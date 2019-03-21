/* jQuery cookie 操作*/
jQuery.cookie = function (key, value, options) {
    if (arguments.length > 1 && (value === null || typeof value !== "object")){
        options = jQuery.extend({}, options);
        if (value === null) {
            options.expires = -1;
        }
        if (typeof options.expires === 'number'){
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }
        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? String(value) : encodeURIComponent(String(value)),
            options.expires ? '; expires=' + options.expires.toUTCString() : '',
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
/** laytpl-v1.1 */

;!function(){"use strict";var f,b={open:"{{",close:"}}"},c={exp:function(a){return new RegExp(a,"g")},query:function(a,c,e){var f=["#([\\s\\S])+?","([^{#}])*?"][a||0];return d((c||"")+b.open+f+b.close+(e||""))},escape:function(a){return String(a||"").replace(/&(?!#?[a-zA-Z0-9]+;)/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/'/g,"&#39;").replace(/"/g,"&quot;")},error:function(a,b){var c="Laytpl Error：";return"object"==typeof console&&console.error(c+a+"\n"+(b||"")),c+a}},d=c.exp,e=function(a){this.tpl=a};e.pt=e.prototype,e.pt.parse=function(a,e){var f=this,g=a,h=d("^"+b.open+"#",""),i=d(b.close+"$","");a=a.replace(/[\r\t\n]/g," ").replace(d(b.open+"#"),b.open+"# ").replace(d(b.close+"}"),"} "+b.close).replace(/\\/g,"\\\\").replace(/(?="|')/g,"\\").replace(c.query(),function(a){return a=a.replace(h,"").replace(i,""),'";'+a.replace(/\\/g,"")+'; view+="'}).replace(c.query(1),function(a){var c='"+(';return a.replace(/\s/g,"")===b.open+b.close?"":(a=a.replace(d(b.open+"|"+b.close),""),/^=/.test(a)&&(a=a.replace(/^=/,""),c='"+_escape_('),c+a.replace(/\\/g,"")+')+"')}),a='"use strict";var view = "'+a+'";return view;';try{return f.cache=a=new Function("d, _escape_",a),a(e,c.escape)}catch(j){return delete f.cache,c.error(j,g)}},e.pt.render=function(a,b){var e,d=this;return a?(e=d.cache?d.cache(a,c.escape):d.parse(d.tpl,a),b?(b(e),void 0):e):c.error("no data")},f=function(a){return"string"!=typeof a?c.error("Template not found"):new e(a)},f.config=function(a){a=a||{};for(var c in a)b[c]=a[c]},f.v="1.1","function"==typeof define?define(function(){return f}):"undefined"!=typeof exports?module.exports=f:window.laytpl=f}();

/* 简单的消息弹出层 */
var motify = {
	timer:null,
	/*shade 为 object调用 show为true显示 opcity 透明度*/
	log:function(msg,time,shade){
		$('.motifyShade,.motify').hide();
		if(motify.timer) clearTimeout(motify.timer);
		if($('.motify').size() > 0){
			$('.motify').show().find('.motify-inner').html(msg);
		}else{
			$('body').append('<div class="motify" style="display:block;"><div class="motify-inner">'+msg+'</div></div>');
		}
		if(shade && shade.show){
			if($('.motifyShade').size() > 0){
				$('.motifyShade').css({'background-color':'rgba(0,0,0,'+(shade.opcity ? shade.opcity : '0.3')+')'}).show();
			}else{
				$('body').append('<div class="motifyShade" style="display:block;background-color:rgba(0,0,0,'+(shade.opcity ? shade.opcity : '0.3')+');"></div>');
			}
		}
		if(typeof(time) == 'undefined'){
			time = 3000;
		}
		if(time != 0){
			motify.timer = setTimeout(function(){
				$('.motify').hide();
			},time);
		}
	},
	clearLog:function(){
		$('.motifyShade,.motify').hide();
	},
	checkMobile:function(){
		if(/(iphone|ipad|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
			return true;
		}else{
			return false;
		}
	},
	checkWeixin:function(){
		if(/(micromessenger)/.test(navigator.userAgent.toLowerCase())){
			return true;
		}else{
			return false;
		}
	},
    checkApp:function(){
        if(/(pigcmso2olifeapp)/.test(navigator.userAgent.toLowerCase())){
            return true;
        }else{
            return false;
        }
    },
	getAndroidVersion:function(){
		var index = navigator.userAgent.indexOf("Android");
		if(index >= 0){
			var androidVersion = parseFloat(navigator.userAgent.slice(index+8));
			if(androidVersion > 1){
				return androidVersion;
			}else{
				return 100;
			}
		}else{
			return 100;
		}
	}
};
/*修复Iscroll高版本安卓无法点击*/
function iScrollClick(){
	if (/iPhone|iPad|iPod|Macintosh/i.test(navigator.userAgent)) return false;
	if (/Chrome/i.test(navigator.userAgent)) return (/Android/i.test(navigator.userAgent));
	if (/Silk/i.test(navigator.userAgent)) return false;
	if (/Android/i.test(navigator.userAgent)) {
	   var s=navigator.userAgent.substr(navigator.userAgent.indexOf('Android')+8,3);
	   return parseFloat(s[0]+s[3]) < 44 ? false : true;
    }
}

var voiceBtmTimer =null,voiceLocalId=0;
$(function(){
	FastClick.attach(document.body);
	/*如果页面没有底部导航，修改样式*/
	if($('.footerMenu').size() == 0){
		$('body').css({'padding-bottom':'0px'});
		$('#container').css({bottom:'0px'});
	}
	if(motify.getAndroidVersion() < 4 && $.cookie('lowPhoneVersion') == null){
		if(confirm('您使用的手机安卓版是 '+motify.getAndroidVersion()+'，低于安卓4.0版本，我们为您提供了更流畅的版本！请问是否需要切换？下次访问会重新询问。')){
			$.cookie('lowPhoneVersion','1');
			window.location.reload();
		}else{
			$.cookie('lowPhoneVersion','2');
		}
	}
	// alert(navigator.platform);
	// alert(navigator.userAgent);
	/*语音事件 start*/
	$('.voiceBtn').click(function(e){
		$('body').append('<div class="voiceContainer"><div class="close"></div><div class="title">请大声说出您想要找什么</div><div class="content"><div class="tip">点击按钮开始录音</div><div class="btn"></div></div><div class="searchBtm1"></div><div class="searchBtm2"></div></div>');
		$('.searchBtm1').css({'background-size':$('.searchBtm1').width()+'px '+$('.searchBtm1').height()+'px'});
		$('.searchBtm2').css({'background-size':$('.searchBtm2').width()+'px '+$('.searchBtm2').height()+'px'});

		$('.voiceContainer .close').click(function(){
			if(voiceBtmTimer){
				clearInterval(voiceBtmTimer);
			}
			$('.voiceContainer').remove();
			if($('.voiceContainer .btn').hasClass('start')){
				endVoice();
			}
		});
		$('.voiceContainer .btn').click(function(){
			if($(this).hasClass('start')){
				$('.voiceContainer .tip').html('点击按钮开始录音');
				$(this).removeClass('start');
				clearInterval(voiceBtmTimer);
				endVoice();
			}else{
				beginVoice();
			}
		});
		return false;
	});
	$('.footerMenu li a').click(function(e){
		if($(this).hasClass('active')){
			return false;
			e.stopPropagation();
		}
	});
	/*语音事件 end*/
	
	/*页面点击事件*/
	$(document).on('click','.link-url',function(){
		redirect($(this).data('url'),$(this).data('url-type'));
		return false;
	});
	
	/*A标签*/
	$(document).on('click','a',function(){
		if($(this).data('nobtn')){
			return false;
		}
		var href = $(this).attr('href');
		if(href && href.substr(0,3) != 'tel' && href.substr(0,10) != 'javascript'){
			redirect(href,$(this).data('url-type'));
			return false;
		}
	});
	
	/*电话按钮事件*/
	if($('.phone').size() > 0){
		$('.phone').click(function(event){
			if($(this).attr('data-phone')){
				var tmpPhone = $(this).attr('data-phone').split(' ');
				var bg_height = $('body').height()>$(window).height() ? $('body').height() : $(window).height();
				var msg_dom = '<div class="msg-bg" style="height:'+bg_height+'px;"></div>';
				msg_dom+= '<div id="msg" class="msg-doc msg-option">';
				msg_dom+= '<div class="msg-bd">拨打电话</div>';
				for(var i in tmpPhone){
					msg_dom+= '		<div class="msg-option-btns"><a class="btn msg-btn" href="tel:'+tmpPhone[i]+'">'+tmpPhone[i]+'</a></div>';
				}
				msg_dom+= '		<button class="btn msg-btn-cancel" type="button">取消</button>';
				msg_dom+= '</div>';	
				$('body').append(msg_dom);
			}
			event.stopPropagation();
		});
		$(document).on('click','.msg-btn-cancel',function(){
			$('.msg-doc,.msg-bg').remove();
		});
	}
	
	$('body').append('<div id="pageLoadTip" style="display:none;"><div></div></div>');
});

