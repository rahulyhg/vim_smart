<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Ownpay/index')}">自有支付配置</a>
			</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="alert alert-info" style="margin:10px 0;">
			<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
			开启自有支付，则用户会优先使用自有支付！例如配置了微信支付，则支付时显示的“微信支付”会调用自有支付。
		</div>
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<if condition="$hasBind">
								<li class="active">
									<a data-toggle="tab" href="#weixin">微信支付</a>
								</li>
							</if>
							<li <if condition="!$hasBind"> class="active"</if>>
								<a data-toggle="tab" href="#tenpay">财付通支付</a>
							</li>
							<li>
								<a data-toggle="tab" href="#yeepay">银行卡支付(易宝支付)</a>
							</li>
							<li>
								<a data-toggle="tab" href="#allinpay">银行卡支付(通联支付)</a>
							</li>
							<li>
								<a data-toggle="tab" href="#chinabank">银行卡支付(网银在线)</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
						<div class="tab-content">
							<if condition="$hasBind">
								<div id="weixin" class="tab-pane active">			
										<div class="form-group">
											<label class="col-sm-1" for="wxpay_open">是否开启</label>
											<select name="weixin[open]" id="wxpay_open">
												<option value="0" <if condition="$ownpay['weixin']['open'] eq 0">selected="selected"</if>>关闭</option>
												<option value="1" <if condition="$ownpay['weixin']['open'] eq 1">selected="selected"</if>>开启</option>
											</select>
										</div>
										<div class="form-group">
											<label class="col-sm-1"><label for="pay_weixin_appid">Appid</label></label>
											<input class="col-sm-2" size="20" name="weixin[pay_weixin_appid]" id="pay_weixin_appid" type="text" value="{pigcms{$ownpay.weixin.pay_weixin_appid}"/>
										</div>
										<div class="form-group">
											<label class="col-sm-1"><label for="pay_weixin_mchid">Mchid</label></label>
											<input class="col-sm-2" size="20" name="weixin[pay_weixin_mchid]" id="pay_weixin_mchid" type="text" value="{pigcms{$ownpay.weixin.pay_weixin_mchid}"/>
										</div>
										<div class="form-group">
											<label class="col-sm-1"><label for="pay_weixin_key">Key</label></label>
											<input class="col-sm-2" size="20" name="weixin[pay_weixin_key]" id="pay_weixin_key" type="text" value="{pigcms{$ownpay.weixin.pay_weixin_key}"/>
										</div>
										<div class="form-group" style="display:none;">
											<label class="col-sm-1"><label for="pay_weixin_appsecret">Key</label></label>
											<input class="col-sm-2" size="20" name="weixin[pay_weixin_appsecret]" id="pay_weixin_appsecret" type="text" value="123456"/>
										</div>
								</div>
							</if>
							<div id="tenpay" class="tab-pane <if condition="!$hasBind">active</if>">
								<div class="form-group">
									<label class="col-sm-1" for="tenpay_open">是否开启</label>
									<select name="tenpay[open]" id="tenpay_open">
										<option value="0" <if condition="$ownpay['tenpay']['open'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$ownpay['tenpay']['open'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_tenpay_partnerid">商户号</label></label>
									<input class="col-sm-2" size="20" name="tenpay[pay_tenpay_partnerid]" id="pay_tenpay_partnerid" type="text" value="{pigcms{$ownpay.tenpay.pay_tenpay_partnerid}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_tenpay_partnerkey">密钥</label></label>
									<input class="col-sm-2" size="20" name="tenpay[pay_tenpay_partnerkey]" id="pay_tenpay_partnerkey" type="text" value="{pigcms{$ownpay.tenpay.pay_tenpay_partnerkey}"/>
								</div>
							</div>
							<div id="yeepay" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" for="yeepay_open">是否开启</label>
									<select name="yeepay[open]" id="yeepay_open">
										<option value="0" <if condition="$ownpay['yeepay']['open'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$ownpay['yeepay']['open'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_yeepay_merchantaccount">商户编号</label></label>
									<input class="col-sm-2" size="20" name="yeepay[pay_yeepay_merchantaccount]" id="pay_yeepay_merchantaccount" type="text" value="{pigcms{$ownpay.yeepay.pay_yeepay_merchantaccount}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_yeepay_merchantprivatekey">商户私钥</label></label>
									<input class="col-sm-2" size="20" name="yeepay[pay_yeepay_merchantprivatekey]" id="pay_yeepay_merchantprivatekey" type="text" value="{pigcms{$ownpay.yeepay.pay_yeepay_merchantprivatekey}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_yeepay_merchantpublickey">商户公钥</label></label>
									<input class="col-sm-2" size="20" name="yeepay[pay_yeepay_merchantpublickey]" id="pay_yeepay_merchantpublickey" type="text" value="{pigcms{$ownpay.yeepay.pay_yeepay_merchantpublickey}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_yeepay_yeepaypublickey">易宝公钥</label></label>
									<input class="col-sm-2" size="20" name="yeepay[pay_yeepay_yeepaypublickey]" id="pay_yeepay_yeepaypublickey" type="text" value="{pigcms{$ownpay.yeepay.pay_yeepay_yeepaypublickey}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_yeepay_productcatalog">商品类别码</label></label>
									<input class="col-sm-2" size="20" name="yeepay[pay_yeepay_productcatalog]" id="pay_yeepay_productcatalog" type="text" value="{pigcms{$ownpay.yeepay.pay_yeepay_productcatalog}"/>
								</div>
							</div>
							<div id="allinpay" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" for="allinpay_open">是否开启</label>
									<select name="allinpay[open]" id="allinpay_open">
										<option value="0" <if condition="$ownpay['allinpay']['open'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$ownpay['allinpay']['open'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_allinpay_merchantid">商户号</label></label>
									<input class="col-sm-2" size="20" name="allinpay[pay_allinpay_merchantid]" id="pay_allinpay_merchantid" type="text" value="{pigcms{$ownpay.allinpay.pay_allinpay_merchantid}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_allinpay_merchantkey">MD5 KEY</label></label>
									<input class="col-sm-2" size="20" name="allinpay[pay_allinpay_merchantkey]" id="pay_allinpay_merchantkey" type="text" value="{pigcms{$ownpay.allinpay.pay_allinpay_merchantkey}"/>
								</div>
							</div>
							<div id="chinabank" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" for="chinabank_open">是否开启</label>
									<select name="chinabank[open]" id="chinabank_open">
										<option value="0" <if condition="$ownpay['chinabank']['open'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$ownpay['chinabank']['open'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_chinabank_account">商户号</label></label>
									<input class="col-sm-2" size="20" name="chinabank[pay_chinabank_account]" id="pay_chinabank_account" type="text" value="{pigcms{$ownpay.chinabank.pay_chinabank_account}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="pay_chinabank_key">MD5 KEY</label></label>
									<input class="col-sm-2" size="20" name="chinabank[pay_chinabank_key]" id="pay_chinabank_key" type="text" value="{pigcms{$ownpay.chinabank.pay_chinabank_key}"/>
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
$(function(){
	$('#add_form').submit(function(){
		$('#save_btn').prop('disabled',true);
		$.post("{pigcms{:U('Ownpay/save')}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.reload();
			}else{
				alert(result.info);
			}
			$('#save_btn').prop('disabled',false);
		})
		return false;
	});
});
function deleteImage(path,obj){
	$.post("{pigcms{:U('Group/ajax_del_pic')}",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>
<include file="Public:footer"/>