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
    'title'=>'待审核企业列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('待审核企业列表','#'),
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
        <th>编号</th>
        <th>企业帐号</th>
        <th>企业名称</th>
        <th>联系电话</th>
        <th>最后登录时间</th>
        <th class="textcenter">访问该企业后台</th>
        <th class="textcenter">微官网点击数</th>
        <th>状态</th>
        <if condition="$config['is_open_oauth']">
            <th>公众号网页授权状态</th>
        </if>
        <th class="textcenter">企业账单</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($merchant_list)">
        <volist name="merchant_list" id="vo">
            <tr>

                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.mer_id}</td>
                <td>{pigcms{$vo.account}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.phone}</td>
                <td><if condition="$vo['last_time']">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
                <td class="textcenter"><if condition="$vo['status'] eq 1"><a href="{pigcms{:U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id']))}" class="__full_screen_link" target="_blank">访问</a><else/><a href="javascript:alert('商户状态不正常，无法访问！请先修改商户状态。');" class="__full_screen_link">访问</a></if></td>
                <td class="textcenter">{pigcms{$vo.hits}</td>
                <td><if condition="$vo['status'] eq 1"><font color="green">启用</font><elseif condition="$vo['status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
                <if condition="$config['is_open_oauth']">
                    <td><if condition="$vo['is_open_oauth'] eq 1"><font color="green">启用</font><else/><font color="red">关闭</font></if></td>
                </if>
                <td class="textcenter"><a href="{pigcms{:U('Merchant/order_news',array('mer_id'=>$vo['mer_id']))}">查看账单</a></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('Merchant/store_news',array('mer_id'=>$vo['mer_id']))}"><i class="icon-tag"></i> 店铺列表</a>

                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.show_other_frame('Group','product','mer_id={pigcms{$vo.mer_id}')"><i class="icon-tag"></i> {pigcms{$config.group_alias_name}列表</a>

                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/edit',array('mer_id'=>$vo['mer_id'],'frame_show'=>true))}','查看详细信息',520,370,true,false,false,false,'detail',true);"><i class="icon-tag"></i> 查看</a>

                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/edit',array('mer_id'=>$vo['mer_id']))}','编辑商户信息',600,450,true,false,false,editbtn,'edit',true);"><i class="icon-tag"></i> 编辑</a>

                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/menu',array('mer_id'=>$vo['mer_id']))}','设置商家使用权限',700,500,true,false,false,editbtn,'edit',true);"><i class="icon-tag"></i> 设置商家使用权限</a>

                            </li>
                            <li>
                                <a href="javascript:void(0);" class="delete_row" parameter="mer_id={pigcms{$vo.mer_id}" url="{pigcms{:U('Merchant/del')}"><i class="icon-tag"></i> 删除</a>

                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="12">列表为空！</td></tr>
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




