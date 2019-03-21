<extend name="./tpl/System/Public_news/base_form.php"/>
<!--引入日历插件样式 -->
<block name="body">
    <!-- BEGIN CONTENT -->
    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <div class="portlet-body">
            <!-- BEGIN FORM-->

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">物业收费名称
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="fee_type[otherfee_type_name]" value="{pigcms{$otherfee_type_info['otherfee_type_name']}"  class="form-control" >
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">表格输出排序
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="fee_type[rank]" value="{pigcms{$otherfee_type_info['rank']}" class="form-control" >
                        <span class="required">数值越小表格中排序越靠前，为空默认为0</span>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">类型
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="md-checkbox-list">
                                <div class="md-radio">
                                    <input name="fee_type[type]"  type="radio" class="mt-radio" value="1" id="checkbox1_1" <if condition="$otherfee_type_info['type'] eq '1'">checked="checked"</if>>
                                    <label for="checkbox1_1" class="text-success">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 缴费 </label>
                                </div>
                            <div class="md-radio">
                                <input name="fee_type[type]"  type="radio" class="mt-radio" value="2" id="checkbox1_2" <if condition="$otherfee_type_info['type'] eq '2'">checked="checked"</if>>
                                <label for="checkbox1_2" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 押金（计算上年周转可选） </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">是否显示
                        <span class="required">*</span>
                    </label>
                <div class="col-md-9">
                    <div class="md-checkbox-list">
                        <div class="md-radio">
                            <input name="fee_type[status]"  type="radio" class="mt-radio" value="1" id="checkbox2_1" <if condition="$otherfee_type_info['status'] eq '1'">checked="checked"</if>>
                            <label for="checkbox2_1" class="text-success">
                                <span class="inc"></span>
                                <span class="check"></span>
                                <span class="box"></span> 是 </label>
                        </div>
                        <div class="md-radio">
                            <input name="fee_type[status]"  type="radio" class="mt-radio" value="0" id="checkbox2_2" <if condition="$otherfee_type_info['status'] eq '0'">checked="checked"</if>>
                            <label for="checkbox2_2" class="text-error">
                                <span class="inc"></span>
                                <span class="check"></span>
                                <span class="box"></span> 否 </label>
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">单价
                        <span class="required">*如果不需要则不用填写</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="fee_type[unit_price]" value="{pigcms{$otherfee_type_info['unit_price']}"  class="form-control" >
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">单位
                        <span class="required">*如果不需要则不用填写</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="fee_type[unit_name]" value="{pigcms{$otherfee_type_info['unit_name']}"  class="form-control" >
                    </div>
                </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">备注
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9" >
                            <textarea    value="" name="fee_type[remark]" class="form-control">{pigcms{$otherfee_type_info['remark']}</textarea>
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
        $('#property_endtime').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'<if condition="$carspace_info['carspace_endtime'] eq ''">{pigcms{:date('Y-n-j')}</if>',//设置开始时间
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('#carspace_start').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'<if condition="$carspace_info['carspace_start'] eq ''">{pigcms{:date('Y-n-j')}</if>',//设置开始时间
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('#carspace_end').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-n-j",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'<if condition="$carspace_info['carspace_end'] eq ''">{pigcms{:date('Y-n-j')}</if>',//设置开始时间
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        var carspace_unit={pigcms{$thisRoomArray['carspace_price']};
        $('#property_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var pay=p1*carspace_unit;
            pay=pay.toFixed(2);
            $('#pay').css('display','block');
            $('#pay_receive').html(pay);
            $('#pay_true').val(pay);
        })




    </script>
</block>