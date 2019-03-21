<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>选择类别</title> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mball.css" /> 
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/publishall.css" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
 <style type="text/css">
<!--
.flxx_trr {width:33.1%; border-right:1px #e3e3e3 solid; float:left; text-align:center; font-size:14px; margin-top:8px; margin-bottom:8px;}
.flxx_trr:nth-child(3n) {border-right:none;}
-->
</style>
 </head> 
 <body> 

  <div class="dl_nav"> 
   <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a>&gt; <a href="javascript:;">发布</a>&gt; <a href="javascript:;"><h1>选择类别</h1></a> </span> 
  </div> 
  <hr />
  <div id="sub_lists">
 <?php if(!empty($Zcategorys)): if(is_array($Zcategorys)): $i = 0; $__LIST__ = $Zcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zv): $mod = ($i % 2 );++$i;?><dl class="business" id="ct_item_<?php echo ($zv['cid']); ?>"> 
   <dt class="">
   <?php echo ($zv['cat_name']); ?>
   </dt> 
   <dd> 
	<?php if(!empty($zv['subdir'])): if(is_array($zv['subdir'])): $i = 0; $__LIST__ = $zv['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><div class="flxx_trr"><a href="<?php echo U('Classify/fabu',array('cid'=>$sv['cid'],'fcid'=>$sv['fcid'],'pfcid'=>$sv['pfcid']));?>"><?php echo ($sv['cat_name']); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?><div style="clear:both"></div><?php endif; ?>
   </dd> 
  </dl><?php endforeach; endif; else: echo "" ;endif; ?>
  <?php else: ?>
  <dl> 
   <dd style="text-align: center;font-size: 20px;height: 50px;line-height: 50px;"> 
	 请联系管理员后台添加分类！
   </dd> 
  </dl><?php endif; ?>

 </div>
  <!--<dl class="business only exp" onclick="window.location.href=''"> 
   <dt class="job">
    发布招聘信息
   </dt> 
  </dl>----> 


  
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
	var new_nav = new function() {};
	var x;
	var old_navigator = window.navigator;
	for (x in navigator) {
		if (typeof navigator[x] == 'function') {
			eval("new_nav." + x + " = function() { return old_navigator." + x
					+ "();};");
		} else {
			eval("new_nav." + x + " = navigator." + x + ";");
		}
	}
	new_nav.userAgent = "Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19";
	new_nav.vendor = "";
	window.navigator = new_nav;
    $(".business dt").bind("click",
    function() {
        var $this = $(this).parent();
        if ($this.hasClass("exp")) {
            $this.removeClass("exp");
        } else {
            var scrollTop = document.body.scrollTop;
            $this.addClass("exp");
            window.scrollTo(0, scrollTop);
        }
    });
var cid=0;
<?php if($cid > 0): ?>cid="<?php echo ($cid); ?>";<?php endif; ?>

if(cid){
 var tmplen=$('#ct_item_'+cid).size();
  $('#sub_lists .business').removeClass("exp");
 if(tmplen>0){
     $('#ct_item_'+cid).addClass("exp");
 }else{
    $('#sub_lists dl:first').addClass("exp");
 }
}else{
  $('#sub_lists dl:first').addClass("exp");
}
</script> 
 </body>
</html>