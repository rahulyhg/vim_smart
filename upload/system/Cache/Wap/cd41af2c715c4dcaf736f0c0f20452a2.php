<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8"/>

		<title>成功提示</title>

		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">

		<meta name="apple-mobile-web-app-capable" content="yes"/>

		<meta name='apple-touch-fullscreen' content='yes'/>

		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>

		<meta name="format-detection" content="telephone=no"/>

		<meta name="format-detection" content="address=no"/>

	</head>

	<body>

        <script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>

		<script>var location_url = '<?php echo ($url); ?>';layer.open({title:['成功提示','background-color:#fb4746;color:#fff;'],content:'<?php echo ($msg); ?>',btn: ['确定'],end:function(){location.href=location_url;}});</script>

	</body>

</html>