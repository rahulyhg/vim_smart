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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>	<form id="myform" method="post" action="<?php echo U('House/village_edit');?>" frame="true" refresh="true">		<input type="hidden" name="village_id" value="<?php echo ($now_village["village_id"]); ?>"/>		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">			<tr>				<th width="100">小区名称</th>				<td><input type="text" class="input fl" name="village_name" value="<?php echo ($now_village["village_name"]); ?>" size="40" placeholder="请输入小区名称" validate="maxlength:20,required:true"/></td>			</tr>			<tr>				<th width="100">小区地址</th>				<td><input type="text" class="input fl" name="village_address" value="<?php echo ($now_village["village_address"]); ?>" size="40" placeholder="请输入小区地址" validate="maxlength:50,required:true"/></td>			</tr>			<tr>				<th width="100">物业公司名称</th>				<td><input type="text" class="input fl" name="property_name" value="<?php echo ($now_village["property_name"]); ?>" size="40" placeholder="请输入物业公司名称" validate="maxlength:20,required:true"/></td>			</tr>			<tr>				<th width="100">物业联系地址</th>				<td><input type="text" class="input fl" name="property_address" value="<?php echo ($now_village["property_address"]); ?>" size="40" placeholder="请输入物业联系地址" validate="maxlength:50,required:true"/></td>			</tr>			<tr>				<th width="100">物业联系电话</th>				<td><input type="text" class="input fl" name="property_phone" value="<?php echo ($now_village["property_phone"]); ?>" size="20" placeholder="请输入物业联系电话" validate="maxlength:50,required:true" tips="多个号码以空格分开"/></td>			</tr>			<tr>				<th width="100">社区后台管理帐号</th>				<td><input type="text" class="input fl" name="account" value="<?php echo ($now_village["account"]); ?>" size="20" placeholder="请输入社区后台管理帐号" validate="maxlength:50,required:true" tips="多个社区帐号一致，将认为是同一家物业公司。进入社区后台会提示进入哪个小区"/></td>			</tr>			<tr>				<th width="100">社区后台管理密码</th>				<td><input type="text" class="input fl" name="pwd" size="20" placeholder="不修改请勿填写" validate="maxlength:50,minlength:6" tips="不修改请勿填写"/></td>			</tr>			<tr>				<th width="100">状态</th>				<td class="radio_box">					<span class="cb-enable"><label class="cb-enable <?php if($now_village['status'] == 1 || $now_village['status'] == 0): ?>selected<?php endif; ?>"><span>正常</span><input type="radio" name="status" value="<?php if($now_village['status'] == 0): ?>0<?php else: ?>1<?php endif; ?>" <?php if($now_village['status'] == 1 || $now_village['status'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>					<span class="cb-disable"><label class="cb-disable <?php if($now_village['status'] == 2): ?>selected<?php endif; ?>"><span>禁止</span><input type="radio" name="status" value="2" <?php if($now_village['status'] == 2): ?>checked="checked"<?php endif; ?>/></label></span>				</td>			</tr>		</table>		<div class="btn hidden">			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />			<input type="reset" value="取消" class="button" />		</div>	</form><script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script><script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script><script>function addLink(domid,iskeyword){	art.dialog.data('domid', domid);	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});}</script>	</body>
</html>