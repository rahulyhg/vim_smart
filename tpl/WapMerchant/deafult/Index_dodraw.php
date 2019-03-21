
<include file="Public:top"/><body>

<div class="container container-fill" style='padding-top:10px'>
    <style>
        @media (max-height: 600px){
            .pigcms-main{
                padding-top: 10px;
            }
            .pigcms-container{
                margin-bottom: 20px;
            }
            .top-img-container{
                padding-bottom: 10px;
            }
            #login-container{
                margin: 1% 10px;
                padding: 1px 15px;
            }
            .pigcms-btn-block{
                padding: 20px 0;
            }
            #forget-password{
                margin: 10px 0;
                font-size: 12px;
            }
            #no-shop{
                margin: 10px 0 10px;
                font-size: 12px;
            }
        }
        .claim-text{
            background:#fff;
            text-align:center;
            width: 94%;
            margin: 0 3%;
            padding: 10px 0;
            color: #777;
            border-radius: 10px;
        }
    </style>
    <script>
        $(function(){
            $(".pigcms-main").css('height', $(window).height());
        })
    </script>
    <div class="container js_container">
    <form class="pigcms-main" id="form1" method="post" role="form" action="" enctype="multipart/form-data" onSubmit="return checkSubmit();">
<!--        <div class="weui_cells weui_cells_form">-->
<!--            <div class="weui_cell_hd" style="width: 20px;"><label class="weui_label"style="width: 20px;">姓名</label></div>-->
<!--            <div class="weui_cell_bd weui_cell_primary">-->
<!--                <input class="weui_input" type="number"  placeholder="请输入姓名">-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="weui_cells weui_cells_form">-->
<!--            <div class="weui_cell_hd" style="width: 20px;"><label class="weui_label"style="width: 20px;">银行卡</label></div>-->
<!--            <div class="weui_cell_bd weui_cell_primary">-->
<!--                <input class="weui_input" type="number" pattern="[0-9]*" placeholder="请输入银行卡号">-->
<!--            </div>-->
<!--        </div>-->

		
		<div class="shtx_dk">
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/fwe1.jpg" style="width:19px; height:18px; margin-top:7px;"/></div>
		<div class="shtx_kk"><input type="text" name="name" id="name" placeholder="请输入姓名" autocomplete='off' style="width:100%; height:20px; line-height:20px;"></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/fwe2.jpg" style="width:19px; height:16px; margin-top:7px;"/></div>
		<div class="shtx_kk"><input type="number" id="number"  name="number" value="" placeholder="请输入银行卡" style="width:100%; height:20px; line-height:20px;"></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_pic"><img src="http://www.hdhsmart.com/tpl/WapMerchant/deafult/static/images/fwe3.jpg" style="width:19px; height:20px; margin-top:6px;"/></div>
		<div class="shtx_kk"><input type="number" id="phone"  name="phone" value="" placeholder="请输入联系电话" style="width:100%; height:20px; line-height:20px;"></div>
		<div class="both"></div>
	</div>
