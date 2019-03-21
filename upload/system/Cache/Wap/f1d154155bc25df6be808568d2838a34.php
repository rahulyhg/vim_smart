<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/color.css" media="all">
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/jquery_min.js"></script>
<title><?php echo ($store['name']); ?></title>	
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<!-- Mobile Devices Support @begin -->
		<meta content="telephone=no, address=no" name="format-detection">
		<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<!-- Mobile Devices Support @end -->
</head>
<style  type="text/css">
#dingcai_adress_info{
border-top: 1px solid #ddd8ce;
border-bottom: 1px solid #ddd8ce;
position: relative;
}
#dingcai_adress_info:after{
position: absolute;
right: 8px;
top: 50%;
display: block;
content: '';
width: 13px;
height: 13px;
border-left: 3px solid #999;
border-bottom: 3px solid #999;
-webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
}


#enter_im_div {
  bottom: 121px;
  z-index: 11;
  display: none;
  position: fixed;
  width: 100%;
  max-width: 640px;
  height: 1px;
}
#enter_im {
  width: 94px;
  margin-left: 110px;
  position: relative;
  left: -100px;
  display: block;
}
a {
  color: #323232;
  outline-style: none;
  text-decoration: none;
}
#to_user_list {
  height: 30px;
  padding: 7px 6px 8px 8px;
  background-color: #00bc06;
  border-radius: 25px;
  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
}
#to_user_list_icon_div {
  width: 20px;
  height: 16px;
  background-color: #fff;
  border-radius: 10px;
}

.rel {
  position: relative;
}
.left {
  float: left;
}
.to_user_list_icon_em_a {
  left: 4px;
}
#to_user_list_icon_em_num {
  background-color: #f00;
}
#to_user_list_icon_em_num {
  width: 14px;
  height: 14px;
  border-radius: 7px;
  text-align: center;
  font-size: 12px;
  line-height: 14px;
  color: #fff;
  top: -14px;
  left: 68px;
}
.hide {
  display: none;
}
.abs {
  position: absolute;
}
.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
  width: 2px;
  height: 2px;
  border-radius: 1px;
  top: 7px;
  background-color: #00ba0a;
}
.to_user_list_icon_em_a {
  left: 4px;
}
.to_user_list_icon_em_b {
  left: 9px;
}
.to_user_list_icon_em_c {
  right: 4px;
}
.to_user_list_icon_em_d {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px;
  top: 14px;
  left: 6px;
  border-color: #fff transparent transparent transparent;
}
#to_user_list_txt {
  color: #fff;
  font-size: 13px;
  line-height: 16px;
  padding: 1px 3px 0 5px;
}
</style>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/nav.js"></script>
<link href="<?php echo ($static_path); ?>meal/css/nav.css" rel="stylesheet">
<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container orderList">
		<section data-role="body">
		<div>我的订单
		<?php if($meal_type == 2): ?><a href="<?php echo U('Food/pad', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" class="clear" style="background: #ececec;color: #ef7f2c;display: block; float: right; margin-right: 10px; margin-top: 2px; width: 77px; height: 30px; text-align: center; font-size: 14px; line-height: 30px;">返回</a><?php endif; ?>
		</div>
		<ul class="orderlist">
		   <?php if(!empty($orderList)): if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li>
				<a href="<?php echo U('Food/order_detail', array('mer_id' => $mer_id, 'store_id' => $store_id, 'order_id' => $order['order_id']));?>" class="info">
					<span class="sawtooth <?php echo ($order['css']); ?>"><?php echo ($order['show_status']); ?></span>
					<label>
						<span class="name"><?php echo ($order['s_name']); ?></span>
						<span class="time"><?php echo ($order['otimestr']); ?></span>
					</label>
				</a>
				<?php if($order['topay']): ?><a href="<?php if($order['meal_type'] == 2): echo U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'foodPad')); else: echo U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food')); endif; ?>" class="btn" style="margin-right: 15px;  border-radius: 5px;">去付款</a>
				<?php else: ?>
				<a><span class="icon_right"><span class="right_adron"></span></span></a><?php endif; ?>
				<!---<?php if(isset($order['jiaxcai']) AND $order['jiaxcai']): ?><a href="<?php echo U('Repast/dishMenu', array('token'=>$token, 'cid'=>$order['cid'],'orid'=>$order['oid'], 'wecha_id'=>$wecha_id));?>" class="btn" style="margin-right: 100px;">去加菜</a><?php endif; ?>-->
			</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</ul>
		</section>
		<?php if($meal_type == 0): ?><footer data-role="footer">
			<nav class="nav">
				<ul class="box">
					<li>
						<a href="<?php echo U('Index/index', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">
							<span class="home">&nbsp;</span>
							<label>首页</label>				
						</a>
					</li>
					<li>
						<a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">
							<span class="order">&nbsp;</span>
							<label>在线购买</label>				
						</a>
					</li>
					<li>
						<a href="<?php echo U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0));?>">
							<span class="book">&nbsp;</span>
							<label>预约位子</label>				
						</a>
					</li>
					<li class="on">
						<a href="<?php echo U('Food/order_list', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">
							<span class="my">&nbsp;</span>
							<label>我的订单</label>
						</a>
					</li>
				</ul>
			</nav>
		</footer><?php endif; ?>
</div>
<?php if($meal_type == 0): if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
	<a id="enter_im" data-url="<?php echo ($kf_url); ?>">
	<div id="to_user_list">
	<div id="to_user_list_icon_div" class="rel left">
	<em class="to_user_list_icon_em_a abs">&nbsp;</em>
	<em class="to_user_list_icon_em_b abs">&nbsp;</em>
	<em class="to_user_list_icon_em_c abs">&nbsp;</em>
	<em class="to_user_list_icon_em_d abs">&nbsp;</em>
	<em id="to_user_list_icon_em_num" class="hide abs">0</em>
	</div>
	<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
	</div>
	</a>
</div>

<script type="text/javascript">
	$(function(){
		var mousex = 0, mousey = 0;
		var divLeft = 0, divTop = 0, left = 0, top = 0;
		document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
			e.preventDefault();
			var offset = $(this).offset();
			divLeft = parseInt(offset.left,10);
			divTop = parseInt(offset.top,10);
			mousey = e.touches[0].pageY;
			mousex = e.touches[0].pageX;
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
			event.preventDefault();
			left = event.touches[0].pageX-(mousex-divLeft);
			top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
			if(top < 1){
				top = 1;
			}
			if(top > $(window).height()-(50+$(this).height())){
				top = $(window).height()-(50+$(this).height());
			}
			if(left + $(this).width() > $(window).width()-5){
				left = $(window).width()-$(this).width()-5;
			}
			if(left < 1){
				left = 1;
			}
			$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchend', function(event){
			if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
				var url = $('#enter_im').attr('data-url');
				if (url == '' || url == null) {
					alert('商家暂时还没有设置客服');
				} else {
					location.href=$('#enter_im').attr('data-url');
				}
			}
			return false;
		});

		$('#enter_im_div').click(function(){
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		});
	});
</script><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
<?php echo ($hideScript); endif; ?>
</body>
</html>