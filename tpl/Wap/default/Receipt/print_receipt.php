<html>
<head>
    <meta charset="utf-8">
    <title>收款单据</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="./static/css/sj/style.css" rel="stylesheet" type="text/css">
    <script src="./static/weidian/js/jquery.min.js"></script>
</head>

<body>
<foreach name="list_cache" item="v">
<div class="width p30">
    <div class="bt">
        <div class="dbt">{pigcms{$v['village_name']}物业服务中心</div>
        <div class="dbt2">收款单据</div>
    </div>
    <div class="lm">
        <div class="zw p15">
            <div class="zw">
                <div class="left">单&nbsp;&nbsp;据&nbsp;&nbsp;号</div>
                <div class="right2">{pigcms{$v['num']}</div>
                <div class="both"></div>
            </div>
            <div class="zw">
                <div class="left">房&nbsp;&nbsp;间&nbsp;&nbsp;号</div>
                <div class="right2">{pigcms{$v['room_name']}</div>
                <div class="both"></div>
            </div>
            <div class="zw">
                <div class="left">客&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户</div>
                <div class="right2">{pigcms{$v['owner']}</div>
                <div class="both"></div>
            </div>
            <div class="zw">
                <div class="left">收费日期</div>
                <div class="right2">{pigcms{$v['create_time']}</div>
                <div class="both"></div>
            </div>
        </div>
        <div class="zw p30">
            <div class="bt2">
                <div class="zb">合计金额</div>
                <div class="yb">¥{pigcms{:number_format($v['sum'],2)}</div>
                <div class="both"></div>
            </div>

            <div class="menu">
                <volist name="v" id="vo">
                    <if condition="is_array($vo)">
                        <div class="menuParent">
                            <div class="ListTitlePanel">
                                <div class="ListTitle">
                                    <div class="left">{pigcms{$vo['type']}<img src="./static/images/sj.jpg" style="width:5%; height:auto;"></div>
                                    <div class="right">￥{pigcms{:number_format($vo['money'],2)}</div>
                                    <div class="yright"></div>
                                    <div class="both"></div>
                                    <div class="leftbgbt"> </div>
                                </div>
                            </div>
                            <div class="menuList">
                                <div>
                                    <span class="gg">收款方式:{pigcms{$vo['fee_type']}</span>
                                    <span class="gg2">备注:{pigcms{$vo['remark']}</span>
                                    <span class="both"></span>
                                </div>
                            </div>
                        </div>
                    </if>
                </volist>

            </div>

        </div>
    </div>
    <div class="zh">如需发票，请凭此收据30天内到物业服务中心换取发票</div>
</div>
</foreach>
<script type="text/javascript">
    $(document).ready(function() {
        var menuParent = $('.menu > .ListTitlePanel > div');
        var menuList = $('.menuList');
        $('.menu > .menuParent > .ListTitlePanel > .ListTitle').each(function(i) {
            $(this).click(function(){
                if($(menuList[i]).css('display') == 'none'){
                    $(menuList[i]).slideDown(300);
                }
                else{
                    $(menuList[i]).slideUp(300);
                }
            });

        });
    });
</script>
</body>
</html>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>收款单据</title>
    <link href="./static/css/style_receipt.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--{pigcms{:dump($list_cache)}-->
<!--<foreach name="list_cache" item="v">
    <div class="width" style="page-break-after:always">
        <div class="logo"><img src="./static/images/logo.jpg" /></div>
        <div class="left">
            <div class="bt">{pigcms{$v['village_name']}物业服务中心</div>
            <div class="bt2">
                <div class="wbt">楼栋房间号：{pigcms{$v['room_name']}<br/>
                    客户：{pigcms{$v['owner']}</div>
                <div class="wbt2">收款单据</div>
                <div class="wbt3">单据号：{pigcms{$v['num']}<br/>收费日期：{pigcms{$v['creattime']}</div>
                <div class="both"></div>
            </div>
            <div class="bg">
                <table width="915" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="196" height="40" align="center" style="border:1px #000000 solid;">收费项目</td>
                        <td width="227" height="40" align="center" style="border:1px #000000 solid; border-left:none;">收款方式</td>
                        <td width="208" height="40" align="center" style="border:1px #000000 solid; border-left:none;">收款金额</td>
                        <td height="40" align="center" style="border:1px #000000 solid; border-left:none;">备注</td>
                    </tr>
                    <for start="0" end="5">
                        <tr>
                            <td height="30" align="center" style="border:1px #000000 solid; border-top:none;">{pigcms{$v[$i]['type']}</td>
                            <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">{pigcms{$v[$i]['fee_type']}</td>
                            <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;"><if condition="$v[$i]['money']"><span style="padding-left:15px;">￥</span> {pigcms{:number_format($v[$i]['money'],2)}</if></td>
                            <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;">{pigcms{$v[$i]['remark']}</td>
                        </tr>
                    </for>
                    <tr>
                        <td height="40" colspan="2" style="border:1px #000000 solid; border-top:none;"><span style="padding-left:15px;">合计金额大写：{pigcms{$v['sum_chinese']}</span></td>
                        <td height="40" colspan="2" style="border:1px #000000 solid; border-top:none; border-left:none;"><span style="padding-left:15px;">合计金额小写：￥ {pigcms{:number_format($v['sum'],2)}</span></td>
                    </tr>
                    <tr>
                        <td height="40" colspan="4" style="border:1px #000000 solid; border-top:none;"><span style="padding-left:15px;">说明：</span></td>
                    </tr>
                </table>
            </div>
            <div class="js">* {pigcms{$v['village_name']}物业服务中心咨询电话：{pigcms{$v['property_phone']}（上班时间：08：30-12:00、14：00-17：30，节假日无休）。<br />
                * 如需发票，请凭此收据30天内到物业服务中心换取发票。<br />
                * 本收据手写无效。<br/>
                * 第一联：存根联； 第二联：记账联； 第三联：客户联。 </div>
            <div class="yz">
                <div class="yz2">
                    <div class="yz3">盖章：</div>
                    <div class="yz4"></div>
                    <div class="both"></div>
                </div>
                <div class="yz2">
                    <div class="yz3">复核人：</div>
                    <div class="yz4"></div>
                    <div class="both"></div>
                </div>
                <div class="yz2">
                    <div class="yz3">收款人：</div>
                    <div class="yz4"></div>
                    <div class="both"></div>
                </div>
                <div class="yz2">
                    <div class="yz3">交款人：</div>
                    <div class="yz4"></div>
                    <div class="both"></div>
                </div>
                <div class="both"></div>
            </div>
        </div>
        <div class="right">
            <div class="rwm"><img style="width: 75px;height: 76px;" src="{pigcms{:U('PropertyService/QR',array('url'=>urlencode('http://'.$_SERVER['SERVER_NAME'].'/wap.php?&g=wap&c=Receipt&a=print_receipt&print_id='.$v['print_id']),'type'=>'notlogo'))}" /></div>
            <div class="rwm2">真伪验证</div>
            <div class="rwm3">
                    <div class="rwm4">重<br/>复<br/>打<br/>印</div>
            </div>
        </div>
        <div class="both"></div>
    </div>
</foreach>

</body>

</html>-->
