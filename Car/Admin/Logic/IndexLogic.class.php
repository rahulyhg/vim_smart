<?php
namespace Admin\Logic;
use \Think\Model;
/**
 * 智慧停车主页数据提供层
 * @Author 祝君伟
 * @Time 2017年12月12日14:55:12
 * @Email phpzjw2016@163.com
 * @Net  http://showmeyh.cn/wordpress/
 */
class IndexLogic extends Model{

    protected $trueTableName = 'smart_payrecord';

    public function dashboard_index_data(){
        $admin_name = $_SESSION['admin_name'];
        $s_garage_id_Arr = D('admin')->field('garage_id')->where(array("ad_name"=>$admin_name))->find();
        $s_garage_id = $s_garage_id_Arr['garage_id'];
        $garage_id = isset($_GET['garage_id'])?$_GET['garage_id']:2;
        if ($s_garage_id != 0 && $s_garage_id != '2,4') {
            if ($s_garage_id != $garage_id) {
                $garage_id = $s_garage_id;
            }
        }
        $income_arr=D('payrecord')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->select();
        //对所有应付金额记录进行叠加
//        dump($income_arr);
//        dump(M()->_sql());exit;
        $all_income=0.00;
        foreach($income_arr as $v){
            $all_income+=$v['payment'];
        }
        $count_data['all_income']=$all_income;    //总收入

        //②：实际总收入金额(订单为已支付状态)
        $true_income_arr=D('payrecord')->alias('p')
            ->field('p.pay_loan')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->select();
//        dump(M()->_sql());exit;
        //对所有应付金额记录进行叠加
        $all_true_income=0.00;
        foreach($true_income_arr as $v){
            $all_true_income+=$v['pay_loan'];
        }
        $count_data['all_true_income']=$all_true_income;    //实际总收入
        //③：算出所有优惠金额
        $count_data['all_cp_hilt']=($all_income-$all_true_income); //所有优惠金额

        //④：算出当日总收入金额
        $begin_time=strtotime(date("Y-m-d"))+7*3600;   //当天开始时间
        $end_time=$begin_time+86400;    //当天结束时间
//        dump($begin_time);
//        dump($end_time);exit;
        //$today_income_arr=D('payrecord')->where(array('pay_status'=>'1'))->getField('payment',true);
        $today_income_arr = D('payrecord')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$begin_time and pay_time<$end_time")
            ->select();
        //对所有应付金额记录进行叠加
        $today_all_income=0.00;
        foreach($today_income_arr as $v){
            $today_all_income+=$v['payment'];
        }
        $tai_online =  $today_all_income;
        $tai_cash = $this->index_cash($begin_time,$end_time,$garage_id,0);
        $tai_scan = $this->index_cash($begin_time,$end_time,$garage_id,1);
        $tai_all = $tai_online+$tai_cash+$tai_scan;
        $count_data['today_all_income']['online']=$tai_online;    //当天在线支付
        $count_data['today_all_income']['cash'] = $tai_cash; //现金支付
        $count_data['today_all_income']['scan'] = $tai_scan;//扫码支付
        $count_data['today_all_income']['all'] = $tai_all;//总支付金额
//        $count_data['today_all_income']=$today_all_income;    //当天总收入
        //⑤：算出当日实际总收入金额
        $begin_time=strtotime(date("Y-m-d"))+7*3600;   //当天开始时间
        $end_time=$begin_time+86400;    //当天结束时间
        //$today_income_arr=D('payrecord')->where(array('pay_status'=>'1'))->getField('payment',true);
//        $today_true_income_arr=M()->query("select pay_loan from ".C('DB_PREFIX')."payrecord where pay_time>".$begin_time." and pay_time<".$end_time." and pay_status='1'");
        //对所有应付金额记录进行叠加
        $today_true_income_arr = D('payrecord')->alias('p')
            ->field('p.pay_loan')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$begin_time and pay_time<$end_time")
            ->select();
        $today_true_all_income=0.00;
        foreach($today_true_income_arr as $v){
            $today_true_all_income+=$v['pay_loan'];
        }
//        $count_data['today_true_all_income']=$today_true_all_income;    //当天实际总收入
        $trai_online =  $today_true_all_income;
        $trai_cash = $this->index_true_cash($begin_time,$end_time,$garage_id,0);
        $trai_scan = $this->index_true_cash($begin_time,$end_time,$garage_id,1);
        $trai_all = $tai_online+$tai_cash+$tai_scan;
        $count_data['today_true_all_income']['online']=$trai_online;    //当天在线支付
        $count_data['today_true_all_income']['cash'] = $trai_cash; //现金支付
        $count_data['today_true_all_income']['scan'] = $trai_scan;//扫码支付
        $count_data['today_true_all_income']['all'] = $trai_all;//总支付金额
        //⑥：算出当今优惠金额
        $count_data['today_all_cp_hilt']=($tai_all-$trai_all); //所有优惠金额

        //当天对账金额（晚11点-第二天晚11点）
        $today_zero=strtotime(date('Y-m-d'))-24*60*60;//昨天凌晨时间戳
        $befeleven=$today_zero-60*60;//前天晚11点
        $afteleven=$today_zero+23*60*60;//昨天晚上11点
        $where['pay_time']=array(array('gt',$befeleven),array('lt',$afteleven));//时间条件
        $where['pay_status']='1';
//        $income_arr=D('payrecord')->where($where)->getField('payment',true);
        $income_arr = D('payrecord')->alias('p')
            ->field('p.payment')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where($where)
            ->where("s.garage_id=$garage_id")
            ->select();
        //对所有应付金额记录进行叠加
        $check_income=0.00;
        foreach($income_arr as $v){
            $check_income+=$v['payment'];
        }
        $count_data['check_income']=$check_income;    //当天对账金额
        $time_str = "'$begin_time,$end_time'";
        //echo $time_str;exit();
        //车辆出入场次
        $out_in_count = D('payrecord')->alias('p')
            ->field('count(*) as num')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$begin_time and pay_time<$end_time")
            ->select();
        $count_data['out_in_count']=$out_in_count[0]['num'];
        //按照值班时间统计总交易金额
        $arr=D('duty')->select();
        foreach ($arr as $k=>&$v){
            $v['start_time'] = strtotime(date('Y-m-d').$v['start_time']);
            $v['end_time']=  strtotime(date('Y-m-d').$v['end_time']);
//            $v['start_time']=$begin_time+(date('H',$v['start_time']))*3600;
//            $v['end_time']=$begin_time+(date('H',$v['end_time']))*3600;
            if($v['start_time']>$v['end_time']){//若隔天统计
                $v['end_time']=  $v['end_time']+86400;

            }
            $where['pay_time']=array(array('gt',$v['start_time']),array('lt',$v['end_time']));//时间条件
            $where['pay_status']='1';
//            $v['duty_income']=M('payrecord')->where($where)->sum('payment');
            $v['duty_income'] = D('payrecord')->alias('p')
                ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                ->where($where)
                ->where("s.garage_id=$garage_id")
                ->sum('p.payment');

//            $v['duty_income']=$v['duty_income'];

            $di_online =  $v['duty_income']?:0;
            $di_cash = $this->index_cash_ban($v['id'],$garage_id,0);
            $di_scan = $this->index_cash_ban($v['id'],$garage_id,1);
            $di_all = $di_online+$di_cash+$di_scan;
            $v['duty_incomeArr']['online']=$di_online;    //当天在线支付
            $v['duty_incomeArr']['cash'] = $di_cash; //现金支付
            $v['duty_incomeArr']['scan'] = $di_scan;//扫码支付
            $v['duty_incomeArr']['all'] = $di_all;//总支付金额
        }
        unset($v);
        $count_data['duty']=$arr;
//        dump($count_data['duty']);exit;
        return $count_data;
    }

