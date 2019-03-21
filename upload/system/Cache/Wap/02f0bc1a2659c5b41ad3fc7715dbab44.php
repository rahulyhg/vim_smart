<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>选取坐标</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="<?php echo ($config["site_url"]); ?>/favicon.ico"/>
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
	<div id="around-map"></div>
	<script src="<?php echo C('JQUERY_FILE');?>"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script>
	<script type="text/javascript">
		$('#around-map').height($(window).height()-$('header').height()-$('footer').height()-49);
		var marker = null;
		// 百度地图API功能
		var map = new BMap.Map("around-map");            // 创建Map实例
		map.centerAndZoom(<?php echo ($map_center); ?>,13);                 // 初始化地图,设置中心点坐标和地图级别。
		map.addControl(new BMap.ZoomControl());      //添加地图缩放控件	
		setTimeout(function(){
			var point = new BMap.Point(map.getCenter().lng,map.getCenter().lat);
			if(marker == null){
				marker = new BMap.Marker(new BMap.Point(map.getCenter().lng,map.getCenter().lat));  //创建标注
				map.addOverlay(marker);                 // 将标注添加到地图中
			}else{
				marker.setPosition(point);
			}
		},1000);
		var gc = new BMap.Geocoder();
		map.addEventListener("click",function(e){
			gc.getLocation(e.point, function(rs){
				if(marker == null){
					marker = new BMap.Marker();
					map.addOverlay(marker);
				}else{
					marker.setPosition(e.point);
				}
				var addComp = rs.addressComponents;
				var infoWindow = new BMap.InfoWindow('<div style="line-height:0.5rem;overflow:hidden;">' + addComp.city + addComp.district + addComp.street + '<br/><a href="javascript:void();" style="font-size:.35rem;" onclick="setSelect(\''+ addComp.city + addComp.district + addComp.street +'\',\''+e.point.lat+'\',\''+e.point.lng+'\')">查看附近<?php echo ($config["group_alias_name"]); ?></a></div>');
				marker.openInfoWindow(infoWindow);
			});
		});
		function setSelect(adress,lat,lng){
			var exp = new Date();
			exp.setTime(exp.getTime() + 365*24*60*60*1000);
			document.cookie = "around_adress=" + encodeURIComponent(adress) + ";expires=" + exp.toGMTString(); 
			document.cookie = "around_lat=" + lat + ";expires=" + exp.toGMTString(); 
			document.cookie = "around_long=" + lng + ";expires=" + exp.toGMTString(); 
			window.location.href = "<?php echo U('Group/around');?>";
		}
	</script>
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
        
<?php echo ($shareScript); ?>
</body>
</html>