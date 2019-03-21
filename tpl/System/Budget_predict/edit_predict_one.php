<layout name="layout"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

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
    .record_check_time{
        width: 50px;
        border: none;
        text-align: center;
        height: 30px;
    }
    .disabled{
        cursor:no-drop;
    }
    td{
        border: none;text-align: center;height: 30px;
    }
    th{
        border: none;text-align: center;height: 30px;
    }
    td .selectpicker{

    }
    .hide {
        display: none;
    }
    -->
</style><div class="row">
    <div class="col-md-12">
        <a href="{pigcms{:U('Budget_predict/output_excel_one',array('id'=>$predict_info['predict_id']))}" >
        <button type="button" class="btn green">导出此表格</button>
        </a>
        <br/>
        <br/>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
        </div>
            <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">

            <div class="portlet-body" style="width:100%;overflow: scroll;">
                <div class="row">
                    <div class="tabbable-custom nav-justified" style="overflow: visible;">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#tab_4" data-toggle="tab" class="active"> 收入明细表</a>
                            </li>
                            <foreach name="data_type" item="vo" key="k">
                                <if condition="$k eq 4">
                                    <!--<li>
                                    <a href="#tab_property" data-toggle="tab"> 物业服务费收入明细表</a>
                                    </li>
                                    <li>
                                        <a href="#tab_{pigcms{$k}" data-toggle="tab"> 泊车、其他服务收入明细表</a>
                                    </li>-->
                                    <else/>
                                    <li>
                                    <a href="#tab_{pigcms{$k}" data-toggle="tab"> {pigcms{$vo['info']['type_name']}明细表</a>
                                    </li>
                                </if>
                            </foreach>
                            <!--<li>
                            <a href="#tab_overtime" data-toggle="tab"> 加班费明细表</a>
                            </li>
                            <li>
                            <a href="#tab_clothesfee" data-toggle="tab"> 服装费明细表</a>
                            </li>
                            <li>
                            <a href="#tab_dispatch" data-toggle="tab"> 派遣和劳务支出</a>
                            </li>-->
                        </ul>

                        <div class="tab-content">
                            <foreach name="data_type" item="vo" key="k">
                                <if condition="$k eq 1">
                                    <div class='tab-pane' id="tab_{pigcms{$k}">
                                        <div class="btn-group" style="margin-top:10px;">
            <!--<span >
                <span>
					<span style="line-height:30px;">添加</span>
                    <div class="btn-group">
                        <select id="add_personnel"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                                <option value="">选择需要添加部门人员</option>
                                <foreach name="department_child_list" item="vo1" key="k1">
                                    <if condition="$vo1['type'] eq 1">
                                        <option value="{pigcms{$k1}">{pigcms{$vo1['name']}</option>
                                    </if>
                                </foreach>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="button" value="添加" onclick="addrow()"/>
            </span>-->
                                        </div>
                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                <thead>
                                                <tr>
                                                    <th rowspan="2">部门</th>
                                                    <th rowspan="2">岗位</th>
                                                    <th rowspan="2">人数</th>
                                                    <if condition="$village_info['village_id'] eq 68 or $village_info['village_id'] eq 87">
                                                        <th rowspan="2">工作月数<br/>(不填则为默认12个月)</th>
                                                    </if>
                                                    <th rowspan="2">月工资</th>
                                                    <th rowspan="2">社保</th>
                                                    <th rowspan="2">社补</th>
                                                    <th rowspan="2">公积金</th>
                                                    <th colspan="4">月福利费</th>
                                                    <th rowspan="2">年终奖金额<br/><span style="font-size: 8px;color: red" >(仅限其它，剩余部门自动计算)</span></th>
                                                    <th rowspan="2">操作</th>
                                                </tr>
                                                <tr>
                                                    <th>餐费补贴</th>
<!--                                                    <th>通信费</th>
-->                                                    <th>降温费</th>
                                                    <th>慰问费</th>
                                                    <th>其它</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <foreach name="department_child_list" item="vo1" key="k1">
                                                        <if condition="empty($vo['data'][$k1]) and $vo1['type'] eq 1">
                                                            <tr>
                                                                <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($vo['data'][$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                <td>
                                                                    <if condition="$vo1['children']">
                                                                        <select class="selectpicker" name="data[{pigcms{$k}][{pigcms{$k1}][1][job]">
                                                                            <option value=""></option>
                                                                            <foreach name="vo1['children']" item="vo3" key="k3">
                                                                                <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                            </foreach>
                                                                        </select>
                                                                        <else/>
                                                                        <input name="data[{pigcms{$k}][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/>
                                                                    </if>

                                                                </td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][num]" type="text" class="record_check_time personnel_num"/></td>
                                                                <if condition="$village_info['village_id'] eq 68 or $village_info['village_id'] eq 87">
                                                                    <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month]" type="text" class="record_check_time"/></td>
                                                                </if>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_0]" type="text" class="record_check_time"/></td>
                                                                <td>
                                                                    <select name="data[{pigcms{$k}][{pigcms{$k1}][1][month_1]" class="selectpicker personnel_select">
                                                                        <option value="1">缴纳</option>
                                                                        <option value="0">不缴纳</option>
                                                                    </select>
                                                                </td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_8]" type="text" class="record_check_time disabled" readonly="readonly"/></td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_2]" type="text" class="record_check_time"/></td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_3]" type="text" class="record_check_time"/></td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_5]" value="{pigcms{$salary_config['month_5']}" readonly type="text" class="record_check_time disabled"/></td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_6]" value="{pigcms{$salary_config['month_6']}" readonly type="text" class="record_check_time disabled"/></td>
                                                                <td><input name="data[{pigcms{$k}][{pigcms{$k1}][1][month_7]"  type="text" class="record_check_time"/></td>
                                                                <td>
                                                                    <eq name="k1" value="12">
                                                                        <input name="data[{pigcms{$k}][{pigcms{$k1}][1][year_end]" type="text" class="record_check_time"/>
                                                                    </eq>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-xs blue" onclick="addrow({pigcms{$k1})">
                                                                        添加一行
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <elseif condition=" $vo1['type'] eq 1"/>
                                                            <?php $cache_key=key($vo['data'][$k1]);?>
                                                            <foreach name="vo['data'][$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($vo['data'][$k1])}">{pigcms{$vo1['name']}</td>
                                                                    </if>
                                                                    <td>
                                                                        <!--<input value="{pigcms{$vo2['job']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/>-->
                                                                        <if condition="$vo1['children']">
                                                                        <select class="selectpicker" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][job]">
                                                                            <option value=""></option>
                                                                            <volist name="vo1['children']" id="vo3" key="k3">
                                                                                <if condition="$vo3 eq $vo2['job']">
                                                                                    <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                                    <else/>
                                                                                    <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                                </if>
                                                                            </volist>
                                                                        </select>
                                                                            <else/>
                                                                            <input value="{pigcms{$vo2['job']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/>
                                                                        </if>
                                                                    </td>
                                                                    <td><input value="{pigcms{$vo2['num']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time personnel_num"/></td>
                                                                    <if condition="$village_info['village_id'] eq 68 or $village_info['village_id'] eq 87">
                                                                    <td><input value="{pigcms{$vo2['month']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month]" type="text" class="record_check_time"/></td>
                                                                    </if>
                                                                    <td><input value="{pigcms{$vo2['month_0']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_0]" type="text" class="record_check_time"/></td>
                                                                    <td>
                                                                        <select name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_1]" class="selectpicker personnel_select">
                                                                            <option value="1">缴纳</option>
                                                                            <option value="0" <if condition="empty($vo2['month_1'])"> selected</if>>不缴纳</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input value="{pigcms{$vo2['month_8']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_8]" type="text" class="record_check_time" <if condition="$vo2['month_1']">readonly="readonly"</if>/></td>
                                                                    <td><input value="{pigcms{$vo2['month_2']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_2]" type="text" class="record_check_time"/></td>
                                                                    <td><input value="{pigcms{$vo2['month_3']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_3]" type="text" class="record_check_time"/></td>
                                                                    <td><input value="{pigcms{$vo2['month_5']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_5]" readonly type="text" class="record_check_time disabled"/></td>
                                                                    <td><input value="{pigcms{$vo2['month_6']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_6]" readonly type="text" class="record_check_time disabled"/></td>
                                                                    <td><input value="{pigcms{$vo2['month_7']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][month_7]" type="text" class="record_check_time"/></td>
                                                                    <td>
                                                                        <eq name="k1" value="12">
                                                                            <input value="{pigcms{$vo2['year_end']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][year_end]" type="text" class="record_check_time"/>
                                                                        </eq>
                                                                    </td>
                                                                    <td>
                                                                        <if condition="$k2 neq $cache_key">
                                                                            <button type="button" class="btn btn-xs red" onclick="deleteRow(this,{pigcms{$k1})">
                                                                                删除此行
                                                                            </button>
                                                                            <else/>
                                                                            <button type="button" class="btn btn-xs blue" onclick="addrow({pigcms{$k1})">
                                                                                添加一行
                                                                            </button>
                                                                        </if>
                                                                    </td>
                                                                </tr>
                                                            </foreach>
                                                        </if>

                                                    </foreach>
                                                    <tr>
                                                        <td colspan="2">工龄工资</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#tab_gongling" data-toggle="modal">
                                                                <button type="button" class="btn btn-xs blue">
                                                                    点击填写工龄工资
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">加班费</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#tab_overtime" data-toggle="modal">
                                                                <button type="button" class="btn btn-xs blue">
                                                                    点击填写加班费
                                                                </button>
                                                            </a>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <else/>
                                    <div class='tab-pane fad <if condition="$k eq 4">active</if>' id="tab_{pigcms{$k}">
                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">项目</th>
                                                    <th>{pigcms{$year}年预算金额</th>
                                                    <th>{pigcms{:$year-1}年实际金额</th>
                                                    <th>{pigcms{:$year-2}年实际金额</th>
                                                    <th>备注</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <if condition="vo['children']">
                                                    <foreach name="vo['children']" item="vo1" key="k1">

                                                                <if condition="$vo1['type_name'] neq '工服费' and $vo1['type_name'] neq '派遣和劳务支出' and $vo1['type_name'] neq '商业保险费'">
                                                                    <volist name="vo1['children']" id="vo2" key="k2">
                                                                        <if condition="$vo2['type_name'] neq '市内交通费'">
                                                                            <tr>
                                                                                <if condition="$k2 eq 1">
                                                                                    <td rowspan="{pigcms{:count($vo1['children'])}" style="text-align:center;vertical-align:middle;">{pigcms{$vo1['type_name']}</td>
                                                                                </if>
                                                                                <td title="{pigcms{$vo2['type_remark']}">{pigcms{$vo2['type_name']}</td>
                                                                                <td>
                                                                                    <input value="{pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']}" style="width: 50%" name="data[{pigcms{$k}][{pigcms{$k1}][children][{pigcms{$vo2['type_id']}][type_data][sum]" type="text" class="record_check_time"/>
                                                                                    <if condition="$vo2['type_name'] eq '物业费服务收入'">
                                                                                        <br/>
                                                                                        <a href="#tab_property" data-toggle="modal">
                                                                                            <button type="button" class="btn btn-xs blue">
                                                                                                点击填写物业费详细
                                                                                            </button>
                                                                                        </a>
                                                                                        <elseif condition="$vo2['type_name'] eq '资产购置费'"/>
                                                                                        <br/>
                                                                                        <a href="#tab_zichan" data-toggle="modal">
                                                                                            <button type="button" class="btn btn-xs blue">
                                                                                                点击填写资产购置费详细
                                                                                            </button>
                                                                                        </a>
                                                                                        <elseif condition="$vo2['type_name'] eq '其他运行费用'"/>
                                                                                        <br/>
                                                                                        <a href="#tab_yunxing" data-toggle="modal">
                                                                                            <button type="button" class="btn btn-xs blue">
                                                                                                点击填写其他运行费用详细
                                                                                            </button>
                                                                                        </a>
                                                                                        <else/>
                                                                                    </if>

                                                                                </td>
                                                                                <td>{pigcms{:$vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                                <td>{pigcms{:$vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                                <td><input value="{pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['remark']}" style="width: 50%" name="data[{pigcms{$k}][{pigcms{$k1}][children][{pigcms{$vo2['type_id']}][type_data][remark]" type="text" class="record_check_time"/></td>
                                                                            </tr>
                                                                        </if>
                                                                    </volist>
                                                                    <else/>
                                                                    <volist name="vo1['children']" id="vo2" key="k2">
                                                                    <tr>
                                                                        <if condition="$k2 eq 1">
                                                                            <td rowspan="{pigcms{:count($vo1['children'])}" style="text-align:center;vertical-align:middle;">{pigcms{$vo1['type_name']}</td>
                                                                        </if>
                                                                        <td>{pigcms{$vo2['type_name']}</td>
                                                                        <td>
                                                                            <if condition="$vo1['type_name'] eq '工服费'">
                                                                                {pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']}
                                                                                <a href="#tab_clothesfee" data-toggle="modal">
                                                                                    <button type="button" class="btn btn-xs blue">
                                                                                        点击填写工服费
                                                                                    </button>
                                                                                </a>
                                                                                <elseif condition="$vo1['type_name'] eq '派遣和劳务支出'"/>
                                                                                {pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']}
                                                                                <a href="#tab_dispatch" data-toggle="modal">
                                                                                    <button type="button" class="btn btn-xs blue">
                                                                                        点击填写派遣和劳务支出
                                                                                    </button>
                                                                                </a>
                                                                                <elseif condition="$vo1['type_name'] eq '商业保险费'"/>
                                                                                自动计算，无需填写

                                                                            </if>
                                                                        </td>
                                                                        <td>{pigcms{:$vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                        <td>{pigcms{:$vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                        <td>{pigcms{$vo2['type_remark']}</td>
                                                                    </tr>
                                                                    </volist>
                                                                </if>
                                                    </foreach>
                                                    <else/>
                                                </if>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </if>
                            </foreach>
                            <!--加班费明细表-->
                            <div  id="tab_overtime" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">加班工资明细</h4>
                                        </div>
                                <div class="btn-group" style="margin-top:10px;">
                                    <input type="hidden" name="overtime_type"  value="{pigcms{:$predict_info['overtime_type']?$predict_info['overtime_type']:1}" />
                                </div>
                                        <div class="modal-body">
                                            <eq name="predict_info['overtime_type']" value="1">
                                <div class="portlet-body form form-horizontal" id="overtime_type_1">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th>部门</th>
                                            <th>岗位</th>
                                            <!--<th>人数</th>-->
                                            <if condition="$village_info['group_id'] eq 1">
                                                <th>月工资</th>
                                                <else/>
                                                <th>基本工资</th>
                                            </if>
                                            <th>天数</th>
                                            <th>每天班次数</th>
                                            <if condition="$village_info['group_id'] neq 1">
                                                <th>每班次的小时数</th>
                                            </if>
                                            <th>每班次的人数</th>
                                            <th>备注</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <foreach name="department_child_list" item="vo1" key="k1">
                                            <if condition="empty($overtime[$k1]) and $vo1['type'] eq 1">
                                                <tr>
                                                    <td id="personnel_overtime_1_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($overtime[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                    <!--<td><input value="" name="data[overtime][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/></td>-->
                                                    <td>
                                                        <if condition="$vo1['children']">
                                                            <select class="selectpicker" name="data[overtime][{pigcms{$k1}][1][job]">
                                                                <option value=""></option>
                                                                <volist name="vo1['children']" id="vo3" key="k3">
                                                                    <if condition="$vo3 eq $vo2['job']">
                                                                        <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                        <else/>
                                                                        <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                    </if>
                                                                </volist>
                                                            </select>
                                                            <else/>
                                                            <input value="" name="data[overtime][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/>
                                                        </if>

                                                    </td>
                                                    <!--<td><input value="" name="data[overtime][{pigcms{$k1}][1][num]" type="text" class="record_check_time"/></td>-->
                                                    <td><input value="" name="data[overtime][{pigcms{$k1}][1][regime]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[overtime][{pigcms{$k1}][1][day]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[overtime][{pigcms{$k1}][1][classes]" type="text" class="record_check_time"/></td>
                                                    <if condition="$village_info['group_id'] neq 1">
                                                        <td><input value="" name="data[overtime][{pigcms{$k1}][1][hour]"  type="text" class="record_check_time"/></td>
                                                    </if>
                                                    <td><input value="" name="data[overtime][{pigcms{$k1}][1][classes_num]"  type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[overtime][{pigcms{$k1}][1][remark]" type="text" class="record_check_time"/></td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_overtime({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </td>
                                                </tr>
                                                <elseif condition="$vo1['type'] eq 1"/>
                                                <?php $cache_key=key($overtime[$k1])?>
                                                <foreach name="overtime[$k1]" item="vo2" key="k2">
                                                    <tr>
                                                        <if condition="$k2 eq $cache_key">
                                                            <td id="personnel_overtime_1_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($overtime[$k1])}">{pigcms{$vo1['name']}</td>
                                                        </if>
                                                        <!--<td><input value="{pigcms{$vo2['job']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/></td>-->
                                                        <td>
                                                            <if condition="$vo1['children']">
                                                            <select class="selectpicker" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][job]">
                                                                <option value=""></option>
                                                                <volist name="vo1['children']" id="vo3" key="k3">
                                                                    <if condition="$vo3 eq $vo2['job']">
                                                                        <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                        <else/>
                                                                        <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                    </if>
                                                                </volist>
                                                            </select>
                                                                <else/>
                                                                <input value="{pigcms{$vo2['job']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/>
                                                            </if>
                                                        </td>
                                                        <!--<td><input value="{pigcms{$vo2['num']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time"/></td>-->
                                                        <td><input value="{pigcms{$vo2['regime']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][regime]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['day']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][day]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['classes']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][classes]" type="text" class="record_check_time"/></td>
                                                        <if condition="$village_info['group_id'] neq 1">
                                                            <td><input value="{pigcms{$vo2['hour']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][hour]" type="text" class="record_check_time"/></td>
                                                        </if>
                                                        <td><input value="{pigcms{$vo2['classes_num']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][classes_num]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['remark']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][remark]" type="text" class="record_check_time"/></td>
                                                        <td>
                                                            <if condition="$k2 neq $cache_key">
                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,{pigcms{$k1})">
                                                                    删除此行
                                                                </button>
                                                                <else/>
                                                                <button type="button" class="btn btn-xs blue" onclick="addrow_overtime({pigcms{$k1})">
                                                                    添加一行
                                                                </button>
                                                            </if>
                                                        </td>
                                                    </tr>
                                                </foreach>
                                            </if>
                                        </foreach>
                                        </tbody>
                                    </table>
                                        </div>
                                            </eq>
                                            <eq name="predict_info['overtime_type']" value="2">
                            <div class="portlet-body form form-horizontal" id="overtime_type_1">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                <thead>
                                <tr>
                                    <th>部门</th>
                                    <th>岗位</th>
                                    <!--<th>人数</th>-->
                                    <th>日加班工资</th>
                                    <th>加班时间(日)</th>
                                    <th>每天班次数</th>
                                    <th>每班次人数</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <foreach name="department_child_list" item="vo1" key="k1">
                                    <if condition="empty($overtime[$k1]) and $vo1['type'] eq 1">
                                        <tr>
                                            <td id="personnel_overtime_1_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($overtime[$k1])+1}">{pigcms{$vo1['name']}</td>
                                            <!--<td><input value="" name="data[overtime][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/></td>-->
                                            <td>
                                                <select class="selectpicker" name="data[overtime][{pigcms{$k1}][1][job]">
                                                    <option value=""></option>
                                                    <volist name="vo1['children']" id="vo3" key="k3">
                                                        <if condition="$vo3 eq $vo2['job']">
                                                            <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                            <else/>
                                                            <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                        </if>
                                                    </volist>
                                                </select>
                                            </td>
<!--                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][num]" type="text" class="record_check_time" /></td>
-->                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][regime]" type="text" class="record_check_time" /></td>
                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][day]" placeholder="需为整数，且小于等于11天" type="number" max="11" class="record_check_time" /></td>
                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][classes]" type="text" class="record_check_time"/></td>
                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][classes_num]"  type="text" class="record_check_time"/></td>
                                            <td><input value="" name="data[overtime][{pigcms{$k1}][1][remark]" type="text" class="record_check_time" /></td>
                                            <td>
                                                <button type="button" class="btn btn-xs blue" onclick="addrow_overtime({pigcms{$k1})">
                                                    添加一行
                                                </button>
                                            </td>
                                        </tr>
                                        <elseif condition="$vo1['type'] eq 1"/>
                                        <?php reset($overtime[$k1]);$cache_key=key($overtime[$k1]);?>
                                        <foreach name="overtime[$k1]" item="vo2" key="k2">
                                            <tr>
                                                <if condition="$k2 eq $cache_key">
                                                    <td id="personnel_overtime_1_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($overtime[$k1])}">{pigcms{$vo1['name']}</td>
                                                </if>
                                                <!--<td><input value="{pigcms{$vo2['job']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/></td>-->
                                                <td>
                                                    <select class="selectpicker" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][job]" >
                                                        <option value=""></option>
                                                        <volist name="vo1['children']" id="vo3" key="k3">
                                                            <if condition="$vo3 eq $vo2['job']">
                                                                <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                <else/>
                                                                <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                            </if>
                                                        </volist>
                                                    </select>
                                                </td>
                                                <!--<td><input value="{pigcms{$vo2['num']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time" disabled/></td>-->
                                                <td><input value="{pigcms{$vo2['regime']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][regime]" type="text" class="record_check_time" /></td>
                                                <td><input value="{pigcms{$vo2['day']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][day]" type="number" max="11" class="record_check_time" placeholder="需为整数，且小于等于11天" /></td>
                                                <td><input value="{pigcms{$vo2['classes']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][classes]" type="text" class="record_check_time"/></td>
                                                <td><input value="{pigcms{$vo2['classes_num']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][classes_num]" type="text" class="record_check_time"/></td>
                                                <td><input value="{pigcms{$vo2['remark']}" name="data[overtime][{pigcms{$k1}][{pigcms{$k2}][remark]" type="text" class="record_check_time" /></td>
                                                <td>
                                                    <if condition="$k2 neq $cache_key">
                                                        <button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,{pigcms{$k1})">
                                                            删除此行
                                                        </button>
                                                        <else/>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_overtime({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </if>
                                                </td>
                                            </tr>
                                        </foreach>
                                    </if>
                                </foreach>
                                </tbody>
                            </table>
                        </div>
                                            </eq>
                            </div>
                                <div class="modal-footer">
                                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                </div>
                    </div>
                        </div>
                    </div>
                            <!--工龄工资明细表-->
                            <div  id="tab_gongling" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">工龄工资明细</h4>
                                        </div>
                                        <div class="modal-body">
                                                <div class="portlet-body form form-horizontal" id="overtime_type_1">
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                        <thead>
                                                        <tr>
                                                            <th>部门</th>
                                                            <th>岗位</th>
                                                            <th>人数</th>
                                                            <th>金额</th>
                                                            <th>备注</th>
                                                            <th>操作</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <foreach name="department_child_list" item="vo1" key="k1">
                                                            <if condition="empty($gongling[$k1]) and $vo1['type'] eq 1">
                                                                <tr>
                                                                    <td id="personnel_gongling_1_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($gongling[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                    <td>
                                                                        <if condition="$vo1['children']">
                                                                            <select class="selectpicker" name="data[gongling][{pigcms{$k1}][1][job]">
                                                                                <option value=""></option>
                                                                                <volist name="vo1['children']" id="vo3" key="k3">
                                                                                    <if condition="$vo3 eq $vo2['job']">
                                                                                        <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                                        <else/>
                                                                                        <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                                    </if>
                                                                                </volist>
                                                                            </select>
                                                                            <else/>
                                                                            <input value="" name="data[gongling][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/>
                                                                        </if>
                                                                    </td>
                                                                    <td><input value="" name="data[gongling][{pigcms{$k1}][1][num]" type="text" class="record_check_time"/></td>
                                                                    <td><input value="" name="data[gongling][{pigcms{$k1}][1][money]" type="text" class="record_check_time"/></td>
                                                                    <td><input value="" name="data[gongling][{pigcms{$k1}][1][remark]" type="text" class="record_check_time"/></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_gongling({pigcms{$k1})">
                                                                            添加一行
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <elseif condition="$vo1['type'] eq 1"/>
                                                                <?php $cache_key=key($gongling[$k1])?>
                                                                <foreach name="gongling[$k1]" item="vo2" key="k2">
                                                                    <tr>
                                                                        <if condition="$k2 eq $cache_key">
                                                                            <td id="personnel_gongling_1_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($gongling[$k1])}">{pigcms{$vo1['name']}</td>
                                                                        </if>
                                                                        <td>
                                                                            <if condition="$vo1['children']">
                                                                                <select class="selectpicker" name="data[gongling][{pigcms{$k1}][{pigcms{$k2}][job]">
                                                                                    <option value=""></option>
                                                                                    <volist name="vo1['children']" id="vo3" key="k3">
                                                                                        <if condition="$vo3 eq $vo2['job']">
                                                                                            <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                                            <else/>
                                                                                            <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                                        </if>
                                                                                    </volist>
                                                                                </select>
                                                                                <else/>
                                                                                <input value="{pigcms{$vo2['job']}" name="data[gongling][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/>
                                                                            </if>
                                                                        </td>
                                                                        <td><input value="{pigcms{$vo2['num']}" name="data[gongling][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time"/></td>
                                                                        <td><input value="{pigcms{$vo2['money']}" name="data[gongling][{pigcms{$k1}][{pigcms{$k2}][money]" type="text" class="record_check_time"/></td>
                                                                        <td><input value="{pigcms{$vo2['remark']}" name="data[gongling][{pigcms{$k1}][{pigcms{$k2}][remark]" type="text" class="record_check_time"/></td>
                                                                        <td>
                                                                            <if condition="$k2 neq $cache_key">
                                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow_gongling(this,{pigcms{$k1})">
                                                                                    删除此行
                                                                                </button>
                                                                                <else/>
                                                                                <button type="button" class="btn btn-xs blue" onclick="addrow_gongling({pigcms{$k1})">
                                                                                    添加一行
                                                                                </button>
                                                                            </if>
                                                                        </td>
                                                                    </tr>
                                                                </foreach>
                                                            </if>
                                                        </foreach>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--工服费明细表-->
                <div  id="tab_clothesfee" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="width: 60%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">工服费明细表</h4>
                            </div>
                            <div class="modal-body">
                                <div class="btn-group" style="margin-top:10px;">
            <span >
                <span>
					<span style="line-height:30px;">添加</span>
                    <div class="btn-group">
                        <select id="add_personnel_clothesfee"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                                <option value="">选择需要添加部门</option>
                                <foreach name="department_child_list" item="vo1" key="k1">
                                    <if condition="$vo1['type'] eq 2">
                                        <option value="{pigcms{$k1}">{pigcms{$vo1['name']}</option>
                                    </if>
                                </foreach>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="button" value="添加" onclick="addrow_clothesfee()"/>
            </span>
                                </div>
                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th>部门</th>
                                            <th>岗位</th>
                                            <th>人数</th>
                                            <th>计算标准<br/>（元/每人/月）</th>
                                            <th>月份</th>
                                            <th>备注</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <foreach name="department_child_list" item="vo1" key="k1">
                                            <if condition="empty($clothesfee[$k1]) and  $vo1['type'] eq 2">
                                                <tr>
                                                    <td id="personnel_clothesfee_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($clothesfee[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                    <td><input value="" name="data[clothesfee][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[clothesfee][{pigcms{$k1}][1][num]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[clothesfee][{pigcms{$k1}][1][price]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[clothesfee][{pigcms{$k1}][1][month]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[clothesfee][{pigcms{$k1}][1][remark]" type="text" class="record_check_time"/></td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_clothesfee({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </td>
                                                </tr>
                                                <elseif condition="$vo1['type'] eq 2"/>
                                                <?php $cache_key=key($clothesfee[$k1])?>
                                                <foreach name="clothesfee[$k1]" item="vo2" key="k2">
                                                    <tr>
                                                        <if condition="$k2 eq $cache_key">
                                                            <td id="personnel_clothesfee_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($clothesfee[$k1])}">{pigcms{$vo1['name']}</td>
                                                        </if>
                                                        <td><input value="{pigcms{$vo2['job']}" name="data[clothesfee][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['num']}" name="data[clothesfee][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['price']}" name="data[clothesfee][{pigcms{$k1}][{pigcms{$k2}][price]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month']}" name="data[clothesfee][{pigcms{$k1}][{pigcms{$k2}][month]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['remark']}" name="data[clothesfee][{pigcms{$k1}][{pigcms{$k2}][remark]" type="text" class="record_check_time"/></td>
                                                        <td>
                                                            <if condition="$k2 neq $cache_key">
                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow_clothesfee(this,{pigcms{$k1})">
                                                                    删除此行
                                                                </button>
                                                                <else/>
                                                                <button type="button" class="btn btn-xs blue" onclick="addrow_clothesfee({pigcms{$k1})">
                                                                    添加一行
                                                                </button>
                                                            </if>
                                                        </td>
                                                    </tr>
                                                </foreach>
                                                <elseif condition="empty($vo1['children'])"/>
                                                <else/>
                                                <tr>
                                                    <td id="personnel_clothesfee_{pigcms{$k1}" style="vertical-align:middle;"  >{pigcms{$vo1['name']}</td>
                                                    <td></td>
                                                    <td><span class="record_check_time" id="personnel_clothesfee_{pigcms{$k1}_num"></span></td>
                                                    <td><span class="record_check_time" id="personnel_clothesfee_{pigcms{$k1}_price"></span></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </if>
                                        </foreach>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>

            <!--物业服务费明细表-->
                        <div  id="tab_property" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" style="width: 60%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">物业费明细表</h4>
                                    </div>
                                    <div class="modal-body">
                                <div class="btn-group" style="margin-top:10px;">
            <span >
                <span>
					<span style="line-height:30px;">添加</span>
                    <div class="btn-group">
                        <select id="add_property"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                                <option value="">选择需要添加的类别</option>
                                <option value="1">写字楼</option>
                                <option value="2">住宅</option>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="button" value="添加" onclick="addrow_property()"/>
            </span>
                                </div>
                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                        <tr>
                                            <th colspan="2" rowspan="2">收费类别</th>
                                            <th colspan="2">以前年度</th>
                                            <th colspan="3">本年度</th>
                                            <th rowspan="2">编制说明</th>
                                            <th rowspan="2">操作</th>
                                        </tr>
                                        <tr>
                                            <th>上年欠费</th>
                                            <th>预算比例</th>
                                            <th>可收费面积</th>
                                            <th>收费标准</th>
                                            <th>预算比例</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <foreach name="property_list" item="vo1" key="k1">
                                            <if condition="empty($property[$k1])">
                                                <tr>
                                                    <td id="property_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($property[$k1])+1}">{pigcms{$vo1}</td>
                                                    <td><input value="" name="data[property][{pigcms{$k1}][1][name]" type="text" class="record_check_time property_name"/></td>
                                                    <td><input value="" name="data[property][{pigcms{$k1}][1][year_last_0]" type="text" class="record_check_time"/></td>
                                                    <td id="property_last_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])+1}" style="vertical-align:middle;">{pigcms{$proportion[$k1][last]}%</td>
                                                    <td><input value="" name="data[property][{pigcms{$k1}][1][year_now_0]" type="text" class="record_check_time"/></td>
                                                    <td><input value="" name="data[property][{pigcms{$k1}][1][year_now_1]" type="text" class="record_check_time"/></td>
                                                    <td id="property_now_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])+1}" style="vertical-align:middle;">{pigcms{$proportion[$k1][now]}%</td>
                                                    <td>{pigcms{$vo1}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_property({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </td>
                                                </tr>
                                                <else/>
                                                <?php $cache_key=key($property[$k1])?>
                                                <foreach name="property[$k1]" item="vo2" key="k2">
                                                    <tr>
                                                        <if condition="$k2 eq $cache_key">
                                                            <td id="property_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($property[$k1])}">{pigcms{$vo1}</td>
                                                        </if>
                                                        <td><input value="{pigcms{$vo2['name']}" name="data[property][{pigcms{$k1}][{pigcms{$k2}][name]" type="text" class="record_check_time property_name"/></td>
                                                        <td><input value="{pigcms{$vo2['year_last_0']}" name="data[property][{pigcms{$k1}][{pigcms{$k2}][year_last_0]" type="text" class="record_check_time"/></td>
                                                        <if condition="$k2 eq $cache_key">
                                                        <td id="property_last_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])}" style="vertical-align:middle;">{pigcms{$proportion[$k1][last]}%</td>
                                                        </if>
                                                        <td><input value="{pigcms{$vo2['year_now_0']}" name="data[property][{pigcms{$k1}][{pigcms{$k2}][year_now_0]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['year_now_1']}" name="data[property][{pigcms{$k1}][{pigcms{$k2}][year_now_1]" type="text" class="record_check_time"/></td>
                                                        <if condition="$k2 eq $cache_key">
                                                        <td id="property_now_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])}" style="vertical-align:middle;">{pigcms{$proportion[$k1][now]}%</td>
                                                        </if>
                                                        <td>{pigcms{$vo1}</td>
                                                        <td>
                                                            <if condition="$k2 neq $cache_key">
                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow_property(this,{pigcms{$k1})">
                                                                    删除此行
                                                                </button>
                                                                <else/>
                                                                <button type="button" class="btn btn-xs blue" onclick="addrow_property({pigcms{$k1})">
                                                                    添加一行
                                                                </button>
                                                            </if>
                                                        </td>
                                                    </tr>
                                                </foreach>
                                            </if>
                                        </foreach>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                    <div class="modal-footer">
                                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--资产购置费-->
                            <div  id="tab_zichan" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">资产购置费明细表</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="btn-group" style="margin-top:10px;">
                                            </div>
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="zichan">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            项目明细
                                                        </th>
                                                        <th>
                                                            单价
                                                        </th>
                                                        <th>
                                                            数量
                                                        </th>
                                                        <th>
                                                            操作
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <if condition="empty($zichan)">
                                                        <tr>
                                                            <td><input value="" name="data[zichan][1][name]" type="text" class="record_check_time"/></td>
                                                            <td><input value="" name="data[zichan][1][unit]" type="text" class="record_check_time zichan"/></td>
                                                            <td><input value="" name="data[zichan][1][num]" type="text" class="record_check_time zichan"/></td>
                                                            <td>
                                                                    <button type="button" class="btn btn-xs blue" onclick="addrow_zichan()">
                                                                        添加一行
                                                                    </button>
                                                            </td>
                                                        </tr>
                                                        <else/>
                                                        <?php $cache_key=key($zichan)?>
                                                        <foreach name="zichan" item="vo1" key="k1">
                                                            <tr>
                                                                <td><input value="{pigcms{$vo1['name']}" name="data[zichan][{pigcms{$k1}][name]" type="text" class="record_check_time"/></td>
                                                                <td><input value="{pigcms{$vo1['unit']}" name="data[zichan][{pigcms{$k1}][unit]" type="text" class="record_check_time zichan"/></td>
                                                                <td><input value="{pigcms{$vo1['num']}" name="data[zichan][{pigcms{$k1}][num]" type="text" class="record_check_time zichan"/></td>
                                                                <td>
                                                                    <if condition="$k1 neq $cache_key">
                                                                        <button type="button" class="btn btn-xs red" onclick="deleteRow_zichan(this)">
                                                                            删除此行
                                                                        </button>
                                                                        <else/>
                                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_zichan()">
                                                                            添加一行
                                                                        </button>
                                                                    </if>
                                                                </td>
                                                            </tr>
                                                        </foreach>
                                                    </if>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--其它运行费用详细-->
                            <div  id="tab_yunxing" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">其它运行费用明细表</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="btn-group" style="margin-top:10px;">
                                            </div>
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="yunxing">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            项目明细
                                                        </th>
                                                        <th>
                                                            具体金额
                                                        </th>
                                                        <th>
                                                            操作
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <if condition="empty($yunxing)">
                                                            <tr>
                                                                <td><input value="" name="data[yunxing][1][name]" type="text" class="record_check_time"/></td>
                                                                <td><input value="" name="data[yunxing][1][sum]" type="text" class="record_check_time yunxing"/></td>
                                                                <td>
                                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_yunxing()">
                                                                            添加一行
                                                                        </button>
                                                                </td>
                                                            </tr>
                                                        <else/>
                                                        <?php $cache_key=key($yunxing)?>
                                                        <foreach name="yunxing" item="vo1" key="k1">
                                                            <tr>
                                                                <td><input value="{pigcms{$vo1['name']}" name="data[yunxing][{pigcms{$k1}][name]" type="text" class="record_check_time"/></td>
                                                                <td><input value="{pigcms{$vo1['sum']}" name="data[yunxing][{pigcms{$k1}][sum]" type="text" class="record_check_time yunxing"/></td>
                                                                <td>
                                                                    <if condition="$k1 neq $cache_key">
                                                                        <button type="button" class="btn btn-xs red" onclick="deleteRow_yunxing(this)">
                                                                            删除此行
                                                                        </button>
                                                                        <else/>
                                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_yunxing()">
                                                                            添加一行
                                                                        </button>
                                                                    </if>
                                                                </td>
                                                            </tr>
                                                        </foreach>
                                                        </foreach>
                                                    </if>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--劳务和派遣费用-->
                        <div  id="tab_dispatch" class="modal fade" role="dialog" aria-hidden="true" >
                            <div class="modal-dialog" style="width: 60%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">劳务和派遣费用明细表</h4>
                                    </div>
                                    <div class="modal-body">
                                <div class="btn-group" style="margin-top:10px;">
            <span >
                <span>
					<span style="line-height:30px;">添加</span>
                    <div class="btn-group">
                        <select id="add_personnel_dispatch"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;">
                                <option value="">选择需要添加部门人员</option>
                                <foreach name="department_child_list" item="vo1" key="k1">
                                    <if condition="$vo1['type'] eq 2">
                                        <option value="{pigcms{$k1}">{pigcms{$vo1['name']}</option>
                                    </if>
                                </foreach>
                        </select>
                    </div>
                </span>
                    <input class="btn green " type="button" value="添加" onclick="addrow_dispatch()"/>
            </span>
                                </div>
                                <div class="portlet-body form form-horizontal">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                        <tr>
                                            <th rowspan="2">部门</th>
                                            <th rowspan="2">岗位</th>
                                            <th rowspan="2">人数</th>
                                            <!--<th rowspan="2">工作月数<br/>(不填则为默认12个月)</th>-->
                                            <th rowspan="2">月工资</th>
                                            <th rowspan="2">社保</th>
                                            <th rowspan="2">社补</th>
                                            <th rowspan="2">公积金</th>
                                            <th colspan="2">月福利费</th>
                                            <th rowspan="2">管理费</th>
                                            <th rowspan="2">保险费<br/>（单价）</th>
                                            <th rowspan="2">年终奖<br/>（单价）</th>
                                            <th rowspan="2">备注</th>
                                            <th rowspan="2">操作</th>
                                        </tr>
                                        <tr>
                                            <th>降温费</th>
                                            <th>慰问费</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <foreach name="department_child_list" item="vo1" key="k1">
                                            <if condition="empty($dispatch[$k1]) and $vo1['type'] eq 2">
                                                <tr>
                                                    <td id="personnel_dispatch_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($dispatch[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][job]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][num]" type="text" class="record_check_time"/></td>
                                                    <!--<td><input name="data[dispatch][{pigcms{$k1}][1][month]" type="text" class="record_check_time"/></td>-->
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_0]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_1]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_6]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_2]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_3]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_4]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][month_5]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][insurance]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][year_end]" type="text" class="record_check_time"/></td>
                                                    <td><input name="data[dispatch][{pigcms{$k1}][1][remark]" type="text" class="record_check_time"/></td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow_dispatch({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </td>
                                                </tr>
                                                <elseif condition=" $vo1['type'] eq 2"/>
                                                <?php $cache_key=key($dispatch[$k1]);?>
                                                <foreach name="dispatch[$k1]" item="vo2" key="k2">
                                                    <tr>
                                                        <if condition="$k2 eq $cache_key">
                                                            <td id="personnel_dispatch_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($dispatch[$k1])}">{pigcms{$vo1['name']}</td>
                                                        </if>
                                                        <td><input value="{pigcms{$vo2['job']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['num']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time"/></td>
                                                        <!--<td><input value="{pigcms{$vo2['month']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month]" type="text" class="record_check_time"/></td>-->
                                                        <td><input value="{pigcms{$vo2['month_0']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_0]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_1']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_1]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_6']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_6]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_2']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_2]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_3']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_3]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_4']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_4]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['month_5']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][month_5]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['insurance']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][insurance]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['year_end']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][year_end]" type="text" class="record_check_time"/></td>
                                                        <td><input value="{pigcms{$vo2['remark']}" name="data[dispatch][{pigcms{$k1}][{pigcms{$k2}][remark]" type="text" class="record_check_time"/></td>
                                                        <td>
                                                            <if condition="$k2 neq $cache_key">
                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow_dispatch(this,{pigcms{$k1})">
                                                                    删除此行
                                                                </button>
                                                                <else/>
                                                                <button type="button" class="btn btn-xs blue" onclick="addrow_dispatch({pigcms{$k1})">
                                                                    添加一行
                                                                </button>
                                                            </if>
                                                        </td>
                                                    </tr>
                                                </foreach>
                                            </if>
                                        </foreach>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                    <div class="modal-footer">
                                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                                    </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-9">

                            <if condition="empty($display_button)">
                                <if condition="$is_finance eq 0">
                                    <button type="button" class="btn green" onclick="add_status(1)">仅保存</button>
                                    <button type="button" class="btn red" onclick="add_status(2)">确认并提交审核</button>
                                    <elseif condition="$is_finance eq 4 and $predict_info['status'] elt 1"/>
                                    <button type="button" class="btn green" onclick="add_status(1)">仅保存</button>
                                    <button type="button" class="btn red" onclick="add_status(3)">确认并提交审核</button>
                                    <else/>
                                    <button type="button" class="btn red" onclick="add_status({pigcms{$predict_info['status']})">完成保存</button>
                                </if>
                            </if>

                        </div>
                    </div>
                </div>
            </form>
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

<script src="/Car/Admin/Public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_public}js/bootstrap-select.min.js"></script>
<script src="/Car/Admin/Public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>


<!--引入js-->

<!--自定义js代码区开始-->
<script>
    function add_status(status) {
        if(status!=1&&{pigcms{:$is_finance?0:1}){
            swal({
                    title: "确认提交吗？",
                    text: "请确保预算金额填写无误后提交！",
                    type: "warning",
                    html:true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
                        $("#form").submit();
                    }
                });
        }else{
            $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
            $("#form").submit();
        }
    }
    //重置整个页面
    $('.selectpicker').selectpicker('destroy');
    $("select[class!='form-control']").selectpicker({size:10});
    //页面初始化
    <if condition="$zichan">
        $("input[name='data[2][23][children][50][type_data][sum]']").addClass("disabled");
        $("input[name='data[2][23][children][50][type_data][sum]']").attr('readonly',false);
    </if>

    <if condition="$yichun">
        $("input[name='data[3][99][children][100][type_data][sum]']").addClass("disabled");
        $("input[name='data[3][99][children][100][type_data][sum]']").attr('readonly',false);
    </if>

        /*$("input[name='data[4][101][children][106][type_data][sum]']").addClass("disabled");
        $("input[name='data[4][101][children][106][type_data][sum]']").attr('readonly',true);
        $("input[name='data[4][101][children][106][type_data][sum]']").val('在详细表中已填写');*/

</script>
<!--资产购置费方法-->
<script>
    var check='';
    var check_end='';
    check={pigcms{:count($zichan)?:1};
    <?php end($zichan); ?>
    check_end={pigcms{:key($zichan)?:1};
    /*删除一行*/
    function deleteRow_zichan(r)
    {
        if(check==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        check--;
    }
    /*添加一行*/
    function addrow_zichan() {
            check++;
            check_end++;
            var html='<tr>';
            html +='<td><input value="" name="data[zichan]['+check_end+'][name]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[zichan]['+check_end+'][unit]" type="text" class="record_check_time zichan"/></td>';
            html +='<td><input value="" name="data[zichan]['+check_end+'][num]" type="text" class="record_check_time zichan"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_zichan(this)">删除此行</button></td>';
            html +='</tr>';
            $('#zichan').append(html);
    }
</script>
<!--其它运行费方法-->
<script>
    var yunxing='';
    var yunxing_end='';
    yunxing={pigcms{:count($yunxing)?:1};
    <?php end($yunxing); ?>
    yunxing_end={pigcms{:key($yunxing)?:1};
    /*删除一行*/
    function deleteRow_yunxing(r)
    {
        if(check==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        check--;
    }
    /*添加一行*/
    function addrow_yunxing() {
        check++;
        check_end++;
        var html='<tr>';
        html +='<td><input value="" name="data[yunxing]['+check_end+'][name]" type="text" class="record_check_time"/></td>';
        html +='<td><input value="" name="data[yunxing]['+check_end+'][sum]" type="text" class="record_check_time yunxing"/></td>';
        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_yunxing(this)">删除此行</button></td>';
        html +='</tr>';
        $('#yunxing').append(html);
    }
</script>
<!--本页面全局变量-->
<script>
    var department_child_list={pigcms{:json_encode($department_child_list)};
</script>
                            <!--人员支出页面方法-->
<script>
    var personnel=new Array();
    var personnel_end=new Array();
    <foreach name="department_child_list" item="vo" key="k">
    personnel[{pigcms{$k}]={pigcms{:count($data_type[1]['data'][$k])?:1};
    <?php end($data_type[1]['data'][$k]); ?>
    personnel_end[{pigcms{$k}]={pigcms{:key($data_type[1]['data'][$k])?:1};
    </foreach>
    /*删除一行*/
    function deleteRow(r,personnel_type)
    {
        if(personnel[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        personnel[personnel_type]--;
        $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);
    }
    /*添加一行*/
    function addrow(num) {
        if($("#add_personnel option:selected").val()||num){
            if(num){
                var personnel_type=num;
            }else{
                var personnel_type=$("#add_personnel option:selected").val();
            }
            //var personnel_val=$("#add_personnel option:selected").text();
            personnel[personnel_type]++;
            personnel_end[personnel_type]++;
            var html='<tr>';
            if(department_child_list[personnel_type]['children']){
                html +='<td><select class="selectpicker" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]" class="record_check_time ">';
                html +='<option value=""></option>'
                department_child_list[personnel_type]['children'].forEach(function (item) {
                    html +='<option value="'+item+'">'+item+'</option>';
                });
                html +='</select></td>';
            }else{
                html +='<td><input  name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]" class="record_check_time "/></td>';
            }

            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][num]" type="text" class="record_check_time personnel_num"/></td>';
        <if condition="$village_info['village_id'] eq 68">
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month]" type="text" class="record_check_time personnel_num"/></td>';
        </if>
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_0]" type="text" class="record_check_time"/></td>';
            html +='<td><select name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_1]" class="selectpicker personnel_select">';
            html +='<option value="1">缴纳</option>'
            html +='<option value="0">不缴纳</option>'
            html +='</select></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_8]" type="text" class="record_check_time" readonly/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_2]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_3]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="{pigcms{$salary_config['month_5']}" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_5]" type="text" readonly class="record_check_time disabled"/></td>';
            html +='<td><input value="{pigcms{$salary_config['month_6']}" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_6]" type="text" readonly class="record_check_time disabled"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_7]" type="text" class="record_check_time"/></td>';
            if(personnel_type==12){
                html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][year_end]" type="text" class="record_check_time"/></td>';
            }else{
                html +='<td></td>';
            }
            /*
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][year_end]" type="text" class="record_check_time"/></td>';
            */
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow(this,'+personnel_type+')">删除此行 </button></td>';
                html +='</tr>';
            if(personnel[personnel_type]==2){
                $('#personnel_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_'+personnel_type).parent('tr').nextAll().eq((personnel[personnel_type]-3)).after(html);
            }
            $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);
            //$('input[name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]"]').selectpicker('refresh');
            $('.selectpicker').selectpicker({size:10});
        }else{
            return false;
        }
    }
    $('body').on("change",".personnel_select",function () {
        if($(this).val()==1){
            $(this).parents("div").parents("td").next().find("input").attr('readonly',true);
            $(this).parents("div").parents("td").next().find("input").val('');
        }else{
            console.log('123');
            $(this).parents("div").parents("td").next().find("input").attr('readonly',false);
        }
    });
    /*$('select.personnel_select').change(function () {

    })*/
</script>
<!--服装费计算-->
<script>
    var personnel_clothesfee=new Array();
    var personnel_end_clothesfee=new Array();
    <foreach name="department_child_list" item="vo" key="k">
    personnel_clothesfee[{pigcms{$k}]={pigcms{:count($clothesfee['data'][$k])?:1};
    <?php end($clothesfee['data'][$k]); ?>
    personnel_end_clothesfee[{pigcms{$k}]={pigcms{:key($clothesfee['data'][$k])?:1};
    </foreach>
    /*删除一行*/
    function deleteRow_clothesfee(r,personnel_type)
    {
        if(personnel_clothesfee[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        personnel_clothesfee[personnel_type]--;
        $('#personnel_clothesfee_'+personnel_type).attr('rowspan',personnel_clothesfee[personnel_type]);
    }
    /*添加一行*/
    function addrow_clothesfee(num) {
        if($("#add_personnel_clothesfee option:selected").val()||num){
            if(num){
                var personnel_type=num;
            }else{
                var personnel_type=$("#add_personnel_clothesfee option:selected").val();
            }
            var personnel_val=$("#add_personnel_clothesfee option:selected").text();
            personnel_clothesfee[personnel_type]++;
            personnel_end_clothesfee[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[clothesfee]['+personnel_type+']['+personnel_end_clothesfee[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[clothesfee]['+personnel_type+']['+personnel_end_clothesfee[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[clothesfee]['+personnel_type+']['+personnel_end_clothesfee[personnel_type]+'][price]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[clothesfee]['+personnel_type+']['+personnel_end_clothesfee[personnel_type]+'][month]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[clothesfee]['+personnel_type+']['+personnel_end_clothesfee[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_clothesfee(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            console.log(personnel_clothesfee[personnel_type]);
            if(personnel_clothesfee[personnel_type]==2){
                $('#personnel_clothesfee_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_clothesfee_'+personnel_type).parent('tr').nextAll().eq((personnel_clothesfee[personnel_type]-3)).after(html);
            }
            $('#personnel_clothesfee_'+personnel_type).attr('rowspan',personnel_clothesfee[personnel_type]);

        }else{
            return false;
        }
    }
</script>
<!--劳务和派遣费用-->
<script>
    var personnel_dispatch=new Array();
    var personnel_end_dispatch=new Array();
    <foreach name="department_child_list" item="vo" key="k">
    personnel_dispatch[{pigcms{$k}]={pigcms{:count($dispatch[$k])?:1};
    <?php end($dispatch[$k]); ?>
    personnel_end_dispatch[{pigcms{$k}]={pigcms{:key($dispatch[$k])?:1};
    </foreach>
    /*删除一行*/
    function deleteRow_dispatch(r,personnel_type)
    {
        if(personnel_dispatch[personnel_type]==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        personnel_dispatch[personnel_type]--;
        $('#personnel_dispatch_'+personnel_type).attr('rowspan',personnel_dispatch[personnel_type]);
    }
    /*添加一行*/
    function addrow_dispatch(num) {
        if($("#add_personnel_dispatch option:selected").val()||num){
            if(num){
                var personnel_type=num;
            }else{
                var personnel_type=$("#add_personnel_dispatch option:selected").val();
            }
            var personnel_val=$("#add_personnel_dispatch option:selected").text();
            personnel_dispatch[personnel_type]++;
            personnel_end_dispatch[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            /*html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month]" type="text" class="record_check_time"/></td>';*/
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_0]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_1]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_6]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_2]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_3]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_4]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][month_5]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][insurance]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][year_end]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[dispatch]['+personnel_type+']['+personnel_end_dispatch[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_dispatch(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            console.log(personnel_dispatch[personnel_type]);
            if(personnel_dispatch[personnel_type]==2){
                $('#personnel_dispatch_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_dispatch_'+personnel_type).parent('tr').nextAll().eq((personnel_dispatch[personnel_type]-3)).after(html);
            }
            $('#personnel_dispatch_'+personnel_type).attr('rowspan',personnel_dispatch[personnel_type]);

        }else{
            return false;
        }
    }
</script>
                        <!--加班费用计算-->
                            <script>
                                //动态选择加班费用
                                /*$('#overtime_type').change(function () {
                                        var overtime_type=$('#overtime_type').val();
                                        if(overtime_type==1){
                                            $('#overtime_type_1').css('display','block');
                                            $('#overtime_type_1 input').attr('disabled',false);
                                            $('#overtime_type_2').css('display','none');
                                            $('#overtime_type_2 input').attr('disabled',true);//隐藏的禁止提交
                                        }else{
                                            $('#overtime_type_1').css('display','none');
                                            $('#overtime_type_1 input').attr('disabled',true);
                                            $('#overtime_type_2').css('display','block');
                                            $('#overtime_type_2 input').attr('disabled',false);
                                        }
                                    }
                                );*/
                                //$('#overtime_type').val({pigcms{$predict_info['overtime_type']});
                                var personnel_overtime=new Array();
                                var personnel_end_overtime=new Array();
                                <foreach name="department_child_list" item="vo" key="k">
                                personnel_overtime[{pigcms{$k}]={pigcms{:count($overtime[$k])?:1};
                                <?php end($overtime['data'][$k]); ?>
                                personnel_end_overtime[{pigcms{$k}]={pigcms{:key($overtime[$k])?:1};
                                </foreach>
                                /*删除一行*/
                                function deleteRow_overtime(r,personnel_type)
                                {
                                    if(personnel_overtime[personnel_type]==1){
                                        swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
                                        return false;
                                    }
                                    $(r).parents("tr").remove();
                                    personnel_overtime[personnel_type]--;
                                    $('#personnel_overtime_1_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);
                                }
                                /*添加一行*/
                                function addrow_overtime(num) {
                                    /*var overtime_type=cache?cache:1;*/
                                    if($("#add_personnel_overtime option:selected").val()||num){
                                        if(num){
                                            var personnel_type=num;
                                        }else{
                                            var personnel_type=$("#add_personnel_overtime option:selected").val();
                                        }
                                        var personnel_val=$("#add_personnel_overtime option:selected").text();
                                        personnel_overtime[personnel_type]++;
                                        personnel_end_overtime[personnel_type]++;
                                        var html='<tr>';
/*
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
*/
                                        if(department_child_list[personnel_type]['children']){
                                            html +='<td><select class="selectpicker" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" class="record_check_time">';
                                            html +='<option value=""></option>';
                                            department_child_list[personnel_type]['children'].forEach(function (item) {
                                                html +='<option value="'+item+'">'+item+'</option>';
                                            });
                                            html +='</select></td>';
                                        }else{
                                            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
                                        }

                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][regime]" type="text" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][day]" max="11"  type="number" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][classes]" max="11"  type="number" class="record_check_time"/></td>';
                                        <if condition="$village_info['group_id'] neq 1 and $predict_info['overtime_type'] eq 1">
                                            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][hour]" max="11"  type="number" class="record_check_time"/></td>';
                                        </if>
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][classes_num]" max="11"  type="number" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
                                        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,'+personnel_type+')">删除此行 </button></td>';
                                        html +='</tr>';
                                        console.log(personnel_overtime[personnel_type]);
                                        if(personnel_overtime[personnel_type]==2){
                                            console.log(personnel_overtime[personnel_type]);
                                            $('#personnel_overtime_1_'+personnel_type).parent('tr').after(html);
                                        }else{
                                            $('#personnel_overtime_1_'+personnel_type).parent('tr').nextAll().eq((personnel_overtime[personnel_type]-3)).after(html);
                                        }
                                        $('#personnel_overtime_1_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);
                                        $('.selectpicker').selectpicker({size:10});

                                    }else{
                                        return false;
                                    }
                                }
                            </script>
                            <!--工龄费用计算-->
                            <script>
                                var personnel_gongling=new Array();
                                var personnel_end_gongling=new Array();
                                <foreach name="department_child_list" item="vo" key="k">
                                personnel_gongling[{pigcms{$k}]={pigcms{:count($gongling[$k])?:1};
                                <?php end($gongling['data'][$k]); ?>
                                personnel_end_gongling[{pigcms{$k}]={pigcms{:key($gongling[$k])?:1};
                                </foreach>
                                /*删除一行*/
                                function deleteRow_gongling(r,personnel_type)
                                {
                                    if(personnel_gongling[personnel_type]==1){
                                        swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
                                        return false;
                                    }
                                    $(r).parents("tr").remove();
                                    personnel_gongling[personnel_type]--;
                                    $('#personnel_overtime_1_'+personnel_type).attr('rowspan',personnel_gongling[personnel_type]);
                                }
                                /*添加一行*/
                                function addrow_gongling(num) {
                                    /*var overtime_type=cache?cache:1;*/
                                    if($("#add_personnel_gongling option:selected").val()||num){
                                        if(num){
                                            var personnel_type=num;
                                        }else{
                                            var personnel_type=$("#add_personnel_gongling option:selected").val();
                                        }
                                        var personnel_val=$("#add_personnel_gongling option:selected").text();
                                        personnel_gongling[personnel_type]++;
                                        personnel_end_gongling[personnel_type]++;
                                        var html='<tr>';
                                        /*
                                         html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
                                         */
                                        if(department_child_list[personnel_type]['children']){
                                            html +='<td><select class="selectpicker" name="data[gongling]['+personnel_type+']['+personnel_end_gongling[personnel_type]+'][job]" class="record_check_time">';
                                            html +='<option value=""></option>';
                                            department_child_list[personnel_type]['children'].forEach(function (item) {
                                                html +='<option value="'+item+'">'+item+'</option>';
                                            });
                                            html +='</select></td>';
                                        }else{
                                            html +='<td><input  name="data[gongling]['+personnel_type+']['+personnel_end_gongling[personnel_type]+'][job]" class="record_check_time "/></td>';
                                        }

                                        html +='<td><input value="" name="data[gongling]['+personnel_type+']['+personnel_end_gongling[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[gongling]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][money]"  type="text" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
                                        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,'+personnel_type+')">删除此行 </button></td>';
                                        html +='</tr>';
                                        console.log(personnel_gongling[personnel_type]);
                                        if(personnel_gongling[personnel_type]==2){
                                            console.log(personnel_gongling[personnel_type]);
                                            $('#personnel_gongling_1_'+personnel_type).parent('tr').after(html);
                                        }else{
                                            $('#personnel_gongling_1_'+personnel_type).parent('tr').nextAll().eq((personnel_gongling[personnel_type]-3)).after(html);
                                        }
                                        $('#personnel_gongling_1_'+personnel_type).attr('rowspan',personnel_gongling[personnel_type]);
                                        $('.selectpicker').selectpicker({size:10});

                                    }else{
                                        return false;
                                    }
                                }
                            </script>
                            <!--物业费收入计算-->
                            <script>
                                var property=new Array();
                                var property_end=new Array();
                                <foreach name="property_list" item="vo" key="k">
                                property[{pigcms{$k}]={pigcms{:count($property[$k])?:1};
                                <?php end($property[$k]); ?>
                                property_end[{pigcms{$k}]={pigcms{:key($property[$k])?:1};
                                </foreach>
                                /*删除一行*/
                                function deleteRow_property(r,personnel_type)
                                {
                                    if(property[personnel_type]==1){
                                        swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
                                        return false;
                                    }
                                    $(r).parents("tr").remove();
                                    property[personnel_type]--;
                                    $('#property_'+personnel_type).attr('rowspan',property[personnel_type]);
                                    $('#property_last_'+personnel_type).attr('rowspan',property[personnel_type]);
                                    $('#property_now_'+personnel_type).attr('rowspan',property[personnel_type]);


                                }
                                /*添加一行*/
                                function addrow_property(num) {
                                    if($("#add_property option:selected").val()||num){
                                        if(num){
                                            var personnel_type=num;
                                        }else{
                                            var personnel_type=$("#add_property option:selected").val();
                                        }
                                        var personnel_val=$("#add_property option:selected").text();
                                        property[personnel_type]++;
                                        property_end[personnel_type]++;
                                        var html='<tr>';
                                        html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][name]" type="text" class="record_check_time property_name"/></td>';
                                        html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_last_0]" type="text" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_now_0]" type="text" class="record_check_time"/></td>';
                                        html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][year_now_1]" type="text" class="record_check_time"/></td>';
                                        html +='<td></td>';
                                        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_property(this,'+personnel_type+')">删除此行 </button></td>';
                                        html +='</tr>';
                                        if(property[personnel_type]==2){
                                            $('#property_'+personnel_type).parent('tr').after(html);
                                        }else{
                                            $('#property_'+personnel_type).parent('tr').nextAll().eq((property[personnel_type]-3)).after(html);
                                        }
                                        $('#property_'+personnel_type).attr('rowspan',property[personnel_type]);
                                        $('#property_last_'+personnel_type).attr('rowspan',property[personnel_type]);
                                        $('#property_now_'+personnel_type).attr('rowspan',property[personnel_type]);

                                    }else{
                                        return false;
                                    }
                                }
                            </script>

<!--收入计算-->
<script>
    /*显示关闭相关*/
    $('#tab_property').on('hidden.bs.modal', function (e) {
        var is_val=0;
        $('.property_name').each(function () {
            console.log($(this).val());
            if($(this).val()){
                $("input[name='data[4][101][children][106][type_data][sum]']").addClass("disabled");
                $("input[name='data[4][101][children][106][type_data][sum]']").val('在详细表中已填写');
                $("input[name='data[4][101][children][106][type_data][sum]']").attr('readonly',true);
                is_val=1;
            }
        });
        if(is_val==0){
            $("input[name='data[4][101][children][106][type_data][sum]']").removeClass("disabled");
            $("input[name='data[4][101][children][106][type_data][sum]']").attr('readonly',false);
            $("input[name='data[4][101][children][106][type_data][sum]']").val('');
        }

    });
    $('#tab_zichan').on('hidden.bs.modal', function (e) {
        var is_val=0;
        $('.zichan').each(function () {
            if($(this).val()){
                $("input[name='data[2][23][children][50][type_data][sum]']").addClass("disabled");
                $("input[name='data[2][23][children][50][type_data][sum]']").attr('readonly',true);
                is_val +=parseFloat($(this).val());
            }
        });
        if(is_val==0){
            $("input[name='data[2][23][children][50][type_data][sum]']").removeClass("disabled");
            $("input[name='data[2][23][children][50][type_data][sum]']").val('');
            $("input[name='data[2][23][children][50][type_data][sum]']").attr('readonly',false);
        }else{
            $("input[name='data[2][23][children][50][type_data][sum]']").val('在详细表中已填写');
        }

    });
    $('#tab_yunxing').on('hidden.bs.modal', function (e) {
        var is_val=0;
        $('.yunxing').each(function () {
            if($(this).val()){
                $("input[name='data[3][99][children][100][type_data][sum]']").addClass("disabled");
                $("input[name='ddata[3][99][children][100][type_data][sum]']").attr('readonly',true);
                is_val +=parseFloat($(this).val());
            }
        });
        if(is_val==0){
            $("input[name='data[3][99][children][100][type_data][sum]']").removeClass("disabled");
            $("input[name='data[3][99][children][100][type_data][sum]']").attr('readonly',false);
        }else{
            $("input[name='data[3][99][children][100][type_data][sum]']").val(is_val);
        }

    });
    //工服费模态框打开时显示
    $('#tab_clothesfee').on('show.bs.modal', function (e) {
        var cache=new Array(1,2,3,4,8)
        cache.forEach(function (item,key) {
                var sum=0;
                $('.personnel_num').each(function () {
                    if($(this).val()&&($(this).attr('name').indexOf('data[1]['+item+']')!=-1)){
                        sum +=parseInt($(this).val());
                    }
                });
                if(item==4||item==8){
                    var price=35
                }else{
                    var price=70
                }
                console.log(sum);
                $('#personnel_clothesfee_'+item+'_num').html(sum);
                $('#personnel_clothesfee_'+item+'_price').html(price);
        });
    })
</script>
<!--自定义js代码区结束-->
