<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>社区列表</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village_list.css?211"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript">
			var location_url = "{pigcms{:U('House/ajax_village_list')}",keyword = "",backUrl="{pigcms{:U('Home/index')}";
			//<if condition="$long_lat">var user_long = "{pigcms{$long_lat.long}",user_lat = "{pigcms{$long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if>
		</script>
		<script type="text/javascript" src="{pigcms{$static_path}js/village_list.js?210" charset="utf-8"></script>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>社区列表</header>
		<section class="searchBar wap pageSliderHide">
			<div class="searchBox">
				<form id="search-form" method="post">
					<input type="search" id="keyword" name="w" placeholder="请输入社区名" autocomplete="off"/>
				</form>
			</div>
			<div class="voiceBtn"></div>
		</section>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉可以刷新</span>
				</div>
				<section class="villageBox hide" id="bindVillageBox">
					<div class="headBox">我的社区</div>
					<dl></dl>
				</section>
				<section class="villageBox hide" id="villageBox">
					<div class="headBox">社区列表</div>
					<dl></dl>
				</section>
				<div class="noMoreDiv hide">未找到相关社区</div>
				<script id="villageBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{pigcms{:U('House/village_select')}&village_id={{ d[i].village_id }}&control={pigcms{$control}">
							<div class="brand">{{ d[i].village_name }}{{# if(d[i].range){ }}<span class="location-right">{{ d[i].range }}</span>{{# } }}</div> 
							<div class="title">{{ d[i].village_address }}</div>
						</dd>
					{{# } }}
				</script>
				<div id="pullUp">
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
			</div>
		</div>
		{pigcms{$shareScript}
	</body>
	<script type="text/javascript">
		var user_long="{pigcms{$long_lat.long}",user_lat="{pigcms{$long_lat.lat}";
		//alert("usre_long:"+user_long);
		$(function(){
			if(user_long=='0' || user_long==''){	//获取定位信息
				getUserLocation({errorAction:1,okFunction:'getRecommendList',errorFunction:'getRecommendList'});
			}
		})
	</script>
</html>