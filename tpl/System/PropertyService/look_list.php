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
        </div>
        <input type="hidden" name="usernum" value="{pigcms{$Think.get.usernum}"/>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="myTable">
                <tr>
                    <th>收费项目</th>
                    <th>实际费用<small class="text-muted"></small></th>
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

    <hr/>
    <div style="width: 50%;float: left">
        <span style="width:20%;height:20%">水电费催费通知样本</span>
        <a data-toggle="modal" data-target="#third_modal" href="{pigcms{:U('show_this_template',array('usernum'=>$_GET['usernum'],'ym'=>$_GET['ym']?:date('Y-m'),'type'=>1))}">
            <img src="./static/img/images/sdjf.png" title="水电费催费通知样本" width="30%" height="30%"/>
        </a>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div style="width: 50%;float: left;display: none">
        <span style="width:20%;height:20%">物业费催费通知样本</span>
        <a data-toggle="modal" data-target="#third_modal" href="{pigcms{:U('show_this_template',array('usernum'=>$_GET['usernum'],'ym'=>$_GET['ym']?:date('Y-m'),'type'=>0))}">
            <img src="./static/img/images/wyjf.png" title="物业费催费通知样本" width="30%" height="30%"/>
        </a>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success"   data-usernum = "{pigcms{$Think.get.usernum}">已出账</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<if></if>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
