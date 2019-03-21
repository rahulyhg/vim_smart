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
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="<?php echo U('Companypay/index');?>" class="on">提款列表</a>|
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="<?php echo U('Companypay/index');?>" method="get">
							<input type="hidden" name="c" value="Companypay"/>
							<input type="hidden" name="a" value="index"/>
							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
							<select name="searchtype">
								<option value="pay_id" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>商ID</option>								
								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>联系电话</option>
							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							支付状态: <select name="searchstatus">
								<option value="1" <?php if($_GET['searchstatus'] == '1'): ?>selected="selected"<?php endif; ?>>已支付</option>
								<option value="0" <?php if($_GET['searchstatus'] == 0): ?>selected="selected"<?php endif; ?>>已取消</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>付费类型</th>
								<th>商家id</th>
								<th>联系电话</th>
								<th>金额</th>
								<th>描述</th>
								<th>添加时间</th>
								<th>支付时间</th>
								<th>状态</th>
							</tr>
						</thead>
						<tbody>
							
								<?php if(is_array($pay_list)): $i = 0; $__LIST__ = $pay_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["pigcms_id"]); ?></td>
										<td><?php echo ($vo["pay_type"]); ?></td>
										<td><?php echo ($vo["pay_id"]); ?></td>
										<td><?php echo ($vo["phone"]); ?></td>
										<td><?php echo ($vo["money"]); ?></td>
										<td><?php echo ($vo["desc"]); ?></td>
										<td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>
										<td><?php if($vo['pay_time']): echo (date('Y-m-d H:i:s',$vo["pay_time"])); else: ?>无<?php endif; ?></td>
										
										<td><?php if($vo['status'] == 1): ?><font color="green">已支付</font><?php elseif($vo['status'] == 2): ?><font color="red">已取消</font>|<a href="<?php echo U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>0));?>"><font color="green">恢复</font></a><?php else: ?><font color="red">未支付</font>|<a href="<?php echo U('Companypay/restore',array('pigcms_id'=>$vo['pigcms_id'],'status'=>2));?>"><font color="black">取消</font></a><?php endif; ?></td>
										
										<!--<td class="textcenter"><a href="<?php echo U('Merchant/order',array('mer_id'=>$vo['mer_id']));?>">查看账单</a></td>-->
										<!--td class="textcenter"><a href="<?php echo U('Merchant/weidian_order',array('mer_id'=>$vo['mer_id']));?>">微店账单</a></td-->
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							<tr><td class="textcenter pagebar" colspan="16"><?php echo ($pagebar); ?></td></tr>	
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</body>
</html>