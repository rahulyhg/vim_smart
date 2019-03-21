<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'团购分类',
    'describe'=>'',
);
$breadcrumb = array(
    array('团购管理','#'),
    array('团购分类','#'),
);

$add_action = array(
    'url'=>U('cat_add',array('fid'=>0)),
    'name'=>'主分类'
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
        <th>排序</th>
        <th>编号</th>
        <th>名称</th>
        <th>短标记(url)</th>
        <if condition="empty($_GET['cat_fid'])">
            <th>查看子分类</th>
            <th>购买须知填写项</th>
            <th>商品字段管理</th>
        </if>
        <th>状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($category_list)">
        <volist name="category_list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>

                <td>{pigcms{$vo.cat_sort}</td>
                <td>{pigcms{$vo.cat_id}</td>
                <td><if condition="$vo['is_hot']"><font color="red">{pigcms{$vo.cat_name}</font><else/>{pigcms{$vo.cat_name}</if></td>
                <td>{pigcms{$vo.cat_url}</td>
                <if condition="empty($_GET['cat_fid'])">
                    <td><a href="{pigcms{:U('Group/index_news',array('cat_fid'=>$vo['cat_id']))}">查看子分类</a></td>
                    <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/cue_field',array('cat_id'=>$vo['cat_id']))}','购买须知填写项',580,420,true,false,false,false,'detail',true);">购买须知填写项</a></td>
                    <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/cat_field',array('cat_id'=>$vo['cat_id']))}','管理商品属性字段',580,420,true,false,false,false,'detail',true);">商品字段管理</a></td>
                </if>
                <td><if condition="$vo['cat_status'] eq 1"><font color="green">启用</font><elseif condition="$vo['cat_status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true))}','查看分类信息',480,260,true,false,false,false,'detail',true);">
                                    <i class="icon-tag"></i> 查看
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/cat_edit',array('cat_id'=>$vo['cat_id']))}','编辑分类信息',480,<if condition="$vo['cat_fid']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">
                                    <i class="icon-tag"></i> 编辑
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$vo.cat_id}" url="{pigcms{:U('Group/cat_del')}">
                                     <i class="icon-tag"></i> 删除
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
    </tr>
    </volist>

    <else/>
    <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
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





