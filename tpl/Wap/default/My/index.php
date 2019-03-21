<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>我的钱包</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}test/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}test/weui2.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .zkd {width:100%; height:240px; background:url({pigcms{$static_path}images/gbj.jpg) no-repeat center; background-size:100% 100%;}
        .tyt {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .tyt2 {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF; margin-top:20px;}
        .hht {width:80px; height:80px; padding-top:20px; margin:0px auto;}
        .hht2 {width:100%; padding-top:7px; line-height:1.5; text-align:center; color:#FFFFFF; font-size:18px;}
        .hht3 {width:100%; padding-top:7px; line-height:1.5; text-align:center; color:#FFFFFF; padding-bottom:13px;}
        .htt4 {border-radius:4px; color:#FFFFFF; border:1px #FFFFFF solid; width:25%; margin:0px auto; text-align:center; line-height:2;}
        .htt4:active {background-color:#FFFFFF; color:#3cb9ff;}
        .jt {width:100%; margin:0px auto; }
        .jt2 {width:33.3%; float:left; box-sizing: border-box; border-right:0.7px #f4f4f4 solid; padding-top:30px; padding-bottom:25px;}
        .jt3 {width:25%; margin:0px auto;}
        .jt4 {width:100%; text-align:center; line-height:2; color:#333333;}
        .xrw {width:100%; height:49px; overflow:hidden; border-bottom:1px #e7e7e7 solid;}
        .xrwt {width:100%; height:45px; overflow:hidden; line-height:45px; font-size:14px; padding-left:5%; color:#fb4746;}
        .xrw:active {background-color:#f5f5f5;}
        .xrwt:active {background-color:#fb4746; color:#FFFFFF;}
        .f1 {width:5%; float:left; padding-top:15px; margin-left:5%;}
        .f2 {width:50%; float:left; line-height:49px; margin-left:3%; color:#575e66;}
        .wb_arrow{
            border-right: 3px solid #a7b9d0;
            border-top: 3px solid #a7b9d0;
            height: 7px;
            width: 7px;
            float: right;
            margin-top: 18px;
            margin-right: 5%;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            border-left: 2px solid transparent;
            border-bottom: 2px solid transparent;
        }

    </style>
</head>
<body>
<div class="zkd">
    <div class="hht"><img src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像" style="width:100%; height:100%; border-radius: 50%;" /></div>
    <div class="hht2">{pigcms{$now_user.nickname}</div>
    <div class="hht3">余额：{pigcms{$now_user.now_money}元　积分：{pigcms{$now_user.score_count}分</div>
    <a href="{pigcms{:U('My/myinfo')}"><div class="htt4">我的账户</div></a>
</div>

<div class="tyt">
    <div class="jt">
        <div class="jt2">
            <div class="jt3"><a href="{pigcms{:U('My/user_qrcode')}" style="display:inline-block"><img src="{pigcms{$static_path}images/gx1.jpg" style="width:100%; height:auto; " /></a></div>
            <div class="jt4">付 款</div>
        </div>
        <div class="jt2">
            <div class="jt3"><a href="{pigcms{:U('My/account_recharge')}" ><img src="{pigcms{$static_path}images/gx2.jpg" style="width:100%; height:auto; " /></a></div>
            <div class="jt4">零 钱</div>
        </div>
        <div class="jt2">
            <div class="jt3"><a href="{pigcms{:U('My/mx_money')}" style="display:inline-block"><img src="{pigcms{$static_path}images/gx3.jpg" style="width:100%; height:auto; " /></a></div>
            <div class="jt4">明 细</div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>

<div class="tyt2">
    <a href="{pigcms{:U('My/group_order_list')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh1.png" style="width:100%; height:auto; " /></div>
            <div class="f2">团购订单</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a href="{pigcms{:U('My/appoint_order_list')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh2.png" style="width:100%; height:auto; " /></div>
            <div class="f2">预约订单</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a href="{pigcms{:U('My/meal_order_list')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh3.png" style="width:100%; height:auto; " /></div>
            <div class="f2">快店订单</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
</div>


<div class="tyt2">
    <a class="react" href="{pigcms{:U('My/group_collect')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh4.png" style="width:100%; height:auto; " /></div>
            <div class="f2">我的收藏</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a class="react" href="{pigcms{:U('My/follow_merchant')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh5.png" style="width:100%; height:auto; " /></div>
            <div class="f2">我关注的商家</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a class="react" href="{pigcms{:U('My/join_activity')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh6.png" style="width:100%; height:auto; " /></div>
            <div class="f2">我参与的活动</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
</div>




<div class="tyt2">
    <a href="{pigcms{:U('My/card_list')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh7.png" style="width:100%; height:auto; " /></div>
            <div class="f2">我的优惠券</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a class="react" href="{pigcms{:U('My/cards')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh8.png" style="width:100%; height:auto; " /></div>
            <div class="f2">我的会员卡</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a class="react" href="{pigcms{:U('My/bindMerchant')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh9.png" style="width:100%; height:auto; " /></div>
            <div class="f2">绑定商家</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
    <a class="react" href="{pigcms{:U('Storestaff/login')}">
        <div class="xrw">
            <div class="f1"><img src="{pigcms{$static_path}images/gh9.png" style="width:100%; height:auto; " /></div>
            <div class="f2">绑定店铺</div>
            <div class="wb_arrow"></div>
            <div style="clear:both"></div>
        </div>
    </a>
</div>


<if condition="isset($config['wap_home_show_classify'])">
<div class="tyt2">
    <a class="react" href="{pigcms{:U('Classify/myCenter')}">
    <div class="xrw">
        <div class="f1"><img src="{pigcms{$static_path}images/gh10.png" style="width:80%; height:auto; " /></div>
        <div class="f2">我的发布</div>
        <div class="wb_arrow"></div>
        <div style="clear:both"></div>
    </div>
    </a>
</div>
</if>


<div class="tyt2">
    <a class="react" href="{pigcms{:U('Login/logout')}">
    <div class="xrwt"><if condition="$is_wexin_browser">重新登录<else/>返回首页</if></div>

    </a>
</div>
<div style="width:100%; height:30px; overflow:hidden;"></div>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common_wap.js"></script>
<!--	<php>$no_footer = false;</php>-->
<!--	<include file="Public:footer"/>-->
{pigcms{$hideScript}
<!--<footer class="footermenu">-->
<!--<ul>-->
<!--					<li>-->
<!--						<a  href="/wap.php?g=Wap&c=Home&a=index">-->
<!--							<em class="home"></em>-->
<!--							<p>首页</p>-->
<!--						</a>-->
<!--					</li>-->
<!--					<li>-->
<!--						<a  href="/wap.php?g=Wap&c=Group&a=index">-->
<!--							<em class="group"></em>-->
<!--							<p>团购</p>-->
<!--						</a>-->
<!--					</li>-->
<!--					<li>-->
<!--						<a  href="/wap.php?g=Wap&c=Meal_list&a=index&store_type=2">-->
<!--							<em class="meal"></em>-->
<!--							<p>快店</p>-->
<!--						</a>-->
<!--					</li>-->
<!--					<li>-->
<!--						<a class="active" href="/wap.php?g=Wap&c=My&a=index">-->
<!--							<em class="my"></em>-->
<!--							<p>我的</p>-->
<!--						</a>-->
<!--					</li>-->
<!--				</ul>-->
<!--			</footer>-->
</body>
</html>