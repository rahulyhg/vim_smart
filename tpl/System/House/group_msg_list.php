<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('add_group_msg')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加消息
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('wxmsg_log_list_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">群发消息记录
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th> 编号 </th>
            <th> 标题 </th>
            <th> 通知类型</th>
            <th> 所属社区</th>
            <th> 通知公司</th>
            <th> 状态</th>
            <th> 通知时间</th>
            <th> 操作</th>
        </tr>
        </thead>
        <tbody>
        <foreach name="list" item="v">
            <tr class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$v.id} </td>
                <td>{pigcms{$v.title}</td>
                <td>{pigcms{$v.msg_type_name}/{pigcms{$v.send_type_name}</td>
                <td>{pigcms{$v["village_name"]?$v["village_name"]:"所有社区"}</td>
                <td>{pigcms{$v["company_name"]?$v["company_name"]:"所有公司"}</td>
                <td>{pigcms{$v.status_name}</td>
                <td>
                    <if condition="$v['send_time']">{pigcms{$v.send_time|date="Y-m-d H:i",###}
                        <else />未发送
                    </if>
                </td>


                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href = "{pigcms{:U('audit_group_msg',array('msg_id'=>$v['id']))}"
                                   data-toggle="modal"
                                   data-target="#modal_{pigcms{$v.id}"
                                ><i class="icon-docs"></i> 详情 </a>

                            </li>
                            <li>
                                <a href = "{pigcms{:U('add_group_msg',array('msg_id'=>$v['id']))}"><i class="icon-docs"></i> 编辑 </a>
                            </li>
                            <li>
                                <a class="del" href = "{pigcms{:U('del_group_msg',array('msg_id'=>$v['id']))}"><i class="icon-docs"></i> 删除 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_<?php echo $v['id']?>">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </tr>
        </foreach>
        </tbody>
    </table>
</block>