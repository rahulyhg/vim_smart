<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>首页</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?215"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/index.css?216"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
		<script type="text/javascript"><?php if($user_long_lat): ?>var user_long = "<?php echo ($user_long_lat["long"]); ?>",user_lat = "<?php echo ($user_long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/index.js?210" charset="utf-8"></script>
		<style>
			.index_house{
				position:relative;
			}
			.index_house:after {
				display: block;
				content: "";
				border-top: 1px solid #BFBFBF;
				border-left: 1px solid #BFBFBF;
				width: 8px;
				height: 8px;
				-webkit-transform: rotate(135deg);
				background-color: transparent;
				position: absolute;
				top: 50%;
				right: 15px;
				margin-top: -5px;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<header <?php if($config['many_city']): ?>class="hasManyCity"<?php endif; ?>>
					<?php if($config['many_city']): ?><div id="cityBtn" class="link-url" data-url="<?php echo U('Changecity/index');?>"><?php echo ($now_city_name); ?></div><?php endif; ?>
					<div id="locaitonBtn" class="link-url" data-url="<?php echo U('Merchant/around');?>"></div>
					<div id="searchBox">
						<a href="<?php echo U('Search/index');?>">
							<i class="icon-search"></i>
							<span>请输入您想找的内容</span>
						</a>
					</div>
					<div id="qrcodeBtn"></div>
				</header>
				<?php if($wap_index_top_adver): ?><section class="banner">
						<div class="swiper-container swiper-container1">
							<div class="swiper-wrapper">
								<?php if(is_array($wap_index_top_adver)): $i = 0; $__LIST__ = $wap_index_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
										<a href="<?php echo ($vo["url"]); ?>">
											<img src="<?php echo ($vo["pic"]); ?>"/>
										</a>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="swiper-pagination swiper-pagination1"></div>
						</div>
					</section><?php endif; ?>
				<?php if($config['house_open']): ?><section class="invote index_house">
						<a href="<?php echo U('House/village_list');?>">
							<img src="<?php echo ($config["wechat_share_img"]); ?>"/>
							我的社区服务
						</a>
					</section><?php endif; ?>
				<?php if($wap_index_slider): ?><section class="slider">
						<div class="swiper-container swiper-container2" style="height:168px;">
							<div class="swiper-wrapper">
								<?php if(is_array($wap_index_slider)): $i = 0; $__LIST__ = $wap_index_slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
										<ul class="icon-list">
											<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="icon">
													<a href="<?php echo ($voo["url"]); ?>">
														<span class="icon-circle">
															<img src="<?php echo ($voo["pic"]); ?>">
														</span>
														<span class="icon-desc"><?php echo ($voo["name"]); ?></span>
													</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="swiper-pagination swiper-pagination2"></div>
						</div>
						<?php if($news_list): ?><div class="platformNews clearfix link-url" data-url="<?php echo U('Systemnews/index');?>">
								<div class="left ico"></div>
								<div class="left list">
									<ul>
										<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="num-<?php echo ($i); ?>" <?php if($i > 2): ?>style="display:none;"<?php endif; ?>><?php echo ($vo["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div><?php endif; ?>
					</section><?php endif; ?>
				<?php if($invote_array): ?><section class="invote">
						<a href="<?php echo ($invote_array["url"]); ?>">
							<img src="<?php echo ($invote_array["avatar"]); ?>"/>
							<?php echo ($invote_array["txt"]); ?>
							<button>关注我们</button>
						</a>
					</section>
				<?php elseif($share): ?>
					<section class="invote">
						<a href="<?php echo ($share["a_href"]); ?>">
							<img src="<?php echo ($share["image"]); ?>"/>
							<?php echo ($share["title"]); ?>
							<button><?php echo ($share['a_name']); ?></button>
						</a>
					</section><?php endif; ?>		
				<?php if($activity_list): ?><section class="activity">
						<div class="activityBox">
							<div class="swiper-container swiper-container4">
								<div class="swiper-wrapper">
									<?php if(is_array($activity_list)): $i = 0; $__LIST__ = $activity_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
											<a href="<?php echo U('Wapactivity/detail',array('id'=>$vo['pigcms_id']));?>">
												<label>
													<span class="title">参与</span>
													<span class="number"><?php echo ($vo["part_count"]); ?></span>
												</label>
												<div class="clock"><span class="time_d"><?php echo ($time_array['d']); ?></span>天 <span class="timerBox"><span class="timer time_h"><?php echo ($time_array['h']); ?></span>:<span class="timer time_m"><?php echo ($time_array['m']); ?></span>:<span class="timer time_s"><?php echo ($time_array['s']); ?></span></span></div>
												<div class="icon">
													<img src="<?php echo ($vo["list_pic"]); ?>" alt="<?php echo ($vo["name"]); ?>"/>
												</div>
												<div class="desc">
													<div class="name"><?php echo ($vo["name"]); ?></div>
													<div class="price">
														<?php if($vo['type'] == 1): ?><strong class="yuan">剩<?php echo ($vo['all_count']-$vo['part_count']); ?></strong>
														<?php else: ?>
															<?php if($vo['mer_score']): ?><strong><?php echo ($vo["mer_score"]); ?>积分</strong>
															<?php else: ?>
																<strong>￥<?php echo ($vo["money"]); ?></strong><?php endif; endif; ?>
													</div>
												</div>
											</a>
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					</section><?php endif; ?>
				<section class="recommend" <?php if(!$wap_index_center_adver): ?>style="height:85px;"<?php endif; ?>>
					<?php if($wap_index_center_adver): ?><div class="recommendBox">
							<div class="recommendLeft link-url" data-url="<?php echo ($wap_index_center_adver["2"]["url"]); ?>">
								<img src="<?php echo ($wap_index_center_adver["2"]["pic"]); ?>" alt="<?php echo ($wap_index_center_adver["2"]["name"]); ?>"/>
							</div>
							<div class="recommendRight">
								<div class="recommendRightTop link-url" data-url="<?php echo ($wap_index_center_adver["1"]["url"]); ?>">
									<img src="<?php echo ($wap_index_center_adver["1"]["pic"]); ?>" alt="<?php echo ($wap_index_center_adver["1"]["name"]); ?>"/>
								</div>
								<div class="recommendRightBottom link-url" data-url="<?php echo ($wap_index_center_adver["0"]["url"]); ?>">
									<img src="<?php echo ($wap_index_center_adver["0"]["pic"]); ?>" alt="<?php echo ($wap_index_center_adver["0"]["name"]); ?>"/>
								</div>
							</div>
						</div><?php endif; ?>
					<div class="nearBox">
						<ul>
							<li>
								<div class="nearBoxDiv merchant link-url" data-url="<?php echo U('Merchant/around');?>">
									<div class="title">附近商家</div>
									<div class="desc">快速找到商家</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv group link-url" data-url="<?php echo U('Group/index');?>">
									<div class="title">附近<?php echo ($config["group_alias_name"]); ?></div>
									<div class="desc">看得到的便宜</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv store link-url" data-url="<?php echo U('Meal_list/index');?>">
									<div class="title">附近<?php echo ($config["meal_alias_name"]); ?></div>
									<div class="desc">购物无需等待</div>
									<div class="icon"></div>
								</div>
							</li>
						</ul>
					</div>
				</section>
				<?php if($classify_Zcategorys): ?><section class="classify">
						<div class="headBox">分类信息</div>
						<div class="classifyBox">
							<div class="swiper-container swiper-container3">
								<div class="swiper-wrapper">
									<?php if(is_array($classify_Zcategorys)): $i = 0; $__LIST__ = $classify_Zcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['cat_pic']): ?><div class="swiper-slide">
												<a href="<?php echo U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])));?>">
													<span class="icon">
														<img src="<?php echo ($vo["cat_pic"]); ?>"/>
													</span>
													<span class="desc"><?php echo ($vo["cat_name"]); ?></span>
												</a>
											</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					</section><?php endif; ?>
				<section class="youlike hide">
					<div class="headBox">猜你喜欢</div>
					<dl class="likeBox dealcard"></dl>
				</section>
				<script id="indexRecommendBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url={{ encodeURIComponent(d[i].list_pic) }}" alt="{{ d[i].s_name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{# if(d[i].tuan_type != 2){ }} {{ d[i].merchant_name }}  {{# if(d[i].range){ }}<span class="location-right">{{ d[i].range }}</span>{{# } }}   {{# }else{ }} {{ d[i].s_name }} {{# } }}</div>								
								<div class="title">{{ d[i].group_name }}</div>
								<div class="price">
									<strong>{{ d[i].price }}</strong><span class="strong-color">元</span>{{# if(d[i].wx_cheap){ }}<span class="tag">微信再减{{ d[i].wx_cheap }}元</span>{{# }else{ }}<del>{{ d[i].old_price }}</del>{{# } }} <span class="line-right">已售{{ d[i].sale_count }}</span>
								</div>
							</div>
						</dd>
					{{# } }}
				</script>
				<!--<div><a href="<?php echo U('House/control_show');?>">智能门禁展示</a></div>-->
				<div id="pullUp" style="bottom:-60px;">
					<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
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
			window.shareData = {  
				"moduleName":"Home",
				"moduleID":"0",
				"imgUrl": "<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($config["site_logo"]); endif; ?>", 
				"sendFriendLink": "<?php echo ($config["site_url"]); echo U('Home/index');?>",
				"tTitle": "<?php echo ($config["site_name"]); ?>",
				"tContent": "<?php echo ($config["seo_description"]); ?>"
			};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>