<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'预约管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('预约管理','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <!--            //编号	排序	商品名称	价格	单位	销售量	最后操作时间	状态	操作-->
            <th >编号</th>
            <th >名称</th>
            <th >价格</th>
            <th >单位</th>
            <th >预约次数</th>
            <th >最后操作时间</th>
<!--            <th >状态</th>-->
            <th class="button-column">操作</th>
        </tr>
        </thead>
        <tbody>

        <volist name="list" id="row">
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
            <td><div class="tagDiv">{pigcms{$row.meal_id}</div></td>
            <td><div class="tagDiv">{pigcms{$row.name}</div></td>
            <td><div class="tagDiv">{pigcms{$row.price}</div></td>
            <td><div class="tagDiv">{pigcms{$row.unit}</div></td>
            <td><div class="tagDiv">{pigcms{$row.sell_count}</div></td>
            <td><div class="tagDiv">{pigcms{$row.last_time|date="Y-m-d H:i",###}</div></td>
<!--            <td><div class="tagDiv">{pigcms{$row.status}</div></td>-->
            <td class="button-column">
                <a href="{pigcms{:U('modal_edit_appointment_cate',array('meal_id'=>$row['meal_id']))}"
                   data-toggle="modal"
                   data-target="#modal_edit_{pigcms{$row.meal_id}"
                >
                    编辑
                </a>
            </td>
            </tr>
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_<?php echo $row['meal_id']?>">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </volist>
        </tbody>
    </table>
    <if condition="$repair_list['totalPage'] gt 1">{pigcms{$repair_list.pagebar}</if>
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
