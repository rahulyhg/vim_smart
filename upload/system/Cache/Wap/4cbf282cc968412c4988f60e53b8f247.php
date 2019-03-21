<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>查看线路</title>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/detail.css?210"/>
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
	<script type="text/javascript"><?php if($long_lat): ?>var user_long = "<?php echo ($long_lat["long"]); ?>",user_lat = "<?php echo ($long_lat["lat"]); ?>";<?php else: ?>var user_long = '0',user_lat  = '0';<?php endif; ?></script>
</head>
<body>
	<iframe id="frame_src" style="width:100%;height:100%;border:none;"></iframe>
	<script>
		$(window).resize(function(){
			window.location.reload();
		});
		$('#frame_src').height($(window).height());
		getUserLocation({useHistory:false,okFunction:'getIframe'});
		motify.log('正在加载地图',0);
		function getIframe(userLonglat,userLong,userLat){
			geoconv('realResult',userLong,userLat);			
		}
		function realResult(result){
			var origin = encodeURIComponent('当前位置');
			var destination = encodeURIComponent('<?php echo ($now_store["area_name"]); echo ($now_store["adress"]); ?>');
			$('#frame_src').attr('src','http://api.map.baidu.com/direction?origin=latlng:'+result.result[0].y+','+result.result[0].x+'|name:'+origin+'&destination=latlng:<?php echo ($now_store["lat"]); ?>,<?php echo ($now_store["long"]); ?>|name:'+destination+'&mode=driving&region=100010000&src=baidu|jsapi&output=html');
			motify.clearLog();
		}
	</script>
	<?php $no_footer=true; ?>
	<?php if(empty($no_footer)): ?><footer class="footerMenu <?php if(!$is_wexin_browser): ?>wap<?php endif; ?>">
		<ul>
			<li>
				<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>"><em class="home"></em><p>首页</p></a>
			</li>
			<li>
				<a <?php if(MODULE_NAME == 'Group'): ?>class="hover"<?php endif; ?> href="<?php echo U('Group/index');?>"><em class="group"></em><p><?php echo ($config["group_alias_name"]); ?></p></a>
			</li>
			<li class="voiceBox">
				<a href="<?php echo U('Search/voice');?>" class="voiceBtn" data-nobtn="true"></a>
			</li>
			<li>
				<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal'))): ?>class="hover"<?php endif; ?> href="<?php echo U('Meal_list/index');?>"><em class="store"></em><p><?php echo ($config["meal_alias_name"]); ?></p></a>
			</li>
			<li>
				<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>"><em class="my"></em><p>我的</p></a>
			</li>
		</ul>
	</footer><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
</body>
</html>