<?php if (!defined('THINK_PATH')) exit();?><!--头部--><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php echo ($shareScript); ?>
	<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery.mmenu.all.css" />
	<link href="<?php echo ($static_path); ?>css/style.css?ver=<?php echo time(); ?>" rel="stylesheet" >
	<link href="<?php echo ($static_path); ?>css/iconfont.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/checkSubmit.js?ver=<?php echo time(); ?>"></script>	
	<script type="text/javascript">
		function onBridgeReady(){
		  //隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
		  WeixinJSBridge.call('hideOptionMenu');
		  //隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
		  WeixinJSBridge.call('hideToolbar');
		}
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
				document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
			}
		}else{
			onBridgeReady();
		}
	wx.ready(function(){
		wx.hideOptionMenu();
	});
</script>
	<script type="text/javascript">	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>
	<script>
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	$(function() {
		//$(".pigcms-main").css('height', $(window).height()-50);
		$('div#slide_menu').mmenu();
		$(".pigcms-slide-footer").css('top', $(window).height()-180);
		$("#mm-0").css('height', $(window).height()-150);
		$('#pigcms-header-left').click(function(){
			setTimeout(function(){
				$("#shop-detail-container").css('width', $("#user-info").width()-95);
			},10);
		})
	});
	</script>
	<style>
		.has-msg:after{
			content: '0'!important;
		}
		.has-order:after{
			content: '0'!important;
		}
	</style>
