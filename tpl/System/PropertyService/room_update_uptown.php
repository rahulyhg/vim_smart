<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>编辑房间
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('room_list_uptown')}">物业服务</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">添加房间</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{pigcms{$thisRoomArray.id}"/>
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加房间</span>
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
                                <if condition="$Think.session.system.account eq 'admin'">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">社区
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            {pigcms{$thisRoomInfo.village_name}
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <else/>
                                    <input type="hidden" name="village_id" value="{pigcms{$Think.session.system.village_id}"/>
                                </if>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">楼层
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <span class="required">{pigcms{$thisRoomInfo.room_name}</span>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">所属期数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[desc]" value="{pigcms{$thisRoomArray['desc']}"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">门牌号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[room_name]" value="{pigcms{$thisRoomArray['room_name']}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">房间面积(平方米)
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[roomsize]" value="{pigcms{$thisRoomArray['roomsize']}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">入伙时间
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[uptown][addtime]"  id="addtime" value="<if condition="$thisRoomArray['addtime']">{pigcms{$thisRoomArray['addtime']|date="Y-m-d",###}</if>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">装修起止
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[uptown][fixhouse_start]"  id="fixhouse_start" value="<if condition="$thisRoomArray['fixhouse_start']">{pigcms{$thisRoomArray['fixhouse_start']|date="Y-m-d",###}</if>" class="form-inline">
                                    至
                                    <input type="text" name="roominfo[uptown][fixhouse_end]"  id="fixhouse_end" value="<if condition="$thisRoomArray['fixhouse_end']">{pigcms{$thisRoomArray['fixhouse_end']|date="Y-m-d",###}</if>" class="form-inline">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">第一次验收时间
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][checktime]"  id="checktime" value="<if condition="$thisRoomArray['checktime']">{pigcms{$thisRoomArray['checktime']|date="Y-m-d",###}</if>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">第二次验收时间
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][checktime_second]"  id="checktime_second" value="<if condition="$thisRoomArray[checktime_second]">{pigcms{$thisRoomArray[checktime_second]|date="Y-m-d",###}</if>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">房屋问题
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][house_program]"  id="house_program" value="{pigcms{$thisRoomArray[house_program]}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">处理结果
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][house_return]"  id="house_return" value="{pigcms{$thisRoomArray[house_return]}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">违规信息
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][house_error]"  id="house_error" value="{pigcms{$thisRoomArray[house_error]}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">整改情况
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][house_abarbeitung]"  id="house_abarbeitung" value="{pigcms{$thisRoomArray[house_abarbeitung]}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="room_number" >
                                    <label class="col-md-2 control-label" for="form_control_1">房屋状态
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="md-checkbox-list">
                                            <div class="md-radio">
                                                <input name="roominfo[uptown][house_type]" type="radio"  class="mt-radio" value="0" id="checkbox1_1"<if condition="$thisRoomArray['house_type'] eq 0">checked="checked"</if>/>
                                                <label for="checkbox1_1" class="text-danger property_emptytime">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 空置 </label>

                                            </div>
                                            <div class="md-radio" >
                                                <input name="roominfo[uptown][house_type]" type="radio"  class="mt-radio" value="1" id="checkbox1_2"<if condition="$thisRoomArray['house_type'] eq 1">checked="checked"</if>/>
                                                <label for="checkbox1_2" class="text-primary property_emptytime">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 出租 </label>

                                            </div>
                                            <div class="md-radio" >
                                                <input name="roominfo[uptown][house_type]" type="radio"  class="mt-radio" value="2" id="checkbox1_3"<if condition="$thisRoomArray['house_type'] eq 2">checked="checked"</if>/>
                                                <label for="checkbox1_3" class="text-success property_emptytime">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 自住 </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="property_emptytime_fa"  <if condition="$thisRoomArray['house_type'] eq 0">style="display:none;"</if>>
                                    <label class="col-md-2 control-label" for="form_control_1">空置期结束时间（没有则不用填写）
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="roominfo[uptown][property_emptytime]"  id="property_emptytime" value="<if condition="$thisRoomArray['property_emptytime'] gt 1">{pigcms{$thisRoomArray['property_emptytime']|date="Y-m-d",###}</if>" class="form-control">
                                    </div>
                                </div>
                                    <div class="form-group form-md-line-input" id="room_number" >
                                        <label class="col-md-2 control-label" for="form_control_1">押金情况
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="md-checkbox-list">
                                                <div class="md-radio">
                                                    <input name="roominfo[uptown][cash_type]" type="radio"  class="mt-radio" value="0" id="radio1_1"<if condition="$thisRoomArray['cash_type']==0">checked="checked"</if>/>
                                                    <label for="radio1_1" class="text-danger">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 已退还 </label>

                                                </div>
                                                <div class="md-radio" >
                                                    <input name="roominfo[uptown][cash_type]" type="radio"  class="mt-radio" value="1" id="radio1_2"<if condition="$thisRoomArray['cash_type']==1">checked="checked"</if>/>
                                                    <label for="radio1_2" class="text-primary">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> 未退还 </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group form-md-line-input"  >
                                    <label class="col-md-2 control-label" for="form_control_1">押金金额
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                    <input type="text" name="roominfo[uptown][cash_price]" value="{pigcms{$thisRoomArray['cash_price']}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=room_list_uptown'">返 回</button>
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
    $('#addtime').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['addtime']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false,    //关闭选择今天按钮
        scrollMonth: false    //设置关闭滚轮
    });
    $('#checktime').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['checktime']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,  //设置关闭滚轮
        todayButton:false    //关闭选择今天按钮
    });
    $('#checktime_second').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['checktime']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,  //设置关闭滚轮
        todayButton:false    //关闭选择今天按钮
    });
    $('#fixhouse_start').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['fixhouse_start']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,  //设置关闭滚轮
        todayButton:false    //关闭选择今天按钮
    });
    $('#fixhouse_end').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['fixhouse_end']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,  //设置关闭滚轮
        todayButton:false    //关闭选择今天按钮
    });
    $('#property_emptytime').datetimepicker({
        lang:"zh",           //语言选择中文
        format:"Y-m-d",      //格式化日期
        timepicker:false,    //关闭时间选项
        startDate:'{pigcms{$thisRoomArray['property_emptytime']|date="Y-m-d",###}',//设置开始时间
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        scrollMonth: false,  //设置关闭滚轮
        todayButton:false    //关闭选择今天按钮
    });
    $(function () {
        $(".property_emptytime").bind("click",function(){

            var selectedvalue = $(this).attr('for');
            selectedvalue=$('#'+selectedvalue).val();
            console.log(selectedvalue);
            if (selectedvalue == 0) {
                $('#property_emptytime_fa').hide();
            }else{
                $('#property_emptytime_fa').show();
            }
        });
    });

    /*页面自定义js代码*/
    /*$("[name='room_state']").change(function() {
        var choose_str = $("[name='room_state']").find("option:selected").text()
        if(choose_str == '单间'){
            $("#room_number").show();
        }else{
            $("#room_number").hide();
        }
    });*/




</script>

</body>

</html>