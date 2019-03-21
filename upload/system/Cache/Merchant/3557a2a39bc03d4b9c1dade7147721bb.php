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
				<i class="ace-icon fa fa-empire"></i>
				<a href="<?php echo ($url); ?>">微活动</a>
			</li>
			<li class="active">添加<?php echo ($tips); ?></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>关键词</label></label>
									<input type="hidden" value="<?php echo ($type); ?>" name="type" />
									<input type="text" class="col-sm-3" id="keyword" name="keyword" value="<?php if($lottery['keyword'] == ''): echo ($tips); else: echo ($lottery["keyword"]); endif; ?>" />
	  								<span class="form_tips">只能写一个关键词，用户输入此关键词将会触发此活动。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>活动名称</label></label>
									<input type="text" class="col-sm-3" name="title" value="<?php if($lottery['title'] == ''): echo ($tips); ?>活动开始了<?php else: echo ($lottery["title"]); endif; ?>" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone"><span class="required" style="color:red;">*</span>兑奖信息</label></label>
									<input type="text" class="col-sm-3" name="txt" value="<?php if($lottery['txt'] == ''): ?>兑奖请联系我们，电话138********<?php else: echo ($lottery["txt"]); endif; ?>" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="long_lat"><span class="required" style="color:red;">*</span>中奖提示</label></label>
									<input type="text" class="col-sm-3" name="sttxt" value="<?php echo ($lottery["sttxt"]); ?>"/> 
									<span class="form_tips">中奖后,提示信息</span>
								</div>

								<div class="form-group">
									<label class="col-sm-1"><label for="adress"><span class="required" style="color:red;">*</span>活动时间</label></label>
									<input type="text" class="hasDatepicker" id="statdate" value="<?php if($lottery['statdate'] != ''): echo (date("Y-m-d",$lottery["statdate"])); endif; ?>" onClick="WdatePicker()" name="statdate" />
									到
									<input type="text" class="hasDatepicker" id="enddate" value="<?php if($lottery['enddate'] != ''): echo (date("Y-m-d",$lottery["enddate"])); endif; ?>" name="enddate"  onClick="WdatePicker()"  />
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">活动开始图片</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview1(this)" name="starpicurl" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="img" src="<?php if($lottery['starpicurl'] != ''): echo ($lottery['starpicurl']); else: ?>/static/images/activity-<?php echo ($activity); ?>-start.jpg<?php endif; ?>"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="info">活动说明</label></label>
									<textarea  class="col-sm-3" id="info" name="info"  style="height:125px" ><?php if($lottery['info'] == ''): ?>亲，请点击进入<?php echo ($tips); ?>抽奖活动页面，祝您好运哦！<?php else: echo ($lottery["info"]); endif; ?></textarea>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>重复抽奖回复</label></label>
									<input class="col-sm-3" type="text" id="aginfo" value="<?php if($lottery['aginfo'] == ''): ?>亲，继续努力哦！<?php else: echo ($lottery["aginfo"]); endif; ?>" name="aginfo"/>
									<span class="form_tips">备注： 如果设置只允许抽一次奖的，请写：你已经玩过了，下次再来。 如果设置可多次抽奖，请写：亲，继续努力哦！</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>活动结束公告主题</label></label>
									<input class="col-sm-3" id="endtite" value="<?php if($lottery['endtite'] == ''): echo ($tips); ?>活动已经结束了<?php else: echo ($lottery["endtite"]); endif; ?>" name="endtite" type="text" />
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">活动结束图片</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-inputend" size="50" onchange="preview2(this)" name="endpicurl" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="endimg" src="<?php if($lottery['endpicurl'] != ''): echo ($lottery['endpicurl']); else: ?>/static/images/activity-<?php echo ($activity); ?>-end.jpg<?php endif; ?>"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="endinfo">活动结束说明</label></label>
									<textarea  class="col-sm-3" id="endinfo" name="endinfo"  style="height:125px" ><?php if($lottery['endinfo'] == ''): ?>亲，活动已经结束，请继续关注我们的后续活动哦。<?php else: echo ($lottery["endinfo"]); endif; ?></textarea>
									<span class="form_tips">换行请输入&lt;br&gt;</span>
								</div>
		
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>一等奖奖品设置</label></label>
									<input class="col-sm-3" name="fist" id="fist" type="text" value="<?php echo ($lottery["fist"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>一等奖奖品数量</label></label>
									<input class="col-sm-1"  name="fistnums" id="fistnums" type="text" value="<?php echo ($lottery["fistnums"]); ?>"/>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">二等奖奖品设置</label></label>
									<input class="col-sm-3" name="second" id="second" type="text" value="<?php echo ($lottery["second"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">二等奖奖品数量</label></label>
									<input class="col-sm-1"  name="secondnums" id="secondnums" type="text" value="<?php echo ($lottery["secondnums"]); ?>"/>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">三等奖奖品设置</label></label>
									<input class="col-sm-3" name="third" id="third" type="text" value="<?php echo ($lottery["third"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">三等奖奖品数量</label></label>
									<input class="col-sm-1"  name="thirdnums" id="thirdnums" type="text" value="<?php echo ($lottery["thirdnums"]); ?>"/>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">四等奖奖品设置</label></label>
									<input class="col-sm-3" name="four" id="four" type="text" value="<?php echo ($lottery["four"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">四等奖奖品数量</label></label>
									<input class="col-sm-1"  name="fournums" id="fournums" type="text" value="<?php echo ($lottery["fournums"]); ?>"/>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">五等奖奖品设置</label></label>
									<input class="col-sm-3" name="five" id="five" type="text" value="<?php echo ($lottery["five"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">五等奖奖品数量</label></label>
									<input class="col-sm-1"  name="fivenums" id="fivenums" type="text" value="<?php echo ($lottery["fivenums"]); ?>"/>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">六等奖奖品设置</label></label>
									<input class="col-sm-3" name="six" id="six" type="text" value="<?php echo ($lottery["six"]); ?>"/>
									<span class="form_tips">请不要多于50字!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">六等奖奖品数量</label></label>
									<input class="col-sm-1"  name="sixnums" id="sixnums" type="text" value="<?php echo ($lottery["sixnums"]); ?>"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>预计活动的人数</label></label>
									<input class="col-sm-1" size="10" name="allpeople" id="allpeople" type="text" value="<?php echo ($lottery["allpeople"]); ?>"/>
									<span class="form_tips">预估活动人数直接影响抽奖概率：中奖概率 = 奖品总数/(预估活动人数*每人抽奖次数) <br/>如果要确保任何时候都100%中奖建议设置为1人参加!<span class='red'>如果要确保任何时候都100%中奖建议设置为1人参加!并且奖项只设置一等奖.</span></span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums"><span class="required" style="color:red;">*</span>每人最多允许抽奖次数</label></label>
									<input class="col-sm-1" size="10" name="canrqnums" id="canrqnums" type="text" value="<?php echo ($lottery["canrqnums"]); ?>"/>
									<span class="form_tips">必须是数字</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="daynums">每天最多抽奖次数</label></label>
									<input class="col-sm-1" size="10" name="daynums" id="daynums" type="text" value="<?php echo ($lottery["daynums"]); ?>"/>
									<span class="form_tips">必须小于总抽奖次数！ 0 为不限制 抽完总数就不能抽了! 可以抽奖天数 = 总数/每天抽奖次数!</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="parssword"><span class="required" style="color:red;">*</span>兑奖密码</label></label>
									<input class="col-sm-1" size="10" name="parssword" id="parssword" type="text" value="<?php echo ($lottery["parssword"]); ?>"/>
									<span class="form_tips">消费确认密码长度小于15位</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="renamesn">SN码重命名为</label></label>
									<input class="col-sm-1" size="10" name="renamesn" id="renamesn" type="text" value="<?php echo ($lottery["renamesn"]); ?>"/>
									<span class="form_tips">例如：CND码,充值密码,SN码 这个主意用于修改SN码的名称，不懂请别修改</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="renametel">手机号重命名</label></label>
									<input class="col-sm-1" size="10" name="renametel" id="renametel" type="text" value="<?php echo ($lottery["renametel"]); ?>"/>
									<span class="form_tips">例如：QQ号,微信号,手机号等其他联系方式，不懂请别修改</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums">抽奖页面是否显示奖品数量</label></label>
									<div class="radio">
										<label>
											<input name="displayjpnums" value="0" type="radio" class="ace" <?php if($lottery['displayjpnums'] == 0): ?>checked<?php endif; ?>>
											<span class="lbl" style="z-index: 1">不显</span>
										</label>
										<label>
											<input name="displayjpnums" value="1" type="radio" class="ace" <?php if($lottery['displayjpnums'] == 1): ?>checked<?php endif; ?>>
											<span class="lbl" style="z-index: 1">显示</span>
										</label>
									</div>										
								</div>
								
								<!--div class="form-group">
									<label class="col-sm-1"><label for="canrqnums">注册后才能参与</label></label>
									<div class="radio">
										<label>
											<input name="needreg" value="0" type="radio" class="ace" <?php if($lottery['needreg'] == 0): ?>checked<?php endif; ?>>
											<span class="lbl" style="z-index: 1">不需要先注册</span>
										</label>
										<label>
											<input name="needreg" value="1" type="radio" class="ace" <?php if($lottery['needreg'] == 1): ?>checked<?php endif; ?>>
											<span class="lbl" style="z-index: 1">需要先注册</span>
										</label>
									</div>										
								</div -->				
								
								
								<?php if($ok_tips): ?><div class="form-group" style="margin-left:0px;">
										<span style="color:blue;"><?php echo ($ok_tips); ?></span>				
									</div><?php endif; ?>
								<?php if($error_tips): ?><div class="form-group" style="margin-left:0px;">
										<span style="color:red;"><?php echo ($error_tips); ?></span>				
									</div><?php endif; ?>
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											保存
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function preview1(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#img').attr('src', e.target.result);}
		reader.readAsDataURL(input.files[0]);
	}
}
function preview2(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#endimg').attr('src', e.target.result); }
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>
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