<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">

    <title>登录</title>

    <link href="./Cashier/pigcms_static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Cashier/pigcms_static/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="./Cashier/pigcms_static/plugins/css/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="./Cashier/pigcms_tpl/Merchants/Static/css/animate.css" rel="stylesheet">
    <link href="./Cashier/pigcms_tpl/Merchants/Static/css/style.css" rel="stylesheet">
    <link href="./Cashier/pigcms_tpl/Merchants/Static/css/login.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="addBg">
    <div class="addBgArea">
        <img class="balloon" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/balloon.png" alt="balloon">
        <img class="cricle" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/cricle.png" alt="cricle">
        <img class="could" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/could.png" alt="could">
        <img class="mountain0" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/mountain0.png" alt="mountain0">
        <img class="mountain1" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/mountain1.png" alt="mountain1">
        <img class="mountain2" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/mountain2.png" alt="mountain2">
        <img class="tree tree0" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/tree.png" alt="tree">
        <img class="tree tree1" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/tree.png" alt="tree">
        <img class="tree tree2" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/tree.png" alt="tree">
        <img class="point" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/point.png" alt="point">
        <img class="stick" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/stick.png" alt="stick">
        <img class="footprint0" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/footprint.png" alt="footprint">
        <img class="footprint1" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/footprint.png" alt="footprint">
        <img class="footprint2" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/footprint.png" alt="footprint">
        <img class="footprint3" src="./Cashier/pigcms_tpl/Merchants/Static/images/login/footprint.png" alt="footprint">
    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <form class="m-t" role="form" id="form" method="post" action="{pigcms{:U('PropertyService/check')}">
                <div class="form-group">
                    <input type="test" name="account" class="form-control" placeholder="账号" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

                <!--<a href="#"><small>忘记密码?</small></a>
                <p class="text-muted text-center"><small>没有账号?</small></p>-->
                <!--<a class="btn btn-sm btn-white btn-block" href="?m=Index&c=login&a=register">创建一个账号</a>-->
            </form>
            <p class="m-t"> <small>Copyright：<?php echo str_replace('http://','',$_SERVER['HTTP_HOST'])?> &copy; <?php echo date('Y');?></small> </p>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="./Cashier/pigcms_static/js/jquery-2.1.1.js"></script>
<script src="./Cashier/pigcms_static/bootstrap/js/bootstrap.min.js"></script>

<!-- Jquery Validate -->
<script src="./Cashier/pigcms_static/plugins/js/validate/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $("#form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                username: {
                    required: true,
                    minlength: 4
                }
            }
        });
        $(".addBg,.addBgArea").height($(window).height());
        $(window).resize(function(){
            $(".addBg,.addBgArea").height($(window).height());
        })
    });
</script>
</body>

</html>
