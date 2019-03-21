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
<style>
.green{color:green;}
.btn{
margin: 0;
text-align: center;
height: 2.2rem;
line-height: 2.2rem;
padding: 0 .32rem;
border-radius: .3rem;
color: #fff;
border: 0;
background-color: #FF658E;
font-size: .28rem;
vertical-align: middle;
box-sizing: border-box;
cursor: pointer;
-webkit-user-select: none;}
.totel{color: green;}
.cpbiaoge td{font-size:1rem;}
#pigcms-header-left {font-size: 30px;}
</style>
<body>
	<!--头部结束-->
	<header class="pigcms-header mm-slideout">
		<a href="/index.php?g=WapMerchant&c=Index&a=morder" id="pigcms-header-left" class="iconfont icon-left">
		</a>			
		<p id="pigcms-header-title">订单详情</p>
		<!--<a id="pigcms-header-right">操作日志</a>-->
	</header>
	<link href="<?php echo ($static_path); ?>css/diancai.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div style="padding: 0.2rem;"> 
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
				<tr>
					<td>顾客姓名：<?php echo ($order["name"]); ?></td>
				</tr>
				<tr>
					<td>顾客电话：<a href="tel:<?php echo ($order["phone"]); ?>" class="totel"><?php echo ($order["phone"]); ?></a></td>
				</tr>
				<tr>
					<td>订单金额： <span class="price">￥<?php echo ($order['price']); ?></span></td>
				</tr>
				<tr>
					<td>订单状态：
					  <?php if($order['status'] == 3): ?><span class="red">已取消并退款</span>
						<?php elseif(empty($order['third_id']) AND ($order['pay_type'] == 'offline')): ?>
							<span class="red">线下未支付</span>
						<?php elseif($order['paid'] == 0): ?>
							<span class="red">未付款</span>
						<?php else: ?>
							<span class="green">已付款</span><?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>下单时间： <?php echo (date("Y-m-d H:i:s",$order["dateline"])); ?></td>
				</tr>
				<tr>
					<td>客户地址： <?php echo ($order["address"]); ?></td>
				</tr>
				<tr>
					<td>客户留言： <?php echo ($order["note"]); ?></td>
				</tr>
				<tr>
				  <td>支付方式： <?php echo ($order["paytypestr"]); ?></td>
				</tr>
			<?php if(!empty($now_order['use_time'])): ?><tr>
					<td><?php if($order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间： <?php echo (date('Y-m-d H:i:s',$order["use_time"])); ?></td>
				</tr>
				<tr>
					<td>操作店员： <?php echo ($order["last_staff"]); ?></td>
				</tr><?php endif; ?>
				<?php if($order['status'] == 0): ?><tr id="xfstatus">
							<td>消费状态：
								<span class="red">未消费</span>	
								<!--<form enctype="multipart/form-data" method="post" action="">
								<div><input name="status" value="1" type="hidden">
								<button id="merchant_remark_btn" class="submit" style="padding: 5px;margin: 12px auto;margin-top: 25px;background-color:#FF658E;border:1px solid #FF658E">确认消费</button>
								<span class="form_tips" style="color: red">
								注：改成已消费状态后同时如果是未付款状态则修改成线下支付已支付，状态修改后就不能修改了	
								</span>
								</div>
								</form>-->
							</td>
						
					</tr>
				<?php elseif($order['status'] == 1 OR $order['status'] == 2): ?>
					<tr>
						<td>是否已消费：<span class="green"> 已消费</span></td>
					</tr><?php endif; ?>
			</tbody>
		</table>
	</ul>
	<a href="<?php echo U('Storestaff/meal_list');?>" class="btn" style="float:right;right:1rem;top:0.2rem;position:absolute;width:5rem;font-size:1rem;">返 回</a>
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
				<tr>
					<th>菜品名称</th>
					<th class="cc">单价</th>
					<th class="cc">购买份数</th>
					<th class="rr">价格</th>
				</tr>
				<?php if(is_array($order['info'])): $i = 0; $__LIST__ = $order['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($info['name']); ?></td>
					<td class="cc"><?php echo ($info['price']); ?></td>
					<td class="cc"><?php echo ($info['num']); ?></td>
					<td class="rr">￥<?php echo ($info['num'] * $info['price']); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<tr>
					<td>商品总价</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr">￥<?php echo ($order['price']); ?></td>
				</tr>
				<!-- <tr>
					<td>配送费</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr">￥1.00</td>
				</tr> -->
				<tr>
					<td>总计</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr"><span class="price">￥<?php echo ($order['price']); ?></span></td>
				</tr>
			</tbody>
		</table>
	</ul>
</div>

<!--<div class="footReturn">
	<div class="clr"></div>
	<div class="window" id="windowcenter">
		<div id="title" class="wtitle">操作成功<span class="close" id="alertclose"></span></div>
		<div class="content">
			<div id="txt"></div>
		</div>
	</div>
</div>--->

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