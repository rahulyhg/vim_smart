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
	<form id="myform" method="post" action="<?php echo U('Activity/amend');?>" enctype="multipart/form-data">
		<input type="hidden" name="activity_id" value="<?php echo ($now_activity["activity_id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">活动名称</th>
				<td><input type="text" class="input fl" name="name" size="20" validate="maxlength:20,required:true" tips="活动名称" value="<?php echo ($now_activity["name"]); ?>"/></td>
			</tr>
			<tr>
				<th width="80">活动期数</th>
				<td><input type="text" class="input fl" name="term" size="20" validate="number:true,required:true" tips="请输入活动的期数，活动属于第几期！应该接上之前的期数" value="<?php echo ($now_activity["term"]); ?>"/></td>
			</tr>
			<tr>
				<th width="80">广告现图</th>
				<td><img src="<?php echo ($config["site_url"]); ?>/upload/extension/<?php echo ($now_activity["bg_pic"]); ?>" style="width:260px;height:80px;" class="view_msg"/></td>
			</tr>
			<tr>
				<th width="80">活动图片</th>
				<td><input type="file" class="input fl" name="bg_pic" style="width:200px;" placeholder="请上传图片" tips="建议尺寸为1210*300（宽*高）"/></td>
			</tr>
			<tr>
				<th width="80">背景颜色</th>
				<td><input type="text" class="input fl" name="bg_color" id="choose_color" style="width:120px;" placeholder="可不填写" tips="请点击右侧按钮选择颜色，用途为如果用户屏幕宽于1210像素，会被背景颜色扩充。" value="<?php echo ($now_activity["bg_color"]); ?>"/>&nbsp;&nbsp;<a href="javascript:void(0);" id="choose_color_box" style="line-height:28px;">点击选择颜色</a></td>
			</tr>
			<tr>
				<th width="80">开始时间</th>
				<td><input type="text" class="input fl" name="begin_time" style="width:120px;" id="d4311" validate="required:true" tips="活动开始时间，开始时间必须大于上次活动结束时间" value="<?php echo (date('Y-m-d H:i',$now_activity["begin_time"])); ?>" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',maxDate:'#F{$dp.$D(\'d4312\')}'})"/></td>
			</tr>
			<tr>
				<th width="80">结束时间</th>
				<td><input type="text" class="input fl" name="end_time" style="width:120px;" id="d4312" validate="required:true" tips="活动结束时间" value="<?php echo (date('Y-m-d H:i',$now_activity["end_time"])); ?>" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm',minDate:'#F{$dp.$D(\'d4311\')}'})"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>