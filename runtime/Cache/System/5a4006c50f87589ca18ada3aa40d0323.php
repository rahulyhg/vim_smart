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
   
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

<!--头部设置结束-->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<style type="text/css">
</style>

<!-- BEGIN CONTENT BODY -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php echo $breadcrumb[count($breadcrumb)-1][0] ?>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <?php if(is_array($breadcrumb)): $k = 0; $__LIST__ = $breadcrumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($k % 2 );++$k; if($k==(count($breadcrumb))){ ?>
                    <li>
                        <span class="active"><?php echo ($row[0]); ?></span>
                    </li>

                <?php  }else{ ?>

                    <li>
                        <a href="<?php echo ($row[1]); ?>"><?php echo ($row[0]); ?></a>
                        <i class="fa fa-circle"></i>
                    </li>

                <?php  } endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->


<!--表格开始-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if($add_action['url']): ?><div class="btn-group">
                                        <a href="javascript:;" >
                                            <button class="btn sbold green" onclick="window.top.artiframe('<?php echo ($add_action['url']); ?>','<?php echo ($add_action['name']); ?>',600,400,true,false,false,addbtn,'add',true);" > <?php echo ($add_action['name']); ?>
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div><?php endif; ?>
                                </div>

                            </div>
                        </div>
<!--业务区-->
<style type="text/css">
    <!--
    .table-checkable tr>td:first-child, .table-checkable tr>th:first-child {
        text-align: center;
        max-width: 100px;
        min-width: 40px;
        padding-left: 0;
        padding-right: 0;
    }
    .record_check_time{
        width: 60px;
        border: none;
        text-align: center;
        height: 30px;
    }
    th{
        border: none;text-align: center;height: 30px;
    }
    #form td{
        text-align: center;
    }
    -->
