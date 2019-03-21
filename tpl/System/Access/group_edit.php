<include file="Public:header"/>

<form id="myform" method="post" action="{pigcms{:U('Access/group_edit')}" frame="true" refresh="true">

    <input type="hidden" name="ag_id" value="{pigcms{$group_info['ag_id']}"/>

    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">

        <tr>
            <th width="100">区域名称</th>
            <td><input type="text" class="input fl" name="ag_name" value="{pigcms{$group_info['ag_name']}" size="40" placeholder="请输入区域名称" /></td>
        </tr>

        <tr>
            <th width="80">所属社区</th>
            <td>
                <div class="mr15 l">
                    <select name="village_id" id="pid">
                        <option selected="selected" value="0">请选择社区</option>
w                        <volist id="village" name="village_categorys">
                            <option  value='{pigcms{$village.village_id}' <if condition="$group_info['village_id'] eq $village['village_id']" >selected</if> >{pigcms{$village.village_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>

        <tr><th width="80">描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ag_desc" name="ag_desc" style="width:250px;height:90px;">{pigcms{$group_info['ag_desc']}</textarea></td></tr>

    </table>

    <div class="btn hidden">

        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />

        <input type="reset" value="取消" class="button" />

    </div>

</form>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>

<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>

<script>

    function addLink(domid,iskeyword){

        art.dialog.data('domid', domid);

        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});

    }

</script>

<include file="Public:footer"/>