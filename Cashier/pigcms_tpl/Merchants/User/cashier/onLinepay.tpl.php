<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>收银台 | 在线收款</title>
<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>
<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/buttons.css" rel="stylesheet">
	<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/table_aa.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo  RL_PIGCMS_STATIC_PATH;?>plugins/css/footable/footable.core.css" rel="stylesheet">

<style type="text/css">
	#qr-code-forever canvas{vertical-align: middle;}
	#qr-code-forever {line-height:200px;width:608px;height:608px;padding-top:4px; margin:0px auto;}
</style>
<script src="<?php echo $this->RlStaticResource;?>plugins/js/footable/footable.all2.min.js"></script>
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
    padding: 7px 10px 0px;
}
#oderinfo{overflow-y: scroll;}
.jsq {width:100%;}
.js {width:100%; border-radius:6px; background-color:#aeaeae; height:48px; overflow:hidden; line-height:48px; font-size:16px; text-align:right; padding-right:5px; font-family:Arial; color:#FFFFFF;}
.js2 {width:100%;}
.fer {width:100%; height:40px; margin-top:20px; line-height:0; font-size:20px; padding:22px 0; font-weight:bold;}
.le {width:100%; margin-top:20px;}
.form-control {
	display: block;
	width: 100%;
	height: 40px;
	padding: 6px 12px;
	font-size: 24px;
	line-height: 1.42857143;
	color: #555;
	text-align: right;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

td {white-space: nowrap;white-space: nowrap;
text-overflow: ellipsis;}
</style>
<body>
<div id="wrapper">
	<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/leftmenu.tpl.php';?>
        <div id="page-wrapper" class="gray-bg">
	<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12" style="padding:1px;">
					<div class="ibox float-e-margins">
						<div class="cgt">
							<div class="jsq">
								<input class="form-control" type="text" name="process" id="process" value="0">
								<div class="js2">
									<a href="#"  class="button button-royalt button-rounded button-giantq">7</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">8</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq2">9</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">4</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">5</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq2">6</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">1</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">2</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq2">3</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">0</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq">.</a>
									<a href="#"  class="button button-royalt button-rounded button-giantq2">C</a>
									<div style="clear:both"></div>
								</div>
								<a href="#" class="button button-actionq  button-rounded fer" id="ee">生成二维码</a>
							</div>
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
												<td height="45" align="left" onclick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);" style="padding-left:10px;overflow-x:hidden;overflow-y:hidden; padding-right:10px;"><?php if(!empty($ovv['nickname'])){
														echo $ovv['nickname'];
													}elseif(!empty($ovv['truename'])){
														echo htmlspecialchars_decode($ovv['truename'],ENT_QUOTES);
													}elseif(!empty($ovv['openid'])){
														echo $ovv['openid'];
													}else{
														echo '未知客户';
													}?></td>
												<td height="45" align="center" onclick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><?php $paytime=$ovv['paytime'] > 0 ? $ovv['paytime'] : $ovv['add_time']; echo date('Y-m-d H:i:s',$paytime);?></td>
												<td height="45" align="center" onclick="GetDetail(<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><?php echo $ovv['goods_price'];?></td>
												<td height="45" align="center"><div style="padding-top:5px;"><?php if($ovv['comefrom']>0){ ?> <button class="btn btn-sm btn-success btn-st"><strong> 已支付 </strong></button> <?php }elseif($ovv['refund']!=2 && $ovv['refund']!=1){?> <button class="btn btn-sm btn-warning" onclick="wxRefundBtn(this,<?php echo $ovv['id'];?>,<?php echo $ovv['mid'];?>);"><strong> 退&nbsp;&nbsp;&nbsp;款 </strong></button>  <?php }elseif($ovv['refund']==2){?><button class="btn btn-sm btn-success btn-st"><strong> 已退款 </strong></button><?php }?></div></td>
												</tr>
										<?php }}else{?>
										<tr class=""><td colspan="7">暂无订单</td></tr>
									<?php }?>
									</tbody>
							  </table>
							</div>

							<div class="ibox-content" id="carousel3">
								<div class="app__content js-app-main page-cashier carousel slide">
									<div class="carousel-inner">
										<div class="page-cashier-box">
											<div class="cashier-desk clearfix">
												<!-- 实时收款二维码 -->
												<div class="realtime-pay js-pay-code-region clearfix">
													<div style="text-align:center;">
														<div class="pay-code f-pay-code">
															<div style="font-size:16px; line-height:50px;">支付二维码</div>
															<div class="qr-code-zone gray" id="qr-code-forever">
																二维码区域
															</div>
															<p class="gray tips" id="receivablesforever" style="font-size:16px; line-height:40px; margin-bottom:0px;">本单支付金额：¥ &nbsp;-&nbsp; 元</p>
															<div style="font-size:13px; text-align:center; padding-bottom:15px;"><span style="color:#FF0000;">温馨提示：</span><span style="color:#666666;">现已开通微信支付 扫描二维码可直接付款</span></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal inmodal" tabindex="-1" role="dialog"  id="oderinfo">
								<div class="modal-dialog">
									<div class="modal-content animated bounceInRight">
										<div class="modal-header">
											<button type="button" class="close _close"><span style="font-size: 35px;">×</span><span class="sr-only">Close</span></button>
											<h4 class="modal-title">支付详情</h4>
										</div>
										<div class="modal-body">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-white _close">关闭</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>
	</div>
