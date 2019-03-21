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
	<form id="myform" method="post" action="<?php echo U('Diymenu/class_edit');?>" enctype="multipart/form-data" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">菜单名称</th>
				<td>
					<input type="text" class="input fl" name="title" size="20" placeholder="主菜单名称" validate="maxlength:20,required:true" value="<?php echo ($show["title"]); ?>"/>
					<input type="hidden" name="id" value="<?php echo ($show["id"]); ?>"/>
				</td>
			</tr>
			<tr>
				<th width="80">父级菜单</th>
				<td>
					<div class="mr15 l">
					<select name="pid" id="pid">
						<option selected="selected" value="0">请选择父菜单</option>
						<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><option value="<?php echo ($class["id"]); ?>" <?php if($show['pid'] == $class['id']): ?>selected<?php endif; ?>><?php echo ($class["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<em class="notice_tips" tips="二级菜单需要选择父菜单"></em>
					</div>
				</td>
			</tr>
			<tr>
				<th width="80">菜单类型</th>
				<td>
					<div class="mr15 l">
					<select name="menu_type" class="menu_type">
						<option value="1" <?php if($type == 1): ?>selected<?php endif; ?>>关键词回复菜单</option>		
						<option value="2" <?php if($type == 2): ?>selected<?php endif; ?>>url链接菜单</option>
						<option value="3" <?php if($type == 3): ?>selected<?php endif; ?>>微信扩展菜单</option>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<th width="80">关联关键词</th>
				<td><input type="text" class="input fl" name="keyword" style="width:200px;" placeholder="关联关键词" value="<?php echo ($show["keyword"]); ?>"/></td>
			</tr>
			<tr <?php if($type != 2): ?>style="display:none;"<?php endif; ?> class="url">
				<th width="80">外链接url</th>
				<td>
				<input type="text" class="input fl" name="url" id="url" style="width:200px;" placeholder="外链接url" value="<?php echo ($show["url"]); ?>"/>
				<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
				</td>
			</tr>
			<tr <?php if($type != 3): ?>style="display:none;"<?php endif; ?> class="wxsys">
				<th width="80">扩展菜单：</th>
				<td>
					<div class="mr15 l">
						<select name="wxsys">
							<option value="">请选择..</option>
							<?php if(is_array($wxsys)): $i = 0; $__LIST__ = $wxsys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wxsys): $mod = ($i % 2 );++$i;?><option value="<?php echo ($wxsys); ?>" <?php if($wxsys == $show['wxsys']): ?>selected<?php endif; ?>><?php echo ($wxsys); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
					<div class="system l"></div>
				</td>
			</tr>
			<tr>
				<th width="80">显示：</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($show['is_show'] == 1): ?>selected<?php endif; ?>"><span>是</span><input type="radio" name="is_show" value="1" <?php if($show['is_show'] == 1): ?>checked="checked"<?php endif; ?>/></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($show['is_show'] == 0): ?>selected<?php endif; ?>"><span>否</span><input type="radio" name="is_show" value="0" <?php if($show['is_show'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">排序：</th>
				<td>
					<div class="mr15 l">
					<input id="sortid" class="input fl" name="sort" title="排序"  value="<?php echo ($show["sort"]); ?>" type="text"></div>
					<div class="system l"></div>
				</td>
			</tr>
			
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
$(function(){
	$('.menu_type').change(function(){
		var val 	= $(this).val();
		if(val == 1){
			$('.keyword').css('display','');
			$('.wxsys').css('display','none');
			$('.url').css('display','none');
		}else if(val == 2){
			$('.keyword').css('display','none');
			$('.wxsys').css('display','none');
			$('.url').css('display','');		
		}else if(val == 3){

			$('.keyword').css('display','none');
			$('.wxsys').css('display','');
			$('.url').css('display','none');
		}
	});
});

function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:800,height:500,yesText:'关闭',background: '#000',opacity: 0.45});
}
</script>
	</body>
</html>