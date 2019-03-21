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
    <table class="search_table" width="100%">
<!--        <tr>-->
<!--            <td>-->
<!--                <form action="<?php echo U('Merchant/index');?>" method="get">-->
<!--                    <input type="hidden" name="c" value="Merchant"/>-->
<!--                    <input type="hidden" name="a" value="index"/>-->
<!--                    筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>-->
<!--                    <select name="searchtype">-->
<!--                        <option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>商户名称</option>-->
<!--                        <option value="account" <?php if($_GET['searchtype'] == 'account'): ?>selected="selected"<?php endif; ?>>商户帐号</option>-->
<!--                        <option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>联系电话</option>-->
<!--                        <option value="mer_id" <?php if($_GET['searchtype'] == 'mer_id'): ?>selected="selected"<?php endif; ?>>商家编号</option>-->
<!--                    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    商户状态: <select name="searchstatus">-->
<!--                        <option value="0" <?php if($_GET['searchstatus'] == 0): ?>selected="selected"<?php endif; ?>>正常</option>-->
<!--                        <option value="1" <?php if($_GET['searchstatus'] == '1'): ?>selected="selected"<?php endif; ?>>待审核</option>-->
<!--                        <option value="2" <?php if($_GET['searchstatus'] == '2'): ?>selected="selected"<?php endif; ?>>关闭</option>-->
<!--                        <option value="3" <?php if($_GET['searchstatus'] == '3'): ?>selected="selected"<?php endif; ?>>全部</option>-->
<!--                    </select>-->
<!--                    <input type="submit" value="查询" class="button"/>-->
<!--                </form>-->
<!--            </td>-->
<!--        </tr>-->
    </table>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>商户名</th>
                    <th>提现金额</th>
                    <th>申请时间</th>
                    <th>提现状态</th>
                    <th>处理人</th>
                    <th>联系方式</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["mc_name"]); ?></td>
                            <td><?php echo ($vo["tc_money"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["sub_time"])); ?></td>
                            <td><?php if($vo['status'] == 0): ?><font color="red">待处理</font><?php elseif($vo['status'] == 1): ?><font color="red">审核中</font><?php elseif($vo['status'] == 2): ?><font color="green">通过审核</font><?php else: ?><font color="red">审核不通过</font><?php endif; ?></td>
                            <td><?php echo ($vo["dispose_name"]); ?></td>
                            <td><?php echo ($vo["contact_num"]); ?></td>
                            <td><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/check',array('d_id'=>$vo['id']));?>','提现审核',600,450,true,false,false,editbtn,'edit',true);">审核</a> |
                                |<a href="javascript:void(0);" class="delete_row" parameter="d_id=<?php echo ($vo['id']); ?>" url="<?php echo U('Merchant/dradel');?>">删除</a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr><td class="textcenter pagebar" colspan="8"><?php echo ($pagebar); ?></td></tr>
                    <?php else: ?>
                    <tr><td class="textcenter red" colspan="8">列表为空！</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
	</body>
</html>