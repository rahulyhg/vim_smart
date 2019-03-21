<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台管理</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />

    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <!-- body 最后 -->
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

    <!-- 如果使用了某些拓展插件还需要额外的JS -->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

    <style type="text/css">
        body {font-family:"微软雅黑";}
        .zk {width:95%; margin:0px auto;}
        .zk2 {width:100%; margin-top:30px; border-radius:8px; background-color:#FFFFFF;}
        .sm {width:100%; height:30px; overflow:hidden; padding-top:12px;}
        .kk {width:5px; height:20px; float:left;}
        .kk2 {height:20px; line-height:20px; float:left; font-size:18px; margin-left:8px; color:#515455;}
        .kk3 {float:right; height:20px; line-height:20px; color:#b4b4b5; margin-right:14px;}
        .kk4 {float:right; margin-right:6px;}
        .xm {width:100%; padding-bottom:25px;}
        .d1 {width:29%; height:90px; border-radius:8px; float:left; background-color:#FFFFFF; box-shadow: 0px 5px 21px #ecf7ff; margin-left:2%; margin-right:2%; margin-top:14px;}
        .cw {width:80%; height:40px; line-height:40px; margin:0px auto; color:#4fadff; font-size:20px;}
        .cw2 {width:80%; height:16px; line-height:16px; margin:0px auto; color:#515455; font-size:14px;}
        .db {width:100%; border-radius:8px; background-color:#FFFFFF;}
        .tm {width:100%; height:40px; overflow:hidden; border-bottom:0.8px #dfdfdf solid;}
        .db2 {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf; margin-top:25px;}
        .tm2 {width:100%; height:40px; overflow:hidden;}
        .jk {width:90%; margin:0px auto;}
        .im {width:4%; float:left; padding-top:8px;}
        .im2 {width:45%; float:left; line-height:40px; color:#a1a1a8; margin-left:3%;font-size: 14px;}
        .im3 {width:35%; float:right; line-height:40px; color:#a1a1a8; font-size:14px; text-align:right;}
        .im4 {width:90%; float:left; line-height:40px; color:#a1a1a8; margin-left:3%;}
        .dht {width:100%; margin:0px auto; padding-bottom:10px;}
        .dht2 {width:25%; float:left; padding-top:20px;}
        .dht3 {width:50%; margin:0px auto;}
        .dht4 {width:100%; text-align:center; line-height:35px; color:#97979f; font-size:14px;}
        .both {clear:both;}
		.weui-select {
			-webkit-appearance: none;
			border: 0;
			outline: 0;
			background-color: transparent;
			width: 100%;
			font-size: inherit;
			height: 40px;
			line-height: 40px;
			position: relative;
			z-index: 1;
			padding-left:0px;
			font-size:16px;
			color:#a1a1a8;
		}
    </style>
</head>
<body style="background-color:#72c7fe;">


<div class="zk" style="padding-top:30px;">
    <div class="db">
        <div class="tm">
            <div class="jk">
                <div class="im"><img src="{pigcms{$static_path}images/137/tb1.jpg" style="width:100%; height:auto;" /></div>
<!--                <div class="im2">{pigcms{$village_name}</div>-->
                <div class="im2">
                    <div style="width:100%; float:left; overflow:hidden;">
						<select class="weui-select" name="select1" id="village_id_up">
                            <foreach name="villageAll" item="vo">
                                <option value="{pigcms{$vo.village_id}" <if condition="$village_id eq $vo['village_id']">selected</if> >{pigcms{$vo.village_name}</option>
<!--                        <option value="2">浦发银行大厦</option>-->
<!--                        <option value="3">钰龙时代中心</option>-->
                            </foreach>
                   		 </select>
					</div>
                </div>
                <div class="im3">

                    <input type="date" name="ym" value="{pigcms{$begin_time|date='Y-m-d',###}" id="time_ym"  style="background-color:#FFFFFF; height:25px; overflow:hidden; outline:none; border:1px #999999 solid; border-radius:4px; color:#727272; padding-left:5px;"/>

                </div>
                <div class="both"></div>
            </div>
        </div>
        <div class="dht">

            <foreach name="topArr" item="vo">
                <a href="{pigcms{$vo.url}"><div class="dht2">
                        <div class="dht3"><img src="{pigcms{$vo.custom_icon}" style="width:100%; height:auto;" /></div>
                        <div class="dht4">{pigcms{$vo.name}</div>
                    </div></a>
            </foreach>
            <div class="both"></div>
        </div>
    </div>
</div>
<div class="zk">
    <foreach name="bigArr" item="vo">
        <div class="zk2">
            <div class="sm">
                <div class="kk" style="background-color:#f8cf6a;"></div>
                <div class="kk2">{pigcms{$vo.name}</div>
<!--                <div class="kk3">{pigcms{$begin_time|date="Y-m-d",###}</div>-->
<!--                <div class="kk4"><img src="{pigcms{$static_path}images/137/tb.jpg" style="width:18px;" /></div>-->
                <div style="clear:both"></div>
            </div>
            <div class="xm">
                <foreach name="vo['son']" item="sv">
                    <a href="{pigcms{$sv.url}">
                        <div class="d1">
                            <div class="cw">{pigcms{$sv.data_value}&nbsp;{pigcms{$sv.unit}</div>
                            <div class="cw2">{pigcms{$sv.name}</div>
                        </div>
                    </a>
                </foreach>

                <div style="clear:both"></div>
            </div>
        </div>
    </foreach>


</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>

    // $("#time_ym").change(function(){
    //     var ym = $(this).val();
    //     window.location.href = "{pigcms{:U('administration')}"+"&ym="+ym;
    // });

    $("#time_ym").change(function(){
        var ym = $(this).val();
        var village_id = $("#village_id_up").val();
        window.location.href = "{pigcms{:U('administration')}"+"&ym="+ym+"&village_id="+village_id;
    });

    /*跳转相应项目*/
    $("#village_id_up").change(function(){
        var ym = $("#time_ym").val();
        var village_id = $(this).val();
        window.location.href = "{pigcms{:U('administration')}"+"&ym="+ym+"&village_id="+village_id;
    });
</script>
</body>
</html>