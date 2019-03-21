<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php echo ($shareScript); ?>
	<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery.mmenu.all.css" />
	<link href="<?php echo ($static_path); ?>css/style.css?ver=<?php echo time(); ?>" rel="stylesheet" >
	<link href="<?php echo ($static_path); ?>css/iconfont.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js?211" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/checkSubmit.js?ver=<?php echo time(); ?>"></script>	
	<script type="text/javascript">
		function onBridgeReady(){
		  //隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
		  WeixinJSBridge.call('hideOptionMenu');
		  //隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
		  WeixinJSBridge.call('hideToolbar');
		}
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
				document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
			}
		}else{
			onBridgeReady();
		}
	wx.ready(function(){
		wx.hideOptionMenu();
	});
</script>
	<script type="text/javascript">	
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>
	<script>
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	$(function() {
		//$(".pigcms-main").css('height', $(window).height()-50);
		$('div#slide_menu').mmenu();
		$(".pigcms-slide-footer").css('top', $(window).height()-180);
		$("#mm-0").css('height', $(window).height()-150);
		$('#pigcms-header-left').click(function(){
			setTimeout(function(){
				$("#shop-detail-container").css('width', $("#user-info").width()-95);
			},10);
		})
	});
	</script>
	<style>
		.has-msg:after{
			content: '0'!important;
		}
		.has-order:after{
			content: '0'!important;
		}
	</style>
</head>

<link href="<?php echo ($static_path); ?>css/weui.css" rel="stylesheet"/>
<style type="text/css">
<!--
.weui_dialog_bd {
  padding: 10px 20px 0;
  font-size: 14px;
  color: #000000;
  text-align:left;
  line-height:1.7rem;
}
-->
</style><body>
<header class="pigcms-header mm-slideout">
    <p id="pigcms-header-title">提现操作</p>
			<div class="sjtx_txsm">
			<div class="txx2">
			
			<div class="container js_container">
    <div class="page slideIn dialog">
    <div class="bd spacing">
        <a href="javascript:;" id="showDialog2">提现说明</a><br>
    </div>
    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog2" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_bd">1、办理提现需提供正确银行卡（不支持信用卡）；<br/>
2、提现时间为每月月底；<br/>
3、提现申请提交后系统将在1个工作日内受理，提现成功后3-5个工作日到账.</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->
    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog3" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_bd">
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="sjtx_ki">
                        <div class="sjtx_fq">
                            <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">提现金额:<?php echo ($v["tc_money"]); ?>.00元</div>
                            <div class="sjtx_cw"style="margin-top: -10px;width: 400px;">提现状态:<?php if($v['status'] == 0): ?><font color="red">待处理</font><?php elseif($v['status'] == 1): ?><font color="red">审核中</font><?php elseif($v['status'] == 2): ?><font color="green">通过审核</font><?php else: ?><font color="red">审核不通过</font><?php endif; ?>
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">提交时间:<?php echo (date("Y-m-d",$v["sub_time"])); ?></div>
                            </div>
                            <?php if($v['status'] != 0): ?><div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核人:<?php echo ($v["dispose_name"]); ?></div>
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核时间:<?php echo (date("Y-m-d",$v["dispose_time"])); ?></div><?php endif; ?>
                            <?php if($v['remark'] != ''): ?><div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核说明:<?php echo ($v["remark"]); ?></div><?php endif; ?>
                        </div>
                        <div class="both"></div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog2 primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->
</div>
</div>
			</div>
			
			
			
			<div class="txx"><img src="<?php echo ($static_path); ?>/images/txx.jpg" style="width:50%; height:50%;" /></div>
			<div class="both"></div>
		</div>
</header>
<!--左侧菜单-->
<div class="container container-fill" style='padding-top:50px'>

