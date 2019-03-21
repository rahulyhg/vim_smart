<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
            <button id="sample_editable_1_new" class="btn sbold green">当前房间门牌号: {pigcms{$room_info['room_name']}
            </button>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('add_otherfee',array('rid'=>$room_info['id']))}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的缴费
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">缴费类型</th>
            <th width="10%">缴费时间</th>
            <th width="10%">种类</th>
            <th width="10%">缴费方式</th>
            <th width="10%">应收</th>
            <th width="10%">实收</th>
            <th width="10%">已退</th>
            <th width="25%">备注说明</th>
            <th width="10%">缴费对应月份</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="otherfee_list" id="vo">
            <td><div class="tagDiv">{pigcms{$vo.otherfee_type_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.fee_time}</div></td>
            <td><div class="tagDiv"><if condition="$vo['otherfee_type'] eq 1">缴费<else/>押金</if></div></td>
            <td><div class="tagDiv"><if condition="$vo['type'] eq 1">线上支付<elseif condition="$vo['type'] eq 2" />现金<elseif condition="$vo['type'] eq 3"/>转账<elseif condition="$vo['type'] eq 4"/>POS单<elseif condition="$vo['type'] eq 5"/>现金缴款单</if></div></td>
            <td><div class="tagDiv"><if condition="$vo['otherfee_type'] eq 1">{pigcms{$vo.fee_receive}</if></div></td>
            <td><div class="tagDiv"><if condition="$vo['otherfee_type'] eq 1">{pigcms{$vo.fee_true}<else/>{pigcms{$vo.fee_receive}</if></div></td>
            <td><div class="tagDiv"><if condition="$vo['otherfee_type'] neq 1">{pigcms{$vo.fee_true}</if></div></td>
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.fee_mouth}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('delete_otherfee',array('rid'=>$room_info['id'],'otherfee_id'=>$vo['otherfee_id']))}" >
                                    <i class="icon-tag"></i><span style="color: green"> 删除 </span></a>
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




