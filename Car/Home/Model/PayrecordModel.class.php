<?php

namespace Home\Model;

use Think\Model;


class PayrecordModel extends Model{
    
    //通过订单id查询订单详情
    public function query_order_detail_by_id($pay_id){
        return $this->find($pay_id);
    }
    
    //通过订单编号查新订单详情
    public function query_order_detail_by_no($pay_no){
        return $this->where(array('pay_no'=>$pay_no))->find();
    }


    //通过优惠券id查到对应的活动信息
    public function query_act_by_cpid($arr){
        $cp_ids='';
        foreach($arr as $k=>$v){
            $cp_ids.=',\''.$v['act_id'].'\'';
        }
        return M()->query("select * from ".C('DB_PREFIX')."activity where act_id in (".ltrim($cp_ids,',').")");
    }

    
    //停车服务根据时间计费规则(5元/小时，向上取整原则)
    public function make_fee_by_time_rule($start_time){
        $now_time = time();
        //读出关于停车场的配置文件
        if(!session('garage_id')){
            return false;
        }else{
            $garageInfo = M('garage')->find(session('garage_id'));
            $car_univalence = $garageInfo['garage_unit_price'];
            $car_free_time  = $garageInfo['garage_free_time'];
            $car_max_price = $garageInfo['garage_max_price'];
            $car_max_time = $garageInfo['garage_max_time'];

            $totalHour = ceil(($now_time-$start_time)/3600);


            if($now_time-$start_time<$car_free_time){
                $payment=0;
            }else{
                if($totalHour>$car_max_time&&floor($totalHour/24)>=1){

                    $payment = floor($totalHour/24)*$car_max_price+($totalHour-floor($totalHour/24)*24)*$car_univalence;

                }else if($totalHour<$car_max_time){

                    $payment=ceil(($now_time-$start_time)/3600)*$car_univalence;

                }else if($totalHour>$car_max_time&&floor($totalHour/24)<1){

                    $payment=$car_max_price;

                }

            }
            return $payment;
        }
    }


    //自定义停车服务根据时间计费规则(5元/小时，向上取整原则)
    public function make_money_of_car($start_time,$now_time){
        //读出关于停车场的配置文件
        if(!session('garage_id')){
            return false;
        }else{
            $garageInfo = M('garage')->find(session('garage_id'));
            $car_univalence = $garageInfo['garage_unit_price'];
            $car_free_time  = $garageInfo['garage_free_time'];
            $car_max_price = $garageInfo['garage_max_price'];
            $car_max_time = $garageInfo['garage_max_time'];

            $totalHour = ceil(($now_time-$start_time)/3600);


            if($now_time-$start_time<$car_free_time){
                $payment=0;
            }else{
                if($totalHour>$car_max_time&&floor($totalHour/24)>=1){

                    $payment = floor($totalHour/24)*$car_max_price+($totalHour-floor($totalHour/24)*24)*$car_univalence;

                }else if($totalHour<$car_max_time){

                    $payment=ceil(($now_time-$start_time)/3600)*$car_univalence;

                }else if($totalHour>$car_max_time&&floor($totalHour/24)<1){

                    $payment=$car_max_price;

                }

            }
            return $payment;
        }
    }


    //判断是否存在系统优惠券活动，
    //如果存在且该用户或者车辆条件满足则系统自动给该用户或者车辆发放(用户或者车辆只能选择其一)
    public function system_cp($user_name,$car_no){

        file_get_contents(C('WEB_DOMAIN').'/index.php?m=Admin&c=Api&a=check_legal&act_id=21&shop_id=76&car_no='.$car_no);

        /*

        //判断当前是否存在正在进行的系统活动
        $system_act_infos=M()->query("select act_id from ".C('DB_PREFIX')."activity where ".time().">act_start_time and act_end_time>".time()." and is_over='0' and act_type=1");
        //dump(M()->getLastSql());
        //dump($system_act_infos);exit;

        if($system_act_infos){
            $api=new \Admin\Controller\ApiController();
            foreach($system_act_infos as $v){
                if($user_name){
                    //给指定用户发放优惠券
                    $api->system_self_get_cp($v['act_id'],0,$user_name,$car_no);
                }else if($car_no){
                    //给指定车辆方法优惠券
                    $api->system_self_get_cp($v['act_id'],0,$user_name,$car_no);
                }
            }
        }

        */


    }


