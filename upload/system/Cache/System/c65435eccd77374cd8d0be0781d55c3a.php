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
<div class="mainbox">

    <!--table class="search_table" width="100%">
        <tr>
            <td>
                <form action="<?php echo U('House/village');?>" method="get">
                    <input type="hidden" name="c" value="User"/>
                    <input type="hidden" name="a" value="village"/>
                    筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
                    <select name="searchtype">
                        <option value="uid" <?php if($_GET['searchtype'] == 'uid'): ?>selected="selected"<?php endif; ?>>用户ID</option>
                        <option value="nickname" <?php if($_GET['searchtype'] == 'nickname'): ?>selected="selected"<?php endif; ?>>昵称</option>
                        <option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>手机号</option>
                    </select>
                    <input type="submit" value="查询" class="button"/>
                </form>
            </td>
        </tr>
    </table-->
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
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
                    <th>名称</th>
                    <th>类型</th>
                    <th>平台</th>
                    <th>所属区域</th>
                    <th>状态</th>
                    <th>说明</th>
                    <th>时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($access_list['access_list']): if(is_array($access_list['access_list'])): $i = 0; $__LIST__ = $access_list['access_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["ac_id"]); ?></td>
                            <td><?php echo ($vo["ac_name"]); ?></td>
                            <td><?php if($vo["type"] == '1' ): ?>门禁<?php else: ?>停车<?php endif; ?></td>
                            <td>yeelink</td>
                            <td><?php echo ($vo["ag_name"]); ?></td>
                            <td><?php if($vo["ac_status"] == '1' ): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                            <td><?php echo ($vo["ac_desc"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["ac_time"])); ?></td>
                            <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Access/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true));?>','查看分类信息',480,260,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Appoint/cat_edit',array('cat_id'=>$vo['cat_id']));?>','编辑分类信息',480,<?php if($vo['cat_fid']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cat_id=<?php echo ($vo["cat_id"]); ?>" url="<?php echo U('Appoint/cat_del');?>">删除</a></td>


                            <td class="textcenter"><?php if($vo['status'] == 1): ?><font color="green">正常</font><?php elseif($vo['status'] == 0): ?><font color="red" title="等待小区管理员登录社区后台完善信息">待完善信息</font><?php else: ?><font color="red">禁止</font><?php endif; ?></td>
                            <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('House/village_edit',array('village_id'=>$vo['village_id']));?>','编辑小区信息',520,370,true,false,false,editbtn,'edit',true);">编辑</a></td>
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