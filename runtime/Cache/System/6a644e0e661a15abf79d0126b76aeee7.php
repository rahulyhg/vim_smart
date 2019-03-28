<?php if (!defined('THINK_PATH')) exit();?>

    <!--头部文件-->
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
   {__CONTENT__}
    



    <!--/头部文件-->




<!--<div class="page-container">-->
    <!-- BEGIN SIDEBAR -->

    <!--主体-->
    <div class="page-content-wrapper" id="main">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1><?php $breadcrumb = $breadcrumb_diy?:$breadcrumb; echo $breadcrumb[count($breadcrumb)-1][0]; ?>
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
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-12" id="table-toolbar-left">
                                        
    <!--<div class="btn-group">
        <a href="<?php echo U('PropertyService/room_add_uptown');?>">
            <button id="sample_editable_1_new" class="btn sbold green">添加楼层房间
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->
    <div class="btn-group">
        <a href="#form_modal2" data-toggle="modal">

            <button  class="btn sbold btn-danger" >
                <i class="fa fa-user"></i>
                业主缴费录入
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="<?php echo U('Receipt/receipt_list');?>">

            <button  class="btn sbold btn-danger" >
                <i class="fa fa-file-text-o"></i>
                历史缴费记录
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="<?php echo U('Property/month');?>">
            <button  class="btn sbold btn-danger" >
                <i class="fa fa-table"></i>
                报表台账
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#form_modal3" data-toggle="modal">
            <button  class="btn sbold green" >
                <i class="fa fa-pie-chart"></i>
                经营数据分析
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub()">
                <i class="fa fa-print"></i>
                打印选中催收单
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub_project()">
                <i class="fa fa-print"></i>
                打印全部欠费催收单
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="<?php echo U('Room/owner_uptown_import_step1');?>">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-plus"></i>
                单元导入
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="<?php echo U('Room/water_uptown_import_step1');?>">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-plus"></i>
                水电费批量导入
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="<?php echo U('Otherfee/getotherfee_list');?>" target="_blank">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-th-list"></i>
                收费类目管理
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="<?php echo U('Room/ajax_village_excel_print',array('year'=>$year));?>">
            <button id="sample_editable_1_new" class="btn sbold green">导出excel表格
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <br>
    <!--    筛选-->
    <div class="btn-group" style="margin-top: 10px">
        <span>筛选（默认显示全部）：</span>
        <span id="filter">
                <span>
                    <!--<div class="btn-group">
                        <select name="project_id" id="project_id_1" class="form-control search">
                            <option value="" selected="selected">请选择期数</option>
                            <?php if(is_array($project_list)): $i = 0; $__LIST__ = $project_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><option value="<?php echo ($value['pigcms_id']); ?>"><?php echo ($value['desc']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>-->
                    <div class="btn-group">
                        <select id="room_over_endtime" class="form-control search" onchange="search_change('room_over_endtime',this.options[this.options.selectedIndex].value)">
                            <option value="0" selected="selected">按缴费状态</option>
                            <option value="1">已欠费</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="room_house_type" class="form-control search" onchange="search_change('room_house_type',this.options[this.options.selectedIndex].value)">
                            <option value="4" selected="selected">按房屋状态</option>
                            <option value="0">空置</option>
                            <option value="1">出租</option>
                            <option value="2">自住</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="room_type" class="form-control search" onchange="search_change('room_type',this.options[this.options.selectedIndex].value)">
                            <option value="" selected="selected">按业主类型</option>
                            <option value="1">业主</option>
                            <option value="2">商户</option>
                            <option value="other">其它</option>
                        </select>
                    </div>
                </span>
            </span>
    </div>

    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">费用录入</h4>
                </div>

                <div class="modal-body">
                    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data" autocomplete="off">
                        <div class="portlet-body">

                            <div class="form-body">
                                <div style="width:64%; float:left; border-right: 1px #d0d0d0 solid;">
                                    <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">门牌号
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" id="room_name" value="" name="room_name" class="form-control" autocomplete="off" disableautocomplete>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">缴费类型
                                        </label>
                                        <div class="col-md-7">
                                            <select name="otherfee_type_id" id="otherfee_type_id" class="form-control">
                                                <option value="0">请选择</option>
                                                <option value="property">物业服务费</option>
                                                <option value="carspace">包月泊位费</option>
                                                <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["otherfee_type_id"]); ?>"><?php echo ($vo["otherfee_type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">付款预付月数
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select name="property_mouth" class="form-control" id="property_mouth">
                                                    <option value="0" selected="selected">请选择</option>
                                                    <?php $__FOR_START_17003__=1;$__FOR_END_17003__=24;for($i=$__FOR_START_17003__;$i < $__FOR_END_17003__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>个月</option><?php } ?>
                                                </select>
                                                <span class="required">如果没有设置过物业费到期时间，请先调整到期时间</span>
                                            </div>
                                        </div>
                                        <div class="property_pay" style="display: none;">
                                            <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                                <label class="col-md-5 control-label" for="form_control_1">应付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="property_recive" value="" name="property_recive" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                                <label class="col-md-5 control-label" for="form_control_1">实付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="property_true" value="" name="property_true" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carspace" style="display: none;">
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">选择车位
                                            </label>
                                            <div class="col-md-7">
                                                <select name="carspace_id" class="form-control">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">付款预付月数
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select name="carspace_mouth" class="form-control" id="carspace_mouth">
                                                    <option value="0" selected="selected">请选择</option>
                                                    <?php $__FOR_START_15872__=1;$__FOR_END_15872__=24;for($i=$__FOR_START_15872__;$i < $__FOR_END_15872__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>个月</option><?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="carspace_pay" style="display: none;">
                                            <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                                <label class="col-md-5 control-label" for="form_control_1">应付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                    <label id="carspace_recive"></label>元
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                                <label class="col-md-5 control-label" for="form_control_1">实付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="carspace_true" value="" name="carspace_true" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="other_fee" style="display: none;">
                                        <?php if($is_code): ?><div class="form-group form-md-line-input"  style="width:42%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1" >起码
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="code_start" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input"  style="width:30%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1 " >止码
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="code_end" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input"  style="width:33%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1" >单价
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="unit" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div><?php endif; ?>
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1" id="fee_receive">应收
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="md-checkbox-list">
                                                    <input type="text" name="fee_receive" value=""  class="form-control control" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;" id="fee_true_div">
                                            <label class="col-md-5 control-label" for="form_control_1" id="fee_true">实收
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="md-checkbox-list">
                                                    <input type="text" name="fee_true" value=""  class="form-control control" >
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                        <label class="col-md-5 control-label" for="form_control_1">缴费方式
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="type" class="form-control">
                                                <!--<option value="2">现金</option>
                                                <option value="1">线上支付</option>
                                                <option value="3">转账</option>
                                                <option value="4">POS单</option>
                                                <option value="5">现金缴款单</option>-->
                                                <?php if(is_array($fee_type_list)): foreach($fee_type_list as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">备注
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7" >
                                            <textarea    value="" name="remark" class="form-control" style="height:34px;"></textarea>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>


                                </div>


                                <div style="float:left; width:35%;">

                                    <div id="room_info" class="form-group form-md-line-input" style="display: none;">
                                        <label class="col-md-4 control-label" for="form_control_1" >房屋信息
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <span id="room_info_id"></span>
                                        </div>
                                    </div>

                                    <div id="user_info" class="form-group form-md-line-input" style="display: none;">
                                        <label class="col-md-4 control-label" for="form_control_1">业主信息
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <span id="user_info_id"></span>
                                        </div>
                                    </div>

                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input" >
                                            <label class="col-md-4 control-label" for="form_control_1">物业费到期时间
                                            </label>
                                            <div class="col-md-7">
                                                <span id="property_time"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input"  >
                                            <label class="col-md-4 control-label" for="form_control_1">物业服务费单价
                                            </label>
                                            <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                <label id="property_unit"></label>元每平方米每月
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carspace" style="display: none;">
                                        <div class="form-group form-md-line-input"  >
                                            <label class="col-md-4 control-label" for="form_control_1">包月泊位费单价
                                            </label>
                                            <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                <label id="carspace_price"></label>元每月
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="clear:both"></div>

                            </div>

                            <!--<div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="button" id="handInput" class="btn green">确认提交</button>
                                    </div>
                                </div>
                            </div>-->
                        </div>

                        <div class="alert alert-danger" style="display: none">
                            <strong>错误！</strong><span></span></div>

                        <div class="alert alert-success" style="display: none">
                            <strong>成功！</strong><span></span></div>

                        <div  class="input-mouth" style="display:none;">

                            <div class="input-group input-large date-picker input-daterange" style="left:100px">
                                <input type="text" class="form-control" name="start_mouth" id="time_from" >
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="end_mouth" id="time_to" >
                            </div>


                            <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
                            <!--获取日期时间插件 -->
                            <script type="text/javascript">
                                $.datetimepicker.setLocale('ch');
                                $('#time_from').datetimepicker({
                                    format: 'Y-m-d',
                                    lang:"zh",
                                    timepicker:false
                                });
                                $('#time_to').datetimepicker({
                                    format: 'Y-m-d',
                                    lang:"zh",
                                    timepicker:false
                                });
                            </script>
                        </div>
                        <input type="hidden" name="start_time">
                        <input type="hidden" name="end_time">
                    </form>

                    <div class="form-group form-md-line-input show_detail" style="display: none; height:30px;">
                        <div style="width:200px;margin-left:100px">
                            <a href="#" id="show_detailed" target="_blank">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    <i class="fa fa-plus"></i>
                                    查看明细
                                </button>
                            </a>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn green"  id="handInput">确认提交</button>
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                </div>
            </div>
        </div>


    </div>
    <div id="form_modal3" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">小区项目统计数据</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="company_list_count" style="margin-top:25px;">
                        <tr>
                            <td align="center"></td>
                            <td align="center">合计</td>
                            <?php if(is_array($sum['data'])): foreach($sum['data'] as $k=>$v): ?><td align="center">
                                    <?php echo ($v["name"]); ?>
                                </td><?php endforeach; endif; ?>
                        </tr>
                        <tr>
                            <td align="center">房间数</td>
                            <td align="center"><?php echo ($sum['sum']['room']); ?></td>
                            <?php if(is_array($sum['data'])): foreach($sum['data'] as $k=>$v): ?><td align="center">
                                    <?php echo ($v["room"]); ?>
                                </td><?php endforeach; endif; ?>
                        </tr>
                        <tr>
                            <td align="center">空置数</td>
                            <td align="center"><span class="text-danger" ><?php echo ($sum['sum']['empty']); ?></span></td>
                            <?php if(is_array($sum['data'])): foreach($sum['data'] as $k=>$v): ?><td align="center ">
                                    <span class="text-danger" ><?php echo ($v["empty"]); ?></span>
                                </td><?php endforeach; endif; ?>
                        </tr>
                        <tr>
                            <td align="center">预交数</td>
                            <td align="center"><span class="text-success" ><?php echo ($sum['sum']['prepay']); ?></span></td>
                            <?php if(is_array($sum['data'])): foreach($sum['data'] as $k=>$v): ?><td align="center ">
                                    <span class="text-success" ><?php echo ($v["prepay"]); ?></span>
                                </td><?php endforeach; endif; ?>
                        </tr>
                        <tr>
                            <td align="center">欠费数</td>
                            <td align="center"><span class="text-danger" ><?php echo ($sum['sum']['noprepay']); ?></span></td>
                            <?php if(is_array($sum['data'])): foreach($sum['data'] as $k=>$v): ?><td align="center ">
                                    <span class="text-danger" ><?php echo ($v["noprepay"]); ?></span>
                                </td><?php endforeach; endif; ?>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                </div>
            </div>
        </div>
    </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-group pull-right">
                                            

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- BEGIN CONTENT -->
    <!--<form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <div class="portlet-body">

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">选择期数
                    </label>
                    <div class="col-md-4">
                        <select id="project_id" class="form-control" >
                            <?php if(is_array($project_list)): $i = 0; $__LIST__ = $project_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['pigcms_id']); ?>" <?php if($project_id == $vo['pigcms_id']): ?>selected="selected"<?php endif; ?>>
                                <?php echo ($vo['desc']); ?>
                                </option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">门牌号
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="room_name" value="" name="room_name" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                <div id="room_info" class="form-group form-md-line-input" style="display: block">
                    <label class="col-md-2 control-label" for="form_control_1" >房屋信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <span id="room_info_id"></span>
                    </div>
                </div>
                <div id="user_info" class="form-group form-md-line-input" style="display: block">
                    <label class="col-md-2 control-label" for="form_control_1">业主信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <span id="user_info_id"></span>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费类型
                    </label>
                    <div class="col-md-4">
                        <select name="otherfee_type_id" id="otherfee_type_id" class="form-control">
                            <option value="0">请选择</option>
                            <option value="property">物业服务费</option>
                            <option value="carspace">包月泊位费</option>
                            <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["otherfee_type_id"]); ?>"><?php echo ($vo["otherfee_type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div id="property" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">物业费到期时间
                        </label>
                        <div class="col-md-4">
                            <span id="property_time"></span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <select name="property_mouth" class="form-control" id="property_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <?php $__FOR_START_20407__=1;$__FOR_END_20407__=24;for($i=$__FOR_START_20407__;$i < $__FOR_END_20407__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>个月</option><?php } ?>
                            </select>
                            <span class="required">如果没有设置过物业费到期时间，请先调整到期时间</span>
                        </div>
                    </div>
                    <div id="property_pay" style="display: block;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-4" >
                                <label id="property_unit"></label>元每平方米每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="property_recive" value="" name="property_recive" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="property_true" value="" name="property_true" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carspace" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">选择车位
                        </label>
                        <div class="col-md-4">
                            <select name="carspace_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <select name="carspace_mouth" class="form-control" id="carspace_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <?php $__FOR_START_19872__=1;$__FOR_END_19872__=24;for($i=$__FOR_START_19872__;$i < $__FOR_END_19872__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>个月</option><?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id="carspace_pay" style="display: block;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-4" >
                                <label id="carspace_price"></label>元每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <label id="carspace_recive"></label>元
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="carspace_true" value="" name="carspace_true" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="other_fee" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1" id="fee_receive">应收
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <div class="md-checkbox-list">
                                <input type="text" name="fee_receive" value=""  class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1" id="fee_true">实收
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <div class="md-checkbox-list">
                                <input type="text" name="fee_true" value=""  class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费方式
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <select name="type" class="form-control">
                            <option value="1">线上支付</option>
                            <option value="2">现金</option>
                            <option value="3">转账</option>
                            <option value="4">POS单</option>
                            <option value="5">现金缴款单</option>
                        </select>

                    </div>
                </div>

                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">备注
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4" >
                        <textarea    value="" name="remark" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="button" id="handInput" class="btn green">确认提交</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" style="display: none">
            <strong>错误！</strong><span></span></div>

        <div class="alert alert-success" style="display: none">
            <strong>成功！</strong><span></span></div>
    </form>-->




    <table class="table table-striped table-bordered table-hover" id="sample_2" >
        <thead>
        <tr>
            <th width="2%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="2%">所属期数</th>
            <th width="5%">栋数</th>
            <th width="5%">单元</th>
            <th width="5%">楼层</th>
            <th width="10%">门牌号</th>
            <th width="10%">房屋面积</th>
            <th width="10%">物业费到期时间</th>
            <th width="10%">车位详情</th>
            <!--<th width="15%">业主详情</th>
            <th width="10%">房屋状态(空置结束时间)</th>
            <th class="button-column" width="15%">操作</th>-->
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($roomsArray)): $i = 0; $__LIST__ = $roomsArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="<?php echo ($vo["id"]); ?>" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv"><?php echo ($vo["desc"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["tung_build"]); ?>栋</div></td>
            <td><div class="tagDiv"><?php echo ($vo["tung_unit"]); ?>单元</div></td>
            <td><div class="tagDiv"><?php echo ($vo["tung_floor"]); ?>层</div></td>
            <td><div class="tagDiv"><?php echo ($vo["room_name"]); ?></div></td>
            <td><div class="tagDiv"><?php echo ($vo["roomsize"]); ?></div></td>
            <td>
                <a href="<?php echo U('room_property_uptown',array('id'=>$vo['id']));?>" target="_blank">
                    <div class="tagDiv">
                        <?php if($vo['property_endtime'] and strtotime($vo['property_endtime']) >= time()): echo ($vo["property_endtime"]); ?>
                            <?php elseif($vo['property_endtime'] and strtotime($vo['property_endtime']) < time()): ?>
                            <span class="text-danger"><?php echo ($vo["property_endtime"]); ?>&nbsp;&nbsp;(已欠费)</span><?php endif; ?>
                        <?php if($vo["property_endtime"] == ''): ?><span class="text-danger">尚未设置初始时间</span><?php endif; ?>
                    </div>
                </a>
            </td>
            <td>
                <a href="<?php echo U('room_carspace_uptown',array('id'=>$vo['id']));?>" target="_blank">
                    <div class="tagDiv">
                        <?php if($vo["carspace_number"] != ''): echo ($vo["carspace_number"]); ?><br>
                            <?php echo ($vo["uc"]["carspace_endtime"]); endif; ?>
                        <?php if($vo["carspace_number"] == ''): ?><span class="text-danger">尚未绑定车位</span><?php endif; ?>
                    </div>
                </a>
            </td>
            <!--<td><div class="tagDiv">
                    <?php if($vo['oid_info']['0'] != ''): if(is_array($vo['oid_info'])): $i = 0; $__LIST__ = $vo['oid_info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oid_info): $mod = ($i % 2 );++$i; echo ($oid_info["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($oid_info["phone"]); ?><br><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if($vo['oid_info']['0'] == ''): ?><span class="text-danger">尚未绑定业主</span><?php endif; ?>
                </div></td>
            <td>
                <div class="tagDiv">
                    <?php echo ($vo["house_type"]); ?>
                    <?php if($vo['house_type'] != '空置' and $vo['property_emptytime']): ?>(<?php echo (date("Y-m-d",$vo['property_emptytime'])); ?>)<?php endif; ?>
                </div>
            </td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="<?php echo U('room_update_uptown',array('id'=>$vo['id']));?>" target="_blank">
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                        <li>
                            <a href="<?php echo U('Otherfee/add_otherfee',array('rid'=>$vo['id']));?>" target="_blank">
                                <i class="icon-tag"></i> 添加新的缴费 </a>
                        </li>
                        <li>
                            <a href="<?php echo U('Otherfee/otherfee_list',array('rid'=>$vo['id']));?>" target="_blank">
                                <i class="icon-tag"></i> 查看全部缴费 </a>
                        </li>
                    </ul>
                </div>
            </td>-->
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

                            
                                <!--        弹出层容器-->
                                <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="sub_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1000px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="third_modal">
                                    <div class="modal-dialog modal-lg" role="document" style="width:1000px">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                                <!--        弹出层容器-->
                            
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

        </div>
    </div>
    <!--主体-->
</div>
<!--底部文件-->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">邻钱科技</a>
        <!--      &nbsp;|&nbsp;   <a href="http://www.metronic.com" target="_blank">Metronic</a>-->
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

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<script src="http://www.bootcss.com/p/underscore/underscore-min.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script src="./static/js/ui-buttons.js"></script>

<script type="text/javascript">
    //表格显示控制js代码区
    var table = $('#sample_1');

    // begin first table
    var jstr = '<?php echo ($table_sort); ?>';
    var table_sort;
    if(jstr){
        table_sort = JSON.parse(jstr);
    }else{
        table_sort = [1, "desc"];
    }
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "每页显示条数 _MENU_",
            "search": "搜索:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "全部"] // change per page values here
        ],
        // set the initial value
        "pageLength": parseInt("<?php echo ($table_init_length); ?>")||15,
        "pagingType": "bootstrap_full_number",
        "columnDefs": [
            {  // set default column settings
                'orderable': false,
                'targets': [0]
            },
            {
                "className": "dt-right",
                //"targets": [2]
            }
        ],
        "order": [
            table_sort
        ] // set first column as a default sort by asc
    });

    var tableWrapper = jQuery('#sample_1_wrapper');

    table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

    table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });

</script>
<script>
    /**
     * vue全局注册函数
     */
    //get
    Vue.prototype._get =  function(url,params,callback){
        var opt = {
            'params':params
        }
        this.$http.get(url,opt).then(function(response){
            // 响应成功回调
            if(response.body.err==0){
                callback(response.body);
            }else{
                console.log(response.body);
                alert("发生错误");
            }
        }, function(response){
            alert(response.status+" 发生错误");
        });

    };
    //post
    Vue.prototype._post = function(url,params,callback){
            this.$http.post(url,params).then(function(response){
                // 响应成功回调
                if(response.body.err==0){
                    callback(response.body);
                }else{
                    alert("发生错误:"+response.body.msg);
                }
            }, function(response){
                alert(response.status+" 发生错误");
            });

        };
    //判断是否是数组
    function isArray(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    }
    //补0函数
    function padNumber(num, fill) {
        //改自：http://blog.csdn.net/aimingoo/article/details/4492592
        var len = ('' + num).length;
        return (Array(
            fill > len ? fill - len + 1 || 0 : 0
        ).join(0) + num);
    }
    //改变群发控制状态
    function change_wxmsg(village_id){
        $.ajax({
            url:"<?php echo U('ajax_change_wxmsg');?>",
            type:'post',
            data:{'village_id':village_id},
            dataType:'json',
            async:false,
            success:function(res){

            }
        });
    }
        $("[name='my-checkbox']").bootstrapSwitch({
            onText:"已启动",
            offText:"已关闭",
            onColor:"success",
            offColor:"danger",
            size:"normal",
            handleWidth:'100px',
            labelWidth:'55px',
            state:Boolean(<?php echo ($is_wxmsg); ?>),
            onSwitchChange:function(event,state){
                change_wxmsg('<?php echo ($village_id); ?>');
            }
        });
