<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>付款确认 - <?php echo ($config["seo_title"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
<script type="text/javascript">
        var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
        var  score_count = Number("<?php echo ($score_count); ?>");
        var  now_money = Number("<?php echo ($now_user["now_money"]); ?>");
        var  score_percent = Number("<?php echo ($user_score_use_percent); ?>");
        var  score_deducte = Number("<?php echo ($score_deducte); ?>");
        var  score_can_use_count = Number("<?php echo ($score_can_use_count); ?>");
        var  car_money = Number("<?php if($now_coupon){ echo ($now_coupon["price"]); }?>");
        var  total_money = Number("<?php echo ($order_info["order_total_money"]); ?>");
        var  need_pay ;
        $(document).ready(function(){
			if($("#use_score").is(':checked')==true){
				need_pay=total_money-score_deducte-car_money-now_money;
				 if(need_pay>0){
					$('.need_pay').empty();
					$('.need_pay').append(need_pay.toFixed(2));
				 }else{
					$('.need_pay').empty();
					$('.need_pay').append(0);
				 }
			}
            if (score_count>0) {
            $("#use_score").bind("click", function () {
                if($("#use_score").is(':checked')==true){
                   
                    need_pay=total_money-score_deducte-car_money-now_money;
					 if(need_pay>0){
						$('.need_pay').empty();
						$('.need_pay').append(need_pay.toFixed(2));
					 }else{
						$('.need_pay').empty();
						$('.need_pay').append(0);
					 }
                }else if($("#use_score").is(':checked')==false){                  
                    need_pay=total_money-car_money-now_money;
                    
                    $('.need_pay').empty();
                    if(car_money>0){
                        $('.need_pay').append(need_pay.toFixed(2));
                    }else{
                         $('.need_pay').append(need_pay.toFixed(2));
                    }
                }
            });
            }
        });
          
           
            
</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/buy-process.css" />
<!--[if IE 6]>
<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   /* EXAMPLE */
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

   /* string argument can be any CSS selector */
   /* .png_bg example is unnecessary */
   /* change it to what suits you! */
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
		body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc"); 
		}
		.category_list li:hover .bmbox {
filter:alpha(opacity=50);
	 
			}
  .gd_box{	display: none;}
</style>
<![endif]-->
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<style>
		.payment-bank {
			margin-top: 10px;
			border: 1px solid #DFDFDF;
			padding: 5px 0 10px 20px;
			background-color: #F5F5F5;
		}
		.payment-banktit {
			height: 20px;
			line-height: 20px;
			margin-top: 5px;
			padding: 5px 0;
			font-family: \5b8b\4f53;
			cursor: pointer;
		}
		.payment-banktit b {
			display: inline-block;
			height: 20px;
			padding-left: 17px;
			color: #333;
			font-size: 14px;
		}
		.payment-bankcen {
			padding-top: 10px;
		}
		.bank {
			width: 786px;
			padding: 15px 0 0 20px;
		}
		.payment-bankcen .bank{
			padding-top: 0;
			width: 1210px;
		}
		.imgradio li {
			padding-left: 20px;
			width: 112px;
			height: 32px;
			float: left;
			position: relative;
			margin: 0 25px 15px 0;
			_display: inline;
			_zomm: 1;
		}
		.imgradio li input {
			position: absolute;
			left: 0;
			top: 10px;
		}
		.imgradio li label{
			cursor:pointer;
		}
		.payment-bankcen .bank .imgradio li {
			margin-right: 45px;
		}
		.clr {
			height: 0;
			font-size: 0;
			line-height: 0;
			clear: both;
			overflow: hidden;
		}
		.form-submit {
			margin: 30px 0 20px;
		}
		
		
#bd {
  width: 1210px;
  margin: 0 auto;
  padding: 10px 0 65px;
    border-top: 3px solid #fe5842;
  margin-top:20px;
}

#content {
  float: left;
  width: 1210px;
  _display: inline;
  padding: 0;
}
.cf {
  zoom: 1;
}		
		
.sysmsgw {
  width: 1150px;
  margin: 10px auto 0;
}
		
.common-tip {
  position: relative;
  margin-bottom: 10px;
  padding: 10px 30px;
  border: 1px #F5D8A7 solid;
  border-radius: 2px;
  background: #FFF6DB;
  font-size: 14px;
  text-align: center;
  color: #666;
  zoom: 1;
}
		
a.see_tmp_qrcode {
  color: #EE3968;
  text-decoration: none;
}
.mainbox {
  border: none;
  padding: 0;
  padding-bottom: 60px;
}	
		
		
	</style>
