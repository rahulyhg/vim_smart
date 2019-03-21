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
		<header class="pageSliderHide"><div id="backBtn"></div>个人中心</header>
		<div id="container">
			<div id="scroller" class="village_my">
				<nav>
					<section class="myInfoSection" id="myInfoSection">
						<img class="lazy_img" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>"/>
						<h2 style="font-size:14px;line-height:20px;height:20px;padding-top:0px;">{pigcms{$now_user_info.name} </h2>
						<p style="line-height:20px;height:20px;"><span style="color:#999;">物业编号：{pigcms{$now_user_info.usernum}</span></p>
						<p style="line-height:20px;height:20px;"><span style="color:#666;">地址：{pigcms{$now_user_info.address}</span></p>
					</section>
				</nav>
				<nav>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_pay',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#0092DE;">费</span><p>社区缴费</p></section>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_repair',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#EAAD0D;">修</span><p>在线报修</p></section>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_utilities',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#EA0DDF;">报</span><p>水电煤上报</p></section>
				</nav>
				<nav>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_paylists',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#F5716E;">订</span><p>缴费订单列表</p></section>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_repairlists',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#EAAD0D;">修</span><p>在线报修列表</p></section>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_utilitieslists',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#EA0DDF;">报</span><p>水电煤上报列表</p></section>					
					<!--<section class="link-url" data-url="{pigcms{:U('House/village_control_check',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#0092DE;">审</span><p>用户资料审核</p></section>-->	
				</nav>
				<nav>
					<section class="link-url" data-url="{pigcms{:U('House/village_my_suggest',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#0092DE;">议</span><p>投诉建议</p></section>
					<!--<section class="link-url" data-url="{pigcms{:U('House/village_my_bind',array('village_id'=>$now_village['village_id']))}"><span style="background-color:#0092DE;">绑</span><p>管理员后台</p></section>-->
				</nav>
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px;"/>
				</div>
			</div>
		</div>
		<include file="House:footer"/>
		{pigcms{$shareScript}
	</body>
</html>