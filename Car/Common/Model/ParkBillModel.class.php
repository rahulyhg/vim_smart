<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/22
 * Time: 9:18
 */

namespace Common\Model;


class ParkBillModel extends BillModel
{

    /**
     * 消费记录 临时停车
     * @param int $user_id
     * @param int $garage_id
     * @param int $start_time
     * @return mixed
     */
    public function get_record($user_id=0,$garage_id=0,$start_time=0){
        //条件
        $map = array();
        $user_id    && $map['p.pay_user']     = array( 'eq', $user_id );
        $garage_id  && $map['s.garage_id']   = array( 'eq' , $garage_id);
        $start_time && $map['p.create_time'] = array('egt',$start_time); //时间条件必要 测试注释掉

        $map['p.pay_status']    = array( 'eq', '1' );   //已经支付过的
        $map['p.is_del']        = array(  'eq', '0'  );//没有被逻辑删除的

        //字段
        $field = array(
            'p.user_id',
            'p.pay_id',
            'p.pay_status',
            'p.pay_time',       //支付时间
            'p.pay_loan',       //支付金额
            'p.bill_id',
            'p.pay_no',
            's.garage_id',      //停车场编号
            's.waiter',         //服务员编号
            's.out_no ',        //出口门号
            's.car_no',         //车牌号码
            's.start_time',
            's.end_time',       //停车起始时间
            'ifnull(b.bill_status,-1)'=>'bill_status'
        );

        $list =M('payrecord')->alias('p')
            ->join('LEFT JOIN __SERVICERECORD__ s on s.serv_id=p.serv_id')
            ->join('left join __BILL__ b on b.bill_id = p.bill_id')
            ->where($map)
            ->field($field)
            ->order('p.bill_id asc,pay_time desc')
            ->select();

        if($list){
            foreach($list as &$row){
                $row['pay_record_type'] = "park";
                $row['pay_record_type_name']='临时停车';
                $row['garage_name'] = $this->get_garage_name($row['garage_id']);
            }
            unset($row);
        }

        return $list;
    }


    /**
     * 将消费记录计入发票
     * @param $pay_ids
     * @param $bill_id
     * @return bool
     */
    public function insert_bill($pay_ids,$bill_id){
        $map = array();
        $re = true;
        if($pay_ids){
            $map['pay_id'] = array('in',$pay_ids);
            $re = M('payrecord')->where($map)->setField('bill_id',$bill_id);
        }
        return $re;
    }

    public function get_bill_list($user_id=0,$bill_id=0){
        $field = array(
            'bill.*',
            'bill.create_time'=>'bill_create_time',

            'serv.car_no',
            'serv.start_time',
            'serv.end_time',

            'pay.pay_id',
            'pay.payment',//应付金额
            'pay.pay_loan',//实际付款
            'pay.pay_time',//付款时间
            'pay.pay_user',//付款人ID
            'pay.pay_no',

            'u.user_t_name',
            'u.user_phone',
            //快递信息

            'ad.adress_id',
            'ad.detail',
            'ad.position'



        );
        $map = array();
        $bill_id && $map['bill.bill_id'] = array('eq',$bill_id);
        $user_id && $map['pay.pay_user'] = array('eq',$user_id);

        //停车场过滤
        if(!$this->garage_id) return null;
        $map['serv.garage_id'] = array('in',$this->garage_id);//只能查看自己所在停车场的ID

        $list = $this->alias('bill')
            ->field($field)
            ->where($map)
            ->join('left join __PAYRECORD__ pay on pay.bill_id = bill.bill_id')//获取消费记录
            ->join('left join __USER__ u on u.user_id = bill.user_id')//获取申请人信息
            ->join('left join __SERVICERECORD__ serv on serv.serv_id = pay.serv_id')//获取车辆信息 1:m
            ->join('left join pigcms_express_order e on e.order_id=bill.express_id')
            ->join('left join pigcms_user_adress ad on ad.adress_id = e.shipping_adid')
            ->order('bill.bill_id desc,pay.pay_time desc')
            ->select();

        //echo $list;exit();

        //分组
        if($list){
            $tmp = array();
            foreach($list as $row){
                $row['pay_user_name'] = $row['pay_user'] ? user_info($row['pay_user'])['user_name'] : "";
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
                $tmp[$row['bill_id']]['max_time'] = $row['start_time'] > $tmp[$row['bill_id']]['max_time']
                    ? $row['start_time']
                    :$tmp[$row['bill_id']]['max_time'];
                if(!$tmp[$row['bill_id']]['min_time']) $tmp[$row['bill_id']]['min_time'] = time();
                $tmp[$row['bill_id']]['min_time'] = $row['start_time'] < $tmp[$row['bill_id']]['min_time']
                    ? $row['start_time']
                    :$tmp[$row['bill_id']]['min_time'];


                //获取描述
                $tmp[$row['bill_id']]['audit_name1']        = $row['audit_id1'] ? user_info($row['audit_id1'])['user_name'] :"";
                $tmp[$row['bill_id']]['audit_name2']        = $row['audit_id2'] ? user_info($row['audit_id2'])['user_name'] :"";
                $tmp[$row['bill_id']]['user_name']          = $row['user_id'] ? user_info($row['user_id'])['user_name'] :"";
                $tmp[$row['bill_id']]['bill_status_desc']   = $this->bill_status_desc($row['bill_status'],$row['receive_type']);

                //消费记录 一个发票id 有多条消费记录
                $tmp[$row['bill_id']]['pay_list'][] = array(
                    'car_no'    => $row['car_no'],
                    'start_time'=> $row['start_time'],
                    'end_time'  => $row['end_time'],
                    'pay_id'    => $row['pay_id'],
                    'payment'   => $row['payment'],//应付金额
                    'pay_loan'  => $row['pay_loan'],//实际付款
                    'pay_time'  => $row['pay_time'],//付款时间
                    'pay_user_name' => $row['pay_user_name'],
                    'pay_no'=>$row['pay_no'],
                    'pay_record_type'=>'park',
                    'pay_record_type_name'=>'临时停车',
                );
            }


            $list = $tmp;
        }

        return $list;

    }


}