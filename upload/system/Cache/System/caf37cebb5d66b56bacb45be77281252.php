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
	<form id="myform" method="post" action="<?php echo U('Classify/attrSeting');?>" frame="true" refresh="true">
		<input type="hidden" name="vid" value="<?php echo ($vid); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td>置顶设置：</td>
				<td><?php if(!empty($item) AND $item['endtoptime'] > 0): if($item['endtoptime'] > $currenttime): ?>您已经置顶了这条消息！
				  <?php else: ?>
				  您上次设置的置顶到期时间是：<?php echo (date('Y-m-d H:i:s',$item['endtoptime'])); ?>，请重新确认置顶！<?php endif; ?>
				<?php else: ?>您尚未置顶这条消息！<?php endif; ?></td>
			</tr>
			<tr>
				<th width="90">设置置顶时间</th>
				<td><span>置顶到 <input type="text" class="input" name="toptime" id="toptime" value="<?php echo ($datetime); ?>" placeholder="" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})" validate="required:true" tips=""/> 结束</span></td>
			</tr>
		<tr>
			<th width="90">排序顺序</th>
			<td><span><input type="text" class="input" name="topsort" id="topsort" value="<?php echo ($item['topsort']); ?>" style="width: 60px;"/></span>&nbsp;&nbsp;&nbsp;<span class="red">数值越大越靠前<span></td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="100">标题颜色设置：</td>
				<td>
				<input type="text" class="input fl" name="bt_color" id="choose_color" <?php if(!empty($item['btcolor'])): ?>style="width:120px;background-color:<?php echo ($item['btcolor']); ?>" <?php else: ?>style="width:120px;"<?php endif; ?> value="<?php echo ($item['btcolor']); ?>" placeholder="可不填写" tips="请点击右侧按钮选择颜色，用途为如果图片尺寸小于屏幕时，会被背景颜色扩充，主要为首页使用。">
				<a href="javascript:void(0);" id="choose_color_box" style="line-height:28px;">点击选择颜色</a>
				</td>
			</tr>
		</table>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="100">跳转链接设置：</td>
				<td>
				<input type="text" class="input fl" name="jumpUrl" id="jumpUrl" value="<?php echo ($item['jumpUrl']); ?>" style="width:220px" onBlur="TextSEO(this.value)" placeholder="请填写一个完整的URL" tips="当填上URL后,点击前台展示列表里此项将跳转到您填写的链接地址">
				<p class="red">当填上URL(以http://形式开头的地址)后,点击前台展示列表里此项将跳转到您填写的链接地址,正常情况下请留空</p>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>
<script type="text/javascript">
function TextSEO(vv){
   vv=$.trim(vv);
   var pattern = /^https?:\/\//i;
   if(vv && !(pattern.test(vv))){
	   alert('URL地址格式不正确！');
   }
}
</script>