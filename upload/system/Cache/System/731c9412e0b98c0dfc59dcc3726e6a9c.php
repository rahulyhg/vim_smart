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
    <form id="myform" method="" action="">
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">用户</th>
            <td><input type="text" class="input fl" name="name" readonly="readonly" value="<?php echo ($log_info['name']); ?>" size="40" placeholder=""/></td>
        </tr>
        <tr>
            <th width="100">证件类型</th>
            <td><?php if($log_info["card_type"] == 1): ?><input type="text" class="input f1" value="现场审核" readonly="readonly"/><?php endif; ?>
                <?php if($log_info["card_type"] == 2): ?><input type="text" class="input f1" value="门禁卡" readonly="readonly"/><?php endif; ?>
                <?php if($log_info["card_type"] == 3): ?><input type="text" class="input f1" value="身份证" readonly="readonly"/><?php endif; ?>
                <?php if($log_info["card_type"] == 4): ?><input type="text" class="input f1" value="工作牌" readonly="readonly"/><?php endif; ?>
            </td>
        </tr>

        <?php if($log_info["card_type"] != 1 and $log_info["card_type"] != 4 ): ?><tr>
            <th width="80">证件号</th>
            <td>
                <input type="text" class="input fl" name="usernum" readonly="readonly"  value="<?php echo ($log_info['usernum']); ?>" size="40" placeholder=""/>
            </td>
        </tr><?php endif; ?>

        <?php if($log_info["card_type"] != 1): ?><tr>
                <th width="100">证件照</th>
                <td>
                    <?php $workcard_img=explode('|',$log_info['workcard_img']) ?>
                    <?php if(is_array($workcard_img)): $k = 0; $__LIST__ = $workcard_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><img alt="" src="/upload/house/<?php echo ($img); ?>" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
                        <!--<img alt="" src="./upload/house/<?php echo ($userCheck_info["workcard_img"]); ?>"  class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>--><?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr><?php endif; ?>

        <tr>
            <th width="100">时间</th>
            <td><input type="text" class="input fl" name="opdate" size="40" readonly="readonly" value="<?php echo (date('Y-m-d H:i:s',$log_info['opdate'])); ?>"/></td>
        </tr>
        <tr>
            <th width="100">设备名称</th>
            <td><input type="text" class="input fl" name="ac_name" size="40" readonly="readonly" value="<?php echo ($log_info['ac_name']); ?>"/></td>
        </tr>
        <tr>
            <th width="100">所属区域</th>
            <td><input type="text" class="input fl" name="ag_name" size="40" readonly="readonly" value="<?php echo ($log_info['ag_name']); ?>"/></td>
        </tr>
        <tr>
            <th width="100">所属社区</th>
            <td><input type="text" class="input fl" name="village_name" readonly="readonly" size="40" value="<?php echo ($log_info['village_name']); ?>"/></td>
        </tr>
        <tr>
            <th width="100">所属公司</th>
            <td><input type="text" class="input fl" name="company" size="40" readonly="readonly" value="<?php echo ($log_info['company_name']); ?>"/></td>
        </tr>      
    </table>
    <!--<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="返回" class="button" />
    </div>-->
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
    /*function addLink(domid,iskeyword){
        art.dialog.data('domid', domid);
        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
    }*/
</script>
	</body>
</html>