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
            <div class="kk2"><span >认证列表({pigcms{$count})</span></div>
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
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 25%;">真实姓名</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 25%;">公司名称</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 30%;">门禁卡</td>
                    <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 20%;">状态</td>
                </tr>
                <foreach name="list" item="vo">
                    <tr style="font-size: 12px;" onclick="aaa({pigcms{$vo.pigcms_id})">
                        <td height="40" align="center" style="color:#515455; border-bottom:1px #efefef solid;"><if condition="isset($vo['name'])">{pigcms{$vo.name}<else />未知</if></td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;"><span style="font-size: 12px;"><if condition="isset($vo['company_name'])">{pigcms{$vo.company_name|substr=###,0,30}<else />未知</if></span></td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;">
                            <if condition="$vo['card_type'] eq 1">
                                现场审核
                                <elseif condition="$vo['card_type'] eq 2" />
                                门禁卡
                                <elseif condition="$vo['card_type'] eq 3" />
                                身份证
                                <elseif condition="$vo['card_type'] eq 4" />
                                工牌
                                <else />
                                未知
                            </if>
                        </td>
                        <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;">
                            <if condition="$vo['ac_status'] eq 1">
                                <span style="color: #cc463d;">审核中</span>
                                <elseif condition="$vo['ac_status'] eq 2 or $vo['ac_status'] eq 4" />
                                <span style="color: #0dcecb;">通过</span>
                                <elseif condition="$vo['ac_status'] eq 3" />
                                <span style="color: #cc463d;">不通过</span>
                            </if>
                        </td>
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

<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<!-- sweetalert -->
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--<script src = "/Car/Home/Public/statics/plublic/js/sweetalert.min.js"></script>-->
<script>
    var search = $("#searchInput").val();
    var village_id = "{pigcms{$village_id}";
    var time = "{pigcms{$time}";
    var type = "{pigcms{$type}";
    var lt = 0;
    var gt = 0;

    function sea() {
        search = $("#searchInput").val();
        window.location.href = "{pigcms{:U('userCheck_index_news')}"+"&type="+type+"&search="+search+"&ym="+time+"&village_id="+village_id;
    }

    $(window).keyup(function(event) {
        if(event.keyCode ==13){
            search = $("#searchInput").val();
            window.location.href = "{pigcms{:U('userCheck_index_news')}"+"&type="+type+"&search="+search+"&ym="+time+"&village_id="+village_id;
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
            if (gt < 10) {
                $(document.body).destroyInfinite();
                $("#okya").hide();
            }
            $.ajax({
                url:"{pigcms{:U('userCheck_index_news_ajax')}",
                type:"get",
                data:"&search="+search+"&ym="+time+"&more="+gt+"&village_id="+village_id,
                // dataType:'json',
                success:function (res) {
                    // console.log(res);
                    if (res){
                        $("#hehe").append(res);
                        // console.log(res);
                    } else {
                        $("#henfan").append("<p style='font-size: 12px;text-align: center;'> 已经到底啦 </p>");
                        $(document.body).destroyInfinite();
                        $("#okya").hide();
                    }

                }
            });
            loading = false;
        }, 200);   //模拟延迟
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

    function aaa(id) {
        window.location.href = "{pigcms{:U('userCheck_detail')}"+"&id="+id+"&ym="+time+"&village_id="+village_id;
    }


    function comeBack() {
        var begin_time = "{pigcms{$begin_time}";
        // alert(time);
        window.location.href = "{pigcms{:U('administration')}"+"&ym="+begin_time+"&village_id="+village_id;

    }




</script>
</body>
</html>