<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Cashier/index')}">商家收银</a>
			</li>
			<li class="active">商家收银台</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<link href="{pigcms{$static_path}plugins/css/sweetalert/sweetalert.css" rel="stylesheet">   
	<link href="{pigcms{$static_path}css/app.css" rel="stylesheet">
	<script src="{pigcms{$static_path}plugins/js/sweetalert/sweetalert.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/cash",array("type"=>1))}'>扫码收银</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/cash",array("type"=>2))}'>扫码退款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/ewmPay")}'>二维码收款</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/ewmRecord")}'>二维码记录</button>
					<button class="btn btn-success" onclick="CreateShop(this)" value='{pigcms{:U("Cashier/payRecord")}'>收款记录</button>
					<div class="wrapper wrapper-content animated fadeIn">
						<div class="row">
							<div class="col-lg-6">
								<div class="tabs-container weixin">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tab-1">扫码收款</a></li>
										<li class=""><a data-toggle="tab" href="#tab-2">扫码退款</a></li>
									</ul>
									<div class="tab-content">
										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 micropay"></div>
												</div>
											</div>
										</div>
										<div id="tab-2" class="tab-pane">
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 micropayRefund"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	wx.config({
	debug: false,
	appId: '<?php echo $signdata["appId"]; ?>',
	timestamp: '<?php echo $signdata["timestamp"]; ?>',
	nonceStr: '<?php echo $signdata["nonceStr"]; ?>',
	signature: '<?php echo $signdata["signature"]; ?>',
	jsApiList: [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'scanQRCode',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getLocation',
		'openLocation',
		'getNetworkType'
	]
});

	var Ttype=<?php echo $type;?>;
	 if(Ttype==2){
		$('.nav-tabs li').removeClass('active');
	    $('.nav-tabs li:last').addClass('active');
		$('#tab-1').removeClass('active');
		$('#tab-2').addClass('active');
	 }
		!function(a,b,wx){
			function is_mobile(){
				var ua = navigator.userAgent.toLowerCase();
				if ((ua.match(/(iphone|ipod|android|ios|ipad)/i))){
					if(navigator.platform.indexOf("Win") == 0 || navigator.platform.indexOf("Mac") == 0){
						return false;
					}else{
						return true;
					}
				}else{
					return false;
				}
			}
			function is_weixin(){
			    var ua = navigator.userAgent.toLowerCase();
			    if(is_mobile() && ua.indexOf('micromessenger') != -1){  
			        return true;
			    } else {  
			        return false;  
			    }
			}
			var c = c || {};
			c.config = {
				data : ['weixin_micropay','weixin_micropayRefund']
			}
			c.init = function(){
				c.tpl();
			}
			
			c.loadJs = function(d){
				var oHead = document.getElementsByTagName('head').item(0),
   					oScript= document.createElement("script");   
   				oScript.type = "text/javascript";   
				oScript.src = d;   
  				oHead.appendChild( oScript);  
			}
			c.tmpl = function(d){
				var e = {
					weixin : {
						micropay : '<h3 class="m-t-none m-b">收款</h3><p>只适用微信扫码支付</p><p>扫码支付确认信息.</p><form role="form" action="?g=Merchant&c=cashier&a=cash&type=1"><div class="form-group"><label>商品描述</label> <input type="text" placeholder="商品名称" name="goods_name" class="form-control"></div><div class="form-group"><label>支付金额</label> <input type="text" placeholder="支付金额" name="goods_price" class="form-control"></div><div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>扫码收款</strong></button></div></form>',
						micropayRefund : '<h3 class="m-t-none m-b">退款</h3><p>只适用微信扫码支付退款</p><p>扫微信扫码支付交易详情页的条形码来退款.</p><form role="form" action="?g=Merchant&c=cashier&a=cash&type=2"><div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>扫码退款</strong></button></div></form>',
					}
				}
				var f;
				$.each(d,function(g,h){
					f = e = e[h];
				});
				return f;
			}
			c.tpl = function(){
				$.each(this.config.data,function(d,e){
					c.create(e.split('_'));
				});
			}
			c.submit = function(d){
    			swal({
				title: "提示 :)",
        			text: "确认此操作？",
        			type: "warning",
        			showCancelButton: true,
        			confirmButtonColor: "#DD6B55",
        			confirmButtonText: "确定",
					cancelButtonText: "取消",
        			closeOnConfirm: false
    			}, function () {
    			    var e = d.serialize();	
					b.post(d.attr('action'),e, function(data){
						console.log(data);
						if(data.error == 0){
							c.tpl();
							swal("成功!", data.msg, "success");
						}else{
							swal("失败!", data.msg, "error");
						}
					},'JSON');
    			});
			}
			c.create = function(s){
				function d(e){
					if(is_weixin()){
						wx.scanQRCode({
							needResult:1,
							scanType:["qrCode","barCode"],
							success:function (res){
								var result = res.resultStr;
								
								if(result.indexOf(',')>0){
									var result = result.split(',');
									result = result[1];
								}
								
								if(result && /^\d+$/g.test(result)){
				 					e.prepend('<input type="hidden" name="auth_code" value="'+result+'">');
				  					c.submit(e);
				    				return false;
								}else{
									swal("错误!", "不是有效的码，非法输入！", "error");
								}	
							}
						});
					}else{
						swal("错误!", "您使用的不是微信浏览器，此功能无法使用！", "error");
					}
				}
				var e = this.tmpl(s),
					f,
					i = b('body');
				$.each(s,function(g,h){
					f = i = i.find('.'+h);
				});
				f.html(e);
	
				if(is_weixin()){
					f.find('form').find('button[type="submit"]').click(function(){
						d(f.find('form'));
						return false;
					});
				}else{
					if(f.find('form').find('.form-group').size()){
						f.find('form').find('.form-group').last().after('<div class="form-group"><label>支付二维码</label><input type="text" placeholder="扫码获取条码数据" name="auth_code" class="form-control"></div>');
					}else{
						f.find('form').prepend('<div class="form-group"><label>支付二维码</label> <input type="text" placeholder="扫码获取条码数据" name="auth_code" class="form-control"></div>');
					}
					f.find('form').find('button[type="submit"]').click(function(){
						c.submit(f.find('form'));
						return false;
					});
				}
			}
			b(document).ready(function(){
				c.init();
			});
		}(window,jQuery,wx||{});
	
	function CreateShop(obj){
		//alert(obj.value);
		window.location.href=obj.value;
	}
	</script>
<include file="Public:footer"/>
