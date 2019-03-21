<extend name="./tpl/System/Public_news/base.php"/>
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('room_property_uptown_updata',array('id'=>$thisRoom['id']))}">
            <button id="sample_editable_1_new" class="btn sbold green">线下物业缴费
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-left: 1%">
        <a href="{pigcms{:U('room_property_uptown_endtime_updata',array('id'=>$thisRoom['id']))}">
            <button class="btn sbold green">物业费截止日期修改
            </button>
        </a>
    </div>

    <br/>
    <br/>



</block>
<!--引入日历插件样式 -->
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>缴费类型</th>
            <th>缴费业主信息</th>
            <th>操作员信息</th>
            <th>续费月数</th>
            <th>应收金额</th>
            <th>实收金额</th>
            <th>缴费前物业费时间</th>
            <th>缴费后物业费时间</th>
            <th>订单状态</th>
            <th>缴费成功时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <volist name="property_list" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.type_str}</td>
                <td>{pigcms{$row.user_name}{pigcms{$row.user_phone}</td>
                <td>{pigcms{$row.admin_name}</td>
                <td>{pigcms{$row.mouth}</td>
                <td>{pigcms{$row.pay_receive}</td>
                <td>{pigcms{$row.pay_true}</td>
                <td>{pigcms{$row.last_endtime_str}</td>
                <td>{pigcms{$row.new_endtime_str}</td>
                <td>{pigcms{$row.status_str}</td>
                <td>{pigcms{$row.pay_time_str}</td>
                <td>{pigcms{$row.remark}</td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>

<block name="script">
    <!--    设备类型模板-->

</block>
