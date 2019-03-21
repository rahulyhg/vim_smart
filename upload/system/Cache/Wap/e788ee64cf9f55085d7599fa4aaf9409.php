<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($thisCard["cardname"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="<?php echo ($static_path); ?>css/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
</head>
<?php if($error < 0): ?><body id="cardunion" class="mode_webapp2">
<?php else: ?>
<body id="card" class="mode_webapp"><?php endif; ?>
<?php if($error < 0): ?><div class="error" style="margin:50px auto 20px auto;text-align:center"><img src="/static/images/card/error.jpg" /></div>
<div style="font-size:14px;text-align:center"><?php if($error==-1){ ?>会员卡暂时缺货<?php }elseif($error==-2){ ?>您的积分不够<?php }elseif($error==-3){ ?>领取此会员卡需要<?php echo ($thisCard["miniscore"]); ?>积分，而您只有<?php echo ($userScore); ?>积分<?php }elseif($error==-4){ ?>还没领取会员卡，现正在跳转<?php } ?></div>
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
<?php else: ?>
<div id="overlay"></div>
<div class="cardcenter">
<div class="card"><img src="<?php if($thisCard['diybg']!=''){ echo ($thisCard["diybg"]); }else{ echo ($thisCard["bg"]); }?>" class="cardbg" />
<?php if($card.logo): ?><img id="cardlogo" class="logo" src="<?php echo ($thisCard["logo"]); ?>"><?php endif; ?>
<h1 style="color:<?php echo ($card["vipnamecolor"]); ?>"><?php echo ($thisCard["cardname"]); ?></h1>
<strong class="pdo verify" style="color:<?php echo ($card["numbercolor"]); ?>"><span id="cdnb" ><em>会员卡号</em><?php echo ($thisMember["number"]); ?></span></strong> </div>
<p class="explain"><span><?php echo ($thisCard["msg"]); ?></span></p>
<div class="window" id="windowcenter">
<div id="title" class="wtitle">领卡信息<span class="close" id="alertclose"></span></div>
<div class="content">
<div id="txt"></div>
<p>
<input name="truename" value=""  class="px" id="truename"  type="text" placeholder="请输入您的姓名">
</p>
<p>
<input name="tel"  class="px" id="tel"  value=""  type="number"  placeholder="请输入您的电话">
</p>
<input type="button" value="确 定" name="确 定" class="txtbtn" id="windowclosebutton">
</div>
</div>
</div>


<div class="cardexplain" >
<style>
		.button{width:100%;margin-bottom:10px;}
		.button .b1,.button .b2{width:49%;text-align:center;font-weight:bold;text-align:center;line-height:40px;background:#1cc200; border: 1px solid #179f00;border-radius: 5px;color:#fff;}
		.button a:hover{background:#179f00}
		.button .b1{margin-right:2px;float:left;}
		.button .b2{float:right;}
</style>

<!--div class="button">
	<a href="<?php echo U('Card/topay', array('token' => $token,'cardid'=>$card['id']));?>" class="b1">充值</a>
	<a href="<?php echo U('Card/consume', array('token' => $token,'cardid'=>$card['id']));?>" class="b2">消费</a>
	<div class="clr"></div>
</div-->

<ul class="round" id="notice">
<li><a href="/wap.php?g=Wap&c=Card&a=my_coupon&token=<?php echo ($token); ?>&cardid=<?php echo ($card["id"]); ?>"><span>会员优惠<?php if ($couponCount>0){echo '<em class="ok">'.$couponCount.'</em>';}else{echo '<em class="error">0</em>';}?></span></a></li>
<!--li><a href="/wap.php?g=Wap&c=Card&a=previlege&token=<?php echo ($token); ?>&cardid=<?php echo ($card["id"]); ?>"><span>会员特权<?php if ($previlegeCount>0){echo '<em class="ok">'.$previlegeCount.'</em>';}else{echo '<em class="error">0</em>';}?></span></a></li-->

<?php if($openCount > 0): ?><li><a href="/wap.php?g=Wap&c=Card&a=gifts&token=<?php echo ($token); ?>&cardid=<?php echo ($card["id"]); ?>"><span>开卡即赠<?php if ($openCount>0){echo '<em class="ok">'.$openCount.'</em>';}?></span></a></li><?php endif; ?>
<li><a href="/wap.php?g=Wap&c=Card&a=notice&token=<?php echo ($token); ?>&cardid=<?php echo ($card["id"]); ?>"><span>最新通知<?php if ($noticeCount>0){echo '<em class="ok">'.$noticeCount.'</em>';}else{echo '<em class="error">0</em>';}?></span></a></li>
<li><a href="<?php echo U('Userinfo/index',array('token' => $token,'cardid' => (int)$_GET['cardid'],'redirect'=>'Card/card|cardid:'.(int)$_GET['cardid']));?>"><span>个人资料</span></a></li>
</ul>


<ul class="round">
<li><a href="/wap.php?g=Wap&c=Card&a=cardIntro&token=<?php echo ($token); ?>&cardid=<?php echo ($card["id"]); ?>"><span>会员卡说明</span></a></li>
<li><a href="/wap.php?g=Wap&c=Card&a=companyDetail&token=<?php echo ($token); ?>"><span>商家电话及地址</span></a></li>
</ul>

      </div>

<div style="height:40px;"></div>
<div class="footermenu">
    <ul>
        <li>
            <a href="/wap.php?g=Wap&c=Card&a=index&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>">
           	<img src="/static/images/card/home.png">
            <p>首页</p>
            </a>
        </li>
        
        <li>
            <a <?php if(ACTION_NAME=='card'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=card&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>">
           	<img src="/static/images/card/c.png">
            <p>会员卡</p>
            </a>
        </li>

        <li>
            <a <?php if(ACTION_NAME=='notice'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=notice&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>">
           	<img src="/static/images/card/prev.png">
            <p>通知</p>
            </a>
        </li>

        <li>
            <a <?php if(ACTION_NAME=='signscore'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=signscore&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>">
           	<img src="/static/images/card/intergral.png">
            <p>签到</p>
            </a>
        </li>

        <li>
            <a <?php if(ACTION_NAME=='cards'){ ?>class="active"<?php } ?> href="/wap.php?g=Wap&c=Card&a=cards&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>">
           	<img src="/static/images/card/my.png">
            <p>会员中心</p>
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

<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div><?php endif; ?>

</body>
</html>