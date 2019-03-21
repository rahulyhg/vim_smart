<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>在线预约</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
    <link rel="stylesheet" href="{pigcms{$static_path}css/openLog.css">
    <link href="/tpl/WapMerchant/deafult/static/css/iconfont.css" rel="stylesheet">
    <script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
    <!--    <script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>-->
    <!--    <script type="text/javascript" src="{pigcms{$static_path}layer/layer.m.js" charset="utf-8"></script>-->
    <!--    <script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>-->
    <script type="text/javascript" src="{pigcms{$static_path}js/common_ac.js" charset="utf-8"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/gundong.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/shop_order.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        .item-price-sell {width:95%; margin:0px auto; height:35px; line-height:35px; font-size:14px; border-bottom:1px #f8f8f8 solid; color:#969696; padding-left:5px;}
        .item-name {width:45%; height:35px; line-height:35px; font-size:14px; color:#969696;}
        .item-price {width:45%; height:35px; line-height:35px; font-size:14px; color:#969696; margin-left:10%;}
        .item-sell {width:95%; margin-left:3%; height:35px; line-height:35px; font-size:14px; border-bottom:1px #f8f8f8 solid; color:#969696;}
        .item-img {width:95%; margin-right:3%; text-align:right; padding-top:3%; height:30px;}
        .item-img1 {width:95%; margin-right:3%;  padding-top:3%; height:30px;}
    </style>
</head>
<script type="text/javascript">
    $(function(){
        $('#backBtn').click(function(){
            window.history.go(-1);
        });
    })
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>在线预约</header>
<!--列表开始-->
<div id="order-list-wrap">
    <div class="pigcms-container">
        <div class="search-container">
            <i class="iconfont icon-search"></i>
            <input type="text" class="pigcms-search" name="keywords" placeholder="用户名/手机">
        </div>
        <div class="header-fliter-container"></div>
    </div>
    <div id="order-list-wrapper" class="pigcms-main" style="height:36rem">
        <scroller
            :on-infinite="infinite"
            :on-refresh="refresh"
        >
            <ul id="order-list-ul" style="padding-bottom: 5px">

                <li v-for="(item, index) in items" class="item-list-container">
                    <div class="item-detail">
                        <p class="item-price-sell">
                            <span class="item-name">
                                <span class="gtt">提交人：</span>{{ item.realname}}
                            </span>
                            <span class="item-price">
                                <span class="gtt">群发类型：</span>{{ item.msg_type_name}} / {{ item.send_type_name}}
                            </span>
                        </p>
                        <p class="item-sell">
                            <span class="gtt">发布时间：</span>
                            <span v-if="item.send_time">{{ item.send_time}}</span>
                            <span v-else>未发送</span>
                        </p>
                        <p class="item-sell" v-if="item.appointment_start_time != '1970-01-01 08:00'">
                            <span class="gtt">发布对象：</span>
                            <span v-if="item.village_name">{{item.village_name}}</span>
                            <span v-else>所有社区</span>
                            <span v-if="item.company_name">{{item.company_name}}</span>
                            <span v-else>所有公司</span>
                        </p>
                        <p class="item-sell">
                            <span class="gtt">当前状态:</span>
                            <span >
                                <font style="color:red" v-if="item.status == 0"  >未处理</font>
                                <font style="color:blue"  v-else-if="item.status == 1" >通过审核</font>
                                <font style="color:peru"  v-else-if="item.status == 2" >已退回</font>
                            </span>
                        </p>
                        <p class="item-img">
<!--                            <a class="" href="javascript::">-->
<!--                            <span class="item-img1" pid="{{ item.id }}" v-on:click="set_read(index)" v-show="item.status==0">-->
<!--                                <img src="http://www.hdhsmart.com/tpl/Wap/pure/static/images/xxqq1-19.png" width="50" height="23">-->
<!--                            </span>-->
<!--                            </a>-->
                            <a v-bind:href="item.detail_link">
                                <img src="http://www.hdhsmart.com/tpl/Wap/pure/static/images/xqt.png" width="50" height="23">
                            </a>
                        </p>
                    </div>
                </li>
            </ul>
        </scroller>
    </div>
</div>
<!--列表结束-->
<!--**
* 下拉刷新，上拉加载
* @update-time: 2017-07-03 15:22:57
* @author: 王亚雄
*-->
<script src="{pigcms{$static_path}js/vue.min.js"></script>
<script src="{pigcms{$static_path}js/vue-scroller.min.js"></script>
<script>
    new Vue({
        //下拉祖级元素
        el: '#order-list-wrapper',

        data: {
            items: []
        },
        //构造函数
        mounted: function () {
            this.page = 1;
        },
        methods: {
            //上滑
            infinite: function (done) {
                //添加数据
                var re = this.addData();
                if(!re){
                    //没有数据时终止下拉事件
                    done(true);
                    return;
                }else{
                    done();
                }
            },
            //下滑
            refresh: function (done) {
                //刷新
                window.location.reload();
            },

            //添加数据
            addData:function(){
                var self = this;
                //异步获取数据
                var data;
                var url =  "{pigcms{$url}" + "&{pigcms{:C('VAR_PAGE') ?: 'p' }=" + self.page;
                $.ajax({
                    url:url,
                    dataType:"json",
                    async: false,//取消异步 重要
                    success:function(re){
                        data = re;
                    }
                });
                if(data.err!==0) return false;
                this.items = this.items.concat(data.data);
                //成功获取后
                this.page ++;
                return true;

            },

            //标记为已处理
            set_read:function(i){
                if(window.confirm("你确认标记为已读")){
                    //异步获取数据
                    var data;
                    var url =  "{pigcms{:U('audit_group_msg_act')}";
                    var msg_id = this.items[i].id;
                    $.ajax({
                        url:url,
                        data:{msg_id:msg_id},
                        dataType:"json",
                        async: false,//取消异步 重要
                        success:function(re){
                            data = re;
                        }
                    });

                    if(data.err===0){
                        this.items[i].status = data.data.status;
                    }else{
                        alert("发生错误,请重试");
                    }
                }

            }
        }
    });


    //搜索（会刷新页面）
    $('.icon-search').click(function(){
        search();
    });

    $('input[name="keywords"]').keyup(function(event){
        if(event.keyCode ==13){
            search();
        }
    });


    function search(){
        var keywords = $('input[name="keywords"]').val();
        window.location.href = "{pigcms{$url}" + "&keywords=" + keywords;
    }

</script>
</body>
</html>