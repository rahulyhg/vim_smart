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
<body>
	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop.css">
	<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_info.css">
	<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=Y7IBZ-W6WWJ-PP6FF-FPFGD-ES3JF-YNFPN"></script>
	<style>
		.top-img-container{
			padding-bottom: 0;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		.top-img-container .pigcms-form-title2{
			float: left;
			width: auto;
			line-height: 60px;
		}
		.up-load-img{
			float:right;
			width: 60px;
			height: 60px;
			margin:0 4% 0 0;
			text-align: center;
		}
		.up-load-img img{
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		#big-pic{
			width: 110px;
			height: 50px;
			border-radius: 0!important;
		}
		#big-pic img{border-radius: 0!important;}
		.form_tips{color:red;}
		.radio{margin: 0 3%;padding-top: 13%; padding-bottom:1%; width: 92%;line-height: 20px!important;background-color: #FFF;}
		#choose_area{margin-right: 2%;width: 15%;padding-left: 2%; float:left;}
		#choose_circle{width: 18%;float:left;}
		#choose_province{width: 12%;float:left; margin-right:2%;}
		#choose_city{width: 12%;float:left; margin-right:2%;}
	</style>
	<header class="pigcms-header mm-slideout">
		<a href="#slide_menu" id="pigcms-header-left">
				<i class="iconfont icon-menu "></i>
		</a>
	   <p id="pigcms-header-title">店铺管理</p>
	</header>
	<div class="container container-fill" >
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
	<form class="pigcms-form" method="post" action="" onSubmit="return checkSubmit();">
		<div class="pigcms-container">
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>店铺名称</p>
			<input type="text" class="pigcms-input-block3" name="name" placeholder="请输入店铺名称" value="<?php echo ($store['name']); ?>" >
		</div>

		   		<div class="pigcms-container"><p class='pigcms-form-title2'>是否设置成主店</p>
				<div class="radio">
					<label>
						<input type="radio" name="ismain" value="1" <?php if($store['ismain'] == 1): ?>checked="checked"<?php endif; ?>>
						<span class="lbl" style="z-index: 1">是</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label>
						<input type="radio" name="ismain" value="0" <?php if($store['ismain'] != 1): ?>checked="checked"<?php endif; ?>>
						<span class="lbl" style="z-index: 1">否</span>
					</label><div style="clear:both"></div>
				<span class="pigcms-input-block5">如果将此店铺设置成主店，系统将自动取消其他已设置的主店</span>
				<div style="clear:both"></div>
				</div>
				
		</div>

		<div class="pigcms-container">
			<p class='pigcms-form-title2'>联系电话</p>
			<input type="tel" class="pigcms-input-block3" name="phone" placeholder="请输入店铺联系电话" value="<?php echo ($store['phone']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>联系微信</p>
			<input type="text" class="pigcms-input-block3" name="weixin" placeholder="请输入店铺联系微信" value="<?php echo ($store['weixin']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>联系Q Q</p>
			<input type="text" class="pigcms-input-block3" name="qq" placeholder="请输入店铺联系QQ" value="<?php echo ($store['qq']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'> 关键词</p>
			<input type="text" class="pigcms-input-block3" name="keywords" placeholder="请输入关键词" value="<?php echo ($store['keywords']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'> 人均消费</p>
			<input type="tel" class="pigcms-input-block3" name="permoney" placeholder="请输入人均消费额" value="<?php echo ($store['permoney']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>店铺特色</p>
			<input type="text" class="pigcms-input-block3" name="feature" placeholder="请输入店铺特色" value="<?php echo ($store['feature']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>店铺所在地</p>
			<div id="choose_cityarea" province_id="<?php echo ($store["province_id"]); ?>" city_id="<?php echo ($store["city_id"]); ?>" area_id="<?php echo ($store["area_id"]); ?>" circle_id="<?php echo ($store["circle_id"]); ?>"></div>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>详细地址</p>
			<input type="text" class="pigcms-input-block3" name="adress" placeholder="请输入店铺详细地址" value="<?php echo ($store['adress']); ?>" >
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container">
				<p class='pigcms-form-title2'><label for="trafficroute">交通路线</label></p>
				<input class="pigcms-input-block3" name="trafficroute" id="trafficroute" type="text" value="<?php echo ($store["trafficroute"]); ?>"/>
				<div style="clear:both"></div>
				<span class="pigcms-input-block6">简单描述本店交通路线80字以内</span>
			</div>
			<div class="pigcms-container">
				<p class='pigcms-form-title2'><label for="sort">店铺排序</label></p>
				<input class="pigcms-input-block3" size="10" name="sort" id="sort" type="text" value="<?php echo ($store["sort"]); ?>" />
				<div style="clear:both"></div>
				<span class="pigcms-input-block6">默认添加顺序排序！手动调值，数值越大，排序越前</span>
			</div>
		<?php if($config['store_open_meal']): ?><div class="pigcms-container">
				<p class='pigcms-form-title2'><?php echo ($config["meal_alias_name"]); ?></p>
				<select name="have_meal" id="have_meal" class="pigcms-input-block3">
					<option value="0" <?php if($store['have_meal'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
					<option value="1" <?php if($store['have_meal'] == 1): ?>selected="selected"<?php endif; ?>>开启</option>
				</select>
				<div style="clear:both"></div>
			</div><?php endif; ?>
		<?php if($config['store_open_meal']): ?><div class="pigcms-container">
				<p class='pigcms-form-title2'><?php echo ($config["meal_alias_name"]); ?>类型</p>
				<select name="store_type" id="store_type" class="pigcms-input-block3">
					<option value="0" <?php if($store['store_type'] == 0): ?>selected="selected"<?php endif; ?>>订餐和外卖</option>
					<option value="1" <?php if($store['store_type'] == 1): ?>selected="selected"<?php endif; ?>>订餐</option>
					<option value="2" <?php if($store['store_type'] == 2): ?>selected="selected"<?php endif; ?>>其他</option>
				</select>
				<div style="clear:both"></div>
				<span class="pigcms-input-block6">【其他】是指（外卖，超市，花店...）</span>
			</div><?php endif; ?>
		<?php if($config['store_open_group']): ?><div class="pigcms-container">
				<p class='pigcms-form-title2'><?php echo ($config["group_alias_name"]); ?></p>
				<select name="have_group" id="have_group" class="pigcms-input-block3">
					<option value="0" <?php if($store['have_group'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
					<option value="1" <?php if($store['have_group'] == 1): ?>selected="selected"<?php endif; ?>>开启</option>
				</select>
				<div style="clear:both"></div>
			</div><?php endif; ?>

		<div class="pigcms-container" style="position:relative;height:64px">
			<p class="pigcms-form-cw">营业时间&nbsp;&nbsp;&nbsp;<span class="form_tips">可一次设置三段时间</span></p>
			<select name="office_start_time" class="pigcms-input">
			</select>
			<span style="position:absolute;left:50%;margin-left:-7px;line-height:40px;font-size:14px;">至</span>
			<select name="office_stop_time" class="pigcms-input">
			</select>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container" style="position:relative;height:42px">
			<select name="office_start_time2" class="pigcms-input">
			</select>
			<span style="position:absolute;left:50%;margin-left:-7px;line-height:40px;font-size:14px;">至</span>
			<select name="office_stop_time2" class="pigcms-input">
			</select>
			<div style="clear:both"></div>
		</div>
		<div class="pigcms-container" style="position:relative;height:42px">
			<select name="office_start_time3" class="pigcms-input">
			</select>
			<span style="position:absolute;left:50%;margin-left:-7px;line-height:40px;font-size:14px;">至</span>
			<select name="office_stop_time3" class="pigcms-input">
			</select>
			<div style="clear:both"></div>
		</div>

		<div class="pigcms-container" >
			<p class='pigcms-form-title2'>地图位置</p>
			<div id="location" onClick="open_map()">
				<i class="iconfont icon-location"></i>
				<span>点击设置店铺地图位置</span>
			</div>
			<input type="hidden" name='lat' value="<?php echo ($store['lat']); ?>">
			<input type="hidden" name='long' value="<?php echo ($store['long']); ?>">
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-few'>店铺简介</p>
			<textarea class="pigcms-textarea" name="txt_info" id="txt_info" cols="20" rows="3" placeholder="" ><?php echo ($store['txt_info']); ?></textarea>
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title2'>店铺图片</p>
			<div class="pic-detail-container">
				<div class="detail-img" id='detail-img-add' onClick="upLoadDetailImg()">
					<i class="iconfont icon-upload"></i>
					<p>添加图片</p>
				</div>
				<input type="hidden" name='pic_detail'>
				<input type="hidden" name='store_id' value="<?php echo ($store['store_id']); ?>">
				<div class="clearfix"></div>
			</div>
		</div>
		
		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit">保存</button>
		<div id="map-layer">
			<div id="map-header">
				<div id="map-cancel">关闭</div>
				<div id="map-title2">标注位置</div>
				<div id="map-confirm">确定</div>
			</div>
			<div id="map"></div>
		</div>
	</form>
 </div>
	<script src="<?php echo ($static_path); ?>js/wgs2mars.min.js"></script>
	<script>
		var picarr = [<?php echo ($store['picstr']); ?>];

		var container = 'browser',
			lat = $("[name='lat']").val() ? $("[name='lat']").val() : '0.000000',
			lng = $("[name='long']").val() ? $("[name='long']").val() : '0.000000',
			center = new qq.maps.LatLng(lat, lng),
			shop_latlng = center,
			pic_detail = [],
			address_detail,
			attachurl = "<?php echo ($site_URl); ?>",
			upLoadImg_url = "<?php echo U('Index/img_uplode');?>";
		    $("input[name='pic_detail']").val("<?php echo ($store['pic_info']); ?>");
	</script>
	<script src="<?php echo ($static_path); ?>js/shop_info_img.js?ver=<?php echo time(); ?>"></script>
	<script src="<?php echo ($static_path); ?>js/shop_info_location.js"></script>
	<script type="text/javascript">
	 var  start_time ="<?php echo ($store['office_time']['0']['open']); ?>";
	 var  stop_time ="<?php echo ($store['office_time']['0']['close']); ?>";
	 var  start_time2 ="<?php echo ($store['office_time']['1']['open']); ?>";
	 var  stop_time2 ="<?php echo ($store['office_time']['1']['close']); ?>";
	 var  start_time3 ="<?php echo ($store['office_time']['2']['open']); ?>";
	 var  stop_time3 ="<?php echo ($store['office_time']['2']['close']); ?>";

	function select_time(timestr,domid) {
		var h = 0,
		m = 0;
		var optionstr='';
		for (var i = 0; i < 48; i++) {
			var M;
			if (m == 0) {
				M = '00';
			} else {
				M = m;
			}
			var hsr= h<10 ? "0"+h : h;
			var time = hsr + ' : ' + M;
			var vtime = hsr + ':' + M;
			if(timestr==vtime){
			   optionstr = "<option value='" + vtime + "' selected='selected'>" + time + "</option>";
			}else{
			   optionstr = "<option value='" + vtime + "'>" + time + "</option>";
			}
			$(optionstr).appendTo("select[name='"+domid+"']");
			m += 30;
			if (m == 60) {
				m = 0;
				h++;
			}
		};
	}
	select_time(start_time,'office_start_time');
	select_time(stop_time,'office_stop_time');
	select_time(start_time2,'office_start_time2');
	select_time(stop_time2,'office_stop_time2');
	select_time(start_time3,'office_start_time3');
	select_time(stop_time3,'office_stop_time3');
	</script>
	<script type="text/javascript">
  var static_public="<?php echo ($static_public); ?>",choose_province="/merchant.php?g=Merchant&c=Area&a=ajax_province",choose_city="/merchant.php?g=Merchant&c=Area&a=ajax_city",choose_area="/merchant.php?g=Merchant&c=Area&a=ajax_area",choose_circle="merchant.php?g=Merchant&c=Area&a=ajax_circle";
</script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/area.js"></script>

	
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