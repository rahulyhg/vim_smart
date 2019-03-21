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
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="<?php echo U('Card/index');?>">会员卡</a>
			</li>
			<li class="active">添加会员卡</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form class="form" method="post" action="" target="_top" enctype="multipart/form-data">
								<div class="content">
									<div class="msgWrap bgfc">
									<table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody>
									<tr>
									<th width="303" rowspan="6" valign="top">
										<div class="vipcard">
											<img id="cardbg" src="<?php if($card["diybg"] != ''): echo ($card["diybg"]); else: echo ($card["bg"]); endif; ?>">
											<img id="cardlogo" class="logo" src="<?php echo ($card["logo"]); ?>">
											<h1 id="vipname" style="color:<?php echo ($card["vipnamecolor"]); ?>;"><?php echo ($card["cardname"]); ?>会员卡</h1>
											<strong class="pdo verify" id="number" style="color:<?php echo ($card["numbercolor"]); ?>"><span><em>会员卡号</em>6537 1998</span></strong>
										</div>
										<span class="red">Logo宽370px高170px，背景图宽534px高318px，图片类型png。<a href="/static/images/cart_info/template.rar" class="green">请下载模板</a></span>
									</th>
									<td colspan="2">会员卡的名称：
									<input type="text" name="cardname" value="<?php echo ($card["cardname"]); ?>" id="cardname" class="px" style="width:200px;" onkeyup="DivFollowingText()"> 
									<script type="text/javascript">
									function DivFollowingText()
									{
									document.getElementById("vipname").innerHTML=document.getElementById("cardname").value+'会员卡';
									}
									</script> 
									颜色：
									<input type="text" name="vipnamecolor" id="vipnamecolor" value="<?php echo ($card["vipnamecolor"]); ?>" class="px color" style="width: 55px; background:<?php echo ($card["vipnamecolor"]); ?>; color: rgb(255, 255, 255);" onblur="document.getElementById('vipname').style.color=document.getElementById('vipnamecolor').value;">
									</td>
									</tr>
									<tr>
									<td colspan="2">最低积分要求：
									<input type="text" name="miniscore" id="miniscore" value="<?php echo ($card["miniscore"]); ?>" class="px" style="width:100px;">  只有到达(含)这个积分后才可以申领此卡</td>
									</tr>
									<tr>
									<td colspan="2">会员卡的图标：
									<input type="text" name="logo" id="logo" value="<?php echo ($card["logo"]); ?>" class="px" style="width:200px;"> 
									<input type="button" onclick="document.getElementById('cardlogo').src=document.getElementById('logo').value;" value="显示效果" class="btnGrayS"> 
									<a href="###" onclick="upyunPicUpload('logo',1000,600,'card')" class="a_upload">上传</a> 
									<a href="###" onclick="viewImg('logo')">预览</a>
									</td>
									</tr>
									<tr>
									<td colspan="2">会员卡的背景：
										<select name="bg" onchange="$('#cardbg').attr('src', $(this).val());" class="pt" style="width:210px;"> 
										<option selected="">请选择会员卡背景图</option>
											<?php  for($i=1;$i<=20;$i++){ $i=$i<10?'0'.$i:$i; $str='./static/images/card/card_bg'.$i.'.png'; if($card['bg']==$str){ echo $str='<option value="'.$str.'" selected="selected" >'.$i.'</option>'; }else{ echo $str='<option value="'.$str.'">'.$i.'</option>'; } } ?>
											
										</select>
										&nbsp;&nbsp;&nbsp;&nbsp;
										卡号文字颜色：
									<input type="text" name="numbercolor" id="numbercolor" value="<?php echo ($card["numbercolor"]); ?>" class="px color" style="width: 55px; background-image: none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onblur="document.getElementById('number').style.color=document.getElementById('numbercolor').value;">
									</td>
									</tr>
									<tr>
									<td colspan="2">自己设计背景：
										<input type="text" name="diybg" id="bgs" class="px" value="<?php echo ($card["diybg"]); ?>" style="width:200px;"> 
										<input type="button" onclick="$('#cardbg').attr('src', $('#bg').val());" value="显示效果" class="btnGrayS"> 
										<a href="###" onclick="upyunPicUpload('bgs',1000,600,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('bgs')">预览</a> 背景图<a href="#modal-table" class="btn btn-sm btn-success" onclick="selectImg('bgs','card')">选择图片</a>
									</td>
									</tr>
									<tr>
									<td colspan="2">
									首页提示文字：
									<input type="text" name="msg" value="<?php echo ($card["msg"]); ?>" id="tishi2" class="px" style="width:287px;" onkeyup="DivFollowingText2()"> 请不要超过20个字。
									<script type="text/javascript">
									function DivFollowingText2()
									{
										$("#tishi").html($("#tishi2").val());
									}
									</script>
									</td>
									</tr>
									<!--tr>
									<th width="303" rowspan="5" valign="top">
										<div class="vipcard">
											<h3>签到头部图片</h3>
											<img id="qiandao2_src" src="<?php if($card["qiandao"] != ''): echo ($card["qiandao"]); else: ?>/static/images/cart_info/qiandao.jpg<?php endif; ?>" style="width:265px;height:150px;">
											<br />
											<textarea name="qiandao" class="col-sm-3" id="qiandao2" style="width:265px; height:35px" onblur="document.getElementById('qiandao2_scr').src=document.getElementById('qiandao2').value;"><?php if($card["qiandao"] != ''): echo ($card["qiandao"]); else: ?>/static/images/cart_info/qiandao.jpg<?php endif; ?></textarea>
											<br />
											<a href="###" onclick="upyunPicUpload('qiandao2',700,420,'card')" class="a_upload">上传</a> 
											<a href="###" onclick="viewImg('qiandao2')">预览</a>
										</div>
									</th>
									<td colspan="2"></td>
									<td colspan="2">
									是否短信验证：
									<input type="radio" class="px" name="is_check" value="0" <?php if($card["is_check"] == 0): ?>checked<?php endif; ?>>不验证&nbsp;&nbsp;
									<input type="radio" class="px" name="is_check" value="1" <?php if($card["is_check"] == 1): ?>checked<?php endif; ?>>验证  &nbsp;&nbsp;(选择后，用户领取会员卡时则必须验证，注：使用此功能必须购买短信服务)
									</td>
									</tr-->
									<tr>
									<td colspan="2">
									会员卡使用说明：<br />
									<textarea class="col-sm-3" id="info" name="info" style="width: 300px; height: 150px; display: none;"><?php echo ($card["info"]); ?></textarea>
									</td>
									</tr>
									<tr>
									<td colspan="2"><button type="submit" class="btn btn-success">保存</button></td>
									</tr>
									</tbody>
									</table>
									</div> 
									<!--div class="cLineB">
										<h4 style="margin-left: 96px;">各内容页头部Benner图片设置<span class="FAQ">根据你企业的特色设计内容页头部图片，完全展示出不同的会员卡风格。</span></h4>
									</div> 
									<div class="msgWrap bgfc">
								 
								  	<table class="userinfoArea" style=" margin: 0;" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody>
									 <tr>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/news-2.jpg">
												<img id="news2_src" src="<?php echo ($card["Lastmsg"]); ?>">
												<img src="/static/images/cart_info/news-3.jpg">
											</div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/vippower-2.jpg">
												<img id="vippower2_src" src="<?php echo ($card["vip"]); ?>">
												<img src="/static/images/cart_info/vippower-3.jpg"></div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/payre.jpg">
												<img id="payre2_src" src="<?php echo ($card["payrecord"]); ?>">
												<img src="/static/images/cart_info/payre-3.jpg">
											</div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/shopping-2.jpg">
												<img id="shopping2_src" src="<?php echo ($card["shopping"]); ?>">
												<img src="/static/images/cart_info/shopping-3.jpg">
											</div>
										</td>
									</tr>
								<tr>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								</tr>
								<tr>
									<td align="center">
										<textarea name="Lastmsg" class="px" id="news2" style="width:210px; height:36px" onblur="document.getElementById('news2_src').src=document.getElementById('news2').value;"><?php echo ($card["Lastmsg"]); ?></textarea><br>
										<a href="###" onclick="upyunPicUpload('news2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('news2')">预览</a>
									</td>
									<td align="center">
										<textarea name="vip" class="px" id="vippower2" style="width:210px; height:36px" onblur="document.getElementById('vippower2_src').src=document.getElementById('vippower2').value;"><?php echo ($card["vip"]); ?></textarea><br>
										<a href="###" onclick="upyunPicUpload('vippower2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('vippower2')">预览</a>
									</td>
									<td align="center">
										<textarea name="payrecord" class="px" id="payre2" style="width:210px; height:36px" onblur="document.getElementById('payre2_src').src=document.getElementById('payre2').value;"><?php echo ($card["payrecord"]); ?></textarea><br>
										<a href="###" onclick="upyunPicUpload('payre2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('payre2')">预览</a>
									</td>
									<td align="center">
										<textarea name="shopping" class="px" id="shopping2" style="width:210px; height:36px" onblur="document.getElementById('shopping2_src').src=document.getElementById('shopping2').value;"><?php echo ($card["shopping"]); ?></textarea><br>
										<a href="###" onclick="upyunPicUpload('shopping2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('shopping2')">预览</a>
									</td>
								 </tr>
								<tr>
								<td></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/user-2.jpg">
										<img id="user2_src" src="<?php echo ($card["memberinfo"]); ?>">
										<img src="/static/images/cart_info/user-3.jpg">
									</div>
								</td>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/info-2.jpg">
										<img id="info2_src" src="<?php echo ($card["membermsg"]); ?>">
										<img src="/static/images/cart_info/info-3.jpg">
									</div>
								</td>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/addr-2.jpg">
										<img id="addr2_src" src="<?php echo ($card["contact"]); ?>">
										<img src="/static/images/cart_info/addr-3.jpg">
									</div>
								</td>
								 <td align="center" valign="middle">
								 	<div class="banner">
										<img src="/static/images/cart_info/rech.jpg">
										<img id="rech2_src" src="<?php echo ($card["recharge"]); ?>">
										<img src="/static/images/cart_info/rech-3.jpg">
									</div>
								</td> 
								</tr>
								<tr>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td align="center">
									<textarea name="memberinfo" class="px" id="user2" style="width:210px; height:36px" onblur="document.getElementById('user2_src').src=document.getElementById('user2').value;"><?php echo ($card["memberinfo"]); ?></textarea><br>
									<a href="###" onclick="upyunPicUpload('user2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('user2')">预览</a>
								</td>
								<td align="center">
									<textarea name="membermsg" class="px" id="info2" style="width:210px; height:36px" onblur="document.getElementById('info2_src').src=document.getElementById('info2').value;"><?php echo ($card["membermsg"]); ?></textarea><br>
									<a href="###" onclick="upyunPicUpload('info2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('info2')">预览</a>
								</td>
								<td align="center">
									<textarea name="contact" class="px" id="addr2" style="width:210px; height:36px" onblur="document.getElementById('addr2_src').src=document.getElementById('addr2').value;"><?php echo ($card["contact"]); ?></textarea><br>
									<a href="###" onclick="upyunPicUpload('addr2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('addr2')">预览</a>
								</td>
								<td align="center">
									<textarea name="recharge" class="px" id="rech2" style="width:210px; height:36px" onblur="document.getElementById('rech2_src').src=document.getElementById('rech2').value;"><?php echo ($card["recharge"]); ?></textarea><br>
									<a href="###" onclick="upyunPicUpload('rech2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('rech2')">预览</a>
								</td>
								</tr>
								<tr>
								<td colspan="4" align="center"><button type="submit" class="btn btn-success">保存</button></td>
								</tr>
								</tbody>
								</table>
								</div--> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script src="/static/js/cart/jscolor.js" type="text/javascript"></script>
