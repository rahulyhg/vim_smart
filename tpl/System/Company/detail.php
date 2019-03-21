<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
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
                <h1>{pigcms{$merchant_name}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('index_news')}">商户列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{pigcms{:U('user_list',array('company_id'=>$company_id,'mid'=>$mid))}">员工列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">{pigcms{$user_name}</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> 列表记录</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active" onclick="window.location.href='__CONTROLLER__/recycle'">
                                    <input type="radio" name="options" class="toggle" id="option1">回收站</label>
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="" method="get" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                            <input type="hidden" name="m" value="System"/>
                            <input type="hidden" name="c" value="Company"/>
                            <input type="hidden" name="a" value="detail"/>
                            <input type="hidden" name="company_id" value="{pigcms{$company_id}"/>
                            <input type="hidden" name="mid" value="{pigcms{$mid}"/>
                            <input type="hidden" name="uid" value="{pigcms{$uid}"/>
                            <select name="searchtype">
                                <option selected="selected" value="0">请选择</option>
                                <option value="out" <if condition="$_GET['searchtype']=='out'">selected</if>>支出</option>
                                <option value="in" <if condition="$_GET['searchtype']=='in'">selected</if>>收入</option>
                            </select>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">开始时间
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" id="datetimepicker" class="form-control" placeholder="" name="startDate" value="{pigcms{$_GET['startDate']}">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">请勿手动输入：请点击右边的下拉按钮进行选择时间”</span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">结束时间
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" id="datetimepicker2" class="form-control" placeholder="" name="endDate" value="{pigcms{$_GET['endDate']}">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">请勿手动输入：请点击右边的下拉按钮进行选择时间”</span>
                                </div>
                            </div>
                            <input type="submit" value="查询" class="button"/>
                        </form>
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
                                <th>创建时间</th>
                                <th>交易单号</th>
                                <th>交易对方</th>
                                <th>收入</th>
                                <th>支出</th>
                                <th>账户余额</th>
<!--                                <th>操作</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <foreach name="list" item="vo">
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> {pigcms{$vo.pigcms_id} </td>
                                    <td class="center">
                                        {pigcms{$vo['time']|date='Y-m-d H:i:s',###}
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.order_id}
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.name}
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['type'] eq 1">+{pigcms{$vo.money}</if>
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['type'] eq 2">-{pigcms{$vo.money}</if>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.now_money}
                                    </td>
<!--                                    <td class="center">-->
<!--                                        详情-->
<!--                                    </td>-->
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
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--自定义js代码区开始-->
<script type="text/javascript">
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
            "info": "Showing _START_ to _END_ of _TOTAL_ records",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "Show _MENU_",
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
            [5, 15, 20, "All"] // change per page values here
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
<script type='text/javascript'>
    //开启日历插件
    $('#datetimepicker').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });
    $('#datetimepicker2').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });
</script>

<!--自定义js代码区结束-->
</body>
<script>
    $(document).ready(function () {
        var mid = '{pigcms{$mid}';
        if(mid){
            var url = "{pigcms{:U('index_news')}";
            menu_select(url);
        }else{
            var url = "{pigcms{:U('left_group_news')}";
            menu_select(url);
        }

    });
</script>
</html>