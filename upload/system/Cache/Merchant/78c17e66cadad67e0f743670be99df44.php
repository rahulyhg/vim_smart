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
    <link href="<?php echo ($static_path); ?>css/animate_new.css" rel="stylesheet">
	<link href="<?php echo ($static_path); ?>css/cashier.css" rel="stylesheet">	<!----开放式头部，请在自己的页面加上--</head>-->
	<link href="<?php echo ($static_path); ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="<?php echo ($static_path); ?>css/app.css" rel="stylesheet">
	<script src="<?php echo ($static_path); ?>plugins/js/sweetalert/sweetalert.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>	
	<!-- Custom and plugin javascript -->
	<script src="<?php echo ($static_path); ?>js/jquery.qrcode.min.js"></script>   
	<script src="<?php echo ($static_path); ?>js/commonfunc.js"></script>
	<script src="<?php echo ($static_path); ?>plugins/js/footable/footable.all.min.js"></script>

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
					<div class="wrapper wrapper-content animated fadeInRight">
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">
								<strong>指定金额收款</strong> 
							</div>
							<div class="ibox-content"> 					 
								<div class="app__content js-app-main page-cashier carousel slide" id="carousel3" >
									<div class="carousel-inner">
										<div class="page-cashier-box"> 
											<div class="cashier-desk clearfix"> 
											<!-- 实时收款二维码 --> 
												<div class="realtime-pay js-pay-code-region clearfix">
													<div style="text-align: center;">
														<div class="pay-config" style="margin-top: 7%;"> 							 
															<form class="form-horizontal"> 
																<div class="control-group config-title"> 													
																</div>
																<div class="control-group config-title"> 
																	<div class="controls"> 
																		<input type="text" name="cashier_name" class="js-cashier-name js-input" value="" placeholder="收款商品名称" /> 
																		<span class="clear-btn js-clear"></span> 
																	</div> 
																</div> 
																<div class="control-group config-amount"> 
																	<div class="controls"> 
																		<input type="text" name="cashier_value" class="js-cashier-value js-input" value="" placeholder="输入金额(元)" /> 
																		<a href="javascript:void(0)" class="btn btn-primary js-create-qrcode">生成二维码</a> 
																	</div> 
															   </div> 
															   <p class="gray tips fixed-tips"></p> 
															</form> 
														</div> 
														<div class="pay-code" id="immediately"> 
															<h5>立刻支付二维码</h5>
															<div class="qr-code-zone gray" id="qr-code-zone">
																二维码区域 
															</div> 
															<p class="gray tips" id="receivables">收款: &nbsp;-&nbsp; 元</p> 
															<p class="tips">&nbsp;&nbsp;</p> 
														</div>
														<div class="pay-code f-pay-code"> 
															<h5>永久支付二维码</h5>
															<div class="qr-code-zone gray" id="qr-code-forever">
																二维码区域 
															</div> 
															<p class="gray tips" id="receivablesforever">收款: &nbsp;-&nbsp; 元</p> 
															<p class="tips downLoadEwm"> <a href="javascript:void(0)" id="downloadEwm">下载二维码</a> </p> 
														</div>
														<div class="pay-code" id="autopay-qrcode"> 
															<h5>自助付款</h5>
															<div class="qr-code-zone gray" id="qr-code-autopay">							   
															</div> 
															<p class="gray tips" id="receivables">买家可自助输入付款金额</p>
															<p class="tips downLoadEwm"> <a href="<?php echo $this->SiteUrl;?>/merchants.php?m=User&c=cashier&a=qrcode&tpy=autopay&dwd=1">下载二维码</a></p>
														</div>
													</div>
												</div> 
											</div> 
											<!-- 实时交易信息展示区域 --> 
											<div class="cashier-realtime"> 
												<div class="realtime-title-block clearfix"> 
													<h1 class="realtime-title">近期收款情况</h1> 
													<a href="javascript:void(0)" class="js-refresh-list refresh-list">刷新</a> 
												</div> 
											</div> 
											<div class="js-real-time-region realtime-list-box loading">
												<div class="widget-list">
													<div class="js-list-filter-region clearfix ui-box" style="position: relative;">
														<div class="widget-list-filter"></div>
													</div> 
													<div class="ui-box"> 
														<table class="ui-table ui-table-list" data-page-size="20" style="padding: 0px;"> 
															<thead class="js-list-header-region tableFloatingHeaderOriginal">
																<tr class="widget-list-header">
																	<th>编号</th>
																	<th  data-hide="phone">付款人</th> 
																	<th  data-hide="phone">付款时间</th> 
																	<th  data-hide="phone">付款金额(元)</th> 
																	<th  data-hide="phone">退款情况</th> 
																	<th>操作</th>
																</tr>
															</thead>
														<tbody class="js-list-body-region" id="table-list-body">
														   <?php if(!empty($neworder)){ foreach($neworder as $ovv){ ?>
														   <tr class="widget-list-item">
															<td><?php echo $ovv['id'];?></td> 
															<td><?php if(!empty($ovv['nickname'])){ echo $ovv['nickname']; }elseif(!empty($ovv['truename'])){ echo htmlspecialchars_decode($ovv['truename'],ENT_QUOTES); }elseif(!empty($ovv['openid'])){ echo $ovv['openid']; }else{ echo '未知客户'; }?></td> 
															<td><?php $paytime=$ovv['paytime'] > 0 ? $ovv['paytime'] : $ovv['add_time']; echo date('Y-m-d H:i:s',$paytime);?></td> 
															<td><?php echo $ovv['goods_price'];?></td>
															<td><?php if($ovv['refund']==1){?>
																 退款中...
															<?php }elseif($ovv['refund']==2){?>
																 已退款
															<?php }elseif($ovv['refund']==3){?>
																 退款失败
															 <?php }else{ echo "已支付"; } ?>
															</td> 
															<td> <?php if($ovv['comefrom']>0){ ?> <button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> <?php }elseif($ovv['refund']!=2 && $ovv['refund']!=1){?> <button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button>  <?php }elseif($ovv['refund']==2){?><button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button>  <?php }?><button class="btn btn-sm btn-info" onclick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong>支付详情</strong></button>  <button class="btn btn-sm btn-danger" onclick="deltheOrder(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 删 除 </strong></button></td>
															</tr>
														   <?php }}else{?>
														   <tr class="widget-list-item"><td colspan="7">暂无订单</td></tr>
														   <?php }?>
														</tbody> 
														</table> 
														<div class="js-list-empty-region"></div> 
													</div> 
													<div class="js-list-footer-region ui-box">
														<div class="widget-list-footer"></div>
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
</div>
<div class="modal inmodal" tabindex="-1" role="dialog"  id="oderinfo">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close _close"><span style="font-size: 35px;">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">支付详情</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white _close">关闭</button>
			</div>
		</div>
	</div>
