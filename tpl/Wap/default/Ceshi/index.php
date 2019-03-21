<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/example.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.min.css" rel="stylesheet" type="text/css" />
    <script src="./Car/Home/Public/statics/plublic/js/zepto.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/router.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/example.js"></script>
    <style type="text/css">
        <!--
        .we {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we:hover {background-color:#389ffe; color:#FFFFFF;}

        .we2 {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-left:2%; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we2:hover {background-color:#389ffe; color:#FFFFFF;}

        .weui_btn_primary {
            background-color: #389ffe;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
        -->
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<form action="{pigcms{:U('Ceshi/save')}" method="post" id="my_form">
    <input type="hidden" name="user_id" value="{$Think.session.user_id}">
    <div style="width:100%; height:50px; text-align:center; line-height:50px; background-color:#389ffe; color:#FFFFFF; font-size:18px;">完善资料</div>
    <div class="bd">
        <div class="weui_cells_title" style="margin-top:20px;">基本信息</div>
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">真实姓名</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" placeholder="请输入姓名" name="user_t_name" value=""/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="tel" placeholder="请输入手机号" name="user_phone" value=""/>
                </div>
            </div>
            <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">所属公司</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="user_commpany">
                        <option value="0">请选择</option>
                        <foreach name="company_array" item="vo">
                            <if condition="$old_user.company_name eq $vo.company_name">
                                <option value="{pigcms{$vo.company_name}" selected="selected">{$vo.company_name}</option>
                                <else/>
                                <option value="{pigcms{$vo.company_name}">{pigcms{$vo.company_name}</option>
                            </if>
                        </foreach>
                        <option value="其它">其它</option>
                    </select>
                </div>
            </div>

            <div class="weui_btn_area" id="showLoadingToast">
                <div class="weui_btn weui_btn_primary" id="button_pay_now">提交</div>
            </div>
        </div>

        <div style="padding-left:15px; padding-right:15px; padding-top:5px; padding-bottom:20px; color:#7f7f7f; line-height:1.5; font-size:12px;">我们会保证您的隐私资料不会被泄露，请放心填写。</div>
        <!--加载提示框开始-->
        <div id="loadingToast" style="display:none;">
            <div class="weui-mask_transparent"></div>
            <div class="weui-toast">
                <i class="weui-loading weui-icon_toast"></i>
                <p class="weui-toast__content">数据加载中</p>
            </div>
        </div>
    </div>
</form>
<script src="./Car/Home/Public/statics/plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="./Car/Home/Public/statics/plublic/js/sweetalert.min.js" type="text/javascript"></script>
<script src="./Car/Home/Public/statics/plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script>
    var flag = false;
    var flag1 = false;
    var flag2 = false;
    $(function(){
        var $loadingToast = $('#loadingToast');
        $('#showLoadingToast').on('click', function(){
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
        });
        $("input[name='card_number']").blur(function(){
            var card_type =$('#card_type option:selected').val();
            var card_number = $("input[name='card_number']").val();
            if(card_type == '身份证'){
                var reg =/^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;
                if(!reg.test(card_number)){
                    swal({
                        title: "您的身份证号码有误！",
                        text: "请您填写真实有效的身份证号码",
                        type: "warning",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    });
                    $("#button_pay_now").attr("disabled",true);
                }else if(card_number ==''){
                    swal({
                        title: "身份证号码不能为空",
                        text: "请您填写真实有效的身份证号码",
                        type: "warning",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    });
                    $("#button_pay_now").attr("disabled",true);

                }else{

                    flag = true;
                }
            }else if(card_number ==''){
                swal({
                    title: "证件号码不能为空",
                    text: "请您填写真实有效的证件号码",
                    type: "warning",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                });
                $("#button_pay_now").attr("disabled",true);

            }else{

                flag = true;
            }
        });

        $("input[name='user_phone']").blur(function(){
            var user_phone = $("input[name='user_phone']").val();
            var reg =/^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(user_phone == ''){
                swal({
                    title: "电话号码不能为空",
                    text: "请您填写真实有效的电话号码",
                    type: "warning",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                });
                $("#button_pay_now").attr("disabled",true);

            }else if(user_phone.length !=11){
                swal({
                    title: "电话号码格式错误！",
                    text: "请您填写真实有效的电话号码",
                    type: "warning",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                });
                $("#button_pay_now").attr("disabled",true);

            }else if(!reg.test(user_phone)) {
                swal({
                    title: "电话号码格式错误！",
                    text: "请您填写真实有效的电话号码",
                    type: "warning",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                });
                $("#button_pay_now").attr("disabled",true);

            }else{
                $.ajax({
                    url:"{:U('User/check_user_phone')}",
                    data:{'user_phone':user_phone},
                    type:'post',
                    success:function(msg){
                        if(msg == '1'){
                            swal({
                                title: "电话号码已被注册！",
                                text: "请您填写真实有效的电话号码",
                                type: "warning",
                                confirmButtonText: "确定",
                                closeOnConfirm: false
                            });
                        }else{
                            flag1 = true;
                        }
                    }
                });


            }

        });

        $("input[name='user_t_name']").blur(function(){
            var user_t_name = $("input[name='user_t_name']").val();
            if(user_t_name == ''){
                swal({
                    title: "真实姓名不能为空！",
                    text: "请您填写真实的姓名",
                    type: "warning",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                });
                $("#button_pay_now").attr("disabled",true);

            }else{
                flag2=true;

            }
        });

        $('#button_pay_now').click(function(){
            $("#my_form").submit();
        });

    });

</script>
</body>
</html>
