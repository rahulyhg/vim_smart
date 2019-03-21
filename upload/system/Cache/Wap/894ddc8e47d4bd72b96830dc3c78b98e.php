<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>提交订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<style>
	    #buy dd {
	        font-size: .3rem;
	    }
	    #change_address .more:after {
	        top: .2rem;
	    }
	    #change_address h6 {
	        width: 3em;
	    }
	    h4 small {
	        color: #999;
	        display: inline-block;
	        padding-left: .2rem;
	    }
	    .good-name {
	        color: #666;
	    }
	
	    .good-left-count {
	        color: #2bb2a3;
	    }
	
	    .good-left-out {
	        color: #999;
	    }
	    .quantity.kv-line {
	        -webkit-box-align: center;
	    }
	
	    .campaign_tag {
	        position: static;
	        background: #ff8c00;
	        color: #fff;
	        line-height: 1.5;
	        display: inline-block;
	        padding: 0 .06rem;
	        text-align: center;
	        font-size: .24rem;
	        border-radius: .06rem;
	        vertical-align: text-bottom;
	    }
	
	    .amount>span {
	        display: block;
	    }
	
	    .J_campaign-value {
	        font-size: .24rem;
	        color: #999;
	    }
	
	    .J_total-price {
	        font-weight: bold;
	        color: #FF9712;
	    }
	
	    .kv-line-r .btn, .kv-line-r .mt, .kv-line-r .input-weak {
	        margin-top: -.15rem;
	        margin-bottom: -.15rem;
	    }
	    .kv-line-r .kv-k {
	        display: block;
	    }
	    .kv-line .btn, .kv-line .mt, .kv-line .input-weak {
	        margin: -.15rem 0;
	    }
	
	    /*agreement*/
	    .agreement {
	        padding: .2rem;
	    }
	
	    .agreement li {
	        display: inline-block;
	        text-align: center;
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
	
	    .agreement li.active {
	        color: #6bbd00;
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
	
	    label.disabled {
	        color: #ccc;
	    }
	    #birthday_wrap label.select {
	        width: 28%;
	        display: inline-block;
	        margin-right: .16rem;
	    }
	    #birthday_wrap .select select {
	        border: 1px solid #ccc;
	    }
	    #sms-captcha {
	        width: 100%;
	    }
	</style>
