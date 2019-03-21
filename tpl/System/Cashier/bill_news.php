<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

<link href="/Car/Admin/Public/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="/Car/Admin/Public/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
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
                <h1>商家对账
                    <!--<small>用户的任何消费都会被记w录在uy此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">收银管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">商家对账</span>
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
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="javascript:;">
                                            <button id="sample_editable_1_new" class="btn sbold green"> 预留按钮
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <label> &nbsp;每页显示条数
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
                                            <input type="hidden" name="m" value="System">
                                            <input type="hidden" name="c" value="Cashier">
                                            <input type="hidden" name="a" value="bill_news">
                                            <input type="hidden" name="list_rows" value="{pigcms{:I('get.list_rows',10,'int')}">

                                            <div class="input-group">
                                                <div class="row">
                                                    <input type="text" class="form-control col-md-4" name="start_time" placeholder="开始时间" value="{pigcms{:I('get.start_time')}" style="width:48%">
                                                    <input type="text" class="form-control col-md-4" name="end_time" placeholder="结束时间" value="{pigcms{:I('get.end_time')}" style="width:48%">
                                                </div>

                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" type="button">提交</button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </div>
                                    </form>
                                    <!--搜索区域 END-->
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
                                <th>商家</th>
                                <th>名称</th>
                                <th>价格</th>
                                <th>订单号</th>
                                <th>支付方式</th>
                                <th>支付时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$list">
                                <volist name="list" id="vo">
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" value="1" />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>{pigcms{$vo.wxname}</td>
                                        <td>{pigcms{$vo.goods_name}</td>
                                        <td>{pigcms{$vo.goods_price}</td>
                                        <td>{pigcms{$vo.order_id}</td>
                                        <td>{pigcms{$vo.goods_describe}</td>
                                        <td>{pigcms{$vo.paytime|date="Y-m-d H:i",###}</td>

                                    </tr>
                                </volist>
                                <input type="hidden" id="percent" value="{pigcms{$percent}" />
                                <tr class="even">
                                    <td colspan="16" style="text-align: left;padding:10px;">
                                        本页总金额：<strong style="color: green">{pigcms{$page_sum}</strong>
                                        <br>
                                        <if condition="I('get.start_time')">
                                            {pigcms{:I('get.start_time')}~{pigcms{:I('get.end_time')} ：
                                        </if>　
                                        <br>
                                        总金额：<strong style="color: green">{pigcms{$sum}</strong>　
                                        总记录数:<strong style="color: green">{pigcms{$count}</strong>　

                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td colspan="16" id="show_count"></td>
                                </tr>
                                <tr><td class="textcenter pagebar" colspan="16">{pigcms{$page_bar}</td></tr>
                                <else/>
                                <tr class="odd"><td class="textcenter red" colspan="16" >该商家暂时还没有订单。</td></tr>
                            </if>
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
<script src="/Car/Admin/Public/assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">

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
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="http://www.hdhsmart.com/Car/Admin/Public/js/jquery.datetimepicker.full.js"></script>
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
        var url = "{pigcms{pigcms{:U('store_news')}";
        menu_select(url);
    });
</script>
<script type="text/javascript">
    $(function(){
        /*店铺状态*/
        updateStatus(".statusSwitch .ace-switch", ".statusSwitch", "OPEN", "CLOSED", "shopstatus");

        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function updateStatus(dom1, dom2, status1, status2, attribute){
        $(dom1).each(function(){
            if($(this).attr("data-status")==status1){
                $(this).attr("checked",true);
            }else{
                $(this).attr("checked",false);
            }
            $(dom2).show();
        }).click(function(){
            var _this = $(this),
                type = 'open',
                id = $(this).attr("data-id");
            _this.attr("disabled",true);
            if(_this.attr("checked")){	//开启
                type = 'open';
            }else{		//关闭
                type = 'close';
            }
            $.ajax({
                url:"{pigcms{pigcms{:U('Meal/sort_status')}",
                type:"post",
                data:{"type":type,"id":id,"status1":status1,"status2":status2,"attribute":attribute},
                dataType:"text",
                success:function(d){
                    if(d != '1'){		//失败
                        if(type=='open'){
                            _this.attr("checked",false);
                        }else{
                            _this.attr("checked",true);
                        }
                        bootbox.alert("操作失败");
                    }
                    _this.attr("disabled",false);
                }
            });
        });
    }


    //高级搜索必要
    $(function() {
        $("ul.dropdown-menu").on("click", "[data-stopPropagation]", function(e) {
            e.stopPropagation();
        });
    });

    //开启日历插件
    $('input[name="start_time"]').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });

    $('input[name="end_time"]').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });

    $(document).ready(function(){
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
    });


</script>
<!--自定义js代码区结束-->
</body>

</html>