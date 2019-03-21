<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php if($zd['status'] == 1): echo ($zd['code']); endif; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl["wxname"]); ?></title>

<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">

<link rel="stylesheet" href="<?php echo ($static_path); ?>tpl/com/css/idangerous.swiper.css">
<link href="<?php echo ($static_path); ?>tpl/com/css/iscroll.css" rel="stylesheet" type="text/css" />

<link href="<?php echo ($static_path); ?>tpl/1268/css/cate.css" rel="stylesheet" type="text/css" />

<style>
 
 
</style>
<script src="<?php echo ($static_path); ?>tpl/com/js/iscroll.js" type="text/javascript"></script>
<script type="text/javascript">
var myScroll;

function loaded() {
myScroll = new iScroll('wrapper', {
snap: true,
momentum: false,
hScrollbar: false,
onScrollEnd: function () {
document.querySelector('#indicator > li.active').className = '';
document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
}
 });
 
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>
 
</head>
<body id="cate72">
<div class="banner">
<div id="wrapper">
<div id="scroller">
<ul id="thelist">
<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li><p><?php echo ($so["info"]); ?></p><a href="<?php echo ($so["url"]); ?>"><img src="<?php echo ($so["img"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
</div>
</div>
<div id="nav">
<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,2);return false">&larr; prev</div>
<ul id="indicator">
            
            
				<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="active"<?php endif; ?> ></li><?php endforeach; endif; else: echo "" ;endif; ?>
 
</ul>
<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
</div>
<div class="clr"></div>
</div>

 <div id="insert1" ></div>
<div class="device">
    <a class="arrow-left" href="#"></a> 
    <a class="arrow-right" href="#"></a>
    <div class="swiper-container">
      <div class="swiper-wrapper">
      
      
		<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i % 6 == 1): ?><div class="swiper-slide">
					<div class="content-slide"><?php endif; ?>
          <a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo (htmlspecialchars_decode($vo["url"])); endif; ?>">
          <div class="mbg">
                    <p class="ico"><img src="<?php echo ($vo["img"]); ?>" /></p>
                    <p class="title"><?php echo ($vo["name"]); ?></p></div>
                </a>
                                         
					<?php if($i % 6 == 0 || $i == count($info)): ?></div>
						</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>                  
              
                            
 
                 

      </div>
  <div class="pagination"></div>
    </div>


</div> 



<script src="<?php echo ($static_path); ?>tpl/com/js/jquery-1.10.1.min.js" type="text/javascript"></script>
  <script src="<?php echo ($static_path); ?>tpl/com/js/idangerous.swiper-2.1.min.js" type="text/javascript"></script>
  <script>
  var mySwiper = new Swiper('.swiper-container',{
    pagination: '.pagination',
    loop:true,
    grabCursor: true,
    paginationClickable: true
  })
  $('.arrow-left').on('click', function(e){
    e.preventDefault()
    mySwiper.swipePrev()
  })
  $('.arrow-right').on('click', function(e){
    e.preventDefault()
    mySwiper.swipeNext()
  })
  </script>

<script>
var count = document.getElementById("thelist").getElementsByTagName("img").length;	

var count2 = document.getElementsByClassName("menuimg").length;
for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";

 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );
window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 


</script>
<?php if($homeInfo['copyright']): ?><div class="copyright"><?php echo ($homeInfo["copyright"]); ?></div><?php endif; ?>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<?php if($radiogroup > 8): ?><br>
<br><?php endif; ?>
<script>
function displayit(n){
	for(i=0;i<4;i++){
		if(i==n){
			var id='menu_list'+n;
			if(document.getElementById(id).style.display=='none'){
				document.getElementById(id).style.display='';
				document.getElementById("plug-wrap").style.display='';
			}else{
				document.getElementById(id).style.display='none';
				document.getElementById("plug-wrap").style.display='none';
			}
		}else{
			if($('#menu_list'+i)){
				$('#menu_list'+i).css('display','none');
			}
		}
	}
}
function closeall(){
	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;
	for(i=0;i<count;i++){
		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';
	}
	document.getElementById("plug-wrap").style.display='none';
}

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script> 

<?php if($invote_array): ?><script>
	var html = '<div class="list" style="border-top: 1px solid #ddd8ce; border-bottom: 1px solid #ddd8ce;margin-bottom: 0; background-color: #fff;z-index:100000;"><a href="<?php echo ($invote_array["url"]); ?>" style="color:#666;display:block;padding:.2rem;padding-bottom: 9px;">';
	html += '<img src="<?php echo ($invote_array["avatar"]); ?>" style="width:40px;  vertical-align: middle;"/><?php echo ($invote_array["txt"]); ?>';
	html += '<button style="float:right;height:2.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 1.2rem;">关注我们</button>';
	html += '</a></div>';
	$('body').prepend(html);
	$('#cate16 .mainmenu, #cate14 .mainmenu').css('top', '61px');
	if ($('body').attr('id')) {
		$('#wrapper').css('top','57px');
	}
</script><?php endif; ?>
 
<!-- share -->
	<?php if(ACTION_NAME == 'index'): ?><script type="text/javascript">
			window.shareData = {  
		            "moduleName":"Index",
		            "moduleID":"0",
		            "imgUrl": "<?php echo ($homeInfo["picurl"]); ?>", 
		            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Index/index',array('token' => $mer_id));?>",
		            "tTitle": "<?php echo ($homeInfo["title"]); ?>",
		            "tContent": "<?php echo ($homeInfo["info"]); ?>"
			};
		</script>
	<?php else: ?>
		<script type="text/javascript">
		window.shareData = {  
	            "moduleName":"NewsList",
	            "moduleID":"<?php echo (intval($_GET['classid'])); ?>",
	            "imgUrl": "<?php echo ($thisClassInfo["img"]); ?>", 
	            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Index/lists',array('token' => $mer_id,'classid'=>$_GET['classid']));?>",
	            "tTitle": "<?php echo ($thisClassInfo["name"]); ?>",
	            "tContent": "<?php echo ($thisClassInfo["info"]); ?>"
		};
		</script><?php endif; ?>
	
<?php echo ($shareScript); ?>

<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
 </body>
</html>