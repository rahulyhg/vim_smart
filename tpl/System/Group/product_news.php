<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'商品管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('团购管理','#'),
    array('商品管理','#'),
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
        <th>名称（悬浮查看商品标题）</th>
        <th>价格</th>
        <th>销售概览</th>
        <th>时间</th>
        <th>数字</th>
        <th>查看二维码</th>
        <th>运行状态</th>
        <th>{pigcms{$config.group_alias_name}状态</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($group_list)">
        <volist name="group_list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.group_id}</td>
                <td><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.group_id}" target="_blank" title="{pigcms{$vo.name}">{pigcms{$vo.s_name}</a></td>
                <td>{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.price}元<br/>原价：￥{pigcms{$vo.old_price}元</td>
                <td>售出：{pigcms{$vo.sale_count} 份<br/><!--库存： <if condition="$vo['count_num']">{pigcms{$vo.count_num}<else/>无限制</if><br/>虚拟：{pigcms{$vo.virtual_num} 人--></td>
                <td>开始时间：{pigcms{$vo.begin_time|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.end_time|date='Y-m-d H:i:s',###}<br/>{pigcms{$config.group_alias_name}券有效期：{pigcms{$vo.deadline_time|date='Y-m-d H:i:s',###}</td>
                <td>查看数：{pigcms{$vo.hits}<br/>出售数：{pigcms{$vo.sale_count}<br/>评论数：{pigcms{$vo.reply_count}</td>
                <td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=group&id={pigcms{$vo.group_id}','查看二维码',430,433,true,false,false,null,'merchant_qrcode',true);" class="see_qrcode">查看二维码</a></td>
                <td>
                    <if condition="$vo['begin_time'] gt $_SERVER['REQUEST_TIME']">
                        未开团
                        <elseif condition="$vo['end_time'] lt $_SERVER['REQUEST_TIME']"/>
                        已结束
                        <else/>
                        进行中
                    </if>
                </td>
                <td><switch name="vo['status']"><case value="0"><font color="red">关闭</font></case><case value="1"><font color="green">正常</font></case><case value="2"><font color="red">审核中</font></case></switch></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('Group/order_list_news',array('group_id'=>$vo['group_id']))}">
                                    <i class="icon-tag"></i> 订单列表
                                </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('Group/reply_list_news',array('group_id'=>$vo['group_id']))}">
                                    <i class="icon-tag"></i> 评论列表
                                </a>
                            </li>
                            <li>
                                <a href="{pigcms{:U('Merchant/merchant_login_news',array('mer_id'=>$vo['mer_id'],'group_id'=>$vo['group_id']))}">
                                    <i class="icon-tag"></i> 编辑
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






