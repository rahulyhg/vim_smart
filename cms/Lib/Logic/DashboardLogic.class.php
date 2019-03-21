<?php
/**
 * 主页逻辑层
 * @author 祝君伟
 * @time 2017年12月6日9:00:13
 */

class DashboardLogic extends Model{


    /**
     * 主页区分数据提供
     * @author 祝君伟
     * @time 2017年12月6日9:01:07
     * @return array
     */
    public function index_dashboard_data(){

        //数据准备
        $todayTime= strtotime(date('Y-m-d'));
        $end_today_time = $todayTime+86400;
        $thisDayStart = strtotime(date('Y-m-d').'07:00:00');
        $thisDayEnd = strtotime('+1 days',$thisDayStart);
        $village_id = filter_village(0,2,'');

        //1.门禁开门人数
        $openDoorPerson = M('access_control_user_log')
            ->field(array('count(DISTINCT pigcms_id) as daynum'))
            ->where(array('opdate'=>array('between',array($todayTime,$end_today_time)),'village_id'=>$_SESSION['system']['village_id']))
            ->select();

        //2.门禁开门次数
        $openDoorTime = M('access_control_user_log')
            ->where(array('opdate'=>array('between',array($todayTime,$end_today_time)),'village_id'=>$_SESSION['system']['village_id']))
            ->count();

        //3.商户收款总笔数
        $totalCashierNumber = M('cashier_order')->alias('c')
            ->join('LEFT JOIN __CASHIER_MERCHANTS__ cash on c.mid = cash.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cash.thirduserid = m.mer_id')
            ->where(array('c.ispay'=>array('eq',1),'c.refund'=>array('neq',2),'c.paytime'=>array('between',array($todayTime,$end_today_time)),'m.village_id'=>$_SESSION['system']['village_id']))
            ->count();

        //4.收款总额
        $totalCashierMoney =  M('cashier_order')->alias('c')
            ->field(array('SUM(goods_price) as num'))
            ->join('LEFT JOIN __CASHIER_MERCHANTS__ cash on c.mid = cash.mid')
            ->join('LEFT JOIN __MERCHANT__ m on cash.thirduserid = m.mer_id')
            ->where(array('c.ispay'=>array('eq',1),'c.refund'=>array('neq',2),'c.paytime'=>array('between',array($todayTime,$end_today_time)),'m.village_id'=>$_SESSION['system']['village_id']))
            ->select();

        //5.报修事项数
        $repairNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',1),'is_read'=>array('eq',0),'village_id'=>$_SESSION['system']['village_id']))
            ->count();

        //6.投诉建议数
        $suggessNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',3),'is_read'=>array('eq',0),'village_id'=>$_SESSION['system']['village_id']))
            ->count();

        //7.在线预约
        $appointmentNumber = M('house_village_repair_list')
            ->where(array('type'=>array('eq',4),'is_read'=>array('eq',0),'village_id'=>$_SESSION['system']['village_id']))
            ->count();

        //8.已经巡更点位数
        $isCheckPoint = M('village_point_record')->alias('vi')
            ->field(array("count(DISTINCT pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on vi.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where(array('check_time'=>array('between',array($thisDayStart,$thisDayEnd)),'r.village_id'=>$_SESSION['system']['village_id']))
            ->select();

        //9.巡更异常点位数
        $warningPoint = M('village_point_record')->alias('vi')
            ->field(array("count(DISTINCT pid)"=>'num'))
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on vi.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where(array('check_time'=>array('between',array($thisDayStart,$thisDayEnd)),'point_status'=>array('neq',0),'r.village_id'=>$_SESSION['system']['village_id']))
            ->select();


        $model = new RoomModel();

        $list = $model->meter_record('',-1,$_SESSION['system']['village_id']);//取全部数据，取完再做赛选
        $is_record_count = 0;
        $no_record_count = 0;
        foreach($list as $key=>$row){
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
            'r.village_id'=>array('eq',$_SESSION['system']['village_id']),
        );
        $totalOrderMoney = M('house_village_pay_order')
            ->alias('o')
            ->field($orderField)
            ->join('LEFT JOIN __HOUSE_VILLAGE_USER_PAYLIST__ as p on o.pid=p.pigcms_id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_POINT__ ho on o.pid = ho.id')
            ->join('LEFT JOIN __HOUSE_VILLAGE_ROOM__ r on ho.rid = r.id')
            ->where($orderMap)
            ->select();
        //申请变量
        $returnArray = array(
            'openDoor_peopel'   => $openDoorPerson[0]['daynum']?:0,
            'openDoor_num'      => $openDoorTime?:0,
            'today_money'       => $totalCashierMoney[0]['num']?:0,
            'today_total_mun'   => $totalCashierNumber?:0,
            'repairNumber'      => $repairNumber?:0,
            'suggessNumber'     => $suggessNumber?:0,
            'appointmentNumber' => $appointmentNumber?:0,
            'isCheckPoint'      => $isCheckPoint[0]['num']?:0,
            'warningPoint'      => $warningPoint[0]['num']?:0,
            'is_record_count'   => $is_record_count?:0,
            'no_record_count'   => $no_record_count?:0,
            'totalOrderMoney'   => $totalOrderMoney[0]['total']?:0,
        );

        return $returnArray;

    }

}