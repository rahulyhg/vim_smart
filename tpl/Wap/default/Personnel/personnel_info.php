<html>
<head>
    <meta charset="utf-8">
    <title>人事待办列表</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="{pigcms{$static_path}css/safety/bd.css" rel="stylesheet" type="text/css">
    <link href="{pigcms{$static_path}css/shui/weui.min.css" rel="stylesheet" type="text/css">
    <script src="{pigcms{$static_path}js/express/jquery.min.js"></script>
    <style type="text/css">
        <!--
        .weui-cells {
            margin-top: 0;
        }
        .weui-cells:after, .weui-cells:before {left:15px;}
        select {
            appearance:none;
            -moz-appearance:none;
            -webkit-appearance:none;
        }
        .weui-cells:after {border-bottom:none;}

        /*清除ie的默认选择框样式清除，隐藏下拉箭头*/
        select::-ms-expand { display: none; }
        .weui-vcode-btn {color: #2093fc;}
        .weui-vcode-btn:active {color: #1883e5;}
        -->
        .table_left{
            border: 1px #e5e5e5 solid;
            color: #0e7fe6;
            font-weight:bold;
            height:30px;
            line-height:30px;
            border-top:none;
            border-left:none;
        }
        .table_right{
            border: 1px #e5e5e5 solid;
            border-top:none;
            height:30px;
            line-height:30px;
            text-align:center;
            border-left:none;
            font-size:14px;
        }
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body style="background-color:#f7f6f9;">
<div class="zw">
    <div class="width p25" >
        <div class="kk2">
            <div class="width p25">
                <div >
                    <table width="100%" border="0px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                        <tr>
                            <th width="50%" class="table_left">姓名</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['name']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">身份证号</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['id_number']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">联系电话</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['phone']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">所属部门</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['department_name']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">入职时间</th>
                            <th width="50%" class="table_right">{pigcms{:date('Y年m月d日',$personnel_info['entrytime'])}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">转正时间</th>
                            <th width="50%" class="table_right">{pigcms{:date('Y年m月d日',$personnel_info['positivetime'])}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">社保缴纳时间</th>
                            <th width="50%" class="table_right">{pigcms{:date('Y年m月d日',$personnel_info['social_addtime'])}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">社保情况</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['social_condition']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">公积金缴纳时间</th>
                            <th width="50%" class="table_right">{pigcms{:date('Y年m月d日',$personnel_info['accumulation_addtime'])}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">公积金缴纳金额</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['accumulation_money']}</th>
                        </tr>
                        <tr>
                            <th width="50%" class="table_left">推荐人</th>
                            <th width="50%" class="table_right">{pigcms{$personnel_info['induction_channel']}</th>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!--<script type="text/javascript">
        function changeurl(){
            var time=$('#time_select').val();
            window.location.href="{pigcms{:U('Personnel/personnel_list')}&time="+time;
        }
    </script>-->
</body>
</html>