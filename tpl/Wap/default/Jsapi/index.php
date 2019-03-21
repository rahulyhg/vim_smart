<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>微信支付样例-支付</title>
</head>
<body>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
<div align="center">
    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
</div>
<script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall()
    {
        var jsApiParameters = JSON.parse({pigcms{:json_encode($jsApiParameters)});
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            jsApiParameters,
            function(res){
                WeixinJSBridge.log(res.err_msg);
                //写自己的程序
            }
        );
    }

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
</script>
</body>
</html>