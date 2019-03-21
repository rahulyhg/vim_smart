<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>余额提现</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<style>
		.inner {
			-webkit-box-flex: 1;
			-webkit-flex: 1;
			-ms-flex: 1;
			flex: 1;
			background-color: #fff;
			overflow-y: scroll;
			-webkit-overflow-scrolling: touch;
		}
		.inner .item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    -webkit-box-align: center;
    box-align: center;
    -webkit-align-items: center;
    align-items: center;
    padding: 3.125%;
    border-bottom: 1px solid #ddd;
    color: #333;
    text-decoration: none;
}
.inner .item .date {
    display: block;
    height: 20px;
	width: 30%;
    line-height: 20px;
    color: #999;
}
.inner .item h3 {
    display: block;
    flex: 1;
    width: 40%;
    max-height: 40px;
    overflow: hidden;
    line-height: 20px;
    margin: 0 10px;
 
}
	</style>
</head>
<body id="index">
        <if condition="$error">
        	<div id="tips" class="tips tips-err" style="display:block;">{pigcms{$error}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <form id="form" method="post" action="{pigcms{:U('My/withdraw')}">
			<input type="hidden" name="label" value="{pigcms{$_GET.label}"/>
		    <dl class="list">
		        <dd class="dd-padding">
				 <input id="truename" placeholder="请填写真实姓名" class="input-weak" type="text" name="truename" value="{pigcms{$user_info['truename']}"/>
				 </dd>
		        <dd class="dd-padding">
		           
		            <input id="money" placeholder="请填写提现金额" class="input-weak" type="text" name="money" value="{pigcms{$_GET.money}"/>
		        </dd>
		    </dl>
		    <p class="btn-wrapper">金额最多仅支持两位小数,只支持微信提现</p>
		    <p class="btn-wrapper">余额：{pigcms{$user_info['now_money']}</p>
			
		    <div class="btn-wrapper"><button type="submit" class="btn btn-block btn-larger">提现</button></div>
		</form>
		
		<div class="inner">
        <div class="lists">
            <a class="item" href="#">
                <h3>提款金额</h3>
                <span class="date">状态</span>
                <span class="date">日期</span>
            </a>
            <volist name="draw_info" id="vc">
				<a class="item" href="#">
				<h3>{pigcms{$vc['money']/100|round=###,2}</h3>
				<span class="date"><if condition="$vc.status eq 0">审核中<elseif condition="$vc.status eq 1"/><font color="green">已付款</font><else /><font color="red">被驳回</font></if></span>
                <span class="date">{pigcms{$vc.add_time|date='Y-m-d',###}</span>
				</a>
			</volist>
        </div>
		</div>
		<div style="float:right">{pigcms{$pagebar}</div>
	
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>
			$(function(){
				$('#form').on('submit', function(e){
					$('#tips').removeClass('tips-err').hide();
					var money = parseFloat($('#money').val());
					if(isNaN(money)){
						$('#tips').html('请输入合法的提现金额！').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money > {pigcms{$user_info.now_money}){
						$('#tips').html('提现金额不能超过余额').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money < <if condition="C(\'config.company_least_money\')">{pigcms{:C(\'config.company_least_money\')}<else />0.1</if>){
						$('#tips').html('单次提现金额最低不能低于 <if condition="C(\'config.company_least_money\')">{pigcms{:C(\'config.company_least_money\')}<else />0.1</if>元').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}
			    });		
				<if condition="$_GET['label'] && $_GET['money']">
					layer.open({type: 2,content: '自动提交中，请稍等',shadeClose:false});
					$('#form').trigger('submit');
				</if>
			});
		</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>