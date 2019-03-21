<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta charset="utf-8"><link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.imgbox.pack.js"></script><title><?php echo ($config["site_name"]); ?> - 社区中心</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script>	<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script><link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.css" type="text/css"><link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.ext.css" type="text/css"><script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>layer/layer.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>	<!--<link rel="stylesheet" href="<?php echo ($static_public); ?>boxer/css/jquery.fs.boxer.css">	<script src="<?php echo ($static_public); ?>boxer/js/jquery-1.8.3.min.js"></script>	<script src="<?php echo ($static_public); ?>boxer/js/jquery.fs.boxer.js"></script>-->	<!-- page specific plugin scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script>	<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!-- ace scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script><style type="text/css">.jqstooltip {	position: absolute;	left: 0px;	top: 0px;	visibility: hidden;	background: rgb(0, 0, 0) transparent;	background-color: rgba(0, 0, 0, 0.6);	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";	color: white;	font: 10px arial, san serif;	text-align: left;	white-space: nowrap;	padding: 5px;	border: 1px solid white;	z-index: 10000;}.jqsfield {	color: white;	font: 10px arial, san serif;	text-align: left;}.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {	display: none;}#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput	{	font-size: 12px;	color: black;	display: none;	width: 100%;}</style><script type="text/javascript">	try{ace.settings.check('navbar' , 'fixed')}catch(e){}	try{ace.settings.check('main-container' , 'fixed')}catch(e){}	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}</script></head><body class="no-skin">	<div id="navbar" class="navbar navbar-default">	<div class="navbar-container" id="navbar-container">		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">			<span class="sr-only">Toggle sidebar</span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>		</button>		<div class="navbar-header pull-left">			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 				<small> 					<img src="<?php echo ($config["site_merchant_waplogo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 社区中心				</small>			</a>		</div>		<div class="navbar-buttons navbar-header pull-right" role="navigation">			<ul class="nav ace-nav">				<li class="light-blue">					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /> 						<span class="user-info"> <small>欢迎您，</small> <?php echo ($house_session["village_name"]); ?></span> 						<i class="ace-icon fa fa-caret-down"></i>					</a>					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">						<li>							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">								<i class="ace-icon fa fa-link"></i> 网站首页							</a>						</li>						<li>							<a href="<?php echo U('Index/index');?>">								<i class="ace-icon fa fa-user"></i> 社区设置							</a>						</li>						<li class="divider"></li>						<li>							<a href="<?php echo U('Login/logout');?>"> 								<i class="ace-icon fa fa-power-off"></i> 退出							</a>						</li>					</ul>				</li>			</ul>		</div>	</div></div>	<div class="main-container" id="main-container">	<div id="sidebar" class="sidebar responsive">
	<?php if($village_arr != ''): ?><ul class="nav nav-list" style="top: 0px;">
			<?php if(is_array($village_arr)): $i = 0; $__LIST__ = $village_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["style_class"]); ?>">
					<a <?php if($vo['menu_list']): ?>href="#" class="dropdown-toggle"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>>
					<i class="menu-icon fa <?php echo ($vo["icon"]); ?>"></i>
					<span class="menu-text"><?php echo ($vo["name"]); ?></span>
					<b class="arrow fa fa-angle-down"></b>
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
	<?php else: ?>
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
		<li class="hsub <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('index','access_edit','deviceType','deviceType_edit','group','group_edit','userCheck','userCheck_edit','operatLog','operatLog_edit'))): ?>open active<?php endif; ?>">
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
			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('deviceType','deviceType_edit'))): ?>class="active"<?php endif; ?>>
			<a href="<?php echo U('Access/deviceType');?>">
				<i class="menu-icon fa fa-caret-right"></i> 设备类型列表
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
			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('visitorLog','visitorLog_edit'))): ?>class="active"<?php endif; ?>>
			<a href="<?php echo U('Access/visitorLog');?>">
				<i class="menu-icon fa fa-caret-right"></i>  访客登记记录
			</a>
			<b class="arrow"></b>
			</li>
			<li <?php if(MODULE_NAME == 'Access' && in_array(ACTION_NAME,array('operatLog','operatLog_edit'))): ?>class="active"<?php endif; ?>>
			<a href="<?php echo U('Access/operatLog');?>">
				<i class="menu-icon fa fa-caret-right"></i>  用户开门记录
			</a>
			<b class="arrow"></b>
			</li>
		</ul>
		</li>
		<!--2016.6.8
		门禁管理
		陈琦
		-->
		<li class="hsub <?php if(MODULE_NAME == 'VillageUser' && in_array(ACTION_NAME,array('index','VillageUserCheck_edit'))): ?>open active<?php endif; ?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text">管理员设置</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li <?php if(MODULE_NAME == 'VillageUser' && in_array(ACTION_NAME,array('index','VillageUserCheck_edit'))): ?>class="active"<?php endif; ?>>
			<a href="<?php echo U('VillageUser/index');?>">
				<i class="menu-icon fa fa-caret-right"></i> 管理员列表
			</a>
			<b class="arrow"></b>
			</li>
		</ul>
		</li>
		<!--2016.6.21
		用户管理
		陈琦
		-->
	</ul><?php endif; ?>
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
                <i class="ace-icon fa fa-tablet"></i>
                <a href="<?php echo U('VillageUser/index');?>">用户审核</a>
            </li>
            <li class="active">详情</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="">
                        <input  name="pigcms_id" type="hidden" value="<?php echo ($userCheck_info['pigcms_id']); ?>"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">微信名</label></label>
                                    <input class="col-sm-2" size="80" name="nickname" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['nickname']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">真实姓名</label></label>
                                    <input class="col-sm-2" size="80" name="name" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['name']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">手机号码</label></label>
                                    <input class="col-sm-2" size="80" name="phone" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['phone']); ?>"/>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">公司</label></label>
                                    <input class="col-sm-2" size="80" name="company" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['company']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">部门</label></label>
                                    <input class="col-sm-2" size="80" name="department" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['department']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">工牌号</label></label>
                                    <input class="col-sm-2" size="80" name="usernum" id="title" type="text" readonly="readonly" value="<?php echo ($userCheck_info['usernum']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">工牌图</label></label>
                                    <?php $workcard_img=explode('|',$userCheck_info['workcard_img']) ?>
                                   <?php if(is_array($workcard_img)): $k = 0; $__LIST__ = $workcard_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><img alt="" src="/upload/house/<?php echo ($img); ?>" width="70" height="110"  style="margin-left:20px;margin-top:10px;clear:both"  /><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">地址</label></label>
                                    <input class="col-sm-2" size="80" name="address" id="title" type="text" readonly="readonly"  value="<?php echo ($userCheck_info['address']); ?>"/>
                                </div>
                                <!--<div class="form-group">
                                    <label class="col-sm-1">审核结果</label>
                                    <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <?php if($userCheck_info['ac_status'] == 1): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;审核中</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="2" name="ac_status" type="radio"  onclick='document.getElementById("d1").style.display="none" ;' <?php if($userCheck_info['ac_status'] == 2 || $userCheck_info['ac_status'] == 4): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;通过</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <?php if($userCheck_info['ac_status'] == 3): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;未通过</label>
                                </div>-->
                                <div class="form-group" id="d1" style="display:none">
                                    <label class="col-sm-1"><label for="description">描述</label></label>
                                    <textarea id="description" name="ac_desc"  placeholder="描述内容"><?php echo (htmlspecialchars_decode($userCheck_info['ac_desc'],ENT_QUOTES)); ?></textarea>
                                </div>
                                <div class="space"></div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="button" onclick="window.location.href='<?php echo U('VillageUser/index');?>'">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            返回
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .ke-dialog-body .ke-input-text{height: 30px;}
</style>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K){
        kind_editor = K.create("#description",{
            width:'400px',
            height:'400px',
            resizeType : 1,
            allowPreviewEmoticons:false,
            allowImageUpload : true,
            filterMode: true,
            items : [
                'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link'
            ],
            emoticonsPath : './static/emoticons/',
            uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
        });
    });

    $(function(){

        $("#wc_img").imgbox({
            'speedIn'		: 0,
            'speedOut'		: 0,
            'alignment'		: 'center',
            'overlayShow'	: true,
            'allowMultiple'	: false
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
<!--陈琦
   2016.6.21-->