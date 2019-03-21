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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="#" class="on">需审核信息列表</a>				</ul>			</div>			<table class="search_table" width="100%">				<tr>					<td>						<form action="/admin.php?g=System&c=Classify&a=checkList" method="get">							<input type="hidden" value="Classify" name="c"></input>							<input type="hidden" value="checkList" name="a"></input>							选择城市：							<select name="city_id" style="width:200px;">								<option value="0">全部城市</option>								<?php if(!empty($city_list)): if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['area_id']); ?>"  <?php if($vo['area_id'] == $city_id): ?>selected="selected"<?php endif; ?>><?php echo ($vo['area_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>								<?php else: ?>									<option value="">无</option><?php endif; ?>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>			<?php if($isverify == 1): ?><!--<table class="search_table" width="100%">				<tr>					<td>					</td>				</tr>			</table>-->			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>						</colgroup>						<thead>							<tr>								<th>ID</th>								<th>一级分类</th>								<th>二级分类</th>								<th>标题</th>								<th>联系人姓名</th>								<th>联系人电话</th>								<th>最后更改时间</th>								<th>状态</th>								<th class="textcenter">操作</th>							</tr>						</thead>						<tbody>							<?php if(!empty($needCheck)): if(is_array($needCheck)): $i = 0; $__LIST__ = $needCheck;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["id"]); ?></td>										<td><?php echo ($ClassifyArr[$vo['fcid']]); ?></td>										<td><?php echo ($ClassifyArr[$vo['cid']]); ?></td>										<td><?php echo ($vo["title"]); ?></td>										<td><?php echo ($vo["lxname"]); ?></td>										<td><?php echo ($vo["lxtel"]); ?></td>																				<td><?php echo (date('Y-m-d H:i:s',$vo["updatetime"])); ?></td>										<td class="red">未审核</td>										<td class="textcenter"><a href="javascript:void(0);" onclick="toCheck(<?php echo ($vo["id"]); ?>);">审核</a>&nbsp; | &nbsp;<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Classify/infodetail',array('vid'=>$vo['id']));?>','查看信息详情',680,560,true,false,false,verifybtn,'edit',true);">查看详细</a>&nbsp; | &nbsp;<a href="javascript:void(0);" onclick="toDelItem(<?php echo ($vo["id"]); ?>);">删除</a></td>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="9"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>			<?php else: ?>			<table class="search_table" width="100%">				<tr>					<td>					您未开启发布信息需要审核功能，请到》系统设置》分类信息 中开启					</td>				</tr>			</table><?php endif; ?>		</div><script type="text/javascript">function toCheck(id){   if(confirm('您确定审核通过此项吗？')){    $.post("<?php echo U('Classify/toVerify');?>",{vid:id},function(data){	  data=parseInt(data);	  if(!data){          window.location.reload();	   }     },'JSON');   }else{     return false;   }}/***删除***/function toDelItem(id){    if(confirm('您确定删除此项吗？')){    $.post("<?php echo U('Classify/delItem');?>",{vid:id},function(data){	  data=parseInt(data);	  if(!data){          window.location.reload();	   }     },'JSON');   }else{     return false;   }}</script>	</body>
</html>