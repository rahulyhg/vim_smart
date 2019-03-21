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
    'title'=>'企业订单',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('企业订单','#'),
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
        <th>企业名称</th>
        <th>店铺名称</th>
        <th>{pigcms{$config.meal_alias_name}人</th>
        <th>电话</th>
        <th>下单时间</th>
        <th>总价</th>
        <th>优惠</th>
        <th>状态</th>
        <th>支付状态</th>
        <th>支付方式</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($order_list)">
        <volist name="order_list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.order_id}</td>
                <td>{pigcms{$vo.merchant_name}</td>
                <td>{pigcms{$vo.store_name}</td>
                <td>{pigcms{$vo.name}</td>
                <td>{pigcms{$vo.phone}</td>
                <td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
                <td>￥<if condition="$vo['total_price'] gt 0">{pigcms{$vo['total_price']}<else />{pigcms{$vo.price}</if></td>
                <td>￥{pigcms{$vo.minus_price}</td>
                <td>
                    <if condition="$vo['status'] eq 0"><span style="color:red">未使用</span>
                        <elseif condition="$vo['status'] eq 1" /><span style="color:green">已使用<strong>未评价</strong></span>
                        <elseif condition="$vo['status'] eq 2" /><span style="color:green">已使用已评价</span>
                        <elseif condition="$vo['status'] eq 3" /><span style="color:red"><del>订单被取消</del></span>
                        <elseif condition="$vo['status'] eq 4" /><span style="color:red"><del>订单被取消</del></span>
                    </if>
                </td>
                <td>
                    <if condition="$vo['paid'] eq 0">
                        <span style="color:red">未支付</span>
                        <elseif condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" />
                        <span style="color:red">线下未支付</span>
                        <elseif condition="$vo['paid'] eq 2"  />
                        <span style="color:green">已付￥{pigcms{$vo['pay_money']}</span>，<span style="color:red">未付￥{pigcms{$vo['price'] - $vo['pay_money']}</span>
                        <else />
                        <span style="color:green">全额支付</span>
                    </if>
                </td>

                <td>
                    <if condition="$vo['pay_type'] eq 'alipay'">
                        <span style="color:green">支付宝</span>
                        <elseif condition="$vo['pay_type'] eq 'weixin'"/>
                        <span style="color:green">微信支付</span>
                        <elseif condition="$vo['pay_type'] eq 'tenpay'"/>
                        <span style="color:green">财付通[wap手机]</span>
                        <elseif condition="$vo['pay_type'] eq 'tenpaycomputer'"/>
                        <span style="color:green">财付通[即时到帐]</span>
                        <elseif condition="$vo['pay_type'] eq 'yeepay'"/>
                        <span style="color:green">易宝支付</span>
                        <elseif condition="$vo['pay_type'] eq 'allinpay'"/>
                        <span style="color:green">通联支付</span>
                        <elseif condition="$vo['pay_type'] eq 'daofu'"/>
                        <span style="color:green">货到付款</span>
                        <elseif condition="$vo['pay_type'] eq 'dianfu'"/>
                        <span style="color:green">到店付款</span>
                        <elseif condition="$vo['pay_type'] eq 'chinabank'"/>
                        <span style="color:green">网银在线</span>
                        <elseif condition="$vo['pay_type'] eq 'offline'"/>
                        <span style="color:green">线下支付</span>
                        <elseif condition="empty($vo['pay_type']) AND $vo['paid'] eq 1 AND $vo['balance_pay'] gt 0" />
                        <span style="color:green">平台余额支付</span>
                        <else />
                        <span style="color:green">暂未选择</span>
                    </if>
                </td>
                <td class="textcenter">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Meal/order_detail',array('order_id'=>$vo['order_id'],'frame_show'=>true))}','查看{pigcms{$config.meal_alias_name}详情',480,380,true,false,false,false,'detail',true);">
                                    <i class="icon-docs"></i> 查看
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>



            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="13">列表为空！</td></tr>
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





