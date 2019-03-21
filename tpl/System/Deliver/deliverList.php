<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Deliver/deliverList')}" class="on">配送列表</a>|
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<style>
							.deliver_search input{height: 20px;}
							.deliver_search select{height: 20px;}
							.deliver_search .mar_l_10{margin-left: 10px;}
							.deliver_search .btn{height: 23px;line-height: 16px; padding: 0px 12px;}
						</style>
						<div class="deliver_search">
							<!-- <span>
								店铺名称：
									<select id="store" name="store">
										<option value="0">全部</option>
										<volist name="stores" id="store">
											<option <if condition="$selectStoreId eq $store['store_id']">selected</if> value="{pigcms{$store['store_id']}">{pigcms{$store['name']}</option>
						    			</volist>
						    		</select>
						    </span>
						    <span class="mar_l_10">
						    	配送员：<select id="deliver" name="deliver">
						    			<option value="0">全部</option>
						    			<volist name="delivers" id="user">
											<option <if condition="$selectUserId eq $user['uid']">selected</if> value="{pigcms{$user['uid']}">{pigcms{$user['name']}</option>
						    			</volist>
						    		</select>
						    </span> -->
						    <!--span class="mar_l_10">订单号：<input type="text" id="order_number" name="order_number" <if condition="$orderNum">value="{pigcms{$orderNum}"></if></span-->
						    <span class="mar_l_10">用户手机号：<input type="text" id="phone" name="phone" <if condition="$phone">value="{pigcms{$phone}"></if></span>
						    <span class="mar_l_10"><button id="search" class="btn btn-success">搜索</button></span>
						</div>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>订单ID</th>
								<th>订单来源</th>
								<th>配送员昵称</th>
								<th>配送员手机号</th>
								<th>配送员类型</th>
								<th>店铺名称</th>
								<th>订单价格</th>
								<th>客户昵称</th>
								<th>客户手机号</th>
								<th>客户地址</th>
								<th>支付方式</th>
								<th>支付状态</th>
								<th>配送状态</th>
								<th>开始时间</th>
								<th>结束时间</th>
								<!--th>创建时间</th-->
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($supply_info)">
								<volist name="supply_info"  id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td width="30">{pigcms{$vo.order_id}</td>
										<td width="50"><if condition="$vo['item'] eq 0">快店的外卖<else />外送系统</if></td>
										<td width="30">{pigcms{$vo.name}</td>
										<td width="100">{pigcms{$vo.phone}</td>
										<td width="100">{pigcms{$vo.group}</td>
										<td width="100">{pigcms{$vo.storename}</td>
										<td width="50">{pigcms{$vo.discount_price}</td>
										<td width="50">{pigcms{$vo.username}</td>
										<td width="50">{pigcms{$vo.userphone}</td>
										<td width="50">{pigcms{$vo.aim_site}</td>
										<td width="50">{pigcms{$vo.pay_type}</td>
										<td width="50">{pigcms{$vo.paid}</td>
										<td width="50">{pigcms{$vo.order_status}</td>
										<td width="50">{pigcms{$vo.start_time}</td>
										<td width="50">{pigcms{$vo.end_time}</td>
										<!--td width="50">{pigcms{$vo.create_time}</td-->
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="16">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="16">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<script>
	var selectStoreId = {pigcms{:$selectStoreId? $selectStoreId: 0};
	var selectUserId = {pigcms{:$selectUserId? $selectUserId: 0};
	$(function(){
		$("#store").change(function(){
			selectStoreId = $("#store").val();
			selectUserId = 0;
			search();
		});
		$("#deliver").change(function(){
			selectStoreId = 0;
			selectUserId = $("#deliver").val();
			search();
		});
		$("#order_number").focus(function(){
			$("#phone").val("");
		});
		$("#phone").focus(function(){
			$("#order_number").val("");
		});
		$("#search").click(function(){
			var orderNum = $("#order_number").val();
			var phone = $("#phone").val();
			search(orderNum, phone)
		});
		function search(orderNum, phone) {
			var orderNum =  orderNum || 0;
			var phone = phone || 0;
			location.href = "{pigcms{:U('Merchant/Deliver/deliverList')}"+"&orderNum="+orderNum+"&phone="+phone+"&selectStoreId="+selectStoreId+"&selectUserId="+selectUserId;
		}
	});
</script>
<include file="Public:footer"/>