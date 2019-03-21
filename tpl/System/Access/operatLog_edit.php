<include file="Public:header"/>
    <form id="myform" method="" action="">
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">用户</th>
            <td><input type="text" class="input fl" name="name" readonly="readonly" value="{pigcms{$log_info['name']}" size="40" placeholder=""/></td>
        </tr>
        <tr>
            <th width="100">证件类型</th>
            <td><if condition="$log_info.card_type eq 1"><input type="text" class="input f1" value="现场审核" readonly="readonly"/></if>
                <if condition="$log_info.card_type eq 2"><input type="text" class="input f1" value="门禁卡" readonly="readonly"/></if>
                <if condition="$log_info.card_type eq 3"><input type="text" class="input f1" value="身份证" readonly="readonly"/></if>
                <if condition="$log_info.card_type eq 4"><input type="text" class="input f1" value="工作牌" readonly="readonly"/></if>
            </td>
        </tr>

        <if condition="$log_info.card_type neq 1 and $log_info.card_type neq 4 ">
        <tr>
            <th width="80">证件号</th>
            <td>
                <input type="text" class="input fl" name="usernum" readonly="readonly"  value="{pigcms{$log_info['usernum']}" size="40" placeholder=""/>
            </td>
        </tr>
        </if>

        <if condition="$log_info.card_type neq 1">
            <tr>
                <th width="100">证件照</th>
                <td>
                    <php> $workcard_img=explode('|',$log_info['workcard_img'])</php>
                    <volist name="workcard_img" id="img" key="k">
                        <img alt="" src="/upload/house/{pigcms{$img}" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
                        <!--<img alt="" src="./upload/house/{pigcms{$userCheck_info.workcard_img}"  class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>-->
                    </volist>
                </td>
            </tr>
        </if>

        <tr>
            <th width="100">时间</th>
            <td><input type="text" class="input fl" name="opdate" size="40" readonly="readonly" value="{pigcms{$log_info['opdate']|date='Y-m-d H:i:s',###}"/></td>
        </tr>
        <tr>
            <th width="100">设备名称</th>
            <td><input type="text" class="input fl" name="ac_name" size="40" readonly="readonly" value="{pigcms{$log_info['ac_name']}"/></td>
        </tr>
        <tr>
            <th width="100">所属区域</th>
            <td><input type="text" class="input fl" name="ag_name" size="40" readonly="readonly" value="{pigcms{$log_info['ag_name']}"/></td>
        </tr>
        <tr>
            <th width="100">所属社区</th>
            <td><input type="text" class="input fl" name="village_name" readonly="readonly" size="40" value="{pigcms{$log_info['village_name']}"/></td>
        </tr>
        <tr>
            <th width="100">所属公司</th>
            <td><input type="text" class="input fl" name="company" size="40" readonly="readonly" value="{pigcms{$log_info['company_name']}"/></td>
        </tr>      
    </table>
    <!--<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="返回" class="button" />
    </div>-->
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
    /*function addLink(domid,iskeyword){
        art.dialog.data('domid', domid);
        art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
    }*/
</script>
<include file="Public:footer"/>