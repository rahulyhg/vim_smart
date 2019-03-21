<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>二维码批量打印</title>
    <link href="./static/PropertyService/css/style.css" rel="stylesheet" type="text/css" />
    <style>

        body
        {
            zoom:50%;
        }
        .jl {
            width: 100px;
            height: 72px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
            word-wrap:break-word;
        }
        .jt{
            /*border-collapse: separate;
            border-spacing: 0px 24px;*/
            width: 360px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
            table-layout:fixed;
        }
        .jk-s {
            width: 240px;
            font-size: 30px;
            color: #444444;
            font-weight: bold;
            margin-bottom: 38px;
            word-wrap:break-word;
        }

        /*body
        {
            zoom:50%;
        }
        .jl {
            width: 120px;
            height: 72px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
        }
        .jt{
            !*border-collapse: separate;
            border-spacing: 0px 24px;*!
            width: 360px;
            font-size: 36px;
            color: #444444;
            font-weight: bold;
        }
        .jk-s {
            width: 240px;
            font-size: 30px;
            color: #444444;
            font-weight: bold;
            margin-bottom: 38px;
        }*/
    </style>
</head>
<!-- ../images/x5.jpg 210 297 650/x = 210/297 297*650/210-->

<body style="width:2000px">



<volist name="data" id="row">
    <div class="rwm" style="width: 435px;height: 445px;">
        <img src="{pigcms{$row.adress}" style="width:100%;hegith:100%;margin:0 auto" />
    </div>

</volist>
<div style="clear:both"></div>



<script>
    // print.portrait = false;
    print();
</script>
</body>
</html>