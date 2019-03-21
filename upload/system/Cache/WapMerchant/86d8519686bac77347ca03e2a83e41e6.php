<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php echo ($shareScript); ?>
	<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery.mmenu.all.css" />
	<link href="<?php echo ($static_path); ?>css/style.css?ver=<?php echo time(); ?>" rel="stylesheet" >
	<link href="<?php echo ($static_path); ?>css/iconfont.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/checkSubmit.js?ver=<?php echo time(); ?>"></script>	
	<script type="text/javascript">
		function onBridgeReady(){
		  //隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
		  WeixinJSBridge.call('hideOptionMenu');
		  //隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
		  WeixinJSBridge.call('hideToolbar');
		}
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
				document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
			}
		}else{
			onBridgeReady();
		}
	wx.ready(function(){
		wx.hideOptionMenu();
	});
</script>
	<script type="text/javascript">	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>
	<script>
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	$(function() {
		//$(".pigcms-main").css('height', $(window).height()-50);
		$('div#slide_menu').mmenu();
		$(".pigcms-slide-footer").css('top', $(window).height()-180);
		$("#mm-0").css('height', $(window).height()-150);
		$('#pigcms-header-left').click(function(){
			setTimeout(function(){
				$("#shop-detail-container").css('width', $("#user-info").width()-95);
			},10);
		})
	});
	</script>
	<style>
		.has-msg:after{
			content: '0'!important;
		}
		.has-order:after{
			content: '0'!important;
		}
	</style>
</head>
<body>
	
	<div class="container container-fill" style='padding-top:40px'>
		<style>
	@media (max-height: 600px){
		.pigcms-main{
			padding-top: 10px;
		}
		.pigcms-container{
			margin-bottom: 20px;
		}
		.top-img-container{
			padding-bottom: 10px;
		}
		#login-container{
			margin: 1% 10px;
			padding: 1px 15px;
		}
		.pigcms-btn-block{
			padding: 20px 0;
		}
		#forget-password{
			margin: 10px 0;
			font-size: 12px;
		}
		#no-shop{
			margin: 10px 0 10px;
			font-size: 12px;
		}

	}
	.claim-text{
		background:#fff;
		text-align:center;
		width: 94%;
		margin: 0 3%;
		padding: 10px 0;
		color: #777;
		border-radius: 10px;
	}
</style>
<script>
	$(function(){
		$(".pigcms-main").css('height', $(window).height());
	})
</script>
	<form class="pigcms-main"  method="post" role="form" action="" enctype="multipart/form-data" onsubmit="return checkSubmit();">
		<div class="pigcms-container">
			<div class="top-img-container"><img src="<?php echo ($config["site_merchant_logo"]); ?>" alt="" class="top-img"></div>
		</div>
		<div class="pigcms-container">
			<div id="login-container">
				<div class="login-input-wrapper">
					<span class="login-input-after"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/human.jpg" style="width:19px; height:22px; margin-top:4px;"></span>
					<input type="text" class="login-input" name="account" placeholder="请输入商户号" autocomplete='off'>
					<div class="clearfix"></div>
				</div>
				<div class="login-input-wrapper">
					<span class="login-input-after"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/lock.jpg" style="width:19px; height:22px; margin-top:4px;"></span>
					<input type="password" class="login-input" name="pwd" placeholder="请输入密码">
					<input type='hidden' value='login' name='type_id'>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" value="登录">登录</button>
		<a href="<?php echo U('Index/merreg');?>" class="pigcms-btn-block pigcms-btn-block-warning" style='color:#fff'>我要入驻</a>
		<p id="no-shop">还没有入驻？</p>
	
	</form>
</div>
</body>
	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>


</html>