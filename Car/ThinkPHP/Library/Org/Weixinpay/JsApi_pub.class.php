<?php

namespace Org\Weixinpay;
use Org\Weixinpay\Common_util_pub;
use Org\Weixinpay\WxPayConf_pub;
/**

 * JSAPI支付——H5网页端调起支付接口

 */

class JsApi_pub extends Common_util_pub

{

    var $code;//code码，用以获取openid

    var $openid;//用户的openid

    var $parameters;//jsapi参数，格式为json

    var $prepay_id;//使用统一支付接口得到的预支付id

    var $curl_timeout;//curl超时时间



    function __construct($appid,$mchid,$key,$appsecret)

    {

        Common_util_pub::__construct($appid,$mchid,$key,$appsecret);

        //设置curl超时时间

        $this->curl_timeout = 60;

    }



    /**

     * 	作用：生成可以获得code的url

     */

    function createOauthUrlForCode($redirectUrl,$state)

    {

        $urlObj["appid"] = $this->appid;

        $urlObj["redirect_uri"] = "$redirectUrl";

        $urlObj["response_type"] = "code";

        $urlObj["scope"] = "snsapi_base";

        //$urlObj["state"] = "STATE"."#wechat_redirect";
        $urlObj["state"] = $state."#wechat_redirect";
        $bizString = $this->formatBizQueryParaMap($urlObj, false);

        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;

    }



    /**

     * 	作用：生成可以获得openid的url

     */

    function createOauthUrlForOpenid()

    {

        $urlObj["appid"] = $this->appid;

        $urlObj["secret"] = $this->mchid;

        $urlObj["code"] = $this->code;

        $urlObj["grant_type"] = "authorization_code";

        $bizString = $this->formatBizQueryParaMap($urlObj, false);

        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;

    }





    /**

     * 	作用：通过curl向微信提交code，以获取openid

     */

    function getOpenid()

    {

        $url = $this->createOauthUrlForOpenid();

        //初始化curl

        $ch = curl_init();

        //设置超时

        curl_setopt($ch, CURLOP_TIMEOUT, $this->curl_timeout);

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);

        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);

        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //运行curl，结果以jason形式返回

        $res = curl_exec($ch);

        curl_close($ch);

        //取出openid

        $data = json_decode($res,true);

        $this->openid = $data['openid'];

        return $this->openid;

    }



    /**

     * 	作用：设置prepay_id

     */

    function setPrepayId($prepayId)

    {

        $this->prepay_id = $prepayId;

    }



    /**

     * 	作用：生成app签名

     */

    function getPrepayAppSign($prepay_result)

    {

        $sign_array = array();

        $sign_array['appId'] = $prepay_result['appId'];

        $sign_array['partnerId'] = $prepay_result['partnerId'];

        $sign_array['prepayId'] = $prepay_result['prepayId'];

        $sign_array['nonceStr'] = $prepay_result['nonceStr'];

        $sign_array['timeStamp'] = $prepay_result['timeStamp'];

        $sign_array['package'] = "Sign=".$prepay_result['package'];

        return $this->getSign($prepay_result);

    }



    /**

     * 	作用：设置code

     */

    function setCode($code_)

    {

        $this->code = $code_;

    }



    /**

     * 	作用：设置jsapi的参数

     */

    public function getParameters()

    {

        $jsApiObj["appId"] = $this->appid;

        $timeStamp = time();

        $jsApiObj["timeStamp"] = "$timeStamp";

        $jsApiObj["nonceStr"] = $this->createNoncestr();

        $jsApiObj["package"] = "prepay_id=$this->prepay_id";

        $jsApiObj["signType"] = "MD5";

        $jsApiObj["paySign"] = $this->getSign($jsApiObj);

        $this->parameters = json_encode($jsApiObj);



        return $this->parameters;

    }

}
