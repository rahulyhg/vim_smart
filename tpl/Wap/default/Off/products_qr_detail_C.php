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
        input:disabled{background-color: #888888;}
    </style>
</head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>

<body>
<form action="{pigcms{:U('Off/products_qr_detail_C')}" method="post" id="ccc">
<div class="shtx_dkx">
    <div class="shtx_xm">
        <div class="kkw">物品分类&nbsp;:&nbsp;</div>
        <div class="shtx_kek">
<!--                        <select style="width:99%; height:25px; margin-top:5px; border:1px #d1d1d1 solid;">-->
<!--                            <option>1</option>-->
<!--                            <option>2</option>-->
<!--                        </select>-->
            <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="off_pro_type" id="off_pro_type" >
                <option value="0">请选择</option>
                <foreach name="typeArr" item="vo" >
                    <option value="{pigcms{$vo.id}" <if condition="$proArr['tid'] eq $vo['id']">selected</if> >{pigcms{$vo.type_name}</option>
                    <if condition="isset($vo['son'])">
                        <foreach name="vo['son']" item="v">
                            <option value="{pigcms{$v.id}" <if condition="$proArr['tid'] eq $v['id']">selected</if> >|--{pigcms{$v.type_name}</option>
                            <if condition="isset($v['g_son'])">
                                <foreach name="v['g_son']" item="sv">
                                    <option value="{pigcms{$sv.id}" <if condition="$proArr['tid'] eq $sv['id']">selected</if> >|--|--{pigcms{$sv.type_name}</option>
                                </foreach>
                            </if>
                        </foreach>
                    </if>
                </foreach>
            </select>
        </div>
        <div class="both"></div>
    </div>

    <div class="shtx_xm">
        <div class="kkw">物品名称&nbsp;:&nbsp;</div>
        <div class="shtx_kek">

            <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="pro_id" id="pro_id" >
                <if condition="isset($proArr['pro_id'])">
                    <option value="{pigcms{$proArr.pro_id}"  >{pigcms{$proArr.pro_name}</option>
                </if>
                <option value="0">请选择</option>
            </select>
        </div>
        <div class="both"></div>
    </div>
    <div class="shtx_xm">
        <div class="kkw">区域选择&nbsp;:&nbsp;</div>
        <div class="shtx_kek">

            <select style="width:99%; border:1px #d4d4d4 solid;  background:url(tpl/System/Static/images/xl.jpg) no-repeat right; background-size:8%; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="zone_id" id="zone_id" >
                <if condition="isset($zoneArr)">
                    <foreach name="zoneArr" item="vo">
                        <option value="{pigcms{$vo.id}"  >{pigcms{$vo.zone_name}</option>
                    </foreach>
                </if>
            </select>
        </div>
        <div class="both"></div>
    </div>
    <div id="bigdd">

    </div>

    <div class="shtx_xm">
        <div class="kkw">责任人&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</div>
        <div class="shtx_kek"><input name="borrower" id="borrower" value="{pigcms{$proArr.borrower}" type="text" autocomplete="on" <if condition="$isOpen neq 1">disabled</if> style="width:95%; border:1px #d4d4d4 solid; height:28px; line-height:28px; border-radius:0px; font-size:14px; padding-left:5px;">
        </div>
        <div class="both"></div>
    </div>
    <input style="display: none; width:100%; border:1px #d4d4d4 solid; height:34px; line-height:34px; border-radius:0px; font-size:14px; padding-left:5px;" name="pro_qrcode" value="{pigcms{$pro_qrcode}" />

</div>
</form>
<div class="zkd">
    <if condition="$isOpen eq 1">
        <div ><a class="weui_btn weui_btn_primary" onclick="check()">提交</a></div>
        <else/>
        <div ><a class="weui_btn weui_btn_primary" onclick="error()">提交</a></div>
    </if>
    <br/>
    <div ><a class="weui_btn weui_btn_primary" id="close_window"  >关闭</a></div>

    <!--    <div style="float:right;width:48%;"><a class="weui_btn weui_btn_primary" href="#">电话联系</a></div>-->
    <div style="clear:both"></div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>
    $("#off_pro_type").change(function(){
        var type_id = $("#off_pro_type").val();
        sessionStorage.setItem('type_id',type_id);
        var url = "{pigcms{:U('Off/get_pro_list')}";
        $("#bigdd").html('');
        $.ajax({
            url: url,
            type:'get',
            async:false,
            data:'type_id='+type_id,
            success:function(re){
                $("#pro_id").html(re);
                var pro_id=sessionStorage.getItem('pro_id');
                if(pro_id){
                    if(re.indexOf('"'+pro_id+'"')){
                        $("#pro_id").val(pro_id);
                        console.log($("#pro_id").val());
                        $("#pro_id").trigger('change');
                    }
                }
            }
        });
    });


    $("#pro_id").change(function(){
        var pro_id = $("#pro_id").val();
        sessionStorage.setItem('pro_id',pro_id);
        var url = "{pigcms{:U('Off/get_pro_one')}";
        $.ajax({
            url: url,
            type:'get',
            async:false,
            data:'pro_id='+pro_id,
            success:function(re){
                $("#bigdd").html(re);
            }
        });
    });

    function check() {
        var type_id = $("#off_pro_type").val();
        var pro_id = $("#pro_id").val();
        var borrower = $("#borrower").val();
        var zone_id = $("#zone_id").val();
        if (type_id == 0 || type_id == '') {
            alert('请选择分类');
        } else if(pro_id == 0 || pro_id == '') {
            alert('请选择物品');
        } else if(borrower == '') {
            alert('请填写责任人');
        }else if(zone_id == '') {
            alert('请选择区域');
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
    $(function () {
        var type_id=sessionStorage.getItem('type_id');
        var borrower=sessionStorage.getItem('borrower');
        if(type_id){
            $("#off_pro_type").val(type_id);
            $("#off_pro_type").trigger('change');
        }


        if(borrower){
            $("#borrower").val(borrower);
        }
    })
    function sleep(n) { //n表示的毫秒数
        var start = new Date().getTime();
        while (true) if (new Date().getTime() - start > n) break;
    }
</script>
</body>
</html>