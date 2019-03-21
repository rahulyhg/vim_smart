<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
	'title'=>'预约管理',
	'describe'=>'',
);
$breadcrumb = array(
	array('分类信息','#'),
	array('预约管理','#'),
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

		<th>排序</th>

		<th>编号</th>

		<th>名称</th>

		<th>短标记(url)</th>

		<if condition="empty($_GET['cat_fid'])">

			<th>查看子分类</th>

			<!-- <th>商品字段管理</th> -->

		</if>

		<th>预约表单填写项</th>

		<th>状态</th>

		<th class="textcenter">操作</th>

	</tr>

	</thead>

	<tbody>

	<if condition="is_array($category_list)">

		<volist name="category_list" id="vo">

			<tr>

				<td>{pigcms{$vo.cat_sort}</td>

				<td>{pigcms{$vo.cat_id}</td>

				<td><if condition="$vo['is_hot']"><font color="red">{pigcms{$vo.cat_name}</font><else/>{pigcms{$vo.cat_name}</if></td>

				<td>{pigcms{$vo.cat_url}</td>

				<if condition="empty($_GET['cat_fid'])">

					<td><a href="{pigcms{:U('Appoint/index_news',array('cat_fid'=>$vo['cat_id']))}">查看子分类</a></td>

				</if>

				<td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appoint/cue_field',array('cat_id'=>$vo['cat_id']))}','预约表单填写项',580,420,true,false,false,false,'detail',true);">预约表单填写项</a></td>

				<td><if condition="$vo['cat_status'] eq 1"><font color="green">启用</font><elseif condition="$vo['cat_status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>

				<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appoint/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true))}','查看分类信息',480,260,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appoint/cat_edit',array('cat_id'=>$vo['cat_id']))}','编辑分类信息',480,<if condition="$vo['cat_fid']">240<else/>340</if>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$vo.cat_id}" url="{pigcms{:U('Appoint/cat_del')}">删除</a></td>

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


<th>
	<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
		<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
		<span></span>
	</label>
</th>

<td>
	<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
		<input type="checkbox" class="checkboxes" value="1" />
		<span></span>
	</label>
</td>

<td>
	<div class="btn-group">
		<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
			<i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
			<li>
				<a href="{pigcms{:U('Diymenu/class_edit',array('id'=>$vo1['id']))}">
					<i class="icon-docs"></i> 更新 </a>
			</li>
			<li onclick="delete_pr_info(this)" id="{pigcms{$v.role_id}">
				<a href="javascript:;">
					<i class="icon-tag"></i> 删除 </a>
			</li>
		</ul>
	</div>
</td>