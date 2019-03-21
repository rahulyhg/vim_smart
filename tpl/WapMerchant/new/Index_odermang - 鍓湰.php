<!DOCTYPE html>
<html lang="zh-cn"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>小铺铺 - 商家微信版</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="keywords" content="移动电子商务,网上开店,免费开店,微购物,同城生活">
	<meta name="description" content="{小铺铺是一款全新的移动电子商务软件，商家免费网上开店，一键开店，直通微信顾客。智能后台管理店铺、人员与订单，支付安全便捷，更可入驻公众号，服务同城客流。">
	
	<link type="text/css" rel="stylesheet" href="pigcmsodermang_files/jquery.css">
	<link href="pigcmsodermang_files/style.css" rel="stylesheet">
	<link href="pigcmsodermang_files/iconfont.css" rel="stylesheet">
	<script src="pigcmsodermang_files/jweixin-1.js"></script>
	<script src="pigcmsodermang_files/require.js"></script>
	<script src="pigcmsodermang_files/config.js"></script>
	<script type="text/javascript" src="pigcmsodermang_files/jquery-1.js"></script>
	<script type="text/javascript" src="pigcmsodermang_files/jquery.js"></script>
	<script type="text/javascript" src="pigcmsodermang_files/checkSubmit.js"></script>
	<script type="text/javascript">
	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
		window.sysinfo = {
		'uniacid': '1',
		'openid': 'oyshZsw8222emgA-SGTfGjZidSbw',
		'siteroot': 'http://www.xiaopupu.com/',
		'siteurl': 'http://www.xiaopupu.com/wx/index.php?i=1&c=pu&a=shop_order&',
		'attachurl': 'http://static.xiaopupu.com/attachment/',
		'cookie' : {'pre': '626f_'}
	};
	
	// jssdk config 对象
	jssdkconfig = {"appId":"wx7a5c555e1f6b56bf","nonceStr":"7aWDZJowqpVatFf3","timestamp":"1437387435","signature":"28f27aacf097c05d4cf05758b8e522946ae84406","url":"http:\/\/www.xiaopupu.com\/wx\/index.php?i=1&c=pu&a=shop_order&","string1":"jsapi_ticket=52Tw1_qSfGvjmabRE6VHqXDikPcUCRr5zR2M-_3-aMsYZmAB7PzAs7azQP07rBZkCIJk78o2D2dADFy1boDLjw&noncestr=7aWDZJowqpVatFf3&timestamp=1437387435&url=http:\/\/www.xiaopupu.com\/wx\/index.php?i=1&c=pu&a=shop_order&","name":"\u5c0f\u94fa\u94fa"} || {};
	
	// 是否启用调试
	jssdkconfig.debug = false;
	
	jssdkconfig.jsApiList = [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'hideMenuItems',
		'showMenuItems',
		'hideAllNonBaseMenuItem',
		'showAllNonBaseMenuItem',
		'translateVoice',
		'startRecord',
		'stopRecord',
		'onRecordEnd',
		'playVoice',
		'pauseVoice',
		'stopVoice',
		'uploadVoice',
		'downloadVoice',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getNetworkType',
		'openLocation',
		'getLocation',
		'hideOptionMenu',
		'showOptionMenu',
		'closeWindow',
		'scanQRCode',
		'chooseWXPay',
		'openProductSpecificView',
		'addCard',
		'chooseCard',
		'openCard'
	];
	
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
	wx.ready(function () {
		wx.hideOptionMenu();
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
<body><div class="mm-menu mm-horizontal mm-offcanvas" id="slide_menu"><header class="pigcms-slide-header">
						<a id="pigcms-slide-left"><i class="iconfont icon-set"></i></a>
						<p id="pigcms-slide-title">15956974877</p>
						<a id="pigcms-slide-right">
							<i class="iconfont icon-mail "></i>
						</a>
						<div id="user-info">
														<img src="pigcmsodermang_files/rw1Az1jaR3zeaz7U1hAqHZEz3JwU3Q.jpg" alt="" id="shop-img" onerror="this.src='http://static.xiaopupu.com/wx/resource/images/pu/pigcms-logo-01.png'">
							<div id="shop-detail-container">
								<p id="shop-balance">余额<span>0.00</span>元</p>
								 <div id="shop-order-container">
								 	<div class="order-container">
								 		<p class="order-count" id="all-order-count">0</p>
								 		<p class="order-text">全部订单</p>
								 	</div>
								 	<div class="order-container">
								 		<p class="order-count" id="today-order-count">0</p>
								 		<p class="order-text">今日订单</p>
								 	</div>
								 	<div class="order-container">
								 		<p class="order-count" id="month-order-count">0</p>
								 		<p class="order-text">本月订单</p>
								 	</div>
								 </div>
							</div>
						</div>
					</header><footer style="top: 711px;" class="pigcms-slide-footer">
						<a id="order-list">
							<i class="iconfont icon-form "></i>
							<span>所有店铺订单</span>
						</a>
						<a id="shop-list">
							<i class="iconfont icon-file2"></i> 
							<span>店铺列表</span>
						</a>
						<div class="clearfix"></div>
					</footer><script>
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
					</script><ul style="height: 741px;" id="mm-0" class="mm-list mm-panel mm-opened mm-current">
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_info&amp;"><i class="iconfont icon-home"></i>dddddd</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_info&amp;do=edit&amp;"><i class="iconfont icon-shop"></i>店铺管理</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_order&amp;"><i class="iconfont icon-form"></i>订单管理</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_item&amp;"><i class="iconfont icon-goods"></i>商品管理</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_staff&amp;"><i class="iconfont icon-friends"></i>店员管理</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_apply&amp;do=receive&amp;"><i class="iconfont icon-iconfontwechat"></i>入驻公众号</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_wallet&amp;"><i class="iconfont icon-recharge"></i>资金管理</a></li>
						<li>
							<a class="mm-subopen"></a>
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_info&amp;do=printer&amp;"><i class="iconfont icon-printer"></i>打印机管理</a></li>

						<li style="display:none">
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop_info&amp;do=settings&amp;" id="shop-settings-li"></a></li>	
						<li style="display:none">
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=staff&amp;a=message&amp;" id="staff-message-li"></a></li>
						<li style="display:none">
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=shop&amp;" id="shop-list-li"></a></li>
						<li style="display:none">
							<a href="#" onclick="jumpLink(this)" data-href="./index.php?i=1&amp;c=pu&amp;a=order&amp;" id="order-list-li"></a></li>
					</ul></div>
	
		<header class="pigcms-header mm-slideout">
									<a href="#slide_menu" id="pigcms-header-left">
					<i class="iconfont icon-menu "></i>
				</a>
						
				<p id="pigcms-header-title">订单管理</p>
				<a href="javascript:window.location.reload();" id="pigcms-header-right">刷新</a>
			</header>
	<div class="container container-fill mm-page mm-slideout" style="padding-top:50px">


			
		<link rel="stylesheet" href="pigcmsodermang_files/shop_order.css">
<script type="text/javascript" src="pigcmsodermang_files/iscroll.js"></script>
<script>
	var url = "./index.php?i=1&c=pu&a=shop_order&";
</script>
	<script>
		$(function(){
			$(".pigcms-main").css('height', $(window).height()-130);
		})
	</script>
	<div class="order-list-wrap">
		<div class="pigcms-container">
			<div class="search-container">
				<i class="iconfont icon-search"></i>
				<input class="pigcms-search" name="keyword" placeholder=" 客户姓名 / 联系电话" type="text">
			</div>
			<div class="header-fliter-container" id="fliter-active">
				<div class="header-fliter">
					<span>全部订单</span><i class="iconfont icon-unfold"></i>
				</div>
			</div>
			<div style="display: none;" id="fliter-layer">
				<div>
					<div style="overflow: hidden;" id="fliter-wrapper">
						<div style="transition-property: transform; transform-origin: 0px 0px 0px; transform: translate(0px, 0px) translateZ(0px);" id="fliter-scroller">
							<ul id="fliter-ul">
								<li class="header-fliter-container" id="fliter-clear">
									<div class="header-fliter">
										<span data-status="">全部订单</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="0">待接单</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="1">已接单</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="2">配送中</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="3">配送完成</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="4">已完成</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="5">已评价</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="6">待付款</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="98">订单超时</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="99">订单放弃</span>
									</div>
								</li>
								<li class="header-fliter-container">
									<div class="header-fliter">
										<span data-status="100">订单取消</span>
									</div>
								</li>
							</ul>
						</div>
					<div style="position: absolute; z-index: 100; width: 7px; bottom: 2px; top: 2px; right: 1px; pointer-events: none; transition-property: opacity; overflow: hidden; opacity: 1;"><div style="position: absolute; z-index: 100; background: rgba(0, 0, 0, 0.5) none repeat scroll 0% 0% padding-box; border: 1px solid rgba(255, 255, 255, 0.9); box-sizing: border-box; width: 100%; border-radius: 3px; pointer-events: none; transition-property: transform; transition-timing-function: cubic-bezier(0.33, 0.66, 0.66, 1); transform: translate(0px, 0px) translateZ(0px); height: 52px;"></div></div></div>
				</div>
				<div style="height: 741px;" id="fliter-close"></div>
			</div>
		</div>

		<div style="height: 761px; overflow: hidden;" id="order-list-wrapper" class="pigcms-main">
			<div style="transition-property: transform; transform-origin: 0px 0px 0px; transform: translate(0px, 0px) translateZ(0px);" id="order-list-scroller">
				<ul id="order-list-ul">
					<!-- <div class="pigcms-container" style="background:none;position:relative;height:20px;padding-top:0">
						<p id="status-container">
							<i class="iconfont icon-shuaxin1"></i>
							<span>未开启自动接单</span>
													</p>
						<label class='settings-icon'>
							<input type="checkbox" class="ios-switch green tinyswitch" />
							<div>
								<div>
								</div>
							</div>
						</label>
						<script>
												var on = false;
						
						$(".settings-icon").click(function(event) {
							$this = $(this);
							if(on){
								var shop_url = "./index.php?i=1&c=pu&a=shop_info&do=auto_accepting_order_off&";
								$.post(shop_url, '', function(data) {
									on = false;
									$("#status-container span").text("未开启自动接单");
								});
							}else{
								var shop_url = "./index.php?i=1&c=pu&a=shop_info&do=auto_accepting_order_on&";
								$.post(shop_url, '', function(data) {
									on = true;
									$("#status-container span").text("自动接单中...");
								});
							}
						});
					</script>
					</div> -->
				</ul>
			</div>
		</div>
	</div>
	<script>
		var myScroll_fliter;
		function loaded() {
			myScroll_fliter = new iScroll('fliter-wrapper',{hideScrollbar:false});
			$(".header-fliter-container").eq(0).trigger('click');
		}
		document.addEventListener('touchmove', function(e) {
			e.preventDefault();
		}, false);
		document.addEventListener('DOMContentLoaded', loaded, false);

	</script>
	<script src="pigcmsodermang_files/shop_order.js"></script>
	</div>

	<script type="text/javascript">
	
	wx.config(jssdkconfig);
	var $_share = null;
	
	if(typeof sharedata == 'undefined'){
		sharedata = $_share;
	} else {
		sharedata['title'] = sharedata['title'] || $_share['title'];
		sharedata['desc'] = sharedata['desc'] || $_share['desc'];
		sharedata['link'] = sharedata['link'] || $_share['link'];
		sharedata['imgUrl'] = sharedata['imgUrl'] || $_share['imgUrl'];
	}
	
	function tomedia(src) {
		if(typeof src != 'string')
			return '';
		if(src.indexOf('http://') == 0 || src.indexOf('https://') == 0) {
			return src;
		} else if(src.indexOf('../addons') == 0 || src.indexOf('../attachment') == 0) {
			src=src.substr(3);
			return window.sysinfo.siteroot + src;
		} else if(src.indexOf('./resource') == 0) {
			src=src.substr(2);
			return window.sysinfo.siteroot + 'app/' + src;
		} else if(src.indexOf('images/') == 0) {
			return window.sysinfo.attachurl+ src;
		}
	}
	
	if(sharedata.imgUrl == ''){
		var _share_img = $('body img:eq(0)').attr("src");
		if(_share_img == ""){
			sharedata['imgUrl'] = window.sysinfo.attachurl + 'images/global/wechat_share.png';
		} else {
			sharedata['imgUrl'] = tomedia(_share_img);
		}
	}
	
	if(sharedata.desc == ''){
		var _share_content = _removeHTMLTag($('body').html());
		if(typeof _share_content == 'string'){
			sharedata.desc = _share_content.replace($_share['title'], '')
		}
	}
	
	wx.ready(function () {

		wx.onMenuShareAppMessage(sharedata);
		wx.onMenuShareTimeline(sharedata);
		wx.onMenuShareQQ(sharedata);
		wx.onMenuShareWeibo(sharedata);
	});
	
	</script>
	


<div id="mm-blocker" class="mm-slideout"></div></body></html>