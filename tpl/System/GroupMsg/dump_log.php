<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('save_group_msg')}">
            <button id="sample_editable_1_new" class="btn sbold green">
                添加消息
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="head"></block>
<block name="script"></block>
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
            <th> id </th>
            <th> 内容 </th>
            <th> 时间 </th>
            <th> 控制器</th>
            <th> 行</th>
        </tr>
        </thead>
        <tbody>

        <volist name="list" id="v">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$v.id}</td>
                <td><php>dump($v['content'])</php></td>
                <td>{pigcms{$v.create_time}</td>
                <td>{pigcms{$v.action} {pigcms{$v.status_name2}</td>
                <td>{pigcms{$v.line}/{pigcms{$v.send_type_name}</td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>
