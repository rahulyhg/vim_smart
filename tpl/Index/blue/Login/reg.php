<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>注册 | {pigcms{$config.site_name}</title>
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="{pigcms{$config.site_url}/tpl/Static/default/css/common.v113ea197.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$config.site_url}/tpl/Static/default/css/base.v492b572b.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$config.site_url}/tpl/Static/default/css/login.v7e870f72.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$config.site_url}/tpl/Static/default/css/login-section.vfa22738e.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$config.site_url}/tpl/Static/default/css/qrcode.v74a11a81.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/footer.css" />
	<script src="{pigcms{$static_public}js/jquery.min.js"></script>
</head>
<body id="login" class="theme--www" style="position: static;">
	<header id="site-mast" class="site-mast site-mast--mini" style="border-bottom: 2px solid #f84848;">
	     <div class="site-mast__branding cf" style="margin:5px auto">
			<a href="{pigcms{$config.site_url}"><img src="{pigcms{$config.site_logo}" alt="{pigcms{$config.site_name}" title="{pigcms{$config.site_name}" style="width:190px;height:60px;"/></a>
	    </div>
	</header>
	<div class="site-body pg-login cf">
	    <div class="promotion-banner">
	        <img src="{pigcms{$config.site_url}/tpl/Static/default/css/img/web_login/{pigcms{:mt_rand(1,4)}.jpg" width="480" height="370">    
	    </div>
	    <div class="component-login-section component-login-section--page mt-component--booted" >
		    <div class="origin-part theme--www">
			    <div class="validate-info" style="visibility:hidden"></div>
		        <h2>账号注册</h2>
		        <form id="J-login-form" method="post" class="form form--stack J-wwwtracker-form">
			        <div class="form-field form-field--icon">
			            <i class="icon icon-user"></i>
			            <input type="text" id="login-phone" class="f-text" name="phone" placeholder="手机号"/>
			        </div>
			        <div class="form-field form-field--icon" >
			            <i class="icon icon-password"></i>
			            <input type="password" id="login-password" class="f-text" name="pwd" placeholder="密码"/>
			        </div>
					<div class="form-field form-field--icon" >
			            <i class="icon icon-password"></i>
			            <input type="password" id="login-repassword" class="f-text" name="repwd" placeholder="再输入一次密码"/>
			        </div>
					<div class="form-field form-field--icon" id="vfycodediv">
			            <i class="icon icon-phone"></i>
			            <input type="text" id="login-vfycode" class="f-text" name="vfycode" placeholder="输入短信验证码" value=""/>
			        </div>
					  <div class="form-field form-field--ops">
			            <input type="button" class="btn" id="sms_commit" value="发送短信验证" style="width:64%"/>
						&nbsp;&nbsp;&nbsp;<span class="btn noact" style="width:15%;"><span id="reciprocal">60</span>秒</span>
			        </div>
   <if condition="$config['register_agreement'] neq ''">
					<p class="signup-guide"><input type="checkbox" id="register_agreement" checked>同意《注册协议》<a href="javascript:;" id="read_register_agreement">查看协议</a></p>
					</if>
					
			        <div class="form-field form-field--ops">
			            <input type="hidden" name="fingerprint" class="J-fingerprint"/>
			            <input type="hidden" name="origin" value="account-login"/>
			            <input type="submit" class="btn" id="commit" value="注册"/>
			        </div>
			    </form>
				<p class="signup-guide">已有账号？<a href="{pigcms{:U('Login/index',array('referer'=>urlencode($referer)))}">立即登录</a></p>
		    </div>
		</div>
	</div>
	<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			if($('body').height() < $(window).height()){
				$('.site-info-w').css({'position':'absolute','width':'100%','bottom':'0'});

			}
			$("#J-login-form").submit(function(){
				$('.validate-info').css('visibility','hidden');
				$('#commit').val('注册中...').prop('disabled',true);
				
				$("#login-phone").val($.trim($("#login-phone").val()));
				$("#login-password").val($.trim($("#login-password").val()));
				$("#login-repassword").val($.trim($("#login-repassword").val()));
				
				if ($('#register_agreement').size() > 0 && !($('#register_agreement').is(':checked'))) {
					error_tips('同意注册协议后才能注册','register_agreement');
					return false;
				}
				var phone = $("#login-phone").val();
				var pwd = $("#login-password").val();
				var repwd = $("#login-repassword").val();
				//短信验证码 edit by wxblue
				var vfycode = $("#login-vfycode").val();
				
				if(phone == '' || phone == null){
					error_tips('手机号不能为空','login-phone');
					return false;
				}
				if(!/^[0-9]{11}$/.test(phone)){
					error_tips('请输入11位数字的手机号码','login-phone');
					return false;
				}
				if(pwd == '' || pwd == null){
					error_tips('密码不能为空','login-password');
					return false;
				}
				if(pwd != repwd){
					error_tips('两次密码输入不一致','login-repassword');
					return false;
				}
				//短信验证码 edit by wxblue
				/*if(vfycode==''||vfycode==null){
					error_tips('短信验证码不能为空','login-vfycode');
					return false;
				}*/
				//短信验证码 edit by wxblue
				$.post("{pigcms{:U('Index/Login/reg')}", {'phone':phone,'pwd':pwd,'vfycode':vfycode}, function(data){
					if(data.error_code){
						$("#commit").val('注册').prop('disabled',false);
						$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						return false;
					}else if(data.user){
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>注册且登录成功！正在跳转.').css('visibility','visible');
						setTimeout("location.href='{pigcms{$referer}'", 1000);
					}else{
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>注册成功！正在跳转登录页.').css('visibility','visible');
						setTimeout("location.href='{pigcms{:U('Login/index',array('referer'=>urlencode($referer)))}'", 1000);
					}
				}, 'json');
				return false;
			});
			$('#read_register_agreement').click(function(){
				art.dialog.open("{pigcms{:U('Login/register_agreement')}&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'注册协议',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
			});
			
			art.dialog.open("{pigcms{:U('Index/Recognition/see_login_qrcode',array('referer'=>urlencode($referer)))}&"+Math.random(),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('login_iframe_handle',iframe);
				},
				id: 'login_handle',
				title:'微信扫码快速注册',
				padding: 0,
				width: 430,
				height: 433,
				lock: true,
				resize: false,
				background:'black',
				button: null,
				fixed: false,
				close: null,
				left: '50%',
				top: '38.2%',
				opacity:'0.4'
			});
		});
		function error_tips(msg,id){
			$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+msg).css('visibility','visible');
			$("#commit").val('注册').prop('disabled',false);
			$('#'+id).focus();

		}
		
		$("#sms_commit").click(function(){
				$('.validate-info').css('visibility','hidden');
				$('#sms_commit').val('正在发短信...').prop('disabled',true);
				var phone = $.trim($("#login-phone").val());
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					$("#sms_commit").val('发送短信验证').prop('disabled',false);
					return false;
				}
				
				$.post("{pigcms{:U('Index/Login/sendsms')}", {'phone':phone}, function(data){
					data.error_code=parseInt(data.error_code);
					if (!data.error_code) {
						$("#sms_commit").val('重发送短信验证');
						$("#vfycodediv").css('visibility','visible');
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>请输入短信验证码').css('visibility','visible');
						flage=data.id;
						Reciprocal();
						return false;
					}else {
						if(data.error_code == 1){
						  $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						  $("#sms_commit").val('重发送短信验证').prop('disabled',false);
						}else if(data.error_code == 3){
						   $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						   $("#sms_commit").val('重发送短信验证').prop('disabled',false);
						}
					}
				}, 'json');
				return false;
			});

		function Reciprocal(){
		   $("#reciprocal").parent('.btn').removeClass('noact');
			 var inttmp=window.setInterval(function(){
			  num = $("#reciprocal").text();
			  num = parseInt(num);
			 $("#reciprocal").text(num-1);
			 if(num==1){
				$("#reciprocal").parent('.btn').addClass('noact');
				//flage=0;
				$("#sms_commit").val('重发送短信验证').prop('disabled',false);
				window.clearInterval(inttmp);
				setTimeout(function(){
					$("#reciprocal").text(60);
				}, 1000);
			 }
		   },1000);
		}	
	</script>
	<include file="Public:footer"/>
</body>
</html>