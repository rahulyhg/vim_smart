<layout name="layout"/>

<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

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
				<h1>账单列表
					<!--<small>用户的任何消费都会被记录在此 </small>-->
				</h1>
			</div>
		</div>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="http://www.hdhsmart.com/admin.php?g=System&c=Index&a=index_news">后台首页</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">智慧助手</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">账单管理</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">账单详情列表</span>
			</li>
		</ul>
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
								<th> 缴费项 </th>
								<th> 已缴金额 </th>
								<th> 支付时间 </th>
								<th>业主名</th>
								<th>联系方式</th>
								<th>住址</th>
								<th>对账状态</th>
							</tr>
							</thead>
							<tbody>
							<foreach name="order_list['order_list']" item="vo">
								<tr class="odd gradeX">
									<td>
										<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
											<input type="checkbox" class="checkboxes" value="1" />
											<span></span>
										</label>
									</td>
									<td>{pigcms{$vo.usernum}</td>
									<td>{pigcms{$vo.money}</td>
									<td>{pigcms{$vo.time|date='Y-m-d H:i:s',###}</td>
									<td>{pigcms{$vo.username}</td>
									<td>{pigcms{$vo.phone}</td>
									<td>{pigcms{$vo.address}</td>
									<td>{pigcms{$vo.usernum}</td>
									<td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
									<td class="textcenter"><if condition="$v.status eq 1"><font color="green">正常</font><elseif condition="$v.status eq 0"/><font color="red" title="等待小区管理员登录社区后台完善信息">待完善信息</font><else/><font color="red">禁止</font></if></td>								
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

<!--自定义js代码区开始-->
<script type="text/javascript">
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