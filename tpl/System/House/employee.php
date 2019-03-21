<include file="Public:header"/>
<style type="text/css">
.aui_outer .aui_border{width:700px;}
.table_list td.td_checkbox{border:1px #dfdfdf solid;width:5%;height:42px;text-align:center;background-color:#f4f4f4;}
.table_list td.td_left{border:1px #dfdfdf solid;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;padding-left:10px;height:42px;text-align:left;background-color:#f4f4f4;}
.table_list td.td_center{border:1px #dfdfdf solid;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;height:42px;text-align:center;background-color:#f4f4f4;}
.table_list td.td_checkbox2{border:1px #dfdfdf solid;border-top:none;height:42px;text-align:center}
.table_list td.td_left2{border:1px #dfdfdf solid;border-top:none;border-left:none;font-family:'微软雅黑';font-size:14px;color:#727272;padding-left:10px;height:42px;text-align:left;}
.table_list td.td_center2{border:1px #dfdfdf solid;border-top:none;border-left:none;font-family:'微软雅黑';font-size:14px;color:#3a6ea5;height:42px;text-align:center}
.table_list .textcenter{text-align:center}
.table_list td.td_center2 .clickChange{cursor:pointer}
</style>
<div class="mainbox">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px #dfdfdf solid; border-top:none;">
        <tr>
            <td height="52" colspan="4" align="left" style="border:1px #dfdfdf solid; border-left:none; background-color:#f5f5f5; padding-left:14px; font-size:16px; font-family:'微软雅黑';">企业资源管理</td>
            <td width="76%" height="42" style="border:1px #dfdfdf solid; border-left:none; border-right:none; background-color:#f5f5f5;">
                <div class="wz1 dept_nameVal"><!--武汉邻钱科技有限公司-->{pigcms{$department_info.deptname}</div>
                <div class="wz2">部门</div>
                <div class="wz3 dept_idVal">
					<!--<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/department_edit',array('id'=>$vo['id']))}','编辑部门',520,350,true,false,false,editbtn,'edit',true);" class="frr">编辑部门</a>-->
					<input type="hidden" name="dept_idVal" value="{pigcms{$department_info.id}">
					<a href="javascript:void(0);" onclick="dept_click(this)" class="frr">编辑部门</a>
				</div>
				<div class="wz3">
					<a href="javascript:void(0);" onclick="del_click(this)" class="frr">删除部门</a>
				</div>
                <div class="wz4">
                    <div class="ss1">
                        <!--<input type="text" name="textfield2" style="width:95%;margin-left:5%;height:31px;line-height:31px;margin-top:2px;border:none;outline:none;font-family:'微软雅黑';font-size:14px;" value="搜索员工" onfocus="this.value='';" onblur="this.value='搜索员工';"/>-->
						<input type="text" name="keywordUser" style="width:95%;margin-left:5%;height:31px;line-height:31px;margin-top:2px;border:none;outline:none;font-family:'微软雅黑';font-size:14px;" value="" placeholder="搜索员工"/>
					</div>
                    <div class="ss2"></div>
                    <div class="both"></div>
                </div>
                <div class="both"></div>	</td>
        </tr>
        <tr>
            <td colspan="4" align="center" valign="top" style="border:1px #dfdfdf solid; border-top:none; border-left:none; border-bottom:none;">
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><div class="chu">
				<div class="q1"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/department_edit')}','添加部门',520,380,true,false,false,addbtn,'add',true);" class="cbs">
					<div class="uz"></div>
					<div class="uz2">添加部门</div></a>
				</div>
				<div class="q2"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/employee_edit')}','添加员工',700,470,true,false,false,addbtn,'add',true);" class="cbs">
					<div class="utz"></div>
					<div class="utz2">添加员工</div></a>
				</div>
				<div class="q3"><a href="#" class="cbs" onclick="window.top.artiframe('{pigcms{:U('House/employExecl')}','导入员工',700,445,true,false,false,'',true);">
					<div class="uwz"></div>
					<div class="uwz2">导入/导出<br />
					员工</div></a>
				</div>
				<div class="q4"><a href="#" class="cbs">
					<div class="uhz"></div>
					<div class="uhz2">团队邀请</div></a>
				</div>
				<div class="both"></div>
			</div></td>
				</tr>
				<tr align="center" height="60">
					<td><table width="95%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td height="33" style="border:1px #dedede solid; -moz-border-radius:8px; -webkit-border-radius:8px; border-radius:8px">
								<div class="fdj dept_select"><img src="{pigcms{$static_path}images/fdj.jpg" width="24" height="24"/></div>
								<div class="wb">
									<!--<input name="textfield" type="text" style="width:100%;height:33px;line-height:33px;border:none;outline:none;font-family:'微软雅黑';font-size:14px;" value="请输入搜索的部门" onfocus="this.value='';" onblur="this.value='请输入搜索的部门';"/>-->
									<input name="keywordDept" type="text" style="width:100%;height:33px;line-height:33px;border:none;outline:none;font-family:'微软雅黑';font-size:14px;" value="" placeholder="请输入搜索的部门"/>
								</div>
							</td>
						</tr>
					</table></td>
				</tr>
				<tr>
					<td style="border:1px #dfdfdf solid; border-left:none; border-right:none; border-bottom:none;">
					<div class="xdp"><img src="{pigcms{$static_path}images/hyt.png" width="22" height="17" /></div>
					<div class="xdp2 st_tree"><!--武汉邻钱科技有限公司-->
						<div style="margin-top:10px;">{pigcms{$department_tree}</div>
					</div>
					<div class="both"></div></td>
				</tr>
			 </table>
			</td>
            <td align="center" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px; margin-bottom:20px;">
				<tr>
					<td width="3%" height="46" align="left"><img src="{pigcms{$static_path}images/ry.jpg" width="39" height="29" /></td>
					<td width="15%" height="46" align="left" style="font-size:16px; font-family:'微软雅黑'; color:#3a6ea5; padding-left:10px;">部门人员</td>
					<td width="74%" height="46" align="right" class="but"><a href="javascript:void(0);" data_status="1" class="cbs status_click">
				  <div class="fer">批量启用</div></a></td>
                    <td width="74%" height="46" align="right" class="but"><a href="javascript:void(0);" data_status="0" class="cbs status_click">
                            <div class="fer">批量禁用</div></a></td>
					<!--<td width="8%" height="46" align="left" class="but2 btn-default"><a href="javascript:void(0);" class="cbs"><div class="fe">添加员工</div></a></td>-->
					<td width="8%" height="46" colspan="2" align="left" class="but2"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/employee_edit')}','添加员工',700,380,true,false,false,addbtn,'add',true);" class="cbs"><div class="fe">添加员工</div>
					</a></td>
				</tr>
				<tr>
					<td colspan="5" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;" class="table_list">
						<tr>
							<td class="td_checkbox"><input type="checkbox" class="td_checkbox"  name="checkbox" value="checkbox" /></td>
							<td class="td_left" width="10%">用户名</td>
							<td class="td_left" width="20%">真实姓名</td>
<!--							<td class="td_left" width="15%">手机号</td>-->
							<td class="td_left" width="20%">时间</td>
							<td class="td_center" width="10%">状态</td>								
							<td class="td_center" width="15%">操作</td>
						</tr>
						
						<if condition="$user_arr['user_list']">
							<volist name="user_arr['user_list']" id="vo">
								<tr>
									<td class="td_checkbox2"><input type="checkbox"  name="checkbox2" value="{pigcms{$vo.id}" /> </td>
									<td class="td_left2">{pigcms{$vo.account}</td>
									<td class="td_left2">{pigcms{$vo.truename}</td>									
<!--									<td class="td_left2">{pigcms{$vo.phone}</td>-->
									<td class="td_left2">{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
									<td class="td_center2"><span data_id="{pigcms{$vo.id}" data_status="{pigcms{$vo.status}" class="clickChange"><if condition="$vo.status eq '1' ">已启用<else/>已禁用</if></span></td>
									<td class="td_center2">
									<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('House/employee_edit',array('id'=>$vo['id']))}','编辑员工',700,380,true,false,false,editbtn,'edit',true);" class="bj">编辑</a> |
									<a href="javascript:void(0);" class="delete_row bj" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('House/employee_del')}">删除</a></td>
								</tr>
							</volist>
							<tr style="height:40px;"><td class="textcenter pagebar" colspan="7">{pigcms{$user_arr['pagebar']}</td></tr>
							<else/>
							<tr><td class="textcenter black" colspan="8">列表为空！</td></tr>
						</if>
					</table></td>
				</tr>
			</table></td>
        </tr>
    </table>
</div>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/SimpleTree.css" />
<script type="text/javascript" src="{pigcms{$static_path}js/SimpleTree.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/ajaxfileupload.js"></script>
<script type="text/javascript">
var del_url="{pigcms{:U('House/employee_del')}";
$(function(){
	//搜索部门
	$('.dept_select').click(function(){		
		var keyword=$('input[name="keywordDept"]').val();	//关键词
		//if(keyword=="" || keyword=="null"){
		//	alert('请输入关键词');
		//}else{
			$.ajax({
				'url':"{pigcms{:U('House/dept_select',array('isajax'=>1))}",
				'data':{'keyword':keyword},
				'type':'get',
				'dataType':'JSON',
				'success':function(msg){
					//alert(msg.code_data.length);
					for(var i=0;i<msg.code_data.length;i++){
						$('.dept_li').each(function(){	
							if($(this).attr('ref')==msg.code_data[i].id){//展示对应的部门
								//alert($(this).attr('ref'));
								$(this).parent('li').parent('ul').css('display','block');
								$(this).parent('li').parent('ul').attr('show',true);
							}
						});
					}
				},
				'error':function(){
					alert('loading error');
				}
			})
		//}		
	});
	
	//搜索员工
	$('.ss2').click(function(){		
		var keyword=$('input[name="keywordUser"]').val();	//关键词
		//if(keyword=="" || keyword=="null"){
		//	alert('请输入关键词');
		//}else{
			$.ajax({
				'url':"{pigcms{:U('House/employee',array('isajax'=>1))}",
				'data':{'keyword':keyword},
				'type':'get',
				'dataType':'JSON',
				'success':function(msg){
					$('.table_list').text('');
					var list_content='<tr><td class="td_checkbox"><input class="td_checkbox" type="checkbox" name="checkbox" value="checkbox"/></td>';
					list_content+='<td width="10%" class="td_left">用户名</td>';
					list_content+='<td width="30%" class="td_left">真实姓名</td>';					
					//list_content+='<td width="15%" class="td_left">手机号</td>';
					list_content+='<td width="20%" class="td_left">时间</td>';
					list_content+='<td width="10%" class="td_center">状态</td>';
					list_content+='<td width="15%" class="td_center">操作</td></tr>';
					if(msg.code_data.user_list){
						for(var i=0;i<msg.code_data.user_list.length;i++){
							if(msg.code_data.user_list[i].status==1){
								var status_name='已启用';
							}else{
								var status_name='已禁用';
							}
							list_content+='<tr><td class="td_checkbox2"><input type="checkbox" name="checkbox2" value="'+msg.code_data.user_list[i].id+'"/></td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].account+'</td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].truename+'</td>';
							//list_content+='<td class="td_left2">'+msg.code_data.user_list[i].phone+'</td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].add_time+'</td>';	
							list_content+='<td class="td_center2"><span data_id="'+msg.code_data.user_list[i].id+'" data_status="'+msg.code_data.user_list[i].status+'" class="clickChange">'+status_name+'</span></td>';	
							list_content+='<td class="td_center2"><a href="javascript:void(0);" data_idVal="'+msg.code_data.user_list[i].id+'" class="bj select_bj">编辑</a> | <a href="javascript:void(0);" class="delete_row bj" parameter="id='+msg.code_data.user_list[i].id+'" url="'+del_url+'">删除</a></td></tr>';
						}
						list_content+='<tr style="height:40px;"><td class="textcenter pagebar" colspan="7">'+msg.code_data.pagebar+'</td></tr>';
					}else{
						list_content+='<tr><td class="textcenter black" colspan="7">列表为空！</td></tr>';
					}
					$('.table_list').append(list_content);
					employeeChange();
					employeeEdit();
					checkAll();
					employeeDel();
				},
				'error':function(){
					alert('loading error');
				}
			})
		//}		
	});
		
	$(".st_tree").SimpleTree({	//树形菜单js初始化
	});
	
	//遍历部门树形结构
	$('.dept_li').each(function(){	
		$(this).click(function(){
			var dept_idVal=$(this).attr('ref');
			$('input[name="dept_idVal"]').val(dept_idVal);
			$('.dept_nameVal').text($(this).text());
			//alert(dept_idVal);
			$.ajax({
				'url':"{pigcms{:U('House/employee',array('isajax'=>1))}",
				'data':{'department_id':dept_idVal},
				'type':'get',
				'dataType':'JSON',
				'success':function(msg){
					//alert(msg.code_data.user_list.length);
					$('.table_list').text('');
					var list_content='<tr><td class="td_checkbox"><input class="td_checkbox" type="checkbox" name="checkbox" value="checkbox"/></td>';
					list_content+='<td width="10%" class="td_left">用户名</td>';
					list_content+='<td width="30%" class="td_left">真实姓名</td>';					
					//list_content+='<td width="15%" class="td_left">手机号</td>';
					list_content+='<td width="20%" class="td_left">时间</td>';
					list_content+='<td width="10%" class="td_center">状态</td>';
					list_content+='<td width="15%" class="td_center">操作</td></tr>';
					if(msg.code_data.user_list){
						for(var i=0;i<msg.code_data.user_list.length;i++){
							if(msg.code_data.user_list[i].status==1){
								var status_name='已启用';
							}else{
								var status_name='已禁用';
							}
							list_content+='<tr><td class="td_checkbox2"><input type="checkbox" name="checkbox2" value="'+msg.code_data.user_list[i].id+'"/></td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].account+'</td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].truename+'</td>';
							//list_content+='<td class="td_left2">'+msg.code_data.user_list[i].phone+'</td>';
							list_content+='<td class="td_left2">'+msg.code_data.user_list[i].add_time+'</td>';
							list_content+='<td class="td_center2"><span data_id="'+msg.code_data.user_list[i].id+'" data_status="'+msg.code_data.user_list[i].status+'" class="clickChange">'+status_name+'</span></td>';						
							list_content+='<td class="td_center2"><a href="javascript:void(0);" data_idVal="'+msg.code_data.user_list[i].id+'" class="bj select_bj">编辑</a> | <a href="javascript:void(0);" class="delete_row bj" parameter="id='+msg.code_data.user_list[i].id+'" url="'+del_url+'">删除</a></td></tr>';
						}
						list_content+='<tr style="height:40px;"><td class="textcenter pagebar" colspan="7">'+msg.code_data.pagebar+'</td></tr>';
					}else{
						list_content+='<tr><td class="textcenter black" colspan="7">列表为空！</td></tr>';
					}
					$('.table_list').append(list_content);
					employeeChange();
					employeeEdit();
					checkAll();
					employeeDel();
				},
				'error':function(){
					alert('loading error');
				}
			})
		});
	});
		
	employeeChange();
	checkAll();
})

//改变用户状态方法
function employeeChange(){	
	$('.clickChange').click(function(){	
		var idVal=$(this).attr('data_id');
		var statusVal=$(this).attr('data_status');
		var this_change=$(this);
		$.ajax({
			'url':"{pigcms{:U('House/employee_status')}",
			'data':{'ids':idVal,'status':statusVal},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.msg_code==0){
					//alert(msg.msg_data);
					//window.location.reload();
					if(msg.msg_data==1){
						var status_name='已启用';
					}else{
						var status_name='已禁用';
					}
					this_change.attr('data_status',msg.msg_data); //修改状态
					this_change.text(status_name);					
				}else{
					alert(msg.msg_data);
				}
			},
			'error':function(){
				//alert('loading error');
			}
		})
	})
}

//批量启用或禁用
$(function(){	
	$('.status_click').click(function(){
		var statusVal=$(this).attr('data_status');
		checkbox2=$("input[name='checkbox2']");
		//alert(checkbox2.length);
		var ids_arr=new Array();
		for(var i=0;i<checkbox2.length;i++){
			//alert(checkbox2[i].checked);
			if(checkbox2[i].checked==true){	//判断是否被选中
				ids_arr[i]=checkbox2[i].value;
			}
		}
		//alert(ids_arr);
		if(ids_arr=="" || ids_arr=="null"){
			alert('请选择用户！');
		}else{
			$.ajax({
				'url':"{pigcms{:U('House/employee_status')}",
				'data':{'ids':ids_arr,'status':statusVal},
				'type':'POST',
				'dataType':'JSON',
				'success':function(msg){
					if(msg.msg_code==0){
						//alert(msg.msg_data);
						//window.location.reload();
						$('.table_list').text("");
						$('.table_list').append(msg.msg_data);
						//alert(ids_arr.length);		
					}else{
						alert(msg.msg_data);
					}
					employeeEdit();
					employeeDel();
					checkAll();
				},
				'error':function(){
					//alert('loading error');
				}
			})
		}
	})
})

//修改用户信息方法
function employeeEdit(){	
	$('.select_bj').click(function(){
		var employee_idVal=$(this).attr('data_idVal');
		//alert(employee_idVal);
		window.top.artiframe('/admin.php?g=System&c=House&a=employee_edit&id='+employee_idVal,'编辑员工',700,380,true,false,false,editbtn,'edit',true);
	});
}
function employeeDel(){		//删除员工
	$('.delete_row').click(function(){	
		var now_dom = $(this);
		window.top.art.dialog({
			icon: 'question',
			title: '请确认',
			id: 'msg' + Math.random(),
			lock: true,
			fixed: true,
			opacity:'0.4',
			resize: false,
			content: '你确定这样操作吗？操作后可能不能恢复！',
			ok:function (){
				$.post(now_dom.attr('url'),now_dom.attr('parameter'),function(result){
					if(result.status == 1){
						window.top.msg(1,result.info,true);				
						if(now_dom.closest('table').find('tr').size()>3){
							now_dom.closest('tr').remove();
							//$('#row_count').html(parseInt($('#row_count').html())-1);
						}else{
							window.location.reload();
						}
					}else{
						window.top.msg(0,result.info);
					}
				});
			},
			cancel:true
		});
		return false;
	});
}
//编辑部门
function dept_click(obj){	
	var dept_idVal=$('input[name="dept_idVal"]').val();
	//alert(dept_idVal);
	window.top.artiframe('/admin.php?g=System&c=House&a=department_edit&id='+dept_idVal,'编辑部门',520,350,true,false,false,editbtn,'edit',true);
}

//删除部门
function del_click(obj){
	if(window.confirm('你确定要删除吗？')){
		var dept_idVal=$('input[name="dept_idVal"]').val();
		$.ajax({
			'url':"{pigcms{:U('House/dept_del')}",
			'data':{'id':dept_idVal},
			'type':'POST',
			'dataType':'JSON',
			'success':function (data) {
				if(data.err_code==0){	//删除成功
					alert(data.code_data);
					window.location.reload();
				}else{
					alert(data.code_data);
				}
			},
			'error':function(){
				//alert('loading error');
			}
		})
	}
}

function checkAll(){	 	//全选方法
	$(".td_checkbox").click(function(){
		$('input[name="checkbox2"]').attr("checked",this.checked);
	});
	var checkbox2=$("input[name='checkbox2']");
	checkbox2.click(function(){
		$(".td_checkbox").attr("checked",checkbox2.length==$("input[name='checkbox2']:checked").length ? true : false);
	});
}

</script>
<include file="Public:footer"/>

