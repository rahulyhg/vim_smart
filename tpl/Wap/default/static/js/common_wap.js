//wxblue
var mobile_timeout;
var mobile_count = 100;
var mobile_lock = 0;
$(function(){
	//$('#container').height($(window).height()-$('header').height()-$('footer').height()-5).css('overflow-y','scroll');
	$('.nav-dropdown-btn').click(function(){
		if($('#nav-dropdown').hasClass('active')){
			$('#nav-dropdown').removeClass('active');
		}else{
			$('#nav-dropdown').addClass('active');
		}
		return false;
	});
	$('body').bind('click',function(e){
		$('#nav-dropdown').removeClass('active');
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop()>150){
			$('.top-btn').show();
		}else{
			$('.top-btn').hide();
		}
	});
	
	$('.top-btn').click(function(){
		$(window).scrollTop(0);
	});
	
	$('.phone').click(function(){
		if($(this).attr('data-phone')){
			var bg_height = $('body').height()>$(window).height() ? $('body').height() : $(window).height();
			var msg_dom = '<div class="msg-bg" style="height:'+bg_height+'px;"></div>';
			msg_dom+= '<div id="msg" class="msg-doc msg-option">';
			msg_dom+= '<div class="msg-bd">拨打电话</div>';
			msg_dom+= '		<div class="msg-option-btns" style="margin-top:0px;"><a class="btn msg-btn" href="tel:'+$(this).attr('data-phone')+'">'+$(this).attr('data-phone')+'</a></div>';
			msg_dom+= '		<button class="btn msg-btn-cancel" data-event="cancel" type="button">取消</button>';
			msg_dom+= '</div>';
			
			$('body').append(msg_dom);
		}
	});
	$('.msg-btn-cancel').live('click',function(){
		$('.msg-doc,.msg-bg').remove();
	});
	
	
	//wxblue
		$("#sms_commit").click(function () {
		if (mobile_lock == 0) {
			var phone = $.trim($('#phone').val());
			$('#phone').val(phone);
			if(phone.length == 0){
				$('#tips').html('请输入手机号码。').show();
				return false;
			}
			if(!/^[0-9]{11}$/.test(phone)){
				$('#tips').html('请输入11位数字的手机号码。').show();
				return false;
			}
			var smode=$("#sms_commit").attr("rel");
			if(smode||typeof(reValue) == "undefined"){smode=1;}
			mobile_lock = 1;
			$.ajax({
				url: '/index.php?g=Index&c=Login&a=sendsms&mode='+smode,
				data: 'phone=' + $("#phone").val(),
				type: 'post',
				success: function(data){
					var ardata=eval("["+data+"]");
					ardata[0].error_code=parseInt(ardata[0].error_code);
					if(ardata[0].error_code == 0) {
						mobile_count = 60;
						BtnCount();
					}else{
						mobile_lock = 0;
						$('#tips').html(ardata[0].msg).show();
					}
				}
			});
		}
	});
	
});

function is_weixin(){
    var ua = navigator.userAgent.toLowerCase();
    if(is_mobile() && ua.match(/MicroMessenger/i)=="micromessenger") {  
        return true;  
    } else {  
        return false;  
    }  
}
function is_mobile(){
	if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
		if((navigator.platform.indexOf("Win") == 0) || (navigator.platform.indexOf("Mac") == 0)){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
}

//wxblue
BtnCount = function () {
	if (mobile_count == 0) {
		$('#sms_commit').html("重新发送");
		mobile_lock = 0;
		clearTimeout(mobile_timeout);
	}
	else {
		mobile_count--;
		$('#sms_commit').html("获取(" + mobile_count.toString() + ")秒");
		mobile_timeout = setTimeout(BtnCount, 1000);
	}
};

