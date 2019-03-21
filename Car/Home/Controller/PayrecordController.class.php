<?php
namespace Home\Controller;
use Admin\Model\DutyModel;
use Home\Model\CouponModel;
use Think\Controller;

class PayrecordController extends Controller {

    //查询当前用户下所有车牌的停车服务记录
    //获取当前用户的session   id

    /**
     * 订单详情的前置操作
     * @update-time: 2017-04-07 16:18:55
     * @author: 王亚雄
     */
    public function _before_order_detail(){
        //领取系统优惠券
        $model = new CouponModel();
        $model->receive_system_coupons();

    }



    //测试
    public function _before_order_detail_two(){
        //领取系统优惠券
        $model = new CouponModel();
        $model->receive_system_coupons();

    }

    //测试订单详情页
    public function order_detail_two(){

        //用户登录操作
        //实例化UserModel
        $user=new \Home\Model\UserModel();
        //如果已经登录过，不再调用
        if(!session('user_id')){
            $user->login();
        }

        //实例化它的model
        $payrecored=new \Home\Model\PayrecordModel();

        //接收对应的订单编号活动订单id
        $pay_id=I('get.pay_id');
        $pay_no=I('get.pay_no');
        $car_no=I('get.car_no');
        $state = I('get.pay_state');
        if(empty($state)){
            //查询对应的订单
            if($pay_id){
                $pay_info=$payrecored->query_order_detail_by_id($pay_id);
            }elseif($pay_no){
                $pay_info=$payrecored->query_order_detail_by_no($pay_no);
            }

            $car_no= urldecode($car_no);

            $pay_info['car_no']=$car_no;


            //如果消费方式为停车消费，通过服务id查询对应的出入场时间
            if($pay_info['pay_type']=='1'){
                $service_info=D('servicerecord')->where('serv_id='.$pay_info['serv_id'])->find();
                $pay_info['start_time']=$service_info['start_time'];   //第三方入场时间
                $pay_info['end_time']=$service_info['end_time'];   //第三方出场时间
            }

            $payment=$payrecored->make_fee_by_time_rule($pay_info['start_time']); //通过计算规则算出应付金额
            if($payment === false){
                $this->error('请选择要缴费的停车场',U('car/choose_garage'));
            }
            $pay_info['payment1']=number_format($payment,2); //【未】参与优惠的金额payment1
            $pay_info['payment2']=number_format($payment,2);; //参与优惠后的金额payment2
            //同时维护订单的金额表(当支付订单已经完成的时候不再能维护本地字段)
            if($pay_info['pay_status']=='0'){
                $payrecored->flash_cash($pay_id,$pay_info['payment2']);
            }
            //传递入场时间戳以便前台时钟显示
            $this->assign('time_begin',$pay_info['start_time']);
            //使用第三方判断是否为月卡车

            $api_total_order=$this->total_order($car_no);
            if($api_total_order['retmsg']=='非临时车'){
                //如果该车为月卡车，将对应的提示消息返回客户端
                $pay_info['payment']=0;
                $this->assign('is_yue_ka','月卡车辆 无需缴费');

            }
            //查询出对应的停车场名称
            $agrage_name=D('servicerecord')->alias('s')->join('__GARAGE__ g on s.garage_id=g.garage_id')->field('garage_name')->where(array('pay_record'=>$pay_id))->find();

            $pay_info['garage_name']=$agrage_name['garage_name'];
            //当前时间
            $date=time();

            //开始时间到目前截止时间
            $c_time = $this->timediff($pay_info['start_time'],$date);//时间差
            //判断是否存在系统优惠券，如存在，且当前用户满足，则系统自动发放
            //$payrecored->system_cp($user_name=null,$car_no);

            //判断当前用户或者当前车辆是否存在优惠券
            //①：判断当前用户是否存在【未过期】优惠券
            $cp_host_info=D('coupon')->where(array('user_id'=>session('user_id'),'is_valid'=>'1'))->select();   //未过滤
            foreach($cp_host_info as $k=>$v) {
                $cp_act_end_time = D('activity')->where(array('act_id' => $v['act_id']))->getField('act_end_time');
                if (time() >= $cp_act_end_time) {
                    D('coupon')->where(array('cp_id'=>$v['cp_id']))->setField(array('is_valid'=>'0'));
                }
            }
            //$cp_host_info=D('coupon')->where(array('user_id'=>session('user_id'),'is_valid'=>'1'))->select();   //已过滤
            /**
             * 过滤掉活动已经关闭的优惠券
             * @update-time: 2017-04-07 17:24:56
             * @author: 王亚雄
             */
            $map = array();
            $map['c.user_id'] = array('eq',session('user_id'));
            $map['c.is_valid'] = array('eq','1');
            $map['act.is_over'] = array('eq','0');
            $cp_host_info=D('Coupon')->alias('c')
                ->field('c.*') //数据尽量保持与前开发人员一致，避免不必要的错误
                ->join('left join __ACTIVITY__ act on c.act_id = act.act_id')
                ->where($map)
                ->select();   //已过滤
            /**
             * 过滤掉活动已经关闭的优惠券【修改结束】
             */
            if($cp_host_info){
                //将优惠券信息返回模板
                $this->assign('cp_infos', $cp_host_info);
                //查询所有活动名称，并将数据返回模板
                $act_infos = D('activity')->select();
                $this->assign('act_infos', $act_infos);
                //将减免金额和最终应付金额数据返回模板
                $old_payment = $payment;
                $pay_info['payment2'] = $this->cp_pay($cp_host_info[0]['cp_id'], $payment);
                $this->assign('free_fee', number_format(floatval($old_payment - $pay_info['payment2']), 2));

            }else{
                //②如果当前用户不存在优惠券则再次判断当前车牌是否存在【未过期】优惠券
                $cp_host_info=D('coupon')->where(array('car_no'=>$car_no,'is_valid'=>'1'))->select();   //未过滤
                foreach($cp_host_info as $k=>$v) {
                    $cp_act_end_time = D('activity')->where(array('act_id' => $v['act_id']))->getField('act_end_time');
                    if (time() >= $cp_act_end_time) {
                        D('coupon')->where(array('cp_id'=>$v['cp_id']))->setField(array('is_valid'=>'0'));
                    }
                }
                $cp_host_info=D('coupon')->where(array('car_no'=>$car_no,'is_valid'=>'1'))->select();   //已过滤

                if($cp_host_info){
                    //将优惠券信息返回模板
                    $this->assign('cp_infos',$cp_host_info);
                    //查询所有优惠券对应的活动名称，并将数据返回模板
                    $act_infos=$payrecored->query_act_by_cpid($cp_host_info);
                    $this->assign('act_infos',$act_infos);
                    //将减免金额和最终应付金额数据返回模板
                    $old_payment=$payment;
                    $pay_info['payment2']=$this->cp_pay($cp_host_info[0]['cp_id'],$payment);
                    $this->assign('free_fee',number_format(floatval($old_payment-str_replace(',','',$pay_info['payment2'])),2));
                }
            }


            //将数据返回模板
            $this->assign('c_time',$c_time);
            $show_msg = '进场30分钟内不产生费用';

            //再次判断应付金额，防止用户直接跳转订单详情页面显示信息不符
            if($pay_info['pay_status']=='1'){
                $check_time = time() - $pay_info['pay_time'];
                //如果出场15分钟内再点订单就把提示文字改掉
                if($payrecored->check_and_show($pay_info['car_no'])){
                    $pay_info['payment2']='0.00';
                    $show_msg = '请在15分钟内离场，否则将产生额外费用';
                    $this->assign('how_long_wait',(900-$check_time)*1000);
                }else{
                    if($check_time>=900){
                        //超时出场，进入溢价
                        $pay_fees = ceil($check_time/3600)*5;
                        $this->redirect('Payrecord/order_detail',array('pay_state'=>1,'pay_fees'=>$pay_fees,'car_no'=>$pay_info['car_no'],'more_time'=>$check_time));
                    }else{
                        $show_msg = '进场30分钟不收费';
                    }
                }
            }

            /**
             * 判断当前时间是否为新进场时间
             */

            $is_new = $payrecored->checkTimeOfNew($pay_info);

            if($is_new){
                $show_msg = '请在15分钟内离场，否则将产生额外费用';
            }


            //制作常规用户车牌显示
            $user_view_car_no=str_replace('-','',$pay_info['car_no']);
            $car_no_pre=mb_substr($user_view_car_no,0,2);
            $car_no_after=mb_substr($user_view_car_no,2);
            $user_view_car_no=$car_no_pre.'-'.$car_no_after;
            $pay_info['user_view_car_no']=$user_view_car_no;

            $this->assign('pay_info',$pay_info);

            /**
             * 获取最佳优惠券ID　ＳＴＡＲＴ 其他逻辑不变
             * @update-time: 2017-04-06 11:36:47
             * @author: 王亚雄
             */
            $cp_model = new CouponModel();
            $optimal_cp_id = $cp_model->get_optimal_coupon($cp_host_info,$pay_info['payment1']);
            $this->assign('optimal_cp_id',$optimal_cp_id);

            /**
             * 获取最佳优惠券ID　ＥＮＤ
             */


            //dump($pay_info);exit;
        }else{
            //进入溢价模式
            //溢价模式的特殊订单号  5+时间戳+uid
            $pay_no = '5'.date("YmdHis").sprintf("%04d",session('user_id'));
            //溢价的钱数，避免恶意逃款,永远不相信客户提交的数据
            $pay_fees = I('get.pay_fees');
            //跳过正常停车模式，直接生产订单
            $pay_info_sp = array(
                'user_id'=>session('user_id'),
                'pay_user'=>session('user_id'),
                'payment'=>number_format($pay_fees,2),
                'serv_id'=>214748647,//int最大取值范围
                'create_time'=>time(),
                'pay_type'=>1,
                'pay_no'=>$pay_no,
                'api_pay_no'=>$pay_no
            );
            //向订单表插入数据
            $pay_id = M('payrecord')->add($pay_info_sp);
            //制作向前台传递的数据
            $car_no=I('get.car_no');
            //$car_no= urldecode($car_no);
            $more_then_time= I('get.more_time');
            //制作常规用户车牌显示
            $user_view_car_no=str_replace('-','',$car_no);
            $car_no_pre=mb_substr($user_view_car_no,0,2);
            $car_no_after=mb_substr($user_view_car_no,2);
            $user_view_car_no=$car_no_pre.'-'.$car_no_after;
            //前台显示数组
            $premium_info = array(
                'pay_id'=>$pay_id,
                'user_id'=>session('user_id'),
                'pay_user'=>session('user_id'),
                'payment'=>number_format($pay_fees,2),
                'cp_id'=>'0',
                'create_time'=>time(),
                'pay_no'=>$pay_no,
                'api_pay_no'=>$pay_no,
                'car_no'=>$car_no,
                'start_time'=>time(),
                'payment1'=>number_format($pay_fees,2),
                'payment2'=>$pay_fees,
                'garage_name'=>'广发银行大厦停车场',
                'user_view_car_no'=>$user_view_car_no,
                'more_then_time'=>$this->how_long($more_then_time)
            );
            $this->assign('pay_info',$premium_info);
            $this->assign('time_begin',time());
        }

        //调用模板
        //服务器标准时间
        $uninx_time = time();
        $this->assign('show_msg',$show_msg);
        $this->assign('uninx_time',$uninx_time);
        $this->assign('garage_id',I('get.garage_id'));
        $this->display();

    }

