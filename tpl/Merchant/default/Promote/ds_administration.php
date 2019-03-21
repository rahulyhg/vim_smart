<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
            <li class="active"><a onclick="CreateShop()">现金劵推广</a></li>
            <li class="active">优惠明细</li>
        </ul>
    </div>
<!--    <div class="alert alert-info" style="margin:10px;">-->
<!--        <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>只统计已使用的订单-->
<!--    </div>-->
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabbable" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-12">
                               
                                <div class="grid-view">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;"><input type="checkbox" id="all_select"/></th>
                                            <th style="text-align: center;">类型</th>
                                            <th style="text-align: center;">店铺名称</th>
                                            <th style="text-align: center;">订单号</th>
                                            <th style="text-align: center;">订单详情</th>
                                            <th style="text-align: center;">数量</th>
                                            <th style="text-align: center;">金额</th>
                                            <th style="text-align: center;">余额支付金额</th>
                                            <th style="text-align: center;">在线支付金额</th>
                                            <th style="text-align: center;">商户优惠金额</th>
                                            <th style="text-align: center;">优惠券</th>
                                            <th style="text-align: center;">下单时间</th>
                                            <th style="text-align: center;">支付时间</th>
                                            <th style="text-align: center;">支付类型</th>
                                            <th style="text-align: center;">状态</th>
                                            <th style="text-align: center;">对账状态</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <if condition="$order_list">
                                            <volist name="order_list" id="vo">
                                                <tr>
                                                    <td style="text-align: center;"><if condition="$vo['is_pay_bill'] eq 0"><input type="checkbox" value="{pigcms{$vo.name}_{pigcms{$vo.order_id}" class="select" data-price="{pigcms{$vo.price}"/></if></td>
                                                    <td style="text-align: center;">扫码</td>
                                                    <td style="text-align: center;">{pigcms{$vo.store_name}</td>
                                                    <td style="text-align: center;">{pigcms{$vo.order_id}</td>
                                                    <td style="text-align: center;">

                                                        <if condition="$vo['name'] eq 1">
                                                            <volist name="vo['order_name']" id="menu">
                                                                {pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
                                                            </volist>
                                                            <else />{pigcms{$vo.order_name}</if>
                                                    </td>
                                                    <td style="text-align: center;">{pigcms{$vo.total}</td>
                                                    <td style="text-align: center;">{pigcms{$vo.order_price}</td>
                                                    <td style="text-align: center;">{pigcms{$vo.balance_pay}</td>
                                                    <td style="text-align: center;">{pigcms{$vo.payment_money}</td>
                                                    <td  style="color: red;text-align: center;">{pigcms{$vo.minus_price}<if condition="stripos($vo.minus_price ,'.') heq false">.00</if></td>
                                                    <td style="text-align: center;"><if condition="$vo['ds_id'] eq ''">未使用<else/><a href="http://you.huidehang.cn/merchant.php?g=Merchant&c=Promote&a=ds_look&disid={pigcms{$vo.ds_id}">详情</a></if></td>
                                                    <td style="text-align: center;">{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
                                                    <td style="text-align: center;"><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
                                                    <td style="text-align: center;">{pigcms{$vo.pay_type_show}</td>
                                                    <td style="text-align: center;">
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
                                                    <td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
                                                </tr>
                                            </volist>
                                            <input type="hidden" id="percent" value="{pigcms{$percent}" />
                                            <tr class="even">
                                                <td colspan="16">
                                                    <if condition="$percent">
                                                        实际收入金额：<strong style="color: green">{pigcms{$alltotal|default="0"}元</strong> 优惠金额：<strong style="color: green">{pigcms{$paycou|default="0"}元</strong>　<br/>
                                                      
                                                    </if>
                                                </td>
                                            </tr>
                                            <tr class="odd">
                                                <td colspan="16" id="show_count"></td>
                                            </tr>
                                            <tr><td class="textcenter pagebar" colspan="16">{pigcms{$pagebar}</td></tr>
                                            <else/>
                                            <tr class="odd"><td class="textcenter red" colspan="16" >该的店铺暂时还没有订单。</td></tr>
                                        </if>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--div class="col-xs-2" style="margin-top: 15px;">
                                <a class="btn btn-success" href="#">导出成excel</a>
                            </div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#all_select').click(function(){
            if ($(this).attr('checked')){
                $('.select').attr('checked', true);
            } else {
                $('.select').attr('checked', false);
            }
            total_price();
        });
        $('.select').click(function(){total_price();});
    });

    function CreateShop(){
        window.location.href = "{pigcms{:U('Promote/discountSpead')}";
    }
    function total_price()
    {
        var total = 0;
        $('.select').each(function(){
            if ($(this).attr('checked')) {
                total += parseFloat($(this).attr('data-price'));
            }
        });
        total = Math.round(total * 100)/100;
        var percent = $('#percent').val();
        if (total > 0) {
            $('#show_count').html('账单总计金额：<strong style=\'color:red\'>￥' + total + '</strong>, 平台对改商家的抽成比例是：<strong style=\'color:green\'>' + percent + '%</strong>, 平台应得金额：<strong style=\'color:green\'>￥' + Math.round(total * percent) /100 + '</strong>,商家应得金额:<strong style=\'color:red\'>￥' + Math.round((total - Math.round(total * percent) /100) * 100)/100 + '</strong>');
        } else {
            $('#show_count').html('');
        }
    }
</script>
<include file="Public:footer"/>
