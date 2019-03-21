<layout name="layout"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/components.min.css" id="style_components" rel="stylesheet" type="text/css" />-->

<!-- END PAGE LEVEL PLUGINS -->


<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
	.table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
		position: relative;
		margin-top: -2;
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
                <h1>Wap内容列表
                    <small>所有Wap内容都在这里 </small>
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
                <a href="#">系统设置</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">子内容列表</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> 列表记录</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active" onclick="window.location.href='__CONTROLLER__/recycle'">
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
                                        <a href="{pigcms{:U('Wapindex/wap_children_add_news',array('fid'=>$_GET['fid']))}">
                                            <button id="sample_editable_1_new" class="btn sbold green">添加子内容
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th> 编号 </th>
                                <th> 排序 </th>
                                <th> 名称 </th>
                                <th> 父内容 </th>
                                <th> 图片/图标 </th>
                                <th> URL地址 </th>
                                <th> 上线状态 </th>
                                <th> 操作 </th>
                            </tr>
                            </thead>
                            <tbody>
                            <foreach name="f_list_array" item="vo">
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> {pigcms{$vo.id} </td>
                                    <td>
                                        <input type="number" style="width: 75px" class="form-control" id="{pigcms{$vo.id}" onblur="edit_number(this);" value="{pigcms{$vo.number}"/>
                                        <span></span>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.name}
                                    </td>
                                    <td class="center">
                                        {pigcms{$f_name}
                                    </td>
                                    <td class="center">
                                        <img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" width="300px" height="150px"/>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.url}
                                    </td>
                                    <if condition="$vo.is_online eq 1">
                                        <td class="center" style="color: green" id="{pigcms{$vo.id}" onclick="change_online_status(this);">
                                            上线
                                        </td>
                                    <else/>
                                        <td class="center" style="color: red" id="{pigcms{$vo.id}" onclick="change_online_status(this);">
                                            未上线
                                        </td>
                                    </if>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('Wapindex/wap_children_edit_news',array('id'=>$vo['id']))}">
                                                        <i class="icon-docs"></i> 更新 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('Wapindex/wap_children_delete_news',array('id'=>$vo['id']))}">
                                                        <i class="icon-tag"></i> 删除 </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </foreach>
                            </tbody>
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
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
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
<script>
    $(function(){
        $("[name='change_state']").click(function(){

            var pigcms_id = $(this).siblings(":first").text();
            var is_use = $(this).text();
            $.ajax({
                url: "{pigcms{:U('Hickey/change_state')}",
                type: "GET",
                data: {'pigcms_id': pigcms_id,'is_use':is_use},
                success: function (res) {
                    if(res == 1){
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

<!--自定义js代码区开始-->
<script type="text/javascript">
    //修改位置的序号信息
    function edit_number(msg){
        var id = $(msg).attr('id');
        var number = $(msg).val();
        $.ajax({
            url:"{pigcms{:U('edit_site')}",
            type:'post',
            data:{id:id,number:number},
            success:function (res) {
                if(res != 2){
                    window.location.reload();
                }
            }
        });
    }



    function use_condition_search(){
        //点击开启搜索区
        layer.open({
            type: 2,
            title: '欢迎使用条件搜索',
            shadeClose: true,
            shade: 0.8,
            area: ['800px', '50%'],
            content: "{:U('payrecord_search')}" //iframe的url
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