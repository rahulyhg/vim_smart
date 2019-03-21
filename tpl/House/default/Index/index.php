<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Index/index')}">社区管理</a>
			</li>
			<li class="active">基本信息设置</li>
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
					<form  class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Index/village_edit')}">
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="name">物业名称</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$village_info.property_name}" type="text" style="border:none;background:white!important; width:30%;" readonly="readonly"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="name">小区名称</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$village_info.village_name}" type="text" style="border:none;background:white!important;" readonly="readonly"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">物业联系方式</label></label>
									<input class="col-sm-2" size="20" name="phone" id="phone" type="text" value="{pigcms{$village_info.property_phone}"/>
									<span class="form_tips">多个电话号码以空格分开</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="property_address">物业联系地址</label></label>
									<input class="col-sm-2" size="20" name="property_address" id="property_address" type="text" value="{pigcms{$village_info.property_address}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="long_lat">小区经纬度</label></label>
									<input class="col-sm-2" size="10" name="long_lat" id="long_lat" type="text" readonly="readonly" value="<if condition="$village_info['long']">{pigcms{$village_info.long},{pigcms{$village_info.lat}</if>"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" id="show_map_frame" data-toggle="modal">点击选取经纬度</a>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>小区地址</label></label>
									<fieldset id="choose_cityarea" province_id="{pigcms{$village_info.province_id}" city_id="{pigcms{$village_info.city_id}" area_id="{pigcms{$village_info.area_id}" circle_id="{pigcms{$village_info.circle_id}"></fieldset>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="village_address">小区地址</label></label>
									<input class="col-sm-2" size="20" name="village_address" id="adress" type="text" value="{pigcms{$village_info.village_address}"/>
									<span class="form_tips">地址不能带有上面所在地选择的省/市/区/商圈信息。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="property_price">物业费单价</label></label>
									<input class="col-sm-1" size="10" name="property_price" id="property_price" type="text" value="{pigcms{$village_info.property_price|floatval=###}"/>
									<span class="form_tips">元/平方米 （支持两位小数，设置为0表示不支持）</span>
								</div>
