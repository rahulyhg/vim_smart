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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<form name="myform" id="myform" action="<?php echo U('TemplateMsg/index');?>" method="post" refresh="true">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup><col> <col> <col><col>  <col width="180" align="center"> </colgroup>						<thead>							<tr>								<th>模板编号</th>								<th>模板名</th>								<th>回复内容</th>								<th>头部颜色</th>								<th>文字颜色</th>								<th>状态</th>								<th>模板ID</th>							</tr>						</thead>						<tbody>			                  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><tr>			                      <td><input type="hidden" name="tempkey[]" value="<?php echo ($t["tempkey"]); ?>" /><?php echo ($t["tempkey"]); ?></td>			                      <td><input type="hidden" name="name[]" value="<?php echo ($t["name"]); ?>" /><?php echo ($t["name"]); ?></td>			                      <td><input type="hidden" name="content[]" value="<?php echo ($t["content"]); ?>" /><pre><?php echo ($t["content"]); ?></pre></td>			                      <td><input type="text" name="topcolor[]" value="<?php echo ($t["topcolor"]); ?>" class="px color" style="width: 55px; background:<?php echo ($t["topcolor"]); ?>; color: rgb(255, 255, 255);"</td>			                      <td>			                        <input type="text" name="textcolor[]" value="<?php echo ($t["textcolor"]); ?>" class="px color" style="width: 55px; background:<?php echo ($t["textcolor"]); ?>; color: rgb(255, 255, 255);" />			                      </td>			                      <td>			                          <select name="status[]">			                            <option value="0" <?php if($t['status'] == 0): ?>selected<?php endif; ?>>关闭</option>			                            <option value="1" <?php if($t['status'] == 1): ?>selected<?php endif; ?>>开启</option>			                          <select>			                      </td>			                      <td class="norightborder"><input type="text" class="input-text" name="tempid[]" value="<?php echo ($t["tempid"]); ?>" /></td>			                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>			                  <tr>			                    <td colspan="7" align="center"><input type="submit" name="dosubmit" value="保存" class="button"/></td>			                  </tr>						</tbody>					</table>				</div>			</form>		</div><script src="/static/js/cart/jscolor.js" type="text/javascript"></script>	</body>
</html>