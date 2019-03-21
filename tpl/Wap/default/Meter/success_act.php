<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>操作成功</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="page msg_warn js_show">
    <div class="page msg_success js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">操作成功</h2>
                <p class="weui-msg__desc">{pigcms{$message}
                    <!--                    <a href="javascript:void(0);">文字链接</a>-->
                </p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">

<!--                    <a class="weui-btn weui-btn_primary">继续扫码</a>-->
                    <a class="weui-btn weui-btn_primary" onclick="saoma();">扫一扫</a>

                    <php>$href=$jumpUrl?:"javascript:history.back();"</php>
                    <!--<a class="weui-btn weui-btn_plain-primary" id='close_window'>返回列表</a>-->
                    <a class="weui-btn weui-btn_plain-primary" href="{pigcms{:U('meter_record2')}">返回列表</a>
                </p>
            </div>
            <div class="weui-msg__extra-area">
                <div class="weui-footer">
                    <!--                    <p class="weui-footer__links">-->
                    <!--                        <a href="javascript:void(0);" class="weui-footer__link">底部链接文本</a>-->
                    <!--                    </p>-->
<!--                    <p class="weui-footer__text">汇得行控股（中国）有限公司武汉广发银行大厦</p>-->
                    <p class="weui-footer__text">汇得行（中国）集团有限公司</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<h1>{pigcms{$jumpUrl}</h1>-->
<!--<h1>{pigcms{$waitSecond}</h1>-->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
{pigcms{$shareScript}
<script>
    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    };


    /*吊起二维码扫描功能*/
    function saoma() {
        wx.scanQRCode({
            needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success: function (res) {
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                console.log(2);
            }
        });
    }
</script>
</body>
</html>