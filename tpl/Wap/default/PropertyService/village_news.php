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
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="http://www.hdhsmart.com/Car/Admin/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">


    <style type="text/css">
        body {font-family:"微软雅黑";}
        .zk {width:95%; margin:0px auto;}
        .zk2 {width:100%; margin-top:30px; border-radius:8px; background-color:#FFFFFF;}
        .sm {width:100%; height:46px; overflow:hidden; padding-top:12px;}
        .kk {width:5px; height:20px; float:left; margin-top:8px;}
        .kk2 {height:20px; line-height:20px; float:left; font-size:16px; margin-left:8px; color:#515455; margin-top:8px;}
        .kkf {float:right; height:34px; margin-right:14px;width: 45%;}
        .xm {width:100%; height:8px; overflow:hidden; border-bottom:1px #e1e1e1 solid;}

    </style>
</head>
<body style="background-color:#72c7fe;">
<div class="zk">
    <div class="zk2" >
        <div class="sm">
            <div class="kk" style="background-color:#f8cf6a;"></div>
            <div class="kk2"><span ><if condition="$point_status eq 1">已上线项目<else />项目数</if>({pigcms{$count})</span></div>
            <div class="kk2"><span onclick="comeBack()" >返回</span></div>
            <div class="kkf">
                <div class="input-icon right" style="font-size: 12px;">
                    <i class="fa fa-search" onclick="sea()" style="width: 25%;"></i>
                    <input type="text" class="form-control input-circle" id="searchInput" <if condition="isset($searchV)">value="{pigcms{$searchV}"<else />placeholder="搜索"</if> >
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="xm"></div>
        <!--        <php>dump($is_record)</php>-->
        <div style="width:100%;" id="henfan">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="hehe">
                <tr>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;">项目名称</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 22%;">物业名称</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 30%;">物业电话</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 18%;">状态</td>
                </tr>
                <foreach name="list" item="vo">
                    <tr style="font-size: 12px;">
                        <td height="40" align="center" style="color:#515455; border-bottom:1px #efefef solid;">{pigcms{$vo.village_name}</td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;"><span style="font-size: 12px;">{pigcms{$vo.property_name|substr=###,0,15}</span></td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;">{pigcms{$vo.property_phone}</td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;"><if condition="$vo['status'] eq 1">正常<else /><span style="color: #cc463d;">未开放</span></if></td>
                    </tr>
                </foreach>
            </table>
        </div>
        <div class="weui-loadmore" id="okya">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips" id="aiyo">正在加载</span>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<script>
    var search = $("#searchInput").val();
    var time = "{pigcms{$time}";
    var point_status = "{pigcms{$point_status}";
    var lt = 0;
    var gt = 0;

    function sea() {
        search = $("#searchInput").val();
        window.location.href = "{pigcms{:U('village_news')}"+"&point_status="+point_status+"&search="+search+"&ym="+time;
    }

    $(window).keyup(function(event) {
        if(event.keyCode ==13){
            search = $("#searchInput").val();
            window.location.href = "{pigcms{:U('village_news')}"+"&point_status="+point_status+"&search="+search+"&ym="+time;
        }
    });


    $(document.body).infinite();

    $(document.body).infinite(50);

    var loading = false;  //状态标记
    $(document.body).infinite().on("infinite", function() {
        if(loading) return;
        loading = true;
        setTimeout(function() {
            lt = 0;
            $("#hehe tr").each(function() {
                lt ++;
            });
            gt = parseInt(lt)-1;
            $.ajax({
                url:"{pigcms{:U('village_news_ajax')}",
                type:"get",
                data:"point_status="+point_status+"&search="+search+"&ym="+time+"&more="+gt,
                // dataType:'json',
                success:function (res) {
                    if (res){
                        console.log(gt);
                        $("#hehe").append(res);
                    } else {
                        $("#henfan").append("<p style='font-size: 12px;text-align: center;'> 已经到底啦 </p>");
                        $(document.body).destroyInfinite();
                        $("#okya").hide();
                    }

                }
            });
            loading = false;
        }, 500);   //模拟延迟
    });

    lt = 0;
    $("#hehe tr").each(function() {
        lt ++;
    });
    gt = parseInt(lt)-1;
    if (gt < 10) {
        $(document.body).destroyInfinite();
        $("#okya").hide();
    }

    function comeBack() {
        var time = "{pigcms{$begin_time}";
        // alert(time);
        window.location.href = "{pigcms{:U('administration')}"+"&ym="+time;

    }


</script>
</body>
</html>