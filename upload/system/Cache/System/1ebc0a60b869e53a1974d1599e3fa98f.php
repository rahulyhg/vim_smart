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
	<form id="myform" method="post" action="<?php echo U('Slider/slider_amend');?>" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo ($now_slider["id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">导航名称</th>
				<td><input type="text" class="input fl" name="name" value="<?php echo ($now_slider["name"]); ?>" size="20" placeholder="请输入名称" validate="maxlength:20,required:true"/></td>
			</tr>
			<?php if($now_slider['pic']): ?><tr>
					<th width="80">导航现图</th>
					<td><img src="<?php echo ($config["site_url"]); ?>/upload/slider/<?php echo ($now_slider["pic"]); ?>" style="width:80px;height:80px;" class="view_msg"/></td>
				</tr><?php endif; ?>
			<tr>
				<th width="80">导航图片</th>
				<td><input type="file" class="input fl" name="pic" style="width:200px;" placeholder="请上传图片" tips="不修改请不上传！上传新图片，老图片会被自动删除！"/></td>
			</tr>
			<tr>
				<th width="80">链接地址</th>
				<td>
				<input type="text" class="input fl" name="url" id="url" value="<?php echo ($now_slider["url"]); ?>" style="width:200px;" placeholder="请填写链接地址" validate="maxlength:200,required:true,url:true"/>
				<?php if($now_slider['cat_id'] != 1): ?><a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0, 0)" data-toggle="modal">从功能库选择</a>
				<?php else: ?>
				<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0, 1)" data-toggle="modal">从功能库选择</a><?php endif; ?>
				</td>
			</tr>
			<tr>
				<th width="80">导航排序</th>
				<td><input type="text" class="input fl" name="sort" style="width:80px;" value="<?php echo ($now_slider["sort"]); ?>" validate="maxlength:10,required:true,number:true"/></td>
			</tr>
			<tr>
				<th width="80">导航状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($now_slider['status'] == 1): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="status" value="1" <?php if($now_slider['status'] == 1): ?>checked="checked"<?php endif; ?>/></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($now_slider['status'] == 0): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="status" value="0" <?php if($now_slider['status'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
function addLink(domid,iskeyword, type){
	art.dialog.data('domid', domid);
	if (type == 1) {
		art.dialog.open('?g=Admin&c=LinkPC&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
	} else {
		art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
	}
	
}
</script>
	</body>
</html>