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
<!-- BEGIN HEAD   邻钱智能门禁管理系统 -->

<head>
    <meta charset="utf-8" />
    <title id="span_title"></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES1 -->
    <link href="/Car/Admin/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <script src="/Car/Admin/Public/assets/global/plugins/mapplic/js/html5shiv.js"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
    <![endif]-->
    <!-- END GLOBAL MANDATORY STYLES -->
    <!--console.js -->

    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
	<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />
    <!--<script src="{$Think.config.ADMIN_ASSETS_URL}global/plugins/echarts.min.js"></script>-->
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/Car/Admin/Public/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/Car/Admin/Public/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

    <link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

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

.nav.pull-right>li>.dropdown-menu, .nav>li>.dropdown-menu.pull-right {
    right:0px;
    left: auto;
}
.bootstrap-select .dropdown-menu {margin: 0px}
.dropdown-menu {position: absolute; min-width: 140px;}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-menu {
    width: 140px;
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown>.dropdown-toggle>.badge {
    display: inline-block;
    font-family: "Open Sans",sans-serif;
    margin: -6px 0 0;
    font-weight: 600;
    padding: 6px 5px;
    height: 25px;
    width: 25px;
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu {
    min-width: 200px;
    max-width: 275px;
    width: 275px;
    z-index: 9995;
}

.page-header.navbar .top-menu .navbar-nav>li.dropdown>.dropdown-toggle {
    margin: 0;
    padding: 29px 12px 14px;
}

.page-header.navbar .page-logo .logo-default {
    margin: 20px 10px 0;
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
/*处理表格最后一行下拉菜单被遮盖的问题*/
/*table tr:last-of-type .dropdown-menu {
    position: relative!important;
}
table tr:nth-last-of-type(2) .dropdown-menu {
    position: relative!important;
}*/


</style>

    </head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <!-- <div class="page-logo">
            <a href="<?php echo U('Index/index_new');?>" class="ggt" id="logo_a">
                <img src="" class="logo-default" id="login_in_pic"> </a>
            <div class="menu-toggler sidebar-toggler" onClick="hide_menu()" >
                DOC: Remove the above "hide" to enable the sidebar toggler button on header
            </div>
        </div> -->

        <div class="page-logo">
            <input type="hidden" id="system_id" value="<?php echo ($_SESSION['system_id']); ?>">
            <a href="<?php echo U('Index/index_new');?>" class="ggt" id="logo_a">
                <div style="margin:25px 10px 0; font-size:17px; font-weight:600;" id="logo_text"></div> </a>
            <div class="menu-toggler sidebar-toggler" onClick="hide_menu()" >

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
                <!--<div class="btn-group index_left_nav" data-toggle="buttons" style="float:left; margin-top:22px; margin-right:10px;">
                    <label class="btn red-haze active" onClick="window.location.href='<?php echo (C("WEB_DOMAIN")); ?>/admin.php?g=System&c=Index&a=index_new';"> 智能门禁 </label>
					<label class="btn" onClick="window.location.href='<?php echo (C("WEB_DOMAIN")); ?>/Car/index.php?s=/Admin/Index/index/state/1';" style="color:#FFFFFF;"> 智慧停车场 </label>
                 </div>-->
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
        <div style="margin-top:22px; float:left; width:10%;">
            <select style="width:100%; height:34px; padding:6px 12px; background-color:#FFFFFF; border: 1px solid #c2cad8; z-index: 10000;" id="select_session" class="form-control selectpicker" data-live-search="true">
<!--                <option value="" <?php if($auth_village_id != null): ?>style="display:none;"<?php endif; ?> >全部显示</option>-->
                <?php if(is_array($villageArr)): foreach($villageArr as $key=>$vo): ?><option value="<?php echo ($vo["village_id"]); ?>" <?php if($auth_village_id == $vo['village_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["village_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <?php if(!empty($project)): ?><div class="col-md-4" style="margin-top:22px; width:10%; float:left;">
                <select class="bs-select form-control" id="project_session">
                    <!--                <option value="" <?php if($auth_village_id != null): ?>style="display:none;"<?php endif; ?> >全部显示</option>-->
                    <?php if(is_array($project)): foreach($project as $key=>$vo): ?><option value="<?php echo ($vo["pigcms_id"]); ?>" <?php if($_SESSION['project_id'] == $vo['pigcms_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["desc"]); ?></option><?php endforeach; endif; ?>
                </select>
            </div><?php endif; ?>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <form class="search-form" action="#" method="post">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="请输入关键词" name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                </div>
            </form>
			<div class="btn-group index_left_nav2" data-toggle="buttons" style="float:left; margin-left:10px; margin-top:20px;">
                <label class="btn red-haze active" onClick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new';"> 智能门禁 </label>
				<label class="btn" onClick="window.location.href='http://www.hdhsmart.com/Car/index.php?s=/Admin/Index/index.html';" style="color:#FFFFFF;"> 智慧停车场 </label>
           </div>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
				<ul class="nav navbar-nav pull-right">
                    
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <?php if(isset($warning_count)): ?><li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="icon-bell"></i>
                                <span style="width:25px; height:25px; overflow:hidden; text-align:center; line-height:25px; background-color: #ed6b75; border-radius:50%!important; color:#FFFFFF; font-size: 12px; color: #FFFFFF; padding:4px 5px;"> <?php echo ($warning_count); ?> </span>
                            </a>
                            <ul class="dropdown-menu" style="width: 120px; margin-left: -35px; margin-top: 10px;">
                                <li class="external">
                                    <h3>
                                        <span class="bold"><?php echo ($warning_count); ?> 条</span> 警告信息</h3>
                                    <a href="<?php echo U('Warning/showlist');?>">更多</a>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                        <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <?php if(is_array($warning_array)): foreach($warning_array as $key=>$vo): ?><li>
                                                    <a href="<?php echo U('Warning/warning_detail',array('pigcms_id'=>$vo['pigcms_id']));?>">
                                                        
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> <?php echo ($vo["warning_name"]); ?> </span>
													<div style="padding:5px 15px 15px 10px;">
													<span class="time"><?php echo (date("Y-m-d",$vo["create_time"])); ?></span>
                                                        <span class="time"><?php echo (date("H:i:s",$vo["create_time"])); ?></span>
													</div>
                                                    </a>
                                                </li><?php endforeach; endif; ?>
                                        </ul>
                                        <div class="slimScrollBar" style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                </li>
                            </ul>
                        </li><?php endif; ?>
                    <?php if(isset($noDealThingArray)): ?><!--<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar" style="width:75px;">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="fa fa-flag"></i>
                                <span class="badge badge-success"> <?php echo ($noDealThingCount); ?> </span>
                            </a>
                            <ul class="dropdown-menu" style="width: 120px; margin-left: -35px; margin-top: 10px;">
                                <li class="external">
                                    <h3>
                                        <span class="bold"><?php echo ($noDealThingCount); ?> 条</span> 未处理反馈 </h3>
                                    <a href="<?php echo U('PropertyService/repair_list_news');?>">更多</a>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                        <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <?php if(is_array($noDealThingArray)): foreach($noDealThingArray as $key=>$vo): if($vo['type'] == 1): ?><li>
                                                        <a href="<?php echo U('PropertyService/repair_list_news');?>">
                                                            <span class="time"><?php echo (date("Y-m-d",$vo["time"])); ?></span>
                                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> 报修信息 </span>
                                                        </a>
                                                    </li>
                                                <?php elseif($vo['type'] == 3): ?>
                                                    <li>
                                                        <a href="<?php echo U('PropertyService/suggess_list_news');?>">
                                                            <span class="time"><?php echo (date("Y-m-d",$vo["time"])); ?></span>
                                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> 投诉信息 </span>
                                                        </a>
                                                    </li>
                                                <?php elseif($vo['type'] == 4): ?>
                                                    <li>
                                                        <a href="<?php echo U('PropertyService/appointment_list_news');?>">
                                                            <span class="time"><?php echo (date("Y-m-d",$vo["time"])); ?></span>
                                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> 预约信息 </span>
                                                        </a>
                                                    </li><?php endif; endforeach; endif; ?>
                                        </ul>
                                        <div class="slimScrollBar" style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                </li>
                            </ul>
                        </li>--><?php endif; ?>
                    <!--<?php if(isset($unread_message_count)): ?><li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar" style="width:75px;">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="icon-envelope-open"></i>
                                <span class="badge badge-success"> <?php echo ($unread_message_count); ?> </span>
                            </a>
                            <ul class="dropdown-menu" style="width: 120px; margin-left: -35px; margin-top: -70px;">
                                <li class="external">
                                    <h3>
                                        <span class="bold"><?php echo ($unread_message_count); ?> 条</span> 未读信息 </h3>
                                    <a href="<?php echo U('Warning/showlist',array('system_id'=>10));?>">更多</a>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                        <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <?php if(is_array($unread_message_array)): foreach($unread_message_array as $key=>$vo): ?><li>
                                                    <a href="http://www.hdhsmart.com/Car/index.php?s=/Admin/Payrecord/chat_windows/user_id/<?php echo ($vo["warning_result"]); ?>/pigcms_id/<?php echo ($vo["pigcms_id"]); ?>">
                                                        <span class="time"><?php echo (date("Y-m-d",$vo["create_time"])); ?></span>
                                                        <span class="time"><?php echo (date("H:i:s",$vo["create_time"])); ?></span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> <?php echo ($vo["warning_name"]); ?> </span>
                                                    </a>
                                                </li><?php endforeach; endif; ?>
                                        </ul>
                                        <div class="slimScrollBar" style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                </li>
                            </ul>
                        </li><?php endif; ?>-->

					<li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> <?php echo ($_SESSION['system']['realname']); ?> </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
							<?php if($_SESSION['system']['headimgurl'] == ''): ?><img alt="" class="img-circle" src="http://www.hdhsmart.com/static/images/5a55d063878ed2.png" /> 
							<?php else: ?> 
							<img alt="" class="img-circle" src="http://www.hdhsmart.com/upload/cardfocus/headimage/<?php echo date('Y').'/'.$_SESSION['system']['headimgurl']; ?>" /><?php endif; ?></a>
                        <ul class="dropdown-menu dropdown-menu-default" style="margin-top:10px;">
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=profile_news">
                                    <i class="icon-user"></i> 个人信息 </a>
                            </li>
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=pass_news">
                                    <i class="icon-calendar"></i> 修改密码 </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Login&a=logout_new">
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
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" id="hide_menu_ul">

                <li class="nav-item start active open">
                    <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new" class="nav-link nav-toggle" id="span_a">
                        <i class="icon-home"></i>
                        <!-- <span class="title"><img src="" class="logo-default" id="span_pic"></span> -->
                        <span class="title" id="span_text"></span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                </li>
                <!--
                  <ul class="sub-menu">
                      <li class="nav-item start active open">
                          <a href="index.html" class="nav-link ">
                              <i class="icon-bar-chart"></i>
                              <span class="title">Dashboard 1</span>
                              <span class="selected"></span>
                          </a>
                      </li>
                      <li class="nav-item start ">
                          <a href="dashboard_2.html" class="nav-link ">
                              <i class="icon-bulb"></i>
                              <span class="title">Dashboard 2</span>
                              <span class="badge badge-success">1</span>
                          </a>
                      </li>
                      <li class="nav-item start ">
                          <a href="dashboard_3.html" class="nav-link ">
                              <i class="icon-graph"></i>
                              <span class="title">Dashboard 3</span>
                              <span class="badge badge-danger">5</span>
                          </a>
                      </li>
                  </ul>
              </li>
             -->

                <!--***************************************************************停车系统开始************************************************-->
               <!-- <li class="heading">
                    <h3 class="uppercase">后台管理系统</h3>
                </li>
                <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="<?php echo ($vo["icon"]); ?>"></i>
                        <span class="title"><?php echo ($vo["name"]); ?></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if(is_array($vo['child_list'])): $i = 0; $__LIST__ = $vo['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="nav-item  ">
                            <?php if($voo['name'] == '系统警告配置' or $voo['name'] == '警告信息列表'): ?><a href="<?php echo ($voo["url"]); ?>" class="nav-link ">
                                    <span class="title"><?php echo ($voo["name"]); ?></span>
                                </a>
                            <?php else: ?>
                            <a href="<?php echo ($voo["url"]); ?>_news" class="nav-link ">
                                <span class="title"><?php echo ($voo["name"]); ?></span>
                            </a><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>-->
                <iframe id = "ifr_name" width="50%" height="50%" style="display: none">
                </iframe>
                <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="heading">
                        <h3 class="uppercase"><?php echo ($vo["name"]); ?></h3>
                    </li>
                    <?php if(is_array($vo['child_list'])): $i = 0; $__LIST__ = $vo['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="<?php echo ($sv["icon"]); ?>"></i>
                                <span class="title"><?php echo ($sv["name"]); ?></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if(is_array($sv['child_list'])): $i = 0; $__LIST__ = $sv['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="nav-item  ">
                                        <?php if($voo['name'] == '系统警告配置' or $voo['name'] == '警告信息列表'): ?><a href="<?php echo ($voo["url"]); ?>" class="nav-link ">
                                                <span class="title"><?php echo ($voo["name"]); ?></span>
                                            </a>
                                        <?php elseif($voo['auth_type'] == 3): ?>
                                            <a href="<?php echo ($voo["w_url"]); ?>" class="nav-link " target="_blank">
                                                <span class="title"><?php echo ($voo["name"]); ?></span>
                                            </a>
                                            <?php else: ?>
                                            <a <?php if($_SESSION['system_id'] != ''): ?>href="<?php echo $voo['url'].'_news'.'&system='.$_SESSION['system_id'];?>"<?php else: ?>href="<?php echo $voo['url'].'_news';?>"<?php endif; ?>  class="nav-link " id="child_a">
                                                <span class="title"><?php echo ($voo["name"]); ?></span>
                                            </a><?php endif; ?>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                <!-- 根据url自动选择相应的选项卡-->
<!--                <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
-->                 <script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                    

                <script>
                    $(document).ready(function(){       
                        // var url = window.location.href;
                        // var str = url.substr(url.lastIndexOf('system='),);
                        // var num = str.substr(str.lastIndexOf('=')+1,);
                        // var num = <?php echo ($_SESSION['system_id']); ?>;
                        var num = document.getElementById("system_id").value;
                        var href1 = document.getElementById("logo_a").href;
                        var href2 = document.getElementById("span_a").href;
                        var href3 = document.getElementById("child_a").href;

                        var logo_a = href1+'&system='+num;
                        var span_a = href2+'&system='+num;
                        var child_a = href3+'&system='+num;

                        console.log(num);
                        if(/^\d+$/.test(num)){
                            console.log(1);
                            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg"+num+".jpg";  /^\d+$/.test(num)
                            // document.getElementById("span_title").innerText="邻钱快递收发管理系统"; 
                            if (num == 1) {
                                document.getElementById("span_title").innerText="邻钱快递收发管理系统";
                                document.getElementById("logo_text").innerText="邻钱快递收发管理系统";
                                document.getElementById("span_text").innerText="邻钱快递收发管理系统";                               
                            } else if(num == 2) {
                                document.getElementById("span_title").innerText="邻钱在线考试管理系统";
                                document.getElementById("logo_text").innerText="邻钱在线考试管理系统";
                                document.getElementById("span_text").innerText="邻钱在线考试管理系统";
                            } else if(num == 3) {
                                document.getElementById("span_title").innerText="邻钱设施设备管理系统";
                                document.getElementById("logo_text").innerText="邻钱设施设备管理系统";
                                document.getElementById("span_text").innerText="邻钱设施设备管理系统";
                            } else if(num == 4) {
                                document.getElementById("span_title").innerText="邻钱固定资产管理系统";
                                document.getElementById("logo_text").innerText="邻钱固定资产管理系统";
                                document.getElementById("span_text").innerText="邻钱固定资产管理系统";
                            } else if(num == 5) {
                                document.getElementById("span_title").innerText="邻钱在线抄表管理系统";
                                document.getElementById("logo_text").innerText="邻钱在线抄表管理系统";
                                document.getElementById("span_text").innerText="邻钱在线抄表管理系统";
                            } else if(num == 6) {
                                document.getElementById("span_title").innerText="邻钱在线巡更管理系统";
                                document.getElementById("logo_text").innerText="邻钱在线巡更管理系统";
                                document.getElementById("span_text").innerText="邻钱在线巡更管理系统";
                            }
                            $('#logo_a').attr('href',logo_a);
                            $('#span_a').attr('href',span_a);
                            $('#child_a').attr('href',child_a);

                        }else{
                            console.log(2);
                            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg.jpg";
                            document.getElementById("span_title").innerText="物业系统";
                            document.getElementById("logo_text").innerText="物业系统";
                            document.getElementById("span_text").innerText="物业系统";
                        }

                    });

                    function menu_select(url){
                        $('.sub-menu li a').each(function(){
                            if($($(this))[0].href.indexOf(url)>-1){
                                $(this).parent().addClass('open');
                                $(this).parent().parent().parent().addClass('open');
                                $(this).parent().parent().parent().find(".sub-menu").show();
                            }
                        });
                    };
                    $(function(){
                        var lastUrl = document.referrer;
                        $('.sub-menu li a').each(function(){
                            var url=sessionStorage.getItem('menu_select');
                            //console.log($($(this))[0].href);
                            if($($(this))[0].href==url){
                                $(this).parent().addClass('open');
                                $(this).parent().parent().parent().addClass('open');
                                $(this).parent().parent().parent().find(".sub-menu").show();
                            }
                            /*if($($(this))[0].href==String(window.location)){
                                $(this).parent().addClass('open');
                                $(this).parent().parent().parent().addClass('open');
                                $(this).parent().parent().parent().find(".sub-menu").show();
                            }*//*else if(lastUrl == $($(this))[0].href){
                                $(this).parent().addClass('open');
                                $(this).parent().parent().parent().addClass('open');
                                $(this).parent().parent().parent().find(".sub-menu").show();
                            }*/
                        });
                        //控制左侧菜单展开以及关闭
                            var hide_menu=sessionStorage.getItem('hide_menu');
                            // console.log(hide_menu);
                            if(hide_menu==-1){
                                // console.log(hide_menu);
                                $('body').addClass('page-sidebar-closed');
                                $('#hide_menu_ul').addClass('page-sidebar-menu-closed');
                            } 


                    });

                    function iframe_window(url){
                        $("#ifr_name").attr('src',url);
                        $("#ifr_name").show();
                    };
                    /*绑定点击事件  保存url进sessionstorage*/
                    $('.nav-link').click(function () {
                        var url=$($(this))[0].href;
                        sessionStorage.setItem('menu_select',url);
                    });
                    $("select#select_session").change(function(){
                        var u = $(this).val();
                        var str = window.location.href;
                        var url = '';
                        if(str.indexOf("default_village_id")>0){
                            url = str.substring(0,str.length-21);
                        }else{
                            url = str;
                        }
                        location.href=url+'&default_village_id='+u;
                    });
                    $("#project_session").change(function(){
                        var u = $(this).val();
                        var str = window.location.href;
                        var url = '';
                        if(str.indexOf("default_project_id")>0){
                            url = str.substring(0,str.length-21);
                        }else{
                            url = str;
                        }
                        location.href=url+'&default_project_id='+u;
                    });
                    function hide_menu(){
                        var hide_menu=sessionStorage.getItem('hide_menu');
                        sessionStorage.setItem('hide_menu',~hide_menu);
                    }

                </script>
                <script>
                    var app = {};
                    app.root             = "__ROOT__";
                    app.app              = "__APP__";
                    app.app_dir         = "<?php echo APP_PATH;?>"
                    app.group_name      = "<?php echo GROUP_NAME;?>";
                    app.controller_name      = "<?php echo MODULE_NAME;?>";
                    app.action_name      = "<?php echo ACTION_NAME;?>";
                    app.url_model        = <?php echo C('URL_MODEL');?>;
                </script>
                    <link rel="stylesheet" href="<?php echo ($static_public); ?>css/bootstrap-select.min.css">
                        <script src="<?php echo ($static_public); ?>js/bootstrap-select.min.js"></script>

                <script>
                    $('.selectpicker').selectpicker({size:10});
                    //初始化多选框
                    <?php if($personnel_info['depatment_id']): ?>var depatment_id='<?php echo ($personnel_info['depatment_id']); ?>';
                    $("select[name='depatment_id']").selectpicker('val',depatment_id);<?php endif; ?>
                    <?php if($personnel_info['admin_id']): ?>var admin_id='<?php echo ($personnel_info['admin_id']); ?>';
                    $("select[name='admin_id']").selectpicker('val',admin_id);<?php endif; ?>
                    <?php if(empty($personnel_info) and $department_id): ?>$("select[name='department_id']").selectpicker('val',<?php echo ($department_id); ?>);<?php endif; ?>
                </script>
                <script src="./static/js/system-main.js"></script>

                <!--
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Elements</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="elements_steps.html" class="nav-link ">
                                <span class="title">Steps</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_lists.html" class="nav-link ">
                                <span class="title">Lists</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_ribbons.html" class="nav-link ">
                                <span class="title">Ribbons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_overlay.html" class="nav-link ">
                                <span class="title">Overlays</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_cards.html" class="nav-link ">
                                <span class="title">User Cards</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">Tables</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="table_static_basic.html" class="nav-link ">
                                <span class="title">Basic Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="table_static_responsive.html" class="nav-link ">
                                <span class="title">Responsive Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="table_bootstrap.html" class="nav-link ">
                                <span class="title">Bootstrap Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Datatables</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="table_datatables_managed.html" class="nav-link "> Managed Datatables </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_buttons.html" class="nav-link "> Buttons Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_colreorder.html" class="nav-link "> Colreorder Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_rowreorder.html" class="nav-link "> Rowreorder Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_scroller.html" class="nav-link "> Scroller Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_fixedheader.html" class="nav-link "> FixedHeader Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_responsive.html" class="nav-link "> Responsive Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_editable.html" class="nav-link "> Editable Datatables </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_ajax.html" class="nav-link "> Ajax Datatables </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Charts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="charts_amcharts.html" class="nav-link ">
                                <span class="title">amChart</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_flotcharts.html" class="nav-link ">
                                <span class="title">Flot Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_flowchart.html" class="nav-link ">
                                <span class="title">Flow Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_google.html" class="nav-link ">
                                <span class="title">Google Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_echarts.html" class="nav-link ">
                                <span class="title">eCharts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_morris.html" class="nav-link ">
                                <span class="title">Morris Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">HighCharts</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="charts_highcharts.html" class="nav-link "> HighCharts </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="charts_highstock.html" class="nav-link "> HighStock </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="charts_highmaps.html" class="nav-link "> HighMaps </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-pointer"></i>
                        <span class="title">Maps</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="maps_google.html" class="nav-link ">
                                <span class="title">Google Maps</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="maps_vector.html" class="nav-link ">
                                <span class="title">Vector Maps</span>
                            </a>
                        </li>
                    </ul>
                </li>


                -->
                <!--********************************************************停车系统结束*************************************************-->
                <!--

                <li class="heading">
                    <h3 class="uppercase">Features</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">UI Features</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="ui_colors.html" class="nav-link ">
                                <span class="title">Color Library</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_metronic_grid.html" class="nav-link ">
                                <span class="title">Metronic Grid System</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_general.html" class="nav-link ">
                                <span class="title">General Components</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_buttons.html" class="nav-link ">
                                <span class="title">Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_buttons_spinner.html" class="nav-link ">
                                <span class="title">Spinner Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_confirmations.html" class="nav-link ">
                                <span class="title">Popover Confirmations</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_sweetalert.html" class="nav-link ">
                                <span class="title">Bootstrap Sweet Alerts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_icons.html" class="nav-link ">
                                <span class="title">Font Icons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_socicons.html" class="nav-link ">
                                <span class="title">Social Icons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_typography.html" class="nav-link ">
                                <span class="title">Typography</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_tabs_accordions_navs.html" class="nav-link ">
                                <span class="title">Tabs, Accordions & Navs</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_timeline.html" class="nav-link ">
                                <span class="title">Timeline 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_timeline_2.html" class="nav-link ">
                                <span class="title">Timeline 2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_timeline_horizontal.html" class="nav-link ">
                                <span class="title">Horizontal Timeline</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_tree.html" class="nav-link ">
                                <span class="title">Tree View</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Page Progress Bar</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="ui_page_progress_style_1.html" class="nav-link "> Flash </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="ui_page_progress_style_2.html" class="nav-link "> Big Counter </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_blockui.html" class="nav-link ">
                                <span class="title">Block UI</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_bootstrap_growl.html" class="nav-link ">
                                <span class="title">Bootstrap Growl Notifications</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_notific8.html" class="nav-link ">
                                <span class="title">Notific8 Notifications</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_toastr.html" class="nav-link ">
                                <span class="title">Toastr Notifications</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_bootbox.html" class="nav-link ">
                                <span class="title">Bootbox Dialogs</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_alerts_api.html" class="nav-link ">
                                <span class="title">Metronic Alerts API</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_session_timeout.html" class="nav-link ">
                                <span class="title">Session Timeout</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_idle_timeout.html" class="nav-link ">
                                <span class="title">User Idle Timeout</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_modals.html" class="nav-link ">
                                <span class="title">Modals</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_extended_modals.html" class="nav-link ">
                                <span class="title">Extended Modals</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_tiles.html" class="nav-link ">
                                <span class="title">Tiles</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_datepaginator.html" class="nav-link ">
                                <span class="title">Date Paginator</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ui_nestable.html" class="nav-link ">
                                <span class="title">Nestable List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Components</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="components_date_time_pickers.html" class="nav-link ">
                                <span class="title">Date & Time Pickers</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_color_pickers.html" class="nav-link ">
                                <span class="title">Color Pickers</span>
                                <span class="badge badge-danger">2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_select2.html" class="nav-link ">
                                <span class="title">Select2 Dropdowns</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_multiselect_dropdown.html" class="nav-link ">
                                <span class="title">Bootstrap Multiselect Dropdowns</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_select.html" class="nav-link ">
                                <span class="title">Bootstrap Select</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_multi_select.html" class="nav-link ">
                                <span class="title">Bootstrap Multiple Select</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_select_splitter.html" class="nav-link ">
                                <span class="title">Select Splitter</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_clipboard.html" class="nav-link ">
                                <span class="title">Clipboard</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_typeahead.html" class="nav-link ">
                                <span class="title">Typeahead Autocomplete</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_tagsinput.html" class="nav-link ">
                                <span class="title">Bootstrap Tagsinput</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_switch.html" class="nav-link ">
                                <span class="title">Bootstrap Switch</span>
                                <span class="badge badge-success">6</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_maxlength.html" class="nav-link ">
                                <span class="title">Bootstrap Maxlength</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_fileinput.html" class="nav-link ">
                                <span class="title">Bootstrap File Input</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_bootstrap_touchspin.html" class="nav-link ">
                                <span class="title">Bootstrap Touchspin</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_form_tools.html" class="nav-link ">
                                <span class="title">Form Widgets & Tools</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_context_menu.html" class="nav-link ">
                                <span class="title">Context Menu</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_editors.html" class="nav-link ">
                                <span class="title">Markdown & WYSIWYG Editors</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_code_editors.html" class="nav-link ">
                                <span class="title">Code Editors</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_ion_sliders.html" class="nav-link ">
                                <span class="title">Ion Range Sliders</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_noui_sliders.html" class="nav-link ">
                                <span class="title">NoUI Range Sliders</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="components_knob_dials.html" class="nav-link ">
                                <span class="title">Knob Circle Dials</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Form Stuff</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="form_controls.html" class="nav-link ">
                                <span class="title">Bootstrap Form
                                    <br>Controls</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_controls_md.html" class="nav-link ">
                                <span class="title">Material Design
                                    <br>Form Controls</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_validation.html" class="nav-link ">
                                <span class="title">Form Validation</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_validation_states_md.html" class="nav-link ">
                                <span class="title">Material Design
                                    <br>Form Validation States</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_validation_md.html" class="nav-link ">
                                <span class="title">Material Design
                                    <br>Form Validation</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_layouts.html" class="nav-link ">
                                <span class="title">Form Layouts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_repeater.html" class="nav-link ">
                                <span class="title">Form Repeater</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_input_mask.html" class="nav-link ">
                                <span class="title">Form Input Mask</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_editable.html" class="nav-link ">
                                <span class="title">Form X-editable</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_wizard.html" class="nav-link ">
                                <span class="title">Form Wizard</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_icheck.html" class="nav-link ">
                                <span class="title">iCheck Controls</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_image_crop.html" class="nav-link ">
                                <span class="title">Image Cropping</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_fileupload.html" class="nav-link ">
                                <span class="title">Multiple File Upload</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="form_dropzone.html" class="nav-link ">
                                <span class="title">Dropzone File Upload</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Elements</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="elements_steps.html" class="nav-link ">
                                <span class="title">Steps</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_lists.html" class="nav-link ">
                                <span class="title">Lists</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_ribbons.html" class="nav-link ">
                                <span class="title">Ribbons</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_overlay.html" class="nav-link ">
                                <span class="title">Overlays</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="elements_cards.html" class="nav-link ">
                                <span class="title">User Cards</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">Tables</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="table_static_basic.html" class="nav-link ">
                                <span class="title">Basic Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="table_static_responsive.html" class="nav-link ">
                                <span class="title">Responsive Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="table_bootstrap.html" class="nav-link ">
                                <span class="title">Bootstrap Tables</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Datatables</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="table_datatables_managed.html" class="nav-link "> Managed Datatables </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_buttons.html" class="nav-link "> Buttons Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_colreorder.html" class="nav-link "> Colreorder Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_rowreorder.html" class="nav-link "> Rowreorder Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_scroller.html" class="nav-link "> Scroller Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_fixedheader.html" class="nav-link "> FixedHeader Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_responsive.html" class="nav-link "> Responsive Extension </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_editable.html" class="nav-link "> Editable Datatables </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="table_datatables_ajax.html" class="nav-link "> Ajax Datatables </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="?p=" class="nav-link nav-toggle">
                        <i class="icon-wallet"></i>
                        <span class="title">Portlets</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="portlet_boxed.html" class="nav-link ">
                                <span class="title">Boxed Portlets</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="portlet_light.html" class="nav-link ">
                                <span class="title">Light Portlets</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="portlet_solid.html" class="nav-link ">
                                <span class="title">Solid Portlets</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="portlet_ajax.html" class="nav-link ">
                                <span class="title">Ajax Portlets</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="portlet_draggable.html" class="nav-link ">
                                <span class="title">Draggable Portlets</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Charts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="charts_amcharts.html" class="nav-link ">
                                <span class="title">amChart</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_flotcharts.html" class="nav-link ">
                                <span class="title">Flot Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_flowchart.html" class="nav-link ">
                                <span class="title">Flow Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_google.html" class="nav-link ">
                                <span class="title">Google Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_echarts.html" class="nav-link ">
                                <span class="title">eCharts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="charts_morris.html" class="nav-link ">
                                <span class="title">Morris Charts</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">HighCharts</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="charts_highcharts.html" class="nav-link "> HighCharts </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="charts_highstock.html" class="nav-link "> HighStock </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="charts_highmaps.html" class="nav-link "> HighMaps </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-pointer"></i>
                        <span class="title">Maps</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="maps_google.html" class="nav-link ">
                                <span class="title">Google Maps</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="maps_vector.html" class="nav-link ">
                                <span class="title">Vector Maps</span>
                            </a>
                        </li>
                    </ul>
                </li>
<li class="heading">
<h3 class="uppercase">Layouts</h3>
</li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Page Layouts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="layout_blank_page.html" class="nav-link ">
                                <span class="title">Blank Page</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_ajax_page.html" class="nav-link ">
                                <span class="title">Ajax Content Layout</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_language_bar.html" class="nav-link ">
                                <span class="title">Header Language Bar</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_footer_fixed.html" class="nav-link ">
                                <span class="title">Fixed Footer</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_boxed_page.html" class="nav-link ">
                                <span class="title">Boxed Page</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-feed"></i>
                        <span class="title">Sidebar Layouts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="layout_sidebar_menu_hover.html" class="nav-link ">
                                <span class="title">Hover Sidebar Menu</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_sidebar_reversed.html" class="nav-link ">
                                <span class="title">Reversed Sidebar Page</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_sidebar_fixed.html" class="nav-link ">
                                <span class="title">Fixed Sidebar Layout</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_sidebar_closed.html" class="nav-link ">
                                <span class="title">Closed Sidebar Layout</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class=" icon-wrench"></i>
                        <span class="title">Custom Layouts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="layout_disabled_menu.html" class="nav-link ">
                                <span class="title">Disabled Menu Links</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="heading">
                    <h3 class="uppercase">Pages</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-basket"></i>
                        <span class="title">eCommerce</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="ecommerce_index.html" class="nav-link ">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ecommerce_orders.html" class="nav-link ">
                                <i class="icon-basket"></i>
                                <span class="title">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ecommerce_orders_view.html" class="nav-link ">
                                <i class="icon-tag"></i>
                                <span class="title">Order View</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ecommerce_products.html" class="nav-link ">
                                <i class="icon-graph"></i>
                                <span class="title">Products</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="ecommerce_products_edit.html" class="nav-link ">
                                <i class="icon-graph"></i>
                                <span class="title">Product Edit</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">Apps</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="app_todo.html" class="nav-link ">
                                <i class="icon-clock"></i>
                                <span class="title">Todo 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="app_todo_2.html" class="nav-link ">
                                <i class="icon-check"></i>
                                <span class="title">Todo 2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="app_inbox.html" class="nav-link ">
                                <i class="icon-envelope"></i>
                                <span class="title">Inbox</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="app_calendar.html" class="nav-link ">
                                <i class="icon-calendar"></i>
                                <span class="title">Calendar</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="app_ticket.html" class="nav-link ">
                                <i class="icon-notebook"></i>
                                <span class="title">Support</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">User</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="page_user_profile_1.html" class="nav-link ">
                                <i class="icon-user"></i>
                                <span class="title">Profile 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_user_profile_1_account.html" class="nav-link ">
                                <i class="icon-user-female"></i>
                                <span class="title">Profile 1 Account</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_user_profile_1_help.html" class="nav-link ">
                                <i class="icon-user-following"></i>
                                <span class="title">Profile 1 Help</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_user_profile_2.html" class="nav-link ">
                                <i class="icon-users"></i>
                                <span class="title">Profile 2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-notebook"></i>
                                <span class="title">Login</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="page_user_login_1.html" class="nav-link " target="_blank"> Login Page 1 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_user_login_2.html" class="nav-link " target="_blank"> Login Page 2 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_user_login_3.html" class="nav-link " target="_blank"> Login Page 3 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_user_login_4.html" class="nav-link " target="_blank"> Login Page 4 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_user_login_5.html" class="nav-link " target="_blank"> Login Page 5 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_user_login_6.html" class="nav-link " target="_blank"> Login Page 6 </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_user_lock_1.html" class="nav-link " target="_blank">
                                <i class="icon-lock"></i>
                                <span class="title">Lock Screen 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_user_lock_2.html" class="nav-link " target="_blank">
                                <i class="icon-lock-open"></i>
                                <span class="title">Lock Screen 2</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-social-dribbble"></i>
                        <span class="title">General</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="page_general_about.html" class="nav-link ">
                                <i class="icon-info"></i>
                                <span class="title">About</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_contact.html" class="nav-link ">
                                <i class="icon-call-end"></i>
                                <span class="title">Contact</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-notebook"></i>
                                <span class="title">Portfolio</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="page_general_portfolio_1.html" class="nav-link "> Portfolio 1 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_portfolio_2.html" class="nav-link "> Portfolio 2 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_portfolio_3.html" class="nav-link "> Portfolio 3 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_portfolio_4.html" class="nav-link "> Portfolio 4 </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-magnifier"></i>
                                <span class="title">Search</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <a href="page_general_search.html" class="nav-link "> Search 1 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_search_2.html" class="nav-link "> Search 2 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_search_3.html" class="nav-link "> Search 3 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_search_4.html" class="nav-link "> Search 4 </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="page_general_search_5.html" class="nav-link "> Search 5 </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_pricing.html" class="nav-link ">
                                <i class="icon-tag"></i>
                                <span class="title">Pricing</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_faq.html" class="nav-link ">
                                <i class="icon-wrench"></i>
                                <span class="title">FAQ</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_blog.html" class="nav-link ">
                                <i class="icon-pencil"></i>
                                <span class="title">Blog</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_blog_post.html" class="nav-link ">
                                <i class="icon-note"></i>
                                <span class="title">Blog Post</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_invoice.html" class="nav-link ">
                                <i class="icon-envelope"></i>
                                <span class="title">Invoice</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_general_invoice_2.html" class="nav-link ">
                                <i class="icon-envelope"></i>
                                <span class="title">Invoice 2</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">System</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="page_cookie_consent_1.html" class="nav-link ">
                                <span class="title">Cookie Consent 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_cookie_consent_2.html" class="nav-link ">
                                <span class="title">Cookie Consent 2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_coming_soon.html" class="nav-link " target="_blank">
                                <span class="title">Coming Soon</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_404_1.html" class="nav-link ">
                                <span class="title">404 Page 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_404_2.html" class="nav-link " target="_blank">
                                <span class="title">404 Page 2</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_404_3.html" class="nav-link " target="_blank">
                                <span class="title">404 Page 3</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_500_1.html" class="nav-link ">
                                <span class="title">500 Page 1</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="page_system_500_2.html" class="nav-link " target="_blank">
                                <span class="title">500 Page 2</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">Multi Level Menu</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i> Item 1
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="?p=dashboard-2" target="_blank" class="nav-link">
                                        <i class="icon-user"></i> Arrow Toggle
                                        <span class="arrow nav-toggle"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="icon-power"></i> Sample Link 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="icon-paper-plane"></i> Sample Link 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="icon-star"></i> Sample Link 1</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-camera"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-link"></i> Sample Link 2</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-pointer"></i> Sample Link 3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="?p=dashboard-2" target="_blank" class="nav-link">
                                <i class="icon-globe"></i> Arrow Toggle
                                <span class="arrow nav-toggle"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-tag"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-pencil"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-graph"></i> Sample Link 1</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-bar-chart"></i> Item 3 </a>
                        </li>
                    </ul>
                </li>
                -->
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
        <!--console.js start-->
        <script src="./static/js/console-samrt.js"></script>

      <script>console.log('I have left')</script>
    </div>
    <!-- END SIDEBAR -->
   
<!--引入日历插件样式 -->

<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>个人资料
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">后台首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">智慧助手</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">个人资料</span>
            </li>
        </ul>
        <div class="row">
            <form action="<?php echo U('Index/amend_profile_new');?>" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="pigcms_id" value="<?php echo ($terrace_array["pigcms_id"]); ?>"/>

                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="http://www.hdhsmart.com/upload/cardfocus/headimage/<?php echo date('Y').'/'.$admin['headimgurl']; ?>" class="img-responsive" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> <?php echo ($admin["account"]); ?> </div>
                                <div class="profile-usertitle-job"> <?php echo ($admin["realname"]); ?> </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a data-toggle="modal" data-target="#common_modal" href="<?php echo U('upload_head_img');?>" class="btn btn-circle green btn-sm">上传图片</a>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li class="active">
                                        <a href="<?php echo U('Index/index_new');?>">
                                            <i class="icon-home"></i> 系统主页 </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo U('Index/edit_admin_info');?>" data-toggle="modal" data-target="#one_modal">
                                            <i class="icon-settings"></i> 修改资料 </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo U('Index/lock_system');?>">
                                            <i class="icon-info"></i> 锁屏 </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                        <!-- PORTLET MAIN -->
                        <div class="portlet light bordered">
                            <!-- STAT -->
                            <div class="row list-separated profile-stat">
                                <div class="col-md-6 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> <?php echo ($admin["login_count"]); ?> </div>
                                    <div class="uppercase profile-stat-text"> 登录次数 </div>
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> <?php echo ($admin["level"]); ?> </div>
                                    <div class="uppercase profile-stat-text"> 等级 </div>
                                </div>
                            </div>
                            <!-- END STAT -->
                            <div>
                                <h4 class="profile-desc-title"><!--<?php echo ($admin["role_name"]); ?>--></h4>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-qq"></i>
                                    <a href="javascript:;"><?php echo ($admin["qq"]); ?></a>
                                </div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-envelope"></i>
                                    <a href="javascript:;"><?php echo ($admin["email"]); ?></a>
                                </div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-mobile-phone"></i>
                                    <a href="javascript:;"><?php echo ($admin["phone"]); ?></a>
                                </div>
								<div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-clock-o"></i>
                                    <a href="javascript:;">2018-10-22 12：21：22</a>
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR 1-->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">事项提醒</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> 系统警告 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> 事项流程提醒 </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <?php if($_SESSION['system']['account']== 'admin'): ?><div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <ul class="feeds">
                                                        <?php if(is_array($warningList['list'])): foreach($warningList['list'] as $key=>$vo): ?><li>
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-warning">
                                                                                <i class="fa fa-warning"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> <?php echo ($vo["warning_name"]); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> <?php echo ($vo["timediffer"]); ?> </div>
                                                                </div>
                                                            </li><?php endforeach; endif; ?>
                                                    </ul>
                                                </div>
                                                <?php else: ?>
                                                    无提醒事项<?php endif; ?>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <ul class="feeds">
                                                        <?php if(is_array($list['list'])): foreach($list['list'] as $key=>$sv): ?><li>
                                                                <a href="<?php echo ($sv["url"]); ?>">
                                                                    <div class="col1">
                                                                        <div class="cont">
                                                                            <div class="cont-col1">
                                                                                <div class="label label-sm label-warning">
                                                                                    <i class="fa fa-bell-o"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cont-col2">
                                                                                <div class="desc"> <?php echo ($sv["content"]); ?> </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col2">
                                                                        <div class="date"> <?php echo ($sv["timediffer"]); ?> </div>
                                                                    </div>
                                                                </a>
                                                            </li><?php endforeach; endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                        </div>

                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!--弹出层-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="one_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    //开启日历插件
    $(function(){
        $("#mybutton").click(function(){
            var tr="<div class='form-group form-md-line-input' name='add_tr'><label class='col-md-3 control-label' for='form_control_1'>其他参数<span class='required'>*</span></label><div class='col-md-9'><input type='text' class='form-control' placeholder='' name='arguments[]'/><input type='text' class='form-control' placeholder='' name='arguments_value[]'/><div class='form-control-focus'></div></div></div>";
            $("div[name='add_tr']:last").after(tr);
        });
        $("#mybutton2").click(function(){
            var td_length = $("div[name='add_tr']").length;
            //alert(td_length);
            var pot = td_length-1;
            var last =td_length;
            if(td_length>1){
                $("div[name='add_tr']:last").remove();
            }
        });
    });
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