</style>
<div class="row">
    <div class="col-md-12">
        <?php if(!$isLiu): ?><a href="<?php echo U('Budget_predict/output_excel_one',array('id'=>$predict_info['predict_id']));?>" >
            <button type="button" class="btn green">导出此表格</button>
        </a><?php endif; ?>
        <br/>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
        </div>
        <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">

            <div class="portlet-body" style="width:100%;overflow-x: scroll;">
                <div class="row">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#tab_all" data-toggle="tab"> 预算主表</a>
                            </li>
                            <li>
                                <a href="#tab_4" data-toggle="tab">收入明细表</a>
                            </li>
                            <?php if(is_array($data_type)): foreach($data_type as $k=>$vo): if($k == 4): else: ?>
                                    <li>
                                    <a href="#tab_<?php echo ($k); ?>" data-toggle="tab"> <?php echo ($vo['info']['type_name']); ?>明细表</a>
                                    </li><?php endif; endforeach; endif; ?>
                            <!--<li>
                                <a href="#tab_overtime" data-toggle="tab"> 加班费明细表</a>
                            </li>
                            <li>
                                <a href="#tab_clothes_fee" data-toggle="tab"> 工服费明细表</a>
                            </li>
                            <li>
                                <a href="#tab_dispatch" data-toggle="tab"> 劳务和派遣明细表</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">
                            <div class='tab-pane fad  active' id="tab_all">
                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <td colspan="7" align="center" style="font-size: 25px"><?php echo ($predict_info['year']); ?>年<?php echo ($title1); ?>年度预算编制汇总表</td>
                                        </tr>
                                        <tr>
                                            <th width="5%">序号</th>
                                            <th width="10%" colspan="2">预算项目</th>
                                            <th width="10%">金额</th>
                                            <th width="10%">编制说明</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>一</td>
                                            <td colspan="2">收入合计</td>
                                            <td><?php echo number_format($predict_all['input']['sum_sum'],2);?></td>
                                            <td>含税金额</td>
                                        </tr>
                                        <?php if(is_array($predict_all['input']['1']['children'])): $i = 0; $__LIST__ = $predict_all['input']['1']['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                <td><?php echo ($i); ?></td>
                                                <td colspan="2"><?php echo ($vo['type_name']); ?></td>
                                                <td><div class="tagDiv"><?php echo number_format($vo['sum_sum'],2);?></div></td>
                                                <td><div class="tagDiv" title="<?php echo ($vo2['type_remark']); ?>"><?php echo ($vo["type_remark"]); ?></div></td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        <tr>
                                            <td>二</td>
                                            <td colspan="2">支出合计</td>
                                            <td><?php echo number_format($predict_all['output']['sum_sum'],2);?></td>
                                            <td>含税金额</td>
                                        </tr>
                                        <?php if(is_array($predict_all['output'])): foreach($predict_all['output'] as $ke=>$vo): if(is_array($vo['children'])): $k = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k % 2 );++$k;?><tr>
                                                    <?php if($k == 1): ?><td rowspan="<?php echo count($vo['children'])+1;?>" style="text-align:center;vertical-align:middle;"><?php echo ($ke); ?></td>
                                                        <td rowspan="<?php echo count($vo['children'])+1;?>" style="text-align:center;vertical-align:middle;"><?php echo ($vo['type_name']); ?></td>
                                                        <?php else: endif; ?>
                                                    <td><div class="tagDiv"><?php echo ($vo1['type_name']); ?></div></td>
                                                    <td><div class="tagDiv"><?php echo number_format($vo1['sum_sum'],2);?></div></td>
                                                    <td><div class="tagDiv" title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo1["type_remark"]); ?></div></td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                            <?php if(is_array($vo)): ?><tr>
                                                    <td>小计</td>
                                                    <td><div class="tagDiv"><?php echo number_format($vo['sum_sum'],2);?></div></td>
                                                    <td></td>
                                                </tr><?php endif; endforeach; endif; ?>
                                        <tr>
                                            <td>三</td>
                                            <td colspan="2">净收支</td>
                                            <td><?php echo number_format($predict_all['sum']['sum_sum'],2);?></td>
                                            <td>含税金额</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if(is_array($data_type)): foreach($data_type as $k=>$vo): if($k == 1): ?><div class='tab-pane' id="tab_<?php echo ($k); ?>">

                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                <thead>
                                                <tr>
                                                    <th rowspan="2">部门</th>
                                                    <th rowspan="2">岗位</th>
                                                    <th rowspan="2">人数</th>
                                                    <th rowspan="2">工作月数</th>
                                                    <th rowspan="2">月工资</th>
                                                    <th rowspan="2">社保</th>
                                                    <th rowspan="2">社补</th>
                                                    <th rowspan="2">公积金</th>
                                                    <th colspan="5">月福利费</th>
                                                    <th colspan="5">年度小计</th>
                                                    <th rowspan="2">年度小计</th>
                                                    <th rowspan="2">编制说明</th>
                                                </tr>
                                                <tr>
                                                    <th>餐费补贴</th>
                                                    <th>通信费</th>
                                                    <th>降温费</th>
                                                    <th>慰问费</th>
                                                    <th>其它</th>
                                                    <th>工资</th>
                                                    <th>社保社补</th>
                                                    <th>公积金</th>
                                                    <th>福利费</th>
                                                    <th>年度奖金</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(is_array($department_child_list)): foreach($department_child_list as $k1=>$vo1): if(empty($vo['data'][$k1]) and $vo1['type'] == 1): ?><!--<tr>
                                                            <td id="personnel_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($vo['data'][$k1])+1;?>"><?php echo ($vo1['name']); ?></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>-->
                                                        <?php elseif( $vo1['type'] == 1): ?>
                                                        <?php $cache_key=key($vo['data'][$k1]);?>
                                                        <?php if(is_array($vo['data'][$k1])): foreach($vo['data'][$k1] as $k2=>$vo2): ?><tr>
                                                                <?php if($k2 == $cache_key): ?><td id="personnel_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($vo['data'][$k1]);?>"><?php echo ($vo1['name']); ?></td><?php endif; ?>
                                                                <td><?php echo ($vo2['job']); ?></td>
                                                                <td><?php echo ($vo2['num']); ?></td>
                                                                <td><?php echo ($vo2['month']); ?></td>
                                                                <td><?php echo ($vo2['month_0']); ?></td>
                                                                <td><?php echo ($vo2['month_1']); ?></td>
                                                                <td><?php echo ($vo2['month_8']); ?></td>
                                                                <td><?php echo ($vo2['month_2']); ?></td>
                                                                <td><?php echo ($vo2['month_3']); ?></td>
                                                                <td><?php echo ($vo2['month_4']); ?></td>
                                                                <td><?php echo ($vo2['month_5']); ?></td>
                                                                <td><?php echo ($vo2['month_6']); ?></td>
                                                                <td><?php echo ($vo2['month_7']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['month_0']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['month_1']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['month_2']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['month_other']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['year_end']); ?></td>
                                                                <td><?php echo ($sum['1'][$k1][$k2]['sum']); ?></td>
                                                                <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['remark']); ?></td>
                                                            </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                                <tr style="color: red">
                                                    <td colspan="2">合计</td>
                                                    <td><?php echo ($sum['1']['sum']['num']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo ($sum['1']['sum']['month_0']); ?></td>
                                                    <td><?php echo ($sum['1']['sum']['month_1']); ?></td>
                                                    <td><?php echo ($sum['1']['sum']['month_2']); ?></td>
                                                    <td><?php echo ($sum['1']['sum']['month_other']); ?></td>
                                                    <td><?php echo ($sum['1']['sum']['year_end']); ?></td>
                                                    <td><?php echo ($sum['1']['sum']['sum']); ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">工龄工资</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12"></td>
                                                    <td>
                                                        <a href="#tab_gongling" data-toggle="modal">
                                                            <button type="button" class="btn btn-xs blue">
                                                                点击查看工龄工资明细
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                    <td><?php echo ($sum['gongling']['sum']['sum']); ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">加班工资</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12">按基本工资/计薪天数*3计算</td>
                                                    <td>
                                                        <a href="#tab_overtime" data-toggle="modal">
                                                            <button type="button" class="btn btn-xs blue">
                                                                点击查看加班费明细
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td><?php echo ($sum['overtime']['sum']['sum']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">总计</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $sum['overtime']['sum']['sum']+$sum['1']['sum']['sum']+$sum['gongling']['sum']['sum'];?></td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class='tab-pane fad' id="tab_<?php echo ($k); ?>">
                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">项目</th>
                                                    <th><?php echo ($year); ?>年预算金额</th>
                                                    <th><?php echo $year-1;?>年实际金额</th>
                                                    <th><?php echo $year-2;?>年实际金额</th>
                                                    <th>备注</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(vo['children']): if(is_array($vo['children'])): foreach($vo['children'] as $k1=>$vo1): if($k1 == 0): else: ?>
                                                            <?php if(is_array($vo1['children'])): $k2 = 0; $__LIST__ = $vo1['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?><tr>
                                                                    <?php if($k2 == 1): ?><td rowspan="<?php echo count($vo1['children'])+1;?>" style="text-align:center;vertical-align:middle;"><?php echo ($vo1['type_name']); ?></td><?php endif; ?>
                                                                    <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['type_name']); ?></td>
                                                                    <td>
                                                                        <?php echo ($vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']); ?>
                                                                        <?php if($vo1['type_name'] == '工服费'): ?><a href="#tab_clothesfee" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看工服费明细
                                                                                </button>
                                                                            </a>
                                                                            <?php elseif($vo1['type_name'] == '派遣和劳务支出'): ?>
                                                                            <a href="#tab_dispatch" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看派遣和劳务支出明细
                                                                                </button>
                                                                            </a>
                                                                            <?php elseif($vo2['type_name'] == '物业费服务收入' and !empty($property)): ?>
                                                                                <a href="#tab_property" data-toggle="modal">
                                                                                    <button type="button" class="btn btn-xs blue">
                                                                                        点击查看物业费详细
                                                                                    </button>
                                                                                </a>
                                                                            <?php elseif($vo2['type_name'] == '资产购置费' and !empty($zichan)): ?>
                                                                                <a href="#tab_zichan" data-toggle="modal">
                                                                                    <button type="button" class="btn btn-xs blue">
                                                                                        点击查看资产购置费详细
                                                                                    </button>
                                                                                </a>
                                                                            <?php elseif($vo2['type_name'] == '其他运行费用' and !empty($yunxing)): ?>
                                                                                <a href="#tab_yunxing" data-toggle="modal">
                                                                                    <button type="button" class="btn btn-xs blue">
                                                                                        点击查看其他运行费用详细
                                                                                    </button>
                                                                                </a><?php endif; ?>
                                                                    </td>
                                                                    <td><?php echo $vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-';?></td>
                                                                    <td><?php echo $vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-';?></td>
                                                                    <td title="<?php echo ($vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['remark']); ?>"><?php echo ($vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['remark']); ?></td>
                                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            <tr style="color: red">
                                                                <td>小计</td>
                                                                <td><?php echo $sum[$k][$k1]['sum']?$sum[$k][$k1]['sum']:'';?></td>
                                                                <?php if($k == 4): ?><td><?php echo $log_sum['last']['input']['1']['children'][$vo1['type_name']]['sum_sum']?number_format($log_sum['last']['input']['1']['children'][$vo1['type_name']]['sum_sum'],2):'-';?></td>
                                                                    <td><?php echo $log_sum['last_last']['input']['1']['children'][$vo1['type_name']]['sum_sum']?number_format($log_sum['last_last']['input']['1']['children'][$vo1['type_name']]['sum_sum'],2):'-';?></td>
                                                                    <?php else: ?>
                                                                    <td><?php echo $log_sum['last']['output'][$k]['children'][$vo1['type_name']]['sum_sum']?number_format($log_sum['last']['output'][$k]['children'][$vo1['type_name']]['sum_sum'],2):'-';?></td>
                                                                    <td><?php echo $log_sum['last_last']['output'][$k]['children'][$vo1['type_name']]['sum_sum']?number_format($log_sum['last']['output'][$k]['children'][$vo1['type_name']]['sum_sum'],2):'-';?></td><?php endif; ?>
                                                                <td></td>
                                                            </tr><?php endif; endforeach; endif; ?>
                                                    <?php else: endif; ?>
                                                <tr  style="color: red">
                                                    <td>合计</td>
                                                    <td></td>
                                                    <td><?php echo ($sum[$k]['sum']['sum']); ?></td>
                                                    <?php if($k == 4): ?><td><?php echo $log_sum['last']['input']['1']['sum_sum']?number_format($log_sum['last']['input']['1']['sum_sum'],2):'-';?></td>
                                                        <td><?php echo $log_sum['last_last']['input']['1']['sum_sum']?number_format($log_sum['last_last']['input']['1']['sum_sum'],2):'-';?></td>
                                                    <?php else: ?>
                                                        <td><?php echo $log_sum['last']['output'][$k]['sum_sum']?number_format($log_sum['last']['output'][$k]['sum_sum'],2):'-';?></td>
                                                        <td><?php echo $log_sum['last_last']['output'][$k]['sum_sum']?number_format($log_sum['last_last']['output'][$k]['sum_sum'],2):'-';?></td><?php endif; ?>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><?php endif; endforeach; endif; ?>
                            <div  id="tab_overtime" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">加班工资明细</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th>部门</th>
                                            <th>岗位</th>
                                            <!--<th>人数</th>-->
                                            <?php if($predict_info['overtime_type'] == 1): ?><th>制度工资</th>
                                                <?php else: ?>
                                                <th>每日加班工资</th><?php endif; ?>
                                            <th>天数</th>
                                            <th>每天班次数</th>
                                            <th>每班次人数</th>
                                            <th>加班工资<br/></th>
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($department_child_list)): foreach($department_child_list as $k1=>$vo1): if(empty($overtime[$k1]) and $vo1['type'] == 1): ?><!--<tr>
                                                    <td id="personnel_overtime_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($overtime[$k1])+1;?>"><?php echo ($vo1['name']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>-->
                                                <?php elseif($vo1['type'] == 1): ?>
                                                <?php $cache_key=key($overtime[$k1])?>
                                                <?php if(is_array($overtime[$k1])): foreach($overtime[$k1] as $k2=>$vo2): ?><tr>
                                                        <?php if($k2 == $cache_key): ?><td id="personnel_overtime_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($overtime[$k1]);?>"><?php echo ($vo1['name']); ?></td><?php endif; ?>
                                                        <td><?php echo ($vo2['job']); ?></td>
                                                        <!--<td><?php echo ($vo2['num']); ?></td>-->
                                                        <td><?php echo $vo2['overtime']?$vo2['overtime']:$vo2['regime'];?></td>
                                                        <td><?php echo ($vo2['day']); ?></td>
                                                        <td><?php echo ($vo2['classes']); ?></td>
                                                        <td><?php echo ($vo2['classes_num']); ?></td>
                                                        <td><?php echo ($sum['overtime'][$k1][$k2]['overtime']); ?></td>
                                                        <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['remark']); ?></td>
                                                    </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                        <tr style="color: red">
                                            <td colspan="2">合计</td>
                                            <td><?php echo ($sum['overtime']['sum']['num']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['overtime']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--工龄工资明细-->
                            <div  id="tab_gongling" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">工龄工资明细</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th>部门</th>
                                            <th>岗位</th>
                                            <th>人数</th>
                                            <th>天数</th>
                                            <th>工龄工资</th>
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($department_child_list)): foreach($department_child_list as $k1=>$vo1): if(empty($gongling[$k1]) and $vo1['type'] == 1): ?><!--<tr>
                                                    <td id="personnel_overtime_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($overtime[$k1])+1;?>"><?php echo ($vo1['name']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>-->
                                                <?php elseif($vo1['type'] == 1): ?>
                                                <?php $cache_key=key($gongling[$k1])?>
                                                <?php if(is_array($gongling[$k1])): foreach($gongling[$k1] as $k2=>$vo2): ?><tr>
                                                        <?php if($k2 == $cache_key): ?><td id="personnel_overtime_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($gongling[$k1]);?>"><?php echo ($vo1['name']); ?></td><?php endif; ?>
                                                        <td><?php echo ($vo2['job']); ?></td>
                                                        <td><?php echo ($vo2['num']); ?></td>
                                                        <td><?php echo ($vo2['money']); ?></td>
                                                        <td><?php echo ($sum['gongling'][$k1][$k2]['sum']); ?></td>
                                                        <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['remark']); ?></td>
                                                    </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                        <tr style="color: red">
                                            <td colspan="2">合计</td>
                                            <td><?php echo ($sum['gongling']['sum']['num']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['gongling']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--物业服务费明细表-->
                            <div  id="tab_property" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">物业费明细表</h4>
                                        </div>
                                        <div class="modal-body">
                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                        <tr>
                                            <th colspan="2" rowspan="2">收费类别</th>
                                            <th colspan="3">以前年度</th>
                                            <th colspan="4">本年度</th>
                                            <th rowspan="2">本年度预算数</th>
                                            <th rowspan="2">编制说明</th>
                                        </tr>
                                        <tr>
                                            <th>上年欠费</th>
                                            <th>预算比例</th>
                                            <th>列入本年预算数</th>
                                            <th>可收费面积</th>
                                            <th>收费标准</th>
                                            <th>预算比例</th>
                                            <th>本年收入</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php if(is_array($property_list)): foreach($property_list as $k1=>$vo1): if(empty($property[$k1])): ?><tr>
                                                    <td id="property_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($property[$k1])+1;?>"><?php echo ($vo1); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td id="property_last_<?php echo ($k1); ?>" rowspan="<?php echo count($property[$k1])+1;?>" style="vertical-align:middle;"><?php echo ($proportion[$k1][last]); ?>%</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td id="property_now_<?php echo ($k1); ?>" rowspan="<?php echo count($property[$k1])+1;?>" style="vertical-align:middle;"><?php echo ($proportion[$k1][now]); ?>%</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td rowspan="<?php echo count($property[$k1])+1;?>" style="vertical-align:middle;width: 300px">
                                                        <?php if($vo1 == '写字楼'): ?>以在管物业可收费面积为依据，按上年未收（含历欠）<?php echo ($proportion[$k1][last]); ?>%和当年应<?php echo ($proportion[$k1][now]); ?>%计算，中途退租和出租的均不作调整。
                                                            <?php else: ?>
                                                            以实际向业主交房面积为依据，按上年未收（含历欠）按<?php echo ($proportion[$k1][last]); ?>%，当年应收<?php echo ($proportion[$k1][now]); ?>%计算，不论何因均不考虑扣减<?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php else: ?>
                                                <?php $cache_key=key($property[$k1])?>
                                                <?php if(is_array($property[$k1])): foreach($property[$k1] as $k2=>$vo2): ?><tr>
                                                        <?php if($k2 == $cache_key): ?><td id="property_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($property[$k1]);?>"><?php echo ($vo1); ?></td><?php endif; ?>
                                                        <td><?php echo ($vo2['name']); ?></td>
                                                        <td><?php echo ($vo2['year_last_0']); ?></td>
                                                        <?php if($k2 == $cache_key): ?><td id="property_last_<?php echo ($k1); ?>" rowspan="<?php echo count($property[$k1]);?>" style="vertical-align:middle;"><?php echo ($proportion[$k1][last]); ?>%</td><?php endif; ?>
                                                        <td><?php echo ($sum['property'][$k1][$k2]['year_last_sum']); ?></td>
                                                        <td><?php echo ($vo2['year_now_0']); ?></td>
                                                        <td><?php echo ($vo2['year_now_1']); ?></td>
                                                        <?php if($k2 == $cache_key): ?><td id="property_now_<?php echo ($k1); ?>" rowspan="<?php echo count($property[$k1]);?>" style="vertical-align:middle;"><?php echo ($proportion[$k1][now]); ?>%</td><?php endif; ?>
                                                        <td><?php echo ($sum['property'][$k1][$k2]['year_now_sum']); ?></td>
                                                        <td><?php echo ($sum['property'][$k1][$k2]['sum']); ?></td>
                                                        <?php if($k2 == $cache_key): ?><td rowspan="<?php echo count($property[$k1]);?>" style="vertical-align:middle;width: 300px">
                                                            <?php if($vo1 == '写字楼'): ?>以在管物业可收费面积为依据，按上年未收（含历欠）<?php echo ($proportion[$k1][last]); ?>%和当年应<?php echo ($proportion[$k1][now]); ?>%计算，中途退租和出租的均不作调整。
                                                                <?php else: ?>
                                                                以实际向业主交房面积为依据，按上年未收（含历欠）按<?php echo ($proportion[$k1][last]); ?>%，当年应收<?php echo ($proportion[$k1][now]); ?>%计算，不论何因均不考虑扣减<?php endif; ?>
                                                        </td><?php endif; ?>

                                                    </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                        <tr style="color: red;">
                                            <td colspan="2">合计</td>
                                            <td><?php echo ($sum['property']['sum']['year_last_0']); ?></td>
                                            <td></td>
                                            <td><?php echo ($sum['property']['sum']['year_last_sum']); ?></td>
                                            <td><?php echo ($sum['property']['sum']['year_now_0']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['property']['sum']['year_now_sum']); ?></td>
                                            <td><?php echo ($sum['property']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--工服费表-->
                            <div  id="tab_clothesfee" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">工服费明细表</h4>
                                        </div>
                                        <div class="modal-body">

                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                        <tr>
                                            <th>部门</th>
                                            <th>岗位</th>
                                            <th>人数</th>
                                            <th>计算标准<br/>（元/每人/月）</th>
                                            <th>月份</th>
                                            <th>工服费</th>
                                            <th>备注</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php if(is_array($department_child_list)): foreach($department_child_list as $k1=>$vo1): if(empty($clothesfee[$k1])): ?><!--<tr>
                                                    <td id="personnel_clothesfee_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($clothesfee[$k1])+1;?>"><?php echo ($vo1['name']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>-->
                                                <?php else: ?>
                                                <?php $cache_key=key($clothesfee[$k1])?>
                                                <?php if(is_array($clothesfee[$k1])): foreach($clothesfee[$k1] as $k2=>$vo2): ?><tr>
                                                        <?php if($k2 == $cache_key): ?><td id="personnel_clothesfee_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($clothesfee[$k1]);?>"><?php echo ($vo1['name']); ?></td><?php endif; ?>
                                                        <td><?php echo ($vo2['job']); ?></td>
                                                        <td><?php echo ($vo2['num']); ?></td>
                                                        <td><?php echo ($vo2['price']); ?></td>
                                                        <td><?php echo ($vo2['month']); ?></td>
                                                        <td><?php echo ($sum['clothesfee'][$k1][$k2]['clothesfee']); ?></td>
                                                        <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['remark']); ?></td>
                                                    </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                        <tr style="color: red">
                                            <td colspan="2">合计</td>
                                            <td><?php echo ($sum['clothesfee']['sum']['num']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['clothesfee']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--资产购置费-->
                            <div  id="tab_zichan" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">资产购置费明细表</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="btn-group" style="margin-top:10px;">
                                            </div>
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="zichan">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            项目明细
                                                        </th>
                                                        <th>
                                                            单价
                                                        </th>
                                                        <th>
                                                            数量
                                                        </th>
                                                        <th>
                                                            合计
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(empty($zichan)): else: ?>
                                                        <?php if(is_array($zichan)): foreach($zichan as $k1=>$vo1): ?><tr>
                                                                <td><?php echo ($vo1['name']); ?></td>
                                                                <td><?php echo ($vo1['unit']); ?></td>
                                                                <td><?php echo ($vo1['num']); ?></td>
                                                                <td><?php echo ($vo1['sum']); ?></td>
                                                            </tr><?php endforeach; endif; endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--其它运行费用详细-->
                            <div  id="tab_yunxing" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">其它运行费用明细表</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="btn-group" style="margin-top:10px;">
                                            </div>
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="yunxing">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            项目明细
                                                        </th>
                                                        <th>
                                                            具体金额
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(empty($yunxing)): else: ?>
                                                        <?php if(is_array($yunxing)): foreach($yunxing as $k1=>$vo1): ?><tr>
                                                                <td><?php echo ($vo1['name']); ?></td>
                                                                <td><?php echo ($vo1['sum']); ?></td>
                                                            </tr><?php endforeach; endif; endif; ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--派遣和劳务支出表-->
                            <div  id="tab_dispatch" class="modal fade" role="dialog" aria-hidden="true" >
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">劳务和派遣费用明细表</h4>
                                        </div>
                                        <div class="modal-body">

                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                        <tr>
                                            <th rowspan="2">部门</th>
                                            <th rowspan="2">岗位</th>
                                            <th rowspan="2">人数</th>
                                            <th rowspan="2">工作月数</th>
                                            <th rowspan="2">月工资</th>
                                            <th rowspan="2">社保</th>
                                            <th rowspan="2">社补</th>
                                            <th rowspan="2">公积金</th>
                                            <th colspan="2">月福利费</th>
                                            <th colspan="6">年度小计</th>
                                            <th rowspan="2">年度合计</th>
                                            <th rowspan="2">备注</th>
                                        </tr>
                                        <tr>
                                            <th>降温费</th>
                                            <th>慰问费</th>
                                            <th>工资</th>
                                            <th>五险一金</th>
                                            <th>福利费</th>
                                            <th>管理费</th>
                                            <th>保险费</th>
                                            <th>年终奖</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($department_child_list)): foreach($department_child_list as $k1=>$vo1): if(empty($dispatch[$k1]) and $vo1['type'] == 2): ?><!--<tr>
                                                    <td id="personnel_<?php echo ($k1); ?>" style="vertical-align:middle;"  rowspan="<?php echo count($dispatch[$k1])+1;?>"><?php echo ($vo1['name']); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                </tr>-->
                                                <?php elseif($vo1['type'] == 2): ?>
                                                <?php $cache_key=key($dispatch[$k1]);?>
                                                <?php if(is_array($dispatch[$k1])): foreach($dispatch[$k1] as $k2=>$vo2): ?><tr>
                                                        <?php if($k2 == $cache_key): ?><td id="personnel_<?php echo ($k1); ?>" style="vertical-align:middle;" rowspan="<?php echo count($dispatch[$k1]);?>"><?php echo ($vo1['name']); ?></td><?php endif; ?>
                                                        <td><?php echo ($vo2['job']); ?></td>
                                                        <td><?php echo ($vo2['num']); ?></td>
                                                        <td><?php echo ($vo2['month']); ?></td>
                                                        <td><?php echo ($vo2['month_0']); ?></td>
                                                        <td><?php echo ($vo2['month_1']); ?></td>
                                                        <td><?php echo ($vo2['month_6']); ?></td>
                                                        <td><?php echo ($vo2['month_2']); ?></td>
                                                        <td><?php echo ($vo2['month_3']); ?></td>
                                                        <td><?php echo ($vo2['month_4']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['month_0']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['month_1']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['month_other']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['month_5']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['insurance']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['year_end']); ?></td>
                                                        <td><?php echo ($sum['dispatch'][$k1][$k2]['sum']); ?></td>
                                                        <td title="<?php echo ($vo2['remark']); ?>"><?php echo ($vo2['remark']); ?></td>
                                                    </tr><?php endforeach; endif; endif; endforeach; endif; ?>
                                        <tr style="color: red">
                                            <td colspan="2">合计</td>
                                            <td><?php echo ($sum['dispatch']['sum']['num']); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['dispatch']['sum']['month_0']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['month_1']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['month_other']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['month_5']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['insurance']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['year_end']); ?></td>
                                            <td><?php echo ($sum['dispatch']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr style="color: red">
                                            <td colspan="2">总计</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo ($sum['dispatch']['sum']['sum']); ?></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-actions">
                    <div class="row" style="margin-top:30px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php if(is_array($predict_log)): foreach($predict_log as $key=>$vo): ?><tr>
                                    <td width="25%" height="160" rowspan="2" align="center" valign="middle" style="border:1px #e7ecf1 solid; font-size:24px;"><?php echo ($vo['admin_role_name']); ?></td>
                                    <td width="75%" height="100" colspan="2" align="center" valign="top" style="border:1px #e7ecf1 solid; border-left:none;"><textarea readonly="readonly" name="textarea" style="width:95%; height:80px; border:1px #e7ecf1 solid; margin-top:10px;"><?php echo ($vo['remark']); ?></textarea></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" valign="middle" style="border:1px #e7ecf1 solid; border-left:none; border-top:none; padding-left:2.5%; font-size:16px;">日期：
                                        <input name="textfield" type="text" value="<?php echo date('Y-m-d H:i:s',$vo['updatetime']);?>" readonly  style="height:40px; line-height:40px; border:1px #e7ecf1 solid; width:80%; font-size:16px;"/></td>
                                    <td height="50" align="left" valign="middle" style="border:1px #e7ecf1 solid; border-left:none; border-top:none; padding-left:2.5%; font-size:16px;">签名：
                                        <input name="textfield2" type="text" value="<?php echo ($vo['admin_name']); ?>" readonly style="height:40px; line-height:40px; border:1px #e7ecf1 solid; width:80%; font-size:16px;"/></td>
                                </tr><?php endforeach; endif; ?>
                            <?php if(empty($display_button)): if($action_now and $action_now['status'] == $predict_info['status']): ?><tr>
                                    <td height="50" style="border:1px #e7ecf1 solid; border-top:none;">&nbsp;</td>
                                    <td height="50" colspan="2" align="left" style="border:1px #e7ecf1 solid; border-top:none; border-left:none;">
                                        <textarea  name="remark" style="width:95%; height:80px; border:1px #e7ecf1 solid; margin-top:10px;" placeholder="填写备注"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="50" style="border:1px #e7ecf1 solid; border-top:none;">&nbsp;</td>
                                    <td height="50" colspan="2" align="left" style="border:1px #e7ecf1 solid; border-top:none; border-left:none;">
                                        <if condition="$predict_info['status'] eq 6">
                                            <button onclick="apply_predict_one(<?php echo ($predict_info['predict_id']); ?>)" type="button" class="btn default" >应用到预算执行报表</button><?php endif; ?>
                                        <a href="#add_status" data-toggle="modal"><button type="button" class="btn default" >退回修改</button></a>
                                        <a href="<?php echo U('edit_predict_one',array('id'=>$predict_info['predict_id']));?>"><button type="button" class="btn green" style="margin-left: 2.5%">调整预算金额</button></a>
                                            <button type="button" class="btn red"  onclick="add_status_check(<?php echo ($action_now['next']['status']); ?>,'审核通过')"><?php echo ($action_now['next']['name']); ?></button>


                                    </td>
                                </tr><?php endif; ?>
                            </if>

                </table>

                </div>
            </div>
        </form>
    </div>
</div>
<div  id="add_status" class="modal fade" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">退回步骤列表</h4>
            </div>
            <div style="width:100%;">

                <div class="portlet-body form form-horizontal">
                    <div class="col-md-12" style="text-align:center;">
                    <?php if(is_array($action_now['return'])): foreach($action_now['return'] as $key=>$vo): ?><button type="button" class="btn red" onclick="add_status_check(<?php echo ($vo['status']); ?>,'<?php echo ($vo['name']); ?>')"><?php echo ($vo['name']); ?></button><br/><br/><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
            </div>
        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js1-->
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!--表格结束-->


</div>
</div>



</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
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
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<!--<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>-->
<script src="//cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<!--插入layer弹层js结束-->



<!--弹出层必要css,js-->
<link rel="stylesheet" href="<?php echo ($static_public); ?>js/artdialog/skins/mydialog.css?4.1.7">
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./tpl/System/Static/js/index1.js"></script>
<script>
    (function(E,C,D,A){var B,$,_,J="@ARTDIALOG.DATA",K="@ARTDIALOG.OPEN",H="@ARTDIALOG.OPENER",I=C.name=C.name||"@ARTDIALOG.WINNAME"+(new Date).getTime(),F=C.VBArray&&!C.XMLHttpRequest;E(function(){!C.jQuery&&document.compatMode==="BackCompat"&&alert("artDialog Error: document.compatMode === \"BackCompat\"")});var G=D.top=function(){var _=C,$=function(A){try{var _=C[A].document;_.getElementsByTagName}catch($){return!1}return C[A].artDialog&&_.getElementsByTagName("frameset").length===0};return $("top")?_=C.top:$("parent")&&(_=C.parent),_}();D.parent=G,B=G.artDialog,_=function(){return B.defaults.zIndex},D.data=function(B,A){var $=D.top,_=$[J]||{};$[J]=_;if(A)_[B]=A;else return _[B];return _},D.removeData=function(_){var $=D.top[J];$&&$[_]&&delete $[_]},D.through=$=function(){var $=B.apply(this,arguments);return G!==C&&(D.list[$.config.id]=$),$},G!==C&&E(C).bind("unload",function(){var A=D.list,_;for(var $ in A)A[$]&&(_=A[$].config,_&&(_.duration=0),A[$].close(),delete A[$])}),D.open=function(B,P,O){P=P||{};var N,L,M,X,W,V,U,T,S,R=D.top,Q="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",a="width:100%;height:100%;border:none 0";if(O===!1){var Z=(new Date).getTime(),Y=B.replace(/([?&])_=[^&]*/,"$1_="+Z);B=Y+(Y===B?(/\?/.test(B)?"&":"?")+"_="+Z:"")}var G=function(){var B,C,_=L.content.find(".aui_loading"),A=N.config;M.addClass("aui_state_full"),_&&_.hide();try{T=W.contentWindow,U=E(T.document),S=T.document.body}catch($){W.style.cssText=a,A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null;return}B=A.width==="auto"?U.width()+(F?0:parseInt(E(S).css("marginLeft"))):A.width,C=A.height==="auto"?U.height():A.height,setTimeout(function(){W.style.cssText=a},0),N.size(B,C),A.follow?N.follow(A.follow):N.position(A.left,A.top),P.init&&P.init.call(N,T,R),P.init=null},I={zIndex:_(),init:function(){N=this,L=N.DOM,X=L.main,M=L.content,W=N.iframe=R.document.createElement("iframe"),W.src=B,W.name="Open"+N.config.id,W.style.cssText=Q,W.setAttribute("frameborder",0,0),W.setAttribute("allowTransparency",!0),V=E(W),N.content().appendChild(W),T=W.contentWindow;try{T.name=W.name,D.data(W.name+K,N),D.data(W.name+H,C)}catch($){}V.bind("load",G)},close:function(){V.css("display","none").unbind("load",G);if(P.close&&P.close.call(this,W.contentWindow,R)===!1)return!1;M.removeClass("aui_state_full"),V[0].src="about:blank",V.remove();try{D.removeData(W.name+K),D.removeData(W.name+H)}catch($){}}};typeof P.ok=="function"&&(I.ok=function(){return P.ok.call(N,W.contentWindow,R)}),typeof P.cancel=="function"&&(I.cancel=function(){return P.cancel.call(N,W.contentWindow,R)}),delete P.content;for(var J in P)I[J]===A&&(I[J]=P[J]);return $(I)},D.open.api=D.data(I+K),D.opener=D.data(I+H)||C,D.open.origin=D.opener,D.close=function(){var $=D.data(I+K);return $&&$.close(),!1},G!=C&&E(document).bind("mousedown",function(){var $=D.open.api;$&&$.focus(!0)}),D.load=function(C,D,B){B=B||!1;var G=D||{},H={zIndex:_(),init:function(A){var _=this,$=_.config;E.ajax({url:C,success:function($){_.content($),G.init&&G.init.call(_,A)},cache:B})}};delete D.content;for(var F in G)H[F]===A&&(H[F]=G[F]);return $(H)},D.alert=function(A){return $({id:"Alert",zIndex:_(),icon:"warning",fixed:!0,lock:!0,content:A,ok:!0})},D.confirm=function(C,A,B){return $({id:"Confirm",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:C,ok:function($){return A.call(this,$)},cancel:function($){return B&&B.call(this,$)}})},D.prompt=function(D,B,C){C=C||"";var A;return $({id:"Prompt",zIndex:_(),icon:"question",fixed:!0,lock:!0,opacity:0.1,content:["<div style=\"margin-bottom:5px;font-size:12px\">",D,"</div>","<div>","<input value=\"",C,"\" style=\"width:18em;padding:6px 4px\" />","</div>"].join(""),init:function(){A=this.DOM.content.find("input")[0],A.select(),A.focus()},ok:function($){return B&&B.call(this,A.value,$)},cancel:!0})},D.tips=function(B,A){return $({id:"Tips",zIndex:_(),title:!1,cancel:!1,fixed:!0,lock:!1}).content("<div style=\"padding: 0 1em;\">"+B+"</div>").time(A||1.5)},E(function(){var A=D.dragEvent;if(!A)return;var B=E(C),$=E(document),_=F?"absolute":"fixed",H=A.prototype,I=document.createElement("div"),G=I.style;G.cssText="display:none;position:"+_+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF",document.body.appendChild(I),H._start=H.start,H._end=H.end,H.start=function(){var E=D.focus.DOM,C=E.main[0],A=E.content[0].getElementsByTagName("iframe")[0];H._start.apply(this,arguments),G.display="block",G.zIndex=D.defaults.zIndex+3,_==="absolute"&&(G.width=B.width()+"px",G.height=B.height()+"px",G.left=$.scrollLeft()+"px",G.top=$.scrollTop()+"px"),A&&C.offsetWidth*C.offsetHeight>307200&&(C.style.visibility="hidden")},H.end=function(){var $=D.focus;H._end.apply(this,arguments),G.display="none",$&&($.DOM.main[0].style.visibility="visible")}})})(window.jQuery||window.art,this,this.artDialog)
</script>

<script src="./tpl/System/Static/js/common1.js"></script>
<!--弹出层必要css,js-->




<script>
    $(function(){
        $("[name='change_state']").click(function(){

            var pigcms_id = $(this).siblings(":first").text();
            var is_use = $(this).text();
            $.ajax({
                url: "<?php echo U('Terrace/change_state');?>",
                type: "GET",
                data: {'pigcms_id': pigcms_id,'is_use':is_use},
                success: function (res) {
                    if(res == 1){
                        alert("警告！将关闭所有平台！");
                        location.reload()
                    }else if(res ==2){
                        location.reload()
                    }else{
                        alert('改变失败');
                    }
                }
            });
        });
    });

</script>
</script>

<script src="/Car/Admin/Public/assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>


<!--引入js-->

<!--自定义js代码区开始-->
<script>
    function add_status(status) {
        $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
    }
    function add_status_check(status,text) {
        add_status(status);
        swal({
                title: "确认执行"+text+"吗？",
                text: "请确认",
                type: "warning",
                html:true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $("#form").submit();
                }
            });
    }
</script>
<!--资产购置费方法-->
<script>
    var check='';
    var check_end='';
    check=<?php echo count($data_type[2]['data'][23])?:1;?>;
    <?php end($data_type[2]['data'][23]); ?>
    check_end=<?php echo key($data_type[2]['data'][23])?:1;?>;
    /*删除一行*/
    function deleteRow_check(r)
    {
        if(check==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        check--;
        $('#check').attr('rowspan',check);
    }
    /*添加一行*/
    function addrow_check() {
        check++;
        check_end++;
        var html='<tr>';
        html +='<td><input value="" name="data[2][23][children]['+check_end+'][type_name]" type="text" class="record_check_time"/></td>';
        html +='<td><input value="" name="data[2][23][children]['+check_end+'][type_data][sum]" type="text" class="record_check_time"/></td>';
        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_check(this)">删除此行 </button></td>';
        html +='</tr>';
        if(check==2){
            $('#check').parent('tr').after(html);
        }else{
            $('#check').parent('tr').nextAll().eq((check-3)).after(html);
        }
        $('#check').attr('rowspan',check);

    }
</script>
<!--人员支出页面方法-->
<script>
    var personnel=new Array();
    var personnel_end=new Array();
    <?php if(is_array($department_child_list)): foreach($department_child_list as $k=>$vo): ?>personnel[<?php echo ($k); ?>]=<?php echo count($data_type[1]['data'][$k])?:1;?>;
    <?php end($data_type[1]['data'][$k]); ?>
    personnel_end[<?php echo ($k); ?>]=<?php echo key($data_type[1]['data'][$k])?:1;?>;<?php endforeach; endif; ?>
    /*删除一行*/
    function deleteRow(r,personnel_type)
    {
        if(personnel[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        personnel[personnel_type]--;
        $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);
    }
    /*添加一行*/
    function addrow() {
        if($("#add_personnel option:selected").val()){
            var personnel_type=$("#add_personnel option:selected").val();
            var personnel_val=$("#add_personnel option:selected").text();
            personnel[personnel_type]++;
            personnel_end[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][clothes_fee]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_0]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_1]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_2]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_3]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_4]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_5]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_6]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_7]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][year_end]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            if(personnel[personnel_type]==2){
                $('#personnel_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_'+personnel_type).parent('tr').nextAll().eq((personnel[personnel_type]-3)).after(html);
            }
            $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);

        }else{
            return false;
        }
    }
