<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />	
		<title>支付提示</title>
		<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/weixin_pay.css" rel="stylesheet"/>
		<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/weui.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/scripts/jquery.js"/> </script>

		<style>
			body{background-color:#FFF;}
			.weui_btn {
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    padding-top: 11px;
    padding-bottom: 11px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #FFFFFF;
    line-height: 20px;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    overflow: hidden;
}
			.btn.btn-block {
				text-align: center;
				width: 100%;
				padding: 11px 10px;
				font-size: 16px;
				line-height: 16px;
				border-radius: 4px;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
			.btn.btn-green {
				color: #fff;
				background-color: #06bf04;
				border-color: #03b401;
			}
			.btn {
				display: inline-block;
				background-color: #fff;
				border: 1px solid #e5e5e5;
				border-radius: 3px;
				padding: 4px;
				text-align: center;
				margin: 0;
				color: #999;
				font-size: 12px;
				cursor: pointer;
				line-height: 18px;
				-webkit-appearance: none;
			}
			.pay_img{
				width:85px;
				height:85px;
				margin: 0 auto;
			}
			.pay_img img{
				width:85px;
				height:85px;;
			}
			ul.round{border: 0px;box-shadow:inherit;}
			ul.round #nav_mb{background-color:inherit;border: 0px;background-image:inherit;}
			.round li.title span{padding: 8px 0px 8px 0; text-align: center;   color: #1ea300;  font-size: 19px;  }
			.round li.title{box-shadow:inherit;}
			.nav_lr{width: 90%;  height: 45px;  margin: 0 auto;    line-height: 45px;}
			#nav_lrr:before{  content: " ";
				position: absolute;
				left: 15px;

				width: 90%;
				height: 1px;
				border-top: 1px solid #D9D9D9;
				color: #D9D9D9;
				-webkit-transform-origin: 0 0;
				transform-origin: 0 0;
				-webkit-transform: scaleY(0.5);
				transform: scaleY(0.5);}
			#nav_lrr:after{
				content: " ";
				position: absolute;
				left:15px;
				top: 242px;
				width: 90%;
				height: 1px;
				border-bottom: 1px solid #D9D9D9;
				color: #D9D9D9;
				-webkit-transform-origin: 0 100%;
				transform-origin: 0 100%;
				-webkit-transform: scaleY(0.5);
				transform: scaleY(0.5);
			}
			.nav_left{ float: left;}
			.nav_right{ float: right;
		</style>
			<script type="text/javascript">
				$(function(){
				$('.weui_btn_primary').click(function(){
					//window.close();   //关闭当前页面
					WeixinJSBridge.call('closeWindow');
				})
			})
		</script>
	</head>
	<body style="padding-top:20px;">
		<div id="payDom" class="cardexplain">
			<div class="pay_img"><img src="<?php echo PIGCMS_TPL_STATIC_PATH;?>images/123.png"></div>
			<ul class="round">
				<li class="title mb" id="nav_mb"><span class="none">支付成功</span></li>
				<li class="nob">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang" style="text-align: center;font-size:35px;">
						<tr><td style="color: #000;">￥<?php echo $orderInfo['goods_price'];?> </td></tr>
					</table>
				</li>
			</ul>
		</div>
		<div>
       <div class="nav_lr" id="nav_lrr">
		   <div class="nav_left">
		   <span >收款人</span>
			   </div>
		   <div class="nav_right">
			   <span><!--阳哥--><?php echo $merInfo['wxname'];?></span>
		   </div>
	   </div>
			</div>
		<div id="footReturn" style="margin: 0 auto;margin-top: 40px;width: 90%;">
			<!--<ul class="round" style="height: 40px;">
				<li class="mb" class="btn-pay btn btn-block btn-large btn-umpay btn-green" style="text-align:center;height:40px;line-height:40px;font-size:18px;color:#fff;background-color:#06bf04;border-color:#03b401;border-radius:5px;">支付成功</li>
			</ul>-->
			<!--<button class="btn-pay btn btn-block btn-large btn-umpay btn-green" type="button">支付成功</button>-->
			<button class="zhifu weui_btn weui_btn_primary" type="button" stle="disabl">完成</button>
		</div>
		<div style="position:absolute; bottom:0; left:50%; margin-left:-51px;">
				<div style="float:left; margin-top:0.5px;"><img src="./pigcms_tpl/Merchants/Static/images/jjy.png" style="width:11px; height:18px;"></div>
				<div style="float:left; color:#c1c1c1; padding-left:4px; height:20px; line-height:20px; width:87px; font-size:12px; font-weight:bold;">汇得行智慧助手</div>
				<div style="clear:both"></div>
		</div>
	</body>
	<script type="text/javascript">
	$(function(){
		$('.btn-pay').click(function(){
			//window.close();	//关闭当前页面
			WeixinJSBridge.call('closeWindow');
		})
	})
	</script>
</html>