<extend name="./tpl/System/Public_news/base_form.php"/>
<!--引入日历插件样式 -->
<block name="body">
    <!-- BEGIN CONTENT -->
    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <div class="portlet-body">
            <!-- BEGIN FORM-->

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">房产信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text"  value="{pigcms{$room_info['room_name']}"  class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费类型
                    </label>
                    <div class="col-md-9">
                        <select name="otherfee[otherfee_type_id]" id="otherfee_type_id" class="form-control">
                            <option value="">请选择</option>
                            <volist name="type_list" id="vo">
                                <option value="{pigcms{$vo.otherfee_type_id}">{pigcms{$vo.otherfee_type_name}</option>
                            </volist>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1" id="fee_receive">应收
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                            <input type="text" name="otherfee[fee_receive]" value=""  class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1" id="fee_true">实收
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                            <input type="text" name="otherfee[fee_true]" value=""  class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">对应缴纳月份
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                            <input type="text" name="otherfee[fee_mouth]"  id="fee_mouth" value="" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费时间
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                            <input type="text" name="otherfee[fee_time]"  id="fee_time" value="" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费方式
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                            <div class="md-radio">
                                <input name="otherfee[type]"  type="radio" class="mt-radio" value="1" id="checkbox2_1" >
                                <label for="checkbox2_1" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 线上支付 </label>
                            </div>
                            <div class="md-radio">
                                <input name="otherfee[type]"  type="radio" class="mt-radio" value="2" id="checkbox2_2" >
                                <label for="checkbox2_2" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 现金 </label>
                            </div>
                            <div class="md-radio">
                                <input name="otherfee[type]"  type="radio" class="mt-radio" value="3" id="checkbox2_3" >
                                <label for="checkbox2_3" class="text-error">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 转账 </label>
                            </div>
                            <div class="md-radio">
                                <input name="otherfee[type]"  type="radio" class="mt-radio" value="4" id="checkbox2_4" >
                                <label for="checkbox2_4" class="text-error">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> POS单 </label>
                            </div>
                            <div class="md-radio">
                                <input name="otherfee[type]"  type="radio" class="mt-radio" value="5" id="checkbox2_5" >
                                <label for="checkbox2_5" class="text-error">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 现金缴款单 </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">备注
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9" >
                        <textarea    value="" name="otherfee[remark]" class="form-control">{pigcms{$otherfee_type_info['remark']}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default" onclick="window.location.href='{pigcms{:U('getotherfee_list')}'">返 回</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FORM-->
        </div>
    </form>

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
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
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
        $.datetimepicker.setLocale('ch');
        $('#fee_mouth').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-n')}',//设置开始时间
            theme:'form-control',
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: true,
            minView: "month",
        });
        $('#fee_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-n-j')}',//设置开始时间
            theme:'form-control',
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: true
        });
        $('#otherfee_type_id').change(function(){
            var p1=$(this).children('option:selected').val();
            $.ajax({
                url:"{pigcms{:U('ajax_otherfee_type')}",
                data:{'otherfee_type_id':p1},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    if(res.type == 1){
                        $('#fee_receive').html('应收<span class="required">*</span>');
                        $('#fee_true').html('实收<span class="required">*</span>');
                    }else{
                        $('#fee_receive').html('实收<span class="required">*</span>');
                        $('#fee_true').html('已退<span class="required">*</span>');
                    }
                }
            });
        })




    </script>
</block>