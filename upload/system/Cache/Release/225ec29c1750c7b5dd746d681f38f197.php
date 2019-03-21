<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title><?php echo ($ctname); ?></title> 
  <meta name="keywords" content="<?php echo ($fcategory['seo_keywords']); ?>" /> 
  <meta name="description" content="<?php echo ($fcategory['seo_description']); ?>" /> 
  <meta name="location" content="" /> 
   <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/subdirectory.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/common.css" />
 </head> 
 <body> 
  <!-- topbar --> 
  <div id="site-mast" class="site-mast"><div class="site-mast__user-nav-w">
	<div class="site-mast__user-nav cf">
		<ul class="basic-info">
			<li class="user-info cf">
				<?php if(empty($user_session)): ?><a rel="nofollow" class="user-info__login" href="<?php echo U('Index/Login/index');?>">登录</a>
					<a rel="nofollow" class="user-info__signup" href="<?php echo U('Index/Login/reg');?>">注册</a>
				<?php else: ?>
					<p class="user-info__name growth-info growth-info--nav">
						<span>
							<a rel="nofollow" href="<?php echo ($siteUrl); ?>/classify/userindex.html" class="username"><?php echo ($user_session["nickname"]); ?></a>
						</span>
						<a class="user-info__logout" href="<?php echo ($siteUrl); ?>/classify/userlogout.html">退出</a>
					</p><?php endif; ?>
            </li>
			<li class="user-info cf">
				<div class="span">|</div>
            </li>
			<li id="dropdown_wx_toggle" class="mobile-info__item dropdown dropdown--open-app">
				<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
				<div class="dropdown-menu dropdown-menu--app">
					<a class="app-block" href="/topic/weixin.html">
						<span class="app-block__title">访问微信版</span>
						<span class="app-block__content" style="background:url(<?php echo ($config["wechat_qrcode"]); ?>);background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo ($config["wechat_qrcode"]); ?>',sizingMethod='scale');"></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="site-mast__user-w">
			<li class="user-orders">
                <a href="<?php echo ($siteUrl); ?>/classify/selectsub.html" rel="nofollow">免费发布信息</a>
            </li>
			<li class="user-info cf">
				<div class="span">|</div>
            </li>
			<li class="dropdown dropdown--account">
				<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="<?php echo ($siteUrl); ?>/classify/mycenter.html">
					<span>个人中心</span>
				</a>
			</li>
			<li class="user-info cf">
				<div class="span">|</div>
            </li>
			<li id="J-site-merchant" class="dropdown dropdown--merchant">
				<a class="dropdown__toggle dropdown__toggle--merchant" href="/">
					<span>网站首页</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
 $('#dropdown_wx_toggle').hover(function(e){
    $(this).addClass('dropdown--open');
 },function(e){
    $(this).removeClass('dropdown--open');
 });
