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
    <div class="panel-heading">
        <a style="float: right" class="btn btn-primary" href="{pigcms{:U('Personnel/personnel_annual_edit',array('personnel_id'=>$personnel_id))}"
           type="button" data-toggle="modal" data-target="#common_modal">
            新增年假记录
        </a>
        <div style="clear: both"></div>
    </div>
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <!--<th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>-->
            <th width="10%">年假使用天数</th>
            <th width="10%">年假使用后剩余</th>
            <th width="10%">上次年假剩余</th>
            <th width="10%">使用时间</th>
            <th width="10%">备注</th>
        </tr>
        </thead>
        <tbody>
        <volist name="personnel_annual_list" id="vo">
            <tr>
            <!--<td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>-->
            <td><div class="shopNameDiv" style="color: red;">{pigcms{$vo.annual_use}天</div></td>
            <td><div class="tagDiv" style="color: red;">剩余{pigcms{$vo.annual_residue}天</div></td>
            <td><div class="tagDiv">{pigcms{$vo.annual_residue_last}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y-m-d H:i:s',$vo['updatetime'])}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>
<block name="modal_script">
    <script>
        $("#common_modal").on("hidden", function() {
            $(this).removeData("modal");
        });
    </script>
</block>