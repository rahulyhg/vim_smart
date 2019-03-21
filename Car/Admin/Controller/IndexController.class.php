<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
use Admin\Logic\IndexLogic;

class IndexController extends RbacController {
    
    //后台首页
    public function index(){
        $index_Logic = new IndexLogic();
        $count_data = $index_Logic->dashboard_index_data();

        $begin_time=strtotime(date("Y-m-d"))+7*60*60;   //当天开始时间 7:00
        $end_time=$begin_time+86400;    //当天结束时间 第二天7:00
        $today_zero=strtotime(date('Y-m-d'))-24*60*60;//昨天凌晨时间戳
        $befeleven=$today_zero+7*60*60;//昨天天早上7点
        $afteleven=$befeleven+86400;//今天天早上7点
//        dump($befeleven);
//        dump($afteleven);exit;

     //将数据返回模板pastday_true
        $table_json_array = $this->dayTox_true();
       // $table_json_array='[{"date":"06-08","true_income":"630.00","count":"30"},{"date":"06-09","true_income":"885.00","count":"44"},{"date":"06-10","true_income":"465.00","count":"15"},{"date":"06-11","true_income":"135.00","count":"7"},{"date":"06-12","true_income":"990.00","count":"41"},{"date":"06-13","true_income":"1200.00","count":"40"},{"date":"06-14","true_income":"55.00","count":"3"}]';
        //dump($table_json_array);exit;
        $table_json_array_past = $this->table_year();
        $month_add_json_arr=$this->month_add_arr();//停车场月增数据。
        $month_statics=$this->month_statics();//本月交易情况
        $positive_arr=$this->positive_arr();//停车场月活跃数（人数、车辆数）
        $beginThismonth=strtotime(date('Y-m'));//这个月的月初时间戳
        $endThismonth=strtotime('+1 month',$beginThismonth)-1;//这个月的月末时间戳
        $thismonth = date('m');
        $thisyear = date('Y');
        if ($thismonth == 1) {
            $lastmonth = 12;
            $lastyear = $thisyear - 1;
        } else {
            $lastmonth = $thismonth - 1;
            $lastyear = $thisyear;
        }
        $lastStartDay = $lastyear . '-' . $lastmonth . '-1';
        //$lastEndDay = $lastyear . '-' . $lastmonth . '-' . date('t', strtotime($lastStartDay));
        $b_time = strtotime($lastStartDay)+7*3600;//上个月的月初7点
        $e_time = strtotime('+1 month',strtotime($lastStartDay))+7*3600;//下个月月初七点
//        $count_data['user_count']=M('user')->count();
        $zhuceNum = D('user')->alias('u')
            ->field('count(*) as num')
            ->join('LEFT JOIN __PAYRECORD__ p on u.user_id = p.user_id')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where("s.garage_id = $this->garage_id")
            ->group("u.user_id")
            ->select();
        $count_data['user_count'] = count($zhuceNum);
        //求出车辆数
        $bangCheNum = D('car')->alias('c')
            ->field('distinct c.car_no,count(*) as num')
            ->join('left join __USER__ u on c.user_id=u.user_id')
            ->join('left join smart_garage g on c.garage_id=g.garage_id')
            ->where("c.garage_id = $this->garage_id")
            ->group("c.car_no")
            ->select();//车辆数
        $count_data['car_count'] = count($bangCheNum);
//        $count_data['car_count']=count($car_no_arr);//车辆数
        $time1=strtotime(date('Y-m-d'))+7*60*60;//对账起始时间
        $time2=strtotime(date('Y-m-d'))+31*60*60;//对账结束时间
        $garageArray = M('garage')->select();
        $this->assign('garageArray',$garageArray);
        $this->assign('beginThismonth',$beginThismonth);
        $this->assign('endThismonth',$endThismonth);
        $this->assign('b_time',$b_time);
        $this->assign('e_time',$e_time);
        $this->assign('table_json_array',$table_json_array);
        $this->assign('table_json_array_past',$table_json_array_past);
        $this->assign('month_add_json_arr',$month_add_json_arr);
        $this->assign('positive_arr',$positive_arr);
        $this->assign('count_data',$count_data);
        $this->assign('begin_time',$begin_time);
        $this->assign('end_time',$end_time);
        $this->assign('befeleven',$befeleven);
        $this->assign('afteleven',$afteleven);
        $this->assign('time1',$time1);
        $this->assign('time2',$time2);
        $this->assign('month_statics',$month_statics);//本月交易情况
        //调用后台程序模板
        $this->display();

    }

