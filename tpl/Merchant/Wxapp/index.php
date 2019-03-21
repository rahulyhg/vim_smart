<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tasks"></i>&nbsp;营销活动
			</li>
			<li><a href="javascript:window.location.reload();">{pigcms{$accessName}</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<iframe src="{pigcms{$accessUrl}" style="width:100%;border:0;" id="accessUrl"></iframe>
</div>
<script type="text/javascript">
	var winHeight = $(window).height()-$('#navbar').height()-$('#breadcrumbs').height()-8;
	var LeftHeight = $('#sidebar .nav-list').height() + $('#sidebar-collapse').height()+30;
	$('#accessUrl').height(winHeight > LeftHeight ? winHeight : LeftHeight);
</script>
<include file="Public:footer"/>