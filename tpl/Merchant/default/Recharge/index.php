<include file="Public:header"/>
<link rel="stylesheet" href="{pigcms{$static_path}css/layout-Frame.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/pcpay.css">
<div class="white">
	<div class="zxcz">
		<div class="zxn">
			<div class="zxfe">商户充值-在线支付</div>
		</div>
	</div>
	<div class="zxn">
		<div class="kid">
			<div class="x1"><img src="././static/images/xz.jpg" width="8" height="8" /></div>
			<div class="x2">商户余额：</div>
			<div class="x3">{pigcms{$money}</div>
			<div class="x4">元</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="zxn">
		<div class="gre">
			<div class="gre2">
				<div class="hre"><img src="./static/images/xz.jpg" width="8" height="8" /></div>
				<div class="hre2">请选择充值的金额</div>
				<div class="both"></div>
			</div>
			<div class="kk">
				<div class="fw">
					<ul id="ulMoneyList">
						<li>
						  	<div class="cz">
						      <input  type="radio" id="rd10" name="money" value="10" checked="checked">
					      </div>
						  	<div class="cz2"><label for="rd10">充值  ￥10</label></div>
						</li>
						<li>
						  	<div class="cz">
						      <input type="radio" name="money" value="50" id="rd50">
					      </div>
						  	<div class="cz2"><label for="rd50">充值  ￥50</label></div>
						</li>
						<li>
						  	<div class="cz">
						      <input type="radio" name="money" value="100" id="rd100">
					      </div>
						  	<div class="cz2"><label for="rd100">充值  ￥100</label></div>
						</li>
						<li>
						  	<div class="cz">
						      <input type="radio" name="money" value="200" id="rd200">
					     </div>
						  	<div class="cz2"><label for="rd200">充值  ￥200</label></div>
						</li>
						<li>
						  	<div class="cz">
						      <input type="radio" name="money" value="1000" id="rd1000">
					      </div>
						  	<div class="cz2"><label for="rd1000">充值  ￥1000</label></div>
						</li>
						<li>
						  	<div class="cz">
						      <input type="radio" id="mon" value="0" name="money" id="rdOther"> 
					      </div>
						  	<div class="cz2">
						  	  
						  	    <input value="" id="txtOtherMoney" type="text" class="enter" maxlength="7" style="width:110px; height:24px; border:1px #CCCCCC solid; margin-top:29px;"/>
					  	      
					  	    </div>
						</li>
					</ul><div class="both"></div>
			  </div>
			</div>
		</div>
	</div>
	<form id="toPayForm" name="toPayForm" action="{pigcms{:U('Recharge/index')}" method="post">
	<div class="zxn">
		<div class="fee">
				<div class="fee2"><img src="./static/images/xz.jpg" width="8" height="8" /></div>
				<div class="fee3">请选择支付方式推荐使用的支付宝扫码支付</div>
				<div class="both"></div>
		</div>
		<div class="feec">
				<div class="fee2"></div>
				<div class="fee4">支付平台支付:</div>
				<div class="both"></div>
		</div>
		<div class="cw">
			<div class="fee2"></div>
			<div class="cw2">
						  
						      <input type="radio" value="alipay" name="account">
				
					      </div>
			<div class="cw3"><img src="./static/images/zfb.jpg" width="60" height="23" /></div>
			<div class="cw4">支付宝支付</div>
			<div class="cw5">
						      <input checked="checked" type="radio" value="weixin" name="account">
					        </div>
			<div class="cw6"><img src="./static/images/wx.jpg" width="37" height="27" /></div>
			<div class="cw4">微信支付</div>
			<div class="both"></div>
		</div>
		<div class="re">
			<div class="fee2"></div>
			<div class="re2">应付金额：</div>
			<div class="re3"><span id="Money">10</span></div>
			<div class="re4">元</div>
			<div class="both"></div>
		</div>
		<div style="margin-top:20px;">
			<div class="fee2"></div>
			
			<input type="hidden" id="hidPayName" name="payName" value="">
			<input type="hidden" id="hidPayBank" name="payBank" value="0">
			<input type="hidden" id="hidMoney" name="money" value="10">
			<input id="submit_ok" class="bluebut imm" type="submit" name="submit" value="立即充值" title="立即充值" style="width:201px; height:52px; background-color:#438eb9; border:none; font-size:22px; font-family:'微软雅黑'; color:#FFFFFF;">
			</div>
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
$(function(){
	var je=$("#ulMoneyList li");
	var dx=/\D/;
	je.click(function(){
		je.removeClass("selected");
		je.find("input").removeAttr("checked");
		var radio=je.index(this);
			je.eq(radio).find("input").attr('checked','checked');
			je.eq(radio).addClass("selected");
		var valx=je.eq(radio).find("input").val();
		$("#Money").text(valx);
		$("#hidMoney").val(valx);
	});
	var tel=$("#txtOtherMoney").val();
	$("#txtOtherMoney").keyup(function(){
		if(dx.test($("#txtOtherMoney").val())){
			$("#txtOtherMoney").val(tel);
		}else{
			tel=$("#txtOtherMoney").val();
		}
		if(tel>0){
			$("#Money").text(tel);
			$("#hidMoney").val(tel);
			$("#mon").val(tel);
		}else{
			$("#Money").text("0");
			$("#hidMoney").val("0");
			$("#mon").val("0");
		}
	});
	
	$("#submit_ok").click(function(){
		if(!this.cc){
			this.cc = 1;
			return true;
		}else{
			return false;
		}
		return false;
	});

	$(".yeepay_click li>img").click(function(){
		$(this).prev().attr("checked",'checked');
	});
	
	$('.see_qrcode').click(function(){
		art.dialog.open($(this).attr('href'),{
			init: function(){
				var iframe = this.iframe.contentWindow;
				window.top.art.dialog.data('iframe_handle',iframe);
			},
			id: 'handle',
			title:'查看渠道二维码',
			padding: 0,
			width: 430,
			height: 433,
			lock: true,
			resize: false,
			background:'black',
			button: null,
			fixed: false,
			close: null,
			left: '50%',
			top: '38.2%',
			opacity:'0.4'
		});
		return false;
	});
	
})
</script>
<include file="Public:footer"/>
