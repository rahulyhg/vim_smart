<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head>    <meta charset="utf-8"/>	<title>店员中心</title>    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">	<meta name="apple-mobile-web-app-capable" content="yes">	<meta name='apple-touch-fullscreen' content='yes'>	<meta name="apple-mobile-web-app-status-bar-style" content="black">	<meta name="format-detection" content="telephone=no">	<meta name="format-detection" content="address=no">    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>	<script src="<?php echo C('JQUERY_FILE');?>"></script>	<script src="<?php echo ($static_public); ?>js/laytpl.js"></script>	<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>    <style>	    dl.list dd.dealcard {	        overflow: visible;	        -webkit-transition: -webkit-transform .2s;	        position: relative;	    }	    .dealcard.orders-del {	        -webkit-transform: translateX(1.05rem);	    }	    #orders .dealcard-block-right {			margin-left:1px;	        position: relative;	    }	    .dealcard small {	        font-size: .24rem;	        color: #9E9E9E;	    }	    .dealcard weak {	        font-size: .24rem;	        color: #999;	        position: absolute;	        bottom: 0;	        left: 0;	        display: block;	        width: 100%;	    }	    .dealcard weak b {	        color: #FDB338;	    }	    .dealcard weak a.btn{	        margin: -.15rem 0;	    }	    .dealcard weak b.dark {	        color: #fa7251;	    }	    .hotel-price {	        color: #ff8c00;	        font-size: .24rem;	        display: block;	    }	    .del-btn {	        display: block;	        width: .45rem;	        height: .45rem;	        text-align: center;	        line-height: .45rem;	        position: absolute;	        left: -.85rem;	        top: 50%;	        background-color: #EC5330;	        color: #fff;	        -webkit-transform: translateY(-50%);	        border-radius: 50%;	        font-size: .4rem;	    }	    .no-order {	        color: #D4D4D4;	        text-align: center;	        margin-top: 1rem;	        margin-bottom: 2.5rem;	    }	    .icon-line {	        font-size: 2rem;	        margin-bottom: .2rem;	    }	    .order-icon {	        display: inline-block;	        width: .5rem;	        height: .5rem;	        text-align: center;	        line-height: .5rem;	        border-radius: .06rem;	        color: white;	        margin-right: .25rem;	        margin-top: -.06rem;	        margin-bottom: -.06rem;	        background-color: #F5716E;	        vertical-align: initial;	        font-size: .3rem;	    }	    .order-all {	        background-color: #2bb2a3;	    }	    .order-zuo,.order-jiudian {	        background-color: #F5716E;	    }	    .order-fav {	        background-color: #0092DE;	    }	    .order-card {	        background-color: #EB2C00;	    }	    .order-lottery {	        background-color: #F5B345;	    }	    .color-gray{	    	color:gray;	    	border-color:gray;	    }	    .color-gray:active{	    	background-color:gray;	    }		#nav-dropdown{height: 1.7rem;}		#filtercon select{height: 100%;line-height: normal; width:100%;}		#find_submit{			position: absolute;			right: 0;			top: .15rem;			width: 1.2rem;			height: .7rem;;			-webkit-box-sizing: border-box;		}		#filtercon{margin: 0 .15rem;}.find_txt_div{vertical-align: middle;position: relative;margin-right: 1.3rem;margin-left: 1.8rem;border-radius: .06rem;border: 1px #CCC solid;height: .7rem;line-height: .7rem;}	#filtercon input{width: 100%;border: none;background: rgba(255, 255, 255, 0);outline-style: none;display: block;line-height: .28rem;height: 100%;font-size: .28rem;padding: 0;} .dealcard-block-right li{     font-size: .266rem;font-weight: 400; }  .dealcard-block-right li.name,.dealcard-block-right li.detail{     margin-bottom: .18rem; }.dealcard-block-right .dth{font-weight: bold;} .ulrightdiv{	float: right;	position: relative;	top: -55px;	margin-right: 15px;	}	dl.list .dd-padding{padding: .28rem 0.1rem;}.dealcard-block-right{padding: 0 10px;}#orders a{color: #333;}.find_div{margin:.15rem 0;}.find_type_div{	position: absolute;left: 0;top: .15rem;width: 1.7rem;height: .7rem;text-align: center;background: white;}</style></head><body>	<dl class="list" style="border-top:none;margin-top:0rem;">		<dd id="filtercon">			<div class="find_div">				<div class="find_type_div">					<select name="find_type" id="find_type" class="col-sm-1">						<optgroup label="预约">							<option value="1">消费密码</option>						</optgroup>						<optgroup label="通用">							<option value="2">订单ID</option>							<option value="3">预约ID</option>							<option value="4">用户ID</option>							<option value="5">用户昵称</option>							<option value="6">手机号码</option>						</optgroup>					</select>				</div>				<div class="find_txt_div"><input name="find_value" id="find_value" type="text" /></div>				<button class="btn" type="submit" id="find_submit">搜索</button>			</div>		</dd>	</dl>	    <div style="margin-top:.2rem;">		    <dl class="list" id="orders">				<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd class="dealcard dd-padding">						<a href="<?php echo U('Storestaff/appoint_edit',array('order_id'=>$vo['order_id']));?>">							<ul class="dealcard-block-right">								<li class="name"><span class="dth">预约名称：</span><span class="ttd"><?php echo ($vo["appoint_name"]); ?></span></li>								<li class="name"><span class="dth">预约客户：</span><span class="ttd"><?php if($vo['truename']): echo ($vo["truename"]); else: echo ($vo["nickname"]); endif; ?>（<?php echo ($vo["phone"]); ?>）</span></li>								<li class="name"><span class="dth">预约时间：</span><span class="ttd"><?php echo ($vo["appoint_date"]); ?>&nbsp;<?php echo ($vo["appoint_time"]); ?></span></li>								<li class="detail"><span class="dth">订单信息：</span><span class="xth">定金: </span><span class="td"><?php echo floatval($vo['payment_money']);?>元</span>&nbsp;&nbsp;<span class="xth">总价: </span><span class="td"><?php echo floatval($vo['appoint_price']);?>元</span></li>								<li>									<span class="dth">订单状态：</span>									<span><?php if($vo['paid'] == 0): ?><font color="red">未支付</font>										<?php if($vo['service_status'] == 0): ?><font color="red">未服务</font>											<span onclick="appoint_verify_btn(<?php echo ($vo['order_id']); ?>,$(this));return false;" style="color:#428bca">验证服务</span>										<?php elseif($vo['service_status'] == 1): ?>											<font color="green">已服务</font><?php endif; ?>									<?php elseif($vo['paid'] == 1): ?>										<font color="green">已支付</font>										<?php if($vo['service_status'] == 0): ?><font color="red">未服务</font>											<span onclick="appoint_verify_btn(<?php echo ($vo['order_id']); ?>,$(this));return false;" style="color:#428bca">验证服务</span>										<?php elseif($vo['service_status'] == 1): ?>											<font color="green">已服务</font><?php endif; ?>									<?php elseif($vo['paid'] == 2): ?>										<font color="red">已退款</font>									<?php else: ?>										<font color="red">订单异常</font><?php endif; ?></span>								</li>							</ul>						</a>					</dd><?php endforeach; endif; else: echo "" ;endif; ?>			</dl>			<!--<div class="top-btn" style="display: block;left:10px;opacity: 0.8;"><a class="react" href="<?php echo U('Storestaff/group_list');?>"><i class="text-icon">刷新</i></a></div>			<div class="top-btn" style="display: block;left:60px"><a class="react"><i class="text-icon">⇧</i></a></div>-->		</div>		<script id="find_html" type="text/html">			{{# for(var i = 0, len = d.list.length; i < len; i++){ }}				<dd class="dealcard dd-padding">					<a href="<?php echo U('Storestaff/appoint_edit');?>&order_id={{ d.list[i].order_id }}">						<ul class="dealcard-block-right">							<li class="name"><span class="dth">预约名称：</span>							<span class="ttd"><?php echo ($vo["appoint_name"]); ?></span></li>							<li class="detail"><span class="dth">订单信息：</span><span class="xth">定金: </span><span class="td"><?php echo floatval($vo['payment_money']);?>元</span>&nbsp;&nbsp;<span class="xth">总价: </span><span class="td"><?php echo floatval($vo['appoint_price']);?>元</span></li>							<li><span class="dth">订单状态：</span><span>								{{# if(d.list[i].paid == '0'){ }}									<font color="red">未支付</font>									{{# if(d.list[i].service_status == '0'){ }}										<font color="red">未服务</font>										<span onclick="appoint_verify_btn(<?php echo ($vo['order_id']); ?>,$(this));return false;" style="color:#428bca">验证服务</span>									{{# }else if(d.list[i].service_status == '1'){ }}										<font color="green">已服务</font>									{{# } }}								{{# }else if(d.list[i].paid == '1'){ }}									<font color="green">已支付</font>									{{# if(d.list[i].service_status == '0'){ }}										<font color="red">未服务</font>										<span onclick="appoint_verify_btn(<?php echo ($vo['order_id']); ?>,$(this));return false;" style="color:#428bca">验证服务</span>									{{# }else if(d.list[i].service_status == '1'){ }}										<font color="green">已服务</font>									{{# } }}								{{# }else if(d.list[i].paid == '2'){ }}									<font color="red">已退款</font>								{{# }else{ }}									<font color="red">订单异常</font>								{{# } }}								</span>							</li>						</ul>					</a>				</dd>			{{# } }}		</script>				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>		<style>			.footermenu ul{background-color:#404a54;}			.footermenu ul li a{color:#fff;}			.footermenu ul li a.active{background-color:#2A3138;}		</style>	    <footer class="footermenu">		    <ul>		        <li>		            <a <?php if(ACTION_NAME == 'group_list' OR ACTION_NAME == 'group_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/group_list');?>">		            <img src="<?php echo ($static_path); ?>images/Lngjm86JQq.png"/>		            <p><?php echo ($config["group_alias_name"]); ?></p>		            </a>		        </li>		        <li>		            <a <?php if(ACTION_NAME == 'meal_list' OR ACTION_NAME == 'meal_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/meal_list');?>">		            <img src="<?php echo ($static_path); ?>images/s22KaR0Wtc.png"/>		            <p><?php echo ($config["meal_alias_name"]); ?></p>		            </a>		        </li>				<li>		            <a <?php if(ACTION_NAME == 'appoint_list' OR ACTION_NAME == 'appoint_edit'): ?>class="active"<?php endif; ?> href="<?php echo U('Storestaff/appoint_list');?>">		            <img src="<?php echo ($static_path); ?>images/3YQLfzfuGx.png"/>		            <p>预约</p>		            </a>		        </li>				<li>		            <a id="qrcode_btn">						<img src="<?php echo ($static_path); ?>images/qrcode.png"/>						<p>扫一扫</p>		            </a>		        </li>		        <!--<li>		            <a href="javascript:;" onclick="LogOutSys()" <?php if(ACTION_NAME == 'logout'): ?>class="active"<?php endif; ?> >		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>退出</p>		            </a>		        </li>-->				<li>		            <a href="Cashier/merchants.php?m=Index&c=login&a=index&type=employee">		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png"/>		            <p>收银台</p>		            </a>		        </li>		    </ul>		<script type="text/javascript">		var logoutURl="<?php echo U('Storestaff/logout');?>"		function LogOutSys(){			if(confirm('您确认要退出系统吗？')){			    window.location.href=logoutURl;			}		}		</script>		</footer>		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>        </body><script type="text/javascript" src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script><script type="text/javascript">	$('#find_value').keyup(function(e){		if(e.keyCode == 13){			$(this).blur();			$('#find_submit').trigger('click');		}	});	$('#find_submit').click(function(){		var find_value = $('#find_value');		find_value.val($.trim(find_value.val()));		if(find_value.val().length < 1){			layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'请输入查找内容',btn: ['确定'],end:function(){find_value.focus();}});			return false;		}				var post_type = $('#find_type').val();		var post_value = $('#find_value').val().replace(/\s+/g,"");		$('#find_submit').removeClass('btn-success').addClass('btn-error').prop('disabled',true);		$('#order_html').empty();		$('#order_list').hide();		layer.open({			type: 2,			content: '正在请求中'		});		$.post("<?php echo U('Storestaff/appoint_find');?>",{find_type:post_type,find_value:post_value},function(result){			layer.closeAll();			$('#find_submit').removeClass('btn-error').addClass('btn-success').prop('disabled',false).html('搜索');			data = $.parseJSON(result);			if(data.row_count > 0){				laytpl(document.getElementById('find_html').innerHTML).render(data, function(html){					document.getElementById('orders').innerHTML = html;					$('#order_list').show();				});			}else{				layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'未查找到内容！',btn: ['确定'],end:function(){find_value.focus();}});			}		});				return false;	});	function appoint_verify_btn(oid,obj){	  	var verify_btn = obj;		verify_btn.html('验证中..');		$.get("<?php echo U('Storestaff/appoint_verify');?>&order_id="+oid,function(result){			if(result.status == 1){				layer.open({					title:['成功提示：','background-color:#FF658E;color:#fff;'],					content:result.info,					btn: ['确定'],					end:function(){window.location.href = window.location.href;}				});			}else{				verify_btn.html('验证消费');				layer.open({					title:['错误提示：','background-color:#FF658E;color:#fff;'],					content:result.info,					btn: ['确定'],					end:function(){}				});			}		});		return false;	}</script><?php echo ($shareScript); ?><script type="text/javascript">function is_mobile(){	var ua = navigator.userAgent.toLowerCase();	if ((ua.match(/(iphone|ipod|android|ios|ipad)/i))){		if(navigator.platform.indexOf("Win") == 0 || navigator.platform.indexOf("Mac") == 0){			return false;		}else{			return true;		}	}else{		return false;	}}function is_weixin(){    var ua = navigator.userAgent.toLowerCase();    if(is_mobile() && ua.indexOf('micromessenger') != -1){          return true;      } else {          return false;      }  }function getParam(url,name){ 	var reg = new RegExp("[&|?]"+name+"=([^&$]*)", "gi"); 	var a = reg.test(url); 	return a ? RegExp.$1 : ""; }$('#qrcode_btn').click(function(){	if(is_weixin()){		wx.scanQRCode({			needResult:1,			scanType:["qrCode"],			success:function (res){				/*				 * URL提示：				 *    /wap.php?c=Storestaff&a=group_qrcode&id=(14位消费码)				 *    /wap.php?c=Storestaff&a=meal_qrcode&id=(订单ID)				 */				var result = res.resultStr;				if(result.indexOf('http://') !== 0 && result.indexOf('https://') !== 0){					layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您扫描的内容 “ <font color="red">'+result+'</font> ” 不是有效的验证二维码',btn: ['确定'],end:function(){}});				}else{					var ctype = getParam(result,'a'),id = getParam(result,'id'),c = getParam(result,'c');					var actMode='group_qrcode';					if(ctype == 'meal_qrcode') actMode='meal_qrcode';					if((ctype != 'group_qrcode' && ctype != 'meal_qrcode') || id== '' || c != 'Storestaff'){						layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您扫描的内容不是有效的验证二维码',btn: ['确定'],end:function(){}});					}else{						layer.open({							title:['提示：','background-color:#FF658E;color:#fff;'],							content:'初次检测订单属于 <font color="red">'+(ctype == 'group_qrcode' ? '<?php echo ($config["group_alias_name"]); ?>' : '<?php echo ($config["meal_alias_name"]); ?>')+'</font> 订单，您是要验证消费或查看订单？',							btn: ['验证消费', '查看订单'],							shadeClose: false,							yes: function(){								layer.open({									type: 2,									content: '验证消费中，请稍后'								});								$.getJSON("/wap.php?g=Wap&c=Storestaff&a="+actMode,{type:ctype,id:id,ajax:1},function(ret){									//layer.closeAll();									if(!ret.error){										layer.open({											title:['成功提示：','background-color:#FF658E;color:#fff;'],											content:'验证成功！是否要刷新页面？',											btn: ['确定','取消'],											yes: function(index){												window.location.href='/wap.php?g=Wap&c=Storestaff&a=group_list';												layer.close(index);											}										});									}else{										layer.open({											title:['错误提示：','background-color:#FF658E;color:#fff;'],											content:ret.msg,											btn: ['确定'],											end:function(){												window.location.href='/wap.php?g=Wap&c=Storestaff&a=group_list';											}										});									}								});							}, no: function(){								if(ctype == 'group_qrcode'){									window.location.href = "<?php echo U('Storestaff/group_edit');?>&order_id="+getParam(result,'order_id');								}else{									window.location.href = "<?php echo U('Storestaff/meal_edit');?>&order_id="+getParam(result,'id');								}							}						});					}				}				}		});	}else{		layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您使用的不是微信浏览器，此功能无法使用！您可以使用浏览器自带的或其他扫描二维码工具进行扫描',btn: ['确定'],end:function(){}});	}	return false;});</script></html>