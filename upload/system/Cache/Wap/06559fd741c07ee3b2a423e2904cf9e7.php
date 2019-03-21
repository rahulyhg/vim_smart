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
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>layer/layer.m.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/common_ac.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/exif.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/imgUploadControl.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo ($static_path); ?>js/village_control.js" charset="utf-8"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
		<!--
		.weui_btn:hover {color:#FFFFFF;}
		.shtx_tyr {
    float: left;
    line-height: 26px;
    border: 0;
    height: 33px;
    font-size: 14px;
    margin-left: 14px;
    width: 65%;
    color: #b6b6b6;
}
		-->
	</style></head>
	<script type="text/javascript">
	$(function(){
		$('#company_id').change(function(){
			var company_idVal=$(this).find("option:selected").text();
			//alert(company_idVal);
			$(this).find("option:selected").text(company_idVal.split('-')[1]);	//截取公司名称前面的首字母
		})	
		$('#company_id').find("option:selected").text($('#company_id').find("option:selected").text().split('-')[1]);
				
		$('#card_type').change(function(){	//隐藏证件号
			var card_typeVal=$(this).val();
			if(card_typeVal==4){
				//motify.log('隐藏证件号');
				$('.shtx_usernum').css('display','none');
			}else{
				$('.shtx_usernum').css('display','block');
			}
		});	
	})
	
	function btnLoading(){	//加载方法
		var loadingToast=$('#loadingToast');
		if(loadingToast.css('display')!='none'){
			return;
		}
		loadingToast.show();
		setTimeout(function(){
			loadingToast.hide();
		}, 5000);
	}
	var url_data="<?php echo U('House/SmsCodeverify',array('village_id'=>$now_village['village_id']));?>";
	$(function(){
		if($("#upload_list").length){
			var imgUpload = new ImgUpload({
				fileInput: "#fileImage",
				container: "#upload_list",
				countNum: "#uploadNum",
				url:"http://" + location.hostname + "/wap.php?c=House&a=ajaxImgUpload"
			});
			$('.weui_btn_warn').click(function(){
				var truename=$('input[name="truename"]').val();	//真实姓名
				var phone=$('input[name="phone"]').val();	//手机号码
				var company=$('#company_id').val(); //公司
				//var department=$('input[name="department"]').val();	//所属部门
				//var youaddress=$('input[name="youaddress"]').val();	//公司地址
				var card_type=$('#card_type').val(); //证件类型
				var usernum=$('input[name="usernum"]').val();	//证件号码
				var inputimg=$('input[name="inputimg[]"]').val();	//工牌图片
				var vcode=$("input[name='vcode']").val();	//手机验证码
				if(truename=="" || truename=="null"){
					motify.log('请输入真实姓名');
					return false;
				}else if(!(/^([^0-9]*)$/.test(truename))){
					motify.log('姓名格式有误，请重填');
					return false;
				}else if(phone=="" || phone=="null"){
					motify.log('请输入手机号码');
					return false;
				}else if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){
					motify.log("手机号码格式有误，请重填");
					return false;
				}else if(vcode=="" || vcode=="null"){
					motify.log("请填写短信验证码");
					return false;
				}else if(company=="" || company=="null"){
					motify.log('请选择到访公司');
					return false;
				}else if(card_type=="" || card_type=="null"){
					motify.log('请选择证件类型');
					return false;
				}else if(card_type!="" && (card_type!=4 && card_type!=1) && (usernum=="" || usernum=="null")){
					motify.log('请输入证件号');
					return false;	
				}else if(card_type==3 && !checkCard1(usernum)){
					return false;
				}else if(card_type!="" && card_type!=1 && (!inputimg || inputimg=="undefined")){
					motify.log('请上传证件图片');
					return false;						
				}else{
					btnLoading();
					$.post(window.location.href,$('#access_form').serialize(),function(result){
						if(result.err_code==0){
							$('#loadingToast').css('display','none');	//隐藏加载
							layer.open({content:'提交成功!',shadeClose:false,btn:['确定'],yes:function(){
								window.location.href="<?php echo U('House/village_access_next',array('village_id'=>$now_village['village_id']));?>";
							}});
						}else{
							//motify.log(result.err_msg);
							alert(result.err_msg);
							window.location.reload();
						}
					});
				}
			})
		}
	})
