<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <!--头部文件-->
    <meta charset="utf-8" />
<title id="span_title"><?php echo ($title?$title:"物业综合服务平台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="" name="author" />

<link rel="shortcut icon" href="favicon.ico" />

<link href="/Car/Admin/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

<script src="/Car/Admin/Public/assets/global/plugins/mapplic/js/html5shiv.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.js"></script>
<![endif]-->


<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />




<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">




<style type="text/css">
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
        right: 50px;
        left: auto;
    }
    .nav.pull-right>li>.dropdown-menu, .nav>li>.dropdown-menu.pull-right{
        right: 50px;
        left: auto;
    }
    [v-cloak] {
        display: none;
    }
</style>
<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
    -->
    .label-kid {
        background-color: #f36a5a;
    }
    .btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
        margin-top: 10px;
    }
    .dropdown-menu {
        margin: 0 0 0 -125px;
    }
    /*.dropdown-menu:last-child{
        position: relative!important;
    }*/
    .dropdown-menu:last-of-type {
        position: relative!important;
    }
</style>
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
<script src="./static/js/system-main.js"></script>
    <!--/头部文件-->
    
</head>


<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">



<div class="page-container">

    <div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item start active open">
                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_new" class="nav-link nav-toggle" id="span_a">
                    <i class="icon-home"></i>
                    <!-- <span class="title"><img src="" class="logo-default" id="span_pic"></span> -->
                    <span class="title" id="span_text"></span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <!--***************************************************************停车系统开始************************************************-->

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
                                        <?php else: ?>
                                        <a href="<?php echo ($voo["url"]); ?>_news" class="nav-link ">
                                            <span class="title"><?php echo ($voo["name"]); ?></span>
                                        </a><?php endif; ?>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            <!-- 根据url自动选择相应的选项卡-->
            <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
            <script>
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
                        if($($(this))[0].href==String(window.location)){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }else if(lastUrl == $($(this))[0].href){
                            $(this).parent().addClass('open');
                            $(this).parent().parent().parent().addClass('open');
                            $(this).parent().parent().parent().find(".sub-menu").show();
                        }
                    });


                });
            </script>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
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

                    <div class="col-md-12" style="float: left">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green sbold uppercase"><?php echo ($breadcrumb[count($breadcrumb)-1][0]); ?></span>
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

                                <div class="form-body">
                                    
    <label class="col-md-2 control-label" for="form_control_1">是否为第一次导入
        <span class="required"></span>
    </label>
    <input type="checkbox"  class="my-checkbox">
    <div>
        <form action="<?php echo U('water_uptown_import_step2');?>" id="form" method="post" enctype="multipart/form-data" >
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/业主信息导入格式表5.xls" download="业主信息导入格式表.xls">
                        下载
                    </a>
                </div>
            </div>

            <div class="time_check">
                <label class="col-md-2 control-label" for="form_control_1">抄表日期
                    <span class="required"></span>
                </label>
                <div class="input-group input-large date-picker input-daterange">
                    <input type="text" class="form-control" name="start_time" id="time_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" name="end_time" id="time_to" onchange="">
                </div>
            </div>
            <!--<div class="input-group input-large date-picker input-daterange">
                <select name="start_time" id="sel" class="form-control show_mouth show_mouth1" >
                    <option value="0">选择月份</option>
                    <?php $__FOR_START_29487__=1;$__FOR_END_29487__=13;for($i=$__FOR_START_29487__;$i < $__FOR_END_29487__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>月</option><?php } ?>
                </select>
                <span class="input-group-addon"> to </span>
                <select name="end_time" id="sels" class="form-control show_mouth show_mouth2" style="float:left">
                    <option value="0">选择月份</option>
                    <?php $__FOR_START_15144__=1;$__FOR_END_15144__=13;for($i=$__FOR_START_15144__;$i < $__FOR_END_15144__;$i+=1){ ?><option value="<?php echo ($i); ?>" ><?php echo ($i); ?>月</option><?php } ?>
                </select>
            </div>-->

            <label class="col-md-2 control-label" for="form_control_1">选择类型
                <span class="required"></span>
            </label>
            <select name="type" id="">
                <option value="-1">请选择类型</option>
                <option value="水费">水费</option>
                <option value="电费">电费</option>
            </select>
            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择社区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="village_id" class="form-control">
                        <?php if(is_array($village_list)): foreach($village_list as $key=>$row): ?><option value="<?php echo ($key); ?>"><?php echo ($row); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div>-->
            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择园区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <div class="md-checkbox-list">
                        <?php if(is_array($project_list)): foreach($project_list as $key=>$row): ?><div class="md-radio">
                                    <input name="project_id" for="<?php echo ($row['desc']); ?>" type="radio" class="mt-radio" value="<?php echo ($row['pigcms_id']); ?>" id="checkbox1_<?php echo ($key); ?>">
                                    <label for="checkbox1_<?php echo ($key); ?>" class="text-success">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> <?php echo ($row['desc']); ?> </label>
                                </div><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>-->

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">导入文件
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <input type="file" class="form-control" name="test">
                </div>
            </div>

            <input type="hidden" name="status">
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
<!--                        <input type="button" class="btn green" onclick="submit1()" value="确认提交"/>-->
                        <button type="submit" class="btn green" >确认提交</button>
                        <button type="button" class="btn default" onclick="app.redirect('PropertyService/room_list_uptown')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
    <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <!--自定义js代码区开始-->
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
    <!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
     -->
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
    <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
    <script>
        function submit1() {
            var project_id='<?php echo ($project_info['desc']); ?>';

            if(!project_id){
                swal({
                        title: '请选择小区',
                        text: "请选择小区后进行上传",
                        type:'warning',
                        confirmButtonText: "确定"

                    },function(){

                    }
                );
            }
            swal({
                    title: "是否批量上传水电费信息",
                    text: "请确认",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $('#form').submit();
                    } else {

                    }
                });
        }


    </script>

    <!--获取日期时间插件 -->
    <script type="text/javascript">
        $(".my-checkbox").click(function(){
            if($(this).is(':checked')){
                $('.time_check').css('display','none');
                $("input[name='status']").val(1);
            }else{
                $('.time_check').css('display','block');
                $("input[name='status']").val('');
            }
        });
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
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </div>
    <!-- /主体-->
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


<script>
    window.onload=function(){       
        // var url = window.location.href;
        // var str = url.substr(url.lastIndexOf('system='),);
        // var num = str.substr(str.lastIndexOf('=')+1,);
        // var num = <?php echo ($_SESSION['system_id']); ?>;
        var num = document.getElementById("system_id").value;
        var href1 = document.getElementById("logo_a").href;
        var href2 = document.getElementById("span_a").href;
/*        var href3 = document.getElementById("child_a").href;
*/
        var logo_a = href1+'&system='+num;
        var span_a = href2+'&system='+num;
/*        var child_a = href3+'&system='+num;
*/
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
/*            $('#child_a').attr('href',child_a);
*/
        }else{
            console.log(2);
            // pic.src="/Car/Admin/Public/assets/pages/img/login/vlg.jpg";
            document.getElementById("span_title").innerText="物业平台";
            document.getElementById("logo_text").innerText="物业平台";
            document.getElementById("span_text").innerText="物业平台";
        }

    };
</script>

<!--/底部文件-->




<!--自定义js代码区结束-->
</body>

</html>