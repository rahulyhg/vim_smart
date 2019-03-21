<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>物业缴费</title>
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
<div class="zkd">
    <div class="hht"><img src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像" style="width:100%; height:100%; border-radius: 50%;" /></div>
    <div class="hht2">{pigcms{$now_user.nickname}</div>
    <div class="hht3">{pigcms{$village_name}</div>
    <a href="{pigcms{:U('PropertyService/pay_add_tenant',array('uid'=>$uid,'village_id'=>$village_id))}"><div class="htt4">新增</div></a>
</div>


<div class="tyt2">
    <if condition="isset($arr_zongji)">
        <foreach name="arr_zongji" item="vo">
            <a href="{pigcms{:U('PropertyService/pay_month_index',array('village_id'=>$_GET['village_id'],'pigcms_id'=>$vo['pigcms_id']))}">
                <div class="xrw">
                    <div class="f1"><img src="{pigcms{$static_path}images/gh1.png" style="width:100%; height:auto; " /></div>
                    <div class="f2" style="font-size: 12px;">{pigcms{$vo.tenantname}&nbsp;&nbsp;{pigcms{$vo.room_name}</div>
                    <div class="wb_arrow"></div>
                    <div style="clear:both"></div>
                </div>
            </a>
        </foreach>
        <else />
            <div class="xrw">
                <div class="f1"><img src="{pigcms{$static_path}images/gh1.png" style="width:100%; height:auto; " /></div>
                <div class="f2" style="font-size: 12px;">暂无绑定公司</div>
                <div class="wb_arrow"></div>
                <div style="clear:both"></div>
            </div>
    </if>
</div>


<div style="width:100%; height:30px; overflow:hidden;"></div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<!--	<php>$no_footer = false;</php>-->
<!--	<include file="Public:footer"/>-->
{pigcms{$hideScript}

</body>
</html>