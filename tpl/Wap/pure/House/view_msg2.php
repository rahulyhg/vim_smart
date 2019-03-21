<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>武汉汇得行物业服务有限公司</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
</head>
<body>
<div style="width:100%; height:46px; line-height:46px; text-align:center; font-size:18px; color:#FFFFFF; background-color:#fb4746;">{pigcms{$msg_info['title']}</div>
<div style="padding:10px">
    <!--<p style="color:#666">{pigcms{$msg_info.create_time|date="Y-m-d H:i",###}</p>-->
    <br>
    <div style="color:#777">
        {pigcms{$msg_info['content']|htmlspecialchars_decode=ENT_QUOTES}
    </div>
</div>
</body>
</html>