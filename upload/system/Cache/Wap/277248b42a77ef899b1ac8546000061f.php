<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/jquery1.8.3.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/dialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/main.js"></script>

<title><?php if($store['name']): echo ($store['name']); else: ?>网页<?php endif; ?></title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>takeout/css/main.css" media="all">
<style>
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
</head>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/scroller.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/menu.js"></script>
<style type="text/css">
#mymenu_lists .dztj_c{display:none}
#mymenu_lists .nodztj_c{display:block}
</style>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<header class="nav menu">
		<div>
			<a href="javascript:;" class="on">商品列表</a>
			<a href="<?php echo U('Takeout/shop', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">门店详情</a>
		</div>
	</header>
	<form name="cart_form" action="<?php echo U('Takeout/sureOrder', array('mer_id' => $mer_id, 'store_id' => $store_id));?>" method="post">
	<section class="menu_wrap" id="menuWrap">
	<div id="menuNav" class="menu_nav">
		 <div class="ico_menu_wrap clearfix"><span class="ico_menu" id="icoMenu"><i></i>分类</span></div>
			<div class="side_nav" id="sideNav" style="height: 666px;">
				<ul>
				<?php if(!empty($sortlist)): if(is_array($sortlist)): $i = 0; $__LIST__ = $sortlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="javascript:void(0);" title="<?php echo ($item['sort_id']); ?>"><?php echo ($item['sort_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</ul>
			</div>
		 </div>
		
	 <div class="menu_container" id="mymenu_lists">
	 <?php if(!empty($meals)): if(is_array($meals)): $i = 0; $__LIST__ = $meals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ditem): $mod = ($i % 2 );++$i;?><div class="menu_tt nodztj_c">
			<h2><?php echo ($ditem['sort_name']); ?></h2></div>
			<ul class="menu_list nodztj_c">
			<?php if(is_array($ditem['list'])): $i = 0; $__LIST__ = $ditem['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dditem): $mod = ($i % 2 );++$i;?><li>
				<div>
					<?php if(!empty($dditem['image'])): ?><img src="<?php echo ($dditem['image']); ?>" alt="" url="<?php echo ($dditem['image']); ?>"><?php endif; ?>
				</div>
				<div>
					<h3><?php echo ($dditem['name']); ?></h3>
					<p class="salenum">已售<span class="sale_num"><?php echo ($dditem['sell_count']); ?></span><span class="sale_unit"><?php if(!empty($dditem['unit'])): echo ($dditem['unit']); else: ?>份<?php endif; ?></span>
					<div class="info"><?php echo (htmlspecialchars_decode($dditem['des'],ENT_QUOTES)); ?></div>
				</div>
				<div class="price_wrap">
					<strong>￥<span class="unit_price"><?php echo floatval($dditem['price']);?></span></strong>
					<div class="fr" max="<?php echo ($dditem['max']); ?>">
						<a href="javascript:void(0);" class="btn add" data-num="<?php echo ($dditem['num']); ?>"></a>
					</div>
					<input autocomplete="off" class="number" type="hidden" name="dish[<?php echo ($dditem['meal_id']); ?>]" value="">
				</div>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</div>
	</section>
	<footer class="shopping_cart">
		<div class="fixed">
			<div class="cart_bg">
			<span class="cart_num" id="cartNum"></span></div>
			<div>￥<span id="totalPrice">0</span></div>
			<div><span class="comm_btn disabled">还差 <span id="sendCondition"><?php if($store['basic_price'] > 0 AND $store['delivery_fee_valid'] == 0): echo ($store['basic_price']); else: ?>0<?php endif; ?></span> 起送</span>
			<a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" style="display: none;">去结算</a></div>
			<?php if($store['delivery_fee'] > 0): if($store['reach_delivery_fee_type'] == 0): ?><p style="padding:10px;"><span>温馨提示：</span>商家设定了外送的费用<?php echo floatval($store['delivery_fee']);?>元，订单金额超过<?php echo floatval($store['basic_price']);?>元的将不收取外送费用</p>
				<?php elseif($store['reach_delivery_fee_type'] == 1): ?>
				<p style="padding:10px;"><span>温馨提示：</span>商家设定了外送的费用<?php echo floatval($store['delivery_fee']);?>元</p>
				<?php elseif($store['reach_delivery_fee_type'] == 2): ?>
				<p style="padding:10px;"><span>温馨提示：</span>商家设定了外送的费用<?php echo floatval($store['delivery_fee']);?>元，订单金额超过<?php echo floatval($store['no_delivery_fee_value']);?>元的将不收取外送费用</p><?php endif; endif; ?>
		</div>
	</footer>
	</form>

	<div class="menu_detail" id="menuDetail">
		<img style="display: none;">
		<div class="nopic"></div>
		<!--a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a-->
		
		<div class="showfixd">
		<div class="btndiv1"><span><a class="btn del active"></a><span class="num">1</span></span><a class="btn add active" id="detailBtn" max="93"></a></div>
		<dl>
			<dt>价格：</dt>
			<dd class="highlight">￥<span class="price"></span></dd>
		</dl>
		</div>
		<p class="sale_desc">月售<span class="sale_num"></span>份</p>
		<dl>
			<dt>介绍：</dt>
			<dd class="info"></dd>
		</dl>
	</div>

</div>
<script src="<?php echo ($static_public); ?>js/jquery.qrcode.min.js"></script>
<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
<?php if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
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
<script type="text/javascript">
$(function(){
	$('#see_storestaff_qrcode').click(function(){
		var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
		layer.open({
			title:['消费二维码','background-color:#8DCE16;color:#fff;'],
			content:'生成的二维码仅限提供给商家店铺员工扫描验证消费使用！<br/><br/><div id="qrcode"></div>',
			success:function(){
				$('#qrcode').qrcode({
					width:qrcode_width,
					height:qrcode_width,
					text:"<?php echo ($config["site_url"]); ?>/wap.php?c=Storestaff&a=meal_qrcode&id=<?php echo ($order["order_id"]); ?>"
				});
			}
		});
		$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});
	});
});
</script>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Takeout",
            "moduleID":"0",
            "imgUrl": "<?php echo ($store["image"]); ?>", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Takeout/menu',array('mer_id' => $mer_id, 'store_id' => $store_id));?>",
            "tTitle": "<?php echo ($store["name"]); ?>",
            "tContent": "<?php echo ($store["txt_info"]); ?>"
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>