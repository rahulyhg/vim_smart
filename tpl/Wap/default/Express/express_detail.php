<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

</head>
<body style="background-color:#efeff4;">
<div class="weui-msg">
    <div class="weui-msg__icon-area"><img src="{pigcms{$Think.session.user.avatar}" style="border-radius: 50%"/></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">{pigcms{$Think.session.user.nickname}，您好！</h2>
        <p class="weui-msg__desc">请凭取件码：<a href="javascript:void(0);">{pigcms{$info.receipt_code}</a>到广发立体车库一楼取件哦！</p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="{pigcms{:U('Home/index_new')}" class="weui-btn weui-btn_primary">更多服务内容</a>
            <a href="javascript:;" class="weui-btn weui-btn_default" id="close_window">关闭</a>
        </p>
    </div>
    <div class="weui-msg__extra-area">
        <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:void(0);" class="weui-footer__link">汇得行智慧助手</a>
            </p>
            <p class="weui-footer__text">Copyright © 2015-2018 www.hdhsmart.com</p>
        </div>
    </div>
</div>
</body>
</html>
<script src="{pigcms{$static_path}js/express/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script>
    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    }

</script>

