<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>{pigcms{$now_village.village_name}</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript">
			var location_url = "{pigcms{:U('House/village_appointlist',array('village_id'=>$now_village['village_id']))}",totalPage = {pigcms{$totalPage};var backUrl = "{pigcms{:U('House/village',array('village_id'=>$now_village['village_id']))}";
		</script>
		<script type="text/javascript" src="{pigcms{$static_path}js/village_grouplist.js?212" charset="utf-8"></script>
		<style>
			body{background-color:#f4f4f4;}
			.appoint{border:none;}
			.dealcard{padding:0px;}
			.dealcard dd{padding:8px;}
		</style>
	</head>
	<body>
		<header class="pageSliderHide"><div id="backBtn"></div>推荐预约</header>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新页面</span>
				</div>
				<if condition="$appoint_list">
					<section class="appoint">
						<dl class="likeBox dealcard" id="listDom">
							<volist name="appoint_list" id="vo">
								<dd class="link-url" data-url="{pigcms{$vo.url}">
									<div class="dealcard-img imgbox">
										<!--img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.name}"/-->
										<img src="/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.appoint_name}"/>   
									</div>
									<div class="dealcard-block-right">
										<div class="brand">{pigcms{$vo.appoint_name} <if condition="$vo['range']"><span class="location-right">{pigcms{$vo.range}</span></if></div>
										<div class="title" style="font-size:14px;margin:4px 0;"><if condition="$vo['payment_money']">定金:￥{pigcms{$vo.payment_money}<else/>无需定金</if>|{pigcms{$vo.appoint_content}</div>
										<div class="price">
											<if condition="$vo['appoint_type'] eq 1"><span class="imgLabel shangmen"></span><else/><span class="imgLabel daodian"></span></if>
											<if condition="$vo['appoint_sum']"><span class="line-right">已预约{pigcms{$vo.appoint_sum}</span></if>
										</div>
									</div>       
								</dd>
							</volist>
						</dl>
					</section>
				</if>
				<div id="pullUp" <if condition="$totalPage eq 1">style="display:none;"</if>>
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
				</div>
				<script id="BoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="{{d[i].url }}">
							<div class="dealcard-img imgbox">
								<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={{ encodeURIComponent(d[i].list_pic) }}" alt="{{d[i].appoint_name }}"/>
							</div>
							<div class="dealcard-block-right">									
								<div class="brand">{{d[i].appoint_name }} {{# if(d[i].juli){ }}<span class="location-right">{{d[i].juli }}</span>{{# } }}</div>	
								<div class="title" style="font-size:14px;margin:4px 0;">{{# if(d[i].payment_money){ }}定金:￥{{d[i].payment_money }}{{# }else{ }}无需定金{{# } }}|{{d[i].appoint_content }}</div>
								<div class="price">
									{{# if(d[i].appoint_type == 1){ }}<span class="imgLabel shangmen"></span>{{# }else{ }}<span class="imgLabel daodian"></span>{{# } }}
									{{# if(d[i].appoint_sum ){ }}<span class="line-right">已预约{{d[i].appoint_sum }}</span>{{# } }}
								</div>
							</div>
						</dd>
					{{# } }}
				</script>
			</div>
		</div>
		{pigcms{$shareScript}
	</body>
</html>