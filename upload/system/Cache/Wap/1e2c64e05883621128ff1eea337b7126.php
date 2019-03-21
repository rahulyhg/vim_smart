<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>确认订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="<?php echo ($static_path); ?>css/wap_pay_check.css" rel="stylesheet"/>
</head>
<body>
        <div id="tips" class="tips"></div>
        <div class="wrapper-list">
		<form action="/source<?php echo U('Pay/balancePay');?>" method="POST" id="pay-form" class="pay-form">
			<input type="hidden" name="typePay" value="<?php echo ($type_pay); ?>">
			<input type="hidden" name="ds_id" value="<?php echo ($order_arr["ds_id"]); ?>">
			<input type="hidden" name="mer_id" value="<?php echo ($order_arr["mer_id"]); ?>">
			<input type="hidden" name="money" value="<?php echo ($order_arr["money"]); ?>">
			<input type="hidden" name="cou_money" value="<?php echo ($order_arr["cou_money"]); ?>">
			<h4 style="margin-top:.4rem">余额支付</h4>
			<dl class="list">
				<dd>
					<dl>
						<dd class="kv-line-r dd-padding">
							<!--<h6>帐户余额：</h6><p><?php echo ($user_info["now_money"]); ?>元</p>-->
							<?php if(!empty($user_info["balance"])): ?><h6>会员卡余额：</h6><p><?php echo ($user_info["balance"]); ?>元</p><?php endif; ?>
						</dd>
						<dd class="kv-line-r dd-padding">
							<?php if(!empty($user_info["now_money"])): ?><h6>帐户余额：</h6><p><?php echo ($user_info["now_money"]); ?>元</p><?php endif; ?>
						</dd>
					</dl>
				</dd>
			</dl>
			<h4>结算信息</h4>
			<dl class="list">
				<dd>
					<dl>
						<dd class="kv-line-r dd-padding">
							<h6>消费总额：</h6><p><?php echo ($order_arr['cou_money']+$order_arr['money']); ?>元</p>
						</dd>
						<dd class="kv-line-r dd-padding">
							<h6>优惠金额：</h6><p><?php echo ($order_arr["cou_money"]); ?>元</p>
						</dd>
						<dd class="kv-line-r dd-padding">
							<h6>支付金额：</h6>
							<p>
								<strong class="highlight-price">
									<span class="need-pay"><?php echo ($order_arr["money"]); ?></span>元										
								</strong>
							</p>
						</dd>
						<?php if($online_pay): ?><dd class="kv-line-r dd-padding">
							<h6>还需支付：</h6>
							<p>
								<strong class="highlight-price">
									<span class="need-pay"><?php echo number_format($order_arr['money']-$user_info['balance']-$user_info['now_money'],2)?></span>元
									<input type="hidden" name="wx_pay" value="<?php echo number_format($order_arr['money']-$user_info['balance']-$user_info['now_money'],2)?>">
								</strong>
							</p>
						</dd><?php endif; ?>
					</dl>
				</dd>
			</dl>
			<?php if($online_pay): ?><div id="normal-fieldset" class="normal-fieldset" style="height: 100%;">
					<h4>支付方式</h4>
					<dl class="list">
						<?php if(is_array($pay_method)): $i = 0; $__LIST__ = $pay_method;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key == weixin): ?><dd class="dd-padding">
								<label class="mt">
									<i class="bank-icon icon-<?php echo ($key); ?>"></i>
									<span class="pay-wrapper"><?php echo ($vo["name"]); ?><input type="radio" class="mt" value="<?php echo ($key); ?>" checked="checked" name="pay_type"></span>
								</label>
							</dd><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</dl>
				</div><?php endif; ?>
			<div class="wrapper buy-wrapper">
				<button type="submit" class="btn mj-submit btn-strong btn-larger btn-block" style="display:none;">确认支付</button>
			</div>
		</form>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>	
		<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
		<script>var showBuyBtn = true;</script>
		<script>if(showBuyBtn){$('button.mj-submit').show();}</script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
<?php echo ($hideScript); ?>
</body>
</html>