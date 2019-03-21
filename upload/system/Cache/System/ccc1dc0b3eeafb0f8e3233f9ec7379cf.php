<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>" />

		<title>网站后台管理</title>

		<script type="text/javascript">

			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}

			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;

 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";

		</script>

		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/employeeStyle.css" />

		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>

	    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script><!--控制图片放大-->

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>

		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>

	</head>

	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
	<form id="myform" method="post" action="<?php echo U('Merchant/amend');?>" frame="true" refresh="true">
		<input type="hidden" name="mer_id" value="<?php echo ($merchant["mer_id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">商户帐号</th>
				<td><div class="show"><?php echo ($merchant["account"]); ?></div></td>
			</tr>
			<tr>
				<th width="80">商户密码</th>
				<td><input type="password" id="check_pwd" check_width="180" check_event="keyup" class="input fl" name="pwd" value="" size="25" placeholder="不修改则不填写！" validate="minlength:6" tips="不修改则不填写！"/></td>
			</tr>
			<tr>
				<th width="80">商户名称</th>
				<td><input type="text" class="input fl" name="name" value="<?php echo ($merchant["name"]); ?>" size="25" placeholder="商户的公司名或..." validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">联系电话</th>
				<td><input type="text" class="input fl" name="phone" value="<?php echo ($merchant["phone"]); ?>" size="25" placeholder="联系人的电话" validate="required:true" tips="多个电话号码以空格分开"/></td>
			</tr>
			<tr>
				<th width="80">联系邮箱</th>
				<td><input type="text" class="input fl" name="email" value="<?php echo ($merchant["email"]); ?>" size="25" placeholder="可不填写" validate="email:true" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">所在区域</th>
				<td id="choose_cityarea" province_id="<?php echo ($merchant["province_id"]); ?>" city_id="<?php echo ($merchant["city_id"]); ?>" area_id="<?php echo ($merchant["area_id"]); ?>" circle_id="-1"></td>
			</tr>
			<tr>
				<th width="80">商户状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['status'] == 1): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="status" value="1" <?php if($merchant['status'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($merchant['status'] != 1): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="status" value="0" <?php if($merchant['status'] != 1): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">线下支付</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['is_close_offline'] == 0): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="is_close_offline" value="0" <?php if($merchant['is_close_offline'] == 0): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($merchant['is_close_offline'] == 1): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="is_close_offline" value="1" <?php if($merchant['is_close_offline'] == 1): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">签约商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['issign'] == 1): ?>selected<?php endif; ?>"><span>是</span><input type="radio" name="issign" value="1" <?php if($merchant['issign'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable  <?php if($merchant['issign'] != 1): ?>selected<?php endif; ?>"><span>否</span><input type="radio" name="issign" value="0"  <?php if($merchant['issign'] != 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<em class="notice_tips" tips="开启后商家中心会显示此商家已签约标签即商家是优质客户，所有新增的产品都无需审核"></em>
				</td>
			</tr>
			<tr>
				<th width="80">认证商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['isverify'] == 1): ?>selected<?php endif; ?>"><span>是</span><input type="radio" name="isverify" value="1" <?php if($merchant['isverify'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($merchant['isverify'] != 1): ?>selected<?php endif; ?>"><span>否</span><input type="radio" name="isverify" value="0"  <?php if($merchant['isverify'] != 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<em class="notice_tips" tips="开启后商家中心会显示此商家已认证标签"></em>
				</td>
			</tr>
			<tr>
				<th width="80">使用公众号</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['is_open_oauth'] == 1): ?>selected<?php endif; ?>"><span>允许</span><input type="radio" name="is_open_oauth" value="1" <?php if($merchant['is_open_oauth'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($merchant['is_open_oauth'] == 0): ?>selected<?php endif; ?>"><span>禁止</span><input type="radio" name="is_open_oauth" value="0" <?php if($merchant['is_open_oauth'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">开微店</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($merchant['is_open_weidian'] == 1): ?>selected<?php endif; ?>"><span>允许</span><input type="radio" name="is_open_weidian" value="1" <?php if($merchant['is_open_weidian'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($merchant['is_open_weidian'] == 0): ?>selected<?php endif; ?>"><span>禁止</span><input type="radio" name="is_open_weidian" value="0" <?php if($merchant['is_open_weidian'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">平台抽成比例</th>
				<td><input type="text" class="input fl" name="percent" value="<?php echo ($merchant["percent"]); ?>" size="5" placeholder="0" tips="平台根据商家的总销售额获取的一定比例的抽成，设置为0则取系统设置的比例"/></td>
			</tr>
			<tr>
				<th width="80">平台积分</th>
				<td><input type="text" class="input fl" name="plat_score" value="<?php echo ($merchant["plat_score"]); ?>" size="10" placeholder="0" tips="平台积分"/></td>
			</tr>
			<tr><th colspan="2" style="color: red;text-align:center"> 超级广告设置 </th></tr>
			<tr>
				<th width="80">首页宣传状态</th>
				<td>
					<select name="share_open" class="valid">
					<option value="0" <?php if($merchant['share_open'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
					<option value="1" <?php if($merchant['share_open'] == 1): ?>selected="selected"<?php endif; ?>>开启显示商家信息</option>
					<option value="2" <?php if($merchant['share_open'] == 2): ?>selected="selected"<?php endif; ?>>开启跳转到商家微网站</option>
					</select>
				</td>
			</tr>
			<tr>
				<th width="80">广告语</th>
				<td><input type="text" class="input fl" name="a_title" value="<?php echo ($home_share["title"]); ?>" size="25" placeholder="可不填写" tips="粉丝看到自己的第一次进入本站来自哪个商家的店铺"/></td>
			</tr>
			<tr>
				<th width="80">进入提示语</th>
				<td><input type="text" class="input fl" name="a_name" value="<?php echo ($home_share["a_name"]); ?>" size="5" placeholder="可不填写" tips="提示粉丝进入的提示语言"/></td>
			</tr>
			<tr>
				<th width="80">进入网址</th>
				<td><input type="text" class="input fl" name="a_href" value="<?php echo ($home_share["a_href"]); ?>" size="60" placeholder="可不填写" tips="跳转到指定地方的网址"  validate="url:true"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>