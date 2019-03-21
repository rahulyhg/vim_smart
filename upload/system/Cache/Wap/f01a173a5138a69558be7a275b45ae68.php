<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>修改昵称</title>
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
        <form id="form" method="post" action="<?php echo U('My/username');?>">
		    <dl class="list">
		        <dd class="dd-padding">
		            <input id="username" placeholder="请填写用户名" class="input-weak" type="text" name="nickname" value="<?php echo ($now_user["nickname"]); ?>">
		        </dd>
		    </dl>
		    <p class="btn-wrapper">以英文字母或汉字开头，限4-16个字符</p>
		    <div class="btn-wrapper"><button type="submit" class="btn btn-block btn-larger">修改</button></div>
		</form>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script>
			$(function(){
				$('#form').on('submit', function(e){
					$('#tips').removeClass('tips-err').hide();
			        var v = $('#username').val();
			        if(!/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-z])+/i.test(v)){
			            $('#tips').html('用户名只能以英文字母或汉字开头！').addClass('tips-err').show();
			            e.preventDefault();
			        }else if(v.length < 4 || v.length > 16){
			        	$('#tips').html('用户名限4-16个字符！').addClass('tips-err').show();
			            e.preventDefault();
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