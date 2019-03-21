<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css"/>
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
      rel="stylesheet" type="text/css"/>
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet"
      type="text/css"/>
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>
<style type="text/css">
    .label-kid {
        background-color: #f36a5a;
    }

    .btn-group > .dropdown-menu, .dropdown-toggle > .dropdown-menu, .dropdown > .dropdown-menu {
        margin-top: 10px;
    }

    .dropdown-menu {
        margin: 0 0 0 -172px;
    }
</style>
<!--头部设置-->
<?php
$title = array(
    'title' => '物业缴费',
    'describe' => '',
);
$breadcrumb = array(
    array('物业服务', '#'),
    array('物业缴费', '#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">

    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/import_tenant')}">
                    <button id="sample_editable_1_new" class="btn sbold green">导入业主
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <!--<div class="btn-group">
                <a href="{pigcms{:U('PropertyService/add_property_order')}">
                    <button id="sample_editable_1_new" class="btn sbold green">手动添加业主
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>-->
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/detail_import')}">
                    <button id="sample_editable_1_new" class="btn sbold green">导入业主每月帐单明细
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/exit_xls')}">
                    <button id="sample_editable_1_new" class="btn sbold green">本月账单预览
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>

        </div>
        <div class="col-md-3 col-sm-offset-3">

        </div>
    </div>
    <br/>
    <!--<for start="1" end="13">
        <a href="{pigcms{:U('village_order_list',array('month'=>$i))}">
        <button class="btn  btn-sm <php>if(empty($_GET['month'])&&$i==date('m')){echo 'blue';}else if($_GET['month']==$i){echo 'blue';}else{echo 'default';}</php>" type="button">
            2017-{pigcms{$i}月
        </button>
        </a>
    </for>-->

    <!--id="sample_1"-->
    <table class="table table-bordered table-hover" id="sample_2">

        <thead>

        <tr>
                <th>入驻状态</th>
                <th>入驻单位</th>
                <th>业主</th>
                <th>总面积</th>
                <th style="width:15%">缴费状态</th>
                <th class="button-column">操作</th>
            </tr>

        </thead>

        <tbody>


        <if condition="$list">
            <volist name="list" id="vo">
                <tr style="background-color: #F3F4F6">
                    <td>
                        <div class="tagDiv">{pigcms{$fstatus_list[$vo['concat_info'][0]['fstatus']]}</div>
                    </td>
                    <td>
                        <div class="tagDiv">{pigcms{$vo.tenantname}</div>
                    </td>
                    <td>
                        <div class="tagDiv">{pigcms{$vo.ownernames}</div>
                    </td>

                    <td>
                        <div class="tagDiv">{pigcms{$vo.total_housesize} ㎡ </div>
                    </td>
<!--                    rowspan="{pigcms{:count($vo['concat_info'])+1}"-->
                    <td>
                        <div class="shopNameDiv">
                            <if condition="$vo['is_enter_paylist']">
                                <div class="tagDiv">
                                    水费：{pigcms{:sprintf("%.2f", $vo['water_price'])}元
                                    <if condition="$vo['water_price'] neq 0">
                                        <a  data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $vo['water_price']),'type'=>'water','pid'=>$vo['pid']))}">缴费</a></if><div style="clear:both"></div></div></div>
                                <div class="tagDiv">
                                    电费：{pigcms{:sprintf("%.2f", $vo['electric_price'])}元
                                    <if condition="$vo['electric_price'] neq 0">
                                        <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $vo['electric_price']),'type'=>'electric','pid'=>$vo['pid']))}">缴费</a></if><div style="clear:both"></div></div></div>
                                <div class="tagDiv">
                                    物业费：{pigcms{:sprintf("%.2f", $vo['property_price'])}元
                                    <if condition="$vo['property_price'] neq 0">
                                        <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $vo['property_price']),'type'=>'property','pid'=>$vo['pid']))}">缴费</a></if><div style="clear:both"></div></div></div>
                                <else />
                                未出账
                            </if>
                        </div>
                    </td>
                    <td class="button-column">
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false"> 操作
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu" style="position: absolute; margin-left:-90px;">
                                <li>
                                    <a href="{pigcms{:U('order_history',array('bind_id'=>$vo['pigcms_id']))}">
                                        <i class="icon-docs"></i> 缴费明细 </a>
                                </li>
                                <li>
                                    <a href="{pigcms{:U('modal_bind_meter_list',array('tid'=>$vo['tid']))}"
                                       data-toggle="modal"
                                       data-target="#modal_{pigcms{$vo.usernum}">
                                        <i class="icon-docs"></i> 水电表管理 </a>

                                </li>
                                <if condition="$vo['more'] eq 1">
                                    <li>
                                        <a class="handle_btn" title="抄表二维码"
                                           href="{pigcms{:U('list_for_more',array('usernum'=>$vo['usernum']))}">
                                            <i class="icon-docs"></i> 更多 </a>
                                    </li>
                                </if>
                            </ul>
                        </div>

                    </td>
        <!--        弹出层容器-->
                <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" role="dialog" id="sub_modal">
                    <div class="modal-dialog modal-lg" role="document" style="width:1000px">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
        <!--        弹出层容器-->
        </tr>
            <volist name="vo.concat_info" id="rr">
                <tr class="text-muted" >
                    <td>楼层号：{pigcms{$rr.floor}</td>
                    <td>面积：{pigcms{$rr.housesize} ㎡ </td>
                    <td>物业费单价：{pigcms{$rr.property_unit}元</td>
                    <td>{pigcms{$rr['name']?$rr['name']:$vo['tenant_name']}</td>
                    <td>{pigcms{$rr['phone']?$rr['phone']:$vo['tenant_phone']}</td>
                    <td></td>
                    <!--                <td><button class="btn blue btn-sm">绑定设备</button></td>-->
                </tr>
            </volist>

        </volist>

        <else/>
        <tr class="odd">
            <td class="button-column" colspan="12">没有任何业主。</td>
        </tr>
        </if>

        </tbody>


    </table>


</div>

<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
    //高级搜索必要
    $(function() {
        $("ul.dropdown-menu").on("click", "[data-stopPropagation]", function(e) {
            e.stopPropagation();
        });
    });


    //隐藏
    $('.summary').hide();

    $(function () {
        $('.handle_btn').on('click', function () {
            art.dialog.open($(this).attr('href'), {
                init: function () {
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle', iframe);
                },
                id: 'handle',
                title: '二维码',
                padding: 0,
                width: 820,
                height: 520,
                lock: true,
                resize: false,
                background: 'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity: '0.4'
            });
            return false;
        });

        $("input[name='keyWord']").change(function () {
            $("#myForm").submit();
        });
    });
</script>
<script>
    //表格显示控制js代码区
    var table = $('#sample_2');
    table.dataTable({
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
        ordering:  false,
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [-1, 5,15, 20],
            ["全部",5, 15, 20] // change per page values here
        ],
        // set the initial value
        "pageLength": -1,
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
        ]
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
<include file="Public_news:footer"/>
