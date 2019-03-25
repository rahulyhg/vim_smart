<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<!--头部设置-->
<?php
$title = array(
    'title'=>'巡更管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('物业服务','#'),
    array('巡更管理','#'),
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
            <!--<div class="btn-group">
                <a href="{pigcms{:U('PropertyService/room_list')}">
                    <button id="sample_editable_1_new" class="btn sbold green">楼层管理
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>-->

            <div class="btn-group">
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
            </div>
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
                        <a href="{pigcms{:U('point_record',array('work_time'=>1,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==1){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==1){echo 'green';}else{echo 'default';}}</php>"> 早班 </a>
                    </if>
                    <if condition="$setArr['middle_shift'] eq 1">
                        <a href="{pigcms{:U('point_record',array('work_time'=>2,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==2){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==2){echo 'green';}else{echo 'default';}}</php>"> 中班 </a>
                    </if>
                    <if condition="$setArr['night_shift'] eq 1">
                        <a href="{pigcms{:U('point_record',array('work_time'=>3,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==3){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==3){echo 'green';}else{echo 'default';}}</php>"> 晚班 </a>
                    </if>
                </div>
            <else/>
                <div class="btn-group btn-group btn-group-justified">
                    <a href="{pigcms{:U('point_record',array('work_time'=>1,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==1){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==1){echo 'green';}else{echo 'default';}}</php>"> 早班 </a>
                    <a href="{pigcms{:U('point_record',array('work_time'=>2,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==2){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==2){echo 'green';}else{echo 'default';}}</php>"> 中班 </a>
                    <a href="{pigcms{:U('point_record',array('work_time'=>3,'d_time'=>$_GET['d_time']?:date('Y-m-d')))}" class="btn <php>if(empty($_GET['work_time'])){if($w_time==3){echo 'green';}else{echo 'default';}}else{if($_GET['work_time']==3){echo 'green';}else{echo 'default';}}</php>"> 晚班 </a>
                </div>
            </if>                    
        </div>
    </div>

    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
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
    </div>

    <br/>
    <if condition="$_GET['point_status'] eq '' and $_GET['work_time'] neq ''">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    巡更点一共  <span style="color: blue">{pigcms{$pointCount}</span> ，已经巡检  <span style="color: green">{pigcms{$nowPointCount}</span> 个, 未巡更点数：<a href="{pigcms{:U('no_check_point',array('work_time'=>$_GET['work_time']?:'','d_time'=>$_GET['d_time']?:''))}">{pigcms{$lowPointCount}</a>
                </div>
            </div>
        </div>
    </if>
</div>

<div id="shopList" class="grid-view">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="10%">楼层</th>
            <th width="10%">方位</th>
            <th width="15%">所属社区</th>
            <th width="15%">巡更人</th>
            <th width="10%">巡更时间</th>
            <th width="10%">状态</th>
            <th class="button-column" width="20%">操作</th>
        </tr>
        </thead>
        <tbody>
        <volist name="pointRecord" id="vo">
                <tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
                <td><div class="tagDiv">{pigcms{$vo.pigcms_id}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.orientation}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.village_name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.name}</div></td>
                <td><div class="tagDiv">{pigcms{$vo.check_time|date='Y-m-d H:i:s',###}</div></td>
                <if condition="$vo['point_status'] eq 0">
                    <td><div class="tagDiv" style="color: green">正常</div></td>
                <else/>
                    <td><div class="tagDiv" style="color: red">异常</div></td>
                </if>
                <td class="button-column">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">
                            <li>
                                <a href="{pigcms{:U('point_detail',array('id'=>$vo['pigcms_id']))}"
                                   data-toggle="modal"
                                   data-target="#modal_{pigcms{$vo.pigcms_id}">
                                    <i class="icon-tag"></i> 查看详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            <!--弹出层容器-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modal_{pigcms{$vo.pigcms_id}">
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
<div class="row">
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
</div>
<div id="didida" style="margin-top:10px;">
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

</div>
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

<script type="text/javascript">
    function changeval(){//当复选框改变时，获取三个班次的value值
        var check1 = document.getElementById("morning_shift");
        var check2 = document.getElementById("middle_shift");
        var check3 = document.getElementById("night_shift");
        if(check1.checked == true){//复选框被选中时,disabled失效
            document.getElementById("morning_shift").value = "1";
            document.getElementById("morning_time_from").disabled=false;
            document.getElementById("morning_time_to").disabled=false;           
        }else{//复选框取消时,disabled生效
            document.getElementById("morning_shift").value = "0";
            document.getElementById("morning_time_from").disabled=true;
            document.getElementById("morning_time_to").disabled=true;         
        }
        if(check2.checked == true){
            document.getElementById("middle_shift").value = "1";
            document.getElementById("middle_time_from").disabled=false;
            document.getElementById("middle_time_to").disabled=false;
        }else{
            document.getElementById("middle_shift").value = "0";
            document.getElementById("middle_time_from").disabled=true;
            document.getElementById("middle_time_to").disabled=true;
            
        }
        if(check3.checked == true){
            document.getElementById("night_shift").value = "1";
            document.getElementById("night_time_from").disabled=false;
            document.getElementById("night_time_to").disabled=false;
        }else{
            document.getElementById("night_shift").value = "0";
            document.getElementById("night_time_from").disabled=true;
            document.getElementById("night_time_to").disabled=true;
        }
    }
    function GetQuery(name){//获取url里的参数
         var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
         var r = window.location.search.substr(1).match(reg);
         if(r!=null)return  unescape(r[2]); return null;
    }
    function go() {//模态框提交
        var village_id = GetQuery("default_village_id");
        var morning_shift = $("input[name='morning_shift']").val();
        var middle_shift = $("input[name='middle_shift']").val();
        var night_shift = $("input[name='night_shift']").val();
        if (morning_shift == 0) {//当复选框取消时,重置该班次的开始和结束时间
            var morning_time_from = 0;
            var morning_time_to = 0;
        } else {
            var morning_time_from = $("input[name='morning_time_from']").val();
            var morning_time_to = $("input[name='morning_time_to']").val();
        }
        if (middle_shift == 0) {
            var middle_time_from = 0;
            var middle_time_to = 0;
        } else {
            var middle_time_from = $("input[name='middle_time_from']").val();
            var middle_time_to = $("input[name='middle_time_to']").val();
        }
        if (night_shift == 0) {
            var night_time_from = 0;
            var night_time_to = 0;
        } else {
            var night_time_from = $("input[name='night_time_from']").val();
            var night_time_to = $("input[name='night_time_to']").val();
        }
        var url = "{pigcms{:U('PropertyService/village_shift_setting')}";
        $.ajax({
            url:url,
            type:'post',
            data:{
                'village_id':village_id,
                'morning_shift':morning_shift,
                'middle_shift':middle_shift,
                'night_shift':night_shift,
                'morning_time_from':morning_time_from,
                'morning_time_to':morning_time_to,
                'middle_time_from':middle_time_from,
                'middle_time_to':middle_time_to,
                'night_time_from':night_time_from,
                'night_time_to':night_time_to
            },
            success:function(res){
                if (res) {
                    alert('班次更新成功');
                } else {
                    alert('班次更新失败');
                }
            }
        })       
    }
</script>
<!--获取日期时间插件 -->
<script type="text/javascript">
    $.datetimepicker.setLocale('ch');
     $('#choose_time').datetimepicker({
            format: 'Y/m/d',
            lang:"zh",
            timepicker:false
        });
     $('#time_from').datetimepicker({
            format: 'Y/m/d',
            lang:"zh",
            timepicker:false
        });
     $('#time_to').datetimepicker({
            format: 'Y/m/d',
            lang:"zh",
            timepicker:false
        });
     $('#morning_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#morning_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#middle_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#middle_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#night_time_from').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
     $('#night_time_to').datetimepicker({
            format: 'H:i',
            lang:"zh",
            datepicker:false
        });
</script>
<!--选择不同日期获取该时间段的巡更率 -->
<script type="text/javascript">
    $("input[name='to']").change(function(){
        alert(1);
        var time_from = $("#time_from").val();
        var time_to = $("#time_to").val();
        // console.log(time_from);
        // console.log(time_to);
        $.ajax({
             url:'{pigcms{:U("get_record_rate")}',
             type:'post',
             dataType:'json',
             data:{'time_from':time_from,'time_to':time_to},
             success:function (list) {
                 // console.log(list);
                 var y=document.getElementById("rate");
                    y.innerHTML="总巡更数: "+ list.pointTol +"个，已巡更: "+ list.nowPointCount +"个, 未巡更："+ list.lowPointCount +"个,巡更率："+ list.rate +"。";               
             }
         });
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

    $("input[name='choose_time']").change(function(){
        var d_time = $("input[name='choose_time']").val();
        window.location.href='/admin.php?g=System&c=PropertyService&a=point_record&d_time='+d_time;
    });
</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>