    //订单详情页
    public function order_detail(){

        //用户登录操作
        //实例化UserModel
        $user=new \Home\Model\UserModel();
        //如果已经登录过，不再调用
        if(!session('user_id')){
            $user->login();
        }

        //实例化它的model
        $payrecored=new \Home\Model\PayrecordModel();

        //接收对应的订单编号活动订单id
        $pay_id=I('get.pay_id');
        $pay_no=I('get.pay_no');
        $car_no=I('get.car_no');
        $state = I('get.pay_state');
        if(empty($state)){
            //查询对应的订单
            if($pay_id){
                $pay_info=$payrecored->query_order_detail_by_id($pay_id);
            }elseif($pay_no){
                $pay_info=$payrecored->query_order_detail_by_no($pay_no);
            }

            $car_no= urldecode($car_no);

            $pay_info['car_no']=$car_no;


            //如果消费方式为停车消费，通过服务id查询对应的出入场时间
            if($pay_info['pay_type']=='1'){
                $service_info=D('servicerecord')->where('serv_id='.$pay_info['serv_id'])->find();
                $pay_info['start_time']=$service_info['start_time'];   //第三方入场时间
                $pay_info['end_time']=$service_info['end_time'];   //第三方出场时间
            }
            $payment=$payrecored->make_fee_by_time_rule($pay_info['start_time']); //通过计算规则算出应付金额
            if($payment === false){
                $this->error('请选择要缴费的停车场',U('Car/choose_garage'));
            }
            $pay_info['payment1']=number_format($payment,2); //【未】参与优惠的金额payment1
            $pay_info['payment2']=number_format($payment,2);; //参与优惠后的金额payment2
            //同时维护订单的金额表(当支付订单已经完成的时候不再能维护本地字段)
            if($pay_info['pay_status']=='0'){
                $payrecored->flash_cash($pay_id,$pay_info['payment2']);
            }
            //传递入场时间戳以便前台时钟显示
            $this->assign('time_begin',$pay_info['start_time']);
            //使用第三方判断是否为月卡车

            $api_total_order=$this->total_order($car_no);
            if($api_total_order['retmsg']=='非临时车'){
                //如果该车为月卡车，将对应的提示消息返回客户端
                $pay_info['payment']=0;
                $this->assign('is_yue_ka','月卡车辆 无需缴费');

            }
            //查询出对应的停车场名称
            $agrage_name=D('servicerecord')->alias('s')->join('__GARAGE__ g on s.garage_id=g.garage_id')->field('garage_name')->where(array('pay_record'=>$pay_id))->find();

            $pay_info['garage_name']=$agrage_name['garage_name'];
            //当前时间
            $date=time();

            //开始时间到目前截止时间
            $c_time = $this->timediff($pay_info['start_time'],$date);//时间差
            //判断是否存在系统优惠券，如存在，且当前用户满足，则系统自动发放
            //$payrecored->system_cp($user_name=null,$car_no);

            //判断当前用户或者当前车辆是否存在优惠券
            //①：判断当前用户是否存在【未过期】优惠券
            $cp_host_info=D('coupon')->where(array('user_id'=>session('user_id'),'is_valid'=>'1'))->select();   //未过滤
            foreach($cp_host_info as $k=>$v) {
                $cp_act_end_time = D('activity')->where(array('act_id' => $v['act_id']))->getField('act_end_time');
                if (time() >= $cp_act_end_time) {
                    D('coupon')->where(array('cp_id'=>$v['cp_id']))->setField(array('is_valid'=>'0'));
                }
            }
            //$cp_host_info=D('coupon')->where(array('user_id'=>session('user_id'),'is_valid'=>'1'))->select();   //已过滤
            /**
             * 过滤掉活动已经关闭的优惠券
             * @update-time: 2017-04-07 17:24:56
             * @author: 王亚雄
             */
            $map = array();
            $map['c.user_id'] = array('eq',session('user_id'));
            $map['c.is_valid'] = array('eq','1');
            $map['act.is_over'] = array('eq','0');
            $cp_host_info=D('Coupon')->alias('c')
                ->field('c.*') //数据尽量保持与前开发人员一致，避免不必要的错误
                ->join('left join __ACTIVITY__ act on c.act_id = act.act_id')
                ->where($map)
                ->select();   //已过滤
            /**
             * 过滤掉活动已经关闭的优惠券【修改结束】
             */
            if($cp_host_info){
                //将优惠券信息返回模板
                $this->assign('cp_infos', $cp_host_info);
                //查询所有活动名称，并将数据返回模板
                $act_infos = D('activity')->select();
                $this->assign('act_infos', $act_infos);
                //将减免金额和最终应付金额数据返回模板
                $old_payment = $payment;
                $pay_info['payment2'] = $this->cp_pay($cp_host_info[0]['cp_id'], $payment);
                $this->assign('free_fee', number_format(floatval($old_payment - $pay_info['payment2']), 2));

            }else{
                //②如果当前用户不存在优惠券则再次判断当前车牌是否存在【未过期】优惠券
                $cp_host_info=D('coupon')->where(array('car_no'=>$car_no,'is_valid'=>'1'))->select();   //未过滤
                foreach($cp_host_info as $k=>$v) {
                    $cp_act_end_time = D('activity')->where(array('act_id' => $v['act_id']))->getField('act_end_time');
                    if (time() >= $cp_act_end_time) {
                        D('coupon')->where(array('cp_id'=>$v['cp_id']))->setField(array('is_valid'=>'0'));
                    }
                }
                $cp_host_info=D('coupon')->where(array('car_no'=>$car_no,'is_valid'=>'1'))->select();   //已过滤

                if($cp_host_info){
                    //将优惠券信息返回模板
                    $this->assign('cp_infos',$cp_host_info);
                    //查询所有优惠券对应的活动名称，并将数据返回模板
                    $act_infos=$payrecored->query_act_by_cpid($cp_host_info);
                    $this->assign('act_infos',$act_infos);
                    //将减免金额和最终应付金额数据返回模板
                    $old_payment=$payment;
                    $pay_info['payment2']=$this->cp_pay($cp_host_info[0]['cp_id'],$payment);
                    $this->assign('free_fee',number_format(floatval($old_payment-str_replace(',','',$pay_info['payment2'])),2));
                }
            }


            //将数据返回模板
            $this->assign('c_time',$c_time);
            $show_msg = '进场30分钟内不产生费用';

            //再次判断应付金额，防止用户直接跳转订单详情页面显示信息不符
            if($pay_info['pay_status']=='1'){
                $check_time = time() - $pay_info['pay_time'];
                //如果出场15分钟内再点订单就把提示文字改掉
                if($payrecored->check_and_show($pay_info['car_no'])){
                    $pay_info['payment2']='0.00';
                    $show_msg = '请在15分钟内离场，否则将产生额外费用';
                    $this->assign('how_long_wait',(900-$check_time)*1000);
                }else{
                    if($check_time>=900){
                        //超时出场，进入溢价
                        $pay_fees = ceil($check_time/3600)*5;
                        $this->redirect('Payrecord/order_detail',array('pay_state'=>1,'pay_fees'=>$pay_fees,'car_no'=>$pay_info['car_no'],'more_time'=>$check_time));
                    }else{
                        $show_msg = '进场30分钟不收费';
                    }
                }
            }

            /**
             * 判断当前时间是否为新进场时间
             */

            $is_new = $payrecored->checkTimeOfNew($pay_info);

            if($is_new){
                $show_msg = '请在15分钟内离场，否则将产生额外费用';
            }


            //制作常规用户车牌显示
            $user_view_car_no=str_replace('-','',$pay_info['car_no']);
            $car_no_pre=mb_substr($user_view_car_no,0,2);
            $car_no_after=mb_substr($user_view_car_no,2);
            $user_view_car_no=$car_no_pre.'-'.$car_no_after;
            $pay_info['user_view_car_no']=$user_view_car_no;

            $this->assign('pay_info',$pay_info);

            /**
             * 获取最佳优惠券ID　ＳＴＡＲＴ 其他逻辑不变
             * @update-time: 2017-04-06 11:36:47
             * @author: 王亚雄
             */
            $cp_model = new CouponModel();
            $optimal_cp_id = $cp_model->get_optimal_coupon($cp_host_info,$pay_info['payment1']);
            $this->assign('optimal_cp_id',$optimal_cp_id);

            /**
             * 获取最佳优惠券ID　ＥＮＤ
             */


            //dump($pay_info);exit;
        }else{
            //进入溢价模式
            //溢价模式的特殊订单号  5+时间戳+uid
            $pay_no = '5'.date("YmdHis").sprintf("%04d",session('user_id'));
            //溢价的钱数，避免恶意逃款,永远不相信客户提交的数据
            $pay_fees = I('get.pay_fees');
            //跳过正常停车模式，直接生产订单
            $pay_info_sp = array(
                'user_id'=>session('user_id'),
                'pay_user'=>session('user_id'),
                'payment'=>number_format($pay_fees,2),
                'serv_id'=>214748647,//int最大取值范围
                'create_time'=>time(),
                'pay_type'=>1,
                'pay_no'=>$pay_no,
                'api_pay_no'=>$pay_no
            );
            //向订单表插入数据
            $pay_id = M('payrecord')->add($pay_info_sp);
            //制作向前台传递的数据
            $car_no=I('get.car_no');
            //$car_no= urldecode($car_no);
            $more_then_time= I('get.more_time');
            //制作常规用户车牌显示
            $user_view_car_no=str_replace('-','',$car_no);
            $car_no_pre=mb_substr($user_view_car_no,0,2);
            $car_no_after=mb_substr($user_view_car_no,2);
            $user_view_car_no=$car_no_pre.'-'.$car_no_after;
            //前台显示数组
            $premium_info = array(
                'pay_id'=>$pay_id,
                'user_id'=>session('user_id'),
                'pay_user'=>session('user_id'),
                'payment'=>number_format($pay_fees,2),
                'cp_id'=>'0',
                'create_time'=>time(),
                'pay_no'=>$pay_no,
                'api_pay_no'=>$pay_no,
                'car_no'=>$car_no,
                'start_time'=>time(),
                'payment1'=>number_format($pay_fees,2),
                'payment2'=>$pay_fees,
                'garage_name'=>'广发银行大厦停车场',
                'user_view_car_no'=>$user_view_car_no,
                'more_then_time'=>$this->how_long($more_then_time)
            );
            $this->assign('pay_info',$premium_info);
            $this->assign('time_begin',time());
        }

        //调用模板
        //服务器标准时间
        $uninx_time = time();
        $this->assign('show_msg',$show_msg);
        $this->assign('uninx_time',$uninx_time);
        $this->display();

    }


