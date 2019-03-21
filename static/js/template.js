/***************************************************************************************************
 *
 * 模板选择js
 * @author 祝君伟 Morty zhu
 * @time 2017年12月14日14:40:16
 * @GitHua https://github.com/zjwForPHP
 * @WEB http://showmeyh.cn/wordpress/
 *
 ***************************************************************************************************/

$(function(){


    //申请公共变量

    var Curl = '/admin.php?g=System&c=PropertyService&a=choose_template'

    ;


    $('#checkbox2').click(function () {
        if($('#checkbox2').is(':checked')){
            $('#wy').show();
        }else {
            $('#wy').hide();
        }

    });


    $('#checkbox1').click(function () {
        if($('#checkbox1').is(':checked')){
            $('#sd').show();
        }else {
            $('#sd').hide();
        }
    });

    $('#confirm_template').click(function(){
        console.log(1);
        var check1 = $('#checkbox1').is(':checked'),
            check2 = $('#checkbox2').is(':checked'),
            month  = $('#confirm_template').attr('data-month'),
            pay_id = $('#confirm_template').attr('data-pay'),
            ym = $('#confirm_template').attr('data-ym'),
            type   = 0
        ;


        if(check1&&check2){
            type   = 1;
            outList(type,pay_id,ym);
        }else if(!check1&&check2){
            type   = 2;
            outList(type,pay_id,ym);
        }else if(check1&&!check2){
            if(month=='03'||month=='06'||month=='09'||month=='12'){

                swal({
                    title: "不发送物业缴费通知吗？",
                    text: "本月为季度末尾，确定不发送物业费催缴吗？",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "发送",
                    cancelButtonText: "不发送",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        type   = 1;
                        outList(type,pay_id,ym);
                    } else {
                        type   = 3;
                        outList(type,pay_id,ym);
                    }
                });
            }else{
                console.log(1);
                type   = 3;
                outList(type,pay_id,ym);
            }

        }else{
            outList(type,pay_id,ym);
        }

    });

    function outList(type,pay_id,ym){
        $.ajax({
            url:Curl,
            data:{'type':type,'pay_id':pay_id,'ym':ym},
            type:'post',
            success:function (res) {
                if(res==0){
                    swal({
                        title: "发送成功！",
                        text: "客户已经收到了相关信息",
                        type: "success",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "成功"

                    },
                        function(){
                            window.location.reload();
                        }
                    );
                }else if(res==4){
                    swal({
                        title: "出账完成",
                        text: "请刷新页面查看最新数据",
                        type: "success",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "成功"

                    },
                        function(){
                            window.location.reload();
                        }
                    );
                }else{
                    swal({
                        title: "发送失败！",
                        text: "请联系技术人员！",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "成功"

                    });
                }
            }
        });
    }



});

