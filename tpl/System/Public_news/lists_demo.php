<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
<!--    <div class="btn-group">-->
<!--        <a href="">-->
<!--            <button id="sample_editable_1_new" class="btn sbold green">-->
<!--            </button>-->
<!--        </a>-->
<!--    </div>-->
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
        </tr>
        </thead>
        <tbody>

        <volist name="list" id="vo">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>
