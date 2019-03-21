<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN" class="index_page">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="location" content="" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <meta name="keywords" content="" /> 
  <meta name="description" content="" /> 
  <title>分类信息</title> 
  <link rel="apple-touch-icon-precomposed" href="" /> 
  <link rel="apple-touch-startup-image" href="" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mindex.css" /> 
  <link href="<?php echo ($static_path); ?>css/idangerous.swiper.css" rel="stylesheet"/>
  <link href="www.hdhsmart.com/tpl/WapMerchant/deafult/static/css/weui.css" rel="stylesheet"/>
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <style type="text/css">
  .pc_banner img{width:100%;height:150px;}
  .both {clear:both;}
  </style>
 </head>
 <body class="hIphone"> 
  <div class="header"> 
   <!--<a class="logo" rel="nofollow" href="/wap.php?g=Wap&c=Classify&a=index"> <img src="<?php echo ($static_path); ?>classify/logo_white.png" alt="" width="69" height="20" /> </a> 
   <a class="city_a" href="" > 
    <div class="city">
	<?php echo ($Nowarea['area_name']); ?>
    </div> 
    <!--<div class="city_ico"></div> </a> -->
   <div class="search "> 
    <form action="" method="get" onsubmit="return win.submit();"> 
     <div class="search_input"> 
      <a id="searchUrl" class="search_url_new" href="javascript:;" style="height: 34px; line-height: 34px;">找你所找，寻你所寻</a> 
      <span class="ico_clear body_bg" onclick="win.clear(this)"></span> 
     </div> 
     <div id="qixc" class="search_but body_bg"></div> 
    </form>
   </div> 
  </div> 
  <div id="index"> 
<!--
   <div class="pc_banner"> 
    <?php if(false AND !empty($classify_index_ad)): ?><ul>
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo ($adimg['url']); ?>" />  <img src="<?php echo ($adimg['pic']); ?>" alt="<?php echo ($adimg['name']); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul> 
	
    <div class="banner_icon">
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><i></i><?php endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>
   </div> --->

 <?php if(!empty($classify_index_ad)): ?><section class="banner" style="height:150px;">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
					<a href="<?php echo ($adimg['url']); ?>">
						<img src="<?php echo ($adimg['pic']); ?>" alt="<?php echo ($adimg['name']); ?>"/>
					</a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</section><?php endif; ?>

   <div class="flxx">
   <div class="flxx_nav">
		<div class="flxx_zb">
			<div class="flxx_ty"><img src="<?php echo ($static_path); ?>/classify/img/ft.jpg" style="width:50%; height:50%;"/></div>
			<div class="flxx_ty2"><a href="<?php echo U('Classify/SelectSub',array('cid'=>0));?>" rel="nofollow">发布信息</a></div>
			<div class="both"></div>
		</div>
		<div class="flxx_yb">
			<div class="flxx_ty"><img src="<?php echo ($static_path); ?>/classify/img/ft2.jpg" style="width:50%; height:50%;"/></div>
			<div class="flxx_ty2"><a href="<?php echo U('Classify/myCenter',array('uid'=>$uid));?>" rel="nofollow">个人中心</a></div>
			<div class="both"></div>
		</div>
		<div class="both"></div>
	</div>
	</div>
  <div class="flxx3">
		<if condition="!empty($Zcategorys)" >
			<?php if(is_array($Zcategorys)): $i = 0; $__LIST__ = $Zcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zv): $mod = ($i % 2 );++$i;?><div class="flxx_zp">
				<!--<div class="flxx_xx2">招聘 ></div>
				<div class="flxx_xx3">发布信息</div>-->
				<div class="flxx_xx2"><a href="<?php echo U('Classify/Subdirectory',array('cid'=>$zv['cid'],'ctname'=>urlencode($zv['cat_name'])));?>"><?php echo ($zv['cat_name']); ?></a></div> 				
				<div class="flxx_xx3"><a href="<?php echo U('Classify/SelectSub',array('cid'=>$zv['cid']));?>#ct_item_<?php echo ($zv['cid']); ?>">发布信息</a></div>
				<div class="both"></div>
			</div><div class="both"></div>
			<div class="flxx_zw">
				<div class="flxx_fe">
					<if condition="!empty($zv['subdir'])">
					<?php $tt=count($zv['subdir']); ?>
					<?php if(is_array($zv['subdir'])): $m = 0; $__LIST__ = $zv['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($m % 3 );++$m;?><div class="flxx_fe2"> 
							<a href="<?php echo U('Classify/Lists',array('cid'=>$sv['cid']));?>"><?php echo ($sv['cat_name']); ?></a>&nbsp; 
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="both"></div>
					<if>					
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<if>
	</div>  
	
	
	
	
	
	
	</div>
  <!-- 搜索框 -->
<div class="search_container">
    <form action="" method="get" onsubmit="win.getData();return false;">
        <div class="search_input">
            <input type="text" name="key" class="input_keys" id="keyWords1" value="" onblur="win.blur()" onfocus="win.focus()" onkeyup="win.getData()" autocomplete="off">
            <i class="search_icon"></i>
        </div>
        <div class="search_cancel" onclick="win.cancel()">取消</div>
    </form>
    <div class="search_ajax"> </div>
    <div class="no_search">  
    <div class="hot_word">
	</div>
	</div>
</div>
<div style="margin-bottom: 100px;">
</div>

  <!--<div id="tipsDiv">正在获取位置信息...</div>---> 
   <script async="" src="<?php echo ($static_path); ?>classify/myhonepage.js"></script> 
   <script src="<?php echo ($static_path); ?>js/idangerous.swiper.min.js"></script>
   <script>
   var mySwiper = $('.swiper-container').swiper({
	pagination:'.swiper-pagination',
    loop:true,
    grabCursor: true,
    paginationClickable: true
});
</script>
 </body>
</html>