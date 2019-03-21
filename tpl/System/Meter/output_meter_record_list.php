<extend name="./tpl/System/Public_news/base.php" />
<block name="head">
    <style>
        td{
            white-space: nowrap;
        }
    </style>
    <style>
        .center:{
            text-align:center;
            vertical-align:middle;
        }
    </style>
</block>
<block name="table-toolbar-left">
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
    <div class="btn-group">
            <button  class="btn sbold green" id="download">点击导出excel表格
            </button>
    </div>
    <!--    筛选-->
    <span>筛选：</span>
    <div class="btn-group">
        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
            <for start="2017" end="date('Y')+2">
                <option value="{pigcms{$i}">{pigcms{$i}</option>
            </for>
        </select>
    </div>
    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <button type="button" class="close" id="download" aria-hidden="true"></button>
                    <h4 class="modal-title">点击导出excel表格</h4>
                </div>-->
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
                                                    <select class="form-control" v-model="type_first">
                                                        <option v-for="(item,index) in list" v-bind:value="item.type_id" >{{item['type_name']}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" >
                                                    <select class="form-control" v-model="type_second">
                                                        <option v-for="(item1,index1) in list_second" v-bind:value="item1.type_id" >{{item1['type_name']}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" >
                                                    <select class="form-control" name="type_id" v-model="type_third">
                                                        <option v-for="(item2,index2) in list_third" v-bind:value="item2.type_id" >{{item2['type_name']}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
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

    <div class="tabbable-custom nav-justified" style="overflow-x: scroll;overflow-y: hidden;">
        <table class="table table-striped table-bordered table-hover"  id="sample_2" >
            <thead>
            <tr>
                <td colspan="41" align="center" style="font-size: 25px" class="center">{pigcms{$year}年{pigcms{$title}水电抄表明细表</td>
            </tr>
            <tr>
                <th  rowspan="2" class="center">编号</th>
                <th  rowspan="2" class="center">倍率</th>
                <th  rowspan="2" class="center">单价</th>
                <th  colspan="2" class="center">合计</th>
                <for start="1" end="13">
                    <th  colspan="3" class="center">{pigcms{$i}月</th>
                </for>
            </tr>
            <tr>
                <th>总用量</th>
                <th>总金额</th>
                <for start="1" end="13">
                    <th   class="center">止码</th>
                    <th   class="center">当月用量</th>
                    <th   class="center">金额</th>
                </for>
            </tr>
            </thead>
            <tbody style="overflow-x: scroll;">
            <foreach name="list" item="vo">
                <if condition="$key neq 'sum'">
                    <tr>
                        <td  class="center">{pigcms{$vo['meter_code']}</td>
                        <td  class="center">{pigcms{$vo['rate']}</td>
                        <td  class="center">{pigcms{$vo['unit_price']}</td>
                        <th>{pigcms{$vo['list']['sum']['degree']}</th>
                        <th>{pigcms{:number_format($vo['list']['sum']['money'],2)}</th>
                        <for start="1" end="13">
                            <th>{pigcms{$vo['list'][$i]['total_consume']?$vo['list'][$i]['total_consume']:''}</th>
                            <th>{pigcms{$vo['list'][$i]['degree']?$vo['list'][$i]['degree']:''}</th>
                            <th>{pigcms{:$vo['list'][$i]['money']?number_format($vo['list'][$i]['money'],2):''}</th>
                        </for>
                    </tr>
                </if>
            </foreach>
            <tr>
                <td colspan="3" class="center">总合计</td>
                <th>{pigcms{$list['sum']['sum']['degree']}</th>
                <th>{pigcms{:number_format($list['sum']['sum']['money'],2)}</th>
                <for start="1" end="13">
                    <th>{pigcms{$list['sum'][$i]['total_consume']}</th>
                    <th>{pigcms{$list['sum'][$i]['degree']}</th>
                    <th>{pigcms{:number_format($list['sum'][$i]['money'],2)}</th>
                </for>
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
            $("#download").click(function () {
                $("#sample_2").table2excel({
                    exclude  : ".noExl", //过滤位置的 css 类名
                    filename : "抄表记录导出.xls", //文件名称
                    name: "Excel Document Name.xlsx",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true

                });
            });

        $('#company_id').val('{pigcms{$company_id}');
        $('#project_id').val('{pigcms{$project_id_change}');
        $('#datetimepicker').val('{pigcms{$year}');
        /*new Vue({
            el:"#form_modal2",
            data:{
                list:{pigcms{$type_list},
                    type_first:1,
                    type_second:5,
                    type_third:8,

                },
                computed: {
                    list_second: function () {
                        /!*var list_second = {};*!/
                        var list = this.list[this.type_first]['children'];
                        /!*console.log(this.list_third);*!/
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

            });*/
        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Meter/output_meter_record_list')}&'+type+'='+val;
        }
    </script>
</block>




