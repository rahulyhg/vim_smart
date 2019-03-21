<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb"></ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .red{display:inline-block; font-size: 18px;margin-left: 70px;}
                td,th {text-align: center;}
                .lastimg img{height: 100px;}
                .ke-dialog-row .ke-input-text{height: 35px;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div id="shopList" class="grid-view">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="7%" style="text-align:center">用户ID</th>
                                <th width="15%" style="text-align:center">用户名</th>
                                <th width="20%" style="text-align:center">用户手机号</th>
                                <th width="25%" style="text-align:center">最后登录时间</th>
                                <th width="15%" style="text-align:center">用户地址</th>
                                <th style="text-align:center">操作</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyList">
                            <if condition="!empty($info)">
                                <volist name="info" id="vo">
                                    <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                            <td style="text-align:center">{pigcms{$vo.uid}</td>
                            <td style="text-align:center">{pigcms{$vo.nickname}</td>
                            <td style="text-align:center">{pigcms{$vo.phone}</td>
                            <td style="text-align:center">{pigcms{$vo.last_time|date="Y-m-d H:i:s",###}</td>
                            <td style="网页特效大集合(每天更新)text-align:center">{pigcms{$vo.province}&nbsp;,&nbsp;{pigcms{$vo.city}</td>
                            <td style="text-align:center"><a title="删除" class="red"style="padding-right:8px;margin-right:60px;" href="{pigcms{:U('Frontmanag/bd_del',array('uid'=>$vo['uid']))}">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a></td>
                            </tr>
                            </volist>
                            <else/>
                            <tr class="odd"><td class="button-column" colspan="6" >无内容</td></tr>
                            </if>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    $(function(){
        jQuery(document).on('click','#shopList a.red',function(){
            if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
        });
    });
    function CreateClassify(){
        window.location.href = "{pigcms{:U('Frontmanag/classify')}";
    }
    KindEditor.ready(function(K){
        var editor = K.editor({
            allowFileManager : true
        });
        //var islock=false;
        K('.J_selectImage').click(function(){
            var cyid=$(this).siblings('input').val();
            //var imgobj=$(this).parent('td').siblings('.lastimg').find('img');
            var imgobj=$(this).parent('td').siblings('.lastimg');
            editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news";
            editor.loadPlugin('image', function(){
                editor.plugin.imageDialog({
                    showRemote : false,
                    imageUrl : K('#course_pic').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        $.post("{pigcms{:U('Frontmanag/save_pic')}",{imgurl:url,cyid:cyid},function(){
                            //islock=false;
                            if(imgobj.find('img').size()>0){
                                imgobj.find('img').attr('src',"{pigcms{$config.site_url}/"+url);
                            }else{
                                imgobj.html('<img src="{pigcms{$config.site_url}/'+url+'">');
                            }
                        });
                        /*$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');*/
                        editor.hideDialog();
                        //window.location.reload();
                    }
                });
            });

        });
    });
</script>

<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
    $(function(){
        $('.see_imgsC').click(function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看图集',
                padding: 0,
                width: 800,
                height: 700,
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
