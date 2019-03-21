<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>优惠导航</title>
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<link href="<?php echo ($static_path); ?>css/iconfont.css" rel="stylesheet"/>
		<link href="<?php echo ($static_path); ?>css/group_navigation.css" rel="stylesheet"/>
		<style>
		.footermenu ul li a img{
			vertical-align: middle;
			border: 0;
		}
		</style>
	</head>
	<body>
		<div class="body" style="position:relative;overflow:hidden;">
			<!--搜索--->
			<form id="searchbox" method="post" action="<?php echo U('Search/group');?>">
				<input placeholder="输入关键字搜索" class="placeholder" id="keyword" name="w" value="" type="text"/>
				<button id="btnfj" type="button" onclick="window.location.href='<?php echo U('Group/around');?>'">附近</button>
				<button id="submit" type="submit"><i class="iconfont icon-050"></i></button>
			</form>

			<!----主要内容---->
			<div class="main" style="margin-bottom:10px;">
				<div class="hot">
					<h3><img src="<?php echo ($static_path); ?>images/hot.jpg"/>热门</h3>
					<ul>
						<?php if(is_array($wap_center_adver)): $i = 0; $__LIST__ = $wap_center_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><div><a href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["pic"]); ?>"/></a></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div style="clear: both;"></div>
					</ul>
				</div>
				<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="park">
						<h3>
							<div>
								<div></div>
								<div><?php echo ($vo["cat_name"]); ?></div>
							</div>
						</h3>
						<ul>
							<?php if(is_array($vo['category_list'])): $i = 0; $__LIST__ = array_slice($vo['category_list'],0,11,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><div><a href="<?php echo U('Group/index',array('cat_url'=>$voo['cat_url']));?>" <?php if($voo['is_hot']): ?>style="color:red;"<?php endif; ?>><?php echo ($voo["cat_name"]); ?></a></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(count($vo['category_list']) > 11): ?><li><div><a href="<?php echo U('Group/index',array('cat_url'=>$vo['cat_url']));?>" style="color:rgb(104,104,181);">更多></a></div></li><?php endif; ?>
							<div style="clear:both;"></div>
						</ul>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
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
        
		</div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script>
			$(function(){
				$('#searchbox').submit(function(){
					if($('#keyword').val() == ''){
						window.location.href = "<?php echo U('Group/index');?>";
						return false;
					}
				});
			});
		</script>
		
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Group",
		            "moduleID":"0",
		            "imgUrl": "<?php echo ($config["site_logo"]); ?>", 
		            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Group/navigation');?>",
		            "tTitle": "优惠导航",
		            "tContent": "网罗全网优惠，查找全城优惠一站搞定"
		};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>