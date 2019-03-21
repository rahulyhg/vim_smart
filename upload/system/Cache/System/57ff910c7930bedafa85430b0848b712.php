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

<form id="myform" method="post" action="<?php echo U('Access/group_edit');?>" frame="true" refresh="true">

    <input type="hidden" name="ag_id" value="<?php echo ($group_info['ag_id']); ?>"/>

    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">

        <tr>
            <th width="100">区域名称</th>
            <td><input type="text" class="input fl" name="ag_name" value="<?php echo ($group_info['ag_name']); ?>" size="40" placeholder="请输入区域名称" /></td>
        </tr>

        <tr>
            <th width="80">所属社区</th>
            <td>
                <div class="mr15 l">
                    <select name="village_id" id="pid">
                        <option selected="selected" value="0">请选择社区</option>
w                        <?php if(is_array($village_categorys)): $i = 0; $__LIST__ = $village_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$village): $mod = ($i % 2 );++$i;?><option  value='<?php echo ($village["village_id"]); ?>' <?php if($group_info['village_id'] == $village['village_id']): ?>selected<?php endif; ?> ><?php echo ($village["village_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </td>
        </tr>

        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ag_desc" name="ag_desc" style="width:250px;height:90px;"><?php echo ($group_info['ag_desc']); ?></textarea></td></tr>

    </table>

    <div class="btn hidden">

        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />

        <input type="reset" value="取消" class="button" />

    </div>

</form>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>

<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>

<script>

    function addLink(domid,iskeyword){

        art.dialog.data('domid', domid);

        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});

    }

</script>

	</body>
</html>