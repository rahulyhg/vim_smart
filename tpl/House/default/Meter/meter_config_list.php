<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-group"></i>
                <a href="{pigcms{:U('Meter/index')}">设备管理</a>
            </li>
            <li class="active">设备类型配置</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">

                <style>
                    .tab{
                        text-indent:2em;
                    }
                </style>
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
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </volist>
                    </volist>
                    </tbody>
                </table>
            <div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
                <div class="modal-dialog modal-lg" role="document" style="width:1200px">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
<include file="Public:footer"/>
