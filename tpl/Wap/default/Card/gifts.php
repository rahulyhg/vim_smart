<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$thisCard.cardname}开卡赠送</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="{pigcms{$static_path}card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
<script src="/static/js/alert.js" type="text/javascript"></script>
<style>
.window .title{background-image: linear-gradient(#179f00, #179f00);}
.accordion_headings .tab  {background-size:40px 40px;}
.accordion_headings .integral_info{padding-left:46px;}
</style>
</head>
<body id="cardnews" onLoad="new Accordian(&#39;basic-accordian&#39;,5,&#39;header_highlight&#39;);" class="mode_webapp">
<div id="basic-accordian">
<volist name="list" id="item">
<div id="test{pigcms{$item.id}-header" class="accordion_headings  <?php if ($item['id']==$firstItemID){?>header_highlight<?php } ?>">

<div class="tab  <if condition="$item.type eq '1'">integral_info<else/>coupon</if>">
<div>
	{pigcms{$item.name}<if condition="$item.type eq '1'">({pigcms{$item.item_value}点)</if>
	<p><?php if ($item['type']&&$item['end']){?>有效期至{pigcms{$item.end|date='Y年m月d日',###}<?php }else{ ?>无限期<?php } ?></p>
</div>
</div>

</div>

</volist>
</div>


<include file="Card:cardFooter"/>
<include file="Card:share"/>
</body>
</html>