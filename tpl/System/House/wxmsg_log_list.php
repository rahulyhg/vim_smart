<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'微信消息日志',
    'describe'=>'',
);
$breadcrumb = array(
    array('信息发布',U('group_msg_list_news')),
    array('微信消息日志','#'),
);

$add_action = array(

);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<style type="text/css">
    .mainnav_title {line-height:40px;/* height:40px; */border-bottom:1px solid #eee;color:#31708f;}
    .mainnav_title a {color:#004499;margin:0 5px;padding:4px 7px;background:#d9edf7;}
    .mainnav_title a:hover ,.mainnav_title a.on{background:#498CD0;color:#fff;text-decoration: none;}
</style>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </th>
        <th>id</th>
        <th>发布人</th>
        <th>接收人</th>
        <th>模板类型</th>
        <th>错误码:错误信息</th>
        <th>接收时间</th>
    </tr>
    </thead>
    <tbody>
    <if condition="$list">
        <volist name="list" id="row">
            <tr>
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$row.id}</td>
                <td>{pigcms{$row.suser}</td>
                <td>{pigcms{$row.ruser}</td>
                <td><a href = "{pigcms{:U('get_msg_log_info',array('log_id'=>$row['id']))}"
                                       data-toggle="modal"
                                       data-target="#modal_{pigcms{$row.id}"
                    >
                        {pigcms{$row.tpl_title}
                    </a>
                </td>
                <td>{pigcms{$row.errcode} : {pigcms{$row.errmsg}</td>
                <td>{pigcms{$row.create_time}</td>
                        <!--                <td>-->
<!--                    <div class="btn-group">-->
<!--                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作-->
<!--                            <i class="fa fa-angle-down"></i>-->
<!--                        </button>-->
<!--                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">-->
<!--                            <li>-->
<!--                                <a href = "{pigcms{:U('get_msg_log_info',array('log_id'=>$row['id']))}"-->
<!--                                   data-toggle="modal"-->
<!--                                   data-target="#modal_{pigcms{$row.id}"-->
<!--                                ><i class="icon-docs"></i> 详情 </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </td>-->
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_<?php echo $row['id']?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </tr>
        </volist>
        <tr class="odd">
            <td colspan="16" id="show_count"></td>
        </tr>
        <tr><td class="textcenter pagebar" colspan="16">{pigcms{$page_bar}</td></tr>
        <else/>
        <tr class="odd"><td class="textcenter red" colspan="16" >暂无数据</td></tr>
    </if>
    </tbody>
</table>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>

<!--引入js-->

<!--自定义js代码区开始-->




<!--自定义js代码区结束-->
<include file="Public_news:footer"/>