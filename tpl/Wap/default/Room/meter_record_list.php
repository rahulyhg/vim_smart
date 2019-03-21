<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>设备报告列表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >  
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="{pigcms{$static_path}css/meter/style.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="{pigcms{$static_path}css/meter/jquery-weui.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.weui-select {padding-left:10px; }
.weui-navbar__item {font-size:15px; padding:10px; font-family:Arial; color:#333333;}
.weui-navbar + .weui-tab__bd {padding-top:45px;}
.weui-select {height:38px; line-height:38px;}
.weui-icon_msg {font-size: 26px;}
.weui-icon_msg-primary {font-size: 26px;}
-->
</style></head>
<body>
<div class="xkk">
  <div class="mc">
    <div class="zw2">
      <div class="wl"><img src="{pigcms{$static_path}images/tt.jpg" style="width:100%; height:auto; margin-top:13px;"/></div>
      <div class="wl2">请选择您要查询的设备名称和时间</div>
      <div style="clear:both"></div>
    </div>
  </div>
  <div class="mc2">
    <div class="zw2">
      <div class="weui-cell weui-cell_select">
          <div class="weui-cell__bd">
              <input type="date" name="choose_time" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>" style="line-height: 30px; width: 150px;"/>
          </div>
          <!-- <div class="input-group input-large date-picker input-daterange">
              <input type="text" class="form-control" name="choose_time" id="choose_time" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>" onchange="" style="width: 140px;"> 
          </div> -->
      </div>
    </div>
    <div class="zw2 m20">
      <div class="weui-cell weui-cell_select">
          <div class="weui-cell__bd">
              <select class="weui-select" name="choose_cate" style="border:1px #e7e7e7 solid;">
                  <option value=" ">全部</option>
                  <volist name="cateArr" id="vo">
                      <option value="{pigcms{$vo.id}" <if condition="$choose_cate eq $vo['id']">selected</if>>{pigcms{$vo.desc}</option>
                      <if condition="isset($vo['son'])">
                          <volist name="vo['son']" id="v">
                              <option value="{pigcms{$v.id}" <if condition="$choose_cate eq $v['id']">selected</if>>|--{pigcms{$v.meter_code}</option>
                          </volist>
                      </if>
                  </volist>                       
              </select>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="xkk" style="margin-top:20px;">
  <div class="zw">
    <div class="weui-tab" style="width: 99%;">
      <div class="weui-navbar" style="border:1px #e3e3e3 solid; border-bottom:none;" id="weui-navbar">
        <a href="{pigcms{:U('meter_record_list',array('choose_cate'=>$choose_cate,'work_time'=>1,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="weui-navbar__item <php>if(empty($_GET['work_time'])){if($w_time==1){echo 'weui-bar__item--on';}else{echo 'default';}}else{if($_GET['work_time']==1){echo 'weui-bar__item--on';}else{echo 'default';}}</php>"> 10:00 </a>
        <a href="{pigcms{:U('meter_record_list',array('choose_cate'=>$choose_cate,'work_time'=>2,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="weui-navbar__item <php>if(empty($_GET['work_time'])){if($w_time==2){echo 'weui-bar__item--on';}else{echo 'default';}}else{if($_GET['work_time']==2){echo 'weui-bar__item--on';}else{echo 'default';}}</php>"> 15:00 </a>
        <a href="{pigcms{:U('meter_record_list',array('choose_cate'=>$choose_cate,'work_time'=>3,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="weui-navbar__item <php>if(empty($_GET['work_time'])){if($w_time==3){echo 'weui-bar__item--on';}else{echo 'default';}}else{if($_GET['work_time']==3){echo 'weui-bar__item--on';}else{echo 'default';}}</php>"> 21:30 </a>
        <a href="{pigcms{:U('meter_record_list',array('choose_cate'=>$choose_cate,'work_time'=>4,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="weui-navbar__item <php>if(empty($_GET['work_time'])){if($w_time==4){echo 'weui-bar__item--on';}else{echo 'default';}}else{if($_GET['work_time']==4){echo 'weui-bar__item--on';}else{echo 'default';}}</php>"> 06:30 </a>
      </div>

      <div class="weui-tab__bd">
      <volist name="meterArr" id="vol">
      <volist name="vol" id="vo">
        
        <div class="weui-tab__bd">           
          <!-- <div style="width:100%; height:20px; overflow:hidden;"></div> -->
          <div class="dbt"><b>{pigcms{$vo.meter_code}</b></div>
          <volist name="vo['cateArray']" id="voi">          
          <if condition="$voi.id == 94">
              <div class="mc3" style="margin-top: -25px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <!-- <tbody> -->
                          <tr>
                              <td style="background-color:#ffffff; width:70%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">声音状态</td>
                              <if condition="$voi['child'][0]['parameter'] == 0">
                                <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-success weui-icon_msg"></i></td>
                              <else/>
                                <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-warn weui-icon_msg-primary"></i></td>
                              </if>
                          </tr>
                      <!-- </tbody> -->
                  </table>
              </div>
          <elseif condition="$voi.id == 95"/>
              <div class="mc3" style="margin-top: -25px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <!-- <tbody> -->
                          <tr>
                              <td style="background-color:#ffffff; width:70%; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">低压测母线状态</td>
                              <if condition="$voi['child'][0]['parameter'] == 0">
                                <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-success weui-icon_msg"></i></td>
                              <else/>
                                <td style="background-color:#ffffff; border:1px #d3d4d6 solid; height:42px; text-align:center; border-left:none; color:#508fff;"><i class="weui-icon-warn weui-icon_msg-primary"></i></td>
                              </if>                              
                          </tr>
                      <!-- </tbody> -->
                  </table>
              </div>
          <else/>                                                
              <div class="mc3" style="margin-top: -25px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td  colspan="2" style="background-color:#f1f1f1; border:1px #d3d4d6 solid; height:34px; text-align:center; color:#5f5f5f; font-weight:600;">{pigcms{$voi.desc}</td>
                      </tr>
                      <volist name="voi['child']" id="voc">
                      <tr>
                          <td style="background-color:#ffffff; width:70%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#2d2d2d;">{pigcms{$voc.desc}</td>
                          <td style="background-color:#ffffff; width:30%;  border:1px #d3d4d6 solid; height:34px; text-align:center; border-top:none; color:#666666; border-left:none;">{pigcms{$voc.parameter}</td>
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
          <!-- <div style="width:100%; height:20px; overflow:hidden;"></div>        -->
      </div>
      </volist>
      </volist>
    </div>
<script src="{pigcms{$static_path}js/meter/jquery-2.1.4.js"></script>
<script src="{pigcms{$static_path}js/meter/jquery-weui.js"></script>
    
  </div>
</div>

<div class="xkk" <if condition="$meter neq 1">style="display: none;"</if>>
  <div class="cw2">
    <div class="link">
      <div class="jb">
        <div class="uz">基本信息</div>
        <div style="clear:both"></div>
      </div>
    </div>
      <div class="zw m10">        
        <div class="zw" style="margin-top: -10px;">
          <div class="zb">设备楼层：</div>
          <div class="yb">{pigcms{$meter_config[0]['meter_desc']}</div>
          <div style="clear:both;"></div>
        </div>        
        <div class="zw" style="margin-top: -20px;">
          <div class="zb">设备类型：</div>
          <div class="yb">{pigcms{$meter_config[0]['meter_type']}</div>
          <div style="clear:both;"></div>
        </div>
        <div class="zw" style="margin-top: -20px;">
          <div class="zb">设备分类：</div>
          <div class="yb">{pigcms{$meter_config[0]['cate_type']}</div>
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

      </div>
  </div><div style="clear:both;"></div>
</div>


<div style="width:100%; height:60px; text-align:center; line-height:60px; color:#8a8a8a; font-size:14px;">汇得行（中国）集团有限公司</div>

<!--获取日期时间插件 -->
<!-- <script type="text/javascript">
    $.datetimepicker.setLocale('ch');
     $('#choose_time').datetimepicker({
            format: 'Y/m/d',
            lang:"zh",
            timepicker:false
        });
</script> -->

<!-- <script type="text/javascript">
    //刷新页面即点击第一个子目录
    var a = $('#weui-navbar :first-child').click();
    console.log(a);
</script> -->

<script>
    $("input[name='choose_time']").change(function(){
        var d_time = $("input[name='choose_time']").val();
        console.log(d_time);
        window.location.href='/wap.php?g=Wap&c=Room&a=meter_record_list&d_time='+d_time;
    });
</script>

<script>
    $("select[name='choose_cate']").change(function(){
        console.log($(this).val());
        var choose_cate = $(this).val();
        var d_time = $("input[name='choose_time']").val();
        console.log(choose_cate);
        $.ajax({
             url:'{pigcms{:U("meter_record_list")}',
             type:'get',
             data:{'choose_cate':choose_cate},
             success:function (res) {
                 if (res) {                 
                    window.location.href='/wap.php?g=Wap&c=Room&a=meter_record_list&d_time='+d_time+'&choose_cate='+choose_cate;
                 }
             }
         });
    });
</script>
</body>