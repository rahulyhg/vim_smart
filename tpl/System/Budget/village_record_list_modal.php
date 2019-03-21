<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
    <style type="text/css">
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
            border: 1px solid #dddddd;
        }
    </style>
</block>
<block name="modal_body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="10%">预算名称</th>
            <th width="5%">预算金额</th>
            <th width="5%">时间</th>
            <th width="10%">所属项目</th>
            <th width="10%">所属公司</th>
            <th width="10%">备注</th>
            <th width="10%">支付凭证</th>
            <th width="10%">状态</th>
            <th width="10%">审核时间</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="record_list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.record_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_money}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_time}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.company_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_remark}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.record_number}</td>
            <td><div class="tagDiv">{pigcms{$vo.record_status_name}</div></td>
            <td>
                <div class="tagDiv">
                    <if condition="$vo['record_status'] neq 1">
                        {pigcms{$vo['record_check_name']}<br/>
                        {pigcms{:date('Y-m-d H:i:s',$vo['record_check_time'])}
                    </if>
                </div>
            </td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                        <li>

                        </li>

                    </ul>
                </div>
            </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>
<block name="modal_script">

</block>