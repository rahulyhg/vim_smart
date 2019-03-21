<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/employeeStyle.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="15%">标题</th>
				<td><?php echo ($detail['title']); ?></td>
			</tr>
			<tr>
				<th width="15%">联系人</th>
				<td><?php echo ($detail['lxname']); ?></td>
			</tr>
			<tr>
				<th width="15%">联系人电话</th>
				<td ><?php if(strpos($detail['lxtel'], 'load/telimages')): ?><img src="<?php echo ($config['site_url']); ?>/<?php echo ($detail['lxtel']); ?>"><?php else: echo ($detail['lxtel']); endif; ?></td>
			</tr>
			<?php if(!empty($content)): if(is_array($content)): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr>
				<th width="15%"><?php echo ($vv['tn']); ?></th>
				<?php if(is_array($vv['vv'])): ?><td><?php echo (implode($vv['vv'],',')); ?></td>
				<?php elseif($vv['type'] == 1 AND isset($vv['unit']) AND !empty($vv['unit'])): ?>
				<td><?php echo ($vv['vv']); ?> / <?php echo ($vv['unit']); ?></td>
				<?php elseif($vv['type'] == 5 AND !empty($vv['vv'])): ?>
				<td><?php echo (htmlspecialchars_decode($vv['vv'],ENT_QUOTES)); ?></td>
				<?php else: ?><td ><?php echo ($vv['vv']); ?></td><?php endif; ?>
			</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<?php if(!empty($detail['otherdesc'])): ?><tr>
				<th width="15%">职位描述</th>
				<?php $detail['otherdesc']=htmlspecialchars_decode($detail['otherdesc'],ENT_QUOTES); ?>
				<td ><?php echo (htmlspecialchars_decode($detail['otherdesc'],ENT_QUOTES)); ?></td>
			</tr><?php endif; ?>
			<?php if(!empty($detail['description'])): ?><tr>
				<th width="15%">说明描述</th>
				<?php $detail['description']=htmlspecialchars_decode($detail['description'],ENT_QUOTES); ?>
				<td ><?php echo (htmlspecialchars_decode($detail['description'],ENT_QUOTES)); ?></td>
			</tr><?php endif; ?>
		</table>
		<?php if(!empty($imglist)): ?><table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		    <tr>
				<td width="100">上传的图片：</td>
			</tr>
		  <?php if(is_array($imglist)): $i = 0; $__LIST__ = $imglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if($mod==0)echo "<tr>"; ?>
			<td><img class="view_msg" style="width:300px;" src="<?php echo ($vv); ?>"></td>
			<?php if($mod==1)echo "</tr>"; endforeach; endif; else: echo "" ;endif; ?>
		</table><?php endif; ?>
		<div class="btn hidden">
			<form id="myform" method="post" action="<?php echo U('Classify/toVerify');?>" frame="true" refresh="true">
		     <input type="hidden" name="vid" value="<?php echo ($vid); ?>"/>
			 <input type="submit" name="dosubmit" id="dosubmit" class="button" />
			 </form>
		</div>

<!--<script type="text/javascript">
function toCheck(id){
   if(confirm('您确定审核通过此项吗？')){
    $.post("<?php echo U('Classify/toVerify');?>",{vid:id},function(data){
	  data=parseInt(data);
	  if(!data){
          //window.location.reload();
		  window.main.location.reload();
	   }
     },'JSON');
   }else{
     return false;
   }
}
</script>-->
	</body>
</html>