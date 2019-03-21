<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>缴费金额录入</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <!-- jquery WEUI css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <link href="/Car/Home/Public/statics/plublic/css/example.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />

    <style>
        .but{
            color: #2093fc;
            font-size: 16px;
			font-weight:600;
        }
		.weui-msg__title {font-size:30px;}
		button, input, select, textarea {
			font-family: inherit;
			font-size: inherit;
			line-height: inherit;
			border: 1px #d4d4d4 solid;
			color: #333333;
			font-size: 14px;
		}
		.weui-msg {padding-top:0;}
		.weui-footer__link {font-size:16px;}
		.weui-msg__text-area {margin-bottom:0;}
		h2 {margin-top:10px;}
		hr, p {
			margin: 20px 0 0 0;
		}
		.weui-cells {margin-top:15px;}
		label {margin-bottom:0;}
    </style>
    </head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="weui-msg">
    <div class="weui-msg__text-area">
        <p class="weui-msg__desc" style="font-size:16px;">管理员：<a href="javascript:void(0);">{pigcms{$info.realname}</a>，您好！
		</p>
    </div>


        <h2 class="weui-msg__title" style="font-size: 16px;">当前班次：<span class="but">{pigcms{$info.duty.name}</span></h2>
        <input type="hidden" name="duty_id" value="{pigcms{$info.duty.id}"/>


        <!--<h2  style="font-size: 16px;text-align: center; padding-top:10px;">选择日期：<input type="date" name="ym" value="{pigcms{$ym}" /></h2>-->

    

        <div class="weui-cells">

            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">选择日期</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="date" name="ym" value="{pigcms{$ym}" />
                </div>
            </div>
			
			<div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">缴费方式</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" id="pay_type" value="" readonly="" type="text" name="pay_type">
                </div>
            </div>

            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">缴费金额</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入金额" name="payment">

                </div>
            </div>
        </div>
		
		<div class="weui-msg__text-area" id="count">
        <div class="weui-loadmore">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>
    </div>

        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="javascript:;" class="weui-btn weui-btn_primary" onclick="sub_data();">提交</a>
                <a href="{pigcms{:U('outLinkRecord')}" class="weui-btn weui-btn_primary">收款记录</a>
                <a href="javascript:;" class="weui-btn weui-btn_default" onclick="window.history.go(-1)">返回</a>
            </p>
        </div>
</div>

		<div style="width:100%; text-align:center; padding-top:30px; margin:0px auto;">
            <a href="{pigcms{:U('PropertyService/administration')}" class="weui-footer__link">后台管理</a>
     	   <p class="weui-footer__text">Copyright © 2015-2018 hdhsmart.com</p>
		</div>

</body>
<!-- jquery WEUI  js-->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<script>
    $(function(){
        //进入页面就需要查询当前录入信息

        reload_record();

        $(".but").on('click',function () {
            $.actions({
                actions: [{
                    text: "早班",
                    onClick: function() {
                        $(".but").text('早班');
                        $("input[name='duty_id']").val(47);
                        reload_record();
                    }
                },{
                    text: "中班",
                    onClick: function() {
                        $(".but").text('中班');
                        $("input[name='duty_id']").val(48);
                        reload_record();
                    }
                },{
                    text: "晚班",
                    onClick: function() {
                        $(".but").text('晚班');
                        $("input[name='duty_id']").val(49);
                        reload_record();
                    }
                }]
            });
        });

        $("#pay_type").select({
            title: "选择收款方式",
            items: [
                {
                    title: "现金付款",
                    value: "0",
                },
                {
                    title: "微信扫码支付",
                    value: "1",
                },
                {
                    title: "其他付款方式",
                    value: "2",
                }
            ]
        });
    });

    function sub_data()
    {
        var payment = $("input[name='payment']").val(),
            pay_type  = $("input[name='pay_type']").attr('data-values'),
            garage_id = "{pigcms{$info.garage_id}",
            duty_id   = $("input[name='duty_id']").val(),
            ym   = $("input[name='ym']").val()
        ;

        $.ajax({
            url:'{pigcms{:U("")}',
            type:'post',
            data:{'payment':payment,'pay_type':pay_type,'garage_id':garage_id,'duty_id':duty_id,'ym':ym},
            success:function (res) {
                if(res==1){
                    $("input[name='pay_type']").val('');

                    $("input[name='payment']").val('');

                    reload_record();

                    $.notification({
                        title: "上传成功",
                        text: "数据已经保存到后台可以点击查看",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkRecord";
                        }
                    });

                }else if(res==2){

                    $.notification({
                        title: "上传失败",
                        text: "请重新上传",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkPay";
                        }
                    });

                }else if($res == 3){
                    $.notification({
                        title: "上传失败",
                        text: "请填写实收金额",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkPay";
                        }
                    });
                }else if($res == 4){
                    $.notification({
                        title: "上传失败",
                        text: "请选择收款方式",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkPay";
                        }
                    });
                }else if($res == 5){
                    $.notification({
                        title: "上传失败",
                        text: "重新进入页面即可",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkPay";
                        }
                    });
                }else if($res == 6){
                    $.notification({
                        title: "上传失败",
                        text: "请选择班次",
                        media: "",
                        onClick: function() {
                            window.location.href="__APP__?g=Wap&c=PropertyService&a=outLinkPay";
                        }
                    });
                }
            }
        });
    }

    function reload_record()
    {
        var garage_id = "{pigcms{$info.garage_id}",
            duty_id   = $("input[name='duty_id']").val(),
            default_html = '<p class="weui-msg__desc"><a href="javascript:void(0);">无数据</a></p>',
            default_load = '<div class="weui-loadmore"> <i class="weui-loading"></i> <span class="weui-loadmore__tips">正在加载</span> </div>'
        ;

        $.ajax({
            url:'{pigcms{:U("ajax_count")}',
            type:'post',
            data:{'garage_id':garage_id,'duty_id':duty_id},
            beforeSend: function () {
                $("#count").html(default_load);
            },
            success:function (res) {
                if(res==1){

                    $("#count").html(default_html);

                }else{
                    $("#count").html(res);
                }
            }
        });
    }
</script>
</html>
