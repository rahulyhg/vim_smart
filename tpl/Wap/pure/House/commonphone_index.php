<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<html lang="zh-CN"><head>
	<meta charset="utf-8">
	<title>{pigcms{$village_name}</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210">
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?217">
	<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/layer/layer.m.js" charset="utf-8"></script><link href="http://you.huidehang.cn//tpl/Wap/pure/static/layer/need/layer.css" type="text/css" rel="styleSheet" id="layermcss">
	<script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/villagephone.js?210" charset="utf-8"></script>
	<style>
		#container{top:130px;border-top: 1px solid #edebeb;}
				.bigBtn {
    height: 50px;
    line-height: 50px;
    text-align: center;
    margin: 15px 10%;
    border: 1px solid #0697dc;
    border-radius: 3px;
    background-color: white;
    color: #0697dc;
}
	</style>
</head>
<body style="zoom: 1;">
<header class="pageSliderHide">常用电话</header>
<section class="bigBtn phone pageSliderHide" data-phonetip="物业服务中心" data-phone="{pigcms{$server}">
	拨打物业服务中心电话 <span style="font-family:Arial; color:#fb4746; font-size:14px;"><if condition="$server">({pigcms{$server})</if></span>
</section>
<div id="container" style="bottom: 57px;">
	<div id="scroller" style="min-height: 712px; transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; left: 0px; top: 0px;">
		<volist name="ct_message" id="vo">
			<section class="villageBox phoneBox">
				<div class="headBox">{pigcms{$vo.ct_name}</div>
				<dl>
					<volist name="vo.ct" id="v">
						<dd class="phone" data-phonetip="{pigcms{$vo.ct_name}联系电话" data-phone="{pigcms{$v.phone}">
							<div>{pigcms{$v.name}</div>
							<span>{pigcms{$v.phone}</span>
						</dd>
					</volist>
				</dl>
			</section>
		</volist>
		</div></div>
<include file="House:footer"/>
		{pigcms{$shareScript}
</body>
<script>
	$("#phone").addClass('hover');
	$("#phone").attr('href','');
</script>
</html>