    public function ajax_time(){
        echo time();
    }


    //简化的时间戳计算方式
    public function how_long($timediff){
        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $time = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        //分钟、秒个位数时,前面加0
        if($time['sec']<10){
            $time['sec'] = '0'.$time['sec'];
        }else if($time['min']<10){
            $time['min'] = '0'.$time['min'];
        }
        if($time['day']==0 && $time['hour']!=0 && $time['min']!=0){
            $c_time=$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']!=0){
            $c_time=$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']==0){
            $c_time=$time['sec'].'秒';
        }
        if($time['day']!=0){
            $c_time=$time['day'].'天'.$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        return $c_time;
    }
    
    
    //根据时间戳计算时间差
    public function timediff($begin_time,$end_time)
    {
        if($begin_time < $end_time){
            $starttime = $begin_time;
            $endtime = $end_time;
        }else{
            $starttime = $end_time;
            $endtime = $begin_time;
        }

        //计算天数
        $timediff = $endtime-$starttime;
        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $time = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        //分钟、秒个位数时,前面加0
        if($time['sec']<10){
            $time['sec'] = '0'.$time['sec'];
        }else if($time['min']<10){
            $time['min'] = '0'.$time['min'];
        }
        if($time['day']==0 && $time['hour']!=0 && $time['min']!=0){
            $c_time=$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']!=0){
            $c_time=$time['min'].'分钟'.$time['sec'].'秒';
        }
        if($time['day']==0 && $time['hour']==0 && $time['min']==0){
            $c_time=$time['sec'].'秒';
        }
        if($time['day']!=0){
            $c_time=$time['day'].'天'.$time['hour'].'小时'.$time['min'].'分钟'.$time['sec'].'秒';
        }
        return $c_time;
    }
    //最终结算(调用第三方接口数据完善完整订单)
    public function total_order($car_no){

        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();
        //实例化第三方接口(捷顺)Model
        $jieshun=new \Org\JieShunApi\Jieshun();

        $api_order_info=$jieshun->api_make_order($car_no);
        return $api_order_info['dataItems'][0]['attributes'];


    }


    //测试
    public function pay_now_two(){

        //用户登录操作
        //实例化UserModel
        $user=new \Home\Model\UserModel();
        //如果已经登录过，不再调用
        if(!session('user_id')){
            echo json_encode(11);
            exit;//支付失败，微信没有任何信息返回
        }

        if(!session('garage_id')){
            echo json_encode(12);
            exit;//支付失败，微信没有任何信息返回
        }

        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();

        //设定微信官方订单详情参数
        $garage_name=I('post.garage_name');//停车场名称
        $order_name=$garage_name.I('post.fee_name');  //订单名称
        $order_no=I('post.order_no');    //订单编号
        $car_no=I('post.car_no');  //车牌号
        //$total_fee=str_replace(',','',I('post.total_fee')); //总费用(仅供用户参考，不作为最终的支付数据)
        $cp_id=I('post.cp_id'); //优惠券id
        $now_time_for_log = time();
        //与第三方接口数据作对比

        //无刷新版本把总价放入后台计算，前台不再传递
        $total_fee = M('payrecord')->where(array('pay_no'=>$order_no))->getField('payment');

        $api_order_info=$this->total_order($car_no);
        if($api_order_info['totalFee']!=$total_fee){
            //如果两边金额不一致，以第三方接口为准
            if($api_order_info['totalFee']!=0&&$api_order_info['totalFee']>$total_fee){
                $total_fee=$api_order_info['totalFee'];
            }else if($api_order_info['totalFee']!=0&&$api_order_info['totalFee']<$total_fee){
                $total_fee = $total_fee;
            }else if($api_order_info['totalFee']==0&&$api_order_info['totalFee']<$total_fee){
                //同时记下异常日志
                $fp= fopen('./Common/Log/WeiXin_notice/money_error_'.$order_no.'.log', 'a+');
                fwrite($fp, "本地金额是：".$total_fee."\r\n本地时间为".date("Y-m-d H:i:s",$now_time_for_log)."\r\n第三方金额为".$api_order_info['totalFee']);
                fclose($fp);
                $this->warning_data_add(ACTION_NAME,MODULE_NAME,'1225',$total_fee,'停车场计费异常');
                //$total_fee=0;
            }

            //同时记下异常日志
            $fp= fopen('./Common/Log/WeiXin_notice/num_error_'.$order_no.'.log', 'a+');
            fwrite($fp, $total_fee);
            fclose($fp);
        }

        $old_total_fee=$total_fee;


        //判断是否存在优惠券
        if($cp_id){
            $cp=D('coupon');
            //执行优惠券自动过期功能
            $cp_end_time=$cp->where(array('cp_id'=>$cp_id))->getField('end_time');
            if(time()>=$cp_end_time){
                $cp->where(array('cp_id'=>$cp_id))->setField(array('is_valid'=>'0'));   //设置为过期状态，并且禁止使用此优惠券
            }else {
                $cp_id = (int)$cp_id;
                //校验优惠是否属于该用户或者属于该车牌
                //①：判断是否为用户所持，并且此优惠券未过期
                $cp_host_id = $cp->where(array('cp_id' => $cp_id, 'is_valid' => '1'))->getField('user_id');
                if ($cp_host_id && $cp_host_id == session('user_id')) {
                    //执行优惠券参与最终结算
                    $total_fee = $this->cp_pay($cp_id, $total_fee);
                    $datas['cp_id'] = (int)$cp_id;    //如果使用到优惠券，那么将优惠券信息记录到本次订单记录
                }
                //②：判断是否车辆所持，并且此优惠券未过期
                $cp_car_no = $cp->where(array('cp_id' => $cp_id, 'is_valid' => '1'))->getField('car_no');
                if ($cp_car_no) {
                    if ($cp_car_no && $car_no == $cp_car_no) {
                        //执行优惠券参与最终结算
                        $total_fee = $this->cp_pay($cp_id, $total_fee);
                        $datas['cp_id'] = (int)$cp_id;    //如果使用到优惠券，那么将优惠券信息记录到本次订单记录
                    }
                }
            }
        }

        //同时将第三方数据维护到订单表
        //同时更新点击按钮时间
        $datas=array(
            'payment'=>$old_total_fee,    //应付金额(第三方实时数据，除非用户真正支付后才成为最终数据)
            'api_pay_no'=>$api_order_info['orderNo'],
            'button_time'=>time()//第三方接口订单
        );

        //$payrecored->where(array('pay_no'=>$order_no))->setField($datas);
        $upd_api_orderno=$payrecored->where(array('pay_no'=>$order_no))->setField($datas);
        if(!$upd_api_orderno){
            //更新第三方订单号失败
            echo 1;exit;
        }

        //使用优惠券后，如果金额已经为0或者为负数，
        if($cp_id){
            $payrecored->where(array('pay_no'=>$order_no))->setField(array('cp_id'=>$cp_id));   //将优惠券信息更新到订单记录表
            if($total_fee<=0){
                //①：修改订单状态
                if($payrecored->where(array('pay_no'=>$order_no))->setField(array('pay_status'=>'1','cp_id'=>$cp_id))){
                    //②：修改优惠券状态
                    if(D('coupon')->where(array('cp_id'=>$cp_id))->setField(array('is_valid'=>'2'))) {
                        //维护订单表支付人和支付时间
                        $upd_date=array(
                            'pay_user'=>session('user_id'),
                            'pay_time'=>time()
                        );
                        $payrecored->where(array('pay_no'=>$order_no))->setField($upd_date);

                        //③：通知第三开门
                        $jieshun_api = new \Org\JieShunApi\Jieshun();
                        $serv_id = M('payrecord')->where(array('pay_no'=>$order_no))->getField('serv_id');
                        $garage_id = M('servicerecord')->find($serv_id)['garage_id'];
                        //通知第三方开门接口
                        $notice_jieshun_result = $jieshun_api->notice_api_pay_ok($api_order_info['orderNo'],$garage_id);
                        //记录日志文件，后期可查异常状态追责
                        $fp= fopen('../../Common/Log/WeiXin_notice/wxin_back_hw123123.log', 'a+');
                        fwrite($fp, '[处理结果为'.$notice_jieshun_result['dataItems'][0]['attributes']['retCode'].'返回码为'.$notice_jieshun_result['resultCode'].'报错是'.$notice_jieshun_result['message'].']');
                        fclose($fp);
                        if ($notice_jieshun_result['dataItems'][0]['attributes']['retCode'] == '0') {
                            //④：通知支付成功(本次订单自此时起免费期内自动抬杆)，同时维护本系统停车记录表
                            $pay_serv_id = $payrecored->where(array('pay_no' => $order_no))->getField('serv_id');
                            D('servicerecord')->where(array('serv_id' => $pay_serv_id))->setField(array('open_door' => '1'));
                            echo json_encode(2);    //支付成功，并且已通知开门成功
                            exit;
                        } else {
                            $payrecored->where(array('pay_no' => $order_no))->setField(array('pay_status' => '0', 'cp_id' => 0));  //数据回滚未支付状态
                            D('coupon')->where(array('cp_id' => $cp_id))->setField(array('is_valid' => '1'));   //优惠券数据回滚
                            echo json_encode(3);    //支付成功，但是开门失败，有退款(修改优惠券状态)！
                            exit;
                        }

                    }else{
                        //支付状态回滚
                        $payrecored->where(array('pay_no' => $order_no))->setField(array('pay_status' => '0', 'cp_id' => 0));
                    }
                }else{
                    echo json_encode(4);    //优惠券支付失败！
                    exit;
                }
            }
        }

        //为了防止用户多次点击支付但实际未支付，导致本地订单编号与金额不一致进而使微信支付失败的情况，
        //所以在每次用户进行几点支付前将其订单编号临时+10-99随机数
        $order_no=$order_no.rand(11,99);
        //同时记下异常日志
        $fp= fopen('./Common/Log/WeiXin_notice/post_mkaed_wxorder_'.$order_no.'.log', 'a+');
        fwrite($fp, '['.$order_no.']');
        fclose($fp);

        //dump($_SESSION);exit;
        //实例化微信类
        $weixin=new \Org\Weixinpay\Weixinpay( array('order_name'=>$order_name,'order_id'=>$order_no),'', array('openid'=>session('wx_openid')) );

        //读取调试配置信息
        $test_pay = M('config')->where(array('name'=>'test_pay'))->find();

        //获取该停车场子商户
//        $car_sub_mch_id = $this->getSub_mch_id(session('garage_id'));
//        $car_sub_mch_id = $this->getSub_mch_id(session('garage_id'));
        if($test_pay['value'] == 1){
            $test_money = M('config')->where(array('name'=>'test_money'))->find();
            $z=$weixin->mobile_pay_two('/weixin_pay_callback.php', floatval($test_money['value']));
        }else{
            $z=$weixin->mobile_pay_two('/weixin_pay_callback.php', str_replace(',','',$total_fee));   //str_replace(',','',$total_fee)
        }


        if($z['error']==0){
            $wx_ready_pay_arr=array(
                'wx_pay'=>'1',
                'vals'=>$z['weixin_param']
            );
            echo json_encode($wx_ready_pay_arr);
        }else{
            echo json_encode(1);    //支付失败，微信没有任何信息返回
        }

    }

    //获取该停车场的子商户
    public function getSub_mch_id($garage_id) {
        $village_id = M('garage','smart_')->where(array('garage_id'=>$garage_id))->getField('village_id');

        $merchant_info=M('merchant','pigcms_')->where(array('village_id'=>$village_id,'name'=>array('like','%物业%')))->field('mer_id')->find();//对应收银台商户信息 小区
        $mid=M('cashier_merchants','pigcms_')->where(array('thirduserid'=>$merchant_info['mer_id']))->getField('mid');
        $cashier_payconfig_data = M('cashier_payconfig','pigcms_')->where(array('mid'=>$mid))->getField('configData');
        $payconfig_data = unserialize(htmlspecialchars_decode($cashier_payconfig_data));
        $mchid = $payconfig_data['weixin']['mchid'];
        return $mchid;
    }

    //调用支付方法
    public function pay_now(){

        //用户登录操作
        //实例化UserModel
        $user=new \Home\Model\UserModel();
        //如果已经登录过，不再调用
        if(!session('user_id')){
            echo json_encode(11);
            exit;//支付失败，微信没有任何信息返回
        }

        if(!session('garage_id')){
            echo json_encode(12);
            exit;//支付失败，微信没有任何信息返回
        }

        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();

        //设定微信官方订单详情参数
        $garage_name=I('post.garage_name');//停车场名称
        $order_name=$garage_name.I('post.fee_name');  //订单名称
        $order_no=I('post.order_no');    //订单编号
        $car_no=I('post.car_no');  //车牌号
        //$total_fee=str_replace(',','',I('post.total_fee')); //总费用(仅供用户参考，不作为最终的支付数据)
        $cp_id=I('post.cp_id'); //优惠券id
        $now_time_for_log = time();
        //与第三方接口数据作对比

        //无刷新版本把总价放入后台计算，前台不再传递
        $total_fee = M('payrecord')->where(array('pay_no'=>$order_no))->getField('payment');

        $api_order_info=$this->total_order($car_no);
        if($api_order_info['totalFee']!=$total_fee){
            //如果两边金额不一致，以第三方接口为准
            if($api_order_info['totalFee']!=0&&$api_order_info['totalFee']>$total_fee){
                $total_fee=$api_order_info['totalFee'];
            }else if($api_order_info['totalFee']!=0&&$api_order_info['totalFee']<$total_fee){
                $total_fee = $total_fee;
            }else if($api_order_info['totalFee']==0&&$api_order_info['totalFee']<$total_fee){
                //同时记下异常日志
                $fp= fopen('./Common/Log/WeiXin_notice/money_error_'.$order_no.'.log', 'a+');
                fwrite($fp, "本地金额是：".$total_fee."\r\n本地时间为".date("Y-m-d H:i:s",$now_time_for_log)."\r\n第三方金额为".$api_order_info['totalFee']);
                fclose($fp);
                $this->warning_data_add(ACTION_NAME,MODULE_NAME,'1225',$total_fee,'停车场计费异常');
                //$total_fee=0;
            }

            //同时记下异常日志
            $fp= fopen('./Common/Log/WeiXin_notice/num_error_'.$order_no.'.log', 'a+');
            fwrite($fp, $total_fee);
            fclose($fp);
        }

        $old_total_fee=$total_fee;


        //判断是否存在优惠券
        if($cp_id){
            $cp=D('coupon');
            //执行优惠券自动过期功能
            $cp_end_time=$cp->where(array('cp_id'=>$cp_id))->getField('end_time');
            if(time()>=$cp_end_time){
                $cp->where(array('cp_id'=>$cp_id))->setField(array('is_valid'=>'0'));   //设置为过期状态，并且禁止使用此优惠券
            }else {
                $cp_id = (int)$cp_id;
                //校验优惠是否属于该用户或者属于该车牌
                //①：判断是否为用户所持，并且此优惠券未过期
                $cp_host_id = $cp->where(array('cp_id' => $cp_id, 'is_valid' => '1'))->getField('user_id');
                if ($cp_host_id && $cp_host_id == session('user_id')) {
                    //执行优惠券参与最终结算
                    $total_fee = $this->cp_pay($cp_id, $total_fee);
                    $datas['cp_id'] = (int)$cp_id;    //如果使用到优惠券，那么将优惠券信息记录到本次订单记录
                }
                //②：判断是否车辆所持，并且此优惠券未过期
                $cp_car_no = $cp->where(array('cp_id' => $cp_id, 'is_valid' => '1'))->getField('car_no');
                if ($cp_car_no) {
                    if ($cp_car_no && $car_no == $cp_car_no) {
                        //执行优惠券参与最终结算
                        $total_fee = $this->cp_pay($cp_id, $total_fee);
                        $datas['cp_id'] = (int)$cp_id;    //如果使用到优惠券，那么将优惠券信息记录到本次订单记录
                    }
                }
            }
        }

        //同时将第三方数据维护到订单表
        //同时更新点击按钮时间
        $datas=array(
            'payment'=>$old_total_fee,    //应付金额(第三方实时数据，除非用户真正支付后才成为最终数据)
            'api_pay_no'=>$api_order_info['orderNo'],
            'button_time'=>time()//第三方接口订单
        );

        //$payrecored->where(array('pay_no'=>$order_no))->setField($datas);
		$upd_api_orderno=$payrecored->where(array('pay_no'=>$order_no))->setField($datas);
        if(!$upd_api_orderno){
            //更新第三方订单号失败
            echo 1;exit;
        }

        //使用优惠券后，如果金额已经为0或者为负数，
        if($cp_id){
            $payrecored->where(array('pay_no'=>$order_no))->setField(array('cp_id'=>$cp_id));   //将优惠券信息更新到订单记录表
            if($total_fee<=0){
                //①：修改订单状态
                if($payrecored->where(array('pay_no'=>$order_no))->setField(array('pay_status'=>'1','cp_id'=>$cp_id))){
                    //②：修改优惠券状态
                    if(D('coupon')->where(array('cp_id'=>$cp_id))->setField(array('is_valid'=>'2'))) {
                        //维护订单表支付人和支付时间
                        $upd_date=array(
                            'pay_user'=>session('user_id'),
                            'pay_time'=>time()
                        );
                        $payrecored->where(array('pay_no'=>$order_no))->setField($upd_date);

                        //③：通知第三开门
                        $jieshun_api = new \Org\JieShunApi\Jieshun();
                        $serv_id = M('payrecord')->where(array('pay_no'=>$order_no))->getField('serv_id');
                        $garage_id = M('servicerecord')->find($serv_id)['garage_id'];
                        //通知第三方开门接口
                        $notice_jieshun_result = $jieshun_api->notice_api_pay_ok($api_order_info['orderNo'],$garage_id);
                        //记录日志文件，后期可查异常状态追责
                        $fp= fopen('../../Common/Log/WeiXin_notice/wxin_back_hw123123.log', 'a+');
                        fwrite($fp, '[处理结果为'.$notice_jieshun_result['dataItems'][0]['attributes']['retCode'].'返回码为'.$notice_jieshun_result['resultCode'].'报错是'.$notice_jieshun_result['message'].']');
                        fclose($fp);
                        if ($notice_jieshun_result['dataItems'][0]['attributes']['retCode'] == '0') {
                            //④：通知支付成功(本次订单自此时起免费期内自动抬杆)，同时维护本系统停车记录表
                            $pay_serv_id = $payrecored->where(array('pay_no' => $order_no))->getField('serv_id');
                            D('servicerecord')->where(array('serv_id' => $pay_serv_id))->setField(array('open_door' => '1'));
                            echo json_encode(2);    //支付成功，并且已通知开门成功
                            exit;
                        } else {
                            $payrecored->where(array('pay_no' => $order_no))->setField(array('pay_status' => '0', 'cp_id' => 0));  //数据回滚未支付状态
                            D('coupon')->where(array('cp_id' => $cp_id))->setField(array('is_valid' => '1'));   //优惠券数据回滚
                            echo json_encode(3);    //支付成功，但是开门失败，有退款(修改优惠券状态)！
                            exit;
                        }
                        
                    }else{
                        //支付状态回滚
                        $payrecored->where(array('pay_no' => $order_no))->setField(array('pay_status' => '0', 'cp_id' => 0));
                    }
                }else{
                    echo json_encode(4);    //优惠券支付失败！
                    exit;
                }
            }
        }

            //为了防止用户多次点击支付但实际未支付，导致本地订单编号与金额不一致进而使微信支付失败的情况，
            //所以在每次用户进行几点支付前将其订单编号临时+10-99随机数
            $order_no=$order_no.rand(11,99);
        //同时记下异常日志
        $fp= fopen('./Common/Log/WeiXin_notice/post_mkaed_wxorder_'.$order_no.'.log', 'a+');
        fwrite($fp, '['.$order_no.']');
        fclose($fp);

        //dump($_SESSION);exit;
            //实例化微信类
            $weixin=new \Org\Weixinpay\Weixinpay( array('order_name'=>$order_name,'order_id'=>$order_no),'', array('openid'=>session('wx_openid')) );

        //读取调试配置信息
        $test_pay = M('config')->where(array('name'=>'test_pay'))->find();
        if($test_pay['value'] == 1){
            $test_money = M('config')->where(array('name'=>'test_money'))->find();
            $z=$weixin->mobile_pay('/weixin_pay_callback.php', floatval($test_money['value']));
        }else{
            $z=$weixin->mobile_pay('/weixin_pay_callback.php', str_replace(',','',$total_fee));   //str_replace(',','',$total_fee)
        }      

        
        if($z['error']==0){
                $wx_ready_pay_arr=array(
                    'wx_pay'=>'1',
                    'vals'=>$z['weixin_param']
                );
                echo json_encode($wx_ready_pay_arr);
            }else{
                //M('log')->data(array('return'=>$z['msg'],'status'=>time(),'garage_name'=>$garage_name))->add();//保存错误信息
                echo json_encode(1);    //支付失败，微信没有任何信息返回
            }

    }


    //优惠券使用规则
    protected function cp_pay($cp_id,$payment){     //参数1：优惠券id，参数2：未使用优惠券前的应付金额

        //根据优惠券的类型和额度进行对应的换算
        $cp_info=D('coupon')->field('cp_type,cp_hilt')->where('cp_id='.$cp_id)->find();
        //①：如果优惠券类型为现金减免类型，那么直接在原来的基础上进行减运算即可
        if($cp_info['cp_type']==1){
            return number_format(floatval($payment)-$cp_info['cp_hilt'],2);   //返回应付金额(将数据转为浮点型，同时四舍五入保留2位小数)
        }
        //②：如果优惠券券类型为时间减免类型，那么进行时间和现金兑换比例进行计算得出
        elseif($cp_info['cp_type']==2){
            //获取停车场服务收费单价
            $serv_price=D('sysconf')->where('conf_name="car_serv_price"')->getField('conf_value');
            $serv_price=number_format(floatval($serv_price),2);
            return number_format(floatval($payment)-($cp_info['cp_hilt']*$serv_price),2);   //返回应付金额(将数据转为浮点型，同时四舍五入保留2位小数)
        }
        //③：如果优惠券类型为全免类型，那么直接返回应付金额为0.00元
        elseif ($cp_info['cp_type']==3){
            return 0.00;
        }

    }


    //智能查询查询当前用户名下所有车辆所有未缴费的订单
    public function query_my_all_order(){
        //先判断是否已经微信登录
        if(!session('user_id')){
            $user=new \Home\Model\UserModel();
            $user->login();
        }

        if(!session('garage_id')){
            session('garage_id',2); //如果没有手动选择丁车场，那么选择默认的停车场
        }

        //判断当前用户名下是否有绑定车辆
        //①：如果该用户没有绑定任何车辆则直接跳转到绑定页面
        $had_cars=D('car')->where(array('user_id'=>session('user_id')))->getField('car_id');

        if(!$had_cars){
            $error_msg='请先绑定车辆再进行缴费操作！';
            header("Location:".C('WEB_DOMAIN')."/.index.php?m=Home&c=Car&a=use_service&error_msg=$error_msg");
            exit;
        }
        //实例化payModel
        $pay_record=new \Home\Model\PayrecordModel();
        //根据车牌号 查询出当前用户名下的所有未支付的订单编号
        $infos=$pay_record->query_notpay_by_carno(session('user_id'));
        //$order_infos=$order_info_arr[0];
        //查询对应的车牌

        if(count($infos)==1){   //如果只有一条记录，那么直接跳转到对应的订单详情页
            //如果存在订单
            //跳转到详情页面
            header("Location:".C('WEB_DOMAIN')."/index.php?m=Home&c=Payrecord&a=order_detail&pay_id=".$infos[0]['pay_record']."&car_no=".$infos[0]['car_no']);
        }elseif(count($infos)>1){   //如果有2条或者以上，列出供用户进行选择
            $error_msg='请选择您的车辆进行缴费！';
            $this->assign('result_msg',$error_msg);
            $this->assign('car_infos',$infos);
            //调用car模块的use_service模板
            $this->display();
            //header("Location:".C('WEB_DOMAIN')."?m=Home&c=Car&a=use_service&error_msg=$error_msg");
        }else{
            $error_msg='你当前暂无需要支付的订单！';
            header("Location:".C('WEB_DOMAIN')."/loading.php?m=Home&c=Car&a=use_service&error_msg=$error_msg");
        }
    }


    //微信支付成功后的调用的方法(回调)
    public function WeiXin_call_back(){
        //接收订单号
        $order_no=I('post.my_order_no');

        //订单号判断， 2 为普通的进场订单 5 为溢价订单
        $order_type = substr($order_no,0,1);

        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();


        //判断支付状态和第三方通知开门状态
        //①：获取本订单状态
        $pay_result_info=$payrecored->where(array('pay_no'=>$order_no))->find();

        if($order_type == '2'){

            //②：查看通知开门状态
            $serv_opendoor_info=D('servicerecord')->where(array('serv_id'=>$pay_result_info['serv_id']))->find();
            //③：查看点击按钮时间是否是当前计费区域内
            $click_money = $payrecored->make_money_of_car($serv_opendoor_info['start_time'],$pay_result_info['button_time']);
            $pay_money = $payrecored->make_money_of_car($serv_opendoor_info['start_time'],$pay_result_info['pay_time']);
            $more_time = $pay_result_info['pay_time']-$pay_result_info['button_time'];
            if($click_money==$pay_money){
                //还在一个计费时间区域内
                if($pay_result_info['pay_status']=='1' && $serv_opendoor_info['open_door']=='1'){
                    //支付成功，并且第三方开门成功！
                    echo json_encode(array('errormsg'=>2));
                }elseif($pay_result_info['pay_status']=='1' && $serv_opendoor_info['open_door']=='0'){
                    //支付成功，但是开门失败！【作退款处理，微信进行退款处理】
                    echo json_encode(array('errormsg'=>3));
                }elseif($pay_result_info['pay_status']=='0'){
                    //支付失败！
                    echo json_encode(array('errormsg'=>4));
                }else{
                    //支付回调失败
                    echo json_encode(array('errormsg'=>4));
                }
            }else{
                //时间区域已经改变要重新多付钱
                //还需要多交钱
                $pay_fees = $pay_money-$click_money;
                echo json_encode(array('errormsg'=>5,'car_no'=>$serv_opendoor_info['car_no'],'more_time'=>$more_time,'pay_fees'=>$pay_fees));
            }
        }elseif($order_type == '5'){
            if($pay_result_info['pay_status']=='1'){
                //支付成功，并且第三方开门成功！
                echo json_encode(array('errormsg'=>2));
            }else{
                //支付失败！
                echo json_encode(array('errormsg'=>4));
            }

        }

    }


    //查看订单状态
    public function query_order_sataus(){
        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();

        //接收订单编号
        $order_no=I('get.order_no');


        //先进行第三方登录
        $token=$payrecored->use_api_login();
        if($token){
            $notice_result_info=$payrecored->query_order_status($token,$order_no);
            dump($notice_result_info);
        }else{
            //登录失败
            $this->error('网络异常，请稍候重试！',U('try_open_door_agin'),1);
        }
    }


    /*
     * 查看缴费记录
     * 陈琦
     * 2017.4.14
     */

    public function record(){
        $pay=new \Home\Model\PayrecordModel();
        $date1 = time()-7*24*3600;//7天前
        $date2=time()-30*24*3600;//30天前
        $date3=time()-3*30*24*3600;//90天前
        if(IS_AJAX){
            if(isset($_POST['sevenday0'])){//进入缴费记录默认页面时请求的ajax
                $arr=$pay->query_time_money($date1);
                echo json_encode(array('error'=>0,'msg'=>$arr['list'],'count'=>$arr['page_count']));
            }
            if(isset($_POST['sevenday'])){//点击7天请求ajax
                $arr=$pay->query_time_money($date1);
                echo json_encode(array('error'=>0,'msg'=>$arr['list'],'count'=>$arr['page_count']));
            }
            if(isset($_POST['onemonth'])){//点击30天请求ajax
                $arr=$pay->query_time_money($date2);
                echo json_encode(array('error'=>0,'msg'=>$arr['list'],'count'=>$arr['page_count']));
            }
            if(isset($_POST['threemonth'])){//点击90天请求ajax
                $arr=$pay->query_time_money($date3);
                echo json_encode(array('error'=>0,'msg'=>$arr['list'],'count'=>$arr['page_count']));
            }
        }else{
            $result1=$pay->query_time_money($date1);//7天数据结果集
            $sevenday_res=$result1['time_money'];//金额
            $s_count=$result1['page_count'];//页数

            $result2=$pay->query_time_money($date2);//7天数据结果集
            $onemonth_res=$result2['time_money'];//金额
            $o_count=$result2['page_count'];//页数

            $result3=$pay->query_time_money($date3);//7天数据结果集
            $threemonth_res=$result3['time_money'];//金额
            $t_count=$result3['page_count'];//页数

            $this->assign('sevenday_res',$sevenday_res);
            $this->assign('onemonth_res',$onemonth_res);
            $this->assign('threemonth_res',$threemonth_res);
            $this->assign('s_count',$s_count);
            $this->assign('o_count',$o_count);
            $this->assign('t_count',$t_count);
            $this->display();
        }
    }



    public function problem(){
        $this->display();
    }

    public function problem_test(){
        /*$payrecored=new \Home\Model\PayrecordModel();
        dump($payrecored->check_and_show('鄂-APQ929'));*/
        /*$_SESSION['garage_no']='p180994882';
        $car_no=$this->jieshu_plate($_GET['car']);
        //$server=new \Home\Controller\ServicerecordController();
        $jieshun=new \Org\JieShunApi\Jieshun();
        $z=json_decode($jieshun->use_api_is_in($car_no),true);
        dump($z);*/
        /*$_SESSION['user_id']='33';
        $unifiedOrder = new \Org\Weixinpay\UnifiedOrder_pub($this->config['pay_weixin_appid'],$this->config['pay_weixin_mchid'],$this->config['pay_weixin_key'],$this->config['pay_weixin_appsecret']);
        dump($unifiedOrder->getSub_mch_id());*/
        dump(U('Payrecord/order_detail',array('pay_state'=>1,'pay_fees'=>$pay_fees,'car_no'=>$pay_info['car_no'],'more_time'=>$check_time)));
        die;
    }
    public function jieshu_plate($car_no_array){
        $user_view_car_no=str_replace('-','',$car_no_array);
        $car_no_pre=mb_substr($user_view_car_no,0,1,'utf-8');
        $car_no_after=mb_substr($user_view_car_no,1,6,'utf-8');
        $user_view_car_no=$car_no_pre.'-'.$car_no_after;
        $user_view_car_no=strtoupper($user_view_car_no);
        return $user_view_car_no;
    }

    public function refresh_money(){
        //刷新当前钱数返回给前台
        $order_no = I('post.order_no');
        $payrecored=new \Home\Model\PayrecordModel();
        $pay_info_re= $payrecored->where(array('pay_no'=>$order_no))->find();
        $pay_info = M('servicerecord')->where(array('serv_id'=>$pay_info_re['serv_id']))->find();
        $payment=$payrecored->make_fee_by_time_rule($pay_info['start_time']); //通过计算规则算出应付金额
        $payment=number_format(floatval($payment),2);
        //同时维护订单的金额表(当支付订单已经完成的时候不再能维护本地字段)
        if($pay_info_re['pay_status']=='0'){
            $payrecored->flash_cash($pay_info_re['pay_id'],$payment);
        }
        echo $payment;
    }

    /*
	 * 封装方法，处理警报流程一，入表
	 * 警报反馈机制
	 * */
    protected function warning_data_add($action,$control,$encode,$result,$warning_name){
        //根据act和con来获得系统名称
        $system_array = M()->table('pigcms_system_control')->where(array('system_act'=>$action,'system_con'=>$control))->find();
        $data = array(
            'system_id'=>$system_array['pigcms_id'],
            'warning_encoding'=>$encode,
            'warning_result'=>$result,
            'warning_name'=>$warning_name
        );
        $result_code = M()->table('pigcms_system_warning_control')->data($data)->add();
        $admin_user = explode(",",$system_array['user_wx_opid']);
        $warn_info = array(
            'first_value'=>$system_array['system_name'].'发生错误！！！',
            'keyword1_value'=>$warning_name,
            'keyword2_value'=>'用户将无法使用该系统的功能',
            'remark_value'=>'请开发者和错误处理人员尽快查看出错位置以便解决！'
        );
        if($result_code){
            //发送消息
            $res =array();
            foreach ($admin_user as $value){//
                $time = time();
                $data=array(
                    'touser'=>$value,
                    'template_id'=>"31Q6rbAa0NQdVuFMH6oyYwdSdOEwQ7aYQuM1d5fXQEk",
                    'data'=>array(
                        'first'=>array(
                            'value'=>urlencode($warn_info['first_value']),
                            'color'=>"#029700",
                        ),
                        'keyword1'=>array(
                            'value'=>urlencode($warn_info['keyword1_value']),
                            'color'=>"#000000",
                        ),
                        'keyword2'=>array(
                            'value'=>urlencode($warn_info['keyword2_value']),
                            'color'=>"#000000",
                        ),
                        'keyword3'=>array(
                            'value'=>urlencode(date('Y-m-d H:i:s',$time)),
                            'color'=>"#000000",
                        ),
                        'remark'=>array(
                            'value'=>urlencode($warn_info['remark_value']),
                            'color'=>"#000000",
                        ),
                    )
                );
                $weixin=new \Org\Weixinpay\Weixinpay();
                $res[] = $weixin->send_template_message(urldecode(json_encode($data)));
            }
            if($res[0]['errmsg']=='ok'){
                return true;
            }else{
                return false;
            }
        }else{
            //入库失败
            return false;
        }
    }



}