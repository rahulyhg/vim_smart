<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">员工编辑详情页</h4>
</div>
<form action="__SELF__" METHOD="post">
    <input type="hidden" name="idVal" value="{pigcms{$department_info['id']}"/>
    <div class="modal-body" style="height: 40rem;overflow-y: scroll">

        <div class="panel panel-default">
            <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">部门编辑
                （ <small class="text-danger inline">修改请谨慎</small>
                ）
            </span>
            </div>
            <div class="panel-body">

                <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover" width="100%">
                    <tr>
                        <th width="100">名称</th>
                        <td><input type="text" name="deptname" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$department_info['deptname']}" size="40" placeholder="请输入部门名称" /></td>
                    </tr>
                    <tr>
                        <th width="80">所属父级部门</th>
                        <td>
                            <div class="mr15">
                                <select name="pid" style="width:95%; border:1px #e3e7ea solid; border-radius:6px; height:32px; line-height:32px; outline:none; color:#919191; font-size:14px; padding-left:10px; font-family:'微软雅黑';">
                                    <if condition="$department_info['pid'] eq 0 AND $department_info['id'] neq 0">
                                        <option selected="selected" value="0">请选择父级名称</option>
                                    </if>
                                    <volist name="department_categorys" id="vo">
                                        <option value="{pigcms{$vo['id']}" <if condition="$department_info['pid'] eq $vo['id']">selected</if> >{pigcms{$vo.name}</option>
                                    </volist>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" name="desc" style="width:250px;height:90px;">{pigcms{$department_info['desc']}</textarea></td></tr>
                </table>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
        <button type="submit" class="btn btn-primary">保存</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
    </div>
</form>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/admin-edit.js"></script>
<script src="./static/js/jquery.min.js"></script>

