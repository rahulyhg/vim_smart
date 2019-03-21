<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title><?php echo ($now_village["village_name"]); ?></title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
    <script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
    <!--<script type="text/javascript" src="<?php echo ($static_path); ?>js/imgUploadControl.js" charset="utf-8"></script>-->
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/zepto.min.js" charset="utf-8"></script>
    <script src="<?php echo ($static_public); ?>boxer/js/jquery.fs.boxer.js"></script>
    <link rel="stylesheet" href="<?php echo ($static_public); ?>boxer/css/jquery.fs.boxer.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
.kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
.shtx_kkt {float:left; line-height:33px; border:0; height:33px; font-size:14px; margin-left:8px; color:#b6b6b6;}
.shtx_tyr {
    float: left;
    line-height: 26px;
    border: 0;
    height: 33px;
    font-size: 14px;
    margin-left: 8px;
    width: 65%;
}
.kdw2 {width:90%; margin:0px auto; padding-bottom:30px;}
.shtx_kkb {
    float: left;
    line-height: 33px;
    border: 0;
    font-size: 14px;
    margin-left: 8px;
    width: 65%;
    color: #b6b6b6;
    white-space:nowrap;
    text-overflow:ellipsis;
    -o-text-overflow:ellipsis;
    overflow: hidden;
}
.weui_cell {
	padding-bottom:0px;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}
.jju {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#fb4746; color:#FFFFFF; margin-top:3px;}
.jju:hover {float:left; border-radius:10px; width:80px; height:25px; text-align:center; line-height:25px; background-color:#e12322; color:#FFFFFF; margin-top:3px;}
-->
</style></head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });

        $('.boxer').boxer({
            mobile: true
        });
        $('.weui_btn_warn').click(function(){
            window.history.go(-1);
        })

    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>访客信息</header>
<form id="access_form" onSubmit="return false;" >
<!--  <input  name=log_id" type="hidden" value="<?php echo ($log_info['log_id']); ?>"/>-->
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
			<div class="kkw">姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华--><?php echo ($log_info["name"]); ?></div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q7.jpg" style="width:12px; height:12px; margin-top:11px;"/></div>
            <div class="kkw">开门时间&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527--><?php echo (date('Y-m-d H:i:s',$log_info["opdate"])); ?></div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q2.jpg" style="width:10px; height:13px; margin-top:10px; margin-left:1px; margin-right:1px;"/></div>
            <div class="kkw">联系方式&nbsp;&nbsp;</div>
            <div class="shtx_kkt"><?php echo ($log_info["phone"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<a href="tel:<?php echo ($log_info["phone"]); ?>" style="color:#fb4746;"><div class="jju"><span style="float:left; margin-right:5px; margin-top:2px; margin-left:6px;"><img src="<?php echo ($static_path); ?>images/ip7.png" style="width:12px; height:12px;"/></span><span style="float:left;">点击拨号</span></div></a>
            <div class="both"></div>
        </div>

    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
			<div class="kkw">设备名称&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉微嗨科技有限公司--><?php echo ($log_info["ac_name"]); ?>
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q4.jpg" style="width:10px; height:14px; margin-top:9px; margin-left:1px; margin-right:2px;"/></div>
			<div class="kkw">公司名称&nbsp;&nbsp;</div>
            <div class="shtx_kkb"><!--技术部--><?php echo ($log_info["company_name"]); ?></div>
            <div class="both"></div>
        </div>
    </div>

    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/fww.png" style="width:11px; height:9px; margin-top:12px; margin-right:1px;"/></div>
            <div class="kkw">证件类型&nbsp;&nbsp;</div>
            <div class="shtx_kk"><?php if($log_info["card_type"] == 1): ?>现场审核<?php endif; if($log_info["card_type"] == 2): ?>门禁卡<?php endif; if($log_info["card_type"] == 3): ?>身份证<?php endif; if($log_info["card_type"] == 4): ?>工作牌<?php endif; ?></div>
            <div class="both"></div>
        </div>

        <?php if($log_info["card_type"] != 1 and $log_info["card_type"] != 4): ?><div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q6.jpg" style="width:12px; height:11px; margin-top:11px;"/></div>
            <div class="kkw">证件号&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--9527--><?php echo ($log_info["usernum"]); ?></div>
            <div class="both"></div>
        </div><?php endif; ?>

        <?php if($log_info["card_type"] != 1): ?><div class="weui_cellj">
			<div class="weui_cell_bd weui_cell_primary">
				<div class="weui_uploader">
					<div class="weui_uploader_hd weui_cell">
						<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/lrr.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
						<div class="shtx_tyr">证件照（正面）</div>

						<div class="both"></div>
					</div>
					<!--<div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                            <li class="weui_uploader_file" style="background:url(http://www.hdhsmart.com/tpl/Wap/pure/static/images/1.jpg)"></li>
                        </ul>
                        <div class="weui_uploader_input_wrp" id="upload_list">
                            <input class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple id="fileImage" name=""/>
                        </div>
                    </div>-->
					<div style="padding-bottom:5px;">
					<div class="upload_box">
                        <ul class="upload_list clearfix" id="upload_list">
                            <?php if($log_info['workcard_img']): $workcard_img=explode('|',$log_info['workcard_img']) ?>
                                <?php if(is_array($workcard_img)): $k = 0; $__LIST__ = $workcard_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><a href="/upload/house/<?php echo ($img); ?>" class="boxer">
                                        <li class="upload_item" id="imgShow<?php echo ($k); ?>" style="height:78px;background:url(./upload/house/<?php echo ($img); ?>) 50% 50% / cover;">
                                            <img src="/upload/house/<?php echo ($img); ?>" class="upload_image loading_img" />
                                        </li>
                                    </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
					</div>
					</div>
				</div>
			</div>
		</div><?php endif; ?>
    </div>
    <div class="kdw2"><a href="javascript:;" class="weui_btn weui_btn_warn eww">返 回</a></div>
</form>

</body>
</html>