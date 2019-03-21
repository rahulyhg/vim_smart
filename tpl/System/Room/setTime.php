<include file="Public:header"/>

<form id="myform" method="post" action="{pigcms{:U('Room/setTime')}" frame="true" refresh="true">

    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">

        <tr>

            <th width="80">上月时间设置</th>

            <td><input type="date" class="input fl" name="start_time" size="20"  value="{pigcms{$start_time}" /></td>

        </tr>

        <tr>

            <th width="80">本月时间设置</th>

            <td><input type="date" class="input fl" name="end_time" size="20"  value="{pigcms{$end_time}" /></td>

        </tr>


    </table>

    <div class="btn hidden">

        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />

        <input type="reset" value="取消" class="button" />

    </div>

</form>

<include file="Public:footer"/>