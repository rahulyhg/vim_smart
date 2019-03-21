<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'预约服务列表',
	'describe'=>'',
);
$breadcrumb = array(
	array('分类信息','#'),
	array('预约服务列表','#'),
);

$add_action = array(

);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
	<thead>

	<tr>

		<th>编号</th>

		<th>服务名称</th>

		<th>价格</th>

		<th>预约数</th>

		<th>时间</th>

		<th>数字</th>

		<th>审核状态</th>

		<th>运行状态</th>

		<th>预约状态</th>

		<th class="textcenter">操作</th>

	</tr>

	</thead>

	<tbody>

	<if condition="is_array($appoint_list)">

		<volist name="appoint_list" id="vo">

			<tr>

				<td>{pigcms{$vo.appoint_id}</td>

				<td>{pigcms{$vo.appoint_name}</td>

				<td>

					定金：￥ {pigcms{$vo.payment_money}<br/>

					全价：￥ {pigcms{$vo.appoint_price}

				</td>

				<td>已预约：{pigcms{$vo.appoint_sum}</td>

				<td>

					开始时间：{pigcms{$vo.start_time|date="Y-m-d H:i:s",###}<br/>

					结束时间：{pigcms{$vo.end_time|date="Y-m-d H:i:s",###}<br/>

					添加时间：{pigcms{$vo.create_time|date="Y-m-d H:i:s",###}

				</td>

				<td>

					点击数：{pigcms{$vo.hits}<br/>

					预约数：{pigcms{$vo.appoint_sum}

				</td>

				<td>

					<if condition="$vo['check_status'] eq 0"><span style="color:red">待审核</span>

						<elseif condition="$vo['check_status'] eq 1" /><span style="color:green">通过</span>

					</if>

				</td>

				<td>

					<if condition="$vo['start_time'] gt $_SERVER['REQUEST_TIME']">

						未开始

						<elseif condition="$vo['end_time'] lt $_SERVER['REQUEST_TIME']"/>

						已结束

						<else/>

						进行中

					</if>

				</td>

				<td>

					<if condition="$vo['appoint_status'] eq 0"><span style="color:green">开启</span>

						<elseif condition="$vo['appoint_status'] eq 1" /><span style="color:red">关闭</span>

					</if>

				</td>

				<td class="textcenter">

					<a href="{pigcms{:U('Appoint/order_list_news', array('appoint_id'=>$vo['appoint_id']))}" class="on">查看订单</a> |

					<a href="{pigcms{:U('Merchant/merchant_login_news',array('mer_id'=>$vo['mer_id'], 'appoint_id'=>$vo['appoint_id']))}">编辑</a>

				</td>

			</tr>

		</volist>



		<else/>

		<tr><td class="textcenter red" colspan="11">列表为空！</td></tr>

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
