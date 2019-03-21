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
					<a href="<?php echo U('Home/other');?>">关键词回复列表</a>|
					<a href="<?php echo U('Home/other_edit',array('id'=>$info['id']));?>" class="on">编辑关键词回复</a>
				</ul>
			</div>
			<form method="post" action="" refresh="true" enctype="multipart/form-data" >
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<th width="80">关键词</th>
						<td>
						<input type="text" class="input-text" name="key" size="20" placeholder="关键词" validate="maxlength:20,required:true" value="<?php echo ($info["key"]); ?>"/><span style="color: red;">使用相同的关键词可以实现多图文</span>
						<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
						</td>
					</tr>
					<tr>
						<th width="80">回复标题</th>
						<td><input type="text" class="input-text" name="title" size="20" placeholder="回复标题" validate="maxlength:20,required:true" value="<?php echo ($info["title"]); ?>"/></td>
					</tr>
					<tr>
						<th width="80">文章简介</th>
						<td><textarea rows="6" cols="104" name="info" ><?php echo ($info["info"]); ?></textarea></td>
					</tr>
					<tr>
						<th width="80">回复内容</th>
						<td><textarea rows="" cols="" name="content" id="content"><?php echo ($info["content"]); ?></textarea></td>
					</tr>
					<tr>
						<th width="80">外链接url</th>
						<td>
							<input type="text" class="input-text" name="url" id="url" style="width:200px;" placeholder="外链接url" validate="maxlength:200,url:true" value="<?php echo ($info["url"]); ?>"/>
							<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
						</td>
					</tr>
					<tr>
						<th width="80">回复图片</th>
						<td>
							<input type="file" class="input-text" name="pic" id="pic" value="<?php echo ($info["pic"]); ?>"/>
						</td>
					</tr>
					<?php if($info['pic']): ?><tr>
							<th width="160"></th>
							<td><img src="<?php echo ($info["pic"]); ?>" width="280" height="180"/></td>
						</tr><?php endif; ?>
					<tr>
						<th width="80">第三方接口url</th>
						<td>
							<input type="text" class="input-text" name="api_url" id="api_url" style="width:200px;" placeholder="第三方接口url" value="<?php echo ($info["api_url"]); ?>"/>
							<span style="color: red;">填写了该URL，我们会把微信发过来的数据原样的post给该接口，交给该接口处理</span>
						</td>
					</tr>
				</table>
				<div class="btn">
					<input type="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
		<style>
			.table_form{border:1px solid #ddd;}
			.tab_ul{margin-top:20px;border-color:#C5D0DC;margin-bottom:0!important;margin-left:0;position:relative;top:1px;border-bottom:1px solid #ddd;padding-left:0;list-style:none;}
			.tab_ul>li{position:relative;display:block;float:left;margin-bottom:-1px;}
			.tab_ul>li>a {
position: relative;
display: block;
padding: 10px 15px;
margin-right: 2px;
line-height: 1.42857143;
border: 1px solid transparent;
border-radius: 4px 4px 0 0;
padding: 7px 12px 8px;
min-width: 100px;
text-align: center;
}
.tab_ul>li>a, .tab_ul>li>a:focus {
border-radius: 0!important;
border-color: #c5d0dc;
background-color: #F9F9F9;
color: #999;
margin-right: -1px;
line-height: 18px;
position: relative;
}
.tab_ul>li>a:focus, .tab_ul>li>a:hover {
text-decoration: none;
background-color: #eee;
}
.tab_ul>li>a:hover {
border-color: #eee #eee #ddd;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li>a:hover {
background-color: #FFF;
color: #4c8fbd;
border-color: #c5d0dc;
}
.tab_ul>li:first-child>a {
margin-left: 0;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul:before,.tab_ul:after{
content: " ";
display: table;
}
.tab_ul:after{
clear: both;
}
</style>
<link rel="stylesheet" href="<?php echo ($static_public); ?>kindeditor/themes/default/default.css">
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script>
var diyTool = "<?php echo U('Home/diytool');?>";
var editor;
KindEditor.ready(function(K) {
	editor = K.create('#content', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : true,
		uploadJson : '/admin.php?g=System&c=Upyun&a=kindedtiropic',
		items : ['fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
		 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist','link', 'unlink','image','diyTool']
	});
});

function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
</script>
	</body>
</html>