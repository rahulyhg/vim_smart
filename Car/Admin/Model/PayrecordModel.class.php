<?php

namespace Admin\Model;

use Think\Model;

class PayrecordModel extends Model{
    
    //自动完成方法，系tp系统函数
    protected $_auto=array(
        //array('start_time','time',1,'function'), //订单生成时间，添加新记录时会触发此自动完成
        //array('pay_time','time',2,'function'), //订单完成支付时间，更新数据时才会触发此自动完成
    );
    
    //生成消费记录
    public function add_record($pay_data){
        
        //设置优惠金额
        $pay_data['cp_loan']=0; //后期配合优惠券功能再进行配置
        //算是最后应付金额
        $pay_data['pay_loan']=$pay_data['payment']-$pay_data['cp_loan'];
        
        //生成流水编号
        $pay_data['pay_no']=date('YmdHis').rand(10000,32767);
        
        //设置订单生成时间
        $pay_data['start_time']=time(); //当前时间戳
        
        //将制作好的数据插入到数据库
        $this->add($pay_data);
    }

    //查询当前结果集中的所有用户信息
    public function query_user_and_car_info($pr_infos){
        $pay_ids='';
        $serv_ids='';
        foreach($pr_infos as $v){
            $pay_ids.=',\''.$v['user_id'].'\'';
            $serv_ids.=',\''.$v['serv_id'].'\'';
        }

        //对应的所有用户信息，并将数据返回模板
        $user_dbname=C('DB_PREFIX')."user";
        $user_infos=M()->query("select user_name,user_id,user_wxnik from ".$user_dbname." where user_id in (".ltrim($pay_ids,',').") order by user_id desc");
        $cars_arr=M()->query("select car_no,serv_id,start_time from ".C('DB_PREFIX')."servicerecord where serv_id in (".ltrim($serv_ids,',').") order by serv_id desc");


        $car_nos='';
        foreach($cars_arr as $v){
            $car_nos.=',\''.$v['car_no'].'\'';
        }

        $car_role_arr=M()->query("select car_no,car_role from ".C('DB_PREFIX')."car where car_no in (".ltrim($car_nos,',').")");
        //数组数据制作
        foreach($cars_arr as $k=>$v){
            foreach($car_role_arr as $kk=>$vv){
                if($v['car_no']==$vv['car_no']){
                    $cars_arr[$k]['car_role']=$vv['car_role'];
                }
            }
        }


        $result_arr=array(
            'user'=>$user_infos,
            'car'=>$cars_arr
        );
        //dump($result_arr);exit;
        return $result_arr;

    }
    
    //查询当前结果集中的所有用户信息 祝君伟 特殊方法
    public function query_user_and_car_info_pay($pr_infos){
        $pay_ids='';
        $serv_ids='';
        foreach($pr_infos as $v){
            $pay_ids.=',\''.$v['pay_user'].'\'';
            $serv_ids.=',\''.$v['serv_id'].'\'';
        }

        //对应的所有用户信息，并将数据返回模板
        $user_dbname=C('DB_PREFIX')."user";
        $user_infos=M()->query("select user_name,user_id,user_wxnik from ".$user_dbname." where user_id in (".ltrim($pay_ids,',').") order by user_id desc");
        $cars_arr=M()->query("select car_no,serv_id,start_time from ".C('DB_PREFIX')."servicerecord where serv_id in (".ltrim($serv_ids,',').") order by serv_id desc");


        $car_nos='';
        foreach($cars_arr as $v){
            $car_nos.=',\''.$v['car_no'].'\'';
        }

        $car_role_arr=M()->query("select car_no,car_role from ".C('DB_PREFIX')."car where car_no in (".ltrim($car_nos,',').")");
        //数组数据制作
        foreach($cars_arr as $k=>$v){
            foreach($car_role_arr as $kk=>$vv){
                if($v['car_no']==$vv['car_no']){
                    $cars_arr[$k]['car_role']=$vv['car_role'];
                }
            }
        }


        $result_arr=array(
            'user'=>$user_infos,
            'car'=>$cars_arr
        );
        //dump($result_arr);exit;
        return $result_arr;

    }


