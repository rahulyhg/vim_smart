<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<title>智能门禁</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="{pigcms{$static_path}css/137/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/137/sweetalert.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="{pigcms{$static_path}css/137/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="{pigcms{$static_path}css/137/kkd.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="{pigcms{$static_path}css/137/layer.css" rel="stylesheet" id="style_components" type="text/css" />
	<!-- END THEME LAYOUT STYLES -->
	<style type="text/css">
		body {background-color:#febe39;}
		.btn:not(.btn-sm):not(.btn-lg) {line-height: 2;font-size: 16px; width:100%;}
		.btn-circle {border-radius: 6px!important;overflow: hidden;}
		.btn.red:not(.btn-outline) {color: #fff;background-color: #e7505a;;border-color: #e7505a;}
		.btn.red:not(.btn-outline).active, .btn.red:not(.btn-outline):active, .btn.red:not(.btn-outline):hover, .open>.btn.red:not(.btn-outline).dropdown-toggle {
			color: #fff;
			background-color: #e7505a;
			border-color:#e7505a;
		}
		.btn-success {
			color: #fff;
			background-color: #3fb636;
			border-color: #3fb636;
		}
		.sweet-alert .sa-icon.sa-success .sa-placeholder {
			width: 80px;
			height: 80px;
			border: 4px solid #ea201e;
			border-radius: 50%;
			box-sizing: content-box;
			position: absolute;
			left: -4px;
			top: -4px;
			z-index: 2;
		}
		.sweet-alert .sa-icon.sa-success .sa-line {
			height: 5px;
			background-color: #ea201e;
			display: block;
			border-radius: 2px;
			position: absolute;
			z-index: 2;
		}
		.sweet-alert .sa-icon.sa-success .sa-line {
			height: 5px;
			background-color: #ea201e;
			display: block;
			border-radius: 2px;
			position: absolute;
			z-index: 2;
		}
		.btn-success.focus, .btn-success:focus {
			color: #fff;
			background-color: #e92558;
			border-color: #ea201e;
		}
		.btn-primary.focus, .btn-primary:focus {
    color: #fff;
    background-color: #e92558;
    border-color: #122b40;
}
.btn-primary {
    color: #fff;
    background-color: #ea201e;
    border-color: #ea201e;
}
.btn-primary.active, .btn-primary:active, .btn-primary:hover, .open>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #ea201e;
    border-color: #ea201e;
}
		.demo{list-style:none;height:126px;float:left; width:30%;}
		.demo span{position:relative;width:100%;height:100%;background:#06c1ae;display:inline-block;border-radius:6px 0 0 6px;}
		.demo span:after{content: "";position: absolute;top: -20px;display: block;width:10px;height: 100%;margin-top: 20px;background-size: 20px 9px;}
		.demo span:after{right: -10px;background-color: #06c1ae;background-position: 100% 15%;
			background-image: linear-gradient(-45deg, #ffffff 25%, transparent 25%, transparent),
			linear-gradient(-135deg, #ffffff 25%, transparent 25%, transparent),
			linear-gradient(-45deg, transparent 75%, #ffffff 75%),
			linear-gradient(-135deg, transparent 75%, #ffffff 75%);}

		.demo2{list-style:none;height:126px;float:left; width:30%;}
		.demo2 span{position:relative;width:100%;height:100%;background:#c9cacc;display:inline-block;border-radius:6px 0 0 6px;}
		.demo2 span:after{content: "";position: absolute;top: -20px;display: block;width:10px;height: 100%;margin-top: 20px;background-size: 20px 9px;}
		.demo2 span:after{right: -10px;background-color: #c9cacc;background-position: 100% 15%;
			background-image: linear-gradient(-45deg, #ffffff 25%, transparent 25%, transparent),
			linear-gradient(-135deg, #ffffff 25%, transparent 25%, transparent),
			linear-gradient(-45deg, transparent 75%, #ffffff 75%),
			linear-gradient(-135deg, transparent 75%, #ffffff 75%);}
		-->
	</style>
</head>
<!-- END HEAD -->

<body>
<div style="width:100%; margin:0px auto;">
	<div style="width:100%; overflow:hidden;"><img style="max-width:100%;" src="{pigcms{$static_path}images/137/hd1.png"></div>
	<div style="width:100%; margin:0px auto; margin-bottom:0; background:url({pigcms{$static_path}images/137/hd2.png) #febe39 no-repeat; max-width:100%; background-size:100% 100%;">
		<div style="margin:0px auto; width:95%; font-size:16px; text-align:left; border-bottom:2px #e70000 solid; color:#969696; padding:15px 0 10px 13px; font-family:'微软雅黑'; font-weight:600; color:#e70000;">活动预告</div>
		<div style="margin:0px auto; width:85%;">
			<div style="width:94%; line-height:2.1; font-size:17px; color:firebrick; margin-top:18px; margin-left:3%; text-align:center; font-family:'微软雅黑'; font-weight:500;" id="div_txt">即将有一大波福利来袭,敬请期待！</div>
			<div style="padding-top:10px;"><div class="mt-sweetalert" id="mybotton"><button class="btn red btn-block">点击了解</button></div>
			<div style="margin:10px auto; width:93%;display: none" id="cate">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
								<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #01b1a1 solid; color:#FFFFFF; font-size:18px; text-align:center;">
									<div style="margin:0px auto; width:100%;"><div style="font-size:38px; float:left;">10</div><div style="font-size:16px; float:left; padding-top:5px; font-family:'微软雅黑';">元</div></div>
								</div>
								<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">代金券</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#000000; font-size:16px; font-family:'微软雅黑';">电影周边10元代金券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#999999; font-size:14px; font-family:'微软雅黑';">满50元可用，限购</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:'微软雅黑'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:40%; float:left; line-height:35px; color:#e65c51; font-family:'微软雅黑'; font-size:12px;">5天过期</div>
								<div style="width:60%; float:right; line-height:35px; color:#909090; font-family:'微软雅黑'; font-size:12px; text-align:right;">有效期至12-25</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>
			<div style="background:url({pigcms{$static_path}images/137/xxx.png) no-repeat; background-size:100% 100%; width:57px; height:48px; margin-top:10px; right:12%; z-index:999; position:absolute;display: none" id="guoqi"></div>
			<div style="margin:10px auto; margin-bottom:10px; width:93%;display: none" id="plate1">
				<div style="width:100%; background-color:#febe39;">
					<div class="demo2">
						<span style="width:100%; margin:0px auto; padding-top:20px;">
							<div style="width:70%; margin:0px auto;">
								<div style="width:100%; height:50px; line-height:50px; border-bottom:1px #b8b9bb solid; color:#FFFFFF; font-size:18px; text-align:center;">
									<div style="margin:0px auto; width:100%;"><div style="font-size:16px; float:left;">1小时</div><div style="font-size:16px; float:left; padding-top:5px; font-family:'微软雅黑';"></div></div>
								</div>
								<div style="width:100%; line-height:30px; color:#FFFFFF; text-align:center; height:30px;">减免</div>
							</div>
						</span>
					</div>
					<div style="width:70%; height:126px; float:left; background-color:#FFFFFF; border-radius:0 6px 6px 0;">
						<div style="width:80%; margin:0px auto;">
							<div style="width:100%; height:40px; line-height:40px; color:#9a9a9a; font-size:16px; font-family:'微软雅黑';">停车减免一小时优惠券</div>
							<div style="width:100%; height:15px; line-height:15px; color:#9a9a9a; font-size:14px; font-family:'微软雅黑';">您已经使用了停车优惠券</div>
							<div style="width:100%; padding-top:34px; height:35px; line-height:35px; color:#999999; font-size:14px; font-family:'微软雅黑'; border-bottom:0.8px #f3f3f3 solid;">
								<div style="width:60%; float:right; line-height:35px; color:#9a9a9a; font-family:'微软雅黑'; font-size:12px; text-align:right;">有效期至12-31</div>
								<div style="clear:both"></div>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>

			<div style="padding-top:15px;"></div>
		</div>

		<div style="width:100%; height:10px;"></div>
	</div>
</div>
<div style="margin:30px auto; width:98%; border-radius:8px; border:3px #c21c08 solid; background-color:#ffffff;">
	<div style="width:90%; margin:0px auto; padding-top:10px; padding-bottom:10px;">
		<div style="line-height:1.5; font-size:16px; color:#4b4b4b; font-family:'微软雅黑'; font-weight:800;">活动介绍</div>
		<div style="line-height:2; font-size:14px; color:#7e7e7e; font-family:'微软雅黑'; padding-top:5px;">1、使用微信扫码开门即可获得一次抽奖机会<br/>2、奖品（随机获得以下奖品中任意一种）<br/><span style="color:#e7505a;">随机微信现金红包<br/>6楼食堂5元现金抵用券<br/>1小时减免停车券</span><br/>3、最终解释权归汇得行控股（中国）有限公司</div>
	</div>
</div>
<!--<div style="width:100%; margin:-3px auto;"><img style="max-width:100%;" src="{pigcms{$static_path}images/137/gr.jpg"></div>-->
<div class="cwx"><img src="{pigcms{$static_path}images/137/xx.png" width="24" height="11" style="margin-right:5px; margin-top:-4px;">汇得行控股（中国）有限公司</div>

<script src="{pigcms{$static_path}js/137/jquery.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/bootstrap.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/js.cookie.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/137/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{pigcms{$static_path}js/137/sweetalert.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{pigcms{$static_path}js/137/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{pigcms{$static_path}js/137/ui-sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var gift = "{pigcms{$gift}";
	var state = "{pigcms{$state}";
	var rc_result = "{pigcms{$rc_result}";
	var message = "{pigcms{$message}";
	$(function(){
		$("#mybotton").click(function(){
			swal({
				title: "新年将至，一大波福利强势来袭！",

				text: "汇得行将于12月27日至12月29日期间，推出福利满满的活动哦！敬请期待",
				imageUrl: "{pigcms{$static_path}images/137/02.jpg",
				closeOnConfirm: false,
				animation: "slide-from-top",
				confirmButtonText: "朕知道了"
			});

		});
		$("#mytable").on("click","#mybutton2",function(){
			swal({
				title: "恭喜你！获得一张停车优惠券",
				text: "赶快去绑定车牌，然后使用吧！",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				animation: "slide-from-top",
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				inputPlaceholder: "请输入您的车牌号（鄂A-XXXXX）"
			}, function(inputValue) {
				var regst = /^[\u4e00-\u9fa5]{1}[a-zA-Z]{1}[-][a-zA-Z_0-9]{5}$/;
				if (inputValue === false) return false;

				if (inputValue === "") {
					swal.showInputError("您还没有输入车牌");
					return false
				}
				if (inputValue.length != 8) {
					swal.showInputError("请输入正确的车牌,例如 鄂A-F1234");
					return false
				}else if(regst.test(inputValue)){
					$.ajax({
						url: "{pigcms{:U('House/pause')}",
						type: "get",
						data:{'pause':inputValue,'rc_result':rc_result},
					}).done(function(res) {
						if(res == 8){
							swal({
								title: "绑定车牌成功",
								text: "车牌"+inputValue+"已享受优惠",
								type: "success",
								confirmButtonText: "确定"
							});
							$("#plate").hide();
							$("#plate1").show();
							$("#guoqi").show();
							$("#div_txt").html("您已经使用了"+gift);
						}else if(res == 1){
							swal("OMG", "缺少对应活动id参数", "error");
						}else if(res ==2){
							swal("OMG", "缺少对应活动id参数", "error");
						}else if(res ==3){
							swal("OMG", "没有指定车辆或者用户", "error");
						}else if(res ==4){
							swal("OMG", "当前没有可创建优惠请的活动", "error");
						}else if(res ==5){
							swal("OMG", "你输入的用户或者车辆不存在，无法发放优惠券", "error");
						}else if(res ==6){
							swal("OMG", "优惠口令输入错误", "error");
						}else if(res ==7){
							swal("OMG", "该商户与活动不匹配", "error");
						}else if(res ==10){
							swal("OMG", "已近领取过该优惠券了", "error");
						}else if(res ==11){
							swal("OMG", "活动已经结束", "error");
						}else if(res ==12){
							swal("OMG", "很抱歉，优惠名额已经使用完", "error");
						}

					}).error(function(res) {
						swal("OMG", "操作失败了!", "error");
					});
				}else{
					swal.showInputError("请输入正确的车牌,例如 鄂A-F1234");
					return false
				}
			});
		});
	})

</script>
</body>

</html>