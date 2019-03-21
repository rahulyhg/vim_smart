<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
		<title><?php echo ($config["site_name"]); ?> - 店铺管理中心</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/group_edit.css"/>
	</head>
	<body>
		<table>
			<tr>
				<th width="15%">订单编号</th>
				<td width="35%"><?php echo ($now_order["order_id"]); ?></td>
				<th width="15%"><?php echo ($config["group_alias_name"]); ?>商品</th>
				<td width="35%"><a href="<?php echo ($now_order["url"]); ?>" target="_blank" title="查看商品详情"><?php echo ($now_order["s_name"]); ?></a></td>
			</tr>
			<tr>
				<td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
			</tr>
			<tr>
				<th width="15%">订单类型</th>
				<td width="35%"><?php if($now_order['tuan_type'] == '0'): echo ($config["group_alias_name"]); ?>券<?php elseif($now_order['tuan_type'] == '1'): ?>代金券<?php else: ?>实物<?php endif; ?></td>
				<th width="15%">订单状态</th>
				<td width="35%">
				<?php if($now_order['status'] == 3): ?><font color="red">已取消</font>
					<?php elseif($now_order['paid'] == '1'): ?>
						<?php if($now_order['pay_type'] == 'offline' AND empty($now_order['third_id'])): ?><font color="red">线下支付　未付款</font>
						<?php elseif($now_order['status'] == '0'): ?>
							<font color="green">已付款</font>&nbsp;
							<if condition="$now_order['tuan_type'] neq '2'">
							<?php if($now_order['tuan_type'] != 2){ ?>
								<font color="red">未消费</font>
							<?php }else{ ?>
								<font color="red">未发货</font>
							<?php } ?>
						<?php elseif($now_order['status'] == '1'): ?>
							<?php if($now_order['tuan_type'] != 2){ ?>
								<font color="green">已消费</font>
							<?php }else{ ?>
								<font color="green">已发货</font>
							<?php } ?>&nbsp;
							<font color="red">待评价</font>
						<?php elseif($now_order['status'] == 3): ?>
							<font color="red">已退款</font>
						<?php elseif($now_order['status'] == 4): ?>
							<font color="red">用户已取消</font>
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
					<th width="15%">买家留言</th>
					<td width="85%" colspan="3"><?php echo ($now_order["delivery_comment"]); ?></td>
				</tr>
			<tr>
				<th width="15%">支付方式</th>
				<td width="85%" colspan="3"><?php echo ($now_order["paytypestr"]); ?></td>
			</tr>
			<?php if(!empty($now_order['use_time'])): ?><tr>
					<th width="15%"><?php if($now_order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间</th>
					<td width="35%"><?php echo (date('Y-m-d H:i:s',$now_order["use_time"])); ?></td>
					<th width="15%">操作店员：</th>
					<td width="35%"><?php echo ($now_order["last_staff"]); ?></td>
				</tr><?php endif; ?>
			<?php if($now_order['paid'] == '1'): ?><tr>
					<td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
				</tr>
				<tr>
					<th width="15%">用户ID</th>
					<td width="35%"><?php echo ($now_order["uid"]); ?></td>
					<th width="15%">用户名</th>
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
					</tr>
					<?php if(empty($now_order['store_id'])){ ?>
						<tr>
							<th width="15%">将订单归属于店铺：</th>
							<td width="85%" colspan="3">
								<select id="order_store_id">
									<?php if(is_array($group_store_list)): $i = 0; $__LIST__ = $group_store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["store_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<button id="store_id_btn">修改</button>
							</td>
						</tr>
					<?php } endif; ?>
				<tr>
					<th width="15%">余额支付金额</th>
					<td width="35%"><?php echo ($now_order["balance_pay"]); ?></td>
					<th width="15%">在线支付金额</th>
					<td width="35%"><?php echo ($now_order["payment_money"]); ?></td>
				</tr>
				<tr>
					<th width="15%">使用商户余额</th>
					<td width="85%" colspan="3"><?php echo ($now_order["merchant_balance"]); ?></td>
				</tr>
				<?php if($now_order['paid'] == '1'): ?><tr>
						<td colspan="4" style="padding-left:5px;color:black;"><b>额外信息：</b></td>
					</tr>
					<tr>
						<th width="15%">订单标记</th>
						<td width="85%" colspan="3"><input type="text" class="input" id="merchant_remark" value="<?php echo ($now_order["merchant_remark"]); ?>" style="width:400px;"/> <button id="merchant_remark_btn">修改</button></td>
					</tr><?php endif; endif; ?>
		</table>
		<script type="text/javascript">
			$(function(){
				$('#merchant_remark_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("<?php echo U('Group/group_remark',array('order_id'=>$now_order['order_id']));?>",{merchant_remark:$('#merchant_remark').val()},function(result){
						$('#merchant_remark_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
				$('#store_id_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("<?php echo U('Group/order_store_id',array('order_id'=>$now_order['order_id']));?>",{store_id:$('#order_store_id').val()},function(result){
						$('#store_id_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
			});
		</script>
	</body>
</html>