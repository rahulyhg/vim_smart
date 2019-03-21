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
</style><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/dialog.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/nav.js"></script><link href="<?php echo ($static_path); ?>meal/css/nav.css" rel="stylesheet"><body onselectstart="return true;" ondragstart="return false;">	<div data-role="container" class="container storeDetails">		<header data-role="header" class="imglist">			<?php if(isset($store['images'][0])): ?><img src="<?php echo ($store['images'][0]); ?>"><?php endif; ?>		</header>		<section data-role="body">			<ul class="linklist">				<li>					<a href="tel:<?php echo ($store['phone']); ?>"><span class="icon tel"></span><?php echo ($store['phone']); ?><span class="right_adron"></span></a>				</li>				<li>					<a href="<?php echo U('Group/addressinfo',array('store_id'=>$store['store_id']));?>"><span class="icon addr"></span><?php echo ($store['adress']); ?><span class="right_adron"></span></a>				</li>				<?php if(!empty($dt)): ?><li>					  <a href="#">当前距离你大约：<?php echo ($dt); ?></a>					</li><?php endif; ?>				<li>					<a href="<?php echo U('Food/shop_detail', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">营业时间、店铺简介<span class="right_adron"></span></a>				</li>			</ul>			<div class="btndiv">				<?php if($store['store_type'] == '0'): ?><div style="width:33%">						<a href="<?php echo U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'is_reserve' => 1));?>" class="schedule"><span class="btn orange bigfont">在线预约</span></a>					</div>					<div style="width:33%">						<a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" class="order"><span class="btn green bigfont">在线购买</span></a>					</div>					<div style="width:33%">						<a href="<?php echo U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" class="schedule"><span class="btn bigfont" style="background: #FCB402;">我要外卖</span></a>					</div>				<?php else: ?>					<div>						<a href="<?php echo U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'is_reserve' => 1));?>" class="schedule"><span class="btn orange bigfont">在线预约</span></a>					</div>					<div>						<a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" class="order"><span class="btn green bigfont">在线购买</span></a>					</div><?php endif; ?>						</div>		</section>		<footer data-role="footer">			<nav class="nav">				<ul class="box">					<li>						<a href="<?php echo U('Index/index', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">							<span class="home">&nbsp;</span>							<label>首页</label>										</a>					</li>					<li >						<a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">							<span class="order">&nbsp;</span>							<label>在线购买</label>										</a>					</li>					<li>						<a href="<?php echo U('Food/sureorder',array('mer_id'=>$mer_id,'store_id'=>$store_id,'deposit'=>0,is_reserve=>1));?>">							<span class="book">&nbsp;</span>							<label>预约位子</label>										</a>					</li>					<li >						<a href="<?php echo U('Food/order_list', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">							<span class="my">&nbsp;</span>							<label>我的订单</label>						</a>					</li>				</ul>			</nav>		</footer>	</div><?php if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
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
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div><script type="text/javascript">window.shareData = {              "moduleName":"Food",            "moduleID":"0",            "imgUrl": "<?php echo ($store["image"]); ?>",             "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Food/index',array('mer_id' => $mer_id, 'store_id' => $store_id));?>",            "tTitle": "<?php echo ($store["name"]); ?>",            "tContent": "<?php echo ($store["txt_info"]); ?>"};</script><?php echo ($shareScript); ?></body></html>