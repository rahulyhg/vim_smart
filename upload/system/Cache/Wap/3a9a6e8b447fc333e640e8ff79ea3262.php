<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>交易详情</title>
    <script src="<?php echo ($static_path); ?>js/jquery.js" language="javascript" type="text/javascript"></script>
    <link href="<?php echo ($static_path); ?>css/weui.css" rel="stylesheet" type="text/css" />
  
    <style type="text/css">
      @font-face {font-family:Helvetica; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica.ttf")}
        @font-face {font-family:Helvetica Bold; src: url("http://1.vhi99.com/statics/templates/quyu-1yygkuan/css/mobile/font/Helvetica Bold.ttf")}
        
        body{background: #efeff4;margin: 0px;}
        .wxzf{height: 50px;margin-top: 25px;padding: 0 13px; }
        .skr{width: 92%;font-size:14px;margin: 0 auto;border-right: 0;border-left: 0;}
        .skr span{color: #858585;}
        .xm{float: right;}
        .weui_cell{padding: 15px 15px;}
        .weui_cell_hd{width: 80px;height: 80px;}
        #weui_img{width:50px;height: 80px;display:block;border-radius: 50%;}
        #weui_title p{font-size: 35px;}
        .action{margin-top: -40px;background: #fff;}
        #nav_dh{border: 1px solid #d4d3d8; -webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:120px;width: 200%;line-height: 90px;}
        #action_content{border: 1px solid #d4d3d8; -webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scale(0.5);transform: scale(0.5);height:430px;width: 200%;}
        .skr_1{font-size: 30px;;font-weight: 500;color: #888888;font-family: "arial, helvetica, sans-serif";}
        #skr_1_2{height: 55px;line-height: 55px;margin-top: 6px;}
        #skr_1_1{height: 95px;line-height: 95px;border-bottom: 1px solid #d4d3d8;}
        .weui_cd{margin: 0 auto;margin-top:-216px;background: #fff;height: 50px;}
        .weui_btn_primary{background-color:#fff ;}
        .weui_btn{color: #04BE02;}
        .weui_btn:after{border: none;}
        .container {padding: 5px 15px;}
        a{ text-decoration:none;color: #000;}
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
        <img src="<?php echo ($static_path); ?>/images/123.png">
    </div>
    <div class="zfcg" style="padding-bottom:5px;">
        <span style="font-size:19px;color:#3fb837;" id="paySatus">支付成功</span>
    </div>-->
    <!--<div class="jiner">
        <div class="jiner_1"><span id="money">￥<?php echo ($info["money"]); ?><span></div>
    </div>-->
    
    <!--带图标、说明导航-->
     
    <div class="weui_cells" id="nav_dh">
    	<a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Home&a=index">
        <div class="weui_cell" style="width: 92%;margin: 0 auto;">
            <div class="weui_cell_hd"><img src="http://you.huidehang.cn/tpl/Wap/static/images/jyxq.png" alt="" id="weui_img"></div>
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
      
      <div class="action" id="action_content">
    <div class="skr">
        <div class="skr_1" id="skr_1_1"><span class="sk" >付款金额</span><span class="xm" style="color: #000000;font-size: 50px;font-family:Helvetica;">￥<?php echo ($info["money"]); ?></span></div>
    </div>
    <div class="skr" id="skr_1_2" > 
        <div class="skr_1" ><span class="sk" style="letter-spacing:60px">商品</span><span class="xm">线下扫码支付</span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">商户名称</span><span class="xm"><?php echo ($info["name"]); ?></span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk" style="letter-spacing:60px">时间</span><span class="xm" style="font-family:font-family:Helvetica;"><?php echo (date("Y-m-d H:i:s",$info["time"])); ?></span></div>
    </div>
    <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">支付方式</span><span class="xm">扫码支付</span></div>
    </div>
     <div class="skr" id="skr_1_2">
        <div class="skr_1" ><span class="sk">商户单号</span><span class="xm" style="font-family:Helvetica;"><?php echo ($info["outid"]); ?></span></div>
    </div>
  

    </div>
    <div class="weui_cd">
    	<div class="container ">
    <div class="page slideIn actionsheet" style="overflow: hidden">
      
        <div class="bd spacing">
            <a href="javascript:;" class="weui_btn weui_btn_primary" id="showActionSheet" style="font-size: 16px;">在线帮助</a>
        </div>
        <!--BEGIN actionSheet-->
        <div id="actionSheet_wrap">
            <div class="weui_mask_transition " id="mask" style="display: none;"></div>
            <div class="weui_actionsheet " id="weui_actionsheet">
                <div class="weui_actionsheet_menu">
                   <!-- <div class="weui_actionsheet_cell">公众号客服</div>-->
                    <div class="weui_actionsheet_cell" > <a class="btn msg-btn" href="tel:027-87779655">拨打客服电话</a></div>
                
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
    </div>
  

</div>
<script src="<?php echo ($static_path); ?>js/zepto.min.js"></script>
  
</body>
</html>