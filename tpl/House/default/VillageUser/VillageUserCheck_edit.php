<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('VillageUser/index')}">用户审核</a>
            </li>
            <li class="active">详情</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="">
                        <input  name="pigcms_id" type="hidden" value="{pigcms{$userCheck_info['pigcms_id']}"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">微信名</label></label>
                                    <input class="col-sm-2" size="80" name="nickname" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['nickname']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">真实姓名</label></label>
                                    <input class="col-sm-2" size="80" name="name" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['name']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">手机号码</label></label>
                                    <input class="col-sm-2" size="80" name="phone" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['phone']}"/>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">公司</label></label>
                                    <input class="col-sm-2" size="80" name="company" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['company']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">部门</label></label>
                                    <input class="col-sm-2" size="80" name="department" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['department']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">工牌号</label></label>
                                    <input class="col-sm-2" size="80" name="usernum" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['usernum']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">工牌图</label></label>
                                    <php> $workcard_img=explode('|',$userCheck_info['workcard_img'])</php>
                                   <volist name="workcard_img" id="img" key="k">
                                          <img alt="" src="/upload/house/{pigcms{$img}" width="70" height="110"  style="margin-left:20px;margin-top:10px;clear:both"  />
                                    </volist>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">地址</label></label>
                                    <input class="col-sm-2" size="80" name="address" id="title" type="text" readonly="readonly"  value="{pigcms{$userCheck_info['address']}"/>
                                </div>
                                <!--<div class="form-group">
                                    <label class="col-sm-1">审核结果</label>
                                    <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 1">checked="checked"</if> />&nbsp;&nbsp;审核中</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="2" name="ac_status" type="radio"  onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 2 || $userCheck_info['ac_status'] eq 4">checked="checked"</if> />&nbsp;&nbsp;通过</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <if condition="$userCheck_info['ac_status'] eq 3"> checked="checked" </if> />&nbsp;&nbsp;未通过</label>
                                </div>-->
                                <div class="form-group" id="d1" style="display:none">
                                    <label class="col-sm-1"><label for="description">描述</label></label>
                                    <textarea id="description" name="ac_desc"  placeholder="描述内容">{pigcms{$userCheck_info['ac_desc']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
                                </div>
                                <div class="space"></div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="button" onclick="window.location.href='{pigcms{:U('VillageUser/index')}'">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            返回
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

    $(function(){

        $("#wc_img").imgbox({
            'speedIn'		: 0,
            'speedOut'		: 0,
            'alignment'		: 'center',
            'overlayShow'	: true,
            'allowMultiple'	: false
        });
    });
</script>
<include file="Public:footer"/>
<!--陈琦
   2016.6.21-->