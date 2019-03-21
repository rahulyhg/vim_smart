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
        .pageSliderHide{
            background: #0b94ea;
        }
        .weui_btn{
            background: #0b94ea;
        }
    </style>
</head>
<body>
<header class="pageSliderHide"><div id="backBtn" onclick="come_back()"></div>发票领取</header>
<form id="access_form" onSubmit="return false;">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.user_t_name}</div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">用户名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.user_name}</div>
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
            <div class="kkw">领取方式&nbsp;&nbsp;</div>
            <div class="shtx_kek">{pigcms{$user_info.receive_type_name}
            </div>
            <div class="both"></div>
        </div>
    </div>
    <div>
        <div id="aaa">点击显示发票</div>
        <div id="bbb" style="display: none;">点击关闭发票</div>
    </div>
    <div id="fapiao" style="display: none;">
        <foreach name="list" item="vo">
        <div class="shtx_dk2">
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
                <div class="kkw">支付流水号&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$vo.pay_no}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
                <div class="kkw">车牌号&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$vo.car_no}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
                <div class="kkw">支付金额&nbsp;&nbsp;</div>
                <div class="shtx_kk"><!--9527-->{pigcms{$vo.payment}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/car_26px_1172317_easyicon.net.png" style="width:12px; height:18px; margin-top:8px;"/></div>
                <div class="kkw">支付时间&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</div>
                <div class="both"></div>
            </div>
            <div class="shtx_xm">
                <div class="shtx_pic"><img src="/Car/Home/Public/statics/plublic/img/smart-img/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
                <div class="kkw">支付人&nbsp;&nbsp;</div>
                <div class="shtx_kk">{pigcms{$vo.pay_user_name}</div>
                <div class="both"></div>
            </div>
        </div>
        </foreach>
    </div>
    <div class="zkd">
        <if condition="$bill_status eq 0"><div ><a href="javascript:;" onclick="link_url_on({pigcms{$bill_id},{pigcms{$bill_status})" class="weui_btn weui_btn_warn btn_check" >点击领取发票</a></div>
            <elseif condition="$bill_status eq 1" /><div ><a href="javascript:;" onclick="come_back()" class="weui_btn weui_btn_warn btn_check" >已处理</a></div>
        </if>
    </div>
</form>
<script src="/Car/Home/Public/statics/plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Home/Public/statics/plublic/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Home/Public/statics/plublic/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script>
    function link_url_on(id,status) {
        if (status == 0) {
            var tit = "您确定该发票通过审核吗";
        } else if (status == 1) {
            var tit = "您确定发票已领取完毕吗";
        } else {
            var tit = "您确定申领发票吗";
        }
        swal({
            title: tit,
            text: "确认请点击继续。",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "继续",
            confirmButtonColor: "#ec6c62",
            cancelButtonText:"取消",
            showLoaderOnConfirm: true,
        },function(){
            window.location.href = "{pigcms{:U('audit')}"+"&bill_id="+id+"&bill_status="+status;
        });

    }

    function come_back(){
        window.location.href ="{pigcms{:U('admin_show_list_all')}";
    }

    $("#aaa").click(function () {
        $("#aaa").hide();
        $("#fapiao").show();
        $("#bbb").show();
    });

    $("#bbb").click(function () {
        $("#bbb").hide();
        $("#fapiao").hide();
        $("#aaa").show();
    });


</script>
</body>
</html>