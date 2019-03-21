<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><?php echo ($config["seo_title"]); ?></title>
	<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
	<?php if($config['wap_redirect']): ?><script>
			if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
				<?php if($config['wap_redirect'] == 1): ?>window.location.href = './wap.php';
				<?php else: ?>
					if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
						window.location.href = './wap.php';
					}<?php endif; ?>
			}
		</script><?php endif; ?>
    <!--[if IE 6]>
		<script src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="<?php echo ($static_path); ?>js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.v113ea197.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/base.v492b572b.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/search-box.v6656b683.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/cate-nav.v4299f875.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/slides.v30fdb768.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/side.v4cfd6eb1.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/deallist.v49c087a6.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/floor.v9bda7972.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/index-slider.v7062a8fb.css" />
	<link rel="shortcut icon" href="<?php echo ($config["site_url"]); ?>/favicon.ico">
	<script src="<?php echo C('JQUERY_FILE');?>"></script>
	<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	   var group_index_sort_url="<?php echo U('Index/group_index_sort');?>";
	  </script>
	<script src="<?php echo ($static_path); ?>js/common.js"></script>
	<script src="<?php echo ($static_path); ?>js/index.js"></script>
</head>
<body id="index" class="pg-floor">
	<header id="site-mast" class="site-mast">
		<div class="site-mast__user-nav-w">
	<div class="site-mast__user-nav cf">
		<ul class="basic-info">
			<li class="user-info cf">
				<?php if(empty($user_session)): ?><a rel="nofollow" class="user-info__login" href="<?php echo U('Index/Login/index');?>">登录</a>
					<a rel="nofollow" class="user-info__signup" href="<?php echo U('Index/Login/reg');?>">注册</a>
				<?php else: ?>
					<p class="user-info__name growth-info growth-info--nav">
						<span>
							<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
						</span>
						<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
					</p><?php endif; ?>
            </li>
			<li class="mobile-info__item dropdown">
				<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
				<div class="dropdown-menu dropdown-menu--app">
					<a class="app-block" href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">
						<span class="app-block__title">访问微信版</span>
						<span class="app-block__content" style="background:url(<?php echo ($config["wechat_qrcode"]); ?>);background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo ($config["wechat_qrcode"]); ?>',sizingMethod='scale');"></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="site-mast__user-w">
			<li class="user-orders">
                <a href="<?php echo U('User/Index/index');?>" rel="nofollow">我的订单</a>
            </li>
			<li class="dropdown dropdown--account">
				<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="<?php echo U('User/Index/index');?>">
					<span>我的信息</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<ul id="J-my-account-menu" class="dropdown-menu dropdown-menu--text dropdown-menu--account account-menu">
					<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
				</ul>
			</li>
			<li class="dropdown dropdown--history">
				<a id="J-my-history-toggle" rel="nofollow" class="dropdown__toggle" href="javascript:void(0)">
					<span>最近浏览</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<div id="J-my-history-menu" class="dropdown-menu dropdown-menu--deal dropdown-menu--history"></div>
			</li>
			<li id="J-site-merchant" class="dropdown dropdown--merchant">
				<a class="dropdown__toggle dropdown__toggle--merchant" href="javascript:void(0)">
					<span>我是商家</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<div class="dropdown-menu dropdown-menu--text dropdown-menu--merchant">
					<ul>
						<li><a rel="nofollow" class="dropdown-menu__item" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a rel="nofollow" class="dropdown-menu__item" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php if($index_top_adver): ?><div class="yui3-widget mt-slider">
		<div class="J-hub J-banner-newtop ui-slider common-banner common-banner--newtop common-banner--floor log-mod-viewed J-banner-stamp-active mt-slider-content">
			<ul class="common-banner__sheets mt-slider-sheet-container">
				<?php if(is_array($index_top_adver)): $i = 0; $__LIST__ = $index_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="common-banner__sheet cf mt-slider-sheet mt-slider-current-sheet" style="<?php if($i == 1): ?>opacity:1;<?php else: ?>opacity:0;display:none;<?php endif; ?>">
						<div class="color color--left" style="background:<?php echo ($vo["bg_color"]); ?>;"></div>
						<div class="color color--right" style="background:<?php echo ($vo["bg_color"]); ?>"></div>
						<a class="common-banner__link" target="_blank" href="<?php echo ($vo["url"]); ?>">
							<img src="<?php echo ($vo["pic"]); ?>" width="980" height="60" alt="<?php echo ($vo["name"]); ?>"/>
						</a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<a href="javascript:void(0)" class="common-close common-close--small close" title="关闭">关闭</a>
			<ul class="trigger ui-slider__triggers ui-slider__triggers--translucent ui-slider__triggers--small mt-slider-trigger-container">
				<?php if(is_array($index_top_adver)): $i = 0; $__LIST__ = $index_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="trigger-item mt-slider-trigger <?php if($i == 1): ?>mt-slider-current-trigger<?php endif; ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div><?php endif; ?>
