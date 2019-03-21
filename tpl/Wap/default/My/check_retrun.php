<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>交易详情</title>
	<script src="{pigcms{$static_path}js/jquery.js" language="javascript" type="text/javascript"></script>
    <link href="{pigcms{$static_path}css/weui.css" rel="stylesheet" type="text/css" />
	<style type="text/css"> 
        body{background: #f5f5f5;margin: 0px;}
		.wxzf{width: 100%;height: 50px;margin-top: 30px; }
		.zhifu{width:95%;height:50px;border-radius:5px;background-color:#04BE02;border:0px #04BE02 solid;cursor:pointer;color:white;font-size:16px;}
        .weui_icon_area{width: 70px;height: 70px;margin: 0 auto;margin-top:30px;}
        .weui_icon_area img{width: 70px;height: 70px;}
        .zfcg{text-align: center;margin-top: 15px;}
        .jiner{width: 100%;height: 35px;text-align: center;line-height: 35px;font-size:26px;font-family:Helvetica;margin-bottom: 15px;}
        .skr{width: 92%;height: 40px;line-height: 40px;font-size:14px;font-family:Helvetica;margin: 0 auto;border: 1px solid #e1e1e1;border-right: 0;border-left: 0;}
        .jiner_1 span{font-family:Helvetica;font-size: 38px; }
        .skr span{color: #858585;}
        .xm{float: right;}
    </style>  
    <script type="text/javascript">
		$(function(){
			$('.weui_btn_primary').click(function(){
				//window.close();   //关闭当前页面
				window.location.href="{pigcms{$config['site_url']}/index.php?g=WapMerchant&c=Index&a=index";
			})
		})
    </script>
</head>
<body>
<div id="innerHtml">
	<div class="weui_icon_area">
		<img src="{pigcms{$static_path}/images/123.png">
	</div>
	<div class="zfcg" style="padding-bottom:14px;">
		<span style="font-size:19px;color:#3fb837;font-family:Helvetica;" id="paySatus">收款成功</span>
	</div>		
	<div class="jiner">
		<div class="jiner_1"><span id="money">￥{pigcms{$view_content.money}<span></div>
	</div>
	<div class="skr">
		<div class="skr_1"><span class="sk">付款人</span><span class="xm">{pigcms{$view_content.title}</span></div>
	</div>
	<div align="center" class="wxzf">
		<button class="zhifu weui_btn weui_btn_primary" type="button">完成</button>
	</div>
</div>
</body>
</html>
