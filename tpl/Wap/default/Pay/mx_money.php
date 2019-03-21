<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>零钱明细</title>
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/eve.kid.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="mx_kw">
	<div class="mx_wz">
		<div class="mx_zb">
			<div class="mx_zbx">充值</div>
			<div class="mx_zbx2">2016-04-28 16:40:45</div>
		</div>
		<div class="mx_yb">+ 100.00</div>
		<div style="clear:both"></div>
	</div>
</div>
<div class="mx_kw">
	<div class="mx_wz">
		<div class="mx_zb">
			<div class="mx_zbx">消费</div>
			<div class="mx_zbx2">{pigcms{$now_user.last_time|date="Y-m-d H:i:s",###}</div>
		</div>
		<div class="mx_yb2">- {pigcms{$now_user.money}///{pigcms{$info.money}</div>
		<div style="clear:both"></div>
	</div>
</div>
</body>
</html>