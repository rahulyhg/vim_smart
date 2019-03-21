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
<form id="myform" method="post" action="<?php echo U('Access/visitorLog_edit');?>" frame="true" refresh="true">
    <input type="hidden" name="pigcms_id" value="<?php echo ($visitorLog_info['pigcms_id']); ?>"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">微信名</th>
            <td><input type="text" class="input fl" name="nickname" value="<?php echo ($visitorLog_info['nickname']); ?>" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">真实姓名</th>
            <td><input type="text" class="input fl" name="name" value="<?php echo ($visitorLog_info['name']); ?>" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">手机号码</th>
            <td><input type="text" class="input fl" name="phone" value="<?php echo ($visitorLog_info['phone']); ?>" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">身份证</th>
            <td><input type="text" class="input fl" name="id_card" value="<?php echo ($visitorLog_info['id_card']); ?>" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">公司名称</th>
            <td><input type="text" class="input fl" name="company" value="<?php echo ($visitorLog_info['company']); ?>" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">登记时间</th>
            <td><input type="text" class="input fl" name="add_time" value="<?php echo (date('Y-m-d H:i:s',$visitorLog_info['add_time'])); ?>" size="40" readonly="readonly"/></td>
        </tr>


    </table>
    <!--<div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>-->
</form>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
	</body>
</html>
<!--陈琦 访客信息详情
   2016.8.18-->