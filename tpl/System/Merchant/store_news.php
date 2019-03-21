<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'商铺列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('商户管理','#'),
    array('商铺列表','#'),
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
        <th>店铺名称</th>
        <th>联系电话</th>
        <th>最后编辑时间</th>
        <th>平台点击数</th>
        <th>{pigcms{$config.meal_alias_name}</th>
        <th>{pigcms{$config.group_alias_name}</th>
        <if condition="$config['store_open_waimai']"><th>{pigcms{$config.waimai_alias_name}</th></if>
        <th>状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($store_list)">
        <volist name="store_list" id="vo">
            <tr>

                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.store_id}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.phone}</td>
                <td><if condition="$vo['last_time']">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
                <td>{pigcms{$vo.hits}</td>
                <td><if condition="$vo['have_meal'] eq 1"><font color="green">开启</font><else/><font color="red">关闭</font></if></td>
                <td><if condition="$vo['have_group'] eq 1"><font color="green">开启</font><else/><font color="red">关闭</font></if></td>
                <if condition="$config['store_open_waimai']"><td><if condition="$vo['have_waimai'] eq 1"><font color="green">开启</font><else/><font color="red">关闭</font></if></td></if>
                <td><if condition="$vo['status'] eq 1"><font color="green">启用</font><elseif condition="$vo['status'] eq 2"/><font color="red">审核中</font><else/><font color="red">关闭</font></if></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                               <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/store_edit',array('store_id'=>$vo['store_id'],'frame_show'=>true))}','查看店铺信息',520,440,true,false,false,false,'detail',true);"> <i class="icon-docs"></i> 查看</a> 
							   <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/store_edit',array('store_id'=>$vo['store_id']))}','编辑店铺信息',520,440,true,false,false,editbtn,'store_add',true);"><i class="icon-tag"></i> 编辑</a>
							   <a href="javascript:void(0);" class="delete_row" parameter="store_id={pigcms{$vo.store_id}" url="{pigcms{:U('Merchant/store_del')}">
                                  <i class="icon-flag"></i> 删除
                               </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="11">列表为空！</td></tr>
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




