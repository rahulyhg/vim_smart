
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">详情</h4>
</div>
<div class="modal-body" style="height:600px;overflow-y: scroll">
    <table class="table">
        <tr>
            <th>提交人</th>
            <td>{pigcms{$info.publish_admin}</td>
        </tr>
        <tr>
            <th>群发类型</th>
            <td>{pigcms{$info.send_type_name}</td>
        </tr>

        <tr>
            <th>发布时间</th>
            <td>
                <if condition="$info['send_time']">
                    {pigcms{$info.send_time|date="Y-m-d H:i",###}(定时发送)
                    <else />过审立即发送
                </if>
            </td>
        </tr>
        <tr>
            <th>发布对象</th>
            <td>
                {pigcms{$info['village_name']?$info['village_name']:"所有社区"}
                {pigcms{$info['company_name']?$info['company_name']:""}
                （共{pigcms{$info.count_users}人）
            </td>
        </tr>
        <tr>
            <th>发布内容</th>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" class="container" style="margin:0 auto;">{pigcms{$info.content}</td>
        </tr>

        <tr>
            <td colspan="2">
                <if condition="$can_audit">
                    <textarea name="remark" style="width:100%" rows="10" placeholder=" 退回修改意见"></textarea>
                    <else />
                    <if condition="$status_remark">
                        修改意见：<p style="padding:15px;">{pigcms{$status_remark}</p>
                    </if>

                </if>
            </td>
        </tr>

    </table>
</div>

<div class="modal-footer">
    <input type="hidden" value="{pigcms{$info.id}" name="msg_id">
    <if condition="$can_audit">
        <button  type="button" class="btn btn-success" id="audit_1">确认并发布</button>
        <button  type="button" class="btn btn-warning"  id="audit_2">退回修改</button>
        <else />
        <button type="button" class="btn {pigcms{$status_class}">{pigcms{$status_name}</button>
        &nbsp;
    </if>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script>
    function audit(msg_id,chang_to_status,remark){
        $.ajax({
            url:"{pigcms{:U('audit_group_msg_act')}",
            data:{msg_id:msg_id,status:chang_to_status,remark:remark},
            datType:'json',
            success:function(re){
                if(re.err===0){
                    alert(re.msg);
                    window.reload();
                }else{
                    alert(re.msg);
                }
            }
        });
    };

    $('#audit_1').click(function(){
        var msg_id = $('input[name="msg_id"]').val();
        var status = 1;
        var remark = $('textarea[name="remark"]').val();
        audit(msg_id,status,remark);
    });

    $('#audit_2').click(function(){
        var msg_id = $('input[name="msg_id"]').val();
        var status = 2;
        var remark = $('textarea[name="remark"]').val();
        audit(msg_id,status,remark);
    });


</script>