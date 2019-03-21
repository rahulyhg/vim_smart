<?php if (!defined('THINK_PATH')) exit();?><html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>店员中心</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="<?php echo ($static_path); ?>css/diancai.css" rel="stylesheet" type="text/css" />

<style>

.green{color:green;}

.btn{

margin: 0;

text-align: center;

height: 2.2rem;

line-height: 2.2rem;

padding: 0 .32rem;

border-radius: .3rem;

color: #fff;

border: 0;

background-color: #FF658E;

font-size: .28rem;

vertical-align: middle;

box-sizing: border-box;

cursor: pointer;

-webkit-user-select: none;}

.totel{color: green;}

.cpbiaoge td{font-size:1rem;}

</style>

</head>

<body>



<div style="padding: 0.2rem;"> 

	<ul class="round">

		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">

			<tbody>

				<tr>

					<td>顾客姓名：<?php echo ($order["name"]); ?></td>

				</tr>

				<tr>

					<td>顾客电话：<a href="tel:<?php echo ($order["phone"]); ?>" class="totel"><?php echo ($order["phone"]); ?></a></td>

				</tr>

				<tr>

					<td>订单金额： <span class="price">￥<?php echo ($order['price']); ?></span></td>

				</tr>

				<tr>

					<td>订单状态：

					  <?php if($order['status'] == 3): ?><span class="red">已取消并退款</span>

						<?php elseif(empty($order['third_id']) AND ($order['pay_type'] == 'offline')): ?>

							<span class="red">线下未支付</span>

						<?php elseif($order['paid'] == 0): ?>

							<span class="red">未付款</span>

						<?php else: ?>

							<span class="green">已付款</span><?php endif; ?>

					</td>

				</tr>

				<tr>

					<td>下单时间： <?php echo (date("Y-m-d H:i:s",$order["dateline"])); ?></td>

				</tr>

				<tr>

					<td>客户地址： <?php echo ($order["address"]); ?></td>

				</tr>

				<tr>

					<td>客户留言： <?php echo ($order["note"]); ?></td>

				</tr>

				<tr>

				  <td>支付方式： <?php echo ($order["paytypestr"]); ?></td>

				</tr>

				<tr>

					<td> 

						<?php if($order['third_id'] == '0' AND $order['pay_type'] == 'offline'): ?>总金额： ￥<?php echo ($order['total_price']); ?><br>

					 		平台余额支付 ：<?php echo ($order["balance_pay"]); ?> <br>

					 		商家会员卡余额支付：<?php echo ($order["merchant_balance"]); ?><br>

							线下需向商家付金额：<font color="red">￥<?php echo ($order['total_price']-$order['merchant_balance']-$order['balance_pay']); ?>元</font>

						<?php else: ?>

							平台余额支付：<?php echo ($order["balance_pay"]); ?> <br>

					 		商家会员卡余额支付：<?php echo ($order["merchant_balance"]); ?><br>

					 		在线支付金额：<?php echo ($order["payment_money"]); ?><br><?php endif; ?>

					 </td>

				</tr>

			<?php if(!empty($now_order['use_time'])): ?><tr>

					<td><?php if($order['tuan_type'] != 2): ?>消费<?php else: ?>发货<?php endif; ?>时间： <?php echo (date('Y-m-d H:i:s',$order["use_time"])); ?></td>

				</tr>

				<tr>

					<td>操作店员： <?php echo ($order["last_staff"]); ?></td>

				</tr><?php endif; ?>

				<?php if($order['status'] == 0): ?><tr id="xfstatus">

						<form enctype="multipart/form-data" method="post" action="">

							<td>消费状态：

								<span class="red">未消费</span>	

								<div><input name="status" value="1" type="hidden">

								<button id="merchant_remark_btn" class="submit" style="padding: 5px;margin: 12px auto;margin-top: 25px;background-color:#FF658E;border:1px solid #FF658E">确认消费</button>

								<span class="form_tips" style="color: red">

								注：改成已消费状态后同时如果是未付款状态则修改成线下支付已支付，状态修改后就不能修改了	

								</span>

								</div>

							</td>

						</form>

					</tr>

				<?php elseif($order['status'] == 1 OR $order['status'] == 2): ?>

					<tr>

						<td>是否已消费：<span class="green"> 已消费</span></td>

					</tr><?php endif; ?>

			</tbody>

		</table>

	</ul>

	<a href="<?php echo U('Storestaff/meal_list');?>" class="btn" style="float:right;right:1rem;top:0.2rem;position:absolute;width:5rem;font-size:1rem;">返 回</a>

	<ul class="round">

		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">

			<tbody>

				<tr>

					<th>菜品名称</th>

					<th class="cc">单价</th>

					<th class="cc">购买份数</th>

					<th class="rr">价格</th>

				</tr>

				<?php if(is_array($order['info'])): $i = 0; $__LIST__ = $order['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>

					<td><?php echo ($info['name']); ?></td>

					<td class="cc"><?php echo ($info['price']); ?></td>

					<td class="cc"><?php echo ($info['num']); ?></td>

					<td class="rr">￥<?php echo ($info['num'] * $info['price']); ?></td>

				</tr><?php endforeach; endif; else: echo "" ;endif; ?>

				<tr>

					<td>商品总价</td>

					<td class="cc"></td>

					<td class="cc"></td>

					<td class="rr">￥<?php echo ($order['price']); ?></td>

				</tr>

				<!-- <tr>

					<td>配送费</td>

					<td class="cc"></td>

					<td class="cc"></td>

					<td class="rr">￥1.00</td>

				</tr> -->

				<tr>

					<td>总计</td>

					<td class="cc"></td>

					<td class="cc"></td>

					<td class="rr"><span class="price">￥<?php echo ($order['price']); ?></span></td>

				</tr>

			</tbody>

		</table>

	</ul>

</div>

<div class="footReturn">

	<div class="clr"></div>

	<div class="window" id="windowcenter">

		<div id="title" class="wtitle">操作成功<span class="close" id="alertclose"></span></div>

		<div class="content">

			<div id="txt"></div>

		</div>

	</div>

</div>



</script>



		<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>		<style>			.footermenu ul{background-color:#404a54;}			.footermenu ul li a{color:#fff;}			.footermenu ul li a.active{background-color:#2A3138;}		</style>	    <footer class="footermenu">		    <ul>		        <li>		            <a <?php if(ACTION_NAME == 'group_list' OR ACTION_NAME == 'group_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/group_list');?>">		            <img src="<?php echo ($static_path); ?>images/Lngjm86JQq.png"/>		            <p><?php echo ($config["group_alias_name"]); ?></p>		            </a>		        </li>		        <li>		            <a <?php if(ACTION_NAME == 'meal_list' OR ACTION_NAME == 'meal_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/meal_list');?>">		            <img src="<?php echo ($static_path); ?>images/s22KaR0Wtc.png"/>		            <p><?php echo ($config["meal_alias_name"]); ?></p>		            </a>		        </li>				<li>		            <a <?php if(ACTION_NAME == 'appoint_list' OR ACTION_NAME == 'appoint_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/appoint_list');?>">		            <img src="<?php echo ($static_path); ?>images/3YQLfzfuGx.png"/>		            <p>预约</p>		            </a>		        </li>				<li>		            <a id="qrcode_btn">						<img src="<?php echo ($static_path); ?>images/qrcode.png"/>						<p>扫一扫</p>		            </a>		        </li>		        <!--<li>		            <a href="javascript:;" onclick="LogOutSys()" <?php if(ACTION_NAME == 'logout'): ?>class="active"<?php endif; ?> >		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>退出</p>		            </a>		        </li>-->				<li>		            <a href="Cashier/merchants.php?m=Index&c=login&a=index&type=employee">		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>收银台</p>		            </a>		        </li>		    </ul>		<script type="text/javascript">		var logoutURl="<?php echo U('Storestaff/logout');?>"		function LogOutSys(){			if(confirm('您确认要退出系统吗？')){			    window.location.href=logoutURl;			}		}		</script>		</footer>		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>