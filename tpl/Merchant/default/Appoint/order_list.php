<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-comments-o comments-o-icon"></i>
			<li class="active"><a href="{pigcms{:U('Appoint/index')}">预约列表</a></li>
			<li>{pigcms{$now_group.appoint_name}</li>
			<li>订单列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<!-- <form id="frmselect" method="get" action="" style="margin-bottom:0;">
					<input type="hidden" name="c" value="Group"/>
					<input type="hidden" name="a" value="order_list"/>
					<select id="group_id" name="group_id">
						<volist name="group_list" id="vo">
							<option value="{pigcms{$vo.group_id}" <if condition="$_GET['group_id'] eq $vo['group_id']">selected="selected"</if>>{pigcms{$vo.s_name}</option>
						</volist>
					</select>
				</form> -->
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>订单编号</th>
									<th>定金</th>
									<th>店铺名称</th>
									<th>店铺地址</th>
									<th>服务类型</th>
									<th>用户信息</th>
									<th>描述</th>
									<th>订单状态</th>
									<th>服务状态</th>
									<th class="button-column">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($order_list)): ?>
								<volist name="order_list" id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td width="70">{pigcms{$vo.order_id}</td>
										<td width="50">￥{pigcms{$vo.payment_money}</td>
										<td width="200">{pigcms{$vo.store_name}</td>
										<td width="200">{pigcms{$vo.store_adress}</td>
										<td width="150">
											<if condition="$vo['appoint_type'] eq 0"><span style="color:red">到店</span>
											<elseif condition="$vo['appoint_type'] eq 1" /><span style="color:red">上门</span>
											</if>
										</td>
										<td width="150">
											用户ID：{pigcms{$vo.uid}<br/>
											用户名：{pigcms{$vo.nickname}<br/>
											订单手机号：{pigcms{$vo.phone}<br/>
										</td>
										<td width="330">{pigcms{$vo.content}</td>
										<td width="400">
											<if condition="$vo['paid'] eq 0"><span style="color:red">未支付</span>
											<elseif condition="$vo['paid'] eq 1" /><span style="color:green">已支付</span>
											<elseif condition="$vo['paid'] eq 2" /><span style="color:red">已退款</span>
											</if><br/>
											下单时间：{pigcms{$vo['order_time']|date='Y-m-d H:i:s',###}<br/>
											<?php if(empty($vo['paid'])): ?>
												付款时间：无
											<?php else : ?>
												付款时间：{pigcms{$vo['pay_time']|date='Y-m-d H:i:s',###}<br/>
											<?php endif; ?>
										</td>
										<td width="150">
											<if condition="$vo['service_status'] eq 0"><span style="color:red">未服务</span>
											<elseif condition="$vo['service_status'] eq 1" /><span style="color:green">已服务</span>
											</if>
										</td>
										<td class="button-column" width="40">
											<a title="操作订单" class="green handle_btn" style="padding-right:8px;" href="{pigcms{:U('Appoint/order_detail',array('order_id'=>$vo['order_id']))}">
												<i class="ace-icon fa fa-search bigger-130"></i>
											</a>
										</td>
									</tr>
								</volist>
								<?php else : ?>
									<tr><td colspan="10" style="color:red;text-align:center;">暂无订单。</td></tr>
								<?php endif; ?>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
	$(function(){
		$('.handle_btn').live('click',function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'操作订单',
				padding: 0,
				width: 720,
				height: 520,
				lock: true,
				resize: false,
				background:'black',
				button: null,
				fixed: false,
				close: null,
				left: '50%',
				top: '38.2%',
				opacity:'0.4'
			});
			return false;
		});
		
		$('#group_id').change(function(){
			$('#frmselect').submit();
		});
	});
</script>
<include file="Public:footer"/>
