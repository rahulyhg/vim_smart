<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>社区缴费</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .zkd {width:100%; height:240px; background:url({pigcms{$static_path}images/gbj.jpg) no-repeat center; background-size:100% 100%;}
        .tyt {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .tyt2 {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF; margin-top:20px;}
        .hht {width:80px; height:80px; padding-top:20px; margin:0px auto;}
        .hht2 {width:100%; padding-top:7px; line-height:1.5; text-align:center; color:#FFFFFF; font-size:18px;}
        .hht3 {width:100%; padding-top:7px; line-height:1.5; text-align:center; color:#FFFFFF; padding-bottom:13px;}
        .htt4 {border-radius:4px; color:#FFFFFF; border:1px #FFFFFF solid; width:25%; margin:0px auto; text-align:center; line-height:2;}
        .htt4:active {background-color:#FFFFFF; color:#3cb9ff;}
        .jt {width:100%; margin:0px auto; }
        .jt2 {width:33.3%; float:left; box-sizing: border-box; border-right:0.7px #f4f4f4 solid; padding-top:30px; padding-bottom:25px;}
        .jt3 {width:25%; margin:0px auto;}
        .jt4 {width:100%; text-align:center; line-height:2; color:#333333;}
        .xrw {width:100%; height:49px; overflow:hidden; border-bottom:1px #e7e7e7 solid;}
        .xrwt {width:100%; height:45px; overflow:hidden; line-height:45px; font-size:14px; padding-left:5%; color:#fb4746;}
        .xrw:active {background-color:#f5f5f5;}
        .xrwt:active {background-color:#fb4746; color:#FFFFFF;}
        .f1 {width:5%; float:left; padding-top:15px; margin-left:5%;}
        .f2 {width:75%; float:left; line-height:49px; margin-left:3%; color:#575e66;}
        .wb_arrow{
            border-right: 3px solid #a7b9d0;
            border-top: 3px solid #a7b9d0;
            height: 7px;
            width: 7px;
            float: right;
            margin-top: 18px;
            margin-right: 5%;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            border-left: 2px solid transparent;
            border-bottom: 2px solid transparent;
        }

    </style>
</head>
<body>
<div class="tyt2">
        <foreach name="date_str" item="vo" key="k">
            <a href="{pigcms{:U('PropertyService/pay_month',array('village_id'=>$village_id,'date'=>$k,'pigcms_id'=>$pigcms_id))}">
                <div class="xrw">
                    <div class="f2" style="font-size: 14px;">{pigcms{$k}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <if condition="$vo gt 0">(需缴费￥{pigcms{$vo})<else/>(无需缴费)</if>
                    </div>
                    <div class="wb_arrow"></div>
                    <div style="clear:both"></div>
                </div>
            </a>
        </foreach>
</div>
</body>
</html>