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
<if condition="isset($listTwoArr)">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">寄件人</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.bad_name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">寄件人电话号</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.bad_phone}" disabled="true" >
            </div>
        </div>
        <if condition="isset($listTwoArr['sad_name'])">
            <div class="weui-cell" style="font-size: 14px;">
                <div class="weui-cell__hd"><label class="weui-label">收件人</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.sad_name}" disabled="true" >
                </div>
            </div>
        </if>
        <if condition="isset($listTwoArr['sad_phone'])">
            <div class="weui-cell" style="font-size: 14px;">
                <div class="weui-cell__hd"><label class="weui-label">收件人电话号</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.sad_phone}" disabled="true" >
                </div>
            </div>
        </if>
        <if condition="isset($listTwoArr['sad_position'])">
            <div class="weui-cell" style="font-size: 14px;">
                <div class="weui-cell__hd"><label class="weui-label">收件人城市</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.sad_position}" disabled="true" >
                </div>
            </div>
        </if>
        <if condition="isset($listTwoArr['sad_detail'])">
            <div class="weui-cell" style="font-size: 14px;">
                <div class="weui-cell__hd"><label class="weui-label">收件人地址</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.sad_detail}" disabled="true" >
                </div>
            </div>
        </if>
        <if condition="isset($listTwoArr['goods_type_name'])">
            <div class="weui-cell" style="font-size: 14px;">
                <div class="weui-cell__hd"><label class="weui-label">物品类型</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.goods_type_name}" disabled="true" >
                </div>
            </div>
        </if>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">快递公司</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listTwoArr.exp_name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">运送状态</label></div>
            <div class="weui-cell__bd">
                <if condition="$listTwoArr.exs_status eq 0">
                    <input class="weui-input" type="text"  value="运送中" disabled="true" >
                    <elseif condition="$listTwoArr.exs_status eq 1" />
                    <input class="weui-input" type="text"  value="已送达" disabled="true" >
                </if>
            </div>
        </div>
    </div>
    <elseif condition="isset($listOneArr)" />
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">运单号</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listOneArr.waybill_number}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">快递公司</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listOneArr.company_name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">电话</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listOneArr.phone}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listOneArr.name}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">提货码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text"  value="{pigcms{$listOneArr.receipt_code}" disabled="true" >
            </div>
        </div>
        <div class="weui-cell" style="font-size: 14px;">
            <div class="weui-cell__hd"><label class="weui-label">状态</label></div>
            <div class="weui-cell__bd">
                <if condition="$listOneArr.status eq 0">
                    <input class="weui-input" type="text"  value="已到站" disabled="true" >
                    <elseif condition="$listOneArr.status eq 1" />
                    <input class="weui-input" type="text"  value="已提货" disabled="true" >
                    <elseif condition="$listOneArr.status eq 2" />
                    <input class="weui-input" type="text"  value="顾客拒收" disabled="true" >
                    <elseif condition="$listOneArr.status eq 3" />
                    <input class="weui-input" type="text"  value="站点拒签" disabled="true" >
                    <elseif condition="$listOneArr.status eq 4" />
                    <input class="weui-input" type="text"  value="已退件" disabled="true" >
                </if>
            </div>
        </div>
    </div>
</if>
    <div class="weui-form-preview__ft">
        <span class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:" style="font-size: 20px;" onclick="comeback()">返回</span>
    </div>

<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<script>
    function comeback(){
        window.history.go(-1);
    }
</script>

</body>
</html>