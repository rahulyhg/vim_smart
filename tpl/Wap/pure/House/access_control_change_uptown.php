<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{pigcms{$now_village.village_name}</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> <!--引入微信js-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        <!--
        .cw {width:100%; margin:0px auto; padding-top:40px; padding-bottom:20px;}
        .cw2 {width:50%; text-align:center; float:left;}
        .cw3 {width:90%; margin:0px auto; line-height:2; font-size:14px; color:#333333;}
        -->
    </style>
</head>
<script type="text/javascript">
    function changeImage(){
        //document.getElementById("imgflag").src="{pigcms{$static_path}images/ttw6.png";
        window.location.href="{pigcms{:U('House/village_access_control',array('village_id'=>$now_village['village_id'],'ac_id'=>$ac_id))}";
    }

    function changeImagee(){
        //document.getElementById("imgflag2").src="{pigcms{$static_path}images/ttw4.png";
        window.location.href="{pigcms{:U('House/village_access_control_uptown',array('village_id'=>$now_village['village_id'],'ac_id'=>$ac_id))}";
    }


    var user_long="{pigcms{$long_lat.long}",user_lat="{pigcms{$long_lat.lat}";
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });
    })

    var signa_arr="{pigcms{$signa_arr}";
    if(signa_arr){		//判断是否须定位
        wx.config({
            debug: false,
            appId: "<?php echo $signa_arr['appid'] ?>",
            timestamp: "<?php echo time() ?>",
            nonceStr: "<?php echo $signa_arr['str'] ?>",
            signature: "<?php echo $signa_arr['signature'] ?>",
            jsApiList: [
                'checkJsApi',
                'getLocation'
            ]
        });
        wx.ready(function(){
            wx.checkJsApi({
                jsApiList:[
                    'getLocation'
                ],
                success:function(res){
                    //alert(res.checkResult.getLocation);
                    if(res.checkResult.getLocation==false){
                        alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
                        return;
                    }
                }
            });
            wx.getLocation({
                success:function(res){
                    var latitude=res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude=res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed=res.speed; // 速度，以米/每秒计
                    var accuracy=res.accuracy; // 位置精度
                    $.ajax({
                        'url':"{pigcms{:U('House/userLocation')}",
                        'data':{'lat':latitude,'long':longitude,'control':'is_control'},
                        'type':'POST',
                        'dataType':'JSON',
                        'success':function(msg){
                            if(msg.code_error==0){
                                //alert(msg.code_msg);
                            }else{
                                alert(msg.code_msg);
                                window.location.reload();
                            }
                        },
                        //'error':function(){
                        //alert('loading error!');
                        //}
                    })
                },
                fail:function(res){		//地理位置获取失败
                    alert('地理位置获取失败');
                },
                cancel:function(){
                    //alert('用户拒绝授权获取地理位置');
                }
            });
        })
    }
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>身份认证</header>
<div class="cw">
    <a href="#"><div class="cw2"><img id="imgflag" src="{pigcms{$static_path}images/ttw5.png" onClick="changeImage()" style="width:85%;"></div></a>
    <a href="#"><div class="cw2"><img id="imgflag2" src="{pigcms{$static_path}images/ttw2.png" onClick="changeImagee()" style="width:85%;"></div></a>
    <div style="clear:both"></div>
</div>
<div class="cw3"><span style="color:#fb4746; font-weight:bold;">工作人员认证:</span>提交后通知社区客服审核通过后使用功能</div>
<div class="cw3"><span style="color:#7788f2; font-weight:bold;">业主认证:</span>房屋绑定，使用各种便捷功能</div>
</body>
</html>