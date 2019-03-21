<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
    -->
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.dropdown-menu {
    margin: 0 0 0 -125px;
}
</style>
<!--头部设置-->
<?php
$title = array(
    'title' => '企业分类',
    'describe' => '',
);
$breadcrumb = array(
    array('企业管理', '#'),
    array('企业分类', '#'),
);
$add_action = array(
    'url'=>U('cat_add',array('parentid'=>$_GET['parentid'])),
    'name'=>'分类'
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
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                <span></span>
            </label>
        </th>
        <th>排序</th>
        <th>编号</th>
        <th>名称</th>
        <th>短标记(url)</th>
        <if condition="empty($parentid)">
            <th>查看子分类</th>
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
                        <input type="checkbox" class="checkboxes" value="1"/>
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.cat_sort}</td>
                <td>{pigcms{$vo.cat_id}</td>
                <td>{pigcms{$vo.cat_name}</td>
                <td>{pigcms{$vo.cat_url}</td>
                <if condition="empty($parentid)">
                    <td><a href="{pigcms{:U('Meal/index_news',array('parentid'=>$vo['cat_id']))}">查看子分类</a></td>
                </if>
                <td>
                    <if condition="$vo['cat_status'] eq 1"><font color="green">启用</font>
                        <elseif condition="$vo['cat_status'] eq 2"/>
                        <font color="red">待审核</font>
                        <else/>
                        <font color="red">关闭</font></if>
                </td>


                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="javascript:void(0);"
                                   onclick="window.top.artiframe('{pigcms{:U('Meal/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true))}','查看分类信息',480,260,true,false,false,false,'detail',true);"> <i class="icon-tag"></i>查看</a>

                            </li>
                            <li onclick="delete_pr_info(this)" id="{pigcms{$v.role_id}">
                                <a href="javascript:void(0);"
                                   onclick="window.top.artiframe('{pigcms{:U('Meal/cat_edit',array('cat_id'=>$vo['cat_id'], 'parentid'=>$vo['cat_fid']))}','编辑分类信息',480,260,true,false,false,editbtn,'edit',true);"> <i class="icon-tag"></i>编辑</a>

                            </li>
                            <li onclick="delete_pr_info(this)" id="{pigcms{$v.role_id}">
                                <a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$vo.cat_id}"
                                   url="{pigcms{:U('Meal/cat_del')}"> <i class="icon-tag"></i>删除</a></td>

                </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>
        <else/>
        <tr>
            <td class="textcenter red" colspan="6">列表为空！</td>
        </tr>
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





