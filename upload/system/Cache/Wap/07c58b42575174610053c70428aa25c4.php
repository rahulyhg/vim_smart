<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>绑定商家</title>
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index">
<?php if($merchant_info): ?><dl class="list">
	<dd>
		<dl>
			<dd class="dd-padding"><label>当前绑定商家<label><input class="input-weak" value="<?php echo ($merchant_info["name"]); ?>" type="text" name="name" style="width:60%; font-weight:bold;"></dd>
			<!--<dd class="dd-padding"><label>密码<label><input class="input-weak" value="<?php echo ($merchant_info["pwd"]); ?>" type="password" name="pwd"></dd>-->
		</dl>
	</dd>
</dl>
<div class="btn-wrapper">
	<button type="submit" class="btn btn-block btn-larger"><a href="<?=C('config.site_url').'/index.php?g=WapMerchant&c=Index&a=wxlogin'?>" style="color:#FFFFFF;">点击进入商户后台</a></button>
</div>
<?php else: ?>
<div id="tips" class="tips"></div>
<form method="post" action="<?php echo U('My/bindMerchant');?>" id="form">
	<dl class="list">
		<dd>
			<dl>			
				<dd class="dd-padding"><input class="input-weak" placeholder="请输入商家账号" type="text" name="account" autocomplete="off"></dd>
				<dd class="dd-padding"><input class="input-weak" placeholder="请输入商家密码" type="password" name="pwd" autocomplete="off"></dd>
				<!--<dd class="dd-padding"><input class="input-weak" placeholder="请输入商家名称" type="text" name="mername" autocomplete="off"></dd>-->
			</dl>
		</dd>
	</dl>
	<div class="btn-wrapper">
		<button type="submit" class="btn btn-block btn-larger">确认绑定</button>
	</div>
</form><?php endif; ?>
<script src="<?php echo C('JQUERY_FILE');?>"></script>
<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
<script>
	$(function(){
		$('#form').submit(function(){
			var account = $('input[name="account"]').val();	//账户
			var pwd = $('input[name="pwd"]').val();	//密码
			if(account=="" || account=="null"){
				$('#tips').html('请输入商家账户！').addClass('tips-err').show();
				return false;
			}else if(pwd=="" || pwd=="null"){
				$('#tips').html('请输入商家密码！').addClass('tips-err').show();
				return false;
			}else{
				return true;
			}
		});
	});
</script>
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
        
</body>
</html>