$(function(){
	$('#scroller').css({'min-height':($(window).height()+1)+'px'});
	var myScroll = new IScroll('#container', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:iScrollClick()});
	
	$('.storeProList .more').click(function(){
		$(this).remove();
		$('.storeProList li').show();
		myScroll.refresh();
	});
});