</head>
<body id="deal-buy" class="pg-buy pg-buy-process">
	<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo UU('Index/Login/index');?>" style="color:red;"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo UU('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo UU('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo UU('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["config_site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["config_site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
        </div>
        <div class="list">

			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo UU('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo UU('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo UU('User/Adress/index');?>">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["config_site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["config_site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
	<!--
	<?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
			<div class="banner" style="background:<?php echo ($one_adver["bg_color"]); ?>">
				<div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
			</div>
		</div><?php endif; ?>
	-->
    <div class="nav cf">
		<div class="logo">
<span><a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>"><img  src="<?php echo ($config["site_logo"]); ?>" /></a></span>
<div class="dcs"><h1><?php echo ($now_city_name); ?></h1><a href="/index.php?g=Index&c=Changecity&a=index">切换城市</a></div>
			<div></div>

		</div>
		<div class="search">
			<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="form_sec">
					<div class="form_sec_txt group"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1 meal"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
</header>
	<div id="doc" class="bg-for-new-index">
		<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
		<div id="bdw" class="bdw" style="min-height:700px;">
    		<div id="bd" class="cf">
			    <div id="content">
			    	<div>
			    		<div class="buy-process-bar-container">
						    <ol class="buy-process-desc steps-desc">
						        <li class="step step--current">
						            1. 提交订单
						        </li>
						        <li class="step">
						            2. 选择支付方式
						        </li>
						        <li class="step">
						            3. 购买成功
						        </li>
						    </ol>
						    <div class="progress">
						        <div class="progress-bar" style="width:66.66%"></div>
						    </div>
						</div>
			    	</div>
					<?php if($order_info['order_type'] != 'recharge'): ?><div class="sysmsgw common-tip" style="margin-bottom:20px;" id="sysmsg-error">					
							<div class="sysmsg">							
								<span class="J-msg-content"><span class="J-tip-status tip-status"></span>在微信中付款才可以使用商家优惠券和商家会员卡。&nbsp;<?php if($order_info['order_type'] == 'group'): ?><a class="see_tmp_qrcode" href="<?php echo U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>2000000000+$order_info['order_id']));?>">查看订单微信二维码</a><?php else: ?><a class="see_tmp_qrcode" href="<?php echo U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>3000000000+$order_info['order_id']));?>" target="_blank">查看订单微信二维码</a><?php endif; ?></span>
								<span class="close common-close">关闭</span>
							</div>					
						</div><?php endif; ?>
			        <form action="<?php echo U('Pay/go_pay');?>" method="post" id="deal-buy-form" class="common-form J-wwwtracker-form">
			            <div class="mainbox cf" style="min-height:0px;">
			            	<div class="table-section summary-table">
			                    <table cellspacing="0" class="buy-table">
			                        <tr class="order-table-head-row">
			                        	<th class="desc">项目</th>
			                        	<th class="unit-price">单价</th>
                                                        <th class="amount">数量</th>
                                                        <th class="col-total">总价</th>
			                    	</tr>
				                    <?php if(is_array($order_info['order_content'])): $i = 0; $__LIST__ = $order_info['order_content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					                        <td class="desc"><?php echo ($vo["name"]); ?></td>
					                        <td class="money J-deal-buy-price">
					                            ￥<span id="deal-buy-price"><?php echo ($vo["price"]); ?></span>
					                        </td>
					                        <td class="deal-component-quantity "><?php echo ($vo["num"]); ?></td>
					                        <td class="money total rightpadding col-total">
                                                                    ￥<span id="J-deal-buy-total"><?php echo ($vo["money"]); ?></span>
                                                                </td>
					                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			                        <tr>						
			                        	<td style="text-align:left;">
                                                                <?php if($order_info['order_type'] != 'recharge'): ?><strong>帐户余额</strong>：
                                                                        <span class="inline-block money" style="color:#EA4F01;">
                                                                                ￥<strong id="deal-buy-total-t"><?php echo ($now_user["now_money"]); ?></strong>
                                                                        </span><?php endif; ?>
                                                          <?php if(!empty($leveloff) AND is_array($leveloff)): ?><span style="float: right;">会员等级<strong style="color:#EA4F01;"><?php echo ($leveloff['lname']); ?></strong> &nbsp;<?php echo ($leveloff['offstr']); ?></span><?php endif; ?>
                                                        </td>										
				                        <td colspan="3" class="extra-fee total-fee rightpadding">
                                                            <strong><?php if(!empty($leveloff) AND is_array($leveloff)): ?>优惠后<?php endif; ?>订单总额</strong>：
				                            <span class="inline-block money">
				                                ￥<strong id="deal-buy-total-t"><?php echo ($order_info["order_total_money"]); ?></strong>
				                            </span>
				                        </td>
			                    	</tr>
			                    	<?php if(!empty($score_count)): ?><tr>
                                                    <td style="text-align:left;">
                                                        <strong>帐户可用积分</strong>：
                                                        <span class="inline-block money" style="color:#EA4F01;">
															<strong id="deal-buy-total-t"><?php echo ($now_user["score_count"]); ?></strong>
															<input type="hidden" name="score_count" value="<?php echo ($now_user["score_count"]); ?>">
                                                        </span>
														&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <strong>本单可抵扣积分</strong>：
                                                        <span class="inline-block money" style="color:#EA4F01;">
                                                            <strong id="deal-buy-total-t"><?php echo ($score_can_use_count); ?></strong>
                                                            <input type="hidden" name="score_used_count" value="<?php echo ($score_can_use_count); ?>">
                                                        </span>
														&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <strong>积分可抵扣现金</strong>：
                                                        <span class="inline-block money" style="color:#EA4F01;">
                                                                <strong id="deal-buy-total-t">￥<?php echo (floatval($score_deducte)); ?></strong>
                                                                <input type="hidden" name="score_deducte" value="<?php echo ($score_deducte); ?>">
                                                        </span>
                                                        
                                                    </td>
                                                
                                                    <td colspan="3" class="extra-fee total-fee rightpadding">
                                                        使用积分抵扣:<input type="checkbox" id ="use_score" name="use_score" value="1" <?php if($score_checkbox == 1 ): ?>checked="checked"<?php endif; if($score_can_use_count == 0 ): ?>disabled="disabled"<?php endif; ?>>
                                                    </td>
                                                </tr><?php endif; ?>
			                	</table>
			            	</div>
			            </div>
						<?php if($pay_money > 0): if($order_info['order_type'] != 'recharge'): ?><div >
									<strong>还需支付</strong>：
									<span class="inline-block money" style="font-size:20px;color:#EA4F01;">
										￥<strong id="deal-buy-total-t" class="need_pay"><?php echo ($pay_money); ?></strong>
									</span>
								</div><?php endif; ?>
							<div id="pay_bank_list">
								<div class="payment-bank">
									<div class="payment-banktit">
										<b class="open">选择支付方式</b>
									</div>	
									<div class="payment-bankcen">
										<div class="bank morebank">
											<ul class="imgradio">
												<?php if(is_array($pay_method)): $i = 0; $__LIST__ = $pay_method;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
														<label>
															<input type="radio" name="pay_type" value="<?php echo ($key); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?>>
															<img src="<?php echo ($static_public); ?>images/pay/<?php echo ($key); ?>.gif" width="112" height="32" alt="<?php echo ($vo["name"]); ?>" title="<?php echo ($vo["name"]); ?>"/>
														</label>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
											<div class="clr"></div>
										</div>
									</div>
									<div class="clr"></div>
								</div>
							</div><?php endif; ?>
						<div class="form-submit">
							<input type="hidden" name="order_id" value="<?php echo ($order_info["order_id"]); ?>"/>
				    		<input type="hidden" name="order_type" value="<?php echo ($order_info["order_type"]); ?>"/>
			                <input id="J-order-pay-button" type="submit" class="btn btn-large btn-pay" name="commit" value="去付款"/><br/>
			            </div>
			    	</form>
				</div>
    		</div>
    		<!-- bd end -->
		</div>
	</div>
	<script src="http://hf.pigcms.com/static/js/artdialog/jquery.artDialog.js"></script>
	<script src="http://hf.pigcms.com/static/js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		var orderid = 0;
		$(function(){
			$('#sysmsg-error .close').click(function(){
				$('#sysmsg-error').remove();
			});
			$('.see_tmp_qrcode').click(function(){
				var qrcode_href = $(this).attr('href');
				art.dialog.open(qrcode_href+"&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码',
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
			$('#deal-buy-form').submit(function(){			
				if($('input[name="pay_type"]:checked').val() == 'weixin'){
					art.dialog({
						title: '提示信息',
						id: 'weixin_pay_tip',
						opacity:'0.4',
						lock:true,
						fixed: true,
						resize: false,
						content: '正在获取微信支付相关信息，请稍等...'
					});
					$.post($('#deal-buy-form').attr('action'),$('#deal-buy-form').serialize(),function(result){
						art.dialog.list['weixin_pay_tip'].close();			
						if(result.status == 1){
							orderid = result.orderid;
							art.dialog({
								title: '请使用微信扫码支付',
								id: 'weixin_pay_qrcode',
								width:'350px',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: '<p style="margin-top:20px;margin-bottom:20px;text-align:center;font-size:16px;color:black;">请使用微信扫描二维码进行支付</p><p style="text-align:center;"><img src="<?php echo U('Recognition/get_own_qrcode');?>&qrCon='+result.info+'" style="width:240px;height:240px;"></p><p style="text-align:center;margin-top:20px;margin-bottom:20px;"><input id="J-order-weixin-button" type="button" class="btn btn-large btn-pay" value="已支付完成"/></p>'
							});
						}else{
							art.dialog({
								title: '错误提示：',
								id: 'weixin_pay_error',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: result.info
							});
						}
					});
					return false;
				}
			});
			$('#J-order-weixin-button').live('click',function(){
				window.location.href="<?php echo U('Pay/weixin_back',array('order_type'=>$order_info['order_type']));?>&order_id="+orderid;
			});
		});
	</script>
	<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br($config['site_show_footer'],'<a>');?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<!--leftsead end-->
</body>
</html>