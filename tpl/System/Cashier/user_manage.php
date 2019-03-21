<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

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
                <h1>{pigcms{$company_name}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('group',array('company_id'=>$company_id))}">分组管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">{pigcms{$this_group}</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">成员管理</span>
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
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <if condition="$mid">
                                            <a href="{pigcms{:U('add_user',array('company_id'=>$company_id,'group_id'=>$group_id))}">
                                                <button id="sample_editable_1_new" class="btn sbold green">添加组员
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </a>
                                            <else/>
                                            <a href="{pigcms{:U('add_user',array('company_id'=>$company_id,'group_id'=>$group_id))}">
                                                <button id="sample_editable_1_new" class="btn sbold green">添加组员
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </a>
                                        </if>
                                    </div>
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn sbold green del">批量删除
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-print"></i> Print </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{pigcms{:U('move_user')}" method="post">
                            <input type="hidden" name="company_id" value="{pigcms{$company_id}"/>
                            <input type="hidden" name="this_group_id" value="{pigcms{$group_id}"/>
                            <label style="font-size:14px;">移至</label>
                            <select name="group_id" style="border:1px #d1d1d1 solid; width: 100px; height: 26px; font-size: 14px; line-height: 26px;">
                                <option value="0" selected="selected">请选择</option>
                                <if condition="$group">
                                    <foreach name="group" item="value">
                                        <option value="{pigcms{$value['group_id']}">
                                            <if condition="$value['group_id'] eq $user['group_id']">selected</if>
                                            {pigcms{$value['group_name']}
                                        </option>
                                    </foreach>
                                </if>
                            </select>
                            <div class="out">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th>用户名</th>
                                        <th>联系电话</th>
                                        <th>证件类型</th>
                                        <th>证件号</th>
                                        <th>注册时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <foreach name="user" item="vo">
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.uid}" name="checkbox[]" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="center">
                                                {pigcms{$vo.name}
                                            </td>
                                            <td class="center">
                                                {pigcms{$vo.phone}
                                            </td>
                                            <td class="center">
                                                <if condition="$vo.card_type eq 1">现场审核</if>
                                                <if condition="$vo.card_type eq 2">门禁卡</if>
                                                <if condition="$vo.card_type eq 3">身份证</if>
                                                <if condition="$vo.card_type eq 4">工作牌</if>
                                            </td>
                                            <td class="center">
                                                {pigcms{$vo.usernum}
                                            </td>
                                            <td class="center">
                                                {pigcms{$vo['add_time']|date='Y-m-d H:i:s',###}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                        <li>
                                                            <a href="{pigcms{:U('user_del',array('company_id'=>$company_id,'group_id'=>$group_id,'uid'=>$vo['uid']))}">
                                                                <i class="icon-docs"></i> 删除 </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </foreach>
                                    </tbody>
                                </table></div>
                            <input type="submit" value="保存" class="ff"/>
                        </form>
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
<script>
    $(function () {
        $('.del').click(function () {
            checkbox=$("input[name='checkbox[]']");
            //alert(checkbox2.length);
            var uid_arr=new Array();
            var group_id='{pigcms{$group_id}';
            var company_id='{pigcms{$company_id}';
            for(var i=0;i<checkbox.length;i++){
                //alert(checkbox2[i].checked);
                if(checkbox[i].checked==true){	//判断是否被选中
                    uid_arr[i]=checkbox[i].value;
                }
            }
            //alert(uid_arr);
            if(uid_arr=="" || uid_arr=="null"){
                alert('请选择用户！');
            }else{
                $.ajax({
                    'url':"{pigcms{:U('all_del')}",
                    'data':{'uid_arr':uid_arr,'group_id':group_id,'company_id':company_id},
                    'type':'POST',
                    'dataType':'JSON',
                    'success':function(msg){
                        //alert(msg.msg);
                        if(msg.msg_code==0){
                            $('.out').html("");
                            $('.out').append(msg.msg_data);
                            //alert(uid_arr.length);
                        }else{
                            alert(msg.msg_data);
                        }
                    },
                    'error':function(){
                        alert('loading error');
                    }
                })
            }
        })
    })
</script>

<!--自定义js代码区结束-->
</body>
<script>
    $(document).ready(function () {
        var url = "{pigcms{:U('recharge_news')}";
        menu_select(url);
    });
</script>
</html>