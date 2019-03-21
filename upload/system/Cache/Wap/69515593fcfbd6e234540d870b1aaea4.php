<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>交易详情</title>
	<script src="<?php echo ($static_path); ?>js/jquery.js" language="javascript" type="text/javascript"></script>
    <link href="<?php echo ($static_path); ?>css/weui.css" rel="stylesheet" type="text/css" />
	<style type="text/css"> 
	 @font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")} 
        body{background: #f5f5f5;margin: 0px;}
		.wxzf{height: 50px;margin-top: 25px;padding: 0 13px; }
		.zhifu{width:95%;height:50px;border-radius:5px;background-color:#04BE02;border:0px #04BE02 solid;cursor:pointer;color:white;font-size:16px;}
        .weui_icon_area{width: 70px;height: 70px;margin: 0 auto;margin-top:30px;}
        .weui_icon_area img{width: 70px;height: 70px;}
        .zfcg{text-align: center;margin-top: 5px;}
        .jiner{width: 100%;height: 35px;text-align: center;line-height: 35px;font-size:26px;font-family:Helvetica;margin-bottom: 15px;}
        .skr{width: 92%;height: 40px;line-height: 40px;font-size:14px;font-family:Helvetica;margin: 0 auto;border: 1px solid #e1e1e1;border-right: 0;border-left: 0;margin-top: -1px;}
        .jiner_1 span{font-family:Helvetica;font-size: 38px; }
        .skr span{color: #858585;}
        .xm{float: right;}
    </style>  
    <script type="text/javascript">
		$(function(){
			$('.weui_btn_primary').click(function(){
				//window.close();   //关闭当前页面
				WeixinJSBridge.call('closeWindow');
			})
		})
    </script>
</head>
<body>
<div id="innerHtml">
	<div class="weui_icon_area">
		<img src="<?php echo ($static_path); ?>/images/123.png">
	</div>
	<div class="zfcg" style="padding-bottom:5px;">
		<span style="font-size:19px;color:#3fb837;" id="paySatus">支付成功</span>
	</div>		
	<div class="jiner">
		<div class="jiner_1"><span id="money">￥<?php echo ($view_content["money"]); ?><span></div>
	</div>
	<div class="skr">
		<div class="skr_1"><span class="sk">收款商家</span><span class="xm"><?php echo ($view_content["title"]); ?></span></div>
	</div>
	<div class="skr">
		<div class="skr_1"><span class="sk">优惠提供方</span><span class="xm"><?php echo ($view_content["mer_name"]); ?></span></div>
	</div>
	<div align="center" class="wxzf">
		<button class="zhifu weui_btn weui_btn_primary" type="button" stle="disabl">完成</button>
	</div>
	<div class="skr" style="margin-top: 10px;">
		<a href="<?php echo ($view_content["ds_url"]); ?>"><img src="<?php echo ($view_content["ds_img"]); ?>" style="width:100%;height:150px;border: 0;"></a>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var money = "<?php echo ($view_content["money"]); ?>";
		var mer_name = "<?php echo ($view_content["title"]); ?>";
		var out_trade_no = "<?php echo ($view_content["out_trade_no"]); ?>";
		var cou_money = "<?php echo ($view_content["cou_money"]); ?>";
		var ds_type = "<?php echo ($view_content["ds_type"]); ?>";
		var meal_add = "<?php echo ($view_content["meal_add"]); ?>";
		var ds_uid = "<?php echo ($view_content["ds_uid"]); ?>";
		var ds_merId = "<?php echo ($view_content["ds_merId"]); ?>";
		var mer_id = "<?php echo ($view_content["mer_id"]); ?>";		
		var first_head="<?php echo ($view_content["first_head"]); ?>";
		$.ajax({
			data:'money='+money+'&mer_name='+mer_name+'&out_trade_no='+out_trade_no+'&cou_money='+cou_money+'&ds_type='+ds_type+'&meal_add='+meal_add+'&ds_uid='+ds_uid+'&ds_merId='+ds_merId+'&mer_id='+mer_id+'&first='+first_head,
			url:"<?php echo U('Pay/af_pay');?>",
			type:"POST",
			success:function(data){
//				alert(data);
			},
//			error:function(XMLHttpRequest, textStatus, errorThrown){
//				alert(XMLHttpRequest.status);
//				alert(XMLHttpRequest.readyState);
//				alert(textStatus);
//			}
		})
	})
</script>
</body>
</html>