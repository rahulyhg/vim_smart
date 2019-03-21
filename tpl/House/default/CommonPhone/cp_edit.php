<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('CommonPhone/cp_index')}">新闻列表</a>
            </li>
            <li class="active">内容发布</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('CommonPhone/cp_edit')}">
                        <input  name="cp_id" type="hidden" value="{pigcms{$news_info['cp_id']}"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">昵称&nbsp;&nbsp;<span style="color:red;">*</span></label></label>
                                    <input class="col-sm-2" size="80" maxlength="12" name="nickname" id="nickname" type="text" required="required" value="{pigcms{$news_info['nickname']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">联系号码&nbsp;&nbsp;<span style="color:red;">*</span></label></label>
                                    <input class="col-sm-2" size="80" name="iphone" id="iphone" required="required" type="text" value="{pigcms{$news_info['iphone']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">所选分类&nbsp;&nbsp;<span style="color:red;">*</span></label></label>
                                    <select name='ct_id' required="required">
                                        <if condition='$ct' id='cate'>
                                        <option value="">--请选择--</option>
                                        <volist name='ct' id='cate'>
                                            <option  value='{pigcms{$cate.ct_id}' <if condition="$news_info['ct_id'] eq $cate['ct_id']" >selected</if> >{pigcms{$cate.ct_name}</option>
                                        </volist>
                                            <else/>
                                            <option value="">--暂无分类可选--</option>
                                        </if>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">服务中心</label>
                                    <label><input  value="1" name="s_phone" type="radio" <if condition="$news_info['s_phone'] eq 1"> checked="checked" </if> />&nbsp;&nbsp;是</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input  value="0" name="s_phone" type="radio" <if condition="$news_info['s_phone'] neq 1"> checked="checked" </if> />&nbsp;&nbsp;否</label>
                                    &nbsp;&nbsp;（<span style="color:red;">服务中心电话只能有一个存在</span>）
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="sort">描述</label></label>
                                    <textarea id="description"  name="description"  placeholder="写上一些描述">{pigcms{$news_info['description']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
                                </div>
                                <div class="space"></div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" id="submit" type="submit" onclick="$(this).attr('type','text')">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .ke-dialog-body .ke-input-text{height: 30px;}
</style>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
    KindEditor.ready(function(K){
        kind_editor = K.create("#description",{
            width:'400px',
            height:'400px',
            resizeType : 1,
            allowPreviewEmoticons:false,
            allowImageUpload : true,
            filterMode: true,
            items : [
                'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link'
            ],
            emoticonsPath : './static/emoticons/',
            uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
        });
    });
//提交
//    $("#submit").click(function(){
//        var iphone = $("#iphone").val();
//        var patrn=/^1[3|4|5|8][0-9]\d{4,8}$/;
//        if (!patrn.test(iphone)){
//            alert("手机号码有误");
////            layer.msg('请填写正确的手机号',{icon:0});
//            return false;
//        }
//    })
</script>

<include file="Public:footer"/>
