<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($config["meal_alias_name"]); ?>搜索</title>
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
			var location_url="<?php echo U('Mealservice/search',array('w'=>urlencode($keywords)));?>",now_sort="<?php if(!empty($now_sort)): echo ($now_sort); else: ?>defaults<?php endif; ?>";
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/mealsearch.js?210" charset="utf-8"></script>
	</head>
	<body>
		<section class="searchBar pageSliderHide <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>" style="background-color:white;border-bottom:1px solid #edebeb;">
			<div class="searchBox">
				<form id="search-form" action="<?php echo U('Search/meal');?>" method="post">
					<input type="search" id="keyword" name="w" placeholder="请输入搜索词" autocomplete="off" value="<?php echo ($keywords); ?>"/>
				</form>
			</div>
			<div class="voiceBtn"></div>
		</section>
		<section class="searchBox pageSliderHide">
			<ul>	
				<li class="dropdown-toggle link-url" data-url="<?php echo U('Search/group',array('w'=>urlencode($keywords)));?>"><span class="nav-head-name"><?php echo ($config["group_alias_name"]); ?></span></li>
				<li class="dropdown-toggle active" data-url-type="openLeftWindow"><span class="nav-head-name"><?php echo ($config["meal_alias_name"]); ?></span></li>
				<li class="dropdown-toggle link-url" data-url="<?php echo U('Search/appoint',array('w'=>urlencode($keywords)));?>" ><span class="nav-head-name">预约</span></li>
			</ul>
		</section>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<section class="navBox">
					<ul style="border-top: 1px solid #edebeb;">	
						<li class="dropdown-toggle caret sort <?php if($now_sort == 'default'): ?>active<?php endif; ?>" data-sort="default"><span class="nav-head-name">默认排序</span></li>
						<li class="dropdown-toggle caret sort <?php if($now_sort == 'hot'): ?>active<?php endif; ?>" data-sort="hot"><span class="nav-head-name">销量最高</span></li>
						<li class="dropdown-toggle caret sort <?php if($now_sort == 'price-asc'): ?>active<?php endif; ?>" data-sort="price-asc"><span class="nav-head-name">人均消费最低</span></li>
					</ul>
				</section>
				<script id="groupListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.group_list.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{ d.group_list[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{{ d.group_list[i].image }}" alt="{{ d.group_list[i].name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{ d.group_list[i].name }}</div>								
								<div class="title">{{ d.group_list[i].txt_info }}</div>
								<div class="price">
									{{# if(d.group_list[i].mean_money){ }}<strong>{{ d.group_list[i].mean_money }}</strong><span class="strong-color">元(人均)</span>{{# } }}&nbsp;<span class="line-right">已售{{ d.group_list[i].sale_count }}</span>
								</div>
							</div>
						</dd>
					{{# } }}
				</script>
				<section class="listBox">
					<dl class="dealcard">
						<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
								<div class="dealcard-img imgbox">
									<img src="<?php echo ($vo["image"]); ?>" alt="<?php echo ($vo["name"]); ?>"/>
								</div>
								<div class="dealcard-block-right">									
									<div class="brand"><?php echo ($vo["name"]); ?></div>								
									<div class="title"><?php echo ($vo["txt_info"]); ?></div>
									<div class="price">
										<?php if($vo['mean_money']): ?><strong><?php echo ($vo["mean_money"]); ?></strong><span class="strong-color">元(人均)</span><?php endif; ?>&nbsp;<span class="line-right">已售<?php echo ($vo["sale_count"]); ?></span>
									</div>
								</div>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<div class="noMoreList <?php if(empty($group_list) || $totalPage > 1): ?>hide<?php endif; ?>">没有更多内容了!</div>
					<div class="shade hide"></div>
					<div class="no-deals <?php if(!empty($group_list)): ?>hide<?php endif; ?>">没有找到相关的<?php echo ($config["meal_alias_name"]); ?></div>
				</section>
				<div id="pullUp" <?php if($totalPage < 2): ?>class="noMore loading" style="display:none;"<?php endif; ?>>
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
			</div>
		</div>
		<?php echo ($shareScript); ?>
	</body>
</html>