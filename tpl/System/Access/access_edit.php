<include file="Public:header"/>
    <form id="myform" method="post" action="{pigcms{:U('Access/access_edit')}" frame="true" refresh="true" >
    <input type="hidden" name="ac_id" value="{pigcms{$access_info['ac_id']}"/>
    <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
        <tr>
            <th width="100">名称</th>
            <td><input type="text" class="input fl" name="ac_name" value="{pigcms{$access_info['ac_name']}" size="40" placeholder="请输入设备名称" /></td>
        </tr>
        <tr>
            <th width="80">设备所属类型</th>
            <td>
                <div class="mr15 l">
                    <select name="actype_id">
                        <option value="0">请选择设备类型</option>
                        <volist id="device" name="device_categorys">
                            <option value='{pigcms{$device.actype_id}'<if condition="$access_info['actype_id'] eq $device['actype_id']" >selected</if> >{pigcms{$device.actype_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th width="100">APIKEY</th>
            <td><input type="text" class="input fl" name="apikey" size="40" placeholder="请输入APIKEY" value="{pigcms{$access_info['apikey']}"/></td>
        </tr>
        <tr>
            <th width="80">设备应用平台</th>
            <td>
                <div class="mr15 l">
                    <select id="terrace_name">
                        <option selected="selected" value="0">请选择平台</option>
                        <foreach name="terrace_array" item="sv">
                            <option value="{pigcms{$sv.pigcms_id}" <if condition="$sv.pigcms_id eq $access_info['terrace_id']" >selected</if>>{pigcms{$sv.terrace_name}</option>
                        </foreach>
                    </select>
                </div>
            </td>
        </tr>
        <tr name="yeelink" style="display: none">
            <th width="100">节点ID</th>
            <td><input type="text" class="input fl" name="nodeid" size="40" placeholder="请输入节点ID" value="{pigcms{$access_info['nodeid']}" /></td>
        </tr>
        <tr name="yeelink" style="display: none">
            <th width="100">传感器ID</th>
            <td><input type="text" class="input fl" name="sensorid" size="40" placeholder="请输入传感器ID" value="{pigcms{$access_info['sensorid']} " /></td>

        </tr>
        <tr name="unios" style="display: none">
            <th width="100">ACT时间</th>
            <td><input type="text" class="input fl" name="unios_act" size="40" placeholder="请输入ACT时间" value="{pigcms{$access_info['unios_act']}" /></td>
        </tr>
        <tr name="unios" style="display: none">
        <th width="100">PIN引脚号</th>
        <td><input type="text" class="input fl" name="unios_pin" size="40" placeholder="请输入PIN引脚号" value="{pigcms{$access_info['unios_pin']} " /></td>
        </tr>
        <script>
            $(function(){
                var index_terrace = $("#terrace_name").find("option:selected").text();
                if(index_terrace == 'Yeelink'){

                    $("*[name='yeelink']").show();
                }else if(index_terrace == '友联unios'){

                    $("*[name='unios']").show();
                }
                $("#terrace_name").change(function(){
                    var terrace_name = $(this).find("option:selected").text();
                    if(terrace_name == 'Yeelink'){
                        $("*[name='unios']").hide();
                        $("*[name='yeelink']").hide();
                        $("*[name='yeelink']").show();
                    }else if(terrace_name == '友联unios'){
                        $("*[name='unios']").hide();
                        $("*[name='yeelink']").hide();
                        $("*[name='unios']").show();
                    }
                });
            });
        </script>
        <tr>
            <th width="80">状态</th>
            <td>			
				<span class="cb-enable"><label class="cb-enable <if condition="$access_info['ac_status'] eq 1 || $access_info['ac_status'] eq ''">selected</if>"><span>启用</span><input type="radio" name="ac_status" value="1" <if condition="$access_info['ac_status'] eq 1 || $access_info['ac_status'] eq ''">checked="checked"</if> /></label></span>
				<span class="cb-disable"><label class="cb-disable <if condition="$access_info['ac_status'] eq 2">selected</if>"><span>停用</span><input type="radio" name="ac_status" value="2" <if condition="$access_info['ac_status'] eq 2">checked="checked"</if> /></label></span>
		   </td>
        </tr>
		<tr>
            <th width="80">所属社区</th>
            <td>
                <div class="mr15 l">
                    <select name="village_id" id="pid" onChange="villageCate(this)">
                        <option selected="selected" value="0">请选择社区</option>
                        <volist id="village" name="village_categorys">
                            <option value='{pigcms{$village.village_id}' data_val="{pigcms{$village.village_id}" <if condition="$access_info['village_id'] eq $village['village_id']" >selected</if> >{pigcms{$village.village_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
        </tr>	
        <tr id="access_cate">
		<if condition="$access_categorys">
            <th width="80">所属区域</th>
            <td>
                <div class="mr15 l">
                    <select name="ag_id" id="pid">
                        <option selected="selected" value="0">请选择区域</option>
                        <volist id="group" name="access_categorys">
                            <option value='{pigcms{$group.ag_id}' <if condition="$access_info['ag_id'] eq $group['ag_id']" >selected</if> >{pigcms{$group.ag_name}</option>
                        </volist>
                    </select>
                </div>
            </td>
		</if>
        </tr>				
        <tr><th width="80">设备描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="ac_desc" name="ac_desc" style="width:250px;height:90px;">{pigcms{$access_info['ac_desc']}</textarea></td></tr>
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
            uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
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
			'url':"{pigcms{:U('Access/access_edit',array('isajax'=>1))}",
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
<include file="Public:footer"/>