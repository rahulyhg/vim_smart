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
				<i class="ace-icon fa fa-cubes"></i>
				<a href="<?php echo U('Meal/index');?>"><?php echo ($config["meal_alias_name"]); ?>管理</a>
			</li>
			<li class="active">编辑<?php echo ($config["meal_alias_name"]); ?>信息</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				#levelcoupon select {width:150px;margin-right: 20px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本信息</a>
							</li>
							<li>
								<a data-toggle="tab" href="#category">选择分类</a>
							</li>
							<li>
								<a data-toggle="tab" href="#label">选择标签</a>
							</li>
							<!--li>
								<a data-toggle="tab" href="#pay">支付方式</a>
							</li>
							<li>
								<a data-toggle="tab" href="#delivertime">配送时间</a>
							</li-->
							<li>
								<a data-toggle="tab" href="#promotion">促销活动</a>
							</li>
							<li>
								<a data-toggle="tab" href="#stock">库存类型选择</a>
							</li>
						  <?php if(!empty($levelarr)): ?><li>
								<a data-toggle="tab" href="#levelcoupon">会员优惠</a>
							</li><?php endif; ?>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="Config_notice">店铺公告</label></label>
									<textarea class="col-sm-3" rows="4" name="store_notice" id="Config_notice"><?php echo ($store_meal["store_notice"]); ?></textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>配送方式</label></label>
									<span><label><input id='deliver_type' name="deliver_type" <?php if($store_meal['deliver_type'] == 0 ): ?>checked="checked"<?php endif; ?> value="0" type="radio"></label>&nbsp;<span>系统配送</span>&nbsp;</span>
									<span><label><input id='deliver_type' name="deliver_type" <?php if($store_meal['deliver_type']==1){?>checked="checked"<?php }?> value="1" type="radio" ></label>&nbsp;<span>自己配送</span></span>
								</div>
								<div class="form-group">
								</div>
								<div class="form-group">
									<label class="col-sm-1">预订金</label>
									<input class="col-sm-1" size="10" maxlength="10" name="deposit" id="Config_deposit" type="text" value="<?php echo ($store_meal["deposit"]); ?>" />元
								</div>
								<div class="form-group">
									<label class="col-sm-1">人均消费</label>
									<input class="col-sm-1" size="10" maxlength="10" name="mean_money" id="Config_mean_money" type="text" value="<?php echo ($store_meal["mean_money"]); ?>" />元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">起送价格</label>
									<input class="col-sm-1" size="10" maxlength="10" name="basic_price" id="Config_basicprice" type="text" value="<?php echo ($store_meal["basic_price"]); ?>" />元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_delivery_fee">外送费</label>
									<input class="col-sm-1" size="10" maxlength="10" name="delivery_fee" id="Config_delivery_fee" type="text" value="<?php echo ($store_meal["delivery_fee"]); ?>"/>元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_send_time">送达时间</label>
									<input class="col-sm-1" size="10" maxlength="10" name="send_time" id="Config_send_time" type="text" value="<?php echo ($store_meal["send_time"]); ?>"/>分钟
								</div>
								<style>
									#perioddeliveryfeebox{
										margin:10px;
										height:auto;
									}
									.perioddeliveryfeeitem{
										margin:10px 0px;
									}
								</style>
								<div class="form-group">
									<div class="radio">
										<label>
											<input class="" name="delivery_fee_valid" id="Config_delivery_fee_valid" value="1" type="checkbox" <?php if($store_meal['delivery_fee_valid']): ?>checked="checked"<?php endif; ?>/>
											<span class="lbl"><label for="Config_delivery_fee_valid">不足起送价格收取外送费照样送</label></span>
										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label bolder blue">达到起送价格</label>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="0" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 0): ?>checked="checked"<?php endif; ?>/>
											<span class="lbl" style="z-index: 1">免外送费</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="1" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 1): ?>checked="checked"<?php endif; ?>/>
											<span class="lbl" style="z-index: 1">照样收取外送费</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="2" type="radio" class="" <?php if($store_meal['reach_delivery_fee_type'] == 2): ?>checked="checked"<?php endif; ?>/>
											<span class="lbl" style="z-index: 1">达到</span><input size="10" maxlength="10" name="no_delivery_fee_value" id="Config_no_delivery_fee_value" type="text" value="<?php echo ($store_meal["no_delivery_fee_value"]); ?>"/><span class="lbl" style="z-index: 1">元免外送费</span>
										</label>
									</div>											
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_delivery_radius">服务距离</label>
									<input class="col-sm-1" size="10" maxlength="10" name="delivery_radius" id="Config_delivery_radius" type="text" value="<?php echo ($store_meal["delivery_radius"]); ?>"/>公里
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="Config_area">配送区域</label></label>
									<textarea class="col-sm-3" rows="4" name="delivery_area" id="Config_area"><?php echo ($store_meal["delivery_area"]); ?></textarea>
								</div>
							</div>
							<div id="category" class="tab-pane">
								<?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
										<div class="radio">
											<label>
												<span class="lbl"><label style="color: red"><?php echo ($vo["cat_name"]); ?>：</label></span>
											</label>
											<?php if(is_array($vo['list'])): $i = 0; $__LIST__ = $vo['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><label>
													<input class="cat_class" type="checkbox" name="store_category[]" value="<?php echo ($vo["cat_id"]); ?>-<?php echo ($child["cat_id"]); ?>" id="Config_store_category_<?php echo ($child["cat_id"]); ?>" <?php if(in_array($child['cat_id'],$relation_array)): ?>checked="checked"<?php endif; ?>/>
													<span class="lbl"><label for="Config_store_category_<?php echo ($child["cat_id"]); ?>"><?php echo ($child["cat_name"]); ?></label></span>
												</label><?php endforeach; endif; else: echo "" ;endif; ?>
										</div>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div id="label" class="tab-pane">
								<?php if(is_array($label_list)): $i = 0; $__LIST__ = $label_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
										<div class="radio">
											<label>
												<input class="cat_class" type="checkbox" name="store_labels[]" value="<?php echo ($vo["id"]); ?>" id="Config_store_label_<?php echo ($vo["id"]); ?>" <?php if(in_array($vo['id'], $store_meal['store_labels'])): ?>checked="checked"<?php endif; ?>/>
												<span class="lbl"><label for="Config_store_label_<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></label></span>
											</label>
										</div>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div id="pay" class="tab-pane">
								<?php if($config['store_open_payone']): ?><div class="form-group">
										<div class="radio">
											<label>
												<input class="paycheck " type="checkbox" name="openpayone" value="1" id="Config_openpayone" onclick="check(this);" <?php if($store_meal['openpayone'] == 1): ?>checked="checked"<?php endif; ?>/>
												<span class="lbl"><label for="Config_openpayone">货到付款</label></span>
											</label>
										</div>
									</div><?php endif; ?>
								<div class="form-group">
									<div class="radio">
										<label>
											<input class="paycheck " type="checkbox" name="openpaytwo" value="1" id="Config_openpaytwo" onclick="check(this);" <?php if($store_meal['openpaytwo'] == 1): ?>checked="checked"<?php endif; ?>/>
											<span class="lbl"><label for="Config_openpaytwo">余额支付</label></span>
										</label>
									</div>
								</div>
								<?php if($config['store_open_paythree']): ?><div class="form-group">
										<div class="radio">
											<label>
												<input class="paycheck " type="checkbox" name="openpaythree" value="1" id="Config_openpaythree" onclick="check(this);" <?php if($store_meal['openpaythree'] == 1): ?>checked="checked"<?php endif; ?>/>
												<span class="lbl"><label for="Config_openpaythree">在线支付</label></span>
											</label>
										</div>
									</div><?php endif; ?>
							</div>
							<div id="delivertime" class="tab-pane">
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									<p>外卖有个特点，就是顾客消费的时间段比较集中，例如中午11点至12点半，晚上5点至6点半，都是点外卖的高峰期。对于某些订单量较大的商家或者多店铺运营者来说，如果顾客都临时下单，很难保证订单的及时配送，可能会导致顾客投诉与抱怨，引起顾客流失。为此，我们提供了店铺配送时间的功能设置。<br/><br/>每个店铺最多可以配置20个配送时间段，顾客在下单的时候，必须选择其中一个时间段。并且可以设置一个最少提前多少分钟下单，例如设置了最少提前30分钟下单，那么选择11:30-12:00时间段配送的顾客，至少要在11点之前下单，否则无法进入订单支付结算页面。
									</p>
								</div>
								<div class="form-group">
									<label class="col-sm-2" for="Config_opendelivertime">是否开启配送时间限制</label>
									<select name="open_deliver_time" id="Config_opendelivertime">
										<option value="0" <?php if($store_meal['open_deliver_time'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
										<option value="1" <?php if($store_meal['open_deliver_time'] == 1): ?>selected="selected"<?php endif; ?>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-2" for="Config_delivertimerange">最少提前多少分钟下单</label>
									<input class="col-sm-1" size="10" maxlength="3" name="deliver_time_range" id="Config_delivertimerange" type="text" value="<?php echo ($store_meal["deliver_time_range"]); ?>" />分钟	
								</div>
								<div class="widget-box">
									<div class="widget-header">
										<h5>配送时间段</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<?php if(is_array($store_meal['deliver_time'])): $i = 0; $__LIST__ = $store_meal['deliver_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="margin:10px;width:400px;float:left;">(<?php echo ($i); ?>)
													<input id="delivertime_<?php echo ($i); ?>_start" type="text" value="<?php echo ($vo["start"]); ?>" name="deliver_time[<?php echo ($i); ?>][start]"/> 至 <input id="delivertime_<?php echo ($i); ?>_stop" type="text" value="<?php echo ($vo["stop"]); ?>" name="deliver_time[<?php echo ($i); ?>][stop]"/>
												</div><?php endforeach; endif; else: echo "" ;endif; ?>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
							
							<div id="promotion" class="tab-pane">
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									<p>赠和送都是商家和消费者的线下互动，如商家赠送一些小礼品呀，购物券之类的。满、减(消费超过多少元立减多少元)，如果商家没有填写就没有这个优惠！</p>
								</div>
								<div class="form-group">
									<label class="col-sm-1">赠</label>
									<textarea class="col-sm-3" rows="4" name="zeng" id="Config_zeng"><?php echo ($store_meal["zeng"]); ?></textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1">满（金额）</label>
									<input class="col-sm-1" size="10" maxlength="10" name="full_money" id="Config_mean_full_money" type="text" value="<?php echo ($store_meal["full_money"]); ?>" />
									<label class="col-sm-1">减（金额）</label>
									<input class="col-sm-1" size="10" maxlength="10" name="minus_money" id="Config_mean_minus_money" type="text" value="<?php echo ($store_meal["minus_money"]); ?>" />
								</div>
								<div class="form-group">
									<label class="col-sm-1">送</label>
									<textarea class="col-sm-3" rows="4" name="song" id="Config_song"><?php echo ($store_meal["song"]); ?></textarea>
								</div>
								<div style="clear:both;"></div>
							</div>
							
							<div id="stock" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">库存类型：</label>
									<label><input type="radio" name="stock_type" value="0" <?php if($store_meal['stock_type'] == 0): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;每天自动更新固定量的库存</label>&nbsp;&nbsp;&nbsp;
									<label><input type="radio" name="stock_type" value="1" <?php if($store_meal['stock_type'] == 1): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;固定的库存，不会每天自动更新</label>&nbsp;&nbsp;&nbsp;
								</div>
								<div style="clear:both;"></div>
							</div>

							<?php if(!empty($levelarr)): ?><div id="levelcoupon" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：必须设置一个会员等级优惠类型和优惠类型对应的数值，我们将结合优惠类型和所填的数值来计算该商品会员等级的优惠的幅度！</label>
								</div>
							    <?php if(is_array($levelarr)): $i = 0; $__LIST__ = $levelarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="form-group">
								    <input  name="leveloff[<?php echo ($vv['level']); ?>][lid]" type="hidden" value="<?php echo ($vv['id']); ?>"/>
								    <input  name="leveloff[<?php echo ($vv['level']); ?>][lname]" type="hidden" value="<?php echo ($vv['lname']); ?>"/>
									<label class="col-sm-1"><?php echo ($vv['lname']); ?>：</label>
									优惠类型：&nbsp;
									<select name="leveloff[<?php echo ($vv['level']); ?>][type]">
										<option value="0">无优惠</option>
										<option value="1" <?php if($vv['type'] == 1): ?>selected="selected"<?php endif; ?>>百分比（%）</option>
										<!--<option value="2">立减</option>-->
									</select>
									<input name="leveloff[<?php echo ($vv['level']); ?>][vv]" type="text" value="<?php echo ($vv['vv']); ?>" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>

							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function check(obj){
	var length = $('.paycheck:checked').length;
	if(length == 0){
		$(obj).attr('checked','checked');
		bootbox.alert('最少要选择一种支付方式');
	}			
}
$(function($){
	<?php if(is_array($store_meal['deliver_time'])): $i = 0; $__LIST__ = $store_meal['deliver_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>$('#delivertime_<?php echo ($i); ?>_start').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
		$('#delivertime_<?php echo ($i); ?>_stop').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));<?php endforeach; endif; else: echo "" ;endif; ?>

	$('#edit_form').submit(function(){
		$.post("<?php echo U('Meal/store_edit',array('store_id'=>$store_meal['store_id']));?>",$('#edit_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "<?php echo U('Meal/store_edit',array('store_id'=>$store_meal['store_id']));?>";
			}else{
				alert(result.info);
			}
		})
		return false;
	});
});
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