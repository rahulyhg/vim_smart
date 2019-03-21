<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银</a>
			</li>
			<li class="active">数据统计</li>
		</ul>
	</div>
	<!-- 内容头部 -->   
    <link href="{pigcms{$static_path}css/animate_new.css" rel="stylesheet">
	<link href="{pigcms{$static_path}css/cashier.css" rel="stylesheet">	<!----开放式头部，请在自己的页面加上--</head>-->
	<link href="{pigcms{$static_path}plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="{pigcms{$static_path}css/app.css" rel="stylesheet">
	<style>
		.ibox-title h5 {
  			margin: 10px 0 0px;
		}
		select.input-sm {
  			height: 35px;
  			line-height: 35px;
		}
		.float-e-margins .btn-info{
			margin-bottom:0px;
			padding:3px;
		}
		.fa-paste{
			margin-right:7px;
			padding: 0px;
		}
		.dz-preview{
			display:none;
		}
		.ibox-title ul{ list-style: outside none none !important; margin: 0; padding: 0;}
		.ibox-title li { float: left;width: 30%; }
		#commonpage {float: right;margin-bottom: 10px;}
		#table-list-body .btn-st{background-color: #337ab7;border-color: #2e6da4;cursor:auto;}
	</style>

	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/statistics")}'>商家收支</button>
						<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/otherpie")}'>概况统计</button>
						<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/fans")}'>粉丝支付排行</button>
						<div class="ibox float-e-margins">
							<div class="ibox-title clearfix">								 
							</div>
							<div class="ibox-content"> 
								<nav class="ui-nav clearfix"> 
								</nav> 
								<div class="app__content js-app-main page-cashier">
									<div>
										<!-- 实时交易信息展示区域 --> 
										<div class="cashier-realtime"> 
											<div class="realtime-title-block clearfix"> 
												<h1 class="realtime-title">粉丝支付情况</h1> 
											</div> 
										</div> 
										<div class="js-real-time-region realtime-list-box loading">
											<div class="widget-list">
												<div class="js-list-filter-region clearfix ui-box" style="position: relative;">
													<div class="widget-list-filter"></div>
												</div> 
												<div class="ui-box"> 
													<table class="ui-table ui-table-list" style="padding: 0px;"> 
													<thead class="js-list-header-region tableFloatingHeaderOriginal">
													   <tr class="widget-list-header">
														<th>编号</th>
														<th>昵称</th>
														<th>头像</th>
														<th data-hide="phone">支付总额</th> 
														<th data-hide="phone">退款金额</th> 
														<th data-hide="phone">关注公众号</th>
													   </tr>
													</thead>
													<tbody class="js-list-body-region" id="table-list-body">
													   <?php if(!empty($fansarr)){
														  foreach($fansarr as $ovv){
													   ?>
													   <tr class="widget-list-item">
														<td><?php echo $ovv['id'];?></td>
														<td><?php if(!empty($ovv['nickname'])){
														  echo '<span  style="margin-right: 10px;font-size: 14px">'.$ovv['nickname'].'</span>';
														}else{echo $ovv['openid'];}?></td> 
														<td><?php if(!empty($ovv['headimgurl'])){
															echo '<img src="'.$ovv['headimgurl'].'" height="50px" width="50px">';
														  }?></td>
														<td><?php echo ($ovv['totalfee']/100);?> 元</td> 
														<td><?php echo ($ovv['refund']/100);?> 元</td> 
														<td><?php if($ovv['is_subscribe']>0){ echo "已关注";}else{echo "未关注";}?></td>
													   </tr>
													   <?php }}else{?>
													   <tr class="widget-list-item"><td colspan="7">暂无粉丝支付</td></tr>
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
<script>
$(document).ready(function(){
	$('.ui-table-list').footable();
});

function CreateShop(obj){	//点击跳转到对应的页面
	//alert(obj.value);
	window.location.href=obj.value;
}
</script>
<include file="Public:footer"/>
