<!DOCTYPE html>
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
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
</head>
<body>
        <div id="tips" class="tips"></div>
        <div class="wrapper-list">
		<form action="/source{pigcms{:U('Pay/balancePay')}" method="POST" id="pay-form" class="pay-form">
			<input type="hidden" name="typePay" value="{pigcms{$type_pay}">
			<input type="hidden" name="ds_id" value="{pigcms{$order_arr.ds_id}">
			<input type="hidden" name="mer_id" value="{pigcms{$order_arr.mer_id}">
			<input type="hidden" name="money" value="{pigcms{$order_arr.money}">
			<input type="hidden" name="cou_money" value="{pigcms{$order_arr.cou_money}">
			<h4 style="margin-top:.4rem">余额支付</h4>
			<dl class="list">
				<dd>
					<dl>
						<dd class="kv-line-r dd-padding">
							<!--<h6>帐户余额：</h6><p>{pigcms{$user_info.now_money}元</p>-->
							<notempty name="user_info.balance">
							<h6>会员卡余额：</h6><p>{pigcms{$user_info.balance}元</p>
							</notempty>
						</dd>
						<dd class="kv-line-r dd-padding">
							<notempty name="user_info.now_money">
							<h6>帐户余额：</h6><p>{pigcms{$user_info.now_money}元</p>
							</notempty>
						</dd>
					</dl>
				</dd>
			</dl>
			<h4>结算信息</h4>
			<dl class="list">
				<dd>
					<dl>
						<dd class="kv-line-r dd-padding">
							<h6>消费总额：</h6><p>{pigcms{$order_arr['cou_money']+$order_arr['money']}元</p>
						</dd>
						<dd class="kv-line-r dd-padding">
							<h6>优惠金额：</h6><p>{pigcms{$order_arr.cou_money}元</p>
						</dd>
						<dd class="kv-line-r dd-padding">
							<h6>支付金额：</h6>
							<p>
								<strong class="highlight-price">
									<span class="need-pay">{pigcms{$order_arr.money}</span>元										
								</strong>
							</p>
						</dd>
						<if condition="$online_pay">
						<dd class="kv-line-r dd-padding">
							<h6>需支付：</h6>
							<p>
								<strong class="highlight-price">
									<span class="need-pay"><?php echo number_format($order_arr['money']-$user_info['balance']-$user_info['now_money'],2)?></span>元
									<input type="hidden" name="wx_pay" value="<?php echo number_format($order_arr['money']-$user_info['balance']-$user_info['now_money'],2)?>">
								</strong>
							</p>
						</dd>
						</if>
					</dl>
				</dd>
			</dl>
			<if condition="$online_pay">
				<div id="normal-fieldset" class="normal-fieldset" style="height: 100%;">
					<h4>支付方式</h4>
					<dl class="list">
						<volist name="pay_method" id="vo">
							<if condition="$key eq weixin">
							<dd class="dd-padding">
								<label class="mt">
									<i class="bank-icon icon-{pigcms{$key}"></i>
									<span class="pay-wrapper">{pigcms{$vo.name}<input type="radio" class="mt" value="{pigcms{$key}" checked="checked" name="pay_type"></span>
								</label>
							</dd>
							</if>
						</volist>
					</dl>
				</div>
			</if>
			<div class="wrapper buy-wrapper">
				<button type="submit" class="btn mj-submit btn-strong btn-larger btn-block" style="display:none;">确认支付</button>
			</div>
		</form>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>var showBuyBtn = true;</script>
		<script>if(showBuyBtn){$('button.mj-submit').show();}</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>