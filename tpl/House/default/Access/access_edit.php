<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tablet"></i>
                <a href="{pigcms{:U('Access/index')}">门禁管理</a>
            </li>
            <li class="active">编辑</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Access/access_edit_do')}" >
                        <input  name="ac_id" type="hidden" value="{pigcms{$access_info['ac_id']}"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">名称</label></label>
                                    <input class="col-sm-2" size="80" name="ac_name" id="title" type="text" value="{pigcms{$access_info['ac_name']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">设备所属类型</label></label>
                                    <select name='actype_id'>
                                        <volist name='device_categorys' id='device'>
                                            <option  value='{pigcms{$device.actype_id}' <if condition="$access_info['actype_id'] eq $device['actype_id']" >selected</if> >{pigcms{$device.actype_name}</option>
                                        </volist>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">APIKEY</label></label>
                                    <input class="col-sm-2" size="80" name="apikey" id="title" type="text" value="{pigcms{$access_info['apikey']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">节点ID</label></label>
                                    <input class="col-sm-2" size="80" name="nodeid" id="title" type="text" value="{pigcms{$access_info['nodeid']}"/>
                                </div>
                                <div class="form-group" <if condition="$access_info['ac_id'] eq ''">style="display:none;"</if> >
                                    <label class="col-sm-1"><label for="title">传感器ID</label></label>
                                    <input class="col-sm-2" size="80" name="sensorid" id="title" type="text" value="{pigcms{$access_info['sensorid']}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">状态</label>
                                    <label><input value="1" name="ac_status" type="radio"  <if condition="$access_info['ac_status'] eq 1 || $access_info['ac_status'] eq ''"> checked="checked" </if> />&nbsp;&nbsp;启用</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label><input value="2" name="ac_status" type="radio" <if condition="$access_info['ac_status'] eq 2"> checked="checked" </if> />&nbsp;&nbsp;停用</label>
                                </div>
                        
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="title">所属区域</label></label>
                                    <select name='ag_id'>
                                        <volist name='access_categorys' id='group'>
                                            <option  value='{pigcms{$group.ag_id}' <if condition="$access_info['ag_id'] eq $group['ag_id']" >selected</if> >{pigcms{$group.ag_name}</option>
                                        </volist>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="description">设备描述</label></label>
                                    <textarea id="description" name="ac_desc"  placeholder="描述内容">{pigcms{$access_info['ac_desc']|htmlspecialchars_decode=ENT_QUOTES}</textarea>
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

	/*function checkForm(){
		//return false;
		var ac_name=$('input[name="ac_name"]').val();	//设备名称
		var apikey=$('input[name="apikey"]').val();	//APIKEY
		var nodeid=$('input[name="nodeid"]').val();	//节点ID
		var sensorid=$('input[name="sensorid"]').val();	//传感器ID
		if(ac_name=="" || ac_name=="null"){
			alert('设备名称');
			return false;
		}else if(!(/[\u4E00-\u9FA5]/.test(ac_name))){
			alert('名称有误，请重填');
			return false;
		}else if(apikey=="" || apikey=="null"){
			alert('请输入apikey');
			return false;
		}else if(nodeid=="" || nodeid=="null"){
			alert('请输入节点ID');
			return false;
		}else if(!(/^(0|[1-9][0-9]*)$/.test(nodeid))){
			alert('节点ID格式有误，请重填');
			return false;
		}else if(sensorid=="" || sensorid=="null"){
			alert('请输入传感器ID');
			return false;
		}else if(!(/^(0|[1-9][0-9]*)$/.test(sensorid))){
			alert('传感器ID格式有误，请重填');
			return false;
		}else{
			return true;
		}
	}*/
</script>
<include file="Public:footer"/>
<!--陈琦
   2016.6.8-->