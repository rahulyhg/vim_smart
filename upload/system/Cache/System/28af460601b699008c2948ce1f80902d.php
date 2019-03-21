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

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>><div class="mainbox">    <div id="nav" class="mainnav_title">        <ul>            <a href="<?php echo U('User/department');?>" class="on">部门列表</a>            <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/department_edit');?>','添加部门',520,350,true,false,false,addbtn,'add',true);">添加部门</a>        </ul>    </div>    <form name="myform" id="myform" action="" method="post">        <div class="table-list">            <table width="100%" cellspacing="0">                                <thead>                <tr>                    <th>ID</th>                    <th>名称</th>                    <th>状态</th>                    <th>说明</th>                    <th>时间</th>                    <th class="textcenter">操作</th>                </tr>                </thead>                <tbody>                <?php if($department_arr['department_list']): if(is_array($department_arr['department_list'])): $i = 0; $__LIST__ = $department_arr['department_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>                            <td><?php echo ($vo["id"]); ?></td>                            <td><?php echo ($vo["deptname"]); ?></td>                            <td><span data_idVal="<?php echo ($vo["id"]); ?>" data_status="<?php echo ($vo["status"]); ?>" class="statusChange" style="cursor:pointer"><?php if($vo['status'] == '1' ): ?>开启<?php else: ?>关闭<?php endif; ?></span></td>                            <td><?php echo ($vo["desc"]); ?></td>                            <td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>                            <td class="textcenter">								<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/department_edit',array('id'=>$vo['id']));?>','编辑部门信息',480,<?php if($vo['id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | 								<a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('User/department_del');?>">删除</a>							</td>						</tr><?php endforeach; endif; else: echo "" ;endif; ?>					<tr><td class="textcenter pagebar" colspan="10"><?php echo ($department_arr['pagebar']); ?></td></tr>                <?php else: ?>					<tr><td class="textcenter red" colspan="10">列表为空！</td></tr><?php endif; ?>                </tbody>            </table>        </div>    </form></div><script type="text/javascript">$(function(){	$('.statusChange').click(function(){	//改变状态		var idVal=$(this).attr('data_idVal');	//ID值		var status=$(this).attr('data_status');	//状态值		$.ajax({			'url':"<?php echo U('User/department');?>",			'data':{'idVal':idVal,'status':status},			'type':'POST',			'dataType':'JSON',			'success':function(msg){				if(msg.msg_code==0){					alert(msg.msg_data);					window.location.reload();				}else{					alert(msg.msg_data);				}			},			//'error':function(){			//	alert('loading error');			//}		})	})})</script>	</body>
</html>