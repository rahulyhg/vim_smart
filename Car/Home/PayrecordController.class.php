<?php
namespace Home\Controller;
use Think\Controller;

class PayrecordController extends Controller {
    
    //查询当前用户下所有车牌的停车服务记录
    //获取当前用户的session   id
    public function get_user_all_recored( ){
        
        $user_id=I('get.user_id');
        
        //通过联表查询出对应的停车服务记录
        $recoreds = D('payrecord')->alias('p')->join('__USER__ r on r.user_id=p.user_id')->where(array('user_id'=>$user_id))->select();

        dump($recoreds);


        //将数据返回模板
        $this->assign('recoreds',$recoreds);

        //调用模板
        $this->display();
    }
    
    
    //查看计费规则
    public function query_fee_rule(){
        
        //实例化它的model
        $pay=new \Home\Model\PayrecordModel();
        
        //先进行第三方登录
        $token=$pay->use_api_login();
        if($token){
            $api_p = '{
                "serviceId":"3c.park.queryparkstandard",
                "requestType":"DATA",
                "attributes":{
                    "parkCode": "0000002265"
                }
            }';
        
            $sn= strtoupper( md5($api_p) ); //对p进行加密后，将加密的字段进行大写转换

            $url="http://preapi.jslife.net/jsaims/as";

            $post_data = "cid=880002701002185&v=2&tn={$token}&sn={$sn}&p={$api_p}";
            $order_info = $pay->use_curl($url, $post_data);

            dump( json_decode($order_info,true) );
        }else{
            //登录失败
            $this->error('网络异常，请稍候重试！',U('try_open_door_agin'),1);
        }
        
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
        $pay=new \Home\Model\PayrecordModel();
        
        //接收对应的订单编号活动订单id
        $pay_id=I('get.pay_id');
        $pay_no=I('get.pay_no');
        $car_no=I('get.car_no');
        
        //查询对应的订单
        if($pay_id){
            $pay_info=$pay->query_order_detail_by_id($pay_id);
        }elseif($pay_no){
            $pay_info=$pay->query_order_detail_by_no($pay_no);
        }
        
        $car_no= urldecode($car_no);
        
        $pay_info['car_no']=$car_no;
        
        $payment=$pay->make_fee_by_time_rule($pay_info['start_time']); //通过计算规则算出应付金额
        //判断用户为PASTIME时，修改支付金额
        //if($pay_info['pay_user'] == '325') {
          //  $pay_info['payment'] = '0.05';
        //}else {
            $pay_info['payment']=$payment;
        //}

        
        //将数据返回模板
        $this->assign('pay_info',$pay_info);
        
        //调用模板
        $this->display();
        
        
    }
    
    //最终结算(调用第三方接口数据完善完整订单)
    public function total_order($car_no){
        
        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();
        
        //先进行第三方登录
        $token=$payrecored->use_api_login();
        if($token){
            $api_order_info=$payrecored->api_make_order($token, $car_no);
            dump($api_order_info);
        }else{
            //登录失败
            $this->error('网络异常，请稍候重试！',U('try_open_door_agin'),1);
        }
        
    }
    
    
    
    //调用支付方法
    public function pay_now(){
        
        //实例化payrecoredModel
        $payrecored=new \Home\Model\PayrecordModel();
        
        //测试方法
        $order_name=I('get.fee_name');  //订单名称
        $order_no=I('get.order_no');    //订单编号
        $total_fee=I('get.total_fee');  //总应付金额
        
        //临时设置的配置
        //session('wx_openid','oa5Cas4dVgZLSh-7J5D3CtmKbPVA');
        
        //实例化微信类
        $weixin=new \Org\Weixinpay\Weixinpay( array('order_name'=>$order_name,'order_id'=>$order_no),'', array('openid'=>session('wx_openid')) );
        //进行微信登录
        //$weixin->authorize_openid('http://car.vhi99.com');
        
        //用户进行微信登录，获取用户的相关信息
        //$login_result=$weixin->authorize_openid('http://car.vhi99.com/');
        //$user_openid=$login_result['openid'];
        
        /*
         * 
         array(2) {
            ["error"] => string(1) "0"
            ["weixin_param"] => string(222) "{"appId":"wx25839630a6d7dadb","timeStamp":"1479978600","nonceStr":"v9utkxwfyban6tl00hw4qizq9zoydseo","package":"prepay_id=wx2016112417100035a8e21bd10655511436","signType":"MD5","paySign":"AE7ACED0DBE7CEC8BE037085F658F565"}"
          }
         * 
         */
        
        //进行微信支付操作
        $z=$weixin->mobile_pay('http://car.vhi99.com', $total_fee);
        if($z['error']==0){
            //将json字串转换为json对象
            //$z['weixin_param']= json_decode($z['weixin_param'],true);
            echo json_encode($z['weixin_param']);
        }else{
            echo json_encode(false);
        }
        
        exit;
        
        
        
        //先进行第三方api登录
        $token=$payrecored->use_api_login();
        if($token){
            dump($order_no);
            $notice_result_info=$payrecored->notice_api_pay_ok($token,$order_no);
            dump($notice_result_info);
        }else{
            //登录失败
            $this->error('网络异常，请稍候重试！',U('try_open_door_agin'),1);
        }
    }
    
    
    //微信支付成功后的调用的方法(回调)
    public function WeiXin_call_back(){
        //更新数据库，回应微信通知成功，
    }
    
    
    
    public function weixin_pay_page(){
        dump($_GET);
        
        //将数据返回给模板
        $this->assign('datas',$_GET);
        
        $this->display();
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
    
    
    
}