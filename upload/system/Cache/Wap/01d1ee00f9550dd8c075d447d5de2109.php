<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<html lang="zh-CN"><head>
	<meta charset="utf-8">
	<title><?php echo ($village_name); ?></title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210">
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?217">
	<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/layer/layer.m.js" charset="utf-8"></script><link href="http://you.huidehang.cn//tpl/Wap/pure/static/layer/need/layer.css" type="text/css" rel="styleSheet" id="layermcss">
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/villagephone.js?210" charset="utf-8"></script>
	<style>
		#container{top:130px;border-top: 1px solid #edebeb;}
				.bigBtn{
	height:50px;
	line-height:50px;
	text-align:center;
	margin:15px 10%;
	border:1px solid #A4BC41;
	border-radius:3px;
	background-color:white;
	color:#A4BC41;
}
	</style>
</head>
<body style="zoom: 1;">
<header class="pageSliderHide">常用电话</header>
<section class="bigBtn phone pageSliderHide" data-phonetip="物业服务中心" data-phone="<?php echo ($server); ?>">
	拨打物业服务中心电话 <span style="font-family:Arial; color:#fb4746; font-size:14px;"><?php if($server): ?>(<?php echo ($server); ?>)<?php endif; ?></span>
</section>
<div id="container" style="bottom: 57px;">
	<div id="scroller" style="min-height: 712px; transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; left: 0px; top: 0px;">
		<?php if(is_array($ct_message)): $i = 0; $__LIST__ = $ct_message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><section class="villageBox phoneBox">
				<div class="headBox"><?php echo ($vo["ct_name"]); ?></div>
				<dl>
					<?php if(is_array($vo["ct"])): $i = 0; $__LIST__ = $vo["ct"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><dd class="phone" data-phonetip="<?php echo ($vo["ct_name"]); ?>联系电话" data-phone="<?php echo ($v["phone"]); ?>">
							<div><?php echo ($v["name"]); ?></div>
							<span><?php echo ($v["phone"]); ?></span>
						</dd><?php endforeach; endif; else: echo "" ;endif; ?>
				</dl>
			</section><?php endforeach; endif; else: echo "" ;endif; ?>
		</div></div>
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
<script>
	$("#phone").addClass('hover');
	$("#phone").attr('href','');
</script>
</html>