</script>
<!--自定义js代码区开始-->

<!--/底部文件-->





    <!--引入js-->
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

    <!--引入js-->

    <!--自定义js代码区开始-->
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
    <!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
     -->
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">

    <script>
        $(".search").change(
            function () {
                var search=$('#property_status').children('option:selected').val();
                //console.log(p1);
                $('input[aria-controls="sample_2"]').val(search).keyup();
            }
        );
        function sub_project(){
            var project_id='<?php echo ($project_info['pigcms_id']); ?>';
            var project_name='<?php echo ($project_info['desc']); ?>';
            if(confirm( '你确定批量打印'+project_name+'全部欠费业主催缴单吗？')) {
                var url = "<?php echo U('Property/print_property');?>";
                //用post方式传递
                var ids = '';
                var ym = '';
                openPostWindow(url,ids,ym,project_id);
                // window.location.href = "<?php echo U('PropertyService/hydropower_account_do');?>" + "&ids=" + ids + "&ym=" + ym;
            }
        }
        function sub() {
            var ids = '';
            var ym = $("input[name='choose_time']").val();
            // alert(ym);
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            ids = ids.substring(1);
            if (ids.length == 0) {
                alert('请选择要添加的选项');
            } else {
                if(confirm( '你确定批量打印码？')) {
                    var url = "<?php echo U('Property/print_property');?>";
                    //用post方式传递
                    var project_id='';
                    openPostWindow(url,ids,ym,project_id);
                    // window.location.href = "<?php echo U('PropertyService/hydropower_account_do');?>" + "&ids=" + ids + "&ym=" + ym;
                }
            }
        }

        function openPostWindow(url,idStr,rid,project_id){

            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_blank"; //打开新页面
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="ids"; //后台要接受这个参数来取值
            hideInput1.value = idStr; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name="rid";
            hideInput2.value = rid;
            var hideInput3 = document.createElement("project_id");
            hideInput2.type = "hidden";
            hideInput2.name="project_id";
            hideInput2.value = project_id;
            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            tempForm.submit();
            document.body.removeChild(tempForm);
        }
    </script>
    <script src="/static/js/jquery.bigautocomplete.js"></script>
    <link rel="stylesheet" href="/static/css/jquery.bigautocomplete.css">
    <script type='text/javascript'>
        $("input[name='fee_receive']").bind("keyup",function() {
            console.log($(this).val());
            $("input[name='fee_true']").val($(this).val());
        });
        //开启日历插件
        $("#handInput").click(function(){
            var tip='添加缴费成功！';
            $.ajax({
                url:'<?php echo U("Property/ajax_in_fee");?>',
                type:'post',
                data:$('#form_sample_1').serialize(),
                dataType:'json',
                success:function (res) {
                    $('.property').css('display','none');
                    $('.carspace').css('display','none');
                    $('.other_fee').css('display','none');
                    $("textarea[name='remark']").val('');
                    $("#room_name").val('');
                    $('#otherfee_type_id').val("1");
                    $('#room_info').css('display','none');
                    $('#user_info').css('display','none');
                    if(res.err == 0){
                        $(".input-group input").val('');
                        $(".alert-danger").hide();
                        $(".alert-success span").html(tip);
                        $(".alert-success").slideDown();
                        $("#in_database tr:eq(1)").before(res.data);
                        if(res.msg){
                            $("textarea[name='remark']").html("");
                            swal({
                                    title: "添加缴费成功，是否立即打印收据？",
                                    text: "确认后会前往打印收据页面",
                                    type: "info",
                                    showCancelButton: true,
                                    cancelButtonText: "取消",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "确定",
                                    closeOnConfirm: true
                                },
                                function(){
                                    //console.log(res.msg);
                                    print_receipt(res.msg);
                                });
                        }
                        document.getElementById("form_sample_1").reset();
                        setTimeout(function(){
                            $(".alert-success").slideUp();
                        },5000);
                    }else{
                        $(".alert-success").hide();
                        $(".alert-danger span").html(res.msg);
                        $(".alert-danger").slideDown();

                        setTimeout(function(){
                            $(".alert-danger").slideUp();
                        },5000);

                    }

                }
            });
        });
        function print_receipt(id) {
            var rid = id;
            var ym = $("input[name='choose_time']").val();
            var ids='';
            var project_id='';
            // alert(ym);
            if (rid.length == 0) {
                alert('请选择要添加的选项');
            } else {
                var url = "<?php echo U('Receipt/print_receipt');?>";
                //用post方式传递
                var project_id='';
                openPostWindow(url,ids,rid,project_id);
            }
        }
        $('#otherfee_type_id').change(function(){
            $("input[name='code_start']").val('');
            $("input[name='code_end']").val('');
            $("input[name='unit']").val('');
            $("input[name='fee_receive']").val('');
            $("input[name='fee_true']").val('');
            $("textarea[name='remark']").html('');
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"<?php echo U('Property/ajax_otherfee_type');?>",
                data:{'otherfee_type_id':p1,'room_name':room_name},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.input-mouth').css('display','none');
                    $('.show_detail').css('display','none');
                    if(res.type == 'property'){
                        $('.property').css('display','block');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','none');
                        $('#fee_true_div').css('display','block');
                        $('#property_time').html(res.data.property_endtime);
                    }else if(res.type=='carspace'){
                        $('.property').css('display','none');
                        $('.carspace').css('display','block');
                        $('.other_fee').css('display','none');
                        $('#fee_true_div').css('display','block');
                        $("select[name='carspace_id']").html('');
                        for ( var i = 0; i <res.data.length; i++){
                            $("select[name='carspace_id']").append('<option value="'+res.data[i].pigcms_id+'">'+res.data[i].carspace_number+'\t到期日:'+res.data[i].carspace_endtime);
                        }
                    } else{
                        $('.property').css('display','none');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','block');
                        if(res.info.start_code != null && res.info.fee_receive != 0){
                            $("input[name='code_start']").val(res.info.start_code);
                            $("input[name='code_end']").val(res.info.end_code);
                            $("input[name='unit']").val(res.info.price);
                            $("input[name='fee_receive']").val(res.info.fee_receive);
                            $("input[name='fee_true']").val(res.info.fee_receive);
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit + res.info.fee_receive_code;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }else if(res.info.fee_receive != 0 && res.info.start_code == null){
                            $("input[name='fee_receive']").val(res.info.fee_receive);
                            $("input[name='fee_true']").val(res.info.fee_receive);
                            /*自动计算*/
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit + res.info.fee_receive_code;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }else{
                            /*自动计算*/
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }

                        if(res.data.otherfee_type_name == "水费" || res.data.otherfee_type_name == "电费"){
//                                $('.input-mouth').css('display','block');
                                $('.show_detail').css('display','block');
                                var id = res.rid;
                                $('#show_detailed').attr('href',"<?php echo U('Property/show_detailed',array('id'=>'"+id+"'));?>");

                                if(res.start_time != null){
                                    $str = res.start_time+"至"+res.end_time;
                                    $("textarea[name='remark']").html($str);
                                    $("input[name='start_time']").val(res.start_time);
                                    $("input[name='end_time']").val(res.end_time);
                                    /*$("input[name='remark']").val(res.start_time);
                                    $("#time_to").val(res.end_time);*/
                                }
                                /*$("#sel option").each(function() {
                                    if($(this).val()==res.start_time){
                                        $(this).prop('selected',true);
                                    }else{
                                        $(this).prop('selected',false);
                                    }
                                });

                                $("#sels option").each(function() {
                                    if($(this).val()==res.end_time){
                                        $(this).prop('selected',true);
                                    }else{
                                        $(this).prop('selected',false);
                                    }
                                });*/

                        }
                        if(res.data.type=='1'){
                            $('#fee_receive').html('应收<span class="required">*</span>');
                            $('#fee_true').html('实收<span class="required">*</span>');
                            $('#fee_true_div').css('display','block');
                        }else{
                            $('#fee_receive').html('实收<span class="required">*</span>');
                            $('#fee_true').html('已退<span class="required">*</span>');
                            $('#fee_true_div').css('display','none');
                        }
                    }
                }
            });
        });
        $("#room_name").bigAutocomplete({
                url:'<?php echo U('Property/ajax_room_list');?>',
            callback:function(data){
            $('.property').css('display','none');
            $('.carspace').css('display','none');
            $('.other_fee').css('display','none');
            $('#otherfee_type_id').val("0");
            $('#room_info').css('display','block');
            $('#user_info').css('display','block');
            $('#room_info_id').html('面积:'+data.result.roomsize+',所属园区:'+data.result.desc);
            $('#user_info_id').html('姓名:'+data.result.user_info.name+',电话:'+data.result.user_info.phone+',身份证号:'+data.result.user_info.usernum);
            $.ajax({
                type:"GET",
                url:"<?php echo U('Property/ajax_change');?>",
                data:{'rid':data.result.id},
                async:false
            });
        }
        });
        $("#room_name").keyup(function(){
            $.ajax({
                url:"<?php echo U('Property/ajax_room_list');?>",
                data:{'keyword':$(this).val(),'type':1},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    if(res.data[0].title){
                        $('.property').css('display','none');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','none');
                        $('#otherfee_type_id').val("0");
                        $('#room_info').css('display','block');
                        $('#user_info').css('display','block');
                        $('#room_info_id').html('面积:'+res.data[0].result.roomsize+',所属园区:'+res.data[0].result.desc);
                        $('#user_info_id').html('姓名:'+res.data[0].result.user_info.name+',电话:'+res.data[0].result.user_info.phone+',身份证号:'+res.data[0].result.user_info.usernum);
                        $.ajax({
                            type:"GET",
                            url:"<?php echo U('Property/ajax_change');?>",
                            data:{'rid':data.result.id},
                            async:false
                        });
                    }
                }
            });
        });
        $('#property_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"<?php echo U('Property/ajax_fee_get');?>",
                data:{'month':p1,'room_name':room_name,'type':'property'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.property_pay').css('display','block');
                    $('#property_unit').html(res.unit);
                    $('#property_recive').val(res.pay_recive);
                    $('#property_true').val(res.pay_true);
                }
            });
        });
        $('#carspace_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("select[name='carspace_id']").children('option:selected').val();
            $.ajax({
                url:"<?php echo U('Property/ajax_fee_get');?>",
                data:{'month':p1,'room_name':room_name,'type':'carspace'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.carspace_pay').css('display','block');
                    $('#carspace_price').html(res.unit);
                    $('#carspace_recive').html(res.pay_recive);
                    $('#carspace_true').val(res.pay_true);
                }
            });
        })

        var table = $('#sample_2');
        table.dataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                'processing':'正在努力处理中',
                "emptyTable": "暂时没有数据",
                "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "​每页显示条数 _MENU_",
                "search": "搜索:",
                "zeroRecords": "抱歉，没有查找到指定结果",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            serverSide: true,
            'processing':true,// 加载
            ajax: {
                url: '<?php echo U("ajax_room_list_uptown");?>&room_over_endtime='+sessionStorage.getItem('room_over_endtime')+'&room_house_type='+sessionStorage.getItem('room_house_type')+'&room_type='+sessionStorage.getItem('room_type'),
                type: 'POST'
            },
            ordering:  false,
            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "​全部"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': [0]
                },
                //去除限制第一列查询
                /*{
                 "searchable": false,
                 "targets": [0]
                 },*/
                {
                    "className": "dt-right",
                    //"targets": [2]
                }
            ],
            //"aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
                {
                    "mDataProp" : "check_id",
                    "sTitle" : "<input type='checkbox'  name='allbox' id='allbox' onclick='check();' />",
                    "sDefaultContent" : "",
                    "bSortable" : false,
                    "sClass" : "center"
                },
                {
                    "sTitle" : "房间号",
                    "mDataProp": "room_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "业主姓名",
                    "mDataProp": "owner_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "联系电话",
                    "mDataProp": "owner_phone",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "房屋面积",
                    "mDataProp": "roomsize",
                    "sDefaultContent" : "<span class='active_value'>未绑定</span>",
                    "sClass" : "center nickname"
                },
                {
                    "sTitle" : "物业费到期时间",
                    "mDataProp": "property",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center active_value"
                },
                {
                    "sTitle" : "房屋状态(空置结束时间)",
                    "mDataProp": "house_type",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "车位详情",
                    "mDataProp": "carspace",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "操作",
                    "mDataProp": "action",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                }
                /*{
                 "sTitle" : "Update Time",
                 "mDataProp": "updateTime",
                 "sDefaultContent" : "",
                 "sClass" : "center",
                 "mRender" : function(data, display, row) {  //将从数据库中查到的时间戳格式化
                 return new Date(data).Format("yyyy-MM-dd hh:mm:ss");
                 }

                 },*/
            ]
        });
        $("#sample_1_filter input[type=search]").removeClass("input-small");
        $("#sample_1_filter input[type=search]").css({ width: '400px' });
        $("#sample_1_filter input[type=search]").attr("placeholder","请输入房间号、业主姓名、手机查询");
        function search_change(key,value){
            sessionStorage.setItem(key,value);
            var url='<?php echo U("ajax_room_list_uptown");?>&room_over_endtime='+sessionStorage.getItem('room_over_endtime')+'&room_house_type='+sessionStorage.getItem('room_house_type')+'&room_type='+sessionStorage.getItem('room_type');
            table.api().ajax.url(url).load();
        }
        if(sessionStorage.getItem('room_over_endtime'))$('#room_over_endtime').val(sessionStorage.getItem('room_over_endtime'));
        if(sessionStorage.getItem('room_house_type'))$('#room_house_type').val(sessionStorage.getItem('room_house_type'));
        if(sessionStorage.getItem('room_type'))$('#room_type').val(sessionStorage.getItem('room_type'));

        //选择月份
        $(".show_mouth").change(function(){
            var v1 = $(".show_mouth1").val();
            var v2 = $(".show_mouth2").val();
            var room_name=$("input[name='room_name']").val();
            var p1=$("#otherfee_type_id").children('option:selected').val();
            $.ajax({
                url:"<?php echo U('Property/ajax_mouth_get');?>",
                data:{'start_mouth':v1,'end_mouth':v2,'room_name':room_name,'otherfee_type_id':p1},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $("input[name='code_start']").val(res.info.start_code);
                    $("input[name='code_end']").val(res.info.end_code);
                    $("input[name='unit']").val(res.info.price);
                    $("input[name='fee_receive']").val(res.info.fee_receive);
                    $("input[name='fee_true']").val(res.info.fee_receive);
                }
            });
        });
    </script>



<!--自定义js代码区结束-->
</body>

</html>