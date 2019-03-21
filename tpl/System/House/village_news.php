<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />


<style type="text/css">
	<!--
	.dropdown-menu {margin: 0 0 0 -90px;}
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
				<h1>项目列表
					<!--<small>用户的任何消费都会被记录在此 </small>-->
				</h1>
			</div>
		</div>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="#">项目管理</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">项目信息列表</span>
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
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm" onclick="window.location.href='__CONTROLLER__/recycle'">
									<input type="radio" name="options" class="toggle" id="option1">列 表</label>
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option2">回收站</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="row">
								<div class="col-md-6">
									<div class="btn-group">
										<a href="{pigcms{:U('House/village_add_new')}">
											<button id="sample_editable_1_new" class="btn sbold green">添加项目
												<i class="fa fa-plus"></i>
											</button>
										</a>
									</div>
<!--									<div class="btn-group">-->
<!--										<a href="javascript:;" onclick="use_condition_search()">-->
<!--											<button class="btn sbold green"> 导入项目-->
<!--												<i class="fa fa-plus"></i>-->
<!--											</button>-->
<!--										</a>-->
<!--									</div>-->
<!--									<div class="btn-group">-->
<!--										<a href="javascript:;" onclick="use_condition_search()">-->
<!--											<button class="btn sbold green"> 项目配置-->
<!--												<i class="fa fa-plus"></i>-->
<!--											</button>-->
<!--										</a>-->
<!--									</div>-->
								</div>
								<div class="col-md-6">
									<div class="btn-group pull-right">
										<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">批量操作
											<i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:;">
													<i class="fa fa-print"></i> 删除 </a>
											</li>
											<li>
												<a href="javascript:;">
													<i class="fa fa-file-pdf-o"></i> 禁用 </a>
											</li>
										</ul>
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
								<th> id </th>
								<th> 项目名称 </th>
								<th> 物业名称 </th>
								<th> 物业电话 </th>
								<th>最后登录时间</th>
								<th>访问</th>
								<th>账单</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
							</thead>
							<tbody>
							<foreach name="village_list" item="v">
								<tr class="odd gradeX">
									<td>
										<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
											<input type="checkbox" class="checkboxes" value="1" />
											<span></span>
										</label>
									</td>
									<td>{pigcms{$v.village_id} </td>
									<td>{pigcms{$v.village_name}</td>
									<td>{pigcms{$v.property_name}</td>
									<td>{pigcms{$v.property_phone}</td>
									<td><if condition="$v['last_time']">{pigcms{$v.last_time|date='Y-m-d H:i:s',###}<else/>从未登录</if></td>
									<td><a href="{pigcms{:U('House/village_login',array('village_id'=>$v['village_id']))}" target="_blank">访问</a></td>
									<td><a href="{pigcms{:U('House/pay_order_new',array('village_id'=>$v['village_id']))}">查看账单</a></td>
									<td class="textcenter"><if condition="$v.status eq 1"><font color="green">正常</font><elseif condition="$v.status eq 0"/><font color="red" title="等待小区管理员登录社区后台完善信息">待完善信息</font><else/><font color="red">禁止</font></if></td>
									<td>
										<div class="btn-group">
											<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
												<li>
													<a href="{pigcms{:U('House/village_edit_new',array('village_id'=>$v['village_id']))}">
														<i class="icon-docs"></i> 更新 </a>
												</li>
											</ul>
										</div>
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
				url: "{pigcms{:U('Terrace/change_state')}",
				type: "GET",
				data: {'pigcms_id': pigcms_id,'is_use':is_use},
				success: function (res) {
					if(res == 1){
						alert("警告！将关闭所有平台！");
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
			"info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
			"infoEmpty": "No records found",
			"infoFiltered": "(filtered1 from _MAX_ total records)",
			"lengthMenu": "每页显示条数 _MENU_",
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
			[5, 15, 20, "全部"] // change per page values here
		],
		// set the initial value
		"pageLength": -1,
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