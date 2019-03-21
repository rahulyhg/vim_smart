<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账单预览</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/xun/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
</head>
<body>
<div class="page__hd">
    <h1 class="page__title" style="text-align: center;color: #3cc51f">账单详情</h1>
    <h5 class="page__title" style="text-align: center">{pigcms{$payList.create_date}月度账单</h5>
</div>
<br/>
<br/>
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <label class="weui-form-preview__label">总金额</label>
        <em class="weui-form-preview__value">￥{pigcms{$payList.total_price}</em>
    </div>
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">水费</label>
            <span class="weui-form-preview__value">￥{pigcms{$payList.water_price}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">电费</label>
            <span class="weui-form-preview__value">￥{pigcms{$payList.electric_price}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">物业费</label>
            <span class="weui-form-preview__value">￥{pigcms{$payList.property_price}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">其他费</label>
            <span class="weui-form-preview__value">￥{pigcms{$payList.other_price}</span>
        </div>
    </div>
    <div class="weui-form-preview__ft">
        <!--<a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:">现在支付</a>-->
        <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">关闭</button>
    </div>

    <div class="weui-footer">
        <p class="weui-footer__text weui-footer_fixed-bottom">Copyright © 2015-2017 hdhsmat.com</p>
    </div>
</div>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
</html>