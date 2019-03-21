<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>停车缴费</title>
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
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">支付成功提醒详情</label>
        <em class="weui-form-preview__value">&nbsp;&nbsp;&nbsp;&nbsp;</em>
    </div>
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">用户头像</label>
            <img class="weui-vcode-img" src="{pigcms{$servArr.user_headerimg}">
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">用户名</label>
            <span class="weui-form-preview__value">{pigcms{$servArr.user_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">车牌号</label>
            <span class="weui-form-preview__value">{pigcms{$servArr.car_no}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">停车场</label>
            <span class="weui-form-preview__value">{pigcms{$servArr.garage_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">驶入时间</label>
            <span class="weui-form-preview__value">{pigcms{$servArr.start_time|date="Y-m-d H:i:s",###}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">出场时间</label>
            <span class="weui-form-preview__value">{pigcms{$out_time|date="Y-m-d H:i:s",###}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">停车时长</label>
            <span class="weui-form-preview__value">{pigcms{$time}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">停车费用</label>
            <span class="weui-form-preview__value">{pigcms{$servArr.payment}元</span>
        </div>
    </div>
    <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" id="close_window">关闭</a>
    </div>

</div>


<script>
    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    }
</script>
</body>
</html>