<div class="site-mast__branding cf">
	<div class="site_logo" style="float:left;margin-top:25px;">
		<a href="<?php echo ($config["site_url"]); ?>"><img src="<?php echo ($config["site_logo"]); ?>" alt="<?php echo ($config["site_name"]); ?>" title="<?php echo ($config["site_name"]); ?>" style="width:190px;height:60px;"/></a>
	</div>
	<div class="component-search-box">
		<div class="J-search-box search-box ">
			<form action="<?php echo U('Meal/Search/index');?>" class="search-box__form J-search-form" name="searchForm" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="search-box__tabs-container">
					<span class="tri"></span>
					<ul class="J-search-box__tabs search-box__tabs">
						<li class="search-box__tab J-search-box__tab--meal search-box__tab--current"><?php echo ($config["meal_alias_name"]); ?></li>
						<li class="search-box__tab J-search-box__tab--group"><?php echo ($config["group_alias_name"]); ?></li>
					</ul>
				</div>
				<input tabindex="1" type="text" name="w" autocomplete="off" class="s-text search-box__input J-search-box__input" value="" placeholder="请输入商品名称、地址等"/>
				<input type="submit" class="s-submit search-box__button" hidefocus="true" value="搜&nbsp;&nbsp;索"  data-mod="sr"/>
			</form>
			<div class="J-search-box__hot search-box__hot log-mod-viewed">
				<div class="s-hot" id="J-deal-hot-query">	
					<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="hot-link <?php if($i == 1): ?>hot-link--first<?php endif; ?>" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
	</div>
	<a class="site-commitment">
		<span class="commitment-item"><i class="F-glob F-glob-commitment-retire"></i>随时退</span>
		<span class="commitment-item"><i class="F-glob F-glob-commitment-free"></i>不满意免单</span>
		<span class="commitment-item"><i class="F-glob F-glob-commitment-expire"></i>过期退</span>
	</a> 