</div>
</body>
</html>
<script>
$(function(){
	var process_val="";
	var topost=true;
	$('.button-royalt').each(function(){	
		$(this).click(function(){
			if($(this).text()=="C"){
				process_val="";
				$('input[name="process"]').val("0");
			}else{
				process_val+=$(this).text();
				//alert(process_val);
				$('input[name="process"]').val(process_val);
			}
			$('#ee').text('生成二维码');//点击任何计算器任意元素即替换a标签
		})
	});
	
	$('.button-actionq').click(function(){
		if(!topost) return false;
		var postdata={paytype:'wxpay'};
		postdata.tname=$.trim("在线收款");
		postdata.tprice=$.trim($('input[name="process"]').val());
		postdata.tprice=parseFloat(postdata.tprice);
		if(!(postdata.tprice > 0)){
			swal({title:'付款金额必须填！',text:'', type: "error"});
			return false;
		}
		//$('input[name="process"]').val("0.00");
		topost=false;
		$.post('?m=User&c=cashier&a=getEwm',postdata,function(ret){
			topost=true;
			if(!ret.error){
				 //alert(ret.qrcode);
				//swal("成功", "二维码生成成功" , "success");
				$('#ee').text('待支付：'+postdata.tprice+'元');
				process_val="";
				$('input[name="process"]').val("0");
			}else{
				swal("失败", ret.msg , "error");
			}
		},'json');
	});


	setInterval(function(){
		$.ajax({
			'type':"POST",
			'url':"?m=User&c=cashier&a=onLinepayajax",
			'dataType':"json",
			'data':"action=ajax",
			success:function(data){
				//alert(data.msg);
				if(data.error==0){
					//alert(data.orderList.length);
					if(data.orderList){
						$('#dd').text("");
						var contentList="";
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

						$('#dd').append(contentList);
					}
				}else{
					alert(data.msg);
				}
				//wxRefundBtn(dom,orderid,mid);
			},
			error:function(){
				//alert("err:操作错误");
			}
		})
	}, 1000);

})
/*****退款处理******/
function wxRefundBtn(dom,orderid,mid){
	if(confirm('您确认要给该单退款？')){
		$.ajax({
			url:"?m=User&c=cashier&a=wxRefund",
			type:"POST",
			dataType:"json",
			data:{ordid:orderid,mid:mid},
			success:function(res){
				if(!res.error){
					swal({
						title:"退款成功",
						text:res.msg,
						type:"success"
					},function(){
						window.location.reload();
					});
				}else{
					swal({
						title:"退款失败",
						text:res.msg,
						type:"error"
					},function(){
						//window.location.reload();
					});
				}
			}
		});
	}
}
/**支付详情*/
function GetDetail(id,mid){
	var getUrl='?m=User&c=cashier&a=odetail&orid='+id+'&mid='+mid;
	$.get(getUrl,function(ret){
		if(ret){
			//alert(ret);
			$('body').append('<div class="modal-backdrop in"></div>');
			$('#oderinfo .modal-body').html(ret);
			$('#oderinfo').show();
		}
	},'html');
}
</script>
<script src="<?php echo PIGCMS_TPL_STATIC_PATH;?>cashier/commonfunc.js"></script>
<script type="text/javascript">
	var qwidth=qheight=600;
	if(is_mobile()){
		var bodyClient=document.getElementById("carousel3").scrollWidth;	//获取DIV宽度
		$('.form-horizontal').addClass('mbform');
		$('.float-e-margins .ibox-content').css('padding','0px 0px 0px 0px');
		$('.js-pay-code-region .pay-code').css('float','none').css('margin-left','0px').css('padding','0px');
		$('.js-fixed-code-region').css('width','auto').css('border-left','none');
		$('.qr-code-zone').css('width',bodyClient+'px').css('height',bodyClient+'px').css('padding-top','0px');
		$('.js-fixed-code-region').css('margin','0px').css('float','none');
		//qwidth=qheight=430; 
		qwidth=qheight=bodyClient;
	}else{
		$('.form-horizontal').removeClass('mbform');
	}

	$(document).ready(function(){
		var time=setInterval(function(){	//定时轮询判断是否有收款二维码生成或变化
			$.ajax({
				url:"?m=User&c=cashier&a=ewmChange",
				type:"post",
				dataType:"json",
				data:{},
				async:true,
				success:function(ret){
					if(ret.error==0){
						$("#qr-code-forever").html('').css('background-color','#FFF').qrcode({
							width: qwidth, //宽度 
							height: qheight, //高度 
							text:"<?php echo 'http://'.$_SERVER['HTTP_HOST'].$this->SiteUrl;?>/merchants.php?m=Index&c=pay&a=foreverpay&ordid="+ret.ewminfo //任意内容 
						});
						$('#receivablesforever').html('本单支付金额:¥ '+ret.dataprice+' 元');
					}else{
						//alert(ret.msg);
					}
				}				
			});
		},1000);

		$("#oderinfo ._close").click(function(){
			$('#oderinfo').hide();
			$('.modal-backdrop').remove();
			$('#oderinfo .modal-body').html('');
		});
	});

	var screenH=$(window).height();
	screenH=  screenH-20;
	$('#oderinfo').css('height',screenH);
</script>