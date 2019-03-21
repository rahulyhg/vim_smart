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

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
	<style>.frame_form td{vertical-align:middle;}</style>
	<form id="myform" method="post" action="<?php echo U('Send/chanel_msg_add');?>" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			
		
			<tr>
				<td width="80">标题</td>
				<td>
				<input type="text"  style="width:300px;" class="input fl" name="Full_title" value=""  validate="required:true" autocomplete="off" />
				</td>
			</tr>
			<tr class="plus">
				<td width="40">图文<label>1</label></td>
				<td>
					<table style="width:100%;border:#d5dfe8 1px solid;padding:2px;">
						<tr>
							<td width="60">标题：</td>
							<td><input type="text" style="width:200px;" class="input" name="title[]"  value=""  /></td>
							<td width="60">图片：</td>
							<td><input type="text"  style="width:200px;" name="img[]" class="input input-image" value=""   readonly>&nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-sm btn-success J_selectImage"  style="background: #87b87f!important;border-color: #87b87f;color:#fff;">上传图片</a></td>
							<td rowspan="2" class="delete">
								<a href="javascript:void(0)" onclick="del(this)"><img style="width:30px;height:30px;" src="<?php echo ($static_path); ?>images/del.jpg"/></a>
							</td>
						<tr/>
						<tr>
							<td width="60">描述：</td>
							<td><textarea  style="width:200px;height:60px" class="input" name="des[]" ></textarea></td>
							<td width="60">链接：</td>
							<td><input type="text"  style="width:200px;" class="input" name="url[]" id="url" value="" /><a href="#modal-table" id="addLink" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><a href="javascript:void(0)" onclick="plus()"><img style="width:30px;height:30px;" src="<?php echo ($static_path); ?>images/plus.jpg"/></a></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
		
	</form>
	<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
	<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>

	<link rel="stylesheet" href="<?php echo ($static_public); ?>kindeditor/themes/default/default.css">
	<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
	<script src="<?php echo ($static_public); ?>kindeditor/lang/zh_CN.js"></script>
	<script type="text/javascript" src="./static/js/upyun.js"></script>

	<script type="text/javascript">
		KindEditor.ready(function(K){
				var site_url = "<?php echo ($config["site_url"]); ?>";
				var editor = K.editor({
					allowFileManager : true
				});
				$('.J_selectImage').click(function(){
					var upload_file_btn = $(this);
					editor.uploadJson = "<?php echo U('Config/ajax_upload_pic');?>";
					editor.loadPlugin('image', function(){
						editor.plugin.imageDialog({
							showRemote : false,
							clickFn : function(url, title, width, height, border, align) {
								upload_file_btn.siblings('.input-image').val(site_url+url);
								editor.hideDialog();
							}
						});
					});
				});

			});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			if($('.odd').length<=1){
				$('.delete').children('a').hide();
			}
		});
		function plus(){
			var item = $('.plus:last');
			var newitem = $(item).clone(true);
			var No = parseInt(item.find("label").html())+1;
			$('.delete').children().show();
			if(No>10){
				alert('不能超过10条信息');
			}else{
				$(item).after(newitem);
				newitem.find('input').attr('value','');
				newitem.find('textarea').attr('value','');
				newitem.find("#addLink").attr('onclick',"addLink('url"+No+"',0)");
				newitem.find("label").html(No);
				newitem.find('input[name="url[]"]').attr('id','url'+No);
				newitem.find('.delete').children().show();
			}
		}
		function del(obj){
			if($('.plus').length<=1){
				$('.delete').children().hide();
			}else{
				if($('.plus').length==2){
					$('.delete').children().hide();
				}
				$(obj).parents('.plus').remove();
				$.each($('.plus'), function(index, val) {
					var No =index+1;
					$(val).find('label').html(No);
					$(val).find('input[name="url[]"]').attr('id','url'+No);
					$(val).find("#addLink").attr('onclick',"addLink('url"+No+"',0)");
				});
			}
		}

		function addLink(domid,iskeyword){
			art.dialog.data('domid', domid);
			art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:800,height:500,yesText:'关闭',background: '#000',opacity: 0.45});
		}
	</script>
	</body>
</html>