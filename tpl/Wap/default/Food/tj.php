
<include file="Food:header" />

<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>

<script type="text/javascript" src="{pigcms{$static_path}meal/js/scroller.js"></script>

<script type="text/javascript" src="{pigcms{$static_path}meal/js/dmain.js"></script>

<script type="text/javascript" src="{pigcms{$static_path}meal/js/menu.js"></script>

<body onselectstart="return true;" ondragstart="return false;" ontouchstart="" style="background-color: #fbfbfb;">


<style>
    *{
        -webkit-touch-callout:none;  /*系统默认菜单被禁用*/
        -webkit-user-select:none; /*webkit浏览器*/
        -khtml-user-select:none; /*早期浏览器*/
        -moz-user-select:none;/*火狐*/
        -ms-user-select:none; /*IE10*/
        user-select:none;
    }

    .menu_detail .btndiv1 {

        position: absolute;

        right: 14px;

        margin-top: 5px;

        width: 78px;

        height: 25px;

    }

    .menu_detail .btn.del {

        background-position: -27px -44px;

    }

    .menu_detail .btn.active {

        background-color: #f9f9f9;

    }

    .menu_detail .num {

        line-height: 25px;

        text-align: center;

        border-width: 1px 0;

    }

    .menu_detail .btn, .menu_detail .num {

        float: left;

        width: 25px;

        height: 25px;

        background-color: #fff;

        border-width: 1px;

        -webkit-border-image: url(../tpl/Wap/default/static/takeout/image/border.gif) 2 stretch;

    }

    .menu_detail .btn.add {

        background-position: 0 -44px;

    }

    .menu_detail .btn.active {

        background-color: #f9f9f9;

    }

    .menu_detail .btn {

        display: inline-block;

        background: url(../tpl/Wap/default/static/takeout/image/s.png) no-repeat;

        background-size: 150px auto;

    }







    #speaker{

        top:0;

        width: 100%;

        height: 40px;

        line-height: 40px;

        position: fixed;

        z-index: 980;

        background-color: #ffffff;

        opacity: 0.95;

        overflow: hidden;

        box-shadow:0px 0px 2px #222;

        -webkit-box-shadow:0px 0px 2px #222;

    }

    #s-word{

        font-size: 13px;

        width: 82%;

        height: 40px;

        position: fixed;

        left: 40px;



    }

    #s-icon{

        width: 20px;

        height: 20px;

        position: fixed;

        top: 10px;

        left: 10px;

        background-color: #ffffff;

        background-size: 20px;

        background-repeat: no-repeat;

        background-image: url(../tpl/Wap/default/static/takeout/image/speaker.png);

    }

    #s-fork{

        width: 20px;

        height: 20px;

        position: fixed;

        top: 10px;

        right: 10px;

        background-color: #fffddf;

        background-size: 20px;

        background-repeat: no-repeat;

        background-image: url(../tpl/Wap/default/static/takeout/image/yellowfork.png);

    }

    .wb_arrow_new {
        border-right: 2px solid #ffffff;
        border-top: 2px solid #ffffff;
        height: 10px;
        width: 10px;
        margin:22px auto 0;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        border-left: 2px solid transparent;
        border-bottom: 2px solid transparent;
    }


    .zw_new {width:100%; height:170px; overflow:hidden; background: url(../tpl/Wap/default/static/images/aw.jpg) repeat-x top center; background-size:100% 100%;}
    .zj_new {width:90%; margin:0px auto; padding-top:10px;}
    .zb_new {width:26%; height:auto; float:left; overflow:hidden;}
    .yb_new {width:68%; float:right;}
    .mc_new {width:100%;}
    .mc2_new {width:100%; height:30px; overflow:hidden;}
    .ki_new {width:93%; float:left;}
    .ki2_new {width:5%; float:right;}
    .yellow_new {width:20%; text-align:center; line-height:22px; background-color:#ffdf3d; border-radius:2px; float:left; font-size:13px; color:#52250a;}
    .dbt_new {float:right; width:75%; line-height:22px; font-size:15px; color:#FFFFFF; font-weight:bold;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .yellow2_new {width:20%; text-align:center; line-height:22px; background-color:#2395ff; border-radius:2px; float:left; font-size:12px; color:#ffffff;}
    .dbt2_new {float:right; width:75%; line-height:22px; font-size:13px; color:#FFFFFF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .gg_new {width:100%; line-height:1.5; color:#FFFFFF; font-size:13px;}
	.yellow_new2 {width:20%; text-align:center; line-height:22px; background-color:#fb4746; border-radius:2px; float:left; font-size:13px; color:#ffffff;}
	.dbt_new2 {float:right; width:75%; line-height:22px; font-size:12px; color:#FFFFFF;}
	.mc2_newx {width:93%; height:60px; overflow:hidden;}

    .menu .left .top {
        padding: 0px;
    }
    .menu .left .top >div {
        width: 100%;
        border-left: 3px solid #2395ff;
        border-bottom:none;
        border-right:none;
        border-top:none;
        min-width: 74px;
        border-radius:0px;
        height: 37px;
        line-height: 35px;
        margin:0px 0px 8px 0px;
        text-align: center;
    }
    .menu .left .content ul li {
        line-height: 20px;
        text-align: center;
        font-size: 14px;
        padding: 10px 0;
        border-bottom: 1px #e7e7e7 solid;
    }
    .menu .right ul {
        border-top-color: #ffffff;
    }
    .menu .left .content ul li.on {
        background: #fff;
        color:#2395ff;
        border-left: 3px solid #2395ff;
        border-bottom:none;
        border-right:none;
        border-top:none;
    }
    .g_nav div {
        line-height: 28px;
        height: 50px;
        position: fixed;
        z-index: 200;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 10px;
    }
    .g_nav div .btn {
        float: right;
        width: 70px;
        font-weight: bold;
        margin-left: 8px;
        height: 28px;
        border: none;
    }
    .xmd {width:100%; padding-top:4px; margin:0px auto;}
    .ygg {width:100%; background-color:#FFFFFF; box-shadow:1px 1px 5px #dfdfdf;}
    .ygg:active {background-color:#f3f3f3;}
    .aft {width:90%; padding-top:20px; padding-bottom:10px; margin:0px auto;}
</style>

<script type="text/javascript">

    $(document).ready(function(){

        $('.mylovedish').click(function(){

            var id = parseInt($(this).find('.thisdid').val());

            var islove = 0;

            if ($(this).parents('li').attr('class') == 'like') {

                islove = 1;

            }

            $.post("{pigcms{:U('Food/dolike', array('mer_id' => $mer_id, 'store_id' => $store_id))}", {meal_id:id,islove:islove}, function(msg){});

        });

        $('#s-fork').click(function(){

            $('#speaker').hide();

            $('#l-nav').css({'top':0});

            $('#right').css({'top':0});

            $('.menu section').css('margin-top', '0px');

        });

        <if condition="!empty($store['store_notice'])">

            $('.menu section').css('margin-top', '0px');

        </if>

    });



    var islock=false;

    function next()

    {

        totalPrice = parseFloat($.trim($('#allmoney').text()));

        totalNum = parseInt($.trim($('#menucount').text()));

        if((totalNum>0) && (totalPrice>0)){

            var data=getMenuChecklist();//[{'id':id,'count':count},{'id':id,'count':count}]

            if((data.length>0) && !islock){

                islock=true;

                $('#nextstep').removeClass('orange show').addClass('gray disabled');

                $.ajax({

                    type: "POST",

                    url: "{pigcms{:U('Food/processOrder', array('mer_id' => $mer_id, 'store_id' => $store_id))}",

                    data: {"cart":data},

                    async:true,

                    success: function(res){

                        islock=false;

                        $('#nextstep').removeClass('gray disabled').addClass('orange show');

                        if (res.error ==0) {

                            window.location.href = "{pigcms{:U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $orid))}";

                        } else {

                            alert(res.msg);

                        }

                    },

                    dataType: "json"

                });

            }else{

                return false;

            }

        }else{

            return false;

        }

    }

</script>
<div data-role="container" class="container menu">

    <section data-role="body">

        <!--		<if condition="!empty($store['store_notice'])">

                    <div id="speaker">

                        <div id="s-icon"></div>

                        <span id="s-word"><marquee behavior="scroll" scrollamount="5" direction="left" width="100%" style="width: 100%;">{pigcms{$store['store_notice']}</marquee></span>

                        <div id="s-fork"></div>

                    </div>

                </if>-->

        <div class="zw_new">
            <if condition="$mer_notice">
            <div style="width:90%; margin:0px auto; height:40px;">
                <div style="width:11%; text-align:center; height:20px; line-height:20px; float:left; margin-top:10px; margin-right:10px;background-color: #fb4746;border-radius:2px; color:#FFFFFF; font-size:13px;">公告</div>

               <DIV id="scrollobj" style="white-space:nowrap;overflow:hidden;width:85%; height:40px; line-height:40px; color:#FFFFFF; font-size:13px;">
                   <php>echo $mer_notice;</php>
               </DIV>

                <div style="clear:both"></div>
            </div>
            </if>
            <div class="zj_new">
                <div class="zb_new"><img src="/upload/store/{pigcms{$store_info['pic_info']}" style="width:88px; height:88px; max-width:100%; max-height:100%; border-radius:2px;"></div>
                <div class="yb_new">
                    <div class="mc_new">
                        <div class="ki_new">
                            <div class="mc2_new">
                                <div class="yellow_new">品牌</div>
                                <div class="dbt_new">{pigcms{$store_info['name']}</div>
                                <div style="clear:both"></div>
                            </div>
                            <div class="mc2_new">
                                <div class="yellow2_new">电话</div>
                                <div class="dbt2_new" ><a href="tel: {pigcms{$store_info['phone']}" style="color: #ffffff;"> {pigcms{$store_info['phone']} <span style="font-weight:bold;">[点击拨打]</span></a></div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                        <div class="ki2_new">
                            <a href="{pigcms{:U('Merchant/index',array('mer_id'=>$store_info['mer_id']))}"><div class="wb_arrow_new"></div></a>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="mc_new">
					<div class="mc2_newx">
						<div class="yellow_new2">地址</div>
						<div class="dbt_new2">{pigcms{$store_info['area_ip_desc']}{pigcms{$store_info['adress']}</div>
						<div style="clear:both"></div>
					</div>
				</div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>

        <div class="xmd">

                <php>$list = array_shift($meals)['list']</php>
                <volist name="list" id="row">
                    <div class="ygg">
                    <div class="aft meal" meal_id="{pigcms{$row.meal_id}">
                        <div style="float:left; width:80px; height:80px; overflow:hidden; border-radius:4px;"><img src="{pigcms{$row.image}" style="width:100%; height:100%;"></div>
                        <div style="float:right; width:70%; height:80px; overflow:hidden;">
                            <div style="width:100%; height:29px; line-height:29px; overflow:hidden; font-size:18px; color:#5d5d5d;">{pigcms{$row.name}</div>

                            <div style="width:100%; height:51px; line-height:17px; overflow:hidden; font-size:12px; color:#909090;"><php>echo html_entity_decode(htmlspecialchars_decode($row['des']),ENT_QUOTES,"UTF-8");</php></div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
					<div style="width:90%; height:30px; overflow:hidden; text-align:right; margin:0px auto;">
                            <div style="font-size:16px; color:#fb4746; line-height:20px; width:100%; text-align:right;">￥{pigcms{$row.price}元({pigcms{$row.unit})</div>
                        </div>
                    </div>
                </volist>

            <div style="width:100%; text-align:center; line-height:50px; overflow:hidden; color:#8d8d8d; font-size:14px;">{pigcms{$Think.config.WEB_FOOTER}</div>
        </div>



    </section>

</div>



<div class="menu_detail" id="menuDetail">

    <img style="display: none;">

    <div class="nopic"></div>

    <!--a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a-->



    <div class="showfixd">

        <div class="btndiv1"><span><a class="btn del active"></a><span class="num">1</span></span><a class="btn add active" id="detailBtn" max="93"></a></div>

        <dl>

            <dt>价格：</dt>

            <dd class="highlight">￥<span class="price"></span></dd>

        </dl>

    </div>

    <p class="sale_desc">月售<span class="sale_num"></span>份</p>

    <dl>

        <dt>介绍：</dt>

        <dd class="info"></dd>

    </dl>

</div>

<!--div class="menu_detail" id="menuDetail">

	<img style="display: none;">

	<div class="nopic"></div>

	<a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>

	<dl>

		<dt>价格：</dt>

		<dd class="highlight">￥<span class="price"></span></dd>

	</dl>

	<p class="sale_desc"></p>

	<dl class="desc">

		<dt>介绍：</dt>

		<dd class="info"></dd>

	</dl>

</div-->

<include file="kefu" />

<script language="javascript" type="text/javascript">
    <!--
    function scroll(obj) {
        var tmp = (obj.scrollLeft)++;
        //当滚动条到达右边顶端时
        if (obj.scrollLeft==tmp) obj.innerHTML += obj.innerHTML;
        //当滚动条滚动了初始内容的宽度时滚动条回到最左端
        if (obj.scrollLeft>=obj.firstChild.offsetWidth) obj.scrollLeft=0;
    }
    setInterval("scroll(document.getElementById('scrollobj'))",20);
    //-->
</script>

<script type="text/javascript">

    window.shareData = {

        "moduleName":"Food",

        "moduleID":"0",

        "imgUrl": "{pigcms{$store.image}",

        "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Food/menu',array('mer_id' => $mer_id, 'store_id' => $store_id))}",

        "tTitle": "{pigcms{$store.name}",

        "tContent": "{pigcms{$store.txt_info}"

    };

</script>

{pigcms{$shareScript}

<script>
$('.meal').click(function(){
    var meal_id = $(this).attr('meal_id');
    window.location.href = '/wap.php?g=Wap&c=PropertyService&a=appointment&meal_id=' + meal_id;
});
</script>

</body>

</html>

