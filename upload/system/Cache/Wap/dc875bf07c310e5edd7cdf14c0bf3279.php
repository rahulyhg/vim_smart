<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html xmlns="http://www.w3.org/1999/html">	<head>		<meta charset="utf-8"/>		<title>绑定手机号码</title>		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>		<meta name="apple-mobile-web-app-capable" content="yes"/>		<meta name='apple-touch-fullscreen' content='yes'/>		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>		<meta name="format-detection" content="telephone=no"/>		<meta name="format-detection" content="address=no"/>		<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>		<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>		<link href="<?php echo ($static_path); ?>css/idangerous.swiper.css" rel="stylesheet"/>		<style>			/*#login{margin: 0.5rem 0.2rem;}*/			.btn-wrapper{margin:.28rem 0;}			dl.list{border-bottom:0;border:1px solid #ddd8ce;}			dl.list:first-child{border-top:1px solid #ddd8ce;}			dl.list dd dl{padding-right:0.2rem;}			dl.list dd dl>.dd-padding, dl.list dd dl dd>.react, dl.list dd dl>dt{padding-right:0;}			.nav{text-align: center;}			.subline{margin:.28rem .2rem;}			.subline li{display:inline-block;}			.captcha img{margin-left:.2rem;}			.captcha .btn{margin-top:-.15rem;margin-bottom:-.15rem;margin-left:.2rem;}		</style>	</head>	<body>        <div id="container">        	<div id="tips"></div>			<div id="login">				<form id="reg-form" action="<?php echo U('My/bind_user');?>" autocomplete="off" method="post" location_url="<?php echo ($referer); ?>" login_url="<?php echo U('Login/index');?>">			        <dl class="list list-in">			        	<dd>			        		<dl>			            		<dd class="dd-padding">			            			<input id="reg_phone" class="input-weak" type="text" placeholder="手机号" name="phone" value="" required=""/>			            		</dd>								<?php if(C('config.bind_phone_verify_sms') AND C('config.sms_key')): ?><dd class="kv-line-r dd-padding">			            			<input id="sms_code" class="input-weak kv-k" name = "vcode" type="text" placeholder="填写短信验证码" required/>			            			<button id="reg_send_sms" type="button" onclick="sendsms(this)" class="btn btn-weak kv-v">获取验证码</button>			            		</dd><?php endif; ?>								<dd class="kv-line-r dd-padding">									<input id="reg_pwd_password" class="input-weak kv-k" type="password" placeholder="设置一个6位以上的密码"/>									<input id="reg_txt_password" class="input-weak kv-k" type="text" placeholder="设置一个6位以上的密码" style="display:none;"/>									<input type="hidden" id="reg_password_type" value="0"/>									<button id="reg_changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>								</dd>			        		</dl>			        	</dd>			        </dl>			        <div class="btn-wrapper"><!--						<button type="submit" class="btn btn-larger btn-block">注册并绑定</button>-->						<button type="submit" class="btn btn-larger btn-block">下一步</button>			        </div>			    </form>			</div>		</div>		<script type="text/javascript">			var countdown = 60;			function sendsms(val){				if($("input[name='phone']").val()==''){					alert('手机号码不能为空！');				}else{										if(countdown==60){						$.ajax({							url: '<?php echo U('My/SmsCodeverify');?>',							type: 'POST',							dataType: 'json',							data: {phone: $("input[name='phone']").val()},						});					}					if (countdown == 0) {						val.removeAttribute("disabled");						val.innerText="免费获取验证码";						countdown = 60;						//clearTimeout(t);					} else {						val.setAttribute("disabled", true);						val.innerText="重新发送(" + countdown + ")";						countdown--;						setTimeout(function() {							sendsms(val);						},1000)					}				}			}		</script>		<script src="<?php echo C('JQUERY_FILE');?>"></script>		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>		<script src="<?php echo ($static_path); ?>js/bind_user.js"></script>				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
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
        	</body></html>