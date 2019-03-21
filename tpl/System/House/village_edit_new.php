<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

	<div class="page-content">
		<!-- BEGIN PAGE HEAD-->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>修改项目信息
				</h1>
			</div>
		</div>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="#">项目管理</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>项目列表</span>
			</li>
			<li>
				<span class="active">修改项目信息</span>
			</li>
		</ul>
		<div class="row">
			<form action="{pigcms{:U('House/village_edit_new')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
				<input type="hidden" name="pigcms_id" value="{pigcms{$terrace_array.pigcms_id}"/>
				<div class="col-md-12" style="float: left">
					<div class="portlet light portlet-fit portlet-form bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class=" icon-layers font-green"></i>
								<span class="caption-subject font-green sbold uppercase">修改项目信息</span>
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
								<input type="hidden" name="village_id" value="{pigcms{$now_village.village_id}"/>
                                <input type="hidden" name="village_type" value="{pigcms{$now_village['village_type']}"/>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="village_type" id="village_type" class="form-control" readonly="readonly" disabled="disabled">
                                            <option value="0"  <if condition="$now_village['village_type'] eq 0">selected="selected"</if>>写字楼</option>
                                            <option value="1" <if condition="$now_village['village_type'] eq 1">selected="selected"</if>>小区</option>
                                            <option value="2" <if condition="$now_village['village_type'] eq 2">selected="selected"</if>>政府机关单位</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目名称
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="village_name" id="cat_url" value="{pigcms{$now_village.village_name}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
                                <if condition="$now_village['village_type'] eq 1">
                                    <div id="project_list">
                                    <volist name="project_list" id="data" key="k">
                                        <if condition="$k eq 1">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">小区期数
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="小区内部分区，多个请点击右边按钮进行添加" value="{pigcms{$data['desc']}" name="object_name[]" />
                                                </div>
                                                <span class="btn green" onclick="add_object();">添加</span>
                                            </div>
                                            <else/>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="" value="{pigcms{$data['desc']}" name="object_name[]" />
                                                </div>
                                            </div>
                                        </if>
                                    </volist>
                                        <if condition="empty($project_list)">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">小区期数
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="小区内部分区，多个请点击右边按钮进行添加" value="{pigcms{$data['desc']}" name="object_name[]" />
                                                </div>
                                                <span class="btn green" onclick="add_object();">添加</span>
                                            </div>
                                        </if>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">泊位费
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{pigcms{$project_list['0']['carspace_price']}" placeholder="" name="carspace_price" />
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </if>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目地址
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="village_address" id="cat_url" value="{pigcms{$now_village.village_address}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业公司名称
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_name" id="cat_url" value="{pigcms{$now_village.property_name}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业联系地址
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_address" id="cat_url" value="{pigcms{$now_village.property_address}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">物业联系电话
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="property_phone" id="cat_url" value="{pigcms{$now_village.property_phone}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目后台管理帐号
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="account" id="cat_url" value="{pigcms{$now_village.account}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">项目后台管理密码
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="" name="pwd" id="cat_url" value="{pigcms{$now_village.pwd}"/>
										<div class="form-control-focus"> </div>
									</div>
								</div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目简写
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="logogram" id="cat_url" value="{pigcms{$now_village.logogram}" required />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">社区楼层最大房间数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" min="1" step="1" class="form-control" placeholder="" name="maximum_room_number"  value="{pigcms{$now_village.maximum_room_number}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">入驻公司
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<botton class="button" style="margin-left: -2px;"><a href="/admin.php?g=System&c=House&a=company&village_id={pigcms{$now_village.village_id}" target="main">点击查看</a></botton>
										<div class="form-control-focus"> </div>
									</div>
								</div>
								<div class="form-group form-md-line-input">
									<label class="col-md-2 control-label" for="form_control_1">状态
										<span class="required">*</span>
									</label>
									<div class="col-md-9">
										<span class="cb-enable"><label class="cb-enable <if condition="$now_village['status'] eq 1 || $now_village['status'] eq 0">selected</if>"><span>正常</span><input type="radio" name="status" value="<if condition="$now_village['status'] eq 0">0<else/>1</if>" <if condition="$now_village['status'] eq 1 || $now_village['status'] eq 0">checked="checked"</if>/></label></span>
										<span class="cb-disable"><label class="cb-disable <if condition="$now_village['status'] eq 2">selected</if>"><span>禁止</span><input type="radio" name="status" value="2" <if condition="$now_village['status'] eq 2">checked="checked"</if>/></label></span>
									</div>
								</div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目所属部门/公司(非必选)
                                    </label>
                                    <div class="col-md-9">
                                        <select name="department_id" class="form-control">
                                            <option value="">请选择</option>
                                            <foreach name="department_list" item="item" >
                                                <if condition="$item['id'] eq $now_village['department_id'] ">
                                                    <option value="{pigcms{$item['id']}" selected="selected">{pigcms{$item['deptname']}</option>
                                                    <else/>
                                                    <option value="{pigcms{$item['id']}">{pigcms{$item['deptname']}</option>
                                                </if>
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
                                            <!--<option value="1" <if condition="$now_village['group_id'] eq 1">selected=""selected</if> >汇得行</option>
                                            <option value="2" <if condition="$now_village['group_id'] eq 2">selected=""selected</if>>靓江物业</option>-->
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
					<!-- END VALIDATION STATES-->
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
			var tr="<div class='form-group form-md-line-input' name='add_tr'><label class='col-md-3 control-label' for='form_control_1'>其他参数<span class='required'>*</span></label><div class='col-md-9'><input type='text' class='form-control' placeholder='' name='arguments[]'/><input type='text' class='form-control' placeholder='' name='arguments_value[]'/><div class='form-control-focus'></div></div></div>";
			$("div[name='add_tr']:last").after(tr);
		});
		$("#mybutton2").click(function(){
			var td_length = $("div[name='add_tr']").length;
			//alert(td_length);
			var pot = td_length-1;
			var last =td_length;
			if(td_length>1){
				$("div[name='add_tr']:last").remove();
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
    function add_object() {
        var use="<div class='form-group form-md-line-input'> <label class='col-md-2 control-label' for='form_control_1'> </label> <div class='col-md-6'> <input type='text' class='form-control' placeholder='' name='object_name[]' /> <div class='form-control-focus'></div> </div> </div>";
        $('#project_list').append(use);
    }
</script>
</body>

</html>