</div>
			
			<div class="shtx_dk2">
	<div class="shtx_xm">
		<div class="shtx_wz">银行</div>
		<div class="shtx_wz4" id="bank"></div>
		<div class="both"><input type="hidden" class="login-input" id="bankname"  name="bankname" value="" /></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_wz">可提现金额:</div>
		<div class="shtx_wz2">{pigcms{$allincomecount['payall']}<span style="font-size:14px; color:#999999;">元</span></div>
		<div class="both"></div>
	</div>
	<div class="shtx_xm">
		<div class="shtx_wz">提现金额:</div>
		<div class="shtx_wz3"><input class="weui_input" type="number" name="withdraw" id="withdraw"  placeholder="请输入提现金额" style="text-align:right; width:100%; line-height:20px; height:20px;"></div>
		<div class="both"></div>
	</div>
</div>
			
			
			
			
        <button type="submit" id="submit" class="pigcms-btn-blockd pigcms-btn-block-warningxx" style='color:#fff'>提交</button>
    </form>
</div>
    <script type="text/javascript">
       function bankInfo(card,bankList)
        {
            var card_8 = card.substring(0, 8);
            if (typeof(bankList[card_8])!="undefined") {
                re = /工商银行|农业银行|邮储|邮政|建设银行|建行|交通银行|中国银行|广发|招商|浦东发展|汉口银行|中信/;
                str = bankList[card_8];
                if(re.test(str)){
                    return bankList[card_8];
                }else{
                    return "暂不支持该银行";
                }
            }
            var card_6 = card.substring(0, 6);
            if (typeof(bankList[card_6])!="undefined") {
                re = /工商银行|农业银行|邮储|邮政|建设银行|建行|交通银行|中国银行|广发|招商|浦东发展|汉口银行|中信/;
                str = bankList[card_6];
                if(re.test(str)){
                    return bankList[card_6];
                }else{
                    return "暂不支持该银行";
                }
            }
            var card_5 = card.substring(0, 5);
            if (typeof(bankList[card_5])!="undefined") {
                re = /工商银行|农业银行|邮储|邮政|建设银行|建行|交通银行|中国银行|广发|招商|浦东发展|汉口银行|中信/;
                str = bankList[card_5];
                if(re.test(str)){
                    return bankList[card_5];
                }else{
                    return "暂不支持该银行";
                }
                return bankList[card_5];
            }
            var card_4 = card.substring(0, 4);
            if (typeof(bankList[card_4])!="undefined") {
                re = /工商银行|农业银行|邮储|邮政|建设银行|建行|交通银行|中国银行|广发|招商|浦东发展|汉口银行|中信/;
                str = bankList[card_4];
                if(re.test(str)){
                    return bankList[card_4];
                }else{
                    return "暂不支持该银行";
                }
                return bankList[card_4];
            }

        }
        $('#number').bind('input propertychange', function() {
            var banklist = '{pigcms{$banklist}';
            var banklist =JSON.parse(banklist);
            if($(this).val().length>8){
                var bankname = bankInfo($(this).val(),banklist);
                if(bankname=="暂不支持该银行"||bankname=="该卡号有误"){
                    $("#bank").html("<span style='color:red;'>"+bankname+"</span>");
                    $("#bankname").val("");
                }else{
                    $("#bank").html('<span style="color:green;">'+'我'+bankname+'</span>');
                    $("#bankname").val(bankname);
                }
        }else{
                $("#bank").text("");
                $("#bankname").val("");
            }
        });
        $("#submit").click(function(){
            $("#submit").attr('disabled',true);
            var money = "{pigcms{$allincomecount['payall']}";
            var number = $.trim($("#number").val());
            var withdraw = $.trim($("#withdraw").val());
            var name = $.trim($("#name").val());
            var phone = $.trim($("#phone").val());
            money = parseFloat(money);
            withdraw = parseFloat(withdraw);
            if(number==""){
                alert("请填写卡号");
                $("#submit").attr('disabled',false);
                return false;
            }
            if(!/^\d{19}$/.test(number)){
                alert("请填写正确卡号");
                $("#submit").attr('disabled',false);
                return false;
            }
            if(phone==""){
                alert("请填写手机号码");
                $("#submit").attr('disabled',false);
                return false;
            }
            if(name==""){
                alert("请填写姓名");
                $("#submit").attr('disabled',false);
                return false;
            }
            if(withdraw<1){
                alert("提现金额不能小于1.00元");
                $("#submit").attr('disabled',false);
                return false;
            }
            if(withdraw>money){
                alert("超过最大提现金额");
                $("#submit").attr('disabled',false);
                return false;
            }
            $.ajax({
                url:"{pigcms{:U('Index/dodraw')}",
                type:"POST",
                data:$("#form1").serialize(),
                success:function(data){
                    if(data.status=="1"){
                        alert(data.info);
						window.location="{pigcms{:U('Index/withdraw')}";
                    }else{
                        alert(data.info);
                        $("#submit").attr('disabled',false);
                    }
                }
            })

        })
    </script>

</body>
<include file="Public:footer"/>
</html>
