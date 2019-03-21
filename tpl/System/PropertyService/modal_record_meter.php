<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">抄表详细-{pigcms{$is_enter_paylist?"已出账":"未出账"}</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">已录入设备
                （ <small class="text-danger inline">实际费用在出账后不允许修改</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>楼层号</th>
                    <th>设备类型</th>
                    <th>设备编号</th>
                    <th>上月止码</th>
                    <th>当前止码</th>
                    <th>计费类型</th>
                    <th>倍率</th>
                    <th>比例</th>
                    <th>用量</th>
                    <th>参考费用</th>
                    <th>实际费用
<!--                        $is_enter_paylist-->

                            <small class="text-muted">（点击修改）</small>
                    </th>
                    <!--                    <th>上月上报状态</th>-->
                </tr>
                <if condition="$ard">
                    <volist name="ard" id="row">
                        <tr>
                            <td>{pigcms{$row.meter_floor}</td>
                            <td>{pigcms{$row.meter_type_desc}</td>
                            <td>{pigcms{$row.meter_code}</td>
                            <td>{pigcms{$row['last_total_consume']}</td>
                            <td>{pigcms{$row['total_consume']}</td>
                            <td>{pigcms{$row.price_type_desc}</td>
                            <td>{pigcms{:intval($row['rate'])}</td>
                            <td>
                                <php>$tid = I('get.tid');</php>
                                {pigcms{$row['tsacles'][$tid]}
                            </td>
                            <td>{pigcms{$row.cousume} {pigcms{:explode('/',$row['unit'])[1]}</td>
                            <td class="text-info">{pigcms{:sprintf("%.2f", $row['price'])}元</td>
                            <td class="text-info" style="width:145px">
                                <span style="cursor: pointer" cid="{pigcms{$row.cid}" is_enter_paylist="{pigcms{$is_enter_paylist}"  class="admin_defined_price">
                                    {pigcms{:sprintf("%.2f", $row['true_price'])}
                                </span>
                                <span>元</span>
                            </td>
                        </tr>
                    </volist>
                    <tr style="font-weight: bold;">
                        <td colspan="8"><span style="float: right;">总计：</span></td>
                        <td>{pigcms{$ard_total.cousume} {pigcms{:explode('/',$ard[0]['unit'])[1]}</td>
                        <td class="text-info">{pigcms{:sprintf("%.2f", $ard_total['price'])}元</td>
                        <td class="text-info" style="width:145px">
                            <span style="cursor: pointer" class="ard_total_price">
                                {pigcms{:sprintf("%.2f", $ard_total['true_price'])}
                            </span>
                            <span>元</span>
                        </td>
                    </tr>
                    <else />
                    <tr><td colspan="11">暂无数据</td></tr>
                </if>

            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">未录入设备</span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>楼层号</th>
                    <th>设备类型</th>
                    <th>设备编号</th>
                    <th>上月止码</th>
                    <th>计费类型</th>
                    <th>倍率</th>
                    <th>比例</th>
                    <!--                    <th>上月上报状态</th>-->
                </tr>
                <if condition="$nrd">
                    <volist name="nrd" id="row">
                        <tr>
                            <td>{pigcms{$row.meter_floor}</td>
                            <td>{pigcms{$row.meter_type_desc}</td>
                            <td>{pigcms{$row.meter_code}</td>
                            <td>{pigcms{$row.newest_cousume}</td>
                            <td>{pigcms{$row.price_type_desc}</td>
                            <td>{pigcms{:intval($row['rate'])}</td>
                            <td>
                                <php>$tid = I('get.tid');</php>
                                {pigcms{$row['tsacles'][$tid]}
                            </td>
                        </tr>
                    </volist>

                    <else />
                    <tr><td colspan="7">暂无数据</td></tr>
                </if>

            </table>
        </div>
    </div>
</div>
<div class="modal-footer">

    <if condition="empty($is_enter_paylist) and $is_enter">
        <button type="button" class="btn btn-primary paylist_one" tid="{pigcms{$tid}">确认出账</button>
    </if>
    <if condition="empty($is_enter)">
        <button type="button" class="btn btn-primary"  disabled="disabled">未统计完成</button>
    </if>
    <if condition="!empty($is_enter_paylist)">
        <button type="button" class="btn btn-primary" disabled="disabled">已出账</button>
    </if>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<if></if>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
/**设置真实价格**/
var is_enter_paylist = "{pigcms{$is_enter_paylist}"||0;
//出账前实际金额才能进行修改

$('.admin_defined_price').bind('click',admin_edit);

var meter_type_id = parseInt("{pigcms{:I('meter_type_id')}")||0;
function admin_edit() {
    var _this = this;
    var usernum = $(this).attr("is_enter_paylist")||"";
    var cid = $(this).attr("cid");
    var old_text = $(this).text()||"0.00";
    var input = $('<input type="number" style="width:80px" value="'+old_text+'">');
    $(this).html(input);
    input.focus().select();
    $(this).unbind('click');
    //移除焦点后重新绑定点击事件
    input.blur(function(){
        var val = input.val();
        var re = save_admin_edit(cid,val);
        if(re){
            $(_this).html(input.val()||"0.00");
        }else{
            $(_this).html(old_text);
        }
        //统计数据
        var sum = 0.00;
        $('.admin_defined_price').each(function(){
            sum += parseFloat($(this).text());
        });
        if(usernum){
            var re2 = edit_paylist_price(usernum,sum);
        }



        $('.ard_total_price').text(sum.toFixed(2));
        $(_this).bind('click',admin_edit);
    });

};


function save_admin_edit(cid,val){
    var flag = false;
    $.ajax({
        url:"{pigcms{:U('admin_defined_price')}",
        data:{cid:cid,val:val},
        dataType:'json',
        async:false,
        success:function(re){
            if(re.err===0){
                flag = true;
            }else{
                flag = false;
                alert(re.data);
            }
        }
    });
    return flag;
}

function edit_paylist_price(usernum,val){
    var flag = false;
    $.ajax({
        url:"{pigcms{:U('edit_paylist_price')}",
        data:{usernum:usernum,val:val,meter_type_id:meter_type_id},
        dataType:'json',
        async:false,
        success:function(re){
            if(re.err===0){
                flag = true;
            }else{
                flag = false;
                alert(re.data);
            }
        }
    });
    return flag;
}
</script>
