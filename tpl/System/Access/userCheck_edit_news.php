<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>审核用户资料信息
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
                <span>认证用户</span>
				<i class="fa fa-circle"></i>
            </li>
			<li>
                <span class="active">审核用户资料信息</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="{pigcms{:U('Access/userCheck_edit_news')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="pigcms_id" value="{pigcms{$userCheck_info['pigcms_id']}"/>
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">审核用户资料信息</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">微信名
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="nickname" value="{pigcms{$userCheck_info['nickname']}" readonly="readonly"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">微信名必填</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">真实姓名
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$userCheck_info['name']}" readonly="readonly"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">真实姓名必填</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">公司名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="company_name" value="{pigcms{$userCheck_info['company_name']}" readonly="readonly"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">公司名称必填</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">证件类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <if condition="$userCheck_info.card_type eq 1">
                                        <input type="text" class="form-control" placeholder="" value="现场审核" readonly="readonly"/>
                                        </if>
                                        <if condition="$userCheck_info.card_type eq 2">
                                            <input type="text" class="form-control" placeholder="" value="门禁卡" readonly="readonly"/>
                                        </if>
                                        <if condition="$userCheck_info.card_type eq 3">
                                            <input type="text" class="form-control" placeholder="" value="身份证" readonly="readonly"/>
                                        </if>
                                        <if condition="$userCheck_info.card_type eq 4">
                                            <input type="text" class="form-control" placeholder="" value="工作牌" readonly="readonly"/>
                                        </if>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <if condition="$userCheck_info.card_type neq 1 and $userCheck_info.card_type neq 4 ">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">证件号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="usernum" value="{pigcms{$userCheck_info['usernum']}" readonly="readonly"/>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">公司名称必填</span>
                                    </div>
                                </div>
                                </if>
                                <if condition="$userCheck_info.card_type neq 1">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">证件照
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <php> $workcard_img=explode('|',$userCheck_info['workcard_img'])</php>
                                            <volist name="workcard_img" id="img" key="k">
                                                <img alt="" src="/upload/house/{pigcms{$img}" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
                                                <!--<img alt="" src="./upload/house/{pigcms{$userCheck_info.workcard_img}"  class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>-->
                                            </volist>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </if>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">审核结果
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 1">checked="checked"</if> />&nbsp;&nbsp;审核中</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label><input value="2" name="ac_status" type="radio"  onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 2 || $userCheck_info['ac_status'] eq 4">checked="checked"</if> />&nbsp;&nbsp;通过</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <if condition="$userCheck_info['ac_status'] eq 3"> checked="checked" </if> />&nbsp;&nbsp;未通过</label>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">公司名称必填</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">审核人
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="check_name" value="{pigcms{$userCheck_info['check_name']}" readonly="readonly"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">描述：
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea tips="一般不超过200个字符！" validate="" id="ag_desc" name="ac_desc" style="width:250px;height:90px;">{pigcms{$userCheck_info['ac_desc']}</textarea>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Access&a=userCheck_index_news'">返 回</button>
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
        var index_terrace = $("#terrace_name").find("option:selected").text();

        if(index_terrace == 'Yeelink'){

            $("*[name='yeelink']").show();
        }else if(index_terrace == '友联unios'){

            $("*[name='unios']").show();
        }
        $("#terrace_name").change(function(){
            var terrace_name = $(this).find("option:selected").text();
            alert(terrace_name);
            if(terrace_name == 'Yeelink'){
                $("*[name='unios']").hide();
                $("*[name='yeelink']").hide();
                $("*[name='yeelink']").show();
            }else if(terrace_name == '友联unios'){
                $("*[name='unios']").hide();
                $("*[name='yeelink']").hide();
                $("*[name='unios']").show();
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

</script>
</body>

</html>