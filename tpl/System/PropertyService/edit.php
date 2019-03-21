<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>编辑
                    <small>预览并编辑所有的信息</small>
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">业主编辑</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="pigcms_id" value="{pigcms{$info.pigcms_id}">
                <input type="hidden" name="usernum" value="{pigcms{$info.usernum}">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">编辑表格</span>
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
                                <table class="table table-bordered table-hover">
                                    <thead>

                                    <tr>
                                        <th colspan="6" style="text-align: center;">业主基本信息</th>
                                    </tr>

                                    <tr>
                                        <th colspan="6" style="text-align: center;color: red">{pigcms{$list.usernum}</th>
                                    </tr>

                                    <tr>
                                        <th style="color: blue" colspan="2">租户</th>
                                        <th style="color: blue">所在社区</th>
                                        <th style="color: blue">房屋状态</th>
                                        <th style="color: blue">租户电话</th>
                                        <th style="color: blue">缴费状态</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                        <tr style="background-color: #F3F4F6" class="old" name="update_this">
                                            <td colspan="2" name="tenantname" data-num="{pigcms{$list.usernum}">{pigcms{$list.tenantname}</td>
                                            <td name="village_id" data-num="{pigcms{$list.usernum}">{pigcms{$list.village_name}</td>
                                            <td name="fstatus" data-num="{pigcms{$list.usernum}">
                                                <if condition="$list['fstatus'] eq 0">待租待售
                                                    <elseif condition="$list['fstatus'] eq 1"/>出租已住入
                                                    <elseif condition="$list['fstatus'] eq 2"/>出售已住入
                                                    <elseif condition="$list['fstatus'] eq 3"/>出售未住入
                                                    <elseif condition="$list['fstatus'] eq 4"/>集团自用
                                                </if>
                                            </td>
                                            <td name="phone" data-num="{pigcms{$list.usernum}">{pigcms{$list.tenant_phone}</td>
                                            <td>正常</td>
                                        </tr>

                                        <if condition="is_array($list['floors'])">
                                            <foreach name="list['floors']" item="voo" key="svv">
                                                <tr>
                                                    <th colspan="6" style=" color: red">楼层：{pigcms{$voo}</th>
                                                </tr>
                                                <tr name="edit_this" data-fid="{pigcms{$list.fid.$svv}">
                                                    <th>合同开始日期</th>
                                                    <td name="contract_start">{pigcms{$list.contract_start.$svv}</td>
                                                    <th>合同结束日期</th>
                                                    <td name="contract_end">{pigcms{$list.contract_end.$svv}</td>
                                                    <th>物业开始计费日期</th>
                                                    <td name="property_start">{pigcms{$list.property_start.$svv}</td>

                                                </tr>
                                                <tr name="edit_this" data-fid="{pigcms{$list.fid.$svv}">
                                                    <th>房屋面积</th>
                                                    <td name="housesize">{pigcms{$list.housesize.$svv}</td>
                                                    <th>物业单价</th>
                                                    <td name="property_unit">{pigcms{$list.property_units.$svv}</td>
                                                    <th>联系电话</th>
                                                    <td name="phones">{pigcms{$list.phones.$svv}</td>
                                                </tr>
                                                <tr name="edit_this" data-fid="{pigcms{$list.fid.$svv}">
                                                    <th colspan="3">业主联系人</th>
                                                    <td name="name" colspan="3">
                                                        {pigcms{$list.relation_name.$svv}
                                                    </td>
                                                </tr>
                                            </foreach>
                                        <else/>
                                            <tr>
                                                <th colspan="6" style=" color: red">楼层：{pigcms{$list.floors}</th>
                                            </tr>
                                            <tr name="edit_this" data-fid="{pigcms{$list.fid}">
                                                <th>合同开始日期</th>
                                                <td name="contract_start">{pigcms{$list.contract_start}</td>
                                                <th>合同结束日期</th>
                                                <td name="contract_end">{pigcms{$list.contract_end}</td>
                                                <th>物业开始计费日期</th>
                                                <td name="property_start">{pigcms{$list.property_start}</td>
                                            </tr>
                                            <tr name="edit_this" data-fid="{pigcms{$list.fid}">
                                                <th>房屋面积</th>
                                                <td name="housesize">{pigcms{$list.housesize}</td>
                                                <th>物业单价</th>
                                                <td name="property_unit">{pigcms{$list.property_units}</td>
                                                <th>联系电话</th>
                                                <td name="phones">{pigcms{$list.phones}</td>
                                            </tr>
                                            <tr name="edit_this" data-fid="{pigcms{$list.fid}">
                                                <th colspan="3">业主联系人</th>
                                                <td name="name" colspan="3">
                                                    {pigcms{$list.relation_name}
                                                </td>
                                            </tr>
                                        </if>
                                    <tr>
                                        <td name="name" colspan="6">
                                            <input type="button" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=User&a=tenant_list_news'" class="btn green-sharp btn-outline  btn-block sbold uppercase" value="点击返回">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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

<!--页面js-->
<script src="/tpl/System/Static/js/edit.js" type="text/javascript"></script>

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

</body>

</html>