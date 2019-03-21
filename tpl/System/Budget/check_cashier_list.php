<extend name="./tpl/System/Public_news/base.php" />

<block name="table-toolbar-left">


</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="5%">出纳名称</th>
            <th width="5%">出纳状态</th>
            <th width="30%">所属项目（影响默认选择）</th>
            <th width="10%">备注</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="cashier_list" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.cashier_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo['account']}</div></td>
            <td>
                <div class="tagDiv">
                    <if condition="$vo['status'] eq 1">
                        <span style="color: green;">开启</span>
                        <else/>
                        <span style="color: red;">关闭</span>
                    </if>
                </div>
            </td>
            <td>
                <div class="tagDiv">
                    <foreach name="vo['village_list_info']" item="vo1">
                        {pigcms{$vo1['village_name']}
                    </foreach>
                </div>
            </td>
            <td>
                <div class="tagDiv">
                        {pigcms{$vo['remark']}
                </div>
            </td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                        <li>
                            <a href="{pigcms{:U('Budget/check_cashier_change',array('cashier_id'=>$vo['cashier_id']))}" >
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
<block name="script">
    <script>

    </script>
</block>




