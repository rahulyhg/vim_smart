<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>消防栓、灭火器设备绑定</title>
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
        select {
          /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
          border: solid 1px #000;
        
          /*很关键：将默认的select选择框样式清除*/
          appearance:none;
          -moz-appearance:none;
          -webkit-appearance:none;
        
          /*在选择框的最右侧中间显示小箭头图片*/
          background: url("http://ourjs.github.io/static/2015/arrow.png") no-repeat scroll right center transparent;
        
        
          /*为下拉小箭头留出一点位置，避免被文字覆盖*/
          padding-right: 14px;
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


        /*清除ie的默认选择框样式清除，隐藏下拉箭头*/
        select::-ms-expand { display: none; }
        
        .shtx_xm {
            border-bottom: 1px #eee solid;
            padding-left: 2%;
            padding-top: 8px;
            padding-bottom: 8px;
        }
        
        .kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:14px; width:29%;}
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
            line-height: 33px;
            border: 0;
            font-size: 14px;
            margin-left: 8px;
            width: 65%;
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
        input:disabled{background-color: #c7c7c7;}
		.shtx_dkx {
			width: 85%;
			background-color: #FFFFFF;
			border-radius: 6px;
			padding: 15px 15px;
			margin: 20px auto;
			margin-bottom: 10px;
		}
		.weui-btn_warn {
			color: #000000;
			background-color: #F8F8F8;
		}
		.weui-btn_warn:not(.weui_btn_disabled):active {
            color: #000000;
            background-color: #dedede;
        }
		.weui_btn:after {width:199%;}
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body>
<form action="{pigcms{:U('PropertyService/punch_safety_card_C')}" method="post" id="ccc">
<div class="shtx_dkx">
    <div class="shtx_xm">
        <div class="kkw">选择社区&nbsp;:&nbsp;</div>
        <div class="shtx_kek">
            <input type="text" name="village_id" id="village_id" style="border: 1px solid #d4d4d4; height: 32px; width: 91%; padding-left:5px; font-size:16px;" value="{pigcms{$villageArr[0]['village_name']}" readonly=""> <span class="required">*</span>           
            <!-- <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="village_id" id="village_id" >
                <option value="0">请选择</option>
                <foreach name="villageArr" item="vo">
                    <option value="{pigcms{$vo['village_id']}"<if condition="$vo['village_id'] eq 4">selected</if>>{pigcms{$vo.village_name}</option>
                </foreach>
            </select> -->
        </div>
        <div class="both"></div>
    </div>

    <div class="shtx_xm">
        <div class="kkw">选择楼层&nbsp;:&nbsp;</div>
        <div class="shtx_kek">

            <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:16px; padding-left:5px; width:94%; margin-right:5px;" name="rid" id="rid" >
                <foreach name="roomArr" item="sv">
                    <option value="{pigcms{$sv.id}">{pigcms{$sv.room_name}</option>
                </foreach>
            </select><span class="required">*</span>
        </div>
        <div class="both"></div>
    </div>

    <div class="shtx_xm">
        <div class="kkw">输入编号&nbsp;:&nbsp;</div>
        <div class="shtx_kek">

            <!-- <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="pro_id" id="pro_id" >
                <if condition="isset($proArr['pro_id'])">
                    <option value="{pigcms{$proArr.pro_id}"  >{pigcms{$proArr.pro_name}</option>
                </if>
                <option value="0">请选择</option>
            </select> -->

            <input type="text" name="orientation" id="orientation" style="border: 1px solid #d4d4d4; height: 32px; width: 91%; padding-left:5px; font-size:16px;" placeholder="请输入点位编号" onBlur=" ">
        </div>
    </div>

    
    <div id="bigdd">

    </div>

    <!-- <div class="shtx_xm">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">项目名称:</label></div>
            <div class="weui-cell__bd">
                <span style="font-size:17px;">{pigcms{$village.village_name}</span>
            </div>
         </div>
    </div>
    <div class="shtx_xm">
        <div class="weui-cell__hd">
            <label class="weui-label">位置/编号:</label>
        </div>
        <div class="weui-cell__bd" style="float: right; margin-top: -18px; margin-right: 200px;">
            <span style="font-size:17px;">{pigcms{$pointArray.room_name}-{pigcms{$pointArray.orientation}</span>
        </div>
        <div class="weui-cell__ft" style="float: right; margin-top: -18px; margin-right: 50px;">
            <button class="weui-vcode-btn">重新绑定</button>
        </div>
    </div> -->

    <div class="shtx_xm">
        <div class="kkw">责任人&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</div>
        <div class="shtx_kek"><input name="borrower" id="borrower" value="{pigcms{$name}" type="text" readonly="" style="border:1px #d4d4d4 solid; height:32px; line-height:32px; border-radius:0px; font-size:16px; width:91%; padding-left:5px;">
        </div>
        <div class="both"></div>
    </div>
    <input style="display: none; width:100%; border:1px #d4d4d4 solid; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="pro_qrcode" value="{pigcms{$pro_qrcode}" />

</div>
</form>
<div class="zkd">
    <div style="width:48%; float:left;"><if condition="$isOpen eq 1">
        <input type="hidden" name="orientation" id="orientation">
        <div><a class="weui_btn weui_btn_primary" onclick="check()">提交绑定</a></div>
        <else/>
        <div><a class="weui_btn weui_btn_primary" onclick="error()">提交绑定</a></div>
    </if></div>
    <div style="width:48%; float:right;"><a class="weui_btn weui-btn_warn" id="close_window"  >关闭</a></div>

    <!--    <div style="float:right;width:48%;"><a class="weui_btn weui_btn_primary" href="#">电话联系</a></div>-->
    <div style="clear:both"></div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script type='text/javascript'>
    //添加点位时判断是否存在
    $("input").blur(function(){
        var rid = $("#rid").val();
        var orientation = $("#orientation").val();
        $.ajax({
             url:'{pigcms{:U("check_orientation")}',
             type:'post',
             data:{'rid':rid,'orientation':orientation},
             success:function (res) {
                 if (res) {
                    alert('该编号已存在，请重新输入');
                     $("#orientation").val("");
                 }
             }
         });
    });

    function check() {
        var village_id = $("#village_id").val();
        var rid = $("#rid").val();
        var borrower = $("#borrower").val();
        var orientation = $("#orientation").val();
        // document.getElementById('orientation').value = orientation;
        if (village_id == 0 || village_id == '') {
            alert('请选择社区');
        } else if(rid == 0 || rid == '') {
            alert('请选择楼层');
        } else if(borrower == '') {
            alert('请填写责任人');
        }else if(orientation == '') {
            alert('请填写编号');
        } else {
            sessionStorage.setItem('borrower',borrower);
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

    //当社区改变时，相应的楼层也会随之改变
    $(function () {
        var village_id=sessionStorage.getItem('village_id');
        var borrower=sessionStorage.getItem('borrower');
        if(village_id){
            $("#village_id").val(village_id);
            $("#village_id").trigger('change');
        }


        if(borrower){
            $("#borrower").val(borrower);
        }
    })
    function sleep(n) { //n表示的毫秒数
        var start = new Date().getTime();
        while (true) if (new Date().getTime() - start > n) break;
    }

    /*页面自定义js代码*/
    // $("[name='all_orientation']").click(function(){
    //     $("[name='orientation[]']").attr('checked',true);
    // });

    // $("[name='village_id']").change(function() {
    //      var village_id = $("[name='village_id']").val();
    //      $.ajax({
    //          url:'{pigcms{:U("change_village")}',
    //          type:'post',
    //          data:{'village_id':village_id},
    //          success:function (res) {
    //              $("[name='rid']").html(res);
    //          }
    //      });
    // });
</script>
</body>
</html>