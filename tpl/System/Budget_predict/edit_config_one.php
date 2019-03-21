<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" >
                <div id="basicinfo" class="tab-pane active">
                    <div id="filter">
                        <div class="form-group">
                            <div class="col-sm-2 control-label">所属项目</div>
                            <div class="col-sm-9" >

                                <div class="btn-group">
                                    <select  id="company_id"  class="form-control search" v-model="company_id">
                                        <option v-for="(index,key) in list" v-bind:value="key">{{index['deptname']}}</option>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <select name="project_id_change" id="project_id"  class="form-control search" v-model="project_id_change" onchange="change_cashier(this.options[this.options.selectedIndex].value)">
                                        <option v-for="(index1,key1) in project_list" v-bind:value="key1">{{index1}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">类目选择</div>
                            <div class="col-sm-9" >
                                <div class="btn-group" >
                                    <select class="form-control" v-model="config_type_id">
                                        <option value="property">物业费配置项</option>
                                        <option value="personnel">人员支出配置项</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div v-if="config_type_id=='property'">
                            <div class="form-group">
                                <div class="col-sm-2 control-label">物业费预算比率</div>
                                <div class="col-sm-9">
                                    <div class="col-sm-8">
                                        <span>写字楼</span>
                                        <input class="col-sm-2" value="{pigcms{$info['config_num']['proportion']['1']['last']}"  name="config_num[proportion][1][last]" type="text" placeholder="上年欠费预算比率" />%
                                        <input class="col-sm-2" value="{pigcms{$info['config_num']['proportion']['1']['now']}"  name="config_num[proportion][1][now]" type="text" placeholder="上年欠费预算比率" />%
                                    </div>
                                    <br>
                                    <div class="col-sm-8">
                                        <span>住宅区</span>
                                        <input class="col-sm-2" value="{pigcms{$info['config_num']['proportion']['2']['last']}"  name="config_num[proportion][2][last]" type="text" placeholder="上年欠费预算比率" />%
                                        <input class="col-sm-2" value="{pigcms{$info['config_num']['proportion']['2']['last']}"  name="config_num[proportion][2][now]" type="text" placeholder="上年欠费预算比率" />%
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 control-label">物业费可选单价</div>
                                <div class="col-sm-9">
                                    <table id="unit" class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <if condition="$info['config_num']['unit']">
                                            <volist name="info['config_num']['unit']" id="vo" key="key">
                                                <tr>
                                                    <td><input name="config_num[unit][]" value="{pigcms{$vo}" placeholder="填写单价，单位为元"/></td>
                                                    <td>
                                                        <if condition="$key eq 1">
                                                            <button type="button" class="btn btn-xs blue" onclick="addrow_unit()">
                                                                添加一行
                                                            </button>
                                                        <else/>
                                                            <button type="button" class="btn btn-xs red" onclick="delete_unit(this)">
                                                                删除本行
                                                            </button>
                                                        </if>
                                                    </td>
                                                </tr>
                                            </volist>
                                            <else/>
                                            <tr>
                                                <td><input name="config_num[unit][]" placeholder="填写单价，单位为元"/></td>
                                                <td>
                                                    <button type="button" class="btn btn-xs blue" onclick="addrow_unit()">
                                                        添加一行
                                                    </button>
                                                </td>
                                            </tr>
                                        </if>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div v-if="config_type_id=='personnel'">
                            <div class="form-group">
                                <div class="col-sm-2 control-label">年终奖配置</div>
                                <div class="col-sm-9">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <tbody>
                                        <foreach name="department_child_list" item="vo1" key="k1">
                                            <if condition="empty($info['config_num']['year_end'][$k1]) and $vo1['type'] eq 1">
                                                <tr>
                                                    <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;"  rowspan="{pigcms{:count($info['config_num']['year_end'][$k1])+1}">{pigcms{$vo1['name']}</td>
                                                    <td>
                                                        <select class="selectpicker" name="config_num[year_end][{pigcms{$k1}][1]['job']">
                                                            <option value=""></option>
                                                            <foreach name="vo1['children']" item="vo3" key="k3">
                                                                <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                            </foreach>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="config_num[year_end][{pigcms{$k1}][1]['type']">
                                                            <option value="1">月工资倍率</option>
                                                            <option value="2">固定金额</option>
                                                        </select>
                                                    </td>
                                                    <td><input name="config_num[year_end][{pigcms{$k1}][1]['num']" type="text" class="record_check_time personnel_num" placeholder="请输入金额或倍率"/></td>
                                                    <td>
                                                        <button type="button" class="btn btn-xs blue" onclick="addrow({pigcms{$k1})">
                                                            添加一行
                                                        </button>
                                                    </td>
                                                </tr>
                                                <elseif condition=" $vo1['type'] eq 1"/>
                                                <?php $cache_key=key($info['config_num']['year_end']);?>
                                                <foreach name="info['config_num']['year_end'][$k1]" item="vo2" key="k2">
                                                    <tr>
                                                        <if condition="$k2 eq $cache_key">
                                                            <td id="personnel_{pigcms{$k1}" style="vertical-align:middle;" rowspan="{pigcms{:count($info['config_num']['year_end'][$k1])}">{pigcms{$vo1['name']}</td>
                                                        </if>
                                                        <td>
                                                            <!--<input value="{pigcms{$vo2['job']}" name="data[{pigcms{$k}][{pigcms{$k1}][{pigcms{$k2}][job]" type="text" class="record_check_time"/>-->
                                                            <select class="selectpicker" name="config_num[year_end][{pigcms{$k1}][{pigcms{$k2}][job]">
                                                                <option value=""></option>
                                                                <volist name="vo1['children']" id="vo3" key="k3">
                                                                    <if condition="$vo3 eq $vo2['job']">
                                                                        <option value="{pigcms{$vo3}" selected>{pigcms{$vo3}</option>
                                                                        <else/>
                                                                        <option value="{pigcms{$vo3}">{pigcms{$vo3}</option>
                                                                    </if>
                                                                </volist>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="config_num[year_end][{pigcms{$k1}][{pigcms{$k2}]['type']">
                                                                <option value="1" <if condition="$vo2['type'] eq 1">selected</if> >月工资倍率</option>
                                                                <option value="2" <if condition="$vo2['type'] eq 2">selected</if>>固定金额</option>
                                                            </select>
                                                        </td>
                                                        <td><input value="{pigcms{$vo2['num']}" name="config_num[year_end][{pigcms{$k1}][{pigcms{$k2}][num]" type="text" class="record_check_time personnel_num"/></td>
                                                        <td>
                                                            <if condition="$k2 neq $cache_key">
                                                                <button type="button" class="btn btn-xs red" onclick="deleteRow(this,{pigcms{$k1})">
                                                                    删除此行
                                                                </button>
                                                                <else/>
                                                                <button type="button" class="btn btn-xs blue" onclick="addrow({pigcms{$k1})">
                                                                    添加一行
                                                                </button>
                                                            </if>
                                                        </td>
                                                    </tr>
                                                </foreach>
                                            </if>

                                        </foreach>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default" onclick="window.location.history(-1)">返 回</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</block>
<!--<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>-->
<block name="head">
    <style>
        .BMap_cpyCtrl{display:none;}
        input.ke-input-text {
            background-color: #FFFFFF;
            background-color: #FFFFFF!important;
            font-family: "sans serif",tahoma,verdana,helvetica;
            font-size: 12px;
            line-height: 24px;
            height: 24px;
            padding: 2px 4px;
            border-color: #848484 #E0E0E0 #E0E0E0 #848484;
            border-style: solid;
            border-width: 1px;
            display: -moz-inline-stack;
            display: inline-block;
            vertical-align: middle;
            zoom: 1;
        }
        .col-sm-1{width: 12%}
        .col-sm-2{width: 20%}
        .form-group>label{font-size:12px;line-height:24px;}
        #upload_pic_box{margin-top:20px;height:150px;}
        #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
        #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    </style>
    <link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
    <link rel="stylesheet" href="{pigcms{$static_public}css/bootstrap-select.min.css">
</block>
<block name="script">
    <script src="{pigcms{$static_public}js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $.datetimepicker.setLocale('ch');
        $('#record_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: false
        });
        $('#checkbox1_1').click();
    </script>
    <script>
        new Vue({
            el:"#filter",
            data:{
                    list:{pigcms{$project_list_json},
                    type_list:'',
                    config_type_id:'<if condition="$info">{pigcms{$info["config_type_id"]}<else/>property</if>',
                    company_id:'2',
                    project_id_change:''
                    },
                    computed: {
                        project_list: function () {
                            /*var list_second = {};*/
                            var list = this.list[this.company_id]['list'];
                            /*console.log(this.list_third);*/
                            /*var get=this;*/
                            var get=this;
                            var list_cache=Object.keys(list);
                            var type_list=list_cache[0];
                            get.$set(get.$data,'project_id_change',type_list);
                            /*get.$set(get.$data,'project_id_change','71');*/
                            console.log(list);
                            return list;

                        },
                    },
                    methods: {

                    },
                    watch: {
                        'project_id_change': function(newVal){
                            var project_id_change=newVal;
                            var type_list_all='';
                            var get=this;
                            $.ajax({
                                url:'{pigcms{:U("Budget/ajax_get_money_list")}',
                                type:'post',
                                data:'project_id_change='+project_id_change,
                                dataType:'json',
                                success:function (res) {
                                    type_list_all=res.type_list;
                                    //设定type_list与money_list
                                    get.$set(get.$data,'type_list',res.type_list);
                                    get.$set(get.$data,'money_list',res.money_list);
                                }
                            });
                        }
                    }

                });
        function addrow_unit() {
            var html='<tr><td><input name="config_num[unit][]" placeholder="填写单价，单位为元"/></td> <td> <button type="button" class="btn btn-xs red" onclick="delete_unit(this)">删除本行</button> </td></tr>';
            $("#unit").append(html);
        }
        function delete_unit(r) {
            $(r).parents("tr").remove();
        }

        var personnel=new Array();
        var personnel_end=new Array();
        <foreach name="department_child_list" item="vo" key="k">
        personnel[{pigcms{$k}]={pigcms{:count($info['config_num']['year_end'][$k])?:1};
        <?php end($info['config_num']['year_end'][$k]); ?>
        personnel_end[{pigcms{$k}]={pigcms{:key($info['config_num']['year_end'][$k])?:1};
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
        function addrow(num) {
            if($("#add_personnel option:selected").val()||num){
                if(num){
                    var personnel_type=num;
                }else{
                    var personnel_type=$("#add_personnel option:selected").val();
                }
                //var personnel_val=$("#add_personnel option:selected").text();
                personnel[personnel_type]++;
                personnel_end[personnel_type]++;
                var html='<tr>';
                html +='<td><select class="selectpicker" name="config_num[year_end]['+personnel_type+']['+personnel_end[personnel_type]+'][job]" class="record_check_time ">';
                html +='<option value=""></option>'
                department_child_list[personnel_type]['children'].forEach(function (item) {
                    html +='<option value="'+item+'">'+item+'</option>';
                });
                html +='</select></td>';
                html +='<td><select class="selectpicker" name="config_num[year_end]['+personnel_type+']['+personnel_end[personnel_type]+'][type]">';
                html +='<option value="1">月工资倍率</option>';
                html +='<option value="2">固定金额</option>';
                html +='</select></td>';
                html +='<td><input value="" name="config_num[year_end]['+personnel_type+']['+personnel_end[personnel_type]+'][num]" type="text" class="record_check_time personnel_num"/></td>';
                html +='<td><button type="button" class="btn btn-xs red" onclick="deleteRow(this,'+personnel_type+')">删除此行 </button></td>';
                html +='</tr>';
                if(personnel[personnel_type]==2){
                    $('#personnel_'+personnel_type).parent('tr').after(html);
                }else{
                    $('#personnel_'+personnel_type).parent('tr').nextAll().eq((personnel[personnel_type]-3)).after(html);
                }
                $('#personnel_'+personnel_type).attr('rowspan',personnel[personnel_type]);
                //$('input[name="data[1]['+personnel_type+']['+personnel_end[personnel_type]+'][job]"]').selectpicker('refresh');
                $('.selectpicker').selectpicker({size:10});
            }else{
                return false;
            }
        }
        $('.selectpicker').selectpicker('destroy');
        $("select[class!='form-control']").selectpicker({size:10});

    </script>
</block>