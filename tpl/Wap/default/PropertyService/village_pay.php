<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>物业缴费</title>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <!-- body 最后 -->
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

    <!-- 如果使用了某些拓展插件还需要额外的JS -->
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

    <!-- sweetalert -->
    <script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="weui-form-preview">
    <form action="{pigcms{:U('PropertyService/real_payment')}" enctype="multipart/form-data" method="post" id="myform">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">付款金额</label>
            <em class="weui-form-preview__value">{pigcms{$orderArr.payable}</em>
        </div>
        <div class="weui-form-preview__bd">
            <div class="weui-form-preview__item">
                <label class="weui-form-preview__label">缴费类型</label>
                <span class="weui-form-preview__value">{pigcms{$orderArr.order_name}</span>
            </div>

        </div>
        <div class="weui-form-preview__ft">
            <input type="hidden" name="order_id" value="{pigcms{$orderArr.order_id}" >
            <input type="hidden" name="village_id" value="{pigcms{$village_id}" >
        </div>
    </form>
    <div class="weui-form-preview__ft">
        <button onclick="sub()" class="weui-form-preview__btn weui-form-preview__btn_primary"  href="javascript:">确认支付</button>
    </div>
</div>
<script>
    function sub() {
        var money = "{pigcms{$orderArr.payable}";
        if (money > 5000) {
            swal({
                title: "您确定吗?",
                text: "数额较大,请您保证余额及每天最大额度充足!",
                icon: "info",
                buttons: ["取消","确定"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#myform").submit();
                    } else {
                        swal("您取消了支付");
                    }
                });
        } else {
            swal({
                title: "您确定缴费吗?",
                icon: "info",
                buttons: ["取消","确定"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#myform").submit();
                    } else {
                        swal("您取消了支付");
                    }
                });
        }
    }

</script>
</body>
</html>