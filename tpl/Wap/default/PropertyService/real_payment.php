<!DOCTYPE html>

<html lang="zh-CN">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <meta name="format-detection" content="telephone=no" />

    <title>微信支付</title>

    <link href="{pigcms{$static_path}css/weixin_pay.css" rel="stylesheet"/>

</head>

<body style="padding-top:20px;">

<div id="payDom" class="cardexplain">

    <ul class="round">

        <li class="title mb"><span class="none">支付信息</span></li>

        <li class="nob">

            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">

                <tr><th>金额</th><td>{pigcms{$pay_money}元</td></tr>
            </table>

        </li>

    </ul>

    <div class="footReturn" style="text-align:center">

        <input type="button" style="margin:0 auto 20px auto;width:100%"   id="pay" class="submit" value="点击进行微信支付" />

    </div>

</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script>
    var param = JSON.parse({pigcms{:json_encode($weixin_param)});
    var village_id = "{pigcms{$village_id}";
    console.log(param);
    $('#pay').click(function(){
        callpay();
    });

    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }

    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            "getBrandWCPayRequest",
            param,
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    window.location.href = "{pigcms{:U('pay_index')}"+"&village_id="+village_id;
                }else{

                }
        });

    }

</script>

</body>

</html>