<!--                                抄表配置-->
                                <div class="form-group">
                                    <label class="col-sm-1" style="line-height: 38px;"><label for="has_custom_pay">抄表配置</label></label>
                                    <div class="radio">
                                        <volist name="re_setmeter" id="row">
                                            <label style="padding-left:0px;padding-right:20px;">
                                                <input class="show_{pigcms{$row.sign}" name="re_setmeter[{pigcms{$row.sign}][is_use]" value="t" type="checkbox" class="ace"
                                                <if condition="$row.is_use eq t">checked</if>
                                                />
                                                <span class="lbl" style="z-index: 1">{pigcms{$row.desc}</span>
                                            </label>
                                        </volist>
                                        <span class="form_tips">（读取物业默认全局配置项，此处为复选框，可多选）</span>
                                    </div>
                                </div>
                                <volist name="re_setmeter" id="row">
                                    <div class="row" style="padding:20px 10px 0px 12px;background-color: #eee;">
                                        <volist name="row._child" id="rr">
                                            <!--去除正在使用限制 by zhukeqin-->
                                            <if condition="t eq t">
                                                <div class="form-group {pigcms{$row.sign}" style="display: inline-block; width:420px;">
                                                    <label class="col-md-4" style="width:90px;"><label for="{pigcms{$rr.sign}">{pigcms{$rr.desc}:</label></label>
                                                    <input class="col-md-2" size="10" name="re_setmeter[{pigcms{$row.sign}][{pigcms{$rr.sign}][unit_price]"  type="text" style="width: 40px;" value="{pigcms{$rr.unit_price|floatval=###}" />
                                                    <span  class="col-md-3 form_tips">{pigcms{$row.unit}</span>
                                                    <strong class="col-md-1 form_tips">X</strong>
                                                    <input class="col-md-2" size="10" name="re_setmeter[{pigcms{$row.sign}][{pigcms{$rr.sign}][rate]"  type="text" style="width: 40px;" value="{pigcms{$rr.rate|floatval=###}" />
                                                    <span class="col-md-1 form_tips">倍</span>
                                                </div>
                                            </if>
                                        </volist>
                                    </div>
                                </volist>

<!--								<div class="form-group">-->
<!--									<label class="col-sm-1"><label for="water_price">水费单价</label></label>-->
<!--									<input class="col-sm-1" size="10" name="water_price" id="water_price" type="text" value="{pigcms{$village_info.water_price|floatval=###}" />-->
<!--									<span class="form_tips">元/立方米 （支持两位小数，设置为0表示不支持）</span>-->
<!--								</div>-->
<!--								<div class="form-group">-->
<!--									<label class="col-sm-1"><label for="electric_price">电费单价</label></label>-->
<!--									<input class="col-sm-1" size="10" name="electric_price" id="electric_price" type="text" value="{pigcms{$village_info.electric_price|floatval=###}" />-->
<!--									<span class="form_tips">元/千瓦时(度) （支持两位小数，设置为0表示不支持）</span>-->
<!--								</div>-->
<!--								<div class="form-group">-->
<!--									<label class="col-sm-1"><label for="gas_price">燃气费单价</label></label>-->
<!--									<input class="col-sm-1" size="10" name="gas_price" id="gas_price" type="text" value="{pigcms{$village_info.gas_price|floatval=###}"  />-->
<!--									<span class="form_tips">元/立方米 （支持两位小数，设置为0表示不支持）</span>-->
<!--								</div>-->
								<div class="form-group" style="padding-top:30px;">
									<label class="col-sm-1"><label for="park_price">停车位单价</label></label>
									<input class="col-sm-1" size="10" name="park_price" id="park_price" type="text" value="{pigcms{$village_info.park_price|floatval=###}" />
									<span class="form_tips">元/月 （支持两位小数，设置为0表示不支持）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" style="line-height:40px;"><label for="has_custom_pay">自定义缴费</label></label>
									<div class="radio">
										<label style="padding-left:0px;padding-right:20px;"><input name="has_custom_pay" value="1" type="radio" class="ace" <if condition="$village_info.has_custom_pay eq 1">checked</if>/><span class="lbl" style="z-index: 1">支持</span></label>
										<label style="padding-left:0px;"><input name="has_custom_pay" value="0" type="radio" class="ace" <if condition="$village_info.has_custom_pay eq 0">checked</if>/><span class="lbl" style="z-index: 1">不支持</span></label>
										<span class="form_tips">开通后，用户可以自定义名称、费用向物业发起缴费！方便物业上门维修等自定义收取费用</span>
									</div>
								</div>

                                <div class="form-group">
                                    <label class="col-sm-1" style="line-height:40px;"><label for="has_custom_pay">账单生成时间</label></label>
                                    <div class="radio">
                                        <label style="padding-left:0px;padding-right:20px;">每月<input name="bill_begin_time" value="{pigcms{$village_info.bill_begin_time}" type="number" class="ace" min="1" max="30"/>号</label>
                                        <span class="form_tips">（只有在设置的时间内能生成账单）</span>
                                    </div>
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
var lock = 0;
KindEditor.ready(function(K){
	
	$('#edit_form').submit(function(){
		$('#edit_form button[type="submit"]').prop('disabled',true).html('保存中...');
		if (lock = 1) {
			return;
		}
		lock = 1;
		$.post("{pigcms{:U('Index/village_edit')}",$('#edit_form').serialize(),function(result){
			lock = 0;
			if(result.status == 1){
				window.location.href = "{pigcms{:U('Index/index')}";
			}else{
				$('#edit_form button[type="submit"]').prop('disabled',false).html('<i class="ace-icon fa fa-check bigger-110"></i>保存');
				alert(result.info);
			}
		})
		return false;
	});
	
});
</script>


<script>
    $("[class^=show_]").each(function(){
        var c = $(this).attr('class');
        var target = c.split('_')[1];
        if(this.checked){
            $('.'+target).show();
        }else{
            $('.'+target).hide();
        }
    });


    $("[class^=show_]").click(function(){
        var c = $(this).attr('class');
        var target = c.split('_')[1];
        if(this.checked){
            $('.'+target).show();
        }else{
            $('.'+target).hide();
        }
    });
</script>
<include file="Public:footer"/>