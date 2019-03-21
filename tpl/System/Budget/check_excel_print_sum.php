<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <if condition="!$isLeader">
        <a href="{pigcms{:U('Budget/check_money_list_change')}">
            <button  class="btn sbold green" >预算金额更改
                </button>
        </a>
         <else/>
            <a href="{pigcms{:U('Budget/check_record_list')}">
                <button  class="btn sbold green" >返回
                </button>
            </a>
        </if>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('Budget/ajax_excel_print',array('project_id_change'=>$project_id_change,'year'=>$year))}">
            <button id="sample_editable_1_new" class="btn sbold red">导出excel表格
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>

    <!--<div class="btn-group1">
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
                    <div class="btn-group">
                        <select name="project_id" id="project_id"  class="form-control search" onchange="change_url('project_id_change',this.options[this.options.selectedIndex].value)">
                                <option value="">总表</option>
                                <foreach name="project_list" item="vo1">
                                    <option value="{pigcms{$key}">{pigcms{$vo1}</option>
                                </foreach>
                        </select>
                    </div>

                </span>
            </span>
    </div>


</block>
<block name="body">
    <div class="tabbable-custom nav-justified" style="width:100%;overflow-x: scroll;">
    <ul class="nav nav-tabs nav-justified">
        <li class="active">
        <a href="{pigcms{:U('Budget/check_excel_print',array('type'=>'sum'))}" onclick="loading();"> 执行主表 </a>
        </li>
        <volist name="type_list" id="vo">
            <li>
            <a href="{pigcms{:U('Budget/check_excel_print',array('type'=>$vo['type_id']))}" onclick="loading();"> {pigcms{$vo['type_name']} </a>
            </li>
        </volist>
    </ul>
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
        <tr>
           <td colspan="7" align="center" style="font-size: 25px">{pigcms{$year}年{pigcms{$title1}预算执行汇总表</td>
        </tr>
        <tr>
            <th width="5%">序号</th>
            <th width="10%" colspan="2">预算项目</th>
            <th width="10%">预算金额</th>
            <th width="10%">执行金额</th>
            <th width="10%">两者差异</th>
           <th width="10%">编制说明</th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>一</td>
           <td colspan="2">收入合计</td>
          <td>{pigcms{:number_format($data['input']['sum_money'],2)}</td>
           <td>{pigcms{:number_format($data['input']['sum_sum'],2)}</td>
           <td>{pigcms{:number_format($data['input']['difference'],2)}</td>
           <td>含税金额</td>
       </tr>
       <volist name="data['input']['1']['children']" id="vo">
           <tr>
           <td>{pigcms{$i}</td>
           <td colspan="2">{pigcms{$vo['type_name']}</td>
           <td><div class="tagDiv">{pigcms{:number_format($vo['sum_money'],2)}</div></td>
           <td><div class="tagDiv">{pigcms{:number_format($vo['sum_sum'],2)}</div></td>
           <td><div class="tagDiv">{pigcms{:number_format($vo['difference'],2)}</div></td>
           <td><div class="tagDiv">{pigcms{$vo.type_remark}</div></td>
           </tr>
       </volist>
       <tr>
           <td>二</td>
           <td colspan="2">支出合计</td>
           <td>{pigcms{:number_format($data['output']['sum_money'],2)}</td>
           <td>{pigcms{:number_format($data['output']['sum_sum'],2)}</td>
           <td>{pigcms{:number_format($data['output']['difference'],2)}</td>
           <td>含税金额</td>
       </tr>
       <foreach name="data['output']" item="vo" key="ke">
           <volist name="vo['children']" id="vo1" key="k">
           <tr>
               <if condition="$k eq 1">
                   <td rowspan="{pigcms{:count($vo['children'])+1}" style="text-align:center;vertical-align:middle;">{pigcms{$ke}</td>
                   <td rowspan="{pigcms{:count($vo['children'])+1}" style="text-align:center;vertical-align:middle;">{pigcms{$vo['type_name']}</td>
                   <else/>
               </if>
                   <td><div class="tagDiv">{pigcms{$vo1['type_name']}</div></td>
                   <td><div class="tagDiv">{pigcms{:number_format($vo1['sum_money'],2)}</div></td>
                   <td><div class="tagDiv">{pigcms{:number_format($vo1['sum_sum'],2)}</div></td>
                   <td><div class="tagDiv">{pigcms{:number_format($vo1['difference'],2)}</div></td>
                   <td><div class="tagDiv">{pigcms{$vo1.type_remark}</div></td>
           </tr>
           </volist>
           <if condition="is_array($vo)">
               <tr>
                   <td>小计</td>
                   <td><div class="tagDiv" id="{pigcms{$key}">{pigcms{:number_format($vo['sum_money'],2)}</div></td>
                   <td><div class="tagDiv">{pigcms{:number_format($vo['sum_sum'],2)}</div></td>
                   <td><div class="tagDiv">{pigcms{:number_format($vo['difference'],2)}</div></td>
                   <td></td>
               </tr>
           </if>
       </foreach>
       <tr>
           <td>三</td>
           <td colspan="2">净收支</td>
           <td>{pigcms{:number_format($data['sum']['sum_money'],2)}</td>
           <td>{pigcms{:number_format($data['sum']['sum_sum'],2)}</td>
           <td>{pigcms{:number_format($data['sum']['difference'],2)}</td>
           <td>含税金额</td>
       </tr>
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




