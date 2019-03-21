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
            寄出快递
        </a>
        <a class="weui-navbar__item" href="#tab2">
            收到快递
        </a>
        <a class="weui-navbar__item" href="#tab3">
            付款
        </a>
    </div>
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <div class="zk">
                <div class="zk2" >
                    <div class="xm"></div>
                    <!--        <php>dump($is_record)</php>-->
                    <div style="width:100%;" >
                        <if condition="$badList neq null">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="hehe">
                            <tr>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;">运单号</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 22%;">收件人</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 30%;">快件类型</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 18%;">操作</td>
                            </tr>
                            <foreach name="badList" item="vo">
                                <tr style="font-size: 12px;" >
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">{pigcms{$vo.ems_order_id}</td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})"><span style="font-size: 12px;">{pigcms{$vo.sad_name}</span></td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">{pigcms{$vo.goods_type_name}</td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">查看详情</td>
                                </tr>
                            </foreach>
                        </table>
                            <else />
                            <span style="font-size:14px; color:#909090;align-content: center;">暂无寄件信息</span>
                        </if>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <div class="zk">
                <div class="zk2" >
                    <div class="xm"></div>
                    <!--        <php>dump($is_record)</php>-->
                    <div style="width:100%;" >
                        <if condition="$sadList neq null">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="hehe">
                            <tr>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;">运单号</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 22%;">寄件人</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 30%;">快件类型</td>
                                <td height="40" align="center" style="border-bottom:1px #e1e1e1 solid; font-size:14px; color:#909090;width: 18%;">操作</td>
                            </tr>
                            <foreach name="sadList" item="vo">
                                <tr style="font-size: 12px;" >
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">{pigcms{$vo.ems_order_id}</td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})"><span style="font-size: 12px;">{pigcms{$vo.bad_name}</span></td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">{pigcms{$vo.goods_type_name}</td>
                                    <td height="40" align="center" style="font-size:12px; color:#515455; border-bottom:1px #efefef solid;" onclick="aaa({pigcms{$vo.order_id})">查看详情</td>
                                </tr>
                            </foreach>
                        </table>
                            <else />
                            <span style="font-size:14px; color:#909090;align-content: center;">暂无收件信息</span>
                        </if>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">输入金额</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  name="money" id="money" placeholder="请输入金额" >
                    </div>
                </div>
            </div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">快递公司</label></div>
                    <div class="weui-cell__bd">
                        <select name="express_id" id="sel">
                            <option value="">请选择</option>
                            <foreach name="companyArr" item="vo">
                                <option value="{pigcms{$vo.id}">{pigcms{$vo.name}</option>
                            </foreach>
                        </select>
                    </div>
                </div>
            </div>
            <div id="tishi" style="text-align: center;height: 25px;color: #0ccfa3;line-height: 24px;font-size: 14px;display: none;">付款成功</div>
            <div class="weui-form-preview__ft" style="font-size: 20px;">
                <button onclick="sub()" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确定</button>
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

    var param;

    $("#money").blur(function () {
        var reg = $(this).val().match(/\d+\.?\d{0,2}/);
        var txt = '';
        if (reg != null) {
            txt = reg[0];
        }
        $(this).val(txt);
    }).change(function () {
        $(this).keypress();
        var v = $(this).val();
        if (/\.$/.test(v))
        {
            $(this).val(v.substr(0, v.length - 1));
        }
    });

    function sub() {
        var money = parseInt($("#money").val());
        var express_id = parseInt($("#sel").val());
        var url = "{pigcms{:U('PropertyService/send_express_pay')}";
        $.ajax({
            url:url,
            type:'post',
            data:'money='+money+'&express_id='+express_id,
            dataType:'json',
            async : false,
            success:function(res){
                if (res.error == 0){
                    param = JSON.parse(res.data);
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                        }
                    }else{
                        jsApiCall();
                    }
                } else {
                    alert(res.msg);
                }
            }
        })
    }


    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            "getBrandWCPayRequest",
            param,
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    window.history.go(-1);
                    $("#money").val('');
                    $("#tishi").slideDown("slow");
                }else{

                }
            });

    }

</script>
</body>
</html>