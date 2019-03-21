<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>停车卡</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"> 
        <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/googleapis.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/bootstrap/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo (C("STATICS_URL")); ?>plublic/css/layout/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <style type="text/css">
<!--
.mt20 {margin-top:20px;}
.kid {padding: 14px 10px 5px!important;}
.col-md-6 {width:100%;}
.tc {width:100%; height:50px; overflow:hidden; text-align:center; line-height:50px; background-color:#46a0dd; color:#FFFFFF; border-radius:4px 4px 0 0; font-family:"微软雅黑"; font-size:20px;}
.tc2 {width:100%; border-bottom:1px #e2e2e2 dashed; border-left:1px #e2e2e2 solid; border-right:1px #e2e2e2 solid; overflow:hidden; background:url(<?php echo (C("STATICS_URL")); ?>parking_card/images/bj.jpg) no-repeat; background-position:right 10%; background-color:#FFFFFF;}
.tc3 {width:100%; border-left:1px #e2e2e2 solid; border-right:1px #e2e2e2 solid; height:130px; overflow:hidden; position:relative; background-color:#FFFFFF;}
.tc4 {width:100%; height:50px; overflow:hidden;}
.tc5 {border-radius:0 0 4px 4px;}
.btn.blue:not(.btn-outline) {height:50px;}
.qf {position: absolute;border-radius: 0 20px 20px 0;background-color: #eaeaea;width: 10px;height: 20px;margin-top: -10px;z-index: 11111;border: 1px #e2e2e2 solid;border-left: none;}
.qf2 {position: absolute;border-radius: 20px 0 0 20px;background-color: #eaeaea;width: 10px;height: 20px;margin-top: -10px; right:15px; z-index: 11111;border: 1px #e2e2e2 solid;border-right: none;}
</style></head>
<script>
  document.addEventListener('touchstart',function(){},false);
</script>
    <!-- END HEAD -->

    <body style="background-color:#eaeaea;">
        <!-- BEGIN HEADER -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div style="padding: 20px 10px 10px!important;">
                    <div class="kid">
					<div class="row">
                        <div class="col-md-6">
                            <div class="tc">停车卡</div>
							<div class="tc2">
								<div style="padding:20px 15px;">
									<div style="width:100%;">
										<div style="font-size:14px; font-family:'微软雅黑'; color:#5c6466; height:25px; line-height:25px;">车牌</div>
										<div style="width:100%; height:25px; overflow:hidden;">
											<div style="float:left; line-height:25px; font-size:18px; color:#2c2c2c; font-family:'微软雅黑';" id="car_no"><?php echo ($pay_info["car_no"]); ?></div>
											<div style="float:left; margin-left:2%;"><img src="<?php echo (C("STATICS_URL")); ?>parking_card/images/photo.jpg" width="18" height="18" style="margin-top:3px;"></div>
											<div style="clear:both"></div>
										</div>
									</div>
									<div style="width:100%; margin-top:25px;">
										<div style="font-size:14px; font-family:'微软雅黑'; color:#5c6466; height:25px; line-height:25px;">停车场名称</div>
										<div style="font-size:18px; font-family:'微软雅黑'; color:#2c2c2c; height:25px; line-height:25px;"><?php echo ($pay_info["garage_name"]); ?></div>
									</div>
									<div style="width:100%; margin-top:25px;">
										<div style="font-size:14px; font-family:'微软雅黑'; color:#5c6466; height:25px; line-height:25px;">入场时间</div>
										<div style="font-size:18px; font-family:'微软雅黑'; color:#2c2c2c; height:25px; line-height:25px;"><?php echo (date("Y年m月d日 H:i:s",$pay_info["start_time"])); ?></div>
									</div>
                                                                        <div style="width:100%; margin-top:25px;">
										<div style="font-size:14px; font-family:'微软雅黑'; color:#5c6466; height:25px; line-height:25px;">出场时间</div>
										<div style="font-size:18px; font-family:'微软雅黑'; color:#2c2c2c; height:25px; line-height:25px;">
                                                                                    <?php if(!empty($pay_info["end_time"])): echo (date("Y年m月d日 H:i:s",$pay_info["end_time"])); ?>
                                                                                    <?php else: ?>
                                                                                    未出场<?php endif; ?>
                                                                                </div>
									</div>
                                                                        <div style="width:100%; margin-top:25px;">
										<div style="font-size:14px; font-family:'微软雅黑'; color:#5c6466; height:25px; line-height:25px;">订单编号</div>
										<div style="font-size:18px; font-family:'微软雅黑'; color:#2c2c2c; height:25px; line-height:25px;">
                                                                                    <?php if(!empty($pay_info["pay_no"])): ?><span id="order_no"><?php echo ($pay_info["pay_no"]); ?></span>
                                                                                    <?php else: ?>
                                                                                    确认要出场后结算会生成<?php endif; ?>
                                                                                    
                                                                                </div>
									</div>
								</div>
							</div>
							<div class="qf"></div>
							<div class="qf2"></div>
							<div class="tc3">
								<div style="padding:20px 15px;">
									<div style="width:100%; height:30px; margin-top:5px;">
										<div style="float:left; line-height:30px; font-size:16px; font-family:'微软雅黑'; color:#676c70;">
                                                                                    <span id="fee_name">停车费</span>
                                                                                    <?php if($pay_info["payment"] == '0'): ?>亲正在享受免费服务...ing︵_︵
                                                                                    <?php else: ?>
                                                                                        <?php echo ($pay_info["payment"]); endif; ?>
                                                                                    元
                                                                                </div>
										<div style="float:right;"><button type="button" class="btn btn-circle blue btn-outline">暂无优惠</button></div>
										<div style="clear:both"></div>
									</div>
									<div style="width:100%; margin-top:15px; height:30px; line-height:30px; font-size:18px; font-family:'微软雅黑'; color:#676c70;">还需支付<span style="color:#fb4746; font-size:24px;"><span id="total_fee"><?php echo ($pay_info["payment"]); ?></span>元</span></div>
								</div>
							</div>
							<div class="tc4"><button class="btn blue tc5 btn-block" id="button_pay_now"><span style="font-size:20px;">我要出去，现在结算</span></button></div>
                       </div>
                    <!-- END PAGE BASE CONTENT -->
             	    </div>
					</div>
					<div style="width:100%; text-align:center; height:20px; line-height:20px; color:#a3a3a3; font-family:'微软雅黑'; font-size:12px;">Power by:武汉邻钱科技有限公司</div>
                <!-- END CONTENT BODY -->
              </div>
        </div>
        <div class="quick-nav-overlay"></div>
		</div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo (C("STATICS_URL")); ?>plublic/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("STATICS_URL")); ?>plublic/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            
            
            var auto_go='';
            
            $('#button_pay_now').on('click',function(){
                var fee_name=$('#fee_name').html(); //费用名称
                var order_no=$('#order_no').html(); //订单编号
                var car_no=$('#car_no').html();   //车牌号 
                alert(order_no);
                //使用ajax异步申请微信支付
                $.ajax({
                    url:"http://car.vhi99.com?m=Home&c=Payrecord&a=pay_now",
                    data:{'fee_name':fee_name,'order_no':order_no,'car_no':car_no},
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg){
                            //将json字串转为json对象
                            //alert(msg);
                            var msg_json=JSON.parse(msg);
                            //alert(msg_json.appId);
                            //调用微信内部支付js
                            
                            if (typeof WeixinJSBridge == "undefined"){
                               if( document.addEventListener ){
                                   document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                               }else if (document.attachEvent){
                                   document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
                                   document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                               }
                            }else{
                               onBridgeReady(msg_json);
                            }
                            
                           
                        }else{
                            alert('哎呀，支付失败鸟！');
                        }
                    }
                });
                auto_go=setInterval('check_pay_is_ture_ok()',2000);  //2秒调用一次(检查微信回调文件 )
            });
            
            
            function onBridgeReady(msg_json){
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest', {
                        "appId":msg_json.appId,     //公众号名称，由商户传入     
                        "timeStamp":msg_json.timeStamp,         //时间戳，自1970年以来的秒数     
                        "nonceStr":msg_json.nonceStr, //随机串     
                        "package":msg_json.package,     
                        "signType":msg_json.signType,         //微信签名方式：     
                        "paySign":msg_json.paySign //微信签名 
                    },
                    function(res){
                        // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。 
                        if(res.err_msg == "get_brand_wcpay_request：ok" ) {
                            
                        }     
                    }
                );
            }
            
            /*
            $(function(){
                check_pay_is_ture_ok();
            });
            */
            
            
            //识辨微信回调信息，并给出相应提示
            var flag=0;
            
            function check_pay_is_ture_ok(){
                var order_no=$('#order_no').html(); //订单编号
                //alert("http://car.vhi99.com<?php echo U('WeiXin_call_back');?>");
                $.ajax({
                    url:"http://car.vhi99.com?m=Home&c=Payrecord&a=WeiXin_call_back",
                    data:{'order_no':order_no},
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        if(msg==true){
                            clearInterval(auto_go);
                            alert('您已成功支付本次订单，请在15分钟内离开，否则可能会产生额外费用！');
                            //同时刷新页面
                            window.location.reload();
                        }else if(msg==false){
                            //alert(1111);
                            flag++;
                            //200秒操作时间
                            if(flag>50){
                                clearInterval(auto_go);
                                alert(1111);
                            }
                        }else{
                            clearInterval(auto_go);
                            alert(msg);
                        }
                    }
                });
            }
           
           
           /*
            //调用js微信支付
            $('#button_pay_now').on('click',function(){
                var fee_name=$('#fee_name').html(); //费用名称
                var order_no=$('#order_no').html(); //订单编号
                var total_fee=$('#total_fee').html();   //最终需要支付的总费用
                function ByWxPay(msg_json){
                    //var myf=document.getElementById('mydataform');
                     //myf.action=formPostUrl;
                        //$('#paytype').val('weixin');
                        //document.myform.submit();
                        $.ajax({
                                url:"<?php echo U('Payrecord/pay_now');?>",
                                //data:$('#mydataform').serialize(),
                                data:msg_json,
                                type:'post',
                                dataType:'json',
                                success:function(data){			
                                        //swal("失败",data.msg,"error");
                                        if(data.error==0){
                                                //alert(data.redirctUrl);
                                                WeixinJSBridge.invoke("getBrandWCPayRequest",data.weixin_param,function(res){
                                                        WeixinJSBridge.log(res.err_msg);
                                                        if(res.err_msg=="get_brand_wcpay_request:ok"){
                                                                //setTimeout(window.location.href=data.redirctUrl,2000);
                                                                //alert('支付成功');
                                                                window.location.href=data.redirctUrl;
                                                        }else{
                                                                if(res.err_msg=="get_brand_wcpay_request:cancel"){
                                                                        var err_msg="您取消了支付";
                                                                }else if(res.err_msg=="get_brand_wcpay_request:fail"){
                                                                        var err_msg="支付失败<br/>错误信息："+res.err_desc;
                                                                }else{
                                                                        var err_msg=res.err_msg +"<br/>"+res.err_desc;
                                                                }
                                                                alert(err_msg);
                                                        }
                                                });
                                        }else{
                                                alert(data.msg);
                                        }
                                },
                                error:function(){
                                        //alert('loading error');
                                }
                        })
                }
            }
            */
        </script>
    </body>

</html>