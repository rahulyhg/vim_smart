<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>汇得行物业集团</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo ($static_path); ?>js/weui.min.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {text-indent:0px;}
img {
width:100%;
height:auto;
}
.bq {width:100%; height:30px; overflow:hidden; line-height:30px; text-align:center; color:#c5c5c5; padding-top:40px; font-size:12px;}
-->
</style></head>
<body>
<div style="width:100%;height:46px; line-height:46px; text-align:center; font-size:18px; color:#FFFFFF; background-color:#ff586c;"><?php echo ($msg_info['title']); ?></div>
<div style="padding:10px;width: 95%; margin:0px auto;">
    <!--<p style="color:#666"><?php echo (date("Y-m-d H:i",$msg_info["create_time"])); ?></p>-->
    <br>
    <div style="color:#777; width:100%;">
        <?php echo (htmlspecialchars_decode($msg_info['content'],ENT_QUOTES)); ?>
    </div>
</div>
<div class="bq"><img src="../tpl/Wap/default/static/images/bq.png" style="width:40%; height:auto;"></div>
<script>
    /*$('img').on('click',function(){
        //去src属性
        var item = $(this)[0].src;
        if(!item) return false;

        var imgUrl = item;
        weui.gallery(imgUrl);
        $('.weui-gallery__del').remove();
        $('.weui-gallery span').html('');
    });*/
</script>
</body>
</html>