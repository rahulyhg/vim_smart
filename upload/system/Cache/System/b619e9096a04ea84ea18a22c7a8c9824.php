<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/employeeStyle.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
	<tr>
		<th width="180">菜品名称</th>
		<th>单价</th>
		<th>数量</th>
	</tr>
	<?php if(is_array($order['info'])): $i = 0; $__LIST__ = $order['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		<th width="180"><?php echo ($vo['name']); ?></th>
		<th><?php echo ($vo['price']); ?></th>
		<th><?php echo ($vo['num']); ?></th>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr>
		<th colspan="3">支付状态:　
		<?php if(empty($order['paid'])): ?>未支付
		<?php elseif($order['pay_type'] == 'offline' AND empty($order['third_id'])): ?>线下未支付
		<?php elseif($order['paid'] == 2): ?><span style="color:green">已付￥<?php echo ($order['pay_money']); ?></span>，<span style="color:red">未付￥<?php echo ($order['price'] - $order['pay_money']); ?></span>
		<?php else: ?><span style="color:green">全额支付</span><?php endif; ?>
		</th>
	</tr>
	<tr>
		<th colspan="3">余额支付金额:￥ <?php echo ($order['balance_pay']); ?></th>
	</tr>
	<tr>
		<th colspan="3">在线支付金额:￥ <?php echo ($order['payment_money']); ?></th>
	</tr>
	<tr>
		<th colspan="3">使用商户余额:￥ <?php echo ($order['merchant_balance']); ?></th>
	</tr>
	<?php if($order['pay_type'] == 'offline' AND empty($order['third_id'])): ?><tr>
		<th colspan="3">线下需向商家付金额：<font color="red">￥<?php echo ($order['price']-$order['merchant_balance']-$order['balance_pay']); ?>元</font></th>
	</tr><?php endif; ?>
	<tr>
		<td colspan="3" style="line-height:22px;padding-top:15px;">
		姓名：<?php echo ($order['name']); ?><br/>
		电话：<?php echo ($order['phone']); ?><br/>
		地址：<?php echo ($order['address']); ?>
		</td>
	</tr>
</table>
	</body>
</html>