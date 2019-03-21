<!--头部-->
<include file="Public:top"/>
<!--头部结束-->
<link rel="stylesheet" href="{pigcms{$static_path}/css/shop_item.css">
<link rel="stylesheet" href="{pigcms{$static_path}/css/shop_staff.css">
<style>
	.pigcms-container{background: none;padding: 0;}
	.form_tips{color:red;}
	.radio{margin: 0 3%;padding: 5px 0; width: 92%;line-height: 20px!important;background-color: #FFF;}
	.pigcms-textarea{margin-bottom:10px;}
	.pigcms-form-title{
	margin-top: 3%;
	margin-bottom:2%;
	margin-left:2%;
	margin-right:0;
	padding: 0 4%!important;
	width:20%;
	font-size: 13px;
	float:left;
}
</style>
<body>
		<header class="pigcms-header mm-slideout">
			<a href="javascript:history.go(-1);" id="pigcms-header-left"><i class="iconfont icon-left"></i></a>
			<p id="pigcms-header-title">添加套餐设置</p>
		</header>
	<div class="container container-fill" style='padding-top:50px'>

		<form class="pigcms-form" method="post" enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Index/mpackageadd')}">
			<div class="pigcms-container">
				<p class='pigcms-form-title'>套餐标示<br/>名称：</p>
				<input type="text" class="pigcms-input-block" name="title" id="title" placeholder="填上套餐标示名称" value="{pigcms{$mpackage['title']}">
				<div style="clear:both"></div>
			</div>
			<div class="pigcms-container">
				<p class='pigcms-form-title'>简短描述：</p>
				<textarea  id="description" name="description"  placeholder="写上一些此套餐的简短描述" rows="5" class="pigcms-textarea">{pigcms{$mpackage['description']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
				<div style="clear:both"></div>
			</div>
		
			<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" value="添加">添加</button>
		</form>
		
	
		</div>

</body>
	<include file="Public:footer"/>
</html>