</head>
<!--头部结束--><link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_item.css"><link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_staff.css"><script type="text/javascript" src="<?php echo ($static_path); ?>js/iscroll.js"></script><style>	.pigcms-container{background: none;padding: 0;}	.form_tips{color:red;}	.radio{margin: 0 3%;padding: 5px 0; width: 92%;line-height: 20px!important;background-color: #FFF;}	.pigcms-textarea{margin-bottom:10px;}</style><!--<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>--><body>		<header class="pigcms-header mm-slideout">			<a href="javascript:history.go(-1);" id="pigcms-header-left"><i class="iconfont icon-left"></i></a>			<p id="pigcms-header-title">添加<?php echo ($config["meal_alias_name"]); ?>商品</p>		</header>	<div class="container container-fill" style='padding-top:50px'>		<form class="pigcms-form" method="post" action="<?php echo U('Index/meal_add');?>">			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品名称：</p>				<input class="pigcms-input-block4"  name="name" id="name" type="text" value="<?php echo ($now_meal["name"]); ?>"/>				<div style="clear:both"></div>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品单位:</p>				<input class="pigcms-input-block4"  name="unit" id="unit" type="text" value="<?php echo ($now_meal["unit"]); ?>"/>				<div style="clear:both"></div>				<span class="pigcms-input-block5">必填。如个、斤、份</span>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品标签:</p>				<input class="pigcms-input-block4" name="label" id="label" type="text" value="<?php echo ($now_meal["label"]); ?>"/>				<div style="clear:both"></div>				<span class="pigcms-input-block5">选填。如特价、促销、招牌！多个以空格分隔，包括空格最长10位</span>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品价格：</p>				<input class="pigcms-input-block4" size="20" name="price" id="price" type="text" value="<?php echo ($now_meal["price"]); ?>"/>				<div style="clear:both"></div>				<span class="pigcms-input-block5">必填。单位为元，最多支持两位小数，下同</span>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品原价：</p>				<input class="pigcms-input-block4" size="20" name="old_price" id="old_price" type="text" value="<?php echo ($now_meal["old_price"]); ?>"/>				<div style="clear:both"></div>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>会员特定价：</p>				<input class="pigcms-input-block4" size="20" name="vip_price" id="vip_price" type="text" value="<?php echo ($now_meal["vip_price"]); ?>"/>				<div style="clear:both"></div>				<span class="pigcms-input-block5">如果设定此值，则所有等级的会员都按此价执行</span>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品排序：</p>				<input class="pigcms-input-block4" size="10" name="sort" id="sort" type="text" value="<?php echo (($now_meal["sort"])?($now_meal["sort"]):'0'); ?>"/>				<div style="clear:both"></div>				<span class="pigcms-input-block5">默认添加顺序排序。数值越大，排序越前</span>			</div>			<div class="pigcms-container">				<p class='pigcms-form-title2'>商品状态：</p>					<select name="status" id="Food_status" class="pigcms-input-block4">						<option value="1" <?php if(!empty($now_meal) AND $now_meal['status'] == 1): ?>selected="selected"<?php endif; ?>>正常</option>						<option value="0" <?php if(!empty($now_meal) AND $now_meal['status'] == 0): ?>selected="selected"<?php endif; ?>>停售</option>					</select>					<div style="clear:both"></div>			</div>			 <?php if(!empty($stores) AND empty($now_meal) AND !($mealid > 0)): ?><div class="pigcms-container">				<p class='pigcms-form-title2'>选择添加到的店铺：</p>				  <select name="store_id" class="pigcms-input-block4" onchange="GetMealSort(this.value)">				     <?php if(is_array($stores)): $i = 0; $__LIST__ = $stores;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['store_id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>				  </select>			  	  <div style="clear:both"></div>			</div>			<?php elseif(!empty($now_meal) AND $mealid > 0): ?>			 			<?php else: ?>			  <p class="pigcms-form-title2" style="color:red;">您还没有可选店铺，<a href="<?php echo U('Index/store_list');?>" style="color: green;">请点击这里去添加店铺吧</a></p><?php endif; ?>			<?php if(!empty($meal_sortJSON)): ?><div class="pigcms-container">				<p class='pigcms-form-title2'>选择添加到的分类：</p>				 <div id="meal_sort_p">				  <select name="sort_id" class="pigcms-input-block4">				     <option value=""></option>				  </select>				  </div>				  <div style="clear:both"></div>			</div>			<?php else: ?>				<p class="pigcms-form-title2" style="color:red;">您还没有可选分类，<a href="<?php echo U('Index/store_list');?>" style="color: green;">请点击这里去添加分类吧</a></p><?php endif; ?>			<div class="pigcms-container">				<div class="top-img-container2">					<div class="up-load-img" onclick="upLoadImg(this)">						<i class="iconfont icon-upload"></i>							<p>商品图片</p>							<div class="clearfix"></div>							<input type="hidden" name="pic_url" value="<?php echo ($now_meal['image']); ?>">							<?php if(isset($now_meal['piclist']) AND !empty($now_meal['piclist'])): ?><img src="<?php echo ($now_meal['piclist']); ?>"><?php endif; ?>					</div>				</div>						</div><div style="clear:both"></div>			<div class="pigcms-container">				<p class='pigcms-form-few'>商品描述：</p>				<textarea class="pigcms-textarea" name='des' id="des" rows=5 placeholder="商品的简短介绍，建议为300字以下"><?php echo ($now_meal["des"]); ?></textarea>			</div>			<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" value="添加">添加</button>			<input type="hidden" name="action" value="edit_item" />			<input type="hidden" name="mealid" value="<?php echo ($mealid); ?>" />			<?php if($mealid > 0): ?><input type="hidden" name="store_id" value="<?php echo ($store_id); ?>" /><?php endif; ?>		</form>					</div>		</body>		<script type="text/javascript">		var picarr = [];			var attachurl = "<?php echo ($site_URl); ?>",			    localIds,				pic_detail = [],				Img_Classify = 'meal',				upload_url = "<?php echo U('Index/img_uplode');?>";			//$("input[name='pic_detail']").val(pic_detail);	var sortid=0;	<?php if(!empty($now_meal) && ($now_meal['sort_id']>0)){ echo 'sortid='.$now_meal['sort_id'].';'; } ?>	sortid=parseInt(sortid);    var meal_sortArr=<?php echo ($meal_sortJSON); ?>;	function GetMealSort(store_id){		var	sortHTML='<select name="sort_id" class="pigcms-input-block4">';		if(typeof(meal_sortArr[store_id]) != 'undefined'){		   $.each(meal_sortArr[store_id],function(idx,vv){			   if(sortid>0 && sortid==vv.sort_id){			      sortHTML +='<option value="'+vv.sort_id+'" selected="selected">'+vv.sort_name+'</option>';			   }else{			      sortHTML +='<option value="'+vv.sort_id+'">'+vv.sort_name+'</option>';			   }		   });		   sortHTML +='</select>';		}else{			sortHTML=sortHTML+'<option value="">无分类</option></select>';		}		$('#meal_sort_p').html(sortHTML);	}	GetMealSort(<?php echo ($stores['0']['store_id']); ?>);	$('#add_form').submit(function(){		$('#save_btn').prop('disabled',true);		$.post("<?php echo U('Index/meal_add');?>",$('#add_form').serialize(),function(result){			if(result.status == 1){				alert(result.info);				window.location.href = "<?php echo U('Index/mpro');?>";			}else{				alert(result.info);			}			$('#save_btn').prop('disabled',false);		})		return false;	});			</script><script type="text/javascript" src="<?php echo ($static_path); ?>js/shop_item_edit.js?ver=<?php echo time(); ?>"></script>	<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>

</html>