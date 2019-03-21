<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>交易详情</title>
    <script src="{pigcms{$static_path}js/jquery.js" language="javascript" type="text/javascript"></script>
	
    <link href="{pigcms{$static_path}css/weui.css" rel="stylesheet" type="text/css" />
  	<link href="{pigcms{$static_path}css/weui2.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      @font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")}
        @font-face {font-family:Helvetica Bold; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica Bold.ttf")}
        
        body{background: #efeff4;margin: 0px;}
        .wxzf{height: 50px;margin-top: 25px;padding: 0 13px; }
        .skr{width: 92%;font-size:14px;margin: 0 auto;border-right: 0;border-left: 0;}
        .skr span{color: #858585;}
        .xm{float: right;}
        .weui_cell{padding: 10px 15px;}
        .weui_cell_hd{width: 40px;height: 40px;}
        #weui_img{width:35px;height: 40px;display:block;border-radius: 50%;}
        #weui_title p{font-size: 16px;}
        .action{background: #fff;}
        #nav_dh{border: 1px solid #d9d9d9; width: 100%;}
        #action_content{border: 1px solid #d4d3d8; width:100%;}
        .skr_1{font-size: 30px;;font-weight: 500;color: #888888;font-family: "arial, helvetica, sans-serif";}
        #skr_1_2{height: 55px;line-height: 55px;margin-top: 6px;}
        #skr_1_1{height: 95px;line-height: 95px;border-bottom: 1px solid #d4d3d8;}
        .weui_cd{margin: 0 auto;margin-top:-216px;background: #fff;height: 50px;}
        .weui_btn_primary{background-color:#fff ;}
        .weui_btn{color: #04BE02;}
        .weui_btn:after{border: none;}
        .container {padding: 5px 15px;}
        a{ text-decoration:none;color: #000;}
		.weui_cell_select .weui_cell_bd:after {
    content: " ";
    display: inline-block;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    height: 8px;
    width: 8px;
    border-width: 2px 2px 0 0;
    border-color: #8c8c8c;
    border-style: solid;
    position: relative;
    top: -2px;
    position: absolute;
    top: 70%;
    right: 18px;
    margin-top: -10px;
}
.weui_cell_primary {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    margin-left: 10px;
}
    </style>
    <!--<script type="text/javascript">
        $(function(){
            $('.weui_btn_primary').click(function(){
                //window.close();   //关闭当前页面
                WeixinJSBridge.call('closeWindow');
            })
        })
    </script>-->
</head>
<body>
    
<div id="innerHtml">
    <!--<div class="weui_icon_area">
        <img src="{pigcms{$static_path}/images/123.png">
    </div>
    <div class="zfcg" style="padding-bottom:5px;">
        <span style="font-size:19px;color:#3fb837;" id="paySatus">支付成功</span>
    </div>-->
    <!--<div class="jiner">
        <div class="jiner_1"><span id="money">￥{pigcms{$info.money}<span></div>
    </div>-->
    
    <!--带图标、说明导航-->
     
    <div class="weui_cells" id="nav_dh">
        <a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Home&a=index">
        <div class="weui_cell" style="width: 92%;margin: 0 auto;">
            <div class="weui_cell_hd"><img src="/static/images/jyxq.png" alt="" id="weui_img"></div>
            <div class="weui_cell_bd weui_cell_primary" id="weui_title">
                <p>汇得行智慧助手</p>
            </div>
           
            <div class="weui_cell_ft">
          <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
             
            </div>
        </div>
        </div>
        
        </div>
      </a>
    </div>
    
      <!--带图标、说明导航-->
      
      <!--<div class="action" id="action_content">
    <div class="skr">
        <div class="skr_1" id="skr_1_1"><span class="sk" >订单金额</span><span class="xm" style="color: #000000;font-size: 50px;font-family:Helvetica;">￥{pigcms{$info.price}</span></div>
    </div>
    <div class="skr" id="skr_1_2" > 
        <div class="skr_1" ><span class="sk" style="letter-spacing:60px">商品</span><span class="xm">{pigcms{$info.order_name}</span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">商户名称</span><span class="xm">{pigcms{$info.merchant_name}</span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">订单状态</span><span class="xm">已接单</span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk" style="letter-spacing:60px">接单时间</span><span class="xm" style="font-family:font-family:Helvetica;">{pigcms{$info.time|date="Y-m-d H:i:s",###}</span></div>
    </div>
     <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">支付方式</span><span class="xm">扫码支付</span></div>
    </div> 
   <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk" style="letter-spacing:60px">接单人</span><span class="xm" style="font-family:font-family:Helvetica;">{pigcms{$info.name}</span></div>
    </div>
     <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">订单号</span><span class="xm" style="font-family:Helvetica;">{pigcms{$info.order_id}</span></div>
    </div>
  

    </div>-->
	
	<div style="margin-top:30px;">
	<div class="weui-form-preview">
            <div class="weui-form-preview-hd">
                <label class="weui-form-preview-label">付款金额</label>
                <em class="weui-form-preview-value">¥2400.00</em>
            </div>
            <div class="weui-form-preview-bd">
              	 <p>
                    <label class="weui-form-preview-label">标题标题</label>
                    <span class="weui-form-preview-value">很长很长的名字很长很长的名字很长很长的名字很长很长的名字很长很长的名字</span>
                </p>
			    <p>
                    <label class="weui-form-preview-label">商品</label>
                    <span class="weui-form-preview-value">电动打蛋机</span>
                </p>
                <p>
                    <label class="weui-form-preview-label">标题标题</label>
                    <span class="weui-form-preview-value">名字名字名字</span>
                </p>
            </div>
            <div class="weui-form-preview-ft">
                <a class="weui-form-preview-btn weui-form-preview-btn-default" href="javascript:">辅助操作</a>
                <button class="weui-form-preview-btn weui-form-preview-btn-primary" href="javascript:">操作</button>
            </div>
        </div> </div>
	
	
	
	
    <!--<div class="weui_cd">
        <div class="container ">
    <div class="page slideIn actionsheet" style="overflow: hidden">
      
        <div class="bd spacing">
            <a href="javascript:;" class="weui_btn weui_btn_primary" id="showActionSheet" style="font-size: 16px;">联系接单人</a>
        </div>
        <!-- <div class="bd spacing">
            <a href="{pigcms{:U('Takeout/order_detail',array('mer_id' => $info['mer_id'], 'store_id' => $info['store_id'], 'orderid' => $info['order_id']))}" class="weui_btn weui_btn_primary" id="showActionSheet" style="font-size: 16px;">查看订单</a>
        </div> -->
        <!--BEGIN actionSheet-->
        <!--<div id="actionSheet_wrap">
            <div class="weui_mask_transition " id="mask" style="display: none;"></div>
            <div class="weui_actionsheet " id="weui_actionsheet">
                <div class="weui_actionsheet_menu">
                   <!-- <div class="weui_actionsheet_cell">公众号客服</div>-->
                   <!-- <div class="weui_actionsheet_cell" > <a class="btn msg-btn" href="tel:{pigcms{$info.phone}">拨打接单人电话</a></div>
                
                </div>
                <div class="weui_actionsheet_action">
                    <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
                </div>
            </div>
        </div>
        </div>
    </div>
	
	
	
	
	
	
	
<script>
    $("#showActionSheet").click(function(){
        var mask = $('#mask');
        var weuiActionsheet = $('#weui_actionsheet');
        weuiActionsheet.addClass('weui_actionsheet_toggle');
        mask.show().addClass('weui_fade_toggle').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        $('#actionsheet_cancel').one('click', function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');

        function hideActionSheet(weuiActionsheet, mask) {
            weuiActionsheet.removeClass('weui_actionsheet_toggle');
            mask.removeClass('weui_fade_toggle');
            weuiActionsheet.on('transitionend', function () {
                mask.hide();
            }).on('webkitTransitionEnd', function () {
                mask.hide();
            })
        }
    })
</script>
    </div>-->
  

</div>
<script src="{pigcms{$static_path}js/zepto.min.js"></script>
  
</body>
</html>
