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
				<a href="<?php echo U('Cashier/index');?>">商家收银</a>
			</li>
			<li class="active">商家收银台</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<link href="<?php echo ($static_path); ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="<?php echo ($static_path); ?>css/app.css" rel="stylesheet">
	<script src="<?php echo ($static_path); ?>plugins/js/sweetalert/sweetalert.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop(this)" value='<?php echo U("Cashier/cash",array("type"=>1));?>'>扫码收银</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='<?php echo U("Cashier/cash",array("type"=>2));?>'>扫码退款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='<?php echo U("Cashier/ewmPay");?>'>二维码收款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='<?php echo U("Cashier/ewmRecord");?>'>二维码记录</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='<?php echo U("Cashier/payRecord");?>'>收款记录</button>
					<div class="wrapper wrapper-content animated fadeIn">
						<div class="row">
							<div class="col-lg-6">
								<div class="tabs-container weixin">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tab-1">扫码收款</a></li>
										<li class=""><a data-toggle="tab" href="#tab-2">扫码退款</a></li>
									</ul>
									<div class="tab-content">
										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 micropay"></div>
												</div>
											</div>
										</div>
										<div id="tab-2" class="tab-pane">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 micropayRefund"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	wx.config({
	debug: false,
	appId: '<?php echo $signdata["appId"]; ?>',
	timestamp: '<?php echo $signdata["timestamp"]; ?>',
	nonceStr: '<?php echo $signdata["nonceStr"]; ?>',
	signature: '<?php echo $signdata["signature"]; ?>',
	jsApiList: [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'scanQRCode',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getLocation',
		'openLocation',
		'getNetworkType'
	]
});

	var Ttype=<?php echo $type;?>;
	 if(Ttype==2){
		$('.nav-tabs li').removeClass('active');
	    $('.nav-tabs li:last').addClass('active');
		$('#tab-1').removeClass('active');
		$('#tab-2').addClass('active');
	 }
		!function(a,b,wx){
			function is_mobile(){
				var ua = navigator.userAgent.toLowerCase();
				if ((ua.match(/(iphone|ipod|android|ios|ipad)/i))){
					if(navigator.platform.indexOf("Win") == 0 || navigator.platform.indexOf("Mac") == 0){
						return false;
					}else{
						return true;
					}
				}else{
					return false;
				}
			}
			function is_weixin(){
			    var ua = navigator.userAgent.toLowerCase();
			    if(is_mobile() && ua.indexOf('micromessenger') != -1){  
			        return true;
			    } else {  
			        return false;  
			    }
			}
			var c = c || {};
			c.config = {
				data : ['weixin_micropay','weixin_micropayRefund']
			}
			c.init = function(){
				c.tpl();
			}
			
			c.loadJs = function(d){
				var oHead = document.getElementsByTagName('head').item(0),
   					oScript= document.createElement("script");   
   				oScript.type = "text/javascript";   
				oScript.src = d;   
  				oHead.appendChild( oScript);  
			}
			c.tmpl = function(d){
				var e = {
					weixin : {
						micropay : '<h3 class="m-t-none m-b">收款</h3><p>只适用微信扫码支付</p><p>扫码支付确认信息.</p><form role="form" action="?g=Merchant&c=cashier&a=cash&type=1"><div class="form-group"><label>商品描述</label> <input type="text" placeholder="商品名称" name="goods_name" class="form-control"></div><div class="form-group"><label>支付金额</label> <input type="text" placeholder="支付金额" name="goods_price" class="form-control"></div><div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>扫码收款</strong></button></div></form>',
						micropayRefund : '<h3 class="m-t-none m-b">退款</h3><p>只适用微信扫码支付退款</p><p>扫微信扫码支付交易详情页的条形码来退款.</p><form role="form" action="?g=Merchant&c=cashier&a=cash&type=2"><div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>扫码退款</strong></button></div></form>',
					}
				}
				var f;
				$.each(d,function(g,h){
					f = e = e[h];
				});
				return f;
			}
			c.tpl = function(){
				$.each(this.config.data,function(d,e){
					c.create(e.split('_'));
				});
			}
			c.submit = function(d){
    			swal({
				title: "提示 :)",
        			text: "确认此操作？",
        			type: "warning",
        			showCancelButton: true,
        			confirmButtonColor: "#DD6B55",
        			confirmButtonText: "确定",
					cancelButtonText: "取消",
        			closeOnConfirm: false
    			}, function () {
    			    var e = d.serialize();	
					b.post(d.attr('action'),e, function(data){
						console.log(data);
						if(data.error == 0){
							c.tpl();
							swal("成功!", data.msg, "success");
						}else{
							swal("失败!", data.msg, "error");
						}
					},'JSON');
    			});
			}
			c.create = function(s){
				function d(e){
					if(is_weixin()){
						wx.scanQRCode({
							needResult:1,
							scanType:["qrCode","barCode"],
							success:function (res){
								var result = res.resultStr;
								
								if(result.indexOf(',')>0){
									var result = result.split(',');
									result = result[1];
								}
								
								if(result && /^\d+$/g.test(result)){
				 					e.prepend('<input type="hidden" name="auth_code" value="'+result+'">');
				  					c.submit(e);
				    				return false;
								}else{
									swal("错误!", "不是有效的码，非法输入！", "error");
								}	
							}
						});
					}else{
						swal("错误!", "您使用的不是微信浏览器，此功能无法使用！", "error");
					}
				}
				var e = this.tmpl(s),
					f,
					i = b('body');
				$.each(s,function(g,h){
					f = i = i.find('.'+h);
				});
				f.html(e);
	
				if(is_weixin()){
					f.find('form').find('button[type="submit"]').click(function(){
						d(f.find('form'));
						return false;
					});
				}else{
					if(f.find('form').find('.form-group').size()){
						f.find('form').find('.form-group').last().after('<div class="form-group"><label>支付二维码</label><input type="text" placeholder="扫码获取条码数据" name="auth_code" class="form-control"></div>');
					}else{
						f.find('form').prepend('<div class="form-group"><label>支付二维码</label> <input type="text" placeholder="扫码获取条码数据" name="auth_code" class="form-control"></div>');
					}
					f.find('form').find('button[type="submit"]').click(function(){
						c.submit(f.find('form'));
						return false;
					});
				}
			}
			b(document).ready(function(){
				c.init();
			});
		}(window,jQuery,wx||{});
	
	function CreateShop(obj){
		//alert(obj.value);
		window.location.href=obj.value;
	}
	</script>
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