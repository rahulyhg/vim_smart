<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <title>等待跳转</title>
    <link href="/Home/Public/statics/plublic/css/weui.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="loadingToast">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>
<script>


    var herf = window.location.search;
        //alert("http://car.vhi99.com/"+herf);
    function jumurl(){

        window.location.href = "http://car.vhi99.com/"+herf;

    }

    setTimeout(jumurl,100);


</script>
</body>
</html>