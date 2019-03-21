<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($config["group_alias_name"]); ?>详情</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/detail.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?216" charset="utf-8"></script>
		<script type="text/javascript"><?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/detail.js?216" charset="utf-8"></script>
		<style type="text/css">
		.clock {
		    position: absolute;
		    display: inline-block;
		    right: 10px;
		    border: 1px solid #DADADA;
		    border-radius: 5px;
		    padding: 1px 3px;
		    top: 25px;
		    background: url(../tpl/Wap/pure/static/img/index/clock.png) no-repeat;
		    background-size: 14px;
		    background-position: 4px 4px;
		    padding-left: 22px;
		}
		.clock .timerBox {
		    letter-spacing: 0.5px;
		}
		.clock .timer {
		    color: #FF658D;
		}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="scroller" style="padding-bottom:50px">
				<div id="pullDown" style="background-color:#fb4746;color:white;">
					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIcont" style="vertical-align:middle; margin-right:10px;"></i><?php echo ($config["wechat_name"]); ?> 精心为您优选</span>
				</div>
				<section class="imgBox">
					<img src="<?php echo ($now_group["all_pic"]["0"]["m_image"]); ?>" class="view_album" data-pics="<?php if(is_array($now_group['all_pic'])): $i = 0; $__LIST__ = $now_group['all_pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["m_image"]); if(count($now_group['all_pic']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>"/>
					<div class="imgCon">
						<div class="title"><?php if($now_group['tuan_type'] != 2): echo ($now_group["merchant_name"]); else: echo ($now_group["s_name"]); endif; ?></div>
						<div class="desc"><?php echo ($now_group["group_name"]); ?></div>
					</div>
					<div class="back"></div>
				</section>
				<section class="buyBox">
					<div class="priceDiv">
						<span class="price">￥<strong><?php echo ($now_group['price']); ?></strong><span class="old">￥<del><?php echo ($now_group["old_price"]); ?></del></span></span>
						<?php if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']): ?><span class="clock"><span class="time_d"><?php echo ($time_array['d']); ?></span>天 <span class="timerBox"><span class="timer time_h"><?php echo ($time_array['h']); ?></span>:<span class="timer time_m"><?php echo ($time_array['m']); ?></span>:<span class="timer time_s"><?php echo ($time_array['s']); ?></span></span></span>
						<?php elseif($now_group['end_time'] > $_SERVER['REQUEST_TIME'] AND $now_group['begin_time'] < $_SERVER['REQUEST_TIME']): ?>
							<a class="btn buy-btn btn-large btn-strong" href="<?php echo U('Group/buy',array('group_id'=>$now_group['group_id']));?>">立即购买</a><?php endif; ?>
					</div>
					<?php if($now_group['wx_cheap']): if($is_app_browser): ?><div class="cheapDiv">优惠 <span class="tag">APP购买再减<?php echo ($now_group["wx_cheap"]); ?>元</span></div> 
                        <?php else: ?>
						<div class="cheapDiv">优惠 <span class="tag">微信购买再减<?php echo ($now_group["wx_cheap"]); ?>元</span></div><?php endif; endif; ?>
					<?php if(empty($user_session) && $config['user_score_max_use']): ?><div class="cheapDiv link-url" data-url="<?php echo U('Login/index');?>">积分抵现 <span class="tag">请先登录查看可抵现金额</span></div>
					<?php elseif($user_coupon_use['score']): ?>
                        <div class="cheapDiv">积分抵现 <span class="tag">本单最高可用<?php echo ($user_coupon_use["score"]); ?>积分抵<?php echo ($user_coupon_use["score_money"]); ?>元</span></div><?php endif; ?>
					<div class="saleDiv">
						<span><i class="yesLightIcon"></i>随时退</span>
						<span><i class="yesLightIcon"></i>过期退</span>
						<span class="sale"><i class="yesIcon"></i>已售<?php echo ($now_group['sale_count']+$now_group['virtual_num']); ?></span>
					</div>
				</section>
				<?php if(!empty($reply_list)): ?><section class="scoreBox link-url" data-url="<?php echo U('Group/feedback',array('group_id'=>$now_group['group_id']));?>">
						<div class="rateInfo">
							<div class="starIconBg"><div class="starIcon" style="width:<?php echo ($now_group['score_mean']*20); ?>%;"></div></div>
							<div class="starText"><?php echo ($now_group["score_mean"]); ?></div>
							<div class="right"><?php echo ($now_group["reply_count"]); ?> 人评价</div>
						</div>
					</section><?php endif; ?>
				<section class="storeBox">
					<dl class="storeList">
						<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = array_slice($now_group['store_list'],0,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo U('Group/shop',array('store_id'=>$vo['store_id']));?>">
								<div class="name"><?php echo ($vo["name"]); ?></div>
								<div class="address"><?php echo ($vo["area_name"]); echo ($vo["adress"]); ?></div>
								<?php if($vo['range']): ?><div class="position"><div class="range"><?php echo ($vo["range"]); ?></div><?php if($i == 1): ?><div class="desc">离我最近</div><?php endif; ?></div><?php endif; ?>
								<div class="phone" data-phone="<?php echo ($vo["phone"]); ?>"></div>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<?php if(count($now_group['store_list']) > 2): ?><div class="more link-url" data-url="<?php echo U('Group/branch',array('group_id'=>$now_group['group_id']));?>">全部<?php echo count($now_group['store_list']);?>家分店</div><?php endif; ?>
				</section>
				<section class="detail introList">
					<div class="titleDiv"><div class="title">本单详情</div></div>
					<div class="content"><?php echo ($now_group["content"]); ?></div> 
				</section>
				<?php if($now_group['cue_arr']): ?><section class="term introList">
						<div class="titleDiv"><div class="title">购买须知</div></div>
						<div class="content">
							<ul>
								<?php if(is_array($now_group['cue_arr'])): $i = 0; $__LIST__ = $now_group['cue_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['value']): ?><li><b><?php echo ($vo["key"]); ?>：</b><?php echo (nl2br($vo["value"])); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div> 
					</section><?php endif; ?>
				<?php if(!empty($reply_list)): ?><section class="comment introList">
						<div class="titleDiv"><div class="title">评价<div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:<?php echo ($now_group['score_mean']*20); ?>%;"></div></div><div class="starText"><?php echo ($now_group["score_mean"]); ?></div></div><div class="right"><?php echo ($now_group["reply_count"]); ?> 人评论</div></div></div>
						<dl>
							<?php if(is_array($reply_list)): $i = 0; $__LIST__ = $reply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
									<div class="titleBar">
										<div class="nickname"><?php echo ($vo["nickname"]); ?></div><div class="dateline"><?php echo ($vo["add_time"]); ?></div><div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:<?php echo ($vo['score']*20); ?>%;"></div></div></div>
									</div>
									<div class="replyCon">
										<div class="textDiv">
											<div class="text"><?php echo ($vo["comment"]); ?></div>
										</div>
										<?php if($vo['pics']): ?><ul class="imgList" data-pics="<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i; echo ($voo["m_image"]); if(count($vo['pics']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>">
												<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($voo["s_image"]); ?>"/></li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul><?php endif; ?>
										<?php if($vo['merchant_reply_content']): ?><div class="textDiv">
											<div class="text" style=" font-size: 12px;color: #C6895A;">商家回复：<?php echo ($vo["merchant_reply_content"]); ?></div>
										</div><?php endif; ?>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
						<?php if($now_group['reply_count'] > 3): ?><div class="more link-url" data-url="<?php echo U('Group/feedback',array('group_id'=>$now_group['group_id']));?>">查看全部 <?php echo ($now_group["reply_count"]); ?> 条评价</div><?php endif; ?>
					</section><?php endif; ?>
				<?php if($merchant_group_list): ?><section class="storeProList introList">
						<div class="titleDiv"><div class="title">商家其他<?php echo ($config["group_alias_name"]); ?></div></div>
						<ul class="goodList">
							<?php if(is_array($merchant_group_list)): $i = 0; $__LIST__ = $merchant_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="link-url" data-url="<?php echo ($vo["url"]); ?>" <?php if($i > 2): ?>style="display:none;"<?php endif; ?>>
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="title"><?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span><?php endif; ?>
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(count($merchant_group_list) > 2): ?><li class="more">其他<?php echo count($merchant_group_list)-2;?>个<?php echo ($config["group_alias_name"]); ?></li><?php endif; ?>
						</ul>
					</section><?php endif; ?>
				<?php if($category_group_list && $merchant_link_showOther): ?><section class="sysProList introList">
						<div class="titleDiv"><div class="title">看了本<?php echo ($config["group_alias_name"]); ?>的用户还看了</div></div>
						<dl class="likeBox dealcard">
							<?php if(is_array($category_group_list)): $i = 0; $__LIST__ = $category_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
									<div class="dealcard-img imgbox">
										<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo urlencode($vo['list_pic']);?>" alt="<?php echo ($vo["name"]); ?>"/>
									</div>
									<div class="dealcard-block-right">
										<div class="brand"><?php if($vo['tuan_type'] != 2): echo ($vo["merchant_name"]); else: echo ($vo["s_name"]); endif; if($vo['range_txt']): ?><span class="location-right"><?php echo ($vo["range_txt"]); ?>米</span><?php endif; ?></div>
										<div class="title">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
										<div class="price">
											<strong><?php echo ($vo['price']); ?></strong><span class="strong-color">元</span><?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span><?php endif; if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); endif; ?></span>
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
		<div class="positionDiv">
			<div class="left"><div class="back"></div></div>
			<?php if($now_group['tuan_type'] != 2): ?><div class="center"><?php echo ($now_group["merchant_name"]); ?></div>
			<?php else: ?>
				<div class="center"><?php echo ($now_group["s_name"]); ?></div><?php endif; ?>
			<?php if($now_group['end_time'] > $_SERVER['REQUEST_TIME'] AND $now_group['begin_time'] < $_SERVER['REQUEST_TIME']): ?><div class="right">
					<a class="btn buy-btn btn-large btn-strong" href="<?php echo U('Group/buy',array('group_id'=>$now_group['group_id']));?>">购买</a>
				</div><?php endif; ?>
		</div>
		<?php if(!$merchant_link_showOther): $no_footer=true; endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footerMenu <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>">
		<ul>
			<li>
				<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>"><em class="home"></em><p>首页</p></a>
			</li>
			<li>
				<a <?php if(MODULE_NAME == 'Group'): ?>class="hover"<?php endif; ?> href="<?php echo U('Group/index');?>"><em class="group"></em><p><?php echo ($config["group_alias_name"]); ?></p></a>
			</li>
			<li class="voiceBox">
				<a href="<?php echo U('Search/voice');?>" class="voiceBtn" data-nobtn="true"></a>
			</li>
			<li>
				<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal'))): ?>class="hover"<?php endif; ?> href="<?php echo U('Meal_list/index');?>"><em class="store"></em><p><?php echo ($config["meal_alias_name"]); ?></p></a>
			</li>
			<li>
				<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>"><em class="my"></em><p>我的</p></a>
			</li>
		</ul>
	</footer><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
		<script type="text/javascript">
			window.shareData={
						"moduleName":"Group",
						"moduleID":"0",
						"imgUrl": "<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($now_group["all_pic"]["0"]["m_image"]); endif; ?>", 
						"sendFriendLink": "<?php echo ($config["site_url"]); echo U('Group/detail', array('group_id' => $now_group['group_id']));?>",
						"tTitle": "<?php echo ($now_group["s_name"]); ?>",
						"tContent": "<?php echo ($now_group["group_name"]); ?>"
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
        
        <?php if($is_app_browser): ?><script type="text/javascript">
                window.lifepasslogin.shareLifePass("<?php if($now_group['tuan_type'] != 2): ?>【<?php echo ($now_group["merchant_name"]); ?>】<?php echo ($now_group["group_name"]); else: echo ($now_group["s_name"]); endif; ?>","<?php echo ($now_group["group_name"]); ?>","<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($now_group["all_pic"]["0"]["m_image"]); endif; ?>","<?php echo ($config["site_url"]); echo U('Group/detail', array('group_id' => $now_group['group_id']));?>");
            </script><?php endif; ?>
	</body>
</html>