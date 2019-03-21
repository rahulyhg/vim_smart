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
  <div class="btn-group">
    <a href="{pigcms{:U('House/wxmsg_log_list_news')}">
      <button id="sample_editable_1_new" class="btn sbold green">
        消息记录
      </button>
    </a>
  </div>

    <input type="checkbox" name="my-checkbox" checked >
    <div class="alert alert-danger" style="display: inline;width: 80%">
        微信群发控制开关，<strong>使用完成后请务必关闭！</strong>
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
            <th> 编号 </th>
            <th> 标题 </th>
            <th> 通知类型</th>
            <th> 计划通知时间</th>
            <th> 所属社区</th>
            <th> 通知公司</th>
            <th> 状态</th>
            <th> 操作</th>
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
                <td>{pigcms{$v.id} </td>
                <td>{pigcms{$v.title}</td>
                <td>{pigcms{$v.msg_type_name}/{pigcms{$v.send_type_name}</td>
                <td>{pigcms{$v.send_date_str} {pigcms{$v.status_name2}</td>
                <td>{pigcms{$v["village_name"]}</td>
                <td>{pigcms{$v["company_name"]}</td>
                <td>{pigcms{$v.status_name}</td>

                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href = "{pigcms{:U('modal_msg_info',array('msg_id'=>$v['id']))}"
                                   data-toggle="modal" data-target="#common_modal"
                                ><i class="icon-docs"></i> 详情 </a>
                            </li>
                            <li>
                                <a href = "{pigcms{:U('save_group_msg',array('msg_id'=>$v['id']))}"><i class="icon-docs"></i> 编辑 </a>
                            </li>
                            <li>
                                <a class="del" href = "{pigcms{:U('del_group_msg',array('msg_id'=>$v['id']))}"><i class="icon-docs"></i> 删除 </a>
                            </li>
                        </ul>
                    </div>
                </td>

            </tr>
        </volist>
        </tbody>
    </table>
</block>
