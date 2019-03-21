<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{pigcms{$now_village.village_name}</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="http://www.hdhsmart.com/tpl/Wap/pure/static/css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="http://www.hdhsmart.com/tpl/Wap/pure/static/css/village.css?211"/>
    <script type="text/javascript" src="http://www.hdhsmart.com/tpl/Wap/pure/static/js/iscroll.js?444" charset="utf-8"></script>
    <script type="text/javascript" src="http://www.hdhsmart.com/tpl/Wap/pure/static/js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://www.hdhsmart.com/tpl/Wap/pure/static/layer/layer.m.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://www.hdhsmart.com/tpl/Wap/pure/static/js/common.js?" charset="utf-8"></script>
<!--    <script type="text/javascript" src="http://www.hdhsmart.com/tpl/Wap/pure/static/js/village_my.js?" charset="utf-8"></script>-->
</head>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>社区缴费</header>
<div id="container">
    <div id="scroller" class="village_my">
        <nav class="me_pay">
            <volist name="pay_list" id="vo">
                <if condition="$vo['money'] gt 0">
                <section class="link-url"  onclick='test("{pigcms{$vo.url}","{pigcms{$vo.money}")' ><img src="http://www.hdhsmart.com/tpl/Wap/pure/static/images/house/{pigcms{$vo.type}.png"/><p>{pigcms{$vo.name}</p><em>(需缴费￥{pigcms{$vo.money})</em></section>
                    <else/>
                    <section class="link-url"  ><img src="http://www.hdhsmart.com/tpl/Wap/pure/static/images/house/{pigcms{$vo.type}.png"/><p>{pigcms{$vo.name}</p><em>(无需缴费)</em></section>
                </if>
            </volist>
        </nav>
    </div>
</div>

<script>
    function test(url,money) {
        var village_id = "{pigcms{$village_id}";
        window.location.href = url+"&money="+money+"&village_id="+village_id;
    }
</script>
</body>
</html>