<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
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
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?215"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index.css?216"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?211" charset="utf-8"></script>
		<script type="text/javascript"><if condition="$user_long_lat">var user_long = "{pigcms{$user_long_lat.long}",user_lat = "{pigcms{$user_long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/index.js?210" charset="utf-8"></script>
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
				<header <if condition="$config['many_city']">class="hasManyCity"</if>>
					<if condition="$config['many_city']">
						<div id="cityBtn" class="link-url" data-url="{pigcms{:U('Changecity/index')}">{pigcms{$now_city_name}</div>
					</if>
					<div id="locaitonBtn" class="link-url" data-url="{pigcms{:U('Merchant/around')}"></div>
					<div id="searchBox">
						<a href="{pigcms{:U('Search/index')}">
							<i class="icon-search"></i>
							<span>请输入您想找的内容</span>
						</a>
					</div>
					<div id="qrcodeBtn"></div>
				</header>
				<if condition="$wap_index_top_adver">
					<section class="banner">
						<div class="swiper-container swiper-container1">
							<div class="swiper-wrapper">
								<volist name="wap_index_top_adver" id="vo">
									<div class="swiper-slide">
										<a href="{pigcms{$vo.url}">
											<img src="{pigcms{$vo.pic}"/>
										</a>
									</div>
								</volist>
							</div>
							<div class="swiper-pagination swiper-pagination1"></div>
						</div>
					</section>
				</if>
				<if condition="$config['house_open']">
					<section class="invote index_house">
						<a href="{pigcms{:U('House/village_list')}">
							<img src="{pigcms{$config.wechat_share_img}"/>
							我的社区服务
						</a>
					</section>
				</if>
				<if condition="$wap_index_slider">
					<section class="slider">
						<div class="swiper-container swiper-container2" style="height:168px;">
							<div class="swiper-wrapper">
								<volist name="wap_index_slider" id="vo">
									<div class="swiper-slide">
										<ul class="icon-list">
											<volist name="vo" id="voo">
												<li class="icon">
													<a href="{pigcms{$voo.url}">
														<span class="icon-circle">
															<img src="{pigcms{$voo.pic}">
														</span>
														<span class="icon-desc">{pigcms{$voo.name}</span>
													</a>
												</li>
											</volist>
										</ul>
									</div>
								</volist>
							</div>
							<div class="swiper-pagination swiper-pagination2"></div>
						</div>
						<if condition="$news_list">
							<div class="platformNews clearfix link-url" data-url="{pigcms{:U('Systemnews/index')}">
								<div class="left ico"></div>
								<div class="left list">
									<ul>
										<volist name="news_list" id="vo">
											<li class="num-{pigcms{$i}" <if condition="$i gt 2">style="display:none;"</if>>{pigcms{$vo.title}</li>
										</volist>
									</ul>
								</div>
							</div>
						</if>
					</section>
				</if>
				<if condition="$invote_array">
					<section class="invote">
						<a href="{pigcms{$invote_array.url}">
							<img src="{pigcms{$invote_array.avatar}"/>
							{pigcms{$invote_array.txt}
							<button>关注我们</button>
						</a>
					</section>
				<elseif condition="$share"/>
					<section class="invote">
						<a href="{pigcms{$share.a_href}">
							<img src="{pigcms{$share.image}"/>
							{pigcms{$share.title}
							<button>{pigcms{$share['a_name']}</button>
						</a>
					</section>
				</if>		
				<if condition="$activity_list">
					<section class="activity">
						<div class="activityBox">
							<div class="swiper-container swiper-container4">
								<div class="swiper-wrapper">
									<volist name="activity_list" id="vo">
										<div class="swiper-slide">
											<a href="{pigcms{:U('Wapactivity/detail',array('id'=>$vo['pigcms_id']))}">
												<label>
													<span class="title">参与</span>
													<span class="number">{pigcms{$vo.part_count}</span>
												</label>
												<div class="clock"><span class="time_d">{pigcms{$time_array['d']}</span>天 <span class="timerBox"><span class="timer time_h">{pigcms{$time_array['h']}</span>:<span class="timer time_m">{pigcms{$time_array['m']}</span>:<span class="timer time_s">{pigcms{$time_array['s']}</span></span></div>
												<div class="icon">
													<img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.name}"/>
												</div>
												<div class="desc">
													<div class="name">{pigcms{$vo.name}</div>
													<div class="price">
														<if condition="$vo['type'] eq 1">
															<strong class="yuan">剩{pigcms{$vo['all_count']-$vo['part_count']}</strong>
														<else/>
															<if condition="$vo['mer_score']">
																<strong>{pigcms{$vo.mer_score}积分</strong>
															<else/>
																<strong>￥{pigcms{$vo.money}</strong>
															</if>
														</if>
													</div>
												</div>
											</a>
										</div>
									</volist>
								</div>
							</div>
						</div>
					</section>
				</if>
				<section class="recommend" <if condition="!$wap_index_center_adver">style="height:85px;"</if>>
					<if condition="$wap_index_center_adver">
						<div class="recommendBox">
							<div class="recommendLeft link-url" data-url="{pigcms{$wap_index_center_adver.2.url}">
								<img src="{pigcms{$wap_index_center_adver.2.pic}" alt="{pigcms{$wap_index_center_adver.2.name}"/>
							</div>
							<div class="recommendRight">
								<div class="recommendRightTop link-url" data-url="{pigcms{$wap_index_center_adver.1.url}">
									<img src="{pigcms{$wap_index_center_adver.1.pic}" alt="{pigcms{$wap_index_center_adver.1.name}"/>
								</div>
								<div class="recommendRightBottom link-url" data-url="{pigcms{$wap_index_center_adver.0.url}">
									<img src="{pigcms{$wap_index_center_adver.0.pic}" alt="{pigcms{$wap_index_center_adver.0.name}"/>
								</div>
							</div>
						</div>
					</if>
					<div class="nearBox">
						<ul>
							<li>
								<div class="nearBoxDiv merchant link-url" data-url="{pigcms{:U('Merchant/around')}">
									<div class="title">附近商家</div>
									<div class="desc">快速找到商家</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv group link-url" data-url="{pigcms{:U('Group/index')}">
									<div class="title">附近{pigcms{$config.group_alias_name}</div>
									<div class="desc">看得到的便宜</div>
									<div class="icon"></div>
								</div>
							</li>
							<li>
								<div class="nearBoxDiv store link-url" data-url="{pigcms{:U('Meal_list/index')}">
									<div class="title">附近{pigcms{$config.meal_alias_name}</div>
									<div class="desc">购物无需等待</div>
									<div class="icon"></div>
								</div>
							</li>
						</ul>
					</div>
				</section>
				<if condition="$classify_Zcategorys">
					<section class="classify">
						<div class="headBox">分类信息</div>
						<div class="classifyBox">
							<div class="swiper-container swiper-container3">
								<div class="swiper-wrapper">
									<volist name="classify_Zcategorys" id="vo">
										<if condition="$vo['cat_pic']">
											<div class="swiper-slide">
												<a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])))}">
													<span class="icon">
														<img src="{pigcms{$vo.cat_pic}"/>
													</span>
													<span class="desc">{pigcms{$vo.cat_name}</span>
												</a>
											</div>
										</if>
									</volist>
								</div>
							</div>
						</div>
					</section>
				</if>
				<!--<section class="youlike hide">
					<div class="headBox">猜你喜欢</div>
					<dl class="likeBox dealcard"></dl>
				</section>-->
				<script id="indexRecommendBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={{ encodeURIComponent(d[i].list_pic) }}" alt="{{ d[i].s_name }}"/>
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
				<!--<div><a href="{pigcms{:U('House/control_show')}">智能门禁展示</a></div>-->
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
		<script type="text/javascript">
			window.shareData = {  
				"moduleName":"Home",
				"moduleID":"0",
				"imgUrl": "<if condition="$config['wechat_share_img']">{pigcms{$config.wechat_share_img}<else/>{pigcms{$config.site_logo}</if>", 
				"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Home/index')}",
				"tTitle": "{pigcms{$config.site_name}",
				"tContent": "{pigcms{$config.seo_description}"
			};
		</script>
		{pigcms{$shareScript}
	</body>
</html>