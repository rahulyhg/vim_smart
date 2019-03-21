<layout name="layout"/>
<!--引入日历插件样式 -->

<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>个人资料
                    <!--<small>用户的任何消费都会被记录在此 </small>-->
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">后台首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">智慧助手</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">个人资料</span>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('Index/amend_profile_new')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="pigcms_id" value="{pigcms{$terrace_array.pigcms_id}"/>

                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="http://www.hdhsmart.com/upload/cardfocus/headimage/<php>echo date('Y').'/'.$admin['headimgurl'];</php>" class="img-responsive" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {pigcms{$admin.account} </div>
                                <div class="profile-usertitle-job"> {pigcms{$admin.realname} </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('upload_head_img')}" class="btn btn-circle green btn-sm">上传图片</a>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li class="active">
                                        <a href="{pigcms{:U('Index/index_new')}">
                                            <i class="icon-home"></i> 系统主页 </a>
                                    </li>
                                    <li>
                                        <a href="{pigcms{:U('Index/edit_admin_info')}" data-toggle="modal" data-target="#one_modal">
                                            <i class="icon-settings"></i> 修改资料 </a>
                                    </li>
                                    <li>
                                        <a href="{pigcms{:U('Index/lock_system')}">
                                            <i class="icon-info"></i> 锁屏 </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                        <!-- PORTLET MAIN -->
                        <div class="portlet light bordered">
                            <!-- STAT -->
                            <div class="row list-separated profile-stat">
                                <div class="col-md-6 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {pigcms{$admin.login_count} </div>
                                    <div class="uppercase profile-stat-text"> 登录次数 </div>
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {pigcms{$admin.level} </div>
                                    <div class="uppercase profile-stat-text"> 等级 </div>
                                </div>
                            </div>
                            <!-- END STAT -->
                            <div>
                                <h4 class="profile-desc-title"><!--{pigcms{$admin.role_name}--></h4>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-qq"></i>
                                    <a href="javascript:;">{pigcms{$admin.qq}</a>
                                </div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-envelope"></i>
                                    <a href="javascript:;">{pigcms{$admin.email}</a>
                                </div>
                                <div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-mobile-phone"></i>
                                    <a href="javascript:;">{pigcms{$admin.phone}</a>
                                </div>
								<div class="margin-top-20 profile-desc-link">
                                    <i class="fa fa-clock-o"></i>
                                    <a href="javascript:;">2018-10-22 12：21：22</a>
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR 1-->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">事项提醒</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> 系统警告 </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> 事项流程提醒 </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <if condition="$Think.session.system.account eq 'admin'">
                                                    <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <ul class="feeds">
                                                        <foreach name="warningList['list']" item="vo">
                                                            <li>
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-warning">
                                                                                <i class="fa fa-warning"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> {pigcms{$vo.warning_name}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> {pigcms{$vo.timediffer} </div>
                                                                </div>
                                                            </li>
                                                        </foreach>
                                                    </ul>
                                                </div>
                                                <else/>
                                                    无提醒事项
                                                </if>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <ul class="feeds">
                                                        <foreach name="list['list']" item="sv">
                                                            <li>
                                                                <a href="{pigcms{$sv.url}">
                                                                    <div class="col1">
                                                                        <div class="cont">
                                                                            <div class="cont-col1">
                                                                                <div class="label label-sm label-warning">
                                                                                    <i class="fa fa-bell-o"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cont-col2">
                                                                                <div class="desc"> {pigcms{$sv.content} </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col2">
                                                                        <div class="date"> {pigcms{$sv.timediffer} </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </foreach>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                        </div>

                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!--弹出层-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="one_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
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

</script>
</body>

</html>