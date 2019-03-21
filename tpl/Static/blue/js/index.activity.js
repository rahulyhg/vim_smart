$(function(){
	var component_slider_timer = null;
	function component_slider_play(){
		component_slider_timer = window.setInterval(function(){
			var slider_index = $('.activityDiv ul li.mt-slider-current-trigger').index();
			if(slider_index == $('.activityDiv ul li').size() - 1){
				slider_index = 0;
			}else{
				slider_index++;
			}
			$('.activityDiv ul li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
			$('.activityDiv ul li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
		},3400);
	}
	component_slider_play();
	$('.activityDiv').hover(function(){
		window.clearInterval(component_slider_timer);
		$('.activityDiv .mt-slider-previous,.activityDiv .mt-slider-next').css({'opacity':'0.6'}).show();
	},function(){
		window.clearInterval(component_slider_timer);
		component_slider_play();
		$('.activityDiv .mt-slider-previous,.activityDiv .mt-slider-next').css({'opacity':'0'}).hide();
	});
	$('.activityDiv .mt-slider-previous,.activityDiv .mt-slider-next').hover(function(){
		$(this).css({'opacity':'1'});
	},function(){
		$(this).css({'opacity':'0.6'});
	});
	$('.activityDiv .mt-slider-previous').click(function(){
		var slider_index = $('.activityDiv ul li.mt-slider-current-trigger').index()-1;
		if(slider_index < 0){
			slider_index = $('.activityDiv ul li').size()-1;
		}
		$('.activityDiv ul li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
		$('.activityDiv ul li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	$('.activityDiv .mt-slider-next').click(function(){
		var slider_index = $('.activityDiv ul li.mt-slider-current-trigger').index()+1;
		if(slider_index == $('.activityDiv ul li').size()){
			slider_index = 0;
		}
		$('.activityDiv ul li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
		$('.activityDiv ul li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
});