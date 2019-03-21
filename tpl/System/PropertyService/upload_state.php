<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'报修类型',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('报修类型列表','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/repair_type_add')}">
                    <button id="sample_editable_1_new" class="btn sbold green">添加报修类型
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="shopList" class="grid-view">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" width="100%">
        <tr>
            <th width="40%">名称</th>
            <th width="60%">导入进度</th>
        </tr>
        <foreach name="err_array" item="vo">
            <tr>
                <td width="40%">{pigcms{$vo.name}</td>
                <if condition="$vo.err eq 1">

                    <td width="60%">{pigcms{$vo.msg}</td>

                    <else/>

                    <td width="60%">完成导入</td>

                </if>
            </tr>
        </foreach>
    </table>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" onclick="back_list();">
                <i class="ace-icon fa fa-check bigger-110"></i>
                返回
            </button>
        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    function back_list(){
        window.location.href="{pigcms{:U('village_order_list')}";
    }

</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
