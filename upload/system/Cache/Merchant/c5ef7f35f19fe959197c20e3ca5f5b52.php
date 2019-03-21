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
			<i class="ace-icon fa fa-comments-o comments-o-icon"></i>
			<li class="active">顾客管理</li>
			<li><a href="<?php echo U('Customer/fans_list');?>">粉丝列表</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<?php if($_GET['page'] < 2): ?><div class="widget-box">
							<div class="widget-header">
								<h5>统计图</h5>
							</div>
							<div class="widget-body" id="main" style="text-align:center;">
								<div style="float:left;width:49%;" id="behavior_chart">
								</div>
								<div style="float:left;" id="sex_chart">
								</div>
							</div>
							<div style="clear:both;"></div>
							<script type="text/javascript" src="<?php echo ($static_public); ?>fushionCharts/FusionCharts.js"></script>
							<script type="text/javascript">
								var chart_behavior = new FusionCharts("<?php echo ($static_public); ?>fushionCharts/Pie3D.swf", "ChartId", "600", "400", "0", "1");
								chart_behavior.setDataXML('<chart borderThickness="0" caption="7天内粉丝行为统计" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666"><?php if(is_array($chart_list)): $i = 0; $__LIST__ = $chart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><set label="<?php echo ($vo["name"]); ?>" value="<?php echo ($vo["count"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?></chart>');
								chart_behavior.render("behavior_chart");
								
								
								var chart_sex = new FusionCharts("<?php echo ($static_public); ?>fushionCharts/Pie3D.swf", "ChartId", "600", "400", "0", "1");
								chart_sex.setDataXML('<chart borderThickness="0" caption="粉丝性别比例图" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666"><set label="男性" value="<?php echo ($man_count); ?>"/><set label="女性" value="<?php echo ($woman_count); ?>"/><set label="未知性别" value="<?php echo ($unsexman_count); ?>"/></chart>');
								chart_sex.render("sex_chart");
							</script>
						</div>
						<div class="alert alert-danger" style="margin-top:5px;margin-bottom:0px;">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							粉丝 即指：扫描了商家二维码、<?php echo ($config["group_alias_name"]); ?>二维码、<?php echo ($config["meal_alias_name"]); ?>二维码等产生了与商家直接关系的用户。用户还必须在网站中注册帐号或绑定帐号才能显示在列表中！
						</div><?php endif; ?>
					
					<div class="alert alert-info" style="margin-top:5px;margin-bottom:0px;">
						<?php if(is_array($count_list)): $i = 0; $__LIST__ = $count_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i; if($cl['from_merchant'] == 0): ?><a href="<?php echo U('Customer/fans_list', array('from_merchant' => 0));?>">扫描商家产品二维码(<?php echo ($cl['count']); ?>)</a>　
						<?php elseif($cl['from_merchant'] == 1): ?><a href="<?php echo U('Customer/fans_list', array('from_merchant' => 1));?>">扫描商家二维码(<?php echo ($cl['count']); ?>)</a>　
						<?php elseif($cl['from_merchant'] == 2): ?><a href="<?php echo U('Customer/fans_list', array('from_merchant' => 2));?>">平台赠送(<?php echo ($cl['count']); ?>)</a>　
						<?php else: ?><a href="<?php echo U('Customer/fans_list', array('from_merchant' => 3));?>">扫描产品推广二维码(<?php echo ($cl['count']); ?>)</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="grid-view" style="padding-top:5px;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>会员ID</th>
									<th>会员昵称</th>
									<th>手机号</th>
									<th>性别</th>
									<th>省(直辖市)</th>
									<th>城市</th>
									<th>头像</th>
									<th width="150">关注时间</th>
									<th width="150">最后登录</th>
									<th width="150">获取渠道</th>
									<th style="text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if($fans_list): if(is_array($fans_list)): $i = 0; $__LIST__ = $fans_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="<?php if($i%2 == 0): ?>odd<?php else: ?>even<?php endif; ?>">
											<td><?php echo ($vo["uid"]); ?></td>
											<td><?php echo ($vo["nickname"]); ?></td>
											<td><?php echo ($vo["phone"]); ?></td>
											<td><?php switch($vo['sex']): case "1": ?>男<?php break; case "2": ?>女<?php break; default: ?>未知<?php endswitch;?></td>
											<td><?php echo ($vo["province"]); ?></td>
											<td><?php echo ($vo["city"]); ?></td>
											<td><?php if($vo['avatar']): ?><a href="<?php echo ($vo["avatar"]); ?>" target="_blank" class="view_img_frame"><img src="<?php echo ($vo["avatar"]); ?>" style="width:50px;" /></a><?php endif; ?></td>
											<td><?php echo (date('Y-m-d H:i:s',$vo["dateline"])); ?></td>
											<td><?php echo (date('Y-m-d H:i:s',$vo["last_time"])); ?></td>
											<td><?php if($vo['from_merchant'] == 0): ?>扫描商家产品二维码<?php elseif($vo['from_merchant'] == 1): ?>扫描商家二维码<?php elseif($vo['from_merchant'] == 2): ?>平台赠送<?php else: ?>扫描产品推广二维码<?php endif; ?></td>
											<td>
												<a style="width:80px;" class="label label-sm label-info" title="粉丝行为分析" href="<?php echo U('Customer/detail',array('uid'=>$vo['uid']));?>">粉丝行为分析</a> <!--a style="width: 60px;" class="label label-sm label-info" title="粉丝行为分析" href="<?php echo U('Customer/detail',array('uid'=>$vo['uid']));?>">粉丝行为分析</a-->
											</td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
									<tr class="odd"><td class="button-column" colspan="11" >暂无粉丝！</td></tr><?php endif; ?>
							</tbody>
						</table>
						<?php echo ($pagebar); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#group_id').change(function(){
			$('#frmselect').submit();
		});
	});
</script>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	$(function(){
		$('.view_img_frame').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看大头像',
				padding: 0,
				width: 640,
				height: 643,
				lock: true,
				resize: false,
				background:'black',
				button: null,
				fixed: false,
				close: null,
				left: '50%',
				top: '38.2%',
				opacity:'0.4'
			});
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