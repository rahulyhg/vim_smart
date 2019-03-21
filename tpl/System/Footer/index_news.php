<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'底部导航',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('底部导航','#'),
);

$add_action = array(
    'url'=>U('Footer/add'),
    'name'=>'底部导航'
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>编号</th>
        <th>名称</th>
        <th>标题</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($link_list)">
        <volist name="link_list" id="vo">
            <tr>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.title}</td>
                <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Footer/edit',array('id'=>$vo['id']))}','编辑导航',800,460,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Footer/del')}">删除</a></td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="4">列表为空！</td></tr>
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


</td>