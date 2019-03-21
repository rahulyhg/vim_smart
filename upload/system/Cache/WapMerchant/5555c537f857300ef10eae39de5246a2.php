<?php if (!defined('THINK_PATH')) exit();?>﻿<!--头部-->
<!DOCTYPE html>
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

<!--头部结束-->
<body>
	<header class="pigcms-header mm-slideout">
		<a href="<?php echo U('Index/login');?>" id="pigcms-header-left"><i class="iconfont icon-left"></i></a>
		<p id="pigcms-header-title">注册商家</p>
		<a  id="pigcms-header-right"></a>
	</header>
	<div class="container container-fill" style='padding:50px 0;'>
	<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop_staff.css">
	<script type="text/javascript" src="<?php echo ($static_path); ?>/js/iscroll.js"></script>
	<style>
		.pigcms-container{
			background: none;
			padding: 0;
		}
		.form_tips{color:red;}
		#choose_area{margin-right: 10px; padding-left:5px; padding-right:5px; float:left;margin-bottom:15px; background: #fb4746; color:#FFFFFF;}
		#choose_circle{padding-left: 5px; padding-right:5px; float:left;margin-bottom:15px; background: #fb4746; color:#FFFFFF;}
	</style>
	<form class="pigcms-form" method="post" action="" onsubmit="return checkSubmit();return false;">
		<div class="pigcms-container">
			<p class='pigcms-form-title'>帐 号：</p>
			<input type="text" class="pigcms-input-block" name="account" placeholder="长度为6~16位字符">
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>密 码：</p>
			<input type="password" class="pigcms-input-block" name="pwd" placeholder="长度为大于6位字符">
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>商家名称：</p>
			<input type="text" class="pigcms-input-block" name="mername" placeholder="请填写员工帐号">
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>所在区域：</p>
			<div id="choose_cityarea"></div>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class="pigcms-form-title">邮 箱：</p>
			<input type="text" class="pigcms-input-block" name="email" placeholder="必填">
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class="pigcms-form-title">手机号：</p>
			<input type="text" class="pigcms-input-block" name="phone" placeholder="必填">
			<div style="clear:both"></div>
		</div>
	  <div class="pigcms-container">
			<p class="pigcms-form-title">验证码：</p>
			<input class="pigcms-input-block2" type="text" id="reg_verify" style="width:70px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
			<span class="verify_box" style="float:left;">
				<img src="<?php echo U('Index/verify',array('type'=>'reg'));?>" id="reg_verifyImg" onclick="reg_fleshVerify('<?php echo U('Index/verify',array('type'=>'reg'));?>')" title="刷新验证码" alt="刷新验证码" style="margin-top:8px; float:left;"/>&nbsp;
				<a href="javascript:reg_fleshVerify('<?php echo U('Index/verify',array('type'=>'reg'));?>')" style="margin-top:15px; margin-left:5px; float:left;">刷新验证码</a>
				<div style="clear:both"></div>
			</span>
		</div><div style="clear:both"></div>

		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info">注 册</button>
		<input type="hidden" name="type_id" value="mer_reg" />
	</form>
		<div style="font-size:12px;margin-left:20px;">
		<p class="form_tips">注册成功后需要管理员审核！</p>
		<?php if($config['site_phone']): ?><p>客服电话 ：<a href="tel:<?php echo ($config["site_phone"]); ?>"><?php echo ($config["site_phone"]); ?></a></p><?php endif; ?>
	</div>
	</div>
	
</body>

<script type="text/javascript">
   var static_public="<?php echo ($static_public); ?>",choose_province="/merchant.php?g=Merchant&c=Area&a=ajax_province",choose_city="/merchant.php?g=Merchant&c=Area&a=ajax_city",choose_area="/merchant.php?g=Merchant&c=Area&a=ajax_area",choose_circle="merchant.php?g=Merchant&c=Area&a=ajax_circle";

function reg_fleshVerify(url){
	var time = new Date().getTime();
	$('#reg_verifyImg').attr('src',url+"&time="+time);
}
 </script>
 <script type="text/javascript" src="<?php echo ($static_path); ?>js/area.js"></script>
	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>


</html>