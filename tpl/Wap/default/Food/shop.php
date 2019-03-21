<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>员工食堂</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="./static/Wap/food/shop/css/style.css" rel="stylesheet" type="text/css" />
    <link href="./static/Wap/food/shop/css/weui.css" rel="stylesheet" type="text/css" />
    <link href="./static/Wap/food/shop/css/weui2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./static/Wap/food/shop/css/baguettebox.min.css">
    <script src="./static/Wap/food/shop/js/baguettebox.min.js"></script>
    <script src="./static/Wap/food/shop/js/zepto.min.js"></script>

    <script>
        $(function(){
            $('.weui-number-plus').click(function(){
                upDownOperation( $(this) );
            });
            $('.weui-number-sub').click(function(){
                upDownOperation( $(this) );
            });

//            //评分js
//            var arr = ["1分","2分","3分","4分","5分"];
//            var num = -1;
//            $(".weui-rater a").mouseover(function(){
//                var thisL = $(this).index();
//                for(var i = 0;i < thisL;i++){
//                    $(".weui-rater a").eq(i).addClass('checked');
//                }
//                for(var i = thisL; i < 5;i++){
//                    $(".weui-rater a").eq(i).removeClass('checked');
//                }
//                $(this).addClass('checked');
//            })
//            $(".weui-rater a").mouseout(function(){
//                var thisL = $(this).index();
//                for(var i = thisL; i < 5;i++){
//                    $(".weui-rater a").eq(i).removeClass('checked');
//                }
//            })
//            $(".weui-rater").mouseout(function(){
//
//                for(var i = 0; i < num;i++){
//                    $(".weui-rater a").eq(i).addClass('checked');
//                }
//            })
//            $(".weui-rater a").click(function(){
//                var thisL = $(this).index();
//                $("#fen").html(arr[thisL]);
//                $(this).addClass('checked');
//                num = thisL+1;
//                console.log(num);
//            })

        });
    </script>
    <style type="text/css">
        .bx {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .bx2 {width:90%; margin:0px auto; padding:20px 0 20px 0;}
        .ty {width:100%; margin-top:15px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .ty2 {width:95%; margin-left:5%; padding-top:20px;}
        .ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
        .geq3 {width:90%; padding-top:25px; margin:0px auto; padding-bottom:15px;}
        .fo {width:80px; height:80px; overflow:hidden; border-radius:4px; float:left; align-items: center; justify-content: center; display: flex; border: 1px #dfdfdf solid;}
        .fof {width:80px; height:80px; overflow:hidden;}
        .fo2 {width:70%; float:left; margin-left:5%;}
        .k1 {width:100%; height:20px; line-height:20px; color:#333333; font-size:18px;}
        .k2 {width:100%; height:40px; overflow:hidden;}
        .kf {width:55%; float:left; margin-top:7px; margin-right:10px;}
        .kf2 {width:40%; height:40px; overflow:hidden; float:left; line-height:40px; color:#666666; font-size:14px;}
        .ps {width:100%; padding-top:25px; padding-bottom:20px;}
        .ps2 {width:100%; background-color:#f8f8f8; border-radius:4px;}
        .ps3 {width:90%; margin:0px auto;}
        .k3 {width:100%; height:20px; line-height:20px; color:#666666; font-size:14px;}
        .k4 {width:100%; height:20px; line-height:20px; color:#333333; font-size:16px;}
        .rs {width:100%; height:39px; line-height:39px; overflow:hidden; border-bottom:1px #e6e6e6 solid; color:#666666; font-size:14px;}
        .rs2 {width:100%; height:40px; line-height:40px; overflow:hidden; color:#666666; font-size:14px;}
        .bw {width:32%; height:42px; overflow:hidden; float:left; text-align:center; line-height:42px; background-color:#188cf1; color:#FFFFFF; margin-right:2%; border-radius:4px;}
        .bw:active {background-color:#0070d2;}
        .bw2 {width:32%; height:42px; overflow:hidden; float:left; text-align:center; line-height:42px; background-color:#fdb55a; color:#FFFFFF; margin-right:2%; border-radius:4px;}
        .bw2:active {background-color:#e59c41;}
        .bw3 {width:32%; height:42px; overflow:hidden; float:left; text-align:center; line-height:42px; background-color:#e72524; color:#FFFFFF; border-radius:4px;}
        .bw3:active {background-color:#d30d0c;}
        .nm {width:10%; float:left;}
        .nm2 {width:85%; float:right;}
        .jj {width:100%; margin-top:10px; margin-bottom:15px;}
        .jj2 {width:5%; margin-left:5%;}
        .jj3 {width:100%; font-size:14px; color:#898989;}
        .jj4 {width:90%; margin:0px auto; padding-top:10px; padding-bottom:10px; line-height:1.7;}
        .pow {width:100%; margin-top:10px; height:45px; line-height:45px; text-align:center; border-top:1px #e7e7e7 solid; text-align:center; overflow:hidden; color:#999999;}
        .cw {width:100%; height:80px; margin-bottom:10px; overflow:hidden;}
        .cw2 {width:80px; height:80px; border-radius:4px; margin-right:15px; float:left;}
        .cw3 {width:100%; line-height:35px; overflow:hidden; border-bottom:1px #e7e7e7 solid;}
        .cw4 {line-height:35px; overflow:hidden; float:left; margin-right:2%; color:#666666; font-weight:bold;}
        .cw5 {line-height:35px; overflow:hidden; float:left; color:#84848a;}
        .page-hd {
            padding:5px 0px 0px 0px;
        }
        .weui-rater-box {
            position: relative;
            margin-right: 2px;
            font-size: 15px;
            width: 15px;
            height: 15px;
            color: rgb(255, 204, 102);
        }
        .weui-rater a {line-height:15px;}
        .weui-rater a {display:inline;}
        .weui_cells_title {
            margin-top: 0px;
            margin-bottom: 0px;
            padding-left:0px;
            padding-right:0px;
            color: #ff6000;
            font-size: 14px;
        }
        .weui-rater a.checked {
            color: #ffaa0c!important;
            cursor: not-allowed;
        }
        .ktl2 {width:90%; margin:0px auto; padding-bottom:5px;}
        .ktl {width:100%; padding-top:20px;}
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="bx">
    <div class="bx2">
        <div style="width:100%;">
            <div class="fo"><img src="{pigcms{$store['images'][0]}" style="width:80px; height:auto;" /></div>
            <div class="fo2">
                <div class="k1">{pigcms{$store['name']}</div>
                <div class="k2">
                    <div class="kf">
                        <div class="page-hd" style="float:left;">

                            <div class="weui-rater">
                                <php>$checked =  floor($store['score_mean'])>=1 ? "checked" : ""</php>
                                <a data-num = "0" class="weui-rater-box {pigcms{$checked}"> <span class="weui-rater-inner">★</span> </a>
                                <php>$checked =  floor($store['score_mean'])>=2 ? "checked" : ""</php>
                                <a data-num = "1" class="weui-rater-box {pigcms{$checked}"> <span class="weui-rater-inner">★</span> </a>
                                <php>$checked =  floor($store['score_mean'])>=3 ? "checked" : ""</php>
                                <a data-num = "2" class="weui-rater-box {pigcms{$checked}"> <span class="weui-rater-inner">★</span> </a>
                                <php>$checked =  floor($store['score_mean'])>=4 ? "checked" : ""</php>
                                <a data-num = "3" class="weui-rater-box {pigcms{$checked}"> <span class="weui-rater-inner">★</span> </a>
                                <php>$checked =  floor($store['score_mean'])>=5 ? "checked" : ""</php>
                                <a data-num = "4" class="weui-rater-box {pigcms{$checked}"> <span class="weui-rater-inner">★</span> </a>
                            </div>

                            <div id='fen' class="weui_cells_title" style="float:right; line-height:16px; margin-left:5px;"></div>
                        </div>
                    </div>
                    <div class="kf2">月售{pigcms{$store['sale_count']}单</div>
                    <div style="clear:both"></div>
                </div>
                <div class="k3">¥20起送 <span style="color:#cccccc;">|</span> 平均37分钟 <span style="color:#cccccc;">|</span> {pigcms{$dt}</div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="ps">
            <div class="ps2">
                <div class="ps3">
                    <div class="rs">配送费：<php>echo intval($store['delivery_fee'])?:"免费"</php></div>
                    <div class="rs2">公告：<php>echo $mer_notice</php></div>
                </div>
            </div>
        </div>
        <div style="width:100%;">
            <style>
                .bw span,.bw2 span,.bw3 span{
                    background-color: transparent !important;
                    color: #ffffff;
                }
            </style>
            <if condition="$store['store_type'] eq '0'">
                <div class="bw">
                    <a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'is_reserve' => 1))}" class="schedule"><span class="btn orange bigfont">在线预约</span></a>
                </div>
                <div class="bw2">
                    <a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont">在线购买</span></a>
                </div>
                <div class="bw3">
                    <a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="schedule"><span class="btn bigfont" style="background: #FCB402;">我要外卖</span></a>
                </div>
                <elseif condition="$store['store_type'] eq '3'"/>
                <div class="bw">
                    <a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'is_reserve' => 1))}" class="schedule"><span class="btn orange bigfont">在线预约</span></a>
                </div>
                <div class="bw2">
                    <a href="{pigcms{:U('Food/tj', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont">在线购买</span></a>
                </div>
                <div class="bw3">
                    <a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="schedule"><span class="btn bigfont" style="background: #FCB402;">我要外卖</span></a>
                </div>
                <else />
                <div class="bw2">
                    <a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'is_reserve' => 1))}" class="schedule"><span class="btn orange bigfont">在线预约</span></a>
                </div>
                <div class="bw3">
                    <a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}" class="order"><span class="btn green bigfont">在线购买</span></a>
                </div>
            </if>



            <div style="clear:both"></div>
        </div>
    </div>
</div>


<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="./static/Wap/food/shop/picture/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">客户点评</div>
        <div style="clear:both"></div>
    </div>
    <div class="ktl2">
<!--第一条记录-->
        <volist name="reply_list" id="row" offset="0" length="1">
        <div class="ktl">
            <div class="nm"><img src="./static/Wap/food/shop/picture/nm.jpg" style="width:100%; height:auto;" /></div>
            <div class="nm2">
                <div class="k4">{pigcms{$row.nickname} <span style="color:#b4b4b4; font-size:14px;">{pigcms{$row.add_time}</span></div>
                <div class="jj">
                    <!--<div class="jj2"><img src="./static/Wap/food/shop/picture/jj.jpg" style="width:100%; height:auto;" /></div>-->
                    <div class="jj3">{pigcms{$row.comment}</div>
                </div>
                <!--<div class="fof">
                    <div id="container" class="container">
                        <foreach name="row.pics" item="img">
                            <img src="{pigcms{$img['image']}" style="width:80px; height:80px;" />
                        </foreach>
                    </div>
                    <div id="popup">
                        <div class="bg"><img src="./static/Wap/food/shop/" alt="" style="width:100%; height:auto;"/></div>
                    </div>
                </div>-->
            </div>
            <div style="clear:both"></div>
        </div>
        </volist>
<!--第一条记录结束-->
        <div id = "showdiv" style="display:none;">
<!--后续初始被影藏的记录-->
            <volist name="reply_list" id="row" offset="1" >
            <div class="ktl">
                <div class="nm"><img src="./static/Wap/food/shop/picture/nm.jpg" style="width:100%; height:auto;" /></div>
                <div class="nm2">
                    <div class="k4">{pigcms{$row.nickname} <span style="color:#b4b4b4; font-size:14px;">{pigcms{$row.add_time}</span></div>
                    <div class="jj">
                        <div class="jj2"><img src="./static/Wap/food/shop/picture/jj.jpg" style="width:100%; height:auto;" /></div>
                        <div class="jj3">
                            <div class="jj4"><span style="color:#333333;">用户点评：</span>
                                {pigcms{$row.comment}
                            </div>
                        </div>
                    </div>
                    <div class="fof">
                        <foreach name="row.pics" item="img">
                            <img src="{pigcms{$img['image']}" style="width:80px; height:80px;" />
                        </foreach>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            </volist>
<!--后续初始被影藏的记录结束-->
        </div>

    </div>
    <a href="javascript:;" onClick="showHideCode(this)"><div class="pow">查看全部评价</div></a>
</div>

<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="./static/Wap/food/shop/picture/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">商家实景</div>
        <div style="clear:both"></div>
    </div>
    <div class="geq3">
        <div class="cw">
            <div class="baguetteBoxOne gallery">
                <foreach name="store.images" item="img">
                    <a href="{pigcms{$img}">
                        <img src="{pigcms{$img}" alt="" style="width:20%;height:100%">
                    </a>
                </foreach>
             <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>

<div class="ty4">
    <div class="ty2">
        <div style="float:left;"><img src="./static/Wap/food/shop/picture/fw2.jpg" style="width:5px; height:auto;" /></div>
        <div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">商家详情</div>
        <div style="clear:both"></div>
    </div>
    <div style="width:100%; padding-top:15px; padding-bottom:30px;">
        <div class="cw3">
            <div style="width:90%; margin:0px auto;">
                <div class="cw4">电话：</div>
                <div class="cw5">{pigcms{$store['phone']}</div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="cw3">
            <div style="width:90%; margin:0px auto;">
                <div class="cw4">地址：</div>
                <div class="cw5">{pigcms{$store['adress']}</div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="cw3">
            <div style="width:90%; margin:0px auto;">
                <div class="cw4">服务简介：</div>
                <div class="cw5"><php>echo html_entity_decode(htmlspecialchars_decode($store['txt_info']),ENT_QUOTES,"UTF-8");</php></div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="cw3">
            <div style="width:90%; margin:0px auto;">
                <div class="cw4">服务特色：</div>
                <div class="cw5">{pigcms{$store['feature']}</div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>

<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司</div>
<script>
    baguetteBox.run('.baguetteBoxOne', {
        animation: 'fadeIn',
    });
</script>
<script type="text/javascript">

    function showHideCode(){
        //$("#showdiv").toggle('100');

    }
</script>
</body>