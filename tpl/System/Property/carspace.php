<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('output_excel')}">
            <button id="sample_editable_1_new" class="btn sbold green">下载物业收费登记账
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
<style type="text/css">
    <!--
    .table-checkable tr>td:first-child, .table-checkable tr>th:first-child {
        text-align: center;
        max-width: 100px;
        min-width: 40px;
        padding-left: 0;
        padding-right: 0;
    }
    -->
    html,body{
        height: 100%;
        width: 100%;
    }
    .test{
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.3;
        opacity:.30;
        filter: alpha(opacity=30);

    }
    .spinner {
        margin: 100px auto;
        margin-bottom: 0px;
        width: 50px;
        height: 150px;
        text-align: center;
        font-size: 10px;
    }

    .spinner > div {
        background-color: #7CFC00;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
        animation: sk-stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {
        0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
        20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes sk-stretchdelay {
        0%, 40%, 100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }  20% {
               transform: scaleY(1.0);
               -webkit-transform: scaleY(1.0);
           }
    }
    .nav-justified > li>a{
        font-size: 11px;
        white-space:nowrap;
    }
	 .bounce1{
         background-color: #32c5d2!important;
     }
	 .bounce2{
         background-color: #32c5d2!important;
     }
	 .bounce3{
         background-color: #32c5d2!important;
     }
	 table.dataTable {
    clear: both;
    margin:0px !important;
    max-width: none !important;
}
</style><div class="row">
    <div class="col-md-12">

        <br/>
        <br/>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>费用详情 </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified" style="overflow-x:scroll">
                            <li <if condition="ACTION_NAME eq property">class="active"</if>>
                            <a href="{pigcms{:U('property')}" > 物业服务费 </a>
                            </li>
                            <li <if condition="ACTION_NAME eq carspace">class="active"</if>>
                            <a href="{pigcms{:U('carspace')}" > 包月泊位费 </a>
                            </li>
                            <volist name="type_list" id="vo">
                                <li <if condition="$_GET['type_id'] eq $vo['otherfee_type_id']">class="active"</if>>
                                <a href="{pigcms{:U('other',array('type_id'=>$vo['otherfee_type_id']))}" > {pigcms{$vo['otherfee_type_name']} </a>
                                </li>
                            </volist>
                            <li <if condition="ACTION_NAME eq month">class="active"</if>>
                            <a href="{pigcms{:U('month')}" > 月报表 </a>
                            </li>
                        </ul>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                            <thead>
                            <tr>
                                <th>房号</th>
                                <th>客户名称</th>
                                <th>车位数(个)</th>
                                <th>月应收</th>
                                <th>上年应收</th>
                                <th>本年应收已收</th>
                                <th>本年实收</th>
                                <th>年末应收</th>
                                <for start="1" end="$month_number1" >
                                    <th>{pigcms{$i}月应收</th>
                                    <th>{pigcms{$i}月已收</th>
                                </for>
                                <th style="width:200px;">备注</th>
                            </tr>
                            </thead>
                            <tbody>
                                <volist name="carspace_fee_list" id="row">
                                    <tr>
                                        <td>{pigcms{$row.room_name}</td>
                                        <td>{pigcms{$row.name}</td>
                                        <td>1</td>
                                        <td>{pigcms{$row.carspace_price}</td>
                                        <td>{pigcms{$row.sum_last}</td>
                                        <td>{pigcms{$row.sum_recive}</td>
                                        <td>{pigcms{$row.sum_true}</td>
                                        <td>{pigcms{$row.sum_nowend}</td>
                                        <for start="1" end="$month_number1" >
                                            <th>{pigcms{$row['list'][$i]['pay_recive']}</th>
                                            <th>{pigcms{$row['list'][$i]['pay_true']}</th>
                                        </for>
                                        <td>{pigcms{$row.remark}</td>
                                    </tr>
                                </volist>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>合计</th>
                                <th>车位数(个)</th>
                                <th>月应收</th>
                                <th>上年应收</th>
                                <th>本年应收已收</th>
                                <th>本年实收</th>
                                <th>年末应收</th>
                                <for start="1" end="$month_number1" >
                                    <th>{pigcms{$i}月应收</th>
                                    <th>{pigcms{$i}月已收</th>
                                </for>
                                <th>备注</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="test" style="display: none" id="spinner">
    <div class="spinner" >
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
    <div style="
    background-color: #666;
    text-align:  center;">
        <span class="form-control" style="
    font-size: 30px;
    border: 0;
    color:rgba(255,255,255,1);
    background-color: #111;
">
            页面正在努力跳转，请稍作等待
        </span>
    </div>
</div>
</block>
<block name="script">
    <script>
        $('#project_list').change(
            function () {
                var p1=$(this).children('option:selected').val();
                window.location.href="__SELF__"+"&project_id="+p1;
            }
        )
        $('#sample_2').dataTable( {
            "footerCallback": function( tfoot, data, start, end, display ) {
                $(tfoot).find('th').eq(2).html( '{pigcms{$sum.num}' );
                $(tfoot).find('th').eq(3).html( '{pigcms{$sum.allprice}' );
                $(tfoot).find('th').eq(4).html( '{pigcms{$sum.sum_last}' );
                $(tfoot).find('th').eq(5).html( '{pigcms{$sum.sum_nowrecive}' );
                $(tfoot).find('th').eq(6).html( '{pigcms{$sum.sum_nowtrue}' );
                $(tfoot).find('th').eq(7).html( '{pigcms{$sum.sum_nowend}' );
                <for start="1" end="$month_number1" >
                var ab1=6+{pigcms{$i}*2;
                var ab2=7+{pigcms{$i}*2;
                $(tfoot).find('th').eq(ab1).html( '{pigcms{$sum['list'][$i]['sum_recive']}' );
                $(tfoot).find('th').eq(ab2).html( '{pigcms{$sum['list'][$i]['sum_true']}' );
                </for>
            },
                "scrollY" : true,
                    "scrollX": true,
                    fixedColumns : {
                    leftColumns : 4
                },
            } );
        function loading() {
            App.blockUI({
                target: "body",
                animate: !0
            });
            /*$('.page-spinner-bar').remove();
            $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');*/
        }
    </script>
</block>
<!--自定义js代码区结束-->
<!--<include file="Public_news:footer_news"/>-->