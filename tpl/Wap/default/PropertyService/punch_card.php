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
			
			*{
				-webkit-touch-callout:none;  /*系统默认菜单被禁用*/
				-webkit-user-select:none; /*webkit浏览器*/
				-khtml-user-select:none; /*早期浏览器*/
				-moz-user-select:none;/*火狐*/
				-ms-user-select:none; /*IE10*/
				user-select:none;
			}
			input,textarea {
				-webkit-user-select:auto; /*webkit浏览器*/
				margin: 0px;
				padding: 0px;
				outline: none;
			}
			
			/*input,*/
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
<div class="tb">{pigcms{$pointArray.room_name}{pigcms{$pointArray.orientation}
    <if condition="$pointArray['desc'] neq null" >({pigcms{$pointArray.desc})</if>
</div>
<div class="xkk">
	<div class="cw">
		<div class="left2">楼层：<span style="color:#757575">{pigcms{$pointArray.room_name}</span></div>
		<div class="right">
			<div class="kid">方位：<span style="color:#757575">{pigcms{$pointArray.orientation}</span></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
<form action="{pigcms{:U('PropertyService/deal_point')}" enctype="multipart/form-data" method="post" onsubmit="return check();">
    <input value="{pigcms{$pointArray.id}" name="point_id" type="hidden">
    <div class="cw2">
        <div class="gh2">巡更人：</div>
        <div class="gh3">
            <!--<if condition="$name neq null">
                <input name="name" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px; display:none;" value="{pigcms{$name}" disabled />
                <span>{pigcms{$name}</span>
                <else />
                <input name="name" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px; width:98%;" value="" placeholder="请输入您的真实姓名" />

            </if>-->
            <input name="name" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:38px; width:100%; font-size:16px;" value="{pigcms{$name}" placeholder="请输入您的真实姓名" />
        </div>
        <div style="clear:both;"></div>
    </div>
	<div class="cw2">
		<div style="width:100%;">
			<div class="gh2">是否正常：</div>
			<div class="gh3">
				<div class="weui_cell weui_cell_select">
						<div class="weui_cell_bd weui_cell_primary">
							<select class="weui_select" name="point_status" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px;">
								<option selected="selected" value="0">正常</option>
								<option value="1">异常</option>
							</select>
						</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="cw2" id="warning" style="display: none;">
		<div style="width:100%;">
			<div class="gh2">紧急情况：</div>
			<div class="gh3">
				<div class="weui_cell weui_cell_select">
						<div class="weui_cell_bd weui_cell_primary">
							<select class="weui_select" name="warning_level" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:40px;">
                                <option selected="selected" value="3">一般</option>
								<option value="1">紧急</option>
								<option value="2">非常紧急</option>
							</select>
						</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="cw3">
		<textarea placeholder="请输入文本,状态正常可以不填" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; height:140px; width:100%; font-size:16px; line-height:28px;" name="point_desc"></textarea>
	</div>
</div>

<div class="xkk" style="margin-top:20px;display: none" id="showImage">
	<div class="cw3">
		<div style="width:100%;">
			<div class="wzjj">上传异常图片</div>
			<div class="wzjj2">
				
				<div class="weui-uploader__bd">
                            <ul class="weui-uploader__files" id="uploaderFiles">

                            </ul>
                            <div class="weui-uploader__input-box">
                                <input id="uploaderInput" class="weui-uploader_input" type="file" accept="image/*" multiple="" name="imageUrl[]">
                            </div>
                        </div>
						
	
						
				
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>
<div style="margin:0px auto; width:90%; padding-top:5px; padding-bottom:5px;">
    <button type="submit" class="ba">巡更提交</button>
    <if condition="$name neq null">
        <a href="{pigcms{:U('check_record',array('village_id'=>$pointArray['village_id'],'project_id'=>$pointArray['project_id']))}"><div class="ba">巡更记录查询</div></a>
    </if>
</div>
</form>
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
                console.log(file);
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
<script>

    $("select[name='point_status']").change(function(){
        var point_status = $("select[name='point_status']").val();
        //console.log(1);
        if(point_status == 1){
            //正常
            $("#warning").slideDown(100);
            $("#showImage").slideDown(100);
        }else{
            $("#warning").slideUp(100);
            $("#showImage").slideUp(100);
        }
    });


    function check() {
        var name = $("input[name='name']").val();
        if (name == "" || name.length == 0) {
            alert("请输入姓名！");
            return false;
        } else {
            return true;
        }
    }
</script>
</body>
</html>