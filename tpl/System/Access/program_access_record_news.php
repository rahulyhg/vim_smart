<layout name="layout"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/components.min.css" id="style_components" rel="stylesheet" type="text/css" />-->

<!-- END PAGE LEVEL PLUGINS -->


<style type="text/css">
	<!--
	.dropdown-menu {margin: 0 0 0 -125px;}
	-->
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>进出记录
					<small>所有用户进出记录都在这里 </small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<!--<div class="page-toolbar">-->
			<!--&lt;!&ndash; BEGIN THEME PANEL &ndash;&gt;-->
			<!--<div class="btn-group btn-theme-panel">-->
			<!--<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">-->
			<!--<i class="icon-settings"></i>-->
			<!--</a>-->
			<!--<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">-->
			<!--<div class="row">-->
			<!--<div class="col-md-4 col-sm-4 col-xs-12">-->
			<!--<h3>HEADER</h3>-->
			<!--<ul class="theme-colors">-->
			<!--<li class="theme-color theme-color-default active" data-theme="default">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Dark Header</span>-->
			<!--</li>-->
			<!--<li class="theme-color theme-color-light " data-theme="light">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Light Header</span>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--<div class="col-md-8 col-sm-8 col-xs-12 seperator">-->
			<!--<h3>LAYOUT</h3>-->
			<!--<ul class="theme-settings">-->
			<!--<li> Theme Style-->
			<!--<select class="layout-style-option form-control input-small input-sm">-->
			<!--<option value="square">Square corners</option>-->
			<!--<option value="rounded" selected="selected">Rounded corners</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Layout-->
			<!--<select class="layout-option form-control input-small input-sm">-->
			<!--<option value="fluid" selected="selected">Fluid</option>-->
			<!--<option value="boxed">Boxed</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Header-->
			<!--<select class="page-header-option form-control input-small input-sm">-->
			<!--<option value="fixed" selected="selected">Fixed</option>-->
			<!--<option value="default">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Top Dropdowns-->
			<!--<select class="page-header-top-dropdown-style-option form-control input-small input-sm">-->
			<!--<option value="light">Light</option>-->
			<!--<option value="dark" selected="selected">Dark</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Mode-->
			<!--<select class="sidebar-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Menu-->
			<!--<select class="sidebar-menu-option form-control input-small input-sm">-->
			<!--<option value="accordion" selected="selected">Accordion</option>-->
			<!--<option value="hover">Hover</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Position-->
			<!--<select class="sidebar-pos-option form-control input-small input-sm">-->
			<!--<option value="left" selected="selected">Left</option>-->
			<!--<option value="right">Right</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Footer-->
			<!--<select class="page-footer-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--&lt;!&ndash; END THEME PANEL &ndash;&gt;-->
			<!--</div>-->
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="index.html">后台首页</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">智慧助手</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">用户开门记录</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">用户开门记录列表</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i>
							<span class="caption-subject bold uppercase"> 列表记录</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active" onclick="window.location.href='__CONTROLLER__/recycle'">
									<input type="radio" name="options" class="toggle" id="option1">回收站</label>
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Settings</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="row">
                                <div class="col-md-3">
                                    <div class="btn-group pull-left">

                                    </div>
                                </div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
							<tr>
								<th>
									<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
										<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
										<span></span>
									</label>
								</th>
								<th> 编号 </th>
								<th> 用户 </th>
								<th> 联系方式 </th>
								<th> 证件类型 </th>
								<th> 证件号 </th>
								<th> 设备名称 </th>
								<th> 所属区域 </th>
                                <th> 开门方式</th>
								<th> 所属社区 </th>
								<th> 所属公司 </th>
								<th> 时间 </th>
							</tr>
							</thead>
							<tbody>
							<foreach name="log_list" item="vo">
								<tr class="odd gradeX">
									<td>
										<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
											<input type="checkbox" class="checkboxes" value="1" />
											<span></span>
										</label>
									</td>
									<td> {pigcms{$vo.log_id} </td>
									<td class="center">
										{pigcms{$vo.name}
									</td>
									<td class="center">
										{pigcms{$vo.phone}
									</td>
									<td><if condition="$vo.card_type eq 1">现场审核</if><if condition="$vo.card_type eq 2">门禁卡</if><if condition="$vo.card_type eq 3">身份证</if><if condition="$vo.card_type eq 4">工作牌</if></td>
									<td class="center">
										{pigcms{$vo.usernum}
									</td>
									<td class="center">
										{pigcms{$vo.ac_name}
									</td>
									<td class="center">
										{pigcms{$vo.ag_name}
									</td>
                                    <td><if condition="$vo.type eq 0">扫码</if><if condition="$vo.type eq 1">扫码</if><if condition="$vo.type eq 2">开关</if></td>
									<td class="center">
										{pigcms{$vo.village_name}
									</td>
									<td class="center">
										{pigcms{$vo.company_name}
									</td>
									<td class="center">
										{pigcms{$vo.opdate|date='Y-m-d H:i:s',###}
									</td>
									
								</tr>
							</foreach>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

	</div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
		<a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
		<a href="http://www.metronic.com" target="_blank">Metronic</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!--<nav class="quick-nav">-->
<!--<a class="quick-nav-trigger" href="#0">-->
<!--<span aria-hidden="true"></span>-->
<!--</a>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">-->
<!--<span>Purchase Metronic</span>-->
<!--<i class="icon-basket"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">-->
<!--<span>Customer Reviews</span>-->
<!--<i class="icon-users"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/showcast/" target="_blank">-->
<!--<span>Showcase</span>-->
<!--<i class="icon-user"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">-->
<!--<span>Changelog</span>-->
<!--<i class="icon-graph"></i>-->
<!--</a>-->
<!--</li>-->
<!--</ul>-->
<!--<span aria-hidden="true" class="quick-nav-bg"></span>-->
<!--</nav>-->
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<!--插入layer弹层js结束-->
<script>
	$(function(){
		$("[name='change_state']").click(function(){

			var pigcms_id = $(this).siblings(":first").text();
			var is_use = $(this).text();
			$.ajax({
				url: "{pigcms{:U('Hickey/change_state')}",
				type: "GET",
				data: {'pigcms_id': pigcms_id,'is_use':is_use},
				success: function (res) {
					if(res == 1){
						location.reload()
					}else if(res ==2){
						location.reload()
					}else{
						alert('改变失败');
					}
				}
			});
		});
	});

</script>

<!--自定义js代码区开始-->
<script type="text/javascript">
	//获取将要删除的记录对应的id
	function pass_user_info(obj){
		layer.msg('你确定要通过审核吗？', {
			time: 0 //不自动关闭
			,btn: ['确定', '取消']
			,yes: function(index){
				layer.close(index);
				var check_id=$(obj).attr('id');
				//通过ajax异步删除
				$.ajax({
					url:"{:U('change_user_state')}",
					data:{'check_id':check_id},
					type:'get',
					success:function(delmsg){
						if(delmsg==='1'){
							//逻辑删除成功！
							layer.msg('提交信息成功！', {icon: 6});
							//同时刷新页面
							window.location.reload();
						}else{
							//逻辑删除失败！
							layer.msg('提交信息失败！错误编码'+delmsg, {icon: 5});
						}
					}

				});
			}
		});

	}

	function refund_order(obj){
		layer.msg('你确定进行退款操作？', {
			time: 0 //不自动关闭
			,btn: ['确定', '取消']
			,yes: function(index){
				layer.close(index);
				var pr_id=$(obj).attr('id');
				var fee=$(obj).attr('fee');
				$.ajax({
					url:"{:U('wx_refund')}",
					data:{'pr_id':pr_id,'fee':fee},
					dataType:'json',
					type:'post',
					success:function(msg){
						alert(msg);
					}

				});
			}
		});
	}

	function refund_order3(obj){
		layer.msg('你确定进行退款操作？', {
			time: 0 //不自动关闭
			,btn: ['确定', '取消']
			,yes: function(index){
				layer.close(index);
				var pr_id=$(obj).attr('id');
				var fee=$(obj).attr('fee');
				$.ajax({
					url:"{:U('wx_refund_test')}",
					data:{'pr_id':pr_id,'fee':fee},
					dataType:'json',
					type:'post',
					success:function(ret){
						if(ret.error==0){
							alert(ret.msg);
						}else{
							alert(ret.msg);
						}
					}

				});
			}
		});
	}

	function refund_order22(obj){
		//var money='{$v.pay_loan}';
		var pr_id=$(obj).attr('id');
		var fee=$(obj).attr('fee');
		swal({
				title: "退款申请",
				text: "请输入退款理由:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				animation: "slide-from-top",
				confirmButtonText:'确认',
				cancelButtonText:'取消'

				//inputPlaceholder: "Write something"
			},
			function(inputValue){
				if (inputValue === false) return false;

				if (inputValue === "") {
					swal.showInputError("请输入退款理由！");
					return false
				}
				$.ajax({
					url:"{:U('wx_refund_test')}",
					data:{'pr_id':pr_id,'fee':fee,'reason':inputValue},
					dataType:'json',
					type:'post',
					success:function(ret){
						if(ret.error==0){
							swal("请求退款成功,请等待审批结果！", "退款金额: " +fee+'元', "success");
						}else{
							alert(ret.msg);
						}
					}
				});

			});
	}

	function use_condition_search(){
		//点击开启搜索区
		layer.open({
			type: 2,
			title: '欢迎使用条件搜索',
			shadeClose: true,
			shade: 0.8,
			area: ['800px', '50%'],
			content: "{:U('payrecord_search')}" //iframe的url
		});
	}


	//表格显示控制js代码区
	var table = $('#sample_1');

	// begin first table
	table.dataTable({

		// Internationalisation. For more info refer to http://datatables.net/manual/i18n
		"language": {
			"aria": {
				"sortAscending": ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			},
			"emptyTable": "No data available in table",
			"info": "Showing _START_ to _END_ of _TOTAL_ records",
			"infoEmpty": "No records found",
			"infoFiltered": "(filtered1 from _MAX_ total records)",
			"lengthMenu": "Show _MENU_",
			"search": "搜索:",
			"zeroRecords": "No matching records found",
			"paginate": {
				"previous":"Prev",
				"next": "Next",
				"last": "Last",
				"first": "First"
			}
		},

		// Or you can use remote translation file
		//"language": {
		//   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
		//},

		// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
		// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
		// So when dropdowns used the scrollable div should be removed.
		//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

		"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

		"lengthMenu": [
			[5, 15, 20, -1],
			[5, 15, 20, "All"] // change per page values here
		],
		// set the initial value
		"pageLength": 10,
		"pagingType": "bootstrap_full_number",
		"columnDefs": [
			{  // set default column settings
				'orderable': false,
				'targets': [0]
			},
			{
				"searchable": false,
				"targets": [0]
			},
			{
				"className": "dt-right",
				//"targets": [2]
			}
		],
		"order": [
			[1, "desc"]
		] // set first column as a default sort by asc
	});

	var tableWrapper = jQuery('#sample_1_wrapper');

	table.find('.group-checkable').change(function () {
		var set = jQuery(this).attr("data-set");
		var checked = jQuery(this).is(":checked");
		jQuery(set).each(function () {
			if (checked) {
				$(this).prop("checked", true);
				$(this).parents('tr').addClass("active");
			} else {
				$(this).prop("checked", false);
				$(this).parents('tr').removeClass("active");
			}
		});
	});

	table.on('change', 'tbody tr .checkboxes', function () {
		$(this).parents('tr').toggleClass("active");
	});

</script>

<!--自定义js代码区结束-->
</body>

</html>