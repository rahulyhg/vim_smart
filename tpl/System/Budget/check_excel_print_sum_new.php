<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">

    <div class="btn-group">
        <span>筛选：</span>
        <span id="filter">
                <span>
                    <div class="btn-group">
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" onchange="change_urls('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                            </for>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="company_id" id="company_id"  class="form-control search" onchange="change_urls('company_id',this.options[this.options.selectedIndex].value)">
                                <foreach name="company_list" item="vo">
                                    <option value="{pigcms{$vo['id']}">{pigcms{$vo['deptname']}</option>
                                </foreach>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="project_id" id="project_id"  class="form-control search" onchange="change_urls('project_id_change',this.options[this.options.selectedIndex].value)">
                                <option value="">总表</option>
                                <foreach name="project_list" item="vo1">
                                    <option value="{pigcms{$key}">{pigcms{$vo1}</option>
                                </foreach>
                        </select>
                    </div>

                </span>
            <input type="hidden" name="role_id" value="{pigcms{$role_id}">
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
    <div class="tabbable-custom nav-justified" style="width:100%;overflow-x: scroll;">
        <ul class="nav nav-tabs nav-justified">
            <volist name="type_list" id="vo">
                <li <if condition="$_GET['type'] eq $vo['type_id']">class="active"</if>>
                <a href="{pigcms{:U('Budget/check_excel_print',array('type'=>$vo['type_id'],'role_id'=>$role_id))}" onclick="loading();"> {pigcms{$vo['type_name']} </a>
                </li>
            </volist>
        </ul>
        <table class="table table-striped table-bordered table-hover" id="sample_1" >
            <thead>
            <tr>
                <td colspan="17" align="center" style="font-size: 25px" class="center">{pigcms{$year}年{pigcms{$title1}{pigcms{$type_name}明细表</td>
            </tr>
            <tr>
                <th width="10%"  colspan="2" rowspan="2" class="center">类型</th>
                <th width="5%" rowspan="2" class="center">预算金额</th>
                <th width="10%" colspan="13" style="text-align:center;vertical-align:middle;">{pigcms{$year}年执行情况</th>
                <th width="10%" rowspan="2" class="center">编制说明</th>
            </tr>
            <tr>
                <th>合计</th>
                <for start="1" end="13">
                    <td width="5%">{pigcms{$i}月</td>
                </for>
            </tr>
            </thead>
            <tbody>
            <foreach name="data" item="vo">
                <if condition="$key nheq 'sum'">
                    <volist name="vo['children']" id="vo1" key="k">
                        <tr>
                            <if condition="$k eq 1">
                                <td rowspan="{pigcms{:count($vo['children'])}" style="text-align:center;vertical-align:middle;">{pigcms{$vo['type_name']}</td>
                            </if>
                            <td>{pigcms{$vo1['type_name']}</td>
                            <td>{pigcms{:number_format($vo1['type_data']['money_sum_no'],2)}</td>
                            <td>{pigcms{:number_format($vo1['type_data']['sum'],2)}</td>
                            <for start="1" end="13">
                                <if condition="$vo1['type_data'][$i]">
                                    <td title="双击点击查看明细"  ondblclick="open_url({pigcms{$key},{pigcms{:sprintf('%02d',$i)})">{pigcms{:number_format($vo1['type_data'][$i],2)}</td>
                                    <else/>
                                    <td>0.00</td>
                                </if>
                            </for>
                            <td>{pigcms{$vo1['type_remark']}</td>
                        </tr>
                    </volist>
                    <else/>
                    <tr>
                        <td colspan="2" style="text-align:center;vertical-align:middle;">合计</td>
                        <td>{pigcms{:number_format($vo['sum_money'],2)}</td>
                        <td>{pigcms{:number_format($vo['sum_sum'],2)}</td>
                        <for start="1" end="13">
                            <td>{pigcms{:number_format($vo[$i],2)}</td>
                        </for>
                        <td></td>
                    </tr>
                </if>
            </foreach>
            </tbody>
        </table>
    </div>
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
        function change_urls(type,val) {
            console.log(val);
            var role_id = $("input[name='role_id']").val();

            window.location.href='{pigcms{:U('Budget/check_excel_print',array('type'=>$_GET['type']))}&'+type+'='+val+'&role_id='+role_id;
        }
        function open_url(type_id,month) {
            var url='{pigcms{:U('Budget/check_record_list',array('company_id'=>$where['company_id'],'village_id_search'=>$where['village_id'],'project_id'=>$where['project_id'],'record_status'=>2,'modal'=>1))}';
            if(type_id) url +='&type_id='+type_id;
            if(month) url +='&month={pigcms{$year}-'+month;
            $("#common_modal").modal({
                remote: url
            });
        }
        $("#common_modal").on("hidden", function() {
            $(this).removeData("modal");
        });
    </script>
</block>




