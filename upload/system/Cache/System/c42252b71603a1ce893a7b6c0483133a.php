<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/employeeStyle.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
    <form id="myform" method="post" action="<?php echo U('Access/access_edit');?>" frame="true" refresh="true" >
    <input type="hidden" name="ac_id" value="<?php echo ($access_info['ac_id']); ?>"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">名称</th>
            <td><input type="text" class="input fl" name="ac_name" value="<?php echo ($access_info['ac_name']); ?>" size="40" placeholder="请输入设备名称" /></td>
        </tr>
        <tr>
            <th width="80">设备所属类型</th>
            <td>
                <div class="mr15 l">
                    <select name="actype_id">
                        <option selected="selected" value="0">请选择设备类型</option>
                        <?php if(is_array($device_categorys)): $i = 0; $__LIST__ = $device_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$device): $mod = ($i % 2 );++$i;?><option value='<?php echo ($device["actype_id"]); ?>'<?php if($access_info['actype_id'] == $device['actype_id']): ?>selected<?php endif; ?> ><?php echo ($device["actype_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th width="100">APIKEY</th>
            <td><input type="text" class="input fl" name="apikey" size="40" placeholder="请输入APIKEY" value="<?php echo ($access_info['apikey']); ?>"/></td>
        </tr>
        <tr>
            <th width="100">节点ID</th>
            <td><input type="text" class="input fl" name="nodeid" size="40" placeholder="请输入节点ID" value="<?php echo ($access_info['nodeid']); ?>" /></td>
        </tr>
        <tr <?php if($access_info['ac_id'] == ''): ?>style="display:none"<?php endif; ?>>
            <th width="100">传感器ID</th>
            <td><input type="text" class="input fl" name="sensorid" size="40" placeholder="请输入传感器ID" value="<?php echo ($access_info['sensorid']); ?> " /></td>

        </tr>
        <tr>
            <th width="80">状态</th>
            <td>			
				<span class="cb-enable"><label class="cb-enable <?php if($access_info['ac_status'] == 1 || $access_info['ac_status'] == ''): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="ac_status" value="1" <?php if($access_info['ac_status'] == 1 || $access_info['ac_status'] == ''): ?>checked="checked"<?php endif; ?> /></label></span>
				<span class="cb-disable"><label class="cb-disable <?php if($access_info['ac_status'] == 2): ?>selected<?php endif; ?>"><span>停用</span><input type="radio" name="ac_status" value="2" <?php if($access_info['ac_status'] == 2): ?>checked="checked"<?php endif; ?> /></label></span>
		   </td>
        </tr>
		<tr>
            <th width="80">所属社区</th>
            <td>
                <div class="mr15 l">
                    <select name="village_id" id="pid" onChange="villageCate(this)">
                        <option selected="selected" value="0">请选择社区</option>
                        <?php if(is_array($village_categorys)): $i = 0; $__LIST__ = $village_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$village): $mod = ($i % 2 );++$i;?><option value='<?php echo ($village["village_id"]); ?>' data_val="<?php echo ($village["village_id"]); ?>" <?php if($access_info['village_id'] == $village['village_id']): ?>selected<?php endif; ?> ><?php echo ($village["village_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </td>
        </tr>	
        <tr id="access_cate">
		<?php if($access_categorys): ?><th width="80">所属区域</th>
            <td>
                <div class="mr15 l">
                    <select name="ag_id" id="pid">
                        <option selected="selected" value="0">请选择区域</option>
                        <?php if(is_array($access_categorys)): $i = 0; $__LIST__ = $access_categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value='<?php echo ($group["ag_id"]); ?>' <?php if($access_info['ag_id'] == $group['ag_id']): ?>selected<?php endif; ?> ><?php echo ($group["ag_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </td><?php endif; ?>
        </tr>				
        <tr><th width="80">设备描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ac_desc" name="ac_desc" style="width:250px;height:90px;"><?php echo ($access_info['ac_desc']); ?></textarea></td></tr>
    </table>
    <div class="btn hidden">
        <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
        <input type="reset" value="取消" class="button" />
    </div>
</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
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
            uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
        });
    });

   /* function checkForm(){
        //return false;
        var ac_name=$('input[name="ac_name"]').val();	//设备名称
        var apikey=$('input[name="apikey"]').val();	//APIKEY
        var nodeid=$('input[name="nodeid"]').val();	//节点ID
        var sensorid=$('input[name="sensorid"]').val();	//传感器ID
        if(ac_name=="" || ac_name=="null"){
            alert('设备名称不能为空');
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
	
	function villageCate(obj){
		//alert(obj.value);
		$.ajax({
			'url':"<?php echo U('Access/access_edit',array('isajax'=>1));?>",
			'data':{'village_id':obj.value},
			'type':'POST',
			'dataType':'JSON',
			'success':function(msg){
				if(msg.err_code==0){
					//alert(msg.code_data);
					$('#access_cate').text('');
                    var options='';
					for(var i=0;i<msg.code_data.length;i++){
						options+="<option value="+msg.code_data[i].ag_id+">"+msg.code_data[i].ag_name+"</option>";
					}
					//alert(options);
					var access_data='';
					access_data+='<th width="80">所属区域</th><td><div class="mr15 l">';
					access_data+='<select name="ag_id" id="pid"><option selected="selected" value="0">请选择区域</option>'+options+'</select></div></td>';
					$('#access_cate').append(access_data);
				}else{
					window.location.reload();
				}			
			},
			'error':function(){
				alert('loading error');
			}
		})
	}
</script>
	</body>
</html>