<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>店员登录</title>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>"/>
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
		#login{margin: 0.5rem 0.2rem;}
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
<body id="index" data-com="pagecommon">
        <!--<header  class="navbar">
            <h1 class="nav-header">店员登录 - <?php echo ($config["site_name"]); ?></h1>
        </header>-->
		<div id="w_login" style="display:none; position:absolute;width: 100%;height:300px;z-index:10;background: #f0efed;">
			<div id="normal-fieldset" class="normal-fieldset" style="height: 100%;">
				<h1 align="center">您可以选择快捷登录</h1>
				<dl class="list">
						<dd class="dd-padding">
							<label class="mt"><i class="bank-icon icon" ></i><span class="pay-wrapper"><span style="width: 200px;">用户名：&nbsp;<?php echo ($wei_login["username"]); ?></span><input type="hidden" style="right: 0px;"  id="mt" value="<?php echo ($wei_login['id']); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?> name="pay_type"></span></label>
						</dd>
				</dl>
			</div>
			<div class="btn-wrapper">
				<button type="" id="wei_login" class="btn btn-larger btn-block">微信快捷登录</button>
			</div>
			<div class="btn-wrapper">
				<button type="" class="btn btn-larger btn-block" onclick="$('#w_login').hide();">密码登录</button>
			</div>
		</div>
        <div id="container">
        	<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
			<div id="login">
			    <form id="login_form" autocomplete="off" method="post" action="<?php echo U('Storestaff/login');?>">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input class="input-weak" type="text" name="account" id="login_account" placeholder="请输入您的店员账号"/>
			            		</dd>
			            		<dd class="dd-padding">
									<input class="input-weak" type="password" name="pwd" id="login_pwd" placeholder="请输入您的店员密码"/>
			            		</dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">登录</button>
			        </div>
					<div class="btn-wrapper" style="margin-top: 10px;">
						<a type="" id="fanhui" style="display:none;" class="btn btn-larger btn-block">返回</a>
					</div>
			    </form>
			</div>
		</div>
		<a href="javascript:void(0);" id="w_login" style="display:none;"  onclick="window.top.artiframe('/admin.php?g=Wap&amp;c=Storestaff&amp;a=selectlogin&amp;openid=<?php echo ($openid); ?>','编辑商户信息',600,450,true,false,false,editbtn,'edit',true);">编辑</a>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_public); ?>js/laytpl.js"></script>
	    <script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
		<script type="text/javascript">
//			判断是否是微信登录
			var wei_o = "<?php echo ($wei_o); ?>";
			if(wei_o=="1"){
				$("#w_login").show();
				$("#fanhui").show();
			}
			$("#fanhui").click(function(){
				$("#w_login").show();
			})
			var static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($merchantstatic_path); ?>",login_check="<?php echo U('Storestaff/login');?>",store_index="<?php echo U('Storestaff/index');?>";

			<?php if(!empty($refererUrl)): ?>store_index="<?php echo ($refererUrl); ?>";<?php endif; ?>

	var openid=false;
	<?php if(isset($openid) AND !empty($openid)): ?>openid="<?php echo ($openid); ?>";<?php endif; ?>

	$(function(){
	$("#wei_login").click(function(){
		var op_id = $("#mt").val();
		var url = "<?php echo U('Storestaff/selectlogin');?>";
		$.ajax({
			url:url,
			data:{
				"op_id" : op_id
			},
			type:"POST",
			success:function(data){
				data = $.parseJSON(data);
				if(data.error == 0){
					setTimeout(function(){
						window.parent.location = store_index;
					},1000);
				}else{
					alert(data.msg);
				}
			}
		});
	});
	$('#login_account').focus();
	$('#login_form').submit(function(){
		if($('#login_account').val()==''){
			alert('请输入帐 号~');
			$('#login_account').focus();
			return false;
		}else if($('#login_pwd').val()==''){
			alert('请输入密码~');
			$('#login_pwd').focus();
		}else{
			$.post(login_check,$("#login_form").serialize(),function(result){
				//result = $.parseJSON(result);
				if(result){
					if(result.error == 0 && openid){
						if(result.oid=="1"){
							layer.open({
								title:['提示：','background-color:#FF658E;color:#fff;'],
								content:'系统检测到您是在微信中访问的，是否需要绑定微信号，下次访问可以免登陆！',
								btn: ['是', '否'],
								shadeClose: false,
								yes: function(){
									/*layer.open({
									 type: 2,
									 content: '绑定中，请稍后'
									 });*/
									$.post("/wap.php?g=Wap&c=Storestaff&a=freeLogin",{},function(ret){
										//layer.closeAll();
										if(!ret.error){
											layer.open({title:['成功提示：','background-color:#FF658E;color:#fff;'],content:'恭喜您绑定成功！',btn: ['确定'],end:function(){window.parent.location = store_index;}});
										}else{
											layer.open({
												title:['错误提示：','background-color:#FF658E;color:#fff;'],
												content:'绑定失败，请下次登陆再试',
												btn: ['确定'],
												end:function(){
													window.parent.location = store_index;
												}
											});
										}
										/* setTimeout(function(){
										 window.parent.location = store_index;
										 },1000);*/
									},'JSON');

								}, no: function(){
									setTimeout(function(){
										window.parent.location = store_index;
									},1000);
								}
							});
						}else if(result.error == 0){
							setTimeout(function(){
								window.parent.location = store_index;
							},1000);
						}

					/*alert(result.msg);
					setTimeout(function(){
						window.parent.location = store_index;
					},1000);*/

					}else if(result.error == 0 && !openid){
						setTimeout(function(){
							window.parent.location = store_index;
						},1000);
					}else{
						$('#login_'+result.dom_id).focus();
						alert(result.msg);
					}
				}else{
					alert('登录出现异常，请重试！');
				}
			},'JSON');
		}
		return false;
	});
});

	</script>
	</body>
</html>