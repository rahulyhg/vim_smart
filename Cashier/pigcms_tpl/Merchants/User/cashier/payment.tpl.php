<!DOCTYPE html>
<html>
<head>
    <title>收银台 | 在线收银</title>
    <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<style type="text/css">
	.cgt {
		-moz-border-bottom-colors: none;
		-moz-border-left-colors: none;
		-moz-border-right-colors: none;
		-moz-border-top-colors: none;
		background-color: #ffffff;
		border-color: #e7eaec;
		border-image: none;
		border-style: solid solid none;
		border-width: 4px 0px 0;
		color: inherit;
		margin-bottom: 0;
		padding: 7px 10px 12px;
	}
	.le {width:100%; margin-top:20px;}
	td {white-space: nowrap;white-space: nowrap;
		text-overflow: ellipsis;}
	.zw {width:100%; margin:0px auto; background-color:#f9f9f9; border:10px #FFFFFF solid;}
	.zw2 {width:97%; margin:0px auto;}
	.ee {
		line-height:2.5; font-weight:bold; font-family:'微软雅黑'; border:1px #e5e6e7 solid; font-size:1.4em; color:#777777; background-color:#FFFFFF; margin:20px auto; padding-left:15px; padding-right:15px;"
	}
</style>
<body>

	<!--<embed id="ad" src="<?php echo PIGCMS_TPL_STATIC_PATH;?>music/alert.mp3" loop="0" autostart="false" hidden="true"></embed>-->

	<!--<input type="button" value="123" onclick="test()">-->
    <div id="wrapper">
		<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/leftmenu.tpl.php';?>
        <div id="page-wrapper" class="gray-bg">
		<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>在线收款</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>User</a>
                        </li>
                        <li>
                            <a>Cashier</a>
                        </li>
                        <li class="active">
                            <strong>payment</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
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
				<div class="row">
					<div class="col-lg-6" id="new">
					<div class="ee"><?php $paytime=$lastResult['paytime'] > 0 ? $lastResult['paytime'] : $lastResult['add_time']; echo date('Y-m-d H:i:s',$paytime);?>
						<span style="color:#ad0000;"><?php if(!empty($lastResult['nickname'])){
								echo $lastResult['nickname'];
							}elseif(!empty($lastResult['truename'])){
								echo htmlspecialchars_decode($lastResult['truename'],ENT_QUOTES);
							}elseif(!empty($lastResult['openid'])){
								echo $lastResult['openid'];
							}else{
								echo '未知客户';
							}?></span> <?php if($lastResult['refund']==0){echo '成功支付';}elseif($lastResult['refund']==2){echo '已退款';}?> ￥<span style="font-family:Arial; color:#cc0000;"><?php echo $lastResult['goods_price'];?></span> 元</div>
					</div>
				</div>
				<div class="cgt">
				<div class="le">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed; font-weight:bold;" class="dif">
						<tr>
							<td width="22%" height="35" align="left" bgcolor="#e7e7e7" style="color:#919191; padding-left:10px; border-right:1px #FFFFFF solid;"><strong>支付人</strong></td>
							<td width="37%" height="35" align="center" bgcolor="#e7e7e7" style="color:#919191; border-right:1px #FFFFFF solid;"><strong>支付时间</strong></td>
							<td width="20%" height="35" align="center" bgcolor="#e7e7e7" style="color:#919191; border-right:1px #FFFFFF solid;"><strong>支付金额</strong></td>
							<td width="21%" height="35" align="center" bgcolor="#e7e7e7" style="color:#919191;"><strong>操作</strong></td>
						</tr>
						<tbody class="" id="dd">
						<?php if(!empty($neworder)){
							foreach($neworder as $key=>$ovv){
								?>
								<tr class="" <?php if($key%2==1) echo 'bgcolor="#f1f1f1"'?>>
									<td height="45" align="left" onClick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);" style="padding-left:10px;overflow-x:hidden;overflow-y:hidden; padding-right:10px;"><?php if(!empty($ovv['nickname'])){
											echo $ovv['nickname'];
										}elseif(!empty($ovv['truename'])){
											echo htmlspecialchars_decode($ovv['truename'],ENT_QUOTES);
										}elseif(!empty($ovv['openid'])){
											echo $ovv['openid'];
										}else{
											echo '未知客户';
										}?></td>
									<td height="45" align="center" onClick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><?php $paytime=$ovv['paytime'] > 0 ? $ovv['paytime'] : $ovv['add_time']; echo date('Y-m-d H:i:s',$paytime);?></td>
									<td height="45" align="center" onClick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><?php echo $ovv['goods_price'];?></td>
									<td height="45" align="center"><div style="padding-top:5px;"><?php if($ovv['comefrom']>0){ ?> <button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> <?php }elseif($ovv['refund']!=2 && $ovv['refund']!=1){?> <button class="btn btn-sm btn-warning" onClick="wxRefundBtn(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button>  <?php }elseif($ovv['refund']==2){?><button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button><?php }?></div></td>
								</tr>
							<?php }}else{?>
							<tr class=""><td colspan="7">暂无订单</td></tr>
						<?php }?>
						</tbody>
					</table>
				</div>
				</div>
        	</div>
			<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
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
						micropay : '<h3 class="m-t-none m-b">收款</h3>' + '<p>只适用微信扫码支付</p>' + '<p>扫码支付确认信息.</p>' +
						'<form role="form" action="?m=User&c=cashier&a=pay" name="uuu" class="form1">' +
						'<div class="form-group">' +
						'<label>商品描述</label>'+
						'<input type="text"  name="goods_name" value="在线收款" readonly="readonly" class="form-control"></div>'+
						'<div class="form-group"><label>支付金额</label> ' +
						'<input type="text" placeholder="支付金额" name="goods_price" class="form-control" id="price"  onkeydown="if(event.keyCode==13) return false;"></div>' +
						'<div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" id="txtSearch"><strong>扫码收款</strong></button></div></form>',
						micropayRefund : '<h3 class="m-t-none m-b">退款</h3><p>只适用微信扫码支付退款</p><p>扫微信扫码支付交易详情页的条形码来退款.</p><form role="form" action="?m=User&c=cashier&a=wxSmRefund"><div><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>扫码退款</strong></button></div></form>',
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
			c.submit = function(d){//省去swal提示
					var e = d.serialize();
					b.post(d.attr('action'),e, function(data){//提交到pay方法
						console.log(data);
						if(data.error == 0){
							c.tpl();
//							$('input[name="goods_price"]').val("");
//							$('input[name="auth_code"]').val("");
//							$("#price").focus();
							document.getElementById("price").focus();
							$('embed').remove();
								$('body').append('<embed src="<?php echo PIGCMS_TPL_STATIC_PATH;?>music/alert.mp3" autostart="true" hidden="true" loop="false">');
							if(data.orderList && data.lastOne){
								$('#dd').text("");
								$('#new').text("");
								var contentList="";
								var newResult = "";
								for(var i=0;i<data.orderList.length;i++){
									if(data.orderList[i].nickname){
										var username=data.orderList[i].nickname;
									}else if(data.orderList[i].truename){
										var username=data.orderList[i].truename;
									}else if(data.orderList[i].openid){
										var username=data.orderList[i].openid;
									}else{
										var username="未知客户";
									}
									var bgcolor=(i%2==1) ? "bgcolor=#f1f1f1" : "";
									var timeVal=(data.orderList[i].paytime>0) ? data.orderList[i].paytime : data.orderList[i].add_time;
									if(data.orderList[i].comefrom > 0){
										var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> ';
									}else if(data.orderList[i].refund!=2 && data.orderList[i].refund!=1){
										var pay_status='<button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,'+data.orderList[i].id+','+data.orderList[i].mid+');"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button> ';
									}else{
										var pay_status='<button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button> ';
									}
									contentList+='<tr class="" '+bgcolor+'>';
									contentList+='<td height="45" align="left" onclick="GetDetail('+data.orderList[i].id+','+data.orderList[i].mid+');" style="padding-left:10px;overflow-x:hidden;overflow-y:hidden;">'+username+'</td>';
									contentList+='<td height="45" align="center" onclick="GetDetail('+data.orderList[i].id+','+data.orderList[i].mid+');">'+timeVal+'</td>';
									contentList+='<td height="45" align="center" onclick="GetDetail('+data.orderList[i].id+','+data.orderList[i].mid+');">'+data.orderList[i].goods_price+'</td>';
									contentList+='<td height="45" align="center" style="padding-top:5px;">'+pay_status+'</td></tr>';
								}
								if(data.lastOne.nickname){
									var username=data.lastOne.nickname;
								}else if(data.lastOne.truename){
									var username=data.lastOne.truename;
								}else if(data.lastOne.openid){
									var username=data.lastOne.openid;
								}else{
									var username="未知客户";
								}
								if(data.lastOne.refund==0){
									var result="成功支付";
								}else if(data.lastOne.refund==2){
									var result="已退款";
								}
								var timeVal=(data.lastOne.paytime>0) ? data.lastOne.paytime : data.lastOne.add_time;
								newResult+='<div class="ee">'+timeVal+'<span style="color:#ad0000;">'+'&nbsp;'+username+'</span>'+ '&nbsp;'+result+'&nbsp;￥'+'<span style="font-family:Arial; color:#cc0000;">'+data.lastOne.goods_price+'</span>'+ '&nbsp;元'+'</div>';
								$('#new').append(newResult);
								$('#dd').append(contentList);
							}
							}else{
								//swal("失败!", data.msg, "error");
								//alert(data.msg);
								//window.location.reload();
//								$(document).keydown(function (event){
//								if (event.keyCode == 13) {
//									$('.sweet-overlay').remove();
//									$('.sweet-alert').remove()
//									$('input[name="goods_price"]').val("");
//									$('input[name="auth_code"]').val("");
//									$("#price").focus();
//									return false;
//								}
//							});
							$('input[name="goods_price"]').val("");
							$('input[name="auth_code"]').val("");
							$("#price").focus();
							}
						},'JSON');
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
								f.find('form').find('.form-group').last().after('<div class="form-group"><label>支付二维码</label><input type="text" placeholder="扫码获取条码数据" name="auth_code" id="zhiFu" class="form-control" maxlength="20"></div>');
							}else{
								f.find('form').prepend('<div class="form-group"><label>支付二维码</label> <input type="text" placeholder="扫码获取条码数据" name="auth_code" id="tuikuan" class="form-control"></div>');
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

//			function refreshThis(){
//				$(document).keydown(function (event){
//					if (event.keyCode == 13) {
////						$('.sweet-overlay').remove();
////						$('.sweet-alert').remove()
////						$('input[name="goods_price"]').val("");
////						$('input[name="auth_code"]').val("");
////						$("#price").focus();
////						return false;
//						window.location.reload();
//					}
//				});
//			}
	</script>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
	<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/lhsw.js"></script>
	<script>
	$(function () {
		$("#price,#zhiFu,#tuikuan").keyup(function(){
			$(this).val($(this).val().replace(/[^0-9.]/g,''));
		}).bind("paste",function(){  //CTR+V事件处理
			$(this).val($(this).val().replace(/[^0-9.]/g,''));
		}).css("ime-mode", "disabled"); //CSS设置输入法不可用

		$("input[name=goods_price]").focus();//获取焦点

		$(document).keydown(function (event) {
			if (event.keyCode == 13) {
				$("#zhiFu").focus();
				//alert(44);
			}
		});

	})
</script>
</body>
</html>