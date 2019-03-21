<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title >付款</title>
	<script src="{pigcms{$static_path}js/jquery.js" language="javascript" type="text/javascript"></script>
	<script src="{pigcms{$static_path}js/jquery.min1.8.js" language="javascript" type="text/javascript"></script>
	<link rel="stylesheet" href="{pigcms{$static_path}js/layer/skin/layer.css" type="text/css">
	<link rel="stylesheet" href="{pigcms{$static_path}js/layer/skin/layer.ext.css" type="text/css">
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/weui.css" rel="stylesheet"/>
    <!--<link href="{pigcms{$static_path}css/example.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="{pigcms{$static_path}css/prism.css">
	<script type="text/javascript" charset="utf-8" src="{pigcms{$static_path}js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="{pigcms{$static_path}js/layer/layer.js"></script>
	<style type="text/css">
	 /*@font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")}*/
		body{background: #f0eff5;margin: 0px;}
		.wxzf{/*height: 50px;*/margin-top: -95px;padding: 0 8px;}
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
        #shanjia{line-height:80px;border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:80px;width: 200%;border-left:0;border-right: 0;}
	     #cou{margin-bottom: -30px;height: 80;background: #ffffff;}
        #cou{line-height:80px;border: 1px solid #d4d3d8;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:80px;width: 200%;border-left:0;border-right: 0;}
	    .weui_cells{background: none;}
	    .weui_btn_area{margin:0px;}
	</style>
	<script type="text/javascript">
		function checkForm(){
			var money=document.getElementById('money').value;
			//alert(money);
			if(money=="" || money=="null"){
				layer.msg('请先输入金额');
				return false;
			}else{

				return true;
			}
		}
	</script>


</head>

<body>
<div class="header_nav">
<div class="nav_img">
	<!--<img src="http://wx.qlogo.cn/mmopen/Q3auHgzwzM65asQWmSZedFia9JN9WtiboIiahJxVU5hKyRZHQA2reUWWEH8F2Q7rtt0vDeLepSHdOicv3J3OkIeHKQ/0">-->
	<img src="{pigcms{$view_content.img}">
</div>
<div class="nav_shngjia" style="display:none;"><span>向<!--武汉大头仔餐饮管理有限公司-->{pigcms{$view_content.title}付款</span></div>
</div>
<div class="dingdanghao">
	<!--<if condition="$view_content.mer_id eq '' ">
	<div class="weui_cell weui_cell_select weui_select_after" style="text-align:center;" id="shanjia">
		<div class="weui_cell_bd weui_cell_primary" >
				<select class="weui_select" name="merid" style="font-size:14px;color:#464646;" id="youhui" >
					<option value="">请选择商家</option>
					<volist name="mer" id="vo">
						<option value="{pigcms{$vo.mer_id}"><div style="float: right;width: 20px;background:url('{pigcms{$vo.adverimgurl}') "></div>{pigcms{$vo.name}</option>
					</volist>
				</select>
		</div>
	</div>
	</if>-->
	   
	<form action="{pigcms{:U('Pay/givejs')}" method="post" id="submit" onsubmit="return checkForm(this);">
	<div class="dingdang">
		  <if condition="$view_content.mer_id eq '' ">
        	<div class="dingdang_create2 " id="shanjia" >
        	<div class="action_border">
            <div class="weui_cell weui_cell_select weui_select_after"  style="background: #fff;">
            <div class="weui_cell_hd" style="padding-left: 15px;color:#464646;font-size: 27px;padding-left: 29px;">商家</div>
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="merid" id="youhui" style="color:#464646;font-size: 27px;">
                <volist name="mer" id="vo">
				<option value="{pigcms{$vo.mer_id}"><div style="float: right;width: 20px;background:url('{pigcms{$vo.adverimgurl}') "></div>{pigcms{$vo.name}</option>
				</volist>
                </select>
            </div>
            </div>
            </div>
            </div>
            </if>
	    <div class="dingdang_create " id="jr" >
		<div style="padding-bottom:4px;padding: 35px 30px;"><span style="color:#464646;font-size:27px;">金额</span>
			<input type="hidden" name="mer_id" id="mer_id" value="{pigcms{$view_content.mer_id}">
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
					<div class="weui_cell_hd" style="padding-left: 15px;color:#464646;font-size: 27px;padding-left: 29px;">优惠金额</div>
					<div class="weui_cell_bd weui_cell_primary">
						<select class="weui_select" name="dsid" id="mer_cou" style="color:#464646;font-size: 27px;">
						</select>
						<input type="hidden" name="favorable" id="ds_id" value="">
					</div>
				</div>
			</div>
		</div>
<!--		<div class="weui_cells weui_cells_form" id="yh">-->
<!--			<div class="weui_cell weui_cell_switch" >-->
<!--				<div class="weui_cell_hd weui_cell_primary"  style="font-size:15px ;color:#595959;font-family:Helvetica;padding: 0 16px;">最新优惠</div>-->
<!--				<div>-->
<!--					<input type="hidden" name="favorable" id="ds_id" value="">-->
<!--					<select class="weui_select" name="ds_id" id="" style="color:#464646;font-size: 15px;">-->
<!--						<volist name="dataip" id="vo">-->
<!--							<option value="{pigcms{$vo.ds_id}">{pigcms{$vo.ds_name}</option>-->
<!--						</volist>-->
<!--					</select>-->
<!--					<span class="optimal" style="color:#000 ;font-size: 27px;color:#595959;font-family:Helvetica;padding: 0 16px;"></span>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<span class="optimal" style="color:#000 ;font-size: 27px;color:#595959;font-family:Helvetica;padding: 0 16px;"></span>-->
		<div class="weui_cells weui_cells_form" id="shangjia" style="display:none;">
			<div class="weui_cell weui_cell_switch">
				<div class="weui_cell_hd weui_cell_primary"  style="font-size:14px ;color:#595959;font-family:Helvetica;padding: 0 3px;">优惠商家</div>
				<div>
					<span class="shangjia" style="color:#000 ;font-size: 14px;color:#595959;font-family:Helvetica;padding: 0 3px;"></span>
				</div>
			</div>
		</div>
		 <div class="dingdang_create1 " id="zk" >
		
		<div class="zhekou_list " >
		<div class="zhekou1"><span class="zhe_left" style="color:#595959;font-size: 27px;">优惠</span><span class="zhe_right" id="yhld"></span></div>
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
                    <div class="weui_loading_leaf weui_loading_leaf_11"></div>
                </div>
                <p class="weui_toast_content">数据加载中</p>
            </div>
        </div>
</div>
</div>
     <script src="{pigcms{$static_path}js/zepto.min.js"></script>
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
		<!--<button class="zhifu" type="button" onclick="callpay()" >立即转账</button>-->
<div class="weui_opr_area" >
                <p class="weui_btn_area">
                <span style="font-size:15px;font-weight:bold;"><input class="zhifu weui_btn weui_btn_primary" type="button" value="付款"></span>
		        <a href="{pigcms{:U('My/recharge')}" class="weui_btn weui_btn_default" style="margin-top:10px;">充值</a>
                </p>
            </div>
	</div>
	
	</form>
	
</div>

<script type="text/javascript">
	var mer_id="{pigcms{$view_content.mer_id}";
	if(mer_id){
		$(".nav_shngjia").show();
	}
	$("#youhui").change(function(){
		var merchant = '{pigcms{$merchant}';
		var mer_id = $('#youhui option:selected').val();
		merchant = JSON.parse(merchant);
		$.each(merchant,function(i,val){
			if(mer_id==merchant[i].mer_id){
				$("#mer_id").val(mer_id);
				if(merchant[i].pic_info!=""){
					$(".nav_img img").attr('src',merchant[i].adverimgurl);
				}else{
					$(".nav_img img").attr('src','http://www.hdhsmart.com/static/images/hdhlogo.png');
				}
			}
		})
	})
	$(function(){
		var cou_list = '{pigcms{$data_vip}';
		var cou_html = '';
		cou_list = JSON.parse(cou_list);
		$.each(cou_list, function(i,val){
			cou_html+='<option value='+cou_list[i].ds_id+' att='+cou_list[i].ds_type+' co='+cou_list[i].ds_scale+'>';
			if(cou_list[i].ds_type=="0"){
				cou_html+= '('+cou_list[i].ds_scale+'&nbsp;&nbsp;元抵用券)'+cou_list[i].ds_name;
			}
			if(cou_list[i].ds_type=="1"){
				cou_html+= '('+cou_list[i].ds_scale*10+'&nbsp;&nbsp;折优惠)'+cou_list[i].ds_name;
			}
			cou_html+='</option>';
		})
		$("#mer_cou").html(cou_html);

		//	优惠金额
		var ds_minmoney="0";
		var ds_maxmoney="0";
		var duibi_money = "0";
		var duibi_paymoney = "0";
		var duibi_dsid = "0";
		var duibi_optimal = "";
		$('#money').bind('input propertychange', function() {
			setYH();
		});
		function setYH(){
			var cou_list = '{pigcms{$data_vip}';
			cou_list = JSON.parse(cou_list);
			var optimal = "";
			var ds_id = "";
			var cou_money = "0";
			var pay_money = "";
			var money = document.getElementById('money').value;
			if(parseFloat(money)>0){
				$.each(cou_list, function(i,val){
					duibi_dsid = cou_list[i].ds_id;
					ds_minmoney = parseFloat(cou_list[i].ds_minmoney);
					ds_maxmoney = parseFloat(cou_list[i].ds_maxmoney);
//			判断是那种优惠，算出相应的优惠
					if(ds_minmoney>0&&ds_maxmoney>0||ds_minmoney=="0"&&ds_maxmoney>0){
						if(parseFloat(money).toFixed(2)>=ds_minmoney&&parseFloat(money).toFixed(2)<=ds_maxmoney){
							if(cou_list[i].ds_type=="0"){
								duibi_money = parseFloat(cou_list[i].ds_scale).toFixed(2);
								duibi_paymoney = (parseFloat(money)-parseFloat(cou_list[i].ds_scale)).toFixed(2);
								duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale+'&nbsp;&nbsp;</span>元抵用券';
								if(duibi_paymoney<0){
									duibi_money = money;
									duibi_paymoney = "0";
								}
//						document.getElementById('yhld').innerText = cou_money+"元";
//						document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:16px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:16px;'>元</span>";
//						document.getElementById('sjmoney').value = pay_money;
							}
							if(cou_list[i].ds_type=="1"){
								duibi_money =(parseFloat(money)-(parseFloat(cou_list[i].ds_scale)*parseFloat(money))).toFixed(2);
								duibi_paymoney = (parseFloat(cou_list[i].ds_scale)*parseFloat(money)).toFixed(2);
								duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale*10+'</span>&nbsp;&nbsp;折优惠';
								if(pay_money<0){
									duibi_money = money;
									duibi_paymoney = "0";
								}
							}
//				得到打的值
							if(cou_money=="0"){
								cou_money=duibi_money;
								pay_money = duibi_paymoney;
								ds_id = duibi_dsid;
								optimal = duibi_optimal;
							}else{
								if(parseFloat(cou_money)<parseFloat(duibi_money)){
									cou_money=duibi_money;
									pay_money = duibi_paymoney;
									ds_id = duibi_dsid;
									optimal = duibi_optimal;
								}
							}
						}
					}else if(ds_minmoney>0&&ds_maxmoney=="0"){
						if(parseFloat(money).toFixed(2)>=ds_minmoney){
							if(cou_list[i].ds_type=="0"){
								duibi_money = parseFloat(cou_list[i].ds_scale).toFixed(2);
								duibi_paymoney = (parseFloat(money)-parseFloat(cou_list[i].ds_scale)).toFixed(2);
								duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale+'&nbsp;&nbsp;</span>元抵用券';
								if(duibi_paymoney<0){
									duibi_money = money;
									duibi_paymoney = "0";
								}
//						document.getElementById('yhld').innerText = cou_money+"元";
//						document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:16px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:16px;'>元</span>";
//						document.getElementById('sjmoney').value = pay_money;
							}
							if(cou_list[i].ds_type=="1"){
								duibi_money =(parseFloat(money)-(parseFloat(cou_list[i].ds_scale)*parseFloat(money))).toFixed(2);
								duibi_paymoney = (parseFloat(cou_list[i].ds_scale)*parseFloat(money)).toFixed(2);
								duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale*10+'</span>&nbsp;&nbsp;折优惠';
								if(pay_money<0){
									duibi_money = money;
									duibi_paymoney = "0";
								}
							}
//				得到打的值
							if(cou_money=="0"){
								cou_money=duibi_money;
								pay_money = duibi_paymoney;
								ds_id = duibi_dsid;
								optimal = duibi_optimal;
							}else{
								if(parseFloat(cou_money)<parseFloat(duibi_money)){
									cou_money=duibi_money;
									pay_money = duibi_paymoney;
									ds_id = duibi_dsid;
									optimal = duibi_optimal;
								}
							}
						}
					}else if(ds_minmoney=="0"&&ds_maxmoney=="0"){
						if(cou_list[i].ds_type=="0"){
							duibi_money = parseFloat(cou_list[i].ds_scale).toFixed(2);
							duibi_paymoney = (parseFloat(money)-parseFloat(cou_list[i].ds_scale)).toFixed(2);
							duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale+'&nbsp;&nbsp;</span>元抵用券';
							if(duibi_paymoney<0){
								duibi_money = money;
								duibi_paymoney = "0";
							}
//						document.getElementById('yhld').innerText = cou_money+"元";
//						document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:16px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:16px;'>元</span>";
//						document.getElementById('sjmoney').value = pay_money;
						}
						if(cou_list[i].ds_type=="1"){
							duibi_money =(parseFloat(money)-(parseFloat(cou_list[i].ds_scale)*parseFloat(money))).toFixed(2);
							duibi_paymoney = (parseFloat(cou_list[i].ds_scale)*parseFloat(money)).toFixed(2);
							duibi_optimal = '<span style="color:red;">'+cou_list[i].ds_scale*10+'</span>&nbsp;&nbsp;折优惠';
							if(pay_money<0){
								duibi_money = money;
								duibi_paymoney = "0";
							}
						}
//				得到大的值
						if(cou_money=="0"){
							cou_money=duibi_money;
							pay_money = duibi_paymoney;
							ds_id = duibi_dsid;
							optimal = duibi_optimal;
						}else{
							if(parseFloat(cou_money)<parseFloat(duibi_money)){
								cou_money=duibi_money;
								pay_money = duibi_paymoney;
								ds_id = duibi_dsid;
								optimal = duibi_optimal;
							}
						}

					}
				});
				if(pay_money==""){
					document.getElementById('yhld').innerText = "0元";
					document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:27px;'>实际付款:</span>"+"￥"+money+"<span style='font-size:27px;'>元</span>";
					document.getElementById('sjmoney').value = money;
					$(".optimal").html("");
					$("#ds_id").val("");
//				layer.msg('没有符合该金额的优惠',{icon:0});
					layer.alert('没有符合该金额的优惠', {
						skin: 'layui-layer-molv' //样式类名
						,closeBtn: 0
					});
				}else{
					var cou_html="";
					$("#mer_cou").html("");
					$.each(cou_list, function(i,val){
						if(cou_list[i].ds_id==ds_id){
							cou_html+='<option value='+cou_list[i].ds_id+' selected="selected" att='+cou_list[i].ds_type+' co='+cou_list[i].ds_scale+'>';
						}else{
							cou_html+='<option value='+cou_list[i].ds_id+' att='+cou_list[i].ds_type+' co='+cou_list[i].ds_scale+'>';
						}
						if(cou_list[i].ds_type=="0"){
							cou_html+= '('+cou_list[i].ds_scale+'&nbsp;&nbsp;元抵用券)'+cou_list[i].ds_name;
						}
						if(cou_list[i].ds_type=="1"){
							cou_html+= '('+cou_list[i].ds_scale*10+'&nbsp;&nbsp;折优惠)'+cou_list[i].ds_name;
						}
						cou_html+='</option>';
					})
					$("#mer_cou").html(cou_html);
					document.getElementById('yhld').innerText = cou_money+"元";
					document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:27px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:27px;'>元</span>";
					document.getElementById('sjmoney').value = pay_money;
					$(".optimal").html(optimal);
					$("#ds_id").val(ds_id);
				}
			}else{
				document.getElementById('yhld').innerText = "";
				document.getElementById('yhmoney').innerHTML = "";
				document.getElementById('sjmoney').value = "";
				$(".optimal").html("");
				$("#ds_id").val("");
			}
		}
//	选择优惠方式
		$("#cou").change(function(){
			var cou_money = "0";
			var pay_money = "0";
			var money = document.getElementById('money').value;
			if(money!=""){
				var d_id = $("select[name=dsid]").val();
				var cou_list = '{pigcms{$data_vip}';
				cou_list = JSON.parse(cou_list);
				$.each(cou_list, function(i,val){
					ds_minmoney = parseFloat(cou_list[i].ds_minmoney);
					ds_maxmoney = parseFloat(cou_list[i].ds_maxmoney);
					if(ds_minmoney>0&&ds_maxmoney>0||ds_minmoney=="0"&&ds_maxmoney>0){
						if(parseFloat(money).toFixed(2)>=ds_minmoney&&parseFloat(money).toFixed(2)<=ds_maxmoney){
							if(cou_list[i].ds_id==d_id){
								if(cou_list[i].ds_type=="1"){
									pay_money = parseFloat(money)*parseFloat(cou_list[i].ds_scale);
									cou_money = parseFloat(money)-pay_money;
								}
								if(cou_list[i].ds_type=="0"){
									pay_money = parseFloat(money)-parseFloat(cou_list[i].ds_scale);
									cou_money = parseFloat(cou_list[i].ds_scale);
								}
							}
						}
					}else if(ds_minmoney>0&&ds_maxmoney=="0"){
						if(parseFloat(money).toFixed(2)>=ds_minmoney){
							if(cou_list[i].ds_id==ds_id){
								if(cou_list[i].ds_type=="1"){
									pay_money = parseFloat(money)*parseFloat(cou_list[i].ds_scale);
									cou_money = parseFloat(money)-pay_money;
								}
								if(cou_list[i].ds_type=="0"){
									pay_money = parseFloat(money)-parseFloat(cou_list[i].ds_scale);
									cou_money = parseFloat(cou_list[i].ds_scale);
								}
							}
						}
					}else if(ds_minmoney=="0"&&ds_maxmoney=="0"){
						if(cou_list[i].ds_id==ds_id){
							if(cou_list[i].ds_type=="1"){
								pay_money = parseFloat(money)*parseFloat(cou_list[i].ds_scale);
								cou_money = parseFloat(money)-pay_money;
							}
							if(cou_list[i].ds_type=="0"){
								pay_money = parseFloat(money)-parseFloat(cou_list[i].ds_scale);
								cou_money = parseFloat(cou_list[i].ds_scale);
							}
						}
					}



				})
				if(pay_money!="0"||cou_money!="0"){
					pay_money = pay_money.toFixed(2);
					cou_money = cou_money.toFixed(2);
					$("#ds_id").val(d_id);
					document.getElementById('yhld').innerText = cou_money+"元";
					document.getElementById('yhmoney').innerHTML = "<span style='color:#595959;font-size:27px;'>实际付款:</span>"+"￥"+pay_money+"<span style='font-size:27px;'>元</span>";
					document.getElementById('sjmoney').value = pay_money;
				}else{
					layer.msg('该金额不能参与该优惠',{icon:0});
					var cou_html="";
					var ds_id = $("#ds_id").val();
					$("#mer_cou").html("");
					$.each(cou_list, function(i,val){
						if(cou_list[i].ds_id==ds_id){
							cou_html+='<option value='+cou_list[i].ds_id+' selected="selected" att='+cou_list[i].ds_type+' co='+cou_list[i].ds_scale+'>';
						}else{
							cou_html+='<option value='+cou_list[i].ds_id+' att='+cou_list[i].ds_type+' co='+cou_list[i].ds_scale+'>';
						}
						if(cou_list[i].ds_type=="0"){
							cou_html+= '('+cou_list[i].ds_scale+'&nbsp;&nbsp;元抵用券)'+cou_list[i].ds_name;
						}
						if(cou_list[i].ds_type=="1"){
							cou_html+= '('+cou_list[i].ds_scale*10+'&nbsp;&nbsp;折优惠)'+cou_list[i].ds_name;
						}
						cou_html+='</option>';
					})
					$("#mer_cou").html(cou_html);
				}
			}
		})
	})
//付款
	$(".zhifu").click(function(){
		var money = document.getElementById('money').value;
		if($.trim(money)==""){
//			layer.msg('请输入支付金额',{icon:0});
       layer.alert('请输入支付金额', {
        skin: 'layui-layer-molv' //样式类名
       ,closeBtn: 0
        });
			return false;
		}
		var mer_id = $('#youhui option:selected').val();
		if(mer_id==""){
//			layer.msg('请选择优惠商家',{icon:5});
          layer.alert('请选择优惠商家', {
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
		$("#submit").submit();
		$("#showLoadingToast").click();
	})
</script>
{pigcms{$shareScript}
</body>
</html>