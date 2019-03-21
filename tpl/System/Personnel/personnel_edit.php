<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <form action="__SELF__" METHOD="post" autocomplete="off">
        <div class="col-md-6" style="float: left">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">人员信息修改</span>
                    </div>
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">姓名:
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="请输入真实姓名" value="{pigcms{$personnel_info['name']}" name="name" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">身份证号:
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['id_number']}" placeholder="请输入身份证号" name="id_number" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">联系电话:
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['phone']}" placeholder="请输入联系电话" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">性别:
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="sex" class="form-control">
                                    <option value="1" <if condition="$personnel_info['sex'] eq 1">selected</if> >男</option>
                                    <option value="2" <if condition="$personnel_info['sex'] eq 2">selected</if> >女</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label"  for="form_control_1">教育程度:
                            </label>
                            <div class="col-md-4">
                                <select name="education" class="form-control" onchange="education_show()">
                                    <option value="1" <if condition="$personnel_info['education'] eq 1">selected</if> >小学</option>
                                    <option value="2" <if condition="$personnel_info['education'] eq 2">selected</if> >初中</option>
                                    <option value="3" <if condition="$personnel_info['education'] eq 3">selected</if> >高中</option>
                                    <option value="4" <if condition="$personnel_info['education'] eq 4">selected</if> >中专</option>
                                    <option value="5" <if condition="$personnel_info['education'] eq 5">selected</if> >大专</option>
                                    <option value="6" <if condition="$personnel_info['education'] eq 6">selected</if> >本科</option>
                                    <option value="7" <if condition="$personnel_info['education'] eq 7">selected</if> >研究生</option>
                                    <option value="8" <if condition="$personnel_info['education'] eq 8">selected</if> >博士</option>
                                    <option value="0" <if condition="$personnel_info['education'] eq 0">selected</if> >其它</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input name="education_remark" class="form-control" value="{pigcms{$personnel_info['education_remark']}" placeholder="请填写受教育程度" <if condition="$personnel_info and $personnel_info['education'] neq 0">style="display:none;"</if>/>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">婚姻状态:
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="marital" class="form-control">
                                    <option value="1" <if condition="$personnel_info['marital'] eq 1">selected</if> >未婚</option>
                                    <option value="2" <if condition="$personnel_info['marital'] eq 2">selected</if> >已婚</option>
                                    <option value="3" <if condition="$personnel_info['marital'] eq 3">selected</if> >离异</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">政治面貌:
                            </label>
                            <div class="col-md-9">
                                <select name="politics" class="form-control">
                                    <option value="0"  >请选择政治面貌</option>
                                    <option value="1" <if condition="$personnel_info['politics'] eq 1">selected</if> >中共党员</option>
                                    <option value="2" <if condition="$personnel_info['politics'] eq 2">selected</if> >中共预备党员</option>
                                    <option value="3" <if condition="$personnel_info['politics'] eq 3">selected</if> >共青团员</option>
                                    <option value="4" <if condition="$personnel_info['politics'] eq 4">selected</if> >民革党员</option>
                                    <option value="5" <if condition="$personnel_info['politics'] eq 5">selected</if> >民盟盟员</option>
                                    <option value="6" <if condition="$personnel_info['politics'] eq 6">selected</if> >民建会员</option>
                                    <option value="7" <if condition="$personnel_info['politics'] eq 7">selected</if> >民进会员</option>
                                    <option value="8" <if condition="$personnel_info['politics'] eq 8">selected</if> >农工党党员</option>
                                    <option value="9" <if condition="$personnel_info['politics'] eq 9">selected</if> >致公党党员</option>
                                    <option value="10" <if condition="$personnel_info['politics'] eq 10">selected</if> >九三学社社员</option>
                                    <option value="11" <if condition="$personnel_info['politics'] eq 11">selected</if> >台盟盟员</option>
                                    <option value="12" <if condition="$personnel_info['politics'] eq 12">selected</if> >无党派人士</option>
                                    <option value="13" <if condition="$personnel_info['politics'] eq 13">selected</if> >普通居民</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">身高:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['height']}" name="height" placeholder="请输入身高">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">籍贯:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control city_picker" value="{pigcms{$personnel_info['native_place']}" name="native_place" placeholder="请输入籍贯">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">家庭住址:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control city_picker" value="{pigcms{$personnel_info['family_address']}" name="family_address" placeholder="请输入家庭住址">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">家庭联系电话:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['family_phone']}" name="family_phone" placeholder="请输入家庭联系电话">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">毕业院校:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['graduat_school']}" name="graduat_school" placeholder="请输入毕业院校">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">学习方式:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['learning_type']}" name="learning_type" placeholder="请输入学习方式">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">专业:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['major']}" name="major" placeholder="请输入专业">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">资格证/职称:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['certification']}" name="certification" placeholder="请输入资格证或职称">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">服役详情:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['enlist']}" name="enlist" placeholder="请输入服役详情">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">入职渠道:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['induction_channel']}" name="induction_channel" placeholder="请输入入职渠道">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">主要经历:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['main_experience']}" name="main_experience" placeholder="请输入主要经历">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6" style="float: left">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <!--<div class="alert alert-danger display-hide">-->
                        <!--<button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>-->
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">所属部门:
                            </label>
                            <div class="col-md-9">
                                <select name="department_id" class="form-control selectpicker" data-live-search="true">
                                    <option  value="0">请选择部门</option>
                                    <volist name="department_categorys" id="vo">
                                        <option value="{pigcms{$vo['id']}" <if condition="$personnel_info['department_id'] eq $vo['id']">selected</if> >{pigcms{$vo.name}</option>
                                    </volist>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">所属公司:
                            </label>
                            <div class="col-md-9">
                                <select name="group_id" class="form-control selectpicker" data-live-search="true">
                                    <option  value="0">请选择公司</option>
                                    <volist name="group_list" id="vo">
                                        <option value="{pigcms{$vo['group_id']}" <if condition="$personnel_info['group_id'] eq $vo['group_id']">selected</if> >{pigcms{$vo.group_name}</option>
                                    </volist>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">工号:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['job_number']}" name="job_number" placeholder="请输入工号">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">职位:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['position']}" name="position" placeholder="请输入职位">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">入职时间:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datetimepicker"  <if condition="$personnel_info['entrytime']">value="{pigcms{:date('Y-m-d',$personnel_info['entrytime'])}"</if> name="entrytime" placeholder="请选择入职时间">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">转正时间:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datetimepicker"  <if condition="$personnel_info['positivetime']">value="{pigcms{:date('Y-m-d',$personnel_info['positivetime'])}"</if> name="positivetime" placeholder="请选择转正时间">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">参保时间:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datetimepicker"  <if condition="$personnel_info['social_addtime']">value="{pigcms{:date('Y-m-d',$personnel_info['social_addtime'])}"</if> name="social_addtime" placeholder="请选择参保时间">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">参保情况:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['social_condition']}" name="social_condition" placeholder="请输入参保情况" >
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">公积金缴纳时间:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control datetimepicker"  <if condition="$personnel_info['accumulation_addtime']">value="{pigcms{:date('Y-m-d',$personnel_info['accumulation_addtime'])}"</if> name="accumulation_addtime" placeholder="公积金缴纳时间">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">公积金金额:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['accumulation_money']}" name="accumulation_money" placeholder="请输入公积金金额" >
                            </div>
                        </div>
                        <div class="form-group form-md-line-input" style="display: none">
                            <label class="col-md-3 control-label" for="form_control_1">年假默认天数:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['annual_day']}" name="annual_day" placeholder="请填写每年年假天数，不填则默认为7天">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input" style="display: none">
                            <label class="col-md-3 control-label" for="form_control_1">职务异动:
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{pigcms{$personnel_info['job_remark']}" name="job_remark" placeholder="请填写职务异动">
                            </div>
                        </div>
                        <if condition="empty($personnel_info)">
                            <if condition="$personnel_contract_info">
                                <input type="hidden" name="contract[personnel_contract_id]" value="{pigcms{$personnel_contract_info['personnel_contract_id']}"/>
                            </if>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label" for="form_control_1">当前劳动合同起止日期:
                                </label>
                                <div class="btn-group form-inline">
                                    <input type="text" style="min-width: 0px" class="form-inline datetimepicker"  <if condition="$personnel_contract_info['time_start']">value="{pigcms{:date('Y-m-d',$personnel_contract_info['time_start'])}"</if> name="contract[time_start]" placeholder="开始时间">
                                    至&nbsp;
                                    <input type="text" style="min-width: 0px" class="form-inline datetimepicker"  <if condition="$personnel_contract_info['time_end']">value="{pigcms{:date('Y-m-d',$personnel_contract_info['time_end'])}"</if> name="contract[time_end]" placeholder="结束时间">
                                </div>
                            </div>
                        </if>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-3 control-label" for="form_control_1">是否需要后台账号:
                            </label>
                            <div class="col-md-9">
                                <select name="admin_get"  style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';" onchange="admin_info()">
                                    <option value="1" <if condition="!$personnel_info['admin_id']">selected</if> >不需要</option>
                                    <option value="2" <if condition="$personnel_info['admin_id']">selected</if> >关联已有账号</option>
                                    <option value="3"  >新建账号</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input" id="admin_list">
                            <label class="col-md-3 control-label" for="form_control_1">请选择关联账号:
                            </label>
                            <div class="col-md-9">
                                <select name="admin_id"  class="form-control selectpicker" data-live-search="true">
                                    <foreach name="admin_list" item="vo">
                                        <option value="{pigcms{$vo['id']}" <if condition="$personnel_info['admin_id'] eq $vo['id']">selected</if> >{pigcms{$vo['realname']}  账号：{pigcms{$vo['account']}</option>
                                    </foreach>
                                </select>
                            </div>
                        </div>
                        <div id="admin_info">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-3 control-label" for="form_control_1"><span style="float:left; color:#FF0000; font-size:14px;">*</span>账号:
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{pigcms{$personnel_info['admin_info']['account']}" name="admin_info[account]" placeholder="请填写账号">
                                </div>
                            </div>
                            <div class="form-group form-md-line-input" >
                                <label class="col-md-3 control-label" for="form_control_1"><span style="float:left; color:#FF0000; font-size:14px;">*</span>密码:
                                </label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" value="{pigcms{$personnel_info['admin_info']['pwd']}" name="admin_info[pwd]" placeholder="请填写密码">
                                </div>
                            </div>
                            <div class="form-group form-md-line-input" >
                                <label class="col-md-3 control-label" for="form_control_1">所属项目:
                                </label>
                                <div class="col-md-9">
                                    <select name="admin_info[village_id]"  class="form-control selectpicker" data-live-search="true">
                                        <option  value="0">请选择社区</option>
                                        <volist name="village_list" id="vo">
                                            <if condition="$vo['village_type'] eq 1 and $vo['project_list']">
                                                <volist name="vo['project_list']" id="vo1">
                                                    <option value="{pigcms{$vo['village_id']}-{pigcms{$vo1['pigcms_id']}">{pigcms{$vo.village_name}-{pigcms{$vo1['desc']}</option>
                                                </volist>
                                               <else/>
                                                <option value="{pigcms{$vo['village_id']}">{pigcms{$vo.village_name}</option>
                                            </if>
                                        </volist>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input" >
                                <label class="col-md-3 control-label" for="form_control_1">所属角色:
                                </label>
                                <div class="col-md-9">
                                    <select name="admin_info[role_id]"  class="form-control selectpicker" data-live-search="true" multiple>
                                        <volist name="role_list" id="vo">
                                            <option value="{pigcms{$vo['role_id']}"  >{pigcms{$vo.role_name}</option>
                                        </volist>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input" >
                                <label class="col-md-3 control-label" for="form_control_1">绑定微信:
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="" name="admin_info[nickname]" placeholder="选填，输入微信昵称即可">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default">清空重填</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</block>
<block name="script">
    <link rel="stylesheet" href="{pigcms{$static_public}css/bootstrap-select.min.css">
    <link href="./static/citypiker/css/city-picker.css" rel="stylesheet" type="text/css" />
    <link href="./static/citypiker/css/main.css" rel="stylesheet" type="text/css" />
    <script src="{pigcms{$static_public}js/bootstrap-select.min.js"></script>
    <script src="/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
    <script src="./static/citypiker/js/city-picker.data.js"></script>
    <script src="./static/citypiker/js/city-picker.js"></script>
    <script>
        /**
         * @author zhukeqin
         * 控制受教育程度其它的显示隐藏
         */
        function education_show() {
            var val=$("select[name='education']").val();
            console.log(val);
            if(val!=0){
                $("input[name='education_remark']").hide();
            }else{
                $("input[name='education_remark']").show();
            }
        }
        /**
         * @author zhukeqin
         * 控制后台账号块显示隐藏
         */
        function admin_info() {
            var val=$("select[name='admin_get']").val();
            console.log(val);
            if(val==2){
                $('#admin_list').show();
                $('#admin_info').hide();
            }else if(val==3){
                $('#admin_info').show();
                $('#admin_list').hide();
            }else{
                $('#admin_info').hide();
                $('#admin_list').hide();
            }
        }
        //初始化
        admin_info();
        $.datetimepicker.setLocale('ch');
        $('.datetimepicker').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d')}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false,      //关闭鼠标滚轮事件
            scrollTime:false,
            scrollInput:false
        });
        //微信昵称自动填充
        $("input[name='admin_info[nickname]']").autocompleter({
            source: "{pigcms{:U('House/ajax_to_autocomplete')}",
            autoFocus: true
        });
        /*$(".city_picker").click(function () {
            $(this).citypicker();
            $(this).citypicker();
        });*/
        /*$(".city_picker").blur(function(){
            $(this).citypicker('destroy');
        });*/
            $('.selectpicker').selectpicker({size:10});
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
</block>