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
    </div>
    <!--<div class="btn-group">
        <a href="{pigcms{:U('Budget/add_type')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的预算类别
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->

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
        <a href="#form_modal2" data-toggle="modal">
            <button  class="btn sbold green" >筛选输出条件
            </button>
        </a>
    </div>
    <div class="btn-group">
            <button  class="btn sbold red" id="download">下载当前表格
            </button>
    </div>
    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">筛选</h4>
                </div>
                <div class="modal-body">
                    <form action="__SELF__" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">预算类型
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12" >
                                                    <div class="col-sm-4" >
                                                        <select class="form-control" name="type_id_first" v-model="type_first">
                                                            <option v-for="(item,index) in list" v-bind:value="item.type_id" >{{item['type_name']}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" >
                                                        <select class="form-control" name="type_id_second" v-model="type_second">
                                                            <option value=""></option>
                                                            <option v-for="(item1,index1) in list_second" v-bind:value="item1.type_id" >{{item1['type_name']}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" >
                                                        <select class="form-control" name="type_id_third" v-model="type_third">
                                                            <option value=""></option>
                                                            <option v-for="(item2,index2) in list_third" v-bind:value="item2.type_id" >{{item2['type_name']}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group form-md-line-input" >
                                    <label class="col-md-2 control-label" for="form_control_1">年份
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select id="datetimepicker"  class="form-control"  name="year" v-model="year">
                                            <for start="2017" end="date('Y')+2">
                                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                                            </for>
                                        </select>
                                    </div>
                                </div>

                                    <div class="form-group form-md-line-input" >
                                        <label class="col-md-2 control-label" for="form_control_1">筛选输出方式
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="type" class="form-control" onchange="change_select(this)">
                                                <option value="1">全部公司</option>
                                                <option value="2">一个公司下的全部项目</option>
                                                <option value="3">全部项目</option>
                                                <option value="4">按总公司筛选</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group form-md-line-input" id="company_list" style="display: none">
                                    <label class="col-md-2 control-label" for="form_control_1">选择公司
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="company_id" class="form-control">
                                            <foreach name="company_list" item="value">
                                                <option value="{pigcms{$value['id']}">{pigcms{$value['deptname']}</option>
                                            </foreach>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input" id="group_list" style="display: none">
                                    <label class="col-md-2 control-label" for="form_control_1">选择总公司
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="group_id" class="form-control">
                                                <option value="1">汇得行</option>
                                                <option value="2">靓江物业</option>
                                                <option value="5">汇得行汉桥</option>
                                        </select>
                                    </div>
                                </div>
                                    <div style="clear:both"></div>
                                </div>
                                <div style="clear:both"></div>


                        </div>
                        <div class="modal-footer">
                            <button class="btn green"  id="handInput" type="submit">确认提交</button>
                            <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                            <!--<button class="btn green"  onclick="updateTime()">更新</button>-->

                        </div>
                    </form>
                </div>

            </div>
        </div>
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
        <table class="table table-striped table-bordered table-hover" id="table_1" >
            <thead>
            <tr>
                <td colspan="17" align="center" style="font-size: 25px" class="center">{pigcms{$year}年{pigcms{$title1}{pigcms{$type_name}明细表</td>
            </tr>
            <tr>
                <th    rowspan="2" class="center">项目/公司名称</th>
                <th   rowspan="2" class="center">预算金额</th>
                <th  colspan="13" style="text-align:center;vertical-align:middle;">{pigcms{$year}年执行情况</th>
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
                <tr>
                    <td   class="center">{pigcms{$vo['name']}</td>
                    <th>{pigcms{:number_format($vo['list']['money_sum_no'],2)}</th>
                    <th>{pigcms{:number_format($vo['list']['sum'],2)}</th>
                    <for start="1" end="13">
                        <if condition="$vo['list'][$i]">
                            <th title="双击查看明细" ondblclick="open_url('{pigcms{$vo['company_id']}','{pigcms{$vo['village_id']}','{pigcms{$vo['village_id']}','{pigcms{:sprintf('%02d',$i)}')">{pigcms{:number_format($vo['list'][$i],2)}</th>
                            <else/>
                            <th >0.00</th>
                        </if>
                    </for>
                </tr>
            </foreach>
            <tr>
                <td    class="center">总合计</td>
                <th>{pigcms{:number_format($sum['money_sum_no'],2)}</th>
                <th>{pigcms{:number_format($sum['sum'],2)}</th>
                <for start="1" end="13">
                    <th>{pigcms{:number_format($sum[$i],2)}</th>
                </for>
            </tr>
            </tbody>
        </table>
    </div>
</block>
<block name="script">
    <script src="./static/js/jquery-table2excel.min.js"></script>
    <script>

        $('#company_id').val('{pigcms{$company_id}');
        $('#project_id').val('{pigcms{$project_id_change}');
        $('#datetimepicker').val('{pigcms{$year}');
        new Vue({
            el:"#form_modal2",
            data:{
                list:{pigcms{$type_list},
                    type_first:1,
                    type_second:5,
                    type_third:8,
                    year:{pigcms{$year}

                            },
                            computed: {
                                list_second: function () {
                                    /*var list_second = {};*/
                                    var list = this.list[this.type_first]['children'];
                                    /*console.log(this.list_third);*/
                                    return list;
                                },
                                list_third:function(){
                                    var cache=this.list[this.type_first]['children'];
                                    var arr = []
                                    for (var i in cache) {
                                        arr[i]=cache[i]; //属性
                                    }
                                    if(arr[this.type_second]){
                                        var list1=this.list[this.type_first]['children'][this.type_second]['children'];
                                    }else{
                                        var list1='';
                                    }
                                    return list1;
                                }
                            },
                            methods: {

                            }

                        });
        function change_select(el) {
            var type=$(el).val();
            console.log($(el).val());
            console.log(el);
            if(type==2){
               $('#company_list').show();
               $('#group_list').hide();
            }else if(type==4){
                $('#group_list').show();
                $('#company_list').hide();
            }else{
                $('#company_list').hide();
                $('#group_list').hide();
            }
        }
        function open_url(company_id,village_id,project_id,month) {
            var url='{pigcms{:U('Budget/check_record_list',array('type_id'=>$type_id,'record_status'=>2))}';
            if(company_id) url +='&company_id='+company_id;
            if(village_id) url +='&village_id='+village_id;
            if(project_id) url +='&project_id='+project_id;
            if(month) url +='&month={pigcms{$year}-'+month;
            window.open(url);
        }
        $("#download").click(function () {
            $("#table_1").table2excel({
                exclude  : ".noExl", //过滤位置的 css 类名
                filename : "预算分类导出表.xls", //文件名称
                name: "Excel Document Name.xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true

            });
        });
    </script>
</block>




