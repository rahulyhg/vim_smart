<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'广告列表',
	'describe'=>'',
);
$breadcrumb = array(
	array('系统配置','#'),
	array('广告分类列表','http://www.hdhsmart.com/admin.php?g=System&c=Adver&a=index_news'),
	array('广告列表','#'),

);

$add_action = array(
    'url'=>U('Adver/adver_add',array('cat_id'=>$now_category['cat_id'])),
    'name'=>""
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
	<thead>
	<tr>
		<th>编号</th>
		<th>名称</th>
		<th>链接地址</th>
		<th>图片(以下为强制小图，点击图片查看大图)</th>
		<th class="textcenter">最后操作时间</th>
		<th class="textcenter">操作</th>
	</tr>
	</thead>
	<tbody>
	<if condition="is_array($adver_list)">
		<volist name="adver_list" id="vo">
			<tr>
				<td>{pigcms{$vo.id}</td>
				<td>{pigcms{$vo.name}</td>
				<td><a href="{pigcms{$vo.url}" target="_blank">访问链接</a></td>
				<td>
					<img src="{pigcms{$config.site_url}/upload/adver/{pigcms{$vo.pic}" style="width:300px;height:80px;" class="view_msg"/>
				</td>
				<td class="textcenter">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}</td>
				<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Adver/adver_edit',array('id'=>$vo['id'],'frame_show'=>true))}','查看广告信息',480,330,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Adver/adver_edit',array('id'=>$vo['id']))}','编辑广告信息',510,330,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Adver/adver_del')}">删除</a></td>
			</tr>
		</volist>
		<else/>
		<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
	</if>
	</tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

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


//	//表格显示控制js代码区
//	var table = $('#sample_1');
//
//	// begin first table
//	table.dataTable({
//
//		// Internationalisation. For more info refer to http://datatables.net/manual/i18n
//		"language": {
//			"aria": {
//				"sortAscending": ": activate to sort column ascending",
//				"sortDescending": ": activate to sort column descending"
//			},
//			"emptyTable": "No data available in table",
//			"info": "Showing _START_ to _END_ of _TOTAL_ records",
//			"infoEmpty": "No records found",
//			"infoFiltered": "(filtered1 from _MAX_ total records)",
//			"lengthMenu": "Show _MENU_",
//			"search": "搜索:",
//			"zeroRecords": "No matching records found",
//			"paginate": {
//				"previous":"Prev",
//				"next": "Next",
//				"last": "Last",
//				"first": "First"
//			}
//		},
//
//		// Or you can use remote translation file
//		//"language": {
//		//   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
//		//},
//
//		// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
//		// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
//		// So when dropdowns used the scrollable div should be removed.
//		//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
//
//		"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
//
//		"lengthMenu": [
//			[5, 15, 20, -1],
//			[5, 15, 20, "All"] // change per page values here
//		],
//		// set the initial value
//		"pageLength": 10,
//		"pagingType": "bootstrap_full_number",
//		"columnDefs": [
//			{  // set default column settings
//				'orderable': false,
//				'targets': [0]
//			},
//			{
//				"searchable": false,
//				"targets": [0]
//			},
//			{
//				"className": "dt-right",
//				//"targets": [2]
//			}
//		],
//		"order": [
//			[1, "desc"]
//		] // set first column as a default sort by asc
//	});
//
//	var tableWrapper = jQuery('#sample_1_wrapper');
//
//	table.find('.group-checkable').change(function () {
//		var set = jQuery(this).attr("data-set");
//		var checked = jQuery(this).is(":checked");
//		jQuery(set).each(function () {
//			if (checked) {
//				$(this).prop("checked", true);
//				$(this).parents('tr').addClass("active");
//			} else {
//				$(this).prop("checked", false);
//				$(this).parents('tr').removeClass("active");
//			}
//		});
//	});
//
//	table.on('change', 'tbody tr .checkboxes', function () {
//		$(this).parents('tr').toggleClass("active");
//	});

</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>