    //班次
    public function index_cash_ban($id,$garage_id,$pay_type) {
        $start_time = date('Y-m-d',time());
        $end_time = date('Y-m-d',time());
        $arr = D('offline_income')->alias('oi')
            ->join('left join __DUTY__ d on oi.duty_id = d.id')
            ->where("UNIX_TIMESTAMP(enter_date)>=$start_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"d.id"=>$id,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();

        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($arr as $v){
            $all_income+=$v['payment'];
        }

        return $all_income;
    }

    public function index_true_cash_ban($id,$garage_id,$pay_type) {
        $start_time = date('Y-m-d',time());
        $end_time = date('Y-m-d',time());
        $arr = D('offline_income')->alias('oi')
            ->join('left join __DUTY__ d on oi.duty_id = d.id')
            ->where("UNIX_TIMESTAMP(enter_date)>=$start_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"d.id"=>$id,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();

        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($arr as $v){
            $all_income+=$v['payment'];
        }

        return $all_income;
    }

    //应收款
    public function index_cash($begin_time,$end_time,$garage_id,$pay_type) {
        $begin_time = $begin_time-7*3600;
        $end_time = $end_time-7*3600;
        $arr = D('offline_income')
            ->where("UNIX_TIMESTAMP(enter_date)>=$begin_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();
//        echo M()->_sql();exit();

        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($arr as $v){
            $all_income+=$v['payment'];
        }

        return $all_income;
    }

    //实收款
    public function index_true_cash($begin_time,$end_time,$garage_id,$pay_type) {
        $begin_time = $begin_time-7*3600;
        $end_time = $end_time-7*3600;
        $arr = D('offline_income')
            ->where("UNIX_TIMESTAMP(enter_date)>=$begin_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();

        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($arr as $v){
            $all_income+=$v['pay_loan'];
        }

        return $all_income;
    }


}