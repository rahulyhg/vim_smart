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
	<style>
		.frame_form td{line-height:24px;}
	</style>
	<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		<tr>
			<tr>
				<th width="15%">订单编号</th>
				<td width="35%"><?php echo ($now_order["order_id"]); ?></td>
				<th width="15%"><?php echo ($config["group_alias_name"]); ?>商品</th>
				<td width="35%"><a href="<?php echo ($now_order["url"]); ?>" target="_blank" title="查看商品详情"><?php echo ($now_order["s_name"]); ?></a></td>
			</tr>
		</tr>
		<tr>
			<td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
		</tr>
		<tr>
			<th width="15%">订单类型</th>
			<td width="35%"><?php if($now_order['tuan_type'] == '0'): echo ($config["group_alias_name"]); ?>券<?php elseif($now_order['tuan_type'] == '1'): ?>代金券<?php else: ?>实物<?php endif; ?></td>
			<th width="15%">订单状态</th>
			<td width="35%">
				<?php if($now_order['paid']): if($now_order['pay_type'] == 'offline' AND empty($now_order['third_id'])): ?><font color="red">线下支付&nbsp;未付款</font>
					<?php elseif($now_order['status'] == 0): ?>
						<font color="green">已付款</font>&nbsp;
						<?php if($now_order['tuan_type'] != 2){ ?>
							<font color="red">未消费</font>
						<?php }else{ ?>
							<font color="red">未发货</font>
						<?php } ?>
					<?php elseif($now_order['status'] == 1): ?>
						<?php if($now_order['tuan_type'] != 2){ ?>
							<font color="green">已消费</font>
						<?php }else{ ?>
							<font color="green">已发货</font>
						<?php } ?>&nbsp;
						<font color="red">待评价</font>
					<?php else: ?>
						<font color="green">已完成</font><?php endif; ?>
				<?php else: ?>
					<font color="red">未付款</font><?php endif; ?>
			</td>
		</tr>
		<tr>
			<th width="15%">数量</th>
			<td width="35%"><?php echo ($now_order["num"]); ?></td>
			<th width="15%">总价</th>
			<td width="35%">￥ <?php echo ($now_order["total_money"]); ?></td>
		</tr>
		<tr>
			<th width="15%">下单时间</th>
			<td width="35%"><?php echo (date('Y-m-d H:i:s',$now_order["add_time"])); ?></td>
			<?php if($now_order['paid']): ?><th width="15%">付款时间</th>
				<td width="35%"><?php echo (date('Y-m-d H:i:s',$now_order["pay_time"])); ?></td>
			<?php else: ?>
				<th width="15%"></th>
				<td width="35%"></td><?php endif; ?>
		</tr>
		<tr>
			<th width="15%">消费密码</th>
			<td width="35%"><?php if($now_order['group_pass']): echo ($now_order["group_pass_txt"]); endif; ?></td>
			<th width="15%">验证店员</th>
			<td width="35%">
				<?php if($now_order['store_id']): if($now_order['store_name']): echo ($now_order["store_name"]); else: ?>店铺不存在<?php endif; ?>
					 (<?php if($now_order['last_staff']): echo ($now_order["last_staff"]); else: ?>尚未验证<?php endif; ?>)
				<?php else: ?>
					尚未验证<?php endif; ?>
			</td>
		</tr>
		<tr>
			<th width="15%">买家留言</th>
			<td width="85%" colspan="3"><?php echo ($now_order["delivery_comment"]); ?></td>
		</tr>
		<?php if($now_order['status'] == 1): ?><tr>
				<th width="15%"><?php if($now_order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间</th>
				<td width="85%" colspan="3"><?php echo (date('Y-m-d H:i:s',$now_order["use_time"])); ?></td>
			</tr><?php endif; ?>
		
		<tr>
			<td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
		</tr>
		<tr>
			<th width="15%">用户ID</th>
			<td width="35%"><?php echo ($now_order["uid"]); ?></td>
			<th width="15%">用户昵称</th>
			<td width="35%"><?php echo ($now_order["nickname"]); ?></td>
		</tr>
		<tr>
			<th width="15%">订单手机号</th>
			<td width="35%"><?php echo ($now_order["phone"]); ?></td>
			<th width="15%">用户手机号</th>
			<td width="35%"><?php echo ($now_order["user_phone"]); ?></td>
		</tr>
		<?php if($now_order['tuan_type'] == 2): ?><tr>
				<td colspan="4" style="padding-left:5px;color:black;"><b>配送信息：</b></td>
			</tr>
			<tr>
				<th width="15%">收货人</th>
				<td width="35%"><?php echo ($now_order["contact_name"]); ?></td>
				<th width="15%">联系电话</th>
				<td width="35%"><?php echo ($now_order["phone"]); ?></td>
			</tr>
			<tr>
				<th width="15%">配送要求</th>
				<td width="35%">
					<?php switch($now_order['delivery_type']): case "1": ?>工作日、双休日与假日均可送货<?php break;?>
						<?php case "2": ?>只工作日送货<?php break;?>
						<?php case "3": ?>只双休日、假日送货<?php break;?>
						<?php case "4": ?>白天没人，其它时间送货<?php break; endswitch;?>
				</td>
				<th width="15%">邮编</th>
				<td width="35%"><?php echo ($now_order["zipcode"]); ?></td>
			</tr>
			<tr>
				<th width="15%">收货地址</th>
				<td width="85%" colspan="3"><?php echo ($now_order["adress"]); ?></td>
			</tr><?php endif; ?>
		<?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?><tr>
				<th width="15%">线下支付</th>
				<th width="85%" colspan="3">总金额￥<?php echo ($now_order['total_money']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平台余额支付<?php echo ($now_order["balance_pay"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;使用商户余额 ￥<?php echo ($now_order["merchant_balance"]); ?><br>
				<?php if($now_order['wx_cheap'] != '0.00'): ?>微信优惠 ￥<?php echo ($now_order['wx_cheap']); ?><br><?php endif; ?>
				线下需向商家付金额：<font color="red">￥<?php echo ($now_order['total_money']-$now_order['wx_cheap']-$now_order['merchant_balance']-$now_order['balance_pay']); ?>元</font>
				</th>
			</tr>
		<?php else: ?>
			<tr>
				<th width="15%">支付方式</th>
				<th width="85%" colspan="3">余额支付金额 ￥<?php echo ($now_order["balance_pay"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在线支付金额 ￥<?php echo ($now_order["payment_money"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;使用商户余额 ￥<?php echo ($now_order["merchant_balance"]); ?></th>
			</tr><?php endif; ?>
	</table>
	<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
		<input type="reset" value="取消" class="button" />
	</div>
<include file="Public:footer"/