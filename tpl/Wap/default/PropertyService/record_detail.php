<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>当前巡更点详细信息</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/xun/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
	<script src="{pigcms{$static_path}js/xun/zepto.min.js"></script>
    <script src="{pigcms{$static_path}js/jquery.min.js"></script>

	<style type="text/css">
			input::-webkit-input-placeholder, textarea::-webkit-input-placeholder { 
			color: #979797; font-size:16px;
			} 
			input:-moz-placeholder, textarea:-moz-placeholder { 
			color: #979797; font-size:16px;
			} 
			input::-moz-placeholder, textarea::-moz-placeholder { 
			color: #979797; font-size:16px;
			} 
			input:-ms-input-placeholder, textarea:-ms-input-placeholder { 
			color: #979797; font-size:16px;
			} 
			
			input,
			textarea {
				border: 0; /* 方法1 */
				-webkit-appearance: none; /* 方法2 */
			}
			
			.weui_cell_select .weui_cell_bd:after {
			content: " ";
			display: inline-block;
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			height: 6px;
			width: 6px;
			border-width: 2px 2px 0 0;
			border-color: #8e8e8e;
			border-style: solid;
			position: relative;
			top: -2px;
			position: absolute;
			top: 50%;
			right: 15px;
			margin-top: -3px;
			z-index: 1111;
		}
		
			.weui-form-preview__item {
				overflow: hidden;
				margin-bottom: 5px;
			}
	</style>
</head>
<body>
<br/>
<br/>

<div class="page__hd">
    <h1 class="page__title" style="text-align: center">{pigcms{$pointRecord.room_name}巡更详细</h1>
</div>
<br/>
<br/>
<div class="weui-form-preview">
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">巡更楼层</label>
            <span class="weui-form-preview__value">{pigcms{$pointRecord.room_name}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">巡更方位</label>
            <span class="weui-form-preview__value">{pigcms{$pointRecord.orientation}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">巡更时间</label>
            <span class="weui-form-preview__value">{pigcms{$pointRecord.check_time|date='Y-m-d H:i:s',###}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">巡更人</label>
            <span class="weui-form-preview__value">{pigcms{$pointRecord.truename}</span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">巡更点状态</label>
            <span class="weui-form-preview__value">
                <if condition="$pointRecord['point_status'] eq 0">
                    状态：正常
                <else/>
                    状态：异常     紧急情况：<if condition="$pointRecord['warning_level'] eq 1">紧急<elseif condition="$pointRecord['warning_level'] eq 2"/>非常紧急<else/>一般</if>
                </if>
            </span>
        </div>
		<if condition="$pointRecord['image'] neq null">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">异常图片</label>
            <span class="weui-form-preview__value" id="pb1"><img src="./upload/adver/{pigcms{$pointRecord.image}" width="80px" height="auto"/></span>
        </div>
        </if>
    </div>
    <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_default" href="javascript:history.back();">返回</a>
        <button type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:" id="close_window">关闭</button>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/swiper.min.js"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/city-picker.min.js"></script>
<script type="application/javascript">
    var pb1 = $.photoBrowser({
        items: [
            "./upload/adver/{pigcms{$pointRecord.image}",
        ]
    });

    $("#pb1").click(function () {
        pb1.open();
    });

    var btn = document.getElementById('close_window');
    btn.onclick = function(){
        WeixinJSBridge.invoke('closeWindow',{},function(res){});
    }
</script>
</body>
</html>