
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">物品--{pigcms{$proArr.pro_name}</h4>
</div>
<div class="modal-body" >
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">二维码列表</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>编号</th>
                    <th>领取状态</th>
                    <th>责任人</th>
                    <th>二维码</th>
                </tr>
                <foreach name="codeArr" item="vo">
                    <tr>
                        <td>{pigcms{$vo.uni}</td>
                        <td>
                            <if condition="$vo['receive'] eq 1">
                                已领取
                                <else />
                                未领取
                            </if>
                        </td>
                        <td>{pigcms{$vo.borrower}</td>
                        <td><img src="{pigcms{$vo.qr_img}" width="150px" height="150px"/></td>
                    </tr>
                </foreach>
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
            $("#bind_meter_{pigcms{$tenant_info['pigcms_id']}").modal('hide');

        });
    });

</script>