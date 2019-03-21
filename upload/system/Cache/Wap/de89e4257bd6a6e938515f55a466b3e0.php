<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($config["meal_alias_name"]); ?>列表</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210">
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/list.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript">
			var location_url = "<?php echo U('Meal_list/ajaxList');?>";
			var now_cat_url="<?php if(!empty($now_category_url)): echo ($now_category_url); else: ?>-1<?php endif; ?>";
			var now_area_url="<?php if(!empty($now_area_url) && $all_area_list): echo ($now_area_url); else: ?>-1<?php endif; ?>";
			var now_sort_id="<?php if(!empty($now_sort_array)): echo ($now_sort_array["sort_id"]); else: ?>defaults<?php endif; ?>";
			<?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?>
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/dropdown.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/meallist.js?210" charset="utf-8"></script>
	</head>
	<body>
		<section class="searchBar pageSliderHide <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>">
			<div class="searchBox">
				<form id="search-form" action="<?php echo U('Search/meal');?>" method="post">
					<input type="search" id="keyword" name="w" placeholder="请输入搜索词" autocomplete="off"/>
				</form>
			</div>
			<div class="voiceBtn"></div>
		</section>
		<section class="navBox pageSliderHide">
			<ul>
				<li class="dropdown-toggle caret category" data-nav="category">
					<span class="nav-head-name"><?php if($now_category): echo ($now_category["cat_name"]); else: ?>全部分类<?php endif; ?></span>
				</li>
				<li class="dropdown-toggle caret biz subway" data-nav="biz">
					<span class="nav-head-name"><?php if($now_area): echo ($now_area["area_name"]); else: ?>全城<?php endif; ?></span>
				</li>
				<li class="dropdown-toggle caret sort" data-nav="sort">
					<span class="nav-head-name"><?php echo ($now_sort_array["sort_value"]); ?></span>
				</li>
			</ul>
			<div class="dropdown-wrapper">
				<div class="dropdown-module">
					<div class="scroller-wrapper">
						<div id="dropdown_scroller" class="dropdown-scroller" style="overflow:hidden;">
							<div>
								<ul>
									<li class="category-wrapper">
										<ul class="dropdown-list">
											<li data-category-id="-1" <?php if(empty($top_category)): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="全部分类">全部分类</span></li>
											<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-category-id="<?php echo ($vo["cat_url"]); ?>" <?php if($vo['cat_count'] > 1): ?>data-has-sub="true"<?php else: ?>onclick="list_location($(this));return false;"<?php endif; ?> class="<?php if($vo['cat_count'] > 1): ?>right-arrow-point-right<?php endif; ?> <?php if($top_category['cat_url'] == $vo['cat_url']): ?>active<?php endif; ?>">
													<span data-name="<?php echo ($vo["cat_name"]); ?>"><?php echo ($vo["cat_name"]); ?></span>
													<?php if($vo['cat_count'] > 1): ?><span class="quantity"><b></b></span><?php endif; ?>
													<div class="sub_cat hide" style="display:none;">
														<?php if($vo['cat_count'] > 1): ?><ul class="dropdown-list sub-list">
																<li data-category-id="<?php echo ($vo["cat_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($vo["cat_name"]); ?>">全部</span></div></li>
																<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li data-category-id="<?php echo ($voo["cat_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($voo["cat_name"]); ?>"><?php echo ($voo["cat_name"]); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
															</ul><?php endif; ?>
													</div>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
									<?php if($all_area_list): ?><li class="biz-wrapper">
											<ul class="dropdown-list">
												<li data-area-id="-1" <?php if(empty($now_area_url)): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="全城">全城</span></li>
												<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-area-id="<?php echo ($vo["area_url"]); ?>" <?php if($vo['area_count'] > 0): ?>data-has-sub="true"<?php else: ?>onclick="list_location($(this));return false;"<?php endif; ?> class="<?php if($vo['area_count'] > 0): ?>right-arrow-point-right<?php endif; ?> <?php if($top_area['area_url'] == $vo['area_url']): ?>active<?php endif; ?>">
														<span><?php echo ($vo["area_name"]); ?></span>
														<?php if($vo['area_count'] > 0): ?><span class="quantity"><b></b></span><?php endif; ?>
														<div class="sub_cat hide" style="display:none;">
															<?php if($vo['area_count'] > 0): ?><ul class="dropdown-list sub-list">
																	<li data-area-id="<?php echo ($vo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($vo["area_name"]); ?>">全部</span></div></li>
																	<?php if(is_array($vo['area_list'])): $j = 0; $__LIST__ = $vo['area_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li data-area-id="<?php echo ($voo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name" data-name="<?php echo ($voo["area_name"]); ?>"><?php echo ($voo["area_name"]); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
																</ul><?php endif; ?>
														</div>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</li><?php endif; ?>
									<li class="sort-wrapper">
										<ul class="dropdown-list">
											<?php if(is_array($sort_array)): $i = 0; $__LIST__ = $sort_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-sort-id="<?php echo ($vo["sort_id"]); ?>" <?php if($vo['sort_id'] == $now_sort_array['sort_id']): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span data-name="<?php echo ($vo["sort_value"]); ?>"><?php echo ($vo["sort_value"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						<div id="dropdown_sub_scroller" class="dropdown-sub-scroller"><div></div></div>
					</div>
				</div>
			</div>
		</section>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<script id="mealListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.meal_list.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d.meal_list[i].wap_url }}">
							<div class="dealcard-img imgbox">
								<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url={{ encodeURIComponent(d.meal_list[i].image) }}" alt="{{ d.meal_list[i].name }}"/>
								{{# if(d.meal_list[i].state == 0){ }}<i class="store_state">休息中</i>{{# }else{ }}<i class="store_state open">营业中</i>{{# } }}
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{ d.meal_list[i].name }} {{# if(d.meal_list[i].range){ }}<span class="location-right">{{ d.meal_list[i].range }}</span>{{# } }}</div>
								<!--div class="title">{{ d.meal_list[i].store_notice }}</div-->
								<!--div class="price">
									{{# if(d.meal_list[i].mean_money){ }}<strong>{{ d.meal_list[i].mean_money }}</strong><span class="strong-color">元(人均)</span>{{# } }}&nbsp;<span class="line-right">已售{{ d.meal_list[i].sale_count }}</span>
								</div-->
								<div class="title" style="font-size:14px;margin:4px 0;">{{ d.meal_list[i].adress }}{{# if(d.meal_list[i].mean_money){ }}|人均{{ d.meal_list[i].mean_money }}元{{# } }}</div>
								<div class="price" style="position: relative;">
									{{# if(d.meal_list[i].store_type == '0' || d.meal_list[i].store_type == '1'){ }}<span class="imgLabel daodian"></span>{{# } }}{{# if(d.meal_list[i].store_type == '0' || d.meal_list[i].store_type == '2'){ }}<span class="imgLabel waisong"></span>{{# } }}
									<span class="line-right">已售{{ d.meal_list[i].sale_count }}</span>
								</div>
								{{# if (d.meal_list[i].store_labels.length > 0) { }}
								<div style="border-top: 1px solid #f1f1f1;padding-top: 3px;">
								{{# for(var ii = 0, len_label = d.meal_list[i].store_labels.length; ii < len_label; ii++){ }}
								<span style="color:#B9B8B8;font-size:12px;"><img src="{{ d.meal_list[i].store_labels[ii].icon }}" style="width:16px;height:16px;vertical-align: middle;"> {{ d.meal_list[i].store_labels[ii].name }}</span><br/>
								{{# } }}
								</div>
								{{# } }}
							</div>
						</dd>
					{{# } }}
				</script>
				<section class="listBox">
					<dl></dl>
					<div class="shade hide"></div>
					<div class="noMoreList hide">更多商户正在入驻，敬请期待!</div>
					<div class="no-deals hide">暂无此类<?php echo ($config["meal_alias_name"]); ?>，请查看其他分类</div>
				</section>
				<div id="pullUp">
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		window.shareData = {  
					"moduleName":"Meal_list",
					"moduleID":"0",
					"imgUrl": "<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($config["site_logo"]); endif; ?>", 
					"sendFriendLink": "<?php echo ($config["site_url"]); echo U('Meal_list/index');?>",
					"tTitle": "<?php echo ($config["meal_alias_name"]); ?>列表",
					"tContent": "<?php echo ($config["site_name"]); ?>"
		};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>