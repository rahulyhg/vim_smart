<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$thisCompany.name}</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="{pigcms{$static_path}card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
</head>
<style>

.integral_table th{
	font-size:14px;
	font-weight:normal;
	background-color:#eee;
	border-top: 1px solid #e3e3e3;
	border-bottom: 1px solid #e3e3e3;
	text-align:left;
	padding:3px 5px 3px 5px;
}

.integral_table td{
	font-size:12px;
	color: #797979;
	border-bottom: 1px solid #e3e3e3;
	text-align:left;
	background-color:#fff;
	padding:10px 10px 8px 10px;
}
.integral_table tfoot td{
	border-bottom: 0;
}

.integral_table td .yqian{
	color: #02ae02;
}
.integral_table td .wqian{
	color: #797979;
}
.integral_table td.right{
	text-align:right;
}
.integral_table td .heji{
	color: #02ae02;
}
	.but {
		width:100%;
		background-color: #179F00;
		padding: 10px 20px;
		font-size: 16px;
		text-decoration: none;
		border: 1px solid #0B8E00;
		background-image: linear-gradient(bottom, #179F00 0%, #5DD300 100%);
		background-image: -o-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
		background-image: -moz-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
		background-image: -webkit-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
		background-image: -ms-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
		background-image: -webkit-gradient(
		 linear,
		 left bottom,
		 left top,
		 color-stop(0, #179F00),
		 color-stop(1, #5DD300)
		 );
		-webkit-box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
		box-shadow: 0 1px 0 #94E700 inset, 0 1px 2px rgba(0, 0, 0, 0.5);
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
		color: #ffffff;
		display: block;
		text-align: center;
		text-shadow: 0 1px rgba(0, 0, 0, 0.2);

	}
	
	.box {
		text-align:center;
	}

.jifen-box {
	margin:10px 5px;
}
</style>
<body id="cardunion" class="mode_webapp2">

<div class="qiandaobanner"><a href="javascript:history.go(-1);"><img src="{pigcms{$thisCard.recharge}" ></a> </div>

	<div class="jifen-box">


		<h3>会员卡充值</h3>
		<div class="box">
			<form action="{pigcms{:U('Card/payAction',array('token'=>$token))}" method="post">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="integral_table">
					<tr>
						<td><b>卡号</b></td>
						<td>{pigcms{$card.number}</td>
					</tr>
					<tr>
						<td><b>金额</b></td>
						<td><input type="text" name="price" style="width:90%;height:35px;line-height:35px;border:1px solid #eee" /> 元</p></td>
					</tr>
					<!--tr>
						<td colspan="2">
							<input type="hidden" name="cardid" value="{pigcms{$info.cardid}" />
							<input type="hidden" name="number" value="{pigcms{$card.number}" />
							<input type="hidden" name="token" value="{pigcms{$info.token}" />
							<input type="submit" value="充值" class="but" />
						</td>
					</tr-->
			</form>
		</div>
		<div class="clr"></div>
	</div>

<include file="Card:bottom"/>
<include file="Card:share"/>
</body>
</html>
