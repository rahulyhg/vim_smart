<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'信息分类',
    'describe'=>'',
);
$breadcrumb = array(
    array('分类信息','#'),
    array('信息分类','#'),
);

$add_action = array(
    'url'=>U('Classify/cat_add',array('fcid'=>$fcid,'pfcid'=>$pfcid)),
    'name'=>'主分类'
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>排序</th>
        <th>编号</th>
        <th>名称</th>
        <th>短标记(url)</th>
        <if condition="$now_category['subdir'] lt 2">
            <th>查看子分类</th>
            <th>发布信息需填项设置</th>
            <th>状态</th>
        </if>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($category_list)">
        <volist name="category_list" id="vo">
            <tr>
                <td>{pigcms{$vo.cat_sort}</td>
                <td>{pigcms{$vo.cid}</td>
                <td><if condition="$vo['is_hot']"><font color="red">{pigcms{$vo.cat_name}</font><else/>{pigcms{$vo.cat_name}</if></td>
                <td>{pigcms{$vo.cat_url}</td>
                <if condition="$now_category['subdir'] lt 2">
                    <td><a href="{pigcms{:U('Classify/index_news',array('fcid'=>$vo['cid'],'pfcid'=>$vo['fcid']))}">查看子分类</a>

                    </td>
                    <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/cat_field',array('cid'=>$vo['cid']))}','管理商品属性字段',580,420,true,false,false,false,'detail',true);">添加/查看设置</a></td>
                    <td><if condition="$vo['cat_status'] eq 1"><font color="green">启用</font><elseif condition="$vo['cat_status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
                </if>
                <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/cat_edit',array('cid'=>$vo['cid'],'frame_show'=>true))}','查看分类信息',480,260,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/cat_edit',array('cid'=>$vo['cid']))}','编辑分类信息',580,450,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cid={pigcms{$vo.cid}" url="{pigcms{:U('Classify/cat_del')}">删除</a></td>
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
