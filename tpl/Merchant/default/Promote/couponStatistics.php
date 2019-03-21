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
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-success" onclick="location_count(0)">本月统计</button>&nbsp;&nbsp;
                    <button class="btn btn-success" onclick="location_count(7)">最近一周</button>&nbsp;&nbsp;
                    <button class="btn btn-success" onclick="location_count(30)">最近三十天</button>
                    <div class="tabbable" style="margin-top:20px;">
                        <ul class="nav nav-tabs" id="myTab">
                            <li>
                                <a data-toggle="tab" href="#couponinfo" title="{pigcms{$config.group_alias_name}统计">
                                    现金劵统计
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="couponinfo" class="tab-pane" style="display:block;">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5>统计图</h5>
                                    </div>
                                    <div class="widget-body" id="coupon_main" style="padding:20px;height:400px;width:100%;"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="grid-view">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>时间</th>
                                                    <th>优惠金额</th>
                                                    <th>支付金额</th>
                                                    <th>实际总金额</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <volist name="request_list" id="vo">
                                                    <tr class="<if condition='$i%2 eq 0'>even<else/>odd</if>">
                                                        <td style="width: 120px">{pigcms{$vo.time|date='Y-m-d',###}</td>
                                                        <td style="width: 120px">{pigcms{$vo.coupon_money|default="0"}<if condition="stripos($vo.coupon_money ,'.') eq false">.00</if></td>
                                                        <td style="width: 120px">{pigcms{$vo.coupon_pay_money|default="0"}<if condition="stripos($vo.coupon_pay_money ,'.') eq false">.00</if></td>
                                                        <td>￥{pigcms{$vo.coupon_all_money|default="0"}<if condition="stripos($vo.coupon_all_money ,'.') eq false">.00</if></td>
                                                    </tr>
                                                </volist>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{pigcms{$static_path}js/echarts-plain.js"></script>
<script type="text/javascript">
    function location_count(day){
        window.location.href = "{pigcms{:U('Promote/couponStatistics')}&day="+day;
    }
    function CreateShop(){
        window.location.href = "{pigcms{:U('Promote/discountSpead')}";
    }
    var coupon_myChart = echarts.init(document.getElementById('coupon_main'));
    var coupon_option = {
        title : {
            text: '{pigcms{$config.group_alias_name}相关统计图',
            x:'left'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['优惠的金额','支付的金额','实际总金额'],
            x: 'right'
        },
        toolbox: {
            show : false,
            feature : {
                mark : {show: false},
                dataView : {show: false, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: false} ,
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [{pigcms{$xAxis_txt}]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'优惠的金额',
                type:'line',
                tiled: '总量',
                data: [{pigcms{$coupon_money_txt}]
            },
            {
                "name":'支付的金额',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$coupon_pay_money_txt}]
            },
            {
                "name":'实际总金额',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$coupon_all_money_txt}]
            }

        ]

    };
    coupon_myChart.setOption(coupon_option);

//    $('.tab-pane').removeAttr('style');
</script>
<include file="Public:footer"/>
