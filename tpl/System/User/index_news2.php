<layout name="layout"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/datatables.bootstrap.css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/sweetalert.css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/font-awesome.min.css" />

<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Car/Admin/Public/assets/global/plugins/datatables/sweetalert/components.min.css" id="style_components" rel="stylesheet" type="text/css" />-->

<!-- END PAGE LEVEL PLUGINS -->


<style type="text/css">
.label-kid {
    background-color: #f36a5a;
}
.btn-group>.dropdown-menu, .dropdown-toggle>.dropdown-menu, .dropdown>.dropdown-menu {
    margin-top: 10px;
}
.width {width:100%;}
.left {width:20%; float:left;}
.right {width:80%; float:left; border-left:1px #eef1f5 solid; box-sizing: border-box;}
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>用户列表
					<small>所有用户都在这里 </small>
				</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<!--<div class="page-toolbar">-->
			<!--&lt;!&ndash; BEGIN THEME PANEL &ndash;&gt;-->
			<!--<div class="btn-group btn-theme-panel">-->
			<!--<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">-->
			<!--<i class="icon-settings"></i>-->
			<!--</a>-->
			<!--<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">-->
			<!--<div class="row">-->
			<!--<div class="col-md-4 col-sm-4 col-xs-12">-->
			<!--<h3>HEADER</h3>-->
			<!--<ul class="theme-colors">-->
			<!--<li class="theme-color theme-color-default active" data-theme="default">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Dark Header</span>-->
			<!--</li>-->
			<!--<li class="theme-color theme-color-light " data-theme="light">-->
			<!--<span class="theme-color-view"></span>-->
			<!--<span class="theme-color-name">Light Header</span>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--<div class="col-md-8 col-sm-8 col-xs-12 seperator">-->
			<!--<h3>LAYOUT</h3>-->
			<!--<ul class="theme-settings">-->
			<!--<li> Theme Style-->
			<!--<select class="layout-style-option form-control input-small input-sm">-->
			<!--<option value="square">Square corners</option>-->
			<!--<option value="rounded" selected="selected">Rounded corners</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Layout-->
			<!--<select class="layout-option form-control input-small input-sm">-->
			<!--<option value="fluid" selected="selected">Fluid</option>-->
			<!--<option value="boxed">Boxed</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Header-->
			<!--<select class="page-header-option form-control input-small input-sm">-->
			<!--<option value="fixed" selected="selected">Fixed</option>-->
			<!--<option value="default">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Top Dropdowns-->
			<!--<select class="page-header-top-dropdown-style-option form-control input-small input-sm">-->
			<!--<option value="light">Light</option>-->
			<!--<option value="dark" selected="selected">Dark</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Mode-->
			<!--<select class="sidebar-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Menu-->
			<!--<select class="sidebar-menu-option form-control input-small input-sm">-->
			<!--<option value="accordion" selected="selected">Accordion</option>-->
			<!--<option value="hover">Hover</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Sidebar Position-->
			<!--<select class="sidebar-pos-option form-control input-small input-sm">-->
			<!--<option value="left" selected="selected">Left</option>-->
			<!--<option value="right">Right</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--<li> Footer-->
			<!--<select class="page-footer-option form-control input-small input-sm">-->
			<!--<option value="fixed">Fixed</option>-->
			<!--<option value="default" selected="selected">Default</option>-->
			<!--</select>-->
			<!--</li>-->
			<!--</ul>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--</div>-->
			<!--&lt;!&ndash; END THEME PANEL &ndash;&gt;-->
			<!--</div>-->
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="#">用户管理</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">用户列表</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption font-dark">
							<i class="icon-settings font-dark"></i>
							<span class="caption-subject bold uppercase"> 在线考试</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm" onclick="window.location.href='__CONTROLLER__/recycle'">
									<input type="radio" name="options" class="toggle" id="option1">列 表</label>
								<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option2">回收站</label>
							</div>
						</div>
					</div>

					<div class="portlet-body">
						<div class="width">
							<div class="left">
								<div style="width:90%; margin:0px auto; padding-top:20px;">
									<div style="border-bottom:1px #eef1f5 solid;">
										<div style="width:100%; text-align:center; font-family:'微软雅黑'; font-size:16px; color:#333333; line-height:30px; font-weight:bold;">考试开始时间</div>
										<div style="width:100%; text-align:center; font-family:'微软雅黑'; font-size:16px; color:#f36a5a; line-height:30px; font-weight:bold;">2017-12-20 14:00:00</div>
										<div style="width:100%; height:40px; overflow:hidden;"></div>
										<div style="width:100%; text-align:center; font-family:'微软雅黑'; font-size:16px; color:#333333; line-height:30px; font-weight:bold;">考试介绍时间</div>
										<div style="width:100%; text-align:center; font-family:'微软雅黑'; font-size:16px; color:#f36a5a; line-height:30px; font-weight:bold;">2017-12-20 16:00:00</div>
										<div style="width:100%; height:15px; overflow:hidden;"></div>
									</div>
									<div style="width:100%; padding-top:25px;">
										<div style="width:100%; text-align:center; font-family:'微软雅黑'; font-size:16px; line-height:30px; font-weight:bold;"><span style="color:#000000;">离结束还有：</span><span style="color:#f36a5a;">100分钟</span></div>
										<div style="padding-top:20px; text-align:center;">
											<button class="btn sbold green">&nbsp;交 卷&nbsp;</button>
										</div>
									</div>
								</div>
							</div>
							<div class="right">
								<div style="width:95%; margin:0px auto; padding-top:20px;">
									<div style="width:100%; height:100px; overflow:hidden; border-bottom:1px #eef1f5 solid; text-align:center;">
										<div style="width:100%; height:40px; overflow:hidden; line-height:40px; font-family:'微软雅黑'; font-size:30px; font-weight:bold; color:#000000;">全国2008年7月高等教育自学考试</div>
										<div style="width:100%; height:50px; overflow:hidden; line-height:50px; font-family:'微软雅黑'; font-size:15px; font-weight:bold; color:#000000;">总分：<span style="color:#f36a5a;">100</span>分&nbsp;&nbsp;及格分数线：<span style="color:#f36a5a;">60</span>分&nbsp;&nbsp;考试时间：<span style="color:#f36a5a;">120</span>分钟</div>
									</div>
									<div style="width:100%; padding-top:20px;">
										<div style="width:100%; height:40px; line-height:40px; font-size:20px; font-family:'微软雅黑'; color:#666666; font-weight:bold;">一、单选题</div>
										<div style="width:100%;">
											<div style="width:100%; border-bottom:1px #eef1f5 solid;  padding-top:25px;">
												<div style="width:100%; height:40px; overflow:hidden; font-family:'微软雅黑'; font-size:18px; font-weight:bold; color:#333333; font-weight:bold;">1. 1978年我国开展了真理标准问题大讨论，提出检验真理的唯一标准是（）</div>
												<div style="width:100%; padding-top:10px; padding-bottom:10px;">
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">发展</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">改革</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">开放</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">创新</div>
														<div style="clear:both"></div>
													</div>
													<div style="clear:both"></div>
												</div>
											</div>
											<div style="width:100%; border-bottom:1px #eef1f5 solid;  padding-top:25px;">
												<div style="width:100%; height:40px; overflow:hidden; font-family:'微软雅黑'; font-size:18px; font-weight:bold; color:#333333; font-weight:bold;">2. 改革开放后，我国农村集体所有制经济普遍采用的经营体制是（）</div>
												<div style="width:100%; padding-top:10px; padding-bottom:10px;">
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">三级所有，队为基础</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">政社合一</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">以家庭承包经营为基础，统分结合</div>
														<div style="clear:both"></div>
													</div>
													<div style="width:50%; float:left; height:50px; line-height:50px; font-family:'微软雅黑'; font-size:14px; font-weight:bold; color:#000000;">
													    <div style="float:left; line-height:30px;"><input type="radio" name="radiobutton" value="radiobutton" style="background-color:#FFFFFF; width:20px; height:20px; border:2px #bebebe solid;"/></div>
														<div style="float:left; line-height:30px; margin-left:15px;">以集体统一经营为基础，统分结合</div>
														<div style="clear:both"></div>
													</div>
													<div style="clear:both"></div>
												</div>
											</div>
										</div>
									</div>
									<div style="width:100%; padding-top:20px;">
										<div style="width:100%; height:40px; line-height:40px; font-size:20px; font-family:'微软雅黑'; color:#666666; font-weight:bold;">二、简答题</div>
										<div style="width:100%;">
											<div style="width:100%; border-bottom:1px #eef1f5 solid;  padding-top:25px;">
												<div style="width:100%; height:40px; overflow:hidden; font-family:'微软雅黑'; font-size:18px; font-weight:bold; color:#333333; font-weight:bold;">1. 解放思想、实事求是的辩证关系怎样？</div>
												<div style="width:100%; padding-top:10px; padding-bottom:30px;"><textarea name="textarea" style="width:95%; height:150px; overflow:hidden; border:1px #eef1f5 solid;"></textarea>
												</div>
											</div>
											
										</div>
									</div>
									<div style="margin:0px auto; text-align:center; padding-top:30px; padding-bottom:15px;">
									<ul class="pagination"><li class="active"><a>1</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=2" title="第2页" class="pga">2</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=3" title="第3页" class="pga">3</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=4" title="第4页" class="pga">4</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=5" title="第5页" class="pga">5</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=1018" title="第1018页">1018</a></li><li><a href="/admin.php?g=System&amp;c=Car&amp;a=car_pay_record_news&amp;page=2" class="next">&gt;&gt;</a></li></ul>
									</div>
								</div>
							</div>
							<div style="clear:both"></div>
						</div>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>

	</div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2017 &copy; 汇得行智慧助手系统
		<a target="_blank" href="http://www.vhi99.com">邻钱科技</a> &nbsp;|&nbsp;
		<a href="http://www.metronic.com" target="_blank">Metronic</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!--<nav class="quick-nav">-->
<!--<a class="quick-nav-trigger" href="#0">-->
<!--<span aria-hidden="true"></span>-->
<!--</a>-->
<!--<ul>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">-->
<!--<span>Purchase Metronic</span>-->
<!--<i class="icon-basket"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">-->
<!--<span>Customer Reviews</span>-->
<!--<i class="icon-users"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/showcast/" target="_blank">-->
<!--<span>Showcase</span>-->
<!--<i class="icon-user"></i>-->
<!--</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">-->
<!--<span>Changelog</span>-->
<!--<i class="icon-graph"></i>-->
<!--</a>-->
<!--</li>-->
<!--</ul>-->
<!--<span aria-hidden="true" class="quick-nav-bg"></span>-->
<!--</nav>-->
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--插入layer弹层js开始-->
<script src="/Car/Admin/Public/js/layer.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>

<script type="text/javascript" src="{pigcms{$static_path}js/sweetalert.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/ui-sweetalert.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/layer.js"></script>

<!--插入layer弹层js结束-->
<!--<script>-->
<!--    $(function () {-->
<!--        $("#update").click(function () {-->
<!--            swal({-->
<!--                    title: "您可能需要等待几秒",-->
<!--                    text: "本次更新10条记录",-->
<!--                    type: "info",-->
<!--                    showCancelButton: true,-->
<!--                    closeOnConfirm: false,-->
<!--                    showLoaderOnConfirm: true,-->
<!--                },-->
<!--                function(){-->
<!--                    $.ajax({-->
<!--                        url:"{pigcms{:U('User/update_info')}",-->
<!--                        type:'post',-->
<!--                        dataType:'json',-->
<!--                        success:function (res) {-->
<!--                            if(res.error==0){-->
<!--                                swal("更新成功！");-->
<!--                                window.location.reload();-->
<!--                            }else{-->
<!--                                swal(res.msg);-->
<!--                            }-->
<!--                        },-->
<!--                        error:function () {-->
<!--                            swal("更新失败！");-->
<!--                        }-->
<!--                    })-->
<!--                });-->
<!--//            $.ajax({-->
<!--//                url:"{pigcms{:U('User/update_info')}",-->
<!--//                type:'post',-->
<!--//                dataType:'json',-->
<!--//                success:function (res) {-->
<!--//                    if(res.error==0){-->
<!--//                        alert('2');-->
<!--//                        //swal("更新成功！");-->
<!--//                        //window.location.reload();-->
<!--//                    }-->
<!--//                },-->
<!--//                error:function () {-->
<!--//                    //swal("更新失败！");-->
<!--//                }-->
<!--//            })-->
<!---->
<!--        })-->
<!--    })-->
<!--</script>-->
<script>
	$(function(){
		$("[name='change_state']").click(function(){

			var pigcms_id = $(this).siblings(":first").text();
			var is_use = $(this).text();
			$.ajax({
				url: "{pigcms{:U('Hickey/change_state')}",
				type: "GET",
				data: {'pigcms_id': pigcms_id,'is_use':is_use},
				success: function (res) {
					if(res == 1){
						location.reload()
					}else if(res ==2){
						location.reload()
					}else{
						alert('改变失败');
					}
				}
			});
		});
	});

</script>

<!--自定义js代码区开始-->
<script type="text/javascript">
	//获取将要删除的记录对应的id
	function pass_user_info(obj){
		layer.msg('你确定要通过审核吗？', {
			time: 0 //不自动关闭
			,btn: ['确定', '取消']
			,yes: function(index){
				layer.close(index);
				var check_id=$(obj).attr('id');
				//通过ajax异步删除
				$.ajax({
					url:"{:U('change_user_state')}",
					data:{'check_id':check_id},
					type:'get',
					success:function(delmsg){
						if(delmsg==='1'){
							//逻辑删除成功！
							layer.msg('提交信息成功！', {icon: 6});
							//同时刷新页面
							window.location.reload();
						}else{
							//逻辑删除失败！
							layer.msg('提交信息失败！错误编码'+delmsg, {icon: 5});
						}
					}

				});
			}
		});

	}






	//表格显示控制js代码区
	var table = $('#sample_1');

	// begin first table
	table.dataTable({

		// Internationalisation. For more info refer to http://datatables.net/manual/i18n
		"language": {
			"aria": {
				"sortAscending": ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			},
			"emptyTable": "No data available in table",
			"info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
			"infoEmpty": "No records found",
			"infoFiltered": "(filtered1 from _MAX_ total records)",
			"lengthMenu": "每页显示条数 _MENU_",
			"search": "搜索:",
			"zeroRecords": "No matching records found",
			"paginate": {
				"previous":"Prev",
				"next": "Next",
				"last": "Last",
				"first": "First"
			}
		},

		// Or you can use remote translation file
		//"language": {
		//   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
		//},

		// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
		// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
		// So when dropdowns used the scrollable div should be removed.
		//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

		"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

		"lengthMenu": [
			[5, 15, 20, -1],
			[5, 15, 20, "全部"] // change per page values here
		],
		// set the initial value
		"pageLength": 10,
		"pagingType": "bootstrap_full_number",
		"columnDefs": [
			{  // set default column settings
				'orderable': false,
				'targets': [0]
			},
			{
				"searchable": false,
				"targets": [0]
			},
			{
				"className": "dt-right",
				//"targets": [2]
			}
		],
		"order": [
			[1, "desc"]
		] // set first column as a default sort by asc
	});

	var tableWrapper = jQuery('#sample_1_wrapper');

	table.find('.group-checkable').change(function () {
		var set = jQuery(this).attr("data-set");
		var checked = jQuery(this).is(":checked");
		jQuery(set).each(function () {
			if (checked) {
				$(this).prop("checked", true);
				$(this).parents('tr').addClass("active");
			} else {
				$(this).prop("checked", false);
				$(this).parents('tr').removeClass("active");
			}
		});
	});

	table.on('change', 'tbody tr .checkboxes', function () {
		$(this).parents('tr').toggleClass("active");
	});

</script>

<!--自定义js代码区结束-->
</body>

</html>