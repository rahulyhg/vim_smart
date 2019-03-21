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
				<i class="ace-icon fa fa-wechat"></i>
				<a href="<?php echo U('Weixin/index');?>">公众号设置</a>
			</li>
			<li class="active">自定义菜单</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<?php if(isset($weixin['code']) AND $weixin['code'] > 0): ?><div class="alert alert-info" style="margin-top:10px;">
							<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>【注意】触发方式选择[跳转网页]时[跳转网页地址]必填，消息关键词不要填写<br/>
							触发方式选择[发送消息]时[消息关键词]必填，跳转网页地址不要填写,如果填写错误会导致菜单生成失败或是少了菜单的问题！！！
						</div>
						
					<div>
						<form id="form1" name="form1" method="post" action="">
							<table class="table table-striped">
								<tbody>
									<tr>
										<th scope="col">菜单序号</th>
										<th scope="col">菜单名称</th>
										<th scope="col">触发方式</th>
										<th scope="col">消息关键词</th>
										<th scope="col">跳转网页地址</th>    
									</tr>
									<?php $__FOR_START_25325__=1;$__FOR_END_25325__=4;for($i=$__FOR_START_25325__;$i < $__FOR_END_25325__;$i+=1){ ?><tr class="parent" data-index="<?php echo ($i); ?>">
											<td><i class="ace-icon fa fa-plus"></i>　主菜单<?php echo ($i); ?></td>
											<td>
												<input name="custommenu[<?php echo ($i); ?>][title]" type="text" class="span2 title" id="<?php echo ($i); ?>_title" value="<?php if(isset($dlists[$i]['title'])): echo ($dlists[$i]['title']); endif; ?>">
												<input name="custommenu[<?php echo ($i); ?>][id]" type="hidden" class="span2 id" id="<?php echo ($i); ?>_id" value="<?php if(isset($dlists[$i]['id'])): echo ($dlists[$i]['id']); endif; ?>">
											</td>
											<td>
												<select name="custommenu[<?php echo ($i); ?>][wxsys]" class="span2" id="<?php echo ($i); ?>_wxsys">
													<option value="0" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 0)): ?>selected="selected"<?php endif; ?>>发送消息</option>
													<option value="1" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 1)): ?>selected="selected"<?php endif; ?>>跳转到网页</option>
													<!--option value="scancode_waitmsg" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'scancode_waitmsg')): ?>selected="selected"<?php endif; ?>>扫码带提示</option> 
													<option value="scancode_push" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'scancode_push')): ?>selected="selected"<?php endif; ?>>扫码推事件</option>
													<option value="pic_sysphoto" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'pic_sysphoto')): ?>selected="selected"<?php endif; ?>>系统拍照发图</option>
													<option value="pic_photo_or_album" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'pic_photo_or_album')): ?>selected="selected"<?php endif; ?>>拍照或者相册发图</option>
													<option value="pic_weixin" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'pic_weixin')): ?>selected="selected"<?php endif; ?>>微信相册发图</option>
													<option value="location_select" <?php if(isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] == 'location_select')): ?>selected="selected"<?php endif; ?>>发送位置</option-->
												</select>
											</td>
											<td><input name="custommenu[<?php echo ($i); ?>][keyword]" type="text" class="span2 keyword" id="<?php echo ($i); ?>_keyword" value="<?php if(isset($dlists[$i]['keyword'])): echo ($dlists[$i]['keyword']); endif; ?>"></td>
											<td><input name="custommenu[<?php echo ($i); ?>][url]" type="text" class="span3 url" id="<?php echo ($i); ?>_url" value="<?php if(isset($dlists[$i]['url'])): echo ($dlists[$i]['url']); endif; ?>">　　<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('<?php echo ($i); ?>_url',0)" data-toggle="modal">从功能库选择</a></td>
										</tr>
										<?php $__FOR_START_1314__=1;$__FOR_END_1314__=6;for($k=$__FOR_START_1314__;$k < $__FOR_END_1314__;$k+=1){ ?><tr class="childs_<?php echo ($i); ?> hidden">
											<td>子菜单<?php echo ($k); ?></td>
											<td>
												<input name="custommenu[<?php echo ($i * 10 + $k); ?>][title]" type="text" class="span2 title" id="<?php echo ($i * 10 + $k); ?>_title" value="<?php if(isset($dlists[$i]['list'][$k]['title'])): echo ($dlists[$i]['list'][$k]['title']); endif; ?>">
												<input name="custommenu[<?php echo ($i * 10 + $k); ?>][id]" type="hidden" class="span2 id" id="<?php echo ($i * 10 + $k); ?>_id" value="<?php if(isset($dlists[$i]['list'][$k]['id'])): echo ($dlists[$i]['list'][$k]['id']); endif; ?>">
											</td>
											<td>
												<select name="custommenu[<?php echo ($i * 10 + $k); ?>][wxsys]" class="span2" id="<?php echo ($i * 10 + $k); ?>_wxsys">
													<option value="0" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 0)): ?>selected="selected"<?php endif; ?>>发送消息</option>
													<option value="1" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 1)): ?>selected="selected"<?php endif; ?>>跳转到网页</option>
													<!--option value="scancode_waitmsg" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'scancode_waitmsg')): ?>selected="selected"<?php endif; ?>>扫码带提示</option> 
													<option value="scancode_push" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'scancode_push')): ?>selected="selected"<?php endif; ?>>扫码推事件</option>
													<option value="pic_sysphoto" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'pic_sysphoto')): ?>selected="selected"<?php endif; ?>>系统拍照发图</option>
													<option value="pic_photo_or_album" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'pic_photo_or_album')): ?>selected="selected"<?php endif; ?>>拍照或者相册发图</option>
													<option value="pic_weixin" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'pic_weixin')): ?>selected="selected"<?php endif; ?>>微信相册发图</option>
													<option value="location_select" <?php if(isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] == 'location_select')): ?>selected="selected"<?php endif; ?>>发送位置</option-->
												</select>
											</td>
											<td><input name="custommenu[<?php echo ($i * 10 + $k); ?>][keyword]" type="text" class="span2 keyword" id="<?php echo ($i * 10 + $k); ?>_keyword" value="<?php if(isset($dlists[$i]['list'][$k]['keyword'])): echo ($dlists[$i]['list'][$k]['keyword']); endif; ?>"></td>
											<td><input name="custommenu[<?php echo ($i * 10 + $k); ?>][url]" type="text" class="span2 url" id="<?php echo ($i * 10 + $k); ?>_url" value="<?php if(isset($dlists[$i]['list'][$k]['url'])): echo ($dlists[$i]['list'][$k]['url']); endif; ?>">　　<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('<?php echo ($i * 10 + $k); ?>_url',0)" data-toggle="modal">从功能库选择</a></td>
										</tr><?php } } ?>
								</tbody>
							</table>
							<div class="form-actions">
								<button class="btn btn-success" type="button" id="save_menu">保存</button>
							</div>
						</form>
					</div>
					<?php else: ?>
					<div>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							您当前的账号是<?php echo ($weixin['errmsg']); ?>,不能创建自定义菜单！
						</div>
					</div><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.ace-icon').click(function(){
		var index = $(this).parents('.parent').attr('data-index');
		$(this).toggleClass('fa-plus').toggleClass('fa-minus');
		$('.childs_' + index).toggleClass('hidden');
	});

	$('#save_menu').click(function(){
		var obj = $(this);
		$('.parent').each(function(i){
			var flag = false;
			if ($(this).find('.title').val() == '') {
				$('.childs_' + parseInt(i + 1)).each(function(k){
					if ($(this).find('.title').val() != '') {
						flag = true;
						return false;
					}
				});
			}
			if (flag) {
				alert('有不规范的数据，没有父菜单有了子菜单');
				return false;
			}
		});
		obj.attr('disabled', true).val('创建中...');
		$.post('/merchant.php?g=Merchant&c=Weixin&a=savemenu', $('#form1').serialize(), function(data){
			if (data.errcode) {
				obj.attr('disabled', false).val('保存');
				alert(data.errmsg);
			} else {
				alert(data.errmsg);
				setTimeout(location.reload(), 1000);
			}
		}, 'json');
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