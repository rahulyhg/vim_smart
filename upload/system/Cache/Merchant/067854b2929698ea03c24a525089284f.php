<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script>

<link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.css" type="text/css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.ext.css" type="text/css">
<script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>layer/layer.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script>

<!-- ace scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script>

<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script>
<style type="text/css">
.jqstooltip {
	position: absolute;
	left: 0px;
	top: 0px;
	visibility: hidden;
	background: rgb(0, 0, 0) transparent;
	background-color: rgba(0, 0, 0, 0.6);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
	color: white;
	font: 10px arial, san serif;
	text-align: left;
	white-space: nowrap;
	padding: 5px;
	border: 1px solid white;
	z-index: 10000;
}

.jqsfield {
	color: white;
	font: 10px arial, san serif;
	text-align: left;
}

.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
	display: none;
}

#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
	{
	font-size: 12px;
	color: black;
	display: none;
	width: 100%;
}
</style>
<script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>

</head>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default">	<div class="navbar-container" id="navbar-container">		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">			<span class="sr-only">Toggle sidebar</span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>		</button>		<div class="navbar-header pull-left">			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 				<small> 					<img src="<?php echo ($config["site_merchant_waplogo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 商家中心				</small>			</a>		</div>		<div class="navbar-buttons navbar-header pull-right" role="navigation">			<ul class="nav ace-nav">				<!--li class="red">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 						<span class="badge badge-important">0</span>					</a>					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单						</li>						<li class="dropdown-footer">							<a href="#">查看全部未处理订单 								<i class="ace-icon fa fa-arrow-right"></i>							</a>						</li>					</ul>				</li>				<li class="green">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 						<span class="badge badge-success">0</span>					</a>							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新留言							</a>						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新评论							</a>						</li>						<li></li>					</ul>				</li-->				<li class="light-blue">					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 						<?php if($merchant_session['img_info']): ?><img class="nav-user-photo" src="<?php echo ($merchant_session["img"]); ?>" alt="Jason&#39;s Photo" />						<?php else: ?>						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /><?php endif; ?>						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 						<i class="ace-icon fa fa-caret-down"></i>					</a>					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">						<li>							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">								<i class="ace-icon fa fa-link"></i> 网站首页							</a>						</li>						<!--li>							<a href="#">								<i class="ace-icon fa fa-share-alt"></i> 推荐好友							</a>						</li-->						<li>							<a href="<?php echo U('Config/merchant');?>">								<i class="ace-icon fa fa-user"></i> 商家设置							</a>						</li>						<li>							<a href="Cashier/merchants.php?m=Index&c=login&a=index&type=merchant" target="_blank">								<i class="ace-icon fa fa-user"></i> 商家收银							</a>						</li>						<!--li>							<a href="<?php echo U('Pay/index');?>"> 								<i class="ace-icon fa fa-smile-o"></i> 对帐平台							</a>						</li-->						<li class="divider"></li>						<li>							<a href="<?php echo U('Login/logout');?>"> 								<i class="ace-icon fa fa-power-off"></i> 退出							</a>						</li>					</ul>				</li>			</ul>		</div>	</div></div>
	<div class="main-container" id="main-container">
	<div id="sidebar" class="sidebar responsive">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="<?php echo U('Config/merchant');?>" title="商家设置">
				<i class="ace-icon fa fa-gear"></i>
			</a>&nbsp;
			<a class="btn btn-info" href="<?php echo U('Meal/index');?>" title="<?php echo ($config["meal_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-cubes"></i>
			</a>&nbsp;
			<a class="btn btn-warning" href="<?php echo U('Group/index');?>" title="<?php echo ($config["group_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-desktop"></i>
			</a>&nbsp;
			<a class="btn btn-danger" href="<?php echo U('Customer/fans_list');?>" title="粉丝管理"> 
				<i class="ace-icon fa fa-group"></i>
			</a>
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>
			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list" style="top: 0px;">
		<?php if(is_array($merchant_menu)): $i = 0; $__LIST__ = $merchant_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["style_class"]); ?>">
				<a <?php if($vo['menu_list']): ?>href="#" class="dropdown-toggle"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>> 
					<i class="menu-icon fa <?php echo ($vo["icon"]); ?>"></i>
					<span class="menu-text"><?php echo ($vo["name"]); ?></span>
					<?php if($vo['menu_list']): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
				</a>
				<b class="arrow"></b>
				<?php if($vo['menu_list']): ?><ul class="submenu">
						<?php if(is_array($vo['menu_list'])): $i = 0; $__LIST__ = $vo['menu_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li <?php if($voo['is_active']): ?>class="active"<?php endif; ?>>
								<a href="<?php echo ($voo["url"]); ?>"> 
									<i class="menu-icon fa fa-caret-right"></i> <?php echo ($voo["name"]); ?>
								</a>
								<b class="arrow"></b>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="<?php echo U('Cashier/index');?>">商家收银台</a>
			</li>
			<li class="active">在线支付配置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<!-- Custom and plugin javascript -->
	<link href="<?php echo ($static_path); ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="<?php echo ($static_path); ?>js/inspinia.js"></script>
	<script src="<?php echo ($static_path); ?>plugins/js/sweetalert/sweetalert.min.js"></script>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title clearfix">
						<h5 style="margin: 10px 0 0px;">支付配置</h5>
					</div>
					<div class="ibox-content">
						<table class="table table-striped">
							<tr>							
								<td><img style="margin-left: 15px" src="<?php echo ($static_path); ?>images/pay_icon/weixin.png"></td>
								<td style="padding-top: 14px;">微信支付</td>
								<td id="wxapiinfo1"><button class="btn btn-info " type="button" <?php if($payConfig['configData']['alipay']['isOpen']==1){ echo 'checked="checked"'; }?> data-toggle="modal" data-target="#weixinSetting"><i class="fa fa-paste"></i>配置信息</button></td>
								<td id="wxapiinfo2"></td>
							</tr>
							<tr>
								<td><img style="margin-left: 15px" src="<?php echo ($static_path); ?>images/pay_icon/alipay.png"></td>
								<td style="padding-top: 14px;">支付宝支付</td>
								<td><button class="btn btn-info " type="button"><i class="fa fa-paste"></i>开发中</button></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" id="weixinSetting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">微信支付 支付配置</h4>
					<?php if($payConfig['proxymid']>0){?>
					<div class="alert alert-warning" style="margin:15px 0px 0px 0px;">您已经成为管理员的特约商家，请不要改动以下配置信息</div>
					<?php }?>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="new_wxpay_box" class="wxpay_box">
							
							<div class="form-group">
								<label>Appid</label>
								<input type="text" placeholder="Appid" value="<?php echo $payConfig['configData']['weixin']['appid']; ?>" name="weixin[appid]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['appid']){?>readonly="readonly"<?php }?> >
							</div>

							<div class="form-group">
								<label>AppSecret</label>
								<input type="text" placeholder="应用密钥" value="<?php echo $payConfig['configData']['weixin']['appSecret']; ?>" name="weixin[appSecret]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['appSecret']){?>readonly="readonly"<?php }?>>
							</div>

							<div class="form-group">
								<label>微支付商户号</label>
								<input type="text" placeholder="商户号" value="<?php echo $payConfig['configData']['weixin']['mchid']; ?>" name="weixin[mchid]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['mchid']){?>readonly="readonly"<?php }?>>
							</div>
							<div class="form-group">
								<label>API密钥</label>
								<input type="text" placeholder="Api密钥" value="<?php echo $payConfig['configData']['weixin']['key']; ?>" name="weixin[key]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['key']){?>readonly="readonly"<?php }?>>
							</div>
							<div class="form-group uploade">
								<label>apiclient_cert私钥文件</label>
								<input type="text" placeholder="apiclient_cert私钥文件" <?php if($payConfig['configData']['weixin']['apiclient_cert']){echo 'value="pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control" >
								<input type="hidden" placeholder="apiclient_cert私钥文件" value="<?php echo urldecode($payConfig['configData']['weixin']['apiclient_cert']); ?>" name="weixin[apiclient_cert]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>
							<div class="form-group uploade">
								<label>apiclient_key公钥文件</label>
								<input type="text" placeholder="apiclient_key公钥文件" <?php if($payConfig['configData']['weixin']['apiclient_key']){echo 'value="pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control">
								<input type="hidden" placeholder="apiclient_key公钥文件" value="<?php echo urldecode($payConfig['configData']['weixin']['apiclient_key']); ?>" name="weixin[apiclient_key]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>
								<div class="form-group uploade">
								<label>CA证书文件</label>
								<input type="text" placeholder="微信支付rootca文件" <?php if($payConfig['configData']['weixin']['rootca']){echo 'value="rootca.pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control">
								<input type="hidden" placeholder="微信支付rootca文件" value="<?php echo urldecode($payConfig['configData']['weixin']['rootca']); ?>" name="weixin[rootca]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-confirm">确定</button>
                </div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal inmodal" tabindex="-1"  id="wxApi_Setting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				
				<div class="modal-header">
                    <button type="button" class="close _close"><span>×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">微信服务器配置接口信息</h4>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="wxActionBox" class="wxpay_box">
							<div class="form-group">
								<label>URL：</label>
								<input type="text" placeholder="服务器推送事件地址" value='<?php echo U("Cashier/sendCms",array("mymid"=>$payConfig["mid"]));?>' class="form-control" readonly="readonly">
							</div>
							<div class="form-group">
								<label>Token：</label>
								<input type="text" placeholder="Token令牌" value="" class="form-control wxtoken" readonly="readonly">
							</div>
							<div class="form-group">
								<label>EncodingAESKey：</label>
								<input type="text" placeholder="消息加解密密钥" value="" class="form-control aeskey" readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-primary _close">关闭</button>
                </div>
			</div>
		</div>
	</div>
	<!--<div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" id="alipaySetting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-wrench modal-icon"></i>
                    <h4 class="modal-title">支付宝支付 支付配置</h4>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="new_wxpay_box" class="wxpay_box">
							
							<div class="form-group">
								<label>Appid</label>
								<input type="text" placeholder="Appid" value="<?php echo $payConfig['configData']['alipay']['appid']; ?>" name="alipay[appid]" class="form-control">
							</div>
							<div class="form-group">
								<label>Key</label>
								<input type="text" placeholder="Key" value="<?php echo $payConfig['configData']['alipay']['key']; ?>" name="alipay[key]" class="form-control">
							</div>
							<div class="form-group">
								<label>卖家账号</label>
								<input type="text" placeholder="卖家账号" value="<?php echo $payConfig['configData']['alipay']['name']; ?>" name="alipay[name]" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-confirm">确定</button>
                </div>
				</form>
			</div>
		</div>
	</div>-->
</div>
<script>
	 var apihtml="<button class='btn btn-info api' type='button' <?php if($payConfig['configData']['alipay']['isOpen'] == 1){ echo 'checked=\"checked\"'; }?> id=\"wxApiSetting\"> API接口 </button>";
	 <?php if(in_array($this->merchant['source'],array(1,2,3))){?>
		apihtml='';
	 <?php }?>
	 if(mobilecheck()){
	     $('#wxapiinfo1').append(apihtml);
		 $('#wxapiinfo1 .api').css('margin-top','15px');
		 $('#new_wxpay_box .uploade').css('display','none');
		 $('#new_wxpay_box').append('<div class="form-group noticee"><label>apiclient_cert私钥文件，apiclient_key公钥文件，CA证书文件等配置请登陆PC端修改</label></div>');
	 }else{
		 $('#new_wxpay_box .uploade').css('display','block');
		 $('#new_wxpay_box .noticee').remove();
	     $('#wxapiinfo2').html(apihtml);
	 }
        $(document).ready(function(){
            /*$('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });*/
			$('.btn-confirm').click(function(){
				var payConfigData=$(this).parents('form').serialize();
				//alert(htmlToArray(payConfigData));
				$.post('<?php echo U("Cashier/pay");?>',{data:htmlToArray(payConfigData)},function(result){
					if(result.status==1){
						swal({
        					title: "成功",
        					text: result.msg,
        					type: "success"
    					}, function () {
							//alert(result.msg);
        					window.location.reload();
   						});
					}else{
						//alert(result.msg);
						swal("失败", result.msg , "error");
					}
				},'json');
			});
			/*$(".dropz").dropzone({
				url: '<?php echo U("Cashier/pem_upload");?>',
				addRemoveLinks: false,
				maxFilesize: 1,
				acceptedFiles: ".pem",
				uploadMultiple: false,
				init: function() {
					this.on("success", function(file,responseText) {
						var rept = $.parseJSON(responseText);
						/***这里的this.element 是 $(".dropz")****/
						/*$(this.element).siblings('.form-control').val('pem文件已上传');
						$(this.element).siblings('.form-control').attr('readonly','readonly');
						$(this.element).siblings('.hiddeninput').val(rept.fileUrl);
					});
				}
			});*/
        });
		function htmlToArray(data){
			data = data.split('&');
			var info = {};
			$.each(data,function(k,v){
				v = v.replace('%5D','').split('=');
				var s = v[0].split('%5B');
				typeof(info[s[0]]) == 'undefined' && (info[s[0]] = {}),info[s[0]][s[1]] = v[1];
			});
			return info;
		}

		 $("#wxApiSetting").click(function(){
			//alert('<?php echo U("Cashier/getApiData");?>');
			$.post('<?php echo U("Cashier/getApiData");?>',function(ret){
				//alert(ret.wxtoken);
			    $('#wxApi_Setting .wxtoken').val(ret.wxtoken);
				$('#wxApi_Setting .aeskey').val(ret.aeskey);			
				var winW=$(window).width();
				if(winW<750){
				   $('#wxApi_Setting .modal-dialog').css('width','92%');
				}else{
				   $('#wxApi_Setting .modal-dialog').width(730);
				}
				$('body').append('<div class="modal-backdrop in"></div>');
				$('#wxApi_Setting').show();
			},'JSON');
		  });
		  $("#wxApi_Setting ._close").click(function(){
			  $('#wxApi_Setting').hide();
			  $('#wxApi_Setting .wxtoken').val('');
			  $('#wxApi_Setting .aeskey').val('');
			  $('.modal-backdrop').remove();
		  });
    </script>

<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;">
		<div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;">
			<b>新订单来啦!</b> <a class="oaright" href="javascript:closeoa()">[关闭]</a>
		</div>
		<div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div>
		<div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div>
		<div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a>
		</div>
	</div>
	<div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> 
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div>

<script>
function newalert(title){
	bootbox.dialog({
		message: title, 
		buttons: {
			"success" : {
				"label" : "确认",
				"className" : "btn-sm btn-primary"
			}
		}
	});
}

function alertshow(content){
	$('#popalertwindowcontent').html(content);
	$('#popalertwindow').show();
}
setInterval(function(){
	$.post("<?php echo U('Index/ping');?>");
},60000);

</script>

<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow">
	<div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div>
	<div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;">
		<div style="height: 40px;"></div>
		<div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;">
			<table style="width: 400px; height: 90px;">
				<tbody>
					<tr>
						<td id="popalertwindowcontent"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 20px;"></div>
		<div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div>
	</div>
</div>
</body>
</html>