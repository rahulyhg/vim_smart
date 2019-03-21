<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="" xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <link href="<?php echo ($static_path); ?>classify/release_classify_select01.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/common.css" />
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
   <style type="text/css">
   .current .ym-submnu{display:block;}
   .current  a.p_a_gljl{background:none;}
.ym-tab2 {
    line-height: 40px;
    text-indent: 10px;
    }
	.current li.post_ym_li{ height:auto; width:auto;}
	.current li.post_ym_li a{ *text-indent:0;}
	.current li.post_ym_li.w_65{width:60%}
	.current li.post_ym_li.w_35{width:40%}
	.post_ym_li dl{font-size:14px; color:#000; font-family:simsun;}
	.post_ym_li dl dt{ font-weight:bold; clear:both;}
	.post_ym_li dl dd{ height:30px; margin:0; padding:0;}
	.post_ym_li dl dd .w_50{ float:left; width:48%; overflow:hidden;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/topbar.css" />
  <title>选择大分类</title> 
 </head> 
 <body> 
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
     <?php if(isset($config['classify_logo']) AND !empty($config['classify_logo'])): ?><header id="postheader" style="height:60px;margin-bottom: 15px;" class="mainpage"> 
	 <span id="logo" style="top:0">
	 <a href="<?php echo ($siteUrl); ?>/classify/" target="_blank"><img src="<?php echo ($config["classify_logo"]); ?>" alt="分类信息" title="分类信息" width="185" height="58" /></a>
	 </span>
	  </header> 
	 <?php else: ?>
	 <header id="postheader" style="height:58px" class="mainpage"> 
		<span id="logo" style="top:0">
		 <a href="/" target="_blank"><img src="<?php echo ($config["site_logo"]); ?>" alt="分类信息" title="分类信息" width="160" height="45" /></a>
		 <a href="<?php echo ($siteUrl); ?>/classify/" class="classify">分类信息</a>
		 </span>
	  </header><?php endif; ?>
   <!--<h2 class="sub_title"><b>合肥</b> </h2>--> 
  <div class="flow_step_no1"> 
   <!-- s --> 
   <div class="flow_step"> 
    <ol class="cols3"> 
     <li class="step_1">
      <div>
       <i>1</i>
       <strong>选择大类</strong>
       <span></span>
      </div><em class="f1"></em></li>
     <li class="step_2">
      <div>
       <i>2</i>
       <strong>选择小类</strong>
       <span></span>
      </div></li>
     <li class="step_3">
      <div>
       <i>3</i>填写信息
       <span></span>
      </div><em class="f2"></em></li>
    </ol> 
   </div> 
   <!-- e --> 
  </div> 
  <div class="minheightout w"> 
   <div class="c"></div> 
 
   <div class="content minheight" id="ymenu-side"> 
    <ul class="ym-mainmnu"> 
	<?php if(!empty($Zcategorys)): if(is_array($Zcategorys)): $i = 0; $__LIST__ = $Zcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zvv): $mod = ($i % 2 );++$i;?><li class="ym-tab"><a href="<?php echo ($siteUrl); ?>/classify/Select2Sub-<?php echo ($zvv['cid']); ?>.html"><?php echo ($zvv['cat_name']); ?></a> 
      <ul class="ym-submnu"> 
	   <?php if(!empty($zvv['subdir'])): if(is_array($zvv['subdir'])): $i = 0; $__LIST__ = $zvv['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svv): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($siteUrl); ?>/classify/fabu-<?php echo ($svv['cid']); ?>-<?php echo ($svv['fcid']); ?>.html"><?php echo ($svv['cat_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </ul> </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

    </ul>
	
    <div class="c"></div> 
    <!--<div class="psearch"> 
     <div class="pshead">
      <em>搜索栏</em>
      <input value="二手手机" style="color:black" defaultvalue="请输入关键字查找您要发布的分类" class="pstxt" id="cateKey" type="text" />
      <input value="帮我推荐类别" class="psbtn" id="btn_cateSearch" type="button" />
     </div> 
     <div id="psbox" class="psbox" style=""> 
      <ul>
       <li>找到与“二手手机”相关的类别共 <b>2</b> 个，请选择适合的类目发布：</li>
       <li><a href="">aaa﹥<font style="color:red;">bbb</font></a></li>
       <li><a href="">cccc﹥dddd</a></li>
      </ul> 
     </div> 
     <div id="cateSearch_cannel" class="pscannel" style="display: block;">
      <em>取消</em>
     </div> 
    </div>--> 
   </div>
   <div class="hr_s"></div> 
  </div> 
  ﻿	<div class="site-info-w">
	    <div class="site-info">
	        <div class="copyright">
	            <p>&copy;<span>2015</span>&nbsp;<a href="<?php echo ($config["site_url"]); ?>"><?php echo ($config["site_name"]); ?></a>&nbsp;<?php echo ($config["top_domain"]); ?>&nbsp;<?php if(!empty($config['site_icp'])): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo ($config["site_icp"]); ?></a><?php endif; ?></p>
	        </div>
	    </div>
		<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
	</div>
 </body>
 
<script type="text/javascript">
 /**
* 延迟显示插件lazyShow
*/
(function(a){a.fn.lazyShow=function(c){var b=a.extend({current:"hover",delay:10},c||{});a.each(this,function(){var f=null,e=null,d=false;a(this).bind("mouseover",function(){if(d){clearTimeout(e)}else{var g=a(this);f=setTimeout(function(){g.addClass(b.current);d=true},b.delay)}}).bind("mouseout",function(){if(d){var g=a(this);e=setTimeout(function(){g.removeClass(b.current);d=false},b.delay)}else{clearTimeout(f)}})})}})(jQuery);
	// 自动切换超链接
    $(document).ready(function() {
	$("#ymenu-side > .ym-mainmnu > .ym-tab").lazyShow({ current: "current",delay: 120});
    });
	</script>
</html>