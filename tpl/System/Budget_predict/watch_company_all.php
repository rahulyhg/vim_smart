<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <button id="sample_editable_1_new" class="btn sbold green">导出excel表格
            <i class="fa fa-plus"></i>
        </button>
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
    <div class="fixed-table-box row-col-fixed">
        <!--<div class="fixed-table_header-wraper">
            <table class="fixed-table_header" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <td class="w-150" colspan="10">
                        <div class="table-cell">
                        {pigcms{$year}年{pigcms{$title1}预算编制汇总表
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td class="w-150" rowspan="2"><div class="table-cell">序号</div></td> 
                    <td class="w-150" rowspan="2"><div class="table-cell">预算项目</div></td> 
                    <td class="w-150" rowspan="2"><div class="table-cell">预算项目</div></td> 
                    <foreach name="predict_list" item="vo">
                        <td class="w-150" colspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell">{pigcms{$vo['village_name']}</div></td> 
                        <?php /*$cache_sum=count($vo['children'])+1*/?>
                        <for start="1" end="$cache_sum">
                            <td class="w-150" hidden></td> 
                        </for>
                    </foreach>
                    <td class="w-150"><div class="table-cell">合计</div></td>
                </tr>
                <tr>
                    <td class="w-150" hidden></td> 
                    <td class="w-150" hidden></td> 
                    <td class="w-150" hidden></td> 
                    <foreach name="predict_list" item="vo">
                        <foreach name="vo['children']" item="vo1">
                            <td class="w-150"><div class="table-cell">{pigcms{$vo1['village_name']}</div></td> 
                        </foreach>
                        <td class="w-150"> <div class="table-cell">总计</div></td>
                    </foreach>
                    <td class="w-150"><div class="table-cell">总计</div></td> 
                </tr>
                </thead>
            </table>
        </div>-->
        <!--表body-->
        <div class="fixed-table_body-wraper">
            <table class="fixed-table_body" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <!--<tr>
                    <td class="w-150" colspan="10">
                        <div class="table-cell">
                            {pigcms{$year}年{pigcms{$title1}预算编制汇总表
                        </div>
                    </td>
                </tr>-->
                <tr>
                    <td class="w-50" rowspan="2"><div class="table-cell-small">序号</div></td>
                    <td class="w-150" rowspan="2"><div class="table-cell">预算项目</div></td>
                    <td class="w-150" rowspan="2"><div class="table-cell">预算项目</div></td>
                    <foreach name="predict_list" item="vo">
                        <td class="w-150" colspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell-large">{pigcms{$vo['village_name']}</div></td>
                        <?php $cache_sum=count($vo['children'])+1?>
                        <for start="1" end="$cache_sum">
                            <td class="w-150" hidden></td>
                        </for>
                    </foreach>
                    <td class="w-150"><div class="table-cell">合计</div></td>
                </tr>
                <tr>
                    <td class="w-50" hidden></td>
                    <td class="w-150" hidden></td>
                    <td class="w-150" hidden></td>
                    <foreach name="predict_list" item="vo">
                        <foreach name="vo['children']" item="vo1">
                            <td class="w-150"><div class="table-cell" title="{pigcms{$vo1['village_name']}">{pigcms{$vo1['village_name']}</div></td>
                        </foreach>
                        <td class="w-150"> <div class="table-cell">总计</div></td>
                    </foreach>
                    <td class="w-150"><div class="table-cell">总计</div></td>
                </tr>
                <tr>
                    <td class="w-50"> <div class="table-cell-small">一</div></td>
                    <td colspan="2" class="w-150"><div class="table-cell">收入合计</div></td>
                    <td hidden></td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="vo1">
                        <?php $cache_sum +=$vo1['sum']['input']['sum_sum'];?>
                        <foreach name="vo1['children']" item="vo2">
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo2['sum']['input']['sum_sum'],2)}</div></td>
                        </foreach>
                        <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo1['sum']['input']['sum_sum'],2)}</div></td>
                    </foreach>
                    <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                </tr>
                <volist name="type_list['input']['1']['children']" id="vo" >
                    <tr>
                        <td class="w-50"><div class="table-cell-small">{pigcms{$i}</div></td>
                        <td class="w-150" colspan="2"><div class="table-cell" title="{pigcms{$vo['type_name']}">{pigcms{$vo['type_name']}</div></td>
                        <td hidden></td>
                        <?php $cache_sum=0;?>
                        <foreach name="predict_list" item="vo1" key="key1">
                            <?php $cache_sum +=$vo1['sum']['input']['1']['children'][$key]['sum_sum'];?>
                            <foreach name="vo1['children']" item="vo2" key="key2">
                                <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo2['sum']['input']['1']['children'][$key]['sum_sum'],2)}</div></td>
                            </foreach>
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo1['sum']['input']['1']['children'][$key]['sum_sum'],2)}</div></td>
                        </foreach>
                        <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                    </tr>
                </volist>
                <tr>
                    <td class="w-50"><div class="table-cell-small">二</div></td>
                    <td class="w-150" colspan="2"><div class="table-cell">支出合计</div></td>
                    <td  hidden></td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="vo">
                        <?php $cache_sum +=$vo['sum']['output']['sum_sum'];?>
                        <foreach name="vo['children']" item="vo1">
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo1['sum']['output']['sum_sum'],2)}</div></td>
                        </foreach>
                        <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo['sum']['output']['sum_sum'],2)}</div></td>
                    </foreach>
                    <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                </tr>
                <foreach name="type_list['output']" item="vo" key="ke">
                    <?php $cache_key1=key($vo['children']);$change++;?>
                    <foreach name="vo['children']" item="vo1" key="ke1">
                        <tr>
                            <if condition="$ke1 eq $cache_key1">
                                <td class="w-50" rowspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell-small">{pigcms{$change}</div></td>
                                <td class="w-150" rowspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell" title="{pigcms{$vo['type_name']}">{pigcms{$vo['type_name']}</div></td>
                                <else/>
                                <td hidden></td>
                                <td hidden></td>
                            </if>
                            <td class="w-150"><div class="table-cell" title="{pigcms{$vo1['type_name']}">{pigcms{$vo1['type_name']}</div></td>
                            <?php $cache_sum=0;?>
                            <foreach name="predict_list" item="value" key="key1">
                                <?php $cache_sum +=$value['sum']['output'][$ke]['children'][$ke1]['sum_sum'];?>
                                <volist name="value['children']" id="value2" key="key2">
                                    <td class="w-150"><div class="table-cell">{pigcms{:number_format($value2['sum']['output'][$ke]['children'][$ke1]['sum_sum'],2)}</div></td>
                                </volist>
                                <td class="w-150"><div class="table-cell">{pigcms{:number_format($value['sum']['output'][$ke]['children'][$ke1]['sum_sum'],2)}</div></td>
                            </foreach>
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                        </tr>
                    </foreach>
                    <tr>
                        <td hidden></td>
                        <td hidden></td>
                        <td class="w-150"><div class="table-cell">小计</div></td>
                        <?php $cache_sum=0;?>
                        <foreach name="predict_list" item="value">
                            <?php $cache_sum +=$value['sum']['output'][$ke]['sum_sum'];?>
                            <volist name="value['children']" id="value1">
                                <td class="w-150" ><div class="table-cell">{pigcms{:number_format($value1['sum']['output'][$ke]['sum_sum'],2)}</div></td>
                            </volist>
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($value['sum']['output'][$ke]['sum_sum'],2)}</div></td>
                        </foreach>
                        <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                    </tr>
                </foreach>
                <tr>
                    <td class="w-50"><div class="table-cell-small">三</div></td>
                    <td class="w-150" colspan="2"><div class="table-cell">净收支</div></td>
                    <td class="w-150" hidden></td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="vo">
                        <?php $cache_sum +=$vo['sum']['sum']['sum_sum'];?>
                        <volist name="vo['children']" id="vo1">
                            <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo1['sum']['sum']['sum_sum'],2)}</div></td>
                        </volist>
                        <td class="w-150"><div class="table-cell">{pigcms{:number_format($vo['sum']['sum']['sum_sum'],2)}</div></td>
                    </foreach>
                    <td class="w-150"><div class="table-cell">{pigcms{:number_format($cache_sum,2)}</div></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="fixed-table_fixed fixed-table_fixed-left" style="overflow-y: hidden">

            <div class="fixed-table_body-wraper" style="overflow: hidden">
                <table class="fixed-table_body" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                    <tr>
                        <td class="w-50"><div class="table-cell-small">序号</div></td>
                        <td class="w-150"><div class="table-cell">预算项目</div></td>
                        <td class="w-150"><div class="table-cell">预算项目</div></td>
                    </tr>
                    <tr>
                        <td class="w-50"><div class="table-cell-small">序号</div></td>
                        <td class="w-150"><div class="table-cell">预算项目</div></td>
                        <td class="w-150"><div class="table-cell">预算项目</div></td>
                    </tr>
                    <tr>
                        <td class="w-50"><div class="table-cell-small">一</div></td>
                        <td class="w-150" colspan="2"><div class="table-cell">收入合计</div></td>
                    </tr>
                    <volist name="type_list['input']['1']['children']" id="vo" >
                        <tr>
                            <td class="w-50"><div class="table-cell-small">{pigcms{$i}</div></td>
                            <td class="w-150" colspan="2"><div class="table-cell" title="{pigcms{$vo['type_name']}">{pigcms{$vo['type_name']}</div></td>

                        </tr>
                    </volist>
                    <tr>
                        <td class="w-50"><div class="table-cell-small">二</div></td>
                        <td class="w-150" colspan="2"><div class="table-cell">支出合计</div></td>

                    </tr>
                    <foreach name="type_list['output']" item="vo" key="ke">
                        <?php $cache_key1=key($vo['children']);$change++;?>
                        <foreach name="vo['children']" item="vo1" key="ke1">
                            <tr>
                                <if condition="$ke1 eq $cache_key1">
                                    <td class="w-50" rowspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell-small">{pigcms{$change}</div></td>
                                    <td class="w-150" rowspan="{pigcms{:count($vo['children'])+1}"><div class="table-cell" title="{pigcms{$vo['type_name']}">{pigcms{$vo['type_name']}</div></td>
                                    <else/>
                                    <td hidden></td>
                                    <td hidden></td>
                                </if>
                                <td class="w-150"><div class="table-cell" title="{pigcms{$vo1['type_name']}">{pigcms{$vo1['type_name']}</div></td>
                            </tr>
                        </foreach>
                        <tr>
                            <td hidden></td>
                            <td hidden></td>
                            <td class="w-150"><div class="table-cell">小计</div></td>
                        </tr>
                    </foreach>
                    <tr>
                        <td class="w-50"><div class="table-cell-small">三</div></td>
                        <td class="w-150" colspan="2"><div class="table-cell">净收支</div></td>
                        <td hidden></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--左侧固定-->
    <div class="tabbable-custom nav-justified" style="widtd:100%;overflow-x: scroll;display: none;">
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
        <div style="widtd: 100%;">{pigcms{$year}年{pigcms{$title1}预算编制汇总表</div>
        <table class="table table-striped table-bordered table-hover" style="overflow-x: auto" id="sample_2" >
            <thead>
            <tr>
                <th widtd="5%" rowspan="2"><div style="widtd: 100px;">序号</div></th>
                <th widtd="20%" rowspan="2"><div style="widtd: 100px;">预算项目</div></th>
                <th widtd="20%" rowspan="2"><div style="widtd: 100px;">预算项目</div></th>
                <foreach name="predict_list" item="vo">
                    <th widtd="10%" colspan="{pigcms{:count($vo['children'])+1}">{pigcms{$vo['village_name']}</th>
                </foreach>
                <th widtd="20%">合计</th>
            </tr>
            <tr>
                <foreach name="predict_list" item="vo">
                    <foreach name="vo['children']" item="vo1">
                        <th>{pigcms{$vo1['village_name']}</th>
                    </foreach>
                    <th>总计</th>
                </foreach>
                <th widtd="20%">总计</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>一</td>
                <td colspan="2">收入合计</td>
                <?php $cache_sum=0;?>
                <foreach name="predict_list" item="vo1">
                    <?php $cache_sum +=$vo1['sum']['input']['sum_sum'];?>
                    <foreach name="vo1['children']" item="vo2">
                        <td>{pigcms{:number_format($vo2['sum']['input']['sum_sum'],2)}</td>
                    </foreach>
                    <td>{pigcms{:number_format($vo1['sum']['input']['sum_sum'],2)}</td>
                </foreach>
                <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
            </tr>
            <volist name="type_list['input']['1']['children']" id="vo" >
                <tr>
                    <td>{pigcms{$i}</td>
                    <td colspan="2">{pigcms{$vo['type_name']}</td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="vo1" key="key1">
                        <?php $cache_sum +=$vo1['sum']['input']['1']['children'][$key]['sum_sum'];?>
                        <foreach name="vo1['children']" item="vo2" key="key2">
                            <td><div class="tagDiv">{pigcms{:number_format($vo2['sum']['input']['1']['children'][$key]['sum_sum'],2)}</div></td>
                        </foreach>
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
                    <foreach name="vo['children']" item="vo1">
                        <td>{pigcms{:number_format($vo1['sum']['output']['sum_sum'],2)}</td>
                    </foreach>
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
                            <volist name="value['children']" id="value2" key="key2">
                                <td>{pigcms{:number_format($value2['sum']['output'][$ke]['children'][$ke1]['sum_sum'],2)}</td>
                            </volist>
                            <td><div class="tagDiv">{pigcms{:number_format($value['sum']['output'][$ke]['children'][$ke1]['sum_sum'],2)}</div></td>
                        </foreach>
                        <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
                    </tr>
                </foreach>
                <tr>
                    <td>小计</td>
                    <?php $cache_sum=0;?>
                    <foreach name="predict_list" item="value">
                        <?php $cache_sum +=$value['sum']['output'][$ke]['sum_sum'];?>
                        <volist name="value['children']" id="value1">
                            <td>{pigcms{:number_format($value1['sum']['output'][$ke]['sum_sum'],2)}</td>
                        </volist>
                        <td><div class="tagDiv">{pigcms{:number_format($value['sum']['output'][$ke]['sum_sum'],2)}</div></td>
                    </foreach>
                    <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
                </tr>
            </foreach>
            <tr>
                <td>三</td>
                <td colspan="2">净收支</td>
                <?php $cache_sum=0;?>
                <foreach name="predict_list" item="vo">
                    <?php $cache_sum +=$vo['sum']['sum']['sum_sum'];?>
                    <volist name="vo['children']" id="vo1">
                        <td>{pigcms{:number_format($vo1['sum']['sum']['sum_sum'],2)}</td>
                    </volist>
                    <td>{pigcms{:number_format($vo['sum']['sum']['sum_sum'],2)}</td>
                </foreach>
                <td><div class="tagDiv">{pigcms{:number_format($cache_sum,2)}</div></td>
            </tr>
            </tbody>
        </table>
    </div>
</block>
<block name="script">
    <link href="./static/css/fixed-table.css" rel="stylesheet" type="text/css"/>
    <style>
        .fixed-table-box{
            width: auto;
            margin: 50px auto;
        }
        .fixed-table-box>.fixed-table_body-wraper{/*内容了表格主体内容有纵向滚动条*/
            max-height: 600px;
        }

        .fixed-table_fixed>.fixed-table_body-wraper{/*为了让两侧固定列能够同步表格主体内容滚动*/
            max-height: 580px;
        }

        .w-150{
            width: 150px;
        }
        .w-50{
            width: 50px;
        }
        .w-120{
            width: 120px;
        }
        .w-300{
            width: 300px;
        }
        .w-100{
            width: 100px;
        }
        .btns{
            text-align: center;
        }
        .btns button{
            padding: 10px 20px;
        }
        td{
            white-space: nowrap;text-overflow: ellipsis;overflow: hidden;
            text-align: center;
        }
        .table-cell{
            width: 150px;text-align: center;
        }
        .table-cell-large{
            width: 300px;text-align: center;
        }
        .table-cell-small{
            width: 50px;text-align: center;
        }

    </style>
    <script src="./static/js/jquery-table2excel.min.js"></script>
    <script src="./static/js/fixed-table.js"></script>
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
            $("#sample_2").table2excel({
                exclude  : ".noExl", //过滤位置的 css 类名
                filename : "{pigcms{$year}年{pigcms{$title1}预算编制汇总表.xls", //文件名称
                name: "Excel Document Name.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
        /*$('#sample_2').dataTable( {
            'ordering' : false,
            'searching' : false,
            "scrollY" : true,
            "scrollX": true,
            fixedColumns : {
                leftColumns : 2
            }
        } );*/
        $(".fixed-table-box").fixedTable();//初始化表格
    </script>
</block>




