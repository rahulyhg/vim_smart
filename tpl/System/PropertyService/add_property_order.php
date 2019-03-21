<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Material Design Form Validation
                    <small>material design form validation</small>
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Form Stuff</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="uid" value="">
                <input type="hidden" name="bind_id" value="">
                <input type="hidden" name="company_id" value="">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Basic Validation</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">账单公司所属社区
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="village_id">
                                            <foreach name="village_array" item="vo">
                                                <option value="{pigcms{$vo.village_id}">{pigcms{$vo.village_name}</option>
                                            </foreach>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">公司名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="如查询无结果，请手动添加" name="company_name"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" style="display: none">
                                    <label class="col-md-2 control-label" for="form_control_1">公司所在楼层
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="多楼层写一个楼层号即可" name="floor"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" style="display: none;" id="name">
                                    <label class="col-md-2 control-label" for="form_control_1">公司负责人姓名
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="如查询无结果，请手动添加" name="name"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" style="display: none;" id="phone">
                                    <label class="col-md-2 control-label" for="form_control_1">联系手机号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="如查询无结果，请手动添加,联系手机号即为公司联系使用" name="phone"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" style="display: none;">
                                    <label class="col-md-2 control-label" for="form_control_1">身份证号码
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="如查询无结果，请手动添加" name="usernum"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" style="display: none;">
                                    <label class="col-md-2 control-label" for="form_control_1">所在地址
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="如查询无结果，请手动添加" name="address"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">账单月份
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="mdate" min="1" max="12"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">账单自然月用水（吨）
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="use_water" min="0" />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">账单自然月用电（度）
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="use_electric" min="0" />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">账单自然月用气（立方）
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="use_gas" min="0"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">房屋面积（平米）
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="housesize" min="0"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default">清空重填</button>
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
        <a target="_blank" href="http://www.vhi99.com">微嗨科技</a> &nbsp;|&nbsp;
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
<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    //开启日历插件
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
<script type='text/javascript'>
    //开启自动完成
    $(function(){
        //清除缓存的时候打开！（定期清理）
        //$.autocompleter('clearCache');
        $("input[name='name']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true,
        });

        $("input[name='company_name']").autocompleter({
            source: "{pigcms{:U('company_to_autocomplete')}",
            autoFocus: true,
        });


        /*选择社区后，触发动作*/
        $("select[name='village_id']").change(function(){
            $("input[name='name']").parent().parent().slideDown(100);
            $("input[name='phone']").parent().parent().slideDown(100);
        });

        /*选择人名字以后，触发动作*/
        $("input[name='name']").change(function(){
            var name = $("input[name='name']").val();
            var village_id = $("select[name='village_id']").val();
            $.ajax({
                url:"{pigcms{:U('check_this_name')}",
                data:{'name':name,'village_id':village_id},
                type:'post',
                dataType:'json',
                success:function (res) {
                    if(res.error == 0){
                        $("input[name='usernum']").parent().parent().slideDown(100);
                        $("input[name='address']").parent().parent().slideDown(100);
                        $("input[name='phone']").val(res.phone);
                        $("input[name='uid']").val(res.uid);
                        $("input[name='usernum']").val(res.usernum);
                        $("input[name='bind_id']").val(res.bind_id);
                        $("input[name='address']").val(res.address);

                    }else{
                        $("input[name='usernum']").parent().parent().slideDown(100);
                        $("input[name='address']").parent().parent().slideDown(100);
                    }
                }
            });
        });

        /*选择公司名字以后，触发动作*/
        $("input[name='company_name']").change(function(){
            var company_name = $("input[name='company_name']").val();
            var village_id = $("select[name='village_id']").val();
            $.ajax({
                url:"{pigcms{:U('check_this_company')}",
                data:{'company_name':company_name,'village_id':village_id},
                type:'post',
                dataType:'json',
                success:function (res) {
                    if(res.error == 0){
                        $("input[name='floor']").parent().parent().slideDown(100);
                        $("input[name='floor']").val(res.floor);
                        $("input[name='company_id']").val(res.company_id);

                    }else{
                        $("input[name='floor']").parent().parent().slideDown(100);
                    }
                }
            });
        });

    });
</script>

</body>

</html>