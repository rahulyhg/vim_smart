<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>店铺详情</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/shop.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/shop.js?211" charset="utf-8"></script>
	</head>
	<body>
		<div id="container">
			<div id="scroller">
				<section class="shopDetail">
					<div class="imgInfo">
						<div class="dealcard-img imgbox" data-pics="<?php if(is_array($now_store['all_pic'])): $i = 0; $__LIST__ = $now_store['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo); if(count($now_store['all_pic']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>">
							<img src="<?php echo ($now_store["all_pic"]["0"]); ?>" alt="<?php echo ($now_store["name"]); ?>">
						</div>
						<div class="dealcard-block-right">
							<div class="brand"><?php echo ($now_store["name"]); ?></div>
							<div class="rateInfo">
								<?php if($store_score): ?><div class="starIconBg"><div class="starIcon" style="width:<?php echo ($store_score['score_all']/$store_score['reply_count']*20); ?>%;"></div></div><div class="starText"><?php echo number_format($store_score['score_all']/$store_score['reply_count'],1);?></div>
								<?php else: ?>
									<span style="color:#999">暂无评分</span><?php endif; ?>
							</div>
							<a href="<?php echo U('Index/index',array('token'=>$now_store['mer_id']));?>" class="btn">商家微官网</a>
							<a href="<?php echo U('My/pay',array('store_id' => $now_store['store_id']));?>" class="btn">优惠买单</a>
						</div>
					</div>
					<div class="locationInfo link-url" data-url="<?php echo U('Group/addressinfo',array('store_id'=>$now_store['store_id']));?>">
						<div class="txt"><?php echo ($now_store["area_name"]); echo ($now_store["adress"]); ?></div>
						<div class="phone" data-phone="<?php echo ($now_store["phone"]); ?>"></div>
					</div>
				</section>
				<?php if($store_group_list): ?><section class="storeProList introList">
						<div class="titleDiv"><div class="title">本店<?php echo ($config["group_alias_name"]); ?>(<?php echo count($store_group_list);?>)</div></div>
						<ul class="goodList">
							<?php if(is_array($store_group_list)): $i = 0; $__LIST__ = $store_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li  class="link-url" data-url="<?php echo ($vo["url"]); ?>" <?php if($i > 2): ?>style="display:none;"<?php endif; ?>>
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["group_name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="title"><?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span>
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(count($store_group_list) > 2): ?><li class="more">全部展开</li><?php endif; ?>
						</ul>
					</section><?php endif; ?>
				<?php if($index_sort_group_list && $merchant_link_showOther): ?><section class="sysProList introList">
						<div class="titleDiv"><div class="title">为您推荐</div></div>
						<dl class="likeBox dealcard">
							<?php if(is_array($index_sort_group_list)): $i = 0; $__LIST__ = $index_sort_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["group_name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="brand"><?php if($vo['tuan_type'] != 2): echo ($vo["merchant_name"]); if($vo['range']): ?><span class="location-right"><?php echo ($vo["range"]); ?></span><?php endif; else: echo ($vo["s_name"]); endif; ?></div>
										<div class="title"><?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo["price"]); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span>
										</div>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
					</section><?php endif; ?>
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		window.shareData = {  
					"moduleName":"Group",
					"moduleID":"0",
					"imgUrl": "<?php echo ($now_store["all_pic"]["0"]); ?>", 
					"sendFriendLink": "<?php echo ($config["site_url"]); echo U('Group/shop', array('store_id' => $now_store['store_id']));?>",
					"tTitle": "<?php echo ($now_store["name"]); ?>",
					"tContent": ""
		};
		</script>
		<?php echo ($shareScript); ?>
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
	</body>
</html>