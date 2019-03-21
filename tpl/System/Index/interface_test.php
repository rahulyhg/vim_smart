<layout name="layout"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    <!--
    .dropdown-menu {
        margin: 0 0 0 -110px;
    }
	.tabbable-custom>.nav-tabs>li.active {
		border-top: 3px solid #f36a5a;
		margin-top: 0;
		position: relative;
	}
    -->
</style>



<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>接口测试

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
                <a href="http://www.hdhsmart.com/Car/index.php?s=/Admin/Index/index.html">系统设置</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">接口测试</span>
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
                            <span class="caption-subject bold uppercase"> 接口一览 </span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tab_1_1_1" data-toggle="tab"> 智能门禁接口测试 </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_2" data-toggle="tab"> 智慧停车接口测试 </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_3" data-toggle="tab"> 标准咖啡接口测试 </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_1_1_1" style="padding-top:30px;">
                                    <form id="my_form1">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">Unios友联开门返回值</label>
                                                <div class="col-md-5">
                                                    <a href="http://www.hdhsmart.com/test.php?g=Test&c=Test&a=test_unios"><button type="button" class="btn blue btn-outline">点击测试</button></a>
                                                    <input name="interval_time" type="hidden" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">Unios友联获取commandToken</label>
                                                <div class="col-md-5">
                                                    <a href="http://www.hdhsmart.com/test.php?g=Test&c=Test&a=test_token"><button type="button" class="btn blue btn-outline">点击测试</button></a>
                                                    <input name="interval_time" type="hidden" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_1_1_2" style="padding-top:30px;">
                                    <form id="my_form2">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">停车场是否在场接口</label>
                                                <div class="col-md-5">
                                                    <a href="http://www.hdhsmart.com/test.php?g=Test&c=Test&a=test_car_in_park"><button type="button" class="btn blue btn-outline">点击测试</button></a>
                                                    <input name="interval_time" type="hidden" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">停车场生成订单接口</label>
                                                <div class="col-md-5">
                                                    <a href="http://www.hdhsmart.com/test.php?g=Test&c=Test&a=make_car_order"><button type="button" class="btn blue btn-outline">点击测试</button></a>
                                                    <input name="interval_time" type="hidden" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">手动排除抬杠失败(慎用)</label>
                                                <div class="col-md-5">
                                                    <a href="http://www.hdhsmart.com/test.php?g=Test&c=Test&a=hm_deal_problem_car"><button type="button" class="btn blue btn-outline">点击排除</button></a>
                                                    <input name="interval_time" type="hidden" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_1_1_3" style="padding-top:30px;">
                                    <form id="my_form3">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">咖啡机配置</label>
                                                <div class="col-md-5">
													<a href="http://coffee.vhi99.com/admin/index.php" target="_blank"><button type="button" class="btn blue btn-outline">点击进入</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

        </div>
    </div>
    <!-- END QUICK SIDEBAR -->
</div>

<!-- END QUICK SIDEBAR -->

<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">微嗨科技</a> &nbsp;|&nbsp;
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
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--toastr 插件开始-->
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<!--toastr 插件结束-->
<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>

<!--插入layer弹层js结束-->


<!--自定义js代码区开始-->


<!--自定义js代码区结束-->
</body>

</html>