<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!--[if IE 6]>
		<script src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="<?php echo ($static_path); ?>js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.v113ea197.css" />
	<style>
		html{background-color:white;}
		body{font-size:12px;background-color:white;}
		.erro_tips{margin-top:40px;text-align:center;}
		.address-list label{margin-left:3px;line-height:36px;zoom:1;}
		.address-list .selected{background:#FEF5E7;}
		.address-list li{padding-left:10px;}
	</style>
</head>
<body>
	<?php if($error_msg): ?><div class="erro_tips"><?php echo ($error_msg); ?></div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script>
			$(function(){
				window.parent.change_adress_frame($('#address-list').height());
				});
		</script>	
	<?php else: ?>
		<ul class="address-list" id="address-list">
			<?php if(is_array($adress_list)): $i = 0; $__LIST__ = $adress_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="selected"<?php endif; ?>>
					<input class="select-radio" type="radio" name="adress_id" autocomplete="off" id="address_<?php echo ($vo["adress_id"]); ?>" value="<?php echo ($vo["adress_id"]); ?>" <?php if($i == 1): ?>checked="checked"<?php endif; ?> />
					<label class="detail" for="address_<?php echo ($vo["adress_id"]); ?>" adress_id="<?php echo ($vo["adress_id"]); ?>" username="<?php echo ($vo["name"]); ?>" phone="<?php echo ($vo["phone"]); ?>" province_txt="<?php echo ($vo["province_txt"]); ?>" city_txt="<?php echo ($vo["city_txt"]); ?>" area_txt="<?php echo ($vo["area_txt"]); ?>" zipcode="<?php echo ($vo["zipcode"]); ?>"><?php echo ($vo["name"]); ?>，<?php echo ($vo["province_txt"]); ?> <?php echo ($vo["city_txt"]); ?> <?php echo ($vo["area_txt"]); ?> <?php echo ($vo["adress"]); ?>，<?php echo ($vo["zipcode"]); ?>，<?php echo ($vo["phone"]); ?></label>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script>
			$(function(){
				window.parent.change_adress_frame($('#address-list').height());
				
				var first_obj = $('#address-list li label').eq(0);
				window.parent.change_adress(first_obj.attr('adress_id'),first_obj.attr('username'),first_obj.attr('phone'),first_obj.attr('province_txt'),first_obj.attr('city_txt'),first_obj.attr('area_txt'),first_obj.attr('zipcode'));
				
				$('#address-list li label').click(function(){
					if(!$(this).closest('li').hasClass('selected')){
						$(this).closest('li').addClass('selected').siblings('li').removeClass('selected');
						window.parent.change_adress($(this).attr('adress_id'),$(this).attr('username'),$(this).attr('phone'),$(this).attr('province_txt'),$(this).attr('city_txt'),$(this).attr('area_txt'),$(this).attr('zipcode'));
					}
				});
			});
		</script><?php endif; ?>
</body>
</html>