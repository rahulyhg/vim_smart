<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="#">合同管理</a>
            </li>
            <li class="active">合同列表</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success" onclick="CreateContract()">新建合同</button>
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>编号</th>
                                <th>社区名称</th>
                                <th>合同名称</th>
                                <th>签订日期</th>
                                <th>截止日期</th>
                                <th>创建人员</th>
                                <th>创建时间</th>
                                <th class="button-column" style="width:100px;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$shequArr">
                                <volist name="shequArr" id="vo">
                                    <tr />
                                    <td>{pigcms{$vo.id}</td>
                                    <td>{pigcms{$vo.village_name}</td>
                                    <td>{pigcms{$vo.contract_name}</td>
                                    <td>{pigcms{$vo.contract_start}</td>
                                    <td>{pigcms{$vo.contract_end}</td>
                                    <td>{pigcms{$vo.admin_name}</td>
                                    <td>{pigcms{$vo.create_time|date="Y-m-d",###}</td>

                                    <td class="button-column" nowrap="nowrap">
                                        <a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Index/contract_edit',array('id'=>$vo['id']))}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Index/contract_del',array('id'=>$vo['id']))}">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </td>
                                </tr>
                                </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="11" >无内容</td></tr>
                            </if>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function CreateContract(){
        window.location.href = "{pigcms{:U('Index/contract_add')}";
    }


</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<include file="Public:footer"/>
