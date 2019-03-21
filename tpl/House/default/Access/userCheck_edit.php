<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('Access/userCheck')}">智能审核</a>
            </li>
            <li class="active">编辑</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Access/userCheck_edit_do')}">
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
                                    <label class="col-sm-1"><label for="title">公司名称</label></label>
                                    <input class="col-sm-2" size="80" name="company" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['company_name']}"/>
                                </div>
                                
                                <!--<div class="form-group">
                                    <label class="col-sm-1"><label for="title">部门</label></label>
                                    <input class="col-sm-2" size="80" name="department" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['department']}"/>
                                </div>-->

                                <div class="form-group"><label class="col-sm-1"><label for="title">证件类型</label></label>
                                    <if condition="$userCheck_info.card_type eq 1"><input type="text" class="col-sm-2" size="80" value="现场审核" readonly="readonly"/></if>
                                    <if condition="$userCheck_info.card_type eq 2"><input type="text" class="col-sm-2" size="80" value="门禁卡" readonly="readonly"/></if>
                                    <if condition="$userCheck_info.card_type eq 3"><input type="text" class="col-sm-2" size="80" value="身份证" readonly="readonly"/></if>
                                    <if condition="$userCheck_info.card_type eq 4"><input type="text" class="col-sm-2" size="80" value="工作牌" readonly="readonly"/></if>
                                </div>

                                <if condition="$userCheck_info.card_type neq 1 and $userCheck_info.card_type neq 4 ">
                                    <div class="form-group">
                                      <label class="col-sm-1"><label for="title">证件号</label></label>
                                      <input class="col-sm-2" size="80" name="usernum" id="title" type="text" readonly="readonly" value="{pigcms{$userCheck_info['usernum']}"/>
                                     </div>
                                </if>

                                <if condition="$userCheck_info.card_type neq 1">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">证件照</label></label>
									<php> $workcard_img=explode('|',$userCheck_info['workcard_img'])</php>						
									<volist name="workcard_img" id="img" key="k">
										<img alt="" src="/upload/house/{pigcms{$img}" width="70" height="110"  style="margin-left:20px;margin-top:10px;clear:both"  />
									</volist>
                                </div>
                                </if>
                                
                                <!--<div class="form-group">
                                    <label class="col-sm-1"><label for="title">地址</label></label>
                                    <input class="col-sm-2" size="80" name="address" id="title" type="text" readonly="readonly"  value="{pigcms{$userCheck_info['address']}"/>
                                </div>-->
                                
                                <div class="form-group">
                                    <label class="col-sm-1">审核结果</label>
                                    <label><input value="1" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 1">checked="checked"</if> />&nbsp;&nbsp;审核中</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="2" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="none" ;' <if condition="$userCheck_info['ac_status'] eq 2 || $userCheck_info['ac_status'] eq 4">checked="checked"</if> />&nbsp;&nbsp;通过</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="3" name="ac_status" type="radio" onclick='document.getElementById("d1").style.display="block";' <if condition="$userCheck_info['ac_status'] eq 3"> checked="checked" </if> />&nbsp;&nbsp;未通过</label>
                                </div>
								<if condition="$userCheck_info['check_name'] neq '' && $userCheck_info['ac_status'] neq 1">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">审核人</label></label>
                                    <input class="col-sm-2" size="80" name="check_name" id="title" type="text" readonly="readonly"  value="{pigcms{$userCheck_info['check_name']}"/>
                                </div>
								</if>
                                <div class="form-group" id="d1" <if condition="$userCheck_info['ac_status'] neq 3">style="display:none" </if>>
                                    <label class="col-sm-1"><label for="description">描述</label></label>
                                    <textarea id="description" name="ac_desc"  placeholder="描述内容">{pigcms{$userCheck_info['ac_desc']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
                                </div>
                                <div class="space"></div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit" onclick="$(this).attr('type','text')">
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
<!--<form id="myform" method="post" action="" frame="true" refresh="true">
	<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">       
		<tr>
			<th width="100">工牌图</th>
			<td>
			<php> $workcard_img=explode('|',$userCheck_info['workcard_img'])</php>						
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