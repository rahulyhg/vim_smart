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
	<form id="myform" method="post" action="<?php echo U('Area/amend');?>" frame="true" refresh="true">
		<input type="hidden" name="area_id" value="<?php echo ($now_area['area_id']); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">名称</th>
				<td><input type="text" class="input fl" name="area_name" value="<?php echo ($now_area["area_name"]); ?>" size="20" placeholder="请输入名称" validate="maxlength:30,required:true"/></td>
			</tr>
			<?php if($now_area['area_type'] == 2 || $now_area['area_type'] == 4): ?><tr>
					<th width="80">首字母</th>
					<td><input type="text" class="input fl" name="first_pinyin" value="<?php echo ($now_area["first_pinyin"]); ?>" size="20" placeholder="" validate="maxlength:20,required:true" tips="名称第一个字符的首字母！输入名称后，若此字段为空，会自动填写（仅作为示例）"/></td>
				</tr><?php endif; ?>
			<?php if($now_area['area_type'] > 1): ?><tr>
					<th width="80">网址标识</th>
					<td><input type="text" class="input fl" name="area_url" value="<?php echo ($now_area["area_url"]); ?>" size="20" placeholder="" validate="maxlength:20,required:true" tips="一般为地区名称的首字母！输入名称后，若此字段为空，会自动填写（仅作为示例）"/></td>
				</tr><?php endif; ?>
			<?php if($now_area['area_type'] > 1 && $now_area['area_type'] < 4): ?><tr>
					<th width="80">IP标识</th>
					<td><input type="text" class="input fl" name="area_ip_desc" value="<?php echo ($now_area["area_ip_desc"]); ?>" size="20" placeholder="" validate="maxlength:30,required:true" tips="一般格式为 XX省XX市XX区(县)"/></td>
				</tr><?php endif; ?>
			<tr>
				<th width="80">排序</th>
				<td><input type="text" class="input fl" name="area_sort" value="<?php echo ($now_area["area_sort"]); ?>" size="10" value="0" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
			<?php if($now_area['area_type'] > 1): ?><tr>
					<th width="80">热门</th>
					<td>
						<span class="cb-enable"><label class="cb-enable <?php if($now_area['is_hot'] == 1): ?>selected<?php endif; ?>"><span>是</span><input type="radio" name="is_hot" value="1" <?php if($now_area['is_hot'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
						<span class="cb-disable"><label class="cb-disable <?php if($now_area['is_hot'] == 0): ?>selected<?php endif; ?>"><span>否</span><input type="radio" name="is_hot" value="0" <?php if($now_area['is_hot'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
					</td>
				</tr><?php endif; ?>
			<tr>
				<th width="80">状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($now_area['is_open'] == 1): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="is_open" value="1" <?php if($now_area['is_open'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($now_area['is_open'] == 0): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="is_open" value="0" <?php if($now_area['is_open'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<script type="text/javascript">
		get_first_word('area_name','area_url','first_pinyin');
	</script>
	</body>
</html>