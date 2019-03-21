var motify = {
	timer:null,
	log:function(msg){
		$('.motify').hide();
		if(motify.timer) clearTimeout(motify.timer);
		if($('.motify').size() > 0){
			$('.motify').show().find('.motify-inner').html(msg);
		}else{
			$('body').append('<div class="motify" style="display:block;"><div class="motify-inner">'+msg+'</div></div>');
		}
		motify.timer = setTimeout(function(){
			$('.motify').hide();
		},3000);
	}
};
var map = null;
var marker = null;
var mapObjDom = null;
$(function(){
	
	$('section').css('min-height','100%');
	
	$('.comm-service').click(function(){
		if($('#service-type .service-list li').size() > 1){
			$('#service-type').show();
			$('#main').hide();
		}
	});
	
	$('#service-type .service-list li').click(function(){
		$(this).addClass('active').siblings('li').removeClass('active');
		$('.con-service-inner').html($(this).find('h3[data-role="title"]').html()+'：'+$(this).find('span[data-role="content"]').html());
		$('.comm-service span span').html($(this).find('span[data-role="payAmount"]').html());
		$('#service_type').val($(this).data('id'));
		$('#service-type').hide();
		$('#main').show();
		$(window).scrollTop(0);
	});
	
	$('.arrow-wrapper').click(function(){
		closeWin();
	});
	
	$('[data-role="chooseTime"]').click(function(){
		$('#service-date').show();
		$('#main').hide();
	});
	
	$('.yxc-time-con dt[data-role="date"]').click(function(){
		$('.yxc-time-con dt[data-role="date"]').removeClass('active');
		$(this).addClass('active');
		$('.date-'+$(this).data('date')).show().siblings('div').hide();
	});
	
	$('.yxc-time-con dd[data-role="item"]').click(function(){
		if(!$(this).hasClass('disable')){
			$('.yxc-time-con dd[data-role="item"]').removeClass('active');
			$(this).addClass('active');
			$('#serviceJobTime').val($('.yxc-time-con dt[data-role="date"].active').data('text') + ' ' +$(this).data('peroid'));
			$('#service_date').val($('.yxc-time-con dt[data-role="date"].active').data('date'));
			$('#service_time').val($(this).data('peroid'));
			closeWin();
		}
	});
	
	$('textarea.ipt-attr').focus(function(){
		$(this).css('height','60px');
	}).blur(function(){
		if($(this).val() == ''){
			$(this).css('height','24px');
		}
	});
	
	$('.select select').change(function(){
		if($(this).val() != ''){
			$(this).css('color','black');
		}else{
			$(this).css('color','#999');
		}
	});
	
	$('input[data-role="position"]').click(function(){
		$('#service-position').css({'z-index':'1111','opacity':1}).show();
		$('#main').hide();
		if(map == null){
			// $('#allmap').height($(window).height()-41);
		}
		selectPosition($(this));
	});
	$('input[data-role="position-desc"]').keyup(function(){
		$(this).closest('li').find('input[data-type="address"]').val($(this).closest('li').find('input[data-role="position"]').val()+' '+$(this).val());
	});
	
	$("#se-input-wd").bind('input',function(e){
		var address = $.trim($('#se-input-wd').val());
		if(address.length>0 && address !== '直接输入定位您的地址'){
			$('#addressShow').empty();
			$.get('/index.php?g=Index&c=Map&a=suggestion', {query:user_city+address}, function(data){
				if(data.status == 1){
					getAdress(data.result);
				} else {
					//alert(data.result);return false;
				}
			});
		}
	});
	
	$('#addressShow').delegate("li","click",function(){ 
		var addressName = $(this).attr("address");
		var addressLongitude = $(this).attr("lng");
		var addressLatitude = $(this).attr("lat");
		var addressSugAddress = $(this).attr("sug_address");
		layer.open({
			title:['位置提示','background-color:#8DCE16;color:#fff;'],
			content:'您选择的位置是：'+addressName,
			btn: ['确定位置','重新选择'],
			yes:function(index){
				mapObjDom.closest('li').find('input[data-type="long"]').val(addressLongitude);
				mapObjDom.closest('li').find('input[data-type="lat"]').val(addressLatitude);
				mapObjDom.closest('li').find('input[data-type="address"]').val(addressName);
				mapObjDom.data({'long':addressLongitude,'lat':addressLatitude,'address':addressName}).val(addressSugAddress);
				layer.close(index);
				closeWin();
			}
		});
}); 

	
	$('.bt-sub-order').click(function(){
		var nowDom = $(this);
		if($('#store_id').val() == ''){
			$(window).scrollTop($('#store_id').offset().top-20);
			motify.log('请选择预约店铺');
			return false;
		}
		if($('#service_date').val() == ''){
			$(window).scrollTop($('#serviceJobTime').offset().top-20);
			motify.log('请选择预约时间');
			return false;
		}
		var slA = $('#main_form').serializeArray();
		for(var i in slA){
			var tmpDom = $("[name='"+slA[i].name+"']");
			if(tmpDom.data('role')){
				if(tmpDom.data('required')){
					if(tmpDom.data('role') == 'phone' && !/^0?1[3|4|5|7|8][0-9]\d{8}$/.test(slA[i].value)){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'text' && slA[i].value == ''){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'position' && !tmpDom.data('long')){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'textarea' && slA[i].value == ''){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'number' && !/^[0-9]*$/.test(slA[i].value)){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'date'  && slA[i].value == '' ){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'time' && slA[i].value == ''){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'select' && slA[i].value == ''){
						formError(tmpDom);
						return false;
					}else if(tmpDom.data('role') == 'email'  && !/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(slA[i].value)){
						formError(tmpDom);
						return false;
					}
				}
			}
		}
		
		nowDom.addClass('disabled').html('提交中...');
		$.post(window.location.href,$('#main_form').serialize(),function(result){
			if(result.status == 1){
				motify.log('下单成功，正在跳转...');
				window.location.href = result.info;
			}else{
				nowDom.removeClass('disabled').html('立即下单');
				motify.log(result.info);
				return false;
			}
		});
		return false;
	});
});

