<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>忘记密码 | <?php echo ($config["site_name"]); ?></title>
    <!--[if IE 6]>
		<script src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="<?php echo ($static_path); ?>js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/common.v113ea197.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/base.v492b572b.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/login.v7e870f72.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/login-section.vfa22738e.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/qrcode.v74a11a81.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/footer.css" />
	<script src="<?php echo ($static_public); ?>js/jquery.min.js"></script>
	<style type="text/css">.noact{background-image:none !important;color: #969696 !important;background-color: #CACACA !important;}</style>
</head>
<body id="login" class="theme--www" style="position: static;">
	<header id="site-mast" class="site-mast site-mast--mini">
	    <div class="site-mast__branding cf">
			<a href="<?php echo ($config["site_url"]); ?>"><img src="<?php echo ($config["site_logo"]); ?>" alt="<?php echo ($config["site_name"]); ?>" title="<?php echo ($config["site_name"]); ?>" style="width:190px;height:60px;"/></a>
	    </div>
	</header>
	<div class="site-body pg-login cf">
	    <div class="promotion-banner">
	        <img src="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/img/web_login/<?php echo mt_rand(1,4);?>.jpg" width="480" height="370">    
	    </div>
	    <div class="component-login-section component-login-section--page mt-component--booted" >
		    <div class="origin-part theme--www">
			    <div class="validate-info" style="visibility:hidden"></div>
		        <h2>您的手机账号</h2>
		        <form id="J-login-form" method="post" class="form form--stack J-wwwtracker-form">
			        <div class="form-field form-field--icon">
			            <i class="icon icon-user"></i>
			            <input type="text" id="login-phone" class="f-text" name="phone" placeholder="手机号" value="<?php echo ($accphone); ?>"/>
			        </div>
			        <div class="form-field form-field--icon" style="visibility:hidden" id="vfycodediv">
			            <i class="icon icon-password"></i>
			            <input type="text" id="vfycode" class="f-text" name="vfycode" placeholder="输入短信验证码" value=""/>
			        </div>
			        <div class="form-field form-field--ops">
			            <input type="submit" class="btn" id="commit" value="发送短信验证" style="width:55%"/>
						&nbsp;&nbsp;&nbsp;<span class="btn noact" style="width:15%;"><span id="reciprocal">60</span>秒</span>
						<a class="btn" id="submitcommit" style="margin-top:15px;width:85%" href="javascript:;" />提 交</a>
			        </div>
			    </form>
		    </div>
		</div>
	</div>
	<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
	<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
	     var flage=false;var islock=false;
		$(document).ready(function(){
			if($('body').height() < $(window).height()){
				$('.site-info-w').css({'position':'absolute','width':'100%','bottom':'0'});
			}
			$("#J-login-form").submit(function(){
				$('.validate-info').css('visibility','hidden');
				$('#commit').val('正在发短信...').prop('disabled',true);
				var phone = $.trim($("#login-phone").val());
				var vfycode = $.trim($("#vfycode").val());
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					$("#commit").val('发送短信验证').prop('disabled',false);
					return false;
				}
				
				$.post("<?php echo U('Index/Login/Generate');?>", {'phone':phone,vfycode:'',tmpid:0}, function(data){
					data.error_code=parseInt(data.error_code);
					if (!data.error_code) {
						$("#commit").val('重发送短信验证');
						$("#vfycodediv").css('visibility','visible');
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>请输入短信验证码').css('visibility','visible');
						flage=data.id;
						Reciprocal();
						return false;
					} else {
						if(data.error_code == 1){
						  $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
							  $("#commit").val('重发送短信验证').prop('disabled',false);
						}else if(data.error_code == 2){
						  $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>验证成功,跳转密码修改页面').css('visibility','visible');
						  setTimeout(function(){
						    window.location.href="<?php echo U('Index/Login/pwdModify');?>&pm="+data.urlpm;
						  }, 800);
						}else if(data.error_code == 3){
						   $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg+'<a href="<?php echo U('Index/Login/reg');?>">去注册</a>').css('visibility','visible');
							  $("#commit").val('重发送短信验证').prop('disabled',false);
						}
						
					}
				}, 'json');
				return false;
			});

			$('#submitcommit').click(function(){
				if(islock || !flage) return false;
				islock=true;
			    $('.validate-info').css('visibility','hidden');
				  $('#submitcommit').val('正在提交数据...').prop('disabled',true);
				var phone = $.trim($("#login-phone").val());
				var vfycode = $.trim($("#vfycode").val());
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					  $("#submitcommit").val('提 交');
					  islock=false;
					  return false;
				}
				if (vfycode == '' || vfycode == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>验证码不能为空').css('visibility','visible');
					 $("#submitcommit").val('提 交');
					 islock=false;
					 return false;
				}

				$.post("<?php echo U('Index/Login/Generate');?>", {'phone':phone,vfycode:vfycode,tmpid:flage}, function(data){
					data.error_code=parseInt(data.error_code);
					if (data.error_code == 2) {
						$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>验证成功,跳转密码修改页面').css('visibility','visible');
						  setTimeout(function(){
						    window.location.href="<?php echo U('Index/Login/pwdModify');?>&pm="+data.urlpm;
						 }, 800);
						 islock=false;
						return false;
					} else {
						  $('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						  islock=false;
						  $("#submitcommit").val('提 交');	
					}
				}, 'json');
				return false;
			});
		});

    function Reciprocal(){
	   $("#reciprocal").parent('.btn').removeClass('noact');
	     var inttmp=window.setInterval(function(){
		  num = $("#reciprocal").text();
		  num = parseInt(num);
	     $("#reciprocal").text(num-1);
		 if(num==1){
		    $("#reciprocal").parent('.btn').addClass('noact');
			//flage=0;
			$("#commit").val('重发送短信验证').prop('disabled',false);
			window.clearInterval(inttmp);
			setTimeout(function(){
				$("#reciprocal").text(60);
			}, 1000);
		 }
	   },1000);
    }
	</script>
	<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br($config['site_show_footer'],'<a>');?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<!--leftsead end-->
</body>
</html>