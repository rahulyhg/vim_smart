<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-key"></i>
                <a href="{pigcms{:U('Access/group')}">区域分组管理</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <button class="btn btn-success" onclick="CreateCategory()">添加区域</button>
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="20%">ID</th>
                                <th width="20%">区域</th>
                                <th width="20%">所属社区</th>
                                <th width="20%">描述</th>
                                <th class="button-column" width="10%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$access_categorys">
                                <volist name="access_categorys" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td><div class="tagDiv">{pigcms{$vo.ag_id}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ag_name}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
                            <td><div class="tagDiv">{pigcms{$vo.ag_desc}</div></td>
                            <td class="button-column">
                                <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('Access/group_edit',array('ag_id'=>$vo['ag_id']))}">编辑</a>
                                <a style="width: 60px;" class="label label-sm label-info" title="删除" href="{pigcms{:U('Access/group_del',array('ag_id'=>$vo['ag_id']))}">删除</a>
                            </td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="5" >您没有添加任何区域</td></tr>
                            </if>
                            </tbody>
                        </table>
                        <tr class="odd"><td class="button-column" colspan="5">{pigcms{$pagebar}</td></tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    function CreateCategory(){
        window.location.href = "{pigcms{:U('Access/group_edit')}";
    }
</script>
<include file="Public:footer"/>

<!--陈琦
    2016.6.8-->