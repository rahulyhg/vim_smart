<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div class="row">
        <div class="{pigcms{$visitor_data?"col-xs-8":"col-xs-12"}" style="height:400px;overflow: auto">
        <table class="table">
            <tr>
                <th>提交人</th>
                <td>{pigcms{$info.publish_admin_name}</td>
                <th>审核人</th>
                <td>{pigcms{$info.audit_admin_name}</td>
            </tr>
            <tr>
                <th>群发类型</th>
                <td>{pigcms{$info.send_type_name}</td>
                <th>群发人数</th>
                <td>{pigcms{$info.rusers_num}人</td>
            </tr>

            <tr>
                <th>发布时间</th>
                <td {pigcms{$info['update_time']?"":"colspan='3'"}>
                <if condition="$info['send_time']">
                    {pigcms{$info.send_time|date="Y-m-d H:i",###}(定时发送)
                    <else />过审立即发送
                </if>
                </td>
                <if condition="$info['update_time']">
                    <th>审核时间</th>
                    <td>{pigcms{$info.update_time|date="Y-m-d H:i",###}</td>
                </if>
            </tr>
            <tr>
                <th>发布对象</th>
                <td colspan="3">
                    {pigcms{$info['village_name']?$info['village_name']:"所有社区"}
                    {pigcms{$info['company_name']?$info['company_name']:""}
                </td>
            </tr>


            <tr>
                <th>发布内容</th>
                <td colspan="3">
            </tr>
            <tr>
                <td colspan="4" class="container" style="margin:0 auto;">{pigcms{$info.content}</td>
            </tr>

            <tr>
                <td colspan="4">
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
    <div class="{pigcms{$visitor_data?"col-xs-4":""}" style="height:400px;overflow: auto">
    <if condition="$visitor_data">
        <h4>
            已阅用户
        </h4>
        <h4>
            <small class="text-muted"> (访问人次：{pigcms{$visitor_data.total_visitor_num}人</small>
            <small class="text-muted"> 总访问数：{pigcms{$visitor_data.total_visit_times}次)</small>
        </h4>

        <div>
            <foreach name="visitor_data.list" item="row">
                <div class="row">
                    <div class="col-xs-2">
                        <img width="100%" src="{pigcms{$row.avatar}">
                    </div>
                    <div class="col-xs-3">
                        {pigcms{$row.nickname}
                    </div>
                    <div class="col-xs-5">
                        <span>{pigcms{:word_time($row['last_visit_time'])}</span>
                    </div>
                    <div class="col-xs-1">
                        <span class="badge">{pigcms{$row.visit_times}</span>
                    </div>

                </div>
            </foreach>
        </div>
    </if>
    </div>
    </div>
</block>

<block name="modal_footer">
    <input type="hidden" value="{pigcms{$info.msg_id}" name="msg_id">
    <if condition="$info['status'] eq 0">
        <button type="button" class="audit btn btn-success" to_status="1" >审核</button>
        <button type="button" class="audit btn btn-success" to_status="2" >退回修改</button>
        <else />
        <button type="button" class="btn btn-success">{pigcms{$info.status_name}</button>
    </if>
</block>

<block name="modal_script">
    <script>
        $('.audit').click(function(){
            var msg_id = parseInt("{pigcms{$info.msg_id}"),
                to_status = $(this).attr('to_status');
            $.ajax({
                url:"{pigcms{:U('ajax_audit_msg')}",
                data:{msg_id:msg_id,to_status:to_status},
                type:'post',
                dataType:'json',
                success:function(re){
                    alert(re.msg);
                }
            });
        })
    </script>
</block>