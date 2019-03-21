<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    <!--
    .dropdown-menu {margin: 0 0 0 -90px;}
    -->
</style>
<!--头部设置-->
<?php
$title = array(
    'title'=>'滞留件列表',
    'describe'=>'',
);
$breadcrumb = array(
    array('滞留件列表','#'),
    array('滞留件列表','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<block name="table-toolbar-right">
    <!--    筛选-->
    <!--<select  style="width: 10%" name="company_id">
        <option value=" ">全部</option>
        <foreach name="company_list" item="sv">
            <option value="{pigcms{$sv.company_name}">{pigcms{$sv.company_name}</option>
        </foreach>
    </select>-->
    <br>
    <br>
    <!--    <div id="com_a" >-->
    <foreach name="company_list_count" item="vo" key="ko">
        <a href="javascript:;" class="icon-btn" data-company="{pigcms{$ko}">
            <i class="fa fa-bookmark"></i>
            <div> {pigcms{$ko} </div>
            <span class="badge badge-danger badge_{pigcms{$ko}" > {pigcms{$vo} </span>
        </a>
    </foreach>
    <!--    </div>-->
    <br>
    <br>
</block>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
    <tr>
        <th width="20%">运单号</th>
        <th>快递公司</th>
        <th>取件码</th>
        <th>收件人</th>
        <th>电话</th>
        <th>微信昵称</th>
        <th>活跃度(1活跃度=1次收件)</th>
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
                <td style="color: orange;width: 15%"> <!--<img src="{pigcms{$vo.avatar}" style="width: 15%;height: 15%"/>-->{pigcms{$vo.nickname} </td>
                <td style="color: red;text-align: center"> {pigcms{$vo.active_value} </td>
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
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>
    //已发送短信按钮放上去改变文字功能
    $(".dropdown-menu").bind('mouseover',function () {
        console.log('重新发送');
        $("a.been_send").text('重新发送');
    });
    $(".dropdown-menu").bind('mouseout',function () {
        console.log('已经发送');
        $("a.been_send").text('已经发送');
    });

    $("select[name='company_id']").change(function(){
        var d_cid = $("select[name='company_id']").val();
        $("#sample_1_filter").find("input").val(d_cid).keyup();
    });

    $(".icon-btn").on('click',function () {
        var company_name = $(this).attr('data-company');
        $("#sample_1_filter").find("input").val(company_name).keyup();
    });

    $("input[name='date']").change(function(){
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
    });

    $("#keyword1").blur(function () {
        var keyword1 = $("#keyword1").val();
        $("#sample_1_filter").find("input").val(keyword1).keyup();
    });

    $("select[name='status']").change(function(){
        var ym = $("input[name='date']").val();
        var status = $("select[name='status']").val();
        $("#sample_1_filter").find("input").val(status).keyup();
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
    function check_send(phone,receipt_code,id,status) {
        if(status==0){
            sendSms(phone,receipt_code,id);
        }else{
            swal({
                    title: "是否发送短信提醒?",
                    text: "该件已被提货或被拒收",
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
</script>

<!--自定义js代码区结束-->
<include file="Public_news:footer"/>