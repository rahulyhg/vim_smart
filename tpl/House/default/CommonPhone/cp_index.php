<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('CommonPhone/cp_index')}">服务号码列表</a>
            </li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <button class="btn btn-success" onclick="CreateCategory()">添加号码</button>
            <button class="btn btn-success" onclick="Category()">分类管理</button>
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
                                <th width="10%" style="text-align: center;">昵称</th>
                                <th width="10%" style="text-align: center;">联系方式</th>
                                <th width="10%" style="text-align: center;">所属分类</th>
                                <th width="10%" style="text-align: center;">服务中心号码</th>
                                <th width="40%" style="text-align: center;">备注</th>
                                <th class="button-column" width="15%" style="text-align: center;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <if condition="$news_list">
                                <volist name="news_list['news_list']" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td style="text-align: center;"><div class="tagDiv">{pigcms{$vo.cp_id}</div></td>
                            <td style="text-align: center;"><div class="tagDiv">{pigcms{$vo.nickname}</div></td>
                            <td style="text-align: center;"><div class="shopNameDiv">{pigcms{$vo.iphone}</div></td>
                            <td style="text-align: center;"><div class="tagDiv">{pigcms{$vo.ct_name}</div></td>
                            <td style="text-align: center;"><div class="tagDiv"><if condition="$vo.s_phone eq '1'">是<else/>否</if></div></td>
                            <td style="text-align: center;"><div class="shopNameDiv">{pigcms{$vo.description}</div></td>
                            <td class="button-column" style="text-align: center;">
                                <a style="width: 60px;" class="label label-sm label-info" title="编辑" href="{pigcms{:U('CommonPhone/cp_edit',array('cp_id'=>$vo['cp_id']))}">编辑</a>
                                <a style="width: 60px;" class="label label-sm label-info delete" title="删除" href="{pigcms{:U('CommonPhone/cp_del',array('cp_id'=>$vo['cp_id']))}">删除</a>
                            </td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="7" >您没有添加任何号码。</td></tr>
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
    function CreateCategory(){
        window.location.href = "{pigcms{:U('CommonPhone/cp_edit')}";
    }
    function Category(){
        window.location.href = "{pigcms{:U('CommonPhone/ct_index')}";
    }
    $(function(){
        jQuery(document).on('click','#shopList a.delete',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    $(function(){
        $('.handle_btn').live('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'提示',
                padding: 0,
                width: 720,
                height: 420,
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
<include file="Public:footer"/>