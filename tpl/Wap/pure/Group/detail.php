<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<title>{pigcms{$config.group_alias_name}详情</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name='apple-touch-fullscreen' content='yes'/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="format-detection" content="telephone=no"/>
		<meta name="format-detection" content="address=no"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/detail.css?210"/>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js?444"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/common.js?216" charset="utf-8"></script>
		<script type="text/javascript"><if condition="$long_lat">var user_long = "{pigcms{$long_lat.long}",user_lat = "{pigcms{$long_lat.lat}";<else/>var user_long = '0',user_lat  = '0';</if></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/detail.js?216" charset="utf-8"></script>
		<style type="text/css">
		.clock {
		    position: absolute;
		    display: inline-block;
		    right: 10px;
		    border: 1px solid #DADADA;
		    border-radius: 5px;
		    padding: 1px 3px;
		    top: 25px;
		    background: url(../tpl/Wap/pure/static/img/index/clock.png) no-repeat;
		    background-size: 14px;
		    background-position: 4px 4px;
		    padding-left: 22px;
		}
		.clock .timerBox {
		    letter-spacing: 0.5px;
		}
		.clock .timer {
		    color: #FF658D;
		}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="scroller" style="padding-bottom:50px">
				<div id="pullDown" style="background-color:#fb4746;color:white;">
					<span class="pullDownLabel" style="padding-left:0px;"><i class="yesLightIcont" style="vertical-align:middle; margin-right:10px;"></i>{pigcms{$config.wechat_name} 精心为您优选</span>
				</div>
				<section class="imgBox">
					<img src="{pigcms{$now_group.all_pic.0.m_image}" class="view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>"/>
					<div class="imgCon">
						<div class="title"><if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.merchant_name}<else/>{pigcms{$now_group.s_name}</if></div>
						<div class="desc">{pigcms{$now_group.group_name}</div>
					</div>
					<div class="back"></div>
				</section>
				<section class="buyBox">
					<div class="priceDiv">
						<span class="price">￥<strong>{pigcms{$now_group['price']}</strong><span class="old">￥<del>{pigcms{$now_group.old_price}</del></span></span>
						<if condition="$now_group['begin_time'] gt $_SERVER['REQUEST_TIME']">
							<span class="clock"><span class="time_d">{pigcms{$time_array['d']}</span>天 <span class="timerBox"><span class="timer time_h">{pigcms{$time_array['h']}</span>:<span class="timer time_m">{pigcms{$time_array['m']}</span>:<span class="timer time_s">{pigcms{$time_array['s']}</span></span></span>
						<elseif condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME'] AND $now_group['begin_time'] lt $_SERVER['REQUEST_TIME']" />
							<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">立即购买</a>
						</if>
					</div>
					<if condition="$now_group['wx_cheap']">
                        <if condition="$is_app_browser">
                        <div class="cheapDiv">优惠 <span class="tag">APP购买再减{pigcms{$now_group.wx_cheap}元</span></div> 
                        <else/>
						<div class="cheapDiv">优惠 <span class="tag">微信购买再减{pigcms{$now_group.wx_cheap}元</span></div>
                        </if>
					</if>
					<if condition="empty($user_session) && $config['user_score_max_use']">
						 <div class="cheapDiv link-url" data-url="{pigcms{:U('Login/index')}">积分抵现 <span class="tag">请先登录查看可抵现金额</span></div>
					<elseif condition="$user_coupon_use['score']"/>
                        <div class="cheapDiv">积分抵现 <span class="tag">本单最高可用{pigcms{$user_coupon_use.score}积分抵{pigcms{$user_coupon_use.score_money}元</span></div> 
					</if>
					<div class="saleDiv">
						<span><i class="yesLightIcon"></i>随时退</span>
						<span><i class="yesLightIcon"></i>过期退</span>
						<span class="sale"><i class="yesIcon"></i>已售{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</span>
					</div>
				</section>
				<if condition="!empty($reply_list)">
					<section class="scoreBox link-url" data-url="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">
						<div class="rateInfo">
							<div class="starIconBg"><div class="starIcon" style="width:{pigcms{$now_group['score_mean']*20}%;"></div></div>
							<div class="starText">{pigcms{$now_group.score_mean}</div>
							<div class="right">{pigcms{$now_group.reply_count} 人评价</div>
						</div>
					</section>
				</if>
				<section class="storeBox">
					<dl class="storeList">
						<volist name="now_group['store_list']" id="vo" offset="0" length="2">
							<dd class="link-url" data-url="{pigcms{:U('Group/shop',array('store_id'=>$vo['store_id']))}">
								<div class="name">{pigcms{$vo.name}</div>
								<div class="address">{pigcms{$vo.area_name}{pigcms{$vo.adress}</div>
								<if condition="$vo['range']"><div class="position"><div class="range">{pigcms{$vo.range}</div><if condition="$i eq 1"><div class="desc">离我最近</div></if></div></if>
								<div class="phone" data-phone="{pigcms{$vo.phone}"></div>
							</dd>
						</volist>
					</dl>
					<if condition="count($now_group['store_list']) gt 2">
						<div class="more link-url" data-url="{pigcms{:U('Group/branch',array('group_id'=>$now_group['group_id']))}">全部{pigcms{:count($now_group['store_list'])}家分店</div>
					</if>
				</section>
				<section class="detail introList">
					<div class="titleDiv"><div class="title">本单详情</div></div>
					<div class="content">{pigcms{$now_group.content}</div> 
				</section>
				<if condition="$now_group['cue_arr']">
					<section class="term introList">
						<div class="titleDiv"><div class="title">购买须知</div></div>
						<div class="content">
							<ul>
								<volist name="now_group['cue_arr']" id="vo">
									<if condition="$vo['value']">
										<li><b>{pigcms{$vo.key}：</b>{pigcms{$vo.value|nl2br=###}</li>
									</if>
								</volist>
							</ul>
						</div> 
					</section>
				</if>
				<if condition="!empty($reply_list)">
					<section class="comment introList">
						<div class="titleDiv"><div class="title">评价<div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:{pigcms{$now_group['score_mean']*20}%;"></div></div><div class="starText">{pigcms{$now_group.score_mean}</div></div><div class="right">{pigcms{$now_group.reply_count} 人评论</div></div></div>
						<dl>
							<volist name="reply_list" id="vo">
								<dd>
									<div class="titleBar">
										<div class="nickname">{pigcms{$vo.nickname}</div><div class="dateline">{pigcms{$vo.add_time}</div><div class="rateInfo"><div class="starIconBg"><div class="starIcon" style="width:{pigcms{$vo['score']*20}%;"></div></div></div>
									</div>
									<div class="replyCon">
										<div class="textDiv">
											<div class="text">{pigcms{$vo.comment}</div>
										</div>
										<if condition="$vo['pics']">
											<ul class="imgList" data-pics="<volist name="vo['pics']" id="voo">{pigcms{$voo.m_image}<if condition="count($vo['pics']) gt $i">,</if></volist>">
												<volist name="vo['pics']" id="voo">
													<li><img src="{pigcms{$voo.s_image}"/></li>
												</volist>
											</ul>
										</if>
										<if condition="$vo['merchant_reply_content']">
										<div class="textDiv">
											<div class="text" style=" font-size: 12px;color: #C6895A;">商家回复：{pigcms{$vo.merchant_reply_content}</div>
										</div>
										</if>
									</div>
								</dd>
							</volist>
						</dl>
						<if condition="$now_group['reply_count'] gt 3">
							<div class="more link-url" data-url="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">查看全部 {pigcms{$now_group.reply_count} 条评价</div>
						</if>
					</section>
				</if>
				<if condition="$merchant_group_list">
					<section class="storeProList introList">
						<div class="titleDiv"><div class="title">商家其他{pigcms{$config.group_alias_name}</div></div>
						<ul class="goodList">
							<volist name="merchant_group_list" id="vo">
								<li class="link-url" data-url="{pigcms{$vo.url}" <if condition="$i gt 2">style="display:none;"</if>>
									<div class="dealcard-img imgbox">
										<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.name}"/>
									</div>
									<div class="dealcard-block-right">
										<div class="title">{pigcms{$vo.group_name}</div>
										<div class="price">
											<strong>{pigcms{$vo['price']}</strong><span class="strong-color">元</span><if condition="$vo['wx_cheap']"><span class="tag">微信再减{pigcms{$vo.wx_cheap}元</span></if><if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
										</div>
									</div>
								</li>
							</volist>
							<if condition="count($merchant_group_list) gt 2"><li class="more">其他{pigcms{:count($merchant_group_list)-2}个{pigcms{$config.group_alias_name}</li></if>
						</ul>
					</section>
				</if>
				<if condition="$category_group_list && $merchant_link_showOther">
					<section class="sysProList introList">
						<div class="titleDiv"><div class="title">看了本{pigcms{$config.group_alias_name}的用户还看了</div></div>
						<dl class="likeBox dealcard">
							<volist name="category_group_list" id="vo">
								<dd class="link-url" data-url="{pigcms{$vo.url}">
									<div class="dealcard-img imgbox">
										<img src="{pigcms{$config.site_url}/index.php?c=Image&a=thumb&width=276&height=168&url={pigcms{:urlencode($vo['list_pic'])}" alt="{pigcms{$vo.name}"/>
									</div>
									<div class="dealcard-block-right">
										<div class="brand"><if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}<else/>{pigcms{$vo.s_name}</if><if condition="$vo['range_txt']"><span class="location-right">{pigcms{$vo.range_txt}米</span></if></div>
										<div class="title">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
										<div class="price">
											<strong>{pigcms{$vo['price']}</strong><span class="strong-color">元</span><if condition="$vo['wx_cheap']"><span class="tag">微信再减{pigcms{$vo.wx_cheap}元</span></if><if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</if></span>
										</div>
									</div>
								</dd>
							</volist>
						</dl>
					</section>
				</if>
				<div id="pullUp" style="bottom:-60px;">
					<img src="{pigcms{$config.site_logo}" style="width:130px;height:40px;margin-top:10px"/>
				</div>
			</div>
		</div>
		<div class="positionDiv">
			<div class="left"><div class="back"></div></div>
			<if condition="$now_group['tuan_type'] neq 2">
				<div class="center">{pigcms{$now_group.merchant_name}</div>
			<else/>
				<div class="center">{pigcms{$now_group.s_name}</div>
			</if>
			<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME'] AND $now_group['begin_time'] lt $_SERVER['REQUEST_TIME']">
				<div class="right">
					<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">购买</a>
				</div>
			</if>
		</div>
		<if condition="!$merchant_link_showOther"><php>$no_footer=true;</php></if>
		<include file="Public:footer"/>
		<script type="text/javascript">
			window.shareData={
						"moduleName":"Group",
						"moduleID":"0",
						"imgUrl": "<if condition="$config['wechat_share_img']">{pigcms{$config.wechat_share_img}<else/>{pigcms{$now_group.all_pic.0.m_image}</if>", 
						"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}",
						"tTitle": "{pigcms{$now_group.s_name}",
						"tContent": "{pigcms{$now_group.group_name}"
			};
		</script>
		{pigcms{$shareScript}
		<include file="kefu" />
        
        <if condition="$is_app_browser">
            <script type="text/javascript">
                window.lifepasslogin.shareLifePass("<if condition="$now_group['tuan_type'] neq 2">【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.group_name}<else/>{pigcms{$now_group.s_name}</if>","{pigcms{$now_group.group_name}","<if condition="$config['wechat_share_img']">{pigcms{$config.wechat_share_img}<else/>{pigcms{$now_group.all_pic.0.m_image}</if>","{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}");
            </script>
        </if>
	</body>
</html>