<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <link rel="stylesheet" href="{pigcms{$static_path}css/control_check.css">
    <link href="/tpl/WapMerchant/deafult/static/css/iconfont.css" rel="stylesheet">
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/gundong.js" charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--    <style type="text/css">-->
<!--        .weui_btn:hover {color:#FFFFFF;}-->
<!--        .item-list-container {-->
<!--            display: block;-->
<!--            background: #fff;-->
<!--            margin-bottom: 8px;-->
<!--            padding-bottom:10px;-->
<!--            color: #696969;-->
<!--            font-size: 13px;-->
<!--        }-->
<!--        .item-list-container:link {background-color:#eeeff4;}-->
<!--        .item-list-container:visited {background-color:#eeeff4;}-->
<!--        .item-list-container:active {background-color:#eeeff4;}-->
<!--        .item-list-container:hover {background-color:#eeeff4;}-->
<!---->
<!--        .item-detail {-->
<!--            width:100%;-->
<!--        }-->
<!--        .item-operation {-->
<!--            float: right;-->
<!--            margin-right:1%;-->
<!--            margin-left:2%;-->
<!--            color: #aaa;-->
<!--            text-align:right;-->
<!--        }-->
<!--    </style>-->

    <style type="text/css">
        .weui_btn:hover {color:#FFFFFF;}
        .item-list-container {
            display: block;
            background: #fff;
            margin-bottom: 8px;
            padding-bottom:3px;
            color: #696969;
            font-size: 13px;
        }
        .item-list-container:link {background-color:#eeeff4;}
        .item-list-container:visited {background-color:#eeeff4;}
        .item-list-container:active {background-color:#eeeff4;}
        .item-list-container:hover {background-color:#eeeff4;}
        .item-detail {
            width:100%;
        }
        .item-operation {
            float: right;
            margin-right:1%;
            margin-left:2%;
            color: #aaa;
            text-align:right;
        }
        .pigcms-container {
            background: #fff;
            padding: 10px 0 0;
            margin-bottom: 5px;
        }
        .search-container {
            position: relative;
            margin: 0 2%;
            width: 96%;
            background: #f4f8f7;
            border-radius: 10px;
        }
        #input-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .search-container i {
            margin-left:15px;
            margin-right:8px;
            color: #0697dc;
            font-size: 20px!important;
        }
        .iconfont {
            font-family: "iconfont" !important;
            font-size: 16px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }
        input[type='text'], input[type='password'], input[type='tel'], input[type='number'], select {
            font-size: 16px;
            height: 30px;
            line-height: 30px;
            border: 0;
            color: #696969;
            border-radius: 10px;
            outline: 0;
        }
        .icon-search:before {
            content: "\e63c";
        }
        .pigcms-search {
            background: #f4f8f7;
            width: 70%;
            color: #dcdcdc;
        }
        .header-fliter-container {
            background: #fff;
            padding: 4px 0 7px;
            text-align: center;
            color: #08af94;
            border-bottom: 1px solid #f0f0f0;
        }
        .gtt {color:#6f6d6b;}
        .item-price-sell {width:95%; margin:0px auto; height:40px; line-height:40px; font-size:14px; border-bottom:1px #f8f8f8 solid; color:#969696; padding-left:5px;}
        .item-name {width:58%; height:40px; line-height:40px; font-size:14px; color:#969696; float:left; overflow:hidden;}
        .item-price {width:40%; height:40px; line-height:40px; font-size:14px; color:#969696; float:right; text-align:right; margin-right:2%;}
        .item-sell {width:95%; margin-left:3%; height:40px; line-height:40px; font-size:14px; border-bottom:1px #f8f8f8 solid; color:#969696;white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            overflow: hidden;}
        .item-img {width:95%; margin-right:3%; text-align:right; padding-top:3%; height:30px;}
    </style></head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });
    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>新闻评论</header>
<div id="order-list-wrap">
    <div class="pigcms-container">
        <div class="search-container">
            <i class="iconfont icon-search"></i>
            <input type="text" class="pigcms-search" name="keyword" placeholder="新闻名称">
        </div>
        <div class="header-fliter-container"></div>
    </div>
    <div id="PullDown" class="scroller-pullDown" style="display: none;text-align: center">
        <!--        <img style="width: 20px; height: 20px;" src="{pigcms{$static_path}images/xxqq1.png" />-->
        <span id="pullDown-msg" class="pull-down-msg">
            <br>
            <strong style="color:#aaa !important;">下拉刷新</strong>
            <br>
        </span>
    </div>
    <div id="order-list-wrapper" class="pigcms-main">
        <div id="order-list-scroller">
            <ul id="order-list-ul">
            </ul>
        </div>
    </div>

</div>
<!--<volist name="reply_list" id="vo">-->
<!--        <div class="item-list-container">-->
<!--            <div class="item-detail">-->
<!--                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">新闻title：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> {pigcms{$vo.title}</span></div>-->
<!--                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">评论内容：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> {pigcms{$vo.content}</span></div>-->
<!--                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">评论人：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> {pigcms{$vo.nickname}</span></div>-->
<!--                <div style="width:100%; font-size:14px; height:40px; line-height:40px; border-bottom:1px #f8f8f8 solid;"><span style="color:#6f6d6b; font-family:'微软雅黑'; font-size:14px; padding-left:15px;">回复时间：</span><span style="font-size:14px; font-family:'微软雅黑'; color:#969696;"> {pigcms{$vo.add_time|date='Y-m-d',###} {pigcms{$vo.add_time|date='H:i:s',###}</span></div>-->
<!--            </div>-->
<!--        </div>-->
<!--</volist>-->
</body>
<script>
    var staticpath="{pigcms{$static_path}";
    var url="{pigcms{:U('House/village_newsReply')}";
    var village_id="{pigcms{$now_village.village_id}";
    $(function(){
        $(".pigcms-main").css('height', $(window).height()-50);
    })
</script>
<script src="{pigcms{$static_path}js/newsReply.js"></script>
</html>