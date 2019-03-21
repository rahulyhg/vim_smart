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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('Merchant/wait_store');?>" method="get">							<input type="hidden" name="c" value="Merchant"/>							<input type="hidden" name="a" value="wait_store"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>店铺名称</option>																<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>联系电话</option>								<option value="store_id" <?php if($_GET['searchtype'] == 'store_id'): ?>selected="selected"<?php endif; ?>>店铺编号</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>						<thead>							<tr>								<th>编号</th>								<th>店铺名称</th>								<th>联系电话</th>								<th>最后编辑时间</th>								<th>平台点击数</th>								<th><?php echo ($config["meal_alias_name"]); ?></th>								<th><?php echo ($config["group_alias_name"]); ?></th>								<th>状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(is_array($store_list)): if(is_array($store_list)): $i = 0; $__LIST__ = $store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["store_id"]); ?></td>										<td><?php echo ($vo["name"]); ?></td>										<td><?php echo ($vo["phone"]); ?></td>										<td><?php if($vo['last_time']): echo (date('Y-m-d H:i:s',$vo["last_time"])); else: ?>无<?php endif; ?></td>										<td><?php echo ($vo["hits"]); ?></td>										<td><?php if($vo['have_meal'] == 1): ?><font color="green">开启</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>										<td><?php if($vo['have_group'] == 1): ?><font color="green">开启</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>										<td><?php if($vo['status'] == 1): ?><font color="green">启用</font><?php elseif($vo['status'] == 2): ?><font color="red">审核中</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/store_edit',array('store_id'=>$vo['store_id'],'frame_show'=>true));?>','查看店铺信息',520,440,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/store_edit',array('store_id'=>$vo['store_id']));?>','编辑店铺信息',520,440,true,false,false,editbtn,'store_add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="store_id=<?php echo ($vo["store_id"]); ?>" url="<?php echo U('Merchant/store_del');?>">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="10"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="10">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div>	</body>
</html>