    //计算没条消费记录的停车时长（只计算已经支付状态的记录）
    public function count_use_time($pr_infos,$car_arr){
        foreach($pr_infos as $k=>$v){
            if($v['pay_time']!=0){
                $time_format=$this->make_easy_time($v['pay_time']-$car_arr[$k]['start_time']);
                $pr_infos[$k]['use_time']=$time_format; //一维数组
            }
        }
        return $pr_infos;
    }



    //计算友好化时间格式
    public function make_easy_time($times){
        $time_format['day']=floor($times/86400);   //计算天数
        $time_format['hour']=floor(($times%86400)/3600);   //计算小时
        $time_format['minuter']=floor(($times%3600)/60);   //计算分钟
        $time_format['second']=$times%60;   //计算秒数
        return $time_format;
    }


    //根据时间段搜索(交易总金额，实际支付金额，优惠金额，交易笔数)
    //参数说明：①-开始时间，②-结束时间，③-消费类型（默认停车消费）
    //【注意事项】:时间字串为格式为Y-m-d H:i:s
    public function search_by_time_m($star_time,$end_time,$pay_type=1){
        //字串转时间戳
        $star_time=strtotime($star_time);
        $end_time=strtotime($end_time);
        $condition_datas=array(
            'pay_status'=>'1',
            'pay_time'=>array(array('gt',$star_time),array('lt',$end_time)),
            'pay_type'=>$pay_type
        );
        $payrecord_infos=$this->field('pay_id,payment,pay_loan')->where($condition_datas)->select();

        if($payrecord_infos){
            $result = array();

            $result['all_payment'] = 0.00;  //交易总金额
            $result['all_pay_loan'] = 0.00; //实际支付金额
            foreach ($payrecord_infos as $v) {
                $result['all_payment'] += $v['payment'];
                $result['all_pay_loan'] += $v['pay_loan'];
            }
            $result['all_coupon'] = $result['all_payment'] - $result['all_pay_loan']; //总优惠金额
            $result['use_num'] = count($payrecord_infos); //交易笔数

            //将数据返回
            return $result;
        }else{
            return false;   //无数据返回假
        }

    }


    //查询单个人的停车消费记录
    public function query_single_order($user_id){
        $pr_infos=$this->where(array('user_id'=>$user_id,'is_del'=>'0'))->select();

        $user_car_arr=$this->query_user_and_car_info($pr_infos);

        //计算优惠金额
        foreach($pr_infos as $k=>$v){
            $pr_infos[$k]['cp_hilt']=($v['payment']-$v['pay_loan']);
        }

        //计算停车时长
        $pr_infos=$this->count_use_time($pr_infos,$user_car_arr['car']);
        $return_datas=array(
            'user_car_arr'=>$user_car_arr,
            'pr_infos'=>$pr_infos
        );
        return $return_datas;
    }

