<?php

namespace Org\Weixinpay;
use Org\Weixinpay\Wxpay_client_pub;
use Org\Weixinpay\WxPayConf_pub;
/**

 * 订单查询接口

 */

class OrderQuery_pub extends Wxpay_client_pub

{

    function __construct($appid,$mchid,$key,$appsecret)

    {

        Common_util_pub::__construct($appid,$mchid,$key,$appsecret);

        //设置接口链接

        $this->url = "https://api.mch.weixin.qq.com/pay/orderquery";

        //设置curl超时时间

        $this->curl_timeout = 60;

    }



    /**

     * 生成接口参数xml

     */

    function createXml()

    {

        try

        {

            //检测必填参数

            if($this->parameters["out_trade_no"] == null &&

                $this->parameters["transaction_id"] == null)

            {

                throw new SDKRuntimeException("订单查询接口中，out_trade_no、transaction_id至少填一个！"."<br>");

            }

            $this->parameters["appid"] = $this->appid;//公众账号ID

            $this->parameters["mch_id"] = $this->mchid;//商户号

            $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串

            $this->parameters["sign"] = $this->getSign($this->parameters);//签名

            return  $this->arrayToXml($this->parameters);

        }catch (SDKRuntimeException $e)

        {

            die($e->errorMessage());

        }

    }



}


