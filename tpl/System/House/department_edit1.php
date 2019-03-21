<include file="Public:header"/>
    <form id="myform" method="post" action="{pigcms{:U('House/department_edit')}" frame="true" refresh="true" onSubmit="return checkForm()">
    <input type="hidden" name="idVal" value="{pigcms{$department_info['id']}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">名称</th>
            <td><input type="text" class="input" name="deptname" value="{pigcms{$department_info['deptname']}" size="40" placeholder="请输入部门名称" /></td>
        </tr>
        <tr>
            <th width="80">所属父级部门</th>
            <td>
                <div class="mr15">
                    <select name="pid" class="selectpicker">
						<if condition="$department_info['pid'] eq 0 AND $department_info['id'] neq 0">
							<option selected="selected" value="0">请选择父级名称</option>
						</if>
                        <volist name="department_categorys" id="vo">
                            <option value="{pigcms{$vo['id']}" <if condition="$department_info['pid'] eq $vo['id']">selected</if> >{pigcms{$vo.count}{pigcms{$vo.deptname}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th width="80">所属项目(非必选)</th>
            <td>
                <div class="mr15">
                    <select name="village_id" class="selectpicker">
                        <option selected="selected" value="0">请选择所属项目</option>
                        <volist name="village_list" id="vo">
                            <option value="{pigcms{$vo['village_id']}" <if condition="$department_info['village_id'] eq $vo['village_id']">selected</if> >{pigcms{$vo.village_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>
        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" name="desc" style="width:250px;height:90px;">{pigcms{$department_info['desc']}</textarea></td></tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
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

   function checkForm(){
        var deptname=$('input[name="deptname"]').val();	//部门名称
        if(deptname=="" || deptname=="null"){
            alert('部门名称不能为空');
            return false;
        }else{
			return true;
		}
    }
	
</script>
<include file="Public:footer"/>