    /*
     * 首页根据所选时间段显示相应收入的ajax请求
     * 陈琦
     * 2017.3.3
     */
    public function index_time_amount(){
        $payrecord=new \Admin\Model\PayrecordModel();
        $begin_time=$_POST['begin_time'];//从前台获取起始时间
        $end_time=$_POST['end_time'];
        $garage_id = $_POST['garage_id'];
        $result=$payrecord->index_time_amount($begin_time,$end_time,$garage_id);//获取前台显示需要的数据
//        dump($result);exit;
        echo json_encode($result);
    }


    /*
     * 首页通过日历选择时段的ajax请求
     * 陈琦
     * 2017.3.3
     */
    public function index_calendar(){
        $begin_time=strtotime($_POST['begin_time'])+7*3600;//从前台获取起始时间
        $end_time=strtotime($_POST['end_time'])+7*3600;
        $garage_id = $_POST['garage_id'];
        $payrecord=new \Admin\Model\PayrecordModel();
        $result=$payrecord->index_time_amount($begin_time,$end_time,$garage_id);//获取前台显示需要的数据
        echo json_encode($result);
    }




    /*主页第一个表格的数据提供方法
     * @author 祝君伟
     * @time 2016.12.29
     * */
    public function dayTox_true(){
        //每天的x轴数据(真实收入)
        $todayTime=strtotime('23:00')-86400-24*60*60;//前天晚上23点
        for($i=5;$i>=-1;$i--){
            $showTime = $todayTime-($i*24*3600)+8*3600;
            $time=date("m-d",$showTime);
            //$week = date("m-d",$showTime);
            $week = $time;
            $showTime_end = $showTime+86400;
            //$today_true_income_arr=M()->query("select pay_loan from ".C('DB_PREFIX')."payrecord where pay_time>".$showTime." and pay_time<".$showTime_end." and pay_status='1'");
            $today_true_income_arr = $this->income_arr($showTime,$showTime_end,1);

            $today_income_arr = $this->income_arr($showTime,$showTime_end);

            $today_day_count = $this->income_arr($showTime,$showTime_end,2);

//            dump($today_day_count);exit;
            /*dump(M()->getLastSql());
            var_dump($today_day_count);exit;*/
            $today_true_all_income=0.00;
            foreach($today_true_income_arr as $v){
                $today_true_all_income+=$v['pay_loan'];
            }
            $today_day_ture = $today_true_all_income;
            if($today_day_ture == ''){
                $today_day_ture = 0;
            }


            $today_all_true = 0.00;
            foreach($today_income_arr as $sv){
                $today_all_true+=$sv['payment'];
            }
            if($today_all_true == ''){
                $today_all_true = 0;
            }
            $table_array[]=array(
                'date'=>$week,
               // 'income'=>$today_day_ture,
                'true_income'=>$today_all_true,
               // 'youhui'=>$today_all_true-$today_day_ture,
                'count'=>$today_day_count[0]['num']
            );

        }
        $table_json_array = json_encode($table_array);
        return $table_json_array;
        //var_dump($table_json_array);
    }

    //查询数据库方法
    public function income_arr($showTime,$showTime_end,$type=0) {
        if ($type == 0) {
            $arr = D('payrecord')->alias('p')
                ->field("p.payment")
                ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                ->where(array('pay_status'=>'1','s.garage_id'=>$this->garage_id))
                ->where("pay_time>$showTime and pay_time<$showTime_end")
                ->select();
        } elseif ($type == 1) {
            $arr = D('payrecord')->alias('p')
                ->field('p.pay_loan')
                ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                ->where(array('pay_status'=>'1','s.garage_id'=>$this->garage_id))
                ->where("pay_time>$showTime and pay_time<$showTime_end")
                ->select();
        } elseif ($type == 2) {
            $arr = D('payrecord')->alias('p')
                ->field("COUNT(*) as num")
                ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                ->where(array('pay_status'=>'1','s.garage_id'=>$this->garage_id))
                ->where("pay_time>$showTime and pay_time<$showTime_end")
                ->select();
        } elseif ($type == 3) {
            $arr = D('payrecord')->alias('p')
                ->field("sum(pay_loan)")
                ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                ->where(array('pay_status'=>'1','s.garage_id'=>$this->garage_id))
                ->where("pay_time>$showTime and pay_time<$showTime_end")
                ->select();
        }

        return $arr;

    }

