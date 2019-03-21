<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .dropdown-menu {
        margin: 0 0 0 -90px;
    }
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'报修项目列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('报修项目列表','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/repair_project_add')}">
                    <button id="sample_editable_1_new" class="btn sbold green">添加报修项目
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/repair_type_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">报修类型列表
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
        <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th> 报修项目编号 </th>
            <th> 报修项目名称 </th>
            <th> 报修项目类型 </th>
            <th> 单位 </th>
            <th> 人工费(元) </th>
            <th> 备注 </th>
            <th> 操作 </th>
        </tr>
        </thead>
        <tbody>
        <foreach name="repair_array" item="vo">
            <tr class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" value="1" />
                        <span></span>
                    </label>
                </td>
                <td> {pigcms{$vo.pro_id} </td>
                <td class="center">
                    {pigcms{$vo.project_name}
                </td>
                <td class="center">
                    {pigcms{$vo.type_name}
                </td>
                <if condition="$vo.unit eq ''">
                    <td class="center">
                        无
                    </td>
                <else/>
                    <td class="center">
                        {pigcms{$vo.unit}
                    </td>
                </if>
                <if condition="$vo.cost neq 0">
                    <td class="center">
                        {pigcms{$vo.cost}
                    </td>
                <else/>
                    <td class="center" style="color: green">
                        免费
                    </td>
                </if>
                <td class="center">
                    {pigcms{$vo.remark}
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('PropertyService/repair_project_edit',array('pro_id'=>$vo['pro_id']))}">
                                    <i class="icon-docs"></i> 更新 </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </foreach>
        </tbody>
    </table>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    //隐藏
    $('.summary').hide();
    function read(obj){
        if(confirm('您确定要标记为已处理？')){
            var bindid = $(obj).attr('bindid');
            var cid = $(obj).attr('pid');
            $.post("{pigcms{:U('do_repair')}",{bind_id:bindid,cid:cid},function(result){
                if(result.error == 0){
                    window.location.reload();
                }
            })
        }
    }
    $(function(){
        $('.handle_btn').on('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看详情',
                padding: 0,
                width: 820,
                height: 520,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });

    });
</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
