<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>收款单据</title>
<!--    <link href="./static/css/style_receipt.css" rel="stylesheet" type="text/css" />
-->

    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {font-family: 宋体}
        td {
            text-align:center!important;
            vertical-align:middle!important;
        }
        th {
            text-align:center!important;
            vertical-align:middle!important;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
            border: 0px solid #000000;
        }
        .border{
            border: 1px solid #000000!important;
        }
        .left{
            text-align: left!important;
        }
    </style>
</head>

<body>

    <table class="table" style="width: 98%">
        <thead style="display: table-header-group;">
        <tr>
            <td colspan="12" style="text-align: left!important;"><img style="margin-left: 10%" src="./static/images/logo.jpg" /></td>
        </tr>
        </thead>
        <thead>

        <tr class="border">
            <td colspan="12" align="center" style="font-size: 25px">{pigcms{:date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime']))}年{pigcms{$check_in_info['department_info']['deptname']}员工月考勤汇总表</td>
        </tr>
        <tr class="border">
            <th width="5%" rowspan="3" class="border">序号</th>
            <th width="10%" rowspan="3" class="border">类别</th>
            <th width="10%" rowspan="3" class="border">姓名</th>
            <th width="5%" rowspan="2" class="border">出勤</th>
            <th width="5%" rowspan="2" class="border">休假</th>
            <th width="15%" colspan="3" class="border">请假</th>
            <th width="5%" rowspan="2" class="border">迟到</th>
            <th width="5%" rowspan="2" class="border">早退</th>
            <th width="5%" rowspan="2" class="border">旷工</th>
            <th width="20%" rowspan="3" class="border">备注</th>
        </tr>
        <tr class="border">
            <th class="border">病假</th>
            <th class="border">事假</th>
            <th class="border">其它</th>
        </tr>
        <tr class="border">
            <th class="border">天数</th>
            <th class="border">天数</th>
            <th class="border">天数</th>
            <th class="border">天数</th>
            <th class="border">天数</th>
            <th class="border">次数</th>
            <th class="border">次数</th>
            <th class="border">次数</th>
        </tr>
        </thead>
        <tbody>
        <foreach name="check_in_info['type_0']" item="vo" key="key">
            <tr class="border">
                <td class="border">{pigcms{:++$count}.</td>
                <if condition="$key eq 0">
                    <td class="border" rowspan="{pigcms{:count($check_in_info['type_0'])}">全勤</td>
                </if>
                <td class="border">{pigcms{$vo['name']}</td>
                <foreach name="vo['info']" item="vo1" key="key1">
                    <td class="border">{pigcms{$vo1}</td>
                </foreach>
                <td class="border">{pigcms{$vo['remark']}</td>
            </tr>
        </foreach>
            <foreach name="check_in_info['type_1']" item="vo" key="key">
                <tr class="border">
                    <td class="border">{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td  class="border" rowspan="{pigcms{:count($check_in_info['type_1'])}">入/离职</td>
                    </if>
                    <td class="border">{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td class="border">{pigcms{$vo1}</td>
                    </foreach>
                    <td class="border">{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>

        <foreach name="check_in_info['type_2']" item="vo" key="key">
            <tr class="border">
                <td class="border">{pigcms{:++$count}.</td>
                <if condition="$key eq 0">
                    <td class="border" rowspan="{pigcms{:count($check_in_info['type_2'])}">请假/旷工</td>
                </if>
                <td class="border">{pigcms{$vo['name']}</td>
                <foreach name="vo['info']" item="vo1" key="key1">
                    <td class="border">{pigcms{$vo1}</td>
                </foreach>
                <td class="border">{pigcms{$vo['remark']}</td>
            </tr>
        </foreach>
        <foreach name="check_in_info['type_3']" item="vo" key="key">
            <tr class="border">
                <td class="border">{pigcms{:++$count}.</td>
                <if condition="$key eq 0">
                    <td class="border" rowspan="{pigcms{:count($check_in_info['type_3'])}">迟到/早退</td>
                </if>
                <td class="border">{pigcms{$vo['name']}</td>
                <foreach name="vo['info']" item="vo1" key="key1">
                    <td class="border">{pigcms{$vo1}</td>
                </foreach>
                <td class="border">{pigcms{$vo['remark']}</td>
            </tr>
        </foreach>
        <foreach name="check_in_info['type_4']" item="vo" key="key">
            <tr class="border">
                <td class="border">{pigcms{:++$count}.</td>
                <if condition="$key eq 0">
                    <td class="border" rowspan="{pigcms{:count($check_in_info['type_4'])}">加班</td>
                </if>
                <td class="border">{pigcms{$vo['name']}</td>
                <foreach name="vo['info']" item="vo1" key="key1">
                    <td class="border">{pigcms{$vo1}</td>
                </foreach>
                <td class="border">{pigcms{$vo['remark']}</td>
            </tr>
        </foreach>
        <foreach name="check_in_info['type_5']" item="vo" key="key">
            <tr class="border">
                <td class="border">{pigcms{:++$count}.</td>
                <if condition="$key eq 0">
                    <td class="border" rowspan="{pigcms{:count($check_in_info['type_5'])}">晋升/降免/调岗</td>
                </if>
                <td class="border" >{pigcms{$vo['name']}</td>
                <foreach name="vo['info']" item="vo1" key="key1">
                    <td class="border">{pigcms{$vo1}</td>
                </foreach>
                <td class="border">{pigcms{$vo['remark']}</td>
            </tr>
        </foreach>
        <tr><td colspan="12" class="left" style="font-size: 16px">填表说明： 月考勤汇总表由考勤员填写；考勤异动（迟到、早退、旷工、请假、加班、补休等）须在备注栏加以说明，病事假须注明当年已休病事假天数；各类请假须附上请假单。</td></tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>

        <tr>
            <td colspan="3" class="left" style="font-size: 16px">考勤员：</td>
            <td colspan="9" class="left" style="font-size: 16px">{pigcms{$check_in_info['ci_name']}&nbsp;&nbsp;{pigcms{:date('Y-n-j',$check_in_info['uploadtime'])}</td>
        </tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr>
            <td colspan="3"class="left" style="font-size: 16px">部门/服务中心负责人：</td>
            <td colspan="9" class="left" style="font-size: 16px">{pigcms{$check_in_info['pm_name']}&nbsp;&nbsp;{pigcms{:date('Y-n-j',$check_in_info['uploadtime'])}</td>
        </tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr>
            <td colspan="3" class="left" style="font-size: 16px">分公司总经理（手签）：   </td>
            <td colspan="9" ></td>
        </tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr><td colspan="12"></td></tr>
        <tr>
            <td colspan="3" class="left" style="font-size: 16px">集团公司审批（手签）：     </td>
            <td colspan="9"></td>
        </tr>
        </tbody>
    </table>

</body>
    <script>
        window.print();
    </script>

</html>
