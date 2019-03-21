<include file="Public:top"/>
<link href="{pigcms{$static_path}css/weui.css" rel="stylesheet"/>
<style type="text/css">
<!--
.weui_dialog_bd {
  padding: 10px 20px 0;
  font-size: 14px;
  color: #000000;
  text-align:left;
  line-height:1.7rem;
}
-->
</style><body>
<header class="pigcms-header mm-slideout">
    <p id="pigcms-header-title">提现操作</p>
			<div class="sjtx_txsm">
			<div class="txx2">
			
			<div class="container js_container">
    <div class="page slideIn dialog">
    <div class="bd spacing">
        <a href="javascript:;" id="showDialog2">提现说明</a><br>
    </div>
    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog2" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_bd">1、办理提现需提供正确银行卡（不支持信用卡）；<br/>
2、提现时间为每月月底；<br/>
3、提现申请提交后系统将在1个工作日内受理，提现成功后3-5个工作日到账.</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->
    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog3" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_bd">
                <volist name="info" id="v">
                    <div class="sjtx_ki">
                        <div class="sjtx_fq">
                            <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">提现金额:{pigcms{$v.tc_money}.00元</div>
                            <div class="sjtx_cw"style="margin-top: -10px;width: 400px;">提现状态:<if condition="$v['status'] eq 0"><font color="red">待处理</font><elseif condition="$v['status'] eq 1"/><font color="red">审核中</font><elseif condition="$v['status'] eq 2"/><font color="green">通过审核</font><else/><font color="red">审核不通过</font></if>
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">提交时间:{pigcms{$v.sub_time|date="Y-m-d",###}</div>
                            </div>
                            <if condition="$v['status'] neq 0">
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核人:{pigcms{$v.dispose_name}</div>
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核时间:{pigcms{$v.dispose_time|date="Y-m-d",###}</div>
                            </if>
                            <if condition="$v['remark'] neq ''">
                                <div class="sjtx_cw" style="margin-top: -10px;width: 400px;">审核说明:{pigcms{$v.remark}</div>
                            </if>
                        </div>
                        <div class="both"></div>
                    </div>
                </volist>
            </div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog2 primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->
</div>
</div>
			</div>
			
			
			
			<div class="txx"><img src="{pigcms{$static_path}/images/txx.jpg" style="width:50%; height:50%;" /></div>
			<div class="both"></div>
		</div>
</header>
<!--左侧菜单-->
<include file="Public:leftMenu"/>
<!--左侧菜单结束-->
<link rel="stylesheet" href="{pigcms{$static_path}css/shop.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_index.css">
<div class="pigcms-main">
    <if condition="!empty($wap_MerchantAd)">
        <script src="{pigcms{$static_path}js/swipe.js"></script>
        <div class="pigcms-container">
            <div class="addWrap">
                <div class="swipe" id="mySwipe">
                    <div class="swipe-wrap">
                        <volist name="wap_MerchantAd" id="adv">
                            <div>
                                <a href="{pigcms{$adv['url']}">
                                    <img class="img-responsive" src="{pigcms{$adv['pic']}"  alt="{pigcms{$adv['name']}"/>
                                </a>
                            </div>
                        </volist>
                    </div>
                </div>
                <div id="position_wrap">
                    <ul id="position">
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                var banner_w = $(window).width();
                var banner_h = 200 * banner_w / 640;
                $(".img-responsive").css('height',banner_h);
                for(var i=0;i<$(".img-responsive").length;i++){
                    $("<li class=''></li>").appendTo('#position');
                }
                $("#position li:first").addClass('cur');
                var bullets = document.getElementById('position').getElementsByTagName('li');
                var banner = Swipe(document.getElementById('mySwipe'), {
                    auto: 4000,
                    continuous: true,
                    disableScroll: false,
                    callback: function(pos) {
                        var i = bullets.length;
                        while (i--) {
                            bullets[i].className = ' ';
                        }
                        bullets[pos].className = 'cur';
                    }
                });
            </script>
        </div>
    </if>
    <div class="pigcms-container" id="count-container" style="">
		
		<div class="sjtx_bj">
		<div class="sjtx_txje">
			<div class="sjtx_txje2">
				<div class="sjtx_jy">交易总金额</div>
				<div class="sjtx_jy2">{pigcms{$allincomecount['actualall']}<span style="font-size:18px; font-weight:normal;">元</span></div>
			</div>
			<div class="sjtx_txje3">
				<div class="sjtx_jy">可提现金额</div>
				<div class="sjtx_jy2">{pigcms{$allincomecount['payall']}<span style="font-size:18px; font-weight:normal;">元</span></div>
			</div>
			<div class="both"></div>
		</div>
		<a href="{pigcms{:U('Index/dodraw')}"><div class="sjtx_but">我要提现</div></a>
            <a href="javascript:;" id="showDialog3"><div class="sjtx_but">进度查询</div></a>
            <div style="height:14px; overflow:hidden;"></div>
	</div>
	
<div class="sjtx_sna">最近30天收支明细</div>
<volist name="list" id="vo">
<div class="sjtx_ki">
	<div class="sjtx_fq">
        <if condition="$vo['name'] eq '4'">
            <div class="sjtx_cw">{pigcms{$vo['order_name']}</div>
            <else/>
            <div class="sjtx_cw">{pigcms{$vo['order_name']['name']}</div>
        </if>
	</div>
	<div class="sjtx_fq2">
		<div class="sjtx_cw2">{pigcms{$vo['pay_time']|date="Y-m-d" ,###}</div>
        <if condition="$vo['name'] eq '4'">
            <div class="sjtx_cw3" style="color: red;">-{pigcms{$vo['payment_money']}元</div>
            <else/>
            <div class="sjtx_cw3" style="color: green;">+{pigcms{$vo['order_name']['price']}元</div>
        </if>
	</div>
	<div class="both"></div>
</div>
</volist>
        <script src="{pigcms{$static_path}js/zepto.min.js"></script>
        <script>
            $('#showDialog2').click(function (e) {
                var $dialog = $('#dialog2');
                $dialog.show();
                $dialog.find('.weui_btn_dialog').one('click', function () {
                    $dialog.hide();
                });
            })
            $('#showDialog3').click(function (e) {
                var $dialog = $('#dialog3');
                $dialog.show();
                $dialog.find('.weui_btn_dialog2').one('click', function () {
                    $dialog.hide();
                });
            })
        </script>
</div>
<div id="share-copy-wrap">
    <img src="{pigcms{$static_path}/images/android_share.png" id='android-share-img'>
    <img src="{pigcms{$static_path}/images/android_copy.png" id='android-copy-img'>
    <img src="{pigcms{$static_path}/images/ios_share.png" id='ios-share-img'>
    <img src="{pigcms{$static_path}/images/ios_copy.png" id='ios-copy-img'>
    <img src="{pigcms{$static_path}/images/qrcode.png" id='qrcode-img'>
</div>
</div>
</body>

<script type="text/javascript">
    var os = "windows",
        container = "web",
        chart_url = "{pigcms{:U('Index/getchart')}",
        pic_url = "" ? "" : "";
</script>
<script src="{pigcms{$static_path}/js/chart.min.js"></script>
<script src="{pigcms{$static_path}/js/shop_index.js"></script>
<script type="text/javascript">
    var on = false;
    $(".settings-icon").click(function(event) {
        $this = $(this);
        if(!on){
            var url = "";
            $.post(url, '', function(data) {
                on = true;
                $("#confirm-close").show();
                $("#status-container span").text("店铺正常营业中").css('color','#696969');
            });

        }
    });


</script>
<include file="Public:footer"/>
</html>
