<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>

<!DOCTYPE html>

<html lang="zh-CN">

<head>

    <meta charset="utf-8" />

    <title>{pigcms{$now_village.village_name}</title>

    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>

    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <meta name='apple-touch-fullscreen' content='yes'/>

    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    <meta name="format-detection" content="telephone=no"/>

    <meta name="format-detection" content="address=no"/>

    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>

    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>

    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>

    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>

    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>

    <script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444" charset="utf-8"></script>

    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>

    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js?210" charset="utf-8"></script>

    <script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>

    <script type="text/javascript" src="{pigcms{$static_path}js/common.js?210" charset="utf-8"></script>

    <script type="text/javascript">

        var pay_type = "{pigcms{$pay_type}",pay_money = {pigcms{$pay_money};

    </script>

    <script type="text/javascript" src="{pigcms{$static_path}js/village_pay.js?210" charset="utf-8"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style type="text/css">
        <!--
        .wdwe:link{color:#FFFFFF; text-decoration:none;}
        .wdwe:visited{color:#FFFFFF; text-decoration:none;}
        .wdwe:active{color:#FFFFFF; text-decoration:none;}
        .wdwe:hover{color:#FFFFFF; text-decoration:none;}

        .area_input {
            width: 84%;
            margin: 30px auto 0;
            height: 50px;
            line-height: 50px;
            background-color: white;
            border-radius: 5px;
            color: #888888;
            overflow: hidden;
            padding-left: 15px;
            position: relative;
            border: 1px #e2e2e2 solid;
        }
        .area_tips {
            width: 84%;
            margin: 15px auto 0;
            height: 50px;
            line-height: 50px;
            background-color: #ffffff;
            border-radius: 5px;
            padding-left: 15px;
            color: #888888;
            overflow: hidden;
            font-size: 1rem;
            border: 1px #e2e2e2 solid;
        }
        -->
    </style></head>

<body>

<header class="pageSliderHide"><div id="backBtn"></div>{pigcms{$pay_name}</header>

<div id="container">

    <div id="scroller">

        <div id="pullDown" style="background-color:#fb4746;color:white;">

            <span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIconx" style="margin-right:10px;vertical-align:middle;"></i>{pigcms{$now_village.village_name} 在线快捷缴费</span>

        </div>

        <!--<section class="query-container">

            <div class="query_div {pigcms{$pay_type}_ico"></div>

            <div class="area_tips">{pigcms{$now_user_info.address}</div>

            <if condition="$pay_type eq 'custom'">

                <div class="area_input" style="margin-top:15px;">

                    <input type="text" class="recharge_txt" id="recharge_txt" placeholder="请填写缴费的事项"/>

                    <span class="nametip">缴费事项</span>

                </div>

                <div class="area_input" style="margin-top:15px;">

                    <input type="tel" class="recharge_txt" id="recharge_money" placeholder="缴纳的费用(元)"/>

                    <span class="nametip">缴费金额</span>

                </div>

                <else/>

                <div class="area_input" style="margin-top:15px;">

                    <input type="tel" class="recharge_txt" id="recharge_money" placeholder="您需缴纳的费用" value="￥{pigcms{$pay_money}" readonly="readonly"/>

                    <span class="nametip"></span>

                </div>

            </if>



        </section>-->
        <if condition="$pay_type eq 'carspace'">
            <section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">
                <div class="headBox" onclick="carspace_info_display()">当前车位信息：{pigcms{$carspace_info['carspace_number']}(点击查看详情)</div>
                <div id="carspace_info_display" style="display: none;">
                <dd>
                    <label class="demo--label">
                        车位编号
                    </label>
                    <div class="right" >
                        {pigcms{$carspace_info['carspace_number']}
                    </div>
                </dd>
                    <dd>
                        <label class="demo--label">
                            所停车辆车牌号
                        </label>
                        <div class="right" >
                            {pigcms{$carspace_info['car_number']}
                        </div>
                    </dd>
                </div>
            </section>
                <section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">
                    <div class="headBox">您已经缴费至{pigcms{$carspace_info['carspace_endtime_str']}</div>

                    <dl>
                        <dd>
                            <label class="demo--label">
                                请选择您要续缴泊位费费的月数
                            </label>
                            <select name="mouth" id="mouth_carspace" class="right">
                                <option value="0" selected="selected">请选择</option>
                                <for start="1" end="25"  name="i" >
                                    <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                </for>
                            </select>
                        </dd>
                        <div id="pay" style="display: none;">
                            <dd>
                                <label class="demo--label">
                                    每月泊位费单价
                                    <span class="required">*</span>
                                </label>
                                <div class="right" >
                                    {pigcms{$carspace_info['carspace_price']}元
                                </div>

                            </dd>
                            <dd>

                                    <label class="demo--label">
                                            应付款
                                            <span class="required">*</span>
                                    </label>
                                        <div class="right" >
                                            <label id="pay_recive"></label>元
                                        </div>


                            </dd>
                        </div>
                    </dl>

                </section>
                <div id="payDom" style="width:88%; margin: 30px auto 0;"><button class="weui_btn weui_btn_primary_blue wdwe"  value="缴费" onclick="go_pay_ajax('livepay_carspace')" >缴费</button></div>
            <div id="successDom" style="display:none;width:88%; margin: 30px auto 0;" >
                <span class="weui_btn weui_btn_primary wdwe">已成功缴费，请等待跳转</span>

            </div>
            <elseif condition="$pay_type eq 'property'"/>
            <section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">

                <div class="headBox">您已经缴费至{pigcms{$room_uptown['property_endtime_str']}</div>

                <dl>
                    <dd>
                        <label class="demo--label">
                            请选择您要续缴物业费的月数
                        </label>
                        <select name="mouth" id="mouth" class="right">
                            <option value="0" selected="selected">请选择</option>
                            <for start="1" end="25"  name="i" >
                                <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                            </for>
                        </select>

                    </dd>
                    <div id="pay" style="display: none;">
                        <dd>
                            <label class="demo--label">
                                房间面积
                                <span class="required">*</span>
                            </label>
                            <div class="right" >
                                {pigcms{$room_info['roomsize']}平方米
                            </div>

                        </dd>
                        <dd>
                            <label class="demo--label">
                                物业费单价
                                <span class="required">*</span>
                            </label>
                            <div class="right" >
                                {pigcms{$property_price['property_unit']}元
                            </div>

                        </dd>
                        <dd>

                            <label class="demo--label">
                                应付款
                                <span class="required">*</span>
                            </label>
                            <div class="right" >
                                <label id="pay_recive"></label>元
                            </div>


                        </dd>
                    </div>
                </dl>

            </section>
            <div id="payDom" style="width:88%; margin: 30px auto 0;"><button class="weui_btn weui_btn_primary_blue wdwe"  value="缴费" onclick="go_pay_ajax('livepay_property')" >缴费</button></div>
            <div id="successDom" style="display:none;width:88%; margin: 30px auto 0;" >
                <span class="weui_btn weui_btn_primary wdwe">已成功缴费，请等待跳转</span>

            </div>
            <else/>
        <if condition="$paylist">
            <form action="" method="post">
            <section class="villageBox newsBox query-list" style="width:90%;margin:30px auto 10px;">

                <div class="headBox">帐单列表（勾选你需要缴费的账单进行缴费）<!--div class="right link-url" data-url="/wap.php?g=Wap&amp;c=House&amp;a=village_newslist&amp;village_id=1"></div--></div>

                <dl>
                    <volist name="paylist" id="vo">

                        <dd>
                            <label class="demo--label"><input type="checkbox" value="{pigcms{$vo['pigcms_id']}" name="paylist_form[]" class="demo--radio"/> <span class="demo--checkbox demo--radioInput"></span></label>

                            <div style="display: inline;">{pigcms{$vo[$pay_type_price]}元</div>

                            <span class="right">{pigcms{$vo.ydate}年{pigcms{$vo.mdate}月</span>

                        </dd>

                    </volist>

                </dl>

            </section>
            <div style="width:88%; margin: 30px auto 0;"><input type="submit" class="weui_btn weui_btn_primary_blue wdwe" value="缴费" /></div>
            </form>
        </if>
        </if>
        <div id="pullUp" style="bottom:-60px;">

            <img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>

        </div>

    </div>

</div>

<!--{pigcms{$shareScript}-->

<script type="text/javascript" src="{pigcms{$static_path}js/zepto.min.js" charset="utf-8"></script>
<script>
    <if condition="$pay_type eq 'property'">
    var property_unit={pigcms{$property_price['property_unit']};
    var roomsize={pigcms{$room_info['roomsize']};
    $('#mouth').change(function(){
        var p1=$(this).children('option:selected').val();
        var pay=p1*property_unit*roomsize;
        pay=pay.toFixed(2);
        $('#pay').css('display','block');
        $('#pay_recive').html(pay);
    });
    </if>
    <if condition="$pay_type eq 'carspace'">
    var carspace_price={pigcms{$carspace_info['carspace_price']};
    $('#mouth_carspace').change(function(){
        var p1=$(this).children('option:selected').val();
        var pay=p1*carspace_price;
        pay=pay.toFixed(2);
        $('#pay').css('display','block');
        $('#pay_recive').html(pay);
    });
    </if>
    function go_pay_ajax(order_type) {
        if(order_type=='livepay_carspace'){
            var month=$('#mouth_carspace option:selected') .val();
        }else{
            var month=$('#mouth option:selected') .val();
        }
        $.ajax({
            'url':"{pigcms{:U('Pay/go_pay_ajax')}",
            'data':{'month':month,'order_type':order_type,'pay_type':'weixin'},
            'type':'POST',
            'dataType':'JSON',
            'success':function(msg){
                if(msg.error==0){
                    //alert(msg.code_msg);
                    callpay(msg.weixin_param,msg.redirctUrl);
                }else{
                    alert(msgg);
                    //window.location.reload();
                }
            },
            /*'error':function(){
             alert('loading error!');
             }*/
        })
    }

    function callpay(param,redirctUrl){

        WeixinJSBridge.invoke("getBrandWCPayRequest",param,function(res){

            WeixinJSBridge.log(res.err_msg);

            if(res.err_msg=="get_brand_wcpay_request:ok"){

                document.getElementById("payDom").style.display="none";

                document.getElementById("successDom").style.display="block";

                setTimeout("window.location.href ='"+redirctUrl+"'",2000);

            }else{

                if(res.err_msg == "get_brand_wcpay_request:cancel"){

                    var err_msg = "您取消了支付";

                }else if(res.err_msg == "get_brand_wcpay_request:fail"){

                    var err_msg = "支付失败<br/>错误信息："+res.err_desc;

                }else{

                    var err_msg = res.err_msg +"<br/>"+res.err_desc;

                }

                /*document.getElementById("payDom").style.display="none";

                 document.getElementById("failDom").style.display="";

                 document.getElementById("failRt").innerHTML=err_msg;*/
                alert(err_msg);

            }

        });

    }
    function submit_it() {
        $("#post_property").submit();
    }
    function carspace_info_display() {
        if($('#carspace_info_display').css('display')=='none'){
            $('#carspace_info_display').css('display','block');
        }else{
            $('#carspace_info_display').css('display','none');

        }
    }
</script>
<style>
    .required{color: red;}
    .demo--label{margin:0px 0px 0 0;display:inline-block}
    .demo--radio{display:none}
    .demo--radioInput{background-color:#fff;border:1px solid rgba(0,0,0,0.15);border-radius:100%;display:inline-block;height:16px;margin-right:10px;margin-top:-1px;vertical-align:middle;width:16px;line-height:1}
    .demo--radio:checked + .demo--radioInput:after{background-color:#57ad68;border-radius:100%;content:"";display:inline-block;height:12px;margin:2px;width:12px}
    .demo--checkbox.demo--radioInput,.demo--radio:checked + .demo--checkbox.demo--radioInput:after{border-radius:0}
</style>
</body>

</html>