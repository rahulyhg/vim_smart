<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>扫码</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?215"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index.css?216"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js?211" charset="utf-8"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<div  id="qrcodeBtn"  style="width: 100%;height:1000px;background: red;">点击扫码</div>

{pigcms{$shareScript}
</body>
</html>
<script type="text/javascript">
    $('#qrcodeBtn').click(function(){
        if(motify.checkWeixin()){
            motify.log('正在调用二维码功能');
            wx.scanQRCode({
                desc:'scanQRCode desc',
                needResult:1,
                scanType:["qrCode"],
                success:function (res){
//                    alert(res);
                },
                error:function(res){
                    motify.log('微信返回错误！请稍后重试。',5);
                },
                fail:function(res){
                    motify.log('无法调用二维码功能');
                }
            });
        }else{
            motify.log('您不是微信访问，无法使用二维码功能');
        }
    });
    document.onreadystatechange = function(){
        if(document.readyState=="complete")
        {
            if(motify.checkWeixin()){
                motify.log('正在调用二维码功能');
                wx.scanQRCode({
                    desc:'scanQRCode desc',
                    needResult:1,
                    scanType:["qrCode"],
                    success:function (res){
//                    alert(res);
                    },
                    error:function(res){
                        motify.log('微信返回错误！请稍后重试。',5);
                    },
                    fail:function(res){
                        motify.log('无法调用二维码功能');
                    }
                });
            }else{
                motify.log('您不是微信访问，无法使用二维码功能');
            }
        }
    };
    setTimeout(function(){
        $('#qrcodeBtn').trigger("dblclick");
    },1000);
</script>