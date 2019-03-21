<?php
namespace Org\Weixinpay;
use Org\Weixinpay\Wxpay_server_pub;
/**

 * 通用通知接口

 */

class Notify_pub extends Wxpay_server_pub

{

    function __construct($appid,$mchid,$key,$appsecret)

    {

        Common_util_pub::__construct($appid,$mchid,$key,$appsecret);

    }

}