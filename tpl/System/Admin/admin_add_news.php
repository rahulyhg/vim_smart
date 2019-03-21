<layout name="layout"/>
<!--引入日历插件样式 -->
<!-- BEGIN CONTENT -->

<style type="text/css">
    .autocompleter {
        z-index: 100;
    }
</style>

<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>添加员工
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">组织架构</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>部门管理</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">添加员工</span>
            </li>
        </ul>
        <div class="row">
            <form action="{pigcms{:U('Admin/admin_save')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{pigcms{$_GET['id']}"/>
                <div class="col-md-12" style="float: left">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加管理员</span>
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
                                    <label class="col-md-2 control-label" for="form_control_1">账号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="account" id="account" size="20" validate="maxlength:30,required:true" value="{pigcms{$admin['account']}" />
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">密码
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pwd" id="pwd" size="20" placeholder=""  tips="添加时候必填，在修改时候不填写证明不修改密码" autocomplete="new-password"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">所属项目
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="village_id" id="village_id" required>
                                            <option value="0">请选择</option>
                                            <!-- <option value="1">全项目</option> -->
                                            <volist name="village_array" id="v">
                                                <if condition="$v['village_id'] eq $admin['village_id']">
                                                    <option value="{pigcms{$v.village_id}" selected="selected">{pigcms{$v.village_name}</option>
                                                    <else/>
                                                    <option value="{pigcms{$v.village_id}">{pigcms{$v.village_name}</option>
                                                </if>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>                               

                                <div class="form-group form-md-line-input" id="project_list" <if condition="empty($project_list)">style="display:none;"</if>>
                                    <label class="col-md-2 control-label" for="form_control_1">可选期数
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9" id="project">
                                            <volist name="project_list" id="v">
                                                <if condition="in_array($v['pigcms_id'],$choose_project)">
                                                    <input type="checkbox" name="project_id[]" value="{pigcms{$v.pigcms_id}" checked="checked">{pigcms{$v.desc}</input>&nbsp;
                                                    <else/>
                                                    <input type="checkbox" name="project_id[]" value="{pigcms{$v.pigcms_id}" >{pigcms{$v.desc}</input>&nbsp;
                                                </if>
                                            </volist>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <!--<div class="form-group form-md-line-input" id="company" <if condition="$admin['company_id'] eq 0">style="display: none"</if>>
                                    <label class="col-md-2 control-label" for="form_control_1">所属公司
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="company_id" id="company_id" >
                                            <option value="0">请选择</option>
                                            <foreach name="company_array" item="v">
                                                <if condition="$v['company_id'] eq $admin['company_id']">
                                                    <option value="{pigcms{$v.company_id}" selected="selected">{pigcms{$v.company_name}</option>
                                                <else/>
                                                    <option value="{pigcms{$v.company_id}">{pigcms{$v.company_name}</option>
                                                </if>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>-->
                                <div class="form-group form-md-line-input" id="company" <if condition="$admin['company_id'] eq 0">style="display: none"</if>>
                                    <label for="company_id" class="control-label col-md-2">所属公司
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select id="company_id"  name="company_id" class="form-control select2">
                                            <option value="0">请选择</option>
                                            <foreach name="company_array" item="v">
                                                <if condition="$v['company_id'] eq $admin['company_id']">
                                                    <option value="{pigcms{$v.company_id}" selected="selected">{pigcms{$v.company_name}</option>
                                                    <else/>
                                                    <option value="{pigcms{$v.company_id}">{pigcms{$v.company_name}</option>
                                                </if>
                                            </foreach>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="merchant" <if condition="$admin['mer_id'] eq 0">style="display: none"</if>>
                                    <label class="col-md-2 control-label" for="form_control_1">所属商户
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="mer_id" id="mer_id" >
                                            <option value="0">请选择</option>
                                            <foreach name="merchant_array" item="v">
                                                <if condition="$v['mer_id'] eq $admin['mer_id']">
                                                    <option value="{pigcms{$v.mer_id}" selected="selected">{pigcms{$v.name}</option>
                                                        <else/>
                                                    <option value="{pigcms{$v.mer_id}">{pigcms{$v.name}</option>
                                                </if>
                                            </foreach>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" id="village_more">
                                    <label class="col-md-2 control-label" for="village_more">多项目
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <!-- <select class="form-control select2" name="village_id_list[]" id="village_id_list" multiple="multiple"> -->
                                        <select class="form-control selectpicker" data-live-search="true" name="village_id_list[]" id="village_id_list" multiple="multiple">
                                            <!-- <option value="1">全项目</option> -->
                                            <volist name="village_array" id="v">
                                                <!-- <if condition="$v['village_id'] eq $admin['village_id']">  onchange="select_all(this)"
                                                    <option value="{pigcms{$v.village_id}" selected="selected">{pigcms{$v.village_name}</option>
                                                    <else/>
                                                    <option value="{pigcms{$v.village_id}">{pigcms{$v.village_name}</option>
                                                </if> -->
                                                <option value="{pigcms{$v.village_id}"  <if condition="in_array($v['village_id'],$admin['village_id_list'])">selected="selected"</if>>{pigcms{$v.village_name}</option>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input" id="village">
                                    <label class="col-md-2 control-label" for="form_control_1">部门
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="department_id" id="department_id" required>
                                            <option value="0">请选择</option>
                                            <volist name="department_categorys" id="v">
                                                <if condition="$v['id'] eq $admin['department_id']">
                                                    <option value="{pigcms{$v.id}" selected="selected">{pigcms{$v.name}</option>
                                                    <else/>
                                                    <option value="{pigcms{$v.id}">{pigcms{$v.name}</option>
                                                </if>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="role_id">角色
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control selectpicker" data-live-search="true" name="role_id[]" id="role_id" multiple="multiple">
                                            <volist name="role_array" id="v">
<!--                                                <if condition="$v['role_id'] eq $admin['role_id']">-->
<!--                                                    <option value="{pigcms{$v.role_id}" selected="selected">{pigcms{$v.role_name}</option>-->
<!--                                                <else/>-->
<!--                                                    <option value="{pigcms{$v.role_id}">{pigcms{$v.role_name}</option>-->
<!--                                                </if>-->
                                                <option value="{pigcms{$v.role_id}"  <if condition="in_array($v['role_id'],$admin['role_id'])">selected="selected"</if>>{pigcms{$v.role_name}</option>
                                            </volist>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>


<!--                        绑定入住公司-->
                        <div class="form-group form-md-line-input" style="display:none" >
                            <label class="col-md-2 control-label" for="tid">绑定入住公司
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control select2" name="tid" id="tid" disabled="disabled">
                                    <volist name="tenant_array" id="row">
                                        <option value="{pigcms{$row.pigcms_id}">{pigcms{$row.tenantname}</option>
                                    </volist>
                                </select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                                
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">真实姓名
                                        <span class="required"></span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="realname" id="realname">
                                            <option value="0" <if condition="$admin['realname'] eq ''">selected="selected"</if>>请选择</option>
                                            <volist name="name_array" id="v">
                                                <if condition="$v['name'] eq $admin['realname']">
                                                    <option value="{pigcms{$v.pigcms_id}" selected="selected">{pigcms{$v.name}</option>
                                                    <!-- <else/> -->
                                                    <!-- <option value="{pigcms{$v.pigcms_id}">{pigcms{$v.name}</option> -->
                                                </if>
                                            </volist>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="realname" id="realname" size="20" placeholder="" tips="填写该账号使用者的真实姓名" value="{pigcms{$admin['realname']}"/> -->
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">电话
                                        <span class="required"></span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone" size="20" placeholder=""  value="{pigcms{$admin['phone']}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">微信名称
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nickname" size="20" value="{pigcms{$admin['nickname']}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">EMAIL
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" size="20" value="{pigcms{$admin['email']}" autocomplete="new-password"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">QQ
                                        <span class="required">(可选)</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="qq" size="20" value="{pigcms{$admin['qq']}"/>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">状态
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <span class="cb-enable"><label class="cb-enable <if condition="$admin['status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="status" value="1" <if condition="$admin['status'] eq 1">checked="checked"</if> /></label></span>

                                        <span class="cb-disable"><label class="cb-disable  <if condition="$admin['status'] eq 0">selected</if>"><span>停用</span><input type="radio" name="status" value="0" <if condition="$admin['status'] eq 0">checked="checked"</if> /></label></span>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green">确认提交</button>
                                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=employee_news'">返 回</button>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
 --><!-- END PAGE LEVEL PLUGINS -->
<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<!--引入日历jquery插件结束-->

<script>
    $( document ).ready(function() {
        var village_id = document.getElementById("village_id").value;
        console.log(village_id);
        $.ajax({
            url:"{pigcms{:U('admin_add_news')}",
            data:{'select_village_id':village_id},
            type:'get',
            success:function (res) {
                // $("#company_id").html(res);
            }           
        });

    });

    // $("#village_id").change(function(){
    //     var village_id = $("#village_id").val();
    //     var html='';
    //     console.log(village_id);
    //     $.ajax({
    //         url:"{pigcms{:U('get_village_array')}",
    //         dataType:'json',
    //         data:{'select_village_id':village_id},
    //         type:'get',
    //         success:function (res) {
    //             console.log(res);
    //             html+='<select name="realname" id="realname" class="form-control select2">';                    
    //             html+='<option value="0">请选择</option>';
    //             res.forEach(function(item,index,res){                    
    //                 html+='<option value="'+item.pigcms_id+'">'+item.name+'</option>';                  
    //             })
    //             html+='</select>';
    //             $("#realname").html(html);
    //         }           
    //     });            
    // });
</script>

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

    //关于后台选择的js控制
    $("#village").change(function(){
       //先选所属社区，根据选择的社区来区分公司
        var village_id = $("#village_id").val();
        $("#company").slideDown(100);
        $("#merchant").slideDown(100);
        $.ajax({
            url:"{pigcms{:U('make_company_list')}",
            data:{'village_id':village_id},
            type:'post',
            success:function (res) {
                $("#company_id").html(res);
            }
        });

        $.ajax({
            url:"{pigcms{:U('make_merchant_list')}",
            data:{'village_id':village_id},
            type:'post',
            success:function (res) {
                $("#mer_id").html(res);
            }
        });
        $.ajax({
            url:"{pigcms{:U('ajax_project_list')}",
            data:{'village_id':village_id},
            type:'post',
            success:function (res) {
                //console.log(res);
                if(res!=0){
                    $("#project_list").css('display','block');
                    $("#project").html(res);
                }else{
                    $("#project_list").css('display','none');
                }
            }
        });
    });

    //查询name,将其他两个信息显示到页面上  removeAttr("selected")
    $("#realname").change(function(){
        

        var a = $("#realname").children("option:last-child");
        a.attr("selected","selected");
        // var ps=a.previousSbiling.removeClass("selected");
        // console.log(a); 
        var pigcms_id = $("#realname").val();
        var village_id = $("#village_id").val();
        console.log(pigcms_id);
        console.log(village_id);
        $.ajax({
            url:"{pigcms{:U('user_bind_phone')}",
            data:{'pigcms_id':pigcms_id,'village_id':village_id},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.phone && $("input[name='phone']").val(res.phone);
                res.weixin_nick && $("input[name='nickname']").val(res.weixin_nick);
            }
        });
    });

    //查询phone,将其他两个信息显示到页面上
    $("input[name='phone']").change(function(){
        var phone = $("input[name='phone']").val();
        $.ajax({
            url:"{pigcms{:U('phone_bind_user')}",
            data:{'phone':phone},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.name && $("input[name='realname']").val(res.name);
                res.weixin_nick && $("input[name='nickname']").val(res.weixin_nick);
            }
        });
    });

    //查询微信昵称,将其他两个信息显示到页面上
    $("input[name='nickname']").change(function(){
        var nickname = $("input[name='nickname']").val();
        $.ajax({
            url:"{pigcms{:U('weixin_bind_user')}",
            data:{'nickname':nickname},
            type:'post',
            dataType:'json',
            success:function (res) {
                res.name && $("input[name='realname']").val(res.name);
                res.phone && $("input[name='phone']").val(res.phone);
            }
        });
    });


</script>

<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>



<script>
    $('#village_id_list').selectpicker({
        size:10,
        actionsBox:true, //在下拉选项添加选中所有和取消选中的按钮
    });
    $('#role_id').selectpicker({
        size:10,
        actionsBox:true, //在下拉选项添加选中所有和取消选中的按钮
    });
    //初始化多选框
    <if condition="$personnel_info['depatment_id']">
    var depatment_id='{pigcms{$personnel_info['depatment_id']}';
    $("select[name='depatment_id']").selectpicker('val',depatment_id);
    </if>
    <if condition="$personnel_info['admin_id']">
        var admin_id='{pigcms{$personnel_info['admin_id']}';
    $("select[name='admin_id']").selectpicker('val',admin_id);
    </if>
    <if condition="empty($personnel_info) and $department_id">
            $("select[name='department_id']").selectpicker('val',{pigcms{$department_id});
    </if>
</script>

<script type='text/javascript'>
    //开启自动完成
    $(function(){
        //清除缓存的时候打开！（定期清理）
        //$.autocompleter('clearCache');
        $("input[name='nickname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true,
        });

        // $("input[name='realname']").autocompleter({
        //     source: "{pigcms{:U('name_to_autocomplete')}",
        //     autoFocus: true,
        // });

        $("input[name='phone']").autocompleter({
            source: "{pigcms{:U('phone_to_autocomplete')}",
            autoFocus: true,
        });

    });
</script>


<script>
    $(document).ready(function(){
        function is_out_form($el,is_out){
            if(is_out){
                console.log('show');
                $el.removeAttr("disabled");
                $el.parents('.form-group').css('display','block')
            }else{
                console.log('hide');
                $el.attr("disabled","disabled");
                $el.parents('.form-group').css('display','none')
            }

        }

        $('[name="role_id[]"]').change(function(){
            var role_id = $(this).val(),
                // is_out = role_id!=19;//role_id = 19 为入住公司管理员
                is_out = role_id.indexOf("19")!=-1;//role_id = 19 为入住公司管理员
                is_out_form($('[name="tid"]'),is_out);
        });

    });

</script>

<script>
    // function select_all(village){
    //    var village_all =  village.val;
    //    console.log(village_all);
    // }
    // $('[name="village_id_list[]"]').change(function(){
    //     var village_id_list = $(this).val();
    //     var a = village_id_list.indexOf("1");
    //     console.log(village_id_list);
    //     console.log(a);
    //     if (a == 0) {
    //         console.log(1);
    //         $.ajax({
    //             url:"{pigcms{:U('get_villagge_id')}",
    //             data:{'a':a},
    //             type:'post',
    //             dataType:'json',
    //             success:function (res) {
    //                 console.log(2);
    //                 console.log(res);
    //                 $('[name="village_id_list[]"]').val(res[0]);
    //                 $('[name="village_id_list[]"]').text(res[1]);
    //             }
    //         });
    //     }
        
    // });
</script>
<script src="https://cdn.bootcss.com/select2/4.0.6-rc.1/js/select2.min.js"></script>
<script src="https://cdn.bootcss.com/select2/4.0.6-rc.1/js/i18n/zh-CN.js"></script>
<script>
$(".select2").select2();
//下拉框的分页显示
$("#realname").select2({ 
    placeholder: '请选择', 
    ajax: { 
        url: "{pigcms{:U('Admin/ajax_search_realname')}", 
        dataType: 'json', 
        delay: 250, 
        data: function (params) { 
            params.offset = 6; 
            return { 
                q: params.term, 
                page: params.page, 
                offset:params.offset 
            }; 
        }, 
        processResults: function (data, params) { 
            params.page = params.page || 1; 
            var users = data.res || []; 
            var options = []; 
            for (var i = 0, len = users.length; i < len; i++) { 
                var option = { 
                    "id": users[i]["pigcms_id"], 
                    "text": users[i]["name"], 
                };
                // option.attr("selected","selected");  remove()
                // options.remove();
                options.push(option); 
            } 

            return { 
                results: options, 
                pagination: { 
                    more: (params.page * params.offset) < data.total 
                } 
            }; 
        }, 
        cache: true 
    },
    // allowClear: true, //允许清空 
    escapeMarkup: function (markup) { return markup; }, 
    minimumInputLength: 1,
    formatResult: function formatRepo(repo){return repo.text;}, // 函数用来渲染结果
    formatSelection: function formatRepoSelection(repo){return repo.text;} // 函数用于呈现当前的选择 
   
});


// $("#realname").select2({    
//       ajax: {
//         type:'POST',
//         url: '{pigcms{:U('Admin/get_name_array')}',
//         dataType: 'json',
//         delay: 250,
//         data: function (params) {
//           return {
//             q: params.term, // search term 请求参数
//             page: params.page
//           };
//         },
//         processResults: function (data, params) {         
//           params.page = params.page || 1;
//           /*var itemList = [];
//           var arr = data.result.list
//           for(item in arr){
//               itemList.push({id: item, text: arr[item]})
//           }*/
//           return {
//             results: data.items,//itemList
//             pagination: {
//               more: (params.page * 2) < data.total_count
//             }
//           };
//         },
//         cache: true
//       },
//       placeholder:'请选择',//默认文字提示
//       language: "zh-CN",
//       tags: true,//允许手动添加
//       allowClear: true,//允许清空
//       escapeMarkup: function (markup) { return markup; }, // 自定义格式化防止xss注入
//       minimumInputLength: 1,
//       formatResult: function formatRepo(repo){return repo.text;}, // 函数用来渲染结果
//       formatSelection: function formatRepoSelection(repo){return repo.text;} // 函数用于呈现当前的选择
//     });


// $("#realname").select2({
//     language : 'zh-CN',//转为中文版
//     minimumInputLength: 1,//最少输入1个字符，否则不会自动查询
//     //escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
//     placeholder: "真实姓名",//默认显示文案：标签
//     ajax: {
//         type:'GET',
//         url: "{pigcms{:U('Admin/ajax_search_realname')}",
//         dataType: 'json',
//         cache: true,
//         delay: 250,
//         data:function (params) {
//             var have_chose="";
//             $.each($("#tag").find("option:selected"),function(key,val){
//                 have_chose+=$(this).val()+",";
//             });
//             return {
//                 title: params.term, // search term
//                 have_chose_ids: have_chose, //已经选择的不在查询
//                 page: params.page //第几页返回查询
//             };
//         },
//         processResults: function (data,params) {//结果处理
//             params.page = params.page || 1;
//             return {
//                 //results: (new Function("return " + data.items))(),
//                 results: data.items,
//                 pagination: {
//                     more: (params.page * 20) < data.total_count //每页20条数据
//                 }
//             }
//         }
//     }
// });


</script>

</body>

</html>