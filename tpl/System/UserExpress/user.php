<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'用户管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('收发快递','#'),
    array('用户管理','#'),
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
<!--        <th>-->
<!--            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">-->
<!--                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />-->
<!--                <span></span>-->
<!--            </label>-->
<!--        </th>-->
<!--        code-->

        <th>编号(uid)</th>
        <th>昵称</th>
        <th>注册手机号</th>
        <th>最后发件时间</th>
        <th>寄件记录</th>
    </tr>
    </thead>

    <tbody>
    <if condition="is_array($list)">
    <volist name="list" id="row">
            <tr class="odd gradeX"
                order_id = "{pigcms{$row.order_id}"
                user_id = "{pigcms{$row.bad_uid}"
            >
<!--                <td>-->
<!--                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">-->
<!--                        <input type="checkbox" class="checkboxes" value="1" />-->
<!--                        <span></span>-->
<!--                    </label>-->
<!--                </td>-->
                <td>{pigcms{$row.uid}</td>
                <td>{pigcms{$row.nickname}</td>
                <td>{pigcms{$row.phone}</td>
                <td>{pigcms{$row.last_billing_time|date="Y-m-d H:i",###}</td>
                <td><a href="{pigcms{:U('shipping',array('user_id'=>$row['uid']))}">寄件记录</a></td>
            </tr>
<!--        code-->
           </volist>
            <tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
            <else/>
            <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
            </if>
    </tbody>

</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
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
                swal({
                    title: re.msg,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false,
                    type:'success',
                });
                //更新成功后替换单号text
                $("[data-target='#modal_"+order_id+"']").text(ems_order_id);
            }else{
                swal({
                    title: re.msg,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false,
                    type:'error',

                });
            }

        }
        var dataType = "json";

        $.ajax({
            url:url,
            data:param,
            type:'get',
            dataType:dataType,
            success:callback,
            error:function(xhr,stu,err){
                console.log(xhr);
                console.log(stu);
                console.log(err);
            }
        });
    }



    $(document).ready(function(){
        //微信推送消息
        $('.send_msg').click(function(){
            var order_id = $(this).parents('tr').attr('order_id');
            var url = "{pigcms{:U('send_msg')}";
            var param = {order_id:order_id};
            var dataType = "json";
            var callback = function (re){
                if(re.err===0){
                    swal({
                        title: re.msg,
                        text: "",
                        timer: 1000,
                        showConfirmButton: false,
                        type:'success',
                    });
                }else{
                    swal({
                        title: re.msg,
                        text: "",
                        timer: 1000,
                        showConfirmButton: false,
                        type:'error',
                    });
                }
            };
            $.ajax({
                url:url,
                data:param,
                type:'get',
                dataType:dataType,
                success:callback,
                error:function(xhr,stu,err){
                    swal({
                        title: "发生错误！",
                        text: "",
                        timer: 1000,
                        showConfirmButton: false,
                        type:'error',
                    });
                }
            });
            return false;
        });





        /**
         * 删除操作
         */

        $('.delete').click(function(){

            var order_id = $(this).parents('tr').attr('order_id');
            //删除时弹出的confirm
            swal({
                    title: "删除操作",
                    text: "你确定删除该条订单记录",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                },
                //点击确定后的回调
                function(){
                    var url = "{pigcms{:U('del_shipping')}";
                    var param = {
                        'order_id':order_id,
                    };
                    var callback = function(re){
                        if(re.err===0){
                            swal({
                                title: re.msg,
                                text: "",
                                timer: 1000,
                                showConfirmButton: false,
                                type:'success',
                            });
                        }else{
                            swal({
                                title: re.msg,
                                text: "",
                                timer: 1000,
                                showConfirmButton: false,
                                type:'error',

                            });
                        }

                    }
                    var dataType = "json";
                    $.ajax({
                        url:url,
                        data:param,
                        type:'get',
                        dataType:dataType,
                        success:callback,
                        error:function(xhr,stu,err){
                            console.log(xhr);
                            console.log(stu);
                            console.log(err);
                        }
                    });
                }
            );
            return false;
        });

        //悬浮查看用户详细
        $('.bad_info').popover({
            trigger:'hover',
            html:true,
            title:'详细',
            placement:'top'
        });

        $('.sad_info').popover({
            trigger:'hover',
            html:true,
            title:'详细',
            placement:'top'
        });

    });


</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