</head>
<body>
	<div id="tips" class="tips"></div>
	<form id="buy-form" action="<?php echo U('Group/buy',array('group_id'=>$now_group['group_id']));?>" method="POST" class="wrapper-list" autocomplete="off">
		<h4 style="margin-top:.4rem"><?php echo ($now_group["s_name"]); ?></h4>
		<dl class="list">
			<dd>
				<dl>
					<dd class="dd-padding kv-line-r">
						<h6>单价：</h6>
						<!--if condition="!empty($leveloff) AND $finalprice gt 0"-->
							<p><del><?php echo ($now_group['price']); ?>元</del></p>
						<!--/if-->
					</dd>
					<?php if(!empty($leveloff) AND $finalprice > 0): ?><dd class="dd-padding kv-line-r">
							<span>会员等级：<strong style="font-size:16px;color:#FF4907"><?php echo ($leveloff['lname']); ?></strong></span>
							<span style="position: absolute;right: 8px;top: 15px;"><?php echo ($leveloff['offstr']); ?>&nbsp;&nbsp;惠后单价 <strong style="font-size:16px;color:#FF4907"><?php echo ($leveloff['price']); ?></strong>元
							</span>
						</dd><?php endif; ?>
					<dd class="dd-padding kv-line-r quantity">
						<h6>数量：</h6>
						<div class="kv-v">
							<div class="stepper" data-com="stepper">
								<button type="button" class="btn btn-weak minus" disabled="disabled">-</button>&nbsp;<input class="mt number" type="tel" name="quantity" min="<?php echo ($now_group["once_min"]); ?>" max="<?php echo ($now_group["once_max"]); ?>" value="<?php echo ($now_group["once_min"]); ?>"/>&nbsp;<button type="button" class="btn btn-weak plus">+</button>
							</div>
						</div>
					</dd>
					<dd class="dd-padding kv-line-r">
						<h6>总价：</h6>
						<span class="kv-v" id="amount">
						<?php if(!empty($leveloff) AND $finalprice > 0): ?><span class="J_total-price"><?php echo ($leveloff['price']*$now_group['once_min']); ?>元</span>
						<?php else: ?>
							<span class="J_total-price"><?php echo ($now_group['price']*$now_group['once_min']); ?>元</span><?php endif; ?>
							<span class="J_campaign-value"></span>
						</span>
					</dd>
				</dl>
			</dd>
		</dl>
		<?php if($now_group['tuan_type'] != 2): ?><h4>您绑定的手机号码</h4>
			<dl class="list" id="mobile-show">
				<dd>
					<?php if($user_session['phone']): ?><a id="change-mobile" class="react" href="javascript:void(0);">
							<div><?php echo ($pigcms_phone); ?></div>
						</a>
					<?php else: ?>
						<a id="change-mobile" class="react" href="<?php echo U('My/bind_user',array('referer'=>urlencode($_SERVER['REQUEST_URI'])));?>">
							<div><?php echo ($pigcms_phone); ?></div>
						</a><?php endif; ?>
				</dd>
			</dl>
		<?php else: ?>
			<h4>选择收货地址</h4>
			<?php if($now_group['user_adress']['adress_id']): ?><dl class="list">
					<dd>
						<a id="change_address" class="react" href="<?php echo U('My/adress',array('group_id'=>$now_group['group_id'],'current_id'=>$now_group['user_adress']['adress_id']));?>">
							<div class="more more-weak">
								<input type="hidden" name="adress_id" value="<?php echo ($now_group['user_adress']['adress_id']); ?>"/>
								<div class="kv-line">
									<h6>姓名：</h6><p><?php echo ($now_group['user_adress']['name']); ?></p>
								</div>
								<div class="kv-line">
									<h6>手机：</h6><p><?php echo ($now_group['user_adress']['phone']); ?></p>
								</div>
								<div class="kv-line">
									<h6>地址：</h6><p><?php echo ($now_group['user_adress']['province_txt']); ?> <?php echo ($now_group['user_adress']['city_txt']); ?> <?php echo ($now_group['user_adress']['area_txt']); ?> <?php echo ($now_group['user_adress']['adress']); ?></p>
								</div>
								<div class="kv-line">
									<h6>邮编：</h6><p><?php echo ($now_group['user_adress']['zipcode']); ?></p>
								</div>
							</div>
						</a>
					</dd>
				</dl>
			<?php else: ?>
				<dl class="list">
					<dd>
						<a id="change_address" class="react" href="<?php echo U('My/adress',array('group_id'=>$now_group['group_id']));?>">
							<div class="more more-weak">添加收货人地址</div>
						</a>
					</dd>
				</dl><?php endif; ?>
			<h4>送货时间</h4>	
			<dl class="list">
				<dd class="dd-padding">
					<label class="select">
						<select name="delivery_type">
							<option value="1">工作日、双休日与假日均可送货</option>
							<option value="2">只工作日送货</option>
							<option value="3">只双休日、假日送货</option>
							<option value="4">白天没人，其它时间送货</option>
						</select>
					</label>
				</dd>
			</dl>	
			<h4>配送说明</h4>
			<dl class="list">
				<dd class="dd-padding">
					<input type="text" class="input-weak" style="width:100%" placeholder="配送特殊说明，配送公司会尽量调节" name="delivery_comment"/>
				</dd>
			</dl><?php endif; ?>
		<div class="btn-wrapper">
			<button type="submit" class="btn btn-block btn-strong btn-larger mj-submit" style="display:none;">提交订单</button>
		</div>
	</form>
	<script src="<?php echo C('JQUERY_FILE');?>"></script>
	<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>	
	<script>
		$(function(){
			var price = <?php echo ($now_group['price']*100); ?>;
			var finalprice=<?php echo ($finalprice); ?>;
			price= finalprice >0 ? finalprice * 100 : price;
			var quantity = $("input[name='quantity']");
			$('button.plus').click(function(){
				$('#tips').removeClass('tips-err').empty();
				var pigcms_now_quantity = parseInt(quantity.val());
				if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(pigcms_now_quantity)){
					$('#tips').addClass('tips-err').html('请输入正确的购买数量');
				}else if(pigcms_now_quantity + 1 > quantity.attr('max') && quantity.attr('max') != '0'){
					$('#tips').addClass('tips-err').html('您最多能购买'+quantity.attr('max')+'单');
					quantity.val(quantity.attr('max'));
					$(this).prop('disabled',true);
				}else{
					quantity.val(pigcms_now_quantity+1);
					$('.J_total-price').html(price*(pigcms_now_quantity+1)/100+'元');
					$('button.minus').prop('disabled',false);
				}
			});
			$('button.minus').click(function(){
				$('#tips').removeClass('tips-err').empty();
				var pigcms_now_quantity = parseInt(quantity.val());
				if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(pigcms_now_quantity)){
					$('#tips').addClass('tips-err').html('请输入正确的购买数量');
				}else if(pigcms_now_quantity - 1 < quantity.attr('min')){
					$('#tips').addClass('tips-err').html('您最少能购买'+quantity.attr('min')+'单');
				}else{
					if(pigcms_now_quantity-1 <= quantity.attr('min')){
						$(this).prop('disabled',true);
					}
					quantity.val(pigcms_now_quantity-1);
					$('.J_total-price').html(price*(pigcms_now_quantity-1)/100+'元');
					$('button.plus').prop('disabled',false);
				}
			});
			quantity.blur(function(){
				$('#tips').removeClass('tips-err').empty();
				var pigcms_now_quantity = parseInt(quantity.val());
				if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(pigcms_now_quantity)){
					$('#tips').addClass('tips-err').html('请输入正确的购买数量');
				}else{
					if(quantity.attr('max') != '0' && pigcms_now_quantity == quantity.attr('max')){
						$('button.plus').prop('disabled',true);
					}else if(quantity.attr('max') != '0' && pigcms_now_quantity > quantity.attr('max')){
						$('#tips').addClass('tips-err').html('您最多能购买'+quantity.attr('max')+'单');
						$('button.plus').prop('disabled',true);
						quantity.val(quantity.attr('max'));
					}else{
						$('button.plus').prop('disabled',false);
					}
					if(pigcms_now_quantity == quantity.attr('min')){
						$('button.minus').prop('disabled',true);
					}else if(pigcms_now_quantity < quantity.attr('min')){
						$('#tips').addClass('tips-err').html('您最少能购买'+quantity.attr('min')+'单');
						$('button.minus').prop('disabled',true);
						quantity.val(quantity.attr('min'));
					}else{
						$('button.minus').prop('disabled',false);
					}

					$('.J_total-price').html(price*(parseInt(quantity.val()))/100+'元');
				}
			});
		});
	</script>	
	<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
	<script>var showBuyBtn = true;</script>
	<?php if($_SESSION['openid']): switch($config['weixin_buy_follow_wechat']): case "0": if($now_group['wx_cheap']){ ?>
					<script>layer.open({title:['提示：','background-color:#8DCE16;color:#fff;'],content:'在微信中购买本单，每单减免 <b style="color:red;"><?php echo ($now_group["wx_cheap"]); ?>元</b>！',btn:['好的'],shadeClose:false});</script>
				<?php } break;?>
			<?php case "1": if($now_group['wx_cheap']){ ?>
					<?php if($now_user['is_follow']){ ?>
						<script>layer.open({title:['提示：','background-color:#8DCE16;color:#fff;'],content:'在微信中购买本单，每单减免 <b style="color:red;"><?php echo ($now_group["wx_cheap"]); ?>元</b>！',btn:['好的'],shadeClose:false});</script>
					<?php }else{ ?>
						<script>layer.open({title:['提示：','background-color:#FF658E;color:#fff;'],content:'关注公众号后购买本单，每单减免 <b style="color:red;"><?php echo ($now_group["wx_cheap"]); ?>元</b>！<br/>长按图片识别二维码关注：<br/><img src="<?php echo ($config["site_url"]); ?>/index.php?c=Recognition&a=see_qrcode&type=group&id=<?php echo ($now_group["group_id"]); ?>" style="width:230px;height:230px;"/>',shadeClose:false});</script>
					<?php } ?>
				<?php } break;?>
			<?php case "2": if($now_user['is_follow']){ ?>
					<?php if($now_group['wx_cheap']){ ?>
						<script>layer.open({title:['提示：','background-color:#8DCE16;color:#fff;'],content:'在微信中购买本单，每单减免 <b style="color:red;"><?php echo ($now_group["wx_cheap"]); ?>元</b>！',btn:['好的'],shadeClose:false});</script>
					<?php } ?>
				<?php }else{ ?>
					<script>layer.open({title:['提示：','background-color:#FF658E;color:#fff;'],content:'您必须关注公众号后才能购买本单！<br/>长按图片识别二维码关注：<br/><img src="<?php echo ($config["site_url"]); ?>/index.php?c=Recognition&a=see_qrcode&type=group&id=<?php echo ($now_group["group_id"]); ?>" style="width:230px;height:230px;"/>',shadeClose:false});$('button.mj-submit').remove();var showBuyBtn = false;</script>
				<?php } break; endswitch;?>
	<?php elseif($now_group['wx_cheap']): ?>
		<script>layer.open({title:['提示：','background-color:#8DCE16;color:#fff;'],content:'在微信中购买本单，每单减免 <b style="color:red;"><?php echo ($now_group["wx_cheap"]); ?>元</b>！',btn:['好的'],shadeClose:false});</script><?php endif; ?>
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