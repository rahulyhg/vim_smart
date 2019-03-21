<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{pigcms{$now_village.village_name}</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/village_my.js?210" charset="utf-8"></script>
</head>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>社区缴费</header>
<div id="container">
    <div id="scroller" class="village_my">
        <nav class="me_pay">
            <volist name="pay_list" id="vo">
                <section class="link-url" data-url="{pigcms{$vo.url}"><img src="{pigcms{$static_path}images/house/{pigcms{$vo.type}.png"/><p>{pigcms{$vo.name}</p><em><if condition="$vo['money'] gt 0">(需缴费￥{pigcms{$vo.money})<else/>(无需缴费)</if></em></section>
            </volist>
        </nav>
        <div id="pullUp" style="bottom:-60px;">
            <img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>
        </div>
    </div>
</div>
{pigcms{$shareScript}
</body>
</html>