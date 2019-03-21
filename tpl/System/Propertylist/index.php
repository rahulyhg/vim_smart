<extend name="./tpl/System/Public_news/base.php" />

<block name="body">
<?php
$title = array(
    'title'=>'费用详情',
    'describe'=>'',
);
$breadcrumb = array(
    array('费用管理','#'),
    array('费用详情','#'),
);

?>
<style type="text/css">
    <!--
    .table-checkable tr>td:first-child, .table-checkable tr>th:first-child {
        text-align: center;
        max-width: 100px;
        min-width: 40px;
        padding-left: 0;
        padding-right: 0;
    }
    -->
</style><div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>费用详情 </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li <if condition="ACTION_NAME eq property">class="active"</if>>
                            <a href="{pigcms{:U('property')}" > 物业费 </a>
                            </li>
                            <li <if condition="ACTION_NAME eq carspace">class="active"</if>>
                            <a href="{pigcms{:U('carspace')}" > 泊位费 </a>
                            </li>
                            <volist name="type_list" id="vo">
                            <li <if condition="$_GET['type_id'] eq $vo['otherfee_type_id']">class="active"</if>>
                            <a href="{pigcms{:U('other',array('type_id'=>$vo['otherfee_type_id']))}" > {pigcms{$vo['otherfee_type_name']} </a>
                            </li>
                            </volist>
                        </ul>

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>费用类型</th>
                                            <th>缴费成功时间</th>
                                            <th>房间信息</th>
                                            <th>应收金额</th>
                                            <th>实收金额</th>
                                            <if condition="ACTION_NAME eq other">
                                                <th>缴费月份</th>
                                                <th>缴费时间</th>
                                                <th>缴费类型</th>
                                               <else/>
                                            <th>缴费业主信息</th>
                                            <th>续费月数</th>
                                            <th>缴费前<if condition="ACTION_NAME eq property">物业费<else/>泊位费</if>时间</th>
                                            <th>缴费后<if condition="ACTION_NAME eq property">物业费<else/>泊位费</if>时间</th>
                                            </if>
                                            <th>订单状态</th>
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <if condition="is_array($list)">
                                            <volist name="list" id="row">
                                                <tr>
                                                    <td><if condition="$row['type'] eq 1">线上支付<elseif condition="$row['type'] eq 2" />现金<elseif condition="$row['type'] eq 3"/>转账<elseif condition="$row['type'] eq 4"/>POS单<elseif condition="$row['type'] eq 5"/>现金缴款单</if></td>
                                                    <if condition="ACTION_NAME eq other">
                                                        <td>{pigcms{:date('Y-m-d H:i:s',$row['creattime'])}</td>
                                                        <else/>
                                                    <td>{pigcms{:date('Y-m-d H:i:s',$row['pay_time'])}</td>
                                                    </if>
                                                    <th>{pigcms{$row.room_name}</th>
                                                    <if condition="ACTION_NAME eq other">
                                                        <td>{pigcms{$row.fee_receive}</td>
                                                        <td>{pigcms{$row.fee_true}</td>
                                                        <td>{pigcms{$row.fee_mouth}</td>
                                                        <td>{pigcms{$row.fee_time}</td>
                                                        <td>{pigcms{$row.otherfee_type_name}</td>
                                                        <else/>
                                                    <td>{pigcms{$row.pay_receive}</td>
                                                    <td>{pigcms{$row.pay_true}</td>
                                                    <td>{pigcms{$row.name}{pigcms{$row.phone}</td>
                                                        <td>{pigcms{$row.mouth}</td>
                                                    <td>{pigcms{:date('Y-n-j',strtotime('+1 day',strtotime($row['last_endtime'])))}</td>
                                                    <td>{pigcms{$row.new_endtime}</td>
                                                    </if>
                                                    <td><if condition="$row['status'] eq 1">已支付<elseif condition="$row['type'] eq 0" />未支付</if></td>
                                                    <td>{pigcms{$row.remark}</td>
                                                </tr>
                                            </volist>

                                            <else/>
                                            <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                                        </if>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
</block>