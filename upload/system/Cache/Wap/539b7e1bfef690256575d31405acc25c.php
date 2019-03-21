<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <title>我的收藏</title> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mball.css" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/ucenter_v.css" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script> 
    <style type="text/css">
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
	        padding: 14px 0px;
	        margin-right: .2rem;
	        box-sizing: border-box;
	        padding-left: 6.2rem;
	        font-size: .74rem;
	        color: #666;
			width: 85%;
	    }
	    .my-account .uname {
	        font-size: .94rem;
	        color: #fff;
	        margin-top: .0rem;
	        margin-bottom: .2rem;
	    }
		.my-account .umoney {
	       margin-bottom: 0.08rem;
		color:#FFFFFF;
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
	    .my-account .more.more-weak:after {
	        border-color: #666;
	        -webkit-transform: translateY(-50%) scaleY(1.2) rotateZ(-135deg);
	    }
 </style>
 </head> 
 <body> 
  <div class="body_div"> 
  	<div>
		<a class="my-account" href="<?php echo U('My/myinfo');?>">
			<div style="background-color:#fb4746;"></div>
			<img class="avater" src="<?php if($now_user['avatar']): echo ($now_user["avatar"]); else: echo ($static_path); ?>images/pic-default.png<?php endif; ?>" alt="<?php echo ($now_user["nickname"]); ?>头像"/>
			<div class="user-info more more-weak">
			    <?php if(!empty($now_user)): ?><p class="uname"><?php echo ($now_user["nickname"]); ?><i class="level-icon level0"></i></p>
				<p class="umoney">余额：<strong style="color:#FFFFFF;"><?php echo ($now_user["now_money"]); ?></strong> 元</p>
				<p style="color:#FFFFFF;">积分：<strong style="color:#FFFFFF;"><?php echo ($now_user["score_count"]); ?></strong> 分</p>
				<?php else: ?>
				<p style="margin-top: 20px;font-size: 15px;">未登录，请点击登录！</p><?php endif; ?>
			</div>
		</a>
		<a class="c_publish" href="<?php echo U('Classify/SelectSub',array('cid'=>0));?>" style="top:25px;margin-right: 15px"> <i class="ico"></i>发布 </a>
	</div> 
   <div class="dl_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Classify&a=index">分类信息首页</a> &gt; <a href="<?php echo U('Classify/myCenter',array('uid'=>$uid));?>" rel="nofollow">个人中心</a> &gt; <a href="javascript:;" rel="nofollow" style="color: #fb4746;">我的收藏</a> </span> 
   </div> 
   <div class="ucenter"> 
    <ul class="u_infolst" id="userFav">
	  <?php if(!empty($listsdatas)): if(is_array($listsdatas)): $i = 0; $__LIST__ = $listsdatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Classify/ShowDetail',array('vid'=>$vl['id']));?>"><h2><?php echo ($vl['title']); ?></h2>
       <div class="attr">
        <span><?php echo ($vl['input1']); ?></span><br>
		<span><?php echo ($vl['input2']); ?> </span><br>
        <span><?php echo ($vl['timestr']); ?></span>
       </div></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	    <div class="u_paging"> 
		<span class="btn_clear w_auto" onclick="emptyC();">清空</span> 
		</div> 
	   <?php else: ?>
	   <li style="height: 50px;text-align: center;margin-top: 20px;font-size: 16px;">您还没有收藏任何数据</li><?php endif; ?>
    </ul> 
      <!--<div class="textcenter pagebar" style="height: 80px;padding-top: 35px;text-align: center;">
		<?php echo ($pagebar); ?>
    </div>-->

   </div> 
 
  </div> 
  <div style="margin-bottom: 100px;">
</div>
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
  <script type="text/javascript">
   var uid="<?php echo ($uid); ?>"
   function emptyC(){
      optCookie('o2oFavoriteThis','');
	  $.post("<?php echo U('Classify/emptyC');?>",{uid:uid},function(ret){
	  },'JSON');
	  $('#userFav li').remove();
	  alert('清空成功！');
   }

   /********** 操作cookie ********/
	 function optCookie(a, b, c)
	{
		if(typeof(b) == 'undefined')
		{
			var e='';
			a = a + '=';
			b = document.cookie.split(';');
			for(c = 0; c < b.length; c ++)
			{
				for(e = b[c]; e.charAt(0) == ' ';) e = e.substring(1, e.length);
				if(e.indexOf(a) == 0) return decodeURIComponent(e.substring(a.length, e.length));
			};
			return 0;
		}
		else
		{
			var f = '';
			if(c)
			{
				f = new Date();
				f.setTime(f.getTime() + c * 24 * 60 * 60 * 1000);
				f = '; expires=' + f.toGMTString();
			};
			document.cookie = a + '=' + encodeURIComponent(b) + f + '; path=/' +'';
	   };
   }

  </script>  
 </body>
</html>