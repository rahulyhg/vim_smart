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
                    查看店铺订单
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">商户管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">店铺列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">查看店铺订单</span>
            </li>
        </ul>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>订单号</th>
                                    <th>下单人姓名</th>
                                    <th>下单人电话</th>
                                    <th>下单人地址</th>
                                    <th>餐台信息</th>
                                    <th>使用人数</th>
                                    <th>消费类型</th>
                                    <th>下单时间</th>
                                    <th>预计消费（送达）时间</th>
                                    <th>订单总价</th>
                                    <th>优惠</th>
                                    <th>应收</th>
                                    <th>验证消费</th>
                                    <th>支付状态</th>
                                    <th>订单状态</th>
                                    <th>余额支付金额</th>
                                    <th>在线支付金额</th>
                                    <th>使用商户余额</th>
                                    <th>菜单详情</th>
                                    <th>顾客留言</th>
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
                                        <td><div class="tagDiv">{pigcms{$vo.order_id}</div></td>
                                        <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                                        <td><div class="shopNameDiv">{pigcms{$vo.phone}</div></td>
                                        <td>{pigcms{$vo.address}</td>
                                        <td>{pigcms{$vo.tablename}</td>
                                        <td>{pigcms{$vo.num}</td>
                                        <td>
                                            <if condition="$vo['meal_type'] eq 0">预定
                                                <elseif condition="$vo['meal_type'] eq 1" />外卖
                                                <elseif condition="$vo['meal_type'] eq 2" />iPad点餐
                                                <elseif condition="$vo['meal_type'] eq 3" />堂内点餐
                                            </if>
                                        </td>
                                        <td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
                                        <td><if condition="$vo['arrive_time']">{pigcms{$vo.arrive_time|date="Y-m-d H:i:s",###}</if></td>
                                        <td><if condition="$vo['total_price'] gt 0">{pigcms{$vo['total_price']}<else />{pigcms{$vo.price}</if></td>
                                        <td>{pigcms{$vo['minus_price']+$vo['system_pay']}</td>
                                        <td>{pigcms{$vo['total_price'] - $vo['minus_price']-$vo['system_pay']}</td>
                                        <td><if  condition="!empty($vo['last_staff'])">
                                                操作人员：<span class="red">{pigcms{$vo['last_staff']}</span><br/>消费时间：<br/>{pigcms{$vo.use_time|date="Y-m-d H:i",###}
                                                <else/>
                                                <span class="red">未验证消费</span>
                                            </if>
                                        </td>
                                        <td>
                                            <if condition="$vo['paid'] eq 0">未支付
                                                <elseif condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" />
                                                <span class="red">线下支付　未付款</span>
                                                <elseif condition="$vo['paid'] eq 2"/>已付<span class="red">{pigcms{$vo.pay_money}</span>
                                                <elseif condition="$vo['paid'] eq 1"/><span class="green">全额支付</span>
                                            </if>
                                        </td>
                                        <td>
                                            <if condition="$vo['status'] eq 0"><span style="color: red">未使用</span>
                                                <elseif condition="$vo['status'] eq 1" /><span style="color: green">已使用<strong>未评价</strong></span>
                                                <elseif condition="$vo['status'] eq 2" /><span style="color: green">已使用<strong>已评价</strong></span>
                                                <elseif condition="$vo['status'] eq 3" /><span style="color: red">订单已取消</span>
                                            </if>
                                        </td>
                                        <td>{pigcms{$vo.balance_pay}</td>
                                        <td>{pigcms{$vo.payment_money}</td>
                                        <td>{pigcms{$vo.merchant_balance}</td>

                                        <td>
                                            <volist name="vo['info']" id="menu">
                                                {pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
                                            </volist>
<!--                                            <a title="操作订单" class="green handle_btn" style="float:right" href="{pigcms{:U('Meal/order_detial',array('order_id'=>$vo['order_id']))}">-->
<!--                                                <i class="ace-icon fa fa-search bigger-130"></i>-->
<!--                                            </a>-->
                                        </td>
                                        <td>{pigcms{$vo.note}</td>
                                    </tr>
                                </foreach>
                                </tbody>
                                <tfoot>
                                <tr><td colspan="21">{pigcms{$pageStr}</td></tr>
                                </tfoot>
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

</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
    $(function(){
        $('.see_qrcode').click(function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看渠道二维码',
                padding: 0,
                width: 430,
                height: 433,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        var url = "{pigcms{:U('store_news')}";
        menu_select(url);
    });
</script>
<!--自定义js代码区结束-->
</body>

</html>