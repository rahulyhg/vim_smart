<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/22
 * Time: 9:19
 */

namespace Common\Model;


class YuekaBillModel extends BillModel
{
    /**
     * 消费记录 月卡
     * @param int $user_id
     * @param int $garage_id
     * @param int $pay_time
     */
    public function get_record($user_id=0,$garage_id=0,$pay_time=0){
        //条件
        $map = array();
        $user_id    && $map['yk.user_id']     = array( 'eq', $user_id );
        $garage_id  && $map['yk.garage_id']   = array( 'eq' , $garage_id);
        $pay_time && $map['yk.create_time'] = array('egt',$pay_time); //时间条件必要 测试注释掉

        $map['yk.pay_status']    = array( 'eq', '1' );   //已经支付过的
        $map['yk.is_del']        = array(  'eq', '0'  );//没有被逻辑删除的

        $field = array(
            'yk.pay_id',
            'yk.user_id',
            'yk.payment',
            'yk.pay_loan',
            'yk.car_no',
            'yk.pay_type',
            'yk.how_long',
            'yk.create_time',
            'yk.pay_time',
            'yk.pay_status',
            'yk.order_no',
            'yk.order_no'=>'pay_no',
            'yk.is_del',
            'yk.bill_id',
            'yk.garage_id',
            'ifnull(b.bill_status,-1)'=>'bill_status',
        );
        $list = M('yueka_payrecord')->alias('yk')
            ->field($field)
            ->where($map)
            ->join('left join __BILL__ b on b.bill_id = yk.bill_id')
            ->select();
        if($list){
            foreach($list as &$row){
                $row['pay_record_type'] = "yueka";
                $row['pay_record_type_name'] = "月卡";
                $row['garage_name'] = $this->get_garage_name($row['garage_id']);
            }
            unset($row);
        }

        return $list?:array();
    }

    /**
     * 将消费记录计入发票
     * @param $pay_ids
     * @param $bill_id
     * @return bool
     */
    //将消费记录加入发票
    public function insert_bill($pay_ids,$bill_id){
        $map = array();
        $re = true;
        if($pay_ids){
            $map['pay_id'] = array('in',$pay_ids);
            $re = M('yueka_payrecord')->where($map)->setField('bill_id',$bill_id);
        }
        return $re;
    }

    //获取发票记录
    public function get_bill_list($user_id=0,$bill_id=0){
        $field = array(
            'bill.*',
            'bill.create_time'=>'bill_create_time',
            'yueka.*',

            'u.user_name',
            'u.user_t_name',
            'u.user_phone',
            //快递信息

            'ad.adress_id',
            'ad.detail',
            'ad.position'
        );
        $map = array();
        $bill_id && $map['bill.bill_id'] = array('eq',$bill_id);
        $user_id && $map['bill.user_id'] = array('eq',$user_id);

        //停车场过滤
        if(!$this->garage_id) return null;
        $map['yueka.garage_id'] = array('in',$this->garage_id);//只能查看自己所在停车场的ID

        $list = $this->alias('bill')
            ->field($field)
            ->where($map)
            ->join('left join __YUEKA_PAYRECORD__ yueka on yueka.bill_id = bill.bill_id')
            ->join('left join __USER__ u on u.user_id = bill.user_id')//获取申请人信息
            ->join('left join pigcms_express_order e on e.order_id=bill.express_id')
            ->join('left join pigcms_user_adress ad on ad.adress_id = e.shipping_adid')
            ->order('bill.bill_id desc,yueka.pay_time desc')
            ->select();

        //echo $list;exit();

        //分组
        if($list){
            $tmp = array();
            foreach($list as $row){
                $row['pay_user_name'] = $row['user_t_name']?:$row['user_name'];
                //发票数据
                $tmp[$row['bill_id']]['bill_id']        = $row['bill_id'];
                $tmp[$row['bill_id']]['audit_id1']      = $row['audit_id1'];
                $tmp[$row['bill_id']]['audit_id2']      = $row['audit_id2'];
                $tmp[$row['bill_id']]['bill_status']    = $row['bill_status'];
                $tmp[$row['bill_id']]['user_id']        = $row['user_id'];
                $tmp[$row['bill_id']]['user_t_name']    = $row['user_t_name'];
                $tmp[$row['bill_id']]['user_phone']     = $row['user_phone'];
                $tmp[$row['bill_id']]['bill_create_time']   = $row['bill_create_time'];
                $tmp[$row['bill_id']]['garage_id']          = $row['garage_id'];
                $tmp[$row['bill_id']]['garage_name']        = $this->get_garage_name($row['garage_id']);
                $tmp[$row['bill_id']]['receive_type']       = $row['receive_type'];
                $tmp[$row['bill_id']]['receive_type_name']  = $this->get_receive_type_name($row['receive_type']);



                //快递信息
                $tmp[$row['bill_id']]['adress_id']  = $row['adress_id'];
                $tmp[$row['bill_id']]['detail']     = $row['detail'];
                $tmp[$row['bill_id']]['position']  = $row['position'];
                $tmp[$row['bill_id']]['express_id'] = $row['express_id'];

                //合计数据
                $tmp[$row['bill_id']]['count_pay_list'] ++;
                $tmp[$row['bill_id']]['loan_sum'] =
                    floatval($tmp[$row['bill_id']]['loan_sum'])
                    + $row['pay_loan'];
                //车牌号码统计
                if(!in_array($row['car_no'],$tmp[$row['bill_id']]['car_no_list']?:[])){
                    $tmp[$row['bill_id']]['car_no_list'][] = $row['car_no'];
                }

                //起始时间
                $tmp[$row['bill_id']]['max_time'] = $row['pay_time'] > $tmp[$row['bill_id']]['max_time']
                    ? $row['pay_time']
                    :$tmp[$row['bill_id']]['max_time'];
                if(!$tmp[$row['bill_id']]['min_time']) $tmp[$row['bill_id']]['min_time'] = time();
                $tmp[$row['bill_id']]['min_time'] = $row['pay_time'] < $tmp[$row['bill_id']]['min_time']
                    ? $row['pay_time']
                    :$tmp[$row['bill_id']]['min_time'];


                //获取描述
                $tmp[$row['bill_id']]['audit_name1']        = $row['audit_id1'] ? user_info($row['audit_id1'])['user_name'] :"";
                $tmp[$row['bill_id']]['audit_name2']        = $row['audit_id2'] ? user_info($row['audit_id2'])['user_name'] :"";
                $tmp[$row['bill_id']]['user_name']          = $row['user_id'] ? user_info($row['user_id'])['user_name'] :"";
                $tmp[$row['bill_id']]['bill_status_desc']   = $this->bill_status_desc($row['bill_status'],$row['receive_type']);

                //消费记录 一个发票id 有多条消费记录
                $tmp[$row['bill_id']]['pay_list'][] = array(
                    'car_no'    => $row['car_no'],
                    'pay_id'    => $row['pay_id'],
                    'payment'   => $row['payment'],//应付金额
                    'pay_loan'  => $row['pay_loan'],//实际付款
                    'pay_time'  => $row['pay_time'],//付款时间
                    'pay_user_name' => $row['pay_user_name'],
                    'pay_record_type' => "yueka",
                    'pay_record_type_name' => "月卡",
                    'pay_no'=>$row['order_no'],
                );
            }


            $list = $tmp;
        }

        return $list;

    }

}