</div>
		<div class="site-mast__site-nav-w">
			<div class="site-mast__site-nav">
				<div class="site-mast__site-nav-inner">
					<div class="component-cate-nav">
						<span class="mt-cates">全部分类</span>
						<div class="cate-nav">
							<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="J-nav-item">
									<div class="cate-nav__item">
										<div class="nav-level1 <?php if($k == 1): ?>nav-level1--first<?php endif; ?>">
											<dl <?php if($vo['cat_count'] > 1): ?>class="nav-level1-inner"<?php endif; ?>>
												<dt>
													<a class="nav-level1__label" href="<?php echo ($vo["url"]); ?>" hidefocus="true" target="_blank"><?php echo ($vo["cat_name"]); ?></a>
												</dt>
												<?php if($vo['cat_count'] > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><dd class="nav-level1__item">
															<a class="bribe" href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a>
														</dd><?php endforeach; endif; else: echo "" ;endif; endif; ?>
											</dl>
											<?php if($vo['cat_count'] > 1): ?><i class="nav-level2-indication F-glob F-glob-caret-right-small"></i><?php endif; ?>
										</div>
										<?php if($vo['cat_count'] > 1): ?><div class="nav-level2 J-nav-level2" style="visibility:visible;top:0px;display:none;">
												<a class="nav-level2-label" href="<?php echo ($vo["url"]); ?>" hidefocus="true" target="_blank"><?php echo ($vo["cat_name"]); ?></a>
												<div class="nav-level2-tile nav-level2-tile--first">
													<div class="nav-level2-inner">
														<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="nav-level2__item <?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
													</div>
												</div>
											</div><?php endif; ?>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<nav>
						<ul class="navbar cf">
							<?php if(is_array($web_index_slider)): $i = 0; $__LIST__ = $web_index_slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="navbar__item-w"><a class="navbar__item" href="<?php echo ($vo["url"]); ?>" hidefocus="true"><span class="nav-label"><?php echo ($vo["name"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</nav>
					<a target="_blank" href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" class="nav-inner__side"></a>
				</div>
			</div>
		</header>
		
		<div class="site-wrapper cf">
			<div class="site-wrapper__content">
				<div class="fs site-fs J-site-fs__content">
					<div class="content__cell content__cell-small content__cell--hot">
						<h3 class="label"><i class="F-glob F-glob-hot"></i><span>热门<?php echo ($config["group_alias_name"]); ?></span></h3>
						<div class="filter-strip log-mod-viewed">
							<ul class="filter-strip__list">
								<?php if(is_array($hot_group_category)): $i = 0; $__LIST__ = $hot_group_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank" <?php if($vo['is_hot']): ?>class="hot"<?php endif; ?>><?php echo ($vo["cat_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="content__cell content__cell-small content__cell--geo J-filter__geo">
						<h3 class="label"><i class="F-glob F-glob-position"></i><span>全部区域</span></h3>
						<div class="filter-strip log-mod-viewed">
							<a href="<?php echo ($group_category_all); ?>" class="filter-strip__all J-geo-more" target="_blank">更多<span class="tri"></span></a>
							<ul class="filter-strip__list">
								<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["area_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="content__cell  content__cell-small content__cell--area">
						<h3 class="label"><i class="F-glob F-glob-shangquan"></i><span>热门商圈</span></h3>
						<div class="filter-strip log-mod-viewed">
							<ul class="filter-strip__list">
								<?php if(is_array($hot_circle_list)): $i = 0; $__LIST__ = $hot_circle_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["area_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="content__cell content__cell--slider">
						<div class="component-index-slider">
							<div class="index-slider ui-slider log-mod-viewed">
								<div class="pre-next">
									<a style="display:none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous" ></a>
									<a style="display:none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a>
								</div>
								<div class="head ccf">
									<h2><span class="icon F-glob F-glob-star"></span>最新<?php echo ($config["group_alias_name"]); ?></h2>
									<ul class="trigger-container ui-slider__triggers mt-slider-trigger-container">
										<?php if(is_array($new_group_list)): $i = 0; $__LIST__ = $new_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i%2 == 1): ?><li class="mt-slider-trigger <?php if($i == 1): ?>mt-slider-current-trigger<?php endif; ?>" style="margin:0 0 0 8px;"></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<ul class="content">
									<li class="cf">
										<?php if(is_array($new_group_list)): $i = 0; $__LIST__ = $new_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="<?php if($i%2 == 1): ?>left<?php else: ?>right<?php endif; ?>">
												<?php if($i%2 == 1): ?><span class="slide__side--left"></span><?php endif; ?>
												<em class="J-discount discount"><?php echo ($vo["discount"]); ?></em>
												<a class="link ccf" target="_blank" href="<?php echo ($vo["url"]); ?>"><img class="img" width="366" height="220" src="<?php echo ($vo["list_pic"]); ?>"/></a>
												<div class="title">
													<span class="slide__split--line"></span>
													<a class="xtitle link ccf" target="_blank" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["merchant_name"]); ?></a>
													<p class="desc"><?php echo ($vo["s_name"]); ?></p>
												</div>
												<span class="price">¥<strong><?php echo ($vo["price"]); ?></strong></span>
												<?php if($i%2 == 0): ?><span class="slide__side--right"></span><?php endif; ?>
											</div>
											<?php if($i%2 == 0 && count($new_group_list) > $i): ?></li><li class="cf" style="display:none;"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
									</li>
								</ul>
							</div>
						</div> 
					</div>
				</div>
				<div class="hots J-hub log-mod-viewed">
					<div class="label">
						<a class="logo" target="_blank" href="<?php echo ($group_category_all); ?>"></a>
					</div>
					<div class="yui3-widget mt-slider">
						<div class="deals J-hots-deals mt-slider-content">
							<div class="reco-slides J-option-content">
								<ul class="reco-slides__slides mt-slider-sheet-container">
									<li class="mt-slider-sheet mt-slider-current-sheet">
										<?php if(is_array($index_sort_group_list)): $i = 0; $__LIST__ = $index_sort_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="hotdeal <?php if($i%4 == 0): ?>hotdeal--last<?php endif; ?>" group-id="<?php echo ($vo["group_id"]); ?>">
												<a href="<?php echo ($vo["url"]); ?>" target="_blank"><img src="<?php echo ($vo["list_pic"]); ?>" width="207" height="127" alt="<?php echo ($vo["s_name"]); ?>"/></a>
												<a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["s_name"]); ?>" class="f1 hotdeal__title" target="_blank"><?php echo ($vo["s_name"]); ?></a>
												<div class="hotdeal__detail">
													<strong class="f4 price">¥<?php echo ($vo["price"]); ?></strong>
													<?php if($vo['wx_cheap']): ?><span class="f1 description">微信购买立减¥<?php echo ($vo["wx_cheap"]); ?></span><?php endif; ?>
												</div>
											</div>
											<?php if($i%4 == 0 && count($index_sort_group_list) > $i): ?></li><li class="mt-slider-sheet" style="display:none;"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
									</li>
								</ul>
								<a href="javascript:void(0)" hidefocus="true" class="reco-slides__roll reco-slides__roll--blacksquare reco-slides__roll--blacksquare--previous mtdisable" style="opacity:0;"></a>
								<a href="javascript:void(0)" hidefocus="true" class="reco-slides__roll reco-slides__roll--blacksquare reco-slides__roll--blacksquare--next mtdisable" style="opacity:0;"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="floors cf">
					<div class="mall mall--3cols J-mall J-hub">
						<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><div class="category-floor">
									<div class="category-floor__head">
										<?php if(count($vo['category_list']) > 1): ?><ul class="sub-categories">
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li class="sub-categories__cell <?php if($j == 6): ?>sub-categories__cell--last<?php endif; ?>">
														<a target="_blank" href="<?php echo ($voo["url"]); ?>" class="link"><?php echo ($voo["cat_name"]); ?></a>
													</li><?php endforeach; endif; else: echo "" ;endif; ?>
												<li class="sub-categories__cell sub-categories__cell--all">
													<a target="_blank" href="<?php echo ($vo["url"]); ?>" class="link">全部<span class="arrow"></span></a>
												</li>
											</ul><?php endif; ?>
										<a class="title" href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["cat_name"]); ?></a>
									</div>
									<div class="category-floor__body cf">
										<?php if(is_array($vo['group_list'])): $i = 0; $__LIST__ = $vo['group_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><div class="deal-tile--br deal-tile <?php if($i%3 == 0): ?>deal-tile--even<?php endif; ?>" group-id="<?php echo ($voo["group_id"]); ?>">
												<a href="<?php echo ($voo["url"]); ?>" class="deal-tile__cover" hidefocus="true" target="_blank">
													<img  width="314" height="192" class="J-webp" alt="<?php echo ($voo["s_name"]); ?>" src="<?php echo ($voo["list_pic"]); ?>" />
													<span class="good-img-wrap">
														<span class="range-area">
															<span class="range-bg"></span>
															<span class="range-desc"><img class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']));?>"/>微信扫码 手机查看</span>
														</span>
													</span>
													<span class="deal-mark">
														<?php if($voo['tuan_type'] == 1): ?><span class="deal-mark__item deal-mark__item--voucher" title="代金券">代金券</span><?php endif; ?>
													</span>
												</a>
												<h3 class="deal-tile__title">
													<a href="<?php echo ($voo["url"]); ?>" class="w-link" title="<?php echo ($voo["s_name"]); ?>"  hidefocus="true" target="_blank">
														<span class="xtitle">【<?php echo ($voo["prefix_title"]); ?>】<?php echo ($voo["merchant_name"]); ?></span>
														<span class="short-title"><?php echo ($voo["group_name"]); ?></span>
													</a>
												</h3>
												<p class="deal-tile__detail">
													<span class="price">¥<strong><?php echo ($voo["price"]); ?></strong></span>
													<span class="value"><?php if($voo['tuan_type'] == 2): ?>零售价<?php else: ?>门店价<?php endif; ?><del class="num"><span>¥</span><?php echo ($voo["old_price"]); ?></del></span>
													<?php if($voo['wx_cheap']): ?><span class="wx_cheap_span">微信购买立减¥<?php echo ($voo["wx_cheap"]); ?></span><?php endif; ?>
												</p>
												<div class="deal-tile__extra">
													<p class="extra-inner">
														<span class="sales">已售<strong class="num"><?php echo ($voo['sale_count']+$voo['virtual_num']); ?></strong></span>
														<?php if($voo['reply_count']): ?><a href="<?php echo ($voo["url"]); ?>#anchor-reviews" class="rate-info" hidefocus="true" target="_blank">
																<span class="rate-info__bar common-rating">
																	<span class="rate-stars" style="width:<?php echo ($voo['score_mean']/5*100); ?>%;"></span>
																</span>
																<span class="rate-info__count"><?php echo ($voo["reply_count"]); ?>次评价</span>
															</a>
														<?php else: ?>
															<span class="rate-info rate-info--noreviews">暂无评价</span><?php endif; ?>
													</p>
												</div>
											</div><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="category-floor__foot" data-mtnode="Acategory">
										<a href="<?php echo ($vo["url"]); ?>" target="_blank" class="link"><span>更多<?php echo ($vo["cat_name"]); echo ($config["group_alias_name"]); ?>，请点击查看<i class="link__icon"></i></span></a>
									</div>
								</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div> 
				</div>
			</div>
            <div class="J-hub elevator-wrapper" style="display:none;">
                <ul class="elevator">
					<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><li class="elevator__floor <?php switch($i): case "2": ?>xiuxianyule<?php break; case "3": ?>dianying<?php break; case "4": ?>jiudian<?php break; case "5": ?>shenghuo<?php break; case "6": ?>wanggou<?php break; case "7": ?>jiankangliren<?php break; case "8": ?>lvyou<?php break; default: ?>meishi<?php endswitch;?>">
								<a class="link" hidefocus="true">
									<span><?php echo ($vo["cat_name"]); ?></span>
								</a>
							</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div> 
			<div class="site-wrapper__side">
				<?php if($index_right_adver): ?><div class="side__block side__activity">
	        			<div class="lottery">
	            			<ul class="lotter__slider-container J-hub">
	            				<?php if(is_array($index_right_adver)): $i = 0; $__LIST__ = $index_right_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="slider" >
					                <a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["name"]); ?>">
					                	<img src="<?php echo ($vo["pic"]); ?>" width="206" height="159" />
					                </a>
					            </li><?php endforeach; endif; else: echo "" ;endif; ?>
	            			</ul>
	       				</div>
	        		</div><?php endif; ?>
       			<div class="side-extension side-extension--history">
       				<div class="side-extension__item side-extension__item--last log-mod-viewed">
       					<h3><a href="javascript:;" class="clear-history J-clear">清空</a>最近浏览</h3>
       					<ul class="history-list J-history-list"></ul>
       				</div>
       			</div>
            </div>
		</div>
	</div>
	<!-- bd end -->
	<style>.holy-reco{width:980px;margin:0 auto;padding-bottom:20px;_display:none}.holy-reco__content{border:1px solid #E8E8E8;border-top:0;padding:10px;background:#FFF}.holy-reco__content a{display:inline-block;color:#666;font-size:12px;padding:0 5px;line-height:16px;white-space:nowrap;width:85px;overflow:hidden;text-overflow:ellipsis}</style>
	<div class="component-holy-reco">
		<div class="J-holy-reco holy-reco">
			<div>
				<ul class="ccf cf nav-tabs--small">
					<li class="J-holy-reco__label current"><a href="javascript:void(0)" class="tab-item">友情链接</a></li>
				</ul>
			</div>
			<div class="J-holy-reco__content holy-reco__content">
				<?php if(is_array($flink_list)): $i = 0; $__LIST__ = $flink_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["info"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
		<footer class="site-info-w">
	    <div class="site-info">
	        <div class="copyright">
	            <p>&copy;<span>2015</span>&nbsp;<a href="<?php echo ($config["site_url"]); ?>"><?php echo ($config["site_name"]); ?></a>&nbsp;<?php echo ($config["top_domain"]); ?>&nbsp;<?php if(!empty($config['site_icp'])): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo ($config["site_icp"]); ?></a><?php endif; ?></p>
	        </div>
	    </div>
		<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
	</footer>
</body>
</html>