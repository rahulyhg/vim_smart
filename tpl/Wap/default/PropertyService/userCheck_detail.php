<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户审核</title>
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
        <form action="{pigcms{:U('userCheck_detail')}" enctype="multipart/form-data" method="post">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">微信名</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="{pigcms{$list.nickname}" disabled="true" >
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">真实姓名</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="{pigcms{$list.name}" disabled="true" >
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">公司名称</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="{pigcms{$list.company_name}" disabled="true" >
                    </div>
                </div>
                <input type="hidden" name="pigcms_id" value="{pigcms{$list.pigcms_id}" >
                <input type="hidden" name="ym" value="{pigcms{$ym}" >
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">证件类型</label></div>
                    <div class="weui-cell__bd">
                        <if condition="$list.card_type eq 1">
                            <input class="weui-input" type="text"  value="现场审核" disabled="true" >
                            <elseif condition="$list.card_type eq 2" />
                            <input class="weui-input" type="text"  value="门禁卡" disabled="true" >
                            <elseif condition="$list.card_type eq 3" />
                            <input class="weui-input" type="text"  value="身份证" disabled="true" >
                            <elseif condition="$list.card_type eq 4" />
                            <input class="weui-input" type="text"  value="工牌" disabled="true" >
                        </if>
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">证件号</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="{pigcms{$list.usernum}" disabled="true" >
                    </div>
                </div>
                <div class="weui-cell weui-cell_vcode" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">证件照</label></div>
                    <div class="weui-cell__ft">
                        <img class="weui-vcode-img" src="/upload/house/{pigcms{$list.workcard_img}">
                    </div>
                </div>
            </div>
            <if condition="$list.ac_status eq 2 or $list.ac_status eq 4 ">
                <div class="weui-cells__title" style="font-size: 14px;">描述</div>
                <div class="weui-cells weui-cells_form" style="font-size: 14px;">
                    <div class="weui-cell">
                        <div class="weui-cell__bd" style="font-size: 14px;">
                            <textarea class="weui-textarea"  rows="2"  readonly>{pigcms{$list.department}</textarea>
                            <div class="weui-textarea-counter"><span>0</span>/200</div>
                        </div>
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">审核结果</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="已通过" disabled="true" >
                    </div>
                </div>
                <div class="weui-cell" style="font-size: 14px;">
                    <div class="weui-cell__hd"><label class="weui-label">审核人</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  value="{pigcms{$list.check_name}" disabled="true" >
                    </div>
                </div>
                <div class="weui-form-preview__ft">
                    <span class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" style="font-size: 20px;" onclick="comeback()">返回</span>
                </div>
                <else />
                <div class="weui-cells__title" style="font-size: 14px;">描述</div>
                <div class="weui-cells weui-cells_form" style="font-size: 14px;">
                    <div class="weui-cell">
                        <div class="weui-cell__bd" style="font-size: 14px;">
                            <textarea class="weui-textarea" value="" rows="2" name="department" ></textarea>
                            <div class="weui-textarea-counter"><span>0</span>/200</div>
                        </div>
                    </div>
                </div>
                <div class="weui-cells weui-cells_radio" style="font-size: 14px;">
                    <label class="weui-cell weui-check__label" for="x11" >
                        <div class="weui-cell__bd">
                            <p>继续审核</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" class="weui-check" name="ac_status" id="x11" checked="checked" value="1">
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                    <label class="weui-cell weui-check__label" for="x12">
                        <div class="weui-cell__bd">
                            <p>通过</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" name="ac_status" class="weui-check" id="x12" value="2" >
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                    <label class="weui-cell weui-check__label" for="x13">
                        <div class="weui-cell__bd">
                            <p>不通过</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" name="ac_status" class="weui-check" id="x13" value="3" >
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                </div>
                <div class="weui-form-preview__ft" style="font-size: 20px;">
                    <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">确定</button>
                </div>
                <div class="weui-form-preview__ft">
                    <span class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:" style="font-size: 20px;" onclick="comeback()">返回</span>
                </div>
            </if>

        </form>
<!-- body 最后 -->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>

<script>
    var time = "{pigcms{$ym}";
    var village_id = "{pigcms{$village_id}";
    function comeback(){
        window.location.href = "{pigcms{:U('userCheck_index_news')}"+"&ym="+time+"&village_id="+village_id;
    }
</script>

</body>
</html>