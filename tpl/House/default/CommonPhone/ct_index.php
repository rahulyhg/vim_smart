<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('News/cate')}">号码分类管理</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <button class="btn btn-success" onclick="CreateCategory()">添加分类</button>
            <button class="btn btn-success" onclick="Category()">常用号码管理</button>
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">ID</th>
                                <th width="20%" style="text-align: center;">分类</th>
                                <th width="50%" style="text-align: center;">描述</th>
                                <th class="button-column" width="10%" style="text-align: center;">操作</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center;">
                            <if condition="$type_info">
                                <volist name="type_info" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td style="text-align: center;"><div class="tagDiv">{pigcms{$vo.ct_id}</div></td>
                            <td style="text-align: center;"><div class="tagDiv">{pigcms{$vo.ct_name}</div></td>
                            <td style="text-align: center;">{pigcms{$vo.ct_description}</td>
                            <td class="button-column" style="text-align: center;">
                                <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('CommonPhone/ct_edit',array('ct_id'=>$vo['ct_id']))}">编辑</a>
                                <a style="width: 60px;" class="label label-sm label-info delete" id="delete" title="删除" href="{pigcms{:U('CommonPhone/ct_del',array('ct_id'=>$vo['ct_id']))}">删除</a>
                            </td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="4" >您没有添加任何新闻分类。</td></tr>
                            </if>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
    $(function(){
        jQuery(document).on('click','#shopList a.delete',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function CreateCategory(){
        window.location.href = "{pigcms{:U('CommonPhone/ct_edit')}";
    }
    function Category(){
        window.location.href = "{pigcms{:U('CommonPhone/cp_index')}";
    }
</script>
<include file="Public:footer"/>
