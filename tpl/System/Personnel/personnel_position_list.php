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
        <a style="float: right" class="btn btn-primary" href="{pigcms{:U('Personnel/personnel_position_edit',array('personnel_id'=>$personnel_id))}"
           type="button" data-toggle="modal" data-target="#common_modal">
            新增职位变动
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
            <th width="10%">原职位</th>
            <th width="10%">现任职位</th>
            <th width="10%">职位变动时间</th>
            <th width="10%">更新时间</th>
            <th width="10%">职位变动原因</th>
            <th width="10%">备注</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="position_list" id="vo">
            <!--<td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>-->
            <td><div class="tagDiv">{pigcms{$vo.position_last}</div></td>
            <td><div class="tagDiv" style="color: red">{pigcms{$vo.position_now}</div></td>
            <td><div class="shopNameDiv" style="color: red;">{pigcms{:date('Y-m-d',$vo['time_change'])}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y-m-d',$vo['time_updatetime'])}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.because}</div></td>
            
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                        <li>
                            <a data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('Personnel/personnel_position_edit',array('position'=>$vo['personnel_position_id']))}" >
                                <i class="icon-tag"></i> 查看详情 </a>
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
    <script>
        $("#common_modal").on("hidden", function() {
            $(this).removeData("modal");
        });
    </script>
</block>