</div>
<script>
	//$('.qr-code-zone').qrcode("http://www.helloweba.com"); //任意字符串 
	var qwidth=qheight=200;
	if(is_mobile()){
	  $('.form-horizontal').addClass('mbform');
	  $('.row .col-lg-12').css('padding','1px');
	  $('.float-e-margins .ibox-content').css('padding','15px 5px 20px 5px');
	  $('.cashier-desk .realtime-pay').css('float','none').css('padding','0 0 0 5px');
	  $('.js-pay-code-region .pay-code').css('float','none').css('margin-left','0px').css('padding','0px');
	  $('.js-cashier-name').css('width','95%');
	  $('.js-fixed-code-region').css('width','auto').css('border-left','none');
	  $('.qr-code-zone').css('width','251px').css('height','251px').css('padding-top','9px');
	  $('.js-fixed-code-region').css('margin','0px').css('float','none');
	  $('.self-pay-code').css('width','251px').css('height','251px');
	  $('.self-pay-code img').css('width','251px').css('height','251px');
	  $('#paytype').css('width','70%');
	  $('.js-cashier-value').css('width','50%');
	  $('.nav-tabs li a').css('padding','10px');
	  $('#immediately').css('margin-top','40px');
	  $('.downLoadEwm').hide();
	  qwidth=qheight=230;
	}else{
	  $('.form-horizontal').removeClass('mbform');
	}
	var topost=true;
	var thismoney=0;
	$(document).ready(function(){
		$('.ui-table-list').footable();
		$("#qr-code-autopay").html('').css('background-color','#FFF').qrcode({ 
				//render: "table", //table方式 
				width: qwidth, //宽度 
				height: qheight, //高度
				text:'<?php echo $this->SiteUrl;?>/merchants.php?m=Index&c=pay&a=autopay&mid=<?php echo $this->mid;?>' //任意内容 
		});
		$('.js-create-qrcode').click(function(){
			if(!topost) return false;
			var postdata={paytype:'wxpay'};
			postdata.tname=$.trim($('input[name="cashier_name"]').val());
			if(!postdata.tname){
				swal({title:'付款理由必须填！',text:'', type:"error"});
				return false;
			}
			postdata.tprice=$.trim($('input[name="cashier_value"]').val());
			postdata.tprice=parseFloat(postdata.tprice);
			if(!(postdata.tprice > 0)){
				swal({title:'付款金额必须填！',text:'', type: "error"});
				return false; 
			}
			thismoney=postdata.tprice;
			topost=false;
			$.post('?m=User&c=cashier&a=getEwm',postdata,function(ret){
				topost=true;
				if(!ret.error){
					$("#qr-code-zone").html('').css('background-color','#FFF').qrcode({ 
						//render: "table", //table方式 
						width: qwidth, //宽度 
						height: qheight, //高度
						text:ret.qrcode //任意内容 
					});
					$('#receivables').html('收款: '+postdata.tprice+' 元');

					$("#qr-code-forever").html('').css('background-color','#FFF').qrcode({ 
						//render: "table", //table方式 
						width: qwidth, //宽度 
						height: qheight, //高度 
						text:"<?php echo $this->SiteUrl;?>/merchants.php?m=Index&c=pay&a=foreverpay&ordid="+ret.ewminfo //任意内容 
					});
					$('#receivablesforever').html('收款: '+postdata.tprice+' 元');
				}else{
					swal("失败", ret.msg , "error");
				}
			},'json');
		});

		$('.js-refresh-list').click(function(){
			if(is_mobile()){
				window.location.reload();
				return false;
			}
			$.ajax({
				url: "?m=User&c=cashier&a=getajaxOrder&cf=index",
				type: "POST",
				dataType: "json",
				/*async:true,
				data:{cf:'index'},*/
				success: function(res){
					if(!res.error && res.datas){
						var datahtml='';
						$.each(res.datas,function(kk,vv){
						   datahtml+='<tr class="widget-list-item">';
						   datahtml+='<td>'+vv.id+'</td>';
						   datahtml+='<td>'+vv.truename+'</td>';
						   datahtml+='<td>'+vv.paytimestr+'</td>';
						   datahtml+='<td>'+vv.goods_price+'</td>';
						   datahtml+='<td>'+vv.refundstr+'</td>';
						   datahtml+='<td>';
						   if(vv.comefrom > 0){
							 datahtml+='<button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> ';
						   }else if(vv.refund!=2 && vv.refund!=1){
							  datahtml+='<button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,'+vv.id+','+vv.mid+');"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button> ';
						   }else{
							 datahtml+='<button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button> ';
						   }
						   datahtml+='<button class="btn btn-sm btn-info" onclick="GetDetail('+vv.id+','+vv.mid+');"><strong>支付详情</strong></button> '+' <button class="btn btn-sm btn-danger" onclick="deltheOrder(this,'+vv.id+','+vv.mid+');"><strong> 删 除 </strong></button></td></td> </tr>';
						});
					  $('.js-list-body-region').html(datahtml);
					}else{
						$('.js-list-body-region').html('<tr class="widget-list-item"><td colspan="6">暂无订单</td></tr>');
					}
					 $('.ui-table-list').footable();
					/*setTimeout(function(){
					
					}, 2000);*/
				}
			});
		});
	});
	var screenH=$(window).height();
	screenH=  screenH-20;
	$('#oderinfo').css('height',screenH);
	
	function CreateShop(obj){	//点击跳转到对应的页面
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