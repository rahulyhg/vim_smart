<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>快递详情</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="{pigcms{$static_path}test/css/bootstrap.min.css">
    <link rel="stylesheet" href="{pigcms{$static_path}test/css/weui.min.css">
    <link rel="stylesheet" href="{pigcms{$static_path}test/css/jquery-weui.min.css">
    <style>
		*{   
			-webkit-touch-callout:none;  /*系统默认菜单被禁用*/   
			-webkit-user-select:none; /*webkit浏览器*/   
			-khtml-user-select:none; /*早期浏览器*/   
			-moz-user-select:none;/*火狐*/   
			-ms-user-select:none; /*IE10*/   
			user-select:none;   
		}  
        body {color:#9c9c9c; font-size:16px; font-family:"微软雅黑";}
        .wz {width:100%; margin:0px auto;}
        .wze {width:100%; margin:0px auto; padding-top:14px;}
        .ls {width:100%; height:40px; overflow:hidden; background-color:#2093fc; text-align:center; line-height:40px; color:#FFFFFF; font-size:18px;}
        .zk2 {width:100%; background-color:#FFFFFF; box-shadow: 0px 2px 20px #ebebeb; padding-bottom:20px;}
        .zk3 {width:100%; background-color:#FFFFFF; box-shadow: 0px 2px 20px #ebebeb;}
        .kw {width:95%; float:right; padding-top:10px;}
        .kw2 {width:100%; height:40px; overflow:hidden;}
        .wzw {float:left; color:#adadad; width:11%; line-height:39px;}
        .wz2 {float:right; width:87%; border-bottom:1px #ededed solid; height:39px; line-height:39px; color:#373737;}
        .zz {width:5%; float:left; text-align:center; padding-top:14px; color:#d9d9d9;}
        .zz2 {width:93%; float:right; border-left:1px #ededed solid; box-sizing: border-box; padding-left:10px; padding-right:10px; padding-top:12px; padding-bottom:12px; }
		.zzk {width:100%; line-height:20px; color:#2093fc; font-size:15px;}
		.zzk2 {width:100%; line-height:20px; color:#b5b5b5; font-size:14px;}
		.zzk3 {width:100%; line-height:20px; color:#858585; font-size:15px;}
        .zz3 {width:30%; float:left; text-align:center; padding-top:12px; font-size:13px; color:#b9b9b9;}
        .zz4 {width:70%; float:right; border-left:1px #ededed solid; border-bottom:1px #ededed solid; box-sizing: border-box; padding-left:10px; padding-right:10px; padding-top:12px; padding-bottom:12px; color:#8c8c8c; font-size:14px;}
        .zz5 {width:70%; float:right; border-left:1px #ededed solid; box-sizing: border-box; height:20px; overflow:hidden;}
		.order {width:100%; height:36px; overflow:hidden;text-align:center; line-height:36px;}
		.order .line {display: inline-block; width: 38%; border-top: 1px solid #bbbbbb ;}  
		.order .txt {color: #898989; vertical-align: middle; font-size:12px;} 
		.yd {width:8px; height:8px; background-color:#2093fc; border-radius:50%; position:absolute; left:6%; margin-top:3px;}
		.yd2 {width:8px; height:8px; background-color:#dadada; border-radius:50%; position:absolute; left:6%; margin-top:3px;}
		.dd {width:90%; margin:20px auto; background-color:#2093fc; border-radius:4px; text-align:center; line-height:40px; color:#FFFFFF;}
		.dd:active {background-color:#1e86e6;}
    </style>
</head>
<body style="background-color:#f6f6f6;">
<div class="wz">
    <div class="ls">运单详情</div>
    <if condition="isset($list)">
    <div class="zk2">
        <div class="kw">
            <div class="kw2">
                <div class="wzw">姓名</div>
                <div class="wz2"><span style="padding-left:5px;">{pigcms{$list.name}</span></div>
                <div style="clear:both"></div>
            </div>
            <div class="kw2">
                <div class="wzw">快递</div>
                <div class="wz2"><span style="padding-left:5px;">{pigcms{$list.company_name}</span></div>
                <div style="clear:both"></div>
            </div>
            <div class="kw2">
                <div class="wzw">单号</div>
                <div class="wz2"><span style="padding-left:5px;">{pigcms{$list.waybill_number}</span></div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <elseif condition="isset($listTwoArr)" />
        <div class="zk2">
            <div class="kw">
                <div class="kw2">
                    <div class="wzw">寄件人姓名</div>
                    <div class="wz2"><span style="padding-left:5px;">{pigcms{$listTwoArr.bad_name}</span></div>
                    <div style="clear:both"></div>
                </div>
                <div class="kw2">
                    <div class="wzw">快递公司</div>
                    <div class="wz2"><span style="padding-left:5px;">{pigcms{$listTwoArr.exp_name}</span></div>
                    <div style="clear:both"></div>
                </div>
                <div class="kw2">
                    <div class="wzw">单号</div>
                    <div class="wz2"><span style="padding-left:5px;">{pigcms{$listTwoArr.ems_order_id}</span></div>
                    <div style="clear:both"></div>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </if>
</div>
<if condition="isset($resArr)">
    <div class="wze">
        <div class="zk3">
            <foreach name="resArr" item="vo">
                <div class="wz">
                    <div class="zz"><div class="yd"></div></div>
                    <div class="zz2">
						<div class="zzk3">{pigcms{$vo.AcceptStation}</div>
						<div class="zzk2">{pigcms{$vo.AcceptTime}</div>
					</div>
                    <div style="clear:both"></div>
                </div>
           </foreach>
        </div>
    </div>
    <else /></if>
	<div class="dd" onclick="comeback()">返 回</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script>
    function comeback(){
        window.history.go(-1);
    }
    $(".zzk3").first().css("color","#2093fc");
</script>
</body>
</html>