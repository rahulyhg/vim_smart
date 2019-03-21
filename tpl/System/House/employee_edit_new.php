<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
    <link href="./static/citypiker/css/city-picker.css" rel="stylesheet" type="text/css" />
    <link href="./static/citypiker/css/main.css" rel="stylesheet" type="text/css" />
</block>
<block name="modal_body">
    <form action="__SELF__" METHOD="post">
        <input name="idVal" value="{pigcms{$personnel_info['personnel_id']}" type="hidden">
        <table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>姓名：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>身份证号：</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <input name="name" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['name']}" placeholder="请输入真实姓名"/>
                </td>
                <td height="50" align="left">
                    <input name="id_number" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['id_number']}" placeholder="请输入身份证号"/>
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>联系电话：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">工号：</span></td>
            </tr>
            <tr>
                <td height="50" align="left" >
                    <input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['phone']}" placeholder="请输入联系电话"/>
                </td>
                <td height="50" align="left" >
                    <input name="job_number" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['job_number']}" placeholder="请输入工号"/>
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>性别：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>教育程度：</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <select name="sex" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                        <option value="1" <if condition="$personnel_info['sex'] eq 1">selected</if> >男</option>
                        <option value="2" <if condition="$personnel_info['sex'] eq 2">selected</if> >女</option>
                    </select>
                </td>
                <td height="50" align="left">
                    <select name="education" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';" onchange="education_show()">
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
                    <input name="education_remark" placeholder="请填写受教育程度" <if condition="$personnel_info and $personnel_info['education'] neq 0">style="display:none;"</if>/>
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">所属部门</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">年假默认天数</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <select name="department_id" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                        <option  value="0">请选择部门</option>
                        <volist name="department_categorys" id="vo">
                            <option value="{pigcms{$vo['id']}" <if condition="$personnel_info['department_id'] eq $vo['id']">selected</if> >{pigcms{$vo.name}</option>
                        </volist>
                    </select>
                </td>
                <td height="50" align="left">
                    <input name="job_number" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['annual_day']}" placeholder="请输入年假天数（每年年假天数）"/>
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">婚姻状态：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>政治面貌：</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <select name="marital" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                        <option value="1" <if condition="$personnel_info['marital'] eq 1">selected</if> >未婚</option>
                        <option value="2" <if condition="$personnel_info['marital'] eq 2">selected</if> >已婚</option>
                    </select>
                </td>
                <td height="50" align="left">
                    <select name="politics" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                            <option value="1" <if condition="$personnel_info['politics'] eq 1">selected</if> >中共党员</option>
                            <option value="2" <if condition="$personnel_info['politics'] eq 2">selected</if> >中共预备党员</option>
                            <option value="3" <if condition="$personnel_info['politics'] eq 3">selected</if> >共青团员</option>
                            <option value="4" <if condition="$personnel_info['politics'] eq 4">selected</if> >民革党员</option>
                            <option value="5" <if condition="$personnel_info['politics'] eq 5">selected</if> >民盟盟员</option>
                            <option value="6" <if condition="$personnel_info['politics'] eq 6">selected</if> >民建会员</option>
                            <option value="7" <if condition="$personnel_info['politics'] eq 7">selected</if> >民进会员</option>
                            <option value="8" <if condition="$personnel_info['politics'] eq 8">selected</if> >农工党党员</option>
                            <option value="0" <if condition="$personnel_info['politics'] eq 9">selected</if> >致公党党员</option>
                            <option value="0" <if condition="$personnel_info['politics'] eq 10">selected</if> >九三学社社员</option>
                            <option value="0" <if condition="$personnel_info['politics'] eq 11">selected</if> >台盟盟员</option>
                            <option value="0" <if condition="$personnel_info['politics'] eq 12">selected</if> >无党派人士</option>
                            <option value="0" <if condition="$personnel_info['politics'] eq 13">selected</if> >普通居民</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">户口类型：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">户口所在地：</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <select name="marital" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                        <option value="2" <if condition="$personnel_info['marital'] eq 2">selected</if> >城镇居民户口</option>
                        <option value="1" <if condition="$personnel_info['marital'] eq 1">selected</if> >农村户口</option>
                    </select>
                </td>
                <td height="50" align="left">
                    <input id="hukou_address"  class="form-control city_picker" readonly type="text" value="{pigcms{$personnel_info['hukou_address']}" data-toggle="city-picker">
                </td>
            </tr>
            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">籍贯：</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">入职时间：</span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <input id="native_place" class="form-control" readonly type="text" value="{pigcms{$personnel_info['native_place']}" data-toggle="city-picker">
                </td>
                <td height="50" align="left">
                    <input id="datetimepicker1" class="form-control" type="text" value="{pigcms{:date('Y-m-d',$personnel_info['hiredate'])}" data-toggle="city-picker">
                </td>
            </tr>

            <tr>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">是否需要后台账号</span></td>
                <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"></span></td>
            </tr>
            <tr>
                <td height="50" align="left">
                    <select name="admin_get"  style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';" onchange="admin_info()">
                        <option value="1" <if condition="!$personnel_info['admin_info']">selected</if> >不需要</option>
                        <option value="2" <if condition="$personnel_info['admin_info']">selected</if> >需要</option>
                    </select>
                </td>
                <td height="50" align="left">

                </td>
            </tr>
                    <tr class="admin_info">
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>用户名：</span></td>
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>密码：</span></td>
                    </tr>
                    <tr class="admin_info">
                        <td height="50" align="left">
                            <input name="admin_info[account]" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$personnel_info['admin_info']['account']}" placeholder="请输入用户名"/>
                        </td>
                        <td height="50" align="left"><input name="admin_info[pwd]" type="password" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="" placeholder="请输入密码"/></td>
                    </tr>
                    <tr class="admin_info">
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属社区：</span></td>
                        <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定微信：</span></td>
                    </tr>
                    <tr class="admin_info">
                        <td height="50" align="left" id="village">
                            <select name="admin_info[village_id]"  style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';" id="village_id">
                                <option selected="selected" value="0">请选择社区</option>
                                <volist name="village_list" id="vo">
                                    <option value="{pigcms{$vo['village_id']}" <if condition="$personnel_info['admin_info']['village_id'] eq $vo['village_id'] ">selected</if> >{pigcms{$vo.village_name}</option>
                                </volist>
                            </select>
                        </td>
                        <td height="50" align="left">
                            <input type="text" class="input condition" name="admin_info[nickname]" value="{pigcms{$personnel_info['admin_info']['nickname']}" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" placeholder="请输入微信昵称"/>
                        </td>
                    </tr>

        </table>
</block>
<block name="modal_script">
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
            if(val){
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
                $('.admin_info').show();
            }else{
                $('.admin_info').hide();
            }
        }
        //初始化
        admin_info();
        $.datetimepicker.setLocale('ch');
        $('#datetimepicker1').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d')}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false      //关闭鼠标滚轮事件
        });
        //微信昵称自动填充
        $("input[name='nickname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true
        });
        $('#hukou_address').citypicker();
        $('#native_place').citypicker();
    </script>
</block>