<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>预约搜索</title>
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
			var location_url="<?php echo U('Appointservice/search',array('w'=>urlencode($keywords)));?>",now_sort="<?php if(!empty($now_sort)): echo ($now_sort); else: ?>defaults<?php endif; ?>";
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/groupsearch.js?210" charset="utf-8"></script>
	</head>
	<body>
		<section class="searchBar pageSliderHide <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>" style="background-color:white;border-bottom:1px solid #edebeb;">
			<div class="searchBox">
				<form id="search-form" action="<?php echo U('Search/appoint');?>" method="post">
					<input type="search" id="keyword" name="w" placeholder="请输入搜索词" autocomplete="off" value="<?php echo ($keywords); ?>"/>
				</form>
			</div>
			<div class="voiceBtn"></div>
		</section>
		<section class="searchBox pageSliderHide">
			<ul>	
				<li class="dropdown-toggle link-url"data-url="<?php echo U('Search/group',array('w'=>urlencode($keywords)));?>"><span class="nav-head-name"><?php echo ($config["group_alias_name"]); ?></span></li>
				<li class="dropdown-toggle link-url" data-url="<?php echo U('Search/meal',array('w'=>urlencode($keywords)));?>"><span class="nav-head-name"><?php echo ($config["meal_alias_name"]); ?></span></li>
				<li class="dropdown-toggle active" data-url="<?php echo U('Search/appoint',array('w'=>urlencode($keywords)));?>"  data-url-type="openLeftWindow"><span class="nav-head-name">预约</span></li>
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
						<li class="dropdown-toggle caret sort <?php if($now_sort == 'appointNum'): ?>active<?php endif; ?>" data-sort="appointNum"><span class="nav-head-name">预约最多</span></li>
						<li class="dropdown-toggle caret sort <?php if($now_sort == 'price'): ?>active<?php endif; ?>" data-sort="price"><span class="nav-head-name">价格最低</span></li>
					</ul>
				</section>
				<script id="groupListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.group_list.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{d.group_list[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url={{ encodeURIComponent(d.group_list[i].list_pic) }}" alt="{{d.group_list[i].appoint_name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{d.group_list[i].appoint_name }} {{# if(d.group_list[i].juli){ }}<span class="location-right">约：{{d.group_list[i].juli }}km</span>{{# } }}</div>					
								<div class="title">{{d.group_list[i].appoint_content }}</div>
								<div class="price">
									{{# if(d.group_list[i].payment_money){ }}<strong>定金:￥{{d.group_list[i].payment_money }}</strong>&nbsp;{{# } }}
									<span class="tag">{{# if(d.group_list[i].appoint_type == 1){ }}上门{{# }else{ }}到店{{# } }}</span>&nbsp;
									{{# if(d.group_list[i].appoint_sum ){ }}<span class="line-right">已预约{{d.group_list[i].appoint_sum }}</span>{{# } }}
								</div>
							</div>
						</dd>
					{{# } }}
				</script>
				<section class="listBox">
					<dl class="dealcard">
						<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo ($vo["url"]); ?>">
								<div class="dealcard-img imgbox">
									<img src="<?php echo ($config["site_url"]); ?>/index.php?c=Image&a=thumb&width=276&height=168&url=<?php echo ($vo["list_pic"]); ?>" alt="<?php echo ($vo["appoint_name"]); ?>"/>
								</div>
								<div class="dealcard-block-right">									
									<div class="brand"><?php echo ($vo["appoint_name"]); ?> <?php if($vo['juli']): ?><span class="location-right">约：<?php echo round($vo.juli/1000,1);?>km</span><?php endif; ?></div>					
									<div class="title"><?php echo ($vo["appoint_content"]); ?></div>
									<div class="price">
										<?php if($vo['payment_money']): ?><strong>定金:￥<?php echo ($vo["payment_money"]); ?></strong>&nbsp;<?php endif; ?>
										<span class="tag"><?php if($vo["appoint_type"] == 1): ?>上门<?php else: ?>到店<?php endif; ?></span>&nbsp;
										<?php if($vo['appoint_sum']): ?><span class="line-right">已预约<?php echo ($vo["appoint_sum"]); ?></span><?php endif; ?>
									</div>
								</div>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					
					<div class="noMoreList <?php if(empty($group_list) || $totalPage > 1): ?>hide<?php endif; ?>">没有更多内容了!</div>
					<div class="shade hide"></div>
					<div class="no-deals <?php if(!empty($group_list)): ?>hide<?php endif; ?>">没有找到相关的预约</div>
				</section>
				<div id="pullUp" <?php if($totalPage < 2): ?>class="noMore loading" style="display:none;"<?php endif; ?>>
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
			</div>
		</div>
		<?php echo ($shareScript); ?>
	</body>
</html>