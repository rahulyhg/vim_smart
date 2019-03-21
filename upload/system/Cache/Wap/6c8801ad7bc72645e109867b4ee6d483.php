<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($thisCompany["name"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="<?php echo ($static_path); ?>card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
</head>

<body id="cardunion" class="mode_webapp2">
<div class="qiandaobanner"><a href="javascript:history.go(-1);"><img src="<?php if($thisCard["contact"] != ''): echo ($thisCard["contact"]); else: ?>/static/images/cart_info/addr.jpg<?php endif; ?>" ></a> </div>
<?php if(is_array($companies)): $i = 0; $__LIST__ = $companies;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$thisCompany): $mod = ($i % 2 );++$i;?><div class="cardexplain">
<ul class="round">
<li class="userinfo"><a href="/wap.php?g=Wap&c=Card&a=companyIntro&token=<?php echo ($token); ?>&companyid=<?php echo ($thisCompany["store_id"]); ?>"><span><?php if($thisCompany["name"] != ''): echo ($thisCompany["name"]); else: ?>商家未设置<?php endif; ?></span></a></li>
<li class="tel"><a href="tel:<?php echo ($thisCompany["phone"]); ?>"><span><?php if($thisCompany["phone"] != ''): echo ($thisCompany["phone"]); else: ?>商家未设置电话<?php endif; ?></span></a></li>
<li class="address"><a href="javascript:;"><span><?php if($thisCompany["adress"] != ''): echo ($thisCompany["adress"]); else: ?>商家未设置地址<?php endif; ?></span></a></li>
<li class="detail"><a href="/wap.php?g=Wap&c=Card&a=companyIntro&token=<?php echo ($token); ?>&companyid=<?php echo ($thisCompany["store_id"]); ?>"><span>查看介绍</span></a></li>
</ul>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="footermenu">
	<ul>
		<li>
			<a href="javascript:history.go(-1);">
				<img src="<?php echo ($static_path); ?>card/images/return.png">
				<p>返回</p>
			</a>
		</li>
		<li>
			<a <?php if($infoType=='memberCardHome'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=index&token=<?php echo ($token); ?>">
				<img src="<?php echo ($static_path); ?>card/images/home.png">
				<p>会员卡首页</p>
			</a>
		</li>
		<li>
			<a <?php if($infoType=='companyDetail'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=companyDetail&token=<?php echo ($token); ?>">
				<img src="<?php echo ($static_path); ?>card/images/detaila.png">
				<p>商家详情</p>
			</a>
		</li>
		<li>
			<a <?php if($infoType=='myCard'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=index&token=<?php echo ($token); ?>&mycard=1">
				<!--span class="num2" ><?php echo ($cardsCount); ?></span--><img src="<?php echo ($static_path); ?>card/images/my.png">
				<p>我的会员卡</p>
			</a>
		</li>
	</ul>
</div>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Card",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Card/index',array('token'=>$token));?>",
            "tTitle": "会员卡",
            "tContent": ""
};
</script>
<?php echo ($shareScript); ?>

<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
</body>
</html>