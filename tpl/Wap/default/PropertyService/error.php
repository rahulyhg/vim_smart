<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>上报数据</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/shui/weui3.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/shui/example.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .weui-icon-success {
            color: #188cf2;
        }
        .weui-btn_primary {
            background-color: #188cf2;
        }
        .weui-btn_primary:not(.weui-btn_disabled):visited {
            color: #FFFFFF;
        }
        .weui-btn_primary:not(.weui-btn_disabled):active {
            color: rgba(255, 255, 255, 0.6);
            background-color: #117cda;
        }
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="page msg_success js_show">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">{pigcms{$message}</h2>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="javascript:;" class="weui-btn weui-btn_primary" id='close_window'>点击关闭</a>
                <a href="javascript:;" class="weui-btn weui-btn_primary" onclick="saoma();">扫一扫</a>
                <a href="{pigcms{:U('check_record',array('village_id'=>$village_id,'build_id'=>$build_id))}" class="weui-btn weui-btn_primary" >巡更列表</a>
                <!--<a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a>!-->
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">

                <p class="weui-footer__text">汇得行（中国）集团有限公司</p>
            </div>
        </div>
    </div>
</div>
<script>
    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    }
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
{pigcms{$shareScript}
<script type="application/javascript">
    /*吊起二维码扫描功能*/
    function saoma() {
        wx.scanQRCode({
            needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success: function (res) {
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                console.log(2);
            }
        });
    }

</script>
</body>