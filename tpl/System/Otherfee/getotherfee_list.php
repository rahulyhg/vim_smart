<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('add_otherfee_type')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的类目
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="5%">表格顺序</th>
            <th width="10%">物业收费名称</th>
            <th width="20%">类型</th>
            <th width="20%">状态</th>
            <th width="25%">备注说明</th>
            <th width="10%">上一次修改时间</th>
            <th width="10%">创建时间</th>
            <th class="button-column" width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="type_list" id="vo">
            <td><div class="shopNameDiv">{pigcms{$vo.rank}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.otherfee_type_name}</div></td>
            <td><div class="tagDiv"><if condition="$vo['type'] eq 1">缴费<else/>押金</if></div></td>
            <td><div class="tagDiv"><if condition="$vo['status'] eq 1"><span style="color: green">显示</span><else/><span style="color: red">隐藏</span></if></div></td>
            <td><div class="tagDiv">{pigcms{$vo.remark}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y年m月d日 h时i分s秒',$vo['updatetime'])}</div></td>
            <td><div class="tagDiv">{pigcms{:date('Y年m月d日 h时i分s秒',$vo['createtime'])}</div></td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="{pigcms{:U('add_otherfee_type',array('otherfee_type_id'=>$vo['otherfee_type_id']))}" >
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                        <if condition="$vo['status'] eq 0">
                            <li>
                                <a href="{pigcms{:U('delete_otherfee_type',array('otherfee_type_id'=>$vo['otherfee_type_id'],'status'=>1))}" >
                                    <i class="icon-tag"></i><span style="color: green"> 显示 </span></a>
                            </li>
                            <else/>
                            <li>
                                <a href="{pigcms{:U('delete_otherfee_type',array('otherfee_type_id'=>$vo['otherfee_type_id'],'status'=>0))}" >
                                    <i class="icon-tag"></i><span style="color: red"> 隐藏 </span></a>
                            </li>
                        </if>
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