function formError(tmpDom){
	$('.form_error').removeClass('form_error');
	motify.log(tmpDom.attr('placeholder'));
	$(window).scrollTop(tmpDom.offset().top-20);
	tmpDom.closest('li').addClass('form_error');
}

var map = null;
var marker = null;
function selectPosition(objDom){
	$('.se-input-wd').val('');
	$('#addressShow').empty();
	mapObjDom = objDom;
	// 百度地图API功能
	if(objDom.data('long')){
		// setTimeout(function(){
			map.centerAndZoom(new BMap.Point(objDom.data('long'),objDom.data('lat')), 16);
		// },300);
	}else{
		map = new BMap.Map("allmap",{enableMapClick:false});
		if(user_long == 0){
			map.centerAndZoom(user_city, 16);  
		}else{
			map.centerAndZoom(new BMap.Point(user_long,user_lat), 16);
		}	
		// map.addControl(new BMap.ZoomControl()); //添加地图缩放控件
		
		map.addEventListener("dragend", function(e){
			$('#addressShow').empty();
			var centerMap = map.getCenter();
			getPositionInfo(centerMap.lat,centerMap.lng);
		});
		
		map.addEventListener("load", function(e){
			var centerMap = map.getCenter();
			getPositionInfo(centerMap.lat,centerMap.lng);
		});
	}
}

function getPositionInfo(lat,lng){
	$.getJSON('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location='+lat+','+lng+'&output=json&pois=1&callback=getPositionAdress&json=?');
}

function getPositionAdress(result){
	if(result.status == 0){
		result = result.result;
		var re = [];
		re.push({'name':result.sematic_description,'address':result.formatted_address,'long':result.location.lng,'lat':result.location.lat});
		for(var i in result.pois){
			re.push({'name':result.pois[i].name,'address':result.pois[i].addr,'long':result.pois[i].point.x,'lat':result.pois[i].point.y});
		}
		getAdress(re);
	}else{
		alert('获取位置失败！');
	}
}
function getAdress(re){
	var addressHtml = '';
	for(var i=0;i<re.length;i++){
		addressHtml += '<li lng="'+re[i]['long']+'" lat="'+re[i]['lat']+'" sug_address="'+re[i]['name']+'" address="'+re[i]['address']+'">';
		addressHtml += '<div class="mapaddress-title"><span class="icon-location" data-node="icon"></span><span class="recommend">'+(i == 0 ? '[推荐位置]' : '')+''+re[i]['name']+'</span></div>';
		addressHtml += '<div class="mapaddress-body">'+re[i]['address']+'</div>';
		addressHtml += '</li>';
	}
	$('#addressShow').append(addressHtml);
}

function closeWin(){
	$('#service-type').hide();
	$('#service-date').hide();
	$('#service-position').css({'z-index':'-999','opacity':0});
	$('#main').css('z-index','0').show();
}