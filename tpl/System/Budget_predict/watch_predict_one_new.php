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
        width: 60px;
        border: none;
        text-align: center;
        height: 30px;
    }
    th{
        border: none;text-align: center;height: 30px;
    }
    #form td{
        text-align: center;
    }
    -->
</style>
<div class="row">
    <div class="col-md-12">
        <div class="btn-group" style="margin-top:10px;">
            <form action="{pigcms{:U('Budget_predict/watch_predict_one')}" method="post">
					<span style="line-height:30px;">筛选：</span>
                    <div class="btn-group">
                        <select name="id" id="record_status"  class="form-inline search" style="line-height:34px; height:34px; border:1px #CCCCCC solid; margin-right:7px; margin-top:-1px;"><!--onchange="change_url('record_status',this.options[this.options.selectedIndex].value)"-->
                            <foreach name="predict_list" item="vo" key="k">
                            <option value="{pigcms{$vo.predict_id}" <if condition="$vo['predict_id'] eq $predict_id">selected</if>>{pigcms{$vo.village_name}</option>
                            </foreach>
                        </select>
                    </div>
                </span>
                <input type="hidden" name="role_id" value="{pigcms{$role_id}">
                    <input class="btn green " type="submit" value="提交筛选"/>
            </span>
            </form>
        </div>
        <br/>

        <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">

            <div class="portlet-body" style="width:100%;overflow-x: scroll;">
                <div class="row">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <foreach name="data_type" item="vo" key="k">
                                <if condition="$k eq 4">

                                    <else/>
                                    <li <if condition="$k eq 1">class="active"</if>>
                                        <a href="#tab_{pigcms{$k}" data-toggle="tab" class="active"> {pigcms{$vo['info']['type_name']}明细表</a>
                                    </li>
                                </if>
                            </foreach>
                            <!--<li>
                                <a href="#tab_overtime" data-toggle="tab"> 加班费明细表</a>
                            </li>
                            <li>
                                <a href="#tab_clothes_fee" data-toggle="tab"> 工服费明细表</a>
                            </li>
                            <li>
                                <a href="#tab_dispatch" data-toggle="tab"> 劳务和派遣明细表</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">

                            <foreach name="data_type" item="vo" key="k">
                                <if condition="$k eq 1">
                                    <div class='tab-pane active tab-pane fad' id="tab_{pigcms{$k}">

                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                <thead>
                                                <tr>
                                                    <th rowspan="2">部门</th>
                                                    <th rowspan="2">岗位</th>
                                                    <th rowspan="2">人数</th>
                                                    <th rowspan="2">工作月数</th>
                                                    <th rowspan="2">月工资</th>
                                                    <th rowspan="2">社保</th>
                                                    <th rowspan="2">社补</th>
                                                    <th rowspan="2">公积金</th>
                                                    <th colspan="5">月福利费</th>
                                                    <th colspan="5">年度小计</th>
                                                    <th rowspan="2">年度小计</th>
                                                    <th rowspan="2">编制说明</th>
                                                </tr>
                                                <tr>
                                                    <th>餐费补贴</th>
                                                    <th>通信费</th>
                                                    <th>降温费</th>
                                                    <th>慰问费</th>
                                                    <th>其它</th>
                                                    <th>工资</th>
                                                    <th>社保社补</th>
                                                    <th>公积金</th>
                                                    <th>福利费</th>
                                                    <th>年度奖金</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <foreach name="department_child_list" item="vo1" key="k1">
                                                    <if condition="empty($vo['data'][$k1])  and $vo1['type'] eq 1">
                                                        <!--<tr>
                                                            <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($vo['data'][$k1])+1}">{pigcms{$vo1['name']}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>-->
                                                        <elseif condition=" $vo1['type'] eq 1"/>
                                                        <?php $cache_key=key($vo['data'][$k1]);?>
                                                        <foreach name="vo['data'][$k1]" item="vo2" key="k2">
                                                            <tr>
                                                                <if condition="$k2 eq $cache_key">
                                                                    <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($vo['data'][$k1])}">{pigcms{$vo1['name']}</td>
                                                                </if>
                                                                <td>{pigcms{$vo2['job']}</td>
                                                                <td>{pigcms{$vo2['num']}</td>
                                                                <td>{pigcms{$vo2['month']}</td>
                                                                <td>{pigcms{$vo2['month_0']}</td>
                                                                <td>{pigcms{$vo2['month_1']}</td>
                                                                <td>{pigcms{$vo2['month_8']}</td>
                                                                <td>{pigcms{$vo2['month_2']}</td>
                                                                <td>{pigcms{$vo2['month_3']}</td>
                                                                <td>{pigcms{$vo2['month_4']}</td>
                                                                <td>{pigcms{$vo2['month_5']}</td>
                                                                <td>{pigcms{$vo2['month_6']}</td>
                                                                <td>{pigcms{$vo2['month_7']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['month_0']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['month_1']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['month_2']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['month_other']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['year_end']}</td>
                                                                <td>{pigcms{$sum['1'][$k1][$k2]['sum']}</td>
                                                                <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['remark']}</td>
                                                            </tr>
                                                        </foreach>
                                                    </if>
                                                </foreach>
                                                <tr style="color: red">
                                                    <td colspan="2">合计</td>
                                                    <td>{pigcms{$sum['1']['sum']['num']}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{pigcms{$sum['1']['sum']['month_0']}</td>
                                                    <td>{pigcms{$sum['1']['sum']['month_1']}</td>
                                                    <td>{pigcms{$sum['1']['sum']['month_2']}</td>
                                                    <td>{pigcms{$sum['1']['sum']['month_other']}</td>
                                                    <td>{pigcms{$sum['1']['sum']['year_end']}</td>
                                                    <td>{pigcms{$sum['1']['sum']['sum']}</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">工龄工资</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12"></td>
                                                    <td>
                                                        <a href="#tab_gongling" data-toggle="modal">
                                                            <button type="button" class="btn btn-xs blue">
                                                                点击查看工龄工资明细
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                    <td>{pigcms{$sum['gongling']['sum']['sum']}</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">加班工资</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12">按基本工资/计薪天数*3计算</td>
                                                    <td>
                                                        <a href="#tab_overtime" data-toggle="modal">
                                                            <button type="button" class="btn btn-xs blue">
                                                                点击查看加班费明细
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td>{pigcms{$sum['overtime']['sum']['sum']}</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">总计</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="12"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{pigcms{:$sum['overtime']['sum']['sum']+$sum['1']['sum']['sum']+$sum['gongling']['sum']['sum']}</td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <else/>
                                    <div class='tab-pane fad' id="tab_{pigcms{$k}">
                                        <div class="portlet-body form form-horizontal">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column">

                                                <tbody>
                                                <if condition="$vo['children']">
                                                    <foreach name="vo['children']" item="vo1" key="k1">
                                                        <if condition="$k1 eq 0">

                                                            <else/>
                                                            <volist name="vo1['children']" id="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$vo1['type_name'] eq '派遣和劳务支出'">

                                                                    <if condition="$k2 eq 1">
                                                                        <td rowspan="{pigcms{:count($vo1['children'])+1}" style="text-align:center;vertical-align:middle;">{pigcms{$vo1['type_name']}</td>
                                                                    </if>
                                                                    <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['type_name']}</td>
                                                                    <td>
                                                                        {pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']}
                                                                        <if condition="$vo1['type_name'] eq '工服费'">
                                                                            <a href="#tab_clothesfee" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看工服费明细
                                                                                </button>
                                                                            </a>
                                                                            <elseif condition="$vo1['type_name'] eq '派遣和劳务支出'"/>
                                                                            <a href="#tab_dispatch" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看派遣和劳务支出明细
                                                                                </button>
                                                                            </a>
                                                                            <elseif condition="$vo2['type_name'] eq '物业费服务收入' and !empty($property)"/>
                                                                            <a href="#tab_property" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看物业费详细
                                                                                </button>
                                                                            </a>
                                                                            <elseif condition="$vo2['type_name'] eq '资产购置费' and !empty($zichan)"/>
                                                                            <a href="#tab_zichan" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看资产购置费详细
                                                                                </button>
                                                                            </a>
                                                                            <elseif condition="$vo2['type_name'] eq '其他运行费用' and !empty($yunxing)"/>
                                                                            <a href="#tab_yunxing" data-toggle="modal">
                                                                                <button type="button" class="btn btn-xs blue">
                                                                                    点击查看其他运行费用详细
                                                                                </button>
                                                                            </a>
                                                                        </if>
                                                                    </td>
                                                                    <td>{pigcms{:$vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                    <td>{pigcms{:$vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum']?number_format($vo['last_last_data'][$k1]['children'][$vo2['type_id']]['type_data']['sum'],2):'-'}</td>
                                                                    <td title="{pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['remark']}">{pigcms{$vo['data'][$k1]['children'][$vo2['type_id']]['type_data']['remark']}</td>
                                                                    </if>
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
                            <div  id="tab_overtime" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">加班工资明细</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th>部门</th>
                                                        <th>岗位</th>
                                                        <!--<th>人数</th>-->
                                                        <if condition="$predict_info['overtime_type'] eq 1">
                                                            <th>制度工资</th>
                                                            <else/>
                                                            <th>每日加班工资</th>
                                                        </if>
                                                        <th>天数</th>
                                                        <th>每天班次数</th>
                                                        <th>每班次人数</th>
                                                        <th>加班工资<br/></th>
                                                        <th>备注</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <foreach name="department_child_list" item="vo1" key="k1">
                                                        <if condition="empty($overtime[$k1]) and $vo1['type'] eq 1">
                                                            <!--<tr>
                                                                <td id="personnel_overtime_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($overtime[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>-->
                                                            <elseif condition="$vo1['type'] eq 1"/>
                                                            <?php $cache_key=key($overtime[$k1])?>
                                                            <foreach name="overtime[$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="personnel_overtime_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($overtime[$k1])}">{pigcms{$vo1['name']}</td>
                                                                    </if>
                                                                    <td>{pigcms{$vo2['job']}</td>
                                                                    <!--<td>{pigcms{$vo2['num']}</td>-->
                                                                    <td>{pigcms{:$vo2['overtime']?$vo2['overtime']:$vo2['regime']}</td>
                                                                    <td>{pigcms{$vo2['day']}</td>
                                                                    <td>{pigcms{$vo2['classes']}</td>
                                                                    <td>{pigcms{$vo2['classes_num']}</td>
                                                                    <td>{pigcms{$sum['overtime'][$k1][$k2]['overtime']}</td>
                                                                    <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['remark']}</td>
                                                                </tr>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                    <tr style="color: red">
                                                        <td colspan="2">合计</td>
                                                        <td>{pigcms{$sum['overtime']['sum']['num']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['overtime']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
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
                            <!--工龄工资明细-->
                            <div  id="tab_gongling" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">工龄工资明细</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th>部门</th>
                                                        <th>岗位</th>
                                                        <th>人数</th>
                                                        <th>天数</th>
                                                        <th>工龄工资</th>
                                                        <th>备注</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <foreach name="department_child_list" item="vo1" key="k1">
                                                        <if condition="empty($gongling[$k1]) and $vo1['type'] eq 1">
                                                            <!--<tr>
                                                                <td id="personnel_overtime_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($overtime[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>-->
                                                            <elseif condition="$vo1['type'] eq 1"/>
                                                            <?php $cache_key=key($gongling[$k1])?>
                                                            <foreach name="gongling[$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="personnel_overtime_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($gongling[$k1])}">{pigcms{$vo1['name']}</td>
                                                                    </if>
                                                                    <td>{pigcms{$vo2['job']}</td>
                                                                    <td>{pigcms{$vo2['num']}</td>
                                                                    <td>{pigcms{$vo2['money']}</td>
                                                                    <td>{pigcms{$sum['gongling'][$k1][$k2]['sum']}</td>
                                                                    <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['remark']}</td>
                                                                </tr>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                    <tr style="color: red">
                                                        <td colspan="2">合计</td>
                                                        <td>{pigcms{$sum['gongling']['sum']['num']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['gongling']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
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
                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                    <thead>
                                                    <tr>
                                                        <th colspan="2" rowspan="2">收费类别</th>
                                                        <th colspan="3">以前年度</th>
                                                        <th colspan="4">本年度</th>
                                                        <th rowspan="2">本年度预算数</th>
                                                        <th rowspan="2">编制说明</th>
                                                    </tr>
                                                    <tr>
                                                        <th>上年欠费</th>
                                                        <th>预算比例</th>
                                                        <th>列入本年预算数</th>
                                                        <th>可收费面积</th>
                                                        <th>收费标准</th>
                                                        <th>预算比例</th>
                                                        <th>本年收入</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <foreach name="property_list" item="vo1" key="k1">
                                                        <if condition="empty($property[$k1])">
                                                            <tr>
                                                                <td id="property_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($property[$k1])+1}">{pigcms{$vo1}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td id="property_last_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])+1}" style="vertical-align:middle;">{pigcms{$proportion[$k1][last]}%</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td id="property_now_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])+1}" style="vertical-align:middle;">{pigcms{$proportion[$k1][now]}%</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td rowspan="{pigcms{:count($property[$k1])+1}" style="vertical-align:middle;width: 300px">
                                                                    <if condition="$vo1 eq '写字楼'">
                                                                        以在管物业可收费面积为依据，按上年未收（含历欠）{pigcms{$proportion[$k1][last]}%和当年应{pigcms{$proportion[$k1][now]}%计算，中途退租和出租的均不作调整。
                                                                        <else/>
                                                                        以实际向业主交房面积为依据，按上年未收（含历欠）按{pigcms{$proportion[$k1][last]}%，当年应收{pigcms{$proportion[$k1][now]}%计算，不论何因均不考虑扣减
                                                                    </if>
                                                                </td>
                                                            </tr>
                                                            <else/>
                                                            <?php $cache_key=key($property[$k1])?>
                                                            <foreach name="property[$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="property_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($property[$k1])}">{pigcms{$vo1}</td>
                                                                    </if>
                                                                    <td>{pigcms{$vo2['name']}</td>
                                                                    <td>{pigcms{$vo2['year_last_0']}</td>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="property_last_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])}" style="vertical-align:middle;">{pigcms{$proportion[$k1][last]}%</td>
                                                                    </if>
                                                                    <td>{pigcms{$sum['property'][$k1][$k2]['year_last_sum']}</td>
                                                                    <td>{pigcms{$vo2['year_now_0']}</td>
                                                                    <td>{pigcms{$vo2['year_now_1']}</td>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="property_now_{pigcms{$k1}" rowspan="{pigcms{:count($property[$k1])}" style="vertical-align:middle;">{pigcms{$proportion[$k1][now]}%</td>
                                                                    </if>
                                                                    <td>{pigcms{$sum['property'][$k1][$k2]['year_now_sum']}</td>
                                                                    <td>{pigcms{$sum['property'][$k1][$k2]['sum']}</td>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td rowspan="{pigcms{:count($property[$k1])}" style="vertical-align:middle;width: 300px">
                                                                            <if condition="$vo1 eq '写字楼'">
                                                                                以在管物业可收费面积为依据，按上年未收（含历欠）{pigcms{$proportion[$k1][last]}%和当年应{pigcms{$proportion[$k1][now]}%计算，中途退租和出租的均不作调整。
                                                                                <else/>
                                                                                以实际向业主交房面积为依据，按上年未收（含历欠）按{pigcms{$proportion[$k1][last]}%，当年应收{pigcms{$proportion[$k1][now]}%计算，不论何因均不考虑扣减
                                                                            </if>
                                                                        </td>
                                                                    </if>

                                                                </tr>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                    <tr style="color: red;">
                                                        <td colspan="2">合计</td>
                                                        <td>{pigcms{$sum['property']['sum']['year_last_0']}</td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['property']['sum']['year_last_sum']}</td>
                                                        <td>{pigcms{$sum['property']['sum']['year_now_0']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['property']['sum']['year_now_sum']}</td>
                                                        <td>{pigcms{$sum['property']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
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
                            <!--工服费表-->
                            <div  id="tab_clothesfee" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">工服费明细表</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                    <thead>
                                                    <tr>
                                                        <th>部门</th>
                                                        <th>岗位</th>
                                                        <th>人数</th>
                                                        <th>计算标准<br/>（元/每人/月）</th>
                                                        <th>月份</th>
                                                        <th>工服费</th>
                                                        <th>备注</th>
                                                    </tr>

                                                    </thead>
                                                    <tbody>
                                                    <foreach name="department_child_list" item="vo1" key="k1">
                                                        <if condition="empty($clothesfee[$k1])">
                                                            <!--<tr>
                                                                <td id="personnel_clothesfee_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($clothesfee[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>-->
                                                            <else/>
                                                            <?php $cache_key=key($clothesfee[$k1])?>
                                                            <foreach name="clothesfee[$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="personnel_clothesfee_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($clothesfee[$k1])}">{pigcms{$vo1['name']}</td>
                                                                    </if>
                                                                    <td>{pigcms{$vo2['job']}</td>
                                                                    <td>{pigcms{$vo2['num']}</td>
                                                                    <td>{pigcms{$vo2['price']}</td>
                                                                    <td>{pigcms{$vo2['month']}</td>
                                                                    <td>{pigcms{$sum['clothesfee'][$k1][$k2]['clothesfee']}</td>
                                                                    <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['remark']}</td>
                                                                </tr>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                    <tr style="color: red">
                                                        <td colspan="2">合计</td>
                                                        <td>{pigcms{$sum['clothesfee']['sum']['num']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['clothesfee']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
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
                                                            合计
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <if condition="empty($zichan)">
                                                        <else/>
                                                        <foreach name="zichan" item="vo1" key="k1">
                                                            <tr>
                                                                <td>{pigcms{$vo1['name']}</td>
                                                                <td>{pigcms{$vo1['unit']}</td>
                                                                <td>{pigcms{$vo1['num']}</td>
                                                                <td>{pigcms{$vo1['sum']}</td>
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <if condition="empty($yunxing)">
                                                        <else/>
                                                        <foreach name="yunxing" item="vo1" key="k1">
                                                            <tr>
                                                                <td>{pigcms{$vo1['name']}</td>
                                                                <td>{pigcms{$vo1['sum']}</td>
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
                            <!--派遣和劳务支出表-->
                            <div  id="tab_dispatch" class="modal fade" role="dialog" aria-hidden="true" >
                                <div class="modal-dialog" style="width: 60%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">劳务和派遣费用明细表</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="portlet-body form form-horizontal">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                                    <thead>
                                                    <tr>
                                                        <th rowspan="2">部门</th>
                                                        <th rowspan="2">岗位</th>
                                                        <th rowspan="2">人数</th>
                                                        <th rowspan="2">工作月数</th>
                                                        <th rowspan="2">月工资</th>
                                                        <th rowspan="2">社保</th>
                                                        <th rowspan="2">社补</th>
                                                        <th rowspan="2">公积金</th>
                                                        <th colspan="2">月福利费</th>
                                                        <th colspan="6">年度小计</th>
                                                        <th rowspan="2">年度合计</th>
                                                        <th rowspan="2">备注</th>
                                                    </tr>
                                                    <tr>
                                                        <th>降温费</th>
                                                        <th>慰问费</th>
                                                        <th>工资</th>
                                                        <th>五险一金</th>
                                                        <th>福利费</th>
                                                        <th>管理费</th>
                                                        <th>保险费</th>
                                                        <th>年终奖</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <foreach name="department_child_list" item="vo1" key="k1">
                                                        <if condition="empty($dispatch[$k1]) and $vo1['type'] eq 2">
                                                            <!--<tr>
                                                                <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($dispatch[$k1])+1}">{pigcms{$vo1['name']}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>

                                                            </tr>-->
                                                            <elseif condition="$vo1['type'] eq 2"/>
                                                            <?php $cache_key=key($dispatch[$k1]);?>
                                                            <foreach name="dispatch[$k1]" item="vo2" key="k2">
                                                                <tr>
                                                                    <if condition="$k2 eq $cache_key">
                                                                        <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($dispatch[$k1])}">{pigcms{$vo1['name']}</td>
                                                                    </if>
                                                                    <td>{pigcms{$vo2['job']}</td>
                                                                    <td>{pigcms{$vo2['num']}</td>
                                                                    <td>{pigcms{$vo2['month']}</td>
                                                                    <td>{pigcms{$vo2['month_0']}</td>
                                                                    <td>{pigcms{$vo2['month_1']}</td>
                                                                    <td>{pigcms{$vo2['month_6']}</td>
                                                                    <td>{pigcms{$vo2['month_2']}</td>
                                                                    <td>{pigcms{$vo2['month_3']}</td>
                                                                    <td>{pigcms{$vo2['month_4']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['month_0']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['month_1']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['month_other']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['month_5']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['insurance']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['year_end']}</td>
                                                                    <td>{pigcms{$sum['dispatch'][$k1][$k2]['sum']}</td>
                                                                    <td title="{pigcms{$vo2['remark']}">{pigcms{$vo2['remark']}</td>
                                                                </tr>
                                                            </foreach>
                                                        </if>
                                                    </foreach>
                                                    <tr style="color: red">
                                                        <td colspan="2">合计</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['num']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['month_0']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['month_1']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['month_other']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['month_5']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['insurance']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['year_end']}</td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr style="color: red">
                                                        <td colspan="2">总计</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{pigcms{$sum['dispatch']['sum']['sum']}</td>
                                                        <td></td>
                                                    </tr>
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
            </div>


        </form>
    </div>
</div>
<div  id="add_status" class="modal fade" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">退回步骤列表</h4>
            </div>
            <div style="width:100%;">

                <div class="portlet-body form form-horizontal">
                    <div class="col-md-12" style="text-align:center;">
                        <foreach name="action_now['return']" item="vo">
                            <button type="button" class="btn red" onclick="add_status_check({pigcms{$vo['status']},'{pigcms{$vo['name']}')">{pigcms{$vo['name']}</button><br/><br/>
                        </foreach>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
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

<script src="/Car/Admin/Public/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>


<!--引入js-->

<!--自定义js代码区开始-->
<script>
    function add_status(status) {
        $('#form').append('<input value="'+status+'" name="status" type="hidden" />');
    }
    function add_status_check(status,text) {
        add_status(status);
        swal({
                title: "确认执行"+text+"吗？",
                text: "请确认",
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
                    $("#form").submit();
                }
            });
    }
</script>
<!--资产购置费方法-->
<script>
    var check='';
    var check_end='';
    check={pigcms{:count($data_type[2]['data'][23])?:1};
    <?php end($data_type[2]['data'][23]); ?>
    check_end={pigcms{:key($data_type[2]['data'][23])?:1};
    /*删除一行*/
    function deleteRow_check(r)
    {
        if(check==1){
            swal({title:"当前项目仅剩一条，无法删除，不需要的话可以留空",showLoaderOnConfirm:true});
            return false;
        }
        $(r).parents("tr").remove();
        check--;
        $('#check').attr('rowspan',check);
    }
    /*添加一行*/
    function addrow_check() {
        check++;
        check_end++;
        var html='<tr>';
        html +='<td><input value="" name="data[2][23][children]['+check_end+'][type_name]" type="text" class="record_check_time"/></td>';
        html +='<td><input value="" name="data[2][23][children]['+check_end+'][type_data][sum]" type="text" class="record_check_time"/></td>';
        html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_check(this)">删除此行 </button></td>';
        html +='</tr>';
        if(check==2){
            $('#check').parent('tr').after(html);
        }else{
            $('#check').parent('tr').nextAll().eq((check-3)).after(html);
        }
        $('#check').attr('rowspan',check);

    }
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
    function addrow() {
        if($("#add_personnel option:selected").val()){
            var personnel_type=$("#add_personnel option:selected").val();
            var personnel_val=$("#add_personnel option:selected").text();
            personnel[personnel_type]++;
            personnel_end[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][clothes_fee]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_0]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_1]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_2]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_3]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_4]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_5]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_6]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][month_7]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][year_end]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            if(personnel[personnel_type]==2){
                $('#personnel_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_'+personnel_type).parent('tr').nextAll().eq((personnel[personnel_type]-3)).after(html);
            }
            $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);

        }else{
            return false;
        }
    }
</script>
<script>
    var personnel_overtime=new Array();
    var personnel_end_overtime=new Array();
    <foreach name="department_child_list" item="vo" key="k">
    personnel_overtime[{pigcms{$k}]={pigcms{:count($overtime['data'][$k])?:1};
    <?php end($overtime['data'][$k]); ?>
    personnel_end_overtime[{pigcms{$k}]={pigcms{:key($overtime['data'][$k])?:1};
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
        $('#personnel_overtime_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);
    }
    /*添加一行*/
    function addrow_overtime() {
        if($("#add_personnel_overtime option:selected").val()){
            var personnel_type=$("#add_personnel_overtime option:selected").val();
            var personnel_val=$("#add_personnel_overtime option:selected").text();
            personnel_overtime[personnel_type]++;
            personnel_end_overtime[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][job]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][num]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][regime]" type="text" class="record_check_time"/></td>';
            html +='<td><input value="" name="data[overtime]['+personnel_type+']['+personnel_end_overtime[personnel_type]+'][remark]" type="text" class="record_check_time"/></td>';
            html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow_overtime(this,'+personnel_type+')">删除此行 </button></td>';
            html +='</tr>';
            console.log(personnel_overtime[personnel_type]);
            if(personnel_overtime[personnel_type]==2){
                $('#personnel_overtime_'+personnel_type).parent('tr').after(html);
            }else{
                $('#personnel_overtime_'+personnel_type).parent('tr').nextAll().eq((personnel_overtime[personnel_type]-3)).after(html);
            }
            $('#personnel_overtime_'+personnel_type).attr('rowspan',personnel_overtime[personnel_type]);

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
    property[{pigcms{$k}]={pigcms{:count($property['data'][$k])?:1};
    property_end[{pigcms{$k}]={pigcms{:key($property['data'][$k])?:1};
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
    function addrow_property() {
        if($("#add_property option:selected").val()){
            var personnel_type=$("#add_property option:selected").val();
            var personnel_val=$("#add_property option:selected").text();
            property[personnel_type]++;
            property_end[personnel_type]++;
            var html='<tr>';
            html +='<td><input value="" name="data[property]['+personnel_type+']['+property_end[personnel_type]+'][name]" type="text" class="record_check_time"/></td>';
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
    /*应用至预算汇总方法*/
    function apply_predict_one(id) {
        swal({
            title: "是否应用至预算汇总表?",
            text: "请确认",
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确认",
            cancelButtonText: "取消",
            closeOnConfirm: false,
            showCancelButton: true,
        }, function (iscom){
            if(iscom){
                swal({title:"正在应用至预算汇总表中，请耐心等待。",showLoaderOnConfirm:true});
                window.location.href='{pigcms{:U("Budget/apply_predict_one")}&id='+id;
            }else{
                swal.close();
            }
            /*$.post("{pigcms{:U('Contract/store_ajax_del_pic')}",{path:path});
             $(obj).closest('.upload_pic_li').remove();
             swal.close();*/
        })
    }
</script>
<!--自定义js代码区结束-->
