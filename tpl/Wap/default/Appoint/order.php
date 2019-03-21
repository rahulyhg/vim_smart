<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0" />
	<meta name="format-detection"content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>预约</title>
	<link href="{pigcms{$static_path}css/appoint_form.css?07" rel="stylesheet"/>
</head>
<body>
	<section id="main">
		<div class="yxc-body-bg index-section">
			<form action="" method="post" id="main_form">
				<if condition="count($appoint_product) gt 0">
					<div class="yxc-space"></div>
					<div class="tit-select-service">选择服务</div>
					<input type="hidden" name="service_type" id="service_type" value="{pigcms{$defaultAppointProduct['id']}"/>
					<div class="comm-service">
						<span><em>¥</em><span>{pigcms{$defaultAppointProduct['price']}</span></span>
						<div class="con-service">
							<div class="con-service-inner" data-role="packageDescription">{pigcms{$defaultAppointProduct['name']}：{pigcms{$defaultAppointProduct['content']}</div>
						</div>
					</div>
				</if>
				<div class="yxc-space space-six border-t-no"></div>
				<ul class="yxc-attr-list">
					<li data-role="chooseStore">
						<i class="icon-store"></i>
						<p class="cover select">
							<select name="store_id" id="store_id" class="ipt-attr">
								<option value="">选择预约店铺</option>
								<volist name="now_group['store_list']" id="vo">
									<option value="{pigcms{$vo.store_id}">{pigcms{$vo.name} [距您约{pigcms{$vo.range_txt}]</option>
								</volist>
							</select>
						</p>
					</li>
				</ul>
				<div class="yxc-space"></div>
				<ul class="yxc-attr-list">
					<li data-role="chooseTime">
						<i class="icon-time"></i>
						<p class="cover no-arrow">
							<input type="hidden" name="service_date" id="service_date" value=""/>
							<input type="hidden" name="service_time" id="service_time" value=""/>
							<input class="ipt-attr" type="text" id="serviceJobTime" placeholder="选择预约时间" readonly="readonly"/>
						</p>
					</li>
				</ul>
				<div class="yxc-space"></div>
				<if condition="$now_group['payment_status'] eq 1">
					<div class="yxc-paymentMoney"><img src="{pigcms{$static_path}images/icon_deposit.png" style="width:15px;margin-right:5px;"/><span style="">预约定金</span><img src="{pigcms{$static_path}images/icon_rmb.png" style="width:8px;margin-left:15px;"/>&nbsp;<span style="font-size:20px;color:#ff8a00;margin-bottom:0;">{pigcms{$now_group.payment_money}</span></div>
					<div class="yxc-space"></div>
				</if>
				<if condition="$formData || $now_group['appoint_type']">
					<ul class="yxc-attr-list">	
						<if condition="$now_group['appoint_type']">
							<li>
								<i class="icon-position"></i>
								<input type="hidden" name="custom_field[0][name]" value="服务位置"/>
								<input type="hidden" name="custom_field[0][type]" value="2"/>
								<input type="hidden" name="custom_field[0][long]" data-type="long"/>
								<input type="hidden" name="custom_field[0][lat]" data-type="lat"/>
								<input type="hidden" name="custom_field[0][address]" data-type="address"/>
								<p class="cover">
									<input data-role="position" class="ipt-attr" type="text" name="custom_field[0][value]" placeholder="请选择服务位置" readonly="readonly" data-required="required"/>
								</p>
								<p class="cover">
									<input data-role="position-desc" class="ipt-attr" type="text" name="custom_field[0][value-desc]" placeholder="请标注地图后填写详细地址" data-required="required"/>
								</p>
							</li>
						</if>
						<volist name="formData" id="vo">
							<li>
								<switch name="vo['type']">
									<case value="0">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="text" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="text" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="1">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><textarea class="ipt-attr" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="textarea" <if condition="$vo['iswrite']">data-required="required"</if>></textarea></p>
									</case>
									<case value="2">
										<i class="icon-position"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][long]" data-type="long"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][lat]" data-type="lat"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][address]" data-type="address"/>
										<p class="cover">
											<input data-role="position" class="ipt-attr" type="text" name="custom_field[{pigcms{$i}][value]" placeholder="请标注{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" readonly="readonly" <if condition="$vo['iswrite']">data-required="required"</if>/>
										</p>
										<p class="cover">
											<input data-role="position-desc" class="ipt-attr" type="text" name="custom_field[0][value-desc]" placeholder="请标注地图后填写详细地址" data-required="required"/>
										</p>
									</case>
									<case value="3">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover select">
											<select name="custom_field[{pigcms{$i}][value]" class="ipt-attr" data-role="select"  placeholder="请选择{pigcms{$vo.name}" <if condition="$vo['iswrite']">data-required="required"</if>>
												<option value="">请选择{pigcms{$vo.name}</option>
												<volist name="vo['use_field']" id="voo">
													<option value="{pigcms{$voo}">{pigcms{$voo}</option>
												</volist>
											</select>
										</p>
									</case>
									<case value="4">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="tel" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="number" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="5">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="email" name="custom_field[{pigcms{$i}][value]" placeholder="请输入正确的{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="email" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="6">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="date" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="date" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="7">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="time" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="time" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="8">
										<i class="icon-phone"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="tel" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="phone" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
									<case value="9">
										<i class="icon-txt"></i>
										<input type="hidden" name="custom_field[{pigcms{$i}][name]" value="{pigcms{$vo.name}"/>
										<input type="hidden" name="custom_field[{pigcms{$i}][type]" value="{pigcms{$vo.type}"/>
										<p class="cover"><input class="ipt-attr" type="datetime" name="custom_field[{pigcms{$i}][value]" placeholder="请输入{pigcms{$vo.name}<if condition="!$vo['iswrite']">（可选）</if>" data-role="datetime" <if condition="$vo['iswrite']">data-required="required"</if>/></p>
									</case>
								</switch>
							</li>
						</volist>
					</ul>
					<div class="yxc-space space-six border-t-no"></div>
				</if>
				<em class="tip-add-money">
					<div class="foot-index">
						<a class="bt-sub-order" data-role="submit">
							立即下单
						</a>
					</div>
				</em>
			</form>
		</div>
	</section>
	<section id="service-type" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<header class="yxc-brand">
				<a class="arrow-wrapper" data-role="cancel">
					<i class="bt-brand-back"></i>
				</a>
				<span>选择服务</span>
			</header>
			<ul class="yxc-service-list yxc-package boder-top service-list">
				<volist name="appoint_product" id="vo">
					<li <if condition="$vo['id'] eq $defaultAppointProduct['id']">class="active"</if> data-id="{pigcms{$vo['id']}">
						<label class="pay-type" for="pay-type-{pigcms{$vo['id']}">
							<span class="service-price"><em>¥</em><span data-role="payAmount">{pigcms{$vo['price']}</span></span>
							<div class="service-intro">
							  <h3 data-role="title">{pigcms{$vo['name']}</h3>
							  <span data-role="content">{pigcms{$vo['content']}</span>
							</div>
							<input name="pay-type" id="pay-type-{pigcms{$vo['id']}" type="radio" value="" style="opacity:0;position:absolute;top:0;" <if condition="$vo['id'] eq $defaultAppointProduct['id']">checked="checked"</if>/>
							<span class="bt-interior"></span>
						</label>
					</li>
				</volist>
			</ul>
		</div>
	</section>
	<section id="service-date" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<header class="yxc-brand">
				<a class="arrow-wrapper" data-role="cancel">
					<i class="bt-brand-back"></i>
				</a>
				<span>选择预约时间</span>
			</header>
			<div class="yxc-time-con number-{pigcms{:count($timeOrder)}">
				<volist name="timeOrder" id="timeOrderInfo">
					<dl <if condition="$i eq count($timeOrder)">class="last"</if>>
						<dt <if condition="$i eq 1">class="active"</if> data-role="date" data-text="<if condition="$key eq date('Y-m-d')" > 今天<elseif condition="$key eq date('Y-m-d',strtotime('+1 day'))" />明天
	<elseif condition="$key eq date('Y-m-d',strtotime('+2 day'))" />后天<else />{pigcms{$key}
								</if>" data-date="{pigcms{$key}">
								<if condition="$key eq date('Y-m-d')" > 今天
								<elseif condition="$key eq date('Y-m-d',strtotime('+1 day'))" />明天
								<elseif condition="$key eq date('Y-m-d',strtotime('+2 day'))" />后天
								<else />
								</if>
							<span>{pigcms{$key}</span>
						</dt>
					</dl>
				</volist>
			</div>
			<div class="yxc-time-con" data-role="timeline">
				<volist name="timeOrder" id="timeOrderInfo">
					<div class="date-{pigcms{$key} timeline" <if condition="$i neq 1">style='display:none'</if> >
					   <volist name="timeOrderInfo" id="vo">
						<dl>
							<dd data-role="item" data-peroid="{pigcms{$vo['time']}" <if condition="$vo['order'] eq 'no' || $vo['order'] eq 'all' ">class="disable"</if>>{pigcms{$vo['time']}<br>
							<if condition="$vo['order'] eq 'no' ">不可预约<elseif condition="$vo['order'] eq 'all' " />已约满<else />可预约</if></dd>
						</dl>
						</volist>
					</div>
				</volist>
            </div>
		</div>
	</section>
	<section id="service-position" style="display:none;">
		<div class="yxc-pay-main yxc-payment-bg pad-bot-comm">
			<header class="yxc-brand">
				<a class="arrow-wrapper" data-role="cancel">
					<i class="bt-brand-back"></i>
				</a>
				<span>选择位置</span>
			</header>
			<div class="selectInput">
				<input type="text" placeholder="直接输入定位您的地址" id="se-input-wd" autocomplete="off"/>
			</div>
			<div class="mapBox">
				<div id="allmap"></div>
				<div class="dot"></div>
			</div>
			<div class="mapaddress">
				<ul id="addressShow"></ul>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script>
	<script type="text/javascript">
		<if condition="$long_lat">
			var user_long={pigcms{$long_lat.long},user_lat={pigcms{$long_lat.lat},user_city='{pigcms{$city_name}';
		<else/>
			var user_long=0,user_city='{pigcms{$city_name}';
		</if>
	</script>
	<script type="text/javascript" src="{pigcms{$static_path}js/appoint_form.js?09"></script>
</body>
</html>