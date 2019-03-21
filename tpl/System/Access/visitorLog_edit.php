<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Access/visitorLog_edit')}" frame="true" refresh="true">
    <input type="hidden" name="pigcms_id" value="{pigcms{$visitorLog_info['pigcms_id']}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">微信名</th>
            <td><input type="text" class="input fl" name="nickname" value="{pigcms{$visitorLog_info['nickname']}" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">真实姓名</th>
            <td><input type="text" class="input fl" name="name" value="{pigcms{$visitorLog_info['name']}" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">手机号码</th>
            <td><input type="text" class="input fl" name="phone" value="{pigcms{$visitorLog_info['phone']}" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">身份证</th>
            <td><input type="text" class="input fl" name="id_card" value="{pigcms{$visitorLog_info['id_card']}" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">公司名称</th>
            <td><input type="text" class="input fl" name="company" value="{pigcms{$visitorLog_info['company']}" size="40" readonly="readonly"/></td>
        </tr>

        <tr>
            <th width="100">登记时间</th>
            <td><input type="text" class="input fl" name="add_time" value="{pigcms{$visitorLog_info['add_time|date='Y-m-d H:i:s',###']}" size="40" readonly="readonly"/></td>
        </tr>


    </table>
    <!--<div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>-->
</form>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<include file="Public:footer"/>
<!--陈琦 访客信息详情
   2016.8.18-->