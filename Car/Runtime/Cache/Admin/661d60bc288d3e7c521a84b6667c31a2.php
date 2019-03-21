<?php if (!defined('THINK_PATH')) exit();?>
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
        <title>Metronic Admin Theme #4 | User Login 6</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
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
                    <img class="login-logo login-6" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/img/login/login-invert.png" />
                    <div class="login-content">
                        <h1>武汉邻钱科技智能停车系统后台登录</h1>
                        <p> 武汉邻钱科技智能停车系统是武汉邻钱科技有限公司完全自主研发的一套系统，致力于各类型停车场智能停车收费管理以及停车场的其它服务，具备停车场商店已经潜在服务和商业数据分析等新颖特色功能 </p>
                        <form action="/index.php/Admin/Admin/admlogin.html" class="login-form" method="post">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>亲！别急！在体验智能系统之前需要登录，请先输入正确的用户名和密码 </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="用户名" name="username" required/> </div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="密码" name="userpassword" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <img src="<?php echo U('Admin/checkCode');?>" onclick='this.src="/index.php/Admin/Admin/checkCode?"+Math.random()'><span id="code_notice"></span> </div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" maxlength="5" type="text" onkeyup="check_code(this)" autocomplete="off" placeholder="请输入正确的验证码" name="verify" required/> </div>
                            </div>
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
                                    <button id="goin_system" class="btn blue" type="submit">开启智能停车系统</button>
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
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; Keenthemes 2015</p>
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
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/excanvas.min.js"></script> 
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/scripts/login-5.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        
        <!--插入layer弹层js开始-->
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>layer.js" type="text/javascript"></script>
        <!--插入layer弹层js结束-->
        
        
        <script type="text/javascript">
            var code_flag=false;
            //校验验证码是否正确
            function check_code(obj){
                if( $(obj).val().length==5 ){
                    var checkcode=$(obj).val();
                    
                    //通过ajax校验验证码是否正确
                    $.ajax({
                        url:"<?php echo U('check_code');?>",
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
            
            
        </script>
        
    </body>

</html>