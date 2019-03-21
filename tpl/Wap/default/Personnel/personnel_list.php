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
                            <th width="33%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">筛选</th>
                            <th width="33%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">
                                <select id="group_id" onchange="changeurl()" autofocus="autofocus">
                                    <foreach name="personnel_group_list" item="vo">
                                        <option value="{pigcms{$vo['group_id']}" <if condition="$vo['group_id'] eq $personnel_group"> selected="selected"</if>>{pigcms{$vo['group_name']}</option>
                                    </foreach>
                                </select>
                            </th>
                            <th width="33%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">
                                <select id="time_select" onchange="changeurl()" autofocus="autofocus">
                                    <for start="date('Y')" end="date('Y')+1" name="i">
                                        <for start="1" end="13" name="j">
                                            <option value="{pigcms{$i}-{pigcms{$j}" <if condition="$time eq $i.'-'.$j"> selected="selected"</if> >{pigcms{$i}年{pigcms{$j}月</option>
                                        </for>
                                    </for>
                                </select>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
    </div>
</div>
<div class="zw">
    <div class="tb">{pigcms{$group_name}本月参保人员列表</div>
    <div class="kk2">
        <div class="width p25">

            <div id="didida">
                <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                    <tr>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">姓名</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">所属部门</th>
                        <th width="25%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">社保缴纳时间</th>
                        <th width="24%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">社保情况</th>
                    </tr>
                    <foreach name="personnel_social" item="vo">
                        <tr>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                <a href="{pigcms{:U('Personnel/personnel_info',array('personnel_id'=>$vo['personnel_id']))}">{pigcms{$vo.name}</a>
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.department_name}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{:date('Y-m-d',$vo['social_addtime'])}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.social_condition}</td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>

    </div>

    <div class="tb">{pigcms{$group_name}本月公积金代缴人员列表</div>
    <div class="kk2">
        <div class="width p25">

            <div id="didida">
                <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                    <tr>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">姓名</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">所属部门</th>
                        <th width="25%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">公积金缴纳时间</th>
                        <th width="24%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">缴纳金额</th>
                    </tr>
                    <foreach name="personnel_accumulation" item="vo">
                        <tr>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                <a href="{pigcms{:U('Personnel/personnel_info',array('personnel_id'=>$vo['personnel_id']))}">{pigcms{$vo.name}</a>
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.department_name}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{:date('Y-m-d',$vo['accumulation_addtime'])}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.accumulation_money}</td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>

    </div>
    <div class="tb">{pigcms{$group_name}本月劳动合同到期人员列表</div>
    <div class="kk2">
        <div class="width p25">

            <div id="didida">
                <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                    <tr>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">姓名</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">所属部门</th>
                        <th width="25%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">开始时间</th>
                        <th width="24%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">结束时间</th>
                    </tr>
                    <foreach name="personnel_contract" item="vo">
                        <tr>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                <a href="{pigcms{:U('Personnel/personnel_info',array('personnel_id'=>$vo['personnel_id']))}">{pigcms{$vo.name}</a>
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.department_name}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{:date('Y-m-d',$vo['time_start'])}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{:date('Y-m-d',$vo['time_end'])}</td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>

    </div>

    <div class="tb">{pigcms{$group_name}本月推荐入职奖励列表</div>
    <div class="kk2">
        <div class="width p25">

            <div id="didida">
                <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
                    <tr>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">推荐人</th>
                        <th width="24%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none;">入职员工</th>
                        <th width="20%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">入职所属部门</th>
                        <th width="25%" style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none;">入职时间</th>
                    </tr>
                    <foreach name="personnel_recommd" item="vo">
                        <tr>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                {pigcms{$vo.induction_name}
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center; font-size:14px;">
                                <a href="{pigcms{:U('Personnel/personnel_info',array('personnel_id'=>$vo['personnel_id']))}">{pigcms{$vo.name}</a>
                            </td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{$vo.department_name}</td>
                            <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none; font-size:14px;">{pigcms{:date('Y-m-d',$vo['entrytime'])}</td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    function changeurl(){
        var time=$('#time_select').val();
        var group_id=$('#group_id').val();
        window.location.href="{pigcms{:U('Personnel/personnel_list')}&time="+time+"&group_id="+group_id;
    }
    /*var time_value='{pigcms{:$_GET["time"]?$_GET["time"]:date("Y-m")}'
    $('#time_select').val(time_value);*/
</script>
</body>
</html>