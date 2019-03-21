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
<form id="myform" method="post" action="<?php echo U('Merchant/check');?>" frame="true" refresh="true">
    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
    <input type="hidden" name="mer_id" value="<?php echo ($info["mer_id"]); ?>"/>
    <input type="hidden" name="tc_money" value="<?php echo ($info["tc_money"]); ?>"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="80">商户名</th>
            <td><div class="show"><?php echo ($info["mc_name"]); ?></div></td>
        </tr>
        <tr>
            <th width="80">提现金额</th>
            <td><div class="show"><?php echo ($info["tc_money"]); ?></div></td>
        <tr>
            <th width="80">申请时间</th>
            <td><div class="show"><?php echo (date('Y-m-d H:i:s',$info["sub_time"])); ?></div></td>
        <tr>
            <th width="80">联系电话</th>
            <td><div class="show"><?php echo ($info["contact_num"]); ?></div></td>
        <tr>
            <th width="80">银行卡号</th>
            <td><div class="show"><?php echo ($info["bank_num"]); ?></div></td>
        <tr>
            <th width="80">所属银行</th>
            <td><div class="show"><?php echo ($info["bank"]); ?></div></td>
        <tr>
            <th width="80">申请状态</th>
            <td>
                <input type="radio" name="status" value="0" <?php if($info['status'] == 0): ?>checked="checked"<?php endif; ?> />待处理
                <input type="radio" name="status" value="1" <?php if($info['status'] == 1): ?>checked="checked"<?php endif; ?>/>审核中
                <input type="radio" name="status" value="2" <?php if($info['status'] == 2): ?>checked="checked"<?php endif; ?>/>审核通过
                <input type="radio" name="status" value="3" <?php if($info['status'] == 3): ?>checked="checked"<?php endif; ?>/>审核不通过
            </td>
        </tr>
        <tr>
            <th width="80">审核说明</th>
            <td>
                <textarea type="text" cols="50" rows="5" name="remark" value=""><?php echo ($info["remark"]); ?></textarea>
            </td>
        </tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script type="text/javascript">

</script>
	</body>
</html>