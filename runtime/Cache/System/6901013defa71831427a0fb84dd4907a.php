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
        <!--<link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />-->

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

		<!--引用图表插件-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/echarts.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<?php if(!empty($terrace_array)): ?><a href="<?php echo U('Terrace/index');?>" class="on">平台列表</a>|						<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Terrace/terrace_add');?>','添加平台',480,260,true,false,false,addbtn,'add',true);">添加平台</a>					<?php else: ?>						<a href="<?php echo U('Terrace/index');?>">平台列表</a>|						<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Appoint/cat_add',array('cat_fid'=>intval($_GET['cat_fid'])));?>','添加子分类',520,370,true,false,false,addbtn,'add',true);">添加平台</a><?php endif; ?>				</ul>			</div>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>编号</th>								<th>云平台名称</th>								<th>接口基础地址</th>								<th>请求格式</th>								<th>API KEY</th>								<th>状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(!empty($terrace_array)): if(is_array($terrace_array)): $i = 0; $__LIST__ = $terrace_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["pigcms_id"]); ?></td>										<td><?php echo ($vo["terrace_name"]); ?></td>										<td><?php echo ($vo["url"]); ?></td>										<td><?php if($vo['data_type'] == 1): ?>JSON<?php endif; if($vo['data_type'] == 2): ?>XML<?php endif; ?></td>										<td><?php echo ($vo["key"]); ?></td>										<td name="change_state"><?php if($vo['is_use'] == 1): ?><font color="green">启用</font><?php elseif($vo['is_use'] == 2): ?><font color="red">待审核</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('terrace_update',array('pigcms_id'=>$vo['pigcms_id']));?>','编辑平台信息',480,<?php if($vo['cat_fid']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="pigcms_id=<?php echo ($vo["pigcms_id"]); ?>" url="<?php echo U('Terrace/terrace_del',array('pigcms_id'=>$vo['pigcms_id']));?>">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="7"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="7">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>					<script>						$(function(){							$("[name='change_state']").click(function(){								var pigcms_id = $(this).siblings(":first").text();								var is_use = $(this).text();								$.ajax({									url: "<?php echo U('Terrace/change_state');?>",									type: "GET",									data: {'pigcms_id': pigcms_id,'is_use':is_use},									success: function (res) {										if(res == 1){											alert("警告！将关闭所有平台！");											location.reload()										}else if(res ==2){											location.reload()										}else{											alert('改变失败');										}									}								});							});						});					</script>				</div>			</form>		</div>	</body>
</html>