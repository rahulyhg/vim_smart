<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>付款</title>
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/eve.kid.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/weui.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css"media="screen and (min-width: 320px) and (max-device-width: 568px)"href="{pigcms{$static_path}css/iphone5.css" />
	<link rel="stylesheet" type="text/css"media="screen and (min-width: 414px) and (max-device-width: 716px)"href="{pigcms{$static_path}css/iphone6.css" />
	<link rel="stylesheet" href="{pigcms{$static_path}js/layer/skin/layer.css" type="text/css">
	<link rel="stylesheet" href="{pigcms{$static_path}js/layer/skin/layer.ext.css" type="text/css">
	<script type="text/javascript" charset="utf-8" src="{pigcms{$static_path}js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="{pigcms{$static_path}js/layer/layer.js"></script>

	<style type="text/css">
		@font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")}

		#fk_wui{width: 84.5%;}
		.weui_cells{border-radius: 5px;}
		.weui_cell_select .weui_cell_bd:after{
			content: " ";
			display: inline-block;
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			height: 10px;
			width: 10px;
			border-width: 1px 1px 0 0;
			border-color: #8c8c8c;
			border-style: solid;
			position: relative;
			top: -2px;
			position: absolute;
			top: 50%;
			right: 18px;
			margin-top: -5px;
		}

		.weui_dialog{border-radius: 8px;}
		.weui_tite{height:50px;line-height: 50px;/*border-bottom: 1px solid #8cb7a3;*/}
		.weui_tite:after{
			content: " ";
			position: absolute;
			top: 48px;
			left: 0;
			bottom: 0;
			width: 100%;
			height: 1px;
			border-bottom: 1px solid #8cb7a3;
			color: #D9D9D9;
			-webkit-transform-origin: 0 100%;
			transform-origin: 0 100%;
			-webkit-transform: scaleY(0.5);
			transform: scaleY(0.5);
		}
		.cd-popup-close:before {
			content: " ";
			position: absolute;
			left: 18px;
			top: 25px;
			width: 17px;
			height: 2px;
			background: #b2b2b2;
			transform: rotate(45deg);
		}
		.cd-popup-close:after {
			content: " ";
			position: absolute;
			top: 25px;
			left: 18px;
			bottom: 0;
			width: 17px;
			height: 2px;
			background: #b2b2b2;
			transform: rotate(135deg);
		}
		.weui_btn_dialog.primary{color: transparent;}
		.weui_title{text-align:center;font-size: 19px;font-family: "黑体";}
		.mima_password{float: right;margin-top: 1px;padding: 0 18px;color: #1974f8;}
		.mima_password a:link    {color:#0081ff;}
		.mima_password a:visited {color:#0081ff;}
		/*.weui_dialog{height: 38%;}*/
		.weui_dialog_ft{background: #1FBD1E;margin: 0 15px;border-radius: 5px;color: #fff;margin-top: 7.5%;margin-bottom:7.5%;line-height: 46px;}
		.weui_dialog_hd{margin-top: -6px;}
		.weui_dialog_bd{margin-top: 5px;}
		#weui_mone{font-size:17px;}

		/*零钱*/
		.weui_cells:before {
			content: " ";
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 1px;
			border-top: 1px solid #D9D9D9;
			color: #D9D9D9;
			-webkit-transform-origin: 0 0;
			transform-origin: 0 0;
			-webkit-transform: scaleY(0.5);
			transform: scaleY(0.5);
		}
		.weui_cells:after {
			content: " ";
			position: absolute;
			left: 0;
			bottom: 0;
			width: 100%;
			height: 1px;
			border-bottom: 1px solid #D9D9D9;
			color: #D9D9D9;
			-webkit-transform-origin: 0 100%;
			transform-origin: 0 100%;
			-webkit-transform: scaleY(0.5);
			transform: scaleY(0.5);
		}

		.weui_cells{
			height: 17%;
			margin: 0 15px;margin-top: -5px;
		}
		.weui_img{float: left;width: 40px;}
		.weui_img img{width: 31px;margin-top: -3px;}
		.lq{height: 35px;line-height: 45px;float: left;margin-left: 10px;color: #6f6f6f;}
		.lq span{color: #70726f;}
		.weui_dialog_hd{margin-top: -6px;}
		.weui_dialog_bd{margin-top: -16px;}
		#weui_moneo{font-size: 40px;}
		#weui_mone{font-size: 40px;letter-spacing:-4px;margin-left:-12px;font-family:Helvetica;}
		.weui_cells{line-height: 46px;}
		/*零钱*/
	</style>
</head>
<body>
<div class="fk_rwm">
	<div class="fk_rwm2"><img src="{pigcms{$qrcode}" style="max-width: 100%; height: auto;display: block;" id="flash"/></div>
</div>
<div class="fk_wz">付款码每分钟自动更新</div>
<span id="flashmeet" style="display:none; position:fixed;top: 300px;left:150px;padding:8px; background-color:#fb4746; border-radius:6px; font-szie:15px;color:#fff;text-align: center;font-family:微软雅黑 ">已刷新</span>

<!--<div class="fk_wz2">账户余额：<span style="color:#ff0000;">{pigcms{$now_money}</span> 元</div>-->
<div class="btn-wrapper">
	<button type="submit" class="btn btn-larger btn-block btn-strong" style="width:90%; margin:1rem auto; margin-bottom:0;border-radius:5px;">充值</button>
</div>
<!--BEGIN dialog-->
<div class="weui_dialog_confirm" id="dialog" style="display: none;">
	<div class="weui_mask"></div>
	<div class="weui_dialog">
		<div class="weui_tite">
			<div class="quxiao"><a href="javascript:;" class="weui_btn_dialog primary cd-popup-close" id=" img-replace"></a></div>
			<span class="weui_title"><strong>支付</strong></span>
		</div>
		<!--<div class="weui_dialog_hd"><strong class="weui_dialog_title">向ZLD转账</strong></div>-->
		<div class="weui_dialog_hd"><strong class="weui_dialog_title">商家向您收款</strong></div>
		<div class="weui_dialog_bd" style="color:#000;text-align: center;"><span id="weui_mone" >￥</span></div>
		<!-- <div class="weui_dialog_bd" style="color:#000;"><span id="weui_mone"></span></div>  -->
		<!-- 零钱 -->
		<div class="weui_cells">
			<div class="weui_cell weui_cell_select">
				<div class="weui_cell_bd weui_cell_primary">
					<div class="weui_img"><img src="http://www.hdhsmart.com/tpl/Wap/default/static/images/lq.png"></div>
					<div class="lq"><span></span></div>
				</div>
			</div>
		</div>
		<!-- 零钱 -->
		<div class="weui_dialog_ft">
			<a href="javascript:;" class="weui_btn_dialog default_pay" style="color:#fff;">确认支付</a>
		</div>
	</div>
</div>
<!--END dialog-->
<div class="fk_xlk" id="fk_wui">

</div>
</body>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_path}js/zepto.js"></script>
<script type="text/javascript">
	$(function(){//祝君伟，60秒自动更新，点击主动刷新
		$.ajax({//一进入二维码页面就相当于触发主动刷新
			url:"{pigcms{:U('My/changeSrc')}",


			success:function (re) {
				$("#flash").attr("src",re);
			}
		});
		$('.btn-larger').click(function(){	//点击充值
			window.location.href="{pigcms{:U('My/account_recharge')}";
		});
		var flash = setInterval(function(){
			window.location.href="{pigcms{:U('My/user_qrcode')}";


		},60000);
		$(document).ready(function(){
			$("#flashmeet").fadeIn(1000);
			var xiaoshi = setTimeout(function(){
				$("#flashmeet").fadeOut(1000);
			},1000);
		});
		$("#flash").click(function(){
			$.ajax({
				url:"{pigcms{:U('My/changeSrc')}",


				success:function (re) {
					$("#flash").attr("src",re);
				}
			});
		});
	});
	//var uid='{pigcms{$uid}';	//用户ID
	//var qrCon='{pigcms{$qrCon}';//二维码字符串
	var time = setInterval(function(){//陈琦定时轮询是否有商户收账
		//var qrCon='{pigcms{$qrCon}';//二维码字符串
		$.ajax({
			url:"{pigcms{:U('My/search_result')}",
			type: "post",
			dataType: "json",
			async : true,
			success: function(res){
				//alert(res);
				if(res){
					//alert(res.merchant_name);
					//window.location.href="{pigcms{$config['site_url']}/wap.php?g=Wap&c=My&a=pay_retrun&merContent="+res.msg+"&cmsData="+res.cmsData;
					window.location.href="{pigcms{$config['site_url']}/wap.php?g=Wap&c=My&a=success_pay&merchant_name="+res.merchant_name+"&price="+res.price+"&time="+res.time;

					
				}
			},
			error:function(){
				layer.msg('loading!');
			}
		});
	},100);

	function payStatus(){	//改变预付款状态(即答应请求)
		$.ajax({
			url:"{pigcms{:U('My/pay_dataForm')}",
			type: "post",
			dataType: "json",
			data: {'uid':uid,'pay_status':'2'},
			async : true,
			success: function(res){
				if(res.code==1){	//确认支付后
					//alert(res.msg);
					/*$.ajax({		//发送信息推送
					 url:"{pigcms{:U('My/pay_dataForm')}",
					 type: "post",
					 dataType: "json",
					 data: {'uid':uid,'pay_cms':'cms','cmsData':res.cmsData},
					 async : true,
					 success: function(res){

					 },
					 error:function(){
					 layer.msg('loading error!');
					 }
					 });*/
					window.location.href="{pigcms{$config['site_url']}/wap.php?g=Wap&c=My&a=pay_retrun&merContent="+res.msg+"&cmsData="+res.cmsData;
				}else{
					//alert(res.msg);
					layer.msg(res.msg);
				}
			},
			error:function(){
				layer.msg('loading error!');
			}
		});
	}

	function payDel(){	//删除预支付订单(关闭弹框时)
		$.ajax({
			url:"{pigcms{:U('My/pay_dataForm')}",
			type: "post",
			dataType: "json",
			data: {'uid':uid,'pay_del':'del'},
			async : true,
			success: function(res){

			},
			error:function(){
				layer.msg('loading error!');
			}
		});
	}

</script>
</html>