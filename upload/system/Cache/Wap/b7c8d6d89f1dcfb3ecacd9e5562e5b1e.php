<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>编辑收货地址</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    .btn-wrapper {
	        margin: .2rem .2rem;
	        padding: 0;
	    }
	
	    dd>label.react {
	        padding: .28rem .2rem;
	    }
	
	    .kv-line h6 {
	        width: .8rem;
	    }
	</style>  
</head>
<body id="index" data-com="pagecommon">
        <div id="tips" class="tips"></div>
        <form id="form" method="post" action="<?php echo U('My/edit_adress');?>">
        
		    <dl class="list list-in">
		    	<dd>
		    		<dl>
		        		<dd class="dd-padding kv-line">
		        			<h6>姓名:</h6>
		        			<input name="name" type="text" class="kv-v input-weak" placeholder="最少2个字" pattern=".{2,}" data-err="姓名必须大于2个字！" value="<?php echo ($now_adress["name"]); ?>">
		        		</dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>电话:</h6>
		        			<input name="phone" type="tel" class="kv-v input-weak" placeholder="不少于7位" pattern="\d{3}[\d\*]{4,}" data-err="电话必须大于7位！" value="<?php echo ($now_adress["phone"]); ?>">
		        		</dd>
		        		<dd class="dd-padding kv-line">
				            <h6>省份:</h6>
				            <label class="select kv-v">
				                <select name="province">
									<?php if($now_adress): if(is_array($province_list)): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>" <?php if($vo['area_id'] == $now_adress['province']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php else: ?>
										<?php if(is_array($province_list)): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>" <?php if($vo['area_id'] == $now_city_area['area_pid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				                </select>
				            </label>
				        </dd>
				        <dd class="dd-padding kv-line">
				            <h6>城市:</h6>
				            <label class="select kv-v">
				                <select name="city">
									<?php if($now_adress): if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>" <?php if($vo['area_id'] == $now_adress['city']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php else: ?>
										<?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>" <?php if($vo['area_id'] == $now_city_area['area_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				                </select>
				            </label>
				        </dd>
				        <dd class="dd-padding kv-line">
				            <h6>区县:</h6>
				            <label class="select kv-v">
				                <select name="area">
				                    <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>"  <?php if($vo['area_id'] == $now_adress['area']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				                </select>
				            </label>
				        </dd>
		        		<dd class="dd-padding kv-line" id="color-gray">
		        			<h6>位置:</h6>
	                        <i class="icon-location" data-node="icon"></i><span class="color-gray" data-node="addAddress"><?php if(!empty($now_adress['adress'])): echo $now_adress['adress']; else : ?>点击选择位置<?php endif; ?></span> <i class="right_arrow"></i>
	                        <!--div class="weaksuggestion"> 请点击这里，进行添加！<i class="toptriangle"></i> </div-->
		        			<!--textarea name="adress" class="input-weak kv-v" placeholder="最少5个字,最多60个字,不能全部为数字" pattern="^.{5,60}$" data-err="请填写正确的地址信息！"><?php echo ($now_adress["adress"]); ?></textarea-->
		        		</dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>地址:</h6>
		        			<input name="detail" type="text" class="kv-v input-weak" placeholder="请填写详细的地址和门牌号" pattern=".{2,}" data-err="详址必须大于2个字！" value="<?php echo ($now_adress["detail"]); ?>">
		        		</dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>邮编:</h6>
		        			<input type="tel" name="zipcode" class="input-weak kv-v" placeholder="6位邮政编码，可不填写"  maxlength="6" value="<?php if($now_adress['zipcode']): echo ($now_adress["zipcode"]); endif; ?>"/>
		        		</dd>
		        		<dd>
			            	<label class="react">
			                	<input type="checkbox" name="default" value="1" class="mt"  <?php if($now_adress['default']): ?>checked="checked"<?php endif; ?>/>
			              		  设为默认地址
			            	</label>
			        	</dd>
			    	</dl>
		   		</dd>
			</dl>
		    <div class="btn-wrapper">
	    		<input type="hidden" name="adress_id" value="<?php echo ($now_adress["adress_id"]); ?>"/>
				<input type="hidden" name="longitude" value="<?php echo ($now_adress["longitude"]); ?>"/>
				<input type="hidden" name="latitude" value="<?php echo ($now_adress["latitude"]); ?>"/>
				<input type="hidden" name="adress" value="<?php echo ($now_adress["adress"]); ?>"/>
				<button type="submit" class="btn btn-block btn-larger"><?php if($now_adress): ?>保存<?php else: ?>添加<?php endif; ?></button>
		    </div>
		</form>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/jquery.cookie.js"></script> 
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
		<script>
			$(function(){
				$("select[name='province']").change(function(){
					show_city($(this).find('option:selected').attr('value'));
				});
				$("select[name='city']").change(function(){
					show_area($(this).find('option:selected').attr('value'));
				});
				$("#color-gray").click(function(){
					var detail = new Object();
					detail.name = $('input[name="name"]').val();
					detail.province = $('select[name="province"]').val();
					detail.area = $('select[name="area"]').val();
					detail.city = $('select[name="city"]').val();
					detail.defaul = $('input[name="default"]').val();
					detail.detail = $('input[name="detail"]').val();
					detail.zipcode = $('input[name="zipcode"]').val();
					detail.phone = $('input[name="phone"]').val();
					detail.id = $('input[name="adress_id"]').val();
					
					$.cookie("user_address", JSON.stringify(detail));
					location.href = "<?php echo U('My/adres_map', $params);?>";
				});

				
				$('#form').submit(function(){
					$('#tips').removeClass('tips-err').empty();
					var form_input = $(this).find("input[type='text'],input[type='tel'],textarea");
					$.each(form_input,function(i,item){
						if($(item).attr('pattern')){
							var re = new RegExp($(item).attr('pattern'));
							if($(item).val().length == 0 || !re.test($(item).val())){
								$('#tips').addClass('tips-err').html($(item).attr('data-err'));
								return false;
							}
						}

						if(i+1 == form_input.size()){
							layer.open({type:2,content:'提交中，请稍候'});
							$.post($('#form').attr('action'),$('#form').serialize(),function(result){
								layer.closeAll();
								if(result.status == 1){
									<?php if($_GET['referer']): ?>window.location.href="<?php echo (htmlspecialchars_decode($_GET["referer"])); ?>";
									<?php else: ?>
										window.location.href="<?php echo U('My/adress',$params);?>";<?php endif; ?>
								}else{
									$('#tips').addClass('tips-err').html(result.info);
								}
							});
						}
					});
			
					return false;
				});
			});
			function show_city(id){
				$.post("<?php echo U('My/select_area');?>",{pid:id},function(result){
					result = $.parseJSON(result);
					if(result.error == 0){
						var area_dom = '';
						$.each(result.list,function(i,item){
							area_dom+= '<option value="'+item.area_id+'">'+item.area_name+'</option>'; 
						});
						$("select[name='city']").html(area_dom);
						show_area(result.list[0].area_id);
					}
				});
			}
			function show_area(id){
				$.post("<?php echo U('My/select_area');?>",{pid:id},function(result){
					result = $.parseJSON(result);
					if(result.error == 0){
						var area_dom = '';
						$.each(result.list,function(i,item){
							area_dom+= '<option value="'+item.area_id+'">'+item.area_name+'</option>'; 
						});
						$("select[name='area']").html(area_dom);
					}else{
						$("select[name='area']").html('<option value="0">请手动填写区域</option>');
					}
				});
			}
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