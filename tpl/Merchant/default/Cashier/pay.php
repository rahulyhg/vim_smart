<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银台</a>
			</li>
			<li class="active">在线支付配置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<!-- Custom and plugin javascript -->
	<link href="{pigcms{$static_path}plugins/css/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="{pigcms{$static_path}js/inspinia.js"></script>
	<script src="{pigcms{$static_path}plugins/js/sweetalert/sweetalert.min.js"></script>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title clearfix">
						<h5 style="margin: 10px 0 0px;">支付配置</h5>
					</div>
					<div class="ibox-content">
						<table class="table table-striped">
							<tr>							
								<td><img style="margin-left: 15px" src="{pigcms{$static_path}images/pay_icon/weixin.png"></td>
								<td style="padding-top: 14px;">微信支付</td>
								<td id="wxapiinfo1"><button class="btn btn-info " type="button" <?php if($payConfig['configData']['alipay']['isOpen']==1){ echo 'checked="checked"'; }?> data-toggle="modal" data-target="#weixinSetting"><i class="fa fa-paste"></i>配置信息</button></td>
								<td id="wxapiinfo2"></td>
							</tr>
							<tr>
								<td><img style="margin-left: 15px" src="{pigcms{$static_path}images/pay_icon/alipay.png"></td>
								<td style="padding-top: 14px;">支付宝支付</td>
								<td><button class="btn btn-info " type="button"><i class="fa fa-paste"></i>开发中</button></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" id="weixinSetting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">微信支付 支付配置</h4>
					<?php if($payConfig['proxymid']>0){?>
					<div class="alert alert-warning" style="margin:15px 0px 0px 0px;">您已经成为管理员的特约商家，请不要改动以下配置信息</div>
					<?php }?>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="new_wxpay_box" class="wxpay_box">
							
							<div class="form-group">
								<label>Appid</label>
								<input type="text" placeholder="Appid" value="<?php echo $payConfig['configData']['weixin']['appid']; ?>" name="weixin[appid]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['appid']){?>readonly="readonly"<?php }?> >
							</div>

							<div class="form-group">
								<label>AppSecret</label>
								<input type="text" placeholder="应用密钥" value="<?php echo $payConfig['configData']['weixin']['appSecret']; ?>" name="weixin[appSecret]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['appSecret']){?>readonly="readonly"<?php }?>>
							</div>

							<div class="form-group">
								<label>微支付商户号</label>
								<input type="text" placeholder="商户号" value="<?php echo $payConfig['configData']['weixin']['mchid']; ?>" name="weixin[mchid]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['mchid']){?>readonly="readonly"<?php }?>>
							</div>
							<div class="form-group">
								<label>API密钥</label>
								<input type="text" placeholder="Api密钥" value="<?php echo $payConfig['configData']['weixin']['key']; ?>" name="weixin[key]" class="form-control" <?php if($payConfig['proxymid']>0 && $payConfig['configData']['weixin']['key']){?>readonly="readonly"<?php }?>>
							</div>
							<div class="form-group uploade">
								<label>apiclient_cert私钥文件</label>
								<input type="text" placeholder="apiclient_cert私钥文件" <?php if($payConfig['configData']['weixin']['apiclient_cert']){echo 'value="pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control" >
								<input type="hidden" placeholder="apiclient_cert私钥文件" value="<?php echo urldecode($payConfig['configData']['weixin']['apiclient_cert']); ?>" name="weixin[apiclient_cert]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>
							<div class="form-group uploade">
								<label>apiclient_key公钥文件</label>
								<input type="text" placeholder="apiclient_key公钥文件" <?php if($payConfig['configData']['weixin']['apiclient_key']){echo 'value="pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control">
								<input type="hidden" placeholder="apiclient_key公钥文件" value="<?php echo urldecode($payConfig['configData']['weixin']['apiclient_key']); ?>" name="weixin[apiclient_key]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>
								<div class="form-group uploade">
								<label>CA证书文件</label>
								<input type="text" placeholder="微信支付rootca文件" <?php if($payConfig['configData']['weixin']['rootca']){echo 'value="rootca.pem文件已上传" readonly="readonly"';}else{echo 'value=""';} ?> class="form-control">
								<input type="hidden" placeholder="微信支付rootca文件" value="<?php echo urldecode($payConfig['configData']['weixin']['rootca']); ?>" name="weixin[rootca]" class="hiddeninput">
								<div class="dropz" style="height: 34px;line-height: 34px;border: 1px solid #e5e6e7;width: 70px;text-align: center;position: relative;top: -34px;float: right;cursor: pointer;">文件上传</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-confirm">确定</button>
                </div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal inmodal" tabindex="-1"  id="wxApi_Setting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				
				<div class="modal-header">
                    <button type="button" class="close _close"><span>×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">微信服务器配置接口信息</h4>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="wxActionBox" class="wxpay_box">
							<div class="form-group">
								<label>URL：</label>
								<input type="text" placeholder="服务器推送事件地址" value='{pigcms{:U("Cashier/sendCms",array("mymid"=>$payConfig["mid"]))}' class="form-control" readonly="readonly">
							</div>
							<div class="form-group">
								<label>Token：</label>
								<input type="text" placeholder="Token令牌" value="" class="form-control wxtoken" readonly="readonly">
							</div>
							<div class="form-group">
								<label>EncodingAESKey：</label>
								<input type="text" placeholder="消息加解密密钥" value="" class="form-control aeskey" readonly="readonly">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-primary _close">关闭</button>
                </div>
			</div>
		</div>
	</div>
	<!--<div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" id="alipaySetting">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-wrench modal-icon"></i>
                    <h4 class="modal-title">支付宝支付 支付配置</h4>
                </div>
				<div class="modal-body">
					<div class="setting_rows">
						<div id="new_wxpay_box" class="wxpay_box">
							
							<div class="form-group">
								<label>Appid</label>
								<input type="text" placeholder="Appid" value="<?php echo $payConfig['configData']['alipay']['appid']; ?>" name="alipay[appid]" class="form-control">
							</div>
							<div class="form-group">
								<label>Key</label>
								<input type="text" placeholder="Key" value="<?php echo $payConfig['configData']['alipay']['key']; ?>" name="alipay[key]" class="form-control">
							</div>
							<div class="form-group">
								<label>卖家账号</label>
								<input type="text" placeholder="卖家账号" value="<?php echo $payConfig['configData']['alipay']['name']; ?>" name="alipay[name]" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-confirm">确定</button>
                </div>
				</form>
			</div>
		</div>
	</div>-->
</div>
<script>
	 var apihtml="<button class='btn btn-info api' type='button' <?php if($payConfig['configData']['alipay']['isOpen'] == 1){ echo 'checked=\"checked\"'; }?> id=\"wxApiSetting\"> API接口 </button>";
	 <?php if(in_array($this->merchant['source'],array(1,2,3))){?>
		apihtml='';
	 <?php }?>
	 if(mobilecheck()){
	     $('#wxapiinfo1').append(apihtml);
		 $('#wxapiinfo1 .api').css('margin-top','15px');
		 $('#new_wxpay_box .uploade').css('display','none');
		 $('#new_wxpay_box').append('<div class="form-group noticee"><label>apiclient_cert私钥文件，apiclient_key公钥文件，CA证书文件等配置请登陆PC端修改</label></div>');
	 }else{
		 $('#new_wxpay_box .uploade').css('display','block');
		 $('#new_wxpay_box .noticee').remove();
	     $('#wxapiinfo2').html(apihtml);
	 }
        $(document).ready(function(){
            /*$('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });*/
			$('.btn-confirm').click(function(){
				var payConfigData=$(this).parents('form').serialize();
				//alert(htmlToArray(payConfigData));
				$.post('{pigcms{:U("Cashier/pay")}',{data:htmlToArray(payConfigData)},function(result){
					if(result.status==1){
						swal({
        					title: "成功",
        					text: result.msg,
        					type: "success"
    					}, function () {
							//alert(result.msg);
        					window.location.reload();
   						});
					}else{
						//alert(result.msg);
						swal("失败", result.msg , "error");
					}
				},'json');
			});
			/*$(".dropz").dropzone({
				url: '{pigcms{:U("Cashier/pem_upload")}',
				addRemoveLinks: false,
				maxFilesize: 1,
				acceptedFiles: ".pem",
				uploadMultiple: false,
				init: function() {
					this.on("success", function(file,responseText) {
						var rept = $.parseJSON(responseText);
						/***这里的this.element 是 $(".dropz")****/
						/*$(this.element).siblings('.form-control').val('pem文件已上传');
						$(this.element).siblings('.form-control').attr('readonly','readonly');
						$(this.element).siblings('.hiddeninput').val(rept.fileUrl);
					});
				}
			});*/
        });
		function htmlToArray(data){
			data = data.split('&');
			var info = {};
			$.each(data,function(k,v){
				v = v.replace('%5D','').split('=');
				var s = v[0].split('%5B');
				typeof(info[s[0]]) == 'undefined' && (info[s[0]] = {}),info[s[0]][s[1]] = v[1];
			});
			return info;
		}

		 $("#wxApiSetting").click(function(){
			//alert('{pigcms{:U("Cashier/getApiData")}');
			$.post('{pigcms{:U("Cashier/getApiData")}',function(ret){
				//alert(ret.wxtoken);
			    $('#wxApi_Setting .wxtoken').val(ret.wxtoken);
				$('#wxApi_Setting .aeskey').val(ret.aeskey);			
				var winW=$(window).width();
				if(winW<750){
				   $('#wxApi_Setting .modal-dialog').css('width','92%');
				}else{
				   $('#wxApi_Setting .modal-dialog').width(730);
				}
				$('body').append('<div class="modal-backdrop in"></div>');
				$('#wxApi_Setting').show();
			},'JSON');
		  });
		  $("#wxApi_Setting ._close").click(function(){
			  $('#wxApi_Setting').hide();
			  $('#wxApi_Setting .wxtoken').val('');
			  $('#wxApi_Setting .aeskey').val('');
			  $('.modal-backdrop').remove();
		  });
    </script>

<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<include file="Public:footer"/>
