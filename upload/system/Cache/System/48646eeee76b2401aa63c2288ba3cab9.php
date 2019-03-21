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
<form id="myform" method="post" action="<?php echo U('Access/userCheck_edit');?>" frame="true" refresh="true">
    <input type="hidden" name="pigcms_id" value="<?php echo ($userCheck_info['pigcms_id']); ?>"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">微信名</th>
            <td><input type="text" class="input fl" name="nickname" value="<?php echo ($userCheck_info['nickname']); ?>" size="40" readonly="readonly"/></td>
        </tr>
		<tr>
            <th width="100">真实姓名</th>
            <td><input type="text" class="input fl" name="name" value="<?php echo ($userCheck_info['name']); ?>" size="40" readonly="readonly"/></td>
        </tr>
		<tr>
            <th width="100">公司名称</th>
            <td><input type="text" class="input fl" name="company_name" value="<?php echo ($userCheck_info['company_name']); ?>" size="40" readonly="readonly"/></td>
        </tr>
		<!--<tr>
            <th width="100">部门</th>
            <td><input type="text" class="input fl" name="department" value="<?php echo ($userCheck_info['department']); ?>" size="40" readonly="readonly"/></td>
        </tr>-->
        <tr>
            <th width="100">证件类型</th>
            <td><?php if($userCheck_info["card_type"] == 1): ?><input type="text" class="input f1" value="现场审核" readonly="readonly"/><?php endif; ?>
                <?php if($userCheck_info["card_type"] == 2): ?><input type="text" class="input f1" value="门禁卡" readonly="readonly"/><?php endif; ?>
                <?php if($userCheck_info["card_type"] == 3): ?><input type="text" class="input f1" value="身份证" readonly="readonly"/><?php endif; ?>
                <?php if($userCheck_info["card_type"] == 4): ?><input type="text" class="input f1" value="工作牌" readonly="readonly"/><?php endif; ?>
            </td>
        </tr>

        <?php if($userCheck_info["card_type"] != 1 and $userCheck_info["card_type"] != 4 ): ?><tr>
            <th width="100">证件号</th>
            <td><input type="text" class="input fl" name="usernum" value="<?php echo ($userCheck_info['usernum']); ?>" size="40" readonly="readonly"/></td>
        </tr><?php endif; ?>

        <?php if($userCheck_info["card_type"] != 1): ?><tr>
            <th width="100">证件照</th>
            <td>
			<?php $workcard_img=explode('|',$userCheck_info['workcard_img']) ?>
			<?php if(is_array($workcard_img)): $k = 0; $__LIST__ = $workcard_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><img alt="" src="/upload/house/<?php echo ($img); ?>" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
			<!--<img alt="" src="./upload/house/<?php echo ($userCheck_info["workcard_img"]); ?>"  class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>--><?php endforeach; endif; else: echo "" ;endif; ?>
			</td>
        </tr><?php endif; ?>

        <tr>
            <th width="80">审核结果</th>
            <td>
                <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <?php if($userCheck_info['ac_status'] == 1): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;审核中</label>
                &nbsp;&nbsp;&nbsp;
                <label><input value="2" name="ac_status" type="radio"  onclick='document.getElementById("d1").style.display="none" ;' <?php if($userCheck_info['ac_status'] == 2 || $userCheck_info['ac_status'] == 4): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;通过</label>
                &nbsp;&nbsp;&nbsp;
                <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <?php if($userCheck_info['ac_status'] == 3): ?>checked="checked"<?php endif; ?> />&nbsp;&nbsp;未通过</label>
           </td>
        </tr>
        <tr>
            <th width="100">审核人</th>
            <td><input type="text" class="input fl" name="check_name" value="<?php echo ($userCheck_info['check_name']); ?>" size="40" readonly="readonly"/></td>
        </tr>
        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ag_desc" name="ac_desc" style="width:250px;height:90px;"><?php echo ($userCheck_info['ac_desc']); ?></textarea></td></tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K){
        kind_editor = K.create("#description",{
            width:'400px',
            height:'400px',
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
            uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
        });
    });
    $(function(){
        $("#wc_img").imgbox({
            'speedIn'		: 0,
            'speedOut'		: 0,
            'alignment'		: 'center',
            'overlayShow'	: true,
            'allowMultiple'	: false
        });
    });
</script>
	</body>
</html>
<!--陈琦
   2016.6.8-->