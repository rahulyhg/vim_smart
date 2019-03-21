<html>
<head>
    <meta charset="utf-8">
    <title>巡更日报表</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="{pigcms{$static_path}css/safety/bd.css" rel="stylesheet" type="text/css">
    <link href="{pigcms{$static_path}css/shui/weui.min.css" rel="stylesheet" type="text/css">

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
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body style="background-color:#f7f6f9;">
<div class="zw">
    <div class="tb">巡更记录表 -- {pigcms{$village_name}</div>
    <div class="kk">
        <div class="zw">
            <div class="width p20">
                <div class="dkk">
                    <div class="width">
                        <div class="nu">{pigcms{$nowPointCount}</div>
                        <div class="nu2">当天已巡更点位数</div>
                        <div class="nu3">
                            <div class="re">
                                <div class="width">
                                    <div class="jk">{pigcms{$safetyPoint}</div>
                                    <div class="jk2">正常</div>
                                </div>
                            </div>
                            <div class="re2">
                                <div class="width">
                                    <div class="jk">{pigcms{$warningPoint}</div>
                                    <div class="jk2">异常</div>
                                </div>
                            </div>
                            <div class="both"></div>
                        </div>
                    </div>
                </div>
                <div class="dkk2">
                    <div class="width">
                        <div class="nu">{pigcms{$lowPoint}</div>
                        <div class="nu2">当天未巡更点位数</div>
                        <div class="nu3">
                            <div class="re3">
                                <div class="width">
                                    <div class="jk3">巡更日期</div>
                                    <div class="jk4">{pigcms{$date['day']}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="both"></div>
            </div>
        </div>
    </div>

    <div class="kk2">
        <div class="width p25">

            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group" style="line-height:32px; color:#999999; padding-bottom: 5px;">
                        过去7天的巡更情况
                    </div>
                </div>
            </div>
            <div id="didida">
                <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                    <tr>
                        <th width="36%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">巡更日期</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">已巡更</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">未巡更</th>
                        <th width="24%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">巡更人</th>
                    </tr>
                    <foreach name="week_pointRecord" item="vo">
                        <tr>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                <a href="{pigcms{:U('PropertyService/check_record',array('village_id'=>$village_id,'time'=>$vo['date']))}">{pigcms{$vo.date}</a>
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.yes_Count}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.no_Count}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.name}</td>
                        </tr>
                    </foreach>
                </table>
                点击表中的日期,可以查看当天详细情况
            </div>

            

        </div>

    </div>
</div>

</body>
</html>