<?php
/**
 * 手机首页的控制的逻辑层MODEL
 * 祝君伟
 * Date: 2017/6/13
 * Time: 9:59
 */
class WapLogic extends Model{

    protected $tableName = 'adver';

    //发票状态
    const BILL_STATUS_YSQ = 0; //已申请，待审核
    const BILL_STATUS_DLQ = 1; //已审核，待领取
    const BILL_STATUS_YLQ = 2; //已领取
    const BILL_STATUS_YHJ = 4; //客服回绝了用户的发票申请
    const BILL_MIN_LOAN_SUM = 0.1; //申请发票的限制，消费总额至少需要达到的数额

    protected $_auto = array (

        array('last_time','time',1,'function'), // 对last_time字段在添加的时候写入当前时间戳
    );

    public function index_dashboard_data($ym,$garage_id,$village_id=null){
        $openid = $_SESSION['openid'];
        if (!$village_id) {
            $village_id = D('admin')->where(array('openid'=>$openid))->find()['village_id'];
        }
        //数据准备
        $todayTime= $ym;
        $end_today_time = $todayTime+86400;
        $thisDayStart = $ym+7*3600;
        $thisDayEnd = strtotime('+1 days',$thisDayStart);

        //1.门禁开门人数
        $openDoorPerson = M('access_control_user_log')
            ->field(array('count(DISTINCT pigcms_id) as daynum'))
            ->where(array('opdate'=>array('between',array($todayTime,$end_today_time)),'village_id'=>$village_id))
            ->select();

        //2.门禁开门次数
        $openDoorTime = M('access_control_user_log')
            ->where(array('opdate'=>array('between',array($todayTime,$end_today_time)),'village_id'=>$village_id))
            ->count();

        //3.商户收款总笔数
        $totalCashierNumber = M('cashier_order')->alias('c')
            ->join('LEFT JOIN __CASHIER_MERCHANTS__ cash on c.mid = cash.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cash.thirduserid = m.mer_id')
            ->where(array('c.ispay'=>array('eq',1),'c.refund'=>array('neq',2),'c.paytime'=>array('between',array($todayTime,$end_today_time)),'m.village_id'=>$village_id))
            ->count();

        //4.收款总额
        $totalCashierMoney =  M('cashier_order')->alias('c')
            ->field(array('SUM(goods_price) as num'))
            ->join('LEFT JOIN __CASHIER_MERCHANTS__ cash on c.mid = cash.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cash.thirduserid = m.mer_id')
            ->where(array('c.ispay'=>array('eq',1),'c.refund'=>array('neq',2),'c.paytime'=>array('between',array($todayTime,$end_today_time)),'m.village_id'=>$village_id))
            ->select();

        //5.报修事项数
        $repairNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',1),'is_read'=>array('eq',0),'village_id'=>$village_id))
            ->count();

        //6.投诉建议数
        $suggessNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',3),'is_read'=>array('eq',0),'village_id'=>$village_id))
            ->count();

        //7.在线预约
        $appointmentNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',4),'is_read'=>array('eq',0),'village_id'=>$village_id))
            ->count();

        //8.已经巡更点位数
        $ok_Record_num = M('village_point_record')->alias('vi')
            ->field(array("count(DISTINCT vi.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on vi.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where(array('vi.check_time'=>array('between',array($thisDayStart,$thisDayEnd))))
            ->where(array('r.village_id'=>$village_id))
            ->select()[0]['num'];

        //9.巡更异常点位数
        $warningPoint = M('village_point_record')->alias('vi')
            ->field(array("count(DISTINCT vi.pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on vi.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where(array('vi.check_time'=>array('between',array($thisDayStart,$thisDayEnd)),'vi.point_status'=>array('neq',0),'r.village_id'=>$village_id))
            ->select();

        //未巡更数
        $pointCount = M('house_village_point')->alias('p')
                ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ m on m.id=p.rid')
                ->join('LEFT JOIN __HOUSE_VILLAGE__ v on v.village_id=m.village_id')
                ->where(array('p.is_del'=>0,'v.village_id'=>$village_id))
                ->count();
        $lowPointnum = $pointCount-$ok_Record_num;

        $model = new RoomModel();
        $time_y_m = date('Y-m',$ym);
        $list_xungeng = $model->meter_record($time_y_m,-1,$village_id);//取全部数据，取完再做赛选
        $is_record_count = 0;
        $no_record_count = 0;
        foreach($list_xungeng as $key=>$row){
            if($row['is_record']){
                //10.已抄表数
                $is_record_count ++;
            }else{
                //11.未抄表数
                $no_record_count ++;
            }


        }

        //12.水电本月收款总额
        $orderField = array(
            'o.pid',
            'o.money',
            'SUM(o.actual_payment)'=>'total'
        );
        $orderMap = array(
            'p.create_date'=>array('eq',date('Y-m')),
            'r.village_id'=>array('eq',$village_id),
        );
        $totalOrderMoney = M('house_village_pay_order')
            ->alias('o')
            ->field($orderField)
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_PAYLIST__ as p on o.pid=p.pigcms_id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on o.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where($orderMap)
            ->select();

        //13.总交易金额
        $income_arr = M('payrecord','smart_')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->select();
        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($income_arr as $v){
            $all_income+=$v['payment'];
        }

        //14.当日交易金额
        $today_income_arr = M('payrecord','smart_')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$thisDayStart and pay_time<$thisDayEnd")
            ->select();
        //对所有应付金额记录进行叠加
        $today_all_income=0.00;
        foreach($today_income_arr as $v){
            $today_all_income+=$v['payment'];
        }

        //15.早班
        $zao_thisDayEnd = $thisDayStart+8*3600;
        $zao_income_arr = M('payrecord','smart_')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$thisDayStart and pay_time<$zao_thisDayEnd")
            ->select();
        //对所有应付金额记录进行叠加
        $zao_all_income=0.00;
        foreach($zao_income_arr as $v){
            $zao_all_income+=$v['payment'];
        }

        //16.中班
        $zhong_thisDayStart = $thisDayStart+8*3600;
        $zhong_thisDayEnd = $thisDayStart+16*3600;
        $zhong_income_arr = M('payrecord','smart_')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$zhong_thisDayStart and pay_time<$zhong_thisDayEnd")
            ->select();
        //对所有应付金额记录进行叠加
        $zhong_all_income=0.00;
        foreach($zhong_income_arr as $v){
            $zhong_all_income+=$v['payment'];
        }

        //17.晚班
        $wan_thisDayStart = $thisDayStart+16*3600;
        $wan_thisDayEnd = $thisDayStart+24*3600;
        $wan_income_arr = M('payrecord','smart_')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$wan_thisDayStart and pay_time<$wan_thisDayEnd")
            ->select();
        //对所有应付金额记录进行叠加
        $wan_all_income=0.00;
        foreach($wan_income_arr as $v){
            $wan_all_income+=$v['payment'];
        }

        //18.车辆出入场次
        $out_in_count = M('payrecord','smart_')->alias('p')
            ->field('count(*) as num')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id = s.serv_id')
            ->where(array('p.pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("p.pay_time>$thisDayStart and p.pay_time<$thisDayEnd")
            ->select();

        //19.求出车辆数
        $bangCheNum = M('car','smart_')->alias('c')
            ->field('distinct c.car_no,count(*) as num')
            ->join('left join smart_user u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where("c.garage_id = $garage_id")
            ->group("c.car_no")
            ->select();//车辆数

        //20.意见反馈
        $suggess_list = M('house_village_repair_list','pigcms_')->alias('hvrl')
            ->field('count(*) as num')
            ->join('left join __MEAL__ m on m.meal_id = hvrl.meal_id')
            ->where(array('hvrl.village_id'=>$village_id))
            ->where("hvrl.type = 3 || hvrl.type = 4")
            ->order('hvrl.pigcms_id desc')
            ->select();

        //21.项目数
        $village_list_num = D('house_village')->alias('v')
            ->field('count(*) as num')
            ->select();

        //21.已上线项目
        $village_list_num_shangxian = D('house_village')->alias('v')
            ->field('count(*) as num')
            ->where('status=1')
            ->select();

        //22.设备数
        $model_Room = new RoomModel();
        $list_shebei = $model_Room->meterlist_three($village_id);
        $list_shebei_num = count($list_shebei);

        //23.水表
        $list_shebei_shui = $model_Room->meterlist_three($village_id,1);
        $list_shebei_shui_num = count($list_shebei_shui);

        //24.电表
        $list_shebei_dian = $model_Room->meterlist_three($village_id,5);
        $list_shebei_dian_num = count($list_shebei_dian);

        //25.食堂收款-当日收入
        //大头仔 28 一亩田 122
        $list_shitang_dang = D('cashier_order')->alias('o')
            ->field('SUM(goods_price) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where(array('o.ispay'=>1))
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->select();
//        echo M()->_sql();exit;
        $list_shitang_dang_num = $list_shitang_dang[0]['num'];

        //26.食堂收款-交易笔数
        $list_shitang_bi = D('cashier_order')->alias('o')
            ->field('count(*) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where(array('o.ispay'=>1))
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->select();
        $list_shitang_bi_num = $list_shitang_bi[0]['num'];

        //26.食堂收款-消费人次
        $list_shitang_ren = D('cashier_order')->alias('o')
            ->field('count(DISTINCT openid) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where(array('o.ispay'=>1))
            ->where("o.refund != 2 and o.paytime>$todayTime and o.paytime<$end_today_time and m.village_id = $village_id")
            ->select();
        $list_shitang_ren_num = $list_shitang_ren[0]['num'];

        //26.食堂收款-交易总额
        $list_shitang_zong = D('cashier_order')->alias('o')
            ->field('sum(goods_price) as num')
            ->join('left join __CASHIER_MERCHANTS__ cm on cm.mid=o.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cm.thirduserid = m.mer_id')
            ->where(array('o.ispay'=>1))
            ->where("o.refund != 2 and m.village_id = $village_id")
            ->select();
        $list_shitang_zong_num = $list_shitang_zong[0]['num'];

        //申请变量
        $returnArray = array(
            'openDoor_peopel'   => $openDoorPerson[0]['daynum']?:0,
            'openDoor_num'      => $openDoorTime?:0,
            'today_money'       => $totalCashierMoney[0]['num']?:0,
            'today_total_mun'   => $totalCashierNumber?:0,
            'repairNumber'      => $repairNumber?:0,
            'suggessNumber'     => $suggessNumber?:0,
            'appointmentNumber' => $appointmentNumber?:0,
            'isCheckPoint'      => $ok_Record_num,
            'warningPoint'      => $warningPoint[0]['num']?:0,
            'is_record_count'   => $is_record_count?:0,
            'no_record_count'   => $no_record_count?:0,
            'totalOrderMoney'   => $totalOrderMoney[0]['total']?:0,
            'all_money_ting'    => $all_income,
            'one_money_ting'    => number_format($today_all_income,2),
            'zao_money_ting'    => number_format($zao_all_income,2),
            'zhong_money_ting'  => number_format($zhong_all_income,2),
            'wan_money_ting'    => number_format($wan_all_income,2),
            'bi_ting'           => $out_in_count[0]['num'],
            'che_ting'          => count($bangCheNum)?:0,
            'suggess_num'       => $suggess_list[0]['num']?:0,
            'xiangmushu'        => $village_list_num[0]['num']?:0,
            'yishangxianxiangmu'=> $village_list_num_shangxian[0]['num']?:0,
            'shebeishu'         => $list_shebei_num?:0,
            'shuibiao'          => $list_shebei_shui_num?:0,
            'dianbiao'          => $list_shebei_dian_num?:0,
            'dang_shitang'      => $list_shitang_dang_num?:0,
            'bi_shitang'        => $list_shitang_bi_num?:0,
            'ren_shitang'       => $list_shitang_ren_num?:0,
            'zong_shitang'      => $list_shitang_zong_num?:0,
            'wei_xungeng'      => $lowPointnum?:0,
        );

        return $returnArray;

    }

    //向用用户推送消息
    public function send_msg_to_user($bill_id){
        $tpl_id = "xLpzcYPX-Kgwsx6Ym3sHjp_CmZhn_n65_-v6CxC4gAc";
        $url    = "http://www.hdhsmart.com/Car/index.php?m=Home&c=Bill&a=bill_list" . '&bill_id=' . $bill_id;
        $bill_data  =  $this->get_bill_detail($bill_id);
        $data = array(
            'first'=>array(
                'value'=>$this->garage_name . "发票申请提醒",
                'color'=>"#029700",
            ),
            'keyword1'=>array(
                'value'=>'金额：￥' . $bill_data['loan_sum']
                    . '/'
                    . '车牌：'. join(',',$bill_data['car_no_list']),
                'color'=>"#000000",
                'color'=>"#000000",
            ),
            'keyword2'=>array(
                'value'=>$bill_data['user_name'],
                'color'=>"#000000",
            ),
            'keyword3'=>array(
                'value'=>$bill_data['bill_status_desc'][3],
                'color'=>"#000000",
            ),
            'keyword4'=>array(
                'value'=>date('Y-m-d H:i:s',time()),
                'color'=>"#000000",
            ),
        );

        $openid =  array($this->user_info($bill_data['user_id'])['user_wx_opid']);
//        $openid = "ohgcf0uwR88TdPtMs7UMD2qYiOHQ";
        $res = $this->send_tpl_messages($openid,$tpl_id,$url,$data);
        return $res;
    }

    //获取发票详情
    public function get_bill_detail($bill_id)
    {
        return $this->get_bill_list(0,$bill_id)[$bill_id];
    }


    //获取发票列表 包括账单信息等数据
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

            'u.user_t_name',
            'u.user_phone',
            //快递信息

            'ad.adress_id',
            'ad.detail',
            'ad.position',

            'pay.pay_no',



        );
        $map = array();
        $bill_id && $map['bill.bill_id'] = array('eq',$bill_id);
        $user_id && $map['bill.user_id'] = array('eq',$user_id);

        //停车场过滤
        $openid = $_SESSION['openid'];
        $garage_arr = M('user','smart_')->alias('u')
            ->field('c.garage_id')
            ->join('LEFT JOIN smart_car c on u.user_id = c.user_id')
            ->where(array('user_wx_opid'=>$openid))
            ->find()['garage_id'];
        $garage_id = $garage_arr['garage_id'];
        $garage_name = $garage_arr['garage_name'];
        if(!$garage_id) return null;
        $map['serv.garage_id'] = array('in',$garage_id);//只能查看自己所在停车场的ID

        $list = M('bill','smart_')->alias('bill')
            ->field($field)
            ->where($map)
            ->join('left join smart_payrecord pay on pay.bill_id = bill.bill_id')//获取消费记录
            ->join('left join smart_user u on u.user_id = bill.user_id')//获取申请人信息
            ->join('left join smart_servicerecord serv on serv.serv_id = pay.serv_id')//获取车辆信息 1:m
            ->join('left join pigcms_express_order e on e.order_id=bill.express_id')
            ->join('left join pigcms_user_adress ad on ad.adress_id = e.shipping_adid')
            ->order('bill.bill_id desc,pay.pay_time desc')
            ->select();

//        dump($list);exit();

        //分组
        if($list){
            $tmp = array();
            foreach($list as $row){
                $row['pay_user_name'] = $row['pay_user'] ? $this->user_info($row['pay_user'])['user_name'] : "";
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
                $tmp[$row['bill_id']]['garage_name']        = $garage_name;
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
                $tmp[$row['bill_id']]['audit_name1']        = $row['audit_id1'] ? $this->user_info($row['audit_id1'])['user_name'] :"";
                $tmp[$row['bill_id']]['audit_name2']        = $row['audit_id2'] ? $this->user_info($row['audit_id2'])['user_name'] :"";
                $tmp[$row['bill_id']]['user_name']          = $row['user_id'] ? $this->user_info($row['user_id'])['user_name'] :"";
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
                    'pay_no'    => $row['pay_no']//支付流水号
                );
            }


            $list = $tmp;
        }

        return $list;

    }

    public function get_receive_type_name($receive_type=-1){
        $types = array(
            'byself'=>"上门自领",
            'express'=>"邮寄"
        );

        if($receive_type===-1) return $types;
        return $types[$receive_type];
    }

    //获取发票状态描述
    public function bill_status_desc($status=-1,$receive_type='byself'){
        $arr = array(
            self::BILL_STATUS_YSQ=>array(
                "已申请",
                "待审核",
                "审核",
                "您的发票申请已提交,请等待审核"
            ),
            self::BILL_STATUS_DLQ=>array(
                "已审核",
                "待领取",
                "核销",
                $receive_type==="byself"
                    ?"您的发票申请已经通过审核，请于一个工作日后到{$this->kf_address}领取"
                    :"您的发票申请已通过审核,发票会在3日内快递送达",
            ),
            self::BILL_STATUS_YLQ=>array(
                "已核销",
                "已领取",
                "已核销",
                "您的发票已经领取，如有疑问请联系客服"
            ),
        );

        if($status===-1){
            return $arr;
        }else{
            return $arr[$status];
        }
    }

    /**
     * 通过id 获取用户信息，不传则获取自己的
     * @param $user_id
     * @return bool|mixed
     * @author 王亚雄
     */
    function user_info($user_id){

        static $last_user_id;
        static $data =array();

        if (!$user_id) {
            $openid = $_SESSION['openid'];
            $user_id = M('user','smart_')->where(array('user_wx_opid'=>$openid))->find()['user_id'];
        }

        if(!$user_id) return false;
        if($user_id==$last_user_id) return $data[$user_id];//单例

        $user_info =  M('user','smart_')->alias('u')
            ->field('*,a.role_id admin_role')
            ->join('left join smart_admin a on find_in_set(u.user_id,a.ad_uid)')
            ->where('user_id=%d',$user_id)
            ->find();
        $last_user_id = $user_id;
        $data[$user_id] = $user_info;

        return $user_info;


    }

    /**
     * 群发
     * @param $openid openid 数组，多个openid
     * @param $tpl_id 模板id
     * @param $url 点击消息跳转地址
     * @param $data 模板数据
     * @param string $color 颜色
     * @return array|bool
     */
    public function send_tpl_messages($openids,$tpl_id,$url="",$data,$color=""){
        $wechat = new WechatModel();
        set_time_limit(300);//超时时间
        static $res = array();
        $err_openids = [];
        foreach($openids as $key=>$openid){
            $re = $wechat->send_tpl_message($openid,$tpl_id,$url,$data,$color);
            $res[]  = $re;
            if($re['errcode']==40001){//token 失效的情况下
                $err_openids[] = $openid;
            }
        }

        if($err_openids){
            $wechat->resetAuth();//重置token
            $this->send_tpl_messages($err_openids,$tpl_id,$url,$data,$color);
        }else{
            return $res;
        }

    }


}