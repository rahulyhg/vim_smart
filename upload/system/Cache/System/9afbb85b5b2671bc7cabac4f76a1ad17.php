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
	<form id="myform" method="post" action="<?php echo U('User/addlevel');?>" frame="true" refresh="true">
		<input type="hidden" name="lid" value="<?php echo ($leveldata['id']); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="80">等级名称：</td>
				<td>
				<input type="text" class="input fl" name="lname" value="<?php echo ($leveldata['lname']); ?>" placeholder="请填写一个等级名" tips="如vip1，vip2等">
				&nbsp;&nbsp;&nbsp;<span class="red">例如：1=>VIP1,2=>VIP2 等</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级级别：</td>
				<td>
				<span class="input fl" style="width: 140px;"><?php echo ($leveldata['level']); ?></span>
				&nbsp;&nbsp;&nbsp;<span class="red">例如：1=>VIP1,2=>VIP2 等</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级积分：</td>
				<td>
				<input type="text" class="input fl" name="integral" value="<?php echo ($leveldata['integral']); ?>" placeholder="请填写一个对应数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')" tips="成为该等级会员所需要的积分数">
				&nbsp;&nbsp;&nbsp;<span class="red">客户想成为该等级会员所需要消耗的积分数</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级图标：</td>
				<td>
				    <input type="hidden" name="icon" value="<?php echo ($leveldata['icon']); ?>"/>
					<a href="javascript:void(0)" class="btn btn-sm btn-success J_selectImage">上传图片</a>
				    <img src="<?php echo ($leveldata['icon']); ?>" width="50px" <?php if(!empty($leveldata['icon'])): ?>style="margin-left: 30px;"<?php else: ?>style="margin-left: 30px;display:none;"<?php endif; ?> />
				</td>
			</tr>
		   <tr>
				<td width="80">等级福利：</td>
				<td>优惠&nbsp;
				<select name="fltype">
				<option value="0">无</option>
				<option value="1" <?php if($leveldata['type'] == 1): ?>selected="selected"<?php endif; ?>>百分比（%）</option>
				<option value="2" <?php if($leveldata['type'] == 2): ?>selected="selected"<?php endif; ?>>立减</option>
				</select>
				&nbsp;&nbsp;&nbsp;
				 <input type="text" class="input" name="boon" value="<?php echo ($leveldata['boon']); ?>" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')" >
				</td>
			</tr>
			<tr>
				<td width="80">等级介绍：</td>
			   <td><textarea id="description" name="description"  placeholder="写上一些等级介绍说明文字"><?php echo (htmlspecialchars_decode($leveldata['description'],ENT_QUOTES)); ?></textarea></td>
			</tr>
		   <tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>
<link rel="stylesheet" href="<?php echo ($static_public); ?>kindeditor/themes/default/default.css">
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">

KindEditor.ready(function(K){
	var editor = K.editor({
		allowFileManager : true
	});
	 //var islock=false;
	K('.J_selectImage').click(function(){
		var obj=$(this);
		editor.uploadJson = "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					obj.siblings('input').val(url);
					editor.hideDialog();
					obj.siblings('img').attr('src',url).show();
					//window.location.reload();
				}
			});
		});
	   
	});

	kind_editor = K.create("#description",{
		width:'480px',
		height:'380px',
		minWidth:'480px',
		resizeType : 1,
		allowPreviewEmoticons:false,
		allowImageUpload : true,
		filterMode: true,
		items : [
			'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image"
	});
});
</script>