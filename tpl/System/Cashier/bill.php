<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'商家对账',
    'describe'=>'',
);
$breadcrumb = array(
    array('收银管理','#'),
    array('商家对账','#'),
);

$add_action = array(

);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<style type="text/css">
    .mainnav_title {line-height:40px;/* height:40px; */border-bottom:1px solid #eee;color:#31708f;}
    .mainnav_title a {color:#004499;margin:0 5px;padding:4px 7px;background:#d9edf7;}
    .mainnav_title a:hover ,.mainnav_title a.on{background:#498CD0;color:#fff;text-decoration: none;}
</style>
<if condition="$order_list">
    <div class="alert alert-info" style="margin:10px;">
        <div class="year"></div>
        <div class="month"></div>
        <!--时间筛选-->
        <form id="myform" method="post" action="{pigcms{:U('bill_news')}" >
            <input type="hidden" name="mer_id" value="{pigcms{$mer_id}">
            <input type="hidden" name="type" value="{pigcms{$type}">
            <div style="float:left"><font color="#000">开始结束时间 ：</font></div>
            <input type="text" class="input fl" name="begin_time" style="width:120px;" id="d4311"  value="" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd'})"/>&nbsp;&nbsp;&nbsp;
            <input type="text" class="input fl" name="end_time" style="width:120px;" id="d4311" value="" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd'})"/>&nbsp;&nbsp;&nbsp;
            <input type="submit">
        </form>
    </div>
</if>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </th>
        <th>类型</th>
        <th>商家</th>
        <th>店铺</th>
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
    <if condition="$list">
        <volist name="list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.type_name}</td>
                <td>{pigcms{$vo.mer_name}</td>
                <td>{pigcms{$vo.store_name}</td>
                <td>{pigcms{$vo.order_id}</td>
                <td>

                    <if condition="$vo['name'] eq 1">
                        <volist name="vo['order_name']" id="menu">
                            {pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
                        </volist>
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
            <td colspan="16" style="text-align: left;padding:10px;">
                    本页总金额：<strong style="color: green">{pigcms{$page_bill}</strong>　
                    本页已出账金额：<strong style="color: red">{pigcms{$page_is_pay_bill}</strong><br/>
                    总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　
                    总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong><br/>
            </td>
        </tr>
        <tr class="odd">
            <td colspan="16" id="show_count"></td>
        </tr>
        <tr><td class="textcenter pagebar" colspan="16">{pigcms{$page_bar}</td></tr>
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