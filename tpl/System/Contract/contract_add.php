<layout name="layout"/>
<!--引入日历插件样式 -->
<style>
    .BMap_cpyCtrl{display:none;}
    input.ke-input-text {
        background-color: #FFFFFF;
        background-color: #FFFFFF!important;
        font-family: "sans serif",tahoma,verdana,helvetica;
        font-size: 12px;
        line-height: 24px;
        height: 24px;
        padding: 2px 4px;
        border-color: #848484 #E0E0E0 #E0E0E0 #848484;
        border-style: solid;
        border-width: 1px;
        display: -moz-inline-stack;
        display: inline-block;
        vertical-align: middle;
        zoom: 1;
    }
    .col-sm-1{width: 12%}
    .form-group>label{font-size:12px;line-height:24px;}
    #upload_pic_box{margin-top:20px;height:150px;}
    #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
    #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    .input-large {
        width: 600px!important;
    }
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>新增合同
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">物业服务</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>合同管理</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">新增合同</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="{pigcms{:U('Contract/contract_add')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">新增合同</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">合同名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="contract_name" id="contract_name"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">合同编号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="contract_number" id="contract_number"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">所属项目
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="village_id" id="village_id" required>
                                            <option value="0">请选择</option>
                                            <!-- <option value="1">全项目</option> -->
                                            <volist name="village_array" id="v">                                                
                                                <option value="{pigcms{$v.village_id}">{pigcms{$v.village_name}</option>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">甲方
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="first_party" id="first_party"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">乙方
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="second_party" id="second_party"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">丙方
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="third_party" id="third_party"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">签订日期
                                        <span class="required">*</span>
                                    </label>
                                    <!-- <div class="col-md-9">
                                        <input type="date" class="form-control" placeholder="" name="contract_start" id="contract_start"/>
                                        <div class="form-control-focus"> </div>
                                    </div> -->
                                    <div class="input-group input-large date-picker input-daterange">
                                        <input type="text" class="form-control" name="contract_start" id="contract_start" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>" onchange="" style="width: 140px;"> 
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">截止日期
                                        <span class="required">*</span>
                                    </label>
                                    <!-- <div class="col-md-9">
                                        <input type="date" class="form-control" placeholder="" name="contract_end" id="contract_end"/>
                                        <div class="form-control-focus"> </div>
                                    </div> -->
                                    <div class="input-group input-large date-picker input-daterange">
                                        <input type="text" class="form-control" name="contract_end" id="contract_end" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>" onchange="" style="width: 140px;"> 
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">备注
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="contract_time" id="contract_time"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目金额
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="money" id="money"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">项目面积
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="area" id="area"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">经办人
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="operator" id="operator"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">合同时长
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <span class="cb-enable"><label class="cb-enable"><span>长期合同</span><input type="radio" name="duration" value="1" checked="checked" /></label></span>

                                        <span class="cb-disable"><label class="cb-disable"><span>短期合同</span><input type="radio" name="duration" value="0"/></label></span>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div> -->
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">合同分类
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <span class="cb-enable"><label class="cb-enable"><span>收入</span><input type="radio" name="classify" value="1"/></label></span>

                                        <span class="cb-disable"><label class="cb-disable"><span>支出</span><input type="radio" name="classify" value="2"/></label></span>

                                        <span class="cb-disable"><label class="cb-disable"><span>其他</span><input type="radio" name="classify" value="3"/></label></span>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">合同状态
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <span class="cb-enable"><label class="cb-enable"><span>正常合同</span><input type="radio" name="status" value="1" checked="checked" /></label></span>

                                        <span class="cb-disable"><label class="cb-disable"><span>终止合同</span><input type="radio" name="status" value="0"/></label></span>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div> -->

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">关联合同
                                        <span class="required">*</span>
                                    </label>
                                    <!-- <div class="col-md-9">
                                        <input type="date" class="form-control" placeholder="" name="contract_end" id="contract_end"/>
                                        <div class="form-control-focus"> </div>
                                    </div> -->
                                    <div class="input-group input-large date-picker input-daterange">
                                        <select class="form-control select2" name="relevance_contract_id" id="relevance_contract_id" required>
                                            <option value="0">请选择</option>
                                            <!-- <option value="1">全项目</option> -->
                                            <volist name="contract_array" id="v">                                               
                                                <option value="{pigcms{$v.id}">{pigcms{$v.contract_name}</option>
                                            </volist>
                                        </select> 
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">合同文件
                                        <span class="required">*</span>
                                    </label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传文件</a>
                                    <span class="form_tips">（支持上传图片，word文档，pdf，Excel格式！）</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">文件预览
                                        <span class="required">*</span>
                                    </label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul">
                                            <volist name="now_merchant['pic']" id="vo">
                                                <li class="upload_pic_li"><img src="{pigcms{$vo.url}"/><input type="hidden" name="pic[]" value="{pigcms{$vo.title}"/><br/><a href="#" onclick="deleteImage('{pigcms{$vo.title}',this);return false;">[ 删除 ]</a></li>
                                            </volist>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='{pigcms{:U('Contract/contract_news')}'">返 回</button>
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
<script src="/Car/Admin/Public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type='text/javascript'>
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager: true
        });
        K('#J_selectImage').click(function () {
            if ($('.upload_pic_li').size() >= 10) {
                alert('最多上传10个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Contract/store_ajax_upload_pic')}";
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
        $.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
        $(obj).closest('.upload_pic_li').remove();
    };

    $.datetimepicker.setLocale('ch');
    $('#contract_start').datetimepicker({
        format: 'Y-m-d',
        lang:"zh",
        timepicker:false
    });
    $('#contract_end').datetimepicker({
        format: 'Y-m-d',
        lang:"zh",
        timepicker:false
    });
</script>
</body>

</html>