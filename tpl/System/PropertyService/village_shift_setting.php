<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加巡更点
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
                <span class="active">添加巡更点</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加巡更点</span>
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
                                <div class="form-group">
                        <label class="control-label col-md-4" style="font-size: 20px;">选择班次:</label>
                        <div class="form-group" style="width: 500px; margin-left: 100px; margin-top: 40px;">
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px; margin-bottom: 5px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="morning_shift" name="morning_shift" onchange="changeval()"> 早班 </span>
                                <input type="text" class="form-control" name="morning_time_from" id="morning_time_from">
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="morning_time_to" id="morning_time_to" onchange="">
                            </div>
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px; margin-bottom: 5px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="middle_shift" name="middle_shift" onchange="changeval()"> 中班 </span>
                                <input type="text" class="form-control" name="middle_time_from" id="middle_time_from">
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="middle_time_to" id="middle_time_to" onchange="">
                            </div>
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="night_shift" name="night_shift" onchange="changeval()"> 晚班 </span>
                                <input type="text" class="form-control" name="night_time_from" id="night_time_from">
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="night_time_to" id="night_time_to" onchange="">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=PropertyService&a=point_record_news'">返 回</button>
                            </div>
                        </div>
                    </div>
                            </div>
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

<script type="text/javascript">
    function changeval(){
        var check1 = document.getElementById("morning_shift");
        var check2 = document.getElementById("middle_shift");
        var check3 = document.getElementById("night_shift");
        if(check1.checked == true){
            document.getElementById("morning_shift").value = "1";           
        }else{
            document.getElementById("morning_shift").value = "0";         
        }
        if(check2.checked == true){
            document.getElementById("middle_shift").value = "1";
        }else{
            document.getElementById("middle_shift").value = "0";
            
        }
        if(check3.checked == true){
            document.getElementById("night_shift").value = "1";
        }else{
            document.getElementById("night_shift").value = "0";
        }
    }
    function GetQuery(name){
         var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
         var r = window.location.search.substr(1).match(reg);
         if(r!=null)return  unescape(r[2]); return null;
    }
    function go() {
        var village_id = GetQuery("default_village_id");
        var morning_shift = $("input[name='morning_shift']").val();
        var middle_shift = $("input[name='middle_shift']").val();
        var night_shift = $("input[name='night_shift']").val();        
        console.log(morning_shift);
        console.log(middle_shift);
        console.log(night_shift);
        console.log(village_id);
        if (morning_shift == 1) {
            var morning_time_from = $("input[name='morning_time_from']").val();
            var morning_time_to = $("input[name='morning_time_to']").val();
        }
        if (middle_shift ==1) {
            var middle_time_from = $("input[name='middle_time_from']").val();
            var middle_time_to = $("input[name='middle_time_to']").val();
        }
        if (night_shift ==1) {
            var night_time_from = $("input[name='night_time_from']").val();
            var night_time_to = $("input[name='night_time_to']").val();
        }
        // var url = "{pigcms{:U('PropertyService/village_shift_setting')}";
        // $.ajax({
        //     url:url,
        //     type:'post',
        //     data:{
        //         'village_id':village_id,
        //         'morning_shift':morning_shift,
        //         'middle_shift':middle_shift,
        //         'night_shift':night_shift,
        //         'morning_time_from':morning_time_from,
        //         'morning_time_to':morning_time_to,
        //         'middle_time_from':middle_time_from,
        //         'middle_time_to':middle_time_to,
        //         'night_time_from':night_time_from,
        //         'night_time_to':night_time_to
        //     },
        //     success:function(res){
        //         if (res) {
        //             alert('班次更新成功');
        //         } else {
        //             alert('班次更新失败');
        //         }
        //     }
        // })       
    }
</script>

<script type="text/javascript">
    $.datetimepicker.setLocale('ch');
     $('#morning_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#morning_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#middle_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#middle_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#night_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#night_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
</script>

</body>

</html>