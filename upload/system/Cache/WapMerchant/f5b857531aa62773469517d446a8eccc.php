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
	</header>
	<div class="container container-fill" style='padding-top:10px'>
		<!--左侧菜单-->
		<div class="container container-fill" style='padding-top:50px'>

<div id="slide_menu">

	<header class="pigcms-slide-header">

		<a id="pigcms-slide-left"><i class="iconfont icon-set"></i></a>

		<p id="pigcms-slide-title"><?php echo ($mer_name); ?></p>

		<!--<a id="pigcms-slide-right">

			<i class="iconfont icon-mail "></i>

		</a>-->

		<div id="user-info">

			<img src="<?php echo ($mer_img); ?>" alt="" id="shop-img" onerror="this.src='<?php echo ($config["site_merchant_logo"]); ?>'">

			<div id="shop-detail-container">

				<p id="shop-balance">粉丝数<span><?php echo ($fans_count); ?></span></p>

				 <div id="shop-order-container">

					<div class="order-container">

						<p class="order-count" id='all-order-count'><?php echo ($allordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/ordermang');?>">全部订单</a></p>

					</div>

					<div class="order-container">

						<p class="order-count" id='today-order-count'><?php echo ($todayordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/index');?>">今日订单</a></p>

					</div>

					<div class="order-container">

						<p class="order-count" id='month-order-count'><?php echo ($monthordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/index');?>">本月订单</a></p>

					</div>

				 </div>

			</div>

		</div>

	</header>

	<ul>
		<li>                                       
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('WapMerchant/Index/index',array('token'=>$merid));?>"><i class="iconfont icon-home"></i>管理首页</a></li>
		<li>
		<li>                                       
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Wap/Index/index',array('token'=>$merid));?>"><i class="iconfont icon-home"></i>我的小店</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/store_list');?>"><i class="iconfont icon-shop"></i>店铺管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/ordermang');?>"><i class="iconfont icon-form"></i>订单管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/promang');?>"><i class="iconfont icon-goods"></i>商品管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/staff');?>"><i class="iconfont icon-friends"></i>店员管理</a></li>
		<!--li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href=""><i class="iconfont icon-iconfontwechat"></i>分佣管理</a>
		</li-->
		<!--<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/Capital');?>"><i class="iconfont icon-recharge"></i>资金管理</a>
		</li>----->
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/hardware');?>"><i class="iconfont icon-printer"></i>打印机管理</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="Cashier/merchants.php?m=Index&c=login&a=index&type=merchant"><i class="iconfont icon-friends"></i>商家收银</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/merchantewm');?>"><i class="iconfont icon-code"></i>商家二维码</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/merchant_qrcode');?>"><i class="iconfont icon-code"></i>付款二维码</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#'  id="qrcodeBtn"><i class="iconfont icon-code shao"></i>扫一扫</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/withdraw');?>"><i class="iconfont icon-licaishouyi"></i>我要提现</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/logout');?>"><i class="iconfont icon-exit"></i>退出</a>
		</li>
	</ul>

	<footer class="pigcms-slide-footer">
		<a id='order-list' href="<?php echo U('Index/ordermang');?>">
			<i class="iconfont icon-form "></i>
			<span>所有店铺订单</span>
		</a>
		<a id='shop-list' href="<?php echo U('Index/store_list');?>">
			<i class="iconfont icon-file2"></i> 
			<span>店铺列表</span>
		</a>
		<div class="clearfix"></div>
	</footer>

	<script>
		$('#qrcodeBtn').click(function(){
			if(motify.checkWeixin()){
				motify.log('正在调用二维码功能');
				wx.scanQRCode({
					desc:'scanQRCode desc',
					needResult:0,
					scanType:["qrCode"],
					success:function (res){
						// alert(res);
					},
					error:function(res){
						motify.log('微信返回错误！请稍后重试。',5);
					},
					fail:function(res){
						motify.log('无法调用二维码功能');
					}
				});
			}else{
				motify.log('您不是微信访问，无法使用二维码功能');
			}
		});
		
		$("#pigcms-slide-right").click(function(){
			$("#staff-message-li").trigger('click');
		})
		$("#order-list").click(function(){
			$("#order-list-li").trigger('click');
		})
		$("#pigcms-slide-left").click(function(){
			$("#shop-settings-li").trigger('click');
		})
		$("#shop-list").click(function(){
			$("#shop-list-li").trigger('click');
		})
		function jumpLink(obj){
			var url = $(obj).attr('data-href');
			setTimeout(function(){
				window.location.href = url;
			},500);
		}
	</script>

