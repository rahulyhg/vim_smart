<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加试题
                </h1>
            </div>
        </div>
        <div class="row">
            <form action="{pigcms{:U('Exam/question_save_news')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加试题</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">所属题库
                                        <span class="required">*</span>
                                    </label>
                                    <select name="subject_id" id="pid">
                                        <option selected="selected" value="0">请选择所属题库</option>
                                        <volist name="subjectArr" id="vo" >
                                            <option  value="{pigcms{$vo.id}">{pigcms{$vo.subject_name}</option>
                                        </volist>

                                    </select>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">题型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="type" id="select_session">
                                            <option selected="selected" value="0">请选择题型</option>
                                            <option  value="1">单选题</option>
                                            <option  value="2">多选题</option>
                                            <option  value="3">主观题</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">难度
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="difficulty" id="pid">
                                            <option selected="selected" value="0">请选择难度</option>
                                            <option  value="1">低</option>
                                            <option  value="2">中</option>
                                            <option  value="3">高</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">题目
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="question" id="cat_url" required />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="ccccc" style="display: none;">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案A
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q1" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案B
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q2" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案C
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q3" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案D
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q4" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案E
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q5" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">备选答案F
                                            <span class="required"></span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="q6" id="cat_url"/>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="ddddd" style="display: none;">
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label" for="form_control_1">正确答案
                                                <span class="required"></span>
                                            </label>
                                            <input type="radio" name="answer_1" value="A" id="A"><label for="A">A</label>&nbsp;&nbsp;
                                            <input type="radio" name="answer_1" value="B" id="B"><label for="B">B</label>&nbsp;&nbsp;
                                            <input type="radio" name="answer_1" value="C" id="C"><label for="C">C</label>&nbsp;&nbsp;
                                            <input type="radio" name="answer_1" value="D" id="D"><label for="D">D</label>&nbsp;&nbsp;
                                            <input type="radio" name="answer_1" value="E" id="E"><label for="E">E</label>&nbsp;&nbsp;
                                            <input type="radio" name="answer_1" value="F" id="F"><label for="F">F</label>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="eeeee" style="display: none;">
                                        <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">正确答案
                                                    <span class="required"></span>
                                                </label>
                                                <input type="checkbox" name="answer_2[]" value="A" id="A_2"><label for="A_2">A</label>&nbsp;&nbsp;
                                                <input type="checkbox" name="answer_2[]" value="B" id="B_2"><label for="B_2">B</label>&nbsp;&nbsp;
                                                <input type="checkbox" name="answer_2[]" value="C" id="C_2"><label for="C_2">C</label>&nbsp;&nbsp;
                                                <input type="checkbox" name="answer_2[]" value="D" id="D_2"><label for="D_2">D</label>&nbsp;&nbsp;
                                                <input type="checkbox" name="answer_2[]" value="E" id="E_2"><label for="E_2">E</label>&nbsp;&nbsp;
                                                <input type="checkbox" name="answer_2[]" value="F" id="F_2"><label for="F_2">F</label>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green">确认添加</button>
                                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Exam&a=question_news'">返 回</button>
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
    $("select#select_session").change(function(){
        var u = $(this).val();
        if (u == 1) {
            $(".ccccc").show();
            $(".ddddd").show();
            $(".eeeee").hide();
        } else if(u == 2) {
            $(".ccccc").show();
            $(".ddddd").hide();
            $(".eeeee").show();
        } else {
            $(".ccccc").hide();
            $(".ddddd").hide();
            $(".eeeee").hide();
        }
    });


</script>
</body>

</html>