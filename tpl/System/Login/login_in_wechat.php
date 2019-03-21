<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <title>汇得行智慧助手-后台登录</title>
</head>
<body>
<form class="login-form" method="post" action="{pigcms{:U('Login/check_new')}">
    <div class="weui-cells__title"></div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">账号名</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="account" placeholder="请输入账号名">
                <!--            pattern="[0-9]*"-->
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">密码</label>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" name="pwd" placeholder="请输入密码">
                <!--            pattern="[0-9]*"-->
            </div>
        </div>
        <div class="weui-btn-area">
            <button class="weui-btn weui-btn_primary weui-btn_disabled" id="submit" href="javascript:" type="submit" id="showTooltips">确定</button>
        </div>
    </div>
</form>

 <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
 <script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
 <script>
    $(document).ready(function(){

        function check(){
            var account = $('input[name="account"]').val(),
                pwd = $('input[name="pwd"]').val(),
                disabled = $('#submit').hasClass('weui-btn_disabled');

            if(account && pwd && disabled){
                $('#submit').removeClass('weui-btn_disabled');
            }

            if(!account || !pwd){
                $('#submit').addClass('weui-btn_disabled');
            }
        }

        window.setTimeout(check,1000);

        $('input').keyup(function(){
            check();
        });


        $('#submit').click(function(){
            var disabled = $('#submit').hasClass('weui-btn_disabled')
            return !disabled;
        });
    });
 </script>
</body>
</html>