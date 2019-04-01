<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>收款单据</title>
    <link href="./static/css/style_receipt.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--<?php echo dump($list_cache);?>-->
<?php if(is_array($list_cache)): foreach($list_cache as $key=>$v): ?><div class="width" style="page-break-after:always;width: 1121px;">
        <div class="logo"><img src="./static/images/logo.jpg" /></div>
        <div class="left">
            <div class="bt"><?php echo ($v['village_name']); ?>物业服务中心</div>
            <div class="bt2">
                <div class="wbt">楼栋房间号：<?php echo ($v['room_name']); ?><br/>
                    客户：<?php echo ($v['owner']); ?></div>
                <div class="wbt2">收款单据</div>
                <div class="wbt3">单据号：<?php echo ($v['num']); ?><br/>收费日期：<?php echo ($v['creattime']); ?></div>
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
                    <?php $__FOR_START_21113__=0;$__FOR_END_21113__=5;for($i=$__FOR_START_21113__;$i < $__FOR_END_21113__;$i+=1){ ?><tr>
                                <td height="30" align="center" style="border:1px #000000 solid; border-top:none;"><?php echo ($v[$i]['type']); ?></td>
                                <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;"><?php echo ($v[$i]['fee_type']); ?></td>
                                <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;"><?php if($v[$i]['money']): ?><span style="padding-left:15px;">￥</span> <?php echo number_format($v[$i]['money'],2); endif; ?></td>
                                <td height="30" align="center" style="border:1px #000000 solid; border-top:none; border-left:none;"><?php echo ($v[$i]['remark']); ?></td>
                            </tr><?php } ?>
                    <tr>
                        <td height="40" colspan="2" style="border:1px #000000 solid; border-top:none;"><span style="padding-left:15px;">合计金额大写：<?php echo ($v['sum_chinese']); ?></span></td>
                        <td height="40" colspan="2" style="border:1px #000000 solid; border-top:none; border-left:none;"><span style="padding-left:15px;">合计金额小写：￥ <?php echo number_format($v['sum'],2);?></span></td>
                    </tr>
                    <tr>
                        <td height="40" colspan="4" style="border:1px #000000 solid; border-top:none;"><span style="padding-left:15px;">说明：<?php echo ($v['remark']); ?></span></td>
                    </tr>
                </table>
            </div>
            <div class="js">* <?php echo ($v['village_name']); ?>物业服务中心咨询电话：<?php echo ($v['property_phone']); ?>（上班时间：08：30-12:00、14：00-17：30，节假日无休）。<br />
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
                    <div class="yz4"><?php echo ($v['realname']); ?></div>
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
        <div class="right" style="margin-right: 33px">
            <div class="rwm" style="width: 115px;height: 115px"><img style="width: 115px;height: 115px;" src="<?php echo U('PropertyService/QR',array('url'=>urlencode('http://'.$_SERVER['SERVER_NAME'].'/wap.php?&g=wap&c=Receipt&a=print_receipt&print_id='.$v['print_id']),'type'=>'notlogo'));?>" /></div>
            <div class="rwm2" style="width: 115px">真伪验证</div>
            <div class="rwm3" style="width:38px;">
                <?php if(!empty($_GET['print_id'])): ?><div class="rwm4" style="width: 78px">重<br/>复<br/>打<br/>印</div><?php endif; ?>
            </div>
        </div>
        <div class="both"></div>
    </div><?php endforeach; endif; ?>

</body>
<?php if(empty($_GET['type'])): ?><script>
        window.print();
    </script><?php endif; ?>

</html>