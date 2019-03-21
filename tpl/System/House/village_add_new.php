<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>添加项目
				</h1>
			</div>
		</div>
		<!-- END PAGE HEAD-->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="#">项目管理</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>项目列表</span>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span class="active">添加项目</span>
			</li>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- BEGIN PAGE BASE CONTENT -->
		<div class="row">
			<form action="{pigcms{:U('House/village_add_new')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
				<div class="col-md-12" style="float: left">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet light portlet-fit portlet-form bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class=" icon-layers font-green"></i>
								<span class="caption-subject font-green sbold uppercase">添加项目</span>
							</div>
							<div class="actions">
								<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
									<i class="icon-cloud-upload"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
									<i class="icon-wrench"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
									<i class="icon-trash"></i>
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<!-- BEGIN FORM-->

							<div class="form-body">
								<div class="alert alert-danger display-hide">
									<button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
								<div class="alert alert-success display-hide">
									<button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="village_type" id="village_type" class="form-control">
                                            <option value="0" onclick="$('project_list').css('display','none')" checked="checked">写字楼</option>
                                            <option value="1" onclick="$('project_list').css('display','block')">小区</option>
                                            <option value="2" onclick="$('project_list').css('display','none')">政府机关单位</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目名称
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="village_name" id="cat_name"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
                                <div id="project_list" style="display: none;">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">小区期数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="小区内部分区，多个请点击右边按钮进行添加" name="object_name[]" />
                                    </div>
                                    <span class="btn green" onclick="add_object();">添加</span>
                                </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">泊位费
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="carspace_price" />
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目地址
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="village_address" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业公司名称
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_name" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业联系地址
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_address" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业联系电话
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_phone" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">社区后台管理帐号
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="account" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">社区后台管理密码
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="pwd" id="cat_url"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目简写
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="比如广发简写为（GF）" name="logogram" id="cat_url" required/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目所属部门/公司(非必选)
                                    </label>
                                    <div class="col-md-9">
                                        <select name="department_id" class="form-control">
                                            <option value="">请选择</option>
                                            <foreach name="department_list" item="item" >
                                                <option value="{pigcms{$item['id']}">{pigcms{$item['deptname']}</option>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">预算所属总公司(非必选)
                                    </label>
                                    <div class="col-md-9">
                                        <select name="group_id" class="form-control">
                                            <option value="">请选择</option>
                                            <foreach name="group_list" item="vo">
                                                <option value="{pigcms{$vo['group_id']}" <if condition="$now_village['group_id'] eq $vo['group_id']">selected=""selected</if> >{pigcms{$vo['group_name']}</option>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-2 col-md-9">
											<button type="submit" class="btn green">确认提交</button>
											<button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=village_news'">返 回</button>
										</div>
									</div>
								</div>
							</div>
							<!-- END FORM-->
						</div>
					</div>
				</div>

			</form>
		</div>

	</div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
	<div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
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
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
	//开启日历插件
	$(function(){
		$("#mybutton").click(function(){
			var tr="<tr name='add_tr'><th width='80'>其他参数</th><td> <input type='text' class='input fl' name='arguments[]' size='10' placeholder='参数'/> <input type='text' class='input fl' name='arguments_value[]' size='10' placeholder='参数值'/></td></tr>";
			$("*[name='add_tr']:last").after(tr);
		});
		$("#mybutton2").click(function(){
			var td_length = $("#form_sample_1 input").length;
			var pot = td_length-2;
			if(td_length>7){
				$("#table tr:eq("+pot+")").remove();
			}
		});
	});
	$('#datetimepicker').datetimepicker({
		lang:"ch",           //语言选择中文
		format:"Y-m-d H:i:s",      //格式化日期
		timepicker:false,    //关闭时间选项
		yearStart:2000,     //设置最小年份
		yearEnd:2050,        //设置最大年份
		todayButton:false    //关闭选择今天按钮
	});
	$('#datetimepicker2').datetimepicker({
		lang:"ch",           //语言选择中文
		format:"Y-m-d H:i:s",      //格式化日期
		timepicker:false,    //关闭时间选项
		yearStart:2000,     //设置最小年份
		yearEnd:2050,        //设置最大年份
		todayButton:false    //关闭选择今天按钮
	});
    $('#village_type').change(function(){
        var p1=$(this).children('option:selected').val();
        if(p1==1){
            $('#project_list').css('display','block');
        }else{
            $('#project_list').css('display','none');
        }
    });
    function add_object() {
        var use="<div class='form-group form-md-line-input'> <label class='col-md-2 control-label' for='form_control_1'> </label> <div class='col-md-6'> <input type='text' class='form-control' placeholder='' name='object_name[]' /> <div class='form-control-focus'></div> </div> </div>";
        $('#project_list').append(use);
    }
</script>
</body>

</html>