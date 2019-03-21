<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
		<title>小猪{pigcms{$config.meal_alias_name}预约系统 - 店铺管理中心</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/group_edit.css"/>
	</head>
	<body>
		<table>
			<tr>
				<th width="15%">订单编号</th>
				<td width="35%">{pigcms{$now_order.order_id}</td>
				<th width="15%">预约信息</th>
				<td width="35%">{pigcms{$now_order.appoint_name}</td>
			</tr>
			<tr>
				<td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
			</tr>
			<tr>
				<th width="15%">预约日期</th>
				<td width="35%">{pigcms{$now_order.appoint_date}</td>
				<th width="15%">预约时间点</th>
				<td width="35%"> {pigcms{$now_order.appoint_time}</td>
			</tr>
			<tr>
				<th width="15%">订单状态</th>
				<td width="35%">
					<if condition="$now_order['paid'] == 0" >
					   	<font color="red">未支付</font>
					   	<if condition="$now_order['service_status'] == 0" >
					   		<font color="red">未服务</font>
					   		<a href="{pigcms{:U('Store/appoint_verify',array('order_id'=>$now_order['order_id']))}" class="group_verify_btn">验证服务</a>
					   	<elseif condition="$now_order['service_status'] == 1" />
					   		<font color="green">已服务</font>
					   	</if>
					<elseif condition="$now_order['paid'] == 1" />
						<font color="green">已支付</font>
						<if condition="$now_order['service_status'] == 0" >
					   		<font color="red">未服务</font>
					   		<a href="{pigcms{:U('Store/appoint_verify',array('order_id'=>$now_order['order_id']))}" class="group_verify_btn">验证服务</a>
					   	<elseif condition="$now_order['service_status'] == 1" />
					   		<font color="green">已服务</font>
					   	</if>
					<elseif condition="$now_order['paid'] == 2" />
						<font color="red">已退款</font>
					</if>
				</td>
				
				<th width="15%">定金</th>
				<td width="35%">￥ {pigcms{$now_order.payment_money}</td>
			</tr>
			<tr>
				<th width="15%">下单时间</th>
				<td width="35%">{pigcms{$now_order.order_time|date='Y-m-d H:i:s',###}</td>
				<th width="15%">总价</th>
				<td width="35%">￥ {pigcms{$now_order.appoint_price}</td>
			</tr>
			<if condition="$now_order['paid']">
				<tr>
					<th width="15%">付款时间</th>
					<td width="35%">{pigcms{$now_order.pay_time|date='Y-m-d H:i:s',###}</td>
					<th width="15%">支付方式</th>
					<td width="35%" colspan="3">{pigcms{$now_order.pay_type}</td>
				</tr>
			</if>
				<tr>
					<th width="15%">买家留言</th>
					<td width="85%" colspan="3">{pigcms{$now_order.content}</td>
				</tr>
				<if condition="!empty($now_order['last_time'])">		
					<tr>
						<th width="15%">验证时间</th>
						<td width="35%">{pigcms{$now_order.last_time|date='Y-m-d H:i:s',###}</td>
						<th width="15%">操作店员：</th>
						<td width="35%">{pigcms{$now_order.last_staff}</td>
					</tr>
				</if>
				<if condition="$now_order['paid'] eq '1'">
					<tr>
						<td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
					</tr>
					<tr>
						<th width="15%">用户ID</th>
						<td width="35%">{pigcms{$now_order.uid}</td>
						<th width="15%">用户名</th>
						<td width="35%">{pigcms{$now_order.nickname}</td>
					</tr>
					<tr>
						<th width="15%">用户手机号</th>
						<td width="35%">{pigcms{$now_order.phone}</td>
						<th width="15%">使用商户余额</th>
						<td width="85%" colspan="3">{pigcms{$now_order.merchant_balance}</td>
					</tr>
				</if>
				<tr>
					<th width="15%">余额支付金额</th>
					<td width="35%">{pigcms{$now_order.balance_pay}</td>
					<th width="15%">实际支付金额</th>
					<td width="35%">{pigcms{$now_order.pay_money}</td>
				</tr>
				<if condition="$cue_list">
					<tr>
						<td colspan="4" style="padding-left:5px;color:black;"><b>自定义填写项：</b></td>
					</tr>
					<volist name="cue_list" id="val">
						<if condition="$val['type'] eq 2">
							<tr>
								<th width="15%">{pigcms{$val.name}</th>
								<td width="35%" colspan="3">
									地址：{pigcms{$val.address}
									{pigcms{$val.value}
								</td>
							</tr>
						<else/>
							<tr>
								<th width="15%">{pigcms{$val.name}</th>
								<td width="35%" colspan="3">{pigcms{$val.value}</td>
							</tr>
						</if>
					</volist>
				</if>
		</table>
	</body>
</html>