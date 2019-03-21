<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'平台快报',
	'describe'=>'',
);
$breadcrumb = array(
	array('系统配置','#'),
	array('平台快报','http://www.hdhsmart.com/admin.php?g=System&c=Systemnews&a=index_news'),
	array('平台快报内容列表','#'),
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

		<th>标题</th>

		<th>添加时间</th>

		<th>最后修改时间</th>

		<th>排序</th>

		<th>状态</th>

		<th class="textcenter">操作</th>

	</tr>

	</thead>

	<tbody>

	<if condition="is_array($news_list)">

		<volist name="news_list" id="vo">

			<tr>

				<td>{pigcms{$vo.id}</td>

				<td>{pigcms{$vo.title}</td>

				<td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>

				<td>{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}</td>

				<td>{pigcms{$vo.sort}</td>

				<td><if condition="$vo['status'] eq 1"><font color="green">启用</font><else/><font color="red">禁用</font></if></td>

				<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Systemnews/edit_news',array('id'=>$vo['id'],'frame_show'=>true))}','查看内容',1000,640,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Systemnews/edit_news',array('id'=>$vo['id']))}','编辑快报',800,500,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Systemnews/del',array('id'=>$vo['id']))}">删除</a></td>

			</tr>

		</volist>



		<else/>

		<tr><td class="textcenter red" colspan="9">列表为空！</td></tr>

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


