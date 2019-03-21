<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('PropertyService/room_add')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加楼层\房间
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">ID</th>
            <th width="10%">楼层</th>
            <th width="45%">房间号</th>
            <th width="10%">所属社区</th>
            <th width="10%">描述</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="roomsArray" id="vo">
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
            <td><div class="tagDiv">{pigcms{$vo.id}</div></td>
            <td>
                 <span style="color:#FBFCFD;text-overflow:ellipsis;display:block;width:0px;height:0">
                            {pigcms{:sprintf("%04d",$vo['room_name']?:9999)}
                </span>
                {pigcms{$vo.room_name}

            </td>
            <td><div class="tagDiv">{pigcms{$vo.room_number}</div></td>
            <td><div class="shopNameDiv">{pigcms{$vo.village_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.desc}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">

                        <li>
                            <a href="{pigcms{:U('room_update',array('id'=>$vo['id']))}">
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                    </ul>
                </div>
            </td>
            </tr>
        </volist>
        </tbody>
    </table>
</block>




