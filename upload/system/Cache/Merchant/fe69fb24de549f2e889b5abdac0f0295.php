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
	<div id="navbar" class="navbar navbar-default">	<div class="navbar-container" id="navbar-container">		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">			<span class="sr-only">Toggle sidebar</span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>		</button>		<div class="navbar-header pull-left">			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 				<small> 					<img src="<?php echo ($config["site_merchant_waplogo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 商家中心				</small>			</a>		</div>		<div class="navbar-buttons navbar-header pull-right" role="navigation">			<ul class="nav ace-nav">				<!--li class="red">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 						<span class="badge badge-important">0</span>					</a>					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单						</li>						<li class="dropdown-footer">							<a href="#">查看全部未处理订单 								<i class="ace-icon fa fa-arrow-right"></i>							</a>						</li>					</ul>				</li>				<li class="green">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 						<span class="badge badge-success">0</span>					</a>							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新留言							</a>						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新评论							</a>						</li>						<li></li>					</ul>				</li-->				<li class="light-blue">					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 						<?php if($merchant_session['img_info']): ?><img class="nav-user-photo" src="<?php echo ($merchant_session["img"]); ?>" alt="Jason&#39;s Photo" />						<?php else: ?>						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /><?php endif; ?>						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 						<i class="ace-icon fa fa-caret-down"></i>					</a>					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">						<li>							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">								<i class="ace-icon fa fa-link"></i> 网站首页							</a>						</li>						<!--li>							<a href="#">								<i class="ace-icon fa fa-share-alt"></i> 推荐好友							</a>						</li-->						<li>							<a href="<?php echo U('Config/merchant');?>">								<i class="ace-icon fa fa-user"></i> 商家设置							</a>						</li>						<!--li>							<a href="<?php echo U('Pay/index');?>"> 								<i class="ace-icon fa fa-smile-o"></i> 对帐平台							</a>						</li-->						<li class="divider"></li>						<li>							<a href="<?php echo U('Login/logout');?>"> 								<i class="ace-icon fa fa-power-off"></i> 退出							</a>						</li>					</ul>				</li>			</ul>		</div>	</div></div>
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
			<li class="active">商家设置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<link href="<?php echo ($static_path); ?>css/animate_new.css" rel="stylesheet">
	<!--<link href="<?php echo ($static_path); ?>css/cashier.css" rel="stylesheet">-->	<!----开放式头部，请在自己的页面加上--</head>-->
	<link href="<?php echo ($static_path); ?>plugins/css/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo ($static_path); ?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">
	<!--<link href="<?php echo ($static_path); ?>css/app.css" rel="stylesheet">-->
	<script src="<?php echo ($static_path); ?>plugins/js/sweetalert/sweetalert.min.js"></script>
	<style>
		.ibox{
		 	border: 1px solid #e7eaec;
		}
		.part_item {
  			background: none repeat scroll 0 0 #fff;
  			border: 1px solid #ccc;
  			border-radius: 5px;
  			padding-bottom: 15px;
  			margin-bottom: 10px;
		}
		.form .part_item p {
  			display: inline-block;
  			font-size: 14px;
  			overflow: hidden;
  			padding: 10px 20px 0;
  			text-overflow: ellipsis;
  			white-space: nowrap;
		}
		.part_item_b {
  			border-top: 1px solid #ccc;
  			margin-top: 10px;
		}
		.form .part_item p.active {
  			color: #f87b00;
		}
		.part_item input {
  			font-size: 14px;
  			margin-bottom: 2px;
  			margin-right: 5px;
		}
		.pagination{
			margin:0px;
		}
		.mustInput {
  			color: red;
  			margin-right: 5px;
		}
		@media (min-width: 768px){
			.form .part_item p {
				width: 37%;
			}
		}
		@media (min-width: 992px){
			.form .part_item p {
				width: 24%;
			}
		}
		.form-control, .single-line{width: 50%;}
	</style>
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<!--<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="搜索员工">-->
								<form action='<?php echo U("Cashier/employersDel");?>' class="employersDelAll" method="post">
								<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
									<thead>
									<tr>
										<th data-sort-ignore="true" class="check-mail"><input type="checkbox" class="i-checks" id="check_box"></th>
										<th>员工名称</th>
										<th data-hide="phone">登录账号</th>
										<th data-hide="phone">状态</th>
										<th data-sort-ignore="true">操作</th>
									</tr>
									</thead>
									<tbody>
									<?php if(!empty($employees)){ foreach($employees as $key=>$val){ ?>
									<tr>
										<td class="check-mail"><input type="checkbox" class="i-checks" value="<?php echo $val['eid'];?>" name="id[]"></td>
										<td><?php echo $val['username'];?></td>
										<td><?php echo $val['account'];?></td>
										<td>
											<div class="switch">
												<div class="onoffswitch">
													<input type="checkbox" <?php if($val['status'] == 1){ echo 'checked'; }?> class="status-checkbox onoffswitch-checkbox" data-id="<?php echo $val['eid'];?>" id="example<?php echo $val['eid'];?>">
													<label class="onoffswitch-label" for="example<?php echo $val['eid'];?>">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</td>
										<td class="center">
											<div class="btn-group">
												<a href="javascript:void(0)" class="btn btn-white btn-sm employersEdit" data-id="<?php echo $val['eid'];?>"><i class="fa fa-pencil"></i> 编辑</a>
												<a href="javascript:void(0)" class="btn btn-white btn-sm employersDel" data-id="<?php echo $val['eid'];?>"><i class="fa fa-times"></i> 删除</a>
											</div>
										</td>
									</tr>
									<?php }}else{ ?>
									<tr><td colspan="4" style="text-align: center; font-size: 16px;">您还没有员工,请添加</td></tr>
									<?php }?>
									</tbody>
								</table>
								</form>
								<div class="tooltip-demo">
									<button class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal5" data-toggle="tooltip" data-placement="left" title="" data-original-title="添加员工"><i class="fa fa-plus"></i> 添加</button>
									<button class="btn btn-white btn-sm info_del_all" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除员工"><i class="fa fa-trash-o"></i> </button>
									<ul class="pagination pull-right"></ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg">
        	<div class="modal-content">
            	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加员工</h4>
                </div>
                <div class="modal-body clearfix">
					<form id="employersForm" class="form" action='<?php echo U("Cashier/merchantOperat");?>' method="post">
						<div class="col-lg-12">
							<div class="ibox">
                        		<div class="ibox-title">
                           			<h5>账户信息</h5>
                        		</div>
                        		<div class="ibox-content">
                            		<div class="form-group">
										<label><span class="mustInput">*</span>员工名称:<span class="f999">(20字以内)</span></label>
										<input type="text"  id="username" placeholder="请输入员工名称" name="username" class="form-control required" aria-required="true">
									</div>
									<div class="form-group">
										<label><span class="mustInput">*</span>登录账号:</label>
										<input type="text" id="account" placeholder="请输入登录账号" name="account" class="form-control required"aria-required="true">
									</div>
									<div class="form-group">
										<label><span class="mustInput">*</span>邮箱:</label>
										<input type="email" id="email" placeholder="请输入邮箱" name="email" class="form-control required" aria-required="true">
									</div>
									<div class="form-group">
										<label><span class="mustInput">*</span>密码:</label>
										<input type="password" id="password" placeholder="请输入密码(6到20个字符)" name="password" class="form-control required" aria-required="true">
									</div>
									<div class="form-group">
										<label><span class="mustInput">*</span>确认密码:<span class="f999"></span></label>
										<input type="password" id="confirm" placeholder="" name="confirm" class="form-control required" aria-required="true">
									</div>
                        		</div>
                    		</div>
						</div>
						<div class="col-lg-12">
							<div class="ibox">
                    	    	<div class="ibox-title">
                    	       		<h5>权限设置</h5>
                    	    	</div>
                    	    	<div class="ibox-content">
                    	        	<div id="permission_list">
										<?php foreach($authority as $key=>$val){ ?>
											<div class="part_item">
												<div class="part_item_t">
													<p><b><input type="checkbox" class="checkAll"><?php echo $val['Des'];unset($val['Des']);?></b></p>
												</div>
												<div class="part_item_b">
													<?php foreach($val as $k=>$v){?>
														<p><input type="checkbox" name="authority[]" value="<?php echo 'Merchants/User/'.$key.'/'.$k;?>"><?php echo $v; ?></p>
													<?php } ?>
												</div>
											</div>
										<?php } ?>
									</div>
                    	    	</div>
                    		</div>
						</div>
					</form>
               	</div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                	<button type="button" class="btn btn-primary formSubmit">保存</button>
                </div>
          	</div>
        </div>
    </div>
	
	<a href="javascript:void(0)" class="employersEditJump"  data-toggle="modal" data-target="#myModal6" data-toggle="tooltip" data-placement="left" title="" data-original-title="员工信息编辑" style="display: none;">员工信息编辑</a>
	<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg">
        	<div class="modal-content">
            	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">员工信息编辑</h4>
                </div>
                <div class="modal-body clearfix">
					<div class="col-lg-12">
					</div>
               	</div>
				<div class="modal-footer">
                	<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                </div>
          	</div>
        </div>
     </div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/html" id="employersEditTpl">
	<figure>
        <iframe width="425" height="349" src="?g=Merchant&c=Cashier&a=merchantOperat&eid={($eid)}" frameborder="0"></iframe>
    </figure>
</script>
<!-- FooTable -->
<script src="<?php echo ($static_path); ?>plugins/js/footable/footable.all.min.js"></script>
<!-- iCheck -->
<script src="<?php echo ($static_path); ?>plugins/js/iCheck/icheck.min.js"></script>
<!-- Jquery Validate -->
<script src="<?php echo ($static_path); ?>plugins/js/validate/jquery.validate.min.js"></script>
<!-- Page-Level Scripts -->
<script>
	$(document).ready(function() {
		employers.init();
	});
	!function(a,b){
		var employers = employers || {};
		employers.init = function(){
			var c = employers;
			b('.footable').footable();
			b('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
			b('#check_box').on('ifChanged', function(){
				c.selectall('id[]','check_box');
			});
			b('.info_del_all').click(function(){
				c.delAll();
			});
			b('.part_item .checkAll').click(function(){
				var checkItems = b(this).parents('.part_item_t').siblings('.part_item_b').find('p').find('input[name="authority[]"]');
				if (b(this).is(':checked') == false) {
					checkItems.each(function(ke,el){
						$(el).iCheck('uncheck');
					});
				}else{
					checkItems.each(function(ke,el){
						$(el).iCheck('check');
					});
				}
			});
			jQuery.extend(jQuery.validator.messages, {
				required: "必填字段",
				remote: "请修正该字段",
				email: "请输入正确格式的电子邮件",
				equalTo: "请再次输入相同的值",
				maxlength: jQuery.validator.format("请输入一个长度最多是 {0} 的字符串"),
				minlength: jQuery.validator.format("请输入一个长度最少是 {0} 的字符串"),
			});
			b('#employersForm').validate({
				errorPlacement: function (error, element){
						element.before(error);
				},
				rules: {
					confirm: {
						equalTo: "#password"
					},
					account: {
						minlength: 4
					},
					password: {
						minlength: 4
					}
				}
			});
			b('.formSubmit').click(function(){
				if(b('#account').val() != ''){
					$.post('<?php echo U("Cashier/merchant");?>',{account:b('#account').val()},function(re){
						if(re.status == 0){
							b('#account').addClass('error');
							swal("错误", re.msg+" :)", "error");
						}else if(re.status == 1){
							b('#employersForm').submit();
						}
					},'json');
				}else{
					b('#employersForm').submit();
				}
			});
			b('.status-checkbox').change(function(){
				var i = b(this).attr('data-id'),s = b(this).is(':checked') ? 1 : 0;
				$.post('<?php echo U("Cashier/employersField");?>',{eid:i,status:s},function(re){
					if(re.status == 0){
						swal("错误", re.msg+" :)", "error");
					}
				},'json');
			});
			b('.employersDel').click(function(){
				var c = b(this);
				swal({
					title: "是否删除这条数据?",
					text: "删除数据后将无法恢复，确认要删除吗！",
					type: "warning",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "删除",
					cancelButtonText: "取消",
					closeOnConfirm: false,
					showCancelButton: true,
				}, function (){
					$.post('<?php echo U("Cashier/employersDel");?>',{eid:c.attr('data-id')},function(re){
						if(re.status == 0){
							swal("错误", re.msg+" :)", "error");
						}else{
							swal("成功", re.msg+" :)", "success");
							c.parents('tr').remove();
							b('.footable').footable();
						}
					},'json');
				});
			});
			b('.employersEdit').click(function(){
				c.edit(b(this).attr('data-id'));
			});
		};
		employers.selectall = function(name,id){
			var checkItems = b('input[name="'+name+'"]');
			if ($("#"+id).is(':checked') == false) {
				checkItems.each(function(ke,el){
					$(el).iCheck('uncheck');
				});
			}else{
				checkItems.each(function(ke,el){
					$(el).iCheck('check');
				});
			}
		}
		employers.delAll = function(){
			swal({
				title: "是否删除选中?",
				text: "删除数据后将无法恢复，确认要删除吗！",
				type: "warning",
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "删除",
				cancelButtonText: "取消",
				closeOnConfirm: false,
				showCancelButton: true,
			}, function (){
				var checkItems = b('input[name="id[]"]'),c = false;
		
				checkItems.each(function(ke,el){
					if($(el).is(':checked') == true){
						c = true;
					}
				});
				if(c == false){
					swal("错误", "你至少需要选中一项 :)", "error");
					return false;
				}
				$('.employersDelAll').submit();
			});
		}
		employers.edit = function(data){
			var $data = b('#employersEditTpl').html().replace('{($eid)}',data);
			b('#myModal6').find('.modal-content .modal-body').find('.col-lg-12').html($data);
			b('.employersEditJump').click();
			employers.iframeRresponsible();
			var index = window.setTimeout(function(){
				$(window).resize();
			},200);
		}
		employers.iframeRresponsible = function(){
			var $allObjects = $("iframe, object, embed"),
			$fluidEl = $("figure");

			$allObjects.each(function() {
				$(this)
				 // jQuery .data does not work on object/embed elements
				.attr('data-aspectRatio', this.height / this.width)
				.removeAttr('height')
				.removeAttr('width');
			});
			$(window).resize(function() {
				var newWidth = $fluidEl.width();
				$allObjects.each(function() {
					var $el = $(this);
					$el
					.width(newWidth)
					.height(newWidth * $el.attr('data-aspectRatio'));
				});
			}).resize();
		}
		a.employers = employers;
	}(window,jQuery);
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