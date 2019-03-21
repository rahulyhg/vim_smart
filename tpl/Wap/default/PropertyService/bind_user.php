<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8"/>

    <title>绑定 - {pigcms{$config.site_name}</title>

    <meta name="description" content="{pigcms{$config.seo_description}"/>

    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>

    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <meta name='apple-touch-fullscreen' content='yes'/>

    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    <meta name="format-detection" content="telephone=no"/>

    <meta name="format-detection" content="address=no"/>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">


</head>

<body id="index" data-com="pagecommon">

<div id="container">

    <div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>

    <div id="login">

        <form method="post" action="{pigcms{:U('PropertyService/bind_user')}" enctype="multipart/form-data">
            <div class="weui-cells weui-cells_form">
                    <div class="weui-cell weui-cell_vcode" style="height: 50px;">
                        <div class="weui-cell__hd">
                            <label class="weui-label">手机号</label>
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" id="phone" type="tel" name="phone" placeholder="请输入手机号">
                        </div>
<!--                        <div class="weui-cell__ft">-->
<!--                            <span class="weui-vcode-btn">获取验证码</span>-->
<!--                        </div>-->
                    </div>

<!--                    <div class="weui-cell weui-cell_vcode" style="height: 50px;">-->
<!--                        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>-->
<!--                        <div class="weui-cell__bd">-->
<!--                            <input class="weui-input" type="number" placeholder="请输入验证码">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->

            </div>
        </form>

<!--        <div class="btn-wrapper">-->
<!---->
<!--            <button onclick="sub()" class="btn btn-larger btn-block green">绑定</button>-->
<!---->
<!--        </div>-->
        <div class="weui-btn-area">
            <a class="weui-btn weui-btn_primary" onclick="sub()" href="javascript:" id="showTooltips">确定</a>
        </div>

    </div>

</div>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

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