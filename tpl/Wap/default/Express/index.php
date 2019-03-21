<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>收发快递</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
<!--    <link href="{pigcms{$static_path}css/weui.min.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="{pigcms{$static_path}css/jquery-weui.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">

    <link href="{pigcms{$static_path}css/sweetalert/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/sweetalert/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/sweetalert/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{pigcms{$static_path}css/sweetalert/layout.min.css" rel="stylesheet" type="text/css" />
    <script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
    <script src="{pigcms{$static_path}js/sweetalert/bootstrap.min.js" type="text/javascript"></script>
    <script src="{pigcms{$static_path}js/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="{pigcms{$static_path}js/sweetalert/ui-sweetalert.min.js" type="text/javascript"></script>


    <style type="text/css">
        .wb_arrow{
            border-right: 2px solid #c0c0c0;
            border-top: 2px solid #c0c0c0;
            height: 10px;
            width: 10px;
            float:right;
            margin:35px auto 0;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            /*不加这两个属性三角会比上一个略丑, 大家可以试一下*/
            border-left: 2px solid transparent;
            border-bottom: 2px solid transparent;
        }
        .wb_arrow2{
            border-right: 2px solid #c0c0c0;
            border-top: 2px solid #c0c0c0;
            height: 10px;
            width: 10px;
            float:right;
            margin:40px auto 0;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            /*不加这两个属性三角会比上一个略丑, 大家可以试一下*/
            border-left: 2px solid transparent;
            border-bottom: 2px solid transparent;
        }
        .sm {width:100%; height:50px; text-align:center; overflow:hidden; line-height:50px; background-color:#0697dc; color:#FFFFFF; font-size:18px;}
        .jj {width:100%; height:100px; border-bottom:0.8px #bcbab6 solid; overflow:hidden; background-color:#FFFFFF;}
        .jjd {width:90%; margin:0px auto; padding-top:8px;}
        .x1 {width:35px; height:35px; float:left; overflow:hidden; border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%; background-color:#0697dc; text-align:center; line-height:35px; color:#FFFFFF; font-size:20px; margin-top:25px;}
        .x2 {width:70%; margin-left:6%; height:75px; float:left; margin-top:5px;}
        .x3 {width:70%; margin-left:6%; height:75px; float:left; margin-top:5px;}
        body,td,th {font-family: 微软雅黑;}
        .xt {width:100%; height:25px; line-height:25px; font-size:18px; color:#000000;}
        .xt2 {width:100%; height:25px; line-height:25px; font-size:16px; color:#888888;}
        .q1 {width:35px; height:35px; float:left; overflow:hidden; border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%; background-color:#9163ff; text-align:center; line-height:35px; color:#FFFFFF; font-size:20px; margin-top:25px;}
        .q2 {width:70%; margin-left:6%; height:75px; float:left; margin-top:5px; line-height:75px; font-size:18px; color:#cccccc;}
        .wp {width:100%; margin-top:30px; height:98px; border-bottom:1px #bcbab6 solid; border-top:1px #bcbab6 solid; background-color:#FFFFFF;}
        .cw {width:50%; float:left; height:98px; overflow:hidden;}
        .cw2 {position:absolute;z-index:1;width:1px; background-color:#bcbab6;height:98px;left:50%}
        .iu {width:80%; margin:0px auto;}
        .iu2 {width:80%; height:98px; overflow:hidden; float:left;}
        .iu2x {width:90%; height:98px; overflow:hidden; float:left;}
        .iu3 {width:100%; height:49px; overflow:hidden; line-height:49px; font-size:18px; color:#a5a5a5;}
        .iu4 {width:100%; height:49px; overflow:hidden; line-height:49px; font-size:18px; color:#333333;}
        .iu5 {width:100%; height:49px; overflow:hidden; line-height:49px; font-size:18px; color:#999999;}
        .weui_select {
            -webkit-appearance: none;
            border: 0;
            outline: 0;
            background-color: transparent;
            width: 100%;
            font-size: inherit;
            height: 49px;
            line-height: 49px;
            position: relative;
            z-index: 1;
            padding-left: 0px;
        }
        .ls {width:100%; position:fixed; bottom:0; height:80px; overflow:hidden;}
        .ls2 {width:75%; float:left; height:80px; background-color:#5a5a5a;}
        .ls3 {width:25%; float:left; height:80px; background-color:#999999; text-align:center; line-height:80px; color:#FFFFFF; font-size:18px;}
        .ls4 {width:90%; margin:0px auto; padding-top:10px; color:#FFFFFF;}
		
		input[type=checkbox], input[type=radio] {margin:-3px;}
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body style="background-color:#f9f9f9;">

<a href="{pigcms{:U('test')}"><div class="sm">在线下单</div></a>
<form action="{pigcms{:U('order')}" method="post">
<div style="width:100%;">
    <input type="hidden" name="billing_adid" value="{pigcms{$out_adr['adress_id']}">
    <div class="jj">
        <a href="{pigcms{$address?U('existed_address',array('type'=>1,'village_id'=>$village_id)):U('address',array('type'=>1,'village_id'=>$village_id))}">
        <div class="jjd">
            <div class="x1">寄</div>
            <if condition="$address">
                    <div class="x2">
                    <div class="xt">{pigcms{$out_adr['name']}  {pigcms{$out_adr['phone']}</div>
                    <div class="xt2">{pigcms{$out_adr['village_name']}</div>
                    <div class="xt2">{pigcms{$out_adr['detail']}</div>
                    </div>
                <else/>
                    <div class="q2">请输入寄件人详细地址</div>
            </if>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
        </a>
    </div>
    <div class="jj">
        <input type="hidden" name="shipping_adid" value="{pigcms{$get_adr['adress_id']}">
        <a href="{pigcms{$get_adr?U('existed_address',array('type'=>2)):U('address',array('type'=>2))}">
        <div class="jjd">
            <div class="q1">收</div>
            <if condition="$get_adr">
                    <div class="x3">
                        <div class="xt">{pigcms{$get_adr['name']}  {pigcms{$get_adr['phone']}</div>
                        <div class="xt2">{pigcms{$get_adr['position']}</div>
                        <div class="xt2">{pigcms{$get_adr['detail']}</div>
                    </div>
                <else/>
                    <div class="q2">请输入收件人详细地址</div>
            </if>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
        </a>
    </div>
</div>
    <div class="wp">
    <div class="cw">
        <div class="iu">
            <div class="iu2">
                <!--                <a href="javascript:;" class="open-popup" data-target="#aa">-->
                <div class="iu3">快递公司</div>
                <div class="iu4" id="thing">
                    <select class="weui_select" name="express_id" >
                        <option value="0" selected="true" disabled="true">请选择</option>
                        <volist name="expressArr" id="vo">
                            <option value="{pigcms{$vo.id}">{pigcms{$vo.name}</option>
                        </volist>
                    </select>
                </div>
                <!--                </a>-->
                <!--                <div id="aa" class="weui-popup__container popup-bottom">-->
                <!--                    <div class="weui-popup__overlay"></div>-->
                <!--                    <div class="weui-popup__modal">-->
                <!--                        <ul class="thing">-->
                <!--                            <li><a href="javascript:;"  class='close-popup'>数码</a></li>-->
                <!--                            <li><a href="javascript:;"  class='close-popup'>文件</a></li>-->
                <!--                            <li><a href="javascript:;"  class='close-popup'>服饰</a></li>-->
                <!--                            <li><a href="javascript:;"  class='close-popup'>日用品</a></li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            <div class="wb_arrow2"></div>
            <div style="clear:both"></div>
        </div>
    </div>
    </div>
<div class="wp">
    <div class="cw">
        <div class="iu">
            <div class="iu2">
<!--                <a href="javascript:;" class="open-popup" data-target="#aa">-->
                <div class="iu3">物品</div>
                <div class="iu4" id="thing">
                    <select class="weui_select" name="goods_type_name" id="goods_type_name">
                        <option value="0" selected="true" disabled="true">请选择</option>
                        <option value="数码">数码</option>
                        <option value="文件">文件</option>
                        <option value="服饰">服饰</option>
                        <option value="日用品">日用品</option>
                        <option value="其他">其他</option>
                    </select>
                </div>
<!--                </a>-->
<!--                <div id="aa" class="weui-popup__container popup-bottom">-->
<!--                    <div class="weui-popup__overlay"></div>-->
<!--                    <div class="weui-popup__modal">-->
<!--                        <ul class="thing">-->
<!--                            <li><a href="javascript:;"  class='close-popup'>数码</a></li>-->
<!--                            <li><a href="javascript:;"  class='close-popup'>文件</a></li>-->
<!--                            <li><a href="javascript:;"  class='close-popup'>服饰</a></li>-->
<!--                            <li><a href="javascript:;"  class='close-popup'>日用品</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="wb_arrow2"></div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div class="cw">
        <div class="iu">
            <div class="iu2x">
                <div class="iu3">保价费用</div>
                <div class="iu5">
                    <div style="float:left; width:80%;">

                        <select class="weui_select" name="save_pay" style="color:#333333;">
                            <option value="0" selected="true" disabled="true">选填</option>
                            <option value="0" >0</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div style="float:right; color:#a5a5a5;">元</div>
                    <div style="clear:both"></div>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div class="cw2"></div>
    <div style="clear:both"></div>
</div>
<div class="wp">
    <div class="cw">
        <div class="iu">
            <div class="iu2">
                <div class="iu3">付款方式</div>
                <div class="iu4">
                    <select class="weui_select" name="billing_type_id" id="billing_type_id">
                        <option value="0" selected="true" disabled="true">请选择</option>
                        <option value="寄付现结">寄付现结</option>
                        <option value="到付">到付</option>
                        <option value="寄付月结">寄付月结</option>
                    </select>
                </div>
            </div>
            <div class="wb_arrow2"></div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div class="cw">
        <div class="iu">
            <div class="iu2">
                <div class="iu3">取件时间</div>
                <div class="iu5">
                    <div style="width:100%;">
                        <select class="weui_select" name="time_period" style="color:#333333;" id="time_period">
                            <option value="0" selected="true" disabled="true">请选择</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="wb_arrow2"></div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div class="cw2"></div>
    <div style="clear:both"></div>
</div>
<div class="ls">
    <div class="ls2">
<!--        <div class="ls4">运费：10元　仅供参考 </div>-->
        <div style="width:90%; margin:0px auto; padding-top:15px;">
            <div style="float:left;">
                <form id="form1" name="form1" method="post" action="">
                    <label class="mt-checkbox" style="color:#0697dc; font-size:15px;">
                                                            <input type="checkbox"> 我同意《快件运单契约条款》
                                                            <span></span>
                                                        </label>
                </form>
            </div>
        </div>
    </div>
    <div class="ls3">提交</div>
</form>
    <div style="clear:both"></div>
</div>
</body>
<div style="height:80px"></div>

<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>

<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/swiper.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
</html>
<script>
    $(function () {
        var needRefresh = sessionStorage.getItem("need-refresh");
        console.log(needRefresh);
        if(needRefresh){
            sessionStorage.removeItem("need-refresh");
            //location.reload();
            swal({
                    title: "您已提交一笔订单",
                    //text: "正在为您分配配送员",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                },
                function(){
                    location.reload();
                });
        }
    });
</script>
<script>
    $(function () {
        $('.thing li').on('click',function () {
            var data = $(this).text();
           $('#thing').text(data);
        })
    })
</script>

<script>


    function check(){
        var billing_adid = $("input[name='billing_adid']").val();//寄件外键
        var shipping_adid = $("input[name='shipping_adid']").val();//收件外键
        var goods_type_name = $("#goods_type_name").val();//物品类型
        var billing_type_id = $("#billing_type_id").val();//付款方式
        var time_period= $("#time_period").val();
        var checkbox = $("input[type='checkbox']").is(':checked');
        if(billing_adid
            &&shipping_adid
            &&goods_type_name
            &&billing_type_id
            &&time_period
            &&checkbox
        ){
            return true;
        }else{
            return false;
        }
    }

    function change_color(){
        $(".ls3").css("background","#0697dc");
    }

    function reset_color(){
        $(".ls3").css("background","#999999");
    }
    
    function deal() {
        if(check()){
            change_color();
        }else{
            reset_color();
        }
    }

    $("#goods_type_name").on('change',function () {
        deal();
    })

    $("#billing_type_id").on('change',function () {
        deal();
    })
    $("#time_period").on('change',function () {
        deal();
    })
    $("input[type='checkbox']").on('click',function () {
        deal();
    })


    $('.ls3').click(function () {
        var billing_adid = $("input[name='billing_adid']").val();//寄件外键
        var shipping_adid = $("input[name='shipping_adid']").val();//收件外键
        var goods_type_name = $("#goods_type_name").val();//物品类型
        var billing_type_id = $("#billing_type_id").val();//付款方式
        var time_period= $("#time_period").val();
        var checkbox = $("input[type='checkbox']").is(':checked');
//        alert(checkbox);return false;
        if(billing_adid=='' || billing_adid==null){
            alert('寄件信息不能为空');
            return false;
        }else if(shipping_adid=='' || shipping_adid==null){
            alert('收件信息不能为空');
            return false;
        }else if(goods_type_name=='' || goods_type_name==null){
            alert('请选择物品类型');
            return false;
        }else if(billing_type_id=='' || billing_type_id==null){
            alert('请选择付款方式');
            return false;
        }else if(time_period=='' || time_period==null){
            alert('请选择取件时间');
            return false;
        }else if(checkbox==false){
            alert('请阅读并同意《快件运单契约条款》');
            return false;
        }else{
            $(".ls3").css('background-color','#0697dc');
            //swal("提交成功", "正在为您分配配送员", "success");
            swal({
                    title: "提交成功",
                    text: "正在为您分配配送员",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: false
                },
                function(){
                    $('form').submit();
                });
        }
    });

</script>



