<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('House/employee_edit')}" frame="true" refresh="true">
	<input type="hidden" name="idVal" value="{pigcms{$user_info['id']}"/>
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
							<input name="account" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['account']}" placeholder="请输入用户名"/></td>
						<td height="50" align="left"><input name="pwd" type="password" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="" placeholder="请输入密码"/></td>
					</tr>
					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>姓名/公司名称：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>部门：</span></td>
					</tr>
					<tr>
						<td height="50" align="left"><input name="realname" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['realname']}" placeholder="请输入姓名/公司名称"/></td>
						<td height="50" align="left">
							<select name="department_id" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择部门</option>
								<volist name="department_categorys" id="vo">
									<option value="{pigcms{$vo['id']}" <if condition="$user_info['department_id'] eq $vo['id']">selected</if> >{pigcms{$vo.count}{pigcms{$vo.deptname}</option>
								</volist>
							</select></td>
					</tr>
					<tr>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定微信：</span></td>
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属社区：</span></td>
					</tr>
					<tr>
						<td height="50" align="left">
							<input type="text" class="input condition" name="nickname" value="" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" placeholder="请输入微信昵称"/>
						</td>
						<td height="50" align="left">
							<select name="village_id" onChange="villageCate(this)" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择社区</option>
								<volist name="village_list" id="vo">
									<option value="{pigcms{$vo['village_id']}" <if condition="$user_info['village_id'] eq $vo['village_id'] ">selected</if> >{pigcms{$vo.village_name}</option>
								</volist>
							</select></td>
					</tr>
                    <tr>
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号：</span></td>
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>商户：</span></td>
                    </tr>
                    <tr><td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['phone']}" placeholder="请输入手机号码"/></td>

                        <td height="50" align="left">
                            <select name="mer_id"  style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
                                <option selected="selected" value="0">请选择商户</option>
                                <volist name="merchant_list" id="vo">
                                    <option value="{pigcms{$vo['mer_id']}" <if condition="$user_info['mer_id'] eq $vo['mer_id']">selected</if> >{pigcms{$vo.name}</option>
                                </volist>
                            </select>
                        </td>
                    </tr>
					<tr>

						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属角色：</span></td>
<!--						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号：</span></td>-->
						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定公司：</span></td>
					</tr>
					<tr><td height="50" align="left"><select name="role_id" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择角色</option>
								<volist name="role_list" id="vo">
									<option value="{pigcms{$vo['role_id']}" <if condition="$user_info['role_id'] eq $vo['role_id']">selected</if> >{pigcms{$vo.role_name}</option>
								</volist>
							</select></td>
						
<!--						<td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;width:90%;outline:none; padding-left:10px; padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['phone']}" placeholder="请输入手机号"/></td>-->
						<td height="50" align="left">
							<select name="company_id" id="company_sel" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
								<option selected="selected" value="0">请选择公司</option>
								<volist name="company_list" id="vo">
									<option value="{pigcms{$vo['company_id']}" <if condition="$user_info['company_id'] eq $vo['company_id']">selected</if> >{pigcms{$vo.company_name}</option>
								</volist>
							</select>
						</td>
					</tr>



<!--					<tr>-->
<!--						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定公司：</span></td>-->
<!--					</tr>-->
<!--					<td height="50" align="left">-->
<!--						<select name="company_id" id="company_sel" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">-->
<!--							<option selected="selected" value="0">请选择公司</option>-->
<!--							<volist name="company_list" id="vo">-->
<!--								<option value="{pigcms{$vo['company_id']}" <if condition="$user_info['company_id'] eq $vo['company_id']">selected</if> >{pigcms{$vo.company_name}</option>-->
<!--							</volist>-->
<!--						</select>-->
<!--					</td>-->
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
<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>
<script type="text/javascript">
	function villageCate(obj){
		//alert(obj.value);
		$.ajax({
			'url':"{pigcms{:U('House/employee_edit',array('isajax'=>1))}",
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
		});

		$('.cw_reset').click(function () {
			//var reset_data=$(this).attr('reset_data');
			//window.open("","_self").close();
			window.top.location.reload();
		});


        $("input[name='nickname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true
        });


	});

	
</script>
<include file="Public:footer"/>