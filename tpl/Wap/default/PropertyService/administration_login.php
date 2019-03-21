<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>管理员登录</title>
    <meta name="format-detection" content="telephone=no, address=no">
    <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link type="text/css" rel="stylesheet" href="/tpl/WapMerchant/deafult/static/css/jquery.mmenu.all.css" />
    <link href="/tpl/WapMerchant/deafult/static/css/style.css?ver=1516673229" rel="stylesheet" >
    <link href="/tpl/WapMerchant/deafult/static/css/iconfont.css" rel="stylesheet">
    <script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/tpl/WapMerchant/deafult/static/js/common.js?211" charset="utf-8"></script>
    <script type="text/javascript" src="/tpl/WapMerchant/deafult/static/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/tpl/WapMerchant/deafult/static/js/jquery.mmenu.min.all.js"></script>
    <script type="text/javascript" src="/tpl/WapMerchant/deafult/static/js/checkSubmit.js?ver=1516673229"></script>

</head>


<div class="container container-fill" style='padding-top:40px'>

    <style>

        @media (max-height: 600px){

            .pigcms-main{

                padding-top: 10px;

            }

            .pigcms-container{

                margin-bottom: 20px;

            }

            .top-img-container{

                padding-bottom: 10px;

            }

            #login-container{

                margin: 1% 10px;

                padding: 1px 15px;

            }

            .pigcms-btn-block{

                padding: 20px 0;

            }

            #forget-password{

                margin: 10px 0;

                font-size: 12px;

            }

            #no-shop{

                margin: 10px 0 10px;

                font-size: 12px;

            }



        }

        .claim-text{

            background:#fff;

            text-align:center;

            width: 94%;

            margin: 0 3%;

            padding: 10px 0;

            color: #777;

            border-radius: 10px;

        }

    </style>

    <script>

        $(function(){

            $(".pigcms-main").css('height', $(window).height());

        })

    </script>

    <form class="pigcms-main"  method="post" role="form" action="{pigcms{:U('PropertyService/administration_login')}" enctype="multipart/form-data" >

        <div class="pigcms-container">

            <div class="top-img-container"><img src="{pigcms{$config.site_merchant_logo}" alt="" class="top-img"></div>

        </div>

        <div class="pigcms-container">

            <div id="login-container">

                <div class="login-input-wrapper">

                    <span class="login-input-after"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/human.jpg" style="width:19px; height:22px; margin-top:4px;"></span>

                    <input type="text" class="login-input" name="account" placeholder="请输入账号" autocomplete='off'>

                    <div class="clearfix"></div>

                </div>

                <div class="login-input-wrapper">

                    <span class="login-input-after"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/lock.jpg" style="width:19px; height:22px; margin-top:4px;"></span>

                    <input type="password" class="login-input" name="pwd" placeholder="请输入密码">

                    <input type='hidden' value='login' name='type_id'>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

        <button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" value="登录">登录</button>


    </form>

</div>

</body>


</html>

