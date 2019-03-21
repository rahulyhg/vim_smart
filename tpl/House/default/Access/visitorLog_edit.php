<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('Access/visitorLog')}">访客信息</a>
            </li>
            <li class="active">编辑</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Access/visitorLog_edit')}">
                        <input  name="pigcms_id" type="hidden" value="{pigcms{$visitor_info['pigcms_id']}"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">微信名</label></label>
                                    <input class="col-sm-2" size="80" name="nickname" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['nickname']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">真实姓名</label></label>
                                    <input class="col-sm-2" size="80" name="name" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['name']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">手机号码</label></label>
                                    <input class="col-sm-2" size="80" name="phone" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['phone']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">身份证</label></label>
                                    <input class="col-sm-2" size="80" name="id_card" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['id_card']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">公司名称</label></label>
                                    <input class="col-sm-2" size="80" name="company" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['company']}"/>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">登记时间</label></label>
                                    <input class="col-sm-2" size="80" name="add_time" id="title" type="text" readonly="readonly" value="{pigcms{$visitor_info['add_time|date='Y-m-d H:i:s',###']}"/>
                                </div>



                            <div class="space"></div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="button" onclick="window.location.href='{pigcms{:U('Access/visitorLog')}'">
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
<!--<form id="myform" method="post" action="" frame="true" refresh="true">
	<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		<tr>
			<th width="100">工牌图</th>
			<td>
			<php> $workcard_img=explode('|',$visitor_info['workcard_img'])</php>
			<volist name="workcard_img" id="img" key="k">
			<img alt="" src="/upload/house/{pigcms{$img}" class="view_msg" width="100" height="100" style="margin-left:20px;margin-top:10px;clear:both"/>
			</volist>
			</td>
		</tr>
	</table>
</form>-->
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

        var ac_status=$("input[name='ac_status']:checked").val();
        alert(ac_status);
    });
</script>
<include file="Public:footer"/>
<!--陈琦
   2016.6.8-->