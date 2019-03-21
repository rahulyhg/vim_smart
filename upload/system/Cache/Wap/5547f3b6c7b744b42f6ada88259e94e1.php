<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>设置密码</title>
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
        <form method="post" action="<?php echo U('My/password');?>" id="form">
		    <dl class="list">
		    	<dd>
		    		<dl>
		    			<?php if($now_user['pwd']): ?><dd class="dd-padding"><input class="input-weak" placeholder="请输入当前密码" type="password" id="currentpassword" name="currentpassword" autocomplete="off"></dd><?php endif; ?>
				        <dd class="dd-padding"><input class="input-weak" placeholder="请输入新密码（密码长度在6-32个字符之间）" type="password" id="password" name="password" autocomplete="off"></dd>
				        <dd class="dd-padding"><input class="input-weak" placeholder="请再输入一次新密码" type="password" id="password2" name="password2" autocomplete="off"></dd>
				    </dl>
		    	</dd>
		    </dl>
		    <div class="btn-wrapper">
				<button type="submit" class="btn btn-block btn-larger">确认提交</button>
		    </div>
		</form>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script>
			$(function(){
				$('#form').submit(function(){
					$('#tips').removeClass('tips-err').hide();
			        var old_v = $("#currentpassword");
			        var new_v = $("#password");
			        var new_v2 = $("#password2");
			        if(old_v.size() > 0 && old_v.val().length < 6){
			        	$('#tips').html('请正确填写原始密码！').addClass('tips-err').show();
			            return false;
				    }
			      	if(new_v.val().length < 6){
			      		$('#tips').html('新密码长度不符合规范！').addClass('tips-err').show();
			      		return false;
				    }
			      	if(new_v2.val() != new_v.val()){
			      		$('#tips').html('两次新密码输入不一致！').addClass('tips-err').show();
			      		return false;
				    }
			    });
			});
			function toast(msg){
				
			}
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