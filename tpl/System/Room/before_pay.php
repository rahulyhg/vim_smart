<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">全项目支付预览</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">{pigcms{$payListInfo.create_date}月度账单
                （ <small class="text-danger inline">请选择项目进行支付</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="myTable">
                <tr>
                    <th>收费项目</th>
                    <th>实际费用<small class="text-muted">（元）</small></th>
                    <!--                    <th>1上月上报状态</th>-->
                </tr>
                <tr>
                    <th colspan="2" style="color: blue">标准项目</th>
                </tr>
                <tr class="main_price">
                    <td>水费</td>
                    <td data-field="water_price">
                        {pigcms{:sprintf("%.2f", $payListInfo['water_price'])}元
                        <if condition="$payListInfo['total_water'] gt 0">
                            <a  data-toggle="modal" data-target="#sub_modal" style="float: right" class="btn btn-xs yellow-mint btn-outline" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $payListInfo['total_water']),'type'=>'water','pid'=>$payListInfo['pid']))}"><i class="fa fa-rmb"></i>缴费</a>
                        <else/>
                            <button class="btn btn-xs green btn-outline" style="float: right"><i class="fa fa-check"></i>已缴费</button>
                        </if>
                    </td>
                </tr>
                <tr class="main_price">
                    <td>电费</td>
                    <td data-field="electric_price">
                        {pigcms{:sprintf("%.2f", $payListInfo['electric_price'])}元
                        <if condition="$payListInfo['total_electric'] gt 0">
                            <a  data-toggle="modal" data-target="#sub_modal" style="float: right" class="btn btn-xs yellow-mint btn-outline" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $payListInfo['total_electric']),'type'=>'electric','pid'=>$payListInfo['pid']))}"><i class="fa fa-rmb"></i>缴费</a>
                            <else/>
                            <button class="btn btn-xs green btn-outline" style="float: right"><i class="fa fa-check"></i>已缴费</button>
                        </if>
                    </td>
                </tr>
                <tr class="main_price">
                    <td>物业费</td>
                    <td data-field="property_price">
                        {pigcms{:sprintf("%.2f", $payListInfo['property_price'])}元
                        <if condition="$payListInfo['total_property'] gt 0">
                            <a  data-toggle="modal" data-target="#sub_modal" style="float: right" class="btn btn-xs yellow-mint btn-outline" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $payListInfo['total_property']),'type'=>'property','pid'=>$payListInfo['pid']))}"><i class="fa fa-rmb"></i>缴费</a>
                            <else/>
                            <button class="btn btn-xs green btn-outline" style="float: right"><i class="fa fa-check"></i>已缴费</button>
                        </if>
                    </td>
                </tr>
                <tr class="main_price">
                    <td>其他费</td>
                    <td data-field="property_price">
                        {pigcms{:sprintf("%.2f", $payListInfo['other_price'])}元
                        <if condition="$payListInfo['total_other'] gt 0">
                            <a  data-toggle="modal" data-target="#sub_modal" style="float: right" class="btn btn-xs yellow-mint btn-outline" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $payListInfo['total_other']),'type'=>'other','pid'=>$payListInfo['pid']))}"><i class="fa fa-rmb"></i>缴费</a>
                            <else/>
                            <button class="btn btn-xs green btn-outline" style="float: right"><i class="fa fa-check"></i>已缴费</button>
                        </if>
                    </td>
                </tr>
                <tr style="font-weight: bold;">
                    <td><span style="float: left;">总计：</span></td>
                    <td>
                        {pigcms{:sprintf("%.2f", $payListInfo['total_price'])}元
                        <if condition="$payListInfo['total_price_true'] gt 0">
                            <a  data-toggle="modal" data-target="#sub_modal" style="float: right" class="btn btn-xs yellow-mint btn-outline" href="{pigcms{:U('PropertyService/choose_pay_type',array('money'=>sprintf('%.2f', $payListInfo['total_price']),'type'=>'all','pid'=>$payListInfo['pid']))}"><i class="fa fa-rmb"></i>缴费</a>
                            <else/>
                            <button class="btn btn-xs green btn-outline" style="float: right"><i class="fa fa-check"></i>已缴费</button>
                        </if>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
