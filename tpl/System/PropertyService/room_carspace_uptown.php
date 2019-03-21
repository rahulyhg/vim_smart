<extend name="./tpl/System/Public_news/base.php"/>
<block name="table-toolbar-left">
        <div class="btn-group">
            <a href="{pigcms{:U('room_carspace_uptown_updata',array('id'=>$thisRoom['id']))}">
                <button id="sample_editable_1_new" class="btn sbold green">添加新车位
                    <i class="fa fa-plus"></i>
                </button>
            </a>
        </div>

    <br/>
    <br/>



</block>
<!--引入日历插件样式 -->
<block name="body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>车位号</th>
            <th>车牌</th>
            <th>泊位费单价</th>
            <th>泊位费开始时间</th>
            <th>泊位费到期时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="carspace_list" id="row">
            <tr>
                <td>{pigcms{$row.carspace_number}</td>
                <td>{pigcms{$row.car_number}</td>
                <td>{pigcms{$row.carspace_price}</td>
                <td>{pigcms{:date('Y年m月d日',strtotime($row['carspace_start']))}</td>
                <td>{pigcms{:date('Y年m月d日',strtotime($row['carspace_end']))}</td>
                <td>
                    <div class="btn-group">
                        <a href="{pigcms{:U('room_carspace_uptown_updata',array('id'=>$thisRoom['id'],'carspace_id'=>$row['pigcms_id'],'edit'=>1))}">
                            <button id="sample_editable_1_new" class="btn sbold green">车位信息修改
                            </button>
                        </a>
                        <!--<a href="{pigcms{:U('room_carspace_uptown_updata',array('id'=>$thisRoom['id'],'carspace_id'=>$row['pigcms_id']))}">
                            <button id="sample_editable_1_new" class="btn sbold green">线下缴纳泊位费
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>-->
                        <a href="javascript:;">
                            <button id="sample_editable_1_new" class="btn sbold green" onclick="delete_one({pigcms{$row['pigcms_id']})">删除该车位
                            </button>
                        </a>

                    </div>
                </td>
            </tr>
        </volist>
        </tbody>
    </table>
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>缴费类型</th>
            <th>缴费业主信息</th>
            <th>操作员信息</th>
            <th>停车位编号</th>
            <th>续费月数</th>
            <th>应收金额</th>
            <th>实收金额</th>
            <th>缴费前泊位费时间</th>
            <th>缴费后泊位费时间</th>
            <th>订单状态</th>
            <th>缴费成功时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <volist name="property_list" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.type_str}</td>
                <td>{pigcms{$row.user_name}{pigcms{$row.user_phone}</td>
                <td>{pigcms{$row.admin_name}</td>
                <td>{pigcms{$row.carspace_number}</td>
                <td>{pigcms{$row.mouth}</td>
                <td>{pigcms{$row.pay_receive}</td>
                <td>{pigcms{$row.pay_true}</td>
                <td>{pigcms{$row.last_endtime_str}</td>
                <td>{pigcms{$row.new_endtime_str}</td>
                <td>{pigcms{$row.status_str}</td>
                <td>{pigcms{$row.pay_time_str}</td>
                <td>{pigcms{$row.remark}</td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>

<block name="script">
    <!--    设备类型模板-->
    <script>
        function delete_one(id) {
            var carspace_id=id;
            swal({
                    title: "是否删除该车位？",
                    text: "请确认",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "确定",
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    closeOnConfirm: true
                },
                function(){
                    $.ajax({
                        url:'{pigcms{:U("PropertyService/ajax_delete_carspace")}',
                        data:{"carspace_id":carspace_id},
                        type:'POST',
                        dataType:'json',
                        success:function (res) {
                            if(res.status==1){
                                swal("删除成功", "成功", "success");
                                window.location.reload();
                            }else{
                                swal("删除失败", res.info, "error");
                            }
                        }
                    })
                });
        }
    </script>
</block>
