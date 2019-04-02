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


    <!-- BEGIN PAGE LEVEL PLUGINS -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />
<link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/css/error.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/echarts.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<style type="text/css">
<!--
.kd {width:90%; margin:0px auto; height:120px; overflow:hidden;}
.wz {width:96%; height:40px; overflow:hidden; line-height:40px; text-align:right; font-family:"微软雅黑"; font-size:20px; color:#f4f4f4; font-weight:bold;}
.wz2 {width:100%; margin:0px auto; padding-top:8px;}
.wz3 {width:29%; height:56px; overflow:hidden; float:left; border:2px #FFFFFF solid; border-radius:4px; margin-left:2%; margin-right:2%;}
.wz4 {width:100%; height:30px; overflow:hidden; text-align:center; line-height:30px; color:#FFFFFF;}
.wz5 {width:100%; height:24px; overflow:hidden; text-align:center; line-height:18px; color:#FFFFFF;}

.js {padding-top:22px; width:100%;}
.js2 {width:30%; float:left;}
.js3 {width:68%; float:right;}
.js4 {width:100%; height:80px; overflow:hidden; border:2px #FFFFFF solid; border-radius:4px;}
.js5 {width:100%; height:42px; overflow:hidden; text-align:center; line-height:52px; color:#FFFFFF;}
.js6 {width:100%; height:24px; overflow:hidden; text-align:center; line-height:18px; color:#FFFFFF;}

.cw {width:100%; height:30px; overflow:hidden; line-height:22px; text-align:right; color:#FFFFFF; font-family:"微软雅黑"; font-size:16px; font-weight:bold; padding-right:2%;}
.cw2 {width:29%; height:50px; overflow:hidden; border:2px #FFFFFF solid; border-radius:4px; float:left; margin-left:2%; margin-right:2%;}
.cw3 {width:100%; height:22px; overflow:hidden; text-align:center; line-height:22px; color:#FFFFFF; font-size:10px;}
.cw4 {width:100%; height:20px; overflow:hidden; text-align:center; line-height:18px; color:#FFFFFF; font-size:10px;}

.wjmm:link{color:#ffffff; text-decoration:none;}
.wjmm:visited{color:#ffffff; text-decoration:none;}
.wjmm:active{color:#ffffff; text-decoration:none;}
.wjmm:hover{color:#ffffff; text-decoration:none;}
.duty_time:link{color:#ffffff; text-decoration:none;}
.duty_time:visited{color:#ffffff; text-decoration:none;}
.duty_time:active{color:#ffffff; text-decoration:none;}
.duty_time:hover{color:#ffffff; text-decoration:none;}
/*#href_all_income{background-color: #e7505a;}*/
/*#href_true_all_income{background-color: #32C5D2;}*/
-->
</style><div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">

                <h1>
                    <?php if(($s_garage_id == 0) OR ($s_garage_id == '2,4')): if($garage_id == 4 ): ?>钰龙时代中心停车场
                            <?php elseif($garage_id == 2 ): ?>广发银行大厦停车场<?php endif; ?>
                    <?php elseif($s_garage_id == 4 ): ?>
                        钰龙时代中心停车场
                        <?php elseif($s_garage_id == 2 ): ?>
                            广发银行大厦停车场<?php endif; ?>
                    <small>由邻钱科技自主研发的智慧停车管理系统</small>
                </h1>
            </div>
            <!--<div class="col-md-6" <?php if(($s_garage_id != 0) AND ($s_garage_id != '2,4')): ?>style="display:none;"<?php endif; ?>>-->
                <!--<div class="btn-group ">-->
                    <!--<button type="button" class="btn btn-default">当前：<?php if($garage_id == 4 ): ?>钰龙时代中心停车场<?php else: ?>广发银行大厦停车场<?php endif; ?></button>-->
                    <!--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">-->
                        <!--<i class="fa fa-angle-down"></i>-->
                    <!--</button>-->
                    <!--<ul class="dropdown-menu" role="menu">-->
                        <!--<?php if(is_array($garageArray)): foreach($garageArray as $key=>$vo): ?>-->
                            <!--<li>-->
                                <!--<a href="<?php echo U('',array('garage_id'=>$vo['garage_id']));?>"> <?php echo ($vo["garage_name"]); ?> </a>-->
                            <!--</li>-->
                        <!--<?php endforeach; endif; ?>-->
                    <!--</ul>-->
                <!--</div>-->
            <!--</div>-->
            <div class="page-toolbar">
                <div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </div>
                <div class="btn-group btn-theme-panel">
                </div>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo (C("WEB_DOMAIN")); ?>/index.php?s=/Admin/Index/index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">首页</span>
            </li>
        </ul>
        <?php if($_SESSION['admin_name']!= 'admin' AND $_SESSION['show_state']== ''): ?><div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-green"> 404 </div>
                <div class="details">
                    <h3>抱歉！您可能无权访问该页面</h3>
                    <p> 如果您需要访问该页面，请您联系系统管理员:
                        <br/>
                        <a href="TEL:027-87779655"> 027-87779655 </a> 拨打电话寻求帮助 </p>
                </div>
            </div>
        </div><?php endif; ?>
        <?php if($_SESSION['admin_name']== 'admin' OR $_SESSION['show_state']== 1): ?><!--<div class="row">-->
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 blue" href="/Car/index.php?s=/Admin/Payrecord/showlist">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-comments"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" data-value="<?php echo ($count_data["all_income"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc"> 交易总金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 red" href="/Car/index.php?s=/Admin/Payrecord/showlist">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-bar-chart-o"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" data-value="<?php echo ($count_data["all_true_income"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc"> 实际收入总金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 green" href="/Car/index.php?s=/Admin/Payrecord/showlist">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-shopping-cart"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" data-value="<?php echo ($count_data["all_cp_hilt"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc"> 全部优惠金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 blue" href="/Car/index.php?s=/Admin/Payrecord/showlist">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-comments"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--<span data-counter="counterup" data-value="<?php echo ($count_data["out_in_count"]); ?>">0</span>笔-->
                        <!--</div>-->
                        <!--<div class="desc"> 车辆出入场次</div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->
        <!--</div>-->

        <div class="row">
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 yellow" href="/Car/index.php?s=/Admin/Payrecord/showlist&startDate=<?php echo ($befeleven); ?>&endDate=<?php echo ($afteleven); ?>">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-comments"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" data-value="<?php echo ($count_data["check_income"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc"> 昨日对账金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green wjmm" id="href_all_income" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-comments"></i>-->
                    <!--</div>-->
                    <div class="kd">
                        <div class="wz">￥<span style="font-family:Arial; font-size:25px; font-weight:bold;" data-counter="counterup" class="today_all_income_all" data-value="<?php echo ($count_data["today_all_income"]["all"]); ?>">0</span> | <span id="all_income" style="font-size:16px;">今天交易金额</span></div>
                        <div class="wz2">
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:Arial; font-size:18px; font-weight:bold;" data-counter="counterup" class="today_all_income_online" data-value="<?php echo ($count_data["today_all_income"]["online"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">在线支付</span></div>
                            </div>
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:'Arial'; font-size:18px; font-weight:bold;" data-counter="counterup" class="today_all_income_scan" data-value="<?php echo ($count_data["today_all_income"]["scan"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">扫码支付</span></div>
                            </div>
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:'Arial'; font-size:18px; font-weight:bold;" data-counter="counterup" class="today_all_income_cash" data-value="<?php echo ($count_data["today_all_income"]["cash"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">现金缴费</span></div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </a>
            </div>


            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 green" id="href_all_income" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-shopping-cart"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" class="today_all_income" data-value="<?php echo ($count_data["today_all_income"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc" id="all_income"> 今天交易金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->


            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green wjmm" id="href_true_all_income" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-comments"></i>-->
                    <!--</div>-->
                    <div class="kd">
                        <div class="wz">￥<span style="font-family:Arial; font-size:25px; font-weight:bold;" data-counter="counterup" class="today_true_all_income_all" data-value="<?php echo ($count_data["today_all_income"]["all"]); ?>">0</span>  | <span id="true_all_income" style="font-size:16px;">今天实际收入金额</span></div>
                        <div class="wz2">
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:Arial; font-size:16px; font-weight:bold;" data-counter="counterup" class="today_true_all_income_online" data-value="<?php echo ($count_data["today_all_income"]["online"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">在线支付</span></div>
                            </div>
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:'Arial'; font-size:16px; font-weight:bold;" data-counter="counterup" class="today_true_all_income_scan" data-value="<?php echo ($count_data["today_all_income"]["scan"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">扫码支付</span></div>
                            </div>
                            <div class="wz3">
                                <div class="wz4">￥<span style="font-family:'Arial'; font-size:16px; font-weight:bold;" data-counter="counterup" class="today_true_all_income_cash" data-value="<?php echo ($count_data["today_all_income"]["cash"]); ?>">0</span></div>
                                <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">现金缴费</span></div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
                <!--<a class="dashboard-stat dashboard-stat-v2 purple" id="href_true_all_income" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">-->
                    <!--<div class="visual">-->
                        <!--<i class="fa fa-globe"></i>-->
                    <!--</div>-->
                    <!--<div class="details">-->
                        <!--<div class="number">-->
                            <!--¥<span data-counter="counterup" class="today_true_all_income" data-value="<?php echo ($count_data["today_true_all_income"]); ?>">0</span>-->
                        <!--</div>-->
                        <!--<div class="desc" id="true_all_income"> 今天实际收入金额 </div>-->
                    <!--</div>-->
                <!--</a>-->
            <!--</div>-->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" id="href_all_cp_hilt" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            ¥<span data-counter="counterup" class="today_all_cp_hilt" data-value="<?php echo ($count_data["today_all_cp_hilt"]); ?>">0</span>
                        </div>
                        <div class="desc" id="all_cp_hilt"> 今天优惠金额 </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" id="href_out_in_count" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($time1); ?>/endDate/<?php echo ($time2); ?>/garage_id/<?php echo ($garage_id); ?>">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" class="out_in_count" data-value="<?php echo ($count_data["out_in_count"]); ?>">0</span>笔
                        </div>
                        <div class="desc" id="out_in_count"> 今天车辆出入场次</div>
                    </div>
                </a>
            </div>
        </div><?php endif; ?>
        <?php if($_SESSION['admin_name']== 'admin' OR $_SESSION['show_state']== 2): ?><div class="row">
            <?php if(is_array($count_data['duty'])): $k = 0; $__LIST__ = $count_data['duty'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                    <a class="dashboard-stat dashboard-stat-v2 red duty_time"  href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($v["start_time"]); ?>/endDate/<?php echo ($v["end_time"]); ?>/garage_id/<?php echo ($garage_id); ?>">
                        <!--<div class="visual">-->
                            <!--<i class="fa fa-comments"></i>-->
                        <!--</div>-->
                        <!--<div class="details">-->
                            <!--<div class="number">-->
                                <!--¥<span data-counter="counterup" class="duty_income" data-value="<?php echo ($v["duty_income"]); ?>">0</span>-->
                            <!--</div>-->
                            <!--<div class="desc"><?php echo (date("H:i",$v["start_time"])); ?>-<?php echo (date("H:i",$v["end_time"])); ?></div>-->
                            <!--<div class="desc"><?php echo ($v["desc"]); ?></div>-->
                        <!--</div>-->

                        <div class="kd">
                            <div class="wz">￥<span style="font-family:Arial; font-size:25px; font-weight:bold;" data-counter="counterup" class="zhenkeng_a_<?php echo ($k-1); ?>" data-value="<?php echo ($v["duty_incomeArr"]["all"]); ?>">0</span>  |  <span id="" style="font-size:16px;"> <?php echo (date("H:i",$v["start_time"])); ?>-<?php echo (date("H:i",$v["end_time"])); ?> <?php echo ($v["desc"]); ?></span></div>
                            <div class="wz2">
                                <div class="wz3">
                                    <div class="wz4">￥<span style="font-family:Arial; font-size:16px; font-weight:bold;" data-counter="counterup" class="zhenkeng_b_<?php echo ($k-1); ?>" data-value="<?php echo ($v["duty_incomeArr"]["online"]); ?>">0</span></div>
                                    <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">在线支付</span></div>
                                </div>
                                <div class="wz3">
                                    <div class="wz4">￥<span style="font-family:'Arial'; font-size:16px; font-weight:bold;" data-counter="counterup" class="zhenkeng_c_<?php echo ($k-1); ?>" data-value="<?php echo ($v["duty_incomeArr"]["scan"]); ?>">0</span></div>
                                    <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">扫码支付</span></div>
                                </div>
                                <div class="wz3">
                                    <div class="wz4">￥<span style="font-family:'Arial'; font-size:16px; font-weight:bold;" data-counter="counterup" class="zhenkeng_d_<?php echo ($k-1); ?>" data-value="<?php echo ($v["duty_incomeArr"]["cash"]); ?>">0</span></div>
                                    <div class="wz5"><span style="font-family:'微软雅黑'; font-size:14px;">现金缴费</span></div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </a>

                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 yellow" id="href_out_today_count" href="/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/<?php echo ($befeleven); ?>/endDate/<?php echo ($afteleven); ?>/garage_id/<?php echo ($garage_id); ?>">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" class="" data-value="<?php echo ($count_data["check_income"]); ?>">0</span>元
                        </div>
                        <div class="desc" id="out_today_count"> 昨日对账金额</div>
                    </div>
                </a>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" id="href_all_cp_hilt" href="/Car/index.php?s=/Admin/User/showlist/garage_id/<?php echo ($garage_id); ?>">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" class="" data-value="<?php echo ($count_data["user_count"]); ?>">0</span>人
                            </div>
                            <div class="desc" id="all_cp_hilt"> 注册用户数 </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" id="href_all_cp_hilt" href="/Car/index.php?s=/Admin/Car/showlist/garage_id/<?php echo ($garage_id); ?>">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" class="" data-value="<?php echo ($count_data["car_count"]); ?>">0</span>辆
                            </div>
                            <div class="desc" id="all_cp_hilt"> 绑定车辆数 </div>
                        </div>
                    </a>
                </div>
				
            </div><?php endif; ?>

        

        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <?php if($_SESSION['admin_name']== 'admin' OR $_SESSION['show_state']== 1): ?><div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12" id="day">
                <!-- BEGIN PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">当天实际收入/交易笔数</span>
                            <span class="caption-helper">日期递增</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn red btn-outline btn-circle btn-sm active">
                                    <input type="radio" name="options" class="toggle" id="option1">当前七天</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="site_statistics_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="site_statistics_content" class="display-none">
                            <div id="site_statistics" class="chart" style="background-color: #ffffff">
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/plugins/responsive/responsive.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/plugins/responsive/responsive.min.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
                                <script>
                                    var url = "/Car/index.php?s=/Admin/Index/dayTox_true";
                                    $(function(){
                                        $.post(url,function(rs){
                                            //url是后台controller的方法的路径
                                            //data 是传到后台的json格式的参数，可选
                                            //rs是返回的数据

                                        },"json");
                                    });
                                    var chartsDate =<?php echo ($table_json_array); ?>;
                                    var chart = AmCharts.makeChart( "site_statistics", {
                                        "type": "serial",
                                        "theme":"light",
                                        "dataProvider": chartsDate,
                                        "categoryField": "date",
                                        "categoryAxis": {
                                            "autoGridCount": false,
                                            "gridCount": chartsDate.length,
                                            "gridPosition": "start",
                                            "gridAlpha": 0,
                                            "categoryAxisColor":"#123456"
                                        },
                                        "gridAboveGraphs": true,
                                        "startDuration": 1,

                                        "valueAxes": [{
                                            "id":"true_income",
                                            "axisAlpha": 0,
                                            "position": "left",
                                            "title": "金额(元)"
                                        }, {
                                            "id":"count",
                                            "axisAlpha": 0,
                                            "position": "right",
                                            "title": "交易数(笔)"
                                        }],
                                        "graphs": [{
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor": "#00BB00",
                                            "lineColor":"#00BB00",
                                            "balloonText": "<span style='font-size:18px;'>当天交易笔数：[[value]]笔</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "red line",
                                            "fillAlphas": 0.2,
                                            "valueField": "count",
                                            "valueAxis": "count",
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                        }, {
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor":"#00ffff",
                                            "lineColor":"#FBC5C5",
                                            "balloonText": "<span style='font-size:18px;'>当日应收款：[[value]]元</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "duration",
                                            "fillAlphas": 0.7,
                                            "valueField": "true_income",
                                            "valueAxis": "true_income"
                                        }],
                                        "responsive": {
                                            "enabled": true,
                                            "addDefaultRules": false,
                                            "rules": [
                                                {
                                                    "maxWidth": 400,
                                                    "overrides": {
                                                        "legend": {
                                                            "enabled": false
                                                        }
                                                    }
                                                }
                                            ]
                                        },

                                        "chartCursor": {
                                            "valueLineEnabled": true,
                                            "valueLineBalloonEnabled": true,
                                            "cursorAlpha": 0,
                                            "zoomable": false,
                                            "valueZoomable": true,
                                            "valueLineAlpha": 0.5
                                        },
                                        "responsive":{
                                            "enabled":true
                                        },
                                        "export": {
                                            "enabled": true
                                        },
                                        "autoGridCount": false,
                                        "axisColor": "#555555",
                                        "gridAlpha": 0.1,
                                        "gridColor": "#FFFFFF",

                                    } );

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>

            <div class="col-lg-6 col-xs-12 col-sm-12" id="month_s">
                <!-- BEGIN PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">近半年实际收入/交易笔数</span>
                            <span class="caption-helper">日期递增</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn red btn-outline btn-circle btn-sm active">
                                    <input type="radio" name="options" class="toggle" id="option1">近半年</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="months_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="months_content" class="display-none">
                            <div id="months" class="chart" style="background-color: #ffffff">
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/plugins/responsive/responsive.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/plugins/responsive/responsive.min.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
                                <script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
                                <script>
                                    var url = "/Car/index.php?s=/Admin/Index/dayTox_true";
                                    $(function(){
                                        $.post(url,function(rs){
                                            //url是后台controller的方法的路径
                                            //data 是传到后台的json格式的参数，可选
                                            //rs是返回的数据

                                        },"json");
                                    });
                                    var chartsDate =<?php echo ($month_statics); ?>;
                                    var chart = AmCharts.makeChart( "months", {
                                        "type": "serial",
                                        "theme":"light",
                                        "dataProvider": chartsDate,
                                        "categoryField": "date",
                                        "categoryAxis": {
                                            "autoGridCount": false,
                                            "gridCount": chartsDate.length,
                                            "gridPosition": "start",
                                            "gridAlpha": 0,
                                            "categoryAxisColor":"#123456"
                                        },
                                        "gridAboveGraphs": true,
                                        "startDuration": 1,

                                        "valueAxes": [{
                                            "id":"income",
                                            "axisAlpha": 0,
                                            "position": "left",
                                            "title": "金额(元)"
                                        }, {
                                            "id":"count",
                                            "axisAlpha": 0,
                                            "position": "right",
                                            "title": "交易数(笔)"
                                        }],
                                        "graphs": [{
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor": "#00BB00",
                                            "lineColor":"#00BB00",
                                            "balloonText": "<span style='font-size:18px;'>本月交易笔数：[[value]]笔</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "red line",
                                            "fillAlphas": 0.2,
                                            "valueField": "count",
                                            "valueAxis": "count",
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                        }, {
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor":"#00ffff",
                                            "lineColor":"#FBC5C5",
                                            "balloonText": "<span style='font-size:18px;'>本月应收款：[[value]]元</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "duration",
                                            "fillAlphas": 0.7,
                                            "valueField": "income",
                                            "valueAxis": "income"
                                        }],
                                        "responsive": {
                                            "enabled": true,
                                            "addDefaultRules": false,
                                            "rules": [
                                                {
                                                    "maxWidth": 400,
                                                    "overrides": {
                                                        "legend": {
                                                            "enabled": false
                                                        }
                                                    }
                                                }
                                            ]
                                        },

                                        "chartCursor": {
                                            "valueLineEnabled": true,
                                            "valueLineBalloonEnabled": true,
                                            "cursorAlpha": 0,
                                            "zoomable": false,
                                            "valueZoomable": true,
                                            "valueLineAlpha": 0.5
                                        },
                                        "responsive":{
                                            "enabled":true
                                        },
                                        "export": {
                                            "enabled": true
                                        },
                                        "autoGridCount": false,
                                        "axisColor": "#555555",
                                        "gridAlpha": 0.1,
                                        "gridColor": "#FFFFFF",

                                    } );

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12" id="count">
                <!-- BEGIN PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">月活跃缴费人数/车辆数</span>
                            <span class="caption-helper">日期递增...</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn red btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option1" value="1">去年</label>
                                <label class="btn red btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2" value="2">今年</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="site_activities_loading">
                            <img src="/Car/Admin/Public/assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="site_activities_content" class="display-none">
                        </div>

                        <div id="site_activities" class="chart">

                            <script>
                                $('#count .btn-sm').click(function(){
                                    var v=$(this).children().val();
                                    var garage_id = "<?php echo ($_GET['garage_id']); ?>";
                                    $.ajax({
                                        url:"<?php echo U('Index/positive_year_add_arr');?>",
                                        data:{'v':v,'garage_id':garage_id},
                                        type:'post',
                                        dataType:'json',
                                        success:function (res) {
                                            console.log(res.msg);
                                            var chartData =res.msg;
                                            var chart = AmCharts.makeChart("site_activities", {
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
                                                "gridAboveGraphs": true,
                                                "startDuration": 1,
                                                "valueAxes": [{
                                                    "id":"income",
                                                    "axisAlpha": 0,
                                                    "position": "left",
                                                    "title": "个数"
                                                },{
                                                    "id":"income_true",
                                                    "axisAlpha": 0,
                                                    "position": "right",
                                                    "title": "金额(元)"

                                                },{
                                                    "id":"youhui",
                                                    "axisAlpha": 0,
                                                    "position": "right",
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
                                                    "valueField": "three",
                                                    "balloonText": "<span style='font-size:18px;'>活跃车辆数：[[value]]辆</span>",
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
                                                 }*/,{
                                                    "bullet": "square",
                                                    "bulletColor": "#659BE0",
                                                    "lineColor":"#659BE0",
                                                    "lineThickness": 2,
                                                    "valueField": "four",
                                                    "balloonText": "<span style='font-size:18px;'>活跃人数：[[value]]人</span>",
                                                    "valueAxis": "three"
                                                },{
                                                    "bullet": "square",
                                                    "bulletColor": "#EE7700",
                                                    "lineColor":"#EE7700",
                                                    "lineThickness": 2,
                                                    "valueField": "five",
                                                    "balloonText": "<span style='font-size:18px;'>连续两个月活跃车辆数：[[value]]辆</span>",
                                                    "valueAxis": "three"
                                                },{
                                                    "bullet": "square",
                                                    "bulletColor": "#227700",
                                                    "lineColor":"#227700",
                                                    "lineThickness": 2,
                                                    "valueField": "six",
                                                    "balloonText": "<span style='font-size:18px;'>连续两个月活跃人数:[[value]]人</span>",
                                                    "valueAxis": "three"
                                                }
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

                                        }
                                    })
                                })
                                var chartData =<?php echo ($positive_arr); ?>;
                                var chart = AmCharts.makeChart("site_activities", {
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
                                    "gridAboveGraphs": true,
                                    "startDuration": 1,
                                    "valueAxes": [{
                                        "id":"income",
                                        "axisAlpha": 0,
                                        "position": "left",
                                        "title": "个数"
                                    },{
                                        "id":"income_true",
                                        "axisAlpha": 0,
                                        "position": "right",
                                        "title": "金额(元)"

                                    },{
                                        "id":"youhui",
                                        "axisAlpha": 0,
                                        "position": "right",
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
                                        "valueField": "three",
                                        "balloonText": "<span style='font-size:18px;'>活跃车辆数：[[value]]辆</span>",
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
                                     }*/,{
                                        "bullet": "square",
                                        "bulletColor": "#659BE0",
                                        "lineColor":"#659BE0",
                                        "lineThickness": 2,
                                        "valueField": "four",
                                        "balloonText": "<span style='font-size:18px;'>活跃人数：[[value]]人</span>",
                                        "valueAxis": "three"
                                    },{
                                        "bullet": "square",
                                        "bulletColor": "#EE7700",
                                        "lineColor":"#EE7700",
                                        "lineThickness": 2,
                                        "valueField": "five",
                                        "balloonText": "<span style='font-size:18px;'>连续两个月活跃车辆数：[[value]]辆</span>",
                                        "valueAxis": "three"
                                    },{
                                        "bullet": "square",
                                        "bulletColor": "#227700",
                                        "lineColor":"#227700",
                                        "lineThickness": 2,
                                        "valueField": "six",
                                        "balloonText": "<span style='font-size:18px;'>连续两个月活跃人数:[[value]]人</span>",
                                        "valueAxis": "three"
                                    }
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
                            </script>


                        </div>
                        <div style="margin: 20px 0 10px 30px;display: none">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-success"> 实际收入: </span>
                                    <h3>¥<?php echo ($count_data["all_true_income"]); ?></h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-info"> 优惠金额: </span>
                                    <h3>¥<?php echo ($count_data["all_cp_hilt"]); ?></h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-danger"> 应收入金额: </span>
                                    <h3>¥<?php echo ($count_data["all_income"]); ?></h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>

            <div class="col-lg-6 col-xs-12 col-sm-12" id="month_add">
                <!-- BEGIN PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">每月新增用户数/新增绑定车辆数</span>
                            <span class="caption-helper">日期递增</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn red btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option1" value="1">去年</label>
                                <label class="btn red btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2" value="2">今年</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="month_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="month_content" class="display-none">
                            <div id="month" class="chart" style="background-color: #ffffff">
                                <script>
                                $('#month_add .btn-sm').click(function(){
                                    var v=$(this).children().val();
                                    var garage_id = "<?php echo ($_GET['garage_id']); ?>";
                                    $.ajax({
                                        url:"<?php echo U('Index/year_add_arr');?>",
                                        data:{'v':v,'garage_id':garage_id},
                                        type:'post',
                                        dataType:'json',
                                        success:function (res) {
                                            console.log(res.msg);
                                            var chartsDate =res.msg;
                                            var chart = AmCharts.makeChart( "month", {
                                                "type": "serial",
                                                "theme":"light",
                                                "dataProvider": chartsDate,
                                                "categoryField": "date",
                                                "categoryAxis": {
                                                    "autoGridCount": false,
                                                    "gridCount": chartsDate.length,
                                                    "gridPosition": "start",
                                                    "gridAlpha": 0,
                                                    "categoryAxisColor":"#123456",
                                                },
                                                "gridAboveGraphs": true,
                                                "startDuration": 1,

                                                "valueAxes": [{
                                                    "id":"income",
                                                    "axisAlpha": 0,
                                                    "position": "left",
                                                    "title": "新增数量(个)"
                                                },{
                                                    "id":"income_true",
                                                    "axisAlpha": 0,
                                                    "position": "right",
                                                    "inside": true,
                                                    "title": "金额(元)"

                                                },{
                                                    "id":"youhui",
                                                    "axisAlpha": 0,
                                                    "position": "right",
                                                },{
                                                    "id":"count",
                                                    "axisAlpha": 0,
                                                    "position": "right",
                                                    "title": "交易数(笔)"
                                                }
                                                ],
                                                "graphs": [{
                                                    "bullet": "round",
                                                    "bulletSize":6,
                                                    "bulletBorderAlpha": 1,
                                                    "bulletBorderThickness": 1,
                                                    "useLineColorForBulletBorder": true,
                                                    "dashLengthField": "8",
                                                    "bulletColor": "#00BB00",
                                                    "lineColor":"#00BB00",
                                                    "balloonText": "<span style='font-size:18px;'>月增用户数：[[value]]个</span>",
                                                    "legendValueText": "[[value]]元",
                                                    "title": "red line",
                                                    "fillAlphas": 0.2,
                                                    "valueField": "one",
                                                    "valueAxis": "one",
                                                    "hideBulletsCount": 50,
                                                    "lineThickness": 2,
                                                },{
                                                    "bullet": "round",
                                                    "bulletSize":6,
                                                    "bulletBorderAlpha": 1,
                                                    "bulletBorderThickness": 1,
                                                    "useLineColorForBulletBorder": true,
                                                    "dashLengthField": "8",
                                                    "bulletColor":"#CA8EC2",
                                                    "lineColor":"#CA8EC2",
                                                    "balloonText": "<span style='font-size:18px;'>月增绑定车辆数：[[value]]辆</span>",
                                                    "legendValueText": "[[value]]元",
                                                    "title": "red line",
                                                    "fillAlphas": 0.2,
                                                    "valueField": "two",
                                                    "valueAxis": "one",
                                                    "hideBulletsCount": 50,
                                                    "lineThickness": 2,
                                                }],
                                                "responsive": {
                                                    "enabled": true,
                                                    "addDefaultRules": false,
                                                    "rules": [
                                                        {
                                                            "maxWidth": 400,
                                                            "overrides": {
                                                                "legend": {
                                                                    "enabled": false
                                                                }
                                                            }
                                                        }
                                                    ]
                                                },

                                                "chartCursor": {
                                                    "valueLineEnabled": true,
                                                    "valueLineBalloonEnabled": true,
                                                    "cursorAlpha": 0,
                                                    "zoomable": false,
                                                    "valueZoomable": true,
                                                    "valueLineAlpha": 0.5
                                                },
                                                "responsive":{
                                                    "enabled":true
                                                },
                                                "export": {
                                                    "enabled": true
                                                },
                                                "autoGridCount": false,
                                                "axisColor": "#555555",
                                                "gridAlpha": 0.1,
                                                "gridColor": "#FFFFFF",

                                            } );
                                        }
                                    })
                                })
                                    var chartsDate =<?php echo ($month_add_json_arr); ?>;
                                    var chart = AmCharts.makeChart( "month", {
                                        "type": "serial",
                                        "theme":"light",
                                        "dataProvider": chartsDate,
                                        "categoryField": "date",
                                        "categoryAxis": {
                                            "autoGridCount": false,
                                            "gridCount": chartsDate.length,
                                            "gridPosition": "start",
                                            "gridAlpha": 0,
                                            "categoryAxisColor":"#123456",
                                        },
                                        "gridAboveGraphs": true,
                                        "startDuration": 1,

                                        "valueAxes": [{
                                            "id":"income",
                                            "axisAlpha": 0,
                                            "position": "left",
                                            "title": "新增数量(个)"
                                        },{
                                            "id":"income_true",
                                            "axisAlpha": 0,
                                            "position": "right",
                                            "inside": true,
                                            "title": "金额(元)"

                                        },{
                                            "id":"youhui",
                                            "axisAlpha": 0,
                                            "position": "right",
                                        },{
                                            "id":"count",
                                            "axisAlpha": 0,
                                            "position": "right",
                                            "title": "交易数(笔)"
                                        }
                                        ],
                                        "graphs": [{
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor": "#00BB00",
                                            "lineColor":"#00BB00",
                                            "balloonText": "<span style='font-size:18px;'>月增用户数：[[value]]个</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "red line",
                                            "fillAlphas": 0.2,
                                            "valueField": "one",
                                            "valueAxis": "one",
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                        },{
                                            "bullet": "round",
                                            "bulletSize":6,
                                            "bulletBorderAlpha": 1,
                                            "bulletBorderThickness": 1,
                                            "useLineColorForBulletBorder": true,
                                            "dashLengthField": "8",
                                            "bulletColor":"#CA8EC2",
                                            "lineColor":"#CA8EC2",
                                            "balloonText": "<span style='font-size:18px;'>月增绑定车辆数：[[value]]辆</span>",
                                            "legendValueText": "[[value]]元",
                                            "title": "red line",
                                            "fillAlphas": 0.2,
                                            "valueField": "two",
                                            "valueAxis": "one",
                                            "hideBulletsCount": 50,
                                            "lineThickness": 2,
                                        }],
                                        "responsive": {
                                            "enabled": true,
                                            "addDefaultRules": false,
                                            "rules": [
                                                {
                                                    "maxWidth": 400,
                                                    "overrides": {
                                                        "legend": {
                                                            "enabled": false
                                                        }
                                                    }
                                                }
                                            ]
                                        },

                                        "chartCursor": {
                                            "valueLineEnabled": true,
                                            "valueLineBalloonEnabled": true,
                                            "cursorAlpha": 0,
                                            "zoomable": false,
                                            "valueZoomable": true,
                                            "valueLineAlpha": 0.5
                                        },
                                        "responsive":{
                                            "enabled":true
                                        },
                                        "export": {
                                            "enabled": true
                                        },
                                        "autoGridCount": false,
                                        "axisColor": "#555555",
                                        "gridAlpha": 0.1,
                                        "gridColor": "#FFFFFF",

                                    } );
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>


        </div><?php endif; ?>
        <!-- END PAGE BASE CONTENT i-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler">
    <i class="icon-login"></i>
</a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
    <div class="page-quick-sidebar">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                    <span class="badge badge-danger">2</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts
                    <span class="badge badge-success">7</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-bell"></i> Alerts </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-info"></i> Notifications </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-speech"></i> Activities </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-settings"></i> Settings </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                    <h3 class="list-heading">Staff</h3>
                    <ul class="media-list list-items">
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-success">8</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Bob Nilson</h4>
                                <div class="media-heading-sub"> Project Manager </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar1.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Nick Larson</h4>
                                <div class="media-heading-sub"> Art Director </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-danger">3</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar4.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Deon Hubert</h4>
                                <div class="media-heading-sub"> CTO </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar2.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Ella Wong</h4>
                                <div class="media-heading-sub"> CEO </div>
                            </div>
                        </li>
                    </ul>
                    <h3 class="list-heading">Customers</h3>
                    <ul class="media-list list-items">
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-warning">2</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar6.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Lara Kunis</h4>
                                <div class="media-heading-sub"> CEO, Loop Inc </div>
                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="label label-sm label-success">new</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar7.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Ernie Kyllonen</h4>
                                <div class="media-heading-sub"> Project Manager,
                                    <br> SmartBizz PTL </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar8.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Lisa Stone</h4>
                                <div class="media-heading-sub"> CTO, Keort Inc </div>
                                <div class="media-heading-small"> Last seen 13:10 PM </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-success">7</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar9.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Deon Portalatin</h4>
                                <div class="media-heading-sub"> CFO, H&D LTD </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar10.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Irina Savikova</h4>
                                <div class="media-heading-sub"> CEO, Tizda Motors Inc </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-danger">4</span>
                            </div>
                            <img class="media-object" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar11.jpg" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Maria Gomez</h4>
                                <div class="media-heading-sub"> Manager, Infomatic Inc </div>
                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="page-quick-sidebar-item">
                    <div class="page-quick-sidebar-chat-user">
                        <div class="page-quick-sidebar-nav">
                            <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                <i class="icon-arrow-left"></i>Back</a>
                        </div>
                        <div class="page-quick-sidebar-chat-user-messages">
                            <div class="post out">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> When could you send me the report ? </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Its almost done. I will be sending it shortly </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Alright. Thanks! :) </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:16</span>
                                    <span class="body"> You are most welcome. Sorry for the delay. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> No probs. Just take your time :) </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:40</span>
                                    <span class="body"> Alright. I just emailed it to you. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> Great! Thanks. Will check it right away. </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar2.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:40</span>
                                    <span class="body"> Please let me know if you have any comment. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout/img/avatar3.jpg" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>
                                </div>
                            </div>
                        </div>
                        <div class="page-quick-sidebar-chat-user-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message here...">
                                <div class="input-group-btn">
                                    <button type="button" class="btn green">
                                        <i class="icon-paper-clip"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                <div class="page-quick-sidebar-alerts-list">
                    <h3 class="list-heading">General</h3>
                    <ul class="feeds list-items">
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 4 pending tasks.
                                            <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> Just now </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-danger">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> New order received with
                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 30 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> Web server hardware needs to be upgraded.
                                            <span class="label label-sm label-warning"> Overdue </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 2 hours </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-default">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <h3 class="list-heading">System</h3>
                    <ul class="feeds list-items">
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 4 pending tasks.
                                            <span class="label label-sm label-warning "> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> Just now </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-danger">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> New order received with
                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 30 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-warning">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> Web server hardware needs to be upgraded.
                                            <span class="label label-sm label-default "> Overdue </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 2 hours </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                <div class="page-quick-sidebar-settings-list">
                    <h3 class="list-heading">General Settings</h3>
                    <ul class="list-items borderless">
                        <li> Enable Notifications
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Allow Tracking
                            <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Log Errors
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Auto Sumbit Issues
                            <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Enable SMS Alerts
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                    </ul>
                    <h3 class="list-heading">System Settings</h3>
                    <ul class="list-items borderless">
                        <li> Security Level
                            <select class="form-control input-inline input-sm input-small">
                                <option value="1">Normal</option>
                                <option value="2" selected>Medium</option>
                                <option value="e">High</option>
                            </select>
                        </li>
                        <li> Failed Email Attempts
                            <input class="form-control input-inline input-sm input-small" value="5" /> </li>
                        <li> Secondary SMTP Port
                            <input class="form-control input-inline input-sm input-small" value="3560" /> </li>
                        <li> Notify On System Error
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Notify On SMTP Error
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                    </ul>
                    <div class="inner-content">
                        <button class="btn btn-success">
                            <i class="icon-settings"></i> Save Changes</button>
                    </div>
                </div>
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

<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo (C("ADMIN_ASSETS_URL")); ?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script type="text/javascript">
    $(function () {
        var name = "<?php echo (session('admin_name')); ?>";
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-bottom-right",
            "progressBar" : true,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        };
        toastr["success"]("欢迎使用智慧停车系统！", "您好!  "+name);
        $('.ranges ul li').click(function () {
            //alert($(this).index());//点击后获取当前li的下标
            //js中字符串转化成整形，用于下面做运算
            var a=parseInt("<?php echo ($begin_time); ?>");
            var b=parseInt("<?php echo ($end_time); ?>");
            var begin_time="";
            var end_time="";
            var c = parseInt("<?php echo ($garage_id); ?>");
            //获取列表下标，判断当前选中时间
            var t=$(this).index();
            if(t!=7){
                if(t==0){
                    begin_time = a;
                    end_time = b;
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s==Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("今天交易金额");
                    $("#true_all_income").html("今天实际收入金额");
                    $("#all_cp_hilt").html("今天优惠金额");
                    $("#out_in_count").html("今天车辆出入场次");

                }else if(t==1){
                    begin_time = a-24*60*60;
                    end_time = a;
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("昨天交易金额");
                    $("#true_all_income").html("昨天实际收入金额");
                    $("#all_cp_hilt").html("昨天优惠金额");
                    $("#out_in_count").html("昨天车辆出入场次");
                }else if(t==2){
                    begin_time = a-7*24*60*60;
                    end_time = a;
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("近七天交易金额");
                    $("#true_all_income").html("近七天实际收入金额");
                    $("#all_cp_hilt").html("近七天优惠金额");
                    $("#out_in_count").html("近七天车辆出入场次");
                }
                else if(t==3){
                    begin_time = a-30*24*60*60;
                    end_time = a;
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("近30天交易金额");
                    $("#true_all_income").html("近30天实际收入金额");
                    $("#all_cp_hilt").html("近30天优惠金额");
                    $("#out_in_count").html("近30天车辆出入场次");
                }
                else if(t==4){
                    begin_time = '<?php echo ($beginThismonth); ?>';
                    end_time = '<?php echo ($endThismonth); ?>';
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("这个月交易金额");
                    $("#true_all_income").html("这个月实际收入金额");
                    $("#all_cp_hilt").html("这个月优惠金额");
                    $("#out_in_count").html("这个月车辆出入场次");
                }
                else if(t==5){
                    begin_time = '<?php echo ($b_time); ?>';
                    end_time = '<?php echo ($e_time); ?>';
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("上个月交易金额");
                    $("#true_all_income").html("上个月实际收入金额");
                    $("#all_cp_hilt").html("上个月优惠金额");
                    $("#out_in_count").html("上个月车辆出入场次");
                }
                else if(t==6){
                    begin_time = 1451577600;
                    end_time = Date.parse(new Date())/1000;
                    $("#href_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time+"/garage_id/"+c);
                    $("#all_income").html("总计交易金额");
                    $("#true_all_income").html("总计实际收入金额");
                    $("#all_cp_hilt").html("总计优惠金额");
                    $("#out_in_count").html("总计车辆出入场次");
                }
                //通过指定时间段查询交易情况
                $.ajax({
                    url:"<?php echo U('index_time_amount');?>",
                    data:{'begin_time':begin_time,'end_time':end_time,'garage_id':c},
                    dataType:'json',
                    type:'post',
                    success:function(res){
                        // alert(res.duty);
                        // console.log(res.today_all_income);
                        console.log(res.duty);
                        //应收款
                        $(".today_all_income_all").text(res.today_all_income.all);
                        $(".today_all_income_online").text(res.today_all_income.online);
                        $(".today_all_income_cash").text(res.today_all_income.cash);
                        $(".today_all_income_scan").text(res.today_all_income.scan);
                        //实收款
                        // $(".today_true_all_income").text(res.today_true_all_income);
                        $(".today_true_all_income_all").text(res.today_true_all_income.all);
                        $(".today_true_all_income_online").text(res.today_true_all_income.online);
                        $(".today_true_all_income_cash").text(res.today_true_all_income.cash);
                        $(".today_true_all_income_scan").text(res.today_true_all_income.scan);
                        //早中晚班
                        var k;
                        for (k in res.duty) {
                            var vo = res.duty[k];
                            $(".zhenkeng_a_"+k).text(vo.duty_incomeArr.all);
                            $(".zhenkeng_b_"+k).text(vo.duty_incomeArr.online);
                            $(".zhenkeng_c_"+k).text(vo.duty_incomeArr.scan);
                            $(".zhenkeng_d_"+k).text(vo.duty_incomeArr.cash);
                        }
                        $(".today_all_cp_hilt").text(res.today_all_cp_hilt);
                        $(".out_in_count").text(res.out_in_count);
                        //alert(res.out_in_count);
                        /*for(var i=0;i<res.duty.length;i++){
                            $(".duty_time:eq("+i+")").attr('href',"javascript:void(0);");
                            $(".duty_income:eq("+i+")").text(res.duty[i].duty_income);
                        }*/
                    }
                });
            }
        })

        //通过日历选择时间段查询交易情况
        $(".applyBtn").click(function () {
            var start=$("input[name='daterangepicker_start']").val();
            var end=$("input[name='daterangepicker_end']").val();
            var s_time = start.replace(/[\/]/g,'-');
            var e_time = end.replace(/[\/]/g,'-');
            var c = parseInt("<?php echo ($garage_id); ?>");
            $.ajax({
                url:"<?php echo U('index_calendar');?>",
                data:{'begin_time':start,'end_time':end,'garage_id':c},
                dataType:'json',
                type:'post',
                success:function (res) {
                    // $(".today_all_income").text(res.today_all_income);
                    //应收款
                    $(".today_all_income_all").text(res.today_all_income.all);
                    $(".today_all_income_online").text(res.today_all_income.online);
                    $(".today_all_income_cash").text(res.today_all_income.cash);
                    $(".today_all_income_scan").text(res.today_all_income.scan);
                    // $(".today_true_all_income").text(res.today_true_all_income);
                    $(".today_true_all_income_all").text(res.today_true_all_income.all);
                    $(".today_true_all_income_online").text(res.today_true_all_income.online);
                    $(".today_true_all_income_cash").text(res.today_true_all_income.cash);
                    $(".today_true_all_income_scan").text(res.today_true_all_income.scan);
                    $(".today_all_cp_hilt").text(res.today_all_cp_hilt);
                    $(".out_in_count").text(res.out_in_count);

                    //早中晚班
                    var k;
                    for (k in res.duty) {
                        var vo = res.duty[k];
                        $(".zhenkeng_a_"+k).text(vo.duty_incomeArr.all);
                        $(".zhenkeng_b_"+k).text(vo.duty_incomeArr.online);
                        $(".zhenkeng_c_"+k).text(vo.duty_incomeArr.scan);
                        $(".zhenkeng_d_"+k).text(vo.duty_incomeArr.cash);
                    }

                    $("#all_income").text('总交易金额');
                    $("#true_all_income").text('实际收入金额');
                    $("#all_cp_hilt").text('优惠金额');
                    $("#out_in_count").text('车辆出入场次');
                    $("#href_all_income").attr('href',"/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/"+res.begin_time+"/endDate/"+res.end_time+"/garage_id/"+c);
                    $("#href_true_all_income").attr('href',"/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/"+res.begin_time+"/endDate/"+res.end_time+"/garage_id/"+c);
                    $("#href_all_cp_hilt").attr('href',"/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/"+res.begin_time+"/endDate/"+res.end_time+"/garage_id/"+c);
                    $("#href_out_in_count").attr('href',"/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/"+res.begin_time+"/endDate/"+res.end_time+"/garage_id/"+c);
                    $(".duty_time").attr('href',"/Car/index.php?s=/Admin/Payrecord/showlist_pay/startDate/"+res.begin_time+"/endDate/"+res.end_time+"/garage_id/"+c);
                    //alert(res.out_in_count);
                    // for(var i=0;i<res.duty.length;i++){
                    //     $(".duty_time:eq("+i+")").attr('href',"javascript:void(0);");
                    //     $(".duty_income:eq("+i+")").text(res.duty[i].duty_income);
                    // }
                }
            })
        })

    })
</script>
</body>

</html>