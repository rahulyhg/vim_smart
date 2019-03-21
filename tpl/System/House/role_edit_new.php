<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT --><style type="text/css">
<!--
.md-checkbox label>.box {
    top: 15px;
    left: 15px;
    border: 2px solid #666;
    height: 20px;
    width: 20px;
    z-index: 5;
    -webkit-transition-delay: .2s;
    -moz-transition-delay: .2s;
    transition-delay: .2s;
}
.md-checkbox label>.check {
    top: 10px;
    left: 15px;
    width: 10px;
    height: 20px;
    border: 2px solid #36c6d3;
    border-top: none;
    border-left: none;
    opacity: 0;
    z-index: 5;
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    transform: rotate(180deg);
    -webkit-transition-delay: .3s;
    -moz-transition-delay: .3s;
    transition-delay: .3s;
}
-->
</style>
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加角色
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">组织架构</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>角色信息列表</span>
				<i class="fa fa-circle"></i>
            </li>
			<li>
                <span class="active">添加角色</span>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('House/role_edit_new')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="role_id" value="{pigcms{$role.role_id}"/>
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加角色</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">角色名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="role_name" id="cat_url" value="{pigcms{$role.role_name}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">描述
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="role_desc" id="cat_url" value="{pigcms{$role.role_desc}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-2 control-label" for="form_control_1">用户权限</label>
                                    <div class="col-md-9"><table border='1' style="border:1px  #c2cad8 solid;">
                                            <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">首页统计菜单</th>
                                            </tr>
                                            <volist name="menus_model" id="rowset">
                                                <tr>
                                                    <th width="20%">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                            <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                            <label for="checkbox1_{pigcms{$rowset.id}"><span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                        </div>
                                                    </th>
                                                    <td>

                                                        <volist name="rowset['lists']" id="row">
                                                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                                <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$row.id}" name="menus[]" value="{pigcms{$row['id']}" onclick="check_parent(this)" <if condition="in_array($row['id'], $role['menus'])">checked="checked"</if> />
                                                                <label for="checkbox1_{pigcms{$row.id}"><span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>{pigcms{$row['name']}</label>　
                                                            </div>
                                                        </volist>
                                                    </td>
                                                </tr>
                                            </volist>
                                        <tr>
                                            <th colspan="2" style="text-align: center;font-size: 24px">后台权限菜单</th>
                                        </tr>
                                        <volist name="menus_O2O" id="rowset">
                                            <tr>
                                                <th width="20%">
                                                    <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                    <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                        <label for="checkbox1_{pigcms{$rowset.id}"><span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                    </div>
                                                </th>
                                                <td>
                                                    <volist name="rowset['lists']" id="row">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                        <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$row.id}" name="menus[]" value="{pigcms{$row['id']}" onclick="check_parent(this)" <if condition="in_array($row['id'], $role['menus'])">checked="checked"</if> />
                                                            <label for="checkbox1_{pigcms{$row.id}"><span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>{pigcms{$row['name']}</label>　
                                                        </div>
                                                    </volist>
                                                </td>
                                            </tr>
                                        </volist>

                                            <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">手机端权限菜单</th>
                                            </tr>
                                            <volist name="menus_guanli" id="rowset">
                                                <tr>
                                                    <th width="20%" colspan="2">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                            <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                            <label for="checkbox1_{pigcms{$rowset.id}" style="text-align: center"><span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                        </div>
                                                    </th>

                                                </tr>
                                            </volist>
                                            <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">手机端统计菜单</th>
                                            </tr>
                                            <volist name="menus_yulan" id="rowset">
                                                <tr>
                                                    <th width="20%">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                            <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                            <label for="checkbox1_{pigcms{$rowset.id}"><span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <volist name="rowset['son']" id="row">
                                                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                                <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$row.id}" name="menus[]" value="{pigcms{$row['id']}" onclick="check_parent(this)" <if condition="in_array($row['id'], $role['menus'])">checked="checked"</if> />
                                                                <label for="checkbox1_{pigcms{$row.id}"><span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>{pigcms{$row['name']}</label>　
                                                            </div>
                                                        </volist>
                                                    </td>
                                                </tr>
                                            </volist>
                                            <!--
                                            <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">智慧助手Phone权限</th>
                                            </tr>
                                            <volist name="menus_phone" id="rowset">
                                                <tr>
                                                    <th width="20%" colspan="2">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                            <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                            <label for="checkbox1_{pigcms{$rowset.id}" style="text-align: center"><span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                        </div>
                                                    </th>

                                                </tr>
                                            </volist>

                                             <tr>
                                                <th colspan="2" style="text-align: center;font-size: 24px">社区菜单权限</th>
                                            </tr>
                                            <volist name="menus_shequ" id="rowset">
                                                <tr>
                                                    <th width="20%">
                                                        <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                            <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$rowset.id}" name="menus[]" value="{pigcms{$rowset['id']}" onclick="parent_controller(this)"<if condition="in_array($rowset['id'], $role['menus'])">checked="checked"</if>/>
                                                            <label for="checkbox1_{pigcms{$rowset.id}"><span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>{pigcms{$rowset['name']}</label>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <volist name="rowset['lists']" id="row">
                                                            <div class="md-checkbox" style="float: left; padding:15px 15px 15px 20px;">
                                                                <input type="checkbox" class="md-check" id="checkbox1_{pigcms{$row.id}" name="menus[]" value="{pigcms{$row['id']}" onclick="check_parent(this)" <if condition="in_array($row['id'], $role['menus'])">checked="checked"</if> />
                                                                <label for="checkbox1_{pigcms{$row.id}"><span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>{pigcms{$row['name']}</label>　
                                                            </div>
                                                        </volist>
                                                    </td>
                                                </tr>
                                            </volist>-->
                                            <tr>
                                                <th width="20%">
                                                    <div class="" style="float: left; padding:15px 15px 15px 20px;">
                                                        <label for="checkbox1_{pigcms{$rowset.id}"><span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>智慧停车场</label>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="col-md-10">
                                                    <div class="md-radio-inline">
                                                    <volist name="car_role_array" id="vo">
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio_{pigcms{$vo['role_id']}" name="car_role_id"  value="{pigcms{$vo['role_id']}" class="md-radiobtn" <if condition="$vo['role_id'] eq $role['car_role_id']">checked="checked"</if>>
                                                            <label for="radio_{pigcms{$vo['role_id']}">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> {pigcms{$vo['role_name']} </label>
                                                        </div>
                                                    </volist>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    </table></div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green">确认提交</button>
                                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=role_news'">返 回</button>
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
    //开启日历插件
    $(function(){
        $("#mybutton").click(function(){
            var tr="<div class='form-group form-md-line-input' name='add_tr'><label class='col-md-3 control-label' for='form_control_1'>其他参数<span class='required'>*</span></label><div class='col-md-9'><input type='text' class='form-control' placeholder='' name='arguments[]'/><input type='text' class='form-control' placeholder='' name='arguments_value[]'/><div class='form-control-focus'></div></div></div>";
            $("div[name='add_tr']:last").after(tr);
        });
        $("#mybutton2").click(function(){
            var td_length = $("div[name='add_tr']").length;
            //alert(td_length);
            var pot = td_length-1;
            var last =td_length;
            if(td_length>1){
                $("div[name='add_tr']:last").remove();
            }
        });
    });
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
    //当一级权限被选中或者取消时，判断其它同级权限从而判断顶级全选的被选状态
    var auth_a_satat=0;
    function check_parent(obj){
        var its_length=$(obj).parent().parent().find('input').length;
        $(obj).parent().parent().find('input').each(function(k,v){
            if( $(v).prop('checked') ){
                auth_a_satat++;
            }else{
                auth_a_satat--;
            }
        });
        if(auth_a_satat>(-its_length)){
            $(obj).parent().parent().parent().find('input').first().prop('checked','checked');
        }else{
            $(obj).parent().parent().parent().find('input').first().removeAttr('checked');
        }
        auth_a_satat=0;
    }

    //当顶级权限被点中时一级权限被全部选择，否则全部不选
    function parent_controller(obj){
        if( $(obj).prop('checked') ){
            $(obj).parent().parent().next().find('input').each(function(k,v){
                $(v).prop('checked','checked');
            });
        }else{
            $(obj).parent().parent().next().find('input').each(function(k,v){
                $(v).removeAttr('checked');
            });
        }
    }

</script>
</body>

</html>