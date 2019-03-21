<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>手机号绑定</title>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <!-- body 最后 -->
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

    <!-- 如果使用了某些拓展插件还需要额外的JS -->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

    <!-- sweetalert -->
    <script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="weui-form-preview">
    <form action="{pigcms{:U('PropertyService/bind_phone')}" enctype="multipart/form-data" method="post" id="myform">
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell weui-cell_vcode" style="height: 50px;">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" id="phone" type="tel" name="phone" placeholder="请输入手机号">
                </div>
            </div>
        </div>
    </form>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" onclick="sub()" href="javascript:" id="showTooltips">确定</a>
    </div>
</div>
<script>
    function sub() {
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(!myreg.test($("#phone").val()))
        {
            alert('请输入有效的手机号码！');
            return false;
        } else {
            $("form").submit();
        }
    }

</script>
</body>
</html>