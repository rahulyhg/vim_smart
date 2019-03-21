<?php if(!defined('PigCms_VERSION')){ exit('deny access!');} ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>{pigcms{$now_village.village_name}</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css?210"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/village.css?211"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weui.css"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/animate.css"/><!--7.18晚-->
	<!--<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/example.css"/>-->
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
	<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE_190')}" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/fastclick.js" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_public}js/jquery.cookie.js" charset="utf-8"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/common.js" charset="utf-8"></script>
	<link rel="stylesheet" href="{pigcms{$static_public}boxer/css/jquery.fs.boxer.css">
	<!--<script src="{pigcms{$static_public}boxer/js/jquery-1.8.3.min.js"></script>-->
	<script src="{pigcms{$static_public}js/zepto.min.js"></script><!--7.18晚-->
	<script src="{pigcms{$static_public}boxer/js/jquery.fs.boxer.js"></script>
	<style type="text/css">
		<!--
		.kkw {float:left; height:33px; line-height:33px; margin-left:10px; font-size:12px;}
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
    color: #FFFFFF;
    text-decoration: none;
    outline: 0;
}
		-->
	</style>
</head>
<script type="text/javascript">
	$(function(){
		$('#backBtn').click(function(){
			window.history.go(-1);
		});

		$('.btn_check').click(function(){	//通过或不通过
			//alert($(this).attr('data_idVal'));
			var ac_status=$(this).attr('data_status');
			var id_val=$(this).attr('data_idVal');
			var ac_desc=$('textarea[name="ac_desc"]').val();
			var uid_val=$(this).attr('data_uid');
			if(ac_status==3 && (ac_desc=="" || ac_desc=="null")){
				motify.log('请输入不通过原因');
				return false;
			}
			$.ajax({
				'url':"{pigcms{:U('House/village_control_checkInfo',array('village_id'=>$now_village['village_id']))}",
				'data':{'ac_status':ac_status,'id_val':id_val,'ac_desc':ac_desc,'uid_val':uid_val},
				'type':'POST',
				'dataType':'JSON',
				'success':function(msg){
					console.log(1);
					// console.log(msg);
					if(msg.err_code==0){
						motify.log(msg.code_msg);
						window.location.href="{pigcms{:U('House/village_control_check',array('village_id'=>$now_village['village_id']))}";
					}else{
						motify.log(msg.code_msg);
					}
				},
				'error':function(){
					console.log(2);
					alert('loading error');
				}
			})
		})
		
	})
</script>
<script>
	$(function(){
		$('.boxer').boxer({
			mobile: true
		});
	});
</script>

<body>
<header class="pageSliderHide"><div id="backBtn"></div>智能门禁</header>
<form id="access_form" onSubmit="return false;">
	<div class="shtx_dkx">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q1.jpg" style="width:12px; height:15px; margin-top:10px;"/></div>
			<div class="kkw">姓名&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--刘德华-->{pigcms{$user_info.name}</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q2.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
			<div class="kkw">联系方式&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--18086681360-->{pigcms{$user_info.phone}</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q3.jpg" style="width:12px; height:16px; margin-top:8px;"/></div>
			<div class="kkw">公司名称&nbsp;&nbsp;</div>
			<div class="shtx_kek">{pigcms{$user_info.company_name}
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="shtx_dk2">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/dd.jpg" style="width:14px; height:14px; margin-top:10px;"/></div>
			<div class="kkw">社区名称&nbsp;&nbsp;</div>
			<div class="shtx_kek">{pigcms{$user_info.village_name}
			</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/fww.png" style="width:12px; height:10px; margin-top:12px;"/></div>
			<div class="kkw">证件类型&nbsp;&nbsp;</div>
			<div class="shtx_kk"><if condition="$user_info.card_type eq 1">现场审核</if><if condition="$user_info.card_type eq 2">门禁卡</if><if condition="$user_info.card_type eq 3">身份证</if><if condition="$user_info.card_type eq 4">工作牌</if></div>
			<div class="both"></div>
		</div>
		<!--<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q4.jpg" style="width:12px; height:18px; margin-top:8px;"/></div>
			<div class="kkw">部门&nbsp;&nbsp;</div>
			<div class="shtx_kk">{pigcms{$user_info.department}</div>
			<div class="both"></div>
		</div>
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q5.jpg" style="width:12px; height:15px; margin-top:9px;"/></div>
			<div class="kkw">地址&nbsp;&nbsp;</div>
			<div class="shtx_kk">{pigcms{$user_info.address}</div>
			<div class="both"></div>
		</div>-->
		<if condition="$user_info.card_type neq 1 and $user_info.card_type neq 4">
		<div class="shtx_xm">
			<div class="shtx_pic"><img src="{pigcms{$static_path}images/q6.jpg" style="width:12px; height:14px; margin-top:9px;"/></div>
			<div class="kkw">证件号&nbsp;&nbsp;</div>
			<div class="shtx_kk"><!--9527-->{pigcms{$user_info.usernum}</div>
			<div class="both"></div>
		</div>
		</if>
	</div>

	<if condition="$user_info.card_type neq 1">
	<div class="weui_cells weui_cells_form">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<div class="weui_uploader">
					<div class="weui_uploader_hd weui_cell">
						<div class="weui_cell_bd weui_cell_primary">证件照（正面）</div>
					</div>
					<div class="upload_box">
						<ul class="upload_list clearfix" id="upload_list">
							<if condition="$user_info['workcard_img']">
								<php>$workcard_img=explode('|',$user_info['workcard_img'])</php>
								<volist name="workcard_img" id="img" key="k">
									 <a href="/upload/house/{pigcms{$img}" class="boxer">
									  <li class="upload_item" id="imgShow{pigcms{$k}" style="height:78px;background:url(./upload/house/{pigcms{$img}) 50% 50% / cover;">
										<img src="/upload/house/{pigcms{$img}" class="upload_image loading_img" />
									  </li>
									</a>
								</volist>
							</if>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div></if>
	<div style="width:92%; margin:10px auto; margin-bottom:0px; background-color:#FFFFFF;border-radius: 10px;" id="desc_show"><textarea id="description" name="ac_desc"  placeholder="请输入不通过原因" style="width:97%;height:50px; border:none; font-size:14px; line-height:25px; padding-left:5px;">{pigcms{$user_info.ac_desc}</textarea></div>
	<div class="zkd">
		<div style="float:left;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn_blue btn_check" data_status="2" data_idVal="{pigcms{$user_info.pigcms_id}" data_uid="{pigcms{$user_info.uid}">通过</a></div>
		<div style="float:right;width:48%;"><a href="javascript:;" class="weui_btn weui_btn_warn_blue btn_check" data_status="3" data_idVal="{pigcms{$user_info.pigcms_id}" data_uid="{pigcms{$user_info.uid}">不通过</a></div>
		<div style="clear:both"></div>
	</div>
</form>
</body>
</html>