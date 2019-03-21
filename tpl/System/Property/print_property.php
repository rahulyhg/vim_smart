<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>催款通知单</title>
    <style type="text/css">
        <!--
        body {margin: 0px; font-family:"微软雅黑"; font-size:18px; font-weight: 100; letter-spacing:1px;}
        .STYLE1 {
            font-size: 24px;
            font-weight: bold;
        }
        .STYLE4 {font-size: 18px; }
        -->
        span {
            font-size: 20px;
            font-weight: bold;
        }
        .pageBreak {  page-break-before: always; ,page-break-after: always;  }
    </style></head>
<!-- ../images/x5.jpg 210 297 650/x = 210/297 297*650/210-->

<body>
<foreach name="list" item="roominfo" >
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 10px;margin-left: 40px;page-break-after:always;" class="">
        <tr>
            <td align="center">
                <div style="font-size:40px; font-weight:bold; ">{pigcms{$village_info.village_name}{pigcms{$roominfo.project_name}物业服务费催收函</div>
                <br/>
            </td>
        </tr>
        <tr>
            <td align="left" style="line-height:2">{pigcms{$village_info.village_name}{pigcms{$roominfo.project_name}<span style="text-decoration:underline; font-size:30px;">&nbsp;{pigcms{$roominfo.room_name}&nbsp;</span>房号<span style="text-decoration:underline; font-size:30px;">&nbsp;{pigcms{$roominfo.owner_name}&nbsp;</span>业主：</td>
        </tr>
        <tr>
            <td align="left" valign="top" style="line-height:2.5; border:0px #000000 solid; border-top:none; border-bottom:none;">　
                &nbsp;&nbsp;您好！截止{pigcms{:date('Y')}年第<span style="text-decoration:underline;">&nbsp;{pigcms{$season_number}&nbsp;</span>季度收费，您合计有<span style="text-decoration:underline;font-size: 30px">{pigcms{:number_format($roominfo['property_money'],2)}</span>元物业服务费欠费未交.根据
                {pigcms{$village_info.village_name}{pigcms{$roominfo.project_name}《前
                期物业服务协议》内容的规定:上年度物业服务费到期7日前缴纳下年度物业服务费；根据
                {pigcms{$village_info.village_name}{pigcms{$roominfo.project_name}《前期物业服务协议》第七条违约责任及承担第四项:“乙方违反本协议，甲方除要求乙方补交所
                欠款项外，有权从乙方逾期交费之日起，以乙方应交而未交物业服务费为基数，按日千分之一的标准累计计算向乙方收取滞纳金。”<br/>
                　
                &nbsp;&nbsp;由于欠费，您已经侵犯了其他业主的利益，并且已经影响到物业服务中心服务工作的正常提供。<br/>
                　
                &nbsp;&nbsp;请您在{pigcms{$last_day['year']}年<span style="text-decoration:underline">&nbsp;{pigcms{$last_day['month']}&nbsp;</span>月<span style="text-decoration:underline">&nbsp;{pigcms{$last_day['day']}&nbsp;</span>日前到物业服务中心前台缴纳物业服务费。如故意拖欠，我们将保留向您依法诉讼追缴的权利。<br/>
                　
                &nbsp;&nbsp;交费咨询电话:{pigcms{$roominfo.property_phone}<br/>
                <br/>
        </tr>
        <tr>
            <td align="right" style="border:0px #000000 solid; border-top:none;">
                    武汉{pigcms{$village_info.group_name}物业服务有限公司<br /><br/>
                    {pigcms{$village_info.village_name}{pigcms{$roominfo.project_name}物业服务中心<br /><br/>
                <span>{pigcms{:date('Y')}</span>年&nbsp;<span>{pigcms{:date('m')}</span>&nbsp;月&nbsp;<span>{pigcms{:date('d')}</span>&nbsp;日

            </td>
        </tr>
    </table>
</foreach>
<div style="clear:both"></div>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>

    /*var dah ='2915';
     $('.da').each(function(){
     var h = $(this).height();
     if(h%dah>0){
     $(this).css('height',(Math.floor(h/dah)+1)*dah) ;
     }
     });*/

    window.onload=function(){
        window.print();

    };
</script>
</body>
</html>