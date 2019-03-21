<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>附近的<?php echo ($config["meal_alias_name"]); ?>列表_<?php echo ($config["site_name"]); ?></title>
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
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="<?php echo U('Home/index');?>" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">附近的<?php echo ($config["meal_alias_name"]); ?>店铺列表</h1>
			<div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
					<span class="nav-btn">
						<i class="text-icon">≋</i>导航
					</span>
				</a>
			</div>
			<div id="nav-dropdown" class="nav-dropdown">
				<ul>
					<li><a class="react" href="<?php echo U('Home/index');?>"><i class="text-icon">⟰</i>
						<space></space>首页</a>
					</li>
					<li><a class="react" href="<?php echo U('My/index');?>"><i class="text-icon">⍥</i>
						<space></space>我的</a>
					</li>
					<li><a class="react" href="<?php echo U('Search/index',array('type'=>'meal'));?>"><i class="text-icon">⌕</i>
						<space></space>搜索</a>
					</li>
				</ul>
			</div>
        </header>
        <!--section class="banner"></section>  -->
		<div class="nav-bar">
		    <ul class="nav">
	            <li class="dropdown-toggle caret1 category"  style="text-align: left"><span class="nav-head-name"></span></li><a href="" class="modify">修改</a>
		    </ul>
		</div>
		<div class="deal-container">
			<div class="deals-list" id="deals">
			<?php if($group_list): ?><dl class="list list-in">
       				<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
	        				<a href="<?php echo U('Meal/menu', array('mer_id' => $vo['mer_id'], 'store_id' => $vo['store_id']));?>" class="react">
								<div class="dealcard" data-did="<?php echo ($vo["store_id"]); ?>">
							        <div class="dealcard-img imgbox">
							        	<img src="<?php echo ($vo["image"]); ?>" style="width:100%;height:100%;">
							        </div>
								    <div class="dealcard-block-right">
										<div class="dealcard-brand single-line"><?php echo ($vo["name"]); ?></div>
								        <div class="title text-block">【<?php echo ($vo["area_name"]); ?>】<?php echo ($vo["name"]); ?></div>
								        <div class="price">
								        	<?php if($vo['mean_money'] > 0): ?><strong><?php echo ($vo["mean_money"]); ?></strong>
								            <span class="strong-color">元</span>
								            <?php else: ?>
								            <strong>&nbsp;</strong>
								            <span class="strong-color">&nbsp;</span><?php endif; ?>
								            <span class="tag" style="background: #075CF9;">约<em><?php echo round($vo['juli']/1000,1);?></em>km</span>
								            <span class="line-right">已售<?php echo ($vo['sale_count']); ?></span>
								        </div>
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
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script src="<?php echo ($static_path); ?>js/dropdown.js"></script>
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
var lat_long = "<?php echo ($lat_long); ?>";
$(document).ready(function(){
	$.get('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
		$('.nav-head-name').html(data.result.formatted_address);
	}, 'jsonp');
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal_list",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Meal_list/around');?>",
            "tTitle": "<?php echo ($config["meal_alias_name"]); ?>店铺列表_<?php echo ($config["site_name"]); ?>",
            "tContent": ""
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>