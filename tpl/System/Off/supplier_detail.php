<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{pigcms{$supplier.sup_unit}</h4>
</div>
<div class="modal-body" style="height:60rem;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">供应商详情</span>
            <div style="clear: both"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>单位名称</th>
                    <td>{pigcms{$supplier.sup_unit}</td>
                </tr>
                <tr>
                    <th>联系人</th>
                    <td>{pigcms{$supplier.sup_name}</td>
                </tr>
                <tr>
                    <th>联系电话</th>
                    <td>{pigcms{$supplier.phone}</td>
                </tr>
                <tr>
                    <th>联系地址</th>
                    <td>{pigcms{$supplier.location}</td>
                </tr>
                <tr>
                    <th>经营范围</th>
                    <td>{pigcms{$supplier.bus_name}</td>
                </tr>
                <if condition="$supplier['tax_rate'] neq ''">
                    <tr>
                        <th>税率</th>
                        <td>{pigcms{$supplier.tax_rate}</td>
                    </tr>
                </if>
                <if condition="$supplier['pic_arr'] neq ''">
                <tr>
                    <th>供应商文件</th>
                    <!-- <td><img src="./upload/contract/{pigcms{$supplier.pic}" width="300px" height="300px"/></td> -->
                    <td>
                        <foreach name="supplier['pic_arr']" item="vo">
                            <a href="./upload/contract/{pigcms{$vo}" target="_blank">
                                <span><img src="./upload/contract/{pigcms{$vo}" width="200px" height="200px"/></span>
                            </a>
                        </foreach>
                    </td>
                </tr>
                </if>             
                <tr>
                    <th>合同日期</th>
                    <td>{pigcms{$supplier.supplier_start} 至 {pigcms{$supplier.supplier_end}</td>
                </tr>
                <if condition="$supplier['supplier_time'] neq ''">
                    <tr>
                        <th>合同日期备注</th>
                        <td>{pigcms{$supplier.supplier_time}</td>  
                    </tr>
                </if>
                <if condition="$supplier['operator'] neq ''">
                    <tr>
                        <th>经办人</th>
                        <td>{pigcms{$supplier.operator}</td>
                    </tr>
                </if>
                <if condition="$supplier['add_name'] neq ''">
                <tr>
                    <th>创建人员</th>
                    <td>{pigcms{$supplier.add_name}</td>
                </tr>
                </if>
                <if condition="$supplier['add_time'] neq ''">
                <tr>
                    <th>创建时间</th>
                    <td>{pigcms{$supplier.add_time|date="Y-m-d",###}</td> 
                </tr>
                </if>
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