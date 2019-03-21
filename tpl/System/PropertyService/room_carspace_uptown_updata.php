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
                                    <label class="col-md-2 control-label" for="form_control_1">所属期数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[desc]" value="{pigcms{$thisRoomArray['desc']}"  class="form-control" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">车位号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="carinfo[carspace_number]" value="{pigcms{$carspace_info['carspace_number']}" class="form-control" <if condition="$carspace_info and $_GET['edit'] neq 1">readonly="readonly"</if>>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">车牌号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="carinfo[car_number]" value="{pigcms{$carspace_info['car_number']}" class="form-control" <if condition="$carspace_info and $_GET['edit'] neq 1">readonly="readonly"</if>>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">泊位费单价
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="carinfo[carspace_price]" value="{pigcms{$carspace_info['carspace_price']}" class="form-control" <if condition="$carspace_info and $_GET['edit'] neq 1">readonly="readonly"</if>>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">泊位费开始时间
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="carinfo[carspace_start]"  id="carspace_start" value="<if condition="$carspace_info['carspace_start']">{pigcms{$carspace_info['carspace_start']}</if>"  class="form-control" <if condition="$carspace_info['carspace_start'] and $_GET['edit'] neq 1">readonly="readonly"</if>>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">泊位费到期时间
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="carinfo[carspace_end]"  id="carspace_end" value="<if condition="$carspace_info['carspace_end']">{pigcms{$carspace_info['carspace_end']}</if>"  class="form-control" <if condition="$carspace_info['carspace_end'] and $_GET['edit'] neq 1">readonly="readonly"</if>>
                                    </div>
                                </div>
                                <!--<div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">缴费方式
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="md-checkbox-list">
                                            <div class="md-radio">
                                                <input name="type"  type="radio" class="mt-radio" value="1" id="checkbox2_1" >
                                                <label for="checkbox2_1" class="text-success">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 线上支付 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input name="type"  type="radio" class="mt-radio" value="2" id="checkbox2_2" >
                                                <label for="checkbox2_2" class="text-success">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 现金 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input name="type"  type="radio" class="mt-radio" value="3" id="checkbox2_3" >
                                                <label for="checkbox2_3" class="text-error">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 转账 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input name="type"  type="radio" class="mt-radio" value="4" id="checkbox2_4" >
                                                <label for="checkbox2_4" class="text-error">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> POS单 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input name="type"  type="radio" class="mt-radio" value="5" id="checkbox2_5" >
                                                <label for="checkbox2_5" class="text-error">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 现金缴款单 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <if condition="$carspace_info">
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">线下付款预付月数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="carspace_mouth" class="form-control" id="property_mouth">
                                            <option value="0" selected="selected">请选择</option>
                                            <for start="1" end="24"  name="i" >
                                                <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                            </for>
                                        </select>
                                        <span class="required">如果没有设置过泊位费到期时间，请先调整到期时间</span>
                                    </div>
                                </div>
                                </if>
                                <div id="pay" style="display: none;">
                                    <div class="form-group form-md-line-input"  >
                                        <label class="col-md-2 control-label" for="form_control_1">应付款
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9" >
                                            <label id="pay_recive"></label>元
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input"  >
                                        <label class="col-md-2 control-label" for="form_control_1">实付款
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9" >
                                            <input type="text"   id="pay_true" value="" name="carspace_true" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input"  >
                                        <label class="col-md-2 control-label" for="form_control_1">备注
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9" >
                                            <textarea    value="" name="remark" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='{pigcms{:U('room_carspace_uptown',array('id'=>$_GET['id']))}'">返 回</button>
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
<!--<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>-->
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
<!--<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>-->
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>-->
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<!--<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
--><!--引入百度文件上传JS结束-->

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
        todayButton:false,    //关闭选择今天按钮
        scrollMonth: false
    });
    $('#carspace_start').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-n-j",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'<if condition="$carspace_info['carspace_start'] eq ''">{pigcms{:date('Y-n-j')}</if>',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,
        todayButton:false    //关闭选择今天按钮
    });
    $('#carspace_end').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-n-j",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'<if condition="$carspace_info['carspace_end'] eq ''">{pigcms{:date('Y-n-j')}</if>',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,
        todayButton:false    //关闭选择今天按钮
    });
    <if condition="$carspace_info['carspace_price']">
    var carspace_unit={pigcms{$carspace_info['carspace_price']};
    </if>
    $('#property_mouth').change(function(){
        var p1=$(this).children('option:selected').val();
        var pay=p1*carspace_unit;
        pay=pay.toFixed(2);
        $('#pay').css('display','block');
        $('#pay_recive').html(pay);
        $('#pay_true').val(pay);
    })




</script>
</block>