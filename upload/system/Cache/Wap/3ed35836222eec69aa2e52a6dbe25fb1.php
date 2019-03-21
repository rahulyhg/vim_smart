<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($thisCard["cardname"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="<?php echo ($static_path); ?>card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo ($static_path); ?>card/js/accordian.pack.js" type="text/javascript"></script>
</head>
<body id="cardnews" onLoad="new Accordian('basic-accordian',5,'header_highlight');" class="mode_webapp">
<div class="qiandaobanner"><a href="javascript:history.go(-1);"><img src="<?php echo ($thisCard["Lastmsg"]); ?>" ></a> </div>

<div id="basic-accordian">
<?php if(is_array($notices)): $i = 0; $__LIST__ = $notices;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div id="test<?php echo ($item["id"]); ?>-header" class="accordion_headings <?php if ($item['id']==$firstItemID){?>header_highlight<?php } ?>">
<div class="tab new">
<span class="title"><?php echo ($item["title"]); ?><p><?php echo (date('Y年m月d日',$item["time"])); ?></p></span>
</div>
<div id="test<?php echo ($item["id"]); ?>-content" style=" display: block; overflow: hidden; opacity: 1; ">
<div class="accordion_child">

<p class="xiangqing"><?php echo ($item["content"]); ?></p>

</div>
</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?> 
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

<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
</body>
</html>