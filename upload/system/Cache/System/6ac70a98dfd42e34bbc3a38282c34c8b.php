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

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
	<form id="myform" method="post" action="<?php echo U('Searchhot/amend');?>" frame="true" refresh="true">
		<input type="hidden" name="id" value="<?php echo ($search_hot["id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">关键词</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入关键词" value="<?php echo ($search_hot["name"]); ?>" validate="maxlength:50,required:true"/></td>
			</tr>
			<tr>
				<th width="80">网址</th>
				<td><input type="text" class="input fl" name="url" size="30" placeholder="可不填写" value="<?php echo ($search_hot["url"]); ?>" validate="url:true" tips="可以为空，默认为搜索该关键词"/></td>
			</tr>
			<tr>
				<th width="80">类型</th>
				<td>
					<select name="type">
						<option value="0" <?php if($search_hot['type'] == 0): ?>selected="selected"<?php endif; ?>><?php echo ($config["group_alias_name"]); ?></option>
						<option value="1" <?php if($search_hot['type'] == 1): ?>selected="selected"<?php endif; ?>><?php echo ($config["meal_alias_name"]); ?></option>
					</select>
					<em tips="如果填写了网址，选择类型不会影响生成的网址。" class="notice_tips"></em>
			</tr>
			<tr>
				<th width="80">链接排序</th>
				<td><input type="text" class="input fl" name="sort" size="10" value="<?php echo ($search_hot["sort"]); ?>" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>