        /*主页表格一的过去七天数据提供方法
         * @author 祝君伟
         * @time 2016.12.29
         * */
    public function pastday_true(){
        //过去七天的x轴数据(真实收入)
        $y=date("Y",time()-604800);
        $m=date("m",time()-604800);
        $d=date("d",time()-604800);
        $todayTime= mktime(0,0,0,$m,$d,$y);
        $end_time=$todayTime+86400;
        for($i=6;$i>=0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_true_income_arr=M()->query("select pay_loan from ".C('DB_PREFIX')."payrecord where pay_time>".$showTime." and pay_time<".$showTime_end." and pay_status='1'");
            $today_income_arr=M()->query("select payment from ".C('DB_PREFIX')."payrecord where pay_time>".$showTime." and pay_time<".$showTime_end." and pay_status='1'");
            $today_true_all_income=0.00;
            foreach($today_true_income_arr as $v){
                $today_true_all_income+=$v['pay_loan'];
            }
            $today_day_ture = $today_true_all_income;
            if($today_day_ture == ''){
                $today_day_ture = 0;
            }


            $today_all_true = 0.00;
            foreach($today_income_arr as $sv){
                $today_all_true+=$sv['payment'];
            }
            $today_all_true = $today_all_true;
            if($today_all_true == ''){
                $today_all_true = 0;
            }
            $table_array[]=array(
                'date'=>$week,
                'income'=>$today_day_ture,
                'true_income'=>$today_all_true,
                'youhui'=>$today_all_true-$today_day_ture
            );

        }
        $table_json_array = json_encode($table_array);
        //var_dump($table_json_array);
        return $table_json_array;
    }


    /*主页表格二的三十天数据输入方法
     * @author 祝君伟
     * @time 2016.12.29
     * */
    public function table_year(){
        //过去七天的x轴数据(真实收入)
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        $todayTime= mktime(0,0,0,$m,$d,$y)-60*60;
        for($i=9;$i>=0;$i--){
            $showTime = $todayTime-($i*24*3600);
            $week = date("m-d",$showTime);
            $showTime_end = $showTime+86400;
            $today_day_count = $this->income_arr($showTime,$showTime_end,2);
            $table_array[]=array(
                'date'=>$week,
                'count'=>$today_day_count[0]['num']
            );

        }
        $table_json_array = json_encode($table_array);
        return $table_json_array;
    }


