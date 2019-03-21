<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel"><?php echo ($supplier["sup_unit"]); ?></h4>
</div>
<div class="modal-body" style="height:60rem;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">员工详情</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>项目名称</th>
                    <td><?php echo ($staff_data["village_name"]); ?></td>
                </tr>
                <tr>
                    <th>位置/房间号</th>
                    <td><?php echo ($staff_data["room"]); ?></td>
                </tr>
                <tr>
                    <th>床位数</th>
                    <td><?php echo ($staff_data["bed_number"]); ?></td>
                </tr>
                <tr>
                    <th>部门</th>
                    <td><?php echo ($staff_data["department"]); ?></td>
                </tr>
                <tr>
                    <th>备注</th>
                    <td><?php echo ($staff_data["comment"]); ?></td>
                </tr>
                <tr>
                    <th>员工姓名</th>
                    <td><?php echo ($staff_name["name"]); ?></td>
                </tr>

                <!-- <tr>
                    <th>附件</th>
                    <?php if($contractRecord['pic_info'] == null): ?><td>无</td>
                    <?php else: ?>
                        <td><img src="./upload/adver/<?php echo ($contractRecord["pic_info"]); ?>" width="300px" height="300px"/></td><?php endif; ?>
                </tr> -->

            </table>
        </div>
    </div>
</div>



<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click','.close_sub_modal',function(){
            $("#meter_set").modal('hide');
            $("#meter_qr").modal('hide');
            $("#bind_meter_<?php echo ($tenant_info['pigcms_id']); ?>").modal('hide');

        });
    });

</script>