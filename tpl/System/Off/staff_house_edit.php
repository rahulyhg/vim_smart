<layout name="layout"/>
<!--引入日历插件样式 -->
<!-- BEGIN CONTENT --><style type="text/css">
    <!--
    .form .form-actions, .portlet-form .form-actions {
        padding: 20px;
        margin: 0;
        background-color: #ffffff;
        border-top: 1px solid #e7ecf1;
    }
    #upload_pic_box{margin-top:20px;height:150px;}
    #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
    #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    .input-large {
        width: 600px!important;
    }
    -->
</style>

<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>更新宿舍
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active">固定资产</span>
            </li>

        </ul>
        <div class="row">
            <form action="{pigcms{:U('Off/staff_house_edit')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">更新宿舍</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">项目名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="vallage" id="sup_name" value="{pigcms{$staff['village_name']}" placeholder="请输入项目名称"  required readonly="readonly"/>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">位置/房间号
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="room" id="sup_name" value="{pigcms{$staff['room']}" placeholder="请输入房间号"  required readonly="readonly"/>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">剩余床位数
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="bed_number" id="phone" value="{pigcms{$staff['bed_number']}" placeholder="请输入床位数" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">部门
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="department" id="location" value="{pigcms{$staff['department']}" placeholder="请输入部门" required />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">备注

                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="comment" id="tax_rate" value="{pigcms{$staff['comment']}" placeholder="请输入备注" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>


                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="role_id">员工
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" name="name_id[]" id="business_scope" multiple="multiple">
                                    <volist name="staff_name" id="v">
                                        <option value="{pigcms{$v.id}" <if condition="in_array($v['id'],$staff['name_id'])">selected="selected"</if>>{pigcms{$v.name}</option>
                                    </volist>
                                </select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>



                        <div class="form-actions">
                            <div class="row">
                                <input type="hidden" name="staff_id" value="{pigcms{$staff['staff_id']}"/>
                                <input type="hidden" name="village_id" value="{pigcms{$staff['village_id']}"/>
                                <div class="col-md-offset-2 col-md-9">
                                    <button type="submit" class="btn green">确认提交</button>
                                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Off&a=supplier_list_news'">返 回</button>
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
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>

<script>
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager: true
        });
        K('#J_selectImage').click(function () {
            if ($('.upload_pic_li').size() >= 10) {
                alert('最多上传10个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Off/store_ajax_upload_pic')}";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title,  width, height, border, align) {
                        var index=url.lastIndexOf("\.");
                        var str;
                        str = url.substring(index+1,url.length);

                        if (str == 'jpg' || str == 'jpng' || str == 'png') {
                            $('#upload_pic_ul').append("<li class=\"upload_pic_li\"><a href=\""+url+"\" target=\"_blank\">\n" +
                                "                            <img src=\""+url+"\" style=\"height: 120px;width: 90px;\" /></a>\n" +
                                "                            <input type=\"hidden\" name=\"pic[]\" value=\""+title+"\"/><br/>\n" +
                                "                            <a href=\"#\" onclick=\"deleteImage('"+title+"',this);return false;\">[ 删除 ]</a>\n" +
                                "                            </li>");
                        } else {
                            //$('#upload_pic_ul').append("<li class=\"upload_pic_li\"><a href=\""+url+"\" >附件下载</a><input type=\"hidden\" name=\"pic[]\" value=\"" + title + "\"/><br/><a href=\"#\" onclick=\"deleteImage('"+title+"',this);return false;\">[ 删除 ]</a></li>");
                            $('#upload_pic_ul').append("<li class=\"upload_pic_li\"><a href=\""+url+"\" >\n" +
                                "                            <img src=\"http://www.hdhsmart.com/upload/images/classify/20160416/moren.png\" style=\"height: 120px;width: 90px;\" /></a>\n" +
                                "                            <input type=\"hidden\" name=\"pic[]\" value=\""+title+"\"/><br/>\n" +
                                "                            <a href=\"#\" onclick=\"deleteImage('"+title+"',this);return false;\">[ 删除 ]</a>\n" +
                                "                            <a href=\""+url+"\">[ 下载 ]</a></li>");
                        }
                        editor.hideDialog();
                    }
                });
            });
        });
    });


    function deleteImage(path, obj) {
        $.post("{pigcms{:U('Off/store_ajax_del_pic')}",{path:path});
        $(obj).closest('.upload_pic_li').remove();
    };

    $.datetimepicker.setLocale('ch');
    $('#supplier_start').datetimepicker({
        format: 'Y-m-d',
        lang:"zh",
        timepicker:false
    });
    $('#supplier_end').datetimepicker({
        format: 'Y-m-d',
        lang:"zh",
        timepicker:false
    });
</script>
</body>

</html>