<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<?php if($is_wexin_browser): ?><title>附近<?php echo ($config["group_alias_name"]); ?></title>
	<?php else: ?>
		<title>附近的<?php echo ($config["group_alias_name"]); ?>列表_<?php echo ($config["site_name"]); ?></title><?php endif; ?>
	<meta name="keywords" content="<?php echo ($now_category["cat_name"]); ?>,<?php echo ($config["seo_keywords"]); ?>" />
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>
</head>
<body>
        <div id="container">
	        <!--section class="banner"></section>  -->
			<div class="nav-bar">
			    <ul class="nav" style="padding:0rem .2rem;">
		            <li class="dropdown-toggle caret1 category"  style="text-align: left"><span class="nav-head-name"><?php echo ($adress); ?></span></li><a href="<?php echo U('Group/around_adress');?>" class="modify">修改</a>
			    </ul>
			</div>		
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<?php if($group_list): ?><dl class="list list-in">
		       				<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
			        				<a href="<?php echo ($vo["url"]); ?>" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="<?php echo ($vo["list_pic"]); ?>" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<?php if($vo['tuan_type'] != 2): ?><div class="dealcard-brand single-line"><?php echo ($vo["merchant_name"]); ?></div>
													<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
												<?php else: ?>
													<div class="dealcard-brand single-line"><?php echo ($vo["s_name"]); ?></div>
													<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div><?php endif; ?>
										        <div class="price">
										            <strong><?php echo ($vo["price"]); ?></strong>
										            <span class="strong-color">元</span>
										            <?php if($vo['wx_cheap']): ?><span class="tag">微信再减<?php echo ($vo["wx_cheap"]); ?>元</span>
										            <?php else: ?>
										            	<del><?php echo ($vo["old_price"]); ?>元</del><?php endif; ?>
										            <?php if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span><?php endif; ?>													
										        </div>
												<?php if(isset($group_around_range[$vo['group_id']])): ?><div class="location_list">约<em><?php echo round($group_around_range[$vo['group_id']]/1000,1);?></em>km</div><?php endif; ?>
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
						<div class="no-deals">您附近暂时还没有<?php echo ($config["group_alias_name"]); ?></div><?php endif; ?>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
			        <div class="loading-spin" style="top:91px;"></div>
			    </div>
			</div>
		</div>
		<script>
			var lat_long = "<?php echo ($lat_long); ?>";
		</script>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script src="<?php echo ($static_path); ?>js/dropdown.js"></script>
		<script src="<?php echo ($static_path); ?>js/grouplist.js"></script>
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
$(document).ready(function(){
	$.get('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
		$('.nav-head-name').html(data.result.formatted_address);
	}, 'jsonp');
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Group/index');?>",
            "tTitle": "<?php echo ($config["group_alias_name"]); ?>列表_<?php echo ($config["site_name"]); ?>",
            "tContent": ""
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>