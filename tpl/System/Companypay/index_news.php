<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'付款管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('付款管理','#'),
);

$add_action = array(
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

    <thead>

    <tr>

        <th>编号</th>

        <th>付费类型</th>

        <th>商家id</th>

        <th>联系电话</th>

        <th>金额</th>

        <th>描述</th>

        <th>添加时间</th>

        <th>支付时间</th>

        <th>状态</th>

    </tr>

    </thead>

    <tbody>



    <volist name="pay_list" id="vo">

        <tr>

            <td>{pigcms{$vo.pigcms_id}</td>

            <td>{pigcms{$vo.pay_type}</td>

            <td>{pigcms{$vo.pay_id}</td>

            <td>{pigcms{$vo.phone}</td>

            <td>{pigcms{$vo.money}</td>

            <td>{pigcms{$vo.desc}</td>

            <td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>

            <td><if condition="$vo['pay_time']">{pigcms{$vo.pay_time|date='Y-m-d H:i:s',###}<else/>无</if></td>



            <td><if condition="$vo['status'] eq 1"><font color="green">已支付</font><elseif condition="$vo['status'] eq 2"/><font color="red">已取消</font>|<a href="{pigcms{:U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>0))}"><font color="green">恢复</font></a><else/><font color="red">未支付</font>|<a href="{pigcms{:U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>2))}"><font color="black">取消</font></a></if></td>



            <!--<td class="textcenter"><a href="{pigcms{:U('Merchant/order',array('mer_id'=>$vo['mer_id']))}">查看账单</a></td>-->

            <!--td class="textcenter"><a href="{pigcms{:U('Merchant/weidian_order',array('mer_id'=>$vo['mer_id']))}">微店账单</a></td-->

        </tr>

    </volist>



    </tbody>

</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
