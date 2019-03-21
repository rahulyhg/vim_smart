<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'抄表管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('抄表管理','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>

<style>
</style>

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
<!--        楼层号、单位名称、上报人、上报时间、止码、用量、类型、费用-->
        <th>ID</th>
        <th>设备编号</th>
        <th>设备类型</th>
        <th>楼层</th>
        <th>上报人</th>
        <th>上报时间</th>
        <th>止码</th>
        <th>用量</th>
        <th>费用</th>
    </tr>
    </thead>
    <tbody>
        <volist name="list" id="row">
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
            <td>{pigcms{$row.id}</td>
            <td>{pigcms{$row.meter_code}</td>
            <td>{pigcms{$row.meter_type_name}</td>
            <td>{pigcms{$row.meter_floor}</td>
            <td>{pigcms{$row.realname}</td>
            <td>{pigcms{$row.create_time|date="Y-m-d H:i:s",###}</td>
                <td>{pigcms{$row['total_consume']} {pigcms{$row['unit']} </td>
            <td>{pigcms{$row['total_consume']-$row['last_total_consume']} {pigcms{$row['unit']}</td>
            <td>{pigcms{$row.price} 元</td>

<!--            <td>{pigcms{$row.price_type_name}</td>-->
            </tr>
    </volist>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>

</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>