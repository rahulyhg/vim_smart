<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Deliver/user')}">配送管理</a>
			</li>
			<li class="active">添加配送员</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本设置</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<input type="hidden" name="uid" value="{pigcms{$now_user['uid']}"/>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="name">姓名</label></label>
									<input class="col-sm-2" size="20" name="name" id="name" type="text" value="{pigcms{$now_user['name']}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">联系电话</label></label>
									<input class="col-sm-2" size="20" name="phone" id="phone" type="text" value="{pigcms{$now_user['phone']}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="qq">密码</label></label>
									<input class="col-sm-2" size="20" name="pwd" id="pwd" type="text" value=""/>
									<span class="form_tips">不填写就不做修改。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="qq">配送范围</label></label>
									<input class="col-sm-2" size="20" name="range" id="range" type="text" value="{pigcms{$now_user['range']}"/>
									<span class="form_tips">（公里）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="long_lat">店铺经纬度</label></label>
									<input class="col-sm-2" size="10" name="long_lat" id="long_lat" type="text" readonly="readonly" value="{pigcms{$now_user['lng']},{pigcms{$now_user['lat']}"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" id="show_map_frame" data-toggle="modal">点击选取经纬度</a>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>配送员常驻地</label></label>
									<fieldset id="choose_cityarea" province_id="{pigcms{$now_user.province_id}" city_id="{pigcms{$now_user.city_id}" area_id="{pigcms{$now_user.area_id}" circle_id="{pigcms{$now_user.circle_id}"></fieldset>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="adress">地址</label></label>
									<input class="col-sm-2" size="20" name="adress" id="adress" type="text" value="{pigcms{$now_user['site']}"/>
									<span class="form_tips">地址不能带有上面所在地选择的省/区/商圈信息。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="have_meal">状态</label>
									<select name="status" id="status">
										<option value="1" <if condition='$now_user["status"] eq 1 || !$now_user["status"]'>selected="selected"</if> >正常</option>
										<option value="0" <if condition='$now_user["status"] eq 0'>selected="selected"</if>>禁止</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="have_meal">选择店铺</label>
									<select name="store_id" id="store_id">
										<volist name="waimai_store" id='waimai'>
										<option value="{pigcms{$waimai.store_id}" <if condition='$now_user["store_id"] eq $waimai["store_id"] || !$now_user["store_id"]'>selected="selected" </if> >{pigcms{$waimai.name}</option>
										</volist>
									</select>
								</div>
							</div>
						</div>
						<div class="space"></div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
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
<div id="modal-table" class="modal fade" tabindex="-1" style="display:block;">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content" style="width:100%;">
			<div class="modal-header no-padding" style="width:100%;">
				<div class="table-header">
					<button id="close_button" type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					(用鼠标滚轮可以缩放地图)    拖动红色图标，经纬度框内将自动填充经纬度。
				</div>
			</div>
			<div class="modal-body no-padding" style="width:100%;">
				<form id="map-search" style="margin:10px;">
					<input id="map-keyword" type="textbox" style="width:500px;" placeholder="尽量填写城市、区域、街道名"/>
					<input type="submit" value="搜索"/>
				</form>
				<div style="width:100%;height:600px;min-height:600px;" id="cmmap"></div>
			</div>
			<div class="modal-footer no-margin-top">
				<button class="btn btn-sm btn-success pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					关闭
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var static_public="{pigcms{$static_public}",static_path="{pigcms{$static_path}",merchant_index="{pigcms{:U('Index/index')}",choose_province="{pigcms{:U('Area/ajax_province')}",choose_city="{pigcms{:U('Area/ajax_city')}",choose_area="{pigcms{:U('Area/ajax_area')}",choose_circle="{pigcms{:U('Area/ajax_circle')}";
</script>
<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>
<style>
.BMap_cpyCtrl{display:none;}
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
#upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	$('#edit_form').submit(function(){
		$('#edit_form button[type="submit"]').prop('disabled',true).html('保存中...');
		$.post("{pigcms{:U('Deliver/user_edit')}",$('#edit_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Deliver/user')}";
			}else{
				$('#edit_form button[type="submit"]').prop('disabled',false).html('<i class="ace-icon fa fa-check bigger-110"></i>保存');
				alert(result.info);
			}
		})
		return false;
	}); 
</script>
<include file="Public:footer"/>
