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
		<a href="javascript:history.go(-1);" id="pigcms-header-left"><i class="iconfont icon-left"></i></a>
		<p id="pigcms-header-title">编辑店员</p>
		<a  id="pigcms-header-right"></a>
	</header>
	<div class="container container-fill" style='padding-top:50px'>
	<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop_staff.css">
	<script type="text/javascript" src="<?php echo ($static_path); ?>/js/iscroll.js"></script>
	<style>
		.pigcms-container{
			background: none;
			padding: 0;
		}
	</style>
	<form class="pigcms-form" method="post" action="" onsubmit="return checkSubmit();return false">
		
		<div class="pigcms-container">
			<p class="pigcms-form-title">员工帐号(<span style='color:red'>不允许修改</span>)</p>
			<input type="text" class="pigcms-input-block" style='background:white'  readonly="readonly" value="<?php echo ($staff['username']); ?>">
		</div>
		<div class="pigcms-container">
			<p class="pigcms-form-title">员工手机号</p>
			<input type="text" class="pigcms-input-block" name='staff_phone' value="<?php echo ($staff["tel"]); ?>">
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>员工姓名</p>
			<input type="text" class="pigcms-input-block" name="staff_name" value='<?php echo ($staff["name"]); ?>'>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>初始密码</p>
			<input type="password" class="pigcms-input-block" name="staff_password" placeholder="请填写员工初始密码">
		</div>
		<div class="pigcms-container">
			<p class="pigcms-form-title">选择店铺(<span style='color:red'>不允许修改</span>)</p>
			<select name="store_id" id="inputstore_id" class="pigcms-input-block">
			<?php if(is_array($store)): $i = 0; $__LIST__ = $store;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?><option value="<?php echo ($store["store_id"]); ?>" <?php if($store['store_id'] == $staff['store_id']): ?>selected<?php endif; ?>><?php echo ($store["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" value="确定">确定</button>
		<input type="hidden" name="type_id" value="staff_edit" />
		<input type="hidden" name="staff_id" value="<?php echo ($staff["id"]); ?>" />
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