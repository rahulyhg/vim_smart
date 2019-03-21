
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{pigcms{$contractRecord.village_name}-{pigcms{$contractRecord.contract_name}</h4>
</div>
<div class="modal-body" style="height:60rem;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">合同详情</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>合同编号</th>
                    <td>{pigcms{$contractRecord.contract_number}</td>
                </tr>
                <tr>
                    <th>合同名称</th>
                    <td>{pigcms{$contractRecord.contract_name}</td>
                </tr>
                <if condition="$contractRecord['company'] neq ''">
                <tr>
                    <th>项目金额</th>
                    <td>{pigcms{$contractRecord.company}</td>
                </tr>
                </if>
                <tr>
                    <th>甲方</th>
                    <td>{pigcms{$contractRecord.first_party}</td>
                </tr>
                <tr>
                    <th>乙方</th>
                    <td>{pigcms{$contractRecord.second_party}</td>
                </tr>
                <if condition="$contractRecord['third_party'] neq ''">
                    <tr>
                        <th>丙方</th>
                        <td>{pigcms{$contractRecord.third_party}</td>
                    </tr>
                </if>
                <if condition="$contractRecord['money'] neq ''">
                <tr>
                    <th>项目金额</th>
                    <td>{pigcms{$contractRecord.money}</td>
                </tr>
                </if>
                <if condition="$contractRecord['area'] neq ''">
                    <tr>
                        <th>项目面积</th>
                        <td>{pigcms{$contractRecord.area}</td>
                    </tr>
                </if>
                <if condition="$contractRecord['remarks'] neq ''">
                    <tr>
                        <th>项目备注</th>
                        <td>{pigcms{$contractRecord.remarks}</td>
                    </tr>
                </if>              
                <tr>
                    <th>合同日期</th>
                    <td>{pigcms{$contractRecord.contract_start} 至 {pigcms{$contractRecord.contract_end}</td>
                </tr>
                <if condition="$contractRecord['contract_time'] neq ''">
                    <tr>
                        <th>合同日期备注</th>
                        <td>{pigcms{$contractRecord.contract_time}</td>  
                    </tr>
                </if>
                <if condition="$contractRecord['operator'] neq ''">
                    <tr>
                        <th>经办人</th>
                        <td>{pigcms{$contractRecord.operator}</td>
                    </tr>
                </if>
                <if condition="$contractRecord['count'] neq ''">
                    <tr>
                        <th>数量</th>
                        <td>{pigcms{$contractRecord.count}</td>
                    </tr>
                </if>
                <if condition="$contractRecord['type'] neq ''">
                <tr>
                    <th>合同类型</th>
                    <td>{pigcms{$contractRecord.type}</td>
                </tr>
                </if>
                <if condition="$contractRecord['number_time'] neq ''">
                <tr>
                    <th>编号日期</th>
                    <td>{pigcms{$contractRecord.number_time}</td>
                </tr>
                </if>
                <if condition="$contractRecord['file_time'] neq ''">
                <tr>
                    <th>存档日期</th>
                    <td>{pigcms{$contractRecord.file_time}</td>
                </tr>
                </if>
                <if condition="$contractRecord['admin_name'] neq ''">
                <tr>
                    <th>创建人员</th>
                    <td>{pigcms{$contractRecord.admin_name}</td>
                </tr>
                </if>
                <if condition="$contractRecord['create_time'] neq ''">
                <tr>
                    <th>创建时间</th>
                    <td>{pigcms{$contractRecord.create_time|date="Y-m-d",###}</td> 
                </tr>
                </if>
                <!-- <tr>
                    <th>合同类型</th>
                    <if condition="$vo['classify'] eq 1">
                        <td>收入</td>
                    <elseif condition="$vo['classify'] eq 2"/>
                        <td>支出</td>
                    <elseif condition="$vo['classify'] eq 3"/>
                        <td>其他</td>
                    <else/>
                        <td> </td>
                    </if>
                </tr> -->
                               
                <!-- <tr>
                    <th>合同状态</th>
                    <if condition="$contractRecord['status'] eq 0">
                        <td>终止合同</td>
                    <else/>
                        <td>正常合同</td>
                    </if>
                </tr> -->
                <!-- <tr>
                    <th>附件</th>
                    <if condition="$contractRecord['pic_info'] eq null">
                        <td>无</td>
                    <else/>
                        <td><img src="./upload/adver/{pigcms{$contractRecord.pic_info}" width="300px" height="300px"/></td>
                    </if>
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
            $("#bind_meter_{pigcms{$tenant_info['pigcms_id']}").modal('hide');

        });
    });

</script>