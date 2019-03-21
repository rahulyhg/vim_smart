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
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/dialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/scroller.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/dmain.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/menu.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<style>
.menu_detail .btndiv1 {
    position: absolute;
    right: 14px;
    margin-top: 5px;
    width: 78px;
    height: 25px;
}
.menu_detail .btn.del {
    background-position: -27px -44px;
}
.menu_detail .btn.active {
    background-color: #f9f9f9;
}
.menu_detail .num {
    line-height: 25px;
    text-align: center;
    border-width: 1px 0;
}
.menu_detail .btn, .menu_detail .num {
    float: left;
    width: 25px;
    height: 25px;
    background-color: #fff;
    border-width: 1px;
    -webkit-border-image: url(../tpl/Wap/default/static/takeout/image/border.gif) 2 stretch;
}
.menu_detail .btn.add {
    background-position: 0 -44px;
}
.menu_detail .btn.active {
    background-color: #f9f9f9;
}
.menu_detail .btn {
    display: inline-block;
    background: url(../tpl/Wap/default/static/takeout/image/s.png) no-repeat;
    background-size: 150px auto;
}



#speaker{
	top:0;
    width: 100%;
    height: 40px;
    line-height: 40px;
    position: fixed;
    z-index: 980;
    background-color: #fffddf;
    opacity: 0.95;
    overflow: hidden;
    box-shadow:0px 0px 2px #222;
    -webkit-box-shadow:0px 0px 2px #222;
}
#s-word{
	font-size: 13px;
	width: 82%;
	height: 40px;
	position: fixed;
	left: 40px;
	
}
#s-icon{
	width: 20px;
	height: 20px;
	position: fixed;
	top: 10px;
	left: 10px;
	background-color: #fffddf;
	background-size: 20px;
	background-repeat: no-repeat;
	background-image: url(../tpl/Wap/default/static/takeout/image/speaker.png);
}
#s-fork{
	width: 20px;
	height: 20px;
	position: fixed;
	top: 10px;
	right: 10px;
	background-color: #fffddf;
	background-size: 20px;
	background-repeat: no-repeat;
	background-image: url(../tpl/Wap/default/static/takeout/image/yellowfork.png);
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.mylovedish').click(function(){
		var id = parseInt($(this).find('.thisdid').val());
		var islove = 0;
		if ($(this).parents('li').attr('class') == 'like') {
			islove = 1;
		}
		$.post("<?php echo U('Food/dolike', array('mer_id' => $mer_id, 'store_id' => $store_id));?>", {meal_id:id,islove:islove}, function(msg){});
	});
	$('#s-fork').click(function(){
		$('#speaker').hide();
		$('#l-nav').css({'top':0});
		$('#right').css({'top':0});
		$('.menu section').css('margin-top', '0px');
	});
	<?php if(!empty($store['store_notice'])): ?>$('.menu section').css('margin-top', '40px');<?php endif; ?>
});

