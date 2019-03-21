<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Appoint/index')}">预约管理</a>
			</li>
			<li class="active">预约列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">添加预约</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="80">编号</th>
									<th>服务名称</th>
									<th>商家名称</th>
									<th>开始时间</th>
									<th>结束时间</th>
									<th>创建时间</th>
									<th>分类名称</th>
									<th>定金状态</th>
									<th>定金金额</th>
									<th>活动状态</th>
									<th>审核状态</th>
									<th width="150" style="text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$appoint_list">
									<volist name="appoint_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.appoint_id}</td>
											<td><a href="{pigcms{$config.site_url}/index.php?g=Appoint&c=Detail&appoint_id={pigcms{$vo.appoint_id}" target="_blank" data-title="{pigcms{$vo.appoint_name}" data-pic="{pigcms{$vo.list_pic}" class="appoint_name">{pigcms{$vo.appoint_name}</a></td>
											<td>{pigcms{$vo.mer_name}</td>
											<td>{pigcms{$vo.start_time|date='Y-m-d',###}</td>
											<td>{pigcms{$vo.end_time|date='Y-m-d',###}</td>
											<td>{pigcms{$vo.create_time|date='Y-m-d H:i:s',###}</td>
											<td>{pigcms{$vo.category_name}</td>
											<td>
												<if condition="$vo['payment_status'] eq 0"><span style="color:green">不收定金</span>
												<elseif condition="$vo['payment_status'] eq 1" /><span style="color:red">收定金</span>
												</if>
											</td>
											<td>￥{pigcms{$vo.payment_money}</td>
											<td>
												<if condition="$vo['appoint_status'] eq 0"><span style="color:green">开启</span>
												<elseif condition="$vo['appoint_status'] eq 1" /><span style="color:red">关闭</span>
												</if>
											</td>
											<td>
												<if condition="$vo['check_status'] eq 0"><span style="color:red">待审核</span>
												<elseif condition="$vo['check_status'] eq 1" /><span style="color:green">通过</span>
												</if>
											</td>
											<td style="text-align:center;">
												<!-- <a style="width: 60px;" class="label label-sm label-info" title="评论列表" href="{pigcms{:U('Message/Appoint_reply',array('Appoint_id'=>$vo['Appoint_id']))}">评论列表</a>&nbsp;&nbsp;&nbsp; -->
												<a style="width: 60px;" class="label label-sm label-info" title="订单列表" href="{pigcms{:U('Appoint/order_list',array('appoint_id'=>$vo['appoint_id']))}">订单列表</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="12" >您没有添加过商品！</td></tr>
								</if>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	function CreateShop(){
		window.location.href = "{pigcms{:U('Appoint/add')}";
	}
</script>
<include file="Public:footer"/>
