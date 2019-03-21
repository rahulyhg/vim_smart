<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'物业缴费记录',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('物业缴费记录','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/repair_type_add')}">
                    <button id="sample_editable_1_new" class="btn sbold green">新增缴费记录
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover">

        <thead>

        <tr>

            <th width="5%">缴费项</th>

            <th width="5%">已缴金额</th>

            <th width="10%">支付时间</th>

        </tr>

        </thead>

        <tbody>

        <if condition="$user_list">

            <volist name="user_list['user_list']" id="vo">

                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">

        <td><div class="tagDiv">{pigcms{$vo.order_name}</div></td>

        <td><div class="tagDiv">{pigcms{$vo.money}</div></td>

        <td><div class="shopNameDiv">{pigcms{$vo.pay_time|date='Y-m-d H:i:s',###}</div></td>

        </tr>

        </volist>

        <else/>

        <tr class="odd"><td class="button-column" colspan="11" >您没有任何缴费记录。</td></tr>

        </if>
        <tr>
            <td name="name" colspan="3">
                <input type="button" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=tenant_list_news'" class="btn green-sharp btn-outline  btn-block sbold uppercase" value="点击返回">
            </td>
        </tr>
        </tbody>

    </table>

    {pigcms{$user_list.pagebar}
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>



<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
