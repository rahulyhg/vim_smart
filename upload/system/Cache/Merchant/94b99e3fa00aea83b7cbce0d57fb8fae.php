<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script>

<link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.css" type="text/css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>layer/skin/layer.ext.css" type="text/css">
<script type="text/javascript" charset="utf-8" src="<?php echo ($static_path); ?>layer/layer.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script>

<!-- ace scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script>

<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script>
<style type="text/css">
.jqstooltip {
	position: absolute;
	left: 0px;
	top: 0px;
	visibility: hidden;
	background: rgb(0, 0, 0) transparent;
	background-color: rgba(0, 0, 0, 0.6);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
	color: white;
	font: 10px arial, san serif;
	text-align: left;
	white-space: nowrap;
	padding: 5px;
	border: 1px solid white;
	z-index: 10000;
}

.jqsfield {
	color: white;
	font: 10px arial, san serif;
	text-align: left;
}

.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
	display: none;
}

#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
	{
	font-size: 12px;
	color: black;
	display: none;
	width: 100%;
}
</style>
<script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>

</head>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default">	<div class="navbar-container" id="navbar-container">		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">			<span class="sr-only">Toggle sidebar</span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>			<span class="icon-bar"></span>		</button>		<div class="navbar-header pull-left">			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 				<small> 					<img src="<?php echo ($config["site_merchant_waplogo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 商家中心				</small>			</a>		</div>		<div class="navbar-buttons navbar-header pull-right" role="navigation">			<ul class="nav ace-nav">				<!--li class="red">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 						<span class="badge badge-important">0</span>					</a>					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单						</li>						<li class="dropdown-footer">							<a href="#">查看全部未处理订单 								<i class="ace-icon fa fa-arrow-right"></i>							</a>						</li>					</ul>				</li>				<li class="green">					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 						<span class="badge badge-success">0</span>					</a>							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">						<li class="dropdown-header">							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新留言							</a>						</li>						<li>							<a href="#">								有<span style="color: red;">0</span>条新评论							</a>						</li>						<li></li>					</ul>				</li-->				<li class="light-blue">					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 						<?php if($merchant_session['img_info']): ?><img class="nav-user-photo" src="<?php echo ($merchant_session["img"]); ?>" alt="Jason&#39;s Photo" />						<?php else: ?>						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /><?php endif; ?>						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 						<i class="ace-icon fa fa-caret-down"></i>					</a>					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">						<li>							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">								<i class="ace-icon fa fa-link"></i> 网站首页							</a>						</li>						<!--li>							<a href="#">								<i class="ace-icon fa fa-share-alt"></i> 推荐好友							</a>						</li-->						<li>							<a href="<?php echo U('Config/merchant');?>">								<i class="ace-icon fa fa-user"></i> 商家设置							</a>						</li>						<li>							<a href="Cashier/merchants.php?m=Index&c=login&a=index&type=merchant" target="_blank">								<i class="ace-icon fa fa-user"></i> 商家收银							</a>						</li>						<!--li>							<a href="<?php echo U('Pay/index');?>"> 								<i class="ace-icon fa fa-smile-o"></i> 对帐平台							</a>						</li-->						<li class="divider"></li>						<li>							<a href="<?php echo U('Login/logout');?>"> 								<i class="ace-icon fa fa-power-off"></i> 退出							</a>						</li>					</ul>				</li>			</ul>		</div>	</div></div>
	<div class="main-container" id="main-container">
	<div id="sidebar" class="sidebar responsive">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="<?php echo U('Config/merchant');?>" title="商家设置">
				<i class="ace-icon fa fa-gear"></i>
			</a>&nbsp;
			<a class="btn btn-info" href="<?php echo U('Meal/index');?>" title="<?php echo ($config["meal_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-cubes"></i>
			</a>&nbsp;
			<a class="btn btn-warning" href="<?php echo U('Group/index');?>" title="<?php echo ($config["group_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-desktop"></i>
			</a>&nbsp;
			<a class="btn btn-danger" href="<?php echo U('Customer/fans_list');?>" title="粉丝管理"> 
				<i class="ace-icon fa fa-group"></i>
			</a>
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>
			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list" style="top: 0px;">
		<?php if(is_array($merchant_menu)): $i = 0; $__LIST__ = $merchant_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["style_class"]); ?>">
				<a <?php if($vo['menu_list']): ?>href="#" class="dropdown-toggle"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>> 
					<i class="menu-icon fa <?php echo ($vo["icon"]); ?>"></i>
					<span class="menu-text"><?php echo ($vo["name"]); ?></span>
					<?php if($vo['menu_list']): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
				</a>
				<b class="arrow"></b>
				<?php if($vo['menu_list']): ?><ul class="submenu">
						<?php if(is_array($vo['menu_list'])): $i = 0; $__LIST__ = $vo['menu_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li <?php if($voo['is_active']): ?>class="active"<?php endif; ?>>
								<a href="<?php echo ($voo["url"]); ?>"> 
									<i class="menu-icon fa fa-caret-right"></i> <?php echo ($voo["name"]); ?>
								</a>
								<b class="arrow"></b>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>

<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-credit-card"></i>
                <a href="<?php echo U('Promote/discountSpead');?>">优惠劵推广</a>
            </li>
            <li class="active">添加优惠券</li>
        </ul>
    </div>
    <!-- 内容头部 -->
     <link href="./tpl/Merchant/default/static/css/weui.css" rel="stylesheet" type="text/css" />
     <style type="text/css">
    #Recharge {text-decoration:none;color: #fff;}
    #Recharge:hover{color: #fff;}

     </style>
  
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <div class="tab-content">
                        <div class="grid-view">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>优惠名称</label></label>
                                    <input type="text" class="col-sm-3" name="name" value="<?php echo ($vip["ds_name"]); ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠类别</label></label>
                                    <div class="radio">
                                        <label>
                                            <input name="ds_type" value="0" type="radio" <?php if($vip['ds_type'] == '0' or $vip['ds_type'] == ''): ?>checked="checked"<?php endif; ?>>
                                            <span class="lbl" style="z-index: 1">抵用券</span>
                                        </label>
                                        <label>
                                            <input name="ds_type" value="1" type="radio" <?php if($vip['ds_type'] == '1'): ?>checked="checked"<?php endif; ?>>
                                            <span class="lbl" style="z-index: 1">折扣</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums" class="youhui">优惠金额</label><label for="canrqnums" style="display:none;" class="zhekou">优惠折扣</label></label>
                                    <div class="radio" style="margin-left: 20px;">
                                        <span><input type="text"   id="have" onkeypress="if((event.keyCode<48||event.keyCode>57) && event.keyCode!=46){alert('只能输入数字和小数点');return false;}" style="width: 80px;text-align: center;"  class="px"  value="<?php echo ($vip["ds_scale"]); ?>" name="ds_scale" style="width:50px;">&nbsp;&nbsp;<span class="youhui">元</span><span class="zhekou" style="display:none;">折&nbsp;&nbsp;<span style="color: red;">(填写的折扣必须在0-1之间，小数点后面不得大于两位数)</span></span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="adress">优惠时间</label></label>
                                    <input type="text" class="hasDatepicker" id="statdate" atime="<?php echo ($vip["statdate"]); ?>" value="<?php echo (date('Y-m-d',$vip["statdate"])); ?>" onClick="WdatePicker()" name="statdate" />
                                    到
                                    <input type="text" class="hasDatepicker" id="enddate" atime="<?php echo ($vip["enddate"]); ?>" value="<?php echo (date('Y-m-d',$vip["enddate"])); ?>" name="enddate" onClick="WdatePicker()"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="">限制优惠金额</label></label>
                                    <input type="number" class="" id="ds_minmoney" value="<?php echo (($vip["ds_minmoney"])?($vip["ds_minmoney"]):'0'); ?>"  name="ds_minmoney" />
                                    到
                                    <input type="number" class="" id="ds_maxmoney" value="<?php echo ($vip["ds_maxmoney"]); ?>" name="ds_maxmoney" />
                                </div>
                                <div class="form-group couponpic" style="margin-bottom:35px;display:none;">
                                    <label class="col-sm-3"><label for="AutoreplySystem_img">上传优惠券图片</label></label>
                                </div>
                                <div class="form-group couponpic" style="width:417px;padding-left:140px;">
                                    <label class="ace-file-input">
										<span class="ace-file-container" data-title="选择" onclick="upyunPicUpload('pic',720,200,'card')">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
                                    </label>
                                    <div><img style="width:417px;height:150px;border: 0;" id="pic_src" src="<?php if($vip["ds_img"] == '' and $vip["type"] == 1): ?>/static/images/cart_info/youhui.jpg<?php elseif($vip["ds_img"] == '' and $vip["type"] == 0): ?>/static/images/cart_info/youhui.jpg<?php else: echo ($vip["ds_img"]); endif; ?>"></div>
                                    <input type="hidden" name="pic" id="pic" value="<?php if($vip["ds_img"] == '' and $vip["type"] == 1): ?>/static/images/cart_info/youhui.jpg<?php elseif($vip["ds_img"] == '' and $vip["type"] == 0): ?>/static/images/cart_info/youhui.jpg<?php else: echo ($vip["ds_img"]); endif; ?>" />
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;"></span>推广URL</label></label>
                                    <input type="url" class="col-sm-3" required name="ds_url" value="<?php echo ($vip["ds_url"]); ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="endinfo">优惠描述</label></label>
                                    <textarea  class="col-sm-3" id="info" name="info"  style="height:125px" ><?php echo ($vip["ds_description"]); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">优惠总金额</label>
                                    <div class="radio" style="margin-left: 20px;margin-top: -10px;">
                                        <span><input type="number"<?php if($disid): ?>readonly<?php endif; ?> id="zong" style="width: 100px;text-align: center;"  class="px"  value="<?php echo ($vip["ds_money"]); ?>" name="ds_money" style="width:50px;">&nbsp;&nbsp;元</span>
                                        <span>当前余额<input type="text" name="money" value="<?php echo ($money); ?>元" style="border:none;background:white!important;" readonly="readonly"/>&nbsp;<a href="<?php echo U('Promote/recharge');?>" class="weui_btn weui_btn_mini weui_btn_primary" id="Recharge">账户充值</a> </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="canrqnums">优惠范围</label></label>
                                    <div class="radio" style="margin-left: 15px;margin-top: -3px;">
                                        <label>
                                            <input name="ds_scope" value="0" type="radio" <?php if($vip['ds_scope'] == '0' or $vip['ds_scope'] == ''): ?>checked="checked"<?php endif; ?>>
                                            <span class="lbl" style="z-index: 1">全站</span>
                                        </label>
                                        <label>
                                            <input name="ds_scope" value="1" type="radio" <?php if($vip['ds_scope'] == '1'): ?>checked="checked"<?php endif; ?>>
                                            <span class="lbl" style="z-index: 1">会员</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit" id="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>

<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="./static/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="./static/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
//        判断其编辑
        var ds_type = "<?php echo ($vip['ds_type']); ?>";
        if(ds_type=="1"){
            $(".youhui").hide();
            $(".zhekou").show();
        }else{
            $(".youhui").show();
            $(".zhekou").hide();
        }
        //	选择优惠类别
        $('input[name=ds_type]').click(function(){
            if($(this).val()=="1"){
                $(".youhui").hide();
                $(".zhekou").show();
            }else{
                $(".youhui").show();
                $(".zhekou").hide();
            }
        });
        function get_unix_time(dateStr)
        {
            var newstr = dateStr.replace(/-/g,'/');
            var date =  new Date(newstr);
            var time_str = date.getTime().toString();
            return time_str.substr(0, 10);
        }
        $("#statdate").blur(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
            }
        });
        $("#enddate").blur(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
            var disid = "<?php echo ($disid); ?>";
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
            }
        })
		$("#zong").blur(function(){
            var ds_money=$('input[name=ds_money]').val();
            var money=$('input[name=money]').val();
            if(!disid){
                if(parseFloat(ds_money)>parseFloat(money)){
                    layer.msg("不能超出当前余额!",{icon:0});
                }
            }
        })
        $("#submit").click(function(){
            var statdate = get_unix_time($('input[name=statdate]').val());
            var enddate = get_unix_time($('input[name=enddate]').val());
            var name = $.trim($('input[name=name]').val());
            var ds_minmoney = $.trim($('input[name=ds_minmoney]').val());
            var ds_maxmoney = $.trim($('input[name=ds_maxmoney]').val());
            var ds_type = $('input[name=ds_type]:checked').val();
            var youhui = $("#have").val();
            var zong = $("#zong").val();
            var pic = $.trim($('input[name=pic]').val());
            var atime = (enddate-statdate)/(3600*24)*100;
			var ds_money=$('input[name=ds_money]').val();
            var money=$('input[name=money]').val();
            if(name==""){
                layer.msg("优惠名称必须填写",{icon:0});
                return false;
            }
            if(ds_minmoney!=""){
                if(ds_minmoney<0){
                    layer.msg("金额最小限制不能小于0",{icon:0});
                    return false;
                }
            }
            if(pic==""){
                layer.msg("请上传图片",{icon:0});
                return false;
            }
            if(atime<=0){
                layer.msg("您选择的时间有误",{icon:0});
                return false;
            }
            if(zong==""){
                layer.msg("总金额不能为空",{icon:0});
                return false;
            }
            if(parseFloat(youhui)>parseFloat(zong)){
                layer.msg("总金额必须大于优惠金额",{icon:0});
                return false;
            }
            if(ds_maxmoney>0){
                if(parseFloat(ds_maxmoney)<parseFloat(youhui)){
                    layer.msg("金额最大限制不能小于优惠金额！",{icon:0});
                    return false;
                }
                if(parseFloat(ds_maxmoney)<parseFloat(ds_minmoney)){
                    layer.msg("金额最大限制不能小于最小金额！",{icon:0});
                    return false;
                }
            }
            if(ds_type=="1"){
                if(youhui>1){
                    layer.msg("优惠折扣不能大于1",{icon:0});
                    return false;
                }
            }
            var disid = "<?php echo ($disid); ?>";
            if(!disid){
                if(parseFloat(ds_money)>parseFloat(money)){
                    layer.msg("优惠总金额不可大于商户余额",{icon:0});
                    return false;
                }
            }
            $("#need").val(atime);
            var have = parseInt($("#have").val());
            var need = parseInt($("#need").val());
            if(have<need){
                $("#nuzu").show();
            }else{
                $("#nuzu").hide();
            }
            $(form).submit();
        })

    });
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#info', {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
            items : [
                'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
                '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image','emoticons', 'link', 'unlink']
        });
    });
</script>
	<div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;">
		<div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;">
			<b>新订单来啦!</b> <a class="oaright" href="javascript:closeoa()">[关闭]</a>
		</div>
		<div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div>
		<div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div>
		<div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a>
		</div>
	</div>
	<div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> 
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div>

<script>
function newalert(title){
	bootbox.dialog({
		message: title, 
		buttons: {
			"success" : {
				"label" : "确认",
				"className" : "btn-sm btn-primary"
			}
		}
	});
}

function alertshow(content){
	$('#popalertwindowcontent').html(content);
	$('#popalertwindow').show();
}
setInterval(function(){
	$.post("<?php echo U('Index/ping');?>");
},60000);

</script>

<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow">
	<div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div>
	<div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;">
		<div style="height: 40px;"></div>
		<div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;">
			<table style="width: 400px; height: 90px;">
				<tbody>
					<tr>
						<td id="popalertwindowcontent"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 20px;"></div>
		<div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div>
	</div>
</div>
</body>
</html>