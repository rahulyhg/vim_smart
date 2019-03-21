<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($thisCard["cardname"]); ?>优惠券</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="<?php echo ($static_path); ?>card/style/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>
<script src="/static/js/alert.js" type="text/javascript"></script>
<script src="<?php echo ($static_path); ?>card/js/accordian.pack.js" type="text/javascript"></script>
<style>
header {
    margin: 0 10px;
    position: relative;
    z-index: 4;
}
header ul {
	margin:0 -1px;
	border: 1px solid #179f00;
	border-radius: 3px;
	width: 100%;
	overflow: hidden;
}
header ul li a.bl {
    border-left: 0.5px solid #0b8e00;
}
header ul li a.on {
    background-color:#179f00;
    color: #ffffff;
    background-image: -moz-linear-gradient(center bottom , #179f00 0%, #5dd300 100%);
}
header ul li a {
    color: #0b8e00;
    display: block;
    font-size: 15px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    width:50%;
    float:left;
}
.pic{width:100%;margin-bottom:10px;}
.over{background:#aaa;border:1px solid #aaa;box-shadow: 0 1px 0 #cccccc inset, 0 1px 2px rgba(0, 0, 0, 0.5);}
.window .title{background-image: linear-gradient(#179f00, #179f00);}
</style>
</head>
<body id="cardnews" onLoad="new Accordian('basic-accordian',5,'header_highlight');" class="mode_webapp">
<div class="qiandaobanner">
	<a href="javascript:history.go(-1);"><img src="<?php echo ($thisCard["vip"]); ?>" ></a>
</div>
<header>
	<nav id="nav_1" class="p_10">
		<ul class="box">
			<li><a href="wap.php?g=Wap&c=Card&a=my_coupon&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>&type=2" class="<?php if($type == 2): ?>on<?php endif; ?>">优惠券</a></li>
			<li><a href="wap.php?g=Wap&c=Card&a=my_coupon&token=<?php echo ($token); ?>&cardid=<?php echo ($thisCard["id"]); ?>&type=3" class="<?php if($type == 3): ?>on<?php endif; ?>">礼品券</a></li>
		</ul>
	</nav>
</header>
<div id="basic-accordian">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div id="test<?php echo ($item["id"]); ?>-header" class="accordion_headings  <?php if ($item['id']==$firstItemID){?>header_highlight<?php } ?>">
<div class="tab  <?php if($type == 3): ?>gift<?php else: ?>coupon<?php endif; ?>">
<span class="title">
<?php echo ($item["title"]); ?>(<?php if($type == 3): echo ($item["integral"]); ?>积分兑换<?php else: ?>可领取<?php echo ($item["count"]); ?>张<?php endif; ?>)
<p>有效期至<?php echo (date('Y年m月d日',$item["enddate"])); ?></p>
</span>
</div>
<div id="test<?php echo ($item["id"]); ?>-content">
<div class="accordion_child">
<div id="queren<?php echo ($item["id"]); ?>">
	<img src="<?php echo ($item["pic"]); ?>" class="pic">
	<a  class="submit <?php if($item["count"] < 1): ?>over<?php endif; ?>" href="javascript:void(0)" onclick="payformsubmit(<?php echo ($item["id"]); ?>)"><?php if($item["count"] < 1): ?>已经领光了<?php else: ?>点击领取<?php endif; ?></a>	
</div>
<ul style="min-height:230px;">
<b>领取要求：</b>
<?php if($type == 3): ?><li>领取礼品卷要消耗<span class="max_count"><?php echo ($item["integral"]); ?></span>点积分。</li>
<?php else: ?>
<li>每人最多领取<span class="max_count"><?php echo ($item["people"]); ?></span>张，您已经领取了<span class="get_count"><?php echo ($item["get_count"]); ?></span>张</li><?php endif; ?>
<b>详情说明：</b>
<p><?php echo ($item["info"]); ?></p></ul>
<div style="clear:both;height:20px;"></div>
</div> 
<div style="clear:both;height:20px;"></div>
</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<script>
var jQ = jQuery.noConflict();

function payformsubmit(itemid){
	var submitData = {
		coupon_id:itemid,
		cardid: <?php echo ($thisCard["id"]); ?>,
		type: <?php echo ($type); ?>,
		cat:3,
	};

	jQ.post('/wap.php?g=Wap&c=Card&a=action_myCoupon&token=<?php echo ($token); ?>', submitData,function(data) {
		if(data.err == 0){
			jQ('.count').html(jQ('.count').html()-1);
		}
		alert(data.info);
	}, "json");


}




</script>
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