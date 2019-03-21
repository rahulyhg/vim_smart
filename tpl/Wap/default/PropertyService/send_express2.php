<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>快递服务</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="{pigcms{$static_path}test/exs/css/bootstrap.min.css">
    <link rel="stylesheet" href="{pigcms{$static_path}test/exs/css/weui.min.css">
    <link rel="stylesheet" href="{pigcms{$static_path}test/exs/css/jquery-weui.min.css">
    <style>
        body {color:#9c9c9c;}
        ol>li{
            height:100vh;
        }
        .active{
            color:#2093fc;
        }
        .header_tab_active{
            color:#2093fc;
            background-color:#ffffff;
            border-bottom:1px solid #2093fc;
        }
        .img_label{
            text-align: center;
            font-size: 14px;
            line-height: 1.5;
        }
        .kid {padding-top:15px; background-color:#FFFFFF; border-top:1px #e8e8e8 solid;}
        .cw {height:50px; background-color:#FFFFFF; line-height:50px;}
        .zk {width:90%; margin:0px auto;}
        .zk2 {width:100%; height:130px; overflow:hidden; background-color:#FFFFFF; border-radius:8px; box-shadow: 0px 0px 20px #ebebeb;}
        .zk3 {width:100%; background-color:#FFFFFF; border-radius:8px; box-shadow: 0px 0px 20px #ebebeb;}
        .sm {width:100%; height:50px; overflow:hidden; border-bottom:1px #ededed solid;}
        .sm2 {width:100%; height:30px; overflow:hidden; margin-top:10px;}
        .sm3 {width:100%; height:30px; overflow:hidden;}
        .sm4 {width:100%; height:50px; overflow:hidden;}
        .sm5 {width:100%; padding-top:10px; padding-bottom:15px;}
        .f1 {margin-left:3%; float:left; padding-top:8px;}
        .f2 {margin-left:2%; line-height:50px; float:left; font-size:16px; color:#000000;}
        .f3 {float:right; margin-right:3%; border:1px #2093fc solid; text-align:center; height:30px; line-height:30px; padding-left:3px; padding-right:3px; color:#2093fc; margin-top:10px; font-size:14px;}
        .f4 {float:right; margin-right:5%; text-align:right; height:50px; line-height:50px; color:#bbbbbb; font-size:14px;}
        .ht {width:40%; float:left; line-height:30px; margin-left:3%; font-size:14px;}
        .ht2 {width:52%; float:right; line-height:30px; margin-right:3%; font-size:14px; text-align:right;}
        .few {float:right; border:1px #fb4746 solid; text-align:center; height:24px; line-height:24px; padding-left:6px; padding-right:6px; color:#fb4746; margin-top:4px;}
        .few:active {background-color:#fb4746; color:#FFFFFF;}
        .xt {width:90%; padding-top:10px; margin:0px auto;}
        .gs {width:25%; float:left; margin-right:5%;}
        .gs2 {width:40%; float:left;}
        .gs3 {width:25%; float:left; margin-left:5%;}
        .wk {text-align:center; height:25px; line-height:25px; color:#373737; overflow:hidden;}
        .wk2 {text-align:center; height:25px; line-height:25px; color:#858585;}
        .sk {text-align:center; height:24px; line-height:24px; color:#f15930; border-bottom:1px #ededed solid; font-size:14px;}
        .sk2 {text-align:center; height:25px; line-height:25px; color:#2093fc; font-size:14px;}
        .ww {width:100%; text-align:center; height:40px; line-height:40px; background-color:#2093fc; border-radius:4px; color:#FFFFFF;}
        .ww:active {background-color:#1884e7; color:#FFFFFF;}
		.ht3 {width:75%; float:left; line-height:30px; margin-left:3%; font-size:14px;}
        .ht4 {width:19%; float:right; line-height:30px; margin-right:3%; font-size:14px;}
		.weui-select {padding-left:0px;}
		.weui-label {font-size:16px;}
		label {margin-bottom:0px;}
		.weui-cell__bd {font-size:16px;}
		.weui-cells:after, .weui-cells:before {left:15px;}
		.weui-cells:before:first-child {border-top:none;}
    </style>
</head>
<body style="background-color:#f6f6f6;">
<div id="app">
    <ol class="list-unstyled">
        <li v-show="show_pag===1">
            <!--P1-->
            <header>
                <ul class="list-unstyled">
                    <li class="col-xs-4 text-center cw" @click="show_sub_pag=1" :class="{header_tab_active:show_sub_pag===1}">待取快递</li>
                    <li class="col-xs-4 text-center cw" @click="show_sub_pag=2" :class="{header_tab_active:show_sub_pag===2}">寄出快递</li>
                    <li class="col-xs-4 text-center cw" @click="show_sub_pag=3" :class="{header_tab_active:show_sub_pag===3}">已取快递</li>
                </ul>
            </header>
            <ol class="list-unstyled">
                <li v-show="show_sub_pag===1">
                    <div class="zk">
                        <foreach name="listTwo" item="vo">
                            <div style="height:30px; overflow:hidden; width:100%;"></div>
                            <div class="zk2">
                                <div class="sm">
                                    <div class="f1"><img src="{pigcms{$static_path}test/exs/images/t1.jpg" style="height:33px;"></div>
                                    <div class="f2">{pigcms{$vo.company_name}</div>
                                    <div class="f3">取件码：{pigcms{$vo.receipt_code}</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="sm2">
                                    <div class="ht">取件人：<span style="color:#000000;">{pigcms{$vo.name}</span></div>
                                    <div class="ht2">手机号：<span style="color:#000000;">{pigcms{$vo.phone}</span></div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="sm3">
                                    <div class="ht3">运单号：<span style="color:#000000;">{pigcms{$vo.waybill_number}</span></div>
                                    <div class="ht4">
                                        <div class="few" onClick="detail_package({pigcms{$vo.id})">详 情</div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </foreach>
                        <div style="height:100px; overflow:hidden; width:100%;"></div>
                    </div>

                </li>
                <li v-show="show_sub_pag===2">
                        <div class="zk">
                            <foreach name="badList" item="vo">
                                <div style="height:30px; overflow:hidden; width:100%;"></div>
                                <div class="zk3 jichu">
                                    <div class="sm4">
                                        <div class="f1"><img src="{pigcms{$static_path}test/exs/images/t1.jpg" style="height:33px;"></div>
                                        <div class="f2">{pigcms{$vo.exp_name}</div>
                                        <div class="f4">{pigcms{$vo.od_create_time|date="Y-m-d",###}</div>
                                        <div style="clear:both"></div>
                                    </div>
                                    <div class="xt">
                                        <div class="gs">
                                            <div class="wk">{pigcms{$vo.bad_position}</div>
                                            <div class="wk2">{pigcms{$vo.bad_name}</div>
                                        </div>
                                        <div class="gs2">
                                            <div class="sk"><if condition="$vo['exs_status'] eq 1"><span style="color: #0ccfa3;">已送达</span><else />运送中</if></div>
                                            <div class="sk2">{pigcms{$vo.ems_order_id}</div>
                                        </div>
                                        <div class="gs3">
                                            <div class="wk">{pigcms{$vo.sad_position}</div>
                                            <div class="wk2">{pigcms{$vo.sad_name}</div>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                    <div class="sm5">
                                        <div class="ht2">
                                            <div class="few" onClick="detail_exs({pigcms{$vo.order_id})">详 情</div>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                </div>
                            </foreach>
							<div style="height:100px; overflow:hidden; width:100%;"></div>
                        </div>
                </li>
                <li v-show="show_sub_pag===3">

                    <div class="zk">
                        <foreach name="listThree" item="vo">
                            <div style="height:30px; overflow:hidden; width:100%;"></div>
                            <div class="zk2">
                                <div class="sm">
                                    <div class="f1"><img src="{pigcms{$static_path}test/exs/images/t1.jpg" style="height:33px;"></div>
                                    <div class="f2">{pigcms{$vo.company_name}</div>
                                    <div class="f3">取件码：{pigcms{$vo.receipt_code}</div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="sm2">
                                    <div class="ht">取件人：<span style="color:#000000;">{pigcms{$vo.name}</span></div>
                                    <div class="ht2">手机号：<span style="color:#000000;">{pigcms{$vo.phone}</span></div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="sm3">
                                    <div class="ht3">运单号：<span style="color:#000000;">{pigcms{$vo.waybill_number}</span></div>
                                    <div class="ht4">
                                        <div class="few" onClick="detail_package({pigcms{$vo.id})">详 情</div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </foreach>
						<div style="height:100px; overflow:hidden; width:100%;"></div>
                    </div>

                </li>
            </ol>
        </li>
        <li v-show="show_pag===2">

            <div class="zk">
                <div class="zk3">
                    <div style="padding-bottom:20px;">
                        <div class="weui-cells">
                            <div class="weui-cell weui-cell_select" style="padding:0px 15px;">
                                <div class="weui-cell__hd">
                                    <label class="weui-label">快递公司</label>
                                </div>
                                <div class="weui-cell__bd">
                                    <select class="weui-select" name="express_id" id="sel">
                                        <option value="1">请选择</option>
                                        <foreach name="companyArr" item="vo">
                                            <option value="{pigcms{$vo.id}">{pigcms{$vo.name}</option>
                                        </foreach>
                                    </select>
                                </div>
                            </div>

                            <div class="weui-cell">
                                <div class="weui-cell__hd">
                                    <label class="weui-label">支付金额</label>
                                </div>
                                <div class="weui-cell__bd">
                                    <input class="weui-input" type="number" name="money" id="money" pattern="[0-9]*" placeholder="请填写您所需支付金额"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="width:90%; margin:0px auto; padding-top:20px;">
                <div class="ww" onClick="sub()">确定支付</div>
            </div>

        </li>
        <li v-show="show_pag===3">P3</li>
    </ol>

    <footer class="navbar-fixed-bottom" id="footer">
        <div class="row">
            <ul class="list-unstyled row kid">
                <li class="col-xs-4 text-center" @click="show_pag=1" :class="{active:show_pag===1}">
                    <div class="weui-tabbar__icon">
                        <img :src="get_src('fdj',1)" id="img1" alt="">
                    </div>
                    <p class="img_label">查快递</p>
                </li>
                <li class="col-xs-4 text-center" @click="show_pag=2" :class="{active:show_pag===2}">
                    <div class="weui-tabbar__icon">
                        <img :src="get_src('jkd',2)" id="img2" alt="">
                    </div>
                    <p class="img_label">寄快递</p>
                </li>
                <li class="col-xs-4 text-center" @click="show_pag=3" :class="{active:show_pag===3}">
                    <div class="weui-tabbar__icon">
                        <img :src="get_src('wd',3)" id="img3" alt="">
                    </div>
                    <p class="img_label">我的</p>
                </li>
            </ul>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

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
    new Vue({
        el:"#app",
        data:{
            show_pag:1,
            show_sub_pag:1,
        },
        methods:{
            get_src(name,index){
                if(index == this.show_pag){
                    name = name + "2";
                }

                return "{pigcms{$static_path}test/exs/images/"+name+'.jpg';
            }
        }

    });

    var param;

    var phone = "{pigcms{$phone}";


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
                    $.toptip('支付成功', 'success');
                }else{

                }
            });
    }

    function detail_package(id) {
        let type=1;
        window.location.href = "{pigcms{:U('PropertyService/detail_all')}"+'&id='+id+'&type='+type;
    }

    function detail_exs(id) {
        let type=2;
        window.location.href = "{pigcms{:U('PropertyService/detail_all')}"+'&id='+id+'&type='+type;
    }
	
	var oHeight = $(document).height(); 
	$(window).resize(function(){
	if($(document).height() < oHeight){

    $("#footer").css("position","static");
	}else{
	
		$("#footer").css("position","absolute");
	}
	});
</script>
</body>
</html>