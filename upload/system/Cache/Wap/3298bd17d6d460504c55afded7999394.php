<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title >商家收账</title>
	<script src="<?php echo ($static_path); ?>js/jquery.js" language="javascript" type="text/javascript"></script>
	<script src="<?php echo ($static_path); ?>js/jquery.min1.8.js" language="javascript" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo ($static_path); ?>js/layer/skin/layer.css" type="text/css">
	<link rel="stylesheet" href="<?php echo ($static_path); ?>js/layer/skin/layer.ext.css" type="text/css">
    <link href="<?php echo ($static_path); ?>css/wap_pay_check.css" rel="stylesheet"/>
    <link href="<?php echo ($static_path); ?>css/weui.css" rel="stylesheet"/>
    <!--<link href="<?php echo ($static_path); ?>css/example.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/prism.css">
	<script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>js/layer/layer.js"></script>
	<style type="text/css">
	 @font-face {font-family:Helvetica;}
		body{background: #f0eff5;margin: 0px;}
		.wxzf{margin-top: -85px;padding: 0 8px;}
		/*.zhifu{width:95%;height:50px;border-radius:15px;background-color:#04BE02;border:0px #04BE02 solid;cursor:pointer;color:white;font-size:16px;}*/
		.header_nav{padding: 0 15px;}
		.nav_img{width: 75px;height: 61px;margin: 0 auto;margin-top: 5px;}
		.nav_img img{width: 74px;height: 70px;border-radius: 2px;}
		.nav_shngjia{height: 20px;text-align: center;margin-top: 13px;line-height: 20px;margin-bottom:-12px;}
        .nav_shngjia span{color:#737278;font-size: 15px;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
		.dingdanghao{width: 100%; }
		.dingdang{padding: 15px;padding-top:15px;}
        .dingdang_create{background: #ffffff;height: 95px;}
        #jr{border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:200px;width: 200%;}
         .zhekou{height: 95px;padding: 0 15px;}
        .zhekou1{height: 69px;line-height: 69px;border-bottom: 1px solid #ecebeb;padding-left: 12px;}
        .zhekou1 span{font-family:Helvetica;}
        .zhe_right{float: right;color: #737278;font-size: 27px;}
        .zhekou2{height: 54px;line-height: 170px;float: right;}
        .zhekou_list{padding:0 18px;}
        #zk{height: 80;background: #ffffff;}
        #zk{border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:200px;width: 200%;}
        #yhmoney{font-size: 68px;}
        #money{font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
        .dingdang_create{font-family:Helvetica;}
        #shangjia{border: 1px solid #d4d3d8;}
        #yh{background: #ffffff;margin-top: -90px;margin-bottom: -44px;border: 1px solid #d4d3d8; -webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:80px;width: 200%;line-height: 60px;}
	    #shanjia{margin-bottom: -30px;height: 80;background: #ffffff;}
        #shanjia{line-height:80px;border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:80px;width: 200%;}
	    #cou{margin-bottom: -30px;height: 80;background: #ffffff;}
        #cou{line-height:80px;border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:80px;width: 200%;}
	    .weui_cells{background: none;}
	     #shoukuan{border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:85px;width: 200%;font-size: 33px;font-family: "arial, helvetica, sans-serif";border-radius: 10px;}
	    #xxzf{border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:85px;width: 200%;font-size: 30px;font-family: "arial, helvetica, sans-serif";border-radius: 10px;}
	    #xxzf{margin-top:-30px;}

	</style>
	
</head>

<body>
<div class="header_nav">
<div class="nav_img">
	<img src="<?php echo ($user_info["avatar"]); ?>">
</div>
</div>
<div class="dingdanghao">		   
	<div class="dingdang">
		<div class="dingdang_create2 " id="shanjia" >
		<div class="action_border">
			<div class="weui_cell weui_cell_select weui_select_after"  style="background: #fff;">
				<div class="weui_cell_hd" style="padding-left: 15px;color:#464646;font-size: 27px;padding-left: 29px;">用户</div>
				<input type="hidden" name="uid" value="<?php echo ($user_info["uid"]); ?>">
				<div class=" weui_cell_primary">             
					<span class="weui_select" name="merid" style="color:#464646;font-size: 27px;"><?php echo ($user_info["nickname"]); ?></span>
				</div>
			</div>
		</div>
		</div>
	    <div class="dingdang_create " id="jr" >
		<div style="padding-bottom:4px;padding: 35px 30px;"><span style="color:#464646;font-size:27px;">金额</span>
		</div>
		<div style="padding-bottom:4px;padding: 0 30px;margin-top:-28px;">
			<!-- <span style="color:#999;letter-spacing:15px">金额</span> -->
			<div color="#9ACD32" style="width: 2%;float: left;margin-top:2px;"><span style="color:#000;font-size:29px">￥</span></div>
               <div style="overflow:hidden;margin-left:24px;height:70px;">
					<input type="text" name="money" value="" id="money"  style="height:70px;border:0;font-size:68px;" >
                    <input type="hidden" name="yhmoney" value="" id="sjmoney">
               </div>
		</div>
		</div>
		<div class="dingdang_create2 " id="cou" style="margin-top: -90px;">
			<div class="action_border">
				<div class="weui_cell weui_cell_select weui_select_after"  style="background: #fff;">
					<div class="weui_cell_hd" style="padding-left: 15px;color:#464646;font-size: 27px;padding-left: 29px;">优惠金额（<?=$discount_info['ds_scale']*10?>折优惠）<?php echo ($discount_info["ds_name"]); ?></div>
					<input type="hidden" name="ds_id" value="<?php echo ($discount_info["ds_id"]); ?>">
					<input type="hidden" name="mer_id" value="<?php echo ($mer_id); ?>">
				</div>
			</div>
		</div>	
		 <div class="dingdang_create1 " id="zk" >		
		<div class="zhekou_list " >
		<div class="zhekou1"><span class="zhe_left" style="color:#595959;font-size: 27px;">优惠</span><span class="zhe_right" id="yhld"></span></div>
		<input type="hidden" name="cou_money" value="" id="cou_money">
		<div class="zhekou2"><label id="yhmoney"></label> </div>
		</div>
		</div>
	</div>
	

	</div>
   <!--数据提交与加载-->
	<div align="center" class="wxzf">
		 <div class="container js_container">
         <div class="page slideIn toast">
        <div class="bd spacing">
          <span style="font-size:15px;font-weight:bold;display:none"><button href="javascript:;" class=" weui_btn weui_btn_primary" id="showLoadingToast" ></button></span>
        </div>
        <div id="loadingToast" class="weui_loading_toast" style="display:none;">
            <div class="weui_mask_transparent"></div>
            <div class="weui_toast">
                <div class="weui_loading">
                    <div class="weui_loading_leaf weui_loading_leaf_0"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_1"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_2"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_3"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_4"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_5"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_6"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_7"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_8"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_9"></div>
                    <div class="weui_loading_leaf weui_loading_leaf_10"></div>
                </div>
                <p class="weui_toast_content">数据加载中</p>
            </div>
        </div>
</div>
</div>
     <script src="<?php echo ($static_path); ?>js/zepto.min.js"></script>
     <script>
    $("#showToast").click(function(e){
        var $toast = $('#toast');
        if ($toast.css('display') != 'none') {
            return;
        }

        $toast.show();
        setTimeout(function () {
            $toast.hide();
        }, 2000);
    })
    $("#showLoadingToast").click(function(e){
        var $loadingToast = $('#loadingToast');
        if ($loadingToast.css('display') != 'none') {
            return;
        }

        $loadingToast.show();
        setTimeout(function () {
            $loadingToast.hide();
        }, 2000);
    })
     </script>
     <!--数据提交与加载-->
	<div align="center" class="wxzf">
        <span style="font-size:15px;font-weight:bold;"><input class="zhifu weui_btn weui_btn_primary" id="shoukuan" type="button" value="收款"></span>
		<span style="font-size:15px;font-weight:bold;"><input class=" weui_btn weui_btn_default" id="xxzf" type="button" value="线下支付"></span>
	</div>	
	
</div>

<script type="text/javascript">
		
		//	优惠金额
		$('#money').bind('input propertychange', function() {
			setYH();
		});
		var ds_scale="<?php echo ($discount_info["ds_scale"]); ?>";	//折扣
		//alert(ds_scale);
		function setYH(){
			var cou_money = "0";
			var pay_money = "";
			var money = document.getElementById('money').value;
			if(parseFloat(money)>0){
				cou_money =(parseFloat(money)-(parseFloat(ds_scale)*parseFloat(money))).toFixed(2);//优惠金额
				pay_money = (parseFloat(ds_scale)*parseFloat(money)).toFixed(2);//实际付款
				//alert(cou_money);
				document.getElementById('yhld').innerText = cou_money+"元";
				document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:27px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:27px;'>元</span>";
				document.getElementById('sjmoney').value = pay_money;
				document.getElementById('cou_money').value = cou_money;	//优惠金额
			}else{
				document.getElementById('yhld').innerText = cou_money+"元";
				document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:27px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:27px;'>元</span>";
				document.getElementById('sjmoney').value = pay_money;
				document.getElementById('cou_money').value = cou_money;
			}
		}
		
//付款
	$(".zhifu").bind("click",function(){
		var flag=true;	//控制多次提交表单的标志
		var money = document.getElementById('money').value;
		if($.trim(money)==""){
//			layer.msg('请输入支付金额',{icon:0});
       layer.alert('请输入支付金额', {
        skin: 'layui-layer-molv' //样式类名
       ,closeBtn: 0
        });
			return false;
		}
		var pay_money = $('#sjmoney').val();
		if(pay_money==""){
//	  layer.msg("优惠额度最低不能少于0.01元",{icon:5});
			layer.alert('支付金额不能为空', {
				skin: 'layui-layer-molv' //样式类名
				,closeBtn: 0
			});
			return false;
		}
		if(parseFloat(pay_money)<0.01){
//	  layer.msg("优惠额度最低不能少于0.01元",{icon:5});
      layer.alert('支付额度最低不能少于0.01元', {
        skin: 'layui-layer-molv' //样式类名
       ,closeBtn: 0
        });
	   		return false;
	  }
		//$("#submit").submit();
		$(this).unbind('click');
		if(flag==true){
			var yhmoney=$('input[name="yhmoney"]').val();	//实际收款
			var uid=$('input[name="uid"]').val();	//用户ID		
			var ds_id=$('input[name="ds_id"]').val();	//优惠券ID		
			var cou_money=$('input[name="cou_money"]').val();	//优惠金额
			var mer_id=$('input[name="mer_id"]').val();	//商家ID(即扫码者)
			//alert(yhmoney+'-'+uid+'-'+ds_id+'-'+cou_money);
			$.ajax({
				url:"<?php echo U('My/pay_dataForm');?>",
				type: "post", 		 
				dataType: "json",  
				data: {'yhmoney':yhmoney,'uid':uid,'ds_id':ds_id,'cou_money':cou_money,'mer_id':mer_id},  				
				async : true,
				success: function(res){
					if(res.code==2){	//订单生成成功时
						//alert(res.msg);
						$('#shoukuan').removeClass("zhifu").val(res.msg);
						setInterval(function(){		//定时轮询判断订单是否已付款
							$.ajax({
								url:"<?php echo U('My/pay_dataForm');?>",
								type: "post", 		 
								dataType: "json",  
								data: {'order_id':res.order},  				
								async : true,
								success: function(res){
									if(res.code==1){	//确认支付后
									   //alert(res.msg);
									   window.location.href="<?php echo ($config['site_url']); ?>/wap.php?g=Wap&c=My&a=check_retrun&userContent="+res.msg; 
									}else{
										//alert(res.msg);
									}
								},
								error:function(){
									layer.msg('loading error!');
								}
							});
						},1000);
					   //flag=false;
					}else{
						if(res.code==-1 || res.code==-2){
							layer.msg(res.msg);
						}
					}
				},
				error:function(){
					layer.msg('loading error!');
				}
			});	
		}
		//$("#showLoadingToast").click();
	})
</script>
<?php echo ($shareScript); ?>
</body>
</html>