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
                <h1>
                    <!--<small>用户的任何消费都会被记w录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{$Think.config.WEB_DOMAIN}/admin.php?g=System&c=Index&a=index_news">后台首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">智慧助手</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">收银管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">扫码退款</span>
            </li>
        </ul>
        <if condition="$mer_id eq '0'">
            {pigcms{$empty}
            <else/>
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
                                    <input type="radio" name="options" class="toggle" id="option1">回收站</label>
                                <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-6">
                            <label> &nbsp;Show
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
                            <form id="frm" action="">
                                <div class="btn-group pull-right">
                                    <input type="hidden" name="g" value="System">
                                    <input type="hidden" name="c" value="Cashier">
                                    <input type="hidden" name="a" value="refund_money_news">
                                    <input type="hidden" name="list_rows" value="{pigcms{:I('get.list_rows',10,'int')}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="输入微信昵称或手机号码" value="{pigcms{:I('get.keywords','','htmlspecialchars')}" name="keywords">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default">搜索</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--搜索区域 END-->
                        </div>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column">
                            <thead>
                            <tr>
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th>ID</th>
                                <th> 支付人 </th>
                                <th> 支付方式 </th>
                                <th> 支付时间 </th>
                                <th> 支付金额 </th>
                                <th> 操作 </th>
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
                                    <td> {pigcms{$vo.id} </td>
                                    <td> <if condition="$vo.headimgurl neq ''"><img src="{pigcms{$vo.headimgurl}" alt="" width="30" height="30"  style="border-radius:6px;"></if>


                                        <if condition="$vo['nickname']">{pigcms{$vo['nickname']}
                                            <elseif condition="$vo['truename']"/><?php echo htmlspecialchars_decode($vo['truename'],ENT_QUOTES);?>
                                            <else/>匿名用户
                                        </if>
                                         </td>
                                    <td class="center">
                                        <if condition="$vo['pay_way'] eq 'weixin'">微信</if>
                                        <if condition="$vo['pay_way'] eq 'ali'">支付宝</if>
                                        <if condition="$vo['pay_way'] eq 'appPay'">余额付</if>
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.paytime|date='Y-m-d H:i:s',###}
                                    </td>
                                    <td class="center">
                                        {pigcms{$vo.goods_price}元
                                    </td>
                                    <td>
                                        <if condition="$vo['refund'] neq '1' && $vo['refund'] neq '2'">
                                            <button type="button" id="refund" class="btn btn-warning" data_attr1="{pigcms{$vo.id}" data_attr2="{pigcms{$vo.mid}">
                                                退款
                                            </button>
                                        </if>
                                        <if condition="$vo['refund'] eq '2'">
                                            <button class="btn btn-primary" data_attr1="{pigcms{$vo.id}" data_attr2="{pigcms{$vo.mid}">
                                                已退款
                                            </button>
                                        </if>
                                    </td>
                                </tr>
                            </foreach>
                            </tbody>
                            <tfoot>
                            <tr><td colspan="12">{pigcms{$pageStr}</td></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        </if>
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
        //分页页码条数切换
        var list_rows = "{pigcms{:I('get.list_rows')}";
        $('#list_rows option[value="'+list_rows+'"]').attr("selected","selected");
        $('#list_rows').change(function(){
            var new_list_rows = $(this).val();
            var url = window.location.href;
            //先删除原有的list_rows
            url = url.replace(/&list_rows=\d*/i,"");
            url = url.replace(/\/list_rows\/\d*/i,"");
            //搜索表单添加list_rows参数
            window.location.href=url + '&list_rows=' + new_list_rows;
        });
    })
</script>
<script>
    $("#refund").click(function () {
        var id=$(this).attr('data_attr1');
        var mid=$(this).attr('data_attr2');
        console.log(id);
        if(confirm('您确认要给该单退款？')){
            $.ajax({
                url: "{pigcms{$Think.config.WEB_DOMAIN}/Cashier/merchants.php?m=User&c=cashier&a=wxRefund",
                type: "POST",
                dataType: "json",
                data:{ordid:id,mid:mid},
                success: function(res){
                    if(!res.error){
                        swal({
                            title: "退款成功",
                            text: res.msg,
                            type: "success"
                        }, function () {
                            window.location.reload();
                        });

                    }else{
                        swal({
                            title: "退款失败",
                            text: res.msg,
                            type: "error"
                        }, function () {
                            //window.location.reload();
                        });
                    }
                }
            });
        }
    })
</script>

<!--自定义js代码区结束-->
</body>

</html>