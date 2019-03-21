<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
		<title>{pigcms{$config.site_name} - 店铺管理中心</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/group_edit.css"/>
	</head>
	<body>
		<table>
			<tr>
				<th width="15%">订单编号</th>
				<td width="35%">{pigcms{$now_order.order_id}</td>
				<th width="15%">服务名称</th>
				<td width="35%">{pigcms{$now_order.appoint_name}</td>
			</tr>
			<tr>
				<td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
			</tr>
			<tr>
				<th width="15%">用户名</th>
				<td width="35%">{pigcms{$now_order.nickname}</td>
				<th width="15%">手机号</th>
				<td width="35%">{pigcms{$now_order.phone}</td>
			</tr>
			<tr>
				<th width="15%">预约日期</th>
				<td width="35%">{pigcms{$now_order.appoint_date}</td>
				<th width="15%">预约时间点</th>
				<td width="35%">{pigcms{$now_order.appoint_time}</td>
			</tr>
			<tr>
				<th width="15%">下单时间</th>
				<td width="35%">{pigcms{$now_order.order_time|date='Y-m-d H:i:s',###}</td>
				<th width="15%">定金</th>
				<td width="35%">￥ {pigcms{$now_order.payment_money}</td>
			</tr>
			<tr>
				<th width="15%">服务类型</th>
				<td width="35%">
					<if condition="$now_order['appoint_type'] eq 0"><span style="color:red">到店</span>
					<elseif condition="$now_order['appoint_type'] eq 1" /><span style="color:red">上门</span>
					</if>
				</td>
				<th width="15%">总价</th>
				<td width="35%">￥ {pigcms{$now_order.appoint_price}</td>
			</tr>
			<tr>
				<th width="15%">支付状态</th>
				<td width="35%">
					<if condition="$now_order['paid'] eq 0"><span style="color:red">未支付</span>
					<elseif condition="$now_order['paid'] eq 1" /><span style="color:green">已支付</span>
					<elseif condition="$now_order['paid'] eq 2" /><span style="color:green">已退款</span>
					</if>
				</td>
				<th width="15%">服务状态</th>
				<td width="35%">
					<if condition="$now_order['service_status'] eq 0"><span style="color:red">未服务</span>
					<elseif condition="$now_order['service_status'] eq 1" /><span style="color:green">已服务</span>
					</if>
				</td>
			</tr>
			<tr>
				<th width="15%">买家留言</th>
				<td width="85%" colspan="3">{pigcms{$now_order.content}</td>
			</tr>
			<!-- <tr>
				<th width="15%">支付方式</th>
				<td width="85%" colspan="3">{pigcms{$now_order.paytypestr}</td>
			</tr> -->
			<if condition="!empty($now_order['use_time'])">		
				<tr>
					<th width="15%"><if condition="$now_order['tuan_type'] neq 2">消费<else/>发货</if>时间</th>
					<td width="35%">{pigcms{$now_order.use_time|date='Y-m-d H:i:s',###}</td>
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
				<tr>
					<th width="15%">余额支付金额</th>
					<td width="35%">{pigcms{$now_order.balance_pay}</td>
					<th width="15%">在线支付金额</th>
					<td width="35%">{pigcms{$now_order.payment_money}</td>
				</tr>
			</if>
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
		<script type="text/javascript">
			$(function(){
				$('#merchant_remark_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("{pigcms{:U('Group/group_remark',array('order_id'=>$now_order['order_id']))}",{merchant_remark:$('#merchant_remark').val()},function(result){
						$('#merchant_remark_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
				$('#store_id_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("{pigcms{:U('Group/order_store_id',array('order_id'=>$now_order['order_id']))}",{store_id:$('#order_store_id').val()},function(result){
						$('#store_id_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
			});
		</script>
	</body>
</html>