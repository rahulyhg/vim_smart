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
                <h1>计划任务管理
                    <small>在此你可以进行所有计划任务的管理</small>
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
                <a href="http://www.hdhsmart.com/Car/index.php?s=/Admin/Index/index.html">后台首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">智慧O2O系统</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">计划任务管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">计划任务列表</span>
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
                            <span class="caption-subject bold uppercase"> 控制面板 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                    <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tab_1_1_1" data-toggle="tab"> 智能门禁任务管理 </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_2" data-toggle="tab"> 智慧停车任务管理 </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_3" data-toggle="tab"> 标准咖啡任务管理 </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_1_1_1">
                                    <form id="my_form1">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">开关门间隔时间</label>
                                                <div class="col-md-5">
                                                    <input name="interval_time" type="number" class="form-control" value="{pigcms{$interval_time}"   min="1" max="60"/> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title"></label>
                                                <div class="col-md-5">
                                                    <a href="javascript:;" class="btn green-jungle btn-lg" id="keep_config_door"> 保存设置 </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_1_1_2">
                                    <form id="my_form2">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title">异常时间间隔设置值(小时)</label>
                                            <div class="col-md-5">
                                                <input name="wait_time" type="number" class="form-control" value="{pigcms{$car_warning.wait_time}"   min="1" max="23"/> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title">开始时间</label>
                                            <div class="col-md-5">
                                                <input name="warning_start" type="time" class="form-control" value="{pigcms{$car_warning.warning_start}"  /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title">结束时间</label>
                                            <div class="col-md-5">
                                                <input name="warning_end" type="time" class="form-control" value="{pigcms{$car_warning.warning_end}"  /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title">运行状态</label>
                                            <div class="col-md-5">
                                                <if condition="$is_work eq 1 and $is_not_deal eq 0">
                                                    <span class="btn green-jungle btn-lg" id="search">搜索进行中....</span>
                                                <else/>
                                                    <span class="btn red btn-lg">未进行搜索</span>
                                                </if>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="title"></label>
                                            <div class="col-md-5">
                                                <a href="javascript:;" class="btn green-jungle btn-lg" id="keep_config"> 保存设置 </a>
                                                <if condition="$is_work eq 1 and $is_not_deal eq 0">
                                                    <a href="javascript:;" class="btn green-jungle btn-lg" id="end_work" > 停止搜寻 </a>
                                                <else/>
                                                    <a href="javascript:;" class="btn green-jungle btn-lg" id="start_work"> 开启搜寻 </a>
                                                </if>
                                                <a href="javascript:;" class="btn green-jungle btn-lg" id="end_work" style="display: none"> 停止搜寻 </a>
                                                <a href="javascript:;" class="btn green-jungle btn-lg" id="start_work" style="display: none"> 开启搜寻 </a>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_1_1_3">
                                    <form id="my_form3">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="title">咖啡机配置</label>
                                                <div class="col-md-5">
                                                    <a class="btn purple" href="http://coffee.vhi99.com/admin/index.php" target="_blank"> 点击进入 </a>
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
            <div class="page-footer-inner"> 2016 &copy; 汇得行智慧停车系统
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
        <script>
            /*停车场交易异常js开始*/
            //保存配置
            $("#keep_config").click(function(){
                //第一步保存toastr设置
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-bottom-full-width",
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
                //第二步向后台传值完成保存动作
                $.ajax({
                    url:"{pigcms{:U('ajax_to_config')}",
                    data:getFormJson($("#my_form2")),
                    type: "POST",
                    dataType: 'json',
                    success:function(res){
                        if(res == 1){
                            toastr["error"]("保存设置失败！", "设置未能生效");
                           
                        }else{
                            toastr["success"]("保存设置成功！", "设置已经生效");
                        }
                    }
                });
            });
            //点击搜寻
            $("#start_work").click(function(){
                var is_not_deal = "{pigcms{$is_not_deal}";
                var is_work = 1;
                if(is_not_deal == '0'){
                    $.ajax({
                        url:"{pigcms{:U('ajax_to_work')}",
                        type: "POST",
                        data:{'is_work':is_work},
                        success:function(res){
                            if(res == 1){
                                toastr["success"]("开始搜寻", "TIP：请即时处理异常信息");
                                $("#start_work").hide();
                                $("#end_work").show();
                                $("#search").text('搜素进行中...');
                            }else{
                                toastr["success"]("错误！未能开启", "TIP：请即时处理异常信息");
                            }
                        }
                    });
                }else{
                    toastr["error"]("处理完成后才能继续搜寻","您有"+is_not_deal+"条处理完成的交易异常");
                }
            });

            //点击结束搜寻
            $("#end_work").click(function(){
                var is_work = 0;
                $.ajax({
                    url:"{pigcms{:U('ajax_to_work')}",
                    type: "POST",
                    data:{'is_work':is_work},
                    success:function(res){
                        if(res == 1){
                            toastr["success"]("已经停止搜寻", "TIP：请即时处理异常信息");
                            $("#start_work").show();
                            $("#end_work").hide();
                            $("#search").text('未进行搜索');
                        }else{
                            toastr["success"]("错误！未能停止", "TIP：请即时处理异常信息");
                        }
                    }
                });
            });
            /*停车场交易异常js结束*/

            /*智能门禁开门js开始*/
            //保存配置
            $("#keep_config_door").click(function(){
                //第一步保存toastr设置
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-bottom-full-width",
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
                //第二步向后台传值完成保存动作
                $.ajax({
                    url:"{pigcms{:U('ajax_to_config')}",
                    data:getFormJson($("#my_form1")),
                    type: "POST",
                    dataType: 'json',
                    success:function(res){
                        if(res == 1){
                            toastr["error"]("保存设置失败！", "设置未能生效");

                        }else{
                            toastr["success"]("保存设置成功！", "设置已经生效");
                        }
                    }
                });
            });

        </script>
        <!--插入layer弹层js结束-->
        
        
        <!--自定义js代码区开始-->
        <script type="text/javascript">
            //获取所有表单的值，做成键值对形式
            function getFormJson(form) {
                var o = {};
                var a = form.serializeArray();
                $.each(a, function () {
                    if (o[this.name] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
            }

        </script>
        
        <!--自定义js代码区结束-->
    </body>

</html>