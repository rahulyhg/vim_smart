<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta charset="utf-8"><link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><title><?php echo ($config["site_name"]); ?> - 店铺管理中心</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script><!-- page specific plugin scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script><!-- ace scripts --><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script><script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script><style type="text/css">
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
</style><script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script></head><body class="no-skin"><div id="navbar" class="navbar navbar-default"><div class="navbar-container" id="navbar-container"><button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler"><span class="sr-only">Toggle sidebar</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><div class="navbar-header pull-left"><a href="<?php echo U('Store/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"><small><img src="<?php echo ($config["site_merchant_logo"]); ?>" style="height:38px;width:38px;"/><?php echo ($config["site_name"]); ?> - 店铺管理中心
				</small></a></div><div class="navbar-buttons navbar-header pull-right" role="navigation"><ul class="nav ace-nav"><!--li class="red"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="ace-icon fa fa-bell icon-animated-bell"></i><span class="badge badge-important">0</span></a><ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close"><li class="dropdown-header"><i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单
						</li><li class="dropdown-footer"><a href="#">查看全部未处理订单 
								<i class="ace-icon fa fa-arrow-right"></i></a></li></ul></li><li class="green"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="ace-icon fa fa-envelope icon-animated-vertical"></i><span class="badge badge-success">0</span></a><ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close"><li class="dropdown-header"><i class="ace-icon fa fa-envelope-o"></i> 0条未读消息
						</li><li><a href="#">
								有<span style="color: red;">0</span>条新评论
							</a></li><li></li></ul></li--><li class="light-blue"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /><span class="user-info"><small>欢迎您，</small><?php echo ($staff_session["name"]); ?></span><i class="ace-icon fa fa-caret-down"></i></a><ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close"><li><a href="<?php echo ($config["site_url"]); ?>" target="_blank"><i class="ace-icon fa fa-link"></i> 网站首页
							</a></li><li class="divider"></li><li><a href="<?php echo U('Store/logout');?>"><i class="ace-icon fa fa-power-off"></i> 退出
							</a></li></ul></li></ul></div></div></div><div class="main-container" id="main-container"><div id="sidebar" class="sidebar responsive"><ul class="nav nav-list" style="top: 0px;"><li class="hsub <?php if(strpos(ACTION_NAME,'group') !== false): ?>open active<?php endif; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-desktop"></i><span class="menu-text"><?php echo ($config["group_alias_name"]); ?>订单管理</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu"><li <?php if(strpos(ACTION_NAME,'group') !== false): ?>class="active"<?php endif; ?>><a href="<?php echo U('Store/group_list');?>"><i class="menu-icon fa fa-caret-right"></i><?php echo ($config["group_alias_name"]); ?>订单列表
					</a><b class="arrow"></b></li></ul></li><li class="hsub <?php if(strpos(ACTION_NAME,'meal') !== false): ?>open active<?php endif; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-cutlery"></i><span class="menu-text"><?php echo ($config["meal_alias_name"]); ?>订单管理</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu"><li <?php if(strpos(ACTION_NAME,'meal') !== false): ?>class="active"<?php endif; ?>><a href="<?php echo U('Store/meal_list');?>"><i class="menu-icon fa fa-caret-right"></i><?php echo ($config["meal_alias_name"]); ?>订单列表
					</a><b class="arrow"></b></li></ul></li><li class="hsub <?php if(strpos(ACTION_NAME,'coupon') !== false): ?>open active<?php endif; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-cutlery"></i><span class="menu-text">优惠券验证</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu"><li <?php if(strpos(ACTION_NAME,'coupon') !== false): ?>class="active"<?php endif; ?>><a href="<?php echo U('Store/coupon_list');?>"><i class="menu-icon fa fa-caret-right"></i> 优惠券验证
					</a><b class="arrow"></b></li></ul></li><li class="hsub <?php if(strpos(ACTION_NAME,'appoint') !== false): ?>open active<?php endif; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-cutlery"></i><span class="menu-text">预约订单管理</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu"><li <?php if(strpos(ACTION_NAME,'appoint') !== false): ?>class="active"<?php endif; ?>><a href="<?php echo U('Store/appoint_list');?>"><i class="menu-icon fa fa-caret-right"></i> 预约订单列表
					</a><b class="arrow"></b></li></ul></li></ul><!-- /.nav-list --><!-- #section:basics/sidebar.layout.minimize --><div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"><i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i></div><!-- /section:basics/sidebar.layout.minimize --><script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script></div><div class="main-content"><!-- 内容头部 --><div class="breadcrumbs" id="breadcrumbs"><ul class="breadcrumb"><li><i class="ace-icon fa fa-desktop gear-icon"></i><?php echo ($config["group_alias_name"]); ?>订单列表
			</li></ul></div><!-- 内容头部 --><div class="page-content"><div class="page-content-area"><div class="row"><div class="col-xs-12"><div class="form-group" style="border:1px solid #c5d0dc;padding:10px;"><form id="find-form" method="post"><select name="find_type" id="find_type" class="col-sm-1" style="margin-right:10px;height:42px;"><optgroup label="<?php echo ($config["group_alias_name"]); ?>"><option value="1">消费密码</option></optgroup><optgroup label="实物"><option value="2">快递单号</option></optgroup><optgroup label="通用"><option value="3">订单ID</option><option value="4"><?php echo ($config["group_alias_name"]); ?>ID</option><option value="5">用户ID</option><option value="6">用户昵称</option><option value="7">手机号码</option></optgroup></select><input class="col-sm-4" name="find_value" id="find_value" type="text" style="margin-right:10px;font-size:18px;height:42px;"/><button class="btn btn-success" type="submit" id="find_submit">查找订单</button></form></div><div id="order_list" class="grid-view" style="display:none;"><table class="table table-striped table-bordered table-hover"><thead><tr><th>订单编号</th><th><?php echo ($config["group_alias_name"]); ?>名称</th><th>订单信息</th><th>订单类型</th><th>验证消费</th><th>用户信息</th><th>订单状态</th><th class="button-column">操作</th></tr></thead><tbody id="order_html"></tbody></table></div></div></div></div></div></div><script id="find_html" type="text/html">
	{{# for(var i = 0, len = d.list.length; i < len; i++){ }}
		<tr class="{{# if(i%2==1){ }}odd{{# }else{ }}even{{# } }}"><td width="100">{{ d.list[i].order_id }}</td><td width="200"><a href="<?php echo ($config["site_url"]); ?>/index.php?g=Group&c=Detail&group_id={{ d.list[i].group_id }}" target="_blank">{{ d.list[i].s_name }}</a></td><td width="150">
				数量：{{ d.list[i].num }}<br/>
				总价：{{ d.list[i].total_money }}<br/></td><td width="80">
				{{# if(d.list[i].tuan_type == '0'){ }}
					<?php echo ($config["group_alias_name"]); ?>券
				{{# }else if(d.list[i].tuan_type == '1'){ }}
					代金券
				{{# }else if(d.list[i].tuan_type == '2'){ }}
					实物
				{{# } }}
				
				<!--{!{# if(d.list[i].tuan_type != '2'){ }!}
					<br/><br/>消费密码：{{ d.list[i].group_pass }!}
				{!{# }else if(d.list[i].express_id != ''){ }}
					<br/><br/>快递单号：{{ d.list[i].express_id }!}
				{!{# } }!}--></td><td width="150">
			  {{# if(d.list[i].last_staff !=''){ }}
				操作店员：{{ d.list[i].last_staff }}<br/>
				消费时间：{{ d.list[i].use_time }}<br/>
				{{# }else{ }}
				 <span class="red">未验证消费</span>
				{{# } }}
			</td><td width="180">
				{{# if(d.list[i].paid == '1'){ }}
					用户ID：{{ d.list[i].uid }}<br/>
					用户名：{{ d.list[i].nickname }}<br/>
					订单手机号：{{ d.list[i].group_phone }}<br/>
				{{# }else{ }}
					未付款用户无法查看
				{{# } }}
			</td><td width="200">
				{{# if(d.list[i].paid == '1'){ }}
					{{# if(d.list[i].pay_type == 'offline' && d.list[i].third_id ==0){ }}
						<font color="red">线下未付款</font><a href="<?php echo U('Store/group_verify');?>&order_id={{ d.list[i].order_id }}" class="group_verify_btn">验证付款</a>
					{{# }else if(d.list[i].status == '0'){ }}
						<font color="green">已付款</font>
						{{# if(d.list[i].tuan_type != '2'){ }}
							<font color="red">未消费</font><a href="<?php echo U('Store/group_verify');?>&order_id={{ d.list[i].order_id }}" class="group_verify_btn">验证消费</a>
						{{# }else{ }}
							<font color="red">未发货</font>
						{{# } }}
					{{# }else if(d.list[i].status == '1'){ }}
						<font color="green">已消费</font><font color="red">待评价</font>
					{{# }else if(d.list[i].status == '3'){ }}
						<font color="red">已退款</font>
					{{# }else if(d.list[i].status == '4'){ }}
						<font color="red">用户已取消</font>
					{{# }else{ }}
						<font color="green">已完成</font>
					{{# } }}
				{{# }else{ }}
					<font color="red">未付款</font>
				{{# } }}
				<br/>
				下单时间：{{ d.list[i].add_time }}<br/>
				{{# if(d.list[i].paid == '1'){ }}
					付款时间：{{ d.list[i].pay_time }}
				{{# } }}
			</td><td class="button-column" width="40"><a title="操作" class="green handle_btn" style="padding-right:8px;" href="<?php echo U('Store/group_edit');?>&order_id={{ d.list[i].order_id }}"><i class="ace-icon fa fa-search bigger-130"></i></a></td></tr>
	{{# } }}
</script><script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script><script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script><script src="<?php echo ($static_public); ?>js/laytpl.js"></script><script type="text/javascript">
	$('#find_type').change(function(){
		if($(this).val() != '1'){
			$('#find_value').val($('#find_value').val().replace(/\s+/g,""));
		}else{
			$('#find_value').val($('#find_value').val().replace(/\s+/g,"").replace(/(\d{4})/g,'$1 '));
		}
	});
	$('#find_value').focus().keyup(function(){
		if($('#find_type').val() == '1'){
			if($(this).val().substr(-1) == ' '){
				$(this).val($(this).val().substr(0,($(this).val().length-1)));
			}else{
				$(this).val($(this).val().replace(/\s+/g,"").replace(/(\d{4})/g,'$1 '));
			}
		}
	});
	$('#find-form').submit(function(){
		var find_value = $('#find_value');
		find_value.val($.trim(find_value.val()));
		if(find_value.val().length < 1){
			alert('请输入查找内容！');
			find_value.focus();
			return false;
		}
		
		var post_type = $('#find_type').val();
		var post_value = $('#find_value').val().replace(/\s+/g,"");
		$('#find_submit').removeClass('btn-success').addClass('btn-error').prop('disabled',true).html('请求中...');
		$('#order_html').empty();
		$('#order_list').hide();
		$.post("<?php echo U('Store/group_find');?>",{find_type:post_type,find_value:post_value},function(result){
			$('#find_submit').removeClass('btn-error').addClass('btn-success').prop('disabled',false).html('查找订单');
			data = $.parseJSON(result);
			if(data.row_count > 0){
				laytpl(document.getElementById('find_html').innerHTML).render(data, function(html){
					document.getElementById('order_html').innerHTML = html;
					$('#order_list').show();
				});
			}else{
				alert('未查找到内容！');
			}
		});
		
		return false;
	});
	$('.group_verify_btn').live('click',function(){
		var verify_btn = $(this);
		verify_btn.html('验证中..');
		$.get(verify_btn.attr('href'),function(result){
			if(result.status == 1){
				var icon = 'succeed';
				var button = [{
								name:'确定',
								callback:function () {  
									window.location.href = window.location.href;
								},
								focus:true
							}];
			}else{
				var icon = 'error';
				var button = [{name:'关闭'}];
				verify_btn.html('验证消费');
			}
			var content = result.info;
			window.art.dialog({
				icon: icon,
				title: '提示：',
				id: 'msg' + Math.random(),
				lock: true,
				fixed: true,
				opacity: '0.4',
				resize: false,
				content: content,
				button: button,
				close: null
			});
		});
		return false;
	});
	$('.handle_btn').live('click',function(){
		art.dialog.open($(this).attr('href'),{
			init: function(){
				var iframe = this.iframe.contentWindow;
				window.top.art.dialog.data('iframe_handle',iframe);
			},
			id: 'handle',
			title:'操作订单',
			padding: 0,
			width: 720,
			height: 520,
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
</script><div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;"><div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;"><b>新订单来啦!</b><a class="oaright" href="javascript:closeoa()">[关闭]</a></div><div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div><div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div><div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a></div></div><div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div><a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"><i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i></a></div><script>
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

</script><div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow"><div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div><div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;"><div style="height: 40px;"></div><div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;"><table style="width: 400px; height: 90px;"><tbody><tr><td id="popalertwindowcontent"></td></tr></tbody></table></div><div style="height: 20px;"></div><div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div></div></div></body></html>