    /*
    * 首页显示时段收入
    * 陈琦
    * 2017.3.3
    */
    public function index_time_amount($begin_time,$end_time,$garage_id){
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
        //①当天总收入

        $tai_online =  $today_all_income;
        $tai_cash = $this->index_cash($begin_time,$end_time,$garage_id,0);
        $tai_scan = $this->index_cash($begin_time,$end_time,$garage_id,1);
        $tai_all = $tai_online+$tai_cash+$tai_scan;
        $count_data['today_all_income']['online'] = $tai_online;    //当天在线支付
        $count_data['today_all_income']['cash'] = $tai_cash; //现金支付
        $count_data['today_all_income']['scan'] = $tai_scan;//扫码支付
        $count_data['today_all_income']['all'] = $tai_all;//总支付金额
        //$today_true_income_arr=M('payrecord')->query("select pay_loan from ".C('DB_PREFIX')."payrecord where pay_time>".$begin_time." and pay_time<".$end_time." and pay_status='1'");
        $today_true_income_arr = D('payrecord')->alias('p')
            ->field('p.pay_loan')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$begin_time and pay_time<$end_time")
            ->select();
        //对所有应付金额记录进行叠加
        $today_true_all_income=0.00;
        foreach($today_true_income_arr as $v){
            $today_true_all_income+=$v['pay_loan'];
        }

        //②当天实际总收入

        $trai_online =  $today_true_all_income;
        $trai_cash = $this->index_true_cash($begin_time,$end_time,$garage_id,0);
        $trai_scan = $this->index_true_cash($begin_time,$end_time,$garage_id,1);
        $trai_all = $tai_online+$tai_cash+$tai_scan;
        $count_data['today_true_all_income']['online']=$trai_online;    //当天在线支付
        $count_data['today_true_all_income']['cash'] = $trai_cash; //现金支付
        $count_data['today_true_all_income']['scan'] = $trai_scan;//扫码支付
        $count_data['today_true_all_income']['all'] = $trai_all;//总支付金额
        //③算出当天优惠金额
        $count_data['today_all_cp_hilt']=($tai_all-$trai_all); //当天优惠金额
        //④当天出入场次

        $out_in_count = D('payrecord')->alias('p')
            ->field('count(*) as num')
            ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
            ->where(array('pay_status'=>'1','s.garage_id'=>$garage_id))
            ->where("pay_time>$begin_time and pay_time<$end_time")
            ->select();
        $count_data['out_in_count']=$out_in_count[0]['num'];
        //⑤时间段金额统计
        $arr=D('duty')->select();//值班各时间段收入查询
        foreach ($arr as $k=>&$v){
            $map['p.pay_time']=array(array('gt',$begin_time),array('lt',$end_time));//时间条件
            $map['p.pay_status']='1';
            if($v['id']==47){
                $sum = D('payrecord')->alias('p')
                    ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='0700' and FROM_UNIXTIME(p.pay_time,'%H%i')<='1500'")
                    ->sum('p.payment');
                $sss = M()->_sql();
            } elseif($v['id']==48) {
                $sum = D('payrecord')->alias('p')
                    ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>'1500' and FROM_UNIXTIME(p.pay_time,'%H%i')<'2300'")
                    ->sum('p.payment');
            } else {
                $sum1 = D('payrecord')->alias('p')
                    ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='2300' and FROM_UNIXTIME(p.pay_time,'%H%i')<='2359'")
                    ->sum('p.payment');

                $sum2 = D('payrecord')->alias('p')
                    ->join('LEFT JOIN __SERVICERECORD__ s on p.serv_id = s.serv_id')
                    ->where($map)
                    ->where("s.garage_id=$garage_id and FROM_UNIXTIME(p.pay_time,'%H%i')>='0000' and FROM_UNIXTIME(p.pay_time,'%H%i')<'0700'")
                    ->sum('p.payment');
                $sum = $sum1+$sum2;
            }


            $di_online =  $sum?:0;
            $di_cash = $this->index_cash_ban($v['id'],$begin_time,$end_time,$garage_id,0);
            $di_scan = $this->index_cash_ban($v['id'],$begin_time,$end_time,$garage_id,1);
            $di_all = $di_online+$di_cash+$di_scan;
            $v['duty_incomeArr']['online']=$di_online;    //当天在线支付
            $v['duty_incomeArr']['cash'] = $di_cash; //现金支付
            $v['duty_incomeArr']['scan'] = $di_scan;//扫码支付
            $v['duty_incomeArr']['all'] = $di_all;//总支付金额
        }
        unset($v);
        $count_data['duty']=$arr;
        $count_data['begin_time']=$begin_time;
        $count_data['end_time']=$end_time;
        return $count_data;

    }

    //应收款
    public function index_cash($begin_time,$end_time,$garage_id,$pay_type) {
        $begin_time = $begin_time-7*3600;
        $end_time = $end_time-7*3600;
        $arr = D('offline_income')
            ->where("UNIX_TIMESTAMP(enter_date)>=$begin_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();


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

    //班次
    public function index_cash_ban($id,$begin_time,$end_time,$garage_id,$pay_type) {
        $begin_time = $begin_time-7*3600;
        $end_time = $end_time-7*3600;
        $arr = D('offline_income')->alias('oi')
            ->join('left join __DUTY__ d on oi.duty_id = d.id')
            ->where("UNIX_TIMESTAMP(enter_date)>=$begin_time and UNIX_TIMESTAMP(enter_date)<=$end_time")
            ->where(array("pay_type"=>$pay_type,"d.id"=>$id,"is_check"=>1,'garage_id'=>$garage_id))
            ->select();

        //对所有应付金额记录进行叠加
        $all_income=0.00;
        foreach($arr as $v){
            $all_income+=$v['payment'];
        }

        return $all_income;
    }
    
    
    
}

