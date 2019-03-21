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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Appoint/cue_field',array('cat_id'=>$now_category['cat_id']));?>" class="on">填写项列表</a>|					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Appoint/cue_field_add',array('cat_id'=>$now_category['cat_id']));?>','添加填写项',460,250,true,false,false,addbtn,'add',true);">添加填写项</a>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>排序</th>								<th>名称</th>								<th>类型</th>								<th>必填</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($now_category['cue_field'])): if(is_array($now_category['cue_field'])): $i = 0; $__LIST__ = $now_category['cue_field'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["sort"]); ?></td>										<td><?php echo ($vo["name"]); ?></td>										<td>											<?php if($vo['type'] == 1): ?>多行											<?php elseif($vo['type'] == 2): ?>地图											<?php elseif($vo['type'] == 3): ?>下拉框											<?php elseif($vo['type'] == 4): ?>数字											<?php elseif($vo['type'] == 5): ?>邮件											<?php elseif($vo['type'] == 6): ?>日期											<?php elseif($vo['type'] == 7): ?>时间											<?php elseif($vo['type'] == 9): ?>日期时间											<?php elseif($vo['type'] == 8): ?>手机											<?php else: ?>单行<?php endif; ?>										</td>										<td>											<?php if($vo['iswrite'] == 1): ?>是<?php else: ?>否<?php endif; ?>										</td>										<td class="textcenter"><a href="javascript:void(0);" class="delete_row" parameter="cat_id=<?php echo ($now_category["cat_id"]); ?>&name=<?php echo ($vo["name"]); ?>" url="<?php echo U('Appoint/cue_field_del');?>">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>							<?php else: ?>								<tr><td class="textcenter red" colspan="6">预约表单须知预设选项列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>