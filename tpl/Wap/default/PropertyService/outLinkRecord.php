<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <!-- jquery WEUI css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <link href="/Car/Home/Public/statics/plublic/css/example.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />

    <style>
        .but{
            color: blue;
            font-size: 16px;
        }

        .demos-title {
            text-align: center;
            font-size: 18px;
            color: #3cc51f;
            font-weight: 400;
            margin: 0 15%;
        }
    </style>
    </head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="weui-tab">
    <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
            全部
        </a>
        <a class="weui-navbar__item" href="#tab2">
            现金
        </a>
        <a class="weui-navbar__item" href="#tab3">
            微信扫码
        </a>
        <a class="weui-navbar__item" href="#tab4">
            其他
        </a>
    </div>
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <foreach name="recordArray['all']" item="av">
                <div class="weui-form-preview">
                    <div class="weui-form-preview__hd">
                        <label class="weui-form-preview__label">付款金额</label>
                        <em class="weui-form-preview__value">¥{pigcms{$av.pay_loan}</em>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">班次</label>
                            <span class="weui-form-preview__value">{pigcms{$av.desc}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">停车场</label>
                            <span class="weui-form-preview__value">{pigcms{$av.garage_name}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">付款方式</label>
                            <if condition="$av['pay_type'] eq 0">
                                <span class="weui-form-preview__value"><span style="color: blue">现金付款</span><br/>{pigcms{$av.enter_time|date='Y-m-d H:i:s',###}</span>
                            <elseif condition="$av['pay_type'] eq 1"/>
                                <span class="weui-form-preview__value"><span style="color: blue">微信扫码付款</span><br/>{pigcms{$av.enter_time|date='Y-m-d H:i:s',###}</span>
                            <elseif condition="$av['pay_type'] eq 2"/>
                                <span class="weui-form-preview__value"><span style="color: blue">其他方式付款</span><br/>{pigcms{$av.enter_time|date='Y-m-d H:i:s',###}</span>
                            </if>
                        </div>
                    </div>

                </div>
            </foreach>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
            <foreach name="recordArray['cash']" item="cv">
                <div class="weui-form-preview">
                    <div class="weui-form-preview__hd">
                        <label class="weui-form-preview__label">付款金额</label>
                        <em class="weui-form-preview__value">¥{pigcms{$cv.pay_loan}</em>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">班次</label>
                            <span class="weui-form-preview__value">{pigcms{$cv.desc}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">停车场</label>
                            <span class="weui-form-preview__value">{pigcms{$cv.garage_name}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">付款方式</label>
                            <span class="weui-form-preview__value"><span style="color: blue">现金付款</span><br/>{pigcms{$cv.enter_time|date='Y-m-d H:i:s',###}</span>
                        </div>
                    </div>

                </div>
            </foreach>
        </div>
        <div id="tab3" class="weui-tab__bd-item">
            <foreach name="recordArray['weChat']" item="wv">
                <div class="weui-form-preview">
                    <div class="weui-form-preview__hd">
                        <label class="weui-form-preview__label">付款金额</label>
                        <em class="weui-form-preview__value">¥{pigcms{$wv.pay_loan}</em>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">班次</label>
                            <span class="weui-form-preview__value">{pigcms{$wv.desc}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">停车场</label>
                            <span class="weui-form-preview__value">{pigcms{$wv.garage_name}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">付款方式</label>
                            <span class="weui-form-preview__value"><span style="color: blue">微信扫码付款</span><br/>{pigcms{$wv.enter_time|date='Y-m-d H:i:s',###}</span>
                        </div>
                    </div>

                </div>
            </foreach>
        </div>
        <div id="tab4" class="weui-tab__bd-item">
            <foreach name="recordArray['Other']" item="ov">
                <div class="weui-form-preview">
                    <div class="weui-form-preview__hd">
                        <label class="weui-form-preview__label">付款金额</label>
                        <em class="weui-form-preview__value">¥{pigcms{$ov.pay_loan}</em>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">班次</label>
                            <span class="weui-form-preview__value">{pigcms{$ov.desc}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">停车场</label>
                            <span class="weui-form-preview__value">{pigcms{$ov.garage_name}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">付款方式</label>
                            <span class="weui-form-preview__value"><span style="color: blue">其他方式付款</span><br/>{pigcms{$ov.enter_time|date='Y-m-d H:i:s',###}</span>
                        </div>
                    </div>

                </div>
            </foreach>
        </div>
    </div>
</div>
</body>
<!-- jquery WEUI  js-->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

</html>
