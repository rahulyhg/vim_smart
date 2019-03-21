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
</style><script type="text/javascript">var store_id = <?php echo ($store_id); ?>;</script><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/dialog.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/scroller.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/dmain.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/showdialog.js"></script><style type="text/css">	.myMenu .main .top >span >a{width: 50px;}</style><body onselectstart="return true;" ondragstart="return false;" style="background-color:#e5e5e5;"><script type="text/javascript">	var islock=false;	function next() {		totalPrice = parseFloat($.trim($('#allmoney').text()));		totalNum = parseInt($.trim($('#menucount').text()));		if((totalNum>0) && (totalPrice>0) && !islock){			$('#totalnum').val(totalNum);			$('#totalmoney').val(totalPrice);			islock = true;			document.myorderform.submit();			islock = false;		}	}var leveloff=false;var offtyp=0,offvv=0;<?php if(isset($level_off) AND !empty($level_off)): ?>leveloff=true;    offtyp="<?php echo ($level_off['type']); ?>";	offvv="<?php echo ($level_off['vv']); ?>";<?php endif; ?></script><div data-role="container" class="container myMenu"><section data-role="body">	<div class="main" >		<div class="top">			<span>				<?php if(isset($level_off) AND !empty($level_off)): ?>&nbsp;<div>会员等级：<span style="color:#FC6E05"><?php echo ($level_off['lname']); ?></span></div>				<?php else: ?>				<div>我的订单</div><?php endif; ?>									<a href="<?php echo U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $orid));?>" class="add">我还要</a>				<a href="javascript:popup();" class="clear">清空</a>			</span>		</div>		<form name="myorderform" method="POST" action="<?php echo ($action_url); ?>">			<div class="all" id="menuList">				<ul id="usermenu">					<?php if(!empty($ordishs)): if(is_array($ordishs)): $i = 0; $__LIST__ = $ordishs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dditem): $mod = ($i % 2 );++$i;?><li id="dish_li<?php echo ($dditem['meal_id']); ?>">							<div class="licontent">								<div class="span">									<?php if(!empty($dditem['image'])): ?><img src="<?php echo ($dditem['image']); ?>" alt="" url="<?php echo ($dditem['image']); ?>"><?php endif; ?>									<?php if($dditem['ishot'] == 1): ?><span class="ishot" style="left: -5px;">推荐</span><?php endif; ?>								</div>								<div class="menudesc">									<h3><?php echo ($dditem['name']); ?></h3>									<p class="addmark" onclick="addmark($(this))">添加备注</p>								</div>								<div class="price_wrap">									<strong>￥<span class="unit_price"><?php echo ($dditem['price']); ?><input type="hidden" class="tureunit_price" <?php if(isset($dditem['vip_price']) AND $dditem['vip_price'] > 0): ?>value="<?php echo ($dditem['vip_price']); ?>"<?php else: ?>value="<?php echo ($dditem['price']); ?>"<?php endif; ?>></span></strong>									<div class="fr" max="-1">										<a href="javascript:void(0);" class="btn plus" <?php if(isset($dditem['num']) && !empty($dditem['num'])): ?>data-num="<?php echo ($dditem['num']); ?>" <?php else: ?>data-num=""<?php endif; ?>></a>									</div>									<input autocomplete="off" class="number" type="hidden" name="dish[<?php echo ($dditem['id']); ?>][num]" value="<?php echo ($dditem['num']); ?>">									<input autocomplete="off"  type="hidden" name="dish[<?php echo ($dditem['id']); ?>][price]" value="<?php echo ($dditem['price']); ?>">									<input autocomplete="off"  type="hidden" name="dish[<?php echo ($dditem['id']); ?>][name]" value="<?php echo ($dditem['name']); ?>">								</div>							</div>							<input type="text" class="markinput" placeholder="备注(30个汉字以内)" name="dish[<?php echo ($dditem['id']); ?>][omark]" <?php if(isset($dditem['omark']) && !empty($dditem['omark'])): ?>value="<?php echo (htmlspecialchars_decode($dditem['omark'],ENT_QUOTES)); ?>" style="display:block;"<?php else: ?>value=""<?php endif; ?>>						</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>				</ul>			</div>			<div class="mark">				<!--textarea placeholder=" 备注" name="allmark"><?php echo ($allmark); ?></textarea-->				<input autocomplete="off"  type="hidden" name="totalmoney" id="totalmoney" value="">				<input autocomplete="off"  type="hidden" name="totalnum" id="totalnum" value="">			</div>		</form>	</div></section><footer data-role="footer">				<nav class="g_nav">		<div>			<span class="cart"></span>			<?php if(isset($level_off) AND !empty($level_off)): ?><span><span class="money"><del>￥<label id="allmoney">0</label></del>&nbsp;￥<label id="levelallmoney">0</label></span>/<label id="menucount">0</label>份</span><span style="margin-left: 60px;color: #FD7008;"><?php echo ($level_off['offstr']); ?></span>			<?php else: ?>			<span> <span class="money">￥<label id="allmoney">0</label></span>/<label id="menucount">0</label>份</span><?php endif; ?>			<a href="javascript:next();" class="btn orange show" id="nextstep">下一步</a>		</div>	</nav></footer><div class="layer transparent"></div><div class="layer popup">	<div class="dialogX">		<div class="content">			<div class="title">清空购物车</div>			<div class="message">您是否要清空购物车？</div>		</div>		<div class="button">			<a class="cancel" href="javascript:cancel();">取消</a>			<a href="<?php echo U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id,'isclean'=>1));?>">确定</a>		</div>	</div>			</div></div><script type="text/javascript">$(function(){	var amountCb = $.amountCb();	$('#menuList li').each(function(){		var count = parseInt($(this).find('.number').val()),			_add = $(this).find('.plus'),			i = 0;		for(; i < count; i++){			amountCb.call(_add, '+');		}		_add.amount(count, amountCb);	});});function addmark(obj){	obj.parent().parent().siblings(".markinput").toggle();}function getMyMenulist(){	var lis =$("#usermenu li");	var list = [];	for(i=0;i<lis.length;i++){				var mark= $(".markinput",lis[i]).get(0).value;		var count = $(".num >input",lis[i]).get(0).value;		if(count>0){			var id = lis[i].id;						var info = {'id':id,'count':count,'mark':mark}			list.push(info);		}			}	var allmark = $("#allmark").get(0).value;	return {'data':list,mark:allmark};}</script><?php if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
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
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div><?php echo ($hideScript); ?></body></html>