var islock=false;
function next()
{
	totalPrice = parseFloat($.trim($('#allmoney').text()));
	totalNum = parseInt($.trim($('#menucount').text()));
	if((totalNum>0) && (totalPrice>0)){
		var data=getMenuChecklist();//[{'id':id,'count':count},{'id':id,'count':count}]
		if((data.length>0) && !islock){
			islock=true;
			$('#nextstep').removeClass('orange show').addClass('gray disabled');
			$.ajax({
				type: "POST",
				url: "<?php echo U('Food/processOrder', array('mer_id' => $mer_id, 'store_id' => $store_id));?>",
				data: {"cart":data},
				async:true,
				success: function(res){
					islock=false;
					$('#nextstep').removeClass('gray disabled').addClass('orange show');
					if (res.error ==0) { 
					  window.location.href = "<?php echo U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $orid));?>";
					} else {
					  alert(res.msg);
					}
				},
				dataType: "json"
			  });
			}else{
				return false;
			}
		}else{
			return false;
		}
}
</script>
<div data-role="container" class="container menu">
	<?php if(!empty($store['store_notice'])): ?><div id="speaker">
		<div id="s-icon"></div>
		<span id="s-word"><marquee behavior="scroll" scrollamount="5" direction="left" width="100%" style="width: 100%;"><?php echo ($store['store_notice']); ?></marquee></span>
		<div id="s-fork"></div>
	</div><?php endif; ?>
	<section data-role="body">
		<div class="left">
			<div class="top">
				<div id="ILike"><a><span class="icon hartblckgray"></span>我喜欢</a></div>
			</div>
			<div class="top">
				<div id="all_dish"><a><span></span>全部商品</a></div>
			</div>
			<div class="content">
				<ul id="typeList"><!--class="on"-->
					<?php if(is_array($sortlist)): $i = 0; $__LIST__ = $sortlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li id="li_type<?php echo ($so['sort_id']); ?>"><?php echo ($so['sort_name']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div class="right" id="usermenu">
			<div class="all" id="menuList">
			<?php if(!empty($meals)): if(is_array($meals)): $i = 0; $__LIST__ = $meals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rowset): $mod = ($i % 2 );++$i;?><ul id="ul_type<?php echo ($rowset['sort_id']); ?>">
						<?php if(is_array($rowset['list'])): $i = 0; $__LIST__ = $rowset['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$meal): $mod = ($i % 2 );++$i;?><li id="dish_li<?php echo ($meal['meal_id']); ?>" <?php if($meal['like']): ?>class="like"<?php endif; ?>>
						 <div class="licontent">
							<div class="span showPop">
								<?php if(!empty($meal['image'])): ?><img src="<?php echo ($meal['image']); ?>" alt="" url="<?php echo ($meal['image']); ?>"><?php endif; ?>
							</div>
							<div class="menudesc showPop">
								<h3><?php echo ($meal['name']); ?></h3>
								<p class="salenum">已售<span class="sale_num"> <?php echo ($meal['sell_count']); ?> </span><span class="theunit"><?php if(!empty($meal['unit'])): echo ($meal['unit']); else: ?>份<?php endif; ?></span></p>
								<p class="mylovedish"> <span class="icon hart"><input autocomplete="off" class="thisdid" type="hidden" value="<?php echo ($meal['meal_id']); ?>"></span></p>
								<div class="info"><?php echo (htmlspecialchars_decode($meal['des'],ENT_QUOTES)); ?></div>
							</div>
							<div class="price_wrap">
								<strong>￥<span class="unit_price"><?php echo ($meal['price']); ?></span><input type="hidden" class="tureunit_price" <?php if(isset($meal['vip_price']) AND $meal['vip_price'] > 0): ?>value="<?php echo ($meal['vip_price']); ?>"<?php else: ?>value="<?php echo ($meal['price']); ?>"<?php endif; ?>></strong>
								<div class="fr" max="-1">
									 <a href="javascript:void(0);" class="btn plus" data-num="<?php echo ($meal['num']); ?>"></a>
								</div>
								<input autocomplete="off" class="number" type="hidden" name="dish[<?php echo ($meal['meal_id']); ?>]" value="0">
							</div>
						</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</div>
		</div>
	</section>
</div>
<footer data-role="footer">			
	<nav class="g_nav">
		<div>
			<span class="cart"></span>
			<span> <span class="money">￥<label id="allmoney">0</label> </span>/<label id="menucount">0</label>份</span>
			<a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
		</div>
	</nav>
</footer>
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
<!--div class="menu_detail" id="menuDetail">
	<img style="display: none;">
	<div class="nopic"></div>
	<a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
	<dl>
		<dt>价格：</dt>
		<dd class="highlight">￥<span class="price"></span></dd>
	</dl>
	<p class="sale_desc"></p>
	<dl class="desc">
		<dt>介绍：</dt>
		<dd class="info"></dd>
	</dl>
</div-->
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
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "<?php echo ($store["image"]); ?>", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Food/menu',array('mer_id' => $mer_id, 'store_id' => $store_id));?>",
            "tTitle": "<?php echo ($store["name"]); ?>",
            "tContent": "<?php echo ($store["txt_info"]); ?>"
};
</script>
<?php echo ($shareScript); ?>

</body>
</html>