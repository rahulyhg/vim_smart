<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'团购订单',
    'describe'=>'',
);
$breadcrumb = array(
    array('团购管理','#'),
    array('团购订单','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>

        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </th>
        <th>订单编号</th>
        <th>商家信息</th>
        <th>{pigcms{$config.group_alias_name}信息</th>
        <th>订单信息</th>
        <th>订单用户</th>
        <th>查看用户信息</th>
        <th>订单状态</th>
        <th>时间</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($order_list)">
        <volist name="order_list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.order_id}</td>
                <td>商家ID：{pigcms{$vo.mer_id}　商家电话：{pigcms{$vo.m_phone}<br/>商家名称：{pigcms{$vo.m_name}</td>
                <td>{pigcms{$config.group_alias_name}ID：{pigcms{$vo.group_id}　{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.g_price}<br/>{pigcms{$config.group_alias_name}名称：{pigcms{$vo.s_name}</td>
                <td>数量：{pigcms{$vo.num}<br/>总价：￥{pigcms{$vo.total_money|floatval=###}</td>
                <td>用户名：{pigcms{$vo.nickname}<br/>订单手机号：{pigcms{$vo.group_phone}</td>
                <td>
                    <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/edit',array('uid'=>$vo['uid']))}','编辑用户信息',680,560,true,false,false,editbtn,'edit',true);">查看用户信息</a>
                </td>
                <td>
                    <if condition="$vo['status'] eq 3">
                        <font color="blue">已取消</font>
                        <elseif condition="$vo['paid'] eq 1"/>
                        <if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" >
                            <font color="red">线下支付&nbsp;未付款</font>
                            <elseif condition="$vo['status'] eq 0" />
                            <font color="green">已付款</font>&nbsp;
                            <php>if($vo['tuan_type'] != 2){</php>
                            <font color="red">未消费</font>
                            <php>}else{</php>
                            <font color="red">未发货</font>
                            <php>}</php>
                            <elseif condition="$vo['status'] eq 1"/>
                            <php>if($vo['tuan_type'] != 2){</php>
                            <font color="green">已消费</font>
                            <php>}else{</php>
                            <font color="green">已发货</font>
                            <php>}</php>&nbsp;
                            <font color="red">待评价</font>
                            <else/>
                            <font color="green">已完成</font>
                        </if>
                        <else/>
                        <font color="red">未付款</font>
                    </if>
                </td>
                <td>
                    下单时间：{pigcms{$vo['add_time']|date='Y-m-d H:i:s',###}<br/>
                    <if condition="$vo['paid']">付款时间：{pigcms{$vo['pay_time']|date='Y-m-d H:i:s',###}</if>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/order_edit',array('order_id'=>$vo['order_id']))}','查看订单详情',600,460,true,false,false,false,'order_edit',true);">
                                    <i class="icon-tag"></i> 查看详情
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="12">列表为空！</td></tr>
    </if>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>




