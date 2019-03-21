<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>取消订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="<?php echo ($static_path); ?>css/wap_pay_check.css" rel="stylesheet"/>
	<style>
    .btn-wrapper {
        margin: .28rem .2rem;
    }
    .hotel-price {
        color: #ff8c00;
        font-size: 12px;
        display: block;
    }
    .dealcard .line-right {
        display: none;
    }
    .agreement li {
        display: inline-block;
        width: 50%;
        box-sizing: border-box;
        color: #666;
    }

    .agreement li:nth-child(2n) {
        padding-left: .14rem;
    }

    .agreement li:nth-child(1n) {
        padding-right: .14rem;
    }

    .agreement ul.agree li {
        height: .32rem;
        line-height: .32rem;
    }

    .agreement ul.btn-line li {
        vertical-align: middle;
        margin-top: .06rem;
        margin-bottom: 0;
    }

    .agreement .text-icon {
        margin-right: .14rem;
        vertical-align: top;
        height: 100%;
    }

    .agreement .agree .text-icon {
        font-size: .4rem;
        margin-right: .2rem;
    }


    #deal-details .detail-title {
        background-color: #F8F9FA;
        padding: .2rem;
        font-size: .3rem;
        color: #000;
        border-bottom: 1px solid #ccc;
    }

    #deal-details .detail-title p {
        text-align: center;
    }

    #deal-details .detail-group {
        font-size: .3rem;
        display: -webkit-box;
        display: -ms-flexbox;
    }

    .detail-group .left {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        display: block;
        padding: .28rem 0;
        padding-right: .2rem;
    }

    .detail-group .right {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.2rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    .detail-group .middle {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.7rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    ul.ul {
        list-style-type: initial;
        padding-left: .4rem;
        margin: .2rem 0;
    }

    ul.ul li {
        font-size: .3rem;
        margin: .1rem 0;
        line-height: 1.5;
    }
    .coupons small{
        float: right;
        font-size: .28rem;
    }
    strong {
        color: #FDB338;
    }
    .coupons-code {
        color: #666;
        text-indent: .2rem;
    }
    .voice-info {
        font-size: .3rem;
        color: #eb8706;
    }
</style>
</head>
<body>
        <div id="tips" class="tips"></div>
        <div class="wrapper-list">
			<h4><?php echo ($now_order["s_name"]); ?></h4>
			<dl class="list">
			    <dd>
			        <dl>
						<dd class="kv-line-r dd-padding">
							<h6>购买数量：</h6><p><?php echo ($now_order["num"]); ?></p>
						</dd>
						<dd class="kv-line-r dd-padding">
							<h6>项目单价：</h6><p><?php echo ($now_order["price"]); ?>元</p>
						</dd>
			            <dd class="kv-line-r dd-padding">
			                <h6>总额：</h6><p><strong class="highlight-price"><?php echo ($now_order["total_money"]); ?> 元</strong></p>
			            </dd>
			        </dl>
			    </dd>
			</dl>
			<dl class="list">
			    <dd>
			        <dl>
						<?php if($now_order['card_id']): ?><dd>
								<a class="react" href="javascript:;">
									<div class="more more-weak">
										<h6>使用商家优惠券：</h6>
										<span class="more-after">￥<?php echo ($now_order["card_id"]); ?></span>
									</div>
								</a>
							</dd><?php endif; ?>
						<?php if($now_order['merchant_balance'] != '0.00'): ?><dd class="kv-line-r dd-padding">
								<h6>使用商家会员卡余额：</h6><p><?php echo ($now_order["merchant_balance"]); ?>元</p>
							</dd><?php endif; ?>
						<?php if($now_order['balance_pay'] != '0.00'): ?><dd class="kv-line-r dd-padding">
								<h6>使用帐户余额：</h6><p><?php echo ($now_order["balance_pay"]); ?>元</p>
							</dd><?php endif; ?>
						<?php if($now_order['wx_cheap'] != '0.00'): ?><dd class="kv-line-r dd-padding">
								<h6>微信优惠：</h6><p><?php echo ($now_order["wx_cheap"]); ?>元</p>
							</dd><?php endif; ?>
						<?php if($now_order['payment_money'] != '0.00'): ?><dd class="kv-line-r dd-padding">
								<h6>在线支付金额：</h6>
								<p>
									<strong class="highlight-price">
										<span class="need-pay"><?php echo ($now_order["payment_money"]); ?></span>元
									</strong>
								</p>
							</dd>
							<dd class="kv-line-r dd-padding">
								<h6>在线支付方式：</h6>
								<p><?php echo ($now_order["pay_type_txt"]); ?></p>
							</dd><?php endif; ?>
			        </dl>
			    </dd>
			</dl>
			<div class="btn-wrapper" style="line-height:1.5;color:#666;">在线支付金额将通过您使用的支付方式返回到您的银行卡上，其他将返回到您的帐户上！</div>
			<div class="btn-wrapper">
				<span onclick="window.location.href='<?php echo U('My/group_order_check_refund',array('order_id'=>$now_order['order_id']));?>'" class="btn btn-larger btn-block btn-strong" style="margin-bottom:15px;">确定取消</span>
			</div>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>	
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
        
		<script>
			$(function(){
				$('#cancel_order').click(function(){
					if(confirm('您确定取消订单吗？取消后不能恢复！')){
						window.location.href = "<?php echo U('My/group_order_del',array('order_id'=>$now_order['order_id']));?>";
					}
				});
			});
		</script>
<?php echo ($hideScript); ?>
</body>
</html>