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
    	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/eve.kid.css" rel="stylesheet"/>
    <style>
	    .my-account {
			width:100%;
	        color: #333;
	        position: relative;
	        background-color:#0697dc;
	        border-bottom: 1px solid #C0BBB2;
	        display: block;
	        height: 1.6rem;	        
		text-align:center;
	    }
	    .my-account>img {
	        height: 100%;
	        position: absolute;
	        right: 0;
	        top:0;
	        z-index: 0;
	    }
	    .my-account .user-info {
	        z-index: 1;
	        position: relative;
	        height: 100%;
	        padding: .28rem .2rem;
	        box-sizing: border-box;
	        font-size: .24rem;
	        color: #666;
		width:99%;
	    }
	    .my-account .uname {
	        font-size: .3rem;
	        color: #FFFFFF;
	        margin-top: .1rem;
		margin-left: 1.4rem;
	        margin-bottom: .12rem;
	    }
		.my-account .umoney {
	       margin-bottom: 0.06rem;
		 margin-left:1.4rem;
		   color:#FFFFFF;
	    }
	    .my-account strong {
	        color: #FFFFFF;
	        font-weight: normal;
	    }
	    .my-account .avater {
		width: 1.2rem;
	        position: absolute;
	        top: .2rem;
	        height: 1.2rem;
	        border-radius: 50%;
		left:.2rem;
	    }
	    .my-account .more.more-weak:after {
	        border-color: #fff;
	        -webkit-transform: translateY(-50%) scaleY(1.2) rotateZ(-135deg);
	    }
	    .orderindex li {
	        display: inline-block;
	        width: 25%;
	        text-align:center;
	        position: relative;
	    }
	    .orderindex li .react {
	        padding: .28rem 0;
	    }
	    .orderindex .text-icon {
	        display: block;
	        font-size: .6rem;
	        margin-bottom: .18rem;
	    }
	    .orderindex .amount-icon {
	        position: absolute;
	        left: 50%;
	        top: .16rem;
	        color: white;
	        background: #EC5330;
	        border-radius: 50%;
	        padding: .08rem .06rem;
	        min-width: .28rem;
	        font-size: .24rem;
	        margin-left: .1rem;
	        display: none;
	    }
	    .order-icon {
	        display: inline-block;
	        width: .5rem;
	        height: .5rem;
	        text-align: center;
	        line-height: .5rem;
	        border-radius: .06rem;
	        color: white;
	        margin-right: .25rem;
	        margin-top: -.06rem;
	        margin-bottom: -.06rem;
	        background-color: #F5716E;
	        vertical-align: initial;
	        font-size: .3rem;
	    }
	    .order-all {
	        background-color: #2bb2a3;
	    }
	    .order-zuo,.order-jiudian {
	        background-color: #F5716E;
	    }
	    .order-fav {
	        background-color: #0092DE;
	    }
	    .order-card {
	        background-color: #EB2C00;
	    }
	    .order-lottery {
	        background-color: #F5B345;
	    }
	    .level-icon{
	        vertical-align: middle;
	        margin-left: .2rem;
	    }
	    .top-btn{background: #0697dc;}
	</style>
</head>
<body>
	<div id="tips" class="tips"></div>
	<div>
		<a class="my-account" href="{pigcms{:U('My/myinfo')}">
			<img class="avater" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像"/>
			<div class="user-info more more-weak">
				<p class="uname">{pigcms{$now_user.nickname}<i class="level-icon level0"></i></p>
				<p class="umoney">余额：<strong>{pigcms{$now_user.now_money}</strong> 元 &nbsp;&nbsp;&nbsp<span>积分：<strong>{pigcms{$now_user.score_count}</strong> 分</span>
				<!--等级：<php>if(isset($levelarr[$now_user['level']])){ 
						  $imgstr='';
						  if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">';
						  echo ' <strong>'.$levelarr[$now_user['level']]['lname'].'</strong>';
						  }else{echo '<strong>暂无等级</strong>';}</php>--></p>
			</div>
		</a>
	</div>
	<dl class="list">
		<dd>
				<div class="dqw">我的钱包</div>
		</dd>
		<!--<ddx>-->
			<div class="kid">
				<div class="xwc"><a href="{pigcms{:U('My/user_qrcode')}" style="display:inline-block"><img class="vww" src="{pigcms{$static_path}images/cw1.jpg"></a></div>
				<div class="xwce">付 款</div>				
			</div>
			<div class="kid">
				<div class="xwc"><a href="{pigcms{:U('My/account_recharge')}" ><img class="vww" src="{pigcms{$static_path}images/cw2.jpg"></div>
				<div class="xwce" style="color:#333;">零 钱</div>
				<div class="xwce2">￥<strong>{pigcms{$now_user.now_money}</strong></div>
			</div>
			<div class="kid">
				<div class="xwc"><a href="{pigcms{:U('My/mx_money')}" style="display:inline-block"><img class="vww" src="{pigcms{$static_path}images/cw3.jpg"></a></div>
				<div class="xwce">明 细</div>
			</div>
			<div style="clear:both"></div>
		</dd>
	</dl>
	
	
		<dl class="list">
				<dd>
			<a class="react" href="{pigcms{:U('My/group_order_list')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/ccw4.jpg">团购订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/appoint_order_list')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/ccw5.jpg">预约订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/meal_order_list')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/ccw6.jpg">快店订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
		<dl class="list">
		<if condition="$config['live_service_appid']">
			<dd>
				<a class="react" href="{pigcms{:U('My/lifeservice')}">
					<div class="more more-weak">
						<img class="cww" src="{pigcms{$static_path}images/gtt11.jpg">生活缴费订单<span class="more-after"></span>
					</div>
				</a>
			</dd>
		</if>
		<dd>
			<a class="react" href="{pigcms{:U('My/group_collect')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt4.jpg">我的收藏<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/follow_merchant')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt5.jpg">我关注的商家<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/join_activity')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt6.jpg">我参与的活动<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('My/card_list')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt7.jpg">我的优惠券<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/cards')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt8.jpg">我的会员卡<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/bindMerchant')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt10.jpg">绑定商家<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<if condition="isset($config['wap_home_show_classify'])">
		<dl class="list">
			<dd>
				<a class="react" href="{pigcms{:U('Classify/myCenter')}">
					<div class="more more-weak">
						<img class="cww" src="{pigcms{$static_path}images/gtt9.jpg">我的发布<span class="more-after"></span>
					</div>
				</a>
			</dd>
		</dl>
	</if>
	<if condition="isset($weixin)">
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Login/logout')}">
				<div class="more more-weak">
					<img class="cww" src="{pigcms{$static_path}images/gtt9.jpg">退出<span class="more-after"></span>
					</div>
				</a>
			</dd>
		</dl>
	</if>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Login/logout')}">
				<div class="more-weak" style="color:#0697dc;">
					<if condition="$is_wexin_browser">重新登录<else/>返回首页</if>
				</div>
			</a>
		</dd>
	</dl>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common_wap.js"></script>
	<php>$no_footer = false;</php>
	<include file="Public:footer"/>
{pigcms{$hideScript}
<footer class="footermenu">
<ul>
					<li>
						<a  href="/wap.php?g=Wap&c=Home&a=index">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a  href="/wap.php?g=Wap&c=Group&a=index">
							<em class="group"></em>
							<p>团购</p>
						</a>
					</li>
					<li>
						<a  href="/wap.php?g=Wap&c=Meal_list&a=index&store_type=2">
							<em class="meal"></em>
							<p>快店</p>
						</a>
					</li>
					<li>
						<a class="active" href="/wap.php?g=Wap&c=My&a=index">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer>
</body>
</html>