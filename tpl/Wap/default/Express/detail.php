<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>快递收发系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />


    <link href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.0/css/jquery-weui.min.css">
    <link href="{pigcms{$static_path}css/express/village.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/express/kui.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:14px;}
        header {
            height: 50px;
            background-color: #389ffe;
            color: white;
            line-height: 50px;
            text-align: center;
            position: relative;
            font-size: 18px;
        }
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
        a, a:visited, a:hover {
            color: #ffffff;
            text-decoration: none;
            outline: 0;
        }
        .weui_btn_primary {
            background-color: #389ffe;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
        .weui_btn {
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-left: 14px;
            padding-right: 14px;
            box-sizing: border-box;
            font-size: 17px;
            text-align: center;
            text-decoration: none;
            color: #FFFFFF;
            line-height: 2.5;
            border-radius: 5px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            overflow: hidden;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
            line-height: 20px;
            padding:2% 7% ;
        }
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body>
<header class="pageSliderHide"><div id="backBtn" onclick="history.go(-1)"></div>快递明细</header>
<div class="shtx_dkx">
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
        <div class="kkw">寄件人&nbsp;&nbsp;</div>
        <div class="shtx_kk">{pigcms{$info['out_name']}</div>
        <div class="both"></div>
    </div>
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
        <div class="kkw">收件人&nbsp;&nbsp;</div>
        <div class="shtx_kk">{pigcms{$info['get_name']}</div>
        <div class="both"></div>
    </div>
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/q7.jpg" style="width:12px; height:13px; margin-top:11px;"/></div>
        <div class="kkw">下单时间&nbsp;&nbsp;</div>
        <div class="shtx_kek">{pigcms{$info['create_time']|date="Y-m-d H:i:s",###}</div>
        <div class="both"></div>
    </div>

</div>
<div class="shtx_dk2">
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/car2.jpg" style="width:12px; height:14px; margin-top:10px;"/></div>
        <div class="kkw">寄件地址&nbsp;&nbsp;</div>
        <div class="shtx_kek">{pigcms{$info['out_village']}{pigcms{$info['out_detail']}</div>
        <div class="both"></div>
    </div>
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/car2.jpg" style="width:12px; height:14px; margin-top:10px;"/></div>
        <div class="kkw">收件地址&nbsp;&nbsp;</div>
        <div class="shtx_kek">{pigcms{$info['get_position']}{pigcms{$info['get_detail']}</div>
        <div class="both"></div>
    </div>
</div>
<div class="shtx_dk2">
    <div class="shtx_xm" id="car_nos">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/car2.jpg" style="width:12px; height:14px; margin-top:10px;"/></div>
        <div class="kkw">物品类型 &nbsp;&nbsp;</div>
        <div class="shtx_kek">
            {pigcms{$info['goods']}
        </div>

        <div class="both"></div>
    </div>
    <div class="shtx_xm" id="car_nos">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/car2.jpg" style="width:12px; height:14px; margin-top:10px;"/></div>
        <div class="kkw">保价费用 &nbsp;&nbsp;</div>
        <div class="shtx_kek">
            <if condition="$info['save_pay']">{pigcms{$info['save_pay']}元<else/>无</if>
        </div>

        <div class="both"></div>
    </div>
    <div class="shtx_xm">
        <div class="shtx_pic"><img src="{$Think.config.STATICS_URL}plublic/img/sb.png" style="width:12px; height:14px; margin-top:10px;"/></div>
        <div class="kkw">配送时间&nbsp;&nbsp;</div>
        <div class="shtx_kek">{pigcms{$info['express_time']|date="Y-m-d H:i:s",###}
        </div>
        <div class="both"></div>
    </div>
</div>
<!--<div class="alert-success">-->
<!--    {$status_info}-->
<!--</div>-->
<div class="zkd">
    <div style="float:left;width:48%;"><a class="weui_btn weui_btn_primary phone" href="TEL:{pigcms{$info['phone']}">电话联系</a></div>
    <div style="float:right;width:48%;"><a class="weui_btn weui_btn_primary" id="biaoji" status="{pigcms{$info['status']}">
            <if condition="$info['status'] eq 1">接单</if>
            <if condition="$info['status'] eq 2">已接单</if>
            <if condition="$info['status'] eq 3">已处理</if>
        </a></div>
    <div style="clear:both"></div>
</div>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.0/js/jquery-weui.min.js"></script>
<script>

    $(document).ready(function(){
        var order_id = "{pigcms{$info['order_id']}";
        $("#biaoji").click(function () {
            if($("#biaoji").attr('status')==1){
                $("#biaoji").text('已接单');
                $.ajax({
                    url:"{pigcms{:U('change_status1')}",
                    data:'order_id='+order_id,
                    type:'post',
                    dataType:'json',
                    success:function (res) {
                        if(res.error==0){
                            $("#biaoji").text('已接单');
                            $("#biaoji").attr('status',2);
                        }
                    }
                });
            }else if($("#biaoji").attr('status')==2){
                $.ajax({
                    url:"{pigcms{:U('change_status2')}",
                    data:'order_id='+order_id,
                    type:'post',
                    dataType:'json',
                    success:function (res) {
                        if(res.error==0){
                            $("#biaoji").text('已处理');
                            $("#biaoji").attr('status',3);
                        }
                    }
                })
            }
        })

    });




</script>
</body>
</html>