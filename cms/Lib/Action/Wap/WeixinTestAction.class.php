<?php
/*
 *
 */
import("@.ORG.weixinTest.WxPayApi");
import("@.ORG.weixinTest.WxPayData");
import("@.ORG.weixinTest.JsApiPay");
class WeixinTestAction extends BaseAction{

    public function index() {
        $order_info = array(
            'order_name'=>'测试',
        );
        $order_no = time().mt_rand(100000,999999);
        $pay_money = 0.01;
        $notify_url = "http://paysdk.weixin.qq.com/example/notify.php";
        $sub_mch_id = 1489131162;
        $res = $this->unified_order_data($order_info,$order_no,$pay_money,$notify_url,$sub_mch_id);
//        dump($res);exit;
        //获取jsapi支付的参数
        if ($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS') {
            $parameters = $this->get_jsapi_result($res);
            $this->assign('parameters',$parameters);
            $this->display();
        } else {
            $this->error('获取失败');
        }

    }

    //②、统一下单
    public function unified_order_data($order_info,$out_trade_no,$total_fee,$notify_url,$sub_mch_id) {
        $input = new WxPayUnifiedOrder();
        $input->SetBody($order_info['order_name']);//订单名称
        $input->SetOut_trade_no($out_trade_no);//订单号
        $input->SetTotal_fee($total_fee*100);//订单金额
        $input->SetNotify_url($notify_url);//回调函数
        $input->SetOpenid($this->getOpenid());//$openid
        $input->SetTrade_type("JSAPI");//交易方式
        $input->SetSub_mch_id($sub_mch_id);//子商户号
        if ($order_info['attach']) $input->SetAttach($order_info['attach']);
        if ($order_info['time_start']) $input->SetTime_start($order_info['time_start']);
        if ($order_info['time_expire']) $input->SetTime_expire($order_info['time_expire']);
        if ($order_info['goods_tag']) $input->SetGoods_tag($order_info['goods_tag']);
        $res = WxPayApi::unifiedOrder($input);
        return $res;
    }

    /**
     *
     * 获取jsapi支付的参数
     * @param array $UnifiedOrderResult 统一支付接口返回的数据
     * @throws WxPayException
     *
     * @return json数据，可直接填入js函数作为参数
     */
    public function get_jsapi_result($res) {
        $tools = new JsApiPay();
        $parameters = $tools->GetJsApiParameters($res);
        return $parameters;
    }

    //①、获取用户openid
    public function getOpenid() {
        $openId = $_SESSION['openid'];
        return $openId;
    }


    /**
     *
     * 支付结果通用通知
     * @param function $callback
     * 直接回调函数使用方法: notify(you_function);
     * 回调类成员函数方法:notify(array($this, you_function));
     * $callback  原型为：function function_name($data){}
     */
    public function return_notify_url() {
        $wxPay = new WxPayApi();

    }
















}