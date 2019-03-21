var myScroll;
var isApp = motify.checkApp();
$(function(){
    if(!isApp){
	    $('#scroller').css({'min-height':($(window).height()+1)+'px'});
	    myScroll = new IScroll('#container', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: true,scrollX: false, scrollY:true,click:iScrollClick()});
	    myScroll.on("scrollEnd",function(){
		    if(this.y < -250){
			    $('.positionDiv').fadeIn('slow');
		    }else{
			    $('.positionDiv').fadeOut('fast');
		    }
	    });
    }else{
        $('body').append('<style>::-webkit-scrollbar{width:0px;}</style>');
        $('#container,#scroller').css({'position':'static'});
        $(window).scroll(function(){
            if (($(window).scrollTop()) >= $(window).height()){
                $('.positionDiv').fadeIn('slow');
            }else{
                $('.positionDiv').fadeOut('fast');
            }
        })
        $('#pullUp,#pullDown,.back').hide();
        $('body').css({'padding-bottom':'45px'});
    }
	//判断商品图片加载完成
	var imgNum=$('.detail .content img').length;
	$('.detail .content img').load(function(){
		console.log($(this).attr('src'));
		if(!--imgNum && !isApp){
			myScroll.refresh();
		}
	});
	/*myScroll.on("scroll",function(){
		if(this.y >= 0){
			$('.imgBox img').height(200+this.y+'px');
		}else{
			$('.imgBox img').height('200px');
		}
		
		if(maxY >= 50){
			!upHasClass && upIcon.addClass("reverse_icon");
			return "";
		}else if(maxY < 50 && maxY >=0){
			upHasClass && upIcon.removeClass("reverse_icon");
			return "";
		}
	});*/
	if(user_long == '0'){
		getUserLocation({okFunction:'refresh'});
	}
	/* $(window).resize(function(){
		window.location.reload();
	}); */
	
	$('.back').click(function(){
		window.history.go(-1);
	});
	
	$('.storeProList .more').click(function(){
		$(this).remove();
		$('.storeProList li').show();
        if(!isApp){
		    myScroll.refresh();
        }
	});
	//评论
	if($('.introList.comment').size() > 0){
		var cOver = false;
		$.each($('.comment .text'),function(i,item){
			if($(item).height() > 63){
				$(item).closest('.textDiv').addClass('overflow');
				cOver = true;
			}
		});
        if(!isApp){
		    cOver && myScroll.refresh();
        }
		$('.comment .textDiv').click(function(){
			$(this).hasClass('overflow') && $(this).removeClass('overflow');
            if(!isApp){
			    myScroll.refresh();
            }
		});
	}
	if(motify.checkWeixin()){
		$('.imgBox img').click(function(){
			var album_array = $(this).data('pics').split(',');
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		});
		$('.imgList img').click(function(){
			var album_array = $(this).closest('.imgList').data('pics').split(',');
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		});
	}
});