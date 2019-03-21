<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Appoint/index')}">预约管理</a>
			</li>
			<li class="active">添加预约</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				#levelcoupon select {width:150px;margin-right: 20px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">				
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本信息</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtstore">选择店铺</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtintro">服务详情</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtimage">图片</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1">服务名称：</label>
									<input class="col-sm-3" maxlength="30" name="appoint_name" type="text" value="" /><span class="form_tips">必填。在预约页显示此名称！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">服务简介：</label>
									<textarea class="col-sm-3" rows="5" name="appoint_content"></textarea><span class="form_tips">预约的简短介绍，建议为100字以下。</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group"><label class="col-sm-1">收取定金</label>
									<label><input type="radio" name="payment_status" <if condition="!$ismainno">checked="checked"</if> value="0" onclick="paymentHide();">&nbsp;&nbsp;否</label>
									&nbsp;&nbsp;&nbsp;
									<label><input type="radio" name="payment_status" value="1" onclick="paymentShow();" <if condition="$ismainno">checked="checked"</if>>&nbsp;&nbsp;是</label>
								</div>
								<div class="form-group" id="payment_money" style="display:none;">
									<label class="col-sm-1">定金：</label>
									<input class="col-sm-1" maxlength="100" name="payment_money" type="text" value="" /><span class="form_tips">最多支持2位小数（超过后，系统自动截取）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">全价：</label>
									<input class="col-sm-1" maxlength="30" name="appoint_price" type="text" value="" /><span class="form_tips">必填。最多支持2位小数（超过后，系统自动截取）</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">开始时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'{pigcms{:date('Y年m月d日',$_SERVER['REQUEST_TIME'])}',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'{pigcms{:date('Y-m-d',$_SERVER['REQUEST_TIME'])}',vel:'start_time'})" value="{pigcms{:date('Y年m月d日',$_SERVER['REQUEST_TIME'])}"/>
									<input name="start_time" id="start_time" type="hidden" value="{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}"/>
									<span class="form_tips">到了开始时间，商品才会显示！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">结束时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'{pigcms{:date('Y年m月d日',$_SERVER['REQUEST_TIME'])}',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'{pigcms{:date('Y-m-d',strtotime('+30 day'))}',vel:'end_time'})" value="{pigcms{:date('Y年m月d日 ',strtotime('+30 day'))}"/>
									<input name="end_time" id="end_time" type="hidden" value="{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}"/>
									<span class="form_tips">超过结束时间，会自动结束！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">服务类别：</label>
									<select name="appoint_type" class="col-sm-2">
										<option value="0">到店</option>
										<option value="1">上门</option>
									</select>
								</div>
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#shop_time_1">
												营业时间段1
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_2">
												营业时间段2
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_3">
												营业时间段3
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="shop_time_1" class="tab-pane in active">
											<div>
												<input id="Config_shop_start_time" type="text" value="08:00" name="office_start_time" />	至
												<input id="Config_shop_stop_time" type="text" value="20:00" name="office_stop_time" />
												<div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_2" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_2" type="text" value="00:00" name="office_start_time2" />	至
												<input id="Config_shop_stop_time_2" type="text" value="00:00" name="office_stop_time2" />
												<div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_3" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_3" type="text" value="00:00" name="office_start_time3" />	至
												<input id="Config_shop_stop_time_3" type="text" value="00:00" name="office_stop_time3" />
												<div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div class="form-group"></div>
										<div class="form-group">
											<label class="col-sm-1">限定人数：</label>
											<input class="col-sm-1" maxlength="100" name="appoint_people" type="text" value="0" /><span class="form_tips">限制每个时间点的预约人数，0为不限制</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">时间间隔：</label>
											<input class="col-sm-1" maxlength="100" name="time_gap" type="text" value="30" /><span class="form_tips">预约时间间隔，单位分钟，必须是10的倍数</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">提前：</label>
											<input class="col-sm-1" maxlength="100" name="before_time" type="text" value="0" /><span class="form_tips">提前多长时间预约，小时计，0为不限制</span>
										</div>
									</div>
								</div>
							</div>
							<div id="txtstore" class="tab-pane">
								<div class="form-group">
									<volist name="store_list" id="vo">
										<div class="radio">
											<label>
												<input class="paycheck ace" type="checkbox" name="store_id[]" value="{pigcms{$vo.store_id}" id="store{pigcms{$vo.store_id}"/>
												<span class="lbl"><label for="store{pigcms{$vo.store_id}">{pigcms{$vo.name} - {pigcms{$vo.area_name}-{pigcms{$vo.adress}</label></span>
											</label>
										</div>
									</volist>
								</div>
							</div>
							<div id="txtintro" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">选择分类：</label>
									<select id="choose_catfid" name="cat_fid" class="col-sm-1" style="margin-right:10px;">
										<option value="">请选择</option>
										<volist name="f_category_list" id="vo">
											<option value="{pigcms{$vo.cat_id}">{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
									<select id="choose_catid" name="cat_id" class="col-sm-1" style="margin-right:10px;">
										<option value="">请选择</option>
										<volist name="s_category_list" id="vo">
											<option value="{pigcms{$vo.cat_id}">{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
									<input type="hidden" name="cat_id" id="cat_id" value=""/>
								</div>
								<!-- <div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="custom_html_tips">
									<div class="form-group" style="margin-top:10px;color:red;">以下为主分类设定的特殊字段，不同分类字段不同，请选择。</div>
									<div id="custom_html">{pigcms{$custom_html}</div>
								</div>
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<div class="form-group" style="margin-top:30px;color:red;">以下为主分类设定的 购买须知填写项，请填写。</div>
									<div id="cue_html">{pigcms{$cue_html}</div>
								</div> 
								<div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a href="javascript:;" id="editor_plan_btn">插入套餐表格</a></div>-->
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<table class="table table-striped">
										<tbody>
											<tr>
												<th scope="col">菜单序号</th>
												<th scope="col">菜单名称</th>
												<th scope="col">价格</th>
												<th scope="col">描述</th>    
											</tr>
											<for start="1" end="10">
												<tr class="parent" data-index="{pigcms{$i}">
													<td><i class="ace-icon fa"></i>序号{pigcms{$i}</td>
													<td><input name="custom_name[]" type="text" class="span2 title" value=""></td>
													<td>￥<input name="custom_price[]" type="text" class="span2 keyword" value=""></td>
													<td><input name="custom_content[]" type="text" class="span3 url" value=""></td>
												</tr>
											</for>
										</tbody>
									</table>
								</div>
								<div class="form-group" >
									<label class="col-sm-1">服务详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
									<textarea name="appoint_pic_content" id="content" style="width:702px;"></textarea>
								</div>
							</div>
							<div id="txtimage" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<php>if(!empty($config['group_pic_width'])){$group_pic_width=explode(',',$config['group_pic_width']);echo '图片宽度建议为：'.$group_pic_width[0].'px，';}</php><php>if(!empty($config['group_pic_height'])){$group_pic_height=explode(',',$config['group_pic_height']);echo '高度建议为：'.$group_pic_height[0].'px';}</php></span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">图片预览</label>
									<div id="upload_pic_box">
										<ul id="upload_pic_ul"></ul>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" id="save_btn">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
input.ke-input-text {
background-color: #FFFFFF;
background-color: #FFFFFF!important;
font-family: "sans serif",tahoma,verdana,helvetica;
font-size: 12px;
line-height: 24px;
height: 24px;
padding: 2px 4px;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
border-style: solid;
border-width: 1px;
display: -moz-inline-stack;
display: inline-block;
vertical-align: middle;
zoom: 1;
}
.form-group>label{font-size:12px;line-height:24px;}
#upload_pic_box{margin-top:20px;height:150px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}
</style>
<script type="text/javascript" src="{pigcms{$static_public}js/date/WdatePicker.js"></script>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
$(function($){
	$('#Config_shop_start_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
});
</script>
<script type="text/javascript">
KindEditor.ready(function(K) {
	var content_editor = K.create("#content",{
		width:'702px',
		height:'260px',
		resizeType : 1,
		allowPreviewEmoticons:false,
		allowImageUpload : true,
		filterMode: true,
		autoHeightMode : true,
		afterCreate : function() {
			this.loadPlugin('autoheight');
		},
		items : [
			'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'table'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=appoint/content",
		cssPath : "{pigcms{$static_path}css/group_editor.css"
	});
	
	var editor = K.editor({
		allowFileManager : true
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 5){
			alert('最多上传5个图片！');
			return false;
		}
		editor.uploadJson = "{pigcms{:U('Appoint/ajax_upload_pic')}";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImg(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
					editor.hideDialog();
				}
			});
		});
	});
	
	$('#choose_catfid').change(function(){
		$.getJSON("{pigcms{:U('Appoint/ajax_get_category')}",{cat_fid:$(this).val()},function(result){
			var html = '';
			html += '<option value="">请选择</option>';  
			if(result.error == 0){
				for ( var i=0; i<result.cat_list.length; i++){
                    html += '<option value="'+ result.cat_list[i].cat_id +'">' + result.cat_list[i].cat_name + '</option>';  
                }  
                $('#choose_catid').html(html);
            } else {  
                $("#choose_catid").html(html);
            }  
		});
	});

	$('#choose_catid').change(function(){
		var cat_id = $(this).val();
		$('#cat_id').attr('value', cat_id);
	});
	
	$('#add_form').submit(function(){
		content_editor.sync();
		$('#save_btn').prop('disabled',true);
		$.post("{pigcms{:U('Appoint/add')}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Appoint/index')}";
			}else{
				alert(result.info);
			}
			$('#save_btn').prop('disabled',false);
		})
		return false;
	});
	
	$('#editor_plan_btn').click(function(){
		var dialog = K.dialog({
				width : 200,
				title : '输入欲插入表格行数',
				body : '<div style="margin:10px;"><input id="edit_plan_input" style="width:100%;"/></div>',
				closeBtn : {
						name : '关闭',
						click : function(e) {
							dialog.remove();
						}
				},
				yesBtn : {
						name : '确定',
						click : function(e){
							var value = $('#edit_plan_input').val();
							if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value)){
								alert('请输入数字！');
								return false;
							}
							value = parseInt(value);
							var html = '<table class="deal-menu">';
							html += '<tr><th class="name" colspan="2">套餐内容</th><th class="price">单价</th><th class="amount">数量/规格</th><th class="subtotal">小计</th></tr>';
							for(var i=0;i<value;i++){
								html += '<tr><td class="name" colspan="2">内容'+(i+1)+'</td><td class="price">¥</td><td class="amount">1份</td><td class="subtotal">¥</td></tr>';
							}
							html += '</table>';
							html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span>{pigcms{$config.group_alias_name}价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
							content_editor.appendHtml(html);
							
							dialog.remove();
						}
				},
				noBtn : {
						name : '取消',
						click : function(e) {
							dialog.remove();
						}
				}
		});
	});
});	
	function deleteImg(path,obj){
		$.post("{pigcms{:U('Appoint/ajax_del_pic')}",{path:path});
		$(obj).closest('.upload_pic_li').remove();
	}

	function paymentHide(){
		$('#payment_money').hide();
	}
	function paymentShow(){
		$('#payment_money').show();
	}
</script>
<include file="Public:footer"/>