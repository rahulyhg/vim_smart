<html>
<head>
<meta charset="utf-8">
<title>巡更月报表</title>
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
.jk {font-size:25px;}
-->
</style>
</head>
<script>
  document.addEventListener('touchstart',function(){},false);
</script>

<body style="background-color:#f7f6f9;">
<div class="zw">
    <div class="tb">各项目在线巡更月度完成情况</div>
    <div class="kk">
        <div class="zw">
            <div class="width p20">
                <div class="dkk">
                    <div class="width">
                        <div class="nu"><a href="#" class="dsz">{pigcms{$nowPointCount}</a></div>
                        <div class="nu2">上月已巡更点位数</div>
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
                        <div class="nu"><a href="#" class="dsz">{pigcms{$lowPointCount}</a></div>
                        <div class="nu2">上月未巡更点位数</div>
                        <div class="nu3">
                            <div class="re3">
                                <div class="width">
                                    <div class="jk3">巡更率</div>
                                    <div class="jk4">{pigcms{$rate}%</div>
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
                上月各社区的巡更情况
            </div>
        </div>
    </div>
    <div id="didida">
        <table width="100%" border="1px" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid; border-bottom:none;">
            <tr>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none; width:15%;">评分</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none; width:35%;">社区名称</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none; width:20%;">总巡更点</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-left:none; width:15%;">已巡更</th>
                <th style="border: 1px #e5e5e5 solid; color: #0e7fe6; font-weight:bold; height:30px; line-height:30px; border-top:none; border-right:none; border-left:none; width:15%;">巡更率</th>
            </tr>
            <foreach name="month_pointRecord" item="vo">
                <tr>
                    <if condition="$vo.rate egt 90">
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;"><img src="{pigcms{$static_path}images/ti1.jpg" style="width:40%; height:auto;" /></td>
                    <elseif condition="$vo.rate egt 80 and $vo.rate lt 90"/>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;"><img src="{pigcms{$static_path}images/ti2.jpg" style="width:40%; height:auto;" /></td>
                    <else/>
                        <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;"><img src="{pigcms{$static_path}images/ti3.jpg" style="width:40%; height:auto;" /></td>
                    </if>                   
                    <td style="border: 1px #e5e5e5 solid; border-top:none; border-left:none; height:30px; line-height:30px; text-align:center;">{pigcms{$vo.village_name}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.pointCount}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.nowPointCount}</td>
                    <td style="border: 1px #e5e5e5 solid; border-top:none; border-right:none; height:30px; line-height:30px; text-align:center; border-left:none;">{pigcms{$vo.rate}%</td>
                </tr>
            </foreach>
        </table>

    </div>


<!--     <div class="kk2">
        <div class="width p25">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-radius: 8px; border: 1px #e5e5e5 solid;">
  <tr>
    <td width="14%" height="60" rowspan="2" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; color:#0e7fe6; font-weight:bold;">检查<br>
      日期</td>
    <td height="30" colspan="5" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-bottom:none; border-top:none; color:#0e7fe6; font-weight:bold;">异常设备统计</td>
    <td width="14%" height="60" rowspan="2" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none; color:#0e7fe6; font-weight:bold;">共计</td>
  </tr>
  <tr>
    <td width="12%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">枪头</td>
    <td width="12%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">水带</td>
    <td width="17%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">消防按钮</td>
    <td width="17%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">外框玻璃</td>
    <td width="14%" height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-left:none; color:#0e7fe6; font-weight:bold;">灭火器</td>
    </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">{pigcms{$date[1]}月</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status_1-1'))}" class="sz">{pigcms{$statusNum[0]}</a>
    </td>
    <td height="30" align="center"  style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status_2-1'))}" class="sz">{pigcms{$statusNum[1]}</a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status_3-1'))}" class="sz">{pigcms{$statusNum[2]}</a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status_4-1'))}" class="sz">{pigcms{$statusNum[3]}</a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status_5-1'))}" class="sz">{pigcms{$statusNum[4]}</a>
    </td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;">
        <a href="{pigcms{:U('check_safety_record_menu',array('status'=>'status'))}" class="sz">{pigcms{$statusNum[5]}</a>
    </td>
  </tr> -->
  <!-- <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">2月</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">1</a></td>
    <td height="30" align="center"  style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">1</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">1</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;"><a href="0" class="sz">3</a></td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">3月</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center"  style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;"><a href="0" class="sz">0</a></td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">4月</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center"  style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;"><a href="0" class="sz">0</a></td>
  </tr>
  <tr>
    <td height="30" align="center" style="font-size:12px; border:1px #e5e5e5 solid; border-top:none; border-left:none;">5月</td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center"  style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">2</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none;"><a href="0" class="sz">0</a></td>
    <td height="30" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-left:none; border-top:none; border-right:none;"><a href="0" class="sz">5</a></td>
  </tr> -->
<!--   <tr>
    <td height="40" colspan="6" style="padding-left:12px; font-size:12px; border:1px #e5e5e5 solid; border-top:none; font-family:'微软雅黑'; border-left:none;">......</td>
    <td height="40" align="center" style="font-family:'宋体'; border:1px #e5e5e5 solid; border-top:none; border-left:none; border-right:none;"><a href="0" class="sz">5</a></td>
  </tr> -->
    <!-- <tr>
    <td height="40" colspan="7" style="padding-left:12px; font-size:12px; color:#ea7406; font-weight:bold;">点击数字可查看详情。</td>
    </tr>
</table> -->

        </div>
        <!-- <div class="width xs2">
            <div class="bt">提 交</div>
        </div> -->
    </div>
</div>

</body>
</html>