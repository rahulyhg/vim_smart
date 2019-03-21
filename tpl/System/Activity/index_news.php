<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'活动列表',
	'describe'=>'',
);
$breadcrumb = array(
	array('推广营销','#'),
	array('活动列表','#'),
);

$add_action = array(
	'url'=>U('Activity/add'),
	'name'=>'活动'
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
		<th>期数</th>
		<th>开始时间</th>
		<th>结束时间</th>
		<th>活动列表</th>
		<th class="textcenter">操作</th>
	</tr>
	</thead>
	<tbody>
	<if condition="is_array($activity_list)">
		<volist name="activity_list" id="vo">
			<tr>
				<td>{pigcms{$vo.activity_id}</td>
				<td>{pigcms{$vo.name}</td>
				<td>{pigcms{$vo.term}</td>
				<td>{pigcms{$vo.begin_time|date='Y-m-d H:i',###}</td>
				<td>{pigcms{$vo.end_time|date='Y-m-d H:i',###}</td>
				<td><a href="{pigcms{:U('Activity/activity_list_news',array('id'=>$vo['activity_id']))}">活动列表</a></td>
				<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Activity/edit',array('id'=>$vo['activity_id']))}','编辑活动分类',480,370,true,false,false,editbtn,'add',true);">编辑</a> <!--| <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.activity_id}" url="{pigcms{:U('Activity/del')}">删除</a--></td>
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


</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
