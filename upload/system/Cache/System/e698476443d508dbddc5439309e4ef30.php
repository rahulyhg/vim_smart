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
<form id="myform" method="post" action="<?php echo U('House/employee_edit');?>" frame="true" refresh="true">
	<input type="hidden" name="idVal" value="<?php echo ($user_info['id']); ?>"/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" id="tcc">
		<!--<tr>
          <td height="48" bgcolor="#eef6f9" style="border:1px #e3e7ea solid; border-radius:10px 10px 0 0; font-family:'微软雅黑'; font-size:14px;"><span style="padding-left:15px;"><strong>添加/编辑员工</strong></span></td>
        </tr>-->
		<tr>
			<td height="370" align="center" valign="top">
				<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>用户名：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>密码：</span></td>
					</tr>
					<tr>
						<td height="50" align="left">
							<input name="account" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="<?php echo ($user_info['account']); ?>" placeholder="请输入用户名"/></td>
						<td height="50" align="left"><input name="pwd" type="password" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="" placeholder="请输入密码"/></td>
					</tr>
					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>姓名/公司名称：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>部门：</span></td>
					</tr>
					<tr>
						<td height="50" align="left"><input name="truename" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="<?php echo ($user_info['truename']); ?>" placeholder="请输入姓名/公司名称"/></td>
						<td height="50" align="left">
							<select name="department_id" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择部门</option>
								<?php if(is_array($department_categorys)): $i = 0; $__LIST__ = $department_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" <?php if($user_info['department_id'] == $vo['id']): ?>selected<?php endif; ?> ><?php echo ($vo["count"]); echo ($vo["deptname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select></td>
					</tr>
					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定微信：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属社区：</span></td>
					</tr>
					<tr>
						<td height="50" align="left">
							<select name="uid" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:50%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" class="aid">
								<option selected="selected" value="0">请选择用户</option>
								<?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['uid']); ?>" <?php if($user_info['uid'] == $vo['uid']): ?>selected<?php endif; ?> ><?php echo ($vo["nickname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<input type="text" class="input condition" name="nickname" value="" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:38%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" placeholder="请输入微信昵称"/>
						</td>
						<td height="50" align="left">
							<select name="village_id" onChange="villageCate(this)" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择社区</option>
								<?php if(is_array($village_list)): $i = 0; $__LIST__ = $village_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['village_id']); ?>" <?php if($user_info['village_id'] == $vo['village_id'] ): ?>selected<?php endif; ?> ><?php echo ($vo["village_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select></td>
					</tr>
					<tr>

						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属角色：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号：</span></td>
					</tr>
					<tr><td height="50" align="left"><select name="role_id" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择角色</option>
								<?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['role_id']); ?>" <?php if($user_info['role_id'] == $vo['role_id']): ?>selected<?php endif; ?> ><?php echo ($vo["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select></td>
						
						<td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;width:90%;outline:none; padding-left:10px; padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="<?php echo ($user_info['phone']); ?>" placeholder="请输入手机号"/></td>
					</tr>

					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定公司：</span></td>
					</tr>
					<td height="50" align="left">
						<select name="company_id" id="company_sel" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
							<option selected="selected" value="0">请选择公司</option>
							<?php if(is_array($company_list)): $i = 0; $__LIST__ = $company_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['company_id']); ?>" <?php if($user_info['company_id'] == $vo['company_id']): ?>selected<?php endif; ?> ><?php echo ($vo["company_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</td>
					<tr>
						
					</tr>
				</table></td>
		</tr>
	</table>
	<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
		<input type="reset" value="取消" class="button" />
	</div>
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	function villageCate(obj){
		//alert(obj.value);
		$.ajax({
			'url':"<?php echo U('House/employee_edit',array('isajax'=>1));?>",
			'data':{'village_id':obj.value},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					//alert(msg.code_data);
					var options='';
					if(msg.code_data){
						for(var i=0;i<msg.code_data.length;i++){
							options+="<option value="+msg.code_data[i].company_id+">"+msg.code_data[i].company_name+"</option>";
						}
						//alert(options);
						document.getElementById("company_sel").innerHTML ="<option>请选择公司</option>"+options;
					}else{
						document.getElementById("company_sel").innerHTML ="<option>请选择公司</option>";
					}					
				}else{
					window.location.reload();
				}
			},
			'error':function(){
				alert('loading error');
			}
		})
	}
	$(function(){
		$('.cw_submit').click(function(){	//提交表单
			var submit_data=$(this).attr('submit_data');
			//alert(submit_data);
			$('input[name="dosubmit"]').val(submit_data);
			$('#myform').submit();
		})

		$('.cw_reset').click(function () {
			//var reset_data=$(this).attr('reset_data');
			//window.open("","_self").close();
			window.top.location.reload();
		})

		$('.condition').on('input',function(e){		//微信用户筛选
			if($('.condition').val() && $('.condition').val()!=''){
				var allOptions=$('.aid').children();
				//alert(allOptions);
				$(allOptions).each(function(i){
					if($(allOptions[i]).html().indexOf($('.condition').val())<=-1){
						$('.aid').append(allOptions[i]);
						$('.aid option').eq(0).attr('selected','true');
					}
				});
			}
		});
	})
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
	
</script>
	</body>
</html>