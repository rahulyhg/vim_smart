<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/datePicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/common1.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/color1.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/nav.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>meal/css/mobiscroll_min.css" media="all">
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/jquery_min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/mobiscroll_min.js"></script>
<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>meal/js/info.js?t=1"></script>
<title><?php echo ($store['name']); ?></title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<!-- Mobile Devices Support @begin -->
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!-- Mobile Devices Support @end -->

</head>
<body onselectstart="return true;" ondragstart="return false;">
<script>
    var config = { 
        table_fee:0,//包房服务费 0 不需要  大于是需要包房费 
        dishes_status:<?php echo ($is_reserve); ?>,//0新增预订 1先点菜后预订位置下一步操作 2修改预订  
        order_sn:'',
        utype:1,
        businessHours:[{"stime":"00:00","etime":"23:59"}],//营业时间  
        editInfo:{"date":"<?php echo ($date); ?>", "time":"<?php echo ($time); ?>", "tel":"<?php echo ($user_info['phone']); ?>", "name":"<?php echo ($user_info['name']); ?>", "sex":null, "seattype":'<?php echo ($seattype); ?>', "mark":""},//修改预订信息
        postURL: "<?php echo U('Food/saveorder', array('mer_id' => $mer_id, 'store_id' => $store_id));?>",//ajax发送路径
        max_seat_num:50,
        seat_num_default:2
    }; 
</script>
<div data-role="container" class="container bookinfo">
    <header data-role="header">	
    </header>
    <section data-role="body">
        <div class="info">
		<?php if(!empty($totalmoney) AND $totalnum > 0): ?><div class="line icons">
                <span>购买情况</span>
                <label><?php echo ($totalnum); ?>份商品，共<strong style="color:#FF4907"><?php echo ($totalmoney); ?></strong>元</label>
			</div><?php endif; ?>
			<?php if(!empty($level_off) AND $finaltotalprice > 0): ?><div class="line icons">
                <span>会员等级： <strong style="color:#FF4907"><?php echo ($level_off['lname']); ?></strong></span>
                <label><?php echo ($level_off['offstr']); ?> &nbsp;&nbsp;&nbsp;惠后共<strong style="color:#FF4907"><?php echo ($finaltotalprice); ?></strong>元</label>
				</div><?php endif; ?>
			<?php if($is_reserve == 1): ?><div class="line icons">
                <i></i>
                <span>预约日期</span>
                <label><input class="select date" name="date" type="text" placeholder="请选择就餐日期" readonly="" id="mobiscroll1432347110712" value=""></label>						
            </div>
            <div class="line icons time">
                <i></i>
                <span>预约时间</span>
                <label id="select_time"><input class="select datetime" name="time" type="text" placeholder="请选择就餐时间" readonly="" id="mobiscroll1432347110713" value="10:11"></label>
            </div><?php endif; ?>
            <div class="line icons num">
                <i></i>
                <span>预约人数</span>
                <label>
                    <div class="ui_select">
                        <span id="input_num">2</span>
                          <select name="num" id="select_num" class="">
                          <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option></select>
                    </div>                        
               </label>						
            </div>
            <div class="line icons status">
                <i></i>
                <span>选择桌位</span>
                 <label>
                    <div class="ui_select">
                        <span id="input_type">不限</span>
                         <select name="seat" class="type" id="select_type">
                         	<?php if(is_array($tables)): $i = 0; $__LIST__ = $tables;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><option value="<?php echo ($table['pigcms_id']); ?>" selected=""><?php echo ($table['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            <option value="0">不限</option>
                        </select>
                    </div>
                </label>							
            </div>
            <?php if($store['deposit'] > 0 AND false): ?><div class="line name">
            	<div class="paytypediv">
                    <label><input type="radio" name="isdeposit" value="1" <?php if($is_reserve == 1): ?>checked="checked"<?php endif; ?> class="">支付定金【<?php echo ($store['deposit']); ?>元】</label>
                    <?php if($is_reserve == 0): ?><label><input type="radio" name="isdeposit" value="0" checked="checked" class="">全额支付</label><?php endif; ?>
                </div>
            </div><?php endif; ?>
        </div>
        
        <div class="info">
            <div class="line">
                <input type="tel" name="tel" id="tel" placeholder="请输入您的手机号码" value="<?php echo ($user_info['phone']); ?>">
            </div>
			<?php if($is_reserve == 1): ?><div class="line">
                <input type="text" name="address" id="address" placeholder="请输入您的地址" value="<?php echo ($user_info['adress']); ?>">
            </div><?php endif; ?>
            <div class="line name">
                <input type="text" placeholder="请输入您的姓名" name="name" id="name" value="<?php echo ($user_info['name']); ?>">
                <div class="sexdiv">							
                    <label><input type="radio" name="sex" value="0" id="sex" class="">女士</label>	
                    <label><input type="radio" name="sex" value="1" checked="checked" class="">先生</label>
                </div>						
            </div>
            <div class="line textarea">
                <textarea name="remark" placeholder="您的其他需求说明" id="mark"></textarea>
            </div>
        </div>
    </section>
    <footer data-role="footer">	
        <nav class="g_nav">
            <div>
            	<?php if($deposit == 0): ?><a class="green left" id="pre" href="<?php echo U('Food/shop', array('mer_id' => $mer_id, 'store_id' => $store_id));?>"><label>上一步</label></a>
            	<?php else: ?>
                <a class="green left" id="pre" href="<?php echo U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id));?>"><label>上一步</label></a><?php endif; ?>
                <a class="orange right" onclick="submit_F()" id="next"><label>下一步</label></a>
            </div>				
        </nav>
    </footer>
</div>
<?php if($kf_url): ?><div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
	<a id="enter_im" data-url="<?php echo ($kf_url); ?>">
	<div id="to_user_list">
	<div id="to_user_list_icon_div" class="rel left">
	<em class="to_user_list_icon_em_a abs">&nbsp;</em>
	<em class="to_user_list_icon_em_b abs">&nbsp;</em>
	<em class="to_user_list_icon_em_c abs">&nbsp;</em>
	<em class="to_user_list_icon_em_d abs">&nbsp;</em>
	<em id="to_user_list_icon_em_num" class="hide abs">0</em>
	</div>
	<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
	</div>
	</a>
</div>

<script type="text/javascript">
	$(function(){
		var mousex = 0, mousey = 0;
		var divLeft = 0, divTop = 0, left = 0, top = 0;
		document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
			e.preventDefault();
			var offset = $(this).offset();
			divLeft = parseInt(offset.left,10);
			divTop = parseInt(offset.top,10);
			mousey = e.touches[0].pageY;
			mousex = e.touches[0].pageX;
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
			event.preventDefault();
			left = event.touches[0].pageX-(mousex-divLeft);
			top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
			if(top < 1){
				top = 1;
			}
			if(top > $(window).height()-(50+$(this).height())){
				top = $(window).height()-(50+$(this).height());
			}
			if(left + $(this).width() > $(window).width()-5){
				left = $(window).width()-$(this).width()-5;
			}
			if(left < 1){
				left = 1;
			}
			$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
			return false;
		});
		document.getElementById("enter_im_div").addEventListener('touchend', function(event){
			if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
				var url = $('#enter_im').attr('data-url');
				if (url == '' || url == null) {
					alert('商家暂时还没有设置客服');
				} else {
					location.href=$('#enter_im').attr('data-url');
				}
			}
			return false;
		});

		$('#enter_im_div').click(function(){
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		});
	});
</script><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
<?php echo ($hideScript); ?>
</body>
</html>