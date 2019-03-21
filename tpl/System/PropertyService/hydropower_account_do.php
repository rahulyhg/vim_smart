<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>催款通知单</title>
    <style type="text/css">
        <!--
        body {margin: 0px; font-family:"宋体"; font-size:15px; font-weight: 100; letter-spacing:1px;}
        .STYLE1 {
            font-size: 24px;
            font-weight: bold;
        }
        .STYLE4 {font-size: 18px; }
        -->
        .pageBreak {  page-break-before: always; ,page-break-after: always;  }
    </style></head>
<!-- ../images/x5.jpg 210 297 650/x = 210/297 297*650/210-->

<body>
<foreach name="accountArr_1" item="billTemplateArray" >
    <table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 30px;" class="pageBreak">
        <tr>
            <td height="70" align="center" style="border:1px #000000 solid; border-bottom:none;">
                <div style="float:left; margin-right:5%; width:20%; text-align: left;"><img src="./static/images/logo.png" width="90" style="margin-left:10px;"/></div>
                <div style="float:left; font-size:20px; font-weight:bold; width:50%;">广发银行大厦水电缴费通知函<br/>({pigcms{$y}年{pigcms{$m}月)</div>
            </td>
<!--            <td height="70" align="center" style="border:1px #000000 solid; border-bottom:none;">-->
<!--                <div style="float:left; margin-left:5%; margin-right:5%; width:20%;"><img src="./static/images/logo.png" width="115" style="margin-left:20px;"/></div>-->
<!--                <div style="float:left; font-size:24px; font-weight:bold; width:70%;">广发银行大厦水电缴费通知函<br/>({pigcms{$y}年{pigcms{$m}月)</div>-->
<!--            </td>-->
        </tr>
        <tr>
            <td align="center">{pigcms{$billTemplateArray.html}</td>
        </tr>
        <tr>
            <td align="left" valign="top" style="line-height:1.2; border:1px #000000 solid; border-top:none; border-bottom:none;">　　注：1.正式用水3.72元/吨  正式用电1元/度<br />
                　　　　2.水电费每月缴取</td>
        </tr>
        <tr>
            <td style="line-height:1.5; border:1px #000000 solid; border-bottom:none;">　　以上费用，请您于 <u>{pigcms{$billTemplateArray.data.end_year}</u> 年 <u>{pigcms{$billTemplateArray.data.end_month}</u> 月 <u>5</u> 日前到广发银行大厦32F(武汉汇得行物业服务有限公司财务部)缴纳。逾期若未缴清相关费用,将按日加收应缴费用3‰的滞纳金。为避免给您的工作、生活带来不便，请尽快缴清相关费用。<br />
                　　如有异议，请向我服务中心咨询。<br />
                　　咨询电话:027-85880377<br />
                　　谢谢合作！</td>
        </tr>
        </tr>
        <tr>
            <td align="right" style="border:1px #000000 solid; border-top:none;"><span style="line-height:1.4;">广发银行大厦物业服务中心&nbsp;&nbsp;&nbsp;&nbsp;<br />
{pigcms{:date('Y')}年{pigcms{:date('m')}月{pigcms{:date('d')}日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        </tr>
        <tr>
            <td style="line-height:1.5; border:1px #000000 solid; border-top:none;">　　收款单位:武汉汇得行物业服务有限公司<br />
                　　帐　　号:1400 0151 7010 021396<br />
                　　开户银行:广发银行武汉分行                                                             <br />
                　　行　　号：219 627</td>
        </tr>

        <tr>
            <td height="40" align="center" style="border:1px #000000 solid; border-bottom: none; border-top:none;"><span class="STYLE4">回&nbsp;执</span></td>
        </tr>

        <tr>
            <td align="left" valign="top" style="line-height:20px; border:1px #000000 solid; border-bottom: none; border-top:none;">　　我已收到武汉汇得行物业服务有限公司签发的关于{pigcms{$m}月份的《水电缴费通知函》，并已明确知晓逾期加收滞纳金事宜。 </td>
        </tr>
        <tr>
            <td align="right" style="line-height:2; border:1px #000000 solid; border-top:none;">签收人：　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />      日&nbsp;期：　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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