</script>
<body>
<header class="pageSliderHide"><div id="backBtn"></div>资料审核</header>
<div class="sfrz_zkd"><img src="<?php echo ($static_path); ?>images/qq.jpg" style="width:100%;" /></div>
<form id="access_form" onSubmit="return false;">
	<div class="shtx_dk">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
			<!--<div class="shtx_kk"><input name="truename" type="text" value="请输入真实姓名" style="color:#ababab; border:none; width:90%; font-size:14px;" onClick="this.value=''"/>-->
			<div class="shtx_kk"><input name="truename" type="text" value="<?php echo ($user_info["name"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="请输入真实姓名"/></div>
			<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
			<div class="weui_cell weui_cell_select">
				<div class="weui_cell_bd weui_cell_primary">
					<select class="weui_select" name="company_id" id="company_id"><!--此处的class要看下，实现下拉样式-->
						<option selected="selected" value="">请选择所属公司</option>
						<?php if(is_array($company_list)): $i = 0; $__LIST__ = $company_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['company_id']); ?>" <?php if($user_info['company_id'] == $vo['company_id']): ?>selected<?php endif; ?> ><?php echo ($vo["company_first"]); ?>-<?php echo ($vo["company_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
			<!--<div class="shtx_kk"><input type="text" name="phone" value="请输入手机号码" style="color:#ababab; border:none; width:90%; font-size:14px;" onClick="this.value=''"/></div>-->
			<div class="shtx_kk"><input type="number" name="phone" value="<?php echo ($user_info["phone"]); ?>" style="color:#ababab;border:none;width:90%;font-size:14px;" placeholder="请输入手机号码" onFocus="focusPhone()" onBlur="blurPhone()"/></div>
			<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/re.jpg" style="width:14px; height:18px; margin-top:8px;"/></div>
			<div class="shtx_kk" style="width:80%;">
				<input class="input-weak" name="vcode" type="text" placeholder="填写验证码" style="width:80px;height:25px; border:1px #CCCCCC solid;"/>
				<button type="button" onClick="sendsms(this)" class="btn-weak" style="height:25px;background-color:#ff777d;color:#FFFFFF;border:none;" id="send-code">获取验证码</button>
			</div>
			<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="shtx_dk2">
		<!--<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q3.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
			<div class="shtx_kk">
				<input name="company_id" type="hidden" value="<?php echo ($user_info["company_id"]); ?>"/>
				<input  type="text" value="" style="color:#ababab; border:none; width:90%; font-size:14px;" id="input_change" placeholder="请输入公司名"/>
			</div>
			<div class="both"></div>
		</div>-->
		<!--<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>		
			<div class="shtx_kk"><input type="text" name="youaddress" value="<?php echo ($user_info["address"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="公司地址"/></div>
			<div class="both"></div>
		</div>-->
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/ff1.png" style="width:14px; height:20px; margin-top:6px;"/></div>
			<div class="weui_cell weui_cell_select">
				<div class="weui_cell_bd weui_cell_primary">
					<select class="weui_select" name="card_type" id="card_type">						
						<option selected="" value="">请选择证件类型</option>												
						<option value="2">门禁卡</option>
						<option value="3">身份证</option>
						<option value="4">工作牌</option>
						<!--<option value="1">现场审核</option>-->
					</select>
				</div>
			</div>
			<div class="both"></div>
		</div>
		<?php if($user_info["card_type"] != '4'): ?><div class="shtx_xm shtx_usernum">
			<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/ff2.png" style="width:17px; height:22px; margin-top:5px;"/></div>
			<div class="shtx_kk"><input name="usernum" type="text" value="<?php echo ($user_info["usernum"]); ?>" style="color:#ababab; border:none; width:90%; font-size:14px;" placeholder="请输入证件号"/></div>
			<div style="float:right; color:#FF0000; padding-top:13px; font-size:14px; padding-right:15px;">*</div>
			<div class="both"></div>
		</div><?php endif; ?>
		<div class="weui_cellj">
			<div class="weui_cell_bd weui_cell_primary">
				<div class="weui_uploader">
					<div class="weui_uploader_hd weui_cell">
						<div class="shtx_pic"><img src="<?php echo ($static_path); ?>images/lrr.png" style="width:17px; height:17px; margin-top:9px; margin-left:2px;"/></div>
						<div class="shtx_tyr">请上传证件照（正面）</div>
						<div class="both"></div>
					</div>
					<!--<div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                            <li class="weui_uploader_file" style="background:url(http://www.hdhsmart.com/tpl/Wap/pure/static/images/1.jpg)"></li>
                        </ul>
                        <div class="weui_uploader_input_wrp" id="upload_list">
                            <input class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple id="fileImage" name=""/>
                        </div>
                    </div>-->
					<div style="padding-bottom:5px;">
					  <div class="upload_box">
						<ul class="upload_list clearfix" id="upload_list">
							<li class="upload_action">
								<img src="/tpl/Wap/default/static/classify/upimg.png">
								<input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name="">
							</li>
						</ul>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="zkd"><a href="javascript:;" class="weui_btn weui_btn_warn">提交</a></div>
</form>
<div id="loadingToast" class="weui_loading_toast" style="display:none;">
	<div class="weui_mask_transparent"></div>
	<div class="weui_toast" style="width:9.6em;min-height:9.6em;left:48%">
		<div class="weui_loading">
			<div class="weui_loading_leaf weui_loading_leaf_0"></div>
			<div class="weui_loading_leaf weui_loading_leaf_1"></div>
			<div class="weui_loading_leaf weui_loading_leaf_2"></div>
			<div class="weui_loading_leaf weui_loading_leaf_3"></div>
			<div class="weui_loading_leaf weui_loading_leaf_4"></div>
			<div class="weui_loading_leaf weui_loading_leaf_5"></div>
			<div class="weui_loading_leaf weui_loading_leaf_6"></div>
			<div class="weui_loading_leaf weui_loading_leaf_7"></div>
			<div class="weui_loading_leaf weui_loading_leaf_8"></div>
			<div class="weui_loading_leaf weui_loading_leaf_9"></div>
			<div class="weui_loading_leaf weui_loading_leaf_10"></div>
			<div class="weui_loading_leaf weui_loading_leaf_11"></div>
		</div>
		<p class="weui_toast_content">数据加载中</p>
	</div>
</div>
<div class="zkd2">请联系您公司所在智能门禁管理员进行审核！</div>
<div class="zdb2">客服电话：<a href="tel:027-87779655" style="color:#fb4746;">027-87779655</a></div>
</body>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/valid.js"></script>
</html>