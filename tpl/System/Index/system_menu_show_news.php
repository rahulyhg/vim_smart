<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -95px;}
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
                <h1>管理员操作日志
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                系统设置
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=system_menu_show_news">后台菜单管理</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> 菜单列表 </span>
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
                                        <a href="{pigcms{:U('Index/system_menu_add_news')}">
                                            <button id="sample_editable_1_new" class="btn sbold green">添加菜单
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">批量操作
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-print"></i> 删除 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-file-pdf-o"></i> 禁用 </a>
                                            </li>
                                        </ul>
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
                                <th>编号</th>
                                <th>排序</th>
                                <th>菜单名称</th>
                                <th>父级菜单</th>
                                <th>所属模块</th>
                                <th>控制器</th>
                                <th>操作方法</th>
                                <th>显示状态</th>
                                <th>权限类型</th>
                                <th>权限范围</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <foreach name="menu_array" item="vo">
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{pigcms{$vo.id}</td>
                                    <td>
                                            <input type="number" style="width: 75px" class="form-control" id="{pigcms{$vo.id}" onblur="sort_fid_menu(this)" value="{pigcms{$vo.sort}" <if condition="$vo['fid'] neq 0 or $vo['auth_area'] neq 0">readonly = "readonly"</if>/>
                                            <span></span>
                                    </td>
                                    <td>{pigcms{$vo.name}</td>
                                    <td>{pigcms{$vo.fid_name}</td>
                                    <td>{pigcms{$vo.module}</td>
                                    <td>{pigcms{$vo.controller}</td>
                                    <td>{pigcms{$vo.action}</td>
                                    <!--<if condition="$vo['fid'] eq 0">
                                        <td colspan="3" style="color: darkred">顶级菜单没有此类型数据</td>
                                        <else/>
                                        <td>{pigcms{$vo.module}</td>
                                        <td>{pigcms{$vo.controller}</td>
                                        <td>{pigcms{$vo.action}</td>
                                    </if>-->
                                    <if condition="$vo.is_show eq 1">
                                    <td style="color: green;cursor:pointer" onclick="hidden_all_choose_menu(this)" id="{pigcms{$vo.id}">显示</td>
                                    <else/>
                                    <td style="color: red;cursor:pointer" id="{pigcms{$vo.id}" onclick="show_all_choose_menu(this)">未显示</td>
                                    </if>
                                    <if condition="$vo.auth_type eq 0">
                                        <td style="color: blue">菜单权限</td>
                                        <elseif condition="$vo.auth_type eq 1"/>
                                        <td style="color: yellow">逻辑权限</td>
                                        <elseif condition="$vo.auth_type eq 2"/>
                                        <td style="color: red">显示权限</td>
                                        <elseif condition="$vo.auth_type eq 3"/>
                                        <td style="color: orange">外部链接</td>
                                        <elseif condition="$vo.auth_type eq 4"/>
                                        <td style="color: purple">模块显示</td>
                                        <elseif condition="$vo.auth_type eq 5"/>
                                        <td style="color: purple">后台管理</td>
                                    </if>
                                    <if condition="$vo.auth_area eq 0">
                                        <td style="color: #DB78A1">后台权限</td>
                                        <elseif condition="$vo.auth_area eq 1"/>
                                        <td style="color: yellowgreen">Wap端权限</td>
                                        <elseif condition="$vo.auth_area eq 2"/>
                                        <td style="color: #ab1e1e">项目权限</td>
                                    </if>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('system_menu_edit_news',array('id'=>$vo['id']))}">
                                                        <i class="icon-tag"></i> 更新 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('system_menu_deleted_news',array('id'=>$vo['id']))}">
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
<!--自定义js代码区开始-->
<script type="text/javascript">
    //获取将要删除的记录对应的id
    function delete_pr_info(obj){
        layer.msg('你确定要删除吗？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                layer.close(index);
                var pigcms_id=$(obj).attr('id');
                //通过ajax异步删除
                $.ajax({
                    url:"{pigcms{:U('Index/log_del_new')}",
                    data:{'pigcms_id':pigcms_id},
                    type:'post',
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


    /*一键隐藏所选菜单，如果菜单包含子菜单的话一起隐藏*/
    function hidden_all_choose_menu(obj){
        var menu_id = $(obj).attr('id');
        $.ajax({
            url:"{pigcms{:U(change_show_hide)}",
            type:'post',
            data:{'menu_id':menu_id},
            success:function (res) {
                if(res == 1){
                    layer.msg('请确认选择的是菜单权限！', {icon: 5});
                }else{
                    window.location.reload();
                }

            }
        });
    }


    /*一键显示所选菜单，如果菜单包含子菜单的话一起隐藏*/
    function show_all_choose_menu(obj){
        var menu_id = $(obj).attr('id');
        $.ajax({
            url:"{pigcms{:U(change_show)}",
            type:'post',
            data:{'menu_id':menu_id},
            success:function (res) {
                if(res == 1){
                    layer.msg('请确认选择的是菜单权限！', {icon: 5});
                }else{
                    window.location.reload();
                }

            }
        });
    }

    /*对父级菜单进行排序*/
    function sort_fid_menu(obj){
        var menu_id = $(obj).attr('id');
        var sort_id = $(obj).val();
        if(sort_id != 0){
            $.ajax({
                url:"{pigcms{:U('sort_menu_id')}",
                type:'post',
                data:{'menu_id':menu_id,'sort_id':sort_id},
                success:function (res) {
                    if(res != 1){
                        window.location.reload();
                    }

                }
            });
        }

    }
</script>

<!--自定义js代码区结束-->
</body>

</html>