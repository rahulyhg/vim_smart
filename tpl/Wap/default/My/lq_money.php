<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>零钱</title>
    <link href="{pigcms{$static_path}css/weui.css" rel="stylesheet"/>
    <script src="{pigcms{$static_path}js/jquery.js" language="javascript" type="text/javascript"></script>
    <style type="text/css">
    @font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")}
    body{background: #efeff4;}
    .weui_msg{padding-top: 60px;}
    #weui_title{font-size: 40px;margin-top: -10px;}
    #weui_mone{font-size: 40px;letter-spacing:-9px;}
    .weui_msg .weui_text_area{margin-bottom: 30px;margin-top: -15px; }
    .weui_msg .weui_icon_area{margin-bottom: 25px;}
    .weui_btn_area{margin: 1.17647059em 10px 0.3em;}
    </style>
</head>
<body ontouchstart>
<div class="container js_container">
    <div class="page slideIn msg">
        <div class="weui_msg">
            <div class="weui_icon_area"><img src="{pigcms{$static_path}images/lq.png"></div>
            <div class="weui_text_area">
                 <p> 我的零钱</p>
                 <div style="margin-top:-10px;margin-left:-4px;"><span id="weui_mone" >￥</span><span id="weui_title">{pigcms{$now_user.now_money}</span></div>
                
                
            </div>
            <div class="weui_opr_area">
                <p class="weui_btn_area">
                    <a href="{pigcms{:U('My/recharge')}" class="weui_btn weui_btn_primary">充值</a>
                    <a href="{pigcms{:U('My/mx_money')}" class="weui_btn weui_btn_default">明细</a>
                </p>
            </div>
        </div>
    </div>
</div>


</body>
</html>

