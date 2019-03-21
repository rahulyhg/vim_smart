<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>选择商家优惠券</title>
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
				width:auto;
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
	<body id="index" data-com="pagecommon">
        <!--header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="<?php echo ($back_url); ?>" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">选择商家优惠券</h1>
            <div class="nav-wrap-right">
                <a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
                    <span class="nav-btn">
                        <i class="text-icon">≋</i>导航
                    </span>
                </a>
            </div>
            <div id="nav-dropdown" class="nav-dropdown">
                <ul>
                    <li><a class="react" href="<?php echo U('Home/index');?>"><i class="text-icon">⟰</i>
                        <space></space>首页</a>
                    </li>
                    <li><a class="react" href="<?php echo U('My/index');?>"><i class="text-icon">⍥</i>
                        <space></space>我的</a>
                    </li>
                    <li><a class="react" href="<?php echo U('Search/index',array('type'=>'group'));?>"><i class="text-icon">⌕</i>
                        <space></space>搜索</a>
                	</li>
                </ul>
            </div>
        </header-->
		<?php if($card_list): ?><div id="tips" class="tips"></div>
			<?php if(is_array($card_list)): $i = 0; $__LIST__ = $card_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="list <?php if($vo['record_id'] == $_GET['card_id']): ?>active<?php endif; ?>">
					<dd class="address-wrapper">
						<a class="react" href="<?php echo ($vo["select_url"]); ?>">
							<div class="address-select"><input class="mt" type="radio" name="addr" <?php if($vo['record_id'] == $_GET['card_id']): ?>checked="checked"<?php endif; ?>/></div>
							<div class="address-container">
								<div class="kv-line">
									<h6>名称：</h6><p><?php echo ($vo["title"]); ?></p>
								</div>
								<div class="kv-line">
									<h6>金额：</h6><p>￥<?php echo ($vo["price"]); ?></p>
								</div>
								<div class="kv-line">
									<h6>有效期：</h6><p><?php echo (date('Y年m月d日',$vo["enddate"])); ?></p>
								</div>
							</div>
						</a>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
			<div id="tips" class="tips" style="display:block;">您没有该商家的优惠券</div><?php endif; ?>
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