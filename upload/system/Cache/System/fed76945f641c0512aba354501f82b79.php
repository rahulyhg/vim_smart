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
	<form id="myform" method="post" action="<?php echo U('Index/saveAdmin');?>" frame="true" refresh="true">
		<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">账号</th>
				<td><input type="text" class="input fl" name="account" id="account" size="20" placeholder="请输入账号" validate="maxlength:30,required:true" value="<?php echo ($admin['account']); ?>"/></td>
			</tr>
			<tr>
				<th width="80">密码</th>
				<td><input type="password" class="input fl" name="pwd" id="pwd" size="20" placeholder=""  tips="添加时候必填，在修改时候不填写证明不修改密码"/></td>
			</tr>
			<tr>
				<th width="80">真实姓名</th>
				<td><input type="text" class="input fl" name="realname" id="realname" size="20" placeholder="" tips="填写该账号使用者的真实姓名" value="<?php echo ($admin['realname']); ?>"/></td>
			</tr>
			<tr>
				<th width="80">电话</th>
				<td><input type="text" class="input fl" name="phone" size="20" placeholder=""  value="<?php echo ($admin['phone']); ?>"/></td>
			</tr>
			<tr>
				<th width="80">EMAIL</th>
				<td><input type="text" class="input fl" name="email" size="20" value="<?php echo ($admin['email']); ?>"/></td>
			</tr>
			<tr>
				<th width="80">QQ</th>
				<td><input type="text" class="input fl" name="qq" size="20" value="<?php echo ($admin['qq']); ?>"/></td>
			</tr>
			<tr>
				<th width="80">状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($admin['status'] == 1): ?>selected<?php endif; ?>"><span>显示</span><input type="radio" name="status" value="1" <?php if($admin['status'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable  <?php if($admin['status'] == 0): ?>selected<?php endif; ?>"><span>隐藏</span><input type="radio" name="status" value="0" <?php if($admin['status'] == 0): ?>checked="checked"<?php endif; ?> /></label></span>
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