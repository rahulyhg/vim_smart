<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>汇得行诚意圣诞礼</title>
    <style>
        * {
            -webkit-touch-callout: none;
            -webkit-user-select: auto;
            -khtml-user-select: auto;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }


        body {padding:0; margin:0; font-family:"微软雅黑"; font-size:14px;}
        .both {clear:both;}
        .width {width:90%; margin:0px auto;}
        .zw {width:100%;}
        .bf-1 {width:100%;height:20px; margin-top:7%;color: #fff;  font-size: 16px;}
        .bf {width:100%; background:url({pigcms{$static_path}/images/winter/3_1.jpg) no-repeat; background-size:100% 100%; height:70px; margin-top:75%;}
        .bf2 {width:100%; text-align:center; padding-top:10px;}
        .bf3 {width:100%; position:fixed; bottom:-10px;z-index: -10;overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;}
		.gfw:link {text-decoration:none; color:#FFFFFF;}
		.gfw:visited {text-decoration:none; color:#FFFFFF;}
		.gfw:hover {text-decoration:none; color:#FFFFFF;}
		.gfw:active {text-decoration:none; color:#FFFFFF;}

    </style>
  <style>
      html,body {width:100%; height:100%;}
    body {color:#afafaf; font-size:14px;  background:url({pigcms{$static_path}/images/winter/1_3.jpg) no-repeat; background-size:100% 100%;overflow: hidden;position:fixed;}
    .active{color:#033f6b;}
	.kidx {padding-top:7px; background-color:#FFFFFF;}
	p {margin: 0px;}
    /*遮罩层样式*/
      .weixin_layout{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:url() no-repeat center center rgba(0, 0, 0, 0.8);z-index:99999;}
      .weixin_layout .point{width:90%;height:60%;float:right;background:url({pigcms{$static_path}/images/winter/share_img1.png) no-repeat center center;background-size: 100% 100%}
      .music{width:30px;height:30px;position:absolute;top:10%;right:10%;margin:0 0 0 0;z-index:99999}
	  li{ list-style-type: none; }
	  ul {margin:0; padding:0;}
  </style>
</head>
<body>
<audio autoplay="autoplay" controls="controls" loop="loop" preload="auto" style="display:none" id="musicplayer">
    <source src="{pigcms{$static_path}/images/winter/shengdange.mp3" loop="loop" type="audio/mpeg">
</audio>
<div class="music" id="music">
    <img src="http://hkland.vhi99.com/winter/mat1.gtimg.com/www/images/qq2012/festival/feasts/dongzhi2015/musicclose.png" id="musicImg" style="width: 100%;height: 100%;"/>
</div>
    <div class="zw">
        <div class="width">
            <div class="bf"><textarea onBlur="action()" id="text" name="text" cols="20"  rows="2" style="font-size:16px;width:90%; margin-top:20px; margin-left:5%; border:none; background-color:#f8f5ee;" placeholder="这里输入圣诞祝福......"></textarea></div>
			<div style="width:100%; padding-top:10px;">
				<div id="broadcast" class="bar" name="giftactive">
				  <div id="demo" style="overflow:hidden; color:#FFFFFF; height:22px;line-height:22px;">
					<ul class="mingdan" id="holder" style="margin-left:5px; font-size:14px;">

                        <foreach name="text_list" item="vo">
                            <li>
                                <a href="#" target="_blank" class="gfw">
                                    {pigcms{$vo['text']}
                                    By:<span style="font-weight:bold;"><if condition="$vo['nickname']">{pigcms{$vo['nickname']}<else/>用户</if></span>
                                </a>
                            </li>
                        </foreach>
					  <!--<li><a href="#" target="_blank" class="gfw"><span style="font-weight:bold;">蓝色贝鱼：</span>是否绑定是防不胜防表达方式吧</a></li>
					  <li><a href="#" target="_blank" class="gfw"><span style="font-weight:bold;">蓝色贝2鱼：</span>是否绑定是防不胜防表达方式吧2</a></li>
					  <li><a href="#" target="_blank" class="gfw"><span style="font-weight:bold;">蓝色3贝鱼：</span>是否绑定是防不胜防表达方式吧3</a></li>
					  <li><a href="#" target="_blank" class="gfw"><span style="font-weight:bold;">蓝色4贝鱼：</span>是否绑定是防不胜防表达方式吧4</a></li>
					  <li><a href="#" target="_blank" class="gfw"><span style="font-weight:bold;">蓝色贝5鱼：</span>是否绑定是防不胜防表达方式吧5</a></li>-->
					</ul>
				  </div>
				</div>
			</div>
            <div class="bf2"><img src="{pigcms{$static_path}/images/winter/1_07_1.png" style="width:50%; height:auto;" onClick="upload()"></div>
            <div class="bf-1">活动时间：即日起至2018年12月25日24:00截止，期间每天都可参与抢红包，抢完即止，最终解释权归汇得行集团所有。</div>
        </div>
        <div class="bf3"><img src="{pigcms{$static_path}/images/winter/6_1.png" style="width:100%;z-index: -10"></div>
    </div>
    <div class="weixin_layout">
        <div class="point"></div>
    </div>
</body>
<script src="{pigcms{$static_path}tpl/com/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<!--<script src="{pigcms{$static_path}js/137/sweetalert.min.js" type="text/javascript"></script>-->
<script>
	function AutoScroll(obj) {
    $(obj).find("ul:first").animate({
        marginTop: "-22px"
    },
    500,
    function() {
        $(this).css({
            marginTop: "0px"
        }).find("li:first").appendTo(this);
    });
	}
	$(document).ready(function() {
		setInterval('AutoScroll("#demo")', 5000)
	});
</script>
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
            title: '"{pigcms{$user_info["nickname"]}"给你准备了圣诞红包和祝福，万万别错过哟',
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
            title: '"{pigcms{$user_info["nickname"]}"给你准备了圣诞红包和祝福，万万别错过哟',
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
    function upload() {
        $.ajax({
            url:"{pigcms{:U('ajax_winter_text')}",
            type:"POST",
            data:{"text":$('#text').val()},
            async:true,
            dataType:"json",
            success:function (data){
                if(data.err==1){
                    alert(data.data);
                }else{
                    share();
                    //分享朋友圈
                    wx.onMenuShareTimeline({
                        title: '"{pigcms{$user_info["nickname"]}"给你准备了圣诞红包和祝福，万万别错过哟',
                        link: 'http://{pigcms{$_SERVER['HTTP_HOST']}{pigcms{:U("ajax_img")}&id='+data.data,
                        imgUrl: 'http://www.hdhsmart.com/tpl/Wap/default/static//images/winter/share.jpg',
                        success: function () {
                            setTimeout(function(){
                                $('.weixin_layout').hide();
                                check();
                            }, 500);
                        },
                        cancel: function () {
                            // 用户取消分享后执行的回调函数
                        }
                    });
                    //分享朋友
                    wx.onMenuShareAppMessage({
                        title: '"{pigcms{$user_info["nickname"]}"给你准备了圣诞红包和祝福，万万别错过哟',
                        desc: '速来，抢最高888元现金红包！',
                        link: 'http://{pigcms{$_SERVER['HTTP_HOST']}{pigcms{:U("ajax_img")}&id='+data.data,
                        imgUrl: 'http://www.hdhsmart.com/tpl/Wap/default/static//images/winter/share.jpg',
                        type: 'link',
                        dataUrl: '',
                        success: function () {
                            setTimeout(function(){
                                $('.weixin_layout').hide();
                                check();
                            }, 500);

                        },
                        cancel: function () {
                        }
                    });
                }
            },
            error:function (error){

            }
        });
    }
    function share() {
        $(".weixin_layout").show();
        $('.weixin_layout').off('click').on('click',function(){
            $('.weixin_layout').hide();
        });
    }
    function check() {
     $.ajax({
     url:"{pigcms{:U('winter_cash_send')}",
     type:"POST",
     data:{"food_list":''},
     async:true,
     dataType:"json",
         beforeSend:function () {
             $('.weixin_layout').show();
         },
        success:function (data){
            if(data.err==1){
                alert(data.data);
            }else{
                window.location.href="{pigcms{:U('winter_hongbao')}";
            }
        },
        error:function (error){

        }
        });
     }
    // 兼容Android 键盘弹起时，把确认订单弹窗顶上去影响布局
    const h = document.body.scrollHeight;  // 用onresize事件监控窗口或框架被调整大小，先把一开始的高度记录下来
    window.onresize = function () { // 如果当前窗口小于一开始记录的窗口高度，那就让当前窗口等于一开始窗口的高度
        if (document.body.scrollHeight < h) {
            document.body.style.height = h
        }
    }
    function action() {
        $('html,body').animate({scrollTop: '0px'}, 800);
    }


</script>
</html>