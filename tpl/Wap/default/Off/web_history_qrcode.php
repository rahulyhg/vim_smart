<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>历史记录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/village.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/weui.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/kui.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        table {
            width: 100%;
            font-size: .938em;
            border-collapse: collapse;/*边框会合并为一个单一的边框*/
        }

        /*th {*/
            /*text-align: left;*/
            /*padding: .5em .5em;*/
            /*font-weight: bold;*/
            /*background: #66677c;color: #fff;*/
        /*}*/

        /*td {*/
            /*padding: .5em .5em;*/
            /*border-bottom: solid 1px #ccc;*/
        /*}*/

        table,table tr th, table tr td { border:1px solid #0094ff; }/*设置边框的*/
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body>
<div style="height: 10px;"></div>
<if condition="$hello eq 1" >
    <h3 style="text-align: center;">暂无记录</h3>
    <else />
    <table style="width: 98%;">
        <tr>
            <th style="width: 24%;height: 30px;text-align: center;line-height: 30px;">姓名</th>
            <th style="width: 38%;height: 30px;text-align: center;line-height: 30px;">开始时间</th>
            <th style="width: 38%;height: 30px;text-align: center;line-height: 30px;">结束时间</th>
        </tr>
        <foreach name="transmitArr" item="vo">
            <tr>
                <td style="width: 24%;height: 30px;text-align: center;line-height: 30px;" >{pigcms{$vo.tt_name}</td>
                <td style="width: 38%;height: 30px;text-align: center;line-height: 30px;" >{pigcms{$vo.s_date}</td>
                <td style="width: 38%;height: 30px;text-align: center;line-height: 30px;" >{pigcms{$vo.e_date}</td>
            </tr>
        </foreach>
        <tr>
            <td style="width: 24%;height: 30px;text-align: center;line-height: 30px;" >{pigcms{$new_name}</td>
            <td style="width: 38%;height: 30px;text-align: center;line-height: 30px;" >{pigcms{$new_date}</td>
            <td style="width: 38%;height: 30px;text-align: center;line-height: 30px;" >/</td>
        </tr>
    </table>
</if>

<div class="zkd">

    <div ><a class="weui_btn weui_btn_primary" href="{pigcms{:U('Off/products_qr_detail',array('pro_qrcode'=>$pro_qrcode))}"  >返回</a></div>
    <br />
    <div ><a class="weui_btn weui_btn_primary" id="close_window"  >关闭</a></div>

    <div style="clear:both"></div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>

    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    };

</script>
</body>
</html>