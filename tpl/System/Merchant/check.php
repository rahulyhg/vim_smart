<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Merchant/check')}" frame="true" refresh="true">
    <input type="hidden" name="id" value="{pigcms{$info.id}"/>
    <input type="hidden" name="mer_id" value="{pigcms{$info.mer_id}"/>
    <input type="hidden" name="tc_money" value="{pigcms{$info.tc_money}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="80">商户名</th>
            <td><div class="show">{pigcms{$info.mc_name}</div></td>
        </tr>
        <tr>
            <th width="80">提现金额</th>
            <td><div class="show">{pigcms{$info.tc_money}</div></td>
        <tr>
            <th width="80">申请时间</th>
            <td><div class="show">{pigcms{$info.sub_time|date='Y-m-d H:i:s',###}</div></td>
        <tr>
            <th width="80">联系电话</th>
            <td><div class="show">{pigcms{$info.contact_num}</div></td>
        <tr>
            <th width="80">银行卡号</th>
            <td><div class="show">{pigcms{$info.bank_num}</div></td>
        <tr>
            <th width="80">所属银行</th>
            <td><div class="show">{pigcms{$info.bank}</div></td>
        <tr>
            <th width="80">申请状态</th>
            <td>
                <input type="radio" name="status" value="0" <if condition="$info['status'] eq 0">checked="checked"</if> />待处理
                <input type="radio" name="status" value="1" <if condition="$info['status'] eq 1">checked="checked"</if>/>审核中
                <input type="radio" name="status" value="2" <if condition="$info['status'] eq 2">checked="checked"</if>/>审核通过
                <input type="radio" name="status" value="3" <if condition="$info['status'] eq 3">checked="checked"</if>/>审核不通过
            </td>
        </tr>
        <tr>
            <th width="80">审核说明</th>
            <td>
                <textarea type="text" cols="50" rows="5" name="remark" value="">{pigcms{$info.remark}</textarea>
            </td>
        </tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script type="text/javascript">

</script>
<include file="Public:footer"/>