<include file="Public:header"/>

<form id="myform" method="post" action="{pigcms{:U('House/company_edit')}" frame="true" refresh="true">
    <input type="hidden" name="company_id" value="{pigcms{$company_info.company_id}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">公司名称</th>
            <td><input type="text" class="input fl" name="company_name"  value="{pigcms{$company_info['company_name']}" size="40" placeholder="请输入公司名称" validate="maxlength:20,required:true"/></td>
        </tr>
		<tr>
            <th width="100">名称首字母</th>
            <td><input type="text" class="input" name="company_first"  value="{pigcms{$company_info['company_first']}" size="40" placeholder="请输入公司首字母" validate="maxlength:20,required:true"/></td>
        </tr>
        <tr>
            <th width="80">所属社区</th>
            <td>
                <div class="mr15 l">
                    <select name="village_id" id="pid">
                        <option selected="selected" value="0">请选择社区</option>
                        <volist id="village" name="village_categorys">
                        <option  value='{pigcms{$village.village_id}' <if condition="$company_info['village_id'] eq $village['village_id']" >selected</if> >{pigcms{$village.village_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th width="100">联系方式</th>
            <td><input type="text" class="input fl" name="company_phone" value="{pigcms{$company_info['company_phone']}" size="40" placeholder="请输入联系方式" /></td>
        </tr>
		<tr>
			<th width="100">是否管理员审核</th>
			<td class="radio_box">
				<span class="cb-enable"><label class="cb-enable <if condition="$company_info['is_admin'] eq 1 || $company_info['is_admin'] eq 0">selected</if>"><span>否</span><input type="radio" name="is_admin" value="1" <if condition="$company_info['is_admin'] eq 1 || $company_info['is_admin'] eq 0">checked="checked"</if>/></label></span>	
				<span class="cb-disable"><label class="cb-disable <if condition="$company_info['is_admin'] eq 2">selected</if>"><span>是</span><input type="radio" name="is_admin" value="2" <if condition="$company_info['is_admin'] eq 2">checked="checked"</if>/></label></span>			
			</td>
		</tr>
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