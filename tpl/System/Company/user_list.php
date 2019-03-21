<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Home/Public/statics/plublic/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/css/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -90px;}
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
                <h1>
                    <h1>{pigcms{$merchant_name}</h1><span id="leftmoney">余额{pigcms{$money}</span>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">食堂充值</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{pigcms{:U('index_news')}">商户列表</a>
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
                                        <a href="{pigcms{:U('record',array('company_id'=>$company_id,'mid'=>$mid))}">
                                            <button id="sample_editable_1_new" class="btn sbold green">充值记录
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                        <a href="{pigcms{:U('group',array('company_id'=>$company_id,'mid'=>$mid))}">
                                            <button id="sample_editable_1_new" class="btn sbold green">分组管理
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
                                <th> 编号 </th>
                                <th> 员工姓名 </th>
                                <th>微信昵称</th>
                                <th>联系电话</th>
                                <th>证件类型</th>
                                <th>证件号</th>
                                <th>所属分组</th>
                                <th>注册时间</th>
                                <th>收入（元）</th>
                                <th>支出（元）</th>
                                <th>账户余额（元）</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <foreach name="user_list" item="vo">
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> {pigcms{$vo.uid} </td>
                                    <td class="center">
                                        {pigcms{$vo.name}
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.nickname}
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.phone}
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['card_type'] eq 1">现场审核</if>
                                        <if condition="$vo['card_type'] eq 2">门禁卡</if>
                                        <if condition="$vo['card_type'] eq 3">身份证</if>
                                        <if condition="$vo['card_type'] eq 4">工作牌</if>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo['usernum']}
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['group_name']">{pigcms{$vo['group_name']}<else/>无</if>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo['add_time']|date='Y-m-d H:i:s',###}
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['in_money']">{pigcms{$vo['in_money']}<else/>0.00</if>
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['out_money']">{pigcms{$vo['out_money']}<else/>0.00</if>
                                    </td>
                                    <td class="center">
                                        <if condition="$vo['money']">{pigcms{$vo['money']}<else/>0.00</if>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('recharge',array('company_id'=>$vo['company_id'],'mid'=>$mid,'uid'=>$vo['uid']))}">
                                                        <i class="icon-docs"></i> 充值 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('user_edit',array('company_id'=>$vo['company_id'],'mid'=>$mid,'uid'=>$vo['uid']))}">
                                                        <i class="icon-docs"></i> 编辑 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('detail',array('company_id'=>$vo['company_id'],'mid'=>$mid,'uid'=>$vo['uid']))}">
                                                        <i class="icon-docs"></i> 明细 </a>
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
            "emptyTable": "表中没有可用数据",
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
<script>
    $(function(){
        var data='{pigcms{:json_encode($data)}';
        var mid='{pigcms{$mid}';
        var company_id='{pigcms{$company_id}';
        var dataObj = JSON.parse(data);
        var result = '{pigcms{$result}';
        console.log(dataObj);
        if(dataObj!=null){
            if(result==='success' && dataObj.OrderStatus==='0000' && dataObj.mid===mid){
                swal("充值成功！","充值金额"+dataObj.OrderAmt/100+'元',"success");

            }else{
                //swal("充值失败！，请重新充值！","error");
                swal({
                    title: '充值失败',
                    text:'请重新充值',
                   // timer: 1000,
                    showConfirmButton: true,
                    type:'error'
                });
            }
            dataObj.company_id=company_id;//将company_id赋值到res对象
            $.ajax({
                url:"{pigcms{:U('chinaPay_after')}",
                dataType:'json',
                type:'post',
                data:dataObj,
                success:function(e){
                    $("#leftmoney").text(e);
                }
            });
        }

    })
</script>

<!--自定义js代码区结束-->
</body>

</html>