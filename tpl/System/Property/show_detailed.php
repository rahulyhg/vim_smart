<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <button id="sample_editable_1_new" class="btn sbold green">当前房间门牌号: {pigcms{$data['room_name']}
        </button>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">业主姓名</th>
            <th width="10%">起码</th>
            <th width="10%">止码</th>
            <th width="10%">单价</th>
            <th width="10%">起始月份</th>
            <th width="10%">结束月份</th>
            <th width="10%">类型</th>
            <th width="25%">缴费状态</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="info" id="vo">
            <td><div class="tagDiv">{pigcms{$vo.owner_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.start_code}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.end_code}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.price}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.start_time}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.end_time}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.type}</div></td>
            <td><div class="tagDiv"><if condition="$vo['result'] eq 0">未缴费<else/>已缴费</if></div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                        <li>
                            <a href="{pigcms{:U('delete_water',array('id'=>$vo['id']))}" >
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




