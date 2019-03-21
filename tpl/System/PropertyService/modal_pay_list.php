<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">其他费用详细</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">已产生的额外费用
                （ <small class="text-danger inline">实际费用在出账后不允许修改</small>
                ）
            </span>
            <button type="button" class="btn btn-primary" style="float: right" id="addPart">添加项目</button>
        </div>
        <input type="hidden" name="id" value="{pigcms{$payListInfo.pigcms_id}"/>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="myTable">
                <tr>
                    <th>收费项目</th>
                    <th>应收费用<small class="text-muted">（元）</small></th>
                    <!--                    <th>上月上报状态</th>-->
                </tr>
                <tr>
                    <th colspan="2" style="color: blue">标准项目</th>
                </tr>
                <tr class="main_price">
                    <td>水费</td>
                    <td data-field="water_price">{pigcms{:sprintf("%.2f", $payListInfo['water_price'])}元</td>
                </tr>
                <tr class="main_price">
                    <td>电费</td>
                    <td data-field="electric_price">{pigcms{:sprintf("%.2f", $payListInfo['electric_price'])}元</td>
                </tr>
                <tr class="main_price">
                    <td>物业费</td>
                    <td data-field="property_price">{pigcms{:sprintf("%.2f", $payListInfo['property_price'])}元</td>
                </tr>
                <if condition="$otherList">
                    <tr>
                        <th colspan="2" style="color: blue">额外项目</th>
                    </tr>
                    <foreach name="otherList" item="vo" key="k">
                        <tr class="auxiliary_price">
                            <td>{pigcms{$k}</td>
                            <td>{pigcms{:sprintf("%.2f", $vo)}元</td>
                        </tr>
                    </foreach>
                </if>
                <tr style="font-weight: bold;">
                    <td><span style="float: left;">总计：</span></td>
                    <td>{pigcms{$total_price}元</td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
    <button type="button" class="btn btn-primary" style="display: none;" id="save" data-usernum = "{pigcms{$payListInfo.pigcms_id}">保存</button>
    <a data-toggle="modal" data-target="#sub_modal" href="{pigcms{:U('PropertyService/choose_template',array('usernum'=>$payListInfo['usernum'],'ym'=>$_GET['ym']?:date('Y-m')))}" class="btn btn-success">出账</a>
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/other-edit.js"></script>
<script>
</script>
