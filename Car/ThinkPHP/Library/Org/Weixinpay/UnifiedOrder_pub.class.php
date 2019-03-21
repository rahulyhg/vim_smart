<?php

namespace Org\Weixinpay;
use Org\Weixinpay\Wxpay_client_pub;
use Org\Weixinpay\WxPayConf_pub;
use Org\Weixinpay\SDKRuntimeException;
/**

 * 统一支付接口类

 */

class UnifiedOrder_pub extends Wxpay_client_pub

{

    function __construct($appid,$mchid,$key,$appsecret)

    {

        Common_util_pub::__construct($appid,$mchid,$key,$appsecret);

        //设置接口链接

        $this->url = "https://api.mch.weixin.qq.com/pay/unifiedorder";

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

            if($this->parameters["out_trade_no"] == null)

            {
                
                throw new SDKRuntimeException("缺少统一支付接口必填参数out_trade_no！"."<br>");

            }elseif($this->parameters["body"] == null){

                throw new SDKRuntimeException("缺少统一支付接口必填参数body！"."<br>");

            }elseif ($this->parameters["total_fee"] == null ) {

                throw new SDKRuntimeException("缺少统一支付接口必填参数total_fee！"."<br>");

            }elseif ($this->parameters["notify_url"] == null) {

                throw new SDKRuntimeException("缺少统一支付接口必填参数notify_url！"."<br>");

            }elseif ($this->parameters["trade_type"] == null) {

                throw new SDKRuntimeException("缺少统一支付接口必填参数trade_type！"."<br>");

            }elseif ($this->parameters["trade_type"] == "JSAPI" &&

                $this->parameters["openid"] == NULL){

                throw new SDKRuntimeException("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！"."<br>");

            }

            $this->parameters["appid"] = $this->appid;//公众账号ID

            $this->parameters["mch_id"] = $this->mchid;//商户号
//            $this->parameters["sub_mch_id"] = "1489131162";//子商户号  目前为大头仔

            $this->parameters["sub_mch_id"] = $this->getSub_mch_id();

            $this->parameters["spbill_create_ip"] = get_client_ip();//终端ip

            $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串

            $this->parameters["sign"] = $this->getSign($this->parameters);//签名

            return  $this->arrayToXml($this->parameters);

        }catch (SDKRuntimeException $e)

        {

            return array('return_code'=>'FAIL','return_msg'=>$e->errorMessage());

        }

    }



    /**

     * 获取prepay_id

     */

    function getPrepayId()

    {

        $this->postXml();

        $this->result = $this->xmlToArray($this->response);

        return $this->result;

    }



    //获取该停车场的子商户
    public function getSub_mch_id() {
        $user=new \Home\Model\UserModel();
        $user_id = session('user_id');
        $garage_id = D('user','smart_')->where(array('user_id'=>$user_id))->getField('spare_garage_id');
        $village_id = M('garage','smart_')->where(array('garage_id'=>$garage_id))->getField('village_id');

        $merchant_info=M('merchant','pigcms_')->where(array('village_id'=>$village_id,'name'=>array('like','%物业%')))->field('mer_id')->find();//对应收银台商户信息 小区
        $mid=M('cashier_merchants','pigcms_')->where(array('thirduserid'=>$merchant_info['mer_id']))->getField('mid');
        $cashier_payconfig_data = M('cashier_payconfig','pigcms_')->where(array('mid'=>$mid))->getField('configData');
        $payconfig_data = unserialize(htmlspecialchars_decode($cashier_payconfig_data));
        $mchid = $payconfig_data['weixin']['mchid'];
        return $mchid;
    }

}
