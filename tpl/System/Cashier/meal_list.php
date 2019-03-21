<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
                    商户管理
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
                <span class="active">商品管理</span>
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
                                        <a href="{pigcms{:U('meal_add',array('sort_id'=>$now_sort['sort_id']))}">
                                            <button id="sample_editable_1_new" class="btn sbold green"> 添加商品
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
                                <th width="50">编号</th>
                                <th width="50">排序</th>
                                <th width="50">商品名称</th>
                                <if condition="$now_store['store_type'] eq 3">
                                    <th width="150">链接</th>
                                </if>
                                <th width="100">价格</th>
                                <th class="button-column" style="width:100px;">单位</th>
                                <th width="80">销售量</th>
                                <th class="button-column" style="width:180px;">最后操作时间</th>
                                <th width="100" class="button-column">状态</th>
                                <th width="100" class="button-column">是否外卖</th>
                                <th width="100" class="button-column">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <foreach name="meal_list" item="vo">
                                <tr>
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{pigcms{$vo.meal_id}</td>
                                    <td>{pigcms{$vo.sort}</td>
                                    <td>{pigcms{$vo.name}</td>

                                    <if condition="$now_store['store_type'] eq 3">
                                        <td><a href="{pigcms{$vo.link}">{pigcms{$vo.link}</a></td>
                                    </if>
                                    <td>{pigcms{$vo.price}</td>
                                    <td class="button-column">{pigcms{$vo.unit}</td>
                                    <!--td>{pigcms{$vo.label}</td-->
                                    <td>{pigcms{$vo.sell_count}</td>
                                    <td class="button-column">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}</td>
                                    <td class="button-column">
                                        <input  type="checkbox"  class="make-switch" <if condition="$vo['status'] eq 1">checked</if>>
                                    </td>
                                    <td class="button-column">
                                        <input  type="checkbox"  class="make-switch" <if condition="$vo['waimai_status'] eq 1">checked</if>>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                                <li>
                                                    <a href="{pigcms{:U('meal_edit',array('meal_id'=>$vo['meal_id']))}">
                                                        <i class="icon-docs"></i> 修改 </a>
                                                </li>
                                                <li>
                                                    <a href="{pigcms{:U('meal_del',array('meal_id'=>$vo['meal_id']))}">
                                                        <i class="icon-docs"></i> 删除 </a>
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
<script src="/Car/Admin/Public/assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
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
                url:"{pigcms{:U('Meal/sort_status')}",
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
</script>
<!--自定义js代码区结束-->
</body>

</html>