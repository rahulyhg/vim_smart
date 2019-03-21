<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <title>公告</title>
    <style>
        img{width:100% !important;}
    </style>
</head>

<body>
<div class="container">
<!--    标题-->
    <h4><strong>{pigcms{$info.title}</strong></h4>
<!--    时间-->
    <h5 class="text-muted">{pigcms{$info.add_time|date="Y-m-d H:i",###}</h5>
<!--    正文-->
    <p>{pigcms{$info.content}</p>
<!--    作者-->
    <if condition="$info['author']">
        <p class="text-right text-muted" ><span>编辑：</span>{pigcms{$info.author}</p>
    </if>


</div>

<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司</div>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>