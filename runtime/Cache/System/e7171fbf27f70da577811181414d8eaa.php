<?php if (!defined('THINK_PATH')) exit();?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo ($modal_title); ?></h4>
</div>
<div class="modal-body" style="height: 45rem;overflow-y: scroll">
  
    <div class="row">
        <div class="<?php echo ($visitor_data?"col-xs-8":"col-xs-12"); ?>" style="height:400px;overflow: auto">
        <table class="table">
            <tr>
                <th>提交人</th>
                <td><?php echo ($info["publish_admin_name"]); ?></td>
                <th>审核人</th>
                <td><?php echo ($info["audit_admin_name"]); ?></td>
            </tr>
            <tr>
                <th>群发类型</th>
                <td><?php echo ($info["send_type_name"]); ?></td>
                <th>群发人数</th>
                <td><?php echo ($info["rusers_num"]); ?>人</td>
            </tr>

            <tr>
                <th>发布时间</th>
                <td <?php echo ($info['update_time']?"":"colspan='3'"); ?>>
                <?php if($info['send_time']): echo (date("Y-m-d H:i",$info["send_time"])); ?>(定时发送)
                    <?php else: ?>过审立即发送<?php endif; ?>
                </td>
                <?php if($info['update_time']): ?><th>审核时间</th>
                    <td><?php echo (date("Y-m-d H:i",$info["update_time"])); ?></td><?php endif; ?>
            </tr>
            <tr>
                <th>发布对象</th>
                <td colspan="3">
                    <?php echo ($info['village_name']?$info['village_name']:"所有社区"); ?>
                    <?php echo ($info['company_name']?$info['company_name']:""); ?>
                </td>
            </tr>


            <tr>
                <th>发布内容</th>
                <td colspan="3">
            </tr>
            <tr>
                <td colspan="4" class="container" style="margin:0 auto;"><?php echo ($info["content"]); ?></td>
            </tr>

            <tr>
                <td colspan="4">
                    <?php if($can_audit): ?><textarea name="remark" style="width:100%" rows="10" placeholder=" 退回修改意见"></textarea>
                        <?php else: ?>
                        <?php if($status_remark): ?>修改意见：<p style="padding:15px;"><?php echo ($status_remark); ?></p><?php endif; endif; ?>
                </td>
            </tr>

        </table>
    </div>
    <div class="<?php echo ($visitor_data?"col-xs-4":""); ?>" style="height:400px;overflow: auto">
    <?php if($visitor_data): ?><h4>
            已阅用户
        </h4>
        <h4>
            <small class="text-muted"> (访问人次：<?php echo ($visitor_data["total_visitor_num"]); ?>人</small>
            <small class="text-muted"> 总访问数：<?php echo ($visitor_data["total_visit_times"]); ?>次)</small>
        </h4>

        <div>
            <?php if(is_array($visitor_data["list"])): foreach($visitor_data["list"] as $key=>$row): ?><div class="row">
                    <div class="col-xs-2">
                        <img width="100%" src="<?php echo ($row["avatar"]); ?>">
                    </div>
                    <div class="col-xs-3">
                        <?php echo ($row["nickname"]); ?>
                    </div>
                    <div class="col-xs-5">
                        <span><?php echo word_time($row['last_visit_time']);?></span>
                    </div>
                    <div class="col-xs-1">
                        <span class="badge"><?php echo ($row["visit_times"]); ?></span>
                    </div>

                </div><?php endforeach; endif; ?>
        </div><?php endif; ?>
    </div>
    </div>

</div>
<div class="modal-footer">
    
    <input type="hidden" value="<?php echo ($info["msg_id"]); ?>" name="msg_id">
    <?php if($info['status'] == 0): ?><button type="button" class="audit btn btn-success" to_status="1" >审核</button>
        <button type="button" class="audit btn btn-success" to_status="2" >退回修改</button>
        <?php else: ?>
        <button type="button" class="btn btn-success"><?php echo ($info["status_name"]); ?></button><?php endif; ?>

    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<!--<script src="./static/js/vue.min.js"></script>-->
<!--<script src="./static/js/vue-route.js"></script>-->
<!--<script src="./static/js/vue-resource.min.js"></script>-->

    <script>
        $('.audit').click(function(){
            var msg_id = parseInt("<?php echo ($info["msg_id"]); ?>"),
                to_status = $(this).attr('to_status');
            $.ajax({
                url:"<?php echo U('ajax_audit_msg');?>",
                data:{msg_id:msg_id,to_status:to_status},
                type:'post',
                dataType:'json',
                success:function(re){
                    alert(re.msg);
                }
            });
        })
    </script>