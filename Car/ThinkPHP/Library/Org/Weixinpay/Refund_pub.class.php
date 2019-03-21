<?php

namespace Org\Weixinpay;
use Org\Weixinpay\Wxpay_client_pub;
use Org\Weixinpay\WxPayConf_pub;
/**

 * 退款申请接口

 */

class Refund_pub extends Wxpay_client_pub

{

    function __construct($appid,$mchid,$key,$appsecret)

    {

        //设置接口链接

        $this->url = "https://api.mch.weixin.qq.com/secapi/pay/refund";

        //设置curl超时时间

        $this->curl_timeout = 60;

        Common_util_pub::__construct($appid,$mchid,$key,$appsecret);

    }



    /**

     * 生成接口参数xml

     */

    function createXml()

    {

        try

        {

            //检测必填参数

            if($this->parameters["out_trade_no"] == null && $this->parameters["transaction_id"] == null) {

                throw new SDKRuntimeException("退款申请接口中，out_trade_no、transaction_id至少填一个！"."<br>");

            }elseif($this->parameters["out_refund_no"] == null){

                throw new SDKRuntimeException("退款申请接口中，缺少必填参数out_refund_no！"."<br>");

            }elseif($this->parameters["total_fee"] == null){

                throw new SDKRuntimeException("退款申请接口中，缺少必填参数total_fee！"."<br>");

            }elseif($this->parameters["refund_fee"] == null){

                throw new SDKRuntimeException("退款申请接口中，缺少必填参数refund_fee！"."<br>");

            }elseif($this->parameters["op_user_id"] == null){

                throw new SDKRuntimeException("退款申请接口中，缺少必填参数op_user_id！"."<br>");

            }

            $this->parameters["appid"] = $this->appid;//公众账号ID

            $this->parameters["mch_id"] = $this->mchid;//商户号
            $this->parameters["sub_mch_id"] = "1420889002";//子商户号

            $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串

            $this->parameters["sign"] = $this->getSign($this->parameters);//签名

            return  $this->arrayToXml($this->parameters);

        }catch (SDKRuntimeException $e)

        {

            die($e->errorMessage());

        }

    }

    /**

     * 	作用：获取结果，使用证书通信

     */

    function getResult()

    {

        $this->postXmlSSL();

        $this->result = $this->xmlToArray($this->response);

        return $this->result;

    }



}

