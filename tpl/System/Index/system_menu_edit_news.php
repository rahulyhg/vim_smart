<layout name="layout"/>
<!--引入日历插件样式 -->
<style>
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>修改菜单
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">系统设置</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"> 后台菜单管理</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">修改菜单</span>
            </li>
        </ul>
        <div class="row">
            <form action="#" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{pigcms{$menu_array.id}">
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">修改菜单</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">权限类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="auth_type" id="cont_type">
                                            <option selected="selected">--请选择--</option>
                                            <option value="0"<if condition="$menu_array['auth_type'] eq 0">selected="selected"</if>>菜单</option>
                                            <option value="1"<if condition="$menu_array['auth_type'] eq 1">selected="selected"</if>>逻辑业务</option>
                                            <option value="2"<if condition="$menu_array['auth_type'] eq 2">selected="selected"</if>>显示权限</option>
                                            <option value="3"<if condition="$menu_array['auth_type'] eq 3">selected="selected"</if>>外部链接</option>
                                            <option value="4"<if condition="$menu_array['auth_type'] eq 4">selected="selected"</if>>模块显示</option>
                                            <option value="5"<if condition="$menu_array['auth_type'] eq 5">selected="selected"</if>>后台管理</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">权限范围
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="auth_area" id="auth_area">
                                            <option selected="selected">--请选择--</option>
                                            <option value="0"<if condition="$menu_array['auth_area'] eq 0">selected="selected"</if>>后台cms</option>
                                            <option value="1"<if condition="$menu_array['auth_area'] eq 1">selected="selected"</if>>Wap端权限</option>
                                            <option value="2"<if condition="$menu_array['auth_area'] eq 2">selected="selected"</if>>项目权限</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1" id="cont_name">权限名称
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$menu_array.name}" >
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">请输入权限名称</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" <if condition="$menu_array.auth_type neq 4 ">style="display:none;"</if>>
                                    <label class="col-md-2 control-label" for="form_control_1" id="cont_name">单位
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="unit" value="{pigcms{$menu_array.unit}" >
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">请输入单位</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="fid_select">
                                    <label class="col-md-2 control-label" for="form_control_1" id="cont_fid">父级菜单
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="fid" id="fid">
                                            <if condition="$menu_array['fid'] neq 0">
                                            <foreach name="show_father_menu" item="v">
                                                <if condition="$menu_array['fid'] eq $v['id']">
                                                    <option value="{pigcms{$v.id}" selected="selected">{pigcms{$v.name}</option>
                                                <else/>
                                                    <option value="{pigcms{$v.id}">{pigcms{$v.name}</option>
                                                </if>
                                            </foreach>
                                            <else/>
                                                <option value="0" selected="selected">顶级菜单</option>
                                                <foreach name="show_father_menu" item="v">
                                                    <option value="{pigcms{$v.id}">{pigcms{$v.name}</option>
                                                </foreach>
                                            </if>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">所属分组
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <if condition="$menu_array['fid'] eq 0">
                                            <select class="form-control" name="group_id" id="group_id">
                                                <if condition="$menu_array['group_id'] neq 0">
                                                    <foreach name="group_array" item="v">
                                                        <if condition="$menu_array['group_id'] eq $v['id']">
                                                            <option value="{pigcms{$v.id}" selected="selected">{pigcms{$v.name}</option>
                                                            <else/>
                                                            <option value="{pigcms{$v.id}">{pigcms{$v.name}</option>
                                                        </if>
                                                    </foreach>
                                                    <else/>
                                                    <option value="0" selected="selected">顶级菜单</option>
                                                    <foreach name="group_array" item="v">
                                                        <option value="{pigcms{$v.id}">{pigcms{$v.name}</option>
                                                    </foreach>
                                                </if>
                                            </select>
                                        <else/>
                                            <foreach name="group_array" item="v">
                                                <if condition="$menu_array['group_id'] eq $v['id']">
                                                    <span class="form-control">{pigcms{$v.name}</span>
                                                    <input name="group_id" value="0" type="hidden"/>
                                                </if>
                                            </foreach>
                                        </if>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <if condition="$menu_array['fid'] neq 0">
                                <div class="form-group form-md-line-input" id="model">
                                    <label class="col-md-2 control-label" for="form_control_1">模块
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="module" class="form-control" id="model_select">
                                            <option>请选择</option>
                                            <foreach name="module_array" item="re">
                                                <if condition="$re eq $menu_array['module']">
                                                    <option value="{pigcms{$re}" selected="selected">{pigcms{$re}</option>
                                                <else/>
                                                    <option value="{pigcms{$re}">{pigcms{$re}</option>
                                                </if>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">请输入模块</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="module">
                                    <label class="col-md-2 control-label" for="form_control_1">控制器
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="controller" class="form-control" id="module_select">
                                            <foreach name="control_array" item="voo">
                                                <if condition="$menu_array['controller'] eq $voo">
                                                    <option value="{pigcms{$voo}" selected="selected">{pigcms{$voo}</option>
                                                    <else/>
                                                    <option value="{pigcms{$voo}">{pigcms{$voo}</option>
                                                </if>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">请输入控制器</span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="action">
                                    <label class="col-md-2 control-label" for="form_control_1">操作方法
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="action" value="{pigcms{$menu_array.action}">
                                        <!-- <select name="action" class="form-control" id="action_select">
                                             <option>请选择</option>
                                         </select>-->
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">请输入操作方法</span>
                                    </div>
                                </div>
                                </if>
                                <if condition="$menu_array['auth_type'] eq 3">
                                    <input name="auth_type" type="hidden" value="3"/>
                                    <div class="form-group form-md-line-input" id="url">
                                        <label class="col-md-2 control-label" for="form_control_1">外部链接
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="w_url" value="{pigcms{$menu_array.w_url}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入外部链接</span>
                                        </div>
                                    </div>
                                </if>


                                <if condition="$menu_array['auth_type'] eq 4">
                                    <div class="form-group form-md-line-input" id="class">
                                        <label class="col-md-2 control-label" for="form_control_1">样式ClassName
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="class" value="{pigcms{$menu_array.class}">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">请输入ClassName</span>
                                        </div>
                                    </div>

                                    <div class="form-group mt-repeater" style="padding-left: 9%;" id="arguments">

                                        <div data-repeater-list="group-c">
                                            <foreach name="menu_array['argArray']" item="vo" key="ke">
                                            <div data-repeater-item class="mt-repeater-item">

                                                    <div class="row mt-repeater-row">

                                                        <div class="col-md-8">
                                                            <label class="control-label">参数名</label>
                                                            <input type="text" placeholder="参数名称" class="form-control" name="a_key" value="{pigcms{$vo.a_key}"/> </div>
                                                        <div class="col-md-2">
                                                            <label class="control-label">参数值</label>
                                                            <input type="text" placeholder="动态值可不填" class="form-control" name="a_value" value="{pigcms{$vo.a_value}"/> </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                            </foreach>
                                            </div>
                                        </div>

                                        <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                            <i class="fa fa-plus"></i> 添加参数</a>
                                    </div>

                                </if>
                                <if condition="$menu_array['fid'] eq 0 and $menu_array['auth_type'] neq 4">
                                <div class="form-group form-md-line-input" id="icon">
                                    <label class="col-md-2 control-label" for="form_control_1">选择图标
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="icon" value="{pigcms{$menu_array.icon}">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                </if>
                                <div class="form-group form-md-line-input" id="custom">
                                    <label class="col-md-2 control-label" for="form_control_1">自定义图片
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" placeholder="" name="custom" >
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control"  name="custom_icon" value="{pigcms{$menu_array.custom_icon}">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">显示状态
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="show_no" name="is_show"  value="1" class="md-radiobtn"<if condition="$menu_array['is_show'] eq 1"> checked</if>>
                                                <label for="show_no">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 显示 </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="show" name="is_show"  value="0" class="md-radiobtn"<if condition="$menu_array['is_show'] eq 0"> checked</if>>
                                                <label for="show">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 未显示 </label>
                                            </div>
                                        </div>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green">确认提交</button>
                                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Index&a=system_menu_show_news'">返 回</button>
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
<script src="/Car/Admin/Public/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
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
    $('#cont_type').change(function(){
        var cont_type =$('#cont_type option:selected').val();
        if(cont_type =='0'){
            $('#cont_name').html('菜单名称 <span class="required">*</span>');
            $('#cont_fid').html('父级菜单 <span class="required">*</span>');

        }else if(cont_type =='1'){
            $.ajax({
                url:"{pigcms{:U('Index/make_child_option')}",
                success:function(res){
                    $("#fid").html(res);
                }
            });
            $('#cont_name').html('权限名称 <span class="required">*</span>');
            $('#cont_fid').html('所属模块名 <span class="required">*</span>');
        }else if(cont_type =='2'){
            $('#cont_name').html('权限名称 <span class="required">*</span>');
            /*$('#fid_select').hide();*/
            $('#action').hide();
            $('#module').hide();
            $('#icon').hide();
        }else if(cont_type =='3'){
            $('#action').hide();
            $('#module').hide();
            $('#icon').hide();
            $('#model').hide();
            $('#url').show();
        }else if(cont_type == '4'){
            $('#icon').hide();
            $('#fid_select').hide();
            $('#group').hide();
            $('#class').show();
            $('#arguments').show();
        }
    });
    //权限范围的选择jq
    $("#fid").change(function(){
        var fid_name = $("#fid").val();
        var auth_area = $('#auth_area option:selected').val();
        if(fid_name == '0'&& auth_area == '0'){
            $('#action').hide();
            $('#module').hide();
            $('#model').hide();
            $("#icon").show();
        }else if(fid_name == '0'&& auth_area != '0'){
            $("#icon").show();
        }else if(fid_name != '0'&& auth_area != '0'){
            $("#icon").show();
        }else{
            $("#icon").hide();
        }
    });

    $("#model_select").change(function(){
        var model_select = $('#model_select option:selected').val();
        $.ajax({
            url:"{pigcms{:U('make_control_option')}",
            type:'post',
            data:{'model':model_select},
            success:function(res){
                $("#module_select").html(res);
            }
        });

    });

</script>
</body>

</html>