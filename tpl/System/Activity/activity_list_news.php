<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'活动列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('推广营销','#'),
    array('活动列表','#'),
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
        <th>类别</th>
        <th>名称</th>
        <th>总商品数量</th>
        <th>已参与数量</th>
        <th>所需金钱</th>
        <th>所需积分</th>
        <th>首页排序</th>
        <th>状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($activity_list)">
        <volist name="activity_list" id="vo">
            <tr>
                <td>{pigcms{$vo.pigcms_id}</td>
                <td>{pigcms{$vo.type_txt}</td>
                <td title="{pigcms{$vo.title}">{pigcms{$vo.name}</td>
                <td><if condition="$vo['type'] neq 1">{pigcms{$vo.all_count}<else/>1</if></td>
                <td>{pigcms{$vo.part_count}</td>
                <td>{pigcms{$vo.money}</td>
                <td>{pigcms{$vo.mer_score}</td>
                <td>{pigcms{$vo.index_sort}</td>
                <td><if condition="$vo['is_finish'] eq 1"><font color="green">已完成</font><elseif condition="$vo['status'] eq 0"/><font color="red">待审核</font><elseif condition="$vo['status'] eq 2"/><font color="red">已结束</font><else/><font color="green">进行中</font></if></td>
                <td class="textcenter"><a href="{pigcms{:U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id'],'activity_id'=>$vo['pigcms_id']))}">编辑</a> <!--| <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Activity/activity_del')}">删除</a--></td>
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


