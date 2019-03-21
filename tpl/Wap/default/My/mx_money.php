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
<volist name="list" id="vo">
	<div class="mx_kw">
		<div class="mx_wz">
			<div class="mx_zb">
				<if condition="$vo.type eq 1">
					<div class="mx_zbx">{pigcms{$vo['desc']['0']}</div>
					<if condition="$vo.app_money neq 0"><div class="mx_zbx2">平台余额：+{pigcms{$vo['app_money']}</div></if>
					<if condition="$vo.merchant_money neq 0"><div class="mx_zbx3">商户({pigcms{$vo['name']})余额：+{pigcms{$vo['merchant_money']}</div></if>
					<div class="mx_zbx4">{pigcms{$vo.time|date="Y-m-d H:i:s",###}</div>
			</div>
			<div class="mx_yb2" style="color:#0697dc;">+{pigcms{$vo.money}</div>
			<else/>
			<div class="mx_zbx">{pigcms{$vo['desc']['0']}</div>
			<if condition="$vo.app_money neq 0"><div class="mx_zbx2">平台余额：-{pigcms{$vo['app_money']}</div></if>
			<if condition="$vo.merchant_money neq 0"><div class="mx_zbx3">商户({pigcms{$vo['name']})余额：-{pigcms{$vo['merchant_money']}</div></if>
			<div class="mx_zbx4">{pigcms{$vo.time|date="Y-m-d H:i:s",###}</div>
		</div>
		<div class="mx_yb2" style="color:#000;">-{pigcms{$vo.money}</div>
		</if>
		<!-- 遍历消费数据 -->
		<div style="clear:both"></div>
	</div>
	</div>
</volist>
</body>
</html>