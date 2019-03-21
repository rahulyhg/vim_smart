<extend name="./tpl/System/Public_news/base.php" />
<block name="head">
    <style>
        .tab{
            text-indent:2em;
        }
    </style>
</block>
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('meterlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">返回
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('add_config')}">
            <button id="sample_editable_1_new" class="btn sbold green">新建设备配置
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
</block>
<block name="body">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>描述</th>
            <th>单位</th>
            <th>所属建筑</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="list" id="row">
            <tr>
                <td>{pigcms{$row.desc}</td>
                <td>{pigcms{$row.unit}</td>
                <td>{pigcms{$row.village_name}</td>
                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                            <li>
                                <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_edit_config',array('config_id'=>$row['id']))}">
                                    <i class="icon-docs"></i> 参数配置
                                </a>
                            </li>
                            <li>
                                <if condition="$is_admin">
                                <a  href="{pigcms{:U('del_config',array('config_id'=>$row['id']))}" onclick="return window.confirm('确认删除？')">
                                    <i class="icon-docs"></i> 删除
                                </a>
                                </if>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <volist name="row['cate']" id="rr">
                <tr>
                    <td class="tab">{pigcms{$rr.desc}</td>
                    <td></td>
                    <td>{pigcms{$rr.village_name}</td>
                    <td class="button-column">
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false"> 操作
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu" style="position: absolute;">
                                <li>
                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_edit_cate',array('cate_id'=>$rr['id']))}">
                                        <i class="icon-docs"></i> 参数配置
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-target="#common_modal"  href="{pigcms{:U('modal_cate_meters',array('cate_id'=>$rr['id']))}">
                                        <i class="icon-docs"></i> 设备管理
                                    </a>
                                </li>
                                <li>
                                    <a  href="{pigcms{:U('del_cate',array('cate_id'=>$rr['id']))}">
                                        <i class="icon-docs"></i> 删除
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </volist>
        </volist>
        </tbody>
    </table>
</block>