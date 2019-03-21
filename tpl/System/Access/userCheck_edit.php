<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Access/userCheck_edit')}" frame="true" refresh="true">
    <input type="hidden" name="pigcms_id" value="{pigcms{$userCheck_info['pigcms_id']}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">微信名</th>
            <td><input type="text" class="input fl" name="nickname" value="{pigcms{$userCheck_info['nickname']}" size="40" readonly="readonly"/></td>
        </tr>
		<tr>
            <th width="100">真实姓名</th>
            <td><input type="text" class="input fl" name="name" value="{pigcms{$userCheck_info['name']}" size="40" readonly="readonly"/></td>
        </tr>
		<tr>
            <th width="100">公司名称</th>
            <td><input type="text" class="input fl" name="company_name" value="{pigcms{$userCheck_info['company_name']}" size="40" readonly="readonly"/></td>
        </tr>
		<!--<tr>
            <th width="100">部门</th>
            <td><input type="text" class="input fl" name="department" value="{pigcms{$userCheck_info['department']}" size="40" readonly="readonly"/></td>
        </tr>-->
        <tr>
            <th width="100">证件类型</th>
            <td><if condition="$userCheck_info.card_type eq 1"><input type="text" class="input f1" value="现场审核" readonly="readonly"/></if>
                <if condition="$userCheck_info.card_type eq 2"><input type="text" class="input f1" value="门禁卡" readonly="readonly"/></if>
                <if condition="$userCheck_info.card_type eq 3"><input type="text" class="input f1" value="身份证" readonly="readonly"/></if>
                <if condition="$userCheck_info.card_type eq 4"><input type="text" class="input f1" value="工作牌" readonly="readonly"/></if>
            </td>
        </tr>

        <if condition="$userCheck_info.card_type neq 1 and $userCheck_info.card_type neq 4 ">
        <tr>
            <th width="100">证件号</th>
            <td><input type="text" class="input fl" name="usernum" value="{pigcms{$userCheck_info['usernum']}" size="40" readonly="readonly"/></td>
        </tr>
        </if>

        <if condition="$userCheck_info.card_type neq 1">
        <tr>
            <th width="100">证件照</th>
            <td>
			<php> $workcard_img=explode('|',$userCheck_info['workcard_img'])</php>
			<volist name="workcard_img" id="img" key="k">
			<img alt="" src="/upload/house/{pigcms{$img}" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
			<!--<img alt="" src="./upload/house/{pigcms{$userCheck_info.workcard_img}"  class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>-->
			</volist>
			</td>
        </tr>
        </if>

        <tr>
            <th width="80">审核结果</th>
            <td>
                <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 1">checked="checked"</if> />&nbsp;&nbsp;审核中</label>
                &nbsp;&nbsp;&nbsp;
                <label><input value="2" name="ac_status" type="radio"  onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 2 || $userCheck_info['ac_status'] eq 4">checked="checked"</if> />&nbsp;&nbsp;通过</label>
                &nbsp;&nbsp;&nbsp;
                <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <if condition="$userCheck_info['ac_status'] eq 3"> checked="checked" </if> />&nbsp;&nbsp;未通过</label>
           </td>
        </tr>
        <tr>
            <th width="100">审核人</th>
            <td><input type="text" class="input fl" name="check_name" value="{pigcms{$userCheck_info['check_name']}" size="40" readonly="readonly"/></td>
        </tr>
        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ag_desc" name="ac_desc" style="width:250px;height:90px;">{pigcms{$userCheck_info['ac_desc']}</textarea></td></tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K){
        kind_editor = K.create("#description",{
            width:'400px',
            height:'400px',
            resizeType : 1,
            allowPreviewEmoticons:false,
            allowImageUpload : true,
            filterMode: true,
            items : [
                'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link'
            ],
            emoticonsPath : './static/emoticons/',
            uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
        });
    });
    $(function(){
        $("#wc_img").imgbox({
            'speedIn'		: 0,
            'speedOut'		: 0,
            'alignment'		: 'center',
            'overlayShow'	: true,
            'allowMultiple'	: false
        });
    });
</script>
<include file="Public:footer"/>
<!--陈琦
   2016.6.8-->