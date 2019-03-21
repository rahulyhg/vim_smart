<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -125px;}
    -->
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.dropdown-menu {
    margin: 0 0 0 -125px;
}
</style>
<!--头部设置-->
<?php
$title = array(
	'title'=>'商户列表',
	'describe'=>'',
);
$breadcrumb = array(
	array('商户管理','#'),
	array('商户列表','#'),
);
$add_action = array(
	'url'=>U('Merchant/add'),
	'name'=>'商铺'
)
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--<if condition="$admin eq 1">-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--            <i class="fa fa-angle-down"></i>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu">-->
<!--            <li>-->
<!--                <a href="{pigcms{:U('')}">-->
<!--                    <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--            </li>-->
<!--            <foreach name="villageArray" item="vo">-->
<!--                <li>-->
<!--                    <a href="__SELF__&village_id={pigcms{$vo.village_id}">-->
<!--                        <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                </li>-->
<!--            </foreach>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <else/>-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--        </a>-->
<!--    </div>-->
<!--</if>-->
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
<!--	编号	企业帐号	企业名称	联系电话	最后登录时间	访问该企业后台	微官网点击数	状态	公众号网页授权状态	企业账单	操作-->
								<thead>
								<tr>
									<th>
										<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
											<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
											<span></span>
										</label>
									</th>
									<th> 所属项目(期数) </th>
									<th> 企业帐号 </th>
									<th> 企业名称 </th>
									<th> 联系电话 </th>
									<th> 最后登录时间 </th>
									<th> 访问该企业后台 </th>
									<th> 微官网点击数</th>
									<th> 状态 </th>
									<th> 公众号网页授权状态 </th>
<!--									<th> 企业账单 </th>-->
									<th> 操作 </th>
								</tr>
								</thead>
								<tbody>
									<volist name="merchant_list" id="vo">
									<tr class="odd gradeX">
										<td>
											<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
												<input type="checkbox" class="checkboxes" value="1" />
												<span></span>
											</label>
										</td>
										<td>{pigcms{$vo.village_name}</td>
										<td>{pigcms{$vo.account}</td>
										<td>{pigcms{$vo.name}</td>
										<td>{pigcms{$vo.phone}</td>
										<td><if condition="$vo['last_time']">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
										<td class="textcenter"><if condition="$vo['status'] eq 1"><a href="{pigcms{:U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id']))}" class="__full_screen_link" target="_blank">访问</a><else/><a href="javascript:alert('商户状态不正常，无法访问！请先修改商户状态。');" class="__full_screen_link">访问</a></if></td>
										<td class="textcenter">{pigcms{$vo.hits}</td>
										<td><if condition="$vo['status'] eq 1"><font color="green">启用</font><elseif condition="$vo['status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
										<if condition="$config['is_open_oauth']">
											<td><if condition="$vo['is_open_oauth'] eq 1"><font color="green">启用</font><else/><font color="red">关闭</font></if></td>
										</if>
<!--										<td class="textcenter">-->
<!---->
<!--											<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/order',array('mer_id'=>$vo['mer_id'],'frame_show'=>true))}','查看详细信息',520,370,true,false,false,false,'detail',true);"><i class="icon-docs"></i> 查看</a>-->
<!---->
<!--												查看账单-->
<!--											</a>-->
<!--										</td>-->
<!--										<td class="textcenter"><a href="{pigcms{:U('Merchant/weidian_order',array('mer_id'=>$vo['mer_id']))}">微店账单</a></td>-->
										<td>
											<div class="btn-group">
												<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
													<i class="fa fa-angle-down"></i>
												</button>
												<ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
													<li>
														<a href="{pigcms{:U('Merchant/store_news',array('mer_id'=>$vo['mer_id']))}"><i class="icon-docs"></i> 商铺列表</a>

													</li>
													<li>
														<a href="javascript:void(0);" onclick="window.top.show_other_frame('Group','product','mer_id={pigcms{$vo.mer_id}')">
															<i class="icon-docs"></i>
															{pigcms{$config.group_alias_name}列表</a>

													</li>
													<li>
														<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/edit',array('mer_id'=>$vo['mer_id'],'frame_show'=>true))}','查看详细信息',520,370,true,false,false,false,'detail',true);"><i class="icon-docs"></i> 查看</a>

													</li>
													<li>
														<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/edit',array('mer_id'=>$vo['mer_id']))}','编辑商户信息',600,450,true,false,false,editbtn,'edit',true);"><i class="icon-docs"></i> 编辑</a>

													</li>
													<li>
														<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/menu',array('mer_id'=>$vo['mer_id']))}','设置商家使用权限',700,500,true,false,false,editbtn,'edit',true);"><i class="icon-docs"></i> 权限</a>

													</li>
													<li>
														<a href="javascript:void(0);" class="delete_row" parameter="mer_id={pigcms{$vo.mer_id}" url="{pigcms{:U('Merchant/del')}"><i class="icon-docs"></i> 删除</a>

													</li>

												</ul>
											</div>
										</td>
									</tr>
									</volist>

<!--									 -->
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