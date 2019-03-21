<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'收件管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('收发快递','#'),
    array('收件管理','#'),
);
//$add_action = array(
//    'url'=>U('UserExpress/add'),
//    'name'=>'寄件'
//)
?>
<!--头部设置结束-->
<include file="Public_news:header"/>

<style>
    .popover-content .form-group{margin-bottom: 10px}
    .popover-content .form-group input{
        display: inline-block;
    }
</style>

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
        <th style="text-align: center;">编号(order_id)</th>
        <th>寄件人昵称</th>
        <th>寄件人 <br><span style="font-size: smaller;font-weight:normal; color:#666" >点击查看详细</span> </th>
        <th>收件人 <br><span style="font-size: smaller;font-weight:normal; color:#666" >点击查看详细</span> </th>
        <th>快件类型</th>
        <th>邮寄方式</th>
        <th>快递单号</th>
        <th>查看物流</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <volist name="list" id="row">
        <tr class="odd gradeX"
            order_id = "{pigcms{$row.order_id}"
            user_id = "{pigcms{$row.bad_uid}"
        >
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="1" />
                    <span></span>
                </label>
            </td>
            <td style="text-align: center;width: 5%;">{pigcms{$row.order_id}</td>
            <td>{pigcms{$row.nickname}</td>
            <td>
                <div style="cursor: pointer" class="bad_info"
                     info_adid="{pigcms{$row.billing_adid}"
                     info_phone="{pigcms{$row.bad_phone}"
                     info_name="{pigcms{$row.bad_name}"
                     info_detail="{pigcms{$row.bad_detail}"
                >
                    {pigcms{$row.bad_name}
                </div>
            </td>
            <td>
                <div style="cursor: pointer" class="sad_info"
                     info_adid="{pigcms{$row.shipping_adid}"
                     info_phone="{pigcms{$row.sad_phone}"
                     info_name="{pigcms{$row.sad_name}"
                     info_detail="{pigcms{$row.sad_detail}"
                >
                    {pigcms{$row.sad_name}
                </div>
            </td>

            <td><?php echo $row['goods_type_name']?></td>
            <td>
                {pigcms{$row['billing_type_id']}
            </td>
            <td>
                <a href = "{pigcms{:U('modal_bind_emsorderid',array('order_id'=>$row['order_id']))}"
                   data-toggle="modal"
                   data-target="#modal_{pigcms{$row.order_id}"
                   onclick="modal_bind({pigcms{$row.order_id})"
                >

                    {pigcms{$row['ems_order_id'] ? $row['ems_order_id'] : "绑定快递单号"}
                </a>


            </td>
            <td>
                <a href="{pigcms{:U('modal_express_trail',array('order_id'=>$row['order_id']))}"
                   data-toggle="modal"
                   data-target="#modal_express_trail_{pigcms{$row.order_id}"
                >查看物流</a>
            </td>
            <td>
                {pigcms{$row.create_time|date="Y-m-d H:i:s",###}
            </td>
            <td>
                <a  class="send_msg">通知用户</a>
                <a href = "{pigcms{:U('modal_detail',array('order_id'=>$row['order_id']))}"
                   data-toggle="modal"   data-target="#modal_detail_{pigcms{$row.order_id}" class="show_detail">查看详情</a>
                <a href="" class="delete">删除</a>
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_<?php echo $row['order_id']?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_detail_<?php echo $row['order_id']?>">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_express_trail_<?php echo $row['order_id']?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </td>

        </tr>
    </volist>
    </tbody>

</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script src="{pigcms{$static_path}js/user_express.js"></script>
<script>


    var modal_bind = function (order_id){
        //弹出层弹出后的回调操作
        $('#modal_'+ order_id.toString()).on('shown.bs.modal', function (e) {
            var $bar_code = $(this).find('.bar_code');
            //光标自动转到input框
            $bar_code.focus()
            //清空值
            $bar_code.val('');
            //回车自动提交
            $bar_code.bind('keydown',function(event){

                if(event.keyCode == "13") {

                    bind_ems_order_id(order_id,$bar_code.val());
                }
            });
        })
    }
    /**
     * 保存快递单号
     * @param order_id 下单单号
     */
    var bind_ems_order_id = function(order_id,ems_order_id){
        var url = "{pigcms{:U('bind_emsorderid_act')}";
        var param = {
            'order_id':order_id,
            'ems_order_id':ems_order_id
        };
        var callback = function(re){
            $('#modal_'+ order_id.toString()).modal('hide').on('hidden.bs.modal', function (e) {
                //关闭弹出层
                //这里可以写一些关闭前的回调函数
            })
            if(re.err===0){
                app.suc(re.msg,"");
                //更新成功后替换单号text
                $("[data-target='#modal_"+order_id+"']").text(ems_order_id);
            }else{
                app.err(re.msg,"")
            }

        }
        app.ajax({
            url:url,
            data:param,
            success:callback,
        });
    }



    $(document).ready(function(){
        //微信推送消息
        $('.send_msg').click(function(){
            var order_id = $(this).parents('tr').attr('order_id');
            var url = "{pigcms{:U('send_msg')}";
            var param = {order_id:order_id};
            var callback = function (re){
                if(re.err===0){
                    app.suc(re.msg);
                }else{
                    app.err(re.msg)
                }
            };
            app.ajax({
                url:url,
                data:param,
                success:callback,
            });
            return false;
        });
        //删除操作
        $('.delete').click(function() {
            var order_id = $(this).parents('tr').attr('order_id');
            //删除时弹出的confirm
            app.warm("删除操作", "你确定删除该条订单记录", function () {
                var url = "{pigcms{:U('del_shipping')}";
                var param = {
                    'order_id': order_id,
                };
                var callback = function (re) {
                    if (re.err === 0) {
                        app.suc(re.msg);
                    } else {
                        app.err(re.msg)
                    }
                }
                app.ajax({
                    url: url,
                    data: param,
                    success: callback,
                });

            });
            return false;
        });



        app.user_popover('.bad_info');
        app.user_popover('.sad_info');
    });









</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>