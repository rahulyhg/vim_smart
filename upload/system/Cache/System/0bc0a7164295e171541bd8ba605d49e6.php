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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="<?php echo U('User/role');?>" class="on">角色列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/role_edit');?>','添加角色',650,500,true,false,false,addbtn,'add',true);" style="margin-left:20px;">添加角色</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col  align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>
                    <th>描述</th>
                    <th>创建时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($role_list['role_list']): if(is_array($role_list['role_list'])): $i = 0; $__LIST__ = $role_list['role_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["role_id"]); ?></td>
                            <td><?php echo ($vo["role_name"]); ?></td>
                            <td><?php echo ($vo["role_desc"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('User/role_edit',array('role_id'=>$vo['role_id']));?>','编辑角色信息',480,<?php if($vo['role_id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="role_id=<?php echo ($vo["role_id"]); ?>" url="<?php echo U('User/role_del');?>">删除</a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr><td class="textcenter pagebar" colspan="5"><?php echo ($role_list['pagebar']); ?></td></tr>
                    <?php else: ?>
                    <tr><td class="textcenter red" colspan="5">列表为空！</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
	</body>
</html>