<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'快递公司列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('快递公司列表','#'),
);

$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递公司'
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
        <th>编码</th>
        <th>链接地址</th>
        <th>编辑时间</th>
        <th>状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($express_list)">
        <volist name="express_list" id="vo">
            <tr>
                <td>{pigcms{$vo.sort}</td>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.code}</td>
                <td><a href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.url}</a></td>
                <td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
                <td><if condition="$vo['status']"><font color="green">启用</font><else/><font color="red">关闭</font></if></td>
                <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Express/edit',array('id'=>$vo['id'],'frame_show'=>true))}','查看详细信息',520,250,true,false,false,false,'add',true);">查看</a>
                    | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Express/edit',array('id'=>$vo['id']))}','编辑快递公司信息',520,250,true,false,false,editbtn,'add',true);">编辑</a>
                    | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Express/add_admin',array('id'=>$vo['id']))}','编辑快递公司信息',520,250,true,false,false,editbtn,'add',true);">管理取件员</a>
                    | <a href="{pigcms{:U('Express/expressage_locker_info',array('id'=>$vo['id']))}" >管理快递柜</a>
                    | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Express/del')}">删除</a></td>
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