<div id="slide_menu">

	<header class="pigcms-slide-header">

		<a id="pigcms-slide-left"><i class="iconfont icon-set"></i></a>

		<p id="pigcms-slide-title"><?php echo ($mer_name); ?></p>

		<!--<a id="pigcms-slide-right">

			<i class="iconfont icon-mail "></i>

		</a>-->

		<div id="user-info">

			<img src="<?php echo ($mer_img); ?>" alt="" id="shop-img" onerror="this.src='<?php echo ($config["site_merchant_logo"]); ?>'">

			<div id="shop-detail-container">

				<p id="shop-balance">粉丝数<span><?php echo ($fans_count); ?></span></p>

				 <div id="shop-order-container">

					<div class="order-container">

						<p class="order-count" id='all-order-count'><?php echo ($allordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/ordermang');?>">全部订单</a></p>

					</div>

					<div class="order-container">

						<p class="order-count" id='today-order-count'><?php echo ($todayordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/index');?>">今日订单</a></p>

					</div>

					<div class="order-container">

						<p class="order-count" id='month-order-count'><?php echo ($monthordercount); ?></p>

						<p class="order-text"><a href="<?php echo U('Index/index');?>">本月订单</a></p>

					</div>

				 </div>

			</div>

		</div>

	</header>

	<ul>
		<li>                                       
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('WapMerchant/Index/index',array('token'=>$merid));?>"><i class="iconfont icon-home"></i>管理首页</a></li>
		<li>
		<li>                                       
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Wap/Index/index',array('token'=>$merid));?>"><i class="iconfont icon-home"></i>我的小店</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/store_list');?>"><i class="iconfont icon-shop"></i>店铺管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/ordermang');?>"><i class="iconfont icon-form"></i>订单管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/promang');?>"><i class="iconfont icon-goods"></i>商品管理</a></li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/staff');?>"><i class="iconfont icon-friends"></i>店员管理</a></li>
		<!--li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href=""><i class="iconfont icon-iconfontwechat"></i>分佣管理</a>
		</li-->
		<!--<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/Capital');?>"><i class="iconfont icon-recharge"></i>资金管理</a>
		</li>----->
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/hardware');?>"><i class="iconfont icon-printer"></i>打印机管理</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="Cashier/merchants.php?m=Index&c=login&a=index&type=merchant"><i class="iconfont icon-friends"></i>商家收银</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/merchantewm');?>"><i class="iconfont icon-code"></i>商家二维码</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/merchant_qrcode');?>"><i class="iconfont icon-code"></i>付款二维码</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#'  id="qrcodeBtn"><i class="iconfont icon-code shao"></i>扫一扫</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/withdraw');?>"><i class="iconfont icon-licaishouyi"></i>我要提现</a>
		</li>
		<li>
			<a class="mm-subopen"></a>
			<a href='#' onclick="jumpLink(this)" data-href="<?php echo U('Index/logout');?>"><i class="iconfont icon-exit"></i>退出</a>
		</li>
	</ul>

	<footer class="pigcms-slide-footer">
		<a id='order-list' href="<?php echo U('Index/ordermang');?>">
			<i class="iconfont icon-form "></i>
			<span>所有店铺订单</span>
		</a>
		<a id='shop-list' href="<?php echo U('Index/store_list');?>">
			<i class="iconfont icon-file2"></i> 
			<span>店铺列表</span>
		</a>
		<div class="clearfix"></div>
	</footer>

	<script>
		$('#qrcodeBtn').click(function(){
			if(motify.checkWeixin()){
				motify.log('正在调用二维码功能');
				wx.scanQRCode({
					desc:'scanQRCode desc',
					needResult:0,
					scanType:["qrCode"],
					success:function (res){
						// alert(res);
					},
					error:function(res){
						motify.log('微信返回错误！请稍后重试。',5);
					},
					fail:function(res){
						motify.log('无法调用二维码功能');
					}
				});
			}else{
				motify.log('您不是微信访问，无法使用二维码功能');
			}
		});
		
		$("#pigcms-slide-right").click(function(){
			$("#staff-message-li").trigger('click');
		})
		$("#order-list").click(function(){
			$("#order-list-li").trigger('click');
		})
		$("#pigcms-slide-left").click(function(){
			$("#shop-settings-li").trigger('click');
		})
		$("#shop-list").click(function(){
			$("#shop-list-li").trigger('click');
		})
		function jumpLink(obj){
			var url = $(obj).attr('data-href');
			setTimeout(function(){
				window.location.href = url;
			},500);
		}
	</script>

