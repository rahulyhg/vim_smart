<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">包裹详细</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">{pigcms{$info.company_name}的包裹
                （ <small class="text-danger inline">运单号：{pigcms{$info.waybill_number}</small>
                ）
            </span>
        </div>
        <input type="hidden" name="usernum" value="{pigcms{$Think.get.usernum}"/>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="myTable">
                <tr>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>提货码</th>
                    <th>到站时间</th>
                    <th>出库时间</th>
                    <th>操作人</th>
                </tr>
                <tr class="main_price">
                    <td>{pigcms{$info.name}</td>
                    <td>{pigcms{$info.phone}</td>
                    <td>{pigcms{$info.receipt_code}</td>
                    <td>{pigcms{$info.in_package_time|date='Y-m-d H:i:s',###}</td>
                    <td>{pigcms{$info.out_package_time|date='Y-m-d H:i:s',###}</td>
                    <td>{pigcms{$info.realname}</td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<if></if>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
