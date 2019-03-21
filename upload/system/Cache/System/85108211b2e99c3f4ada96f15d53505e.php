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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>><style type="text/css">.importexcel{height: 60px;line-height: 60px;}.importexcel a{ cursor: pointer;}</style><div class="mainbox">	<div id="nav" class="mainnav_title">		<ul>			<a href="<?php echo U('House/employExecl');?>" class="on">员工导入</a>		</ul>	</div>	<table class="search_table" width="100%">		<tr>			<td>				<div class="importexcel">					&nbsp;&nbsp;&nbsp;示例表格：					<a target="_blank" href="<?php echo ($config['site_url']); ?>/upload/excel/employee/sample.xls">点击下载</a>			</td>		</tr>		<tr>			<td>				<div class="importexcel">				  <span>Excel导入： </span>				  <a href="javascript:;"><input type="file" title="Excel导入"  id="excelimport"  name="excelfile" value="选择文件上传"/></a>				</div>			</td>		</tr>	</table></div><script type="text/javascript" src="<?php echo ($static_public); ?>js/ajaxfileupload.js"></script><script type='text/javascript'>$(function(){	$("#excelimport").change(function(){ 		ExcelImport();            	});})// 上传excel 表格function ExcelImport(){		//员工文件导入方法    $.ajaxFileUpload({		url:"<?php echo U('House/employExecl');?>",  //需要链接到服务器地址		secureuri:false,		fileElementId:'excelimport',           //文件选择框的id属性		dataType: 'json',		success: function (data) {			if(data.error){				alert(data.msg);			}else{				alert('导入成功！');				window.location.reload();			}			$("#excelimport").change(function(){                 ExcelImport();            			});        }     }); }</script>	</body>
</html>