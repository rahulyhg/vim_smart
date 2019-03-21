// var myScroll;
$(function(){
	$('#around-map').height($(window).height());
	// $('#scroller').css({'min-height':($(window).height()+1)+'px'});
	// myScroll = new IScroll('#listList', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:false,scrollbars:true,shrinkScrollbars: 'scale',resizeScrollbars:false,fadeScrollbars:true});
	myScroll = new IScroll('#listList',{probeType:1,disableMouse:true,disablePointer:true,mouseWheel:false,scrollX:false,scrollY:true,click:iScrollClick()});
	
	$(window).resize(function(){
		window.location.reload();
	});
	motify.log('正在调用地图组件',0,{show:true});
	if(user_long == '0'){
		getUserLocation({okFunction:'geoconvPlace',useHistory:false});
	}else{
		getMap(user_long,user_lat);
	}
	
	
});
function geoconvPlace(userLongLat,lng,lat){
	geoconv('getStoreListBefore',lng,lat);
}
function getStoreListBefore(result){
	getMap(result.result[0].x,result.result[0].y);
}
var tmpLng,tmpLat,map,storeBox=[],storePoint=[];
function getMap(lng,lat){
	$.getScript('http://api.map.baidu.com/getscript?type=quick&file=api&ak=4c1bb2055e24296bbaef36574877b4e2&t=20140109092002',function(){
		$.getScript('http://api.map.baidu.com/getscript?type=quick&file=feature&ak=4c1bb2055e24296bbaef36574877b4e2&t=20140109092002',function(){
			map = new BMap.Map("around-map",{enableMapClick:false});            // 创建Map实例
			map.centerAndZoom(new BMap.Point(lng,lat),15);                 // 初始化地图,设置中心点坐标和地图级别。
			map.addControl(new BMap.ZoomControl());      //添加地图缩放控件	
			// var marker = new BMap.Marker(new BMap.Point(lng,lat));
			// map.addOverlay(marker);
			tmpLng = lng;
			tmpLat = lat;
			getStoreList(tmpLng,tmpLat);
			map.addEventListener("dragend", function showInfo(){
				if(map.getZoom() >= 15){
					motify.clearLog();
					var cp = map.getCenter();
					var range = GetDistance(tmpLng,tmpLat,cp.lng,cp.lat);
					if(range > 300){
						tmpLng = cp.lng;
						tmpLat = cp.lat;
						getStoreList(tmpLng,tmpLat);
					}
				}else{
					motify.log('地图范围过大，请扩大后查看');
				}
			});
			map.addEventListener("zoomend", function(){
				motify.clearLog();
				if(this.getZoom() < 15){
					map.clearOverlays();
					motify.log('地图范围过大，请扩大后查看');
				}
			});   
		});
	});
}
//附近店铺列表
function getStoreList(lng,lat){
	motify.log('正在加载周边店铺',0,{show:true});
	$.each(storePoint,function(i,item){
		storePoint[i].closeInfoWindow();
	});
	map.clearOverlays();
	storePoint = [];
	// lng = 117.238061;
	// lat = 31.814095;
	$.post(window.location.pathname+'?c=Merchant&a=ajaxAround',{lng:lng,lat:lat},function(result){
		if(result.length > 0){
			var listHtml = '';
			$.each(result,function(i,item){
				var listUrl = window.location.pathname+'?c=Group&a=shop&store_id='+item.store_id;
				listHtml+= '<dd class="link-url" data-url="'+listUrl+'"><div class="title">'+item.sname+'</div><div class="phone">电话：'+item.phone+'</div><div class="desc">地址：'+item.adress+'</div></dd>';
				// if(i == 0){
					// var marker = new BMap.Marker(new BMap.Point(item['long'],item['lat']),{icon:new BMap.Icon(static_path+"images/blue_marker.png", new BMap.Size(24,25))});
				// }else{
					var marker = new BMap.Marker(new BMap.Point(item['long'],item['lat']),{icon:new BMap.Icon(static_path+"images/red_marker.png", new BMap.Size(24,25))});
				// }
				map.addOverlay(marker);
				storePoint[i] = marker;
				// console.log(item);
				var infoWindow = new BMap.InfoWindow('<div class="windowBox link-url" data-url="'+listUrl+'"><!--img id="imgDemo" src="'+item.img+'"/><br/--><a href="'+listUrl+'" style="color:white;">'+item.sname+'</a><br/>电话：<a href="tel:'+item.phone+'" style="color:#06c1ae;">'+item.phone+'</a><br/>地址：'+item.adress+'</div>');
				marker.addEventListener("click", function(){
					$.each(result,function(k,ktem){
						if(i == k){
							storePoint[k].setIcon(new BMap.Icon(static_path+"images/blue_marker.png", new BMap.Size(24,25)));
						}else{
							storePoint[k].setIcon(new BMap.Icon(static_path+"images/red_marker.png", new BMap.Size(24,25)));
						}
					});
					this.openInfoWindow(infoWindow);
					// document.getElementById('imgDemo').onload = function (){
						// infoWindow.redraw();
					// }
				});
			});
			$('#listList dl').html(listHtml);
		}else{
			$('#listList dl').empty();
		}
		motify.clearLog();
	});
	$(document).on('click','#listBtn',function(){
		$('#listList').height('auto');
		if($('#listList dl').html() != ''){
			$('#listBg,#listList').show();
			if($('#listList dl').height() < $('#listList').height()){
				$('#listList').css({height:$('#listList dl').height()-1+'px',top:(($(window).height()-$('#listList dl').height())/2)});
			}
			myScroll.refresh();
		}else{
			motify.log('屏幕地图中没有店铺');
		}
	});
	$(document).on('click','#listBg',function(){
		$('#listBg,#listList').hide();
	});
}