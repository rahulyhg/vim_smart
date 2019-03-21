<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
            <button id="sample_editable_1_new" class="btn sbold green">导出excel表格
                <i class="fa fa-plus"></i>
            </button>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Budget_predict/predict_in')}" >
            <button  class="btn sbold red" >
                预算编制明细
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Budget/check_excel_print')}" >
            <button  class="btn sbold red" >
                预算执行总表
            </button>
        </a>
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
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                            </for>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="company_id" id="company_id"  class="form-control search" onchange="change_url('company_id',this.options[this.options.selectedIndex].value)">
                                <foreach name="company_list" item="vo">
                                    <option value="{pigcms{$vo['id']}">{pigcms{$vo['deptname']}</option>
                                </foreach>
                        </select>
                    </div>
                </span>
            </span>
    </div>


</block>
<block name="body">
    <div class="tabbable-custom nav-justified" style="width:100%;overflow-x: scroll;">
        <!--<ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="{pigcms{:U('Budget/check_excel_print',array('type'=>'sum'))}" onclick="loading();"> 执行主表 </a>
            </li>
            <volist name="type_list" id="vo">
                <li>
                    <a href="{pigcms{:U('Budget/check_excel_print',array('type'=>$vo['type_id']))}" onclick="loading();"> {pigcms{$vo['type_name']} </a>
                </li>
            </volist>
        </ul>-->
        <div style="width: 100%;">{pigcms{$year}年{pigcms{$title1}预算编制汇总表</div>
        <table class="table table-striped table-bordered table-hover" style="overflow-x: auto" id="sample_1" >
            <thead>
            <tr>
                <th width="5%">序号</th>
                <th width="20%" colspan="2">预算项目</th>
                <foreach name="predict_list" item="vo">
                    <th width="10%">{pigcms{$vo['village_name']}</th>
                </foreach>
                <th width="20%">总计</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>一</td>
                <td colspan="2">收入合计</td>
                <?php $cache_sum=0;?>
                <foreach name="predict_list" item="vo1">
                    <?php $cache_sum +=$vo1['sum']['input']['sum_sum'];?>
                        <td>{pigcms{:number_format($vo1['sum']['input']['sum_sum'],2)}</td>
                </foreach>
                <th><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></th>
            </tr>
            <volist name="type_list['input']['1']['children']" id="vo" >
                <tr>
                    <td>{pigcms{$i}</td>
                    <td colspan="2">{pigcms{$vo['type_name']}</td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="vo1" key="key1">
                        <?php $cache_sum +=$vo1['sum']['input']['1']['children'][$key]['sum_sum'];?>
                        <td><div class="tagDiv">{pigcms{:number_format($vo1['sum']['input']['1']['children'][$key]['sum_sum'],2)}</div></td>
                    </foreach>
                    <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
                </tr>
            </volist>
            <tr>
                <td>二</td>
                <td colspan="2">支出合计</td>
                <?php $cache_sum=0;?>
                <foreach name="predict_list" item="vo">
                    <?php $cache_sum +=$vo['sum']['output']['sum_sum'];?>
                    <td>{pigcms{:number_format($vo['sum']['output']['sum_sum'],2)}</td>
                </foreach>
                <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
            </tr>
            <foreach name="type_list['output']" item="vo" key="ke">
                <?php $cache_key1=key($vo['children']);$change++;?>
                <foreach name="vo['children']" item="vo1" key="ke1">
                    <tr>
                        <if condition="$ke1 eq $cache_key1">
                            <td rowspan="{pigcms{:count($vo['children'])+1}" style="text-align:center;vertical-align:middle;">{pigcms{$change}</td>
                            <td rowspan="{pigcms{:count($vo['children'])+1}" style="text-align:center;vertical-align:middle;">{pigcms{$vo['type_name']}</td>
                            <else/>
                        </if>
                        <td><div class="tagDiv">{pigcms{$vo1['type_name']}</div></td>
                        <?php $cache_sum=0;?>
                        <foreach name="predict_list" item="value" key="key1">
                            <?php $cache_sum +=$value['sum']['output'][$ke]['children'][$ke1]['sum_sum'];?>
                            <td><div class="tagDiv">{pigcms{:number_format($value['sum']['output'][$ke]['children'][$ke1]['sum_sum'],2)}</div></td>
                        </foreach>
                        <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
                    </tr>
                </foreach>
                <if condition="is_array($vo)">
                    <tr>
                        <td>小计</td>
                        <?php $cache_sum=0;?>
                        <foreach name="predict_list" item="value">
                            <?php $cache_sum +=$value['sum']['output'][$ke]['sum_sum'];?>
                            <td><div class="tagDiv">{pigcms{:number_format($value['sum']['output'][$ke]['sum_sum'],2)}</div></td>
                        </foreach>
                        <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
                    </tr>
                </if>
            </foreach>
            <tr>
                <td>三</td>
                <td colspan="2">净收支</td>
                <?php $cache_sum=0;?>
                <foreach name="predict_list" item="vo">
                    <?php $cache_sum +=$vo['sum']['sum']['sum_sum'];?>
                    <td>{pigcms{:number_format($vo['sum']['sum']['sum_sum'],2)}</td>
                </foreach>
                <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
            </tr>
            </tbody>
        </table>
    </div>
</block>
<block name="script">
    <script src="./static/js/jquery-table2excel.min.js"></script>
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
        /*$('#project_id').val('{pigcms{$project_id_change}');*/
        $('#datetimepicker').val('{pigcms{$year}');
        sessionStorage.setItem('company_id',{pigcms{$company_id});
        sessionStorage.setItem('year',{pigcms{$year});
        function change_url(type,val) {
            sessionStorage.setItem(type,val);
            window.location.href='{pigcms{:U('watch_company_one')}&company_id='+sessionStorage.getItem('company_id')+'&year='+sessionStorage.getItem('year');
        }
        $("#sample_editable_1_new").click(function () {
            $("#sample_1").table2excel({
                exclude  : ".noExl", //过滤位置的 css 类名
                filename : "{pigcms{$year}年{pigcms{$title1}预算编制汇总表.xls", //文件名称
                name: "Excel Document Name.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
    </script>
</block>




