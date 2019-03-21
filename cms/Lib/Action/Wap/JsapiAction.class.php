<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/5
 * Time: 10:10
 */
import("@.ORG.wxTest.WxPayApi");
import("@.ORG.wxTest.JsApiPay");
import("@.ORG.wxTest.Log");
import("@.ORG.wxTest.CLogFileHandler");
import("@.ORG.wxTest.WxPayUnifiedOrder");
class JsapiAction extends BaseAction{
    function index() {
        //①、获取用户openid
        $tools = new JsApiPay();
//        $openId = $tools->GetOpenid();
        $openId = session('openid');
        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");//商品描述
        $input->SetAttach("test");//附加数据
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));//订单号
        $input->SetTotal_fee("1");//订单总金额
        $input->SetTime_start(date("YmdHis"));//订单生成时间
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");//通知地址（回调需要）
        $input->SetTrade_type("JSAPI");//交易类型
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        $order_str = $this->printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $editAddress = $tools->GetEditAddressParameters();//获取共享地址
//        dump($jsApiParameters);
//        exit;
        $this->assign('order_str',$order_str);
        $this->assign('jsApiParameters',$jsApiParameters);
        $this->assign('editAddress',$editAddress);
        $this->display();
    }

    //打印输出数组信息
    function printf_info($data)
    {
        foreach($data as $key=>$value){
            return "<font color='#00ff55;'>$key</font> : $value <br/>";
        }
    }















}