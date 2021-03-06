<layout name="layout"/>
<style type="text/css">
<!--
.form .form-actions, .portlet-form .form-actions {
    padding: 20px;
    margin: 0;
    background-color: #ffffff;
    border-top: 1px solid #e7ecf1;
}
-->
</style>
<!--引入日历插件样式 -->
<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>更新分类
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('Off/off_zone_news')}">区域管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">更新区域</span>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('Off/off_zone_update')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{pigcms{$_GET['id']}"/>
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">更新分类</span>
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
                                <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">父级分类
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="pid"  required>
                                            <option value="0" <if condition="$tArr['pid'] eq 0">selected</if>>顶级分类</option>
                                            <foreach name="typeArr" item="vo">
                                                <option value="{pigcms{$vo.id}" <if condition="$tArr['pid'] eq $vo['id']">selected</if>>{pigcms{$vo.zone_name}</option>
                                                <if condition="isset($vo['son'])">
                                                    <foreach name="vo['son']" item="v">
                                                        <option value="{pigcms{$v.id}" <if condition="$tArr['pid'] eq $v['id']">selected</if> >|--{pigcms{$v.zone_name}</option>
<!--                                                        <if condition="isset($v['g_son'])">-->
<!--                                                            <foreach name="v['g_son']" item="sv">-->
<!--                                                                <option value="{pigcms{$sv.id}" <if condition="$tArr['pid'] eq $sv['id']">selected</if> >|--|--{pigcms{$sv.zone_name}</option>-->
<!--                                                            </foreach>-->
<!--                                                        </if>-->
                                                    </foreach>
                                                </if>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">分类名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="zone_name"  size="20" validate="maxlength:30,required:true" value="{pigcms{$tArr.zone_name}" required />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="id"   value="{pigcms{$tArr.id}" style="display: none;" />
                            </div>
                        </div>
					<div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Off&a=off_zone_news'">返 回</button>
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
    <div class="page-footer-inner" style="width: 100%"> 2018 &copy; 汇得行智慧助手系统
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->


</body>

</html>