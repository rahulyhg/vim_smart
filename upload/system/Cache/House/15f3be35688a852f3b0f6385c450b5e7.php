<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta charset="utf-8"><link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.imgbox.pack.js"></script><title><?php echo ($config["site_name"]); ?> - 社区中心</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script><link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.css" type="text/css"><link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.ext.css" type="text/css"><script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>layer/layer.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script><!-- page specific plugin scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script><!-- ace scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script><style type="text/css">.jqstooltip {	position: absolute;	left: 0px;	top: 0px;	visibility: hidden;	background: rgb(0, 0, 0) transparent;	background-color: rgba(0, 0, 0, 0.6);	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";	color: white;	font: 10px arial, san serif;	text-align: left;	white-space: nowrap;	padding: 5px;	border: 1px solid white;	z-index: 10000;}.jqsfield {	color: white;	font: 10px arial, san serif;	text-align: left;}.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {	display: none;}#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput	{	font-size: 12px;	color: black;	display: none;	width: 100%;}</style><script type="text/javascript">	try{ace.settings.check('navbar' , 'fixed')}catch(e){}	try{ace.settings.check('main-container' , 'fixed')}catch(e){}	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script></head><body class="no-skin">	<div id="navbar" class="navbar navbar-default">	<div class="navbar-container" id="navbar-container">		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">			<span class="sr-only">Toggle sidebar</span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>		</button>		<div class="navbar-header pull-left">			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 				<small> 					<img src="<?php echo ($config["site_merchant_waplogo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 社区中心				</small>			</a>		</div>		<div class="navbar-buttons navbar-header pull-right" role="navigation">			<ul class="nav ace-nav">				<li class="light-blue">					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /> 						<span class="user-info"> <small>欢迎您，</small> <?php echo ($house_session["village_name"]); ?></span> 						<i class="ace-icon fa fa-caret-down"></i>					</a>					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">						<li>							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">								<i class="ace-icon fa fa-link"></i> 网站首页							</a>						</li>						<li>							<a href="<?php echo U('Index/index');?>">								<i class="ace-icon fa fa-user"></i> 社区设置							</a>						</li>						<li class="divider"></li>						<li>							<a href="<?php echo U('Login/logout');?>"> 								<i class="ace-icon fa fa-power-off"></i> 退出							</a>						</li>					</ul>				</li>			</ul>		</div>	</div></div>	<div class="main-container" id="main-container">	<div id="sidebar" class="sidebar responsive">

	<ul class="nav nav-list" style="top: 0px;">

		<li class="hsub <?php if(MODULE_NAME == 'Index' && ACTION_NAME == 'index'): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-gear"></i>

				<span class="menu-text">基本信息管理</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(strpos(ACTION_NAME,'index') !== false): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Index/index');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> 基本信息设置

					</a>

					<b class="arrow"></b>

				</li>					

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'User' && in_array(ACTION_NAME,array('index','user_import','detail_import','edit','orders','pay_detail'))): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-group"></i>

				<span class="menu-text">业主列表</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'User' && in_array(ACTION_NAME,array('index','user_import','detail_import','edit','orders','pay_detail'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('User/index');?>">

						<i class="menu-icon fa fa-caret-right"></i> 业主列表

					</a>

					<b class="arrow"></b>

				</li>

			</ul>

		</li>

		<li class="hsub <?php if((MODULE_NAME == 'News' && in_array(ACTION_NAME,array('reply','suggess'))) || (MODULE_NAME == 'Repair' && in_array(ACTION_NAME,array('suggess')))): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-comments-o"></i>

				<span class="menu-text">业主交流</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'News' && in_array(ACTION_NAME,array('reply'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('News/reply');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> 新闻评论列表

					</a>

					<b class="arrow"></b>

				</li>

				<li <?php if(MODULE_NAME == 'Repair' && in_array(ACTION_NAME,array('suggess'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Repair/suggess');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> 投诉建议列表

					</a>

					<b class="arrow"></b>

				</li>

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'Index' && strpos(ACTION_NAME,'active') !== false): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-empire"></i>

				<span class="menu-text">推荐活动管理</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'Index' && in_array(ACTION_NAME,array('active_group_list','active_group'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Index/active_group_list');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> <?php echo ($config["group_alias_name"]); ?>列表

					</a>

					<b class="arrow"></b>

				</li>

				<li <?php if(MODULE_NAME == 'Index' && in_array(ACTION_NAME,array('active_meal_list','active_meal'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Index/active_meal_list');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> <?php echo ($config["meal_alias_name"]); ?>列表

					</a>

					<b class="arrow"></b>

				</li>	

				<li <?php if(MODULE_NAME == 'Index' && in_array(ACTION_NAME,array('active_appoint_list','active_appoint','active_appoint_edit'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Index/active_appoint_list');?>"> 

						<i class="menu-icon fa fa-caret-right"></i> 预约列表

					</a>

					<b class="arrow"></b>

				</li>				

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'News' && in_array(ACTION_NAME,array('index','news_edit','cate','cate_edit'))): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-newspaper-o"></i>

				<span class="menu-text">新闻管理</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'News' && in_array(ACTION_NAME,array('index','news_edit'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('News/index');?>">

						<i class="menu-icon fa fa-caret-right"></i> 新闻列表

					</a>

					<b class="arrow"></b>

				</li>	

				<li <?php if(MODULE_NAME == 'News' && in_array(ACTION_NAME,array('cate','cate_edit'))): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('News/cate');?>">

						<i class="menu-icon fa fa-caret-right"></i> 新闻分类设置

					</a>

					<b class="arrow"></b>

				</li>				

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'CommonPhone' && in_array(ACTION_NAME,array('cp_index','cp_edit','cp_del','ct_index','ct_edit','ct_del'))): ?>open active<?php endif; ?>">

		<a href="#" class="dropdown-toggle">

			<i class="menu-icon fa fa-tablet"></i>

			<span class="menu-text">常用号码</span>

			<b class="arrow fa fa-angle-down"></b>

		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li <?php if(MODULE_NAME == 'CommonPhone' && in_array(ACTION_NAME,array('cp_index','cp_edit'))): ?>class="active"<?php endif; ?>>

			<a href="<?php echo U('CommonPhone/cp_index');?>">

				<i class="menu-icon fa fa-caret-right"></i> 常用号码管理列表

			</a>

			<b class="arrow"></b>

			</li>

			<li <?php if(MODULE_NAME == 'CommonPhone' && in_array(ACTION_NAME,array('ct_index','ct_edit','ct_del'))): ?>class="active"<?php endif; ?>>

			<a href="<?php echo U('CommonPhone/ct_index');?>">

				<i class="menu-icon fa fa-caret-right"></i> 常用号码分类设置

			</a>

			<b class="arrow"></b>

			</li>

		</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'Repair' && ACTION_NAME == 'index'): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-file-excel-o"></i>

				<span class="menu-text">在线报修设置</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'Repair' && ACTION_NAME == 'index'): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Repair/index');?>">

						<i class="menu-icon fa fa-caret-right"></i> 在线报修列表

					</a>

					<b class="arrow"></b>

				</li>					

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'Repair' && ACTION_NAME == 'water'): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-tasks"></i>

				<span class="menu-text">水电煤上报列表</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'Repair' && ACTION_NAME == 'water'): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('Repair/water');?>">

						<i class="menu-icon fa fa-caret-right"></i> 水电煤上报列表

					</a>

					<b class="arrow"></b>

				</li>					

			</ul>

		</li>

		<li class="hsub <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'village_order'): ?>open active<?php endif; ?>">

			<a href="#" class="dropdown-toggle"> 

				<i class="menu-icon fa fa-shopping-cart"></i>

				<span class="menu-text">在线缴费订单列表</span>

				<b class="arrow fa fa-angle-down"></b>

			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li <?php if(MODULE_NAME == 'User' && ACTION_NAME == 'village_order'): ?>class="active"<?php endif; ?>>

					<a href="<?php echo U('User/village_order');?>">

						<i class="menu-icon fa fa-caret-right"></i> 在线缴费订单列表

					</a>

					<b class="arrow"></b>

				</li>					

			</ul>

		</li>


		<li class="hsub <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('index','access_edit','group','group_edit','userCheck','userCheck_edit'))): ?>open active<?php endif; ?>">

		<a href="#" class="dropdown-toggle">

			<i class="menu-icon fa fa-key"></i>

			<span class="menu-text">智能门禁管理</span>

			<b class="arrow fa fa-angle-down"></b>

		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('index','access_edit'))): ?>class="active"<?php endif; ?>>

			<a href="<?php echo U('Access/index');?>">

				<i class="menu-icon fa fa-caret-right"></i> 门禁设备列表

			</a>

			<b class="arrow"></b>

			</li>

			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('group','group_edit'))): ?>class="active"<?php endif; ?>>

			<a href="<?php echo U('Access/group');?>">

				<i class="menu-icon fa fa-caret-right"></i> 门禁区域管理

			</a>

			<b class="arrow"></b>

			</li>

			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('userCheck','userCheck_edit'))): ?>class="active"<?php endif; ?>>

			<a href="<?php echo U('Access/userCheck');?>">

				<i class="menu-icon fa fa-caret-right"></i>  用户资料审核

			</a>

			<b class="arrow"></b>

			</li>

		</ul>

		</li>
		<!--2016.6.8
		    陈琦
		-->

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
                <i class="ace-icon fa fa-group"></i>
                <a href="<?php echo U('User/index');?>">业主管理</a>
            </li>
            <li class="active">导入业主每月帐单明细</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
    	<form id="myform" method="post" action="<?php echo U('User/detail_import');?>" enctype="multipart/form-data">
        <div class="page-content-area">
        <input class="col-sm-2 Wdate" type="text" name="paytime" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月',vel:'start_time'})" value="<?php echo date('Y年m月',$_SERVER['REQUEST_TIME']);?>"/>
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                    
						<input type="hidden" name="cat_id" value="<?php echo ($now_category["cat_id"]); ?>"/>
						<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" width="100%">
							<tr>
								<th width="80">示例表格</th>
								<td><a target="_blank" href="<?php echo ($static_public); ?>file/user_detail_sample.xls" class="button" style="margin-left:0px;">点击下载</a></td>
							</tr>
							<tr>
								<th width="80">Excel导入</th>
								<td><input type="file" class="input fl" name="pic" style="width:200px;" placeholder="请上传excel表格" validate="required:true"/></td>
							</tr>
						</table>
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									保存
								</button>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
 		</form>
    </div>
</div>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>
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