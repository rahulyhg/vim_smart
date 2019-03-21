<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">员工编辑详情页</h4>
</div>
<form action="__SELF__" METHOD="post">
    <input name="id" value="{pigcms{$Think.session.system.id}" type="hidden">
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">资料编辑
                （ <small class="text-danger inline">修改请谨慎</small>
                ）
            </span>
        </div>
        <div class="panel-body">


            <table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>真实姓名</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>手机号</span></td>
                </tr>
                <tr>
                    <td height="50" align="left">
                        <input name="realname" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$admin['realname']}" placeholder="请输入姓名"/></td>
                    <td height="50" align="left"><input name="phone" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$admin['phone']}" placeholder="请输入手机号"/></td>
                </tr>
                <tr>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>E-mail</span></td>
                    <td width="50%" height="40" align="left" style="font-size:14px; font-weight:bold;"><span style="padding-left:5px; font-family:'微软雅黑';"><span style="float:left; color:#FF0000; font-size:14px;">*</span>QQ</span></td>
                </tr>
                <tr>
                    <td height="50" align="left">
                        <input name="email" type="text" style="border:1px #e3e7ea solid;border-radius:6px;height:32px;width:90%;outline:none;padding-left:10px;line-height:32px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$admin['email']}" placeholder="请输入姓名"/></td>
                    <td height="50" align="left"><input name="qq" type="text" style="border:1px #e3e7ea solid;border-radius:6px;line-height:32px;height:32px;width:90%;outline:none;padding-left:10px;padding-right:10px;font-family:'微软雅黑';color:#919191; font-size:14px;" value="{pigcms{$admin['qq']}" placeholder="请输入QQ号"/></td></tr>

            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
    <input type="submit" class="btn btn-primary" value="提交">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
</form>
<script src="./static/js/jquery.min.js"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/admin-edit.js"></script>
<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>

