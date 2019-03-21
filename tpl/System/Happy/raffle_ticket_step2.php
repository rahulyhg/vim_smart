<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3')}">
            <button id="sample_editable_1_new" class="btn sbold green">打印全部（执行不能太卡了）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>0,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（1-150）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>150,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（151-300）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>300,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（301-450）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>450,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（451-600）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>600,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（601-750）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>750,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（751-900）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>900,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（901-1050）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>1050,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（1051-1200）
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a target="_blank"  href="{pigcms{:U('raffle_ticket_step3',array('offset'=>1200,'length'=>150))}">
            <button id="sample_editable_1_new" class="btn sbold green">打印（1201-1350）
            </button>
        </a>
    </div>
</block>
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
            <foreach name="data.title" item="field_name">
                <th>{pigcms{$field_name}</th>
            </foreach>

        </tr>
        </thead>
        <tbody>

            <volist name="data.body" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.ticket_no}</td>
                <td>{pigcms{$row.company}</td>
                <td>{pigcms{$row.section}</td>
                <td>{pigcms{$row.project}</td>
                <td>{pigcms{$row.name}</td>
            </tr>
            </volist>
        </tbody>
    </table>
</block>