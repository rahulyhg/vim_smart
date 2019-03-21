
<include file="header" /><body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<section>
		<ul class="my_order">
			<li>
				<a href="{pigcms{:U('Takeout/menu', array('mer_id'=>$order['mer_id'],'store_id'=>$order['store_id']))}">
					<div>
						<div class="ico_status {pigcms{$order['css']}"><i></i>{pigcms{$order['show_status']}</div>
					</div>
					<div>
						<h3 class="highlight">{pigcms{$store['name']}</h3>
						<p>{pigcms{$order['total']}份/￥{pigcms{$order['price']}</p>
						<div>{pigcms{$order['date']}</div>
					</div>
					<div class="w14"><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th>美食列表</th>
					<th>{pigcms{$order['total']}份</th>
					<th><strong class="highlight">￥{pigcms{$order['price']}</strong></th>
				</tr>
			</thead>
			<tbody>
				<volist name="order['info']" id="info">
				<tr>
					<td>{pigcms{$info['name']}</td>
					<td>X{pigcms{$info['num']}</td>
					<td>￥{pigcms{$info['price']}</td>
				</tr>
				</volist>
			</tbody>
		</table>

		<ul class="box">
			<li>预定人：{pigcms{$order['name']}</li>
			<li>手机：{pigcms{$order['phone']}</li>
			<li>送餐地址：{pigcms{$order['address']}</li>
			<li>送餐时间：{pigcms{$order['arrive_time']}</li>
			<li>送餐费用：￥{pigcms{$order['delivery_fee']}</li>
			<li>积分抵扣费用：￥{pigcms{$order['score_deducte']}</li>
			<li>支付方式：{pigcms{$order['paytypestr']}</li>
			<li>支付状态：<if condition="$order['status'] eq 3"><span style="color:red">已退款</span><elseif condition="$order['paid']"/><if condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])"><span style="color:red">线下未支付</span><else /><span style="color:green">已付款</span></if><else /><span style="color:#0697dc;">未支付</span></if></li>
			<if condition="$order['paid'] && $order['status'] eq 0">
			<li>消费二维码：<span id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</span></li>
			</if>
		</ul>
		<ul class="box">
			<li>备注</li>
			<li><if condition="$order['note']">{pigcms{$order['note']}<else />无</if></li>
		</ul>
	</section>

	<in name="openid" value="$arr_openid">
		<footer class="order_fixed">
			<div class="fixed">
				<div style="float: right">
							<if condition="$order['is_confirm'] eq 1">
								<a class="comm_btn" href="javascript:;">已接单</a>
							<else/>
								<a class="comm_btn" id="confirm" openid="{pigcms{$openid}" uid="{pigcms{$order['uid']}" price="{pigcms{$order['price']}" attr_mer="{pigcms{$order['mer_id']}" attr_store="{pigcms{$order['store_id']}" attr_order="{pigcms{$order['order_id']}">接受订单</a>
							</if>
				</div>
			</div>
		</footer>
	<else/>
		<if condition="$order['status'] lt 3">
			<footer class="order_fixed">
				<div class="fixed">
					<if condition="$order['paid'] neq 1 AND $order['status'] eq 0">
						<div style="float: left">
							<a href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'))}" class="comm_btn" style="background-color: #0697dc;">支付订单</a>
						</div>
					</if>
					<div style="float: right">
						<if condition="$order['paid'] eq 0 AND $order['is_confirm'] eq 0 AND $order['status'] lt 3">
						<a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Takeout/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a>
						<elseif condition="$order['paid'] eq 1 AND $order['status'] eq 0 AND $order['is_confirm'] eq 0" />
						<a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a>
						</if>
					</div>
					<if condition="$order['status'] eq 1">
						<div style="float: right">
							<a href="{pigcms{:U('My/meal_feedback',array('order_id' => $order['order_id']))}" class="comm_btn">去评价</a>
						</div>
					</if>
				</div>
			</footer>
		</if>
	</in>

</div>
<include file="kefu" />
<script type="text/javascript">
	function drop_confirm(msg, url)
	{
		if (confirm(msg)) {
			window.location.href = url;
		}
	}
	$("#confirm").click(function(){
		var self=this;//指的是当前id这个dom
		var result=confirm("您确定要接受此订单吗？");
		var mer_id=$(this).attr('attr_mer');
		var store_id=$(this).attr('attr_store');
		var order_id=$(this).attr('attr_order');
		var uid=$(this).attr('uid');//当前订单用户的uid
		var price=$(this).attr('price');//订单价格
		var openid=$(this).attr('openid');
		if(result==true){
			$.ajax({
				url:"{pigcms{:U('Takeout/check_confirm')}",
				data:{'mer_id':mer_id,'store_id':store_id,'order_id':order_id,'uid':uid,'price':price,'openid':openid},
				dataType:'json',
				type:'post',
				success:function(res){
					if(res.error==0){

						$(self).parent().html('<a class="comm_btn" href="javascript:;">已接单</a>');
					}else{
						alert(res.msg);
					}
				}
			})
		}else{
			window.location.reload();
		}
	})
</script>
{pigcms{$hideScript}
</body>
</html>