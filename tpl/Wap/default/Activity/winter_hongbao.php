<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>汇得行诚意圣诞礼</title>
    <style>
        * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }


        body {padding:0; margin:0; font-family:"微软雅黑"; font-size:14px;}
        .both {clear:both;}
        .width {width:90%; margin:0px auto;}
        .zw {width:100%;}
        .bf {width:100%; background:url(../images/3.png) no-repeat; background-size:100% 100%; height:240px; margin-top:65%;}
        .bf2 {width:100%; text-align:center; padding-top:20px;}
        .bf3 {width:100%; position:fixed; bottom:-10px;}


        .hb {width:95%; margin:8px auto; margin-bottom:0px;}
        .hb2 {width:100%; line-height:24px; color:#FFFFFF; text-align:center; font-size:14px; padding-top:80px; font-weight:bold;}
        .hb3 {width:100%; line-height:24px; color:#FFFFFF; text-align:center; font-size:12px; padding-top:10px;}
        html,body {width:100%; height:100%;}
        body {color:#afafaf; font-size:14px; background-color:#cf0822; background-size:100% 100%;;}
        .active{color:#033f6b;}
        .kidx {padding-top:7px; background-color:#FFFFFF;}
        p {margin: 0px;}
    </style>
</head>
<body>
<div class="zw">
    <div class="width">
        <div class="hb2">红包已发，请在消息列表“服务通知”中领取</div>
		<div class="hb"><img src="{pigcms{$static_path}/images/winter/kk.jpg" style="width:100%; height:auto;" onClick="f_close()"></div>
        <div class="hb3">请注意：关注过“汇得行智慧助手”公众号的朋友，会直接收到我们发的红包哦 ^_^</div>
    </div>
</div>
</body>
<script src="{pigcms{$static_path}tpl/com/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script>

    function f_close(){
        if(typeof(WeixinJSBridge)!="undefined"){
            WeixinJSBridge.call('closeWindow');
        }else{
            if (navigator.userAgent.indexOf("MSIE") > 0) {
                if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {
                    window.opener = null; window.close();
                } else {
                    window.open('', '_top'); window.top.close();
                }
            } else if (navigator.userAgent.indexOf("Firefox") > 0) {
                window.location.href = 'about:blank ';
                //window.history.go(-2);
            } else {
                window.opener = null;
                window.open('', '_self', '');
                window.close();
            }
        }
    }
</script>
</html>