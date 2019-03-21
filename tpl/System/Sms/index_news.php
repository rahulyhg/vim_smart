<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'短信发送记录',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('短信发送记录','#'),
);


?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>编号</th>
        <th>商家名称</th>
        <th>发送到手机</th>
        <th>发送类型</th>
        <th>发送时间</th>
        <th>发送内容</th>
        <th>订单类型</th>
        <th>发送状态</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($record_list)">
        <volist name="record_list" id="vo">
            <tr>
                <td>{pigcms{$vo.pigcms_id}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.phone}</td>
                <td><if condition="$vo['sendto'] eq 'user'">顾客<else />商家</if></td>
                <td>{pigcms{$vo.time|date="Y-m-d H:i:s",###}</td>
                <td>{pigcms{$vo.text}</td>
                <td><if condition="$vo['type'] eq 'food'">订餐<elseif condition="$vo['type'] eq 'takeout'" />外卖<elseif condition="$vo['type'] eq 'group'" />团购</if></td>
                <td><if condition="isset($status[$vo['status']])">{pigcms{$status[$vo['status']]}<else/>{pigcms{$vo.status}</if></td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
    </if>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->



<!--自定义js代码区开始-->

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
