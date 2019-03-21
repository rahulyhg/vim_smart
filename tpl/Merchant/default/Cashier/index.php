<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银</a>
			</li>
			<li class="active">首页</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<link href="{pigcms{$static_path}css/animate_new.css" rel="stylesheet">
	<link href="{pigcms{$static_path}css/app.css" rel="stylesheet">
	<div class="row wrapper page-heading iconList">
		<ul>
			<li class="col-xs-4">
				<a href="{pigcms{:U('Cashier/cash',array('type'=>1))}"><i class="fa fa-inbox animated bounceIn"></i>刷卡收款</a>
			</li>
			<li class="col-xs-4">
				<a href="{pigcms{:U('Cashier/cash',array('type'=>2))}"><i class="fa fa-undo animated bounceIn"></i>退款</a>
			</li>
			<li class="col-xs-4">
				<a href=""><i class="fa fa-money animated bounceIn"></i>卡券核销</a>
			</li>
			<li class="col-xs-4">
				<a href="{pigcms{:U('Cashier/ewmPay')}"><i class="fa fa-qrcode animated bounceIn"></i>收款二维码</a>
			</li>
			<li class="col-xs-4">
				<a href="{pigcms{:U('Cashier/payRecord')}"><i class="fa fa-pencil animated bounceIn"></i>收款记录</a>
			</li>
			<li class="col-xs-4">
				<a href=""><i class="fa fa-file-text-o animated bounceIn"></i>核销记录</a>
			</li>
			<!--<li class="col-xs-4">
				<a href=""><i class="fa  fa-unlock-alt animated bounceIn"></i>修改密码</a>
			</li>-->
		</ul>
	</div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<include file="Public:footer"/>
