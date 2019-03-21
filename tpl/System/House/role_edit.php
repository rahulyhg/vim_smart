<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('House/role_edit')}" frame="true" refresh="true" >
    <input type="hidden" name="role_id" value="{pigcms{$role_info['role_id']}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">角色名称</th>
            <td><input type="text" class="input fl" name="role_name" value="{pigcms{$role_info['role_name']}" size="40" placeholder="请输入角色名称" /></td>
        </tr>
        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="desc" name="role_desc" style="width:250px;height:90px;">{pigcms{$role_info['role_desc']}</textarea></td></tr>
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
</script>
<include file="Public:footer"/>