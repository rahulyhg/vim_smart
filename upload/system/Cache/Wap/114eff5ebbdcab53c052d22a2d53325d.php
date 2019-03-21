<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/color.css" media="all">
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/jquery_min.js"></script>
<title><?php echo ($store['name']); ?></title>	
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<!-- Mobile Devices Support @begin -->
		<meta content="telephone=no, address=no" name="format-detection">
		<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<!-- Mobile Devices Support @end -->
</head>
<style  type="text/css">
#dingcai_adress_info{
border-top: 1px solid #ddd8ce;
border-bottom: 1px solid #ddd8ce;
position: relative;
}
#dingcai_adress_info:after{
position: absolute;
right: 8px;
top: 50%;
display: block;
content: '';
width: 13px;
height: 13px;
border-left: 3px solid #999;
border-bottom: 3px solid #999;
-webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
-ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
}


#enter_im_div {
  bottom: 121px;
  z-index: 11;
  display: none;
  position: fixed;
  width: 100%;
  max-width: 640px;
  height: 1px;
}
#enter_im {
  width: 94px;
  margin-left: 110px;
  position: relative;
  left: -100px;
  display: block;
}
a {
  color: #323232;
  outline-style: none;
  text-decoration: none;
}
#to_user_list {
  height: 30px;
  padding: 7px 6px 8px 8px;
  background-color: #00bc06;
  border-radius: 25px;
  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
}
#to_user_list_icon_div {
  width: 20px;
  height: 16px;
  background-color: #fff;
  border-radius: 10px;
}

