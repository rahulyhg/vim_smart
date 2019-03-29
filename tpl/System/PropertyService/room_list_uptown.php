<extend name="./tpl/System/Public_news/base.php" />
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />

<block name="table-toolbar-left">
    <!--<div class="btn-group">
        <a href="{pigcms{:U('PropertyService/room_add_uptown')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加楼层\房间
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->
    <div class="btn-group">
        <a href="#form_modal2" data-toggle="modal">

            <button  class="btn sbold btn-danger" >
                <i class="fa fa-user"></i>
                业主缴费录入
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Receipt/receipt_list')}">

            <button  class="btn sbold btn-danger" >
                <i class="fa fa-file-text-o"></i>
                历史缴费记录
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Property/month')}">
            <button  class="btn sbold btn-danger" >
                <i class="fa fa-table"></i>
                报表台账
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#form_modal3" data-toggle="modal">
            <button  class="btn sbold green" >
                <i class="fa fa-pie-chart"></i>
                经营数据分析
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub()">
                <i class="fa fa-print"></i>
                打印选中催收单
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub_project()">
                <i class="fa fa-print"></i>
                打印全部欠费催收单
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('Room/owner_uptown_import_step1')}">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-plus"></i>
                单元导入
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('Room/water_uptown_import_step1')}">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-plus"></i>
                水电费批量导入
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('Otherfee/getotherfee_list')}" target="_blank">
            <button id="sample_editable_1_new" class="btn sbold green">
                <i class="fa fa-th-list"></i>
                收费类目管理
            </button>
        </a>
    </div>

    <div class="btn-group">
        <a href="{pigcms{:U('Room/ajax_village_excel_print',array('year'=>$year))}">
            <button id="sample_editable_1_new" class="btn sbold green">导出excel表格
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <br>
    <!--    筛选-->
    <div class="btn-group" style="margin-top: 10px">
        <span>筛选（默认显示全部）：</span>
        <span id="filter">
                <span>
                    <!--<div class="btn-group">
                        <select name="project_id" id="project_id_1" class="form-control search">
                            <option value="" selected="selected">请选择期数</option>
                            <volist name="project_list" id="value">
                                <option value="{pigcms{$value['pigcms_id']}">{pigcms{$value['desc']}</option>
                            </volist>
                        </select>
                    </div>-->
                    <div class="btn-group">
                        <select id="room_over_endtime" class="form-control search" onchange="search_change('room_over_endtime',this.options[this.options.selectedIndex].value)">
                            <option value="0" selected="selected">按缴费状态</option>
                            <option value="1">已欠费</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="room_house_type" class="form-control search" onchange="search_change('room_house_type',this.options[this.options.selectedIndex].value)">
                            <option value="4" selected="selected">按房屋状态</option>
                            <option value="0">空置</option>
                            <option value="1">出租</option>
                            <option value="2">自住</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="room_type" class="form-control search" onchange="search_change('room_type',this.options[this.options.selectedIndex].value)">
                            <option value="" selected="selected">按业主类型</option>
                            <option value="1">业主</option>
                            <option value="2">商户</option>
                            <option value="other">其它</option>
                        </select>
                    </div>
                </span>
            </span>
    </div>

    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">费用录入</h4>
                </div>

                <div class="modal-body">
                    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data" autocomplete="off">
                        <div class="portlet-body">

                            <div class="form-body">
                                <div style="width:64%; float:left; border-right: 1px #d0d0d0 solid;">
                                    <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">门牌号
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" id="room_name" value="" name="room_name" class="form-control" autocomplete="off" disableautocomplete>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">缴费类型
                                        </label>
                                        <div class="col-md-7">
                                            <select name="otherfee_type_id" id="otherfee_type_id" class="form-control">
                                                <option value="0">请选择</option>
                                                <option value="property">物业服务费</option>
                                                <option value="carspace">包月泊位费</option>
                                                <volist name="type_list" id="vo">
                                                    <option value="{pigcms{$vo.otherfee_type_id}">{pigcms{$vo.otherfee_type_name}</option>
                                                </volist>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">付款预付月数
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select name="property_mouth" class="form-control" id="property_mouth">
                                                    <option value="0" selected="selected">请选择</option>
                                                    <for start="1" end="24"  name="i" >
                                                        <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                                    </for>
                                                </select>
                                                <span class="required">如果没有设置过物业费到期时间，请先调整到期时间</span>
                                            </div>
                                        </div>
                                        <div class="property_pay" style="display: none;">
                                            <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                                <label class="col-md-5 control-label" for="form_control_1">应付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="property_recive" value="" name="property_recive" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                                <label class="col-md-5 control-label" for="form_control_1">实付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="property_true" value="" name="property_true" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carspace" style="display: none;">
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">选择车位
                                            </label>
                                            <div class="col-md-7">
                                                <select name="carspace_id" class="form-control">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1">付款预付月数
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <select name="carspace_mouth" class="form-control" id="carspace_mouth">
                                                    <option value="0" selected="selected">请选择</option>
                                                    <for start="1" end="24"  name="i" >
                                                        <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                                    </for>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="carspace_pay" style="display: none;">
                                            <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                                <label class="col-md-5 control-label" for="form_control_1">应付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                    <label id="carspace_recive"></label>元
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                                <label class="col-md-5 control-label" for="form_control_1">实付款
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-7" >
                                                    <input type="text"   id="carspace_true" value="" name="carspace_true" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="other_fee" style="display: none;">
                                        <if condition="$is_code">

                                            <div class="form-group form-md-line-input"  style="width:42%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1" >起码
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="code_start" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input"  style="width:30%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1 " >止码
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="code_end" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input"  style="width:33%; float:left;">
                                                <label class="col-md-6 control-label" for="form_control_1" >单价
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-list">
                                                        <input type="text" name="unit" value=""  class="form-control autocount" >
                                                    </div>
                                                </div>
                                            </div>


                                        </if>
                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;">
                                            <label class="col-md-5 control-label" for="form_control_1" id="fee_receive">应收
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="md-checkbox-list">
                                                    <input type="text" name="fee_receive" value=""  class="form-control control" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input"  style="width:50%; float:left;" id="fee_true_div">
                                            <label class="col-md-5 control-label" for="form_control_1" id="fee_true">实收
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="md-checkbox-list">
                                                    <input type="text" name="fee_true" value=""  class="form-control control" >
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="form-group form-md-line-input" style="width:50%; float:left;" >
                                        <label class="col-md-5 control-label" for="form_control_1">缴费方式
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="type" class="form-control">
                                                <!--<option value="2">现金</option>
                                                <option value="1">线上支付</option>
                                                <option value="3">转账</option>
                                                <option value="4">POS单</option>
                                                <option value="5">现金缴款单</option>-->
                                                <foreach name="fee_type_list" item="vo" key="key">
                                                    <option value="{pigcms{$key}">{pigcms{$vo}</option>
                                                </foreach>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input" style="width:50%; float:left;">
                                        <label class="col-md-5 control-label" for="form_control_1">备注
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7" >
                                            <textarea    value="" name="remark" class="form-control" style="height:34px;"></textarea>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>


                                </div>


                                <div style="float:left; width:35%;">

                                    <div id="room_info" class="form-group form-md-line-input" style="display: none;">
                                        <label class="col-md-4 control-label" for="form_control_1" >房屋信息
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <span id="room_info_id"></span>
                                        </div>
                                    </div>

                                    <div id="user_info" class="form-group form-md-line-input" style="display: none;">
                                        <label class="col-md-4 control-label" for="form_control_1">业主信息
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <span id="user_info_id"></span>
                                        </div>
                                    </div>

                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input" >
                                            <label class="col-md-4 control-label" for="form_control_1">物业费到期时间
                                            </label>
                                            <div class="col-md-7">
                                                <span id="property_time"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="property" style="display: none;">
                                        <div class="form-group form-md-line-input"  >
                                            <label class="col-md-4 control-label" for="form_control_1">物业服务费单价
                                            </label>
                                            <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                <label id="property_unit"></label>元每平方米每月
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carspace" style="display: none;">
                                        <div class="form-group form-md-line-input"  >
                                            <label class="col-md-4 control-label" for="form_control_1">包月泊位费单价
                                            </label>
                                            <div class="col-md-7" style="padding-top:5px; line-height:24px;">
                                                <label id="carspace_price"></label>元每月
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="clear:both"></div>

                            </div>

                            <!--<div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="button" id="handInput" class="btn green">确认提交</button>
                                    </div>
                                </div>
                            </div>-->
                        </div>

                        <div class="alert alert-danger" style="display: none">
                            <strong>错误！</strong><span></span></div>

                        <div class="alert alert-success" style="display: none">
                            <strong>成功！</strong><span></span></div>

                        <div  class="input-mouth" style="display:none;">

                            <div class="input-group input-large date-picker input-daterange" style="left:100px">
                                <input type="text" class="form-control" name="start_mouth" id="time_from" >
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="end_mouth" id="time_to" >
                            </div>


                            <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
                            <!--获取日期时间插件 -->
                            <script type="text/javascript">
                                $.datetimepicker.setLocale('ch');
                                $('#time_from').datetimepicker({
                                    format: 'Y-m-d',
                                    lang:"zh",
                                    timepicker:false
                                });
                                $('#time_to').datetimepicker({
                                    format: 'Y-m-d',
                                    lang:"zh",
                                    timepicker:false
                                });
                            </script>
                        </div>
                        <input type="hidden" name="start_time">
                        <input type="hidden" name="end_time">
                    </form>

                    <div class="form-group form-md-line-input show_detail" style="display: none; height:30px;">
                        <div style="width:200px;margin-left:100px">
                            <a href="#" id="show_detailed" target="_blank">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    <i class="fa fa-plus"></i>
                                    查看明细
                                </button>
                            </a>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn green"  id="handInput">确认提交</button>
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                </div>
            </div>
        </div>


    </div>
    <div id="form_modal3" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">小区项目统计数据</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="company_list_count" style="margin-top:25px;">
                        <tr>
                            <td align="center"></td>
                            <td align="center">合计</td>
                            <foreach name="sum['data']" item="v" key="k">
                                <td align="center">
                                    {pigcms{$v.name}
                                </td>
                            </foreach>
                        </tr>
                        <tr>
                            <td align="center">房间数</td>
                            <td align="center">{pigcms{$sum['sum']['room']}</td>
                            <foreach name="sum['data']" item="v" key="k">
                                <td align="center">
                                    {pigcms{$v.room}
                                </td>
                            </foreach>
                        </tr>
                        <tr>
                            <td align="center">空置数</td>
                            <td align="center"><span class="text-danger" >{pigcms{$sum['sum']['empty']}</span></td>
                            <foreach name="sum['data']" item="v" key="k">
                                <td align="center ">
                                    <span class="text-danger" >{pigcms{$v.empty}</span>
                                </td>
                            </foreach>
                        </tr>
                        <tr>
                            <td align="center">预交数</td>
                            <td align="center"><span class="text-success" >{pigcms{$sum['sum']['prepay']}</span></td>
                            <foreach name="sum['data']" item="v" key="k">
                                <td align="center ">
                                    <span class="text-success" >{pigcms{$v.prepay}</span>
                                </td>
                            </foreach>
                        </tr>
                        <tr>
                            <td align="center">欠费数</td>
                            <td align="center"><span class="text-danger" >{pigcms{$sum['sum']['noprepay']}</span></td>
                            <foreach name="sum['data']" item="v" key="k">
                                <td align="center ">
                                    <span class="text-danger" >{pigcms{$v.noprepay}</span>
                                </td>
                            </foreach>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                </div>
            </div>
        </div>
    </div>
</block>
<block name="body">
    <!-- BEGIN CONTENT -->
    <!--<form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <div class="portlet-body">

            <div class="form-body">
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">选择期数
                    </label>
                    <div class="col-md-4">
                        <select id="project_id" class="form-control" >
                            <volist name="project_list" id="vo">
                                <option value="{pigcms{$vo['pigcms_id']}" <if condition="$project_id eq $vo['pigcms_id']">selected="selected"</if>>
                                {pigcms{$vo['desc']}
                                </option>
                            </volist>
                        </select>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">门牌号
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="room_name" value="" name="room_name" class="form-control" autocomplete="off" disableautocomplete>
                    </div>
                </div>
                <div id="room_info" class="form-group form-md-line-input" style="display: block">
                    <label class="col-md-2 control-label" for="form_control_1" >房屋信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <span id="room_info_id"></span>
                    </div>
                </div>
                <div id="user_info" class="form-group form-md-line-input" style="display: block">
                    <label class="col-md-2 control-label" for="form_control_1">业主信息
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <span id="user_info_id"></span>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费类型
                    </label>
                    <div class="col-md-4">
                        <select name="otherfee_type_id" id="otherfee_type_id" class="form-control">
                            <option value="0">请选择</option>
                            <option value="property">物业服务费</option>
                            <option value="carspace">包月泊位费</option>
                            <volist name="type_list" id="vo">
                                <option value="{pigcms{$vo.otherfee_type_id}">{pigcms{$vo.otherfee_type_name}</option>
                            </volist>
                        </select>
                    </div>
                </div>
                <div id="property" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">物业费到期时间
                        </label>
                        <div class="col-md-4">
                            <span id="property_time"></span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <select name="property_mouth" class="form-control" id="property_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <for start="1" end="24"  name="i" >
                                    <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                </for>
                            </select>
                            <span class="required">如果没有设置过物业费到期时间，请先调整到期时间</span>
                        </div>
                    </div>
                    <div id="property_pay" style="display: block;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-4" >
                                <label id="property_unit"></label>元每平方米每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="property_recive" value="" name="property_recive" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="property_true" value="" name="property_true" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carspace" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">选择车位
                        </label>
                        <div class="col-md-4">
                            <select name="carspace_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1">付款预付月数
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <select name="carspace_mouth" class="form-control" id="carspace_mouth">
                                <option value="0" selected="selected">请选择</option>
                                <for start="1" end="24"  name="i" >
                                    <option value="{pigcms{$i}" >{pigcms{$i}个月</option>
                                </for>
                            </select>
                        </div>
                    </div>
                    <div id="carspace_pay" style="display: block;">
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">单价
                            </label>
                            <div class="col-md-4" >
                                <label id="carspace_price"></label>元每月
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">应付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <label id="carspace_recive"></label>元
                            </div>
                        </div>
                        <div class="form-group form-md-line-input"  >
                            <label class="col-md-2 control-label" for="form_control_1">实付款
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-4" >
                                <input type="text"   id="carspace_true" value="" name="carspace_true" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="other_fee" style="display: block;">
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1" id="fee_receive">应收
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <div class="md-checkbox-list">
                                <input type="text" name="fee_receive" value=""  class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input"  >
                        <label class="col-md-2 control-label" for="form_control_1" id="fee_true">实收
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-4">
                            <div class="md-checkbox-list">
                                <input type="text" name="fee_true" value=""  class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">缴费方式
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4">
                        <select name="type" class="form-control">
                            <option value="1">线上支付</option>
                            <option value="2">现金</option>
                            <option value="3">转账</option>
                            <option value="4">POS单</option>
                            <option value="5">现金缴款单</option>
                        </select>

                    </div>
                </div>

                <div class="form-group form-md-line-input"  >
                    <label class="col-md-2 control-label" for="form_control_1">备注
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-4" >
                        <textarea    value="" name="remark" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="button" id="handInput" class="btn green">确认提交</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-danger" style="display: none">
            <strong>错误！</strong><span></span></div>

        <div class="alert alert-success" style="display: none">
            <strong>成功！</strong><span></span></div>
    </form>-->




    <table class="table table-striped table-bordered table-hover" id="sample_2" >
        <thead>
        <tr>
            <th width="2%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th width="2%">所属期数</th>
            <th width="5%">栋数</th>
            <th width="5%">单元</th>
            <th width="5%">楼层</th>
            <th width="10%">门牌号</th>
            <th width="10%">房屋面积</th>
            <th width="10%">物业费到期时间</th>
            <th width="10%">车位详情</th>
            <!--<th width="15%">业主详情</th>
            <th width="10%">房屋状态(空置结束时间)</th>
            <th class="button-column" width="15%">操作</th>-->
        </tr>
        </thead>
        <tbody>
        <volist name="roomsArray" id="vo">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="{pigcms{$vo.id}" />
                    <span></span>
                </label>
            </td>
            <td><div class="shopNameDiv">{pigcms{$vo.desc}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.tung_build}栋</div></td>
            <td><div class="tagDiv">{pigcms{$vo.tung_unit}单元</div></td>
            <td><div class="tagDiv">{pigcms{$vo.tung_floor}层</div></td>
            <td><div class="tagDiv">{pigcms{$vo.room_name}</div></td>
            <td><div class="tagDiv">{pigcms{$vo.roomsize}</div></td>
            <td>
                <a href="{pigcms{:U('room_property_uptown',array('id'=>$vo['id']))}" target="_blank">
                    <div class="tagDiv">
                        <if condition="$vo['property_endtime'] and strtotime($vo['property_endtime']) egt time()">
                            {pigcms{$vo.property_endtime}
                            <elseif condition="$vo['property_endtime'] and strtotime($vo['property_endtime']) lt time()"/>
                            <span class="text-danger">{pigcms{$vo.property_endtime}&nbsp;&nbsp;(已欠费)</span>
                        </if>
                        <if condition="$vo.property_endtime eq ''">
                            <span class="text-danger">尚未设置初始时间</span>
                        </if>
                    </div>
                </a>
            </td>
            <td>
                <a href="{pigcms{:U('room_carspace_uptown',array('id'=>$vo['id']))}" target="_blank">
                    <div class="tagDiv">
                        <if condition="$vo.carspace_number neq ''">
                            {pigcms{$vo.carspace_number}<br>
                            {pigcms{$vo.uc.carspace_endtime}
                        </if>
                        <if condition="$vo.carspace_number eq ''">
                            <span class="text-danger">尚未绑定车位</span>
                        </if>
                    </div>
                </a>
            </td>
            <!--<td><div class="tagDiv">
                    <if condition="$vo['oid_info']['0'] neq ''">
                        <volist name="vo['oid_info']" id="oid_info">
                            {pigcms{$oid_info.name}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$oid_info.phone}<br>
                        </volist>
                    </if>
                    <if condition="$vo['oid_info']['0'] eq ''">
                        <span class="text-danger">尚未绑定业主</span>
                    </if>
                </div></td>
            <td>
                <div class="tagDiv">
                    {pigcms{$vo.house_type}
                    <if condition="$vo['house_type'] neq '空置' and $vo['property_emptytime']">
                        ({pigcms{$vo['property_emptytime']|date="Y-m-d",###})
                    </if>
                </div>
            </td>
            <td class="button-column">
                <div class="btn-group">
                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-left" role="menu" style="position:relative;">

                        <li>
                            <a href="{pigcms{:U('room_update_uptown',array('id'=>$vo['id']))}" target="_blank">
                                <i class="icon-tag"></i> 编辑 </a>
                        </li>
                        <li>
                            <a href="{pigcms{:U('Otherfee/add_otherfee',array('rid'=>$vo['id']))}" target="_blank">
                                <i class="icon-tag"></i> 添加新的缴费 </a>
                        </li>
                        <li>
                            <a href="{pigcms{:U('Otherfee/otherfee_list',array('rid'=>$vo['id']))}" target="_blank">
                                <i class="icon-tag"></i> 查看全部缴费 </a>
                        </li>
                    </ul>
                </div>
            </td>-->
            </tr>
        </volist>
        </tbody>
    </table>
</block>
<block name="script">

    <!--自定义js代码区开始-->
    <script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
    <!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
     -->
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">

    <script>
        $(".search").change(
            function () {
                var search=$('#property_status').children('option:selected').val();
                //console.log(p1);
                $('input[aria-controls="sample_2"]').val(search).keyup();
            }
        );
        function sub_project(){
            var project_id='{pigcms{$project_info['pigcms_id']}';
            var project_name='{pigcms{$project_info['desc']}';
            if(confirm( '你确定批量打印'+project_name+'全部欠费业主催缴单吗？')) {
                var url = "{pigcms{:U('Property/print_property')}";
                //用post方式传递
                var ids = '';
                var ym = '';
                openPostWindow(url,ids,ym,project_id);
                // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
            }
        }
        function sub() {
            var ids = '';
            var ym = $("input[name='choose_time']").val();
            // alert(ym);
            $(".checkboxes").each(function() {
                if ($(this).is(':checked') && $(this).val() != '') {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            ids = ids.substring(1);
            if (ids.length == 0) {
                alert('请选择要添加的选项');
            } else {
                if(confirm( '你确定批量打印码？')) {
                    var url = "{pigcms{:U('Property/print_property')}";
                    //用post方式传递
                    var project_id='';
                    openPostWindow(url,ids,ym,project_id);
                    // window.location.href = "{pigcms{:U('PropertyService/hydropower_account_do')}" + "&ids=" + ids + "&ym=" + ym;
                }
            }
        }

        function openPostWindow(url,idStr,rid,project_id){

            var tempForm = document.createElement("form");
            tempForm.id = "tempForm1";
            tempForm.method = "post";
            tempForm.action = url;
            tempForm.target="_blank"; //打开新页面
            var hideInput1 = document.createElement("input");
            hideInput1.type = "hidden";
            hideInput1.name="ids"; //后台要接受这个参数来取值
            hideInput1.value = idStr; //后台实际取到的值
            var hideInput2 = document.createElement("input");
            hideInput2.type = "hidden";
            hideInput2.name="rid";
            hideInput2.value = rid;
            var hideInput3 = document.createElement("project_id");
            hideInput2.type = "hidden";
            hideInput2.name="project_id";
            hideInput2.value = project_id;
            tempForm.appendChild(hideInput1);
            tempForm.appendChild(hideInput2);
            tempForm.appendChild(hideInput3);
            if(document.all){
                tempForm.attachEvent("onsubmit",function(){});        //IE
            }else{
                var subObj = tempForm.addEventListener("submit",function(){},false);    //firefox
            }
            document.body.appendChild(tempForm);
            if(document.all){
                tempForm.fireEvent("onsubmit");
            }else{
                tempForm.dispatchEvent(new Event("submit"));
            }
            tempForm.submit();
            document.body.removeChild(tempForm);
        }
    </script>
    <script src="/static/js/jquery.bigautocomplete.js"></script>
    <link rel="stylesheet" href="/static/css/jquery.bigautocomplete.css">
    <script type='text/javascript'>
        $("input[name='fee_receive']").bind("keyup",function() {
            console.log($(this).val());
            $("input[name='fee_true']").val($(this).val());
        });
        //开启日历插件
        $("#handInput").click(function(){
            var tip='添加缴费成功！';
            $.ajax({
                url:'{pigcms{:U("Property/ajax_in_fee")}',
                type:'post',
                data:$('#form_sample_1').serialize(),
                dataType:'json',
                success:function (res) {
                    $('.property').css('display','none');
                    $('.carspace').css('display','none');
                    $('.other_fee').css('display','none');
                    $("textarea[name='remark']").val('');
                    $("#room_name").val('');
                    $('#otherfee_type_id').val("1");
                    $('#room_info').css('display','none');
                    $('#user_info').css('display','none');
                    if(res.err == 0){
                        $(".input-group input").val('');
                        $(".alert-danger").hide();
                        $(".alert-success span").html(tip);
                        $(".alert-success").slideDown();
                        $("#in_database tr:eq(1)").before(res.data);
                        if(res.msg){
                            $("textarea[name='remark']").html("");
                            swal({
                                    title: "添加缴费成功，是否立即打印收据？",
                                    text: "确认后会前往打印收据页面",
                                    type: "info",
                                    showCancelButton: true,
                                    cancelButtonText: "取消",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "确定",
                                    closeOnConfirm: true
                                },
                                function(){
                                    //console.log(res.msg);
                                    print_receipt(res.msg);
                                });
                        }
                        document.getElementById("form_sample_1").reset();
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
        function print_receipt(id) {
            var rid = id;
            var ym = $("input[name='choose_time']").val();
            var ids='';
            var project_id='';
            // alert(ym);
            if (rid.length == 0) {
                alert('请选择要添加的选项');
            } else {
                var url = "{pigcms{:U('Receipt/print_receipt')}";
                //用post方式传递
                var project_id='';
                openPostWindow(url,ids,rid,project_id);
            }
        }
        $('#otherfee_type_id').change(function(){
            $("input[name='code_start']").val('');
            $("input[name='code_end']").val('');
            $("input[name='unit']").val('');
            $("input[name='fee_receive']").val('');
            $("input[name='fee_true']").val('');
            $("textarea[name='remark']").html('');
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_otherfee_type')}",
                data:{'otherfee_type_id':p1,'room_name':room_name},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.input-mouth').css('display','none');
                    $('.show_detail').css('display','none');
                    if(res.type == 'property'){
                        $('.property').css('display','block');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','none');
                        $('#fee_true_div').css('display','block');
                        $('#property_time').html(res.data.property_endtime);
                    }else if(res.type=='carspace'){
                        $('.property').css('display','none');
                        $('.carspace').css('display','block');
                        $('.other_fee').css('display','none');
                        $('#fee_true_div').css('display','block');
                        $("select[name='carspace_id']").html('');
                        for ( var i = 0; i <res.data.length; i++){
                            $("select[name='carspace_id']").append('<option value="'+res.data[i].pigcms_id+'">'+res.data[i].carspace_number+'\\t到期日:'+res.data[i].carspace_endtime);
                        }
                    } else{
                        $('.property').css('display','none');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','block');
                        if(res.info.start_code != null && res.info.fee_receive != 0){
                            $("input[name='code_start']").val(res.info.start_code);
                            $("input[name='code_end']").val(res.info.end_code);
                            $("input[name='unit']").val(res.info.price);
                            $("input[name='fee_receive']").val(res.info.fee_receive);
                            $("input[name='fee_true']").val(res.info.fee_receive);
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit + res.info.fee_receive_code;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }else if(res.info.fee_receive != 0 && res.info.start_code == null){
                            $("input[name='fee_receive']").val(res.info.fee_receive);
                            $("input[name='fee_true']").val(res.info.fee_receive);
                            /*自动计算*/
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit + res.info.fee_receive_code;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }else{
                            /*自动计算*/
                            $(".control").focus(function(){
                                var code_start=$("input[name='code_start']").val();
                                var code_end=$("input[name='code_end']").val();
                                var unit=$("input[name='unit']").val();
                                if(code_start&&code_end&&unit){
                                    var sum=(code_end-code_start)*unit;
                                    $("input[name='fee_receive']").val(sum.toFixed(2));
                                    $("input[name='fee_true']").val(sum.toFixed(2));
                                }
                            });
                        }

                        if(res.data.otherfee_type_name == "水费" || res.data.otherfee_type_name == "电费"){
//                                $('.input-mouth').css('display','block');
                                $('.show_detail').css('display','block');
                                var id = res.rid;
                                $('#show_detailed').attr('href',"{pigcms{:U('Property/show_detailed',array('id'=>'"+id+"'))}");

                                if(res.start_time != null){
                                    $str = res.start_time+"至"+res.end_time;
                                    $("textarea[name='remark']").html($str);
                                    $("input[name='start_time']").val(res.start_time);
                                    $("input[name='end_time']").val(res.end_time);
                                    /*$("input[name='remark']").val(res.start_time);
                                    $("#time_to").val(res.end_time);*/
                                }
                                /*$("#sel option").each(function() {
                                    if($(this).val()==res.start_time){
                                        $(this).prop('selected',true);
                                    }else{
                                        $(this).prop('selected',false);
                                    }
                                });

                                $("#sels option").each(function() {
                                    if($(this).val()==res.end_time){
                                        $(this).prop('selected',true);
                                    }else{
                                        $(this).prop('selected',false);
                                    }
                                });*/

                        }
                        if(res.data.type=='1'){
                            $('#fee_receive').html('应收<span class="required">*</span>');
                            $('#fee_true').html('实收<span class="required">*</span>');
                            $('#fee_true_div').css('display','block');
                        }else{
                            $('#fee_receive').html('实收<span class="required">*</span>');
                            $('#fee_true').html('已退<span class="required">*</span>');
                            $('#fee_true_div').css('display','none');
                        }
                    }
                }
            });
        });
        $("#room_name").bigAutocomplete({
                url:'{pigcms{:U('Property/ajax_room_list')}',
            callback:function(data){
            $('.property').css('display','none');
            $('.carspace').css('display','none');
            $('.other_fee').css('display','none');
            $('#otherfee_type_id').val("0");
            $('#room_info').css('display','block');
            $('#user_info').css('display','block');
            $('#room_info_id').html('面积:'+data.result.roomsize+',所属园区:'+data.result.desc);
            $('#user_info_id').html('姓名:'+data.result.user_info.name+',电话:'+data.result.user_info.phone+',身份证号:'+data.result.user_info.usernum);
            $.ajax({
                type:"GET",
                url:"{pigcms{:U('Property/ajax_change')}",
                data:{'rid':data.result.id},
                async:false
            });
        }
        });
        $("#room_name").keyup(function(){
            $.ajax({
                url:"{pigcms{:U('Property/ajax_room_list')}",
                data:{'keyword':$(this).val(),'type':1},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    if(res.data[0].title){
                        $('.property').css('display','none');
                        $('.carspace').css('display','none');
                        $('.other_fee').css('display','none');
                        $('#otherfee_type_id').val("0");
                        $('#room_info').css('display','block');
                        $('#user_info').css('display','block');
                        $('#room_info_id').html('面积:'+res.data[0].result.roomsize+',所属园区:'+res.data[0].result.desc);
                        $('#user_info_id').html('姓名:'+res.data[0].result.user_info.name+',电话:'+res.data[0].result.user_info.phone+',身份证号:'+res.data[0].result.user_info.usernum);
                        $.ajax({
                            type:"GET",
                            url:"{pigcms{:U('Property/ajax_change')}",
                            data:{'rid':data.result.id},
                            async:false
                        });
                    }
                }
            });
        });
        $('#property_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("input[name='room_name']").val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_fee_get')}",
                data:{'month':p1,'room_name':room_name,'type':'property'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.property_pay').css('display','block');
                    $('#property_unit').html(res.unit);
                    $('#property_recive').val(res.pay_recive);
                    $('#property_true').val(res.pay_true);
                }
            });
        });
        $('#carspace_mouth').change(function(){
            var p1=$(this).children('option:selected').val();
            var room_name=$("select[name='carspace_id']").children('option:selected').val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_fee_get')}",
                data:{'month':p1,'room_name':room_name,'type':'carspace'},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $('.carspace_pay').css('display','block');
                    $('#carspace_price').html(res.unit);
                    $('#carspace_recive').html(res.pay_recive);
                    $('#carspace_true').val(res.pay_true);
                }
            });
        })

        var table = $('#sample_2');
        table.dataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                'processing':'正在努力处理中',
                "emptyTable": "暂时没有数据",
                "info": "当前显示 _START_ 到 _END_ ​条记录 共 _TOTAL_ ​条记录",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "​每页显示条数 _MENU_",
                "search": "搜索:",
                "zeroRecords": "抱歉，没有查找到指定结果",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            serverSide: true,
            'processing':true,// 加载
            ajax: {
                url: '{pigcms{:U("ajax_room_list_uptown")}&room_over_endtime='+sessionStorage.getItem('room_over_endtime')+'&room_house_type='+sessionStorage.getItem('room_house_type')+'&room_type='+sessionStorage.getItem('room_type'),
                type: 'POST'
            },
            ordering:  false,
            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "​全部"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': [0]
                },
                //去除限制第一列查询
                /*{
                 "searchable": false,
                 "targets": [0]
                 },*/
                {
                    "className": "dt-right",
                    //"targets": [2]
                }
            ],
            //"aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
                {
                    "mDataProp" : "check_id",
                    "sTitle" : "<input type='checkbox'  name='allbox' id='allbox' onclick='check();' />",
                    "sDefaultContent" : "",
                    "bSortable" : false,
                    "sClass" : "center"
                },
                {
                    "sTitle" : "房间号",
                    "mDataProp": "room_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "业主姓名",
                    "mDataProp": "owner_name",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "联系电话",
                    "mDataProp": "owner_phone",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "房屋面积",
                    "mDataProp": "roomsize",
                    "sDefaultContent" : "<span class='active_value'>未绑定</span>",
                    "sClass" : "center nickname"
                },
                {
                    "sTitle" : "物业费到期时间",
                    "mDataProp": "property",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center active_value"
                },
                {
                    "sTitle" : "房屋状态(空置结束时间)",
                    "mDataProp": "house_type",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "车位详情",
                    "mDataProp": "carspace",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                },
                {
                    "sTitle" : "操作",
                    "mDataProp": "action",
                    "sDefaultContent" : "不存在",
                    "sClass" : "center"
                }
                /*{
                 "sTitle" : "Update Time",
                 "mDataProp": "updateTime",
                 "sDefaultContent" : "",
                 "sClass" : "center",
                 "mRender" : function(data, display, row) {  //将从数据库中查到的时间戳格式化
                 return new Date(data).Format("yyyy-MM-dd hh:mm:ss");
                 }

                 },*/
            ]
        });
        $("#sample_1_filter input[type=search]").removeClass("input-small");
        $("#sample_1_filter input[type=search]").css({ width: '400px' });
        $("#sample_1_filter input[type=search]").attr("placeholder","请输入房间号、业主姓名、手机查询");
        function search_change(key,value){
            sessionStorage.setItem(key,value);
            var url='{pigcms{:U("ajax_room_list_uptown")}&room_over_endtime='+sessionStorage.getItem('room_over_endtime')+'&room_house_type='+sessionStorage.getItem('room_house_type')+'&room_type='+sessionStorage.getItem('room_type');
            table.api().ajax.url(url).load();
        }
        if(sessionStorage.getItem('room_over_endtime'))$('#room_over_endtime').val(sessionStorage.getItem('room_over_endtime'));
        if(sessionStorage.getItem('room_house_type'))$('#room_house_type').val(sessionStorage.getItem('room_house_type'));
        if(sessionStorage.getItem('room_type'))$('#room_type').val(sessionStorage.getItem('room_type'));

        //选择月份
        $(".show_mouth").change(function(){
            var v1 = $(".show_mouth1").val();
            var v2 = $(".show_mouth2").val();
            var room_name=$("input[name='room_name']").val();
            var p1=$("#otherfee_type_id").children('option:selected').val();
            $.ajax({
                url:"{pigcms{:U('Property/ajax_mouth_get')}",
                data:{'start_mouth':v1,'end_mouth':v2,'room_name':room_name,'otherfee_type_id':p1},
                type: "POST",
                dataType: 'json',
                success:function(res){
                    $("input[name='code_start']").val(res.info.start_code);
                    $("input[name='code_end']").val(res.info.end_code);
                    $("input[name='unit']").val(res.info.price);
                    $("input[name='fee_receive']").val(res.info.fee_receive);
                    $("input[name='fee_true']").val(res.info.fee_receive);
                }
            });
        });
    </script>

</block>