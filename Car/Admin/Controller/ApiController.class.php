<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Common\RbacController;
//第三方请求本系统服务响应类
class ApiController extends RbacController{

    protected $sys_ip;
    protected $htp_token;

    //初始化系统校验配置
    public function __construct(){

        if($_SERVER['REMOTE_ADDR']!='121.40.74.90'){
            //$fp= fopen('./weixin_pay_ok_notice.log', 'a+');
            //fwrite($fp,'ip地址不合法，拒绝回调访问');
            echo 'ip地址不合法';
            exit;
        }

        parent::__construct();//自己定义了构造方法后，必须要先执行父类构造方法，否则可能会造成功能丢失甚至报错
    }

    //校验第三方请求是否合法
    public function check_legal(){

        //校验ip和系统通信token是否合法

        //接收参数
        //①：所属活动(智能判断第三方请求参数传递方式)
        if(I('get.act_id')){
            $act_id=(int)I('get.act_id');   //整型转化
        }elseif(I('post.act_id')){
            $act_id=(int)I('post.act_id');   //整型转化
        }

        if(!$act_id){
            echo 1; //缺少对应活动id参数
            return array('imsg_no'=>1,'imessage_content'=>'缺少对应活动id参数');
        }
        //②：活动发起者（一般为商户）
        if(I('get.shop_id')){
            $shop_id=(int)I('get.shop_id');   //整型转化
        }elseif(I('post.shop_id')){
            $shop_id=(int)I('post.shop_id');   //整型转化
        }

        if(!$shop_id){
            echo 2; //缺少对应发行者id参数
            return array('imsg_no'=>2,'imessage_content'=>'缺少对应发行者id参数 ');
        }
        //③：指定车辆或者用户名
        if(I('get.user_name')){
            $user_name=I('get.user_name');
        }elseif(I('post.user_name')){
            $user_name=I('post.user_name');
        }else{
            $user_name=null;
        }

        if(I('get.car_no')){
            $car_no=I('get.car_no');
        }elseif(I('post.car_no')){
            $car_no=I('post.car_no');
        }else{
            $car_no=null;
        }

        if(!$user_name && !$car_no){
            echo 3;
            return array('imsg_no'=>3,'imessage_content'=>'没有指定车辆或者用户');
        }

        //④:优惠口令(根据商户发起活动情况)
        if(I('get.cp_token')){
            $cp_token=I('get.cp_token');
        }elseif(I('post.cp_token')){
            $cp_token=I('post.cp_token');
        }else{
            $cp_token=null;
        }


        //执行优惠券生成
        //实例化cpController
        $cp=new \Admin\Controller\CouponController();
        $ad_cp_result = $cp->cp_add($act_id, $shop_id, $user_name, $car_no, $cp_token);



        if($ad_cp_result===4){
            echo 4;
            return array('imsg_no'=>4,'imessage_content'=>'当前没有可创建优惠请的活动或者活动与商户不匹配');
        }elseif($ad_cp_result===5){
            echo 5;
            return array('imsg_no'=>5,'imessage_content'=>'你输入的用户不存在，无法发放优惠券');
        }elseif($ad_cp_result===6){
            echo 6;
            return array('imsg_no'=>6,'imessage_content'=>'优惠口令输入错误');
        }elseif($ad_cp_result===7){
            echo 7;
            return array('imsg_no'=>7,'imessage_content'=>'该商户已被取消优惠活动创建资格');
        }elseif($ad_cp_result===8){
            echo 8;
            return array('imsg_no'=>8,'imessage_content'=>'优惠券打印成功');
        }elseif($ad_cp_result===9){
            echo 9;
            return array('imsg_no'=>9,'imessage_content'=>'参数正确但优惠券打印失败');
        }elseif($ad_cp_result===10){
            echo 10;
            return array('imsg_no'=>10,'imessage_content'=>'已经领取过优惠券了');
        }elseif($ad_cp_result===11){
            echo 11;
            return array('imsg_no'=>11,'imessage_content'=>'活动已经结束');
        }elseif($ad_cp_result===12){
            echo 12;
            return array('imsg_no'=>12,'imessage_content'=>'优惠名额已经使用完');
        }


    }


    //本系统调用的方法
    public function system_self_get_cp($act_id, $shop_id, $user_name, $car_no, $cp_token){
        $cp=new \Admin\Controller\CouponController();
        $cp->cp_add($act_id, $shop_id, $user_name, $car_no, $cp_token);
    }


    //测试接口方法
    public function test_api(){

        dump(file_get_contents('http://car.vhi99.com/?m=Admin&c=Api&a=check_legal&act_id=1&shop_id=76&car_no=鄂-A0AA06&cp_token=时间车牌领取'));

        //car.vhi99.com/?m=Admin&c=Api&a=check_legal&act_id=1&shop_id=76&car_no=鄂-APS693

        //$cp=new \Admin\Controller\CouponController();
        //$ad_cp_result = $cp->cp_add(1, 76, '小王', '', '');
        //dump($ad_cp_result);
    }

}




















