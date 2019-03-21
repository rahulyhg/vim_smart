<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($now_village["village_name"]); ?></title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_my.js?210" charset="utf-8"></script>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>个人中心</header>
		<div id="container">
			<div id="scroller" class="village_my">
				<nav>
					<section class="myInfoSection" id="myInfoSection">
						<img class="lazy_img" src="<?php if($now_user['avatar']): echo ($now_user["avatar"]); else: echo ($static_path); ?>images/pic-default.png<?php endif; ?>"/>
						<h2 style="font-size:14px;line-height:20px;height:20px;padding-top:0px;"><?php echo ($now_user_info["name"]); ?> </h2>
						<p style="line-height:20px;height:20px;"><span style="color:#999;">物业编号：<?php echo ($now_user_info["usernum"]); ?></span></p>
						<p style="line-height:20px;height:20px;"><span style="color:#666;">地址：<?php echo ($now_user_info["address"]); ?></span></p>
					</section>
				</nav>
				<nav>
					<section class="link-url" data-url="<?php echo U('House/village_my_pay',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#0092DE;">费</span><p>小区缴费</p></section>
					<section class="link-url" data-url="<?php echo U('House/village_my_repair',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#EAAD0D;">修</span><p>在线报修</p></section>
					<section class="link-url" data-url="<?php echo U('House/village_my_utilities',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#EA0DDF;">报</span><p>水电煤上报</p></section>
				</nav>
				<nav>
					<section class="link-url" data-url="<?php echo U('House/village_my_paylists',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#F5716E;">订</span><p>缴费订单列表</p></section>
					<section class="link-url" data-url="<?php echo U('House/village_my_repairlists',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#EAAD0D;">修</span><p>在线报修列表</p></section>
					<section class="link-url" data-url="<?php echo U('House/village_my_utilitieslists',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#EA0DDF;">报</span><p>水电煤上报列表</p></section>
				</nav>
				<nav>
					<section class="link-url" data-url="<?php echo U('House/village_my_suggest',array('village_id'=>$now_village['village_id']));?>"><span style="background-color:#0092DE;">议</span><p>投诉建议</p></section>
				</nav>
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<?php if(empty($no_footer)): ?><footer class="footerMenu wap">
		<ul>
			<li>
				<a href="<?php echo U('Home/index');?>"><em class="home"></em><p>平台首页</p></a>
			</li>
			<li>
				<a href="<?php echo U('House/village_list');?>"><em class="group"></em><p>社区列表</p></a>
			</li>			<li>				<a id="phone" href="<?php echo U('House/village_list',array('village_id'=>$now_village['village_id'],'comm'=>'1'));?>"><em class="group" id="group1"></em><p>号码管理</p></a>			</li>
			<li>
				<a <?php if(in_array(ACTION_NAME,array('village'))): ?>class="hover"<?php else: ?>href="<?php echo U('House/village',array('village_id'=>$now_village['village_id']));?>"<?php endif; ?>><em class="store"></em><p>小区首页</p></a>
			</li>
			<li>
				<a <?php if(strpos(ACTION_NAME,'village_my') !== false): ?>class="active"<?php else: endif; ?> href="<?php echo U('House/village_my',array('village_id'=>$now_village['village_id']));?>"><em class="my"></em><p>个人中心</p></a>
			</li>
		</ul>
	</footer><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
		<?php echo ($shareScript); ?>
	</body>
</html>