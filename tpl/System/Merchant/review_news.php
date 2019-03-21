<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'企业列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('企业列表','#'),
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
        <th>ID</th>
        <th>商户名</th>
        <th>提现金额</th>
        <th>申请时间</th>
        <th>提现状态</th>
        <th>处理人</th>
        <th>联系方式</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($list)">
        <volist name="list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$vo.mc_name}</td>
                <td>{pigcms{$vo.tc_money}</td>
                <td>{pigcms{$vo.sub_time|date='Y-m-d H:i:s',###}</td>
                <td><if condition="$vo['status'] eq 0"><font color="red">待处理</font><elseif condition="$vo['status'] eq 1"/><font color="red">审核中</font><elseif condition="$vo['status'] eq 2"/><font color="green">通过审核</font><else/><font color="red">审核不通过</font></if></td>
                <td>{pigcms{$vo.dispose_name}</td>
                <td>{pigcms{$vo.contact_num}</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/check',array('d_id'=>$vo['id']))}','提现审核',600,450,true,false,false,editbtn,'edit',true);">
                                    审核
                                </a>
                            </li>
                            <li onclick="delete_pr_info(this)" id="{pigcms{$v.role_id}">
                                <a href="javascript:void(0);" class="delete_row" parameter="d_id={pigcms{$vo['id']}" url="{pigcms{:U('Merchant/dradel')}">
                                    <i class="icon-tag"></i>删除
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
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






