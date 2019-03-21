<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title' => '企业标签',
    'describe' => '',
);
$breadcrumb = array(
    array('企业管理', '#'),
    array('企业标签', '#'),
);
$add_action = array(
    'url'=>U('label_add'),
    'name'=>'标签'
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
        <th>编号</th>
        <th>名称</th>
        <th>图标</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($labels)">
        <volist name="labels" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1"/>
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$vo.name}</td>
                <td><img src="{pigcms{$vo.icon}" style="width:50px;height:50px;"></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Meal/label_edit',array('id'=>$vo['id']))}','编辑广告信息',510,330,true,false,false,editbtn,'add',true);">
                                    <i class="icon-tag"></i>编辑
                                </a>
                            </li>
                            <li onclick="delete_pr_info(this)" id="{pigcms{$v.role_id}">
                                <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Meal/label_del')}">
                                    <i class="icon-tag"></i> 删除
                                </a>

                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>
        <else/>
        <tr>
            <td class="textcenter red" colspan="5">列表为空！</td>
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




