<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<?php if($is_wexin_browser): ?><title><?php echo ($config["meal_alias_name"]); ?>列表</title>
	<?php else: ?>
		<title><?php echo ($config["meal_alias_name"]); ?>列表_<?php echo ($config["site_name"]); ?></title><?php endif; ?>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>
	<style>.navbar{background:#F03C03;border-bottom:1px solid #F03C03;}.navbar .nav-dropdown{background:#F03C03;}.nav-dropdown li{border-bottom:1px solid #FF658E;}</style>
</head>
<body id="index">
		<div id="container">
			<div class="nav-bar">
				<ul class="nav">
					<li class="dropdown-toggle caret category" data-nav="category"><span class="nav-head-name"><?php if($now_category): echo ($now_category["cat_name"]); else: ?>全部分类<?php endif; ?></span></li>
					<li class="dropdown-toggle caret biz subway" data-nav="biz"><span class="nav-head-name"><?php if($now_area): echo ($now_area["area_name"]); else: ?>全城<?php endif; ?></span></li>
					<li class="dropdown-toggle caret sort" data-nav="sort"><span class="nav-head-name"><?php echo ($now_sort_array["sort_value"]); ?></span></li>
				</ul>
				<div class="dropdown-wrapper">
					<div class="dropdown-module">
						<div class="scroller-wrapper">
							<div id="dropdown_scroller" class="dropdown-scroller" style="overflow:hidden;">
								<ul>
									<li class="category-wrapper">
										<ul class="dropdown-list">
											<li data-category-id="all" <?php if($now_category_url == 'all'): ?>class="active"<?php endif; ?>><span>全部分类</span></li>
											<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><li data-category-id="<?php echo ($category['cat_url']); ?>" class="right-arrow-point-right <?php if($now_category_url == $category['cat_url']): ?>active<?php endif; ?>" onclick="list_location($(this));return false;"><span><?php echo ($category['cat_name']); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
									<li class="brand-wrapper">
										<ul class="dropdown-list"></ul>
									</li>
									
									<li class="biz-wrapper">
										<ul class="dropdown-list">
											<li data-area-id="-1" <?php if(empty($now_area_url)): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span>全城</span></li>
											
											<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-area-id="<?php echo ($vo["area_url"]); ?>" <?php if($vo['area_count'] > 0): ?>data-has-sub="true"<?php else: ?>onclick="list_location($(this));return false;"<?php endif; ?> class="<?php if($vo['area_count'] > 0): ?>right-arrow-point-right<?php endif; ?> <?php if($top_area['area_url'] == $vo['area_url']): ?>active<?php endif; ?>">
													<span><?php echo ($vo["area_name"]); ?></span>
													<?php if($vo['area_count'] > 0): ?><span class="quantity"><b></b></span><?php endif; ?>
													<div class="sub_cat hide" style="display:none;">
														<?php if($vo['area_count'] > 0): ?><ul class="dropdown-list">
																<li data-area-id="<?php echo ($vo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name">全部</span></div></li>
																<?php if(is_array($vo['area_list'])): $j = 0; $__LIST__ = $vo['area_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li data-area-id="<?php echo ($voo["area_url"]); ?>" onclick="list_location($(this));return false;"><div><span class="sub-name"><?php echo ($voo["area_name"]); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
															</ul><?php endif; ?>
													</div>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
									<li class="brand-wrapper">
										<ul class="dropdown-list"></ul>
									</li>
									<li class="sort-wrapper">
										<ul class="dropdown-list">
											<?php if(is_array($sort_array)): $i = 0; $__LIST__ = $sort_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-sort-id="<?php echo ($vo["sort_id"]); ?>" <?php if($vo['sort_id'] == $now_sort_array['sort_id']): ?>class="active"<?php endif; ?> onclick="list_location($(this));return false;"><span><?php echo ($vo["sort_value"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</li>
									<li class="subway-wrapper">
										<ul class="dropdown-list"></ul>
									</li>
								</ul>
							</div>
							<div id="dropdown_sub_scroller" class="dropdown-sub-scroller" style="overflow: hidden;">
								<ul class="dropdown-list"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="deal-container">
				<div class="deals-list" id="deals">
				<?php if($meal_list): ?><dl class="list list-in">
						<?php if(is_array($meal_list)): $i = 0; $__LIST__ = $meal_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
								<a href="<?php echo U('Food/shop', array('mer_id' => $vo['mer_id'], 'store_id' => $vo['store_id']));?>" class="react">
									<div class="dealcard" data-did="<?php echo ($vo["store_id"]); ?>">
										<div class="dealcard-img imgbox">
											<img src="<?php echo ($vo["image"]); ?>" style="width:100%;height:100%;">
										</div>
										<div class="dealcard-block-right">
											<div class="dealcard-brand single-line"><?php echo ($vo["name"]); ?></div>
											<div class="title text-block">【<?php echo ($vo["area_name"]); ?>】<?php echo ($vo["name"]); ?></div>
											<div class="price">
												<?php if($vo['mean_money'] > 0): ?><span class="strong-color"><?php echo ($vo["mean_money"]); ?>元(人均)</span>
												<?php else: ?>
												
												<strong>&nbsp;</strong>
												<span class="strong-color">&nbsp;</span><?php endif; ?>
												<span class="line-right">已售<?php echo ($vo['sale_count']); ?></span>
											</div>
											<?php if(isset($vo['juli'])): ?><div class="location_list">约<em><?php echo round($vo['juli']/1000,1);?></em>km</div><?php endif; ?>
										</div>
									</div>
								</a>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<?php if($pagebar): ?><dl class="list">
						<dd>
							<div class="pager"><?php echo ($pagebar); ?></div>
						</dd>
					</dl><?php endif; ?>
				<?php else: ?>	
					<div class="no-deals">暂无区域的餐饮店，请查看其他分类</div><?php endif; ?>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
					<div class="loading-spin" style="top: 91px;"></div>
				</div>
			</div>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script>
		$(function(){
			$('#container').css('min-height',$(window).height()-$('header.navbar').height()-60+'px');
		});
		</script>
		<script src="<?php echo ($static_path); ?>js/dropdown.js"></script>
		<script>
			var location_url = "<?php echo U('Meal_list/index');?>";
			var now_area_url="<?php if(!empty($now_area_url) && $all_area_list): echo ($now_area_url); else: ?>-1<?php endif; ?>";
			var now_sort_id="<?php if(!empty($now_sort_array)): echo ($now_sort_array["sort_id"]); else: ?>store_id<?php endif; ?>";
			var now_cat_url="<?php if(!empty($now_category_url)): echo ($now_category_url); else: ?>all<?php endif; ?>";
		</script>
		<script src="<?php echo ($static_path); ?>js/meallist.js"></script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        

<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal_list",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Meal_list/index');?>",
            "tTitle": "<?php echo ($config["meal_alias_name"]); ?>店铺列表_<?php echo ($config["site_name"]); ?>",
            "tContent": ""
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>