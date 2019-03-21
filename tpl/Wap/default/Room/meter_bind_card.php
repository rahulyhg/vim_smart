<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>在线抄表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/meter/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/jquery-weui.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/demos.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/kid.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.weui-cells {margin-top:0px; margin-bottom:15px;}
.weui-cells:before {border-top:none;}
.weui-cells:after {border-bottom:none;}
.weui-switch, .weui-switch-cp__box {width:82px;}
.weui-switch-cp__box:before, .weui-switch:before {width:80px;}
.weui-switch-cp__box:after, .weui-switch:after {width:40px;}
.weui-switch-cp__input:checked~.weui-switch-cp__box:after, .weui-switch:checked:after {transform: translateX(40px);}
.weui-switch-cp__input:checked~.weui-switch-cp__box, .weui-switch:checked {border-color: #96bcff; background-color: #96bcff;}
.sz:link{color:#586479; text-decoration:none;}
.sz:visited{color:#586479; text-decoration:none;}
.sz:active{color:#586479; text-decoration:none;}
.sz:hover{color:#586479; text-decoration:none;}
input{
-webkit-appearance: none;
border-radius:0px;
font-size:16px;
}
-->
</style></head>
<body>
<form action="{pigcms{:U('Room/deal_meter_bind_card')}" method="post" enctype="multipart/form-data">
<div class="tb">设备楼层：{pigcms{$meter_config[0]['meter_desc']}</div>
<div class="xkk">
	<div class="cw2">
				<div class="container">
					<ul class="my-biji-view">
						<li>
							<div class="biji-tit">
								<div class="jb">
									<div class="uz">基本信息</div>
									<div style="clear:both"></div>
								</div>
								<div class="zw m10">
									<div class="zw">
										<div class="zb">检查人：</div>
                                        <!-- <div class="yb">{pigcms{$name}</div> -->
										<div class="yb"><input type="text" style="height:30px; padding-left:8px; width:89%; outline:none; line-height:30px; background-color:#FFFFFF; border:0px #d4d4d4 solid;" name="check_name" readonly="" value="{pigcms{$name}"></div>
										<div style="clear:both;"></div>
									</div>
									<div class="zw">
										<div class="zb">检查时间：</div>
										<div class="yb">{pigcms{$time}</div>
										<div style="clear:both;"></div>
									</div>
								</div>
							</div>
							<div class="biji-content">
								<div class="jb">
									<div class="uz">基本信息</div>
									<div style="clear:both"></div>
								</div>
								<div class="zw m10">
									<div class="zw">
										<div class="zb">检查人：</div>
										<div class="yb"><input type="text" style="height:30px; padding-left:8px; width:89%; outline:none; line-height:30px; background-color:#FFFFFF; border:0px #d4d4d4 solid;" name="check_name" readonly="" value="{pigcms{$name}"></div>
										<div style="clear:both;"></div>
									</div>
									<div class="zw">
										<div class="zb">检查时间：</div>
										<div class="yb">{pigcms{$time}</div>
										<div style="clear:both;"></div>
									</div>
								</div>
								<div class="zw">
									<div class="zb">设备类型：</div>
									<div class="yb">{pigcms{$meter_config[0]['meter_type']}</div>
									<div style="clear:both;"></div>
								</div>
								<div class="zw">
									<div class="zb">设备分类：</div>
									<div class="yb">{pigcms{$meter_config[0]['cate_type']}</div>
									 <input type="hidden" name="sign" value="{pigcms{$data[0]['sign']}">
									<div style="clear:both;"></div>
								</div>
                                
                                <volist name="meter_config" id="vol">
                                <volist name="vol['configArr']" id="vo">
                                  <div class="zw" style="margin-top: -20px;">
                                    <div class="zb">{pigcms{$vo.desc}：</div>
                                    <div class="yb">{pigcms{$vo.val}</div>
                                    <div style="clear:both;"></div>
                                  </div>
                                </volist>
                                </volist>

								<!-- <div class="zw">
									<div class="zb">品牌：</div>
									<div class="yb">上稳</div>
									<div style="clear:both;"></div>
								</div> -->
							</div>
							<a class="biji-oth">
								<time></time>
								<div id="key" style="padding: 3px 6px;border: none;outline: none;background-color: #e4e4e4;color:#939393;font-size: 14px;border-radius: 4px;">展 开</div>
							</a>
						</li>
					</ul>
				</div>
	</div><div style="clear:both;"></div>
</div>
<script src="{pigcms{$static_path}js/meter/jquery.min.js"></script>
<script>
    $(function(){
        $(".biji-content").hide();
        //按钮点击事件
        $("#key").click(function(){
            var txts = $(this).parents("li");
            if ($(this).text() == "展 开"){
                $(this).text("收 起");
                txts.find(".biji-tit").hide();
                txts.find(".biji-content").show();
            }else{
                $(this).text("展 开");
                txts.find(".biji-tit").show();
                txts.find(".biji-content").hide();
            }
        })
    });
</script>


<div class="weui-tab__bd">
    <div class="by" >{pigcms{$data[0]['meter_code']}</div>
    <input type="hidden" name="meter_id" value="{pigcms{$data[0]['id']}">

    <volist name="data_2" id="vo">
        <if condition="$vo.id == 94">
            <div class="mc3" style="margin-top: -25px;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <!-- <tbody> -->
                      <tr>
                          <td style="background-color:#ffffff; width:50%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">声音状态</td>
                          <td><input class="weui-switch" type="checkbox" name="voice" value="1" style="margin-left: 20px;"></td>
                      </tr>
                  <!-- </tbody> -->
              </table>
            </div>
        <elseif condition="$vo.id == 95"/>
            <div class="mc3" style="margin-top: -25px;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <!-- <tbody> -->
                      <tr>
                          <td style="background-color:#ffffff; width:50%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">低压测母线状态</td>
                          <td><input class="weui-switch" type="checkbox" name="ohm" value="1" style="margin-left: 20px;"></td>                              
                      </tr>
                  <!-- </tbody> -->
              </table>
            </div>
        <else/>                                                
            <div class="mc3" style="margin-top: -25px;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td  colspan="2" style="background-color:#f1f1f1; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">{pigcms{$vo.desc}</td>
                  </tr>
                  <volist name="vo['parameters']" id="voo">
                  <tr>
                      <td style="background-color:#ffffff; width:30%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">{pigcms{$voo.desc}</td>
                      <td style="background-color:#ffffff; width:70%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;"><input name="{pigcms{$voo.key}_{pigcms{$voo.id}" type="text"  style="line-height:30px; height:30px; width:98%; border: 0px solid gray;"/></td>
                  </tr>
                  </volist>
                  <!-- <tr>
                      <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">B相</td>
                      <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;">0</td>
                  </tr>
                  <tr>
                      <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">C相</td>
                      <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;">0</td>
                  </tr> -->
              </table>                          
            </div>
        </if>
    </volist>

</div>

    
<script src="{pigcms{$static_path}js/meter/jquery-2.1.4.js"></script>
<script src="{pigcms{$static_path}js/meter/fastclick.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/meter/index.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>
<script src="{pigcms{$static_path}js/meter/jquery-weui.js"></script>           


<div style="margin:0px auto; width:90%; padding-top:5px; padding-bottom:5px;">
<!-- <div class="ba" type="submit">上报数据</div> -->
<button type="submit" class="ba">提交记录</button>
</form>
<div class="ba2"><a href="{pigcms{:U('meter_record_list',array('choose_cate'=>$data[0]['id']))}" class="sz">抄表记录</a></div>
<div style="clear:both"></div>
</div>
<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>
<script type="text/javascript">
    //刷新页面即点击第一个子目录
    var a = $('.weui-navbar :first-child').click();
    // console.log(a);
</script>
<!-- <script>
    //声音字段的判断与赋值
    $('input[name="voice"]').change(function(){
        if ($('input[name="voice"]').prop("checked")) {
            console.log(1);           
            $(".voice").val(1);
       } else { 
            console.log(2);
            $(".voice").val(0);
       }
    });

    //低压侧母字段的判断与赋值
    $('input[name="ohm"]').change(function(){
        if ($('input[name="ohm"]').prop("checked")) {
            console.log(1);           
            // $(".ohm").attr("value",1);           
            $(".ohm").val(1);
       } else { 
            console.log(2);
            // $(".ohm").attr("value",0);
            $(".ohm").val(0);
       }
    });
</script> -->
</body>