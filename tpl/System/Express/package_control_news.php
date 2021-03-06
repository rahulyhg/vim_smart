<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />


<!--<style>
    border-top-color{
    rgb(255, 255, 255);
    }
</style>-->
<!--<style>
    .dropdown-menu {margin: 0 0 0 -90px;}
</style>-->
<!--头部设置-->
<?php
$title = array(
    'title'=>'包裹管理',
    'describe'=>'',
);
$breadcrumb = array(
    array('收发快递','#'),
    array('包裹管理','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<style type="text/css">
<!--
.table-checkable tr>td:first-child, .table-checkable tr>th:first-child {
    text-align: center;
    max-width: 100px;
    min-width: 40px;
    padding-left: 0;
    padding-right: 0;
}
-->
</style><div class="row">
    <div class="col-md-12">
        <!--<div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase" style="font-size: 24px;">当前快递：{pigcms{$company_name}</span>
                <hr/>
            </div>
        </div>-->
        <br/>
        <br/>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>包裹管理 </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li <if condition="$_GET['type'] eq 0">class="active"</if>>
                            <a href="#tab_6_1" data-toggle="tab"> 包裹入库 </a>
                            </li>
                            <li <if condition="$_GET['type'] eq 1">class="active"</if>>
                            <a href="#tab_6_2" data-toggle="tab"> 包裹出库 </a>
                            </li>
                            <li <if condition="$_GET['type'] eq 2">class="active"</if>>
                            <a href="#tab_6_3" data-toggle="tab"> 用户信息 </a>
                            </li>
                            <li <if condition="$_GET['type'] eq 3">class="active"</if>>
                            <a href="#tab_6_4" data-toggle="tab"> 包裹统计 </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class='tab-pane <if condition="$Think.get.type eq 0"> active<else/>fade</if>' id="tab_6_1">
                                <div class="portlet-body form form-horizontal">

                                    <div class="form-body">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">快递公司<span style="color: red">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-phone"></i>
                                                                        </span>
                                                    <select name="cid" class="form-control input-circle-right">
                                                        <option value="0" selected='selected'>请选择</option>
                                                        <foreach name="company_list" item="vo">
                                                            <option value="{pigcms{$vo.company_id}"<if condition="$vo['company_id'] eq $_GET['cid']">selected="selected"</if>>{pigcms{$vo.company_name}</option>
                                                        </foreach>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">手机号<span style="color: red">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-phone"></i>
                                                                        </span>
                                                    <input type="text" name="phone" class="form-control input-circle-right" placeholder="请输入收件人移动电话,如果是座机电话则请电话通知"> </div>
                                                <span class="text-danger" id="phone-warning" style="display: none;">请不要输入座机号码！</span>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">姓名</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                                    <input type="text" name="name" class="form-control input-circle-right" placeholder="请输入收件人姓名"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="saoma">
                                            <label class="col-md-3 control-label">运单编号<span style="color: red">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-barcode"></i>
                                                                        </span>
                                                    <!--<div class="form-control1 input-circle-right" contentEditable="true"></div>-->
                                                    <input type="text" name="waybill_number" class="form-control input-circle-right" placeholder="请扫描运单号" value="">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="alert alert-danger" style="display: none">
                                            <strong>错误！</strong><span></span></div>

                                        <div class="alert alert-success" style="display: none">
                                            <strong>成功！</strong><span></span></div>


                                        <div class="form-actions" id="hand_submit">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button"  class="btn btn-circle green" id="handInput">提交</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="row">
                                    <select name="company_id" class="form-control col-md-3" style="width: 15%">
                                        <option value="0" selected='selected'>请选择</option>
                                        <foreach name="company_list" item="vo">
                                            <option value="{pigcms{$vo.company_name}">{pigcms{$vo.company_name}</option>
                                        </foreach>
                                    </select>
                                    <input type="text" name="keyword" value="" class="form-control" style="float: right;width: 50%" placeholder="请输入运单号，手机，姓名，提货码" id="keyword1"/>
                                    </div>-->
                                    <br/>
                                    <br/>
                                    <div style="width:92%; float:left;">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sms_failed" data-company="未送达" style="width: 100%; margin-bottom:20px;">
                                        <tr>
											<td align="center"><span style="font-weight:bold;">短信提醒未送达数量</span></td>
                                            <td align="center">总数</td>
											<td align="center">{pigcms{$sms_failed['num']}</td>
                                            <td align="center">已处理数</td>
											<td align="center">{pigcms{$sms_failed['last']}</td>
                                            <td align="center">尚未处理数</td>
                                            <td align="center" style="font-weight:bold;"><a style="color:#fb4746;">{pigcms{$sms_failed['now']}</a></td>
                                        </tr>
                                    </table>
									</div>
                                    <script>
                                        $("#sms_failed").on('click',function () {
                                            var company_name = $(this).attr('data-company');
                                            $("#sample_1_filter").find("input").val(company_name).keyup();
                                        });
                                    </script>
                                    <div style="float:right;">
									<a href="{pigcms{:U('package_info_list')}" class="btn btn-primary">更多</a>
									</div>
									<div style="clear:both"></div>

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>运单号</th>
                                            <th>快递公司</th>
                                            <th>取件码</th>
                                            <th>收件人</th>
                                            <th>电话</th>
                                            <th>包裹状态</th>
                                            <th class="textcenter">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <if condition="is_array($list)">
                                            <volist name="list" id="vo">
                                                <tr>
                                                    <td width="20%">{pigcms{$vo.waybill_number}</td>
                                                    <td>{pigcms{$vo.company_name}</td>
                                                    <td>{pigcms{$vo.receipt_code}</td>
                                                    <td>{pigcms{$vo.name}</td>
                                                    <td>{pigcms{$vo.phone}</td>
                                                    <td>
                                                        <!--                    <if condition="$vo['status'] eq 0">-->
                                                        <!--                        <span style="color: blue">已到站</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}-->
                                                        <!--                    <elseif condition="$vo['status'] eq 1"/>-->
                                                        <!--                        <span style="color: green">已提货</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                        <!--                    <elseif condition="$vo['status'] eq 2"/>-->
                                                        <!--                        <span style="color: red">顾客拒收</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                        <!--                    <elseif condition="$vo['status'] eq 3"/>-->
                                                        <!--                        <span style="color: red">站点拒签</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                        <!--                    <elseif condition="$vo['status'] eq 4"/>-->
                                                        <!--                        <span style="color: red">已退件</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                        <!--                    </if>-->
                                                        <if condition="$vo['status'] eq 0">
                                                            <span style="color: blue">已到站</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                            <elseif condition="$vo['status'] eq 1"/>
                                                            <span style="color: green">已提货</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                            <elseif condition="$vo['status'] eq 2"/>
                                                            <span style="color: red">顾客拒收</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                            <elseif condition="$vo['status'] eq 3"/>
                                                            <span style="color: red">站点拒签</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                            <elseif condition="$vo['status'] eq 4"/>
                                                            <span style="color: red">已退件</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                        </if>
                                                    </td>
                                                    <td class="textcenter">
                                                        <div class="btn-group">
                                                            <if condition="$vo['status'] eq 0">
                                                                <a href="javascript:;" class="btn btn-xs btn-primary" onclick="changePackageStatus('{pigcms{$vo.id}',1)">提货</a>
                                                                <elseif condition="$vo['status'] eq 1"/>
                                                                <button type="button" class="btn btn-xs btn-primary">已提货</button>
                                                                <elseif condition="$vo['status'] eq 2"/>
                                                                <button type="button" class="btn btn-xs btn-primary">顾客拒收</button>
                                                                <elseif condition="$vo['status'] eq 3"/>
                                                                <button type="button" class="btn btn-xs btn-primary">站点拒签</button>
                                                                <elseif condition="$vo['status'] eq 4"/>
                                                                <button type="button" class="btn btn-xs btn-primary">已退件</button>
                                                            </if>
                                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle " data-toggle="dropdown">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <if condition="$vo['status'] eq 0">
                                                                    <li>
                                                                        <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',2)"> 顾客拒收 </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',3)"> 站点拒签 </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',4)"> 退件 </a>
                                                                    </li>
                                                                    <li>
                                                                        <if condition="$vo['is_send_sms'] eq 0">
                                                                            <a href="javascript:;" onclick="sendSms('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}')">
                                                                                发送短信
                                                                            </a>
                                                                        </if>
                                                                        <if condition="$vo['is_send_sms'] neq 0" >
                                                                            <a href="javascript:;" onclick="check('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}');">
                                                                                已经发送
                                                                            </a>
                                                                        </if>
                                                                    </li>
                                                                </if>
                                                                <if condition="$vo['status'] eq 1">
                                                                    <li>
                                                                        <if condition="$vo['is_send_sms'] eq 0">
                                                                            <a href="javascript:;" onclick="sendSms('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}')">
                                                                                发送短信
                                                                            </a>
                                                                        </if>
                                                                        <if condition="$vo['is_send_sms'] neq 0" >
                                                                            <a href="javascript:;" onclick="check('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}');">
                                                                                已经发送
                                                                            </a>
                                                                        </if>
                                                                    </li>
                                                                </if>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </volist>

                                            <else/>
                                            <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                                        </if>
                                        </tbody>
                                    </table>
                                </div>

                                <!--包裹入`1库javascript-->
                                <script>



                                    $("input[name='phone']").change(function () {
                                        var phone = $("input[name='phone']").val();
                                        if(phone.substr(0,1)!=1){
                                            $("input[name='phone']").val('');
                                            swal({
                                                title: '输入号码不为手机号',
                                                text: "手机号码格式错误，不能输入座机号码，请检查",
                                                type:'warning',
                                                confirmButtonText: "确定"
                                            });
                                            return false;
                                        }
                                        $.ajax({
                                            url:"{pigcms{:U('ajax_user_info')}",
                                            type:'post',
                                            data:{'phone':phone},
                                            success:function (res) {
                                                res && $("input[name='name']").val(res);
                                            }
                                        });
                                    });



                                    $("input[name='phone']").keyup(function () {
                                        var phone = $("input[name='phone']").val();
                                        if(phone.substr(0,1)!=1){
                                            $("input[name='phone']").val('');
                                            $("#phone-warning").css('display','inline');
                                            return false;
                                        }
                                        $("#phone-warning").css('display','none');
                                        if(phone.length>=11){
                                            $("input[name='name']").focus();
                                        }
                                    });

                                    $("#handInput").click(function(){

                                        var phone = $("input[name='phone']").val(),
                                            name  = $("input[name='name']").val(),
                                            waybill_number  = $("input[name='waybill_number']").val(),
                                            cid   =  $('select[name="cid"]').val(),
                                            tip   = '运单号'+waybill_number+'已经入库'
                                        ;

                                        $.ajax({
                                            url:'{pigcms{:U("ajax_in_database")}',
                                            type:'post',
                                            data:{'phone':phone,'name':name,'waybill_number':waybill_number,'cid':cid},
                                            dataType:'json',
                                            success:function (res) {
                                                if(res.err == 0){
                                                    $(".input-group input").val('');
                                                    $(".alert-danger").hide();
                                                    $(".alert-success span").html(tip);
                                                    $(".alert-success").slideDown();
                                                    $("#in_database tr:eq(1)").before(res.data);

                                                    setTimeout(function(){
                                                        $(".alert-success").slideUp();
                                                    },5000);
                                                }else{
                                                    $(".alert-success").hide();
                                                    $(".alert-danger span").html(res.msg);
                                                    $(".alert-danger").slideDown();

                                                    setTimeout(function(){
                                                        $(".alert-danger").slideUp();
                                                    },5000);

                                                }

                                            }
                                        });
                                    });



                                    $("input[name='waybill_number']").keydown(function(e){
                                        var e = e || event,
                                            keyCode = e.which || e.keyCode;

                                        if(keyCode==13){
                                            $("#handInput").trigger("click");//触发click
                                        }
                                    });


                                    function changePackageStatus(id,status){
                                        $.ajax({
                                            url:"{pigcms{:U('change_status')}",
                                            type:'post',
                                            data:{'id':id,'status':status},
                                            success:function(res){
                                                if(res == 1){
                                                    window.location.reload();
                                                }else{
                                                    alert('改变失败');
                                                }
                                            }
                                        });
                                    }

                                    function sendSms(phone,receipt_code,id){
                                        $.ajax({
                                            url:"{pigcms{:U('ajax_send_sms')}",
                                            type:'post',
                                            data:{'phone':phone,'receipt_code':receipt_code,'id':id},
                                            success:function(res){
                                                if(res == 1){
                                                    swal({
                                                            title: '发送完毕',
                                                            text: "客户收到通知短信了。",
                                                            type:'success',
                                                            confirmButtonText: "确定"

                                                        },function(){
                                                            window.location.reload();
                                                        }

                                                    );
                                                }else{
                                                    swal({
                                                            title: '发送失败',
                                                            text: "请联系技术人员。",
                                                            type:'warning',
                                                            confirmButtonText: "确定"

                                                        },function(){
                                                            window.location.reload();
                                                        }

                                                    );
                                                }
                                            }
                                        });
                                    }


                                </script>
                                <!--包裹入库javascript-->
                            </div>
                            <div class="tab-pane <if condition='$Think.get.type eq 1'> active<else/>fade</if>" id="tab_6_2">
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">运单号</label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                            <span class="input-group-addon input-circle-left">
                                                                <i class="fa fa-barcode"></i>
                                                            </span>
                                                        <input type="text" name="code" class="form-control input-circle-right" id="num" autofocus="autofocus" placeholder="请扫描或者输入运单号"> </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" class="btn btn-primary" id="out">确认出库</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr/>
                                        <div class="alert alert-danger" style="display: none">
                                            <strong>错误！</strong><span></span></div>

                                        <div class="alert alert-success" style="display: none">
                                            <strong>成功！</strong><span></span></div>

                                        <!--<div class="row">
                                        <select name="status" class="form-control col-md-3" style="width: 15%">
                                            <option value="已到站">待出库</option>
                                            <option value="已提货">已出库</option>
                                        </select>
                                        <input type="text" name="keyword" value="" class="form-control" style="float: right;width: 50%" placeholder="请输入运单号，手机，姓名，提货码" id="keyword2"/>
                                        </div>-->
                                        <br/>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                            <thead>
                                            <tr>
                                                <th>运单号</th>
                                                <th>快递公司</th>
                                                <th>取件码</th>
                                                <th>收件人</th>
                                                <th>电话</th>
                                                <th>包裹状态</th>
                                                <th class="textcenter">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <if condition="is_array($list)">
                                                <volist name="list" id="vo">
                                                    <tr>
                                                        <td width="20%">{pigcms{$vo.waybill_number}</td>
                                                        <td>{pigcms{$vo.company_name}</td>
                                                        <td>{pigcms{$vo.receipt_code}</td>
                                                        <td>{pigcms{$vo.name}</td>
                                                        <td>{pigcms{$vo.phone}</td>
                                                        <td>
                                                            <!--                    <if condition="$vo['status'] eq 0">-->
                                                            <!--                        <span style="color: blue">已到站</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}-->
                                                            <!--                    <elseif condition="$vo['status'] eq 1"/>-->
                                                            <!--                        <span style="color: green">已提货</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                            <!--                    <elseif condition="$vo['status'] eq 2"/>-->
                                                            <!--                        <span style="color: red">顾客拒收</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                            <!--                    <elseif condition="$vo['status'] eq 3"/>-->
                                                            <!--                        <span style="color: red">站点拒签</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                            <!--                    <elseif condition="$vo['status'] eq 4"/>-->
                                                            <!--                        <span style="color: red">已退件</span><br/>{pigcms{$vo.out_package_time|date='Y-m-d H:i:s',###}-->
                                                            <!--                    </if>-->
                                                            <if condition="$vo['status'] eq 0">
                                                                <span style="color: blue">已到站</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                                <elseif condition="$vo['status'] eq 1"/>
                                                                <span style="color: green">已提货</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                                <elseif condition="$vo['status'] eq 2"/>
                                                                <span style="color: red">顾客拒收</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                                <elseif condition="$vo['status'] eq 3"/>
                                                                <span style="color: red">站点拒签</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                                <elseif condition="$vo['status'] eq 4"/>
                                                                <span style="color: red">已退件</span><br/>{pigcms{$vo.in_package_time|date='Y-m-d H:i:s',###}
                                                            </if>
                                                        </td>
                                                        <td class="textcenter">
                                                            <div class="btn-group">
                                                                <if condition="$vo['status'] eq 0">
                                                                    <a href="javascript:;" class="btn btn-xs btn-primary" onclick="changePackageStatus('{pigcms{$vo.id}',1)">提货</a>
                                                                    <elseif condition="$vo['status'] eq 1"/>
                                                                    <button type="button" class="btn btn-xs btn-primary">已提货</button>
                                                                    <elseif condition="$vo['status'] eq 2"/>
                                                                    <button type="button" class="btn btn-xs btn-primary">顾客拒收</button>
                                                                    <elseif condition="$vo['status'] eq 3"/>
                                                                    <button type="button" class="btn btn-xs btn-primary">站点拒签</button>
                                                                    <elseif condition="$vo['status'] eq 4"/>
                                                                    <button type="button" class="btn btn-xs btn-primary">已退件</button>
                                                                </if>
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle " data-toggle="dropdown">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <if condition="$vo['status'] eq 0">
                                                                        <li>
                                                                            <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',2)"> 顾客拒收 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',3)"> 站点拒签 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;" onclick="changePackageStatus('{pigcms{$vo.id}',4)"> 退件 </a>
                                                                        </li>
                                                                        <li>
                                                                            <if condition="$vo['is_send_sms'] eq 0">
                                                                                <a href="javascript:;" onclick="sendSms('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}')">
                                                                                    发送短信
                                                                                </a>
                                                                            </if>
                                                                            <if condition="$vo['is_send_sms'] neq 0" >
                                                                                <a href="javascript:;" onclick="check('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}');">
                                                                                    已经发送
                                                                                </a>
                                                                            </if>
                                                                        </li>
                                                                    </if>
                                                                    <if condition="$vo['status'] eq 1">
                                                                        <li>
                                                                            <if condition="$vo['is_send_sms'] eq 0">
                                                                                <a href="javascript:;" onclick="sendSms('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}')">
                                                                                    发送短信
                                                                                </a>
                                                                            </if>
                                                                            <if condition="$vo['is_send_sms'] neq 0" >
                                                                                <a href="javascript:;" onclick="check('{pigcms{$vo.phone}','{pigcms{$vo.receipt_code}','{pigcms{$vo.id}');">
                                                                                    已经发送
                                                                                </a>
                                                                            </if>
                                                                        </li>
                                                                    </if>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </volist>

                                                <else/>
                                                <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                                            </if>
                                            </tbody>
                                        </table>
                                        <!-- END 1FORM1-->
                                    </div>
                                    <script>


                                        $("input[name='code']").keydown(function(e){
                                            var e = e || event,
                                                keyCode = e.which || e.keyCode;

                                            if(keyCode==13){
                                                $("#out").trigger("click");//触发click
                                            }
                                        });

                                        $("#out").click(function(){

                                            var code = $("input[name='code']").val(),
                                                tip   = '运单号'+code+'已经出库'
                                            ;

                                            $.ajax({
                                                url:'{pigcms{:U("ajax_out_database")}',
                                                type:'post',
                                                data:{'code':code},
                                                dataType:'json',
                                                success:function (res) {
                                                    if(res.err == 0){
                                                        $(".input-circle-right").val('');
                                                        $(".alert-danger").hide();
                                                        $(".alert-success span").html(tip);
                                                        $(".alert-success").slideDown();
                                                        $("#out_database tr:eq(1)").before(res.data);

                                                        setTimeout(function(){
                                                            $(".alert-success").slideUp();
                                                        },5000);
                                                    }else{
                                                        $(".alert-success").hide();
                                                        $(".alert-danger span").html(res.msg);
                                                        $(".alert-danger").slideDown();

                                                        setTimeout(function(){
                                                            $(".alert-danger").slideUp();
                                                        },5000);

                                                    }

                                                }
                                            });
                                        });


                                    </script>
                                </div>
                            </div>
                            <div class="tab-pane <if condition='$Think.get.type eq 2'> active<else/>fade</if>" id="tab_6_3" >
                                <div class="portlet-body form">
                                    <!-- BEGIN FOR1M-->
                                    <p>
                                        <a href="javascript:;" class="btn purple btn-outline sbold " id="blockui_sample_4_3" onclick="auto_bind()"> 自动绑定微信 </a>
                                    </p>

                                    <div class="alert alert-danger" style="display: none">
                                        <strong>错误！</strong><span></span></div>

                                    <div class="alert alert-success" style="display: none">
                                        <strong>成功！</strong><span></span></div>

                                    <div id="blockui_sample_4_portlet_body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                            <tr>
                                                <th> 姓名 </th>
                                                <th> 电话 </th>
                                                <th> 微信昵称 </th>
                                                <th> 状态 </th>
                                                <th> 活跃值 </th>
                                                <th> 操作 </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <foreach name="userList" item="vo">
                                                <tr>

                                                    <td> {pigcms{$vo.name} </td>
                                                    <td> {pigcms{$vo.phone} </td>
                                                    <td style="color: orange;width: 15%"> <!--<img src="{pigcms{$vo.avatar}" style="width: 15%;height: 15%"/>-->{pigcms{$vo.nickname} </td>
                                                    <td name="status">
                                                        <if condition="$vo['status'] eq 0">
                                                            <span style="color:green;">正常</span>
                                                            <elseif condition="$vo['status'] eq 1"/>
                                                            <span style="color:red;">封禁</span>
                                                        </if>
                                                    </td>
                                                    <td style="color: red;text-align: center"> {pigcms{$vo.active_value} </td>
                                                    <td>
                                                        <if condition="$vo['status'] eq 0">
                                                            <button class="btn green btn-xs" type="button" name="blacklist" data-id = "{pigcms{$vo.pigcms_id}"> 拉黑
                                                            </button>
                                                            <else/>
                                                            <button class="btn block btn-xs" type="button"> 已拉黑
                                                            </button>
                                                        </if>
                                                        <if condition="$vo['uid'] eq 0">
                                                            <a class="btn dark btn-xs" data-toggle="modal" data-target="#common_modal" href="{pigcms{:U('bind_weChat',array('id'=>$vo['pigcms_id']))}">
                                                                绑定微信
                                                            </a>
                                                        </if>

                                                    </td>
                                                </tr>
                                            </foreach>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END 1FORM1-->
                                </div>
                                <script>


                                    $("*[name='blacklist']").on('click',function(){
                                        var black = '<button class="btn block btn-xs" type="button"> 已拉黑 </button>',
                                            text  = '<span style="color:red;">封禁</span>',
                                            id = $(this).attr('data-id'),
                                            $this = $(this)
                                        ;
                                        $.ajax({
                                            url:'{pigcms{:U("see_you_in_blacklist")}',
                                            type:'post',
                                            data:{'id':id},
                                            success:function(res){
                                                if(res==1){
                                                    console.log(black);
                                                    $this.parent().html(black);
                                                    $this.parent().prev().html(text);
                                                }else{
                                                    alert('拉黑失败');
                                                }
                                            }
                                        });
                                    });


                                    function auto_bind() {

                                        $.ajax({
                                            url:'{pigcms{:U("ajax_bind_weChat")}',
                                            success:function (res) {
                                                console.log(res);
                                                if(res != '999'){
                                                    $(".alert-success span").html('绑定完成，系统已绑定'+res+'人');
                                                    $(".alert-success").slideDown();

                                                    setTimeout(function(){
                                                        $(".alert-success").slideUp();
                                                        window.location.href='__SELF__&type=2';
                                                    },2000);
                                                }else{
                                                    $(".alert-danger span").html('自动绑定失败！');
                                                    $(".alert-danger").slideDown();

                                                    setTimeout(function(){
                                                        $(".alert-danger").slideUp();
                                                        window.location.href='__SELF__&type=2';
                                                    },3000);
                                                }
                                            }
                                        });
                                    }


                                </script>
                            </div>
                            <div class="tab-pane <if condition='$Think.get.type eq 3'> active<else/>fade</if>" id="tab_6_4" >
                                <div class="portlet-body form">
                                    <!-- BEGIN FOR1M-->
                                    <div id="blockui_sample_4_portlet_body">
                                        <!--<div class="input-group" style="width: 80%">
                                                                        <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-user"></i>
                                                                        </span>
                                            <select name="cid" class="form-control input-circle-right">
                                                <option value="0" selected='selected'>快递公司</option>
                                                <foreach name="company_list" item="vo">
                                                    <option value="{pigcms{$vo.company_id}"<if condition="$vo['company_id'] eq $_GET['cid']">selected="selected"</if>>{pigcms{$vo.company_name}</option>
                                                </foreach>
                                            </select>

                                            <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-paper-plane"></i>
                                                                        </span>
                                            <select name="status" class="form-control input-circle-right">
                                                <option value="" selected='selected'>包裹状态</option>
                                                <option value="0">已入库</option>
                                                <option value="1">已出库</option>
                                                <option value="2">滞留件</option>
                                            </select>
                                            <span class="input-group-addon input-circle-left">
                                                                            <i class="fa fa-paw"></i>
                                                                        </span>
                                            <input type="text" name="phone" class="form-control input-circle-right" placeholder="运单号、收件人姓名或者电话" />

                                        </div>
                                        <button type="button" class="btn btn-circle blue" style="float: right;" id="handsearch">搜索</button>-->
                                        <div class="page-toolbar">
                                            <div id="dashboard-report-range" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" data-original-title="Change dashboard date range">
                                                <i class="icon-calendar"></i>&nbsp;
                                                <span class="thin uppercase hidden-xs"></span>&nbsp;
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                            <div class="btn-group btn-theme-panel">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                        <foreach name="count_list" item="v" key="k">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <if condition="$k eq 'count_retention'">
                                                <a class="dashboard-stat dashboard-stat-v2 {pigcms{$v.color}"
                                                   id="{pigcms{$k}_url" href="{pigcms{:U('package_info_list_retention')}">
                                                    <else />
                                                    <a class="dashboard-stat dashboard-stat-v2 {pigcms{$v.color}"
                                                       id="{pigcms{$k}_url" href="">
                                                </if>
                                                    <div class="visual">
                                                        <i class="fa fa-comments"></i>
                                                    </div>
                                                    <div class="details">
                                                        <div class="number" id="{pigcms{$k}">
                                                            <!--<span data-counter="counterup" data-value="{pigcms{$v.num}">0</span>-->{pigcms{$v.num}
                                                        </div>
                                                        <div class="desc" id="{pigcms{$k}_name"> {pigcms{$v.name}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </foreach>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="company_list_count" style="margin-top:25px;">
                                            <tr>
                                                <td align="center">快递公司名称</td>
                                                <foreach name="company_list_count" item="v" key="k">
                                                    <td align="center">
                                                        {pigcms{$k}
                                                    </td>
                                            </foreach>
                                            </tr>
                                            <tr>
                                                <td align="center">今日入库快递数量</td>
                                                <foreach name="company_list_count" item="v" key="k">
                                                <td align="center">
                                                    {pigcms{$v['in']}
                                                </td>
                                        </foreach>
                                            </tr>
                                            <tr>
                                                <td align="center">当前滞留件数量</td>
                                                <foreach name="company_list_count" item="v" key="k">
                                                    <td align="center">{pigcms{$v['out']}</td>
                                                </foreach>
                                            </tr>
                                        </table>

                                        <!-- END 1FORM1-->
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--        弹出层容器-->
<div class="modal fade" tabindex="-1" role="dialog" id="common_modal">
    <div class="modal-dialog modal-lg" role="document" style="width:1200px">
        <div class="modal-content">

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js1-->
<include file="Public_news:script"/>
<script src="/Car/Admin/Public/assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
<!--<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!--<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>-->
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Car/Admin/Public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!--<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>-->
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入js-->

<!--自定义js代码区开始-->
<script>
    /*$(function(){
     $("#sample_1_length").hide();
     $("#sample_1_filter").hide();
     });
     */
    $("select[name='company_id']").change(function(){
        var d_cid = $("select[name='company_id']").val();
        $("#sample_1_filter").find("input").val(d_cid).keyup();
    });

    $("#keyword1").blur(function () {
        var keyword1 = $("#keyword1").val();
        $("#sample_1_filter").find("input").val(keyword1).keyup();
    });

    $("select[name='status']").change(function(){
        var status = $("select[name='status']").val();
        $("#sample_1_filter").find("input").val(status).keyup();
    });

    $("#keyword2").blur(function () {
        var keyword2 = $("#keyword2").val();
        $("#sample_1_filter").find("input").val(keyword2).keyup();
    });
    $(function () {
        var name = "{$Think.session.admin_name}";
        /*toastr.options = {
         "closeButton": true,
         "debug": false,
         "positionClass": "toast-bottom-right",
         "progressBar" : true,
         "onclick": null,
         "showDuration": "1000",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "slideDown",
         "hideMethod": "slideUp"
         };
         toastr["success"]("欢迎使用智慧停车系统！", "您好!  "+name);*/
        $('.ranges ul li').click(function () {
            //alert($(this).index());//点击后获取当前li的下标
            //js中字符串转化成整形，用于下面做运算
            var start=new Date();
            start.setHours(0);
            start.setMinutes(0);
            start.setSeconds(0);
            start.setMilliseconds(0);
            var today=start;
            var a=parseInt(Date.parse(start)/1000);
            var b=parseInt(Date.parse(new Date())/1000);
            start=new Date();
            start.setDate(1);
            start.setHours(0);
            start.setMinutes(0);
            start.setSeconds(0);
            start.setMilliseconds(0);
            var thismouth_begin = parseInt(Date.parse(start)/1000);
            var oneday = 1000 * 60 * 60 * 24;
            var begin_time="";
            var end_time="";
            var td_title="";
            console.log(a);
            console.log(b);
            //获取列表下标，判断当前选中时间
            var t=$(this).index();
            if(t!=7){
                if(t==0){
                    begin_time = a;
                    end_time = b;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("今日已入库");
                    $("#count_out_name").html("今日已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='今日';
                }else if(t==1){
                    begin_time = a-24*60*60;
                    end_time = a;
                    $("#count_in_rul").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("昨日已入库");
                    $("#count_out_name").html("昨日已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='昨日';
                }else if(t==2){
                    begin_time = a-7*24*60*60;
                    end_time = a;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("近七天已入库");
                    $("#count_out_name").html("近七天已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='近七天';
                }
                else if(t==3){
                    begin_time = a-30*24*60*60;
                    end_time = a;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("近30天已入库");
                    $("#count_out_name").html("近30天已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='近30天';
                }
                else if(t==4){
                    begin_time = thismouth_begin;
                    end_time = b;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("本月已入库");
                    $("#count_out_name").html("本月已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='本月';
                }
                else if(t==5){
                    var lastMonthFirst = new Date(today - oneday * today.getDate());
                    begin_time = parseInt(Date.parse(new Date(lastMonthFirst - oneday * (lastMonthFirst.getDate() - 1))))/1000;
                    end_time = thismouth_begin;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("上月已入库");
                    $("#count_out_name").html("上月已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='上月';
                }
                else if(t==6){
                    begin_time = 1451577600;
                    end_time = b;
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/"+begin_time+"/endDate/"+end_time);
                    $("#count_in_name").html("总计已入库");
                    $("#count_out_name").html("总计已出库");
                    $("#count_retention_name").html("滞留件");
                    td_title='总计'
                }
                //通过指定时间段查询包裹数据情况
                $.ajax({
                    url:"{pigcms{:U('ajax_get_package_list')}",
                    data:{'begin_time':begin_time,'end_time':end_time,'search_dim':'','type':'count'},
                    dataType:'json',
                    type:'post',
                    success:function(res){

                        $("#count_in").text(res.count_in);
                        $("#count_out").text(res.count_out);
                        $("#count_retention").text(res.count_retention);
                        $("#company_list_count").html(gettable(res.company_list_count,td_title));
                    }
                });
            }
        });
        function gettable(company_list_count,td_title) {
            var tableinfo1='<tr><td align="center">快递公司名称</td>';
            var tableinfo2='<tr><td align="center">'+td_title+' 入库快递数量 </td>';
            var tableinfo3='<tr><td align="center">'+td_title+' 出库快递数量 </td>';
            $.each(company_list_count,function(index,value) {
                tableinfo1 +='<td align="center">'+index+'</td>';
                tableinfo2 +='<td align="center">'+value['in']+'</td>';
                tableinfo3 +='<td align="center">'+value['out']+'</td>';
            });
            tableinfo1 +='</tr>';
            tableinfo2 +='</tr>';
            tableinfo3 +='</tr>';
            return tableinfo1+tableinfo2+tableinfo3;
        }

        //通过日历选择时间段查询交易情况
        $(".applyBtn").click(function () {
            var start=Date.parse(new Date($("input[name='daterangepicker_start']").val()))/1000;
            var end=Date.parse(new Date($("input[name='daterangepicker_end']").val()))/1000;
            /*var s_time = start.replace(/[\/]/g,'-');
             var e_time = end.replace(/[\/]/g,'-');*/
            var c = parseInt("{$garage_id}");
            $.ajax({
                url:"{pigcms{:U('ajax_get_package_list')}",
                data:{'begin_time':start,'end_time':end,'search_dim':'','type':'count'},
                dataType:'json',
                type:'post',
                success:function (res) {
                    $("#count_in_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/");
                    $("#count_out_url").attr('href',"__APP__Admin/Payrecord/showlist_pay/startDate/");
                    $("#count_retention_url").attr('href',"__APP__=Admin/Payrecord/showlist_pay/startDate/");
                    $("#count_in_name").html("已入库");
                    $("#count_out_name").html("已出库");
                    $("#count_retention_name").html("滞留件");
                    $("#count_in").text(res.count_in);
                    $("#count_out").text(res.count_out);
                    $("#count_retention").text(res.count_retention);
                    $("#company_list_count").html(gettable(res.company_list_count,''));
                }
            })
        });
    });
    $("select[name='company_id']").change(function(){
        var d_cid = $("select[name='company_id']").val();
        $("#sample_1_filter").find("input").val(d_cid).keyup();
    });

    $(".icon-btn").on('click',function () {
        var company_name = $(this).attr('data-company');
        $("#sample_1_filter").find("input").val(company_name).keyup();
    });

    /*$("input[name='date']").change(function(){
        var ym = $("input[name='date']").val();
        var status = $("input[name='status']").val();
        $("#sample_1_filter").find("input").val(ym).keyup();
        $.ajax({
            url:"{pigcms{:U('change_date')}",
            type:'post',
            data:{'ym':ym,'status':status},
            dataType:'json',
            success:function(res){
                for (var ko in res){
                    var vo = res[ko];
                    $(".badge_"+ko).html(vo);
                }
            }
        })
    });*/

    $("#keyword1").blur(function () {
        var keyword1 = $("#keyword1").val();
        $("#sample_1_filter").find("input").val(keyword1).keyup();
    });




    function changePackageStatus(id,status){
        switch (status)
        {
            case 1:status_name='提货';break;
            case 2:status_name='顾客拒收';break;
            case 3:status_name='站点拒签';break;
            case 4:status_name='退件';break;
        }
        swal({
                title: "是否进行"+status_name+"操作?",
                text: "请确认",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url:"{pigcms{:U('change_status')}",
                        type:'post',
                        data:{'id':id,'status':status},
                        success:function(res){
                            if(res == 1){
                                window.location.reload();
                            }else{
                                alert('改变失败');
                            }
                        }
                    });
                } else {

                }
            });
    }
    function sendSms(phone,receipt_code,id){
        $.ajax({
            url:"{pigcms{:U('ajax_send_sms')}",
            type:'post',
            data:{'phone':phone,'receipt_code':receipt_code,'id':id},
            success:function(res){
                if(res == 1){
                    swal({
                            title: '发送完毕',
                            text: "客户收到通知短信了。",
                            type:'success',
                            confirmButtonText: "确定"

                        },function(){
                            window.location.reload();
                        }

                    );
                }else{
                    swal({
                            title: '发送失败',
                            text: "请联系技术人员。",
                            type:'warning',
                            confirmButtonText: "确定"

                        },function(){
                            window.location.reload();
                        }

                    );
                }
            }
        });
    }
    function check(phone,receipt_code,id) {
        swal({
                title: "是否重新发送?",
                text: "已经发送过短信提醒",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    sendSms(phone,receipt_code,id);
                } else {

                }
            });
    }
    function check_send(phone,receipt_code,id,status,is_send_sms) {
        if(status==0&&is_send_sms==0){
            sendSms(phone,receipt_code,id);
        }else{
            if(is_send_sms==1&&status==0){
                var sms='该快件已发送过提醒短信';
            }else{
                var sms='该件已被提货或被拒收';
            }
            swal({
                    title: "是否发送短信提醒?",
                    text: sms,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        sendSms(phone,receipt_code,id);
                    } else {

                    }
                });
        }
    }
    function check_send_phone(id) {
            var sms='是否确定该快件收货人已经收到电话提醒';
            swal({
                    title: "是否通过电话提醒收货人?",
                    text: sms,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            url:"{pigcms{:U('ajax_send_phone')}",
                            type:'post',
                            data:{'id':id},
                            success:function(res){
                                if(res == 1){
                                    swal({
                                            title: '状态更改完毕',
                                            text: "该快件已处理",
                                            type:'success',
                                            confirmButtonText: "确定"

                                        },function(){
                                            window.location.reload();
                                        }

                                    );
                                }else{
                                    if(res == 2){
                                        var sms_res='该快件通知状态有误，请稍后再试';
                                    }else{
                                        var sms_res='参数错误，请稍后重试';
                                    }
                                    swal({
                                            title: '处理请求失败',
                                            text: sms_res,
                                            type:'warning',
                                            confirmButtonText: "确定"

                                        },function(){
                                            window.location.reload();
                                        }

                                    );
                                }
                            }
                        });
                    } else {

                    }
                });
        }
</script>
<!--自定义js代码区结束-->
<include file="Public_news:footer_server_news"/>