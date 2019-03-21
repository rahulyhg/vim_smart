<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>诚意圣诞礼</title>
    <style>
        * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }


        body {padding:0; margin:0; font-family:"微软雅黑"; font-size:14px;}


        .hb {width:100%; }


    </style>
    <style>
        html,body {width:100%; height:100%;}
        body {color:#afafaf; font-size:14px; background-color:#ffffff; background-size:100% 100%;;}
        .active{color:#033f6b;}
        .kidx {padding-top:7px; background-color:#FFFFFF;}
        p {margin: 0px;}
        .music{width:30px;height:30px;position:absolute;top:10%;right:10%;margin:0 0 0 0;z-index:99999}
    </style>
</head>
<body>
<audio autoplay="autoplay" controls="controls" loop="loop" preload="auto" style="display:none" id="musicplayer">
    <source src="{pigcms{$static_path}/images/winter/shengdange.mp3" loop="loop" type="audio/mpeg">
</audio>
<div class="music" id="music">
    <img src="http://hkland.vhi99.com/winter/mat1.gtimg.com/www/images/qq2012/festival/feasts/dongzhi2015/musicclose.png" id="musicImg" style="width: 100%;height: 100%;"/>
</div>
        <div class="hb"><img src="{pigcms{:U('ajax_img',array('id'=>$_GET['id'],'ajax'=>'ajax'))}" style="width:100%; height:100%;"></div
</body>
<script src="{pigcms{$static_path}tpl/com/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script>
    var mPlayer = document.getElementById('musicplayer');
    var musicImg = document.getElementById('musicImg');
    var mstatus = 1;
    $(musicImg).click(function () {
        if(mstatus == 1) {
            mstatus = 0;
            musicImg.src = 'http://hkland.vhi99.com/winter/mat1.gtimg.com/www/images/qq2012/festival/feasts/dongzhi2015/musicopen.png';
            mPlayer.pause();
        }else{
            mstatus = 1;
            musicImg.src = 'http://hkland.vhi99.com/winter/mat1.gtimg.com/www/images/qq2012/festival/feasts/dongzhi2015/musicclose.png';
            mPlayer.play();
        }
    });
    wx.config({
        debug: false,
        appId: '{pigcms{$signPackage["appId"]}',
        timestamp: '{pigcms{$signPackage["timestamp"]}',
        nonceStr: '{pigcms{$signPackage["nonceStr"]}',
        signature: '{pigcms{$signPackage["signature"]}',
        jsApiList: [
            'chooseWXPay','onMenuShareTimeline','onMenuShareAppMessage','getLocation','startRecord','stopRecord','onVoiceRecordEnd','playVoice','pauseVoice','stopVoice','onVoicePlayEnd','uploadVoice','downloadVoice'
        ]
    });
    wx.ready(function(){
        mPlayer.play();
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: '{pigcms{$user_info["nickname"]}给你准备了圣诞红包和祝福，万万别错过哟',
            link: 'http://{pigcms{$_SERVER['HTTP_HOST']}{pigcms{:U("ajax_img")}',
            imgUrl: 'http://www.hdhsmart.com/tpl/Wap/default/static//images/winter/share.jpg',
            success: function () {

            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //分享朋友
        wx.onMenuShareAppMessage({
            title: '{pigcms{$user_info["nickname"]}给你准备了圣诞红包和祝福，万万别错过哟',
            desc: '速来，抢最高888元现金红包！',
            link: 'http://{pigcms{$_SERVER['HTTP_HOST']}{pigcms{:U("ajax_img")}',
            imgUrl: 'http://www.hdhsmart.com/tpl/Wap/default/static//images/winter/share.jpg',
            type: 'link',
            dataUrl: '',
            success: function () {

            },
            cancel: function () {
            }
        });
    });
</script>
</html>