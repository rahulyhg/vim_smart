<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<title>物业综合服务平台</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/Car/Admin/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="/Car/Admin/Public/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="/Car/Admin/Public/assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN : LOGIN PAGE 5-2 -->
<div class="user-login-5">
	<div class="row bs-reset">
		<div class="col-md-6 login-container bs-reset">
			<img class="login-logo login-6" id="login_pic" src="/Car/Admin/Public/assets/pages/img/login/login-invert.png" />
			<div class="login-content">
				<h1 id="login_title"><img src="" class="logo-default" id="login_title_pic">-后台登录</h1>
				<!--<p> 汇得行物业综合服务平台是武汉邻钱网络科技有限公司针对物业行业特性完全自主研发的一套智慧物业管理系统，致力于智慧物业的管理及应用，同时实现对潜在增值服务的探索与发掘。 </p>-->
				<form class="login-form" method="post" action="{pigcms{:U('Login/check_new')}">
					<input type="hidden" name="system" id="system">
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>
						<span>亲！别急！在进入智慧物业系统之前需要登录，请先输入您的账号口令 </span>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="用户名"  id="account" value="{pigcms{$_GET.account}" name="account" required/> </div>
						<div class="col-xs-6">
							<input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="密码" name="pwd" id="pwd" value="{pigcms{$_GET.pwd}" required/> </div>
					</div>

					<!-- <p>

						<label>验证码：</label>

						<input class="text-input" type="text" id="verify" style="width:60px;" maxlength="4" name="verify"/>

					<span id="verify_box">

						<img src="{pigcms{:U('Login/verify')}" id="verifyImg" onclick="fleshVerify('{pigcms{:U('Login/verify')}')" title="刷新验证码" alt="刷新验证码"/>

						<a href="javascript:fleshVerify('{pigcms{:U('Login/verify')}')" id="fleshVerify">刷新验证码</a>

					</span>

					</p> -->
					<!--
                    <div class="row">
                        <div class="col-xs-6">
                            <img src="{:U('Admin/checkCode')}" onclick='this.src="__MODULE__/Admin/checkCode?"+Math.random()'><span id="code_notice"></span> </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" maxlength="5" type="text" onkeyup="check_code(this)" autocomplete="off" placeholder="请输入正确的验证码" name="verify" required/> </div>
                    </div>
                    -->
					<div class="row">
						<div class="col-sm-4">
							<label class="rememberme mt-checkbox mt-checkbox-outline">
								<input type="checkbox" name="remember" value="1" /> 记住用户名和密码
								<span></span>
							</label>
						</div>
						<div class="col-sm-8 text-right">
							<div class="forgot-password">
								<a href="javascript:;" id="forget-password" class="forget-password">忘记密码？点此找回！</a>
							</div>
							<input id="goin_system" class="btn blue" type="submit" value="登录后台"/>
						</div>
					</div>
				</form>
				<!-- BEGIN FORGOT PASSWORD FORM -->
				<form class="forget-form" action="javascript:;" method="post">
					<h3>邻钱科技提醒您！您正在执行找回密码操作</h3>
					<p> 请输入您的电子邮箱，以便通过您的电子邮箱找回您的密码！ </p>
					<div class="form-group">
						<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="请在此输入您注册时使用的电子邮箱" name="email" /> </div>
					<div class="form-actions">
						<button type="button" id="back-btn" class="btn blue btn-outline">返回</button>
						<button type="submit" class="btn blue uppercase pull-right">提交找回申请</button>
					</div>
				</form>
				<!-- END FORGOT PASSWORD FORM -->
			</div>
			<div class="login-footer">
				<div class="row bs-reset">
					<div class="col-xs-5 bs-reset">
						<ul class="login-social">
							<li>
								<a href="javascript:;">
									<i class="fa fa-weixin"></i>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-weibo"></i>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa fa-qq"></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-xs-7 bs-reset">
						<div class="login-copyright text-right">
							<p>Copyright &copy; 邻钱科技 2018</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 bs-reset">
			<div class="login-bg"> </div>
		</div>
	</div>
</div>
<!-- END : LOGIN PAGE 5-2 -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/pages/scripts/login-5.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<!--插入layer弹层js结束-->

<script type="text/javascript">


	/*
	 var code_flag=false;
	 //校验验证码是否正确
	 function check_code(obj){
	 if( $(obj).val().length==5 ){
	 var checkcode=$(obj).val();

	 //通过ajax校验验证码是否正确
	 $.ajax({
	 url:"{:U('check_code')}",
	 data:{'checkcode':checkcode},
	 dataType:'json',
	 type:'post',
	 success:function(msg){
	 if(msg=='1'){
	 $('#code_notice').html('验证码正确').css({"color":"green","font-size":"26px"});
	 code_flag=true;
	 $('#goin_system').prop('type','submit');
	 }else{
	 $('#code_notice').html('验证码错误').css({"color":"red","font-size":"26px"});
	 //同时阻止表单提交
	 code_flag=false;
	 $('#goin_system').prop('type','button');
	 }
	 }
	 });
	 }else{
	 $('#code_notice').html('');
	 }
	 }

	 //判断表单是否达到提交条件，并执行或者阻止
	 $('#goin_system').click(function(){
	 if( code_flag===false ){
	 layer.msg('请输入正确的验证码！', {icon: 5});
	 }
	 });

	 */
	
	$(document).ready(function(){
        
        var url = window.location.href;
        var str = url.substr(url.lastIndexOf('system='),);
        var num = str.substr(str.lastIndexOf('=')+1,);
        var pic = document.getElementById("login_pic");
        // console.log(url);
        // console.log(str);
        console.log(num);
        // console.log(pic);   pic.src="/Car/Admin/Public/assets/pages/img/login/vlg"+num+".jpg";
        if(/^\d+$/.test(num)){
            pic.src="/Car/Admin/Public/assets/pages/img/login/login-invert"+num+".png";
            document.getElementById("login_title_pic").src="/Car/Admin/Public/assets/pages/img/login/login-invert"+num+".png";
            $("#system").attr("value",num);           
        }else{
            pic.src="/Car/Admin/Public/assets/pages/img/login/login-invert.png";
            document.getElementById("login_title_pic").src="/Car/Admin/Public/assets/pages/img/login/login-invert.png";
        }

        if (num == '1') {
        	document.title = '邻钱快递收发管理系统';
        } else if(num == '2') {
        	document.title = '邻钱在线考试管理系统';
        } else if(num == '3') {
        	document.title = '邻钱设施设备管理系统';
        } else if(num == '4') {
        	document.title = '邻钱固定资产管理系统';
        } else if(num == '5') {
        	document.title = '邻钱在线抄表管理系统';
        } else if(num == '6') {
        	document.title = '邻钱在线巡更管理系统';
        } else {
        	document.title = '物业综合服务平台';
        }
    });

</script>

</body>

</html>