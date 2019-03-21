<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
	<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/eve.kid.css" rel="stylesheet" type="text/css" />
</head>
<body>



<!--<div class="mx_kw">-->
<!--	<div class="mx_wz">-->
<!--		<div class="mx_zb">-->
<!--			<div class="mx_zbx">充值</div>-->
<!--			<div class="mx_zbx2">2016-04-28 16:40:45</div>-->
<!--		</div>-->
<!--		<div class="mx_yb">+ 100.00</div>-->
<!--		<div style="clear:both"></div>-->
<!--	</div>-->
<!--</div>-->
 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mx_kw">
	<div class="mx_wz">
		<div class="mx_zb">
			<?php if($vo["type"] == 1): ?><div class="mx_zbx"><?php echo ($vo['desc']['0']); ?>操作</div>
				<div class="mx_zbx2"><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></div>
		</div>
		<div class="mx_yb2" style="color:#009100;">+<?php echo ($vo["money"]); ?></div>
		<?php else: ?>
				<div class="mx_zbx"><?php echo ($vo['desc']['0']); ?>操作</div>
<!--				<div class="mx_zbx" style="width:300px;">商品名：<?php echo ($vo["orderid"]); ?></div>-->
		<div class="mx_zbx2"><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></div>
	</div>
	<div class="mx_yb2" style="color:#000;">-<?php echo ($vo["money"]); ?></div><?php endif; ?>

		<!-- 遍历消费数据 -->
		<div style="clear:both"></div>
	</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>