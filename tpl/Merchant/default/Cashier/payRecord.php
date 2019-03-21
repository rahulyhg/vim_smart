<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银</a>
			</li>
			<li class="active">商家收银台</li>
		</ul>
	</div>
	<!-- 内容头部 -->
    <link href="{pigcms{$static_path}css/animate_new.css" rel="stylesheet">
	<link href="{pigcms{$static_path}css/cashier.css" rel="stylesheet">	<!----开放式头部，请在自己的页面加上--</head>-->
	<link href="{pigcms{$static_path}plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="{pigcms{$static_path}css/app.css" rel="stylesheet">
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/cash",array("type"=>1))}'>扫码收银</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/cash",array("type"=>2))}'>扫码退款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/ewmPay")}'>二维码收款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/ewmRecord")}'>二维码记录</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/payRecord")}'>收款记录</button>
					<div class="wrapper wrapper-content animated fadeInRight">
						<div class="row">
							<div class="col-lg-12" style="">
								<div class="ibox float-e-margins">
									<div class="ibox-title clearfix">
										<ul class="nav nav-tabs"> 
											<li> <a href="{pigcms{:U('Cashier/index')}">收银台</a> </li> 
											<li	class="active"> <a href="{pigcms{:U('Cashier/payRecord')}">收款记录</a> </li> 
											<li> <a href="{pigcms{:U('Cashier/ewmRecord')}">二维码记录</a> </li>  
										</ul> 
									</div>
									<div class="ibox-content"> 
										<nav class="ui-nav clearfix"> 
										</nav> 
										<div class="app__content js-app-main page-cashier">
											<div>
												<!-- 实时交易信息展示区域 --> 
												<div class="cashier-realtime"> 
													<div class="realtime-title-block clearfix"> 
														<h1 class="realtime-title">收款情况</h1> 
													</div> 
												</div> 
												<div class="js-real-time-region realtime-list-box loading">
													<div class="widget-list">
														<div class="js-list-filter-region clearfix ui-box" style="position: relative;">
															<div class="widget-list-filter"></div>
														</div> 
														<div class="ui-box"> 
															<table class="ui-table ui-table-list" data-page-size="20" style="padding: 0px;"> 
															<thead class="js-list-header-region tableFloatingHeaderOriginal">
															   <tr class="widget-list-header">
																<th>编号</th>
																<th data-hide="phone">付款人</th> 
																<th data-hide="phone">付款时间</th> 
																<th data-hide="phone">付款理由</th> 
																<th data-hide="phone">付款金额(元)</th>
																<th data-hide="phone">退款情况</th> 
																<th>操作</th>
															   </tr>
															</thead>
															<tbody class="js-list-body-region" id="table-list-body">
															   <?php if(!empty($neworder)){
																  foreach($neworder as $ovv){
															   ?>
															   <tr class="widget-list-item">
																<td><?php echo $ovv['id'];?></td> 
																<td><?php if(!empty($ovv['nickname'])){
																	echo $ovv['nickname'];
																}elseif(!empty($ovv['truename'])){
																	 echo htmlspecialchars_decode($ovv['truename'],ENT_QUOTES);
																}elseif(!empty($ovv['openid'])){
																	echo $ovv['openid'];
																}else{
																	echo '未知客户';
																}?></td> 
																<td><?php $paytime=$ovv['paytime'] > 0 ? $ovv['paytime'] : $ovv['add_time']; echo date('Y-m-d H:i:s',$paytime);?></td> 
																<td><?php echo htmlspecialchars_decode($ovv['goods_name'],ENT_QUOTES);?></td> 
																<td><?php echo $ovv['goods_price'];?></td>
																<td><?php if($ovv['refund']==1){?>
																	 退款中...
																<?php }elseif($ovv['refund']==2){?>
																	 已退款
																<?php }elseif($ovv['refund']==3){?>
																	 退款失败
																 <?php }else{
																	 echo "已支付";
																 } ?>
																</td> 
																<td><?php if($ovv['comefrom']>0){ ?> <button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> <?php }elseif($ovv['refund']!=2 && $ovv['refund']!=1){?> <button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button>  <?php }elseif($ovv['refund']==2){?><button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button>  <?php }?><button class="btn btn-sm btn-info" onclick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong>支付详情</strong></button>  <button class="btn btn-sm btn-danger" onclick="deltheOrder(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 删 除 </strong></button></td>
															   </tr>
															   <?php }}else{?>
															   <tr class="widget-list-item"><td colspan="7">暂无订单</td></tr>
															   <?php }?>
															</tbody> 
															</table> 
															<div class="js-list-empty-region"></div> 
														</div> 
														<div class="js-list-footer-region ui-box">
															<div class="widget-list-footer"></div>
														</div> 
													</div>
												</div> 
											</div>
										</div>
									</div> 
								</div>    
							</div>
							<?php echo $pagebar;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal inmodal" tabindex="-1" role="dialog"  id="oderinfo">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close _close"><span style="font-size: 35px;">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">支付详情</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white _close">关闭</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.ui-table-list').footable();
	});
	var screenH=$(window).height();
	screenH=  screenH-20;
	$('#oderinfo').css('height',screenH);
	
	function CreateShop(obj){	//点击跳转到对应的页面
		//alert(obj.value);
		window.location.href=obj.value;
	}
</script>
<include file="Public:footer"/>
