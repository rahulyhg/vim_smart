<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>物业缴费</title>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <!-- body 最后 -->
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

    <!-- 如果使用了某些拓展插件还需要额外的JS -->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
</head>
<body>
<div class="weui-form-preview">
    <form action="{pigcms{:U('PropertyService/real_payment')}" enctype="multipart/form-data" method="post">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">付款金额</label>
            <em class="weui-form-preview__value">{pigcms{$orderArr.payable}</em>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">缴费类型</label>
                <span class="weui-form-preview__value">{pigcms{$orderArr.order_name}</span>
            </div>

        </div>
        <div class="weui-form-preview__ft">
            <input type="hidden" name="order_id" value="{pigcms{$orderArr.order_id}" >
            <input type="hidden" name="village_id" value="{pigcms{$village_id}" >
            <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" id="pay" href="javascript:">确认支付</button>
        </div>
    </form>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script>
    var param = JSON.parse({pigcms{:json_encode($parameters)});
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
                    alert('哈哈哈');
                }
            });

    }

</script>
</body>
</html>