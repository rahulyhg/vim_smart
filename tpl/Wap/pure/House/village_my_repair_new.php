<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>在线报修</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
	<meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
	<meta content="" name="author" />
	<link href="{pigcms{$static_path}css/style.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/weui.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/weui2.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/137/sweetalert.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/137/components.min.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/137/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
	<link href="{pigcms{$static_path}css/137/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		.bx {width:100%; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
		.bx2 {width:90%; margin:0px auto; padding:10px 0 10px 0;}
		.bx3 {width:5%; float:left; padding-top:3px;}
		.bx4 {width:90%; float:left; margin-left:2%; color:#a1a1a8;}
		.cw {width:90%; padding-top:25px; margin:0px auto;}
		.cwjj {width:90%; padding-top:25px; margin:0px auto; padding-bottom:25px;}
		.ty {width:100%; margin-top:15px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
		.ty2 {width:95%; margin-left:5%; padding-top:20px;}
		.ty4 {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
		.ty41 {width:100%; margin-top:25px;  background-color:#FFFFFF;display: none;}
		.ty3 {width:100%; padding-top:20px; margin:0px auto; overflow:hidden;}
		.tk {width:40%; margin-left:5%; margin-right:5%; float:left; margin-bottom:15px;}
		.tkw {width:86%; margin-left:7%; margin-right:7%; margin-bottom:15px;}
		.tk2 {width:100%; margin:0px auto;}
		.tk3 {width:100%; height:30px; line-height:30px; overflow:hidden; text-align:center; color:#a1a1a8;}
		.geq {width:100%; margin-top:25px; -webkit-box-shadow: 0px 0px 6px #e9e9e9; background-color:#FFFFFF;}
		.geq2 {width:90%; padding-top:20px; margin:0px auto; padding-bottom:25px;cursor:pointer;}
		.geq3 {width:90%; padding-top:15px; margin:0px auto; padding-bottom:15px; line-height:1.8; color:#878787; font-size:14px;}
		.weui_cell:before {
			border-top:none;
		}
		.weui_cell {
			padding:0px;
			width:100%;
			position: relative;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
		}
		.weui_cell:before {
			left: 0px;
		}
		.btb {width:100%; font-size:18px; text-align:center; line-height:40px; height:40px; overflow:hidden; background-color:#18b4ed; color:#FFFFFF;}
		.btb:active {width:100%; font-size:18px; text-align:center; line-height:40px; height:40px; overflow:hidden; background-color:#0ba4dc; color:#FFFFFF;}
		.cw2 {width:100%;}
		.cw3 {width:100%; margin-top:15px;}
		.cw4 {width:90%; padding-top:15px; margin:0px auto;}
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
		.weui_textarea {padding-left:12px;}
		.upload_list .upload_action, .upload_list .upload_item {
			width: 25%;
			float: left;
			position: relative;
			display: -webkit-box;
			-webkit-box-pack: center;
			-webkit-box-align: center;
			border:none;
			-webkit-box-sizing: border-box;
			overflow: hidden;
			padding: 8px 0 5px 0;
			border-radius: 10px;
		}
	</style></head>
<script>
	document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div class="bx">
	<div class="bx2">
		<div class="bx3"><img src="{pigcms{$static_path}images/bx1.jpg" style="width:100%; height:auto;" /></div>
		<div class="bx4">请选择您要报修的类别</div>
		<div style="clear:both;"></div>
	</div>
</div>
<div class="cw">
	<!--<div class="cw2">
		<div class="weui_cell weui_cell_select">
			<div class="weui_cell_bd weui_cell_primary">
				<select class="weui_select" name="is_cost" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;">
					<option selected="selected">请选择</option>
					<option value="1">有偿报修</option>
					<option value="0">无偿报修</option>
				</select>
			</div>
		</div>
	</div>-->
	<div class="cw3">
		<div class="weui_cell weui_cell_select">
			<div class="weui_cell_bd weui_cell_primary">
				<select class="weui_select" name="repair_type" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0; color:#8f8f8f;">
					<option selected="selected">请选择</option>
					<foreach name="repair_type_array" item="vo">
						<option value="{pigcms{$vo.type_id}">{pigcms{$vo.type_name}</option>
					</foreach>
				</select>
			</div>
		</div>
	</div>
<!--	<div class="cw3"><div class="btb" onclick="select_project();">点击查询</div></div>-->
</div>
<div class="geq">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">服务表格</div>
		<div style="clear:both"></div>
	</div>
	<div class="geq2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="60%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; color:#333333;">服务项目</td>
				<td width="20%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; border-left:none; color:#333333;">价格</td>
                <td width="20%" height="40" align="center" bgcolor="#f1f1f1" style="border:1px #d3d4d6 solid; border-left:none; color:#333333;">选择</td>
			</tr>
		</table>
	</div>
</div>

<div class="ty41" id="cc">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">报修提交</div>
		<div style="clear:both"></div>
	</div>
	<div class="cwjj">
	<div class="cw2">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<input class="weui_select" type="text" name="content" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;" value="" readonly="readonly"/>
			</div>
		</div>
	</div>
	<div class="cw3">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<input class="weui_select" type="number" name="contact" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;" placeholder="联系电话（必填）"/>
			</div>
		</div>
	</div>
	<div class="cw3">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<textarea  name="details" rows="3" placeholder="备注（选填）" class="weui_textarea" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;"></textarea>
				<!--<input class="weui_select" type="text" name="details" style="border:1px #d4d4d4 solid; background-color:#FFFFFF; border-radius:0;" placeholder="备注（选填）"/>-->
			</div>
		</div>
	</div>
		<div class="upload_box">
			<ul class="upload_list clearfix" id="upload_list">
				<li class="upload_action">
					<img src="/tpl/Wap/default/static/classify/upimg.png"/>
					<input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name=""/>
					<input type="hidden" name="upload" id="upload">
				</li>
			</ul>
		</div>
	<div class="cw3"><div class="btb" onClick="submit_form();">点击提交</div></div>
</div>
</div>

<div class="ty4" id="form">
	<div class="ty2">
		<div style="float:left;"><img src="{pigcms{$static_path}images/fw2.jpg" style="width:5px; height:auto;" /></div>
		<div style="float:left; padding-left:8px; color:#000000; font-size:18px; font-weight:bold; line-height:20px;">报修说明</div>
		<div style="clear:both"></div>
	</div>
	<div class="geq3">
		<p>1、以上维修收费只含辅材，材料费另计；<br />
			2、以上维修收费不包括开辟检修空间及还原的费用；<br />
			3、如需提供材料，将在材料单价上加收10%采购费；<br />
			4、材料费以市场价格而定； <br />
			5、未列入以上有偿服务清单的项目其价格双方协商约定。
		</p>
	</div>
</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行控股（中国）有限公司</div>
<!--页面js区域-->
<script src="{pigcms{$static_path}/js/137/jquery.min.js"></script>
<script src="{pigcms{$static_path}/js/137/sweetalert.min.js"></script>
<script src="{pigcms{$static_path}/js/137/ui-sweetalert.min.js"></script>
<!--ajaxUploadFile.js-->
<script type="text/javascript" src="{pigcms{$static_path}js/exif.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/imgUpload.js" charset="utf-8"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/village_uploadImg.js" charset="utf-8"></script>
<script>



    $("select[name='repair_type']").change(function () {
        var repair_type = $("select[name='repair_type']").val();
        $.ajax({
            url:"{pigcms{:U('ajax_repair_table')}",
            type:'post',
            data:{'repair_type':repair_type},
            success:function (res) {
                $('table').html(res);
            }
        });
    })

    //用户进行点击以后选中所点项然后自动填充表单
	$('table').on('click','tr',function(){
        var type_name = $("select[name='repair_type'] option:selected").text();
		var name=$(this).children().eq(0).text();
		//console.log($(this).children("td:eq(0)").text());
		if(name != '没有相关服务项目'&&name!='服务项目'&&name!='价格'){
			var content = '类别：'+type_name+'  内容：'+name;
			$("input[name='content']").val(content);
			$(".ty41").slideDown(100);
			//直接跳转到页面指定位置
			$("html,body").animate({ scrollTop: $("#cc").offset().top},500);
		}
	});

	//用户提交表单 ajax
	function submit_form(){
		//内容类别
		var content = $("input[name='content']").val();
		//联系方式
		var contact = $("input[name='contact']").val();
		//当前报修项目id
		var village_id = "{pigcms{$Think.get.village_id}";
		//当前备注
		var details = $("*[name='details']").val();
		//处理ajax上传图片返回的数据
		var arr = [];
		$("input[name='inputimg[]']").each(function(){
			arr.push($(this).val());
		});
		if(contact==''){
			swal("联系方式不能为空", "方便我们直接与您取得联系", "error");
			return false;
		}
		//非表单提交
		$.ajax({
			url:"{pigcms{:U('ajax_submit_form')}",
			type:'post',
			data:{'content':content,'contact':contact,'village_id':village_id,'image':arr,'details':details},
			success:function (res) {
				if(res == 1){
					swal({
						title: "报修信息以提交!",
						text: "我们马上解决您反馈的问题",
						type: "success",
						closeOnConfirm: false,
						confirmButtonText: "完成",
						confirmButtonColor: "#ec6c62",
					}, function() {
						//不作任何操作
						window.location.href="{pigcms{:U('Home/index_new')}";
					});
				}else{
					swal("报修提交失败", "请联系管理员，稍后重试", "error");
				}
			}
		});
	}


</script>
</body>
</html>