    /*
     * 停车场月增数据统计（每月新增用户；每月新增绑定车辆数）
     * 陈琦.
     * 2017.3.29
     */
    public function month_add_arr(){
        $todayTime=strtotime(date('Y-m'));//本月初时间
        for($i=5;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $todayTime);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $usernum_add=M()->query("select count(a.user_id) as num from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as pay on ser.serv_id=pay.serv_id join ".C('DB_PREFIX')."user as a on a.user_id=pay.user_id where a.add_time>".$showTime." and a.add_time<".$showTime_end." and ser.garage_id=".$this->garage_id);//新增用户
            $carnum_add=M()->query("select distinct b.car_no  from ".C('DB_PREFIX')."car as b where b.add_time>".$showTime." and b.add_time<".$showTime_end." and b.garage_id=".$this->garage_id);//新增绑定车辆数
            $carnum_add=count($carnum_add);
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$carnum_add
            );
        }
        $result=json_encode($table_array);
        return $result;
    }



    /*
     * 停车场月增数据统计（每月活跃缴费车辆数；人数）
     * 陈琦.
     * 2017.3.29
     */
    public function positive_arr(){
        $todayTime=strtotime(date('Y-m'));
        for($i=5;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $todayTime);//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            $lastshowTime=strtotime('-1 month',$showTime);//上个月的月初时间
            $lastshowTime_end=strtotime('-1 month',$showTime_end);//上个月月末时间
            $positive_carno=M()->query("select distinct a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$showTime." and b.pay_time<".$showTime_end." and a.garage_id=".$this->garage_id);//活跃车辆数
            $carpositive_add=count($positive_carno);
            $positive_userno=M()->query("select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$showTime." and a.pay_time<".$showTime_end." and ser.garage_id=".$this->garage_id);//活跃人数
            $userpositive_add=count($positive_userno);
            $twoMonth_positive_carno=M()->query("select distinct c.car_no from(select a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$lastshowTime." and b.pay_time<".$lastshowTime_end.")as c join(select distinct a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$showTime." and b.pay_time<".$showTime_end." and a.garage_id=".$this->garage_id.")as d on c.car_no=d.car_no");
            $twoMonth_positive_carno=count($twoMonth_positive_carno);
            $twoMonth_positive_userno=M()->query("select distinct c.user_id from(select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$lastshowTime." and a.pay_time<".$lastshowTime_end.")as c 
                            join(select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$showTime." and a.pay_time<".$showTime_end." and ser.garage_id=".$this->garage_id.")as d on c.user_id=d.user_id");
            $twoMonth_positive_userno=count($twoMonth_positive_userno);
            $table_array[]=array(
                'date'=>$week,
                'three'=>strval($carpositive_add),//活跃车辆数
                'four'=>strval($userpositive_add),//活跃人数
                'five'=>strval($twoMonth_positive_carno),//连续两个月活跃车辆数
                'six'=>strval($twoMonth_positive_userno)//连续两个月活跃人数
            );
        }
        $result=json_encode($table_array);
        return $result;
    }


    /*
     * 停车场根据年份请求数据统计（每月新增用户；每月新增绑定车辆数）
     * 陈琦.
     * 2017.3.29
     */
    public function year_add_arr(){
        $garage_id = I('post.garage_id');
        for($i=1;$i<=12;$i++){
            if($_POST['v']==1){//去年
                $showTime=strtotime('-1 year',strtotime(date('Y-'.$i)));
                $week = date("m",$showTime);
                $showTime_end=strtotime("+1 month",$showTime)-1;//那个月月末时间
            }else{
                $showTime = strtotime(date('Y-'.$i));//那个月月初时间
                $week = date("m",$showTime);
                $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
            }
            $usernum_add=M()->query("select count(a.user_id) as num from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as pay on ser.serv_id=pay.serv_id join ".C('DB_PREFIX')."user as a on a.user_id=pay.user_id where a.add_time>".$showTime." and a.add_time<".$showTime_end." and ser.garage_id=".$garage_id);//新增用户
            $carnum_add=M()->query("select distinct b.car_no  from ".C('DB_PREFIX')."car as b where b.add_time>".$showTime." and b.add_time<".$showTime_end." and b.garage_id=".$garage_id);//新增绑定车辆数
            $carnum_add=count($carnum_add);
            $table_array[]=array(
                'date'=>$week,
                'one'=>$usernum_add[0]['num'],
                'two'=>$carnum_add
            );
        }

        echo json_encode(array('msg'=>$table_array));
    }




    /*
    * 停车场根据年份请求数据统计（每月活跃缴费车辆数；人数）
    * 陈琦.
    * 2017.3.31
    */
    public function positive_year_add_arr(){
        $garage_id = I('post.garage_id');
        for($i=1;$i<=12;$i++){
            if($_POST['v']==1){//去年
                $showTime=strtotime('-1 year',strtotime(date('Y-'.$i)));
                $week = date("m",$showTime);
                $showTime_end=strtotime("+1 month",$showTime)-1;//那个月月末时间
                $lastshowTime=strtotime('-1 month',$showTime);//上个月的月初时间
                $lastshowTime_end=strtotime('-1 month',$showTime_end);//上个月月末时间
            }else{
                $showTime = strtotime(date('Y-'.$i));//那个月月初时间
                $week = date("m",$showTime);
                $showTime_end = strtotime("+1 month",$showTime)-1;//那个月月末时间
                $lastshowTime=strtotime('-1 month',$showTime);//上个月的月初时间
                $lastshowTime_end=strtotime('-1 month',$showTime_end);//上个月月末时间
            }
            $positive_carno=M()->query("select distinct a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$showTime." and b.pay_time<".$showTime_end." and a.garage_id=".$garage_id);//活跃车辆数
            $carpositive_add=count($positive_carno);
            $positive_userno=M()->query("select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$showTime." and a.pay_time<".$showTime_end." and ser.garage_id=".$garage_id);//活跃人数
            $userpositive_add=count($positive_userno);
            $twoMonth_positive_carno=M()->query("select distinct c.car_no from(select a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$lastshowTime." and b.pay_time<".$lastshowTime_end.")as c join(select distinct a.car_no from ".C('DB_PREFIX')."servicerecord as a join ".C('DB_PREFIX')."payrecord as b on a.serv_id=b.serv_id where b.pay_status='1' and
                            b.pay_time>".$showTime." and b.pay_time<".$showTime_end." and a.garage_id=".$garage_id.")as d on c.car_no=d.car_no");
            $twoMonth_positive_carno=count($twoMonth_positive_carno);
            $twoMonth_positive_userno=M()->query("select distinct c.user_id from(select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$lastshowTime." and a.pay_time<".$lastshowTime_end.")as c 
                            join(select distinct a.user_id from ".C('DB_PREFIX')."servicerecord as ser join ".C('DB_PREFIX')."payrecord as a on ser.serv_id=a.serv_id where a.pay_status='1' and a.pay_time>".$showTime." and a.pay_time<".$showTime_end." and ser.garage_id=".$garage_id.")as d on c.user_id=d.user_id");
            $twoMonth_positive_userno=count($twoMonth_positive_userno);
            $table_array[]=array(
                'date'=>$week,
                'three'=>strval($carpositive_add),//活跃车辆数
                'four'=>strval($userpositive_add),//活跃人数
                'five'=>strval($twoMonth_positive_carno),//连续两个月活跃车辆数
                'six'=>strval($twoMonth_positive_userno)//连续两个月活跃人数
            );
        }
        echo json_encode(array('msg'=>$table_array));
//        echo json_encode(array('msg'=>$garage_id));
    }


    /*
     * 近半年交易金额、笔数
     * 陈琦
     * 2017.4.24
     */
    public function month_statics(){
        //过去七天的x轴数据(真实收入)
        $begin_time=strtotime(date('Y-m'));
        for($i=5;$i>=0;$i--){
            $showTime = strtotime("-".$i." month", $begin_time)+7*3600;//那个月的月初时间
            $week = date("m",$showTime);
            $showTime_end = strtotime("+1 month",strtotime("-".$i."month",$begin_time))+7*3600;
//            $today_true_income_arr=M()->query("select sum(pay_loan) from ".C('DB_PREFIX')."payrecord where pay_time>".$showTime." and pay_time<".$showTime_end." and pay_status='1'");
            //$today_income_arr=M()->query("select payment from ".C('DB_PREFIX')."payrecord where pay_time>".$showTime." and pay_time<".$showTime_end." and pay_status='1'");
            $today_true_income_arr = $this->income_arr($showTime,$showTime_end,3);
            $today_day_count = $this->income_arr($showTime,$showTime_end,2);
            /*dump(M()->getLastSql());
            var_dump($today_day_count);exit;*/
//            $today_true_all_income=0.00;
//            foreach($today_true_income_arr as $v){
//                $today_true_all_income+=$v['pay_loan'];
//            }
//            $today_day_ture = $today_true_all_income;
//            if($today_day_ture == ''){
//                $today_day_ture = 0;
//            }


//            $today_all_true = 0.00;
//            foreach($today_income_arr as $sv){
//                $today_all_true+=$sv['payment'];
//            }
//            $today_all_true = $today_all_true;
//            if($today_all_true == ''){
//                $today_all_true = 0;
//            }
            $table_array[]=array(
                'date'=>$week,
                'income'=>$today_true_income_arr[0]['sum(pay_loan)'],
               // 'true_income'=>$today_all_true,
               // 'youhui'=>$today_all_true-$today_day_ture,
                'count'=>$today_day_count[0]['num']
            );

        }
        $table_json_array = json_encode($table_array);
        return $table_json_array;
    }

    public function flush_garage_choose(){
        session('garage_id',null);
        //redirect(U('Admin/Index/index'));
        $this->redirect('Admin/Index/index');
    }
}