</div>
		<!--左侧菜单结束-->
	<form class="pigcms-form" method="post" action="" onSubmit="return checkSubmit2();return false">
		<div class="pigcms-container">
			<p class='pigcms-form-title2' id="printer-status" style="color: #838383;">
				<i class="iconfont icon-printer" style="font-size: 50px!important;margin-right: 20px;"></i>
				<!--<span class="pigcms-span pigcms-span-info">未绑定</span>-->
			</p>
			<p class='pigcms-form-wz'>打印机状态</p>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>终端号<span class="pigcms-help-text">(终端号, 密钥在打印机底部)</span></p>
			<input type="text" class="pigcms-input-block3" placeholder="请输入终端号" name="mcode" value="<?php echo ($Orderprinter['mcode']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>绑定账号<span class="pigcms-help-text">(绑定手机号和绑定账号只能填写一个)</span></p>
			<input type="text" class="pigcms-input-block3" placeholder="请输入绑定账号" name="username" value="<?php echo ($Orderprinter['username']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>密钥</p>
			<input type="text" class="pigcms-input-block3" placeholder="请输入密钥" name="mkey" value="<?php echo ($Orderprinter['mkey']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>终端手机号</p>
			<input type="text" class="pigcms-input-block3" placeholder="请输入终端手机号" name="mp" value="<?php echo ($Orderprinter['mp']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>打印份数</p>
			<input type="text" class="pigcms-input-block3" placeholder="请输入打印份数" name="count" value="<?php echo ($Orderprinter['count']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class="pigcms-form-title2">选择店铺</p>
			<select name="store_id" class="pigcms-input-block3">
			<?php if(is_array($store)): $i = 0; $__LIST__ = $store;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?><option value="<?php echo ($store["store_id"]); ?>" <?php if($Orderprinter['store_id'] == $store['store_id']): ?>selected="selected"<?php endif; ?>><?php echo ($store["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container" style="margin-left:5%;">
			<label><input type="radio" class='ios-switch green tinyswitch' value="1" name="paid" <?php if($Orderprinter['paid'] == 1): ?>checked="checked"<?php endif; ?>>只打印付过款的 </label>
			<label><input type="radio" value="0" name="paid" <?php if($Orderprinter['paid'] == 0): ?>checked="checked"<?php endif; ?> >无论是否付款都打印</label>
		</div>
		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info"	 value="保存">保存</button>
			<input  name="pigcms_id"  type="hidden" value="<?php echo ($pigcms_id); ?>"/>	
		</form>

	</div>
	<script>
		function checkSubmit2(){
			//alert($("input[name='count']").val());
		var message = "请正确填写以下信息:<br>";

		if($("input[name='mcode']")[0] && $("input[name='mcode']").val() == ''){
			message += '终端号<br>';
		}
		if($("input[name='username']")[0] && $("input[name='username']").val() == ''){
			message += '绑定账号<br>';
		}
		if($("input[name='mkey']")[0] && $("input[name='mkey']").val() == ''){
			message += '密钥<br>';
		}
		if($("input[name='mp']")[0] && ($("input[name='mp']").val() == '' || !checkMobile($("input[name='mp']").val()))){
			message += '终端手机号<br>';
		}
		if(message != "请正确填写以下信息:<br>"){
			alert_open(message);
			return false;
		}else{
			hardware_add();
			return false;
		}
	}
	</script>
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