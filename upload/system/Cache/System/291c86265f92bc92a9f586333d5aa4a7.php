<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
	<script type="text/javascript">
		$(function(){
			var store_add_dom = window.top.frames['Openstore_add'];
			var store_add_frame = window.top.frames['Openstore_add'].document;
			$.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2",function(){
				var map = null;
				var oPoint = new BMap.Point(<?php echo ($long_lat); ?>);
				var marker = new BMap.Marker(oPoint);
				var setPoint = function(mk,b){
					var pt = mk.getPosition();
					$('#long_lat',store_add_frame).val(pt.lng+','+pt.lat);
					(new BMap.Geocoder()).getLocation(pt,function(rs){
						addComp = rs.addressComponents;
						if (b===true){
							if(addComp.province && typeof($('#choose_province',store_add_frame)) != 'undefined'){
								$.each($('#choose_province option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.province.indexOf(text)!=-1){
										var choose_province = $('#choose_province',store_add_frame);
										choose_province.find('option').eq(i).prop('selected',true);
										store_add_dom.show_city(choose_province.find('option:selected').attr('value'),choose_province.find('option:selected').html(),1);
										return false;
									}
								});
							}
							if(addComp.city && typeof($('#choose_city',store_add_frame)) != 'undefined'){
								$.each($('#choose_city option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.city.indexOf(text)!=-1){
										var choose_city = $('#choose_city',store_add_frame);
										choose_city.find('option').eq(i).prop('selected',true);
										store_add_dom.show_area(choose_city.find('option:selected').attr('value'),choose_city.find('option:selected').html(),1);
										return false;
									}
								});
							}
							if(addComp.district && typeof($('#choose_area',store_add_frame)) != 'undefined'){
								$.each($('#choose_area option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.district.indexOf(text)!=-1){
										var choose_area = $('#choose_area',store_add_frame);
										choose_area.find('option').eq(i).prop('selected',true);
										store_add_dom.show_circle(choose_area.find('option:selected').attr('value'),choose_area.find('option:selected').html(),1);
										return false;
									}
								});
							}
							$('#adress',store_add_frame).val(addComp.street + addComp.streetNumber);
						}
					});
				};
				
				map = new BMap.Map("cmmap",{"enableMapClick":false});
				map.enableScrollWheelZoom();
				marker.enableDragging();
				
				<?php if(empty($_GET['long_lat'])): ?>map.centerAndZoom(oPoint, 11);
					function myFun(result){
						oPoint = new BMap.Point(result.center['lng'],result.center['lat']);
						map.centerAndZoom(oPoint,11);
						marker.setPosition(oPoint);
					}
					var myCity = new BMap.LocalCity();
					myCity.get(myFun);
				<?php else: ?>
					map.centerAndZoom(oPoint,18);<?php endif; ?>
			
	
				map.addControl(new BMap.NavigationControl());
				map.enableScrollWheelZoom();

				map.addOverlay(marker);
				
				marker.addEventListener("dragend", function(){
					setPoint(marker,true);
				});
				marker.addEventListener("click", function(e){	
					setPoint(marker,true);
				});	
				/*map.addEventListener("click",function(e){
					alert(e.point.lng + "," + e.point.lat);
				});*/
			});
		});
	</script>
	<style>.BMap_cpyCtrl{display:none;}</style>
	<div id="frame_map_tips" style="margin:0">(用鼠标滚轮可以缩放地图)&nbsp;&nbsp;&nbsp;&nbsp;拖动红色图标，左侧经纬度框内将自动填充经纬度。</div>
	<div id="cmmap" style="height:478px;"></div>
	</body>
</html>