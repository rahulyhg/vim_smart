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
   
<style type="text/css">
    .btn-icon-only {width:18px; height:18px;}
    .pd {padding:0; border:none;}
    .tq {width:100%; height:154px; background:url(/static/weather_img/xx1.jpg) no-repeat;}
    .btn:not(.btn-sm):not(.btn-lg) {line-height: 1.3;}
    a {
        text-shadow: none;
        color: #337ab7;
    }
    .easy-pie-chart .number {
        font-weight: 300;
        width: 75px;
        margin: 0 auto;
    }
    .tq2 {width:85%; padding-top:40px; margin:0px auto;}
    .tq3 {width:70%; float:left;}
    .tq4 {width:20%; float:right; padding-top:9px;}
    .cw1 {width:100%; height:50px; overflow:hidden; line-height:50px;}
    .cw2 {width:100%; height:20px; overflow:hidden; line-height:20px; color:#FFFFFF; font-size:16px;}
    .wz1 {width:80px; float:left; line-height:50px; color:#FFFFFF; font-family:Arial; font-weight:bold; font-size:30px;}
    .wz2 {width:70px; float:left; color:#FFFFFF; padding-top:5px; margin-left:2%;}
    .wz3 {width:100%; line-height:20px; overflow:hidden; color:#FFFFFF; font-size:12px;}
	
	@media screen and (min-width: 1390px) and (max-width:1510px)  { 
	  .widget-thumb .widget-thumb-body .widget-thumb-body-stat {
	 	 font-size:24px;
	  }
	}
	
	@media screen and (min-width: 1270px) and (max-width:1390px)  { 
	  .widget-thumb .widget-thumb-body .widget-thumb-body-stat {
	 	 font-size:24px;
	  }
	}


</style>
<!--<script src="/Car/Admin/Public/assets/global/plugins/echarts/echarts.js" type="text/javascript"></script>-->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <?php if(is_array($top_list)): foreach($top_list as $key=>$vo): ?><div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1><?php echo ($vo['name']); ?> <span style="color:#9e9e9e; font-size:18px;">/ Project Profile</span>
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                    <!-- BEGIN PAGE TOOLBAR -->
                    <!--<div class="page-toolbar">
                        <div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs"></span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>-->
                    <!-- END PAGE TOOLBAR -->
                </div>

                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE BASE CONTENT -->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="row">
                    <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-bottom-10">
                            <div class="<?php echo ($vo1['class']); ?>">
                                <div class="visual">
                                    <i class="<?php echo ($vo1['argument']['icon']); ?>"></i>
                                </div>
                                <div class="details">
                                    <?php if(strpos($vo1['data'],'/')): ?><div class="number"><span data-counter="counterup" data-value="<?php echo explode('/',$vo1['data'])['0'];?>">0</span>/<span data-counter="counterup" data-value="<?php echo explode('/',$vo1['data'])['1'];?>">0</span><span style="font-size:16px; font-family:'微软雅黑';"> <?php echo ($vo1['unit']); ?></span> </div>
                                        <?php else: ?>
                                        <div class="number" data-counter="counterup" data-value="<?php echo ($vo1['data']); ?>">0<span style="font-size:16px; font-family:'微软雅黑';"> <?php echo ($vo1['unit']); ?></span> </div><?php endif; ?>
                                    <div class="desc"> <?php echo ($vo1['name']); ?> </div>
                                </div>
                                <a class="more" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>"> 查看更多
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div><?php endforeach; endif; ?>
                <div class="clearfix"></div><?php endforeach; endif; ?>

            <?php if(is_array($menu_list)): $k = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><!--单独处理第一个循环变量宽度-->
                <?php if($k == 1): ?><div class="col-lg-9 col-xs-12 col-sm-12">
                            <?php else: ?>
                            <div class="col-lg-6 col-xs-12 col-sm-12"><?php endif; ?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase"><?php echo ($vo['name']); ?></span>
                        </div>
                        <div class="col-md-2" style="float:right;">
                            <div class="page-toolbar">
                                <div id="<?php echo ($vo['id']); ?>-range"  class="pull-right tooltips btn btn-fit-height green" data-placement="left" >
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span style="display: none"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="btn-group btn-theme-panel">
                                </div>
                            </div>
                        </div><div style="clear:both"></div>
                    </div>
                    <div class="portlet-body">
                    <?php if($vo['argument']['map_type'] == 1): ?><!--模板 小方块 map_type1-->
                            <div class="row widget-row">
                                <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div class="col-md-4">
                                    <!-- BEGIN WIDGET THUMB -->
                                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                                <h4 class="widget-thumb-heading"><?php echo ($vo1['name']); ?></h4>
                                                <div class="widget-thumb-wrap">
                                                    <i class="<?php echo ($vo1['argument']['icon']); ?>"></i>
                                                    <div class="widget-thumb-body">
                                                        <span class="widget-thumb-subtitle"><?php echo ($vo1['unit']); ?></span>
                                                        <a class="more" style="text-decoration:none;" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>">
                                                        <span  class="widget-thumb-body-stat" id="<?php echo ($vo1['id']); ?>" data-counter="counterup" data-value="0">0</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    <!-- END WIDGET THUMB -->
                                    </div><?php endforeach; endif; ?>
                            </div>
                        <?php elseif($vo['argument']['map_type'] == 2): ?>
                            <!--模板 圆形百分图 map_type2-->
                            <div class="row">
                                <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): if($vo1['argument']['type'] == 1): ?><div class="col-md-4" style="margin-top:41px; margin-bottom:38px;">
                                            <div class="easy-pie-chart">
                                                <div class="<?php echo ($vo1['class']); ?>" data-percent="100">
                                                    <span><?php echo ($vo1['name']); ?></span></div>
                                                <a id="<?php echo ($vo1['id']); ?>" class="title" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>"> ￥0元
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="col-md-4" style="margin-top:41px;  margin-bottom:38px;">
                                            <div class="easy-pie-chart">
                                                <div id="<?php echo ($vo1['id']); ?>" class="<?php echo ($vo1['class']); ?>" data-percent="1">
                                                    <span>+0</span>% </div>
                                                <a class="title" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>"> <?php echo ($vo1['name']); ?>
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div><?php endif; ?>

                                    <div class="margin-bottom-10 visible-sm"> </div><?php endforeach; endif; ?>
                            </div>
                        <?php elseif($vo['argument']['map_type'] == 3): ?>
                        <!--模板 长条状图 map_type3-->
                        <div class="row">
                            <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div class="col-md-4">
                                    <div class="mt-widget-3">
                                <div class="<?php echo ($vo1['class']); ?>">
                                    <div class="mt-head-icon">
                                        <i class="<?php echo ($vo1['argument']['icon']); ?>"></i>
                                    </div>
                                    <div class="mt-head-desc" style="height:25px; overflow:hidden;"> <span style="font-size:18px;"><?php echo ($vo1['name']); ?></span> </div>
                                    <span class="mt-head-date" style="height:42px; overflow:hidden;"> <span id="<?php echo ($vo1['id']); ?>-all" style="font-size:30px;">完成率:0%</span> </span>
                                    <div class="mt-head-button">
                                        <a href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>">
                                            <button type="button" class="btn btn-circle btn-outline white btn-sm">详情</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-body-actions-icons">
                                    <div class="btn-group btn-group btn-group-justified">
                                        <a href="javascript:;" class="btn ">
                                                            <span class="mt-icon">
                                                            </span><span id="<?php echo ($vo1['id']); ?>-done" style="font-size:24px;">0</span><br/>已<?php echo mb_substr($vo1['name'],-2);?> </a>
                                        <a href="javascript:;" class="btn ">
                                                            <span class="mt-icon">
                                                            </span><span id="<?php echo ($vo1['id']); ?>-nodone" style="font-size:24px;">0</span><br/>未<?php echo mb_substr($vo1['name'],-2);?> </a>
                                    </div>
                                </div>
                                    </div>
                                </div><?php endforeach; endif; ?>
                        </div>
                        <?php elseif($vo['argument']['map_type'] == 4): ?>
                        <!--模板 map_type4-->
                        <div class="row widget-row">
                            <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div class="col-md-6" style="margin-bottom:10px;">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20">
                                        <div class="widget-thumb-wrap">
                                            <i class="<?php echo ($vo1['argument']['icon']); ?>" style="border-radius:50%;"></i>
                                            <a class="more" style="text-decoration:none;" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>">
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><?php echo ($vo1['name']); ?></span>
                                                <span class="widget-thumb-body-stat" id="<?php echo ($vo1['id']); ?>" data-counter="counterup" data-value="0">0</span>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- END WIDGET THUMB -->
                                </div><?php endforeach; endif; ?>
                        </div>
                        <?php elseif($vo['argument']['map_type'] == 5): ?>
                        <!--模板 雷达图 map_type5-->
                        <div style="width:55%; float:left;">
                            <div id="<?php echo ($vo['id']); ?>-chart" class="chart" style="height: 400px;width: 100%"> </div>
                        </div>
                        <div style="width:45%; float:right;">
                            <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div style="width:50%; float:left;">
                                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20">
                                        <div class="widget-thumb-wrap">
                                            <a class="more" style="text-decoration:none;" href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>">
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-body-stat" id="<?php echo ($vo1['id']); ?>" data-counter="counterup" data-value="0">0</span>
                                                <span class="widget-thumb-subtitle" style="height:20px; overflow:hidden;"><?php echo ($vo1['name']); ?></span>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><?php endforeach; endif; ?>
                        </div>
                        <div style="clear:both"></div>
                        <?php elseif($vo['argument']['map_type'] == 6): ?>
                        <!--模板 折线图 map_type6-->
                        <div id="<?php echo ($vo['id']); ?>_content" class="display">
                            <div id="<?php echo ($vo['id']); ?>_activities" style="height: 228px;"> </div>
                        </div>
                        <div style="margin: 20px 0 10px 30px">
                            <div class="row">
                                <?php if(is_array($vo['list'])): foreach($vo['list'] as $key=>$vo1): ?><div class="col-md-4 col-sm-3 col-xs-6 text-stat" style="margin-bottom:18px; margin-top:10px;">
                                        <span class="<?php echo ($vo1['class']); ?>"> <?php echo ($vo1['name']); ?> </span>
                                        <h3 id="<?php echo ($vo1['id']); ?>">¥0</h3>
                                    </div><?php endforeach; endif; ?>
                            </div>
                        </div>
                        <?php elseif($vo['argument']['map_type'] == 7): ?>
                        <div id="<?php echo ($vo['id']); ?>" class="chart" style="height: 400px;"> </div><?php endif; ?>
                    </div>
                </div>
            </div>
                    <?php if($k == 1): ?><div class="col-lg-3 col-xs-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">快捷入口</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <?php if(is_array($quick_list['list'])): foreach($quick_list['list'] as $key=>$vo1): ?><a href="<?php echo U($vo1['controller'].'/'.$vo1['action']);?>" title="<?php echo ($vo1['name']); ?>"><div class=" col-md-6 col-sm-4" style="margin-bottom:15px; height:20px; overflow:hidden;">
                                                    <div class="btn btn-circle btn-icon-only green pd">
                                                        <i class="<?php echo ($vo1['argument']['icon']); ?>"></i>
                                                    </div> <?php echo ($vo1['name']); ?>
                                                </div></a><?php endforeach; endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-12">
                            <div class="tq">
                                <div class="tq2">
                                    <div class="tq3" style="width: 80%">
                                        <div class="cw1">
                                            <div id="weather_temp" class="wz1"></div>
                                            <div class="wz2" style="width: 100px;margin-left: 26%">
                                                <div id="weather_week" class="wz3"></div>
                                                <div id="weather_day" class="wz3"></div>
                                            </div>
                                        </div>
                                        <div class="cw2">湖北省武汉市 江汉区</div>
                                    </div>
                                    <div class="tq4"><img id="weather_img" style="width: 53px;height: 53px"></div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <!-- END DASHBOARD STATS 1-->

            </div>
        </div>
        <!-- END CONTENT BODY -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.counterup.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/amcharts.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/serial.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/pie.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/radar.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/light.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/patterns.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/chalk.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/ammap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/worldLow.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/amstock.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/horizontal-timeline.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.world.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="./static/js/jquery-number.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/dashboard.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/charts-amcharts.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/index_new/js/quick-nav.min.js" type="text/javascript"></script>
<script src="https://cdn.bootcss.com/echarts/4.2.0-rc.1/echarts.min.js" type="text/javascript"></script>
<!--<script src="https://cdn.bootcss.com/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" type="text/javascript"></script>
-->
<script>
    //更新天气
    $.ajax({
        url:"<?php echo U('Indexajax/ajax_get_weater');?>",
        type:'post',
        dataType:'json',
        success:function (res) {
            $('#weather_temp').html(res['today']['temperature']+'°C');
            $('#weather_week').html(res['today']['week']);
            $('#weather_day').html(res['today']['date_y']);
            $('#weather_img').attr('src','./static/weather_img/day/'+res['today']['weather_id']['fa']+'.png');
        }
    })
</script>
<?php if(is_array($menu_list)): $k = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><script>
        $('#<?php echo ($vo['id']); ?>-range').daterangepicker({
            "ranges": {
                '总计':['2016-08-12',moment()],
                '今天': [moment(), moment()],
                '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
                '近7天': [moment().subtract('days', 6), moment()],
                '近30天': [moment().subtract('days', 29), moment()],
                '这个月': [moment().startOf('month'), moment().endOf('month')],
                '上个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            "locale": {
                "format": "YYYY-MM-DD",
                "separator": "至",
                "applyLabel": "确定",
                "cancelLabel": "取消",
                "fromLabel": "From",
                "toLabel": "至",
                "customRangeLabel": "自定义",
                /*"daysOfWeek": [
                    "星期一",
                    "星期二",
                    "星期三",
                    "星期四",
                    "星期五",
                    "星期六",
                    "星期日"
                ],*/
                "monthNames": [
                    "一月",
                    "二月",
                    "三月",
                    "四月",
                    "五月",
                    "六月",
                    "七月",
                    "八月",
                    "九月",
                    "十月",
                    "十一月",
                    "十二月"
                ],
                "firstDay": 1
            },
            "startDate": "2016-08-12",
            "endDate":moment() ,
            opens: (App.isRTL() ? 'right' : 'left'),
        }, function(start, end, label) {
            if ($('#<?php echo ($vo['id']); ?>-range').attr('data-display-range') != '0') {
                $('#<?php echo ($vo['id']); ?>-range span').html(start.format('YYYY-MM-DD') + '至' + end.format('YYYY-MM-DD'));
                change_<?php echo ($vo['id']); ?>();
            }
        });
        if ($('#<?php echo ($vo['id']); ?>-range').attr('data-display-range') != '0') {
            $('#<?php echo ($vo['id']); ?>-range span').html('1971-01-01至' + moment().format('YYYY-MM-DD'));
        }
        $('#<?php echo ($vo['id']); ?>-range').show();
    </script>
    <?php if($vo['argument']['map_type'] == 1): ?><script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',$.number(item['data']));
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                            }
                        );
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 2): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                if(item['arguments']['type']==1){
                                    $('#'+item['id']).html('￥'+item['data']+'元');
                                }else{
                                    //$('#'+item['id']).attr('data-percent',Math.round(item['data']/100));
                                    $('#'+item['id']).data('easyPieChart').update(Math.round(item['data']*100)>100?100:Math.round(item['data']*100));
                                    /*$('#'+item['id']).attr('data-percent',item['data']);*/
                                    $('#'+item['id']).find('span').html(Math.round(item['data']*100)>100?100:Math.round(item['data']*100));
                                }
                            }
                        )
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 3): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                var cache=""+item['data'];
                                var cache1=cache.split('-');
                                //var sum=parseInt(cache1['0'])+parseInt(cache1['1']);
                                var persent=cache1['0']/cache1['1'];
                                if(isNaN(persent)) persent=0;
                                //console.log(sum);
                                $('#'+item['id']+'-all').html('完成率:'+Math.round(persent*100)+'%');
                                $('#'+item['id']+'-done').html(Math.round(cache1['0']));
                                $('#'+item['id']+'-nodone').html(Math.round(cache1['1']-cache1['0']));
                            }
                        )
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 4): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',item['data']);
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                            }
                        )
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 5): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                var max_num=0;
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).attr('data-value',item['data']);
                                $('#'+item['id']) .counterUp({delay:10,time:1e3});
                                if(item['data']>max_num) max_num=item['data'];
                            }
                        );
                        // 基于准备好的容器(这里的容器是id为chart1的div)，初始化echarts实例
                        var myChart = echarts.init(document.getElementById('<?php echo ($vo['id']); ?>-chart'));
                        var indicator="[]";
                        indicator=eval('(' + indicator + ')');
                        var data_num=new Array();
                        res.forEach(
                            function (item,index,arr) {
                                var cache={'text':item['name'],'max':max_num}
                                indicator.push(cache);
                                data_num.push(item['data']);
                            }
                        );
                        var option = {
                            title : {
                                text: '<?php echo ($vo['name']); ?>统计',
                                textStyle:{
                                    fontWeight:'normal',
                                    fontSize:'14',
                                    color:'#666'
                                },
                                x:'center',
                                y:'15'
                            },
                            tooltip : {
                                trigger: 'axis',
                                padding:10,
                                formatter:function(params){
                                    /*var data = '';
                                    $.each(params,function (index,item) {
                                        data += item.name+':'+item.value+'&nbsp;万元 '+ '<br/>';
                                    });
                                    return params[0].indicator+'<br/>'+data;*/
                                }
                            },
                            polar : [
                                {
                                    radius:95,   //半径
                                    center:['50%','50%'], // 图的位置
                                    name:{
                                        // show: true, // 是否文字
                                        // formatter: null, // 文字的显示形式
                                        textStyle: {
                                            color:'#999'   // 文字颜色
                                        }
                                    },
                                    indicator : indicator,
                                    splitArea : {
                                        show : true,
                                        areaStyle : {
                                            color: ["#f8f8f8","#e9e9e9"]  // 图表背景网格区域的颜色
                                        }
                                    },
                                    splitLine : {
                                        show : true,
                                        lineStyle : {
                                            width : 1,
                                            color : '#dbdbdb' // 图表背景网格线的颜色
                                        }
                                    }
                                }
                            ],
                            calculable : true,
                            series : [
                                {
                                    name: '',
                                    type: 'radar',
                                    symbol:'emptyCircle',  /*曲线圆点*/
                                    symbolSize:4,
                                    data : [
                                        {
                                            value: data_num,
                                            name: '模拟站',
                                            totalNumber: 1000,
                                            itemStyle: {
                                                normal: {
                                                    color: "#f4bc65"   // 图表中各个图区域的边框线颜色
                                                }
                                            }
                                        }
                                    ]
                                }
                            ]
                        };

                        // 使用刚指定的配置项和数据显示图表
                        myChart.setOption(option);
                    }
                })

            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 6): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        var chartData = res['map'];
                        var echo=res['echo'];
                        echo.forEach(
                            function (item,index,arr) {
                                if(item['data']){
                                    $('#'+item['id']).html($.number(item['data'],2));
                                }
                            }
                        );
                        console.log(chartData);
                            //AmSerialChart 类
                        var chart = AmCharts.makeChart("<?php echo ($vo['id']); ?>_activities", {
                            "type": "serial",
                            "theme":"light",
                            "dataProvider": chartData,
                            "categoryField": "date",
                            "categoryAxis": {
                                "autoGridCount": false,
                                "gridCount": chartData.length,
                                "gridPosition": "start",
                                "gridAlpha": 0,
                                "categoryAxisColor":"#123456",
                            },
                            toolbox: {
                                //显示策略，可选为：true（显示） | false（隐藏），默认值为false
                                show: true,
                                //启用功能，目前支持feature，工具箱自定义功能回调处理
                                feature: {
                                    //辅助线标志
                                    mark: {show: true},
                                    //dataZoom，框选区域缩放，自动与存在的dataZoom控件同步，分别是启用，缩放后退
                                    dataZoom: {
                                        show: true,
                                        title: {
                                            dataZoom: '区域缩放',
                                            dataZoomReset: '区域缩放后退'
                                        }
                                    },
                                    //数据视图，打开数据视图，可设置更多属性,readOnly 默认数据视图为只读(即值为true)，可指定readOnly为false打开编辑功能
                                    dataView: {show: true, readOnly: true},
                                    //magicType，动态类型切换，支持直角系下的折线图、柱状图、堆积、平铺转换
                                    magicType: {show: true, type: ['line', 'bar']},
                                    //restore，还原，复位原始图表
                                    restore: {show: true},
                                    //saveAsImage，保存图片（IE8-不支持）,图片类型默认为'png'
                                    saveAsImage: {show: true}
                                }
                            },
                            "gridAboveGraphs": true,
                            "startDuration": 1,
                            "valueAxes": [{
                                "id":"income",
                                "axisAlpha": 0,
                                "position": "left",
                                "title": "元"
                            }],
                            "balloon": {
                                "borderThickness": 1,
                                "shadowAlpha": 0
                            },

                            "graphs": [ {
                                "fillAlphas": 0.2,
                                "bullet": "round",
                                "bulletBorderAlpha": 1,
                                "bulletColor": "#36C6D3",
                                "lineColor":"#36C6D3",
                                "bulletSize": 5,
                                "hideBulletsCount": 50,
                                "lineThickness": 2,
                                "title": "red line",
                                "useLineColorForBulletBorder": true,
                                "valueField": "visits",
                                "balloonText": "<span style='font-size:18px;'>[[category]]支出[[value]]元</span>",
                                "valueAxis": "three"
                            }/*,{
                             "fillAlphas": 0.2,
                             "bullet": "round",
                             "lineThickness": 2,
                             "bulletColor": "#ED6B75",
                             "lineColor":"#ED6B75",
                             "valueField": "true_income",
                             "balloonText": "<span style='font-size:18px;'>[[value]]</span>",
                             "valueAxis": "income"
                             }*/
                            ],
                            "chartCursor": {
                                "valueLineEnabled": true,
                                "valueLineBalloonEnabled": true,
                                "cursorAlpha": 0,
                                "zoomable": false,
                                "valueZoomable": true,
                                "valueLineAlpha": 0.5
                            },

                        } );
                            /*chart.dataProvider = chartData;     //指定数据源
                            chart.categoryField = "country";    //数据的分类*/

                            //创建
                            /*var graph = new AmCharts.AmGraph();
                            graph.valueField = "visits";    //数值字段名称
                            graph.type = "column";          //列名称
                            graph.type = "line";
                            graph.fillAlphas = 0.5;
                            chart.addGraph(graph);*/
                            //chart.write(document.getElementById("<?php echo ($vo['id']); ?>_activities")); //write 到 div 中
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script>
        <?php elseif($vo['argument']['map_type'] == 7): ?>
        <script>
            function change_<?php echo ($vo['id']); ?>() {
                var ids=<?php echo ($vo['ids']); ?>;
                var time=$('#<?php echo ($vo['id']); ?>-range span').html();
                $.ajax({
                    url:'<?php echo (htmlspecialchars_decode($vo['argument']['ajax_url'])); ?>',
                    type:'post',
                    data:{'ids':ids,'time':time},
                    dataType:'json',
                    success:function (res) {
                        res.forEach(
                            function (item,index,arr) {
                                $('#'+item['id']).html(item['data']);
                            }
                        );
                        //AmSerialChart 类
                        var e = AmCharts.makeChart("<?php echo ($vo['id']); ?>", {
                            type: "serial",
                            theme: "light",
                            fontFamily: "Open Sans",
                            color: "#888888",
                            legend: {
                                equalWidths: !1,
                                useGraphSettings: !0,
                                valueAlign: "left",
                                valueWidth: 120
                            },
                            dataProvider: [{
                                date: "2012-01-01",
                                distance: 227,
                                townName: "New York",
                                townName2: "New York",
                                townSize: 25,
                                latitude: 40.71,
                                duration: 408
                            }, {
                                date: "2012-01-02",
                                distance: 371,
                                townName: "Washington",
                                townSize: 14,
                                latitude: 38.89,
                                duration: 482
                            }, {
                                date: "2012-01-03",
                                distance: 433,
                                townName: "Wilmington",
                                townSize: 6,
                                latitude: 34.22,
                                duration: 562
                            }, {
                                date: "2012-01-04",
                                distance: 345,
                                townName: "Jacksonville",
                                townSize: 7,
                                latitude: 30.35,
                                duration: 379
                            }, {
                                date: "2012-01-05",
                                distance: 480,
                                townName: "Miami",
                                townName2: "Miami",
                                townSize: 10,
                                latitude: 25.83,
                                duration: 501
                            }, {
                                date: "2012-01-06",
                                distance: 386,
                                townName: "Tallahassee",
                                townSize: 7,
                                latitude: 30.46,
                                duration: 443
                            }, {
                                date: "2012-01-07",
                                distance: 348,
                                townName: "New Orleans",
                                townSize: 10,
                                latitude: 29.94,
                                duration: 405
                            }, {
                                date: "2012-01-08",
                                distance: 238,
                                townName: "Houston",
                                townName2: "Houston",
                                townSize: 16,
                                latitude: 29.76,
                                duration: 309
                            }, {
                                date: "2012-01-09",
                                distance: 218,
                                townName: "Dalas",
                                townSize: 17,
                                latitude: 32.8,
                                duration: 287
                            }, {
                                date: "2012-01-10",
                                distance: 349,
                                townName: "Oklahoma City",
                                townSize: 11,
                                latitude: 35.49,
                                duration: 485
                            }, {
                                date: "2012-01-11",
                                distance: 603,
                                townName: "Kansas City",
                                townSize: 10,
                                latitude: 39.1,
                                duration: 890
                            }, {
                                date: "2012-01-12",
                                distance: 534,
                                townName: "Denver",
                                townName2: "Denver",
                                townSize: 18,
                                latitude: 39.74,
                                duration: 810
                            }, {
                                date: "2012-01-13",
                                townName: "Salt Lake City",
                                townSize: 12,
                                distance: 425,
                                duration: 670,
                                latitude: 40.75,
                                dashLength: 8,
                                alpha: .4
                            }, {
                                date: "2012-01-14",
                                latitude: 36.1,
                                duration: 470,
                                townName: "Las Vegas",
                                townName2: "Las Vegas"
                            }, {
                                date: "2012-01-15"
                            }, {
                                date: "2012-01-16"
                            }, {
                                date: "2012-01-17"
                            }, {
                                date: "2012-01-18"
                            }, {
                                date: "2012-01-19"
                            }],
                            valueAxes: [{
                                id: "distanceAxis",
                                axisAlpha: 0,
                                gridAlpha: 0,
                                position: "left",
                                title: "distance"
                            }, {
                                id: "latitudeAxis",
                                axisAlpha: 0,
                                gridAlpha: 0,
                                labelsEnabled: !1,
                                position: "right"
                            }, {
                                id: "durationAxis",
                                duration: "mm",
                                durationUnits: {
                                    hh: "h ",
                                    mm: "min"
                                },
                                axisAlpha: 0,
                                gridAlpha: 0,
                                inside: !0,
                                position: "right",
                                title: "duration"
                            }],
                            graphs: [{
                                alphaField: "alpha",
                                balloonText: "[[value]] miles",
                                dashLengthField: "dashLength",
                                fillAlphas: .7,
                                legendPeriodValueText: "total: [[value.sum]] mi",
                                legendValueText: "[[value]] mi",
                                title: "distance",
                                type: "column",
                                valueField: "distance",
                                valueAxis: "distanceAxis"
                            }, {
                                balloonText: "latitude:[[value]]",
                                bullet: "round",
                                bulletBorderAlpha: 1,
                                useLineColorForBulletBorder: !0,
                                bulletColor: "#FFFFFF",
                                bulletSizeField: "townSize",
                                dashLengthField: "dashLength",
                                descriptionField: "townName",
                                labelPosition: "right",
                                labelText: "[[townName2]]",
                                legendValueText: "[[description]]/[[value]]",
                                title: "latitude/city",
                                fillAlphas: 0,
                                valueField: "latitude",
                                valueAxis: "latitudeAxis"
                            }, {
                                bullet: "square",
                                bulletBorderAlpha: 1,
                                bulletBorderThickness: 1,
                                dashLengthField: "dashLength",
                                legendValueText: "[[value]]",
                                title: "duration",
                                fillAlphas: 0,
                                valueField: "duration",
                                valueAxis: "durationAxis"
                            }],
                            chartCursor: {
                                categoryBalloonDateFormat: "DD",
                                cursorAlpha: .1,
                                cursorColor: "#000000",
                                fullWidth: !0,
                                valueBalloonsEnabled: !1,
                                zoomable: !1
                            },
                            dataDateFormat: "YYYY-MM-DD",
                            categoryField: "date",
                            categoryAxis: {
                                dateFormats: [{
                                    period: "DD",
                                    format: "DD"
                                }, {
                                    period: "WW",
                                    format: "MMM DD"
                                }, {
                                    period: "MM",
                                    format: "MMM"
                                }, {
                                    period: "YYYY",
                                    format: "YYYY"
                                }],
                                parseDates: !0,
                                autoGridCount: !1,
                                axisColor: "#555555",
                                gridAlpha: .1,
                                gridColor: "#FFFFFF",
                                gridCount: 50
                            },
                            exportConfig: {
                                menuBottom: "20px",
                                menuRight: "22px",
                                menuItems: [{
                                    icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                                    format: "png"
                                }]
                            }
                        });
                        /*$("#<?php echo ($vo['id']); ?>").closest(".portlet").find(".fullscreen").click(function () {
                            e.invalidateSize()
                        })*/
                        /*chart.dataProvider = chartData;     //指定数据源
                         chart.categoryField = "country";    //数据的分类*/

                        //创建
                        /*var graph = new AmCharts.AmGraph();
                         graph.valueField = "visits";    //数值字段名称
                         graph.type = "column";          //列名称
                         graph.type = "line";
                         graph.fillAlphas = 0.5;
                         chart.addGraph(graph);*/
                        //chart.write(document.getElementById("<?php echo ($vo['id']); ?>_activities")); //write 到 div 中
                    }
                })
            };
                change_<?php echo ($vo['id']); ?>();
        </script><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</body>