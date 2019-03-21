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
        <!--<link href="/Car/Admin/Public/assets/global/css/jquery.autocompleter.css" rel="stylesheet" type="text/css" />-->

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

		<!--引用图表插件-->
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/echarts.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="<?php echo U('Access/access_index');?>" class="on">设备列表</a>
            <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Access/access_edit');?>','添加设备',520,350,true,false,false,addbtn,'add',true);">添加设备</a>
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
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col  align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>设备所属类型</th>
                    <th>当前平台</th>
                    <th>所属区域</th>
                    <th>所属社区</th>
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
                            <td><?php echo ($vo["actype_name"]); ?></td>
                            <td><?php echo ($vo["terrace_id"]); ?></td>
                            <td><?php echo ($vo["ag_name"]); ?></td>
                            <td><?php echo ($vo["village_name"]); ?></td>
                            <td><span data_acVal="<?php echo ($vo["ac_id"]); ?>" data_status="<?php echo ($vo["ac_status"]); ?>" class="statusChange"><a href=""><?php if($vo['ac_status'] == '1' ): ?>开启<?php else: ?>关闭<?php endif; ?></a></span></td>
                            <td><?php echo ($vo["ac_desc"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["ac_time"])); ?></td>
                            <td class="textcenter"><a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('Access/access_edit',array('ac_id'=>$vo['ac_id']));?>','编辑设备信息',480,<?php if($vo['ac_id']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="ac_id=<?php echo ($vo["ac_id"]); ?>" url="<?php echo U('Access/access_del');?>">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr><td class="textcenter pagebar" colspan="10"><?php echo ($access_list['pagebar']); ?></td></tr>
                <?php else: ?>
                <tr><td class="textcenter red" colspan="10">列表为空！</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('.statusChange').click(function(){	//改变状态
            var ac_id=$(this).attr('data_acVal');	//ID值
            var ac_status=$(this).attr('data_status');	//状态值
            $.ajax({
                'url':"<?php echo U('Access/access_index');?>",
                'data':{'ac_id':ac_id,'ac_status':ac_status},
                'type':'POST',
                'dataType':'JSON',
                'success':function(msg){
                    if(msg.msg_code==0){
                        alert(msg.msg_data);
                        window.location.reload();
                    }else{
                        alert(msg.msg_data);
                    }
                },
                'error':function(){
                    //alert('loading error');
                }
            })
        })
    })
</script>
	</body>
</html>