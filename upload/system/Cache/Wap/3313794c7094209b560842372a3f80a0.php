<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
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
  <title><?php echo ($ctname); ?></title> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mcategory.css" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script> 
 </head> 
 <body style="min-height: 600px;"> 
  <div id="banner"> 
   <div id="index_down_div"> 
    <div id="pics"> 
     <ul id="datu"></ul> 
     <div class="panel_num"></div> 
    </div> 
   </div> 
  </div> 
  <div class="header"> 
   <!--<a class="logo" rel="nofollow" href="/wap.php?g=Wap&c=Classify&a=index"> <img src="<?php echo ($static_path); ?>classify/logo_white.png" alt="" title="" width="69" height="20" /></a> 
   <a class="city_a" href=""> 
    <div class="city">
     <?php echo ($Nowarea['area_name']); ?>
    </div> 
    <!--<div class="city_ico"></div> </a> -->

   <div class="search "> 
    <form action="" method="get" onSubmit="return win.submit();"> 
     <div class="search_input"> 
      <a id="searchUrl" class="search_url_new" href="javascript:;" style="height: 34px; line-height: 34px;">找你所找，寻你所寻</a> 
      <span class="ico_clear body_bg" onClick="win.clear(this)"></span> 
     </div> 
     <div id="qixc" class="search_but body_bg"></div> 
    </form> 
   </div> 

  </div> 

  <div id="house" class="house"> 
   <!--<div class="pc_banner"> 
    <a href=""> <img src="" alt="" /> </a> 
   </div>-->  
   </div> 
   <div class="warp" style=""> 
    <div class="nav_tt nav_ttbg1 tuijian warp_nav" style="margin-top: 5px;">
     <a href="javascript:void(0)">导航</a>
    </div> 
    <div class="sm_dl" style="padding-bottom: 30px;">
	<?php if(!empty($Subdirectory2)): if(is_array($Subdirectory2)): $i = 0; $__LIST__ = $Subdirectory2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><dl> 
      <dt>
       <a href="<?php echo U('Classify/Lists',array('cid'=>$sv['cid']));?>"><?php echo ($sv['cat_name']); ?></a>
      </dt> 
      <dd class="zufang_link">
	   <?php if(!empty($sv['subdir'])): if(is_array($sv['subdir'])): $i = 0; $__LIST__ = $sv['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subv): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Classify/Lists',array('cid'=>$subv['fcid'],'sub3dir'=>$subv['cid']));?>"><?php echo ($subv['cat_name']); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </dd> 
     </dl><?php endforeach; endif; else: echo "" ;endif; ?>
	 <?php else: ?>
     <dl>  
      <dd class="zufang_link" style="text-align: center;font-size: 20px;height: 50px;line-height: 50px;">
	    没有子分类！
      </dd> 
     </dl><?php endif; ?> 

    </div> 
   </div> 
  </div> 
    <!-- 搜索框 -->
<div class="search_container">
    <form action="" method="get" onSubmit="win.getData();return false;">
        <div class="search_input">
            <input type="text" name="key" class="input_keys" id="keyWords1" value="" onBlur="win.blur()" onFocus="win.focus()" onKeyUp="win.getData()" autocomplete="off">
            <i class="search_icon"></i>
        </div>
        <div class="search_cancel" onClick="win.cancel()">取消</div>
    </form>
    <div class="search_ajax"> </div>
    <div class="no_search">  
    <div class="hot_word">
	</div>
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
  <script async="" src="<?php echo ($static_path); ?>classify/myhonepage.js"></script>  
 </body>
</html>