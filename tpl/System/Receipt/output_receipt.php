<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>收据</title>
    <link href="{pigcms{$static_path}css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .tk5{
            background: url("{pigcms{$static_path}/images/gg.jpg") no-repeat;
        }
    </style>
</head>
<body>
<foreach name="list_cache" item="item">
    <div class="width">
        <div class="sm">
            <div class="bt">
                <div class="m19"></div>
                <div class="sj">收&nbsp;&nbsp;据</div>
                <div class="xx"></div>
                <div class="m71"></div>
                <div class="rq">入账日期：{pigcms{$item.create_time}</div>
            </div>
            <div class="sz">
                <div class="m1"></div>
                <div class="yb">{pigcms{$item.id}</div>
            </div>
            <div class="both"></div>
        </div>
        <div class="zwd">
            <div class="ft">{pigcms{$item.left_id}</div>
            <div class="ft3">
                <div class="kd">
                    <div class="di1">
                        <div class="ddz">
                            <div class="jk">交款单位</div>
                            <div class="jk2">{pigcms{$item.owner}</div>
                            <div class="both"></div>
                        </div>
                        <div class="ddz2">
                            <div class="jk">收款方式</div>
                            <div class="jk3">{pigcms{$item.fee_type}</div>
                            <div class="both"></div>
                        </div>
                        <div class="both"></div>
                    </div>
                    <div class="di2">
                        <div class="ddz3">
                            <div class="rmb">人民币<span style="font-size:12px;">(大写)</span></div>
                            <div class="rmb2">{pigcms{$item.money_chinese}</div>
                            <div class="both"></div>
                        </div>
                        <div class="ddz4">
                            <div class="tk4">￥</div>
                            <div class="tk5">{pigcms{$item.money}</div>
                            <div class="both"></div>
                        </div>
                        <div class="both"></div>
                    </div>
                    <div class="di2">
                        <div class="ddz5">
                            <div class="jk">收款事由</div>
                            <div class="jk4">{pigcms{$item.type}</div>
                            <div class="both"></div>
                        </div>
                    </div>
                    <div class="ny">年&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;日&nbsp;&nbsp;&nbsp;</div>
                </div>
                <div class="both"></div>
            </div>
            <div class="ft2">第<br/>一<br/>联<br/>：<br/>存<br/>根</div>
            <div class="both"></div>
        </div>
        <div class="zxm">
            <div class="x1">单<br />位<br />盖<br />章</div>
            <div class="x2">财<br />会<br />主<br />管</div>
            <div class="x2">记<br />&nbsp;<br />&nbsp;<br />账</div>
            <div class="x2">出<br />&nbsp;<br />&nbsp;<br />纳</div>
            <div class="x2">审<br />&nbsp;<br />&nbsp;<br />核</div>
            <div class="x2">经<br />&nbsp;<br />&nbsp;<br />办</div>
            <div class="both"></div>
        </div>
    </div>
</foreach>
</body>
</html>