</div>
<!--左侧菜单结束-->
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_index.css">
<div class="pigcms-main">
    <?php if(!empty($wap_MerchantAd)): ?><script src="<?php echo ($static_path); ?>js/swipe.js"></script>
        <div class="pigcms-container">
            <div class="addWrap">
                <div class="swipe" id="mySwipe">
                    <div class="swipe-wrap">
                        <?php if(is_array($wap_MerchantAd)): $i = 0; $__LIST__ = $wap_MerchantAd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adv): $mod = ($i % 2 );++$i;?><div>
                                <a href="<?php echo ($adv['url']); ?>">
                                    <img class="img-responsive" src="<?php echo ($adv['pic']); ?>"  alt="<?php echo ($adv['name']); ?>"/>
                                </a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div id="position_wrap">
                    <ul id="position">
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                var banner_w = $(window).width();
                var banner_h = 200 * banner_w / 640;
                $(".img-responsive").css('height',banner_h);
                for(var i=0;i<$(".img-responsive").length;i++){
                    $("<li class=''></li>").appendTo('#position');
                }
                $("#position li:first").addClass('cur');
                var bullets = document.getElementById('position').getElementsByTagName('li');
                var banner = Swipe(document.getElementById('mySwipe'), {
                    auto: 4000,
                    continuous: true,
                    disableScroll: false,
                    callback: function(pos) {
                        var i = bullets.length;
                        while (i--) {
                            bullets[i].className = ' ';
                        }
                        bullets[pos].className = 'cur';
                    }
                });
            </script>
        </div><?php endif; ?>
    <div class="pigcms-container" id="count-container" style="">
		
		<div class="sjtx_bj">
		<div class="sjtx_txje">
			<div class="sjtx_txje2">
				<div class="sjtx_jy">交易总金额</div>
				<div class="sjtx_jy2"><?php echo ($allincomecount['actualall']); ?><span style="font-size:18px; font-weight:normal;">元</span></div>
			</div>
			<div class="sjtx_txje3">
				<div class="sjtx_jy">可提现金额</div>
				<div class="sjtx_jy2"><?php echo ($allincomecount['payall']); ?><span style="font-size:18px; font-weight:normal;">元</span></div>
			</div>
			<div class="both"></div>
		</div>
		<a href="<?php echo U('Index/dodraw');?>"><div class="sjtx_but">我要提现</div></a>
            <a href="javascript:;" id="showDialog3"><div class="sjtx_but">进度查询</div></a>
            <div style="height:14px; overflow:hidden;"></div>
	</div>
	
<div class="sjtx_sna">最近30天收支明细</div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="sjtx_ki">
	<div class="sjtx_fq">
        <?php if($vo['name'] == '4'): ?><div class="sjtx_cw"><?php echo ($vo['order_name']); ?></div>
            <?php else: ?>
            <div class="sjtx_cw"><?php echo ($vo['order_name']['name']); ?></div><?php endif; ?>
	</div>
	<div class="sjtx_fq2">
		<div class="sjtx_cw2"><?php echo (date("Y-m-d" ,$vo['pay_time'])); ?></div>
        <?php if($vo['name'] == '4'): ?><div class="sjtx_cw3" style="color: red;">-<?php echo ($vo['payment_money']); ?>元</div>
            <?php else: ?>
            <div class="sjtx_cw3" style="color: green;">+<?php echo ($vo['order_name']['price']); ?>元</div><?php endif; ?>
	</div>
	<div class="both"></div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
        <script src="<?php echo ($static_path); ?>js/zepto.min.js"></script>
        <script>
            $('#showDialog2').click(function (e) {
                var $dialog = $('#dialog2');
                $dialog.show();
                $dialog.find('.weui_btn_dialog').one('click', function () {
                    $dialog.hide();
                });
            })
            $('#showDialog3').click(function (e) {
                var $dialog = $('#dialog3');
                $dialog.show();
                $dialog.find('.weui_btn_dialog2').one('click', function () {
                    $dialog.hide();
                });
            })
        </script>
</div>
<div id="share-copy-wrap">
    <img src="<?php echo ($static_path); ?>/images/android_share.png" id='android-share-img'>
    <img src="<?php echo ($static_path); ?>/images/android_copy.png" id='android-copy-img'>
    <img src="<?php echo ($static_path); ?>/images/ios_share.png" id='ios-share-img'>
    <img src="<?php echo ($static_path); ?>/images/ios_copy.png" id='ios-copy-img'>
    <img src="<?php echo ($static_path); ?>/images/qrcode.png" id='qrcode-img'>
</div>
</div>
</body>

<script type="text/javascript">
    var os = "windows",
        container = "web",
        chart_url = "<?php echo U('Index/getchart');?>",
        pic_url = "" ? "" : "";
</script>
<script src="<?php echo ($static_path); ?>/js/chart.min.js"></script>
<script src="<?php echo ($static_path); ?>/js/shop_index.js"></script>
<script type="text/javascript">
    var on = false;
    $(".settings-icon").click(function(event) {
        $this = $(this);
        if(!on){
            var url = "";
            $.post(url, '', function(data) {
                on = true;
                $("#confirm-close").show();
                $("#status-container span").text("店铺正常营业中").css('color','#696969');
            });

        }
    });


</script>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	//隐藏右上角菜单，需要显示请把hideOptionMenu换成showOptionMenu
	WeixinJSBridge.call('hideOptionMenu');
	//隐藏下方工具栏，需要显示顶部导航栏，请把hideToolbar换成showToolbar
	WeixinJSBridge.call('hideToolbar');
});
</script>


</html>