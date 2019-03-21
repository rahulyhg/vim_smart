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
	<div id="navbar" class="navbar navbar-default">
	<div class="navbar-container" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
			<span class="sr-only">Toggle sidebar</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="navbar-header pull-left">
			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 
				<small> 
					<img src="<?php echo ($config["site_merchant_logo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 商家中心
				</small>
			</a>
		</div>
		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<!--li class="red">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 
						<span class="badge badge-important">0</span>
					</a>
					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单
						</li>
						<li class="dropdown-footer">
							<a href="#">查看全部未处理订单 
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
				<li class="green">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 
						<span class="badge badge-success">0</span>
					</a>
		
					<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新留言
							</a>
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新评论
							</a>
						</li>
						<li></li>
					</ul>
				</li-->
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 
						<?php if($merchant_session['img_info']): ?><img class="nav-user-photo" src="<?php echo ($merchant_session["img"]); ?>" alt="Jason&#39;s Photo" />
						<?php else: ?>
						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /><?php endif; ?>
						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 
						<i class="ace-icon fa fa-caret-down"></i>
					</a>
					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">
								<i class="ace-icon fa fa-link"></i> 网站首页
							</a>
						</li>
						<!--li>
							<a href="#">
								<i class="ace-icon fa fa-share-alt"></i> 推荐好友
							</a>
						</li-->
						<li>
							<a href="<?php echo U('Config/merchant');?>">
								<i class="ace-icon fa fa-user"></i> 商家设置
							</a>
						</li>
						<!--li>
							<a href="<?php echo U('Pay/index');?>"> 
								<i class="ace-icon fa fa-smile-o"></i> 对帐平台
							</a>
						</li-->
						<li class="divider"></li>
						<li>
							<a href="<?php echo U('Login/logout');?>"> 
								<i class="ace-icon fa fa-power-off"></i> 退出
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
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
				<a href="<?php echo U('Appoint/index');?>">预约管理</a>
			</li>
			<li class="active">添加预约</li>
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
								<a data-toggle="tab" href="#txtstore">选择店铺</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtintro">服务详情</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtimage">图片</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1">服务名称：</label>
									<input class="col-sm-3" maxlength="30" name="appoint_name" type="text" value="" /><span class="form_tips">必填。在预约页显示此名称！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">服务简介：</label>
									<textarea class="col-sm-3" rows="5" name="appoint_content"></textarea><span class="form_tips">预约的简短介绍，建议为100字以下。</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group"><label class="col-sm-1">收取定金</label>
									<label><input type="radio" name="payment_status" <?php if(!$ismainno): ?>checked="checked"<?php endif; ?> value="0" onclick="paymentHide();">&nbsp;&nbsp;否</label>
									&nbsp;&nbsp;&nbsp;
									<label><input type="radio" name="payment_status" value="1" onclick="paymentShow();" <?php if($ismainno): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;是</label>
								</div>
								<div class="form-group" id="payment_money" style="display:none;">
									<label class="col-sm-1">定金：</label>
									<input class="col-sm-1" maxlength="100" name="payment_money" type="text" value="" /><span class="form_tips">最多支持2位小数（超过后，系统自动截取）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">全价：</label>
									<input class="col-sm-1" maxlength="30" name="appoint_price" type="text" value="" /><span class="form_tips">必填。最多支持2位小数（超过后，系统自动截取）</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">开始时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'<?php echo date('Y年m月d日',$_SERVER['REQUEST_TIME']);?>',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'<?php echo date('Y-m-d',$_SERVER['REQUEST_TIME']);?>',vel:'start_time'})" value="<?php echo date('Y年m月d日',$_SERVER['REQUEST_TIME']);?>"/>
									<input name="start_time" id="start_time" type="hidden" value="<?php echo date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);?>"/>
									<span class="form_tips">到了开始时间，商品才会显示！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">结束时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'<?php echo date('Y年m月d日',$_SERVER['REQUEST_TIME']);?>',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'<?php echo date('Y-m-d',strtotime('+30 day'));?>',vel:'end_time'})" value="<?php echo date('Y年m月d日 ',strtotime('+30 day'));?>"/>
									<input name="end_time" id="end_time" type="hidden" value="<?php echo date('Y-m-d H:i:s',strtotime('+1 day'));?>"/>
									<span class="form_tips">超过结束时间，会自动结束！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">服务类别：</label>
									<select name="appoint_type" class="col-sm-2">
										<option value="0">到店</option>
										<option value="1">上门</option>
									</select>
								</div>
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#shop_time_1">
												营业时间段1
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_2">
												营业时间段2
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_3">
												营业时间段3
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="shop_time_1" class="tab-pane in active">
											<div>
												<input id="Config_shop_start_time" type="text" value="08:00" name="office_start_time" />	至
												<input id="Config_shop_stop_time" type="text" value="20:00" name="office_stop_time" />
												<div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_2" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_2" type="text" value="00:00" name="office_start_time2" />	至
												<input id="Config_shop_stop_time_2" type="text" value="00:00" name="office_stop_time2" />
												<div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_3" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_3" type="text" value="00:00" name="office_start_time3" />	至
												<input id="Config_shop_stop_time_3" type="text" value="00:00" name="office_stop_time3" />
												<div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div class="form-group"></div>
										<div class="form-group">
											<label class="col-sm-1">限定人数：</label>
											<input class="col-sm-1" maxlength="100" name="appoint_people" type="text" value="0" /><span class="form_tips">限制每个时间点的预约人数，0为不限制</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">时间间隔：</label>
											<input class="col-sm-1" maxlength="100" name="time_gap" type="text" value="30" /><span class="form_tips">预约时间间隔，单位分钟，必须是10的倍数</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">提前：</label>
											<input class="col-sm-1" maxlength="100" name="before_time" type="text" value="0" /><span class="form_tips">提前多长时间预约，小时计，0为不限制</span>
										</div>
									</div>
								</div>
							</div>
							<div id="txtstore" class="tab-pane">
								<div class="form-group">
									<?php if(is_array($store_list)): $i = 0; $__LIST__ = $store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="radio">
											<label>
												<input class="paycheck ace" type="checkbox" name="store_id[]" value="<?php echo ($vo["store_id"]); ?>" id="store<?php echo ($vo["store_id"]); ?>"/>
												<span class="lbl"><label for="store<?php echo ($vo["store_id"]); ?>"><?php echo ($vo["name"]); ?> - <?php echo ($vo["area_name"]); ?>-<?php echo ($vo["adress"]); ?></label></span>
											</label>
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
							<div id="txtintro" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">选择分类：</label>
									<select id="choose_catfid" name="cat_fid" class="col-sm-1" style="margin-right:10px;">
										<option value="">请选择</option>
										<?php if(is_array($f_category_list)): $i = 0; $__LIST__ = $f_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<select id="choose_catid" name="cat_id" class="col-sm-1" style="margin-right:10px;">
										<option value="">请选择</option>
										<?php if(is_array($s_category_list)): $i = 0; $__LIST__ = $s_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<input type="hidden" name="cat_id" id="cat_id" value=""/>
								</div>
								<!-- <div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="custom_html_tips">
									<div class="form-group" style="margin-top:10px;color:red;">以下为主分类设定的特殊字段，不同分类字段不同，请选择。</div>
									<div id="custom_html"><?php echo ($custom_html); ?></div>
								</div>
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<div class="form-group" style="margin-top:30px;color:red;">以下为主分类设定的 购买须知填写项，请填写。</div>
									<div id="cue_html"><?php echo ($cue_html); ?></div>
								</div> 
								<div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a href="javascript:;" id="editor_plan_btn">插入套餐表格</a></div>-->
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<table class="table table-striped">
										<tbody>
											<tr>
												<th scope="col">菜单序号</th>
												<th scope="col">菜单名称</th>
												<th scope="col">价格</th>
												<th scope="col">描述</th>    
											</tr>
											<?php $__FOR_START_337841265__=1;$__FOR_END_337841265__=10;for($i=$__FOR_START_337841265__;$i < $__FOR_END_337841265__;$i+=1){ ?><tr class="parent" data-index="<?php echo ($i); ?>">
													<td><i class="ace-icon fa"></i>序号<?php echo ($i); ?></td>
													<td><input name="custom_name[]" type="text" class="span2 title" value=""></td>
													<td>￥<input name="custom_price[]" type="text" class="span2 keyword" value=""></td>
													<td><input name="custom_content[]" type="text" class="span3 url" value=""></td>
												</tr><?php } ?>
										</tbody>
									</table>
								</div>
								<div class="form-group" >
									<label class="col-sm-1">服务详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
									<textarea name="appoint_pic_content" id="content" style="width:702px;"></textarea>
								</div>
							</div>
							<div id="txtimage" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<?php if(!empty($config['group_pic_width'])){$group_pic_width=explode(',',$config['group_pic_width']);echo '图片宽度建议为：'.$group_pic_width[0].'px，';} if(!empty($config['group_pic_height'])){$group_pic_height=explode(',',$config['group_pic_height']);echo '高度建议为：'.$group_pic_height[0].'px';} ?></span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">图片预览</label>
									<div id="upload_pic_box">
										<ul id="upload_pic_ul"></ul>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" id="save_btn">
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
<style>
input.ke-input-text {
background-color: #FFFFFF;
background-color: #FFFFFF!important;
font-family: "sans serif",tahoma,verdana,helvetica;
font-size: 12px;
line-height: 24px;
height: 24px;
padding: 2px 4px;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
border-style: solid;
border-width: 1px;
display: -moz-inline-stack;
display: inline-block;
vertical-align: middle;
zoom: 1;
}
.form-group>label{font-size:12px;line-height:24px;}
#upload_pic_box{margin-top:20px;height:150px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}
</style>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script type="text/javascript">
$(function($){
	$('#Config_shop_start_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
});
</script>
<script type="text/javascript">
KindEditor.ready(function(K) {
	var content_editor = K.create("#content",{
		width:'702px',
		height:'260px',
		resizeType : 1,
		allowPreviewEmoticons:false,
		allowImageUpload : true,
		filterMode: true,
		autoHeightMode : true,
		afterCreate : function() {
			this.loadPlugin('autoheight');
		},
		items : [
			'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'table'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=appoint/content",
		cssPath : "<?php echo ($static_path); ?>css/group_editor.css"
	});
	
	var editor = K.editor({
		allowFileManager : true
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 5){
			alert('最多上传5个图片！');
			return false;
		}
		editor.uploadJson = "<?php echo U('Appoint/ajax_upload_pic');?>";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImg(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
					editor.hideDialog();
				}
			});
		});
	});
	
	$('#choose_catfid').change(function(){
		$.getJSON("<?php echo U('Appoint/ajax_get_category');?>",{cat_fid:$(this).val()},function(result){
			var html = '';
			html += '<option value="">请选择</option>';  
			if(result.error == 0){
				for ( var i=0; i<result.cat_list.length; i++){
                    html += '<option value="'+ result.cat_list[i].cat_id +'">' + result.cat_list[i].cat_name + '</option>';  
                }  
                $('#choose_catid').html(html);
            } else {  
                $("#choose_catid").html(html);
            }  
		});
	});

	$('#choose_catid').change(function(){
		var cat_id = $(this).val();
		$('#cat_id').attr('value', cat_id);
	});
	
	$('#add_form').submit(function(){
		content_editor.sync();
		$('#save_btn').prop('disabled',true);
		$.post("<?php echo U('Appoint/add');?>",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "<?php echo U('Appoint/index');?>";
			}else{
				alert(result.info);
			}
			$('#save_btn').prop('disabled',false);
		})
		return false;
	});
	
	$('#editor_plan_btn').click(function(){
		var dialog = K.dialog({
				width : 200,
				title : '输入欲插入表格行数',
				body : '<div style="margin:10px;"><input id="edit_plan_input" style="width:100%;"/></div>',
				closeBtn : {
						name : '关闭',
						click : function(e) {
							dialog.remove();
						}
				},
				yesBtn : {
						name : '确定',
						click : function(e){
							var value = $('#edit_plan_input').val();
							if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value)){
								alert('请输入数字！');
								return false;
							}
							value = parseInt(value);
							var html = '<table class="deal-menu">';
							html += '<tr><th class="name" colspan="2">套餐内容</th><th class="price">单价</th><th class="amount">数量/规格</th><th class="subtotal">小计</th></tr>';
							for(var i=0;i<value;i++){
								html += '<tr><td class="name" colspan="2">内容'+(i+1)+'</td><td class="price">¥</td><td class="amount">1份</td><td class="subtotal">¥</td></tr>';
							}
							html += '</table>';
							html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span><?php echo ($config["group_alias_name"]); ?>价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
							content_editor.appendHtml(html);
							
							dialog.remove();
						}
				},
				noBtn : {
						name : '取消',
						click : function(e) {
							dialog.remove();
						}
				}
		});
	});
});	
	function deleteImg(path,obj){
		$.post("<?php echo U('Appoint/ajax_del_pic');?>",{path:path});
		$(obj).closest('.upload_pic_li').remove();
	}

	function paymentHide(){
		$('#payment_money').hide();
	}
	function paymentShow(){
		$('#payment_money').show();
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