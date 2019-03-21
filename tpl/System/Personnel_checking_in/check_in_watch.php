<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <style>
        td {
            text-align:center!important;
            vertical-align:middle!important;
        }
        th {
            text-align:center!important;
            vertical-align:middle!important;
        }
    </style>
</block>
<block name="body">
    <div class="tabbable-custom nav-justified" style="width:100%;overflow-x: scroll;">

        <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <tr>
                <td colspan="12" align="center" style="font-size: 25px">{pigcms{:date('Y年m月',strtotime('-1 month',$check_in_info['uploadtime']))}年{pigcms{$check_in_info['department_info']['deptname']}员工月考勤汇总表</td>
            </tr>
            <tr>
                <th width="5%" rowspan="3">序号</th>
                <th width="10%" rowspan="3">类别</th>
                <th width="10%" rowspan="3">姓名</th>
                <th width="5%" rowspan="2">出勤</th>
                <th width="5%" rowspan="2">休假</th>
                <th width="15%" colspan="3">请假</th>
                <th width="5%" rowspan="2">迟到</th>
                <th width="5%" rowspan="2">早退</th>
                <th width="5%" rowspan="2">旷工</th>
                <th width="20%" rowspan="3">备注</th>
            </tr>
            <tr>
                <th>病假</th>
                <th>事假</th>
                <th>其它</th>
            </tr>
            <tr>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>天数</th>
                <th>次数</th>
                <th>次数</th>
                <th>次数</th>
            </tr>
            </thead>
            <tbody>
            <foreach name="check_in_info['type_0']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_0'])}">全勤</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_1']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_1'])}">入/离职</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_2']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_2'])}">请假/旷工</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_3']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_3'])}">迟到/早退</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_4']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_4'])}">加班</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <foreach name="check_in_info['type_5']" item="vo" key="key">
                <tr>
                    <td>{pigcms{:++$count}.</td>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_5'])}">晋升/降免/调岗</td>
                    </if>
                    <td>{pigcms{$vo['name']}</td>
                    <foreach name="vo['info']" item="vo1" key="key1">
                        <td>{pigcms{$vo1}</td>
                    </foreach>
                    <td>{pigcms{$vo['remark']}</td>
                </tr>
            </foreach>
            <tr>
                <td colspan="2">考勤员：</td>
                <td colspan="2">{pigcms{$check_in_info['ci_name']}</td>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="2">部门/服务中心负责人：</td>
                <td colspan="2">{pigcms{$check_in_info['pm_name']}</td>
                <td colspan="8"></td>
            </tr>
            <foreach name="check_in_info['type_file']" item="vo" key="key">
                <tr>
                    <if condition="$key eq 0">
                        <td rowspan="{pigcms{:count($check_in_info['type_file'])}">附件下载</td>
                    </if>
                    <td colspan="3">{pigcms{$vo['name']}</td>
                    <td><a href="{pigcms{$vo['pic']}" download="{pigcms{$vo['name']}">下载</a></td>
                    <td  colspan="7"></td>
                </tr>
            </foreach>
            <if condition="$check_in_info['type_file']">
                <tr>
                    <td colspan="12"><a href="{pigcms{:U('check_download_file',array('id'=>$check_in_info['check_in_id']))}" >打包下载全部附件</a></td>
                </tr>
            </if>
            </tbody>
        </table>
    </div>
    <if condition="$is_personnel eq 1">
        <if condition="$check_in_info['status'] eq 1">
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-5 col-md-9">
                        <a href="{pigcms{:U('checking_in_edit',array('id'=>$check_in_info['check_in_id'],'status'=>2))}"><button type="button" class="btn green">通过审核</button></a>
                        <a href="{pigcms{:U('checking_in_edit',array('id'=>$check_in_info['check_in_id']))}"><button type="button" class="btn red">修改信息</button></a>
                    </div>
                </div>
            </div>
            <elseif condition="$check_in_info['status'] eq 2" />
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-5 col-md-9">
                        <a href="{pigcms{:U('check_excel_output',array('id'=>$check_in_info['check_in_id']))}"><button type="button" class="btn green">下载考勤表</button></a>
                        <a href="{pigcms{:U('check_online_output',array('id'=>$check_in_info['check_in_id']))}"><button type="button" class="btn green">在线打印考勤表</button></a>
                    </div>
                </div>
            </div>
        </if>
    </if>


</block>
<block name="script">

    <script>
        $.datetimepicker.setLocale('ch');
        /*$('#datetimepicker').datetimepicker({
         lang:"zh",           //语言选择中文
         format:"Y",      //格式化日期
         timepicker:false,    //关闭时间选项
         datepicker: false,//关闭日期选项
         yearStart:2000,     //设置最小年份
         yearEnd:2050,        //设置最大年份
         todayButton:false    //关闭选择今天按钮
         });*/

        $('#company_id').val('{pigcms{$company_id}');
        $('#project_id').val('{pigcms{$project_id_change}');
        $('#datetimepicker').val('{pigcms{$year}');
        function change_url(type,val) {
            //console.log(val);
            if(type=='project_id_change'&&val==''){
                type='company_id';
                val={pigcms{$company_id};
            }
                window.location.href='{pigcms{:U('Budget/check_excel_print',array('type'=>$_GET['type']))}&'+type+'='+val;
            }
    </script>
</block>




