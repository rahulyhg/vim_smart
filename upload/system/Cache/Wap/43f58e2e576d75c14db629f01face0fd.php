<?php if (!defined('THINK_PATH')) exit(); if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title><?php echo ($now_village["village_name"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name='apple-touch-fullscreen' content='yes'/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<meta name="format-detection" content="address=no"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/common.css?210"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/village.css?211"/>
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/weui.css"/>
<!--<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/example.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css"/>
<script type="text/javascript" src="<?php echo C('JQUERY_FILE_190');?>" charset="utf-8"></script>
<!--<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/imgUploadControl.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_control.js" charset="utf-8"></script>-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
.demo{width:720px;margin:30px auto;}
.demo li{float:left;}
.text,.button{background:url(http://su.bdimg.com/static/superpage/img/spis_031ddf34.png) no-repeat;}
.text{width:529px;height:22px;padding:4px 7px;padding:6px 7px 2px\9;font:16px arial;border:1px solid #cdcdcd;border-color:#9a9a9a #cdcdcd #cdcdcd #9a9a9a;vertical-align:top;outline:none;margin:0 5px 0 0;}
</style>
<script type="text/javascript">
$(function(){
	var bigAutocomplete = new function(){
		this.currentInputText = null;//目前获得光标的输入框（解决一个页面多个输入框绑定自动补全功能）
		this.functionalKeyArray = [9,20,13,16,17,18,91,92,93,45,36,33,34,35,37,39,112,113,114,115,116,117,118,119,120,121,122,123,144,19,145,40,38,27];//键盘上功能键键值数组
		this.holdText = null;//输入框中原始输入的内容
		
		//初始化插入自动补全div，并在document注册mousedown，点击非div区域隐藏div
		this.init = function(){
			$("body").append("<div id='bigAutocompleteContent' class='bigautocomplete-layout'></div>");
			$(document).bind('mousedown',function(event){
				var $target = $(event.target);
				if((!($target.parents().andSelf().is('#bigAutocompleteContent'))) && (!$target.is(bigAutocomplete.currentInputText))){
					bigAutocomplete.hideAutocomplete();
				}
			})
			
			//鼠标悬停时选中当前行
			$("#bigAutocompleteContent").delegate("tr", "mouseover", function() {
				$("#bigAutocompleteContent tr").removeClass("ct");
				$(this).addClass("ct");
			}).delegate("tr", "mouseout", function() {
				$("#bigAutocompleteContent tr").removeClass("ct");
			});		
			
			
			//单击选中行后，选中行内容设置到输入框中，并执行callback函数
			$("#bigAutocompleteContent").delegate("tr", "click", function() {
				bigAutocomplete.currentInputText.val( $(this).find("div:last").html());
				var callback_ = bigAutocomplete.currentInputText.data("config").callback;
				if($("#bigAutocompleteContent").css("display") != "none" && callback_ && $.isFunction(callback_)){
					callback_($(this).data("jsonData"));
					
				}				
				bigAutocomplete.hideAutocomplete();
			})			
			
		}
		
		this.autocomplete = function(param){
			
			if($("body").length > 0 && $("#bigAutocompleteContent").length <= 0){
				bigAutocomplete.init();//初始化信息
			}			
			
			var $this = $(this);//为绑定自动补全功能的输入框jquery对象
			
			var $bigAutocompleteContent = $("#bigAutocompleteContent");
			
			this.config = {
			               //width:下拉框的宽度，默认使用输入框宽度
			               width:$this.outerWidth() - 2,
			               //url：格式url:""用来ajax后台获取数据，返回的数据格式为data参数一样
			               url:null,
			               /*data：格式{data:[{title:null,result:{}},{title:null,result:{}}]}
			               url和data参数只有一个生效，data优先*/
			               data:null,
			               //callback：选中行后按回车或单击时回调的函数
			               callback:null};
			$.extend(this.config,param);
			
			$this.data("config",this.config);
			
			//输入框keydown事件
			$this.keydown(function(event) {
				switch (event.keyCode) {
				case 40://向下键
					
					if($bigAutocompleteContent.css("display") == "none")return;
					
					var $nextSiblingTr = $bigAutocompleteContent.find(".ct");
					if($nextSiblingTr.length <= 0){//没有选中行时，选中第一行
						$nextSiblingTr = $bigAutocompleteContent.find("tr:first");
					}else{
						$nextSiblingTr = $nextSiblingTr.next();
					}
					$bigAutocompleteContent.find("tr").removeClass("ct");
					
					if($nextSiblingTr.length > 0){//有下一行时（不是最后一行）
						$nextSiblingTr.addClass("ct");//选中的行加背景
						$this.val($nextSiblingTr.find("div:last").html());//选中行内容设置到输入框中
						
						//div滚动到选中的行,jquery-1.6.1 $nextSiblingTr.offset().top 有bug，数值有问题
						$bigAutocompleteContent.scrollTop($nextSiblingTr[0].offsetTop - $bigAutocompleteContent.height() + $nextSiblingTr.height() );
						
					}else{
						$this.val(bigAutocomplete.holdText);//输入框显示用户原始输入的值
					}
										
					break;
				case 38://向上键
					if($bigAutocompleteContent.css("display") == "none")return;
					
					var $previousSiblingTr = $bigAutocompleteContent.find(".ct");
					if($previousSiblingTr.length <= 0){//没有选中行时，选中最后一行行
						$previousSiblingTr = $bigAutocompleteContent.find("tr:last");
					}else{
						$previousSiblingTr = $previousSiblingTr.prev();
					}
					$bigAutocompleteContent.find("tr").removeClass("ct");
					
					if($previousSiblingTr.length > 0){//有上一行时（不是第一行）
						$previousSiblingTr.addClass("ct");//选中的行加背景
						$this.val($previousSiblingTr.find("div:last").html());//选中行内容设置到输入框中
						
						//div滚动到选中的行,jquery-1.6.1 $$previousSiblingTr.offset().top 有bug，数值有问题
						$bigAutocompleteContent.scrollTop($previousSiblingTr[0].offsetTop - $bigAutocompleteContent.height() + $previousSiblingTr.height());
					}else{
						$this.val(bigAutocomplete.holdText);//输入框显示用户原始输入的值
					}
					
					break;
				case 27://ESC键隐藏下拉框
					
					bigAutocomplete.hideAutocomplete();
					break;
				}
			});		
			
			//输入框keyup事件
			$this.keyup(function(event) {
				var k = event.keyCode;
				var ctrl = event.ctrlKey;
				var isFunctionalKey = false;//按下的键是否是功能键
				for(var i=0;i<bigAutocomplete.functionalKeyArray.length;i++){
					if(k == bigAutocomplete.functionalKeyArray[i]){
						isFunctionalKey = true;
						break;
					}
				}
				//k键值不是功能键或是ctrl+c、ctrl+x时才触发自动补全功能
				if(!isFunctionalKey && (!ctrl || (ctrl && k == 67) || (ctrl && k == 88)) ){
					var config = $this.data("config");
					
					var offset = $this.offset();
					$bigAutocompleteContent.width(config.width);
					var h = $this.outerHeight() - 1;
					$bigAutocompleteContent.css({"top":offset.top + h,"left":offset.left});
					
					var data = config.data;
					var url = config.url;
					var keyword_ = $.trim($this.val());
					if(keyword_ == null || keyword_ == ""){
						bigAutocomplete.hideAutocomplete();
						return;
					}					
					if(data != null && $.isArray(data) ){
						var data_ = new Array();
						for(var i=0;i<data.length;i++){
							if(data[i].title.indexOf(keyword_) > -1){
								data_.push(data[i]);
							}
						}
						
						makeContAndShow(data_);
					}else if(url != null && url != ""){//ajax请求数据
						$.post(url,{keyword:keyword_},function(result){
							makeContAndShow(result.data)
						},"json")
					}
					
					bigAutocomplete.holdText = $this.val();
				}
				//回车键
				if(k == 13){
					var callback_ = $this.data("config").callback;
					if($bigAutocompleteContent.css("display") != "none"){
						if(callback_ && $.isFunction(callback_)){
							callback_($bigAutocompleteContent.find(".ct").data("jsonData"));
						}
						$bigAutocompleteContent.hide();						
					}
				}
				
			});	
								
			//组装下拉框html内容并显示
			function makeContAndShow(data_){
				if(data_ == null || data_.length <=0 ){
					return;
				}
				
				var cont = "<table><tbody>";
				for(var i=0;i<data_.length;i++){
					cont += "<tr><td><div>" + data_[i].title + "</div></td></tr>"
				}
				cont += "</tbody></table>";
				$bigAutocompleteContent.html(cont);
				$bigAutocompleteContent.show();
				
				//每行tr绑定数据，返回给回调函数
				$bigAutocompleteContent.find("tr").each(function(index){
					$(this).data("jsonData",data_[index]);
				})
			}			
					
			
			//输入框focus事件
			$this.focus(function(){
				bigAutocomplete.currentInputText = $this;
			});
			
		}
		//隐藏下拉框
		this.hideAutocomplete = function(){
			var $bigAutocompleteContent = $("#bigAutocompleteContent");
			if($bigAutocompleteContent.css("display") != "none"){
				$bigAutocompleteContent.find("tr").removeClass("ct");
				$bigAutocompleteContent.hide();
			}			
		}
		
	};
	
	$.fn.bigAutocomplete = bigAutocomplete.autocomplete;
	
})
$(function(){
	$("#input_change").bigAutocomplete({
		width:543,
		data:[{idVal:'1',title:"中国好声音"},
		{idVal:'2',title:"中国移动网上营业厅"},
		{idVal:'3',title:"中国银行"},
		{idVal:'4',title:"中国移动"},
		{idVal:'5',title:"中国好声音第三期"},
		{idVal:'6',title:"中国好声音 第一期"},
		{idVal:'7',title:"中国电信网上营业厅"},
		{idVal:'8',title:"中国工商银行"},
		{idVal:'9',title:"中国好声音第二期"},
		{idVal:'10',title:"中国地图"}],
		callback:function(data){
			alert(data.title);	
			alert(data.idVal);
		}
	});
	
	$('#company_id').change(function(){
		var company_idVal=$(this).find("option:selected").text();
		//alert(company_idVal);
		$(this).find("option:selected").text(company_idVal.split('-')[1]);
	})
	
	$('#company_id').find("option:selected").text($('#company_id').find("option:selected").text().split('-')[1]);
})
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>资料审核</header>
<div class="sfrz_zkd"><img src="<?php echo ($static_path); ?>images/qq.jpg" style="width:100%;" /></div>
<form id="access_form" onSubmit="return false;">
	<div class="shtx_dk">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
			<div class="weui_cell weui_cell_select">
				<div class="weui_cell_bd weui_cell_primary">
					<select class="weui_select" name="company_id" id="company_id"><!--此处的class要看下，实现下拉样式-->
						<option selected="selected" value="">请选择到访公司</option>
						<?php if(is_array($company_list)): $i = 0; $__LIST__ = $company_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['company_id']); ?>" <?php if($vo['company_id'] == 26): ?>selected<?php endif; ?> ><?php echo ($vo["company_first"]); ?>-<?php echo ($vo["company_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="demo">
		<ul>
			<li><input type="text" id="input_change" value="" class="text" placeholder="请输入公司名"/></li>
		</ul>
	</div>
</form>
</body>
</html>