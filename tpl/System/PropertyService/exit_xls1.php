<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'物业缴费',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('物业缴费','#'),
    array('账单预览','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="javascript::void(0)">
                    <button  class="btn sbold green paylist_all">生成账单
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
            <a href="{pigcms{:U('tenant_list_news')}">
                <button  class="btn sbold green">返回
                    <i class="fa fa-plus"></i>
                </button>
            </a>
            </div>
        </div>
        <div style="float:right; margin-right:15px;"><div style="width:100%;">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="village_list" class="col-sm-5 control-label">选择社区：</label>
                    <div class="col-sm-7">
                        <php>$village_id = I('get.village_id',4,'intval')</php>
                        <select class="form-control" id="village_list">
                            <foreach name="village_array" item="row" key="key">
                                <option {pigcms{$key===$village_id?"selected='selected'":""} value="{pigcms{$key}">
                                    {pigcms{$row}
                                </option>
                            </foreach>
                        </select>
                    </div>
                </div>
            </form>
        </div></div><div style="clear:both"></div>
    </div>
    <br>
    <table class="table table-bordered table-hover table-checkable order-column" id="sample_2">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>物业编号</th>
            <th>租户</th>
            <th>缴费明细</th>
            <th class="button-column">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <tr class="odd gradeX" style="background-color: #F3F4F6">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>
                    <div class="tagDiv">{pigcms{$vo.usernum}</div>
                </td>
                <td>
                    <div class="tagDiv">{pigcms{$vo.tenantname}</div>
                </td>
                <td>
                    <div class="tagDiv">
                        水费：{pigcms{:sprintf("%.2f", $vo['water_total_price_true'])}元
                        <a  data-toggle="modal" data-target="#modal_record_meter"
                                href="{pigcms{:U('modal_record_meter',array('meter_type_id'=>1,'tid'=>$vo['ub_id']))}">
                            （{pigcms{$vo.water_meter_count}/{pigcms{$vo.record_water_meter_count}）
                        </a>
                    </div>
                    <div class="tagDiv">
                        电费：{pigcms{:sprintf("%.2f", $vo['electricity_total_price_true'])}元
                        <a  data-toggle="modal" data-target="#modal_record_meter"
                                href="{pigcms{:U('modal_record_meter',array('meter_type_id'=>5,'tid'=>$vo['ub_id']))}">
                            （{pigcms{$vo.electricity_meter_count}/{pigcms{$vo.record_electricity_meter_count}）
                        </a>
                    </div>
                    <div class="tagDiv">物业费：{pigcms{:sprintf("%.2f", $vo['property_total_price'])}元</div>
                    <div class="tagDiv">
                        其他：
                        <a  data-toggle="modal" data-target="#modal_other"
                                            href="{pigcms{:U('edit_other',array('usernum'=>$vo['usernum']))}" id="{pigcms{$vo.usernum}">
                            {pigcms{:sprintf("%.2f", $vo['other_price'])}元
                        </a>
                    </div>
                </td>

                <td class="button-column">
                    <div class="btn-group">
                        <if condition="$vo['is_enter_list'] eq null || $vo['is_enter_list'] eq 0">
                            已出账
                            <else />
                            <if condition="$vo['is_enter']">
                                <button type="button" tid="{pigcms{$vo.ub_id}" class="paylist_one btn btn-default">确认出账</button>
                                <else />
                                未统计完成
                            </if>
                        </if>
                    </div>
                </td>
            </tr>
            <volist name="vo.concat_info" id="rr">
                <tr class="text-muted">
                    <td>
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" value="1" />
                            <span></span>
                        </label>
                    </td>
                    <td>楼层号：{pigcms{$rr.floor}</td>
                    <td>面积：{pigcms{$rr.housesize} ㎡ 丨物业费单价：{pigcms{$rr.property_unit}元</td>
                    <td>联系人：{pigcms{$rr['name']?$rr['name']:$vo['tenant_name']}|{pigcms{$rr['phone']?$rr['phone']:$vo['tenant_phone']}</td>
                    <td></td>
                </tr>
            </volist>
        </volist>

        </tbody>
    </table>
</div>
<div class="modal fade" id="modal_record_meter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="width:1200px" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="modal_other" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="width:1200px" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>
    $("#modal_record_meter").on('hide.bs.modal',function(){
        window.location.reload();
    })
    $('#village_list').change(function(){
        var vid = $(this).val();
        window.location.href = "/admin.php?g=System&c=PropertyService&a=exit_xls&village_id="+vid;
    });
    //导入单个业主账单
    $(document).on('click','.paylist_one',function(){
        var self = this;
        var tid = $(self).attr('tid');
        $.ajax({
            url:'{pigcms{:U("enter_paylist")}',
            type:'get',
            data:{tid:tid},
            dateType:'json',
            success:function(re){
                if(re.err==0){
                    $(self).parents('td').text("已出账");
                    window.location.reload();
                }else{
                    alert("发送错误");
                }
            }
        });
    });


    //导入所有业主账单
    $('.paylist_all').click(function(){
        var village_id = parseInt("{pigcms{:I('get.village_id',4)}")||0;
        var self = this;
        $.ajax({
            url:'{pigcms{:U("enter_paylist")}',
            type:'get',
            dateType:'json',
            data:{tid:'all',village_id:village_id},
            success:function(re){
                if(re.err==0){
                    alert("导入完成");
                    window.location.reload();
                }else{
                    alert("发送错误");
                }
            }
        });
    });



    /*自定义js代码区域*/
    function outUp(){
        var village_id = "{pigcms{$Think.get.village_id}";
        if(village_id!=null){
            window.location.href = "/admin.php?g=System&c=PropertyService&a=complete_all_order&village_id="+village_id;
        }else{
            window.location.href = "{pigcms{:U('complete_all_order')}";
        }

    }
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
        ordering:  false,
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


        "lengthMenu": [
            [-1, 5,15, 20],
            ["All",5, 15, 20] // change per page values here
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
