<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'城市区域',
    'describe'=>'',
);
$breadcrumb = array(
    array('系统配置','#'),
    array('城市区域','http://www.hdhsmart.com/admin.php?g=System&c=Area&a=index_news'),
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
        <th>排序</th>
        <th>编号</th>
        <th>名称</th>
        <if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
            <th>首字母</th>
        </if>
        <th>状态</th>
        <if condition="$_GET['type'] gt 1">
            <th>网址标识</th>
            <if condition="$_GET['type'] lt 4">
                <th>IP标识</th>
            </if>
        </if>
        <if condition="$_GET['type'] lt 4">
            <th>进入下级分类</th>
        </if>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($area_list)">
        <volist name="area_list" id="vo">
            <tr>
                <td>{pigcms{$vo.area_sort}</td>
                <td>{pigcms{$vo.area_id}</td>
                <td><if condition="$vo['is_hot']"><font color="red">{pigcms{$vo.area_name}</font><else/>{pigcms{$vo.area_name}</if></td>
                <if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
                    <td>{pigcms{$vo.first_pinyin}</td>
                </if>
                <td><if condition="$vo['is_open']"><font color="green">显示</font><else/><font color="red">隐藏</font></if></td>
                <if condition="$_GET['type'] gt 1">
                    <td>{pigcms{$vo.area_url}</td>
                    <if condition="$_GET['type'] lt 4">
                        <td>{pigcms{$vo.area_ip_desc}</td>
                    </if>
                </if>
                <if condition="$_GET['type'] lt 4">
                    <td><a href="{pigcms{:U('Area/index_news',array('type'=>$_GET['type']+1,'pid'=>$vo['area_id']))}">进入下级</a></td>
                </if>
                <td>
                    <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Area/edit',array('area_id'=>$vo['area_id']))}','编辑{pigcms{$now_type_str}',450,320,true,false,false,editbtn,'add',true);">编辑</a> |
                    <a href="javascript:void(0);" class="delete_row" parameter="area_id={pigcms{$vo.area_id}" url="{pigcms{:U('Area/del')}">删除</a>
                    <if condition="$_GET['type'] eq 2">
                        | <a href="{pigcms{:U('Area/admin', array('area_id' => $vo['area_id']))}">城市管理员</a>
                        <elseif condition="$_GET['type'] eq 3" />
                        | <a href="{pigcms{:U('Area/admin', array('area_id' => $vo['area_id']))}">区域管理员</a>
                    </if>
                </td>
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

