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
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
    <script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
        .weui_btn:hover {color:#FFFFFF;}
        .item-list-container {
            display: block;
            background: #fff;
            margin-bottom: 8px;
            padding-bottom:10px;
            color: #696969;
            font-size: 13px;
        }
        .item-list-container:link {background-color:#eeeff4;}
        .item-list-container:visited {background-color:#eeeff4;}
        .item-list-container:active {background-color:#eeeff4;}
        .item-list-container:hover {background-color:#eeeff4;}

        .item-detail {
            width:100%;
        }
        .item-operation {
            float: right;
            margin-right:1%;
            margin-left:2%;
            color: #aaa;
            text-align:right;
        }
    </style></head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });
    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>新闻评论</header>
<?php if(is_array($reply_list)): $i = 0; $__LIST__ = $reply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item-list-container">
            <div class="item-detail">
                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">新闻title：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> <?php echo ($vo["title"]); ?></span></div>
                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">评论内容：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> <?php echo ($vo["content"]); ?></span></div>
                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">评论人：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> <?php echo ($vo["nickname"]); ?></span></div>
                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">回复时间：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> <?php echo (date('Y-m-d',$vo["add_time"])); ?> <?php echo (date('H:i:s',$vo["add_time"])); ?></span></div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>