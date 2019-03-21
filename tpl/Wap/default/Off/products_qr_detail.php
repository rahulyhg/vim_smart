<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>物品管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/village.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/weui.css" rel="stylesheet" type="text/css" />
    <link href="/Car/Admin/Public/assets/global/css/qr_d_css/kui.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        <!--
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:14px;}
        header {
            height: 50px;
            background-color: #389ffe;
            color: white;
            line-height: 50px;
            text-align: center;
            position: relative;
            font-size: 18px;
        }
        .shtx_kek {
            float: left;
            line-height: 33px;
            border: 0;
            font-size: 14px;
            margin-left: 8px;
            width: 60%;
            color: #b6b6b6;
            white-space:nowrap;
            text-overflow:ellipsis;
            -o-text-overflow:ellipsis;
            overflow: hidden;
        }
        a, a:visited, a:hover {
            color: #ffffff;
            text-decoration: none;
            outline: 0;
        }
        .weui_btn_primary {
            background-color: #389ffe;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
        .weui_btn {
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-left: 14px;
            padding-right: 14px;
            box-sizing: border-box;
            font-size: 17px;
            text-align: center;
            text-decoration: none;
            color: #FFFFFF;
            line-height: 2.5;
            border-radius: 5px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            overflow: hidden;
        }
		input:-webkit-autofill,select:-webkit-autofill {  
			-webkit-box-shadow: 0 0 0px 1000px white  inset !important;  
		} 
		 
		 
		input{
			outline-color: invert ;
			outline-style: none ;
			outline-width: 0px ;
			border: none ;
			border-style: none ;
			text-shadow: none ;
			-webkit-appearance: none ;
			-webkit-user-select: text ;
			outline-color: transparent ;
			box-shadow: none;
		}
		.blue {background-color:#3598dc;}
		.blue:active {background-color:#2382c4;}
		
		.Green {background-color:#09bb07;}
		.Green:active {background-color:#09ac07;}
		
		.hsd {background-color:#e1e5ec;}
		.hsd:active {background-color:#d0d4db;}
		
		.dhs {background-color:#e7505a;}
		.dhs:active {background-color:#ca4750;}
		
		.sls {background-color:#36c6d3;}
		.sls:active {background-color:#2bafbb;}
		
		.hse {background-color:#67809F;}
		.hse:active {background-color:#526987;}

        input:disabled{background-color: #e8e8e8;}
		.weui_btn:after {border:none;}
    </style>
    {pigcms{$shareScript}
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body>
<form action="{pigcms{:U('Off/products_qr_detail')}" method="post" id="ccc">
    <div class="shtx_dkx">
        <div class="shtx_xm">
            <div class="kkw">二维码编号&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.pro_qrcode}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">分类名称&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.tname}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">物品名称&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.pro_name}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="kkw">所属区域&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.zone_name}
            </div>
            <div class="both"></div>
        </div>
        <div class="shtx_xm">
            <div class="kkw">物品单价&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.pro_price}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">物品品牌&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.band}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">采购日期&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.purch_time|date="Y-m-d",###}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">物品供应商&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.pro_supplier}
            </div>
            <div class="both"></div>
        </div>

        <div class="shtx_xm">
            <div class="kkw">入库时间&nbsp;:&nbsp;</div>
            <div class="shtx_kek">{pigcms{$proArr.create_time|date="Y-m-d H:i:s",###}
            </div>
            <div class="both"></div>
        </div>

        <if condition="$proArr['receive'] eq 1" >
            <div class="shtx_xm">
                <div class="kkw">领取时间&nbsp;:&nbsp;</div>
                <div class="shtx_kek">{pigcms{$proArr.trans_time|date="Y-m-d H:i:s",###}
                </div>
                <div class="both"></div>
            </div>
        </if>

        <div class="shtx_xm">
            <div class="kkw">责任人&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</div>
            <div class="shtx_kek"><input name="borrower" id="borrower" value="{pigcms{$proArr.borrower}" type="text" <if condition="$isOpen neq 1">disabled</if> style="width:96%; border:1px #d1d1d1 solid; height:25px; line-height:25px; border-radius:0px; font-size:14px; padding-left:5px; margin-top:2px;">
            </div>
            <div class="both"></div>
        </div>
        <input style="display: none;" name="pro_qrcode" value="{pigcms{$pro_qrcode}" />

    </div>
</form>
<div class="zkd">
    <if condition="$isOpen eq 1">
        <div style="width:48%; float:left;"><a class="weui_btn blue" onclick="check()">提交</a></div>
        <else/>
        <div style="width:48%; float:left;"><a class="weui_btn blue" onclick="error()">提交</a></div>
    </if>
    <div style="width:48%; float:right;"><a class="weui_btn dhs" href="{pigcms{:U('Off/web_history_qrcode',array('id'=>$proArr['qid']))}"  >历史记录</a></div>
	<div style="clear:both"></div>
    <br />
    <if condition="$isOpen eq 1">
        <div style="width:48%; float:left;"><a class="weui_btn sls" href="{pigcms{:U('Off/products_list')}">数据分析</a></div>
        <div style="width:48%; float:right;"><a class="weui_btn hse" href="#" onclick="qrcode()">扫一扫</a></div>
    <else/>
        <div><a class="weui_btn hse" href="#" onclick="qrcode()">扫一扫</a></div>
    </if>
	<!-- <div style="width:48%; float:left;"><a class="weui_btn sls" href="{pigcms{:U('Off/products_list')}">数据分析</a></div> -->
    <!-- <div style="width:48%; float:right;"><a class="weui_btn hse" href="#" onclick="qrcode()">扫一扫</a></div> -->
	<div style="clear:both"></div>
    <br />
    <div ><a class="weui_btn hsd" id="close_window"><span style="color:#333333;">关闭</span></a></div>

    <!--    <div style="float:right;width:48%;"><a class="weui_btn weui_btn_primary" href="#">电话联系</a></div>-->
    <div style="clear:both"></div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>
    $("#off_pro_type").change(function(){
        var type_id = $("#off_pro_type").val();
        var url = "{pigcms{:U('Off/get_pro_list')}";
        $.ajax({
            url: url,
            type:'get',
            data:'type_id='+type_id,
            success:function(re){
                $("#pro_id").html(re);
            }
        });
    });


    function check() {
        var borrower = $("#borrower").val();
        if(borrower == '') {
            alert('请填写责任人');
        } else {
            $("#ccc").submit();
        }
    }

    function error() {
        alert('您的权限不足，如有需求请联系项目管理员');
    }

    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    };

    //调用扫一扫
    function qrcode(){
        //alert('正在启动摄像头，请稍作等待');
        wx.scanQRCode({
            needResult: 0,
            scanType: ["qrCode","barCode"],
            desc: '正在启动摄像头，请稍作等待'
        });
    }

</script>
</body>
</html>