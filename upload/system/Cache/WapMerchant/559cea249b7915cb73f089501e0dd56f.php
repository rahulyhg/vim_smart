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
	<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop.css">
	<link rel="stylesheet" href="<?php echo ($static_path); ?>/css/shop_info.css">
	<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=Y7IBZ-W6WWJ-PP6FF-FPFGD-ES3JF-YNFPN"></script>
	<style>
		.top-img-container{
			padding-bottom: 0;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		.top-img-container .pigcms-form-title{
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
		.radio{margin: 0 3%;padding: 5px 0; width: 92%;line-height: 20px!important;}
		.radio2{margin: 0 3%;padding: 5px 0; line-height: 20px!important; float:left;}
		#choose_area{margin-right: 30px;width: 35%;padding-left: 20px;}
		#choose_circle{width: 45%;padding-left: 20px;}
		#perioddeliveryfeebox{margin:10px;height:auto;}
		.perioddeliveryfeeitem{margin:10px 0px;}
		.pigcms-input-block{display:inline-block;width: 75%;}
		.pigcms-container{margin-bottom: 10px;}
		.pigcms-textarea{width: 85%;margin-bottom: 20px;}
		
		.pigcms-form-title{
	margin-top: 3%;
	margin-bottom:3%;
	margin-left:3%;
	margin-right:0;
	padding: 0 4%!important;
	width:20%;
	font-size: 13px;
	float:left;
}
.pigcms-form-titlex{
	margin-top: 3%;
	margin-bottom:3%;
	margin-left:3%;
	margin-right:0;
	padding: 0 4%!important;
	width:86%;
	font-size: 13px;
	float:left;
	line-height:2;
}

	</style>
	<header class="pigcms-header mm-slideout">
	   <a  href="<?php echo U('Index/store_list');?>" id="pigcms-header-left">返 回</a>
	   <p id="pigcms-header-title"><?php echo ($config["meal_alias_name"]); ?>信息管理</p>
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
	<form class="pigcms-form" method="post" action="<?php echo U('Index/storemeal',array('store_id'=>$now_store['store_id']));?>">
		<div class="pigcms-container">
		</div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>店铺公告</p>
			<textarea class="pigcms-textarea" rows="4" name="store_notice" id="Config_notice"><?php echo ($store_meal["store_notice"]); ?></textarea>
		</div><div style="clear:both"></div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>预订金</p>
			<input class="pigcms-input-block" size="10" maxlength="10" name="deposit" id="Config_deposit" type="text" value="<?php echo ($store_meal["deposit"]); ?>" style="float:left; width:55%;"/><span style="line-height:3;">元</span>
		</div><div style="clear:both"></div>
		<div class="pigcms-container">
			<p class='pigcms-form-title'>人均消费</p>
			<input class="pigcms-input-block" size="10" maxlength="10" name="mean_money" id="Config_mean_money" type="text" value="<?php echo ($store_meal["mean_money"]); ?>" style="float:left; width:55%;"/><span style="line-height:3;">元</span><span class="required">*</span>
		</div><div style="clear:both"></div>

		<?php if($now_store['store_type'] != 1): ?><div class="pigcms-container">

			<p class='pigcms-form-title'>起送价格</p>

			<input class="pigcms-input-block" size="10" maxlength="10" name="basic_price" id="Config_basicprice" type="text" value="<?php echo ($store_meal["basic_price"]); ?>" style="float:left; width:55%;"/><span style="line-height:3;">元</span><span class="required">*</span>
			
		</div><div style="clear:both"></div>

		<div class="pigcms-container">

			<p class='pigcms-form-title'>外送费</p>

			<input class="pigcms-input-block" size="10" maxlength="10" name="delivery_fee" id="Config_delivery_fee" type="text" value="<?php echo ($store_meal["delivery_fee"]); ?>" style="float:left; width:55%;"/><span style="line-height:3;">元</span><span class="required">*</span>
			
		</div><div style="clear:both"></div>



		<div class="pigcms-container">

			<p class='pigcms-form-title'>送达时间</p>

			<input class="pigcms-input-block" size="10" maxlength="10" name="send_time" id="Config_send_time" type="text" value="<?php echo ($store_meal["send_time"]); ?>" style="float:left; width:55%;"/><span style="line-height:3;">分钟</span>
			
		</div><div style="clear:both"></div>



		<div class="pigcms-container">

			<div class="radio">

			 <label>

				&nbsp;&nbsp;&nbsp;<input  name="delivery_fee_valid" id="Config_delivery_fee_valid" value="1" type="checkbox" <?php if($store_meal['delivery_fee_valid']): ?>checked="checked"<?php endif; ?>/>

				<span class="lbl" style="z-index: 1;"> 不足起送价格收取外送费照样送</span>

			 </label>

			</div>

		</div>

		<div class="pigcms-container">

			<p class='pigcms-form-title'>达到起<br/>送价格</p>

			<div class="radio2">

				<label>

					<input name="reach_delivery_fee_type" value="0" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 0): ?>checked="checked"<?php endif; ?>/>

					<span class="lbl" style="z-index: 1">免外送费</span>

				</label>

			</div>

			<div class="radio2">

				<label>

					<input name="reach_delivery_fee_type" value="1" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 1): ?>checked="checked"<?php endif; ?>/>

					<span class="lbl" style="z-index: 1">照样收取外送费</span>

				</label>

			</div>

			<div class="radio2">

				<label>

					<input name="reach_delivery_fee_type" value="2" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 2): ?>checked="checked"<?php endif; ?>/>

					<span class="lbl" style="z-index: 1">达到</span>

					&nbsp;&nbsp;&nbsp;<input size="10" maxlength="10" name="no_delivery_fee_value" id="Config_no_delivery_fee_value" type="text" value="<?php echo ($store_meal["no_delivery_fee_value"]); ?>" style="border: 1px solid #eee;padding-left:10px;"/><span class="lbl" style="z-index: 1"> 元免外送费</span>

				</label>

			</div>											
		</div><div style="clear:both"></div>


		

		<div class="pigcms-container">

			<p class='pigcms-form-title'>服务距离</p>

			<input class="pigcms-input-block" size="10" maxlength="10" name="delivery_radius" id="Config_delivery_radius" type="text" value="<?php echo ($store_meal["delivery_radius"]); ?>" style="float:left; width:50%;"/><span style="line-height:3;">公里</span>
		</div><div style="clear:both"></div>
		<div class="pigcms-container">

			<p class='pigcms-form-title'>配送区域</p>

			<textarea class="pigcms-textarea" rows="4" name="delivery_area" id="Config_area" style="float:left; width:55%;"><?php echo ($store_meal["delivery_area"]); ?></textarea>
		</div><div style="clear:both"></div><?php endif; ?>



		<p class='pigcms-form-title'>选择分类</p><div style="clear:both"></div>

		<?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="pigcms-container" style="width:85%; float:right;">

			<div class="radio">

				<label>

					<span class="lbl" style="color: red"><?php echo ($vo["cat_name"]); ?>：</span>

				</label>

				<?php if(is_array($vo['list'])): $i = 0; $__LIST__ = $vo['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><label>

						<input  type="checkbox" name="store_category[]" value="<?php echo ($vo["cat_id"]); ?>-<?php echo ($child["cat_id"]); ?>" id="Config_store_category_<?php echo ($child["cat_id"]); ?>" <?php if(in_array($child['cat_id'],$relation_array)): ?>checked="checked"<?php endif; ?>/>

						<span class="lbl"><label for="Config_store_category_<?php echo ($child["cat_id"]); ?>"><?php echo ($child["cat_name"]); ?></label></span>

					</label><?php endforeach; endif; else: echo "" ;endif; ?>

			</div>

		</div><?php endforeach; endif; else: echo "" ;endif; ?><div style="clear:both"></div>



        <p class='pigcms-form-title'>促销活动</p>

		<div class="pigcms-container">

			<p class='pigcms-form-titlex' style="color:red;">赠和送都是商家和消费者的线下互动，如商家赠送一些小礼品呀，购物券之类的。满、减(消费超过多少元立减多少元)，如果商家没有填写就没有这个优惠！</p>
		</div><div style="clear:both"></div>


		  

	<div class="pigcms-container">

		<p class='pigcms-form-title'>赠品</p>

		<textarea class="pigcms-textarea" rows="4" name="zeng" id="Config_zeng"><?php echo ($store_meal["zeng"]); ?></textarea>
	</div><div style="clear:both"></div>


		<div class="pigcms-container">

			<label class='pigcms-form-title'>满（金额）</label>

			<input  size="10" maxlength="10" name="full_money" id="Config_mean_full_money" type="text" value="<?php echo ($store_meal["full_money"]); ?>" style="padding-left:10px;"/> &nbsp;元
			<br/><br/><div style="clear:both"></div>


			<label class='pigcms-form-title'>减（金额）</label>

			<input size="10" maxlength="10" name="minus_money" id="Config_mean_minus_money" type="text" value="<?php echo ($store_meal["minus_money"]); ?>" style="padding-left:10px;"/> &nbsp;元
		</div><div style="clear:both"></div>


		<div class="pigcms-container">

			<p class='pigcms-form-title'>送品</p>

			<textarea class="pigcms-textarea" rows="4" name="song" id="Config_song"><?php echo ($store_meal["song"]); ?></textarea>
		</div><div style="clear:both"></div>
		</div>


		<?php if(!empty($levelarr)): ?><div id="levelcoupon" style="border:1px solid #c5d0dc;padding:0px 0px 10px 10px;margin-bottom:10px;">

		<p class='pigcms-form-title'>会员优惠</p>

			<div class="pigcms-container">

				<p class="pigcms-form-titlex" style="color:red;">说明：必须设置一个会员等级优惠类型和优惠类型对应的数值，我们将结合优惠类型和所填的数值来计算该商品会员等级的优惠的幅度！</p>
			</div><div style="clear:both"></div>

			<?php if(is_array($levelarr)): $i = 0; $__LIST__ = $levelarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="pigcms-container">

				<input  name="leveloff[<?php echo ($vv['level']); ?>][lid]" type="hidden" value="<?php echo ($vv['id']); ?>"/>

				<input  name="leveloff[<?php echo ($vv['level']); ?>][lname]" type="hidden" value="<?php echo ($vv['lname']); ?>"/>

				<p class="pigcms-form-title"><?php echo ($vv['lname']); ?>：<br/>优惠类型：&nbsp;</p>

				<select name="leveloff[<?php echo ($vv['level']); ?>][type]" style="margin-left: 10px;width: 25%; float:left; height:40px;">

					<option value="0">无优惠</option>

					<option value="1" <?php if($vv['type'] == 1): ?>selected="selected"<?php endif; ?>>百分比（%）</option>

					<!--<option value="2">立减</option>-->

				</select>
				&nbsp;&nbsp;

				<input name="leveloff[<?php echo ($vv['level']); ?>][vv]" type="text" value="<?php echo ($vv['vv']); ?>" placeholder="请填写一个优惠值数字" onKeyUp="value=value.replace(/[^1234567890]+/g,'')" style="width: 30%;padding-left:7px; float:left; margin-left:5px; height:31px;"/>

			</div><?php endforeach; endif; else: echo "" ;endif; ?><div style="clear:both"></div>

		   </div><?php endif; ?><div style="clear:both"></div>

		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit">保存</button>



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