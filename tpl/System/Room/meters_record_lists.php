<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/tpl/Wap/default/static/css/meter/weui.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'工程设备记录表',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('工程设备记录表','#'),
);

?>
<!--头部设置结束-->
<include file="Public_news:header"/>

<!--<if condition="$admin eq 1">-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;" data-toggle="dropdown">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--            <i class="fa fa-angle-down"></i>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu">-->
<!--            <li>-->
<!--                <a href="{pigcms{:U('')}">-->
<!--                    <i class="fa fa-building-o"></i> 全部显示 </a>-->
<!--            </li>-->
<!--            <foreach name="villageArray" item="vo">-->
<!--                <li>-->
<!--                    <a href="__SELF__&village_id={pigcms{$vo.village_id}">-->
<!--                        <i class="fa fa-building-o"></i> {pigcms{$vo.village_name} </a>-->
<!--                </li>-->
<!--            </foreach>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <else/>-->
<!--    <div class="btn-group">-->
<!--        <a class="btn green-haze btn-outline sbold uppercase" href="javascript:;">-->
<!--            <i class="fa fa-building"></i> 当前:{pigcms{$presentVillage}-->
<!--        </a>-->
<!--    </div>-->
<!--</if>-->


<style type="text/css">
<!--
table.dataTable.no-footer {
    border-bottom: none;
}
div.xdsoft_datetimepicker {
    z-index: 111000;
}
-->
</style><br/>
<br/>
<!--业务区-->
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{pigcms{:U('meters_record_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">工程设备
                        <!-- <i class="fa fa-plus"></i> -->
                    </button>
                </a>
            </div>

            <!-- <div class="btn-group">
                <a href="{pigcms{:U('PropertyService/point_list',array('is_del'=>0))}">
                    <button id="sample_editable_1_new" class="btn sbold green">巡更点管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
                
                <a href="#form_modal2" data-toggle="modal">
                    <button id="sample_editable_1_new" class="btn sbold green">巡更班次管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div> -->
        </div>
    </div>

    <br/>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <!-- <div class="btn-group">
                <input type="date" name="choose_time" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>"/>
            </div> -->
            <div class="input-group input-large date-picker input-daterange">
                <input type="text" class="form-control" name="choose_time" id="choose_time" value="<php>echo $_GET['d_time']?:date('Y-m-d')</php>" onchange="" style="width: 140px;"> 
            </div>

            <!-- <div class="input-group input-large date-picker input-daterange" data-date="2018/09/14" data-date-format="yyyy/mm/dd">
            <input type="text" class="form-control" name="choose_time" id="time_from1">
            <span class="input-group-addon"> to </span>
            <input type="text" class="form-control" name="choose_time" id="time_to1" onchange=""> 
            </div> -->

        </div>
        <div class="col-md-6">
            <if condition="$setArr neq ''">
                <div class="btn-group btn-group btn-group-justified">
                    <if condition="$setArr['morning_shift'] eq 1">
                        <a href="{pigcms{:U('meters_record_lists',array('work_time'=>1,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==1){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==1){echo 'green';}else{echo 'default';}}</php>"> 10:00 </a>
                    </if>
                    <if condition="$setArr['middle_shift'] eq 1">
                        <a href="{pigcms{:U('meters_record_lists',array('work_time'=>2,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==2){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==2){echo 'green';}else{echo 'default';}}</php>"> 15:00 </a>
                    </if>
                    <if condition="$setArr['night_shift'] eq 1">
                        <a href="{pigcms{:U('meters_record_lists',array('work_time'=>3,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==3){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==3){echo 'green';}else{echo 'default';}}</php>"> 21:30 </a>
                    </if>
                    <if condition="$setArr['night_shift'] eq 1">
                        <a href="{pigcms{:U('meters_record_lists',array('work_time'=>4,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==4){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==4){echo 'green';}else{echo 'default';}}</php>"> 06:30 </a>
                    </if>
                </div>
            <else/>
                <div class="btn-group btn-group btn-group-justified">
                    <a href="{pigcms{:U('meters_record_lists',array('work_time'=>1,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==1){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==1){echo 'green';}else{echo 'default';}}</php>"> 10:00 </a>
                    <a href="{pigcms{:U('meters_record_lists',array('work_time'=>2,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==2){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==2){echo 'green';}else{echo 'default';}}</php>"> 15:00 </a>
                    <a href="{pigcms{:U('meters_record_lists',array('work_time'=>3,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==3){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==3){echo 'green';}else{echo 'default';}}</php>"> 21:30 </a>
                    <a href="{pigcms{:U('meters_record_lists',array('work_time'=>4,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==4){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==4){echo 'green';}else{echo 'default';}}</php>"> 06:30 </a>
                </div>
            </if>                    
        </div>
    </div>

    <!-- <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title">巡更班次管理</h3>
                </div>
                <form  method="post"  class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-4" style="font-size: 20px;">选择班次:</label>
                        <div class="form-group" style="width: 500px; margin-left: 100px; margin-top: 40px;">
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px; margin-bottom: 5px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="morning_shift" name="morning_shift" value="{pigcms{$setArr['morning_shift']}" onchange="changeval()" <if condition="$setArr['morning_shift'] eq 1">checked</if>> 早班 </span>
                                <input type="text" class="form-control" name="morning_time_from" id="morning_time_from" value="{pigcms{$setArr['morning_time_from']}" <if condition="$setArr['morning_shift'] eq 0">disabled</if>>
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="morning_time_to" id="morning_time_to" value="{pigcms{$setArr['morning_time_to']}" <if condition="$setArr['morning_shift'] eq 0">disabled</if>>
                            </div>
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px; margin-bottom: 5px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="middle_shift" name="middle_shift" value="{pigcms{$setArr['middle_shift']}" onchange="changeval()" <if condition="$setArr['middle_shift'] eq 1">checked</if>> 中班 </span>
                                <input type="text" class="form-control" name="middle_time_from" id="middle_time_from" value="{pigcms{$setArr['middle_time_from']}" <if condition="$setArr['middle_shift'] eq 0">disabled</if>>
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="middle_time_to" id="middle_time_to" value="{pigcms{$setArr['middle_time_to']}" <if condition="$setArr['middle_shift'] eq 0">disabled</if>>
                            </div>
                            <div class="input-group select2-bootstrap-prepend" style="width: 400px;">
                                <span class="input-group-addon">
                                    <input type="checkbox" id="night_shift" name="night_shift" value="{pigcms{$setArr['night_shift']}" onchange="changeval()" <if condition="$setArr['night_shift'] eq 1">checked</if>> 晚班 </span>
                                <input type="text" class="form-control" name="night_time_from" id="night_time_from" value="{pigcms{$setArr['night_time_from']}" <if condition="$setArr['night_shift'] eq 0">disabled</if>>
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="night_time_to" id="night_time_to" value="{pigcms{$setArr['night_time_to']}" <if condition="$setArr['night_shift'] eq 0">disabled</if>>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button class="btn green"  onclick="go()">确定</button>
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div> -->

    <br/>
    <if condition="$_GET['point_status'] eq '' and $_GET['work_time'] neq ''">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    设备共:  <span style="color: blue">{pigcms{$MeterCount}</span>台 ，已抄表:  <span style="color: green">{pigcms{$nowMeterCount}</span> 台, 未抄表：<a href="{pigcms{:U('',array('work_time'=>$_GET['work_time']?:'','d_time'=>$_GET['d_time']?:''))}">{pigcms{$lowMeterCount}</a>台，抄表率:  <span style="color: blue">{pigcms{$rate}</span>。
                </div>
            </div>
        </div>
    </if>
</div>

<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" style="text-align: center;">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="10%">楼层</th>
            <th width="20%">设备号</th>
            <th width="10%">所属分类</th>
            <th width="10%">抄表人</th>
            <th width="20%">抄表时间</th>
            <!-- <th width="10%">状态</th> -->
            <th class="button-column" width="20%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="meterArray" id="vo">
            <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td><div class="tagDiv">{pigcms{$vo.meter_id}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.meter_code}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.meter_cate}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.check_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.check_time|date='Y-m-d H:i:s',###}</div></td>
                <!-- <if condition="$vo['point_status'] eq 0">
                    <td><div class="tagDiv" style="color: green">正常</div></td>
                <else/>
                    <td><div class="tagDiv" style="color: red">异常</div></td>
                </if> -->
                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('meters_record_detail',array('id'=>$vo['id'],'field'=>$vo['meter_sign']))}"
                                   data-toggle="modal"
                                   data-target="#modal_{pigcms{$vo.meter_id}">
                                    <i class="icon-tag"></i> 查看详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <!--弹出层容器-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.meter_id}">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
            <!--        弹出层容器-->
        </volist>
        </tbody>
    </table>

</div>

<br />
<!-- <div class="row">
    <div class="col-md-12">
        <div class="btn-group" style="width:100%;">
            <div style="float:left; line-height:34px;">过去30天的巡更情况</div>
			
			<div id="rate" style="float:right; line-height:34px; margin-left:10px;">总巡更点 164 个，已巡更 0 次, 未巡更：164 次,巡更率：0%。 </div>
			
			<div style="float:right;">
			
    			<div class="input-group input-large date-picker input-daterange">
        			<input type="text" class="form-control" name="from" id="time_from">
        			<span class="input-group-addon"> to </span>
        			<input type="text" class="form-control" name="to" id="time_to" onchange=""> 
                </div>						
			
			</div>
			<div style="clear:both"></div>
        </div>
    </div>
</div> -->
<!-- <div id="didida" style="margin-top:10px;">
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>巡更日期</th>
            <th>总巡更点</th>
            <th>已巡更</th>
            <th>未巡更</th>
        </tr>
        <foreach name="month_pointRecord" item="vo">
            <tr>
                <td>{pigcms{$vo.date}</td>
                <td>{pigcms{$vo.pointNum}</td>
                <td>{pigcms{$vo.yes_Count}</td>
                <td>{pigcms{$vo.no_Count}</td>
            </tr>
        </foreach>
    </table>

</div> -->
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
 -->
 <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>

<!--获取日期时间插件 -->
<script type="text/javascript">
    $.datetimepicker.setLocale('ch');
     $('#choose_time').datetimepicker({
            format: 'Y/m/d',
            lang:"zh",
            timepicker:false
        });
</script>

<!--选择不同日期获取该时间段的巡更率 -->
<script type="text/javascript">
    $("input[name='choose_time']").change(function(){
        var d_time = $("input[name='choose_time']").val();
        window.location.href='/admin.php?g=System&c=Room&a=meters_record_lists&d_time='+d_time;
    });
</script>

<script>
    //隐藏
    $('.summary').hide();
    function read(obj){
        if(confirm('您确定要标记为已处理？')){
            var bindid = $(obj).attr('bindid');
            var cid = $(obj).attr('pid');
            $.post("{pigcms{:U('do_repair')}",{bind_id:bindid,cid:cid},function(result){
                if(result.error == 0){
                    window.location.reload();
                }
            })
        }
    }
    $(function(){
        $('.handle_btn').on('click',function(){
            art.dialog.open($(this).attr('href'),{
                init: function(){
                    var iframe = this.iframe.contentWindow;
                    window.top.art.dialog.data('iframe_handle',iframe);
                },
                id: 'handle',
                title:'查看详情',
                padding: 0,
                width: 820,
                height: 520,
                lock: true,
                resize: false,
                background:'black',
                button: null,
                fixed: false,
                close: null,
                left: '50%',
                top: '38.2%',
                opacity:'0.4'
            });
            return false;
        });

    });

    // $("input[name='choose_time']").change(function(){
    //     var d_time = $("input[name='choose_time']").val();
    //     window.location.href='/admin.php?g=System&c=Room&a=meters_record_lists&d_time='+d_time;
    // });
</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
