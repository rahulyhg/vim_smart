<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">员工编辑详情页</h4>
</div>
<form action="__SELF__" METHOD="post">
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">员工编辑
                （ <small class="text-danger inline">修改请谨慎</small>
                ）
            </span>
        </div>
        <div class="panel-body">

            <table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>用户名：</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>密码：</span></td>
                </tr>
                <tr>
                    <td height="50" align="left">
                        <input name="account" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['account']}" placeholder="请输入用户名"/></td>
                    <td height="50" align="left"><input name="pwd" type="password" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="" placeholder="请输入密码"/></td>
                </tr>
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>所属社区：</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定公司：</span></td>



                </tr>
                <tr>
                    <td height="50" align="left" id="village">
                        <select name="village_id"  style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';" id="village_id">
                            <option selected="selected" value="0">请选择社区</option>
                            <volist name="village_list" id="vo">
                                <option value="{pigcms{$vo['village_id']}" <if condition="$user_info['village_id'] eq $vo['village_id'] ">selected</if> >{pigcms{$vo.village_name}</option>
                            </volist>
                        </select></td>

                    <td height="50" align="left">
                        <select name="company_id" id="company_id" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
                            <option selected="selected" value="0">请选择公司</option>
                            <volist name="company_list" id="vo">
                                <option value="{pigcms{$vo['company_id']}" <if condition="$user_info['company_id'] eq $vo['company_id']">selected</if> >{pigcms{$vo.company_name}</option>
                            </volist>
                        </select>
                    </td>




                </tr>
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>姓名/公司名称：</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号：</span></td>
                    <!--						<td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号：</span></td>-->

                </tr>
                <tr>
                    <td height="50" align="left"><input name="realname" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['realname']}" placeholder="请输入姓名/公司名称"/></td>
                    <td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['phone']}" placeholder="请输入手机号码"/></td>
                    <!--						<td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;width:90%;outline:none; padding-left:10px; padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$user_info['phone']}" placeholder="请输入手机号"/></td>-->

                </tr>
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';">绑定微信：</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>部门：</span></td>
                </tr>
                <tr>
                    <td height="50" align="left">
                        <input type="text" class="input condition" name="nickname" value="" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" placeholder="请输入微信昵称"/>
                    </td>
                    <td height="50" align="left">
                        <select name="department_id" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                            <option selected="selected" value="0">请选择部门</option>
                            <volist name="department_categorys" id="vo">
                                <option value="{pigcms{$vo['id']}" <if condition="$user_info['department_id'] eq $vo['id']">selected</if> >{pigcms{$vo.name}</option>
                            </volist>
                        </select></td>
                </tr>
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>商户：</span></td>
                </tr>
                <tr>
                    <td height="50" align="left">
                        <select name="mer_id"  style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';" id="mer_id">
                            <option selected="selected" value="0">请选择商户</option>
                            <volist name="merchant_list" id="vo">
                                <option value="{pigcms{$vo['mer_id']}" <if condition="$user_info['mer_id'] eq $vo['mer_id']">selected</if> >{pigcms{$vo.name}</option>
                            </volist>
                        </select>
                    </td>
                </tr>

                <tr class="bind_tenant">
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>绑定入住单位：</span></td>
                </tr>
                <tr class="bind_tenant">
                    <td height="50" align="left">
                        <select name="tid" style="width:95%;border:1px #e3e7ea solid;border-radius:6px;height:32px;line-height:32px;outline:none;color:#919191; font-size:14px;padding-left:10px;font-family:'微软雅黑';">
                            <option value="0">绑定入住单位</option>
                            <volist name="tenant_array" id="row">
                                <option value="{pigcms{$row.pigcms_id}">{pigcms{$row.tenantname}</option>
                            </volist>
                        </select>
                    </td>
                </tr>

            </table>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="role_id">角色
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <volist name="role_list" id="v">
                        <div style="margin: 5px;width: 10px;font-size: 14px;display: inline-block;" class="ccc">
                            <input type="checkbox"  name="role_id[]" id="role_id_{pigcms{$v.role_id}"  value="{pigcms{$v.role_id}" />
                            <label for="role_id_{pigcms{$v.role_id}">{pigcms{$v.role_name}</label>
                        </div>
                    </volist>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
    <button type="submit" class="btn btn-primary">保存</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
</form>
<script src="./static/js/jquery.min.js"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/admin-edit.js"></script>
<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>
<script>
    $(function(){
        $("input[name='nickname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true
        });

        $("input[name='realname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete_name')}",
            autoFocus: true
        });

        $("input[name='phone']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete_phone')}",
            autoFocus: true
        });
    });

    $("input[name='nickname']").autocompleter({
        source: "{pigcms{:U('ajax_to_autocomplete')}",
        autoFocus: true
    });

    //绑定入住单位
    $('.bind_tenant').hide();

    $(".ccc").click(function(){
        if ($("#role_id_19").is(":checked")) {
            $('.bind_tenant').show();
        } else {
            $('.bind_tenant').hide();
        }
    })


</script>

