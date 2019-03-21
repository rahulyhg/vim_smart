<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
<body>	<header class="pigcms-header mm-slideout">	  <a href="#slide_menu" id="pigcms-header-left">			<i class="iconfont icon-menu "></i>	  </a>	<p id="pigcms-header-title">我的店</p>	</header>	<!--左侧菜单-->	<div class="container container-fill" style='padding-top:50px'>

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

</div>	<!--左侧菜单结束-->	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop.css">	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_index.css">	<div class="pigcms-main">	 <?php if(!empty($wap_MerchantAd)): ?><script src="<?php echo ($static_path); ?>js/swipe.js"></script>	    <div class="pigcms-container">		   <div class="addWrap">	          <div class="swipe" id="mySwipe">	             <div class="swipe-wrap">				 <?php if(is_array($wap_MerchantAd)): $i = 0; $__LIST__ = $wap_MerchantAd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adv): $mod = ($i % 2 );++$i;?><div>		               <a href="<?php echo ($adv['url']); ?>">		                <img class="img-responsive" src="<?php echo ($adv['pic']); ?>"  alt="<?php echo ($adv['name']); ?>"/>		                </a>		               </div><?php endforeach; endif; else: echo "" ;endif; ?>	             </div>	            </div>	        <div id="position_wrap">	           <ul id="position">	           </ul>	       </div>	  </div>		<script type="text/javascript">			var banner_w = $(window).width();			var banner_h = 200 * banner_w / 640;			$(".img-responsive").css('height',banner_h);			for(var i=0;i<$(".img-responsive").length;i++){				$("<li class=''></li>").appendTo('#position');			}			$("#position li:first").addClass('cur');			var bullets = document.getElementById('position').getElementsByTagName('li');			var banner = Swipe(document.getElementById('mySwipe'), {				auto: 4000,				continuous: true,				disableScroll: false,				callback: function(pos) {					var i = bullets.length;					while (i--) {						bullets[i].className = ' ';					}					bullets[pos].className = 'cur';				}			});		</script>		</div><?php endif; ?>		<!--<div class="pigcms-container" style="position:relative;height:40px">			<p id="status-container">				<i class="iconfont icon-notification"></i>				<span style='color:#fe7d54'>暂停营业中...</span>			</p>			<a id="confirm-close" href="."></a>			<label class='settings-icon'>			<input type="checkbox" class="ios-switch green tinyswitch" />				<div>					<div>					</div>				</div>			</label>		</div>-->		<div class="pigcms-container" style="background:#fff;margin-bottom:15px;">			<a class="index-btn" id='open-code'>				<i class="iconfont icon-code"  style="color:#aedda9"></i>				<p>扫一扫</p>			</a>			<a class="index-btn" id='open-item'>				<i class="iconfont icon-goods" style="color:#ff9f70"></i>				<p>商品管理</p>			</a>			<a class="index-btn" id='open-order'>				<i class="iconfont icon-form " style="color:#37dddf"></i>				<p>订单管理</p>			</a>			<a class="index-btn" id='open-menu'>				<i class="iconfont icon-menu" style="color:#ff7a88"></i>				<p>更多功能</p>			</a>			<div class="clearfix"></div>		</div>		<div class="pigcms-container" id="count-container">			<div class="index-count-container" id="order-count-container" style="background:#bbdb9c" onclick="chart_ajax('order');">				<div class="index-count">					<p class="count-text" id='order-all'><?php echo ($allordercount); ?></p>					<p class="count-title">订单总数</p>				</div>			</div>			<div class="index-count-container" id="income-count-container" style="background:#7cd6de" onclick="chart_ajax('income');">				<div class="index-count">					<p class="count-text" id='income-all'><?php echo ($allincomecount['actualall']); ?></p>					<p class="count-title">交易总金额</p>				</div>			</div>			<div class="index-count-container" id="member-count-container" style="background:#ffae6c" onclick="chart_ajax('member');">				<div class="index-count">					<p class="count-text" id='member-all'><?php echo ($allincomecount['coupon']); ?>					</p>					<p class="count-title">优惠金额</p>				</div>			</div>			<div class="index-count-container" id="income-count-container" style="background:#ff8283" onclick="chart_ajax('view');">				<div class="index-count">					<p class="count-text" id='view-all'><?php echo ($allincomecount['payall']); ?></p>					<p class="count-title">实际收入金额</p>				</div>			</div>			<div class="clearfix"></div>		</div>		<div class="pigcms-container" id='canvas-container'>			<div id="canvas-layer"></div>			<p id='canvas-title'></p>			<canvas id="myChart" style="width:100%!important;"></canvas>		</div>		<!--<div id="index-footer" class='mm-slideout'>			<a class="shop-link" href="<?php echo U('Index/index',array('token'=>$merid));?>">				<i class="iconfont icon-shop link-icon"></i>				<p>预览店铺</p>			</a>			<a class="shop-link" id='qrcode'>				<i class="iconfont icon-code link-icon"></i>				<p></p>			</a>			<a class="shop-link share-copy-link" id='share-link'>				<i class="iconfont icon-share link-icon"></i>				<p>分享店铺</p>			</a>			<a class="shop-link share-copy-link" id='copy-link'>				<i class="iconfont icon-link link-icon"></i>				<p>复制链接</p>			</a>			<div class="clearfix"></div>		</div>-->	</div>	<div id="share-copy-wrap">		<img src="<?php echo ($static_path); ?>/images/android_share.png" id='android-share-img'>		<img src="<?php echo ($static_path); ?>/images/android_copy.png" id='android-copy-img'>		<img src="<?php echo ($static_path); ?>/images/ios_share.png" id='ios-share-img'>		<img src="<?php echo ($static_path); ?>/images/ios_copy.png" id='ios-copy-img'>		<img src="<?php echo ($static_path); ?>/images/qrcode.png" id='qrcode-img'>	</div>	</div></body> <script type="text/javascript">	 $("#open-code").click(function(e){//		 alert("234234");		 setTimeout(function(){			 if(motify.checkWeixin()){				 motify.log('正在调用二维码功能');				 wx.scanQRCode({					 desc:'scanQRCode desc',					 needResult:0,					 scanType:["qrCode"],					 success:function (res){						 // alert(res);					 },					 error:function(res){						 motify.log('微信返回错误！请稍后重试。',5);					 },					 fail:function(res){						 motify.log('无法调用二维码功能');					 }				 });			 }else{				 motify.log('您不是微信访问，无法使用二维码功能');			 }		 },500)//		 e.preventDefault();	 })			var os = "windows",			container = "web",			chart_url = "<?php echo U('Index/getchart');?>",			pic_url = "" ? "" : "";</script>	<script src="<?php echo ($static_path); ?>/js/chart.min.js"></script>    <script src="<?php echo ($static_path); ?>/js/shop_index.js"></script>	<script type="text/javascript">		var on = false;		$(".settings-icon").click(function(event) {		$this = $(this);		if(!on){			var url = "";			$.post(url, '', function(data) {				on = true;				$("#confirm-close").show();				$("#status-container span").text("店铺正常营业中").css('color','#696969');			});					}	});		</script>	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>

</html>