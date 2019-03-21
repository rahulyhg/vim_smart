<extend name="./tpl/System/Public_news/base_full.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('tenantlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">返回
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list',array('meter_type_id'=>1))}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">水费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list',array('meter_type_id'=>5))}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">电费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('property_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">物业费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('other_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn btn-lg active sbold green">其他费用
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list2')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">分类查看
            </button>
        </a>
    </div>
    <div class="btn-group">
        <form action="" method="post">
            <select name="ym" id="ym" class="form-control">
                <option value="0">选择月份</option>
                <for start="1" end="13">
                    <option value="{pigcms{$i}" {pigcms{$month==$i?"selected='selected'":""}>{pigcms{$i}月</option>
                </for>
            </select>
        </form>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('out_account_list',array('meter_type_id'=>5))}">
            <button id="sample_editable_1_new" class="btn sbold green">导出
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
            <th>单元号</th>
            <th>入住单位（客户名称）</th>
            <th>业主</th>
            <th>其他费用</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
            <tr style="background-color: #F3F4F6">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>
                    <div>
                        <!--/排序需要-->
                        <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{:sprintf("%04d",$vo['room_names']?:9999)}
                        </span>
                        <!--排序需要-->
                        {pigcms{$vo.room_names}
                    </div>
                </td>
                <td>{pigcms{$vo.tenantname}</td>
                <td>
                    {pigcms{:str_replace(',',"<br >",$vo['ownernames'])}
                </td>
                <td>
                    {pigcms{:number_format($vo['use_other'],2)}
                </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>


<block name="script">
    <script>
        $(document).ready(function () {
            $('#ym').change(function(){
                var y = "{pigcms{:date('Y')}";
                var m = $(this).val();
                var ym = y+'-'+pad(m,2);
                window.location.href = app.U("",{ym:ym});

            });

            //补0函数
            function pad(num, n) {
                if ((num + "").length >= n) return num;
                return pad("0" + num, n);
            }

        });

    </script>

</block>