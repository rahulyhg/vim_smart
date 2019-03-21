<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />	
		<title>温馨提示</title>
		<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/weixin_pay.css" rel="stylesheet"/>
		<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>index/pay/styles/weui.css" rel="stylesheet"/>
		<style>
			body{background-color: #efeff4;}
		#footReturn li{

		    text-align: center;
			line-height: 50px;
			font-size: 18px;
			padding: 10px 20px;
			text-decoration: none;
			color: #000;
		}
			ul.round{
				 border: 0px;
				 background-color: inherit;
			}
			ul.round li{     border: 0px;}
			.round li span{display: initial;padding: 10px 5px 9px 0;font-size: 18 px;}
			#footReturn li{    padding: 10px 15px;}
			#nav_img{
				margin: 0 auto;
				width: 100px;
				margin-top: 30px;
				margin-bottom: 20px;
			}
			#nav_img img{width:100px;}
			.round li p{
				padding: 0;
				margin: 2px 0;
				color: #999;
				font-size: 17px;
				line-height: 30px;

			}
		</style>
	</head>
	<body >
		<div id="footReturn" >
			<div id="nav_img">
				<i class="weui_icon_msg weui_icon_warn"></i>
			</div>
			
			<ul class="round">
				<li class="mb" id="nav_bm"  style="text-align:center"><p><?php echo $msg;?></p></li>
				<div style="width: 90%; margin: 0 auto;border-radius: 5px;">
				<li class="mb"  style="text-align:center;margin-top: 45px;line-height: 40px;padding: 2px 20px;border-radius: 5px;background-color: #06bf04;color: #fff;"><span id="returnSecond">7</span>秒后自动返回</li>
					</div>
			</ul>
		</div>
	</body>
		<script type="text/javascript">
		var wait = document.getElementById('returnSecond');
			var interval = setInterval(function(){
				var time = --wait.innerHTML;
				if(time == 0) {
					window.history.back();
					clearInterval(interval);
				};
			},1000);
		</script>
</html>