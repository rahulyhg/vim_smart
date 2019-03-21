<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>分类信息</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mball.css" /> 
	<script src="<?php echo C('JQUERY_FILE');?>"></script> 
    <style>
		.more-weak:after {
    border-left: .04rem solid #fff;
    border-bottom: .04rem solid #fff;
}
  	    .my-account {
	        color: #333;
	        position: relative;
	        background-color:#fb4746;
	        border-bottom: 1px solid #C0BBB2;
	        display: block;
	        height: 100px;
	        position: relative;
	        padding-right: .2rem;
	    }
	    .my-account>img {
	        height: 100%;
	        position: absolute;
	        right: 0;
	        top:0;
	        z-index: 0;
	    }
	    .my-account .user-info {
	        z-index: 1;
	        position: relative;
	        height: 100%;
	        padding: .28rem .2rem;
	        margin-right: .2rem;
	        box-sizing: border-box;
	        padding-left: 2rem;
	        font-size: .24rem;
	        color: #fff;
	    }
	    .my-account .uname {
	        font-size: .3rem;
	        color: #fff;
	        margin-top: .0rem;
	        margin-bottom: .12rem;
	    }
		.my-account .umoney {
	       margin-bottom: 0.06rem;
	    }
	    .my-account strong {
	        color: #FF9712;
	        font-weight: normal;
	    }
	    .my-account .avater {
	        position: absolute;
	        top: 7px;
	        left: 10px;
	        width: 80px;
	        height: 80px;
	        border-radius: 50%;
	    }

	    .orderindex .text-icon {
	        display: block;
	        font-size: .6rem;
	        margin-bottom: .18rem;
	    }
	    .order-icon {
	        display: inline-block;
	        width: .5rem;
	        height: .5rem;
	        text-align: center;
	        line-height: .5rem;
	        border-radius: .06rem;
	        color: white;
	        margin-right: .25rem;
	        margin-top: -.06rem;
	        margin-bottom: -.06rem;
	        background-color: #F5716E;
	        vertical-align: initial;
	        font-size: .3rem;
	    }

	</style>
</head>
<body>
	<div id="tips" class="tips"></div>
	<div>
		<a class="my-account" href="<?php echo U('My/myinfo');?>">
			<div style="background-color:#fb4746;"></div>
			<img class="avater" src="<?php if($now_user['avatar']): echo ($now_user["avatar"]); else: echo ($static_path); ?>images/pic-default.png<?php endif; ?>" alt="<?php echo ($now_user["nickname"]); ?>头像"/>
			<div class="user-info more more-weak">
			    <?php if(!empty($now_user)): ?><p class="uname"><?php echo ($now_user["nickname"]); ?><i class="level-icon level0"></i></p>
				<p class="umoney">余额：<strong style="color:#FFFFFF;"><?php echo ($now_user["now_money"]); ?></strong> 元</p>
				<p style="color:#FFFFFF;">积分：<strong style="color:#FFFFFF;"><?php echo ($now_user["score_count"]); ?></strong> 分</p>
				<?php else: ?>
				<p style="margin-top: 15px;font-size: 15px;">未登录，请点击登录！</p><?php endif; ?>
			</div>
		</a>
	</div>
	<dl class="list">
		<dd>
			<a class="react" href="<?php echo U('Classify/myfabu',array('uid'=>$uid));?>">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#0092DE;">我</i>我的发布<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="<?php echo U('Classify/myCollect',array('uid'=>$uid));?>">
				<div class="more more-weak">
					<i class="text-icon order-fav order-icon" style="background-color:#F5716E;">☆</i>我的收藏<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<dl class="list">
		<dd>
			<a class="react" href="/wap.php?g=Wap&c=Classify&a=index">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:green">H</i>分类信息首页<span class="more-after"></span>
				</div>
			</a>
	    </dd>
		<dd>
			<a class="react" href="<?php echo U('Classify/SelectSub',array('cid'=>0));?>">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#EB2C00;">发</i>免费发布信息<span class="more-after"></span>
				</div>
			</a>
	</dd>
	</dl>
	<?php if(!empty($classifyslider)): ?><link rel="stylesheet" href="<?php echo ($static_path); ?>classify/showcase.css" /> 
<style type="text/css">
 .nav-item{border: 0;}
</style>
   <!--<div class="nav-item">
    <a class="mainmenu js-mainmenu" href="<?php echo ($svv['url']); ?>"><span class="mainmenu-txt"><?php echo ($svv['name']); ?></span></a>
   </div>-->
  <div class="footermenu"> 
  <ul>
	<?php if(is_array($classifyslider)): $i = 0; $__LIST__ = $classifyslider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svv): $mod = ($i % 2 );++$i;?><li>
     <a href="<?php echo ($svv['url']); ?>">
        <!--<img src="">-->
       <p><?php echo ($svv['name']); ?></p>
        </a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul> 
 </div><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>

</body>
</html>