<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<style type="text/css">
.vipcard{
margin: 0 auto;
position: relative;
height: 159px;
text-align: left;
width: 267px;
}
#cardbg{
height: 159px;
width: 267px;
position:absolute;
border-radius: 8px;
-webkit-border-radius:8px;
-moz-border-radius:8px;
box-shadow: 0 0 4px rgba(0, 0, 0, 0.6);
-moz-box-shadow:0 0 4px rgba(0, 0, 0, 0.6);
-webkit-box-shadow:0 0 8px rgba(0, 0, 0, 0.6);
top:0;
left:0;
z-index:1;
}
.vipcard .logo {
max-height:70px;
position:absolute;
top:8px;
left:5px;
z-index:2;
}
.vipcard .verify {
display:inline-block;
height:40px;
top:105px;
right:12px;
text-align:right;
line-height:24px;
color:#000;
font-size:20px;
text-shadow:0 1px rgba(255, 255, 255, 0.2);
z-index:2;
}

.vipcard h1 {
position:absolute;
right:10px;
top:7px;
text-shadow:0 1px rgba(255, 255, 255, 0.2);
color:#000;
font-size:11px;
line-height:25px;
text-align:right;
font-weight: normal;
z-index:2;
}
.vipcard .verify span {
display:inline-block;
text-align:left;
}
.vipcard .verify em {
display:block;
line-height:13px;
font-size:10px;
font-weight:normal;
font-style:normal;
}
.pdo {
position:absolute;
top:0;
left:0;
display:inline-block;
}
.userinfoArea td {
    padding: 8px 0 0px 15px;
}
#tishi{
text-align: center;display: block;
}
.banner{
display:block; width:213px;height: 278px;overflow: hidden;
}
.banner img{
display:block; width:213px; border:0;
}
.bannerbtn{ position:relative; display:block}
.bannerbtn .qiaodaobtn{ position: absolute; display:block; bottom:0}

</style>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#info', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
items : [
'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist','link', 'unlink','']
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