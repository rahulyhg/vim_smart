<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'账单列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('待审核企业列表','#'),
    array('账单列表','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th><input type="checkbox" id="all_select"/></th>
        <th>门店名称</th>
        <th>订单号</th>
        <th>订单详情</th>
        <th>数量</th>
        <th>金额</th>
        <th>余额支付金额</th>
        <th>在线支付金额</th>
        <th>商户余额支付金额</th>
        <th>优惠券</th>
        <th>下单时间</th>
        <th>支付时间</th>
        <th>支付类型</th>
        <if condition="($type eq 'meal') or ($type eq 'group')"><th>状态</th></if>
        <th>对账状态</th>
    </tr>
    </thead>
    <tbody>
    <if condition="$order_list">
        <volist name="order_list" id="vo">
            <tr>
                <td><if condition="($vo['is_pay_bill'] eq 0) AND ($start_year neq '')"><input type="checkbox" name="orderid[]" value="{pigcms{$vo.order_id}" class="select" data-price="{pigcms{$vo.price}"/></if></td>
                <td>{pigcms{$vo.store_name}</td>
                <td>{pigcms{$vo.order_id}</td>
                <td>

                    <if condition="$type eq 'meal'">
                        <volist name="vo['order_name']" id="menu" key='k'>
                            <if condition="$k lt 3">
                                {pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
                            </if>
                        </volist>
                        <if condition="count($vo['order_name']) gt 2">
                            <a class='js-alert' orderid='{pigcms{$vo.order_id}' href="javascript:;" style="color: red">查看更多</a></if>
                        <span style="display:none" id="js-alert-{pigcms{$vo.order_id}">
												<volist name="vo['order_name']" id="menu" key='k'>
												{pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
												</volist>
												</span>
                        <else />{pigcms{$vo.order_name}</if>
                </td>
                <td>{pigcms{$vo.total}</td>
                <td>{pigcms{$vo.order_price}</td>
                <td>{pigcms{$vo.balance_pay}</td>
                <td>{pigcms{$vo.payment_money}</td>
                <td>{pigcms{$vo.merchant_balance}</td>
                <td><if condition="$vo['card_id'] eq 0">未使用<else/>已使用</if></td>
                <td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
                <td><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
                <td>{pigcms{$vo.pay_type_show}</td>
                <if condition="($type eq 'meal') or ($type eq 'group')">
                    <td>
                        <if condition="$vo['paid'] eq 0">
                            未付款
                            <else />
                            <if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])">线下未支付
                                <elseif condition="$vo['status'] eq 0" />未消费
                                <elseif condition="$vo['status'] eq 1" />未评价
                                <elseif condition="$vo['status'] eq 2" />已完成
                            </if>
                        </if>
                    </td>
                </if>
                <td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
            </tr>
        </volist>
        <input type="hidden" id="percent" value="{pigcms{$percent}" />
        <tr class="even">
            <td colspan="16">
                <if condition="$percent">
                    平台的抽成比例：<strong style="color: green">{pigcms{$percent}%</strong> <br/>
                    本页总金额：<strong style="color: green">{pigcms{$total}</strong>　本页已出账金额：<strong style="color: red">{pigcms{$finshtotal} * {pigcms{$percent}%</strong><br/>
                    总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh} * {pigcms{$percent}%</strong><br/>
                    <strong>本页平台应获取的抽成金额：</strong><strong style="color: green">{pigcms{$total_percent}</strong><br/>
                    <strong>平台应获取的总抽成金额：</strong><strong style="color: red">{pigcms{$all_total_percent}</strong><br/>
                    <strong>本页应获取的金额：</strong><strong style="color: red">{pigcms{$total-$total_percent}</strong><br/>
                    <strong>应获取的总金额：</strong><strong style="color: red">{pigcms{$alltotal+$alltotalfinsh-$all_total_percent}</strong><br/>
                    <else />
                    本页总金额：<strong style="color: green">{pigcms{$total}</strong>　本页已出账金额：<strong style="color: red">{pigcms{$finshtotal}</strong><br/>
                    总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong><br/>

                </if>
                <!--本页总金额：<strong style="color: green">{pigcms{$total}</strong> 本页已出账金额：<strong style="color: red">{pigcms{$finshtotal}</strong><br/> 总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong> 总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong-->
            </td>
        </tr>
        <tr class="odd">
            <td colspan="16" id="show_count"></td>
        </tr>

        <else/>
        <tr class="odd"><td class="textcenter red" colspan="16" >该的店铺暂时还没有订单。</td></tr>
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
