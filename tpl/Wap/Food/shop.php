<include file="Food:header"/>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/nav.js"></script>
<link href="{pigcms{$static_path}meal/css/nav.css" rel="stylesheet">


<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container storeDetails">
		<header data-role="header" class="imglist">
			<if condition="isset($store['images'][0])">
				<img src="{pigcms{$store['images'][0]}">
			</if>
		</header>
		<section data-role="body">
			<ul class="linklist">
				<li>
					<a href="tel:{pigcms{$store['phone']}"><span class="icon tel"></span>{pigcms{$store['phone']}<span class="right_adron"></span></a>
				</li>
				<li>
					<a href="http://api.map.baidu.com/marker?location={pigcms{$store['lat']},{pigcms{$store['long']}&title=我的位置&content={pigcms{$store['adress']}&output=html&src={pigcms{$store['name']}">
					<span class="icon addr"></span>{pigcms{$store['adress']}<span class="right_adron"></span></a>
				</li>
				<if condition="!empty($dt)">
					<li>
					  <a href="#">当前距离你大约：{pigcms{$dt}</a>
					</li>
				</if>
				<li>
					<a href="{pigcms{:U('Food/shop_detail', array('mer_id' => $mer_id, 'store_id' => $store_id))}">营业时间、餐厅简介<span class="right_adron"></span></a>
				</li>
			</ul>
			<div class="btndiv">
				<if condition="$store['store_type'] eq '0'">
					<div style="width:33%">
						<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}" class="schedule"><span class="btn orange bigfont">我要预订</span></a>
					</div>
					<div style="width:33%">
						<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont">我要点餐</span></a>
					</div>
					<div style="width:33%">
						<a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="schedule"><span class="btn bigfont" style="background: #FCB402;">我要外卖</span></a>
					</div>
				<else />
					<div>
						<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}" class="schedule"><span class="btn orange bigfont">我要预订</span></a>
					</div>
					<div>
						<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont">我要点餐</span></a>
					</div>
				</if>
			</div>
		</section>
		<footer data-role="footer">
			<nav class="nav">
				<ul class="box">
					<li>
						<a href="{pigcms{:U('Index/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="home">&nbsp;</span>
							<label>首页</label>				
						</a>
					</li>
					<li >
						<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="order">&nbsp;</span>
							<label>在线点餐</label>				
						</a>
					</li>
					<li>
						<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}">
							<span class="book">&nbsp;</span>
							<label>在线订位</label>				
						</a>
					</li>
					<li >
						<a href="{pigcms{:U('Food/order_list', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="my">&nbsp;</span>
							<label>我的订单</label>
						</a>
					</li>
				</ul>
			</nav>
		</footer>
	</div>
<include file="kefu" />
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Food/index',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
</body>
</html>