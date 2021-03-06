<extend name="./tpl/System/Public_news/base_form.php"/>
<!--引入日历插件样式 -->
<block name="body">
    <!-- BEGIN CONTENT -->
    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{pigcms{$thisRoom.id}"/>
        <div class="portlet-body">
            <!-- BEGIN FORM-->

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">门牌号
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="roominfo[room_name]" value="{pigcms{$thisRoomArray['room_name']}" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">房间面积(平方米)
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="roominfo[roomsize]" value="{pigcms{$thisRoomArray['roomsize']}" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">物业费开始时间
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="property_defaulttime"  id="property_defaulttime" value="<if condition="$thisRoomArray['property_defaulttime']">{pigcms{$thisRoomArray['property_defaulttime']}</if>"  class="form-control" >
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">物业费到期时间
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="property_endtime"  id="property_endtime" value="<if condition="$thisRoomArray['property_endtime']">{pigcms{$thisRoomArray['property_endtime']}</if>"  class="form-control">
                    </div>
                </div>



                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">确认提交</button>
                            <button type="reset" class="btn default" onclick="window.location.href='{pigcms{:U('room_property_uptown',array('id'=>$_GET['id']))}'">返 回</button>
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
        $('#property_endtime').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-n-j')}',//设置开始时间
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('#property_defaulttime').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{$thisRoomArray['property_defaulttime']}',//设置开始时间
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });




    </script>
</block>