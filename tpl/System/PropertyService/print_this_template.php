<if condition="$_GET['type'] eq 1">
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
        .STYLE4 {font-size: 18px; font-weight: bold; }
        -->
    </style></head>

<body>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
    <tr>
<!--        <td height="70" align="center" style="border:1px #000000 solid; border-bottom:none;">-->
<!--            <div style="float:left; margin-left:5%; margin-right:5%; width:20%;"><img src="./static/images/logo.png" width="115" style="margin-left:20px;"/></div>-->
<!--            <div style="float:left; font-size:24px; font-weight:bold; width:70%;">广发银行大厦水电缴费通知函<br/>({pigcms{$billTemplateArray.ym})</div>-->
<!--        </td>-->
        <td height="70" align="center" style="border:1px #000000 solid; border-bottom:none;">
            <div style="float:left; margin-right:5%; width:20%; text-align: left;"><img src="./static/images/logo.png" width="90" style="margin-left:10px;"/></div>
            <div style="float:left; font-size:20px; font-weight:bold; width:50%;">广发银行大厦水电缴费通知函<br/>({pigcms{$y}年{pigcms{$m}月)</div>
        </td>
    </tr>
    <tr>
        <td align="center">{pigcms{$bill_html}</td>
    </tr>
    <tr>
        <td align="left" valign="top" style="line-height:1.2; border:1px #000000 solid; border-top:none; border-bottom:none;">　　注：1.正式用水3.72元/吨  正式用电1元/度<br />
            　　　　2.水电费每月缴取</td>
    </tr>
    <tr>
        <td style="line-height:1.5; border:1px #000000 solid; border-bottom:none;">　　以上费用，请您于 <u>{pigcms{$billTemplateArray.end_year}</u> 年 <u>{pigcms{$billTemplateArray.end_month}</u> 月 <u>5</u> 日前到广发银行大厦32F(武汉汇得行物业服务有限公司财务部)缴纳。逾期若未缴清相关费用,将按日加收应缴费用3‰的滞纳金。为避免给您的工作、生活带来不便，请尽快缴清相关费用。<br />
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
        <td height="40" align="center" style="border:1px #000000 solid; border-bottom: none; border-top:none;"><span class="STYLE4">回&nbsp;&nbsp;&nbsp;执</span></td>
    </tr>

    <tr>
        <td align="left" valign="top" style="line-height:20px; border:1px #000000 solid; border-bottom: none; border-top:none;">　　我已收到武汉汇得行物业服务有限公司签发的关于{pigcms{$m}月份的《水电缴费通知函》，并已明确知晓逾期加收滞纳金事宜。 </td>
    </tr>
    <tr>
        <td align="right" style="line-height:2; border:1px #000000 solid; border-top:none;">签收人：　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />      日&nbsp;期：　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>
<script>
    window.onload=function(){
        window.print();

    };
</script>
</body>
</html>
<else/>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>缴费通知单</title>
        <style type="text/css">
            <!--
            body {margin: 0px; font-family:"宋体"; font-size:15px; font-weight: 100; letter-spacing:1px;}
            .STYLE1 {
                font-size: 28px;
                font-weight: bold;
            }
            -->
        </style></head>

    <body>
    <table align="center" width="670" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
            <td style="border-bottom:2px #000000 solid;" align="left" height="100"><img src="./static/images/logo.png" style="margin-left:20px;" width="115"></td>
        </tr>
        <tr>
            <td align="center" height="80"><span class="STYLE1">缴费通知单</span></td>
        </tr>
        <tr>
            <td align="left" height="38"><u>{pigcms{$billTemplateArray.company_name}</u>：</td>
        </tr>
        <tr>
            <td style="line-height:2;" align="left">　　感谢贵司一直以来对我服务中心工作的大力支持！ <br>
                　　本次贵公司需缴纳<u> {pigcms{$billTemplateArray.quarterStart}</u>至<u></u><u> {pigcms{$billTemplateArray.quarterEnd}</u>的物业服务费总计：<u> {pigcms{$billTemplateArray.total_property} </u>元（<u> {pigcms{$billTemplateArray.roomsizes} </u>㎡X<u> {pigcms{$billTemplateArray.true_property_unit} </u>元/㎡X<u> 3 </u><u></u>月=<u></u><u> {pigcms{$billTemplateArray.total_property} </u>元）,总金额共计<u> {pigcms{$billTemplateArray.total_property} </u>元，请于<u> {pigcms{$billTemplateArray.quarterEnd}</u>前支付。<br>
                <br>
                　　谢谢您的支持，我们将一如既往的为您提供优质的服务！<br>
                　　备注：<u>1、</u><u>包含</u><u>x</u><u>个月物业服务费。</u><u> </u><br>
                　　　　　<u>2、请您务必于</u><u>x</u><u>月</u><u>x</u><u>日之前缴清费用，方便我司为您尽快开出发票。我司</u><br>
                　　　　　<u>发票均会在款项到账后第一时间为您开出并送予您签收，请勿担心。</u></td>
        </tr>
        <tr>
            <td align="right" height="60">&nbsp;</td>
        </tr>
        <tr>
            <td style="line-height:2;" align="right">武汉汇得行物业服务有限公司<br>
                广发银行大厦物业服务中心<br>
                2017年{pigcms{:date('m')}月{pigcms{:date('d')}日</td>
        </tr>
        <tr>
            <td height="60">&nbsp;</td>
        </tr>
        <tr>
            <td style="line-height:2;" align="left">　　联系方式：027-85880377 <br>
                　　公司名称：武汉汇得行物业服务有限公司 <br>
                　　开 户 行：广发银行武汉分行营业部 <br>
                　　账　　号：1400 0151 7010 021396 <br>
                　　行　　号：219 627 </td>
        </tr>
        </tbody></table>
    <script>
        window.onload=function(){
            window.print();

        };
    </script>

    </body>
    </html>
</if>

