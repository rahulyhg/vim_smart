<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
        <title>平台快报</title>     
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?213"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/idangerous.swiper.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>/layer/layer.m.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript">
			var location_url = "<?php echo U('Systemnews/ajaxList');?>";
			var backUrl = "<?php echo C('config.site_url');?>/wap.php";
			var now_cat_id = "<?php echo ($now_cat_id); ?>";
			var count = "<?php echo ($count); ?>";
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/newslist.js?215" charset="utf-8"></script>
		<style>
			.newsListBox dd div{
				font-size:12px;
			}
			.newsListBox dd div{
				margin-right:90px;
				height:21px;
				overflow:hidden;
				word-break:keep-all;
				white-space:nowrap;
				text-overflow:ellipsis;
			}
		</style>
	</head>
	<body>
    <?php if(!$is_app_browser): ?><header class="pageSliderHide"><div id="backBtn"></div>平台快报</header><?php endif; ?>
		<div id="container">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新页面</span>
				</div>
				<section class="villageBox newsBox newsListBox">
					<div class="headBox newsheader">
						<div class="swiper-container swiper-container1">
							<ul class="swiper-wrapper">
								<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="swiper-slide <?php if($i == 1): ?>on<?php endif; ?>" data-cat_id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<dl>
						<!--<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="link-url" data-url="<?php echo U('Systemnews/news',array('id'=>$vo['id']));?>">
								<div><?php echo ($vo["title"]); ?></div>
								<span class="right"><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></span>
							</dd><?php endforeach; endif; else: echo "" ;endif; ?>-->
					</dl>
					
				</section>
				<script id="newsListBoxTpl" type="text/html">
					{{# for(var i = 0, len = d.length; i < len; i++){ }}
						<dd class="link-url" data-url="<?php echo U('Systemnews/news');?>&id={{ d[i].id }}">
							<div>{{ d[i].title }}</div>
							<span class="right">{{ d[i].add_time }}</span>
						</dd>
					{{# } }}
				</script>
			
                <?php if(!$is_app_browser): ?><div id="pullUp" style="bottom:-60px;">
						<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多</span>
                        <!--<img src="<?php echo ($config["site_logo"]); ?>" style="width:130px;height:40px;margin-top:10px"/>-->
                    </div><?php endif; ?>
				
			</div>
		</div>
		<script type="text/javascript">
			window.shareData = {  
				"moduleName":"Systemnews",
				"moduleID":"0",
				"imgUrl": "<?php if($config['wechat_share_img']): echo ($config["wechat_share_img"]); else: echo ($config["site_logo"]); endif; ?>", 
				"sendFriendLink": "<?php echo ($config["site_url"]); echo U('Systemnews/index');?>",
				"tTitle": "平台快报 - <?php echo ($config["site_name"]); ?>",
				"tContent": "点击查看快报详细内容"
			};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>