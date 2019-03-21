<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'物业缴费',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('缴费明细','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">

    <table class="table table-striped table-bordered table-hover" id="sample_1">

        <thead>

        <tr>

            <th width="5%">编号</th>

            <th width="5%">订单名称</th>

            <th width="5%">缴费单位/公司/个人</th>

            <th width="5%">所属项目</th>

            <th width="5%">实缴费</th>

            <th width="5%">缴费时间</th>


        </tr>

        </thead>

        <tbody>


            <volist name="order_list" id="vo" key="i">
                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">

                            <td><div class="tagDiv">{pigcms{$vo.order_id}</div></td>

                            <td><div class="tagDiv">{pigcms{$vo.order_name}</div></td>

                            <if condition="$vo.nickname eq ''">
                                <td><div class="tagDiv">{pigcms{$vo.realname}</div></td>
                            <else/>
                                <td><div class="tagDiv">{pigcms{$vo.nickname}</div></td>
                            </if>

                            <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>

                            <td><div class="tagDiv">{pigcms{$vo.money}</div></td>

                            <td><div class="tagDiv">{pigcms{$vo.time|date='Y-m-d',###}</div></td>
                    </tr>
            </volist>

        </tbody>

    </table>
    

</div>

<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    //隐藏
    $('.summary').hide();
</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
