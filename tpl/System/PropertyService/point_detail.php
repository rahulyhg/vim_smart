
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{pigcms{$pointRecord.room_name}-{pigcms{$pointRecord.orientation}</h4>
</div>
<div class="modal-body" style="height:60rem;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">巡检详情</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>楼层</th>
                    <td>{pigcms{$pointRecord.room_name}</td>
                </tr>
                <tr>
                    <th>方位</th>
                    <td>{pigcms{$pointRecord.orientation}</td>
                </tr>
                <tr>
                    <th>巡检人</th>
                    <td>{pigcms{$pointRecord.name}</td>
                </tr>
                <tr>
                    <th>时间</th>
                    <td>{pigcms{$pointRecord.check_time|date='Y-m-d H:i:s',###}</td>
                </tr>
                <tr>
                    <th>设备是否正常</th>
                    <if condition="$pointRecord['point_status'] eq 0">
                        <td>正常</td>
                    <else/>
                        <td>异常</td>
                    </if>

                </tr>
                <tr>
                    <th>异常图片</th>
                    <if condition="$pointRecord['image'] eq null">
                        <td>无</td>
                    <else/>
                        <td><img src="./upload/adver/{pigcms{$pointRecord.image}" width="300px" height="300px"/></td>
                    </if>

                </tr>
                <tr>
                    <th>描述与分析</th>
                    <td>{pigcms{$pointRecord.point_desc}</td>
                </tr>

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