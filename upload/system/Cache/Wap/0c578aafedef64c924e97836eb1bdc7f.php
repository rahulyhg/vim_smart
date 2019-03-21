<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>绑定帐号</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>

    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		/*#login{margin: 0.5rem 0.2rem;}*/
		.btn-wrapper{margin:.28rem 0;}
		dl.list{border-bottom:0;border:1px solid #ddd8ce;}
		dl.list:first-child{border-top:1px solid #ddd8ce;}
		dl.list dd dl{padding-right:0.2rem;}
		dl.list dd dl>.dd-padding, dl.list dd dl dd>.react, dl.list dd dl>dt{padding-right:0;}
	    .nav{text-align: center;}
	    .subline{margin:.28rem .2rem;}
	    .subline li{display:inline-block;}
	    .captcha img{margin-left:.2rem;}
	    .captcha .btn{margin-top:-.15rem;margin-bottom:-.15rem;margin-left:.2rem;}
	</style>
</head>
<body>
	<div id="container">
		<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
		<div id="login">
			<dl class="list">
				<dd class="nav">
					<ul class="taba taban noslide" data-com="tab">
						<li class="active" tab-target="login-form"><a class="react">绑定已有帐号</a>
						</li><li tab-target="reg-form"><a class="react">注册新帐号</a>
					</li><div class="slide" style="left:0px;width:0px;"></div>
					</ul>
				</dd>
			</dl>
			<form id="login-form" autocomplete="off" method="post" action="<?php echo U('Login/weixin_bind');?>" location_url="<?php echo ($referer); ?>">
				<dl class="list list-in">
					<dd>
						<dl>
							<dd class="dd-padding">
								<input id="login_phone" class="input-weak" type="tel" placeholder="手机号" name="phone" value="" required=""/>
							</dd>
							<dd class="dd-padding">
								<input id="login_password" class="input-weak" type="password" placeholder="请输入您的密码" name="password" required=""/>
							</dd>
						</dl>
					</dd>
				</dl>
				<div class="btn-wrapper">
					<button type="submit" class="btn btn-larger btn-block">绑定</button>
				</div>
			</form>
			<form id="reg-form" action="<?php echo U('Login/weixin_bind_reg');?>" autocomplete="off" method="post" location_url="<?php echo ($referer); ?>" style="display:none;">
				<dl class="list list-in">
					<dd>
						<dl>
							<dd class="dd-padding">
								<input id="reg_phone" class="input-weak" type="tel" placeholder="手机号" name="phone" value="" required=""/>
							</dd>
							<dd class="kv-line-r dd-padding">
								<input id="reg_pwd_password" class="input-weak kv-k" type="password" placeholder="6位以上的密码"/>
								<input id="reg_txt_password" class="input-weak kv-k" type="text" placeholder="6位以上的密码" style="display:none;"/>
								<input type="hidden" id="reg_password_type" value="0"/>
								<button id="reg_changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>
							</dd>
						</dl>
					</dd>
				</dl>
				<div class="btn-wrapper">
					<button type="submit" class="btn btn-larger btn-block">注册并绑定</button>
				</div>
			</form>
		</div>
		<?php if(!$config['weixin_login_bind']): ?><ul class="subline">
				<li><a href="<?php echo U('Login/weixin_nobind');?>" id="weixin_nobind" style="height: 25px">不想绑定帐号，跳过 →</a></li>
			</ul><?php endif; ?>
	</div>
	<script src="<?php echo C('JQUERY_FILE');?>"></script>
	<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
	<script src="<?php echo ($static_path); ?>js/weixin_back.js"></script>
	<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
	<script>
		$('#weixin_nobind').click(function(){
			layer.open({
				title:['提醒：','background-color:#8DCE16;color:#fff;'],
				content:'直接将微信号作为用户登录，以后将无法绑定已有帐号！请确认：',
				btn: ['确认', '取消'],
				shadeClose: false,
				yes: function(){
					layer.open({content: '你点了确认，正在跳转！', time:3});
					window.location.href = "<?php echo U('Login/weixin_nobind');?>";
				}
			});
			return false;
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