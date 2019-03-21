<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>快递管理</title>
    <!-- head 中 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">

    <style>
        body{
            font-size: 14px;
        }
    </style>
</head>
<body>
<form action="{pigcms{:U('express_delivery_detail')}" enctype="multipart/form-data" method="post">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">运单号</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$list.waybill_number}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">快递公司</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$list.company_name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">电话</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$list.phone}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$list.name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">提货码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$list.receipt_code}" disabled="true" >
            </div>
        </div>
        <input type="hidden" name="id" value="{pigcms{$list.id}" >
        <input type="hidden" name="ym" value="{pigcms{$ym}" >
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">状态</label></div>
            <div class="weui-cell__bd">
                <if condition="$list.status eq 0">
                    <input class="weui-input" type="text"  value="已到站" disabled="true" >
                    <elseif condition="$list.status eq 1" />
                    <input class="weui-input" type="text"  value="已提货" disabled="true" >
                    <elseif condition="$list.status eq 2" />
                    <input class="weui-input" type="text"  value="顾客拒收" disabled="true" >
                    <elseif condition="$list.status eq 3" />
                    <input class="weui-input" type="text"  value="站点拒签" disabled="true" >
                    <elseif condition="$list.status eq 4" />
                    <input class="weui-input" type="text"  value="已退件" disabled="true" >
                </if>
            </div>
        </div>
    </div>
    <if condition="$list.status neq 1">
        <div class="weui-cells weui-cells_radio" style="font-size: 14px;">
            <label class="weui-cell weui-check__label" for="x10" >
                <div class="weui-cell__bd">
                    <p>已到站</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="status" id="x10" value="0" <if condition="$list.status eq 0">checked="checked"</if> >
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label" for="x11" >
                <div class="weui-cell__bd">
                    <p>已提货</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="status" id="x11" value="1" <if condition="$list.status eq 1">checked="checked"</if>>
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label" for="x12">
                <div class="weui-cell__bd">
                    <p>顾客拒收</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" name="status" class="weui-check" id="x12" value="2" <if condition="$list.status eq 2">checked="checked"</if>>
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label" for="x13">
                <div class="weui-cell__bd">
                    <p>站点拒签</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" name="status" class="weui-check" id="x13" value="3" <if condition="$list.status eq 3">checked="checked"</if>>
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
            <label class="weui-cell weui-check__label" for="x14">
                <div class="weui-cell__bd">
                    <p>已退件</p>
                </div>
                <div class="weui-cell__ft">
                    <input type="radio" name="status" class="weui-check" id="x14" value="4" <if condition="$list.status eq 4">checked="checked"</if>>
                    <span class="weui-icon-checked"></span>
                </div>
            </label>
        </div>
        <div class="weui-form-preview__ft" style="font-size: 20px;">
            <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确定</button>
        </div>
    </if>
    <div class="weui-form-preview__ft">
        <span class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:" style="font-size: 20px;" onclick="comeback()">返回</span>
    </div>

</form>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<script>
    var time = "{pigcms{$time}";
    var village_id = "{pigcms{$village_id}";
    function comeback(){
        window.location.href = "{pigcms{:U('express_delivery')}"+"&ym="+time+"&village_id="+village_id;
    }
</script>

</body>
</html>