<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>错误提示</title>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="./tpl/WapMerchant/common/static/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
        <script src="./tpl/WapMerchant/common/static/layer/layer.m.js"></script>
		<script>var location_url = '<?php echo ($url); ?>';layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'<?php echo ($msg); ?>',btn: ['确定'],end:function(){location.href=location_url;}});</script>
</body>
	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>


</html>