<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title><?php echo ($now_village["village_name"]); ?></title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>
    <!--<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>-->
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
    <script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
    <link rel="stylesheet" href="<?php echo ($static_public); ?>boxer/css/jquery.fs.boxer.css">
    <!--<script src="<?php echo ($static_public); ?>boxer/js/jquery-1.8.3.min.js"></script>-->
    <script src="<?php echo ($static_public); ?>boxer/js/jquery.fs.boxer.js"></script>
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
        -->
    </style>
</head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        })
    })
</script>
<script>
    $(function(){
        $('.boxer').boxer({
            mobile: true
        });
    });
</script>

<body>
<header class="pageSliderHide"><div id="backBtn"></div>在线报修</header>
<form id="access_form" onSubmit="return false;">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
            <div class="kkw">姓名&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--刘德华--><?php echo ($repair_info["name"]); ?></div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q6.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">工牌号&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--18086681360--><?php echo ($repair_info["usernum"]); ?></div>
            <div class="both"></div>
        </div>
    </div>
    <div class="shtx_dk2">
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q2.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
            <div class="kkw">联系方式&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--武汉微嗨科技有限公司--><?php echo ($repair_info["phone"]); ?>
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q7.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
            <div class="kkw">提交时间&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--技术部--><?php echo (date('Y-m-d H:i:s',$repair_info["time"])); ?></div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
            <div class="kkw">报修地址&nbsp;&nbsp;</div>
            <div class="shtx_kk"><!--广发银行大厦2008--><?php echo ($repair_info["address"]); ?></div>
            <div class="both"></div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_hd weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">报修图片</div>
                    </div>
                    <div class="upload_box">
                        <ul class="upload_list clearfix" id="upload_list">
                            <?php if($repair_info['pic']): $pic=explode('|',$repair_info['pic']) ?>
                                <?php if(is_array($pic)): $k = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><a href="/upload/house/<?php echo ($img); ?>" class="boxer"><li class="upload_item" id="imgShow<?php echo ($k); ?>" style="height:78px;background:url(./upload/house/<?php echo ($img); ?>) 50% 50% / cover;">
                                            <img src="/upload/house/<?php echo ($img); ?>" class="upload_image loading_img" />
                                        </li></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show"><textarea id="description" name="content" readonly="readonly"  placeholder="报修内容" style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;"><?php echo ($repair_info["content"]); ?></textarea></div>
    <!--<div class="zkd">
        <div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" data_status="2" data_idVal="<?php echo ($repair_info["pigcms_id"]); ?>" data_uid="<?php echo ($repair_info["uid"]); ?>">通过</a></div>
        <div style="float:right;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn btn_check" data_status="3" data_idVal="<?php echo ($repair_info["pigcms_id"]); ?>" data_uid="<?php echo ($repair_info["uid"]); ?>">不通过</a></div>
        <div style="clear:both"></div>
    </div>-->
    <div class="zkd"></div>
</form>
</body>
</html>