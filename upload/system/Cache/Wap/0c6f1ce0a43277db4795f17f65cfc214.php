<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>等级升级</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    #pg-account .text-icon {
	        font-size: .44rem;
	        color: #666;
	        width: .44rem;
	        text-align: center;
	        margin-right: .1rem;
	    }
	#pg-account strong{
	   color: #fb4746;
	}
	.react{margin-left: 20px;}
	.leveldesc p{line-height: 25px;}
	</style>
</head>
<body id="index" data-com="pagecommon">
        <?php if($_GET['OkMsg']): ?><div id="tips" class="tips tips-ok" style="display:block;"><?php echo ($_GET["OkMsg"]); ?></div>
        <?php else: ?>
        	<div id="tips" class="tips"></div><?php endif; ?>
        <div id="pg-account">
		    <dl class="list">
		    	<dd>
		    		<dl>
				        <dd>
							<div class="react  more-weak" style="margin-left: 0px;">您当前积分： <strong><?php echo ($now_user["score_count"]); ?></strong>&nbsp;&nbsp;&nbsp;当前等级：<span><strong><?php if(isset($levelarr[$now_user['level']])){ $nextlevel=$levelarr[$now_user['level']]['level']+1;echo $levelarr[$now_user['level']]['lname'];}else{ $nextlevel=1; echo '暂无等级';} ?></strong></span></div>
				        </dd>
						</dl>
						
						<dl>
						<dd>
							<div class="react  more-weak">下一等级详情：</div>
				        </dd>
						<?php if(isset($levelarr[$nextlevel])): ?><dd>
				        	<div class="react  more-weak">等级名称：<span><?php echo ($levelarr[$nextlevel]['lname']); ?></span></div>
				        </dd>
				        <dd>
				        	<div class="react  more-weak">消耗积分：<span><?php echo ($levelarr[$nextlevel]['integral']); ?></span></div>
				        </dd>
						<dd>
				        	<div class="react  more-weak">等级优惠：<span><?php if($levelarr[$nextlevel]['type'] == 1): ?>购买商品优惠<?php echo ($levelarr[$nextlevel]['boon']); ?>%<?php elseif($levelarr[$nextlevel]['type'] == 2): ?>商品价格立减<?php echo ($levelarr[$nextlevel]['boon']); ?>元<?php else: ?>无<?php endif; ?></span></div>
				        </dd>
						<dd>
				        	<div class="react  more-weak"><a href="javascript:void(0);" class="btn" onclick="levelToupdate(<?php echo ($now_user["score_count"]); ?>,<?php echo ($levelarr[$nextlevel]['integral']); ?>,$(this))" style="color:#FFF;">升 级</a></div>
				        </dd>
						<?php else: ?>
						<dd>
						<div class="react  more-weak">没有更高的等级了！</div>
						</dd><?php endif; ?>
			<?php if(isset($levelarr[$now_user['level']])): ?><dd style="margin:20px 0px 10px 15px;">
			<strong><?php echo ($levelarr[$now_user['level']]['lname']); ?> 详情描述：</strong>
			 <div style="line-height: 25px;margin: 15px 0px;" class="leveldesc">
			  <?php echo (htmlspecialchars_decode($levelarr[$now_user['level']]['description'],ENT_QUOTES)); ?>
			 </div>
			</dd><?php endif; ?>
			<?php if(isset($levelarr[$nextlevel])): ?><dd style="margin:20px 0px 10px 15px;">
			<strong><?php echo ($levelarr[$nextlevel]['lname']); ?> 详情描述：</strong>
			 <div style="line-height: 25px;margin: 15px 0px;" class="leveldesc">
			  <?php echo (htmlspecialchars_decode($levelarr[$nextlevel]['description'],ENT_QUOTES)); ?>
			 </div>
			</dd><?php endif; ?>
		    </dl></dd></dl>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
	<script type="text/javascript">
		/*****等级升级******/
		var levelToupdateUrl="<?php echo ($config['site_url']); ?>/index.php?g=User&c=Level&a=levelUpdate"
		function levelToupdate(currentscore,needscore,obj){
		currentscore=parseInt(currentscore);
		needscore=parseInt(needscore);
		if(currentscore>0 && needscore>0){
		   if(currentscore<needscore){
			  alert('您当前的积分不够升级！');
			  return false;
		   }
		   if(confirm("升级会扣除您"+needscore+"积分\n您确认要升级吗？")){
			  obj.attr('onclick','return false');
			  $.post(levelToupdateUrl,{},function(ret){
				  alert(ret.msg);
				  window.location.reload();
			  },'JSON');
			  return false;
		   }
		}
		}
</script>
			<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
<?php echo ($hideScript); ?>
</body>
</html>