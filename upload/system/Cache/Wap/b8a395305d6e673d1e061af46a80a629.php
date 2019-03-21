<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>支付提示</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
	<!--header  class="navbar">
        <h1 class="nav-header">支付提示</h1>
    </header-->
	<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
	<?php if($pay_info['error']): ?><script>layer.open({title:'支付提示',content:'<?php echo ($pay_info["msg"]); ?>',end:function(){location.href='<?php echo ($pay_info["url"]); ?>';}});</script>
	<?php else: ?>
		<script>layer.open({type:2,content:'<?php echo ($pay_info["msg"]); ?>',shadeClose:false});</script>
		<script>window.location.href = '<?php echo ($pay_info["url"]); ?>';</script><?php endif; ?>
<?php echo ($hideScript); ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
</body>
</html>