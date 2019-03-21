<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('Budget/add_type')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的预算类别
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>

</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="type_list">
        <thead>
        <tr>
            <th width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="10%">类型名称</th>
            <th width="5%">类型级别</th>
            <th width="20%">所属公司</th>
            <th width="10%">备注</th>
            <th width="10%">排序值</th>
            <th class="button-column" width="5%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="type_list" id="vo">
            <tr>
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.pigcms_id}-{pigcms{$vo.type_id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.type_name}</div></td>
            <td><div class="tagDiv">一级</div></td>
            <td><div class="tagDiv"><if condition="$vo['type_company_name']">{pigcms{$vo.type_company_name}<else/>全公司通用</if></div></td>
            <td><div class="tagDiv">{pigcms{$vo.type_remark}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.type_sort}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                        <li>
                            <a href="{pigcms{:U('Budget/add_type',array('id'=>$vo['type_id']))}" >
                                <i class="icon-tag"></i> 查看详情 </a>
                        </li>

                    </ul>
                </div>
            </td>
            </tr>
            <volist name="vo['children']" id="vo1">
                <tr>
                    <td>
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" value="{pigcms{$vo1.type_id}" />
                            <span></span>
                        </label>
                    </td>
                    <td><div class="shopNameDiv">|----{pigcms{$vo1.type_name}</div></td>
                    <td><div class="tagDiv" style="color: green;">二级</div></td>
                    <td><div class="tagDiv"><if condition="$vo1['type_company_name']">{pigcms{$vo1.type_company_name}<else/>全公司通用</if></div></td>
                    <td><div class="tagDiv">{pigcms{$vo1.type_remark}</div></td>
                    <td><div class="tagDiv">{pigcms{$vo1.type_sort}</div></td>
                    <td class="button-column">
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                <li>
                                    <a href="{pigcms{:U('Budget/add_type',array('id'=>$vo1['type_id']))}" >
                                        <i class="icon-tag"></i> 查看详情 </a>
                                </li>

                            </ul>
                        </div>
                    </td>

                </tr>
                <volist name="vo1['children']" id="vo2">
                    <tr>
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="{pigcms{$vo2.type_id}" />
                                <span></span>
                            </label>
                        </td>
                        <td><div class="shopNameDiv">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|----{pigcms{$vo2.type_name}</div></td>
                        <td><div class="tagDiv" style="color: red;">三级</div></td>
                        <td><div class="tagDiv"><if condition="$vo2['type_company_name']">{pigcms{$vo2.type_company_name}<else/>全公司通用</if></div></td>
                        <td><div class="tagDiv">{pigcms{$vo2.type_remark}</div></td>
                        <td><div class="tagDiv">{pigcms{$vo2.type_sort}</div></td>
                        <td class="button-column">
                            <div class="btn-group">
                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                                    <li>
                                        <a href="{pigcms{:U('Budget/add_type',array('id'=>$vo2['type_id']))}" >
                                            <i class="icon-tag"></i> 查看详情 </a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                </volist>
            </volist>
        </volist>
        </tbody>
    </table>
</block>
<block name="script">
    <script>
        $("#type_list").DataTable({
            "ordering": false,//禁止排序
            "paging": false // 禁止分页
        });

    </script>
</block>




