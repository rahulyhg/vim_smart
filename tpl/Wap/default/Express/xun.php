<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <title>当前巡更点</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/xun/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/shui/weui.css" rel="stylesheet" type="text/css" />
	<script src="{pigcms{$static_path}js/xun/zepto.min.js"></script>

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
	</style>
</head>
<body>
<div class="tb">立体车库B1F东</div>
<div class="xkk">
	<div class="cw">
		<div class="left2">楼层：<span style="color:#757575">立体车库B1F</span></div>
		<div class="right">
			<div class="kid">方位：<span style="color:#757575">东</span></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="xkk" style="margin-top:20px;">
	<div class="cw2">
		<div style="width:100%;">
			<div class="gh2">是否正常：</div>
			<div class="gh3">
				<div class="weui_cell weui_cell_select">
						<div class="weui_cell_bd weui_cell_primary">
							<select class="weui_select" name="select1" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px;">
								<option selected="" value="1">正常</option>
								<option value="2">异常</option>
							</select>
						</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="cw2">
		<div style="width:100%;">
			<div class="gh2">紧急情况：</div>
			<div class="gh3">
				<div class="weui_cell weui_cell_select">
						<div class="weui_cell_bd weui_cell_primary">
							<select class="weui_select" name="select1" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px;">
								<option selected="" value="1">紧急</option>
								<option value="2">非常紧急</option>
							</select>
						</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="cw3">
		<textarea name="textarea" placeholder="请输入文本" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:140px; width:100%; font-size:16px; line-height:28px;"></textarea>
	</div>
</div>

<div class="xkk" style="margin-top:20px;">
	<div class="cw3">
		<div style="width:100%;">
			<div class="wzjj">上传异常图片</div>
			<div class="wzjj2">
				
				<div class="weui-uploader__bd">
                            <ul class="weui-uploader__files" id="uploaderFiles">

                            </ul>
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" class="weui-uploader_input" type="file" accept="image/*" multiple="">
                            </div>
                        </div>
						
	
						
				
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>
<div style="margin:0px auto; width:90%; padding-top:5px; padding-bottom:5px;">
<a href="http://www.hdhsmart.com/wap.php?g=Wap&c=Express&a=shui2"><div class="ba">巡更提交</div></a>
</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>
<script type="text/javascript">
    $(function(){
        var tmpl = '<li class="weui-uploader__file" style="background-image:url(#url#)"></li>',
            $gallery = $("#gallery"), $galleryImg = $("#galleryImg"),
            $uploaderInput = $("#uploaderInput"),
            $uploaderFiles = $("#uploaderFiles")
            ;

        $uploaderInput.on("change", function(e){
            var src, url = window.URL || window.webkitURL || window.mozURL, files = e.target.files;
            for (var i = 0, len = files.length; i < len; ++i) {
                var file = files[i];

                if (url) {
                    src = url.createObjectURL(file);
                } else {
                    src = e.target.result;
                }

                $uploaderFiles.append($(tmpl.replace('#url#', src)));
            }
        });
        $uploaderFiles.on("click", "li", function(){
            $galleryImg.attr("style", this.getAttribute("style"));
            $gallery.fadeIn(100);
        });
        $gallery.on("click", function(){
            $gallery.fadeOut(100);
        });
    });
</script>

</body>