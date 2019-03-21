<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>230/127</title>
    <style>
        *{padding:0;margin:0;font-size: 3mm;}
        body{

        }
        .bg_sf div{
            line-height:6.9mm;
        }
        .main-left div{
            /*background-color: #00a0f8;*/
            opacity:0.5;
        }
        .main-right div{
            /*background-color: #00a0f8;*/
            opacity:0.5;
        }

        .bg_sf{
            width:230mm;
            height:127mm;
            /*background-image: url(/Car/Admin/Public/images/sf.jpg);*/
            background-size: 100% 100% ;
            background-repeat: no-repeat;
            /*background-color: #0a6aa1;*/
        }

        .top{
            height:30mm;
            width:100%;
        }
        /*火狐修正*/
        @-moz-document url-prefix() {
            .top{
                height:28mm;
                width:100%;
            }
        }
        /*chrome修正*/
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            .top{
                height:30mm;
                width:100%;
            }
        }

        .body{
            height: 96.3mm;
            width:100%;
        }
        .main-left{
            margin-left:25.6mm;
            width:89.6mm;
            height:96.3mm;
            float:left;
        }
        .main-right{
            margin-left:3.8mm;
            width:89.6mm;
            height:96.3mm;
            float:left;
        }

        /*寄件方信息*/
        /*寄件方公司名*/
        #billing_company_name{
            margin-left:15.36mm;
            width:55mm;
            float: left;
            /*background-color:#999;*/
        }
        /*寄件方联系人*/
        #billing_linkman{
            width:19.2mm;
            float: left;
        }
        /*寄件方地址*/
        #billing_address{
            margin-left:6.4mm;
        }
        /*寄件方手机*/
        #billing_phone{
            margin-left:15.36mm;
        }

        /*收件方信息*/
        /*收件方公司名*/
        #shipping_company_name{
            margin-left:15.36mm;
            width:55mm;
            float: left;
            /*background-color:#999;*/
        }
        /*收件方联系人*/
        #shipping_linkman{
            width:19.2mm;
            float: left;
        }
        /*收件方地址信息*/
        #shipping_addrss_province{
            float:left;
            width:23.4mm;
            margin-left:11.52mm;
        }
        #shipping_addrss_city{
            float:left;
            width:19.2mm;
            margin-left:2mm;
        }
        #shipping_addrss_area{
            float:left;
            width:15mm;
            margin-left:2.56mm;
        }
        #shipping_addrss_detail{

        }
        /*收件方手机*/
        #shipping_phone{
            margin-left:14.08mm;
            width:75.52mm;
        }
        /*寄托物品详细治疗*/
        #goods_detail{
            line-height: 3mm;
            margin-top: 6.784mm;
            height: 10.24mm;
            width: 25.6mm;
        }
        /*付款方式*/
        #pay_type{
            margin-top: 78.08mm;
            margin-left: 2.56mm;
        }
        #pay_type div{
            float: left;
            width:16mm;
        }
    </style>
</head>
<!--√√√√√-->
<body>
        <div class="bg_sf">
            <div class="top"></div>
            <div class="body">
                <div class="main-left">
                    <!-- 寄件方信息-->
                    <div id="billing_company_name"><?php echo $info['bad_company_name']?:"&nbsp;"?></div>
                    <div id="billing_linkman"><?php echo $info['bad_name']?:"&nbsp;" ?></div>
                    <div style="clear: both"></div>
                    <div id="billing_address"><?php echo $info['bad_detail']?:"&nbsp;" ?></div>
                    <div id="billing_phone"><?php echo $info['bad_phone']?:"&nbsp;" ?></div>
                    <div style="height:1mm;width:1.5mm"></div>
                    <!-- 收件方信息-->
                    <div id="shipping_company_name"><?php echo $info['sad_company_name']?:"&nbsp;" ?></div>
                    <div id="shipping_linkman"><?php echo $info['sad_name']?:"&nbsp;" ?></div>

                    <!-- 收件方地址信息-->
                    <div id="shipping_addrss_province"><?php echo explode(' ',$info['sad_position'])[0]?:"&nbsp;" ?></div>
                    <div id="shipping_addrss_city"><?php echo explode(' ',$info['sad_position'])[1]?:"&nbsp;" ?></div>
                    <div id="shipping_addrss_area"><?php echo explode(' ',$info['sad_position'])[2]?:"&nbsp;" ?></div>
                    <div style="clear: both"></div>
                    <div id="shipping_addrss_detail"><?php echo $info['sad_detail']?:"&nbsp;" ?></div>

                    <!--收件方手机-->
                    <div id="shipping_phone"><?php echo $info['sad_phone']?:"&nbsp;" ?></div>
                    <!--寄托物品详细资料-->
                    <div id="goods_detail"><?php echo $info['goods_detail']?:"&nbsp;" ?></div>

                </div>
                <div class="main-right">
                <!--付款方式-->
                    <div id="pay_type">
                        <div> √</div>
                        <div> √</div>
                        <div> √</div>
                        <div style="clear: both"></div>
                    </div>
                </div>
                <div style="clear: both"></div>
           </div>
        </div>

</body>
</html>

