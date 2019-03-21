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
    <title>汇得行</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{pigcms{$static_path}css/137/googleapis.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{pigcms{$static_path}css/137/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{pigcms{$static_path}css/137/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{pigcms{$static_path}css/137/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{pigcms{$static_path}css/137/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/137/layer.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <style type="text/css">
        <!--
        input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color: #824b9a; opacity:1;
        }

        input:-moz-placeholder { /* Mozilla Firefox 19+ */
            color: #824b9a;opacity:1;
        }

        input:-ms-input-placeholder{
            color: #824b9a;opacity:1;
        }

        input::-webkit-input-placeholder{
            color: #824b9a;opacity:1;
        }
		h2 {
    color: #373B3E;
    font-size: 14px;
    line-height: 32px;
    padding-left: 10px;
    padding-top: 5px;
    text-align:center;
    font-weight: normal;
}
body {background-color:#FFFFFF;}
        -->
    </style>
</head>
<!-- END HEAD -->

<body>
<form method="post" action="{pigcms{:U('Hotactivity/addPhone')}" id="form1">
<div style="width:100%;"><img src="{pigcms{$static_path}/images/137/x1.jpg" style="width:100%;"></div>
<div style="width:79%; margin:15px auto;">
    <div style="float:left; width:70%;">
        <div style="float:left; margin-left:5px; width:70%;"><input type="text" placeholder="请输入电话号码" style="border:none; background-color:#d6bde6; width:100%; height:28px; color:#824b9a; line-height:28px; border-radius:6px;" name="phone" id="phone" value="{pigcms{$phone}"></div>
        <div style="float:left; width:20%; margin-left:5px;">
            <button type="button" class="btn btn-success mt-sweetalert " id="myform">领取</button>
            <button type="button" style ="display: none" class="btn btn-success mt-sweetalert " data-title="恭喜您，体验券领取成功" data-message="请尽快在2016年12月31日前进店体验" data-type="success" data-allow-outside-click="true" data-confirm-button-class="btn-success" id="mybutton1" >领取</button>
            <button type="button" style ="display: none" class="btn btn-danger mt-sweetalert" data-title="抱歉领取失败！" data-message="请检查您的手机号是否正确" data-type="error" data-allow-outside-click="true" data-confirm-button-class="btn-danger" id="mybutton2">领取</button>
        </div>


            <div style="clear:both"></div>
    </div>
    <div style="float:right; width:20%; margin-top:-1px;"><img src="{pigcms{$static_path}/images/137/logo.png" style="width:100%;"></div>
    <div style="clear:both"></div>
</div>
</form>
<div style="width:80%; margin:0px auto; height:15px; line-height:15px; text-align:center; font-size:12px; color:#999999;">活动主办：汇得行控股（中国）有限公司</div>
<div style="width:80%; margin:0px auto; height:25px; line-height:25px; text-align:center; font-size:12px; color:#999999;">技术支持：武汉邻钱科技有限公司</div>

<script src="{pigcms{$static_path}js/137/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $("#myform").click(function(){
        var phone = $("#phone").val();
       //对用户的手机进行合法性验证
        var flag = false;
        var message = "";
        var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(phone == ''){
            message = "手机号码不能为空！";
        }else if(phone.length !=11){
            message = "请输入有效的手机号码！";
        }else if(!myreg.test(phone)){
            message = "请输入有效的手机号码！";

        }else{
            flag = true;
        }
        if(!flag){
            //alert(message);
            $("#mybutton2").click();
           /*$("#myform").removeClass().addClass("btn btn-danger mt-sweetalert");
           $("#myform").attr("data-title",message);
            $("#myform").attr("data-message","输入正确即可获得丰厚奖励");
            $("#myform").attr("data-type","error");
            $("#myform").attr("data-confirm-button-class","btn-danger");*/
        }else{
            $.ajax({
                url:"{pigcms{:U('Hotactivity/addPhone')}",
                type:"post",
                data:{'phone':phone},
                success:function (re) {
                    $("#mybutton1").click();
                    $('#phone').attr("disabled",true);
                    $('#phone').attr("value","您已近领取过了");
                    $("#myform").text('已领取');
                }
            });
        }

    });
});
</script>
<script src="{pigcms{$static_path}js/137/bootstrap.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/layer.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/sweetalert.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/ui-sweetalert.min.js" type="text/javascript"></script>
</body>

</html>