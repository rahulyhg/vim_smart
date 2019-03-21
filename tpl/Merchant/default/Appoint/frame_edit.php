<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/styles.css">
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ba-bbq.min.js"></script>
<title>{pigcms{$config.site_name} - 商家中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="{pigcms{$static_path}css/bootstrap.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/font-awesome.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-fonts.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace.min.css" id="main-ace-style">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-skins.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-rtl.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/global.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/ace-extra.min.js"></script>


<script type="text/javascript" src="{pigcms{$static_path}js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script type="text/javascript" src="{pigcms{$static_path}js/bootbox.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.sparkline.min.js"></script>

<!-- ace scripts -->
<script type="text/javascript" src="{pigcms{$static_path}js/ace-elements.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/ace.min.js"></script>

<script type="text/javascript" src="{pigcms{$static_path}js/jquery.yiigridview.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui-i18n.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui-timepicker-addon.min.js"></script>
<style type="text/css">
html{
	background:#fff;
}
.jqstooltip {
	position: absolute;
	left: 0px;
	top: 0px;
	visibility: hidden;
	background: rgb(0, 0, 0) transparent;
	background-color: rgba(0, 0, 0, 0.6);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
	color: white;
	font: 10px arial, san serif;
	text-align: left;
	white-space: nowrap;
	padding: 5px;
	border: 1px solid white;
	z-index: 10000;
}

.jqsfield {
	color: white;
	font: 10px arial, san serif;
	text-align: left;
}

.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
	display: none;
}

#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
	{
	font-size: 12px;
	color: black;
	display: none;
	width: 100%;
}
</style>
<script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>

</head>

<body class="no-skin">
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{$_GET.system_file}?c=Appoint&a=product_list">预约列表</a>
			</li>
			<li class="active">编辑预约</li>
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
								<a data-toggle="tab" href="#txtintro">预约详情</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtimage">图片</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtorder">状态设置</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1">预约名称：</label>
									<input class="col-sm-3" maxlength="30" name="appoint_name" type="text" value="{pigcms{$appoint_list.appoint_name}" /><span class="form_tips">必填。在预约页显示此名称！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">预约简介：</label>
									<textarea class="col-sm-3" rows="5" name="appoint_content">{pigcms{$appoint_list.appoint_content}</textarea><span class="form_tips">预约的简短介绍，建议为100字以下。</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group"><label class="col-sm-1">收取定金</label>
									<label><input type="radio" name="payment_status" value="0" onclick="paymentHide();" <?php if($appoint_list['payment_status'] == 0): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;否</label>
									&nbsp;&nbsp;&nbsp;
									<label><input type="radio" name="payment_status" value="1" onclick="paymentShow();" <?php if($appoint_list['payment_status'] == 1): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;是</label>
								</div>
								<div class="form-group" id="payment_money" <?php if($appoint_list['payment_status'] == 0): ?> style="display:none;" <?php else : ?> style="display:block;" <?php endif; ?>>
									<label class="col-sm-1">定金：</label>
									<input class="col-sm-1" maxlength="100" name="payment_money" type="text" value="<?php echo $appoint_list['payment_money']; ?>" /><span class="form_tips">最多支持2位小数</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">全价：</label>
									<input class="col-sm-1" maxlength="30" name="appoint_price" type="text" value="<?php echo $appoint_list['appoint_price']; ?>" /><span class="form_tips">必填。最多支持2位小数</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">开始时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'{pigcms{:date('Y-m-d',$_SERVER['REQUEST_TIME'])}',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'<?php echo date('Y-m-d', $appoint_list['start_time']); ?>',vel:'start_time'})" value="<?php echo date('Y年m月d日', $appoint_list['start_time']); ?>"/>
									<input name="start_time" id="start_time" type="hidden" value="<?php echo date('Y-m-d', $appoint_list['start_time']); ?>"/>
									<span class="form_tips">到了开始时间，商品才会显示！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">结束时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({minDate:'{pigcms{:date('Y-m-d',$_SERVER['REQUEST_TIME'])}',isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日',startDate:'<?php echo date('Y-m-d', $appoint_list['end_time']); ?>',vel:'end_time'})" value="<?php echo date('Y年m月d日', $appoint_list['end_time']); ?>"/>
									<input name="end_time" id="end_time" type="hidden" value="<?php echo date('Y-m-d', $appoint_list['end_time']); ?>"/>
									<span class="form_tips">超过结束时间，会自动结束！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">预约类别：</label>
									<select name="appoint_type" class="col-sm-2">
										<option value="0" <?php if($appoint_list['appoint_type'] == 0): ?>selected="selected"<?php endif; ?>>到店</option>
										<option value="1" <?php if($appoint_list['appoint_type'] == 1): ?>selected="selected"<?php endif; ?>>上门</option>
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
												<input id="Config_shop_start_time" type="text" value="<?php echo $office_time_1['open'] ?>" name="office_start_time" />	至
												<input id="Config_shop_stop_time" type="text" value="<?php echo $office_time_1['close'] ?>" name="office_stop_time" />
												<div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_2" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_2" type="text" value="<?php echo $office_time_2['open']; ?>" name="office_start_time2" />	至
												<input id="Config_shop_stop_time_2" type="text" value="<?php echo $office_time_2['close']; ?>" name="office_stop_time2" />
												<div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div id="shop_time_3" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_3" type="text" value="<?php echo $office_time_3['open']; ?>" name="office_start_time3" />	至
												<input id="Config_shop_stop_time_3" type="text" value="<?php echo $office_time_3['close']; ?>" name="office_stop_time3" />
												<div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
												<span class="form_tips">如果营业时间段1设置为00:00-00:00，则表示24小时营业</span>
											</div>
										</div>
										<div class="form-group"></div>
										<div class="form-group">
											<label class="col-sm-1">限定人数：</label>
											<input class="col-sm-1" maxlength="100" name="appoint_people" type="text" value="<?php echo $appoint_list['appoint_people']; ?>" /><span class="form_tips">限制每个时间点的预约人数，0为不限制</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">时间间隔：</label>
											<input class="col-sm-1" maxlength="100" name="time_gap" type="text" value="<?php echo $appoint_list['time_gap']; ?>" /><span class="form_tips">预约时间间隔，单位分钟，必须是10的倍数</span>
										</div>
										<div class="form-group">
											<label class="col-sm-1">提前：</label>
											<input class="col-sm-1" maxlength="100" name="before_time" type="text" value="<?php echo $appoint_list['before_time']; ?>" /><span class="form_tips">提前多长时间预约，小时计</span>
										</div>
									</div>
								</div>
							</div>
							<div id="txtstore" class="tab-pane">
								<div class="form-group">
									<volist name="store_list" id="vo">
										<div class="radio">
											<label>
												<input class="paycheck ace" type="checkbox" name="store[]" value="{pigcms{$vo.store_id}" id="store_{pigcms{$vo.store_id}" <if condition="in_array($vo['store_id'],$store_arr)">checked="checked"</if>/>
												<span class="lbl"><label for="store_{pigcms{$vo.store_id}">{pigcms{$vo.name} - {pigcms{$vo.area_name}-{pigcms{$vo.adress}</label></span>
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
											<option value="{pigcms{$vo.cat_id}" <if condition="$appoint_list['cat_fid'] eq $vo['cat_id']">selected="selected"</if>>{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
									<select id="choose_catid" name="cat_id" class="col-sm-1" style="margin-right:10px;">
										<volist name="s_category_list" id="vo">
											<option value="{pigcms{$vo.cat_id}" <if condition="$appoint_list['cat_id'] eq $vo['cat_id']">selected="selected"</if>>{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
								</div>
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<table class="table table-striped">
										<tbody>
											<tr>
												<th scope="col">菜单序号</th>
												<th scope="col">菜单名称</th>
												<th scope="col">价格</th>
												<th scope="col">描述</th>    
											</tr>
											<?php foreach($product_list as $key => $val): ?>
												<tr class="parent">
													<td><i class="ace-icon fa"></i>序号<?php echo $key+1; ?></td>
													<td><input name="custom_name_s[]" type="text" class="span2 title" value="<?php echo $val['name']; ?>"></td>
													<td>￥<input name="custom_price_s[]" type="text" class="span2 keyword" value="<?php echo $val['price']; ?>"></td>
													<td><input name="custom_content_s[]" type="text" class="span3 url" value="<?php echo $val['content']; ?>"></td>
													<input name="custom_id_s[]" type="hidden" value="<?php echo $val['id']; ?>" />
												</tr>
											<?php endforeach; ?>
											<?php for($i=(count($product_list))+1; $i<=10; $i++): ?>
												<tr class="parent">
													<td><i class="ace-icon fa"></i>序号<?php echo $i; ?></td>
													<td><input name="custom_name[]" type="text" class="span2 title" value=""></td>
													<td>￥<input name="custom_price[]" type="text" class="span2 keyword" value=""></td>
													<td><input name="custom_content[]" type="text" class="span3 url" value=""></td>
												</tr>
											<?php endfor; ?>
										</tbody>
									</table>
								</div>
								<div class="form-group" >
									<label class="col-sm-1">预约详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
									<textarea name="appoint_pic_content" id="content" style="width:702px;"><?php echo $appoint_list['appoint_pic_content']; ?></textarea>
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
										<ul id="upload_pic_ul">
											<volist name="pic_list" id="vo">
												<li class="upload_pic_li"><img src="{pigcms{$vo.url}"/><input type="hidden" name="pic[]" value="{pigcms{$vo.title}"/><br/><a href="#" onclick="deleteImg('{pigcms{$vo.title}',this);return false;">[ 删除 ]</a></li>
											</volist>
										</ul>
									</div>
								</div>
							</div>
							<div id="txtorder" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">预约状态：</label>
									<select name="appoint_status" class="col-sm-1">
										<option value="0" <if condition="$appoint_list['appoint_status'] eq 0">selected="selected"</if>>开启</option>
										<option value="1" <if condition="$appoint_list['appoint_status'] eq 1">selected="selected"</if>>关闭</option>
									</select>
									<span class="form_tips">为了方便用户能查找到以前的订单，预约无法删除！</span>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" id="save_btn"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
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
<script type="text/javascript">$(function($){
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
			//html += '<option value="">请选择</option>';  
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
		$.post("{pigcms{:U('Appoint/frame_edit', array('appoint_id'=>$appoint_list['appoint_id']))}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = window.location.href;
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