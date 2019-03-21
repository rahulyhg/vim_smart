<include file="Store:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-desktop gear-icon"></i>
				优惠券列表
			</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">查找优惠券</button>
					<p>&nbsp;</p>此页面只列出已归属到此店铺的优惠券。若想验证新优惠券或查找优惠券，请点击上面按钮。
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>编号</th>
									<th>优惠券名称</th>
									<th>优惠券密码</th>
									<th>用户信息</th>
									<th>订单状态</th>
								</tr>
							</thead>
							<tbody>
								<volist name="order_list" id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td width="100">{pigcms{$vo.pigcms_id}</td>
										<td width="200"><a href="{pigcms{$config.site_url}/activity/{pigcms{$vo.activity_id}.html" target="_blank">{pigcms{$vo.name}</a></td>
										<td width="200">{pigcms{$vo.number}</td>
										<td width="200">
											用户ID：{pigcms{$vo.uid}<br/>
											用户名：{pigcms{$vo.nickname}<br/>
											手机号：{pigcms{$vo.phone}
										</td>
										<td width="200">
											兑换时间：{pigcms{$vo['time']|date='Y-m-d H:i:s',###}<br/>
											验证时间：{pigcms{$vo['check_time']|date='Y-m-d H:i:s',###}
										</td>
									</tr>
								</volist>
							</tbody>
						</table>
						<!--div class="summary">第 1-1 条, 共 1 条.</div-->
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
		$('.group_verify_btn').live('click',function(){
			var verify_btn = $(this);
			verify_btn.html('验证中..');
			$.get(verify_btn.attr('href'),function(result){
				if(result.status == 1){
					var icon = 'succeed';
					var button = [{
									name:'确定',
									callback:function () {  
										window.location.href = window.location.href;
									},
									focus:true
								}];
				}else{
					var icon = 'error';
					var button = [{name:'关闭'}];
					verify_btn.html('验证消费');
				}
				var content = result.info;
				window.art.dialog({
					icon: icon,
					title: '提示：',
					id: 'msg' + Math.random(),
					lock: true,
					fixed: true,
					opacity: '0.4',
					resize: false,
					content: content,
					button: button,
					close: null
				});
			});
			return false;
		});
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
	});
	function CreateShop(){
		window.location.href = "{pigcms{:U('Store/coupon_find')}";
	}
</script>
<include file="Public:footer"/>
