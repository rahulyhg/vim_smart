<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>快递收发</title>
    <!-- head 中 -->

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
        .zk2 {width:100%; margin-top:10px; border-radius:8px; background-color:#FFFFFF;}
        .sm {width:100%; height:46px; overflow:hidden; padding-top:12px;}
        .kk {width:5px; height:20px; float:left; margin-top:8px;}
        .kk2 {height:20px; line-height:20px; float:left; font-size:14px; margin-left:8px; color:#515455; margin-top:8px;}
        .kkf {float:right; height:34px; margin-right:14px;width: 45%;}
        .xm {width:100%; height:8px; overflow:hidden; border-bottom:1px #e1e1e1 solid;}
        #tab2{font-size:16px;}
    </style>
</head>
<body>
<!-- 容器 -->
<div class="weui-tab">
    <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
            用户信息
        </a>
        <a class="weui-navbar__item" href="#tab2">
            包裹入库
        </a>
        <a class="weui-navbar__item" href="#tab3">
            包裹出库
        </a>
    </div>
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <div class="zk">
                <div class="zk2" >
                    <div class="sm">
                        <div class="kk" style="background-color:#f8cf6a;"></div>
                        <div class="kk2"><span>包裹数({pigcms{$count})</span></div>
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
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;">运单号</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 22%;">姓名</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 30%;">提货码</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 18%;">状态</td>
                            </tr>
                            <foreach name="list" item="vo">
                                <tr style="font-size: 12px;" >
                                    <td height="40" align="center" style="color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.waybill_number}</td>
                                    <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})"><span style="font-size: 12px;">{pigcms{$vo.name}</span></td>
                                    <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.receipt_code}</td>
                                    <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" id="td_{pigcms{$vo.id}" <if condition="$vo['status'] neq 1">onclick="bbb({pigcms{$vo.id})"</if>>
                                        <if condition="$vo['status'] eq 0"><span style="color: #0e62cd;">已到站</span>
                                            <elseif condition="$vo['status'] eq 1"/><span style="color: #0ccfa3;">已提货</span>
                                            <elseif condition="$vo['status'] eq 2"/><span style="color: #cc463d;">顾客拒收</span>
                                            <elseif condition="$vo['status'] eq 3"/><span style="color: #cc463d;">站点拒签</span>
                                            <elseif condition="$vo['status'] eq 4"/><span style="color: #cc463d;">已退件</span>
                                        </if></td>
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
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">快递公司</label></div>
                    <div class="weui-cell__bd">
                        <select class="weui-select" name="company_id" id="selone">
                            <foreach name="company_list" item="vo">
                                <option value="{pigcms{$vo.company_id}">{pigcms{$vo.company_name}</option>
                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                    <div class="weui-cell__bd" >
                        <input class="weui-input" type="tel" name="phone" placeholder="请输入手机号" id="phoneCC">
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="name" placeholder="请输入姓名" id="nameCC">
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">运单编号</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  name="waybill_number" placeholder="请输入运单编号" id="waybill_numberCC">
                    </div>
                </div>
            </div>
            <div class="weui-form-preview__ft" style="font-size: 20px;">
                <button onclick="heihei()" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确定</button>
            </div>
            <br /><hr />
            <div style="width:100%;" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="in_database_one">
                    <tr>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;">运单号</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 22%;">姓名</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 30%;">提货码</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 18%;">状态</td>
                    </tr>
                    <foreach name="list_little" item="vo">
                        <tr style="font-size: 12px;" >
                            <td height="40" align="center" style="color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.waybill_number}</td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})"><span style="font-size: 12px;">{pigcms{$vo.name}</span></td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.receipt_code}</td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" id="td_{pigcms{$vo.id}" <if condition="$vo['status'] neq 1">onclick="bbb({pigcms{$vo.id})"</if>>
                            <if condition="$vo['status'] eq 0"><span style="color: #0e62cd;">已到站</span>
                                <elseif condition="$vo['status'] eq 1"/><span style="color: #0ccfa3;">已提货</span>
                                <elseif condition="$vo['status'] eq 2"/><span style="color: #cc463d;">顾客拒收</span>
                                <elseif condition="$vo['status'] eq 3"/><span style="color: #cc463d;">站点拒签</span>
                                <elseif condition="$vo['status'] eq 4"/><span style="color: #cc463d;">已退件</span>
                            </if></td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">运单编号</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  name="waybill_number" placeholder="请输入运单编号" id="waybill_numberDD">
                    </div>
                </div>
            </div>
            <div class="weui-form-preview__ft" style="font-size: 20px;">
                <button onclick="chuku()" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确定</button>
            </div>

            <br /><hr />
            <div style="width:100%;" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="in_database_two">
                    <tr>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;">运单号</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 22%;">姓名</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 30%;">提货码</td>
                        <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:16px; color:#909090;width: 18%;">状态</td>
                    </tr>
                    <foreach name="out_list" item="vo">
                        <tr style="font-size: 12px;" >
                            <td height="40" align="center" style="color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.waybill_number}</td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})"><span style="font-size: 12px;">{pigcms{$vo.name}</span></td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.id})">{pigcms{$vo.receipt_code}</td>
                            <td height="40" align="center" style="font-size:14px; color:#515455; border-bottom:1px #efefef solid;" id="td_{pigcms{$vo.id}" <if condition="$vo['status'] neq 1">onclick="bbb({pigcms{$vo.id})"</if>>
                            <if condition="$vo['status'] eq 0"><span style="color: #0e62cd;">已到站</span>
                                <elseif condition="$vo['status'] eq 1"/><span style="color: #0ccfa3;">已提货</span>
                                <elseif condition="$vo['status'] eq 2"/><span style="color: #cc463d;">顾客拒收</span>
                                <elseif condition="$vo['status'] eq 3"/><span style="color: #cc463d;">站点拒签</span>
                                <elseif condition="$vo['status'] eq 4"/><span style="color: #cc463d;">已退件</span>
                            </if></td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<script>
    var village_id = "{pigcms{$village_id}";
    var search = $("#searchInput").val();
    var time = "{pigcms{$time}";
    var point_status = "{pigcms{$point_status}";
    var lt = 0;
    var gt = 0;

    function sea() {
        search = $("#searchInput").val();
        window.location.href = "{pigcms{:U('express_delivery')}"+"&search="+search+"&ym="+time+"&village_id="+village_id;
    }

    $(window).keyup(function(event) {
        if(event.keyCode ==13){
            search = $("#searchInput").val();
            window.location.href = "{pigcms{:U('express_delivery')}"+"&search="+search+"&ym="+time+"&village_id="+village_id;
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
                url:"{pigcms{:U('express_delivery_ajax')}",
                type:"get",
                data:"point_status="+point_status+"&search="+search+"&ym="+time+"&more="+gt+"&village_id="+village_id,
                // dataType:'json',
                success:function (res) {
                    if (res){
                        // console.log(res);
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

    function aaa(id) {
        window.location.href = "{pigcms{:U('express_delivery_detail')}"+"&id="+id+"&ym="+time+"&village_id="+village_id;
    }

    function heihei(){

        var phone = $("#phoneCC").val(),
            name  = $("#nameCC").val(),
            waybill_number  = $("#waybill_numberCC").val(),
            cid   =  $('#selone option:selected') .val(),
            tip   = '运单号'+waybill_number+'已经入库'
        ;

        $.ajax({
            url:'{pigcms{:U("ajax_in_database")}',
            type:'post',
            data:{'phone':phone,'name':name,'waybill_number':waybill_number,'cid':cid},
            dataType:'json',
            success:function (res) {
                if(res.err == 0){
                    $.toast('入库成功');
                    $("#phoneCC").val('');
                    $("#nameCC").val('');
                    $("#waybill_numberCC").val('');
                    // console.log(res.data);
                    $("#in_database_one tr:eq(1)").before(res.data);
                }else{
                    $.toast(res.msg, "forbidden");
                }

            }
        });
    }

    function chuku(){
        var code = $("#waybill_numberDD").val(),
            tip   = '运单号'+code+'已经出库'
        ;

        $.ajax({
            url:'{pigcms{:U("ajax_out_database")}',
            type:'post',
            data:{'code':code},
            dataType:'json',
            success:function (res) {
                if(res.err == 0){
                    $.toast('出库成功');
                    $("#waybill_numberDD").val('');
                    $("#in_database_two tr:eq(1)").before(res.data);
                }else{
                    $.toast(res.msg, "forbidden");
                }

            }
        });
    }

    $("#phoneCC").change(function () {
        var phone = $("input[name='phone']").val();
        $.ajax({
            url:"{pigcms{:U('ajax_user_info')}",
            type:'post',
            data:{'phone':phone},
            success:function (res) {
                res && $("#nameCC").val(res);
            }
        });
    });

    function comeBack() {
        var time = "{pigcms{$begin_time}";
        // alert(time);
        window.location.href = "{pigcms{:U('administration')}"+"&ym="+time+"&village_id="+village_id;

    }

    function bbb(id) {
        var td = "#td_"+id;

    }

</script>
</body>
</html>