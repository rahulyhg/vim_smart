<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <style type="text/css">
        .long_number{
            mso-number-format:'\@';
        }
        td{
            text-align: center;
        }
    </style>
    <div class="btn-group">
        <a href="{pigcms{:U('Personnel/group_list')}">
            <button  class="btn sbold red" >更改公司通知绑定管理员
            </button>
        </a>
    </div>
    <div class="btn-group">
            <button  class="btn sbold green" id="download">下载当前excel表格
                <i class="fa fa-plus"></i>
            </button>
    </div>

    <!--<div class="btn-group">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub()">批量打印选中缴费
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-left: 10px">
        <a href="javascript:">
            <button  class="btn sbold green" onclick="sub_project()">打印当前全部缴费单(筛选后的)
            </button>
        </a>
    </div>-->
    <!--    筛选-->
    <div class="btn-group">
        <span>筛选：</span>
        <span id="filter">
                <span>
                    <div class="btn-group">
                        <select name="group_id" id="group_id"  class="form-control search" onchange="change_url()">
                                <option value="all">全部</option>
                                <foreach name="group_list" item="vo">
                                    <option value="{pigcms{$vo['group_id']}" <if condition="$group_id eq $vo['group_id']"> selected="selected"</if>>{pigcms{$vo['group_name']}</option>
                                </foreach>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="datetimepicker"  class="form-control"  name="startDate" onchange="change_url()">
                            <for start="date('Y')" end="date('Y')+1" name="i">
                                <for start="1" end="13" name="j">
                                    <option value="{pigcms{$i}-{pigcms{$j}" <if condition="$time eq $i.'-'.$j"> selected="selected"</if> >{pigcms{$i}年{pigcms{$j}月</option>
                                </for>
                            </for>
                        </select>
                    </div>
                </span>
            </span>
    </div>


</block>
<block name="body">
    <style>
        .center:{
            text-align:center;
            vertical-align:middle;
        }
    </style>
    <div class="tabbable-custom nav-justified">
        <table class="table table-striped table-bordered table-hover" id="table_1" >
            <thead>
            <tr>
                <td colspan="7" align="center" style="font-size: 25px" class="center">{pigcms{$group_name}{pigcms{$time}待办人员事务表</td>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td colspan="7" align="center" style="font-size: 25px" class="center">{pigcms{$group_name}参保人员列表</td>
            </tr>
            <tr style="color: red">
                <td>姓名</td>
                <td>所属部门</td>
                <td>社保缴纳时间</td>
                <td>社保情况</td>
                <td>身份证号</td>
                <td>手机号</td>
                <td class="noExcel">操作</td>
            </tr>
            <foreach name="personnel_social" item="vo">
                <tr>
                <td>{pigcms{$vo['name']}</td>
                <td>{pigcms{$vo.department_name}</td>
                <td>{pigcms{:date('Y-m-d',$vo['social_addtime'])}</td>
                <td>{pigcms{$vo.social_condition}</td>
                <td><span style="display:none">'</span>{pigcms{$vo.id_number}</td>
                <td>{pigcms{$vo.phone}</td>
                <td class="noExcel">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('Personnel/personnel_edit',array('id'=>$vo['personnel_id']))}" >
                                    <i class="icon-tag"></i> 查看该员工详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            </foreach>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="7" align="center" style="font-size: 25px" class="center">{pigcms{$group_name}公积金代缴人员列表</td>
            </tr>
            <tr style="color: red">
                <td>姓名</td>
                <td>所属部门</td>
                <td>公积金时间</td>
                <td>缴纳金额</td>
                <td>身份证号</td>
                <td>手机号</td>
                <td class="noExcel">操作</td>
            </tr>
            <foreach name="personnel_accumulation" item="vo">
                <tr>
                <td>{pigcms{$vo['name']}</td>
                <td>{pigcms{$vo.department_name}</td>
                <td>{pigcms{:date('Y-m-d',$vo['accumulation_addtime'])}</td>
                <td>{pigcms{$vo.accumulation_money}</td>
                <td><span style="display:none">'</span>{pigcms{$vo.id_number}</td>
                <td>{pigcms{$vo.phone}</td>
                <td class="noExcel">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('Personnel/personnel_edit',array('id'=>$vo['personnel_id']))}" >
                                    <i class="icon-tag"></i> 查看该员工详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            </foreach>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="7" align="center" style="font-size: 25px" class="center">{pigcms{$group_name}合同到期人员列表</td>
            </tr>
            <tr style="color: red">
                <td>姓名</td>
                <td>所属部门</td>
                <td>合同开始时间</td>
                <td>合同结束时间</td>
                <td>身份证号</td>
                <td>手机号</td>
                <td class="noExcel">操作</td>
            </tr>
            <foreach name="personnel_contract" item="vo">
                <tr>
                <td>{pigcms{$vo['name']}</td>
                <td>{pigcms{$vo.department_name}</td>
                <td>{pigcms{:date('Y-m-d',$vo['time_start'])}</td>
                <td>{pigcms{:date('Y-m-d',$vo['time_end'])}</td>
                <td><span style="display:none">'</span>{pigcms{$vo.id_number}</td>
                <td>{pigcms{$vo.phone}</td>
                <td class="noExcel">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('Personnel/personnel_edit',array('id'=>$vo['personnel_id']))}" >
                                    <i class="icon-tag"></i> 查看该员工详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            </foreach>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="7" align="center" style="font-size: 25px" class="center">{pigcms{$group_name}推荐入职奖励列表</td>
            </tr>
            <tr style="color: red">
                <td>推荐人</td>
                <td>推荐人所属部门</td>
                <td>被推荐入职人姓名</td>
                <td>被推荐入职人所属部门</td>
                <td>入职时间</td>
                <td>身份证号</td>
                <td class="noExcel">操作</td>
            </tr>
            <foreach name="personnel_recommd" item="vo">
                <tr>
                <td>{pigcms{$vo['induction_name']}</td>
                <td>{pigcms{$vo['induction_info']['department_name']}</td>
                <td>{pigcms{$vo['name']}</td>
                <td>{pigcms{$vo['department_name']}</td>
                <td>{pigcms{:date('Y-m-d',$vo['entrytime'])}</td>
                <td><span style="display:none">'</span>{pigcms{$vo.id_number}</td>
                <td class="noExcel">
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> 操作
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu" style="position:relative; margin-left:-90px;">
                            <li>
                                <a href="{pigcms{:U('Personnel/personnel_edit',array('id'=>$vo['personnel_id']))}" >
                                    <i class="icon-tag"></i> 查看该员工详情 </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>
            </foreach>

            </tbody>
        </table>
    </div>
</block>
<block name="script">
    <script src="./static/js/jquery-table2excel.min.js"></script>
    <script>
        function change_url() {
            var time=$('#datetimepicker').val();
            var group_id=$('#group_id').val();
            window.location.href='{pigcms{:U("Personnel/personnel_check_list")}&time='+time+'&group_id='+group_id;
        }
        $("#download").click(function () {
            $("#table_1").table2excel({
                exclude  : ".noExcel", //过滤位置的 css 类名
                filename : "{pigcms{$group_name}{pigcms{$time}待办人员事务表.xls", //文件名称
                name: "{pigcms{$group_name}{pigcms{$time}本月待办人员事务表.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
    </script>
</block>




