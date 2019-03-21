<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>编辑房间\楼层
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{pigcms{:U('room_list')}">物业服务</a>
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
                <input type="hidden" name="id" value="{pigcms{$thisRoomInfo.id}"/>
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加房间\楼层</span>
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
                                <div class="form-group form-md-line-input" id="room_number" >
                                    <label class="col-md-2 control-label" for="form_control_1">房间号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="md-checkbox-list">
                                            <div class="md-checkbox">
                                                <input name="all_number" type="checkbox" value="" class="mt-checkbox" id="checkbox1_1"/>
                                                <label for="checkbox1_1">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 全选 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="01" id="checkbox1_2"<if condition="in_array('01',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_2">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 01 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="02" id="checkbox1_3"<if condition="in_array('02',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_3">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 02 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="03" id="checkbox1_4"<if condition="in_array('03',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_4">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 03 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="04" id="checkbox1_5"<if condition="in_array('04',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_5">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 04 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="05" id="checkbox1_6"<if condition="in_array('05',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_6">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 05 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="06" id="checkbox1_7"<if condition="in_array('06',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_7">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 06 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="07" id="checkbox1_8"<if condition="in_array('07',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_8">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 07 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="08" id="checkbox1_9"<if condition="in_array('08',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_9">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 08 </label>

                                            </div>
                                            <div class="md-checkbox">
                                                <input name="room_number[]" type="checkbox"  class="mt-checkbox" value="09" id="checkbox1_10"<if condition="in_array('09',$roomNumber)">checked="checked"</if>/>
                                                <label for="checkbox1_10">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 09 </label>

                                            </div>
                                        </div>
                                        <!--<input name="all_number" type="checkbox" value="" class="mt-checkbox"/>全选
                                        <input name="room_number[]" type="checkbox" value="01" class="mt-checkbox"/>01
                                        <input name="room_number[]" type="checkbox" value="02" class="mt-checkbox"/>02
                                        <input name="room_number[]" type="checkbox" value="03" class="mt-checkbox"/>03
                                        <input name="room_number[]" type="checkbox" value="04" class="mt-checkbox"/>04
                                        <input name="room_number[]" type="checkbox" value="05" class="mt-checkbox"/>05
                                        <input name="room_number[]" type="checkbox" value="06" class="mt-checkbox"/>06
                                        <input name="room_number[]" type="checkbox" value="07" class="mt-checkbox"/>07
                                        <input name="room_number[]" type="checkbox" value="08" class="mt-checkbox"/>08
                                        <input name="room_number[]" type="checkbox" value="09" class="mt-checkbox"/>09-->
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">描述
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea cols="50" name="desc">{pigcms{$thisRoomInfo.desc}</textarea>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=room_list'">返 回</button>
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

    /*页面自定义js代码*/
    $("[name='all_number']").click(function(){
        if(!$("input[name='all_number']").is(':checked')){
            $("[name='room_number[]']").attr('checked',false);
        }else{
            $("[name='room_number[]']").attr('checked',true);
        }

    });

    $("[name='room_state']").change(function() {
        var choose_str = $("[name='room_state']").find("option:selected").text()
        if(choose_str == '单间'){
            $("#room_number").show();
        }else{
            $("#room_number").hide();
        }
    });




</script>

</body>

</html>