    //查询用户名下所有车辆未缴费的订单
    public function query_notpay_by_carno($user_id){
        //①：先查询当前用户名下所有车辆
        $car_no_arr=M('car')->where(array('user_id'=>$user_id))->getField('car_no',true);

        //同时查询该用户名下车辆是否已存在最新的未支付的订单
        $serv_controller=new \Home\Controller\ServicerecordController();
        $result_infos=array();
        foreach($car_no_arr as $v){
            $z=$serv_controller->new_record($v);
            if($z['result_code']==13 || $z['result_code']==14){
                $result_infos[]=$z;  //最新订单记录(二维数组)
            }
        }

        return $result_infos;
    }
    
    //没刷新页面都维护一次改订单的金额信息
    public function flash_cash($pay_id,$too_free){
        $order_creat_time=time();
        $this->where(array('pay_id'=>$pay_id))->data(array('payment'=>$too_free,'create_time'=>$order_creat_time))->save();
    }
    

   /* public function auto_check_car($serv_id,$create_time){
        //这一次的停车信息
        $serv_array = M('servicerecord')->where(array('serv_id'=>$serv_id))->find();
        //上一次的停车信息
        $last_car_info = M('servicerecord')
            ->alias('s')
            ->join('JOIN smart_payrecord  p on s.serv_id=p.serv_id')
            ->where(array('s.car_no'=>$serv_array['car_no'],'p.pay_status'=>'1'))
            ->field('p.pay_time,p.create_time,s.start_time,s.end_time')
            ->order('s.serv_id desc')
            ->limit(1)
            ->select();
        //该车辆上一次支付时间加15分钟大于现在时间

    }*/



    public function query_time_money($date){
        $count=$this->alias('p')
            ->join('LEFT JOIN __SERVICERECORD__ s on s.serv_id=p.serv_id')
            ->where(array('p.user_id'=>'82','s.start_time'=>array('egt',$date)))
            ->count();//获取总页数
        $page=new \Think\Page($count,10);
        $page_count=ceil($count/10);
        $time_money=$this->alias('p')
            ->join('LEFT JOIN __SERVICERECORD__ s on s.serv_id=p.serv_id')
            ->where(array('p.user_id'=>'82','s.start_time'=>array('egt',$date)))
            ->field('p.pay_loan,p.pay_status,s.start_time')
            ->order('s.start_time desc')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach ($time_money as $k=>&$value){
            if($value['pay_status']==0){
                //$value['not_payment']=$this->make_fee_by_time_rule($value['start_time']); //通过计算规则算出订单状态为0的待支付金额
                $value['not_payment']=0; //通过计算规则算出订单状态为0的待支付金额
            }
        }
        unset($value);
        $list=array();//重新定义一个转化好时间的二维数组，通过ajax传给前台用
        foreach ($time_money as $key=>$v){
            $list[]=$v;
            $list[$key]['start_time']=date('Y/m/d H:i',$v['start_time']);
        }
        $result=array(
            'page_count'=>$page_count,
            'time_money'=>$time_money,
            'list'=>$list,
        );
        return $result;
    }


    //寻找改车牌下的车近15分钟内是否有缴费记录
    public function check_and_show($car_no){
        $time = time();
        $s_time = $time-900;
        $count = $this
            ->alias('p')
            ->join('LEFT JOIN smart_servicerecord s on p.serv_id=s.serv_id')
            ->where(array('s.car_no'=>$car_no,'p.pay_time'=>array('between',array($s_time,$time))))
            ->count();
        //return $this->_sql();
        if($count>0){
            return true;
        }else{
            return false;
        }
    }


    /**
     * 判断到底是出场后新订单还是没出场再点击页面的
     * @param $pay_info
     * @return bool  真：还在场内未出场点击的   假：新订单
     */
    public function checkTimeOfNew($pay_info){
        //查询车牌
        $serv_info = M('servicerecord')->find($pay_info['serv_id']);
        //上一笔该车牌的信息
        $last_serv_info = M('servicerecord')->where(array('car_no'=>$serv_info['car_no']))->order('start_time desc')->select()[1];
        //上一笔订单的支付信息
        $last_pay_info = $this->where(array('serv_id'=>$last_serv_info['serv_id']))->find();
        //比较时间
        $nowTime = time();
        //判断时间戳
        if($last_pay_info['pay_time']+900>$nowTime){
            //还在场内未出场
            return true;
        }else{
            return false;
        }


    }

}

