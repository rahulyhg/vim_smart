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
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title clearfix">
										<ul class="nav nav-tabs"> 
											<li> <a href="{pigcms{:U('Cashier/index')}">收银台</a> </li> 
											<li> <a href="{pigcms{:U('Cashier/payRecord')}">收款记录</a> </li> 
											<li class="active"> <a href="{pigcms{:U('Cashier/ewmRecord')}">二维码记录</a> </li> 
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
														<h1 class="realtime-title">二维码记录</h1> 
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
																	<th>二维码</th> 
																	<th data-hide="phone">付款金额(元)</th>
																	<th data-hide="phone">生成时间</th>
																	<th data-hide="phone">支付状态</th> 
																	<th data-hide="phone">付款理由</th>
																	<th>操作</th>
																</tr>
																</thead>
															<tbody class="js-list-body-region">
															   <?php if(!empty($neworder)){
																  foreach($neworder as $ovv){
															   ?>
															   <tr class="widget-list-item">
																<td><?php echo $ovv['id'];?></td> 
																<td><div class="ui-centered-image">
																<img src="<?php echo $this->RlStaticResource;?>images/qrcode.png" width="90">
																  <input type="hidden" value="<?php echo $ovv['ewmurl']?>">
																</div></td> 
																<td><?php echo $ovv['goods_price'];?></td> 
																<td><?php echo date('Y-m-d H:i:s',$ovv['add_time']);?></td> 
																<td><?php  if($ovv['ispay']>0){
																		echo '<font color="green">已支付</font>';
																	}else{
																		echo  '<font color="red">未支付</font>';
																	}?><br/><br/>
																	<?php if($ovv['refund']==1){?>
																			 退款中...
																		<?php }elseif($ovv['refund']==2){?>
																			 已退款
																		<?php }elseif($ovv['refund']==3){?>
																			退款失败
																		<?php }?>
																	</td> 
																<td><?php echo htmlspecialchars_decode($ovv['goods_name'],ENT_QUOTES);?></td> 
																<td><button class="btn btn-sm btn-danger" onclick="deltheOrder(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 删 除 </strong></button></td> 
																</tr>
																<?php }}else{?>
																<tr class="widget-list-item"><td colspan="6">暂无记录</td></tr>
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
	var bodyW=$('body').width();
	bodyW=bodyW-80;
	if(bodyW>350) bodyW=350;
	$(document).ready(function(){
		$('.ui-table-list').footable();
	   $(".ui-centered-image").click(function(){
			var ewm_url=$(this).find('input').val();
			$('#ewmPopDiv .modal-body').qrcode({ 
				//render: "table", //table方式 
				width: bodyW, //宽度 
				height:bodyW, //高度 
				text:ewm_url//任意内容 
		   });
		   $('body').append('<div class="modal-backdrop in"></div>');
		   $('#ewmPopDiv').show();
	   });

	  $("#ewmPopDiv ._close").click(function(){
		  $('#ewmPopDiv').hide();
		  $('.modal-backdrop').remove();
		  $('#ewmPopDiv .modal-body').html('');
	  });
	});
	function CreateShop(obj){	//点击跳转到对应的页面
		//alert(obj.value);
		window.location.href=obj.value;
	}
</script>
<include file="Public:footer"/>
