<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>商家地图</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js?444"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?210" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/merchant_map.js?210" charset="utf-8"></script>
		<style>
			#introBox{padding:0 12px;background-color:white;height:79px;border-top:1px solid #f1f1f1;}
			#introBox .title{font-size:18px;height:40px;line-height:40px;}
			#introBox .title .right{font-size:12px;float:right;}
			.anchorBL{height:20px!important;}
			.anchorBL a img{height:12px!important;width:34px!important}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="scroller">
				<div id="around-map"></div>
				<div id="introBox">
					<div class="title"><?php echo ($now_group["store_list"]["0"]["name"]); if($now_group['store_list'][0]['range']): ?><div class="right"><?php echo ($now_group['store_list'][0]['range']); ?></div><?php endif; ?></div>
					<div class="desc"><?php echo ($now_group["store_list"]["0"]["area_name"]); echo ($now_group["store_list"]["0"]["adress"]); ?></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('#around-map').height($(window).height()-80);
			var _ary = [<?php if(is_array($now_group['store_list'])): $i = 0; $__LIST__ = $now_group['store_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>[<?php echo ($vo['long']); ?>,<?php echo ($vo['lat']); ?>,"<?php echo ($vo['name']); ?>","<?php echo ($vo['store_id']); ?>","<?php echo ($vo['phone']); ?>","<?php echo ($vo["area_name"]); echo ($vo["adress"]); ?>","<?php if($vo['range']): echo ($vo['range']); endif; ?>"],<?php endforeach; endif; else: echo "" ;endif; ?>];
		</script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script>
		<script type="text/javascript">	
			// 百度地图API功能
			var map = new BMap.Map("around-map",{enableMapClick:false});            // 创建Map实例
			map.centerAndZoom(new BMap.Point(_ary[0][0],_ary[0][1]),11);                 // 初始化地图,设置中心点坐标和地图级别。
			map.addControl(new BMap.ZoomControl());      //添加地图缩放控件
			var store_point =[];
			var result = getSearchListPoints();
			$.each(result,function(i,item){
				if(i == 0){
					var marker = new BMap.Marker(item.point,{icon:new BMap.Icon("<?php echo ($static_path); ?>images/blue_marker.png", new BMap.Size(24,25))});
				}else{
					var marker = new BMap.Marker(item.point,{icon:new BMap.Icon("<?php echo ($static_path); ?>images/red_marker.png", new BMap.Size(24,25))});
				}
				store_point[i] = marker;
				map.addOverlay(marker);
				var tmpHtml = '<div class="title">'+item.title+(item.range != -1 ? '<div class="right">'+item.range+'</div>' : '')+'</div><div class="desc">'+item.adress+'</div>';
				marker.addEventListener("click", function(){
					$.each(result,function(k,ktem){
						if(i == k){
							store_point[k].setIcon(new BMap.Icon("<?php echo ($static_path); ?>images/blue_marker.png", new BMap.Size(24,25)));
						}else{
							store_point[k].setIcon(new BMap.Icon("<?php echo ($static_path); ?>images/red_marker.png", new BMap.Size(24,25)));
						}
					});
					
					$('#introBox').html(tmpHtml);
				});
			});
			function getSearchListPoints(){
				var $$=[],b;
				for(b in _ary){
					8!=_ary[b][0] && $$.push({
						i:b,
						point:new BMap.Point(_ary[b][0],_ary[b][1]),
						title:_ary[b][2],
						id:_ary[b][3],
						phone:_ary[b][4],
						adress:_ary[b][5],
						range:(_ary[b][6] ? _ary[b][6] : -1)
					});
				}
				return $$;
			}
		</script>
	</body>
</html>