</script>
<script>
    var personnel_overtime=new Array();
    var personnel_end_overtime=new Array();
    <?php if(is_array($department_child_list)): foreach($department_child_list as $k=>$vo): ?>personnel_overtime[<?php echo ($k); ?>]=<?php echo count($overtime['data'][$k])?:1;?>;
    <?php end($overtime['data'][$k]); ?>
    personnel_end_overtime[<?php echo ($k); ?>]=<?php echo key($overtime['data'][$k])?:1;?>;<?php endforeach; endif; ?>
    /*删除一行*/
    function deleteRow_overtime(r,personnel_type)
    {
        if(personnel_overtime[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        personnel_overtime[personnel_type]--;
        $('#personnel_overtime_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);
    }
    /*添加一行*/
    function addrow_overtime() {
        if($("#add_personnel_overtime option:selected").val()){
            var personnel_type=$("#add_personnel_overtime option:selected").val();
            var personnel_val=$("#add_personnel_overtime option:selected").text();
            personnel_overtime[personnel_type]++;
            personnel_end_overtime[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][regime]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            console.log(personnel_overtime[personnel_type]);
            if(personnel_overtime[personnel_type]==2){
                $('#personnel_overtime_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_overtime_'+personnel_type).parent('tr').nextAll().eq((personnel_overtime[personnel_type]-3)).after(html);
            }
            $('#personnel_overtime_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);

        }else{
            return false;
        }
    }
</script>
<!--物业费收入计算-->
<script>
    var property=new Array();
    var property_end=new Array();
    <?php if(is_array($property_list)): foreach($property_list as $k=>$vo): ?>property[<?php echo ($k); ?>]=<?php echo count($property['data'][$k])?:1;?>;
    <?php end($vo); ?>
    property_end[<?php echo ($k); ?>]=<?php echo key($property['data'][$k])?:1;?>;<?php endforeach; endif; ?>
    /*删除一行*/
    function deleteRow_property(r,personnel_type)
    {
        if(property[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        property[personnel_type]--;
        $('#property_'+personnel_type).attr('rowspan',property[personnel_type]);
        $('#property_last_'+personnel_type).attr('rowspan',property[personnel_type]);
        $('#property_now_'+personnel_type).attr('rowspan',property[personnel_type]);


    }
    /*添加一行*/
    function addrow_property() {
        if($("#add_property option:selected").val()){
            var personnel_type=$("#add_property option:selected").val();
            var personnel_val=$("#add_property option:selected").text();
            property[personnel_type]++;
            property_end[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][name]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_last_0]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_now_0]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_now_1]" type="text" class="record_check_time"/></td>';
            html +='<td></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_property(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            if(property[personnel_type]==2){
                $('#property_'+personnel_type).parent('tr').after(html);
            }else{
                $('#property_'+personnel_type).parent('tr').nextAll().eq((property[personnel_type]-3)).after(html);
            }
            $('#property_'+personnel_type).attr('rowspan',property[personnel_type]);
            $('#property_last_'+personnel_type).attr('rowspan',property[personnel_type]);
            $('#property_now_'+personnel_type).attr('rowspan',property[personnel_type]);

        }else{
            return false;
        }
    }
    /*应用至预算汇总方法*/
    function apply_predict_one(id) {
        swal({
            title: "是否应用至预算汇总表?",
            text: "请确认",
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确认",
            cancelButtonText: "取消",
            closeOnConfirm: false,
            showCancelButton: true,
        }, function (iscom){
            if(iscom){
                swal({title:"正在应用至预算汇总表中，请耐心等待。",showLoaderOnConfirm:true});
                window.location.href='<?php echo U("Budget/apply_predict_one");?>&id='+id;
            }else{
                swal.close();
            }
            /*$.post("<?php echo U('Contract/store_ajax_del_pic');?>",{path:path});
             $(obj).closest('.upload_pic_li').remove();
             swal.close();*/
        })
    }
</script>
<!--自定义js代码区结束-->