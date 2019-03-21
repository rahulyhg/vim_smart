<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'企业公告',
    'describe'=>'',
);
$breadcrumb = array(
    array('企业管理','#'),
    array('企业公告','#'),
);
$add_action = array(
    'url'=>U('news_add'),
    'name'=>"公告"
);
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </th>
        <th>编号</th>
        <th>标题</th>
        <th class="textcenter">置顶</th>
        <th class="textcenter">操作</th>
    </tr>
    </thead>
    <tbody>
    <if condition="is_array($news_list)">
        <volist name="news_list" id="vo">
            <tr>

                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td>{pigcms{$vo.id}</td>
                <td>{pigcms{$vo.title}</td>
                <td class="textcenter"><if condition="$vo['is_top'] eq 1"><font color="green">是</font><else/><font color="red">否</font></if></td>


                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/news_edit',array('id'=>$vo['id']))}','编辑公告',800,460,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Merchant/news_del')}">
                                    <i class="icon-docs"></i>删除
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </volist>

        <else/>
        <tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
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