</script></div> 

  <div id="homeWrap" class="wrapper"> 
   <div id="header" class="mainpage"> 
	<?php if(isset($config['classify_logo']) AND !empty($config['classify_logo'])): ?><span id="logo" style="top:10px">
	 <a href="<?php echo ($siteUrl); ?>/classify/" target="_blank"><img src="<?php echo ($config["classify_logo"]); ?>" alt="分类信息" title="分类信息" width="185" height="58" /></a>
	 </span>
	 <?php else: ?>
	 <span id="logo">
	 <a href="/" target="_blank"><img src="<?php echo ($config["site_logo"]); ?>" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="<?php echo ($siteUrl); ?>/classify/" class="classify">分类信息</a>
	 </span><?php endif; ?>
     <form action="<?php echo ($siteUrl); ?>/classify/searchlist.html" method="get" name="mysearch"> 
      <div id="searchbar"> 
       <div id="saerkey"> 
        <span><input type="text" id="keyword" name="keystr" class="keyword" value="请填写关键词进行搜索" onblur="if(this.value=='')this.value='请填写关键词进行搜索',this.className='keyword'" onfocus="if(this.value=='请填写关键词进行搜索')this.value='',this.className='keyword2'" /></span> 
       </div> 
       <div class="inputcon">
        <input type="submit" class="btnall" value="搜一搜" onmousemove="this.className='btnal2'" onmouseout="this.className='btnall'" />
       </div> 
       <div class="clear"></div> 
       <div class="search-no"> 
        <span id="hot"></span>
        <span class="hot2"></span> 
       </div> 
      </div> 
     </form> 
     <a href="<?php echo ($siteUrl); ?>/classify/selectsub.html" id="fabu" rel="nofollow"><i></i>免费发布信息</a>
     <!--<a href="<?php echo U('Classify/myCenter');?>" id="delinfo" rel="nofollow" class="search-no">个人中心</a>---> 
    </div> 
   
   <div class="hShadow"></div> 
   <div class="navcon" id="nav"> 
    <ul class="nav2"> 
     <li><a href="<?php echo ($siteUrl); ?>/classify/">首页</a></li> 
	 <?php if(!empty($navClassify)): if(is_array($navClassify)): $i = 0; $__LIST__ = $navClassify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php if($nav['cid'] == $cid): ?>class="on"<?php endif; ?>><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($nav['cid']); ?>.html"><?php echo ($nav['cat_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul> 
    <div id="1003" class="ad_nav"></div> 
   </div> 
  </div> 
  
    <?php if(!empty($classify_index_ad)): ?><div class="pc_banner mainpage"> 
    <ul>
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo ($adimg['url']); ?>" target="_blank">  <img src="<?php echo ($adimg['pic']); ?>" alt="<?php echo ($adimg['name']); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul> 
	
    <div class="banner_icon">
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><i alt="<?php echo ($i); ?>" <?php if($i == 1): ?>class="active"<?php endif; ?>></i><?php endforeach; endif; else: echo "" ;endif; ?>
    </div> 
	<span class="banner-close" onclick="bannerClose();">&nbsp;</span>
   </div><?php endif; ?>

  <!-- head end --> 
  <!-- main start --> 
  <div class="wb-main"> 
   <div class="wb-content mainpage"> 
    <!-- fliter start --> 
    <!-- filter end --> 
    <!-- 广告位预留 --> 
    <!--<div class="mqad clearfix">
		
		</div>--> 
   

    <!-- 职位列举 start --> 
    <div class="posExp bor clearfix" id="posExp"> 
	 <div class="title"> 
      <h2><?php echo ($ctname); ?></h2> 
     </div>
	<?php if(!empty($Subdirectory2)): if(is_array($Subdirectory2)): $i = 0; $__LIST__ = $Subdirectory2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><dl> 
      <dt> 
       <a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($sv['cid']); ?>.html"><?php echo ($sv['cat_name']); ?></a> 
      </dt> 
      <dd> 
	  	 <?php if(!empty($sv['subdir'])): if(is_array($sv['subdir'])): $i = 0; $__LIST__ = $sv['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subv): $mod = ($i % 2 );++$i;?><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($subv['fcid']); ?>-<?php echo ($subv['cid']); ?>.html"><?php echo ($subv['cat_name']); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </dd> 
     </dl><?php endforeach; endif; else: echo "" ;endif; ?>
	 <?php else: ?>
     <dl>  
      <dd class="zufang_link" style="text-align: center;font-size: 20px;height: 50px;line-height: 50px;">
	    没有子分类！
      </dd> 
     </dl><?php endif; ?> 
    </div> 
    <!--职位列举 end --> 

   </div> 
  </div> 
  <!-- main end --> 

 	<?php if(!empty($Subdirectory2)): if(is_array($Subdirectory2)): $i = 0; $__LIST__ = $Subdirectory2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ssv): $mod = ($i % 2 );++$i; if(!empty($ssv['userinput'])): ?><div class="pet-box floor mainpage">
		<h3 class="title"><span class="title-link">
		  <?php if(!empty($ssv['subdir'])){ $mm=0; foreach($ssv['subdir'] as $subv){ if($mm>=7) break; echo '<a target="_blank" href="'.$siteUrl.'/classify/list-'.$subv['fcid'].'-'.$subv['cid'].'.html">'.$subv['cat_name'].'</a>'; $mm++; } } ?>
		 <a target="_blank" href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($ssv['cid']); ?>.html">更多» </a>
		</span>
		<a target="_blank" href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($ssv['cid']); ?>.html" class="ac-green"><?php echo ($ssv['cat_name']); ?></a>
		</h3>
		<ul class="pet-list clearfix">
		<?php if(is_array($ssv['userinput'])): $i = 0; $__LIST__ = $ssv['userinput'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$usv): $mod = ($i % 2 );++$i; $imgs=unserialize($usv['imgs']);$oneImg=!empty($imgs) ? $imgs['0'] : false; ?>

		<li class="pet-list-pic">
		<a href="<?php echo ($siteUrl); ?>/classify/<?php echo ($usv['id']); ?>.html" target="_blank" title="<?php echo ($usv['title']); ?>">
		<img width="140" height="106" <?php if($oneImg): ?>src="<?php echo ($oneImg); ?>" <?php else: ?> src="<?php echo ($static_path); ?>classify/img/noimg.jpg"<?php endif; ?>></a>
		<div class="pet-list-name2">
		<a href="<?php echo ($siteUrl); ?>/classify/<?php echo ($usv['id']); ?>.html" target="_blank" title="<?php echo ($usv['title']); ?>"><?php echo ($usv['title']); ?><i class="fc-orange"></i></a>
		</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		</div><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
	   ﻿	<div class="site-info-w">
	    <div class="site-info">
	        <div class="copyright">
	            <p>&copy;<span>2015</span>&nbsp;<a href="<?php echo ($config["site_url"]); ?>"><?php echo ($config["site_name"]); ?></a>&nbsp;<?php echo ($config["top_domain"]); ?>&nbsp;<?php if(!empty($config['site_icp'])): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo ($config["site_icp"]); ?></a><?php endif; ?></p>
	        </div>
	    </div>
		<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
	</div>
 </body>
 <script  src="<?php echo ($static_path); ?>classify/banner.js"></script> 
 <script type="text/javascript">
   $('#posExp dl').hover(function(e){
	 $(this).addClass('bgColor');
  },function(e){
	 $(this).removeClass('bgColor');
  });
  </script>
</html>