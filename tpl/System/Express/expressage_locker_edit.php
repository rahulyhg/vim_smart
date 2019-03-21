<include file="Public:header"/>
<form id="myform" method="post" action="{pigcms{:U('Express/expressage_locker_edit')}" frame="true" refresh="true">

    <input type="hidden" name="id" value="{pigcms{$info['id']}"/>

    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <if condition="$id neq 0">
        <tr style="display: none;">

            <th width="80">ID</th>
            <td><input name="id" value="{pigcms{$id}" type="text" /></td>
        </tr>
        </if>
        <if condition="$company_id neq 0">
        <tr style="display: none;">
            <th width="80">company_id</th>
            <td><input name="company_id" value="{pigcms{$company_id}" type="text" /></td>
        </tr>
        </if>
        <tr>
            <th width="80">所属大厦</th>
            <td><select name="village_id">
                    <foreach name="village_info" item="village">
                        <option value="{pigcms{$village['village_id']}" <if condition="$info['village_id'] eq $village['village_id']">selected='selected'</if> >{pigcms{$village['village_name']}</option>
                    </foreach>
                </select></td>
        </tr>

        <tr>

            <th width="80">货架编号</th>

            <td><input type="text" class="input fl" name="expressage_locker_id" size="20" placeholder="请输入编号,必填" value="{pigcms{$info['expressage_locker_id']}" validate="maxlength:6,required:true,number:true" /></td>

        </tr>

        <tr>

            <th width="80">货架层数</th>

            <td><input type="text" class="input fl" name="expressage_locker_count" size="30" placeholder="请输入货架层数，必填" value="{pigcms{$info['expressage_locker_count']}" validate="maxlength:6,required:true,number:true"/></td>

        </tr>


        <tr>

            <th width="80">状态</th>

            <td class="radio_box">

                <span class="cb-enable"><label class="cb-enable <if condition="$info['status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="status" value="1" <if condition="$express['status'] eq 1">checked="checked"</if> /></label></span>

                <span class="cb-disable"><label class="cb-disable <if condition="$info['status'] eq 0">selected</if>"><span>关闭</span><input type="radio" name="status" value="0" <if condition="$express['status'] eq 0">checked="checked"</if> /></label></span>

            </td>

        </tr>

    </table>

    <div class="btn hidden">

        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />

        <input type="reset" value="取消" class="button" />

    </div>

</form>

<include file="Public:footer"/>