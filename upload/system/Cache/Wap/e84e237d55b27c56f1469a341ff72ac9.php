<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo ($now_village["village_name"]); ?></title>
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<link href="<?php echo ($static_path); ?>css/mp_news.css" rel="stylesheet"/>
	</head>
		<body id="activity-detail">
		<div class="rich_media container">
			<div class="rich_media_inner content">
				<h2 class="rich_media_title" id="activity-name"><?php echo ($now_news['title']); ?></h2>
				<div class="rich_media_meta_list">
					<em id="post-date" class="rich_media_meta text"><?php echo (date('Y-m-d H:i',$now_news['add_time'])); ?></em> 
					<em class="rich_media_meta text"></em> 
					<a class="rich_media_meta link nickname js-no-follow js-open-follow" href="<?php echo U('House/village',array('village_id'=>$now_village['village_id']));?>" id="post-user"><?php echo ($now_village["village_name"]); ?></a>
				</div>
				<div id="page-content" class="content">
					<div id="img-content">
						<div class="rich_media_content" id="js_content"><?php echo (htmlspecialchars_decode($now_news['content'],ENT_QUOTES)); ?></div>
					</div>
				</div>
			</div>
		</div>
		<section class="foot_comment">
			<aside class="foot_commentcont">
				<div class="foot_cmt_input j_cmt_btn"><p>说说你的看法</p></div>
			</aside>
			<aside class="cmnt_wrap" style="display:none;">
				<div class="cmnt_tp">
					<span class="fl"><a href="javascript:void(0);" class="cmnt_cancel" id="j_cmnt_cancel">取消</a></span>
					<span class="fr"><a href="javascript:void(0);" class="cmnt_smt" id="j_cmnt_smt">发送</a></span>
				</div>
				<div class="cmntarea">
					<textarea id="j_cmnt_input" class="newarea" name="" placeholder="说说你的看法"></textarea>
				</div>
			</aside>
		</section>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script>
			var is_login = <?php if($user_session): ?>1<?php else: ?>0<?php endif; ?>;
		</script>
		<script>
			$(function(){
				$('.rich_media_inner').css('min-height',$(window).height()-30+'px');
				$('.foot_commentcont').click(function(){
					if(is_login){
						$(this).hide();
						$('.cmnt_wrap').show();
						$('#j_cmnt_input').val('').focus();
					}else{
						if(confirm('您需要先登录才能进行评论。是否前往登录？')){
							window.location.href = "<?php echo U('Login/index');?>";
						}
					}
				});
				$('#j_cmnt_cancel').click(function(){
					$('.cmnt_wrap').hide();
					$('.foot_commentcont').show();
				});
				var is_sending = false;
				$('#j_cmnt_smt').click(function(){
					if(is_sending){
						alert('正在发送中，请稍候');
					}
					$('#j_cmnt_input').val($.trim($('#j_cmnt_input').val()));
					if($('#j_cmnt_input').val() == ''){
						return false;
					}else{
						is_sending = true;
						$.post("<?php echo U('House/village_news_reply',array('news_id'=>$now_news['news_id']));?>",{content:$('#j_cmnt_input').val()},function(result){
							if(result.errcode != 1){
								alert(result.errmsg);
							}else{
								alert(result.errmsg);
								$('#j_cmnt_cancel').trigger('click');
							}
						});
					}
				});
			});
		</script>
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Article",
		            "moduleID":"0",
		            "imgUrl": '<?php if(strpos($nowImage['cover_pic'],'http://') === 0): echo ($nowImage['cover_pic']); else: echo ($config["site_url"]); echo ($nowImage['cover_pic']); endif; ?>', 
		            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Article/index', array('imid' => $nowImage['pigcms_id']));?>",
		            "tTitle": "<?php echo ($nowImage['title']); ?>",
		            "tContent": "<?php echo ($nowImage['digest']); ?>"
		};
		</script>
		<?php echo ($shareScript); ?>
	</body>
</html>