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
		<header class="pageSliderHide"><div id="backBtn"></div>缴费订单列表</header>
		<div id="container">
			<div id="scroller" class="village_my">
				<if condition="$order_list">
					<nav class="order_list">
						<volist name="order_list" id="vo">
							<section>
								<img src="{pigcms{$static_path}images/house/{pigcms{$vo.order_type}.png"/>
								<p>{pigcms{$vo.order_name}</p>
								<p class="money">金额：<span>￥{pigcms{$vo.money|floatval=###}</span><em>{pigcms{$vo.time|date='Y-m-d H:i',###}</em></p>
							</section>
						</volist>
					</nav>
				<else/>
					<div class="noMoreDiv" style="margin-top:20px;background:#ebebeb;">您还没有使用缴费功能</div>
				</if>
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		{pigcms{$shareScript}
	</body>
</html>