.rel {
  position: relative;
}
.left {
  float: left;
}
.to_user_list_icon_em_a {
  left: 4px;
}
#to_user_list_icon_em_num {
  background-color: #f00;
}
#to_user_list_icon_em_num {
  width: 14px;
  height: 14px;
  border-radius: 7px;
  text-align: center;
  font-size: 12px;
  line-height: 14px;
  color: #fff;
  top: -14px;
  left: 68px;
}
.hide {
  display: none;
}
.abs {
  position: absolute;
}
.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
  width: 2px;
  height: 2px;
  border-radius: 1px;
  top: 7px;
  background-color: #00ba0a;
}
.to_user_list_icon_em_a {
  left: 4px;
}
.to_user_list_icon_em_b {
  left: 9px;
}
.to_user_list_icon_em_c {
  right: 4px;
}
.to_user_list_icon_em_d {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 4px;
  top: 14px;
  left: 6px;
  border-color: #fff transparent transparent transparent;
}
#to_user_list_txt {
  color: #fff;
  font-size: 13px;
  line-height: 16px;
  padding: 1px 3px 0 5px;
}
</style>
<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container businessHours">
	<header data-role="header">	
	<?php if(isset($store['images'][0])): ?><a href="<?php echo U('Food/index', array('mer_id' => $mer_id, 'store_id' => $store_id));?>">
	  <img src="<?php echo ($store['images'][0]); ?>" style="width: 100%;">
	  </a><?php endif; ?>
	</header>
	<section data-role="body" class="section_scroll_content">
		<ul class="pay">
			<li class="title"><a><span class="icon time"></span>营业时间</a></li>
			<li>
			<?php if(is_array($store['office_time'])): $i = 0; $__LIST__ = $store['office_time'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i; echo ($row['open']); ?>-<?php echo ($row['close']); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
			</li>
		</ul>
		<ul class="pay">
			<li class="title"><a><span class="icon mark"></span>店铺简介</a></li>
			<li style="color:#000000;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;font-style:normal;font-weight:normal;line-height:18px;">
			<?php echo html_entity_decode(htmlspecialchars_decode($store['txt_info']),ENT_QUOTES,"UTF-8"); ?>
			</li>
		</ul>
		<?php if(!empty($reply_list)): ?><ul class="pay">
				<dl class="list" id="deal-feedback">
					<dd>
						<dl>
							<dt>评价<span class="pull-right"><span class="stars"><?php $__FOR_START_275235408__=0;$__FOR_END_275235408__=5;for($i=$__FOR_START_275235408__;$i < $__FOR_END_275235408__;$i+=1){ if($store['score_mean'] > $i): ?><i class="text-icon icon-star"></i><?php elseif($store['score_mean'] > $i-1): ?><i class="text-icon icon-star-gray"><i class="text-icon icon-star-half"></i></i><?php else: ?><i class="text-icon icon-star-gray"></i><?php endif; } ?><em class="star-text"><?php echo ($now_group["score_mean"]); ?></em></span></span></dt>
							<?php if(is_array($reply_list)): $i = 0; $__LIST__ = $reply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="dd-padding">
									<div class="feedbackCard">
										<div class="userInfo">
											<weak class="username"><?php echo ($vo["nickname"]); ?></weak>
										</div>
										<div class="score">
											<span class="stars"><?php $__FOR_START_2045031939__=0;$__FOR_END_2045031939__=5;for($i=$__FOR_START_2045031939__;$i < $__FOR_END_2045031939__;$i+=1){ if($vo['score'] > $i): ?><i class="text-icon icon-star"></i><?php else: ?><i class="text-icon icon-star-gray"></i><?php endif; } ?></span>
								
											<weak class="time"><?php echo ($vo["add_time"]); ?></weak>
										</div>
										<div class="comment">
											<p><?php echo ($vo["comment"]); ?></p>
										</div>
										<?php if($vo['pics']): ?><div class="pics view_album" data-pics="<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i; echo ($voo["m_image"]); if(count($vo['pics']) > $i): ?>,<?php endif; endforeach; endif; else: echo "" ;endif; ?>">
												<?php if(is_array($vo['pics'])): $i = 0; $__LIST__ = $vo['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><span class="pic-container imgbox" style="background:none;"><img src="<?php echo ($voo["s_image"]); ?>" style="width:100%;"/></span>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
											</div><?php endif; ?>
									</div>
								</dd><?php endforeach; endif; else: echo "" ;endif; ?>
						</dl>
					</dd>
				</dl>
			</ul><?php endif; ?>
	<div style="display: none;text-align: center;height: 30px;margin-top: 15px;" id="show_more" page="2"><a href="javascript:void(0);" style="color: #ED0B8C;">加载更多...</a></div>
	<input type="hidden" id="canScroll" value="1" />
	</section>
	<footer data-role="footer"></footer>
</div>
<script type="text/javascript">
$(document).ready(function(){
	/*---------------------加载更多--------------------*/
	var total = <?php echo ($store['reply_count']); ?>;
	var pagesize = 10;
	var t = 0;
	var pages = Math.ceil(total / pagesize);
	if (pages > 1) {
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				var _page = $('#show_more').attr('page');
				$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载中...</a>');
				if (_page > pages) {
					$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">没有更多了</a>').delay(2300).slideUp(1600);
					return;
				}
				if($('#canScroll').val()==0){//不要重复加载
					return;
				}
				$('#canScroll').attr('value',0);
				
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'pagesize' : pagesize, 'mer_id':<?php echo ($mer_id); ?>, 'store_id':<?php echo ($store_id); ?>},
					url :  '/wap.php?c=Food&a=ajaxreply',
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载更多</a>');
						data = RES.data;
						if(data != null && data != ''){
							$('#show_more').attr('page', parseInt(_page)+1);
						}
						var _tmp_html = '';
						$.each(data, function(x, vo) {
							_tmp_html += '<dd class="dd-padding">';
							_tmp_html += '<div class="feedbackCard">';
							_tmp_html += '<div class="userInfo">';
							_tmp_html += '<weak class="username">' + vo.nickname + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="score">';
							_tmp_html += '<span class="stars">';
							for (var i = 0; i < 5; i++) {
								if (vo.score > i) {
									_tmp_html += '<i class="text-icon icon-star"></i>';
								} else {
									_tmp_html += '<i class="text-icon icon-star-gray"></i>';
								}
							}
							_tmp_html += '</span>';
						
							_tmp_html += '<weak class="time">' + vo.add_time + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="comment">';
							_tmp_html += '<p>' + vo.comment + '</p>';
							_tmp_html += '</div>';
							if (vo.pics != null && vo.pics != '') {
								var pre = '', str = '';
								$.each(vo.pics, function(ii, voo){
									str += pre + voo['m_image'];
									pre = ',';
								});
								_tmp_html += '<div class="pics view_album" data-pics="' + str + '">';
								$.each(vo.pics, function(io, vvo){
									_tmp_html += '<span class="pic-container imgbox" style="background:none;"><img src="' + vvo.s_image + '" style="width:100%;"/></span>&nbsp;';
								});
								_tmp_html += '</div>';
							}
							_tmp_html += '</div>';
							_tmp_html += '</dd>';
						});
						$('#deal-feedback').find('dl').append(_tmp_html);
					}
				});
			}
		});
	}

});
window.shareData = {  
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "<?php echo ($store["image"]); ?>", 
            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Food/index',array('mer_id' => $mer_id, 'store_id' => $store_id));?>",
            "tTitle": "<?php echo ($store["name"]); ?>",
            "tContent": "<?php echo ($store["txt_info"]); ?>"
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>