<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-comments-o"></i>
                <a href="{pigcms{:U('News/reply')}">业主交流</a>
            </li>
            <li class="active">新闻评论列表</li>
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
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="20%">新闻title</th>
                                    <th width="50%">评论内容</th>
                                    <th width="10%">评论人</th>
                                    <th width="10%">回复时间</th>
                                    <th class="button-column" width="10%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <if condition="$news">
                                    <volist name="news['reply_list']" id="vo">
                                        <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                                            <td><div class="tagDiv">{pigcms{$vo.title}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.content}</div></td>
                                            <td><div class="tagDiv">{pigcms{$vo.nickname}</div></td>
                                            <td><div class="shopNameDiv">{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</div></td>
                                            <td class="button-column">
                                           		<if condition="$vo['is_read'] eq 0">
                                                <a style="width:60px;" class="label label-sm label-info" title="已读" href="javascript:;" onclick="read(this)" cmsid='{pigcms{$vo.pigcms_id}'>已读</a>
                                                </if>
                                            </td>
                                        </tr>
                                    </volist>
                                <else/>
                                    <tr class="odd"><td class="button-column" colspan="11" >没有评论。</td></tr>
                                </if>
                            </tbody>
                        </table>
                        {pigcms{$news.pagebar}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script>
function read(obj){
	if(confirm('您确定要标记为已读？')){
		var cmsid = $(obj).attr('cmsid');
		$.post("{pigcms{:U('News/read')}",{cmsid:cmsid},function(result){
			if(result.status == 1){
				window.location.reload();
			}
		})
	}
}
</script>
<include file="Public:footer"/>
