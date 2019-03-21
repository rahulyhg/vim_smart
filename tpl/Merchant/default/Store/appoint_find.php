<include file="Store:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-desktop gear-icon"></i>
				预约订单列表
			</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group" style="border:1px solid #c5d0dc;padding:10px;">
						<form id="find-form" method="post">
							<select name="find_type" id="find_type" class="col-sm-1" style="margin-right:10px;height:42px;">
								<optgroup label="预约">
									<option value="1">消费密码</option>
								</optgroup>
								<optgroup label="通用">
									<option value="2">订单ID</option>
									<option value="3">预约ID</option>
									<option value="4">用户ID</option>
									<option value="5">用户昵称</option>
									<option value="6">手机号码</option>
								</optgroup>
							</select>
							<input class="col-sm-4" name="find_value" id="find_value" type="text" style="margin-right:10px;font-size:18px;height:42px;"/>
							<button class="btn btn-success" type="submit" id="find_submit">查找订单</button>
						</form>
					</div>
					<div id="order_list" class="grid-view" style="display:none;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>订单编号</th>
									<th>预约名称</th>
									<th>订单信息</th>
									<th>服务状态</th>
									<th>用户信息</th>
									<th>订单状态</th>
									<th class="button-column">操作</th>
								</tr>
							</thead>
							<tbody id="order_html">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script id="find_html" type="text/html">
	{{# for(var i = 0, len = d.list.length; i < len; i++){ }}
		<tr class="{{# if(i%2==1){ }}odd{{# }else{ }}even{{# } }}">
			<td width="100">{{ d.list[i].order_id }}</td>
			<td width="200"><a href="{pigcms{$config.site_url}/index.php?g=Appoint&c=Detail&appoint_id={{ d.list[i].appoint_id }}" target="_blank">{{ d.list[i].appoint_name }}</a></td>
			<td width="150">
				定金：{{d.list[i].payment_money}}<br/>
				总价：{{d.list[i].appoint_price}}<br/>
			</td>
			<td width="150">
 				{{# if(d.list[i].last_staff == null){ }}
					<span class="red">未验证服务</span>
				{{# }else{ }}
					操作店员：{{d.list[i].last_staff}}<br/>
					消费时间：{{d.list[i].pay_time}}<br/>
				{{# } }}
			</td>
			<td width="180">
				用户ID：{{d.list[i].uid}}<br/>
				用户名：{{d.list[i].nickname}}<br/>
				用户手机号：{{d.list[i].phone}}<br/>
			</td>
			<td width="200">
				{{# if(d.list[i].paid ==0){ }}
					{{# if(d.list[i].payment_money != '0.00'){ }}
						<font color="red">未支付</font>
					{{# } }}
						{{# if(d.list[i].service_status ==0){ }}
							<font color="red">未服务</font>
							<a href="{pigcms{:U('Store/appoint_verify')}&order_id={{ d.list[i].order_id }}" class="group_verify_btn">验证服务</a>
						{{# }else if(d.list[i].service_status ==1){ }}
							<font color="green">已服务</font>
						{{# } }}
				{{# }else if(d.list[i].paid ==1){ }}
					<font color="green">已支付</font>
						{{# if(d.list[i].service_status ==0){ }}
							<font color="red">未服务</font>
							<a href="{pigcms{:U('Store/appoint_verify')}&order_id={{ d.list[i].order_id }}" class="group_verify_btn">验证服务</a>
						{{# }else if(d.list[i].service_status ==1){ }}
							<font color="green">已服务</font>
						{{# } }}
				{{# }else if(d.list[i].paid ==2){ }}
						<font color="red">已退款</font>
				{{# } }}<br/>
				下单时间：{{d.list[i].order_time}}<br/>
				付款时间：{{d.list[i].pay_time}}
			</td>
			<td class="button-column" width="40">
				<a title="操作" class="green handle_btn" style="padding-right:8px;" href="{pigcms{:U('Store/appoint_detail')}&order_id={{ d.list[i].order_id }}">
					<i class="ace-icon fa fa-search bigger-130"></i>
				</a>
			</td>
		</tr>
	{{# } }}
</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script src="{pigcms{$static_public}js/laytpl.js"></script>
<script type="text/javascript">
	$('#find_type').change(function(){
		if($(this).val() != '1'){
			$('#find_value').val($('#find_value').val().replace(/\s+/g,""));
		}else{
			$('#find_value').val($('#find_value').val().replace(/\s+/g,"").replace(/(\d{4})/g,'$1 '));
		}
	});
	$('#find_value').focus().keyup(function(){
		if($('#find_type').val() == '1'){
			if($(this).val().substr(-1) == ' '){
				$(this).val($(this).val().substr(0,($(this).val().length-1)));
			}else{
				$(this).val($(this).val().replace(/\s+/g,"").replace(/(\d{4})/g,'$1 '));
			}
		}
	});
	$('#find-form').submit(function(){
		var find_value = $('#find_value');
		find_value.val($.trim(find_value.val()));
		if(find_value.val().length < 1){
			alert('请输入查找内容！');
			find_value.focus();
			return false;
		}
		
		var post_type = $('#find_type').val();
		var post_value = $('#find_value').val().replace(/\s+/g,"");
		$('#find_submit').removeClass('btn-success').addClass('btn-error').prop('disabled',true).html('请求中...');
		$('#order_html').empty();
		$('#order_list').hide();
		$.post("{pigcms{:U('Store/appoint_find')}",{find_type:post_type,find_value:post_value},function(result){
			$('#find_submit').removeClass('btn-error').addClass('btn-success').prop('disabled',false).html('查找订单');
			data = $.parseJSON(result);
			if(data.row_count > 0){
				laytpl(document.getElementById('find_html').innerHTML).render(data, function(html){
					document.getElementById('order_html').innerHTML = html;
					$('#order_list').show();
				});
			}else{
				alert('未查找到内容！');
			}
		});
		
		return false;
	});
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
</script>
<include file="Public:footer"/>