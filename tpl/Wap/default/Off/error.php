
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>操作失败</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    {pigcms{$shareScript}
</head>
<body>
<div class="page msg_warn js_show">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <!--<h2 class="weui-msg__title">操作失败</h2>-->
            <p class="weui-msg__desc">
                {pigcms{$error}
                <!--<a href="javascript:void(0);">文字链接</a>-->
            </p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a   class="weui-btn weui-btn_primary" onclick="qrcode()">扫一扫</a>
                <a id="close_window"  class="weui-btn weui-btn_default" >关闭</a>
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">
                <!--<p class="weui-footer__links">-->
                    <!--<a href="javascript:void(0);" class="weui-footer__link">底部链接文本</a>-->
                <!--</p>-->
                <p class="weui-footer__text">2016 © 汇得行智慧停车系统 邻钱科技</p>
            </div>
        </div>
    </div>
</div>
    <!--<h1>{$jumpUrl}</h1>-->
    <!--<h1>{$waitSecond}</h1>-->
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
    <script>
        var btn = document.getElementById('close_window');
        btn.onclick = function(){
            WeixinJSBridge.invoke('closeWindow',{},function(res){});
        }
        //调用扫一扫
        function qrcode(){
            //alert('正在启动摄像头，请稍作等待');
            wx.scanQRCode({
                needResult: 0,
                scanType: ["qrCode","barCode"],
                desc: '正在启动摄像头，请稍作等待'
            });
        }
    </script>
</body>
</html>