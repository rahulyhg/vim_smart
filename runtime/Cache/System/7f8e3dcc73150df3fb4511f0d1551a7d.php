<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>页面跳转中</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for 500 page option 2" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        
        
        <link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="/Car/Admin/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

        <link href="/Car/Admin/Public/assets/pages/css/error.min.css" rel="stylesheet" type="text/css" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.btn.btn-outline.red {
    border-color: #f36a5a;
    color: #f36a5a;
    background: 0 0;
}
.btn.btn-outline.red.active, .btn.btn-outline.red:active, .btn.btn-outline.red:active:focus, .btn.btn-outline.red:active:hover, .btn.btn-outline.red:focus, .btn.btn-outline.red:hover {
    border-color: #f36a5a;
    color: #fff;
    background-color: #f36a5a;
}
-->
</style></head>
    <!-- END HEAD -->

    <body class=" page-500-full-page">
        <div class="row">
            <div class="col-md-12 page-500">
                <?php if(isset($message)): ?><div class=" number font-red"> <img src="/tpl/System/Static/images/gree.png" style="margin-top:-20px;"/> </div>
                    <div class="details" style="min-width:290px;">
                        <h3><?php echo($message); ?></h3>
                        <p style="font-size:18px;"> 页面将在<span id="wait"><?php echo($waitSecond); ?></span>秒后自动跳转<a id="href" href="<?php echo($jumpUrl); ?>" style="display: none">跳转</a>
                            <br/> </p>
                        <p>
                            <a href="javascript:;" class="btn red btn-outline" onclick="refresh_html()"> 返回 </a>
                            <br> </p>
                    </div>
                    <?php else: ?>
                    <div class=" number font-red"> <img src="/tpl/System/Static/images/gree.png" style="margin-top:-20px;"/> </div>
                    <div class=" details" style="min-width:290px;">
                        <h3><?php echo($error); ?></h3>
                        <p style="font-size:18px;"> 页面将在<span id="wait"><?php echo($waitSecond); ?></span>秒后自动跳转<a id="href" href="<?php echo($jumpUrl); ?>" style="display: none">跳转</a>
                            <br/> </p>
                        <p>
                            <a href="javascript:;" class="btn red btn-outline"  onclick="jumpback()"> 返回 </a>
                            <br> </p>
                    </div><?php endif; ?>



            </div>
        </div>
        <script >
            function refresh_html() {
//                window.history.back(-1);
//                window.location.reload();
                window.location.href = document.referrer;//返回上一页并刷新
            };
            function jumpback() {
                window.history.back(-1);
            };
        </script>
        <script type="text/javascript">
            (function(){
                var wait = document.getElementById('wait'),href = document.getElementById('href').href;
                var interval = setInterval(function(){
                    var time = --wait.innerHTML;
                    if(time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    };
                }, 1000);
            })();
        </script>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script>

<![endif]-->
        <!-- BEGIN CORE PLUGINS -->

        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>