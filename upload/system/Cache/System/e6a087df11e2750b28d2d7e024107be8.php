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

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>		<div class="mainbox">			<div id="nav" class="mainnav_title">				<ul>					<a href="<?php echo U('Send/chanel_msg_list');?>" class="on">渠道消息列表</a>					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Send/chanel_msg_add');?>','添加渠道消息',1000,640,true,false,false,addbtn,'edit',true);">添加渠道消息</a>				</ul>			</div>			<table class="search_table" width="100%">				<tr>					<td>						<form action="<?php echo U('Send/chanel_msg_list');?>" method="get">							<input type="hidden" name="c" value="Send"/>							<input type="hidden" name="a" value="chanel_msg_list"/>							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>							<select name="searchtype">								<option value="title" <?php if($_GET['searchtype'] == 'title'): ?>selected="selected"<?php endif; ?>>标题</option>								<option value="chanel_id" <?php if($_GET['searchtype'] == 'chanel_id'): ?>selected="selected"<?php endif; ?>>消息ID</option>							</select>							<input type="submit" value="查询" class="button"/>						</form>					</td>				</tr>			</table>			<form name="myform" id="myform" action="" method="post">				<div class="table-list">					<table width="100%" cellspacing="0">						<colgroup>							<col/>							<col/>							<col/>							<col/>							<col/>							<col/>							<col width="180" align="center"/>						</colgroup>						<thead>							<tr>								<th>ID</th>								<th>标题</th>								<th>添加时间</th>								<th>最后修改时间</th>								<th>查看二维码</th>								<th class="textcenter">状态(点击改变)</th>								<th class="textcenter">编辑</th>							</tr>						</thead>						<tbody>							<?php if(is_array($chanel_list)): if(is_array($chanel_list)): $i = 0; $__LIST__ = $chanel_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>										<td><?php echo ($vo["chanel_id"]); ?></td>										<td><?php echo ($vo["title"]); ?></td>										<td><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>										<td><?php echo (date('Y-m-d H:i:s',$vo["last_time"])); ?></td>										<td><a href="<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Recognition&a=see_qrcode&type=chanel&id=<?php echo ($vo["chanel_id"]); ?>" class="see_qrcode">查看二维码</a></td>										<td class="textcenter"><a href="javascript:void(0)" onclick="changeStatus(this,<?php echo ($vo["chanel_id"]); ?>,<?php echo ($vo["status"]); ?>)"><?php if($vo['status'] == 1): ?><font color="green">正常</font><?php elseif($vo['status'] == 2): ?><font color="red">未审核</font><?php else: ?><font color="red">禁用</font><?php endif; ?></a></td>										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Send/chanel_msg_edit',array('chanel_id'=>$vo['chanel_id']));?>','编辑实体卡信息',1000,640,true,false,false,editbtn,'edit',true);">编辑</a>										<a href="javascript:void(0);" class="delete_row" parameter="id=10" url="<?php echo U('Send/delete_chanel_msg_list',array('chanel_id'=>$vo['chanel_id']));?>">删除</a>									</tr><?php endforeach; endif; else: echo "" ;endif; ?>								<tr><td class="textcenter pagebar" colspan="7"><?php echo ($pagebar); ?></td></tr>							<?php else: ?>								<tr><td class="textcenter red" colspan="7">列表为空！</td></tr><?php endif; ?>						</tbody>					</table>				</div>			</form>		</div><script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script><script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script><script type="text/javascript">	$(function(){		$('#indexsort_edit_btn').click(function(){			$(this).prop('disabled',true).html('提交中...');			$.post("/merchant.php?g=Merchant&c=Config&a=merchant_indexsort",{group_indexsort:$('#group_indexsort').val(),indexsort_groupid:$('#indexsort_groupid').val()},function(result){				alert('处理完成！正在刷新页面。');				window.location.href = window.location.href;			});		});		$('.see_qrcode').click(function(){			art.dialog.open($(this).attr('href'),{				init: function(){					var iframe = this.iframe.contentWindow;					window.top.art.dialog.data('iframe_handle',iframe);				},				id: 'handle',				title:'查看渠道二维码',				padding: 0,				width: 430,				height: 433,				lock: true,				resize: false,				background:'black',				button: null,				fixed: false,				close: null,				left: '50%',				top: '38.2%',				opacity:'0.4'			});			return false;		});	});	function changeStatus(obj,id,status){		$.post("<?php echo U('Send/change_chanel_status');?>", {chanel_id: id,status:status}, function(data, textStatus, xhr) {			if(data.status){				   window.location.reload();			}		});	}	</script>	</body>
</html>