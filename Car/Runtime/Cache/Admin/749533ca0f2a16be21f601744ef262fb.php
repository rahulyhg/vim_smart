<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>邻钱智慧停车管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />-->
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!--<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/echarts.min.js"></script>-->
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.ggt:link{color:#FFFFFF; text-decoration:none;}
.ggt:visited{color:#FFFFFF; text-decoration:none;}
.ggt:active{color:#FFFFFF; text-decoration:none;}
.ggt:hover{color:#FFFFFF; text-decoration:none;}

@media screen and (min-width: 769px) {

	.index_left_nav2{display:none;}
}
@media screen and (max-width: 768px) {	
	
	.index_left_nav{display:none;}
}
.btn.red-haze:not(.btn-outline).active, .btn.red-haze:not(.btn-outline):active, .btn.red-haze:not(.btn-outline):hover, .open>.btn.red-haze:not(.btn-outline).dropdown-toggle {
    color: #fff;
    background-color: #f36a5a;
    border-color: #f36a5a;
}
.dropdown-menu {position:absolute;}

.form-control {
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    background-color: #ffffff;
    border: 1px solid #555555;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.form-control, output {
    font-size: 14px;
    line-height: 1.42857;
    color: #555555;
    display: block;
}
select {
  /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
  border: solid 1px #000;

  /*很关键：将默认的select选择框样式清除*/
  appearance:none;
  -moz-appearance:none;
  -webkit-appearance:none;

  /*在选择框的最右侧中间显示小箭头图片*/
  background: url("http://ourjs.github.io/static/2015/arrow.png") no-repeat scroll right center transparent;


  /*为下拉小箭头留出一点位置，避免被文字覆盖*/
  padding-right: 8px;
}


/*清除ie的默认选择框样式清除，隐藏下拉箭头*/
select::-ms-expand { display:block; }
-->
</style></head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo U('Index/index');?>" class="ggt">
                <div style="margin:25px 10px 0; font-size:17px; font-weight:600;">邻钱智慧停车管理系统</div> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <div class="page-actions">
            <div class="btn-group">
				<div class="btn-group index_left_nav" data-toggle="buttons" style="float:left; margin-top:22px; margin-right:10px;">
                    <div class="btn-group" data-toggle="buttons">
						<label class="btn" onClick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new';" style="color:#FFFFFF;"> 智能门禁 </label>
						<label class="btn red-haze active" onClick="window.location.href='<?php echo (C("WEB_DOMAIN")); ?>/index.php?s=/Admin/Index/index.html';"> 智慧停车场 </label>
					</div>
                 </div>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="javascript:;">
                            <i class="icon-docs"></i> 财务对账 </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-tag"></i> 新留言 </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-share"></i> 分享 </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-flag"></i> 评论
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-users"></i> 意见反馈
                            <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
		<div style="margin-top:22px; width:21%; float:left;">
			<select style="width:55%; height:34px; padding:6px 12px; background-color:#FFFFFF; border: 1px solid #c2cad8;" id="select_session">
                <?php if(is_array($s_garage_Arr)): foreach($s_garage_Arr as $key=>$vo): ?><option value="<?php echo ($vo["garage_id"]); ?>" <?php if($_GET['garage_id']== $vo['garage_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["garage_name"]); ?></option><?php endforeach; endif; ?>
			</select>
		</div>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			<form class="search-form" action="<?php echo (C("WEB_DOMAIN")); ?>/index.php?s=/Admin/Servicerecord/search" method="post">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="请输入车牌号或车主姓名" name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                </div>
            </form>
            <!--
			<div class="btn-group index_left_nav2" data-toggle="buttons" style="float:left; margin-left:10px; margin-top:20px;">
                <label class="btn" onClick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new';" style="color:#FFFFFF;"> 智慧助手后台 </label>
				<label class="btn red-haze active" onClick="window.location.href='<?php echo (C("WEB_DOMAIN")); ?>/index.php?s=/Admin/Index/index.html';"> 智慧停车场后台 </label>
           </div>
           -->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> <?php echo (session('admin_name')); ?> </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/img/avatar9.jpg" /> </a>
                        <ul class="dropdown-menu dropdown-menu-default" style="margin-left:-50px; margin-top:10px;">
                            <li>
                                <a href="/Car/index.php?s=admin/user/detail_info/ad_id/<?php echo (session('admin_id')); ?>">
                                    <i class="icon-user"></i> 个人信息 </a>
                            </li>
                            <li>
                                <a href="/Car/index.php?s=admin/user/password_update/ad_id/<?php echo (session('admin_id')); ?>">
                                    <i class="icon-calendar"></i> 修改密码 </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-envelope-open"></i> 我的订单
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-rocket"></i> 我的消息
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-lock"></i> 锁定屏幕 </a>
                            </li>
                            <li>
                                <a href="/Car/index.php?s=/Admin/Login/admlogout">
                                    <i class="icon-key"></i> 退出 </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li>-->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                <li class="nav-item start active open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">邻钱智慧停车管理系统</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                </li>


                <!--***************************************************************停车系统开始************************************************-->
                <li class="heading">
                    <h3 class="uppercase">系统管理后台</h3>
                </li>
                <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="nav-item  " name="show_li">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="<?php echo ($vo["icon"]); ?>"></i>
                        <span class="title"><?php echo ($vo["name"]); ?></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if(is_array($vo['child_list'])): $i = 0; $__LIST__ = $vo['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="nav-item  " >
                            <a href="<?php if(isset($_GET['garage_id'])){echo substr($voo['url'],0,strlen($voo['url'])-5).'/garage_id/'.$_GET['garage_id'];}else{echo $voo['url'];} ?>" class="nav-link ">
                                <span class="title"><?php echo ($voo["name"]); ?></span>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <script src="<?php echo (C("ADMIN_JS_URL")); ?>jquery.js" type="text/javascript"></script>
                <script>
                    $(function(){
                        $('.sub-menu li a').each(function(){
                            if($($(this))[0].href==String(window.location)){
                                $(this).parent().addClass('open');
                                $(this).parent().parent().parent().addClass('open');
                                $(this).parent().parent().parent().find(".sub-menu").show();
                            }

                        });

                    });
                    $("select#select_session").change(function(){
                        var u = $(this).val();
                        var str = window.location.href;
                        var url = '';
                        if(str.indexOf("keywords")>0){
                            location.href=str+'&garage_id='+u;
                        }else{
                            if(str.indexOf("garage_id")>0){
                                url = str.substring(0,str.length-12);
                            }else if(str.indexOf("state")>0){
                                url = str.substring(0,str.length-8);
                            }else{
                                url = str.substring(0,str.length-5);
                            }
                            location.href=url+'/garage_id/'+u;
                        }
                    });
                </script>

            </ul>

        </div>

    </div>


    <!--引入日历插件样式 -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />
<link href="<?php echo (C("ADMIN_CSS_URL")); ?>jquery.datetimepicker.css" rel="stylesheet" type="text/css" />


            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>M手动添加车辆信息
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->
                        <!--<div class="page-toolbar">-->
                            <!--&lt;!&ndash; BEGIN THEME PANEL &ndash;&gt;-->
                            <!--<div class="btn-group btn-theme-panel">-->
                                <!--<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">-->
                                    <!--<i class="icon-settings"></i>-->
                                <!--</a>-->
                                <!--<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">-->
                                    <!--<div class="row">-->
                                        <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                                            <!--<h3>HEADER</h3>-->
                                            <!--<ul class="theme-colors">-->
                                                <!--<li class="theme-color theme-color-default active" data-theme="default">-->
                                                    <!--<span class="theme-color-view"></span>-->
                                                    <!--<span class="theme-color-name">Dark Header</span>-->
                                                <!--</li>-->
                                                <!--<li class="theme-color theme-color-light " data-theme="light">-->
                                                    <!--<span class="theme-color-view"></span>-->
                                                    <!--<span class="theme-color-name">Light Header</span>-->
                                                <!--</li>-->
                                            <!--</ul>-->
                                        <!--</div>-->
                                        <!--<div class="col-md-8 col-sm-8 col-xs-12 seperator">-->
                                            <!--<h3>LAYOUT</h3>-->
                                            <!--<ul class="theme-settings">-->
                                                <!--<li> Theme Style-->
                                                    <!--<select class="layout-style-option form-control input-small input-sm">-->
                                                        <!--<option value="square">Square corners</option>-->
                                                        <!--<option value="rounded" selected="selected">Rounded corners</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Layout-->
                                                    <!--<select class="layout-option form-control input-small input-sm">-->
                                                        <!--<option value="fluid" selected="selected">Fluid</option>-->
                                                        <!--<option value="boxed">Boxed</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Header-->
                                                    <!--<select class="page-header-option form-control input-small input-sm">-->
                                                        <!--<option value="fixed" selected="selected">Fixed</option>-->
                                                        <!--<option value="default">Default</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Top Dropdowns-->
                                                    <!--<select class="page-header-top-dropdown-style-option form-control input-small input-sm">-->
                                                        <!--<option value="light">Light</option>-->
                                                        <!--<option value="dark" selected="selected">Dark</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Sidebar Mode-->
                                                    <!--<select class="sidebar-option form-control input-small input-sm">-->
                                                        <!--<option value="fixed">Fixed</option>-->
                                                        <!--<option value="default" selected="selected">Default</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Sidebar Menu-->
                                                    <!--<select class="sidebar-menu-option form-control input-small input-sm">-->
                                                        <!--<option value="accordion" selected="selected">Accordion</option>-->
                                                        <!--<option value="hover">Hover</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Sidebar Position-->
                                                    <!--<select class="sidebar-pos-option form-control input-small input-sm">-->
                                                        <!--<option value="left" selected="selected">Left</option>-->
                                                        <!--<option value="right">Right</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                                <!--<li> Footer-->
                                                    <!--<select class="page-footer-option form-control input-small input-sm">-->
                                                        <!--<option value="fixed">Fixed</option>-->
                                                        <!--<option value="default" selected="selected">Default</option>-->
                                                    <!--</select>-->
                                                <!--</li>-->
                                            <!--</ul>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; END THEME PANEL &ndash;&gt;-->
                        <!--</div>-->
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="#">车辆信息管理</a>
                            <i class="fa fa-circle"></i>
                        </li>
						<li>
                            <a href="#">车辆信息列表</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">手动添加车辆信息</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <!--<div class="m-heading-1 border-green m-bordered">-->
                        <!--<h3>使用提示</h3>-->
                        <!--<p> 本操作请谨慎使用，正常情况下仅作为开发人员调试或者临时特殊需要添加记录所用-->
                            <!--<a class="btn red btn-outline" href="http://jqueryvalidation.org" target="_blank">不会使用请点此联系相关服务人员指导</a>-->
                        <!--</p>-->
                    <!--</div>-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">手动添加车辆信息</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="#" method="post" class="form-horizontal" id="form_sample_1">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">车牌号
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" name="car_no">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入完整车牌号：请参考系统已有格式录入”</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">车辆车主
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" name="user_id">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入用户id”</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">购入价格
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="" name="car_price">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入车辆购入价格</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">车辆类型
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <select name="car_role" id="">
                                                        <option value="0">临时卡</option>
                                                        <option value="1">月卡</option>
                                                        <option value="2">内部</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">车辆描述</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="car_type" rows="3"></textarea>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请输入车辆信息，例如车辆颜色，车型等”</span>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-9">
                                                    <button type="submit" class="btn green">确认提交</button>
                                                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/Car/index.php?s=/Admin/Car/showlist.html'">返 回</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; 汇得行智慧停车系统
                <a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
                <a href="http://www.metronic.com" target="_blank">Metronic</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN QUICK NAV -->
        <!--<nav class="quick-nav">-->
            <!--<a class="quick-nav-trigger" href="#0">-->
                <!--<span aria-hidden="true"></span>-->
            <!--</a>-->
            <!--<ul>-->
                <!--<li>-->
                    <!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">-->
                        <!--<span>Purchase Metronic</span>-->
                        <!--<i class="icon-basket"></i>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">-->
                        <!--<span>Customer Reviews</span>-->
                        <!--<i class="icon-users"></i>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<a href="http://keenthemes.com/showcast/" target="_blank">-->
                        <!--<span>Showcase</span>-->
                        <!--<i class="icon-user"></i>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">-->
                        <!--<span>Changelog</span>-->
                        <!--<i class="icon-graph"></i>-->
                    <!--</a>-->
                <!--</li>-->
            <!--</ul>-->
            <!--<span aria-hidden="true" class="quick-nav-bg"></span>-->
        <!--</nav>-->
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/excanvas.min.js"></script> 
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>jquery.js" type="text/javascript"></script>
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!--表单提交检查js-->
        <!--<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!--引入日历jquery插件开始-->
        <!--
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>jquery.datetimepicker.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>jquery.datetimepicker.min.js" type="text/javascript"></script>-->
        
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>jquery.datetimepicker.full.js" type="text/javascript"></script>
        <!--引入日历jquery插件结束-->
        
        <script type='text/javascript'>
            //开启日历插件
            $('#datetimepicker').datetimepicker({
                lang:"ch",           //语言选择中文
                format:"Y-m-d H:i:s",      //格式化日期
                timepicker:false,    //关闭时间选项
                yearStart:2000,     //设置最小年份
                yearEnd:2050,        //设置最大年份
                todayButton:false    //关闭选择今天按钮
            });
            $('#datetimepicker2').datetimepicker({
                lang:"ch",           //语言选择中文
                format:"Y-m-d H:i:s",      //格式化日期
                timepicker:false,    //关闭时间选项
                yearStart:2000,     //设置最小年份
                yearEnd:2050,        //设置最大年份
                todayButton:false    //关闭选择今天按钮
            });
        </script>
    </body>

</html>