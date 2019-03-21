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
<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
<script type="text/javascript" src="<?php echo ($static_path); ?>takeout/js/swipe_min.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<header class="nav">
		<div>
			<a href="<?php echo U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">商品列表</a>
			<a href="javascript:;" class="on">门店详情</a>
		</div>
	</header>
	<section>
		<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
			<ul style="width: 640px;">
				<?php if(is_array($store['images'])): $i = 0; $__LIST__ = $store['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li data-index="0" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
					<img src="<?php echo ($img); ?>"/>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
				<!--li data-index="1" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
				<a href=""><img src=""></a>
				</li-->
			</ul>
			<ol id="swipeNum">
				<?php if(is_array($store['images'])): $i = 0; $__LIST__ = $store['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i; if($i == 1): ?><li class="on"></li>
				<?php else: ?>
				<li></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ol>
		</div>
		<div class="store_info">
			<!--span><strong>30</strong>送达/分钟</span-->
			<span><strong><?php echo floatval($store['basic_price']);?></strong>起送价/元</span>
			<span><strong><?php echo floatval($store['delivery_fee']);?></strong>配送费/元</span>
		</div>
		<ul class="box">
			<li>
				<a href="tel:<?php echo ($store['phone']); ?>">
					<span><i class="ico_tel"></i></span>
					<strong>电话：<?php echo ($store['phone']); ?></strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
			<li>
				<a href="<?php echo U('Group/addressinfo',array('store_id'=>$store['store_id']));?>">
					<span><i class="ico_addres1"></i></span>
					<strong><?php echo ($store['adress']); ?></strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
		</ul>
		<ul class="box">
			<li>营业时间：<?php if(is_array($store['office_time'])): $i = 0; $__LIST__ = $store['office_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tim): $mod = ($i % 2 );++$i; echo ($tim['open']); ?>~<?php echo ($tim['close']); ?>　　<?php endforeach; endif; else: echo "" ;endif; ?></li>
			<li>服务半径：<?php echo ($store['delivery_radius']); ?>公里</li>
			<?php if($store['delivery_area']): ?><li>配送区域：<?php echo ($store['delivery_area']); ?></li><?php endif; ?>
		</ul>
		<?php if(!empty($reply_list)): ?><ul class="box">
				<dl class="list" id="deal-feedback">
					<dd>
						<dl>
							<dt>评价<span class="pull-right"><span class="stars"><?php $__FOR_START_916796992__=0;$__FOR_END_916796992__=5;for($i=$__FOR_START_916796992__;$i < $__FOR_END_916796992__;$i+=1){ if($store['score_mean'] > $i): ?><i class="text-icon icon-star"></i><?php elseif($store['score_mean'] > $i-1): ?><i class="text-icon icon-star-gray"><i class="text-icon icon-star-half"></i></i><?php else: ?><i class="text-icon icon-star-gray"></i><?php endif; } ?><em class="star-text"><?php echo ($now_group["score_mean"]); ?></em></span></span></dt>
							<?php if(is_array($reply_list)): $i = 0; $__LIST__ = $reply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="dd-padding">
									<div class="feedbackCard">
										<div class="userInfo">
											<weak class="username"><?php echo ($vo["nickname"]); ?></weak>
										</div>
										<div class="score">
											<span class="stars"><?php $__FOR_START_1876536563__=0;$__FOR_END_1876536563__=5;for($i=$__FOR_START_1876536563__;$i < $__FOR_END_1876536563__;$i+=1){ if($vo['score'] > $i): ?><i class="text-icon icon-star"></i><?php else: ?><i class="text-icon icon-star-gray"></i><?php endif; } ?></span>
								
											<weak class="time"><?php echo ($vo["add_time"]); ?></weak>
										</div>
										<div class="comment">
											<p><?php echo ($vo["comment"]); ?></p>
										</div>
										<?php if($vo['pics']): ?><div class="pics view_album" data-pics="<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i; echo ($voo["m_image"]); if(count($vo['pics']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>">
												<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><span class="pic-container imgbox" style="background:none;"><img src="<?php echo ($voo["s_image"]); ?>" style="width:100%;"/></span>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
											</div><?php endif; ?>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
					</dd>
				</dl>
			</ul><?php endif; ?>
	<div style="display: none;text-align: center;height: 30px;margin-top: 15px;" id="show_more" page="2"><a href="javascript:void(0);" style="color: #ED0B8C;">加载更多...</a></div>
	<input type="hidden" id="canScroll" value="1" />
	</section>
	<footer class="go_menu" style="height:70px;">
		<div class="fixed">
			<a href="<?php echo U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">查看商品列表</a>
		</div>
	</footer>
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
$(document).ready(function(){
	/*---------------------加载更多--------------------*/
	var total = <?php echo ($store['reply_count']); ?>;
	var pagesize = 10;
	var t = 0;
	var pages = Math.ceil(total / pagesize);
	if (pages > 1) {
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				var _page = $('#show_more').attr('page');
				$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载中...</a>');
				if (_page > pages) {
					$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">没有更多了</a>').delay(2300).slideUp(1600);
					return;
				}
				if($('#canScroll').val()==0){//不要重复加载
					return;
				}
				$('#canScroll').attr('value',0);
				
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'pagesize' : pagesize, 'mer_id':<?php echo ($mer_id); ?>, 'store_id':<?php echo ($store_id); ?>},
					url :  '/wap.php?c=Takeout&a=ajaxreply',
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载更多</a>');
						data = RES.data;
						if(data != null && data != ''){
							$('#show_more').attr('page', parseInt(_page)+1);
						}
						var _tmp_html = '';
						$.each(data, function(x, vo) {
							_tmp_html += '<dd class="dd-padding">';
							_tmp_html += '<div class="feedbackCard">';
							_tmp_html += '<div class="userInfo">';
							_tmp_html += '<weak class="username">' + vo.nickname + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="score">';
							_tmp_html += '<span class="stars">';
							for (var i = 0; i < 5; i++) {
								if (vo.score > i) {
									_tmp_html += '<i class="text-icon icon-star"></i>';
								} else {
									_tmp_html += '<i class="text-icon icon-star-gray"></i>';
								}
							}
							_tmp_html += '</span>';
						
							_tmp_html += '<weak class="time">' + vo.add_time + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="comment">';
							_tmp_html += '<p>' + vo.comment + '</p>';
							_tmp_html += '</div>';
							if (vo.pics != null && vo.pics != '') {
								var pre = '', str = '';
								$.each(vo.pics, function(ii, voo){
									str += pre + voo['m_image'];
									pre = ',';
								});
								_tmp_html += '<div class="pics view_album" data-pics="' + str + '">';
								$.each(vo.pics, function(io, vvo){
									_tmp_html += '<span class="pic-container imgbox" style="background:none;"><img src="' + vvo.s_image + '" style="width:100%;"/></span>&nbsp;';
								});
								_tmp_html += '</div>';
							}
							_tmp_html += '</div>';
							_tmp_html += '</dd>';
						});
						$('#deal-feedback').find('dl').append(_tmp_html);
					}
				});
			}
		});
	}

});
window.shareData = {  
            "moduleName":"Takeout",
            "moduleID":"0",
            "imgUrl": "<?php echo ($store["image"]); ?>", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Takeout/shop',array('mer_id' => $mer_id, 'store_id' => $store_id));?>",
            "tTitle": "<?php echo ($store["name"]); ?>",
            "tContent": "<?php echo ($store["txt_info"]); ?>"
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>