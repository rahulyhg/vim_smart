<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>后台管理</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/Car/Home/Public/statics/plublic/css/smart-house/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="/Car/Home/Public/statics/plublic/css/smart-house/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="/Car/Home/Public/statics/plublic/css/smart-house/weui.css"/>
    <link rel="stylesheet" type="text/css" href="/Car/Home/Public/statics/plublic/css/smart-house/animate.css"/><!--7.18晚-->
    <link href="/Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!--<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>-->
    <link rel="stylesheet" type="text/css" href="/Car/Home/Public/statics/plublic/css/smart-house/style.css"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="/Car/Home/Public/statics/plublic/js/smart-js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Car/Home/Public/statics/plublic/js/smart-js/common.js" charset="utf-8"></script>
    <!--<script src="{pigcms{$static_public}boxer/js/jquery-1.8.3.min.js"></script>-->
    <script src="/Car/Home/Public/statics/plublic/js/smart-js/zepto.min.js"></script><!--7.18晚-->
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
        .shtx_kek {
            float: left;
            line-height: 33px;
            border: 0;
            font-size: 14px;
            margin-left: 8px;
            width: 60%;
            color: #b6b6b6;
            white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            overflow: hidden;
        }
        -->
        .pageSliderHide {
            background: #0b94ea;
        }
        .weui_btn {
            background: #0b94ea;
        }
    </style>
</head>
<body>
<if condition="$user_info.pay_type eq 1">
<header class="pageSliderHide"><div id="backBtn" onclick="come_back()"></div>新开月卡审核</header>
<form id="access_form" onSubmit="return false;">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.user_t_name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">联系方式&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--18086681360-->{pigcms{$user_info.user_phone}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">公司名称&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$user_info.user_commpany}
            </div>
            <div class="both"></div>
        </div>
    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
            <div class="kkw">证件类型&nbsp;&nbsp;</div>
            <div class="shtx_kk">
                <if condition="$user_info['card_type'] eq 1">现场审核
                <elseif condition="$user_info['card_type'] eq 2" />门禁卡
                    <elseif condition="$user_info['card_type'] eq 3" />身份证
                    <elseif condition="$user_info['card_type'] eq 4" />工牌
                </if></div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
            <div class="kkw">证件号&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527-->{pigcms{$user_info.card_number}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/car_26px_1172317_easyicon.net.png" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">车牌号&nbsp;&nbsp;</div>
            <div class="shtx_kk">{pigcms{$user_info.car_no}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
            <div class="kkw">开通时长&nbsp;&nbsp;</div>
            <div class="shtx_kk">{pigcms{$user_info.how_long}个月</div>
            <div class="both"></div>
        </div>
    </div>
    <div class="zkd">
        <div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" id="do_finish_one">待处理</a></div>
        <div style="float:right;width:48%;"><a href="TEL:{pigcms{$user_info.user_phone}" class="weui_btn weui_btn_warn btn_check">点击拨打电话</a></div>
        <div style="clear:both"></div>
    </div>
</form>
    <else />
    <header class="pageSliderHide"><div id="backBtn" onclick="come_back()"></div>月卡延期</header>
    <form id="access_form" onSubmit="return false;">
        <div class="shtx_dkx">
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
                <div class="kkw">姓名&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.user_t_name}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
                <div class="kkw">联系方式&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--18086681360-->{pigcms{$user_info.user_phone}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
                <div class="kkw">公司名称&nbsp;&nbsp;</div>
                <div class="shtx_kek">{pigcms{$user_info.user_commpany}
                </div>
                <div class="both"></div>
            </div>
        </div>
        <div class="shtx_dk2">
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
                <div class="kkw">证件类型&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$user_info.card_type}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
                <div class="kkw">证件号&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--9527-->{pigcms{$user_info.card_number}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/car_26px_1172317_easyicon.net.png" style="width:12px; height:18px; margin-top:8px;"/></div>
                <div class="kkw">车牌号&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$user_info.car_no}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
                <div class="kkw">延期日期至&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$user_info.how_long}</div>
                <div class="both"></div>
            </div>
        </div>
        <div class="zkd">
            <div ><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" id="do_finish" onclick="come_back()">返回</a></div>
            <div style="clear:both"></div>
        </div>
    </form>
</if>
<script src="/Car/Home/Public/statics/plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Home/Public/statics/plublic/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Home/Public/statics/plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script>
    $(function(){
        var check_id = "{pigcms{$Think.get.check_id}";
        $.ajax({
            url:"{pigcms{:U('is_have_admin_check')}",
            data:{'check_id':check_id},
            type:'post',
            async: false,
            success:function(res){
                if(res=='1'){
                    $("#do_finish_one").text("待处理");
                }else{
                    $("#do_finish_one").text("已处理");
                }
            }
        });
    });
    $("#do_finish_one").click(function(){
        var car_no = "{pigcms{$user_info.car_no}";
        var user_id = "{pigcms{$user_info.user_id}";
        var how_long = "{pigcms{$user_info.how_long}";
        var check_id = "{pigcms{$Think.get.check_id}";
        var admin_id = "{pigcms{$admin_info.user_id}";
        var garage_id = "{pigcms{$user_info.garage_id}";
        $.ajax({
            url:"{pigcms{:U('is_have_admin_check')}",
            data:{'check_id':check_id},
            type:'post',
            async: false,
            success:function(res){
                if(res=='1'){
                    swal({
                        title: "请确保车辆"+car_no+"月卡开通成功！",
                        text: "用户已完成缴费，请确认开通后再处理，如有异议请电话通知客户",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "继续",
                        confirmButtonColor: "#FE575E",
                        cancelButtonText:"取消",
                        showLoaderOnConfirm: true,
                    },function(){
                        tell_system_true(car_no,user_id,how_long,check_id,admin_id,garage_id);
                    });
                }else{
                    swal({
                        title: "该流程审核已经完成!",
                        text: "无需再次审核，谢谢您！",
                        type: "info",
                        closeOnConfirm: false,
                        confirmButtonText: "继续",
                        confirmButtonColor: "#FE575E",
                    },function(){
                        window.location.href ="{pigcms{:U('admin_show_list_all')}";
                    });
                }
            }
        });
    });

    function tell_system_true(car_no,user_id,how_long,check_id,admin_id,garage_id){
        //三重验证
        $.ajax({
            url:"{pigcms{:U('change_car_yue')}",
            data:{'car_no':car_no,'user_id':user_id,'how_long':how_long,'check_id':check_id,'admin_id':admin_id,'garage_id':garage_id},
            async: false,
            type:'post',
            success:function(msg){
                console.log(msg);
                if(msg == '1'){
                    setTimeout(function(){
                        swal({
                            title: car_no+"的月卡信息已上传成功",
                            text: "提示：上传成功即视为开卡成功！",
                            type: "success",
                            closeOnConfirm: false,
                            confirmButtonText: "完成",
                            confirmButtonColor: "#FE575E",
                        }, function() {
                            //跳转到首页
                            window.location.href ="{pigcms{:U('admin_show_list_all')}";
                        });
                    },2000);
                }else{
                    swal({
                        title: "很抱歉！月卡信息提交失败了！",
                        text: "请点击确认，刷新页面重试！",
                        type: "info",
                        closeOnConfirm: false,
                        confirmButtonText: "继续",
                        confirmButtonColor: "#FE575E",
                    }, function() {
                        //不作任何操作
                        window.location.reload();
                    });
                }
            }
        });
    }

    function come_back(){
        window.location.href ="{pigcms{:U('admin_show_list_all')}";
    }




</script>
</body>
</html>