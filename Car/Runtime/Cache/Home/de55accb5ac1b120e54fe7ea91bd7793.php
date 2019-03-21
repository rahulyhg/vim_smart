<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
        <title>查询停车费</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"> 
        <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/googleapis.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/bootstrap/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
		<link href="<?php echo (C("STATICS_URL")); ?>plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/custom.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo (C("STATICS_URL")); ?>plublic/css/style.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <style type="text/css">
<!--
.mt20 {margin-top:20px;}
.zi {width:48px; height:48px; border:1px #eaeaea solid; text-align:center; color:#848484; font-size:16px; line-height:48px; float:left; margin:5px; background-color:#FFFFFF;}
.zi:link {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
.zi:visited {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
.zi:hover {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
.zi:active  {background-color:#389ffd; color:#FFFFFF; border:1px #389ffd solid; text-align:center;}
.kid {padding: 14px 10px 5px!important;}
.col-md-6 {width:100%;}
.portlet {
    margin-top: 0;
    margin-bottom: 5px;
    padding: 0;
    border-radius: 4px;
}
@media (min-width:414px) and (max-width:500px) {
.dropdown-menu {
    min-width: 558%;
    padding: 5px 0 8px 8px;
}
}
@media (min-width:375px) and (max-width:411px) {
.dropdown-menu {
    min-width: 500%;
    padding: 5px 0 8px 16px;
}
}
@media (min-width:320px) and (max-width:359px) {
.dropdown-menu {
    min-width: 412%;
    padding: 5px 0 8px 13px;
}
}
@media (min-width:360px) and (max-width:374px) {
.dropdown-menu {
    min-width: 480%;
    padding: 5px 0 8px 10px;
}
}
@media (width:412px) {
.dropdown-menu {
    min-width: 580%;
    padding: 5px 0 8px 10px;
}
}
@media (width:768px) {
.dropdown-menu {
    min-width: 1110%;
    padding: 5px 0 8px 30px;
}
}
.input-group-addon, .input-group-btn {
    width: 1%;
    vertical-align: top;
}
-->
</style></head>
<script>
  document.addEventListener('touchstart',function(){},false);
</script>
    <!-- END HEAD -->

    <body>
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div style="padding: 20px 10px 10px!important;">
					<div style="margin:5px 20px 0px 15px; padding-left:30px; font-size:18px; color:#242424; background:url(<?php echo (C("STATICS_URL")); ?>car_bind/images/car.png) no-repeat left; background-size:24px;">绑定车牌</div>
                    <div class="kid"><div class="row">
                        <div class="col-md-6 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                <div class="portlet-body">
                                    <form role="form" action="/?m=Home&c=Car&a=use_service" method="post" formborder="0" >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <div id="car_no_pre_div" class="input-group-btn">
                                                        <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">
                                                            <span id="button_html">
                                                                <span id="car_no_along">鄂</span>
                                                                <span id="car_no_A">A</span>
                                                            </span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <input type="hidden"  name="car_no_pre" value="鄂-A">
                                                        <div id="car_A" class="dropdown-menu" style="display: none;width: 400%;">
                                                            
                                                            <?php for($i=65;$i<91;$i++){ ?>
                                                            <div class="zi"><?php echo strtoupper(chr($i)); ?></div>
                                                            <?php } ?>
                                                            
                                                        </div>
                                                        
                                                        <div class="dropdown-menu">
                                                            <div class="zi">京</div>
                                                            <div class="zi">津</div>
                                                            <div class="zi">沪</div>
                                                            <div class="zi">冀</div>
                                                            <div class="zi">豫</div>
                                                            <div class="zi">云</div>
                                                            <div class="zi">辽</div>
                                                            <div class="zi">黑</div>
                                                            <div class="zi">湘</div>
                                                            <div class="zi">皖</div>
                                                            <div class="zi">鲁</div>
                                                            <div class="zi">新</div>
                                                            <div class="zi">苏</div>
                                                            <div class="zi">浙</div>
                                                            <div class="zi">赣</div>
                                                            <div class="zi">鄂</div>
                                                            <div class="zi">桂</div>
                                                            <div class="zi">甘</div>
                                                            <div class="zi">晋</div>
                                                            <div class="zi">蒙</div>
                                                            <div class="zi">陕</div>
                                                            <div class="zi">吉</div>
                                                            <div class="zi">闵</div>
                                                            <div class="zi">贵</div>
                                                            <div class="zi">粤</div>
                                                            <div class="zi">川</div>
                                                            <div class="zi">青</div>
                                                            <div class="zi">藏</div>
                                                            <div class="zi">琼</div>
                                                            <div class="zi">宁</div>
                                                            <div class="zi">渝</div>
                                                        </div> 
                                                    </div>
                                                    
                                                    <!-- /btn-group -->
                                                    <input type="text" class="form-control" placeholder="车牌后5位" maxlength="5" name="c_no" style="background-color:#f6f6f6; border:1px #ededed solid; border-left:none; height:43px; line-height:43px; -webkit-appearance: none; border-right:none; font-size:15px;">
                                                    <span class="input-group-btn">
                                                        <button class="btn blue" type="submit">&nbsp;&nbsp;&nbsp;新增&nbsp;&nbsp;&nbsp;</button>
                                                    </span>
                                                    <!-- /btn-group -->
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-md-6 -->
                                        </div>
                                        <!-- /.row -->
                                    </form>
                                </div>
                            </div>
							<div class="portlet-title">
								<div style="height:44px;background-color: #f6f6f6;border: 1px #ededed solid; border-radius:4px 4px 0 0; text-align:center; line-height:44px; color:#389ffe; font-family:'微软雅黑'; font-size:16px; margin-top:10px;">
                                                                    <?php if(!empty($result_msg)): echo ($result_msg); ?>
                                                                    <?php else: ?>
                                                                        欢迎使用本服务<?php endif; ?>
                                                                </div>
                                                                
                                                                <!--显示模糊查询的结果-->
                                                                <?php if(!empty($result_datas)): if(is_array($result_datas)): foreach($result_datas as $key=>$v): ?><div style="height:44px;background-color: #f6f6f6;border: 1px #ededed solid; border-radius:4px 4px 0 0; text-align:center; line-height:44px; color:#389ffe; font-family:'微软雅黑'; font-size:16px; margin-top:10px;" onClick="get_this_val_new(this)"><?php echo ($v["attributes"]["carNo"]); ?></div><?php endforeach; endif; endif; ?>
                                                            
                                                                <!--旧用户显示已经绑定的车辆-->
                                                                <?php if(!empty($car_infos)): if(is_array($car_infos)): foreach($car_infos as $key=>$v): ?><div style="height:44px;background-color: #f6f6f6;border: 1px #ededed solid; border-radius:4px 4px 0 0; text-align:center; line-height:44px; color:#389ffe; font-family:'微软雅黑'; font-size:16px; margin-top:10px;" onClick="get_this_val(this)"><?php echo ($v["car_no"]); ?></div><?php endforeach; endif; endif; ?>
							</div>
                        </div>
                    </div>
					<div class="ki">Power by:武汉邻钱科技有限公司</div>
                    <!-- END PAGE BASE CONTENT -->
              </div></div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <!-- END QUICK SIDEBAR -->
        </div>
		</div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo (C("STATICS_URL")); ?>plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("STATICS_URL")); ?>plublic/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo (C("STATICS_URL")); ?>plublic/js/sweetalert.min.js" type="text/javascript"></script>
		<script src="<?php echo (C("STATICS_URL")); ?>plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
        <!--插入layer弹层js开始-->
        <script src="<?php echo (C("HOME_JS_URL")); ?>layer.js" type="text/javascript"></script>
        <!--插入layer弹层js结束-->
        <script type="text/javascript">
            $(function(){
                $(".dropdown-menu").children().click(function(){
                    $('#car_no_along').html($(this).html());
                    $('#car_A').css('display','block');
                });
                $('#car_A').children().click(function(){
                    $('#car_no_A').html($(this).html());
                    $('#car_A').css('display','none');
                    $("input[name='car_no_pre']").val($('#car_no_along').html()+"-"+$('#car_no_A').html());
                });
                
            })
            
            function get_this_val(obj){
                $("input[name='c_no']").val($(obj).html());
                $('#car_no_pre_div').remove();
                $('form').submit();
            }
            
            function submit_this_car(obj){
              
                    layer.msg('确定车牌：'+$(obj).html()+'？', {
                        time: 0 //不自动关闭
                        ,btn: ['确定', '取消']
                        ,yes: function(index){
                            layer.close(index);
                            $("input[name='c_no']").val($(obj).html());
                            $('#car_no_pre_div').remove();
                            $('form').submit();
                        }
                    });
            }
            function get_this_val_new(obj){

                $("input[name='c_no']").val($(obj).html());
                var card=$(obj).html();
                swal({
                    title: "绑定车牌："+card,
                    text: "请确认车牌是否正确，确认请点击继续。",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "继续",
                    confirmButtonColor: "#ec6c62",
                    cancelButtonText:"取消"
                }, function() {
                    $('form').submit();
                });
                $('#car_no_pre_div').remove();
                //$('form').submit();
            }
        </script>
    </body>

</html>