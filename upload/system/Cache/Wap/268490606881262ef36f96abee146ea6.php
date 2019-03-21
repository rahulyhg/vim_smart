<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>收货地址管理</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    .address-container {
	        font-size: .3rem;
	        -webkit-box-flex: 1;
	    }
	    .kv-line h6 {
	        width: 4em;
	    }
	    .btn-wrapper {
	        margin: .2rem .2rem;
	        padding: 0;
	    }
	
	    .address-wrapper a {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	    }
	
	    .address-select {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	        padding-right: .2rem;
	        -webkit-box-align: center;
	        -webkit-box-pack: center;
	        -moz-box-align: center;
	        -moz-box-pack: center;
	        -ms-box-align: center;
	        -ms-flex-pack: justify;
	    }
	
	    .list.active dd {
	        background-color: #fff5e3;
	    }
	
	    .confirmlist {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	    }
	
	    .confirmlist li {
	        -ms-flex: 1;
	        -moz-box-flex: 1;
	        -webkit-box-flex: 1;
	        height: .88rem;
	        line-height: .88rem;
	        border-right: 1px solid #C9C3B7;
	        text-align: center;
	    }
	
	    .confirmlist li a {
	        color: #2bb2a3;
	    }
	
	    .confirmlist li:last-child {
	        border-right: none;
	    }
	</style>
</head>
<body id="index">
        <div id="tips" class="tips"></div>
        <div class="wrapper btn-wrapper">
		    <a class="address-add btn btn-larger btn-warning btn-block" href="<?php echo U('My/edit_adress',$_GET);?>">添加新地址</a>
		</div>
		<?php if(is_array($adress_list)): $i = 0; $__LIST__ = $adress_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="list <?php if($vo['default']): ?>active<?php endif; ?>">
		        <dd class="address-wrapper <?php if(!$vo['select_url']): ?>dd-padding<?php endif; ?>">
		        	<?php if($vo['select_url']): ?><a class="react" href="<?php echo ($vo["select_url"]); ?>">
		                <div class="address-select"><input class="mt" type="radio" name="addr" <?php if($vo['adress_id'] == $_GET['current_id']): ?>checked="checked"<?php endif; ?>/></div><?php endif; ?>
			            <div class="address-container">
			                <div class="kv-line">
			                    <h6>姓名：</h6><p><?php echo ($vo["name"]); ?></p>
			                </div>
			                <div class="kv-line">
			                    <h6>手机：</h6><p><?php echo ($vo["phone"]); ?></p>
			                </div>
			                <div class="kv-line">
			                    <h6>省市：</h6><p><?php echo ($vo["province_txt"]); ?> <?php echo ($vo["city_txt"]); ?></p>
			                </div>
			                <div class="kv-line">
			                    <h6>地址：</h6><p><?php echo ($vo["area_txt"]); ?> <?php echo ($vo["adress"]); ?> <?php echo ($vo["detail"]); ?></p>
			                </div>
							<?php if($vo['zipcode']): ?><div class="kv-line">
									<h6>邮编：</h6><p><?php echo ($vo["zipcode"]); ?></p>
								</div><?php endif; ?>
			            </div>
			        <?php if($vo['select_url']): ?></a><?php endif; ?>
		        </dd>
		        <dd>
	                <ul class="confirmlist">
	                    <li><a class="react" href="<?php echo ($vo["edit_url"]); ?>">编辑</a></li><li><a class="react mj-del" href="<?php echo ($vo["del_url"]); ?>">删除</a></li>
	                </ul>
		        </dd>
		    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script>
			$(function(){
				$('.mj-del').click(function(){
					var now_dom = $(this);
					if(confirm('您确定要删除此地址吗？')){
						$.post(now_dom.attr('href'),function(result){
							if(result.status == '1'){
								now_dom.closest('dl').remove();
							}else{
								alert(result.info);
							}
						});
					}
					return false;
				});
				$('.address-wrapper input.mt').click(function(){
					window.location.href = $(this).closest('a').attr('href');
				});
			});
		</script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        

<?php echo ($hideScript); ?>
</body>
</html>