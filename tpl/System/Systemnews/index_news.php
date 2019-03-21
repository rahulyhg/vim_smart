<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'平台快报',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('平台快报','#'),
);

$add_action = array(
    'url'=>U('Systemnews/add_category',array()),
    'name'=>'快报平台分类'
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>

    <tr>

        <th>编号</th>

        <th>分类名称</th>

        <th>内容列表</th>

        <th>排序</th>

        <th>状态</th>

        <th class="textcenter">操作</th>

    </tr>

    </thead>

    <tbody>

    <if condition="is_array($category)">

        <volist name="category" id="vo">

            <tr>

                <td>{pigcms{$vo.id}</td>

                <td>{pigcms{$vo.name}</td>

                <td><a href="{pigcms{:U('Systemnews/news_news',array('category_id'=>$vo['id']))}">查看内容</a></td>

                <td>{pigcms{$vo.sort}</td>

                <td><if condition="$vo['status'] eq 1"><font color="green">启用</font><else/><font color="red">禁止</font></if></td>

                <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Systemnews/edit_category',array('id'=>$vo['id']))}','编辑快报',800,460,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="category_id={pigcms{$vo.id}" url="{pigcms{:U('Systemnews/del',array('category_id'=>$vo['id']))}">删除</a></td>

            </tr>

        </volist>



        <else/>

        <tr><td class="textcenter red" colspan="9">列表为空！</td></tr>

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

