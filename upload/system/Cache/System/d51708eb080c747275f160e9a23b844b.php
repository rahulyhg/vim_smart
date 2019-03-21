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
            <a href="<?php echo U('House/company');?>" class="on">公司管理</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('House/company_edit');?>','添加公司',520,300,true,false,false,addbtn,'add',true);">添加公司</a>
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
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>公司名称</th>
                    <th>所属社区</th>
                    <th>联系方式</th>
                    <th>时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($company_list): if(is_array($company_list)): $i = 0; $__LIST__ = $company_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["company_id"]); ?></td>
                            <td><?php echo ($vo["company_name"]); ?></td>
                            <td><?php echo ($vo["village_name"]); ?></td>
                            <td><?php echo ($vo["company_phone"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>
                            <td class="textcenter">
                                <a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('House/company_edit',array('company_id'=>$vo['company_id']));?>','编辑公司信息',480,<?php if($vo['company_id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> |
                                <a href="javascript:void(0);" class="delete_row" parameter="company_id=<?php echo ($vo["company_id"]); ?>" url="<?php echo U('House/company_del');?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr><td class="textcenter pagebar" colspan="9"><?php echo ($pagebar); ?></td></tr>
                    <?php else: ?>
                    <tr><td class="textcenter red" colspan="9">列表为空！</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
	</body>
</html>