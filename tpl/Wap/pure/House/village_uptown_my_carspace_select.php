<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}hui/css/hui.css" />
    <style type="text/css">
        .userinfo{height:80px; text-align:center; color:#FFF; line-height:80px; font-size:22px; margin:5px; background:#3388FF;}
    </style>
</head>
<body>
<header class="hui-header">
    <div id="hui-back"></div>
    <h1>停车位选择</h1>
</header>
<div id="container" style="margin-top: 60px">
    <foreach name="carspace_list" item="vo">
        <div class="hui-list" style="margin-top:22px;">
            <a href="{pigcms{:U('village_uptown_pay', array('village_id' => $now_village['village_id'], 'type' => 'carspace','carspace_id'=>$vo['pigcms_id']))}" style="height:auto; height:80px; padding-bottom:8px;">
                <div class="hui-list-icons" style="width:110px; height:80px;">
                    <img src="{pigcms{$static_path}images/house/park.png" style="width:66px; margin:0px; border-radius:50%;" />
                </div>
                <div class="hui-list-text" style="height:79px; line-height:79px;">
                    {pigcms{$vo['carspace_number']}
                    <div class="hui-list-info">
                        <span class="hui-icons hui-icons-right"></span>
                    </div>
                </div>
            </a>
            <div class="hui-list-text">
                登记车牌号 : {pigcms{$vo['car_number']} | 泊位费到期时间: {pigcms{$vo['carspace_endtime']}
            </div>
        </div>
    </foreach>
</div>
</div>
</div>
<script type="text/javascript" src="{pigcms{$static_path}hui/js/hui.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}hui/js/hui-picker.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/137/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript">

</script>
</body>
</html>