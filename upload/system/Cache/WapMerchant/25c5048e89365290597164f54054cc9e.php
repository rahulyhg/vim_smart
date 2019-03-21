<?php if (!defined('THINK_PATH')) exit();?><!--头部-->
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
<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop_item.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop_staff.css">
<style>
	.pigcms-container{background: none;padding: 0;}
	.form_tips{color:red;}
	.radio{margin: 0 3%;padding: 10px 0; width: 92%;line-height: 20px!important;}
	.pigcms-textarea{margin-bottom:10px;}
	.submittips{height: 60px;
	line-height: 70px;
	font-size: 22px;
	}
	.pigcms-form-title{
	margin-top: 3%;
	margin-bottom:3%;
	margin-left:3%;
	margin-right:0;
	padding: 0 4%!important;
	width:18%;
	font-size: 13px;
	float:left;
}
.pigcms-input-block{
	display: block;
	margin-top: 0;
	margin-bottom:15px;
	margin-left:0;
	margin-right:0;
	padding: 0 2%!important;
	width: 63%;
	height: 40px!important;
	line-height: 40px!important;
	float:left;
	}
</style>
<body>
		<header class="pigcms-header mm-slideout">
			<a href="javascript:history.go(-1);" id="pigcms-header-left"><i class="iconfont icon-left"></i></a>
			<p id="pigcms-header-title"><?php if($tid > 0): ?>编辑桌台<?php else: ?>添加桌台<?php endif; ?></p>
		</header>
	<div class="container container-fill" style='padding-top:50px'>

		<form class="pigcms-form" method="post" class="form-horizontal" method="post"  action="<?php echo U('Index/table_add',array('store_id'=>$now_store['store_id']));?>">
			<div class="pigcms-container">
				<p class='pigcms-form-title'>桌台名称：</p>
				<input class="pigcms-input-block" size="20" name="name" id="name" type="text" value="<?php echo ($now_table["name"]); ?>"/>
			</div><div style="clear:both"></div>
			<div class="pigcms-container">
				<p class='pigcms-form-title'>容纳人数：</p>
				<input class="pigcms-input-block" size="20" name="num" id="num" type="text" value="<?php echo ($now_table["num"]); ?>"/>
			</div><div style="clear:both"></div>
								
			<div class="pigcms-container">
				<p class='pigcms-form-title'>桌台使用<br/>状态</p>
				<div class="radio">
					<label>
						<input name="status" value="1" type="radio" <?php if($now_table['status'] == 1): ?>checked="checked"<?php endif; ?>/>
						<span class="lbl" style="z-index: 1">使用中</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label>
						<input name="status" value="0" type="radio" <?php if($now_table['status'] == 0): ?>checked="checked"<?php endif; ?>/>
						<span class="lbl" style="z-index: 1">空闲</span>
					</label>
				</div>										
			</div><div style="clear:both"></div>

		   <?php if($ok_tips): ?><div class="pigcms-container">
					<p class='pigcms-form-title submittips'><span style="color:blue;"><?php echo ($ok_tips); ?></span></p>
				</div><?php endif; ?>
			<?php if($error_tips): ?><div class="pigcms-container">
					<p class='pigcms-form-title submittips'><span style="color:red;"><?php echo ($error_tips); ?></span></p>
				</div><?php endif; ?>

			<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit"><?php if($tid > 0): ?>修改<?php else: ?>添加<?php endif; ?></button>
			<input  name="store_id"  type="hidden" value="<?php echo ($now_store['store_id']); ?>"/>
			<input  name="tid"  type="hidden" value="<?php echo ($tid); ?>"/>
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