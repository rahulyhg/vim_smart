<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'广告分类列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统设置','#'),
    array('广告分类列表','#'),
);

$add_action = array(
    'url'=>U('Adver/cat_add'),
    'name'=>'广告分类'
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
        <th>标识</th>
        <th>类别</th>
        <th>广告列表</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($category_list)">
        <volist name="category_list" id="vo">
            <tr>
                <td>{pigcms{$vo.cat_id}</td>
                <td>{pigcms{$vo.cat_name}</td>
                <td>{pigcms{$vo.cat_key}</td>
                <td><if condition="$vo['cat_type']">PC站广告<else />WAP站广告</if></td>
                <td><a href="{pigcms{:U('Adver/adver_list_news',array('cat_id'=>$vo['cat_id']))}">广告列表</a></td>
                <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Adver/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true))}','查看广告分类',400,180,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Adver/cat_edit',array('cat_id'=>$vo['cat_id']))}','编辑广告分类',400,180,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$vo.cat_id}" url="{pigcms{:U('Adver/cat_del')}">删除</a></td>
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
