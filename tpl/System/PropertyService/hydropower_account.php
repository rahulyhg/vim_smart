<style type="text/css">
    <!--
    .btn.red:not(.btn-outline) {
        color: #fff;
        background-color: #659be0;
        border-color: #659be0;
    }

    #da>a{
        color:black;
        text-decoration:none;

    }

    #da>a>table{
        border: 1px solid #cc463d;
    }
    -->
</style><extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">

</block>

<block name="body">
    <foreach name="accountArr_1" item="vo" >
        <div id="da">
            <a href="{pigcms{:U('modal_pay_list',array('tid'=>$vo['pigcms_id'],'ym'=>$ym))}">
                <table  cellpadding="0"  align="center" cellspacing="0">
                    <tr>
                        <td height="100" align="left" style="border-bottom:2px #000000 solid;"><img src="./static/images/logo.png" width="115" style="margin-left:20px;"/></td>
                    </tr>
                    <tr>
                        <td height="60" align="center"><span class="STYLE1">广发银行大厦水电缴费通知函({pigcms{$vo.ym})</span></td>
                    </tr>
                    <tr>
                        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="18%" height="34" align="center" style="border:1px #000000 solid;">公司名称</td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none;">{pigcms{$vo.company_name}</td>
                                    <td width="18%" height="34" align="center" style="border:1px #000000 solid; border-left:none;">单元号</td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none;">{pigcms{$vo.room_name}</td>
                                </tr>
                                <tr>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">上月抄表日期</td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$vo.last_month_time}</td>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月抄表日期</td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$vo.this_month_time}</td>
                                </tr>
                                <tr>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">上月水表起码</td>
                                    <td width="17%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月水表止码</td>
                                    <td width="14%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><p>用水量<br />
                                            （吨）</p>          </td>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">上月电表起码<br />
                                        （度）</td>
                                    <td width="19%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">本月电表止码<br />
                                        （度）</td>
                                    <td width="14%" height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">用电量<br />
                                        （度）</td>
                                </tr>
                                <if condition="count($vo['water']) gt count($vo['electric'])">
                                    <foreach name="vo['water']" item="wv" key="wk">
                                        <tr>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-top:none;">{pigcms{$wv.last_total_consume}</td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$wv.total_consume}</td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$wv.now_consume}</td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><php>echo $vo['electric'][$wk]['last_total_consume']?:'/'</php></td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><php>echo $vo['electric'][$wk]['total_consume']?:'/'</php></td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><php>echo $vo['electric'][$wk]['now_consume']?:'/'</php></td>
                                        </tr>
                                    </foreach>
                                    <else/>
                                    <foreach name="vo['electric']" item="ev" key="ek">
                                        <tr>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-top:none;"><php>echo $vo['water'][$ek]['last_total_consume']?:'/'</php></td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><php>echo $vo['water'][$ek]['total_consume']?:'/'</php></td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;"><php>echo $vo['water'][$ek]['now_consume']?:'/'</php></td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$ev.last_total_consume}</td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$ev.total_consume}</td>
                                            <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$ev.now_consume}</td>
                                        </tr>
                                    </foreach>
                                </if>
                                <tr>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-top:none;">用水费用<br />
                                        合计(元）</td>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$vo.total_water}</td>
                                    <td height="34" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">用电费用<br />
                                        合计(元）</td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$vo.total_electric}</td>
                                </tr>
                                <tr>
                                    <td height="34" colspan="4" align="center" style="border:1px #000000 solid; border-top:none;"><strong>本月应缴水电费合计：</strong></td>
                                    <td height="34" colspan="2" align="center" style="border:1px #000000 solid; border-left:none; border-top:none;">{pigcms{$vo.total_money}</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="line-height:2; border:1px #000000 solid; border-top:none;">　　注：1.正式用水3.72元/吨  正式用电1元/度<br />
                            　　　　2.水电费每月缴取</td>
                    </tr>
                    <tr><td height="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="line-height:1.5;">　　以上费用，请您于 {pigcms{$vo.end_year} 年 {pigcms{$vo.end_month} 月 5 日前到广发银行大厦32F(武汉汇得行物业服务有限公司财务部)缴纳。逾期若未缴清相关费用,将按日加收应缴费用3‰的滞纳金。为避免给您的工作、生活带来不便，请尽快缴清相关费用。<br />
                            　　如有异议，请向我服务中心咨询。<br />
                            　　咨询电话:027-85880377<br />
                            　　谢谢合作！</td>
                    </tr>
                    </tr>
                    <tr>
                        <td align="right" style="border-bottom:1px #000000 solid;"><span style="line-height:1.5;">广发银行大厦物业服务中心<br />
            {pigcms{:date('Y')}年{pigcms{:date('m')}月{pigcms{:date('d')}日</span></td>
                    </tr>
                    </tr>
                    <tr><td height="15">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="line-height:1.5;">收款单位:武汉汇得行物业服务有限公司<br />
                            帐　　号:1400 0151 7010 021396<br />
                            开户银行:广发银行武汉分行                                                             <br />
                            行　　号：219 627</td>
                    </tr>

                    <tr>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <td height="40" align="center" style="border-top:1px #000000 dashed;"><span class="STYLE4">回&nbsp;&nbsp;&nbsp;执</span></td>
                    </tr>

                    <tr>
                        <td align="left" valign="top" style="line-height:30px;">　　我已收到武汉汇得行物业服务有限公司签发的关于 月份的《水电缴费通知函》，并已明确知晓逾期加收滞纳金事宜。 </td>
                    </tr>
                    <tr>
                        <td align="right" style="line-height:2;">签收人：　　　<br />      日&nbsp;期：　　　</td>
                    </tr>
                </table>
            </a>
        </div>
    </foreach>
</block>
<block name="script">
    <script>
        $("input[name='choose_time']").change(function(){
            var ym = $("input[name='choose_time']").val();
            window.location.href='/admin.php?g=System&c=PropertyService&a=hydropower_account&ym='+ym;
        });
    </script>
</block>