<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>店员登录</title>
    <meta name="description" content="{pigcms{$config.seo_description}"/>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
    <style>
        #login{margin: 0.5rem 0.2rem;}
        .btn-wrapper{margin:.28rem 0;}
        dl.list{border-bottom:0;border:1px solid #ddd8ce;}
        dl.list:first-child{border-top:1px solid #ddd8ce;}
        dl.list dd dl{padding-right:0.2rem;}
        dl.list dd dl>.dd-padding, dl.list dd dl dd>.react, dl.list dd dl>dt{padding-right:0;}
        .nav{text-align: center;}
        .subline{margin:.28rem .2rem;}
        .subline li{display:inline-block;}
        .captcha img{margin-left:.2rem;}
        .captcha .btn{margin-top:-.15rem;margin-bottom:-.15rem;margin-left:.2rem;}
    </style>
</head>
<body id="index" data-com="pagecommon">
<!--<header  class="navbar">
    <h1 class="nav-header">店员登录 - {pigcms{$config.site_name}</h1>
</header>-->
<div id="container">
    <div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
    <div id="login">
        <form id="login_form" autocomplete="off" method="post" action="{pigcms{:U('Storestaff/selectlogin')}">
            <div id="normal-fieldset" class="normal-fieldset" style="height: 100%;">
                <h4>选择支付方式</h4>
                <dl class="list">
                    <volist name="wei_login" id="vo">
                        <dd class="dd-padding">
                            <label class="mt"><i class="bank-icon icon"></i><span class="pay-wrapper">{pigcms{$vo.username}<input type="radio" class="mt" value="{pigcms{$key}" <if condition="$i eq 1">checked="checked"</if> name="pay_type"></span></label>
                        </dd>
                    </volist>
                </dl>
            </div>
            <div class="btn-wrapper">
                <button type="submit" class="btn btn-larger btn-block">确定</button>
            </div>
        </form>
    </div>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_public}js/laytpl.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script type="text/javascript">

</script>
</body>
</html>