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
                    <a class="weui-btn weui-btn_primary" id="close_window">关闭</a>
                    <php>$href=$jumpUrl?:"javascript:history.back();"</php>
                    <a href="{pigcms{$href}" class="weui-btn weui-btn_default">返回</a>
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
    <script>
        var btn = document.getElementById('close_window');
        btn.onclick = function(){
            WeixinJSBridge.invoke('closeWindow',{},function(res){});
        }
    </script>
</body>
</html>