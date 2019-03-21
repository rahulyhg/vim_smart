<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>余额充值</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index">
        <?php if($error): ?><div id="tips" class="tips tips-err" style="display:block;"><?php echo ($error); ?></div>
        <?php else: ?>
        	<div id="tips" class="tips"></div><?php endif; ?>
        <form id="form" method="post" action="<?php echo U('My/recharge');?>">
			<input type="hidden" name="label" value="<?php echo ($_GET["label"]); ?>"/>
		    <dl class="list">
		        <dd class="dd-padding">
		            <input id="money" placeholder="请填写充值金额" class="input-weak" type="text" name="money" value="<?php echo ($_GET["money"]); ?>" <?php if($_GET['label'] && $_GET['money']): ?>readonly="readonly" onclick="$('#tips').html('订单充值时无法修改金额！').show();"<?php endif; ?>/>
		        </dd>
		    </dl>
		    <p class="btn-wrapper">金额最多仅支持两位小数</p>
		    <div class="btn-wrapper"><button type="submit" class="btn btn-block btn-larger">充值</button></div>
		</form>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
		<script>
			$(function(){
				$('#form').on('submit', function(e){
					$('#tips').removeClass('tips-err').hide();
					var money = parseFloat($('#money').val());
					if(isNaN(money)){
						$('#tips').html('请输入合法的金额！').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money > 10000){
						$('#tips').html('单次充值金额最高不能超过1万元').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money < 0.01){						$('#tips').html('单次充值金额最低不能低于 0.01 元').addClass('tips-err').show();			            e.preventDefault();						return false;					}
			    });		
				<?php if($_GET['label'] && $_GET['money']): ?>/* layer.open({type: 2,content: '自动提交中，请稍等',shadeClose:false}); */
					$('#form').trigger('submit');<?php endif; ?>
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
        
<?php echo ($hideScript); ?>
</body>
</html>