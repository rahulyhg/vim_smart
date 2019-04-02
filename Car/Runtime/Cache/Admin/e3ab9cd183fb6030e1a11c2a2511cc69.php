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


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

            <!-- BEGIN CONTENT -->
            <style type="text/css">
<!--
.dropdown-menu {margin: 0 0 0 -110px;}
-->
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.dropdown-menu {
    margin: 0 0 0 -109px;
	position:absolute;
}
.row {
    margin-left: 0px;
    margin-right: 0px;
}
.table {
    width: 100%;
    margin-bottom: 40px;
}
</style><div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>车辆信息列表
                                <small>出入停车场的车辆信息会记录在此，在此你可以查看车辆的出入时间，车牌号，缴费信息等状态</small>
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
                            <span class="active">车辆信息列表</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <!--<div class="m-heading-1 border-green m-bordered">-->
                        <!--<h3>使用提示</h3>-->
                        <!--<p>本页面的数据主要作为阅读和查询，谨慎使用删除操作</p>-->
                        <!--<p> 不遵守提示使用者，数据无价，后果自负！-->
                            <!--<a class="btn red btn-outline" href="http://datatables.net/" target="_blank">点此查看使用操作或联系技术人员服务</a>-->
                        <!--</p>-->
                    <!--</div>-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> 车辆信息列表</span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active" onclick="window.location.href='<?php echo U('recycle');?>'">
                                                <input type="radio" name="options" class="toggle" id="option1">列 表</label>
                                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                                <input type="radio" name="options" class="toggle" id="option2">回收站</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <a href="<?php echo U('add');?>">
                                                        <button id="sample_editable_1_new" class="btn sbold green"> 手动添加记录
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <label> &nbsp;每页显示条数
                                                    <select id="list_rows" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-offset-3">
                                                <!--搜索区域 START-->
                                                <form id="frm" action="<?php echo (ROOT_URL); echo U('');?>">
                                                    <div class="btn-group pull-right">
                                                        <input type="hidden" name="m" value="Admin">
                                                        <input type="hidden" name="c" value="Car">
                                                        <input type="hidden" name="a" value="showlist">
                                                        <input type="hidden" name="list_rows" value="<?php echo I('get.list_rows',10,'int');?>">
                                                        <input type="hidden" name="garage_id" value="<?php echo ($garage_id); ?>">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="输入车主姓名或车牌号码" value="<?php echo I('get.keywords','','htmlspecialchars');?>" name="keywords">
                                                            <div class="input-group-btn">

                                                                <button type="submit" class="btn btn-default">搜索</button>
                                                                <!--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                                                <!--<span class="caret"></span>-->
                                                                <!--<span class="sr-only">Toggle Dropdown</span>-->
                                                                <!--</button>-->
                                                                <!--<ul class="dropdown-menu dropdown-menu-right"  style="margin-left:-33rem;width:40rem">-->
                                                                <!--<li style="padding:8px 16px" data-stopPropagation="true">-->
                                                                <!---->
                                                                <!--</li>-->
                                                                <!--</ul>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!--搜索区域 END-->
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_12">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th> 记录id </th>
                                                <th> 车牌号 </th>
                                                <th> 车辆主人 </th>
                                                <th> 登记时间 </th>
                                                <th> 临时/月卡 </th>
                                                <th> 剩余天数/次数 </th>
                                                <th> 停车场名称 </th>
                                                <th> 查看详情 </th>
                                                <th> 操作 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($list)): foreach($list as $key=>$row): ?><tr class="odd gradeX">
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="checkboxes" value="1" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td> <?php echo ($row["car_id"]); ?> </td>
                                                    <td>
                                                        <a target="_blank" href="<?php echo U('Admin/Car/car_user',array('car_id'=>$row['car_id']));?>"><?php echo ($row["car_no"]); ?></a>
                                                    </td>
                                                    <td class="center">
                                                        <a target="_blank" href="<?php echo U('Admin/User/detail',array('uid'=>$row['user_id']));?>"><?php echo ($row["user_name"]); ?></a>
                                                    </td>
                                                    <td class="center"><?php echo (date("Y-m-d H:i:s",$row["add_time"])); ?></td>
                                                    <td class="center">
                                                        <?php switch($row['car_role']): case "0": ?>临时车<?php break;?>
                                                            <?php case "1": ?>月卡车<?php break;?>
                                                            <?php case "2": ?>内部车<?php break; endswitch;?>
                                                    </td>
                                                    <td class="center">
                                                        <?php switch($row['car_role']): case "0": ?>暂无<?php break;?>
                                                            <?php case "1": echo ($row["days_remaining"]); ?> 天<?php break;?>
                                                            <?php case "2": echo ($row["number"]); ?> 次<?php break; endswitch;?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo ($row["garage_name"]); ?>
                                                    </td>
                                                    <td class="center">
                                                        <a href="<?php echo U('detail',array('car_id'=>$row['car_id']));?>">点击查看</a>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 编辑
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                                <li>
                                                                    <a href="<?php echo U('update',array('car_id'=>$row['car_id']));?>">
                                                                        <i class="icon-docs"></i> 更新 </a>
                                                                </li>
                                                                <li onclick="delete_car_info(this)" id="<?php echo ($row["car_id"]); ?>">
                                                                    <a href="javascript:;">
                                                                        <i class="icon-tag"></i> 删除 </a>
                                                                </li>
                                                                <li class="divider"> </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                        <i class="icon-flag"></i> Comments
                                                                        <span class="badge badge-success">4</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr><?php endforeach; endif; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr><td colspan="10"><?php echo ($pageStr); ?></td></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
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
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!--<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <!--插入layer弹层js开始-->
        <script src="<?php echo (C("ADMIN_JS_URL")); ?>layer.js" type="text/javascript"></script>
        <!--插入layer弹层js结束-->


        <!--自定义js代码区开始-->
        <script type="text/javascript">
            $(document).ready(function(){
                //分页页码条数切换
                var list_rows = "<?php echo I('get.list_rows');?>";
                $('#list_rows option[value="'+list_rows+'"]').attr("selected","selected");
                $('#list_rows').change(function(){

                    var new_list_rows = $(this).val();
                    var url = "<?php echo get_url();?>"
                    //先删除原有的list_rows
                    url = url.replace(/&list_rows=\d*/i,"");
                    url = url.replace(/\/list_rows\/\d*/i,"");
                    //搜索表单添加list_rows参数
                    window.location.href=url + '&list_rows=' + new_list_rows;

                });
            });



            //获取将要删除的记录对应的id
            function delete_car_info(obj){
                layer.msg('你确定要删除么？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        var car_id=$(obj).attr('id');
                        //通过ajax异步删除
                        $.ajax({
                            url:"<?php echo U('delete');?>",
                            data:{'car_id':car_id},
                            dataType:'json',
                            type:'get',
                            success:function(delmsg){
                                if(delmsg==='1'){
                                    //逻辑删除成功！
                                    layer.msg('删除成功！', {icon: 6});
                                    //同时刷新页面
                                    window.location.reload();
                                }else{
                                    //逻辑删除失败！
                                    layer.msg('删除失败！', {icon: 5});
                                }
                            }

                        });
                    }
                });

            }


            //表格显示控制js代码区
            var table = $('#sample_1');

            // begin first table
            table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "暂时没有数据",
					"info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
					"infoEmpty": "没有找到记录",
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

                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "全部"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,
                "pagingType": "bootstrap_full_number",
                "columnDefs": [
                    {  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    },
                    {
                        "searchable": false,
                        "targets": [0]
                    },
                    {
                        "className": "dt-right",
                        //"targets": [2]
                    }
                ],
                "order": [
                    [1, "desc"]
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

        <!--自定义js代码区结束-->
    </body>

</html>