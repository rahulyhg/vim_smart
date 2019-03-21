<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <!--<div class="btn-group">
        <a href="{pigcms{:U('Budget/add_type')}">
            <button id="sample_editable_1_new" class="btn sbold green">添加新的预算类别
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>-->

    <div class="btn-group">
        <a href="{pigcms{:U('Budget/check_money_list_change')}">
            <button  class="btn sbold green" >预算金额更改
            </button>
        </a>
    </div>
    <div class="btn-group" style="margin-left: 10px">
        <a href="{pigcms{:U('Budget/check_file_list')}">
            <button  class="btn sbold green">预算清单文件预览及管理
            </button>
        </a>
    </div>
    <!--    筛选-->
    <div class="btn-group">
        <span>筛选：</span>
        <span id="filter">
                <span>
                    <div class="btn-group">
                        <select name="company_id" id="company_id"  class="form-control search" v-model="company_id">
                                    <option v-for="(index,key) in list" v-bind:value="key">{{index['deptname']}}</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select name="project_id" id="project_id"  class="form-control search" v-model="project_id_change" onchange="change_url('project_id_change',this.options[this.options.selectedIndex].value)">
                            <option v-for="(index1,key1) in project_list" v-bind:value="key1">{{index1}}</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="datetimepicker"  class="form-control" placeholder="" name="startDate" v-model="year" onchange="change_url('year',this.options[this.options.selectedIndex].value)">
                            <for start="2017" end="date('Y')+2">
                                <option value="{pigcms{$i}">{pigcms{$i}</option>
                            </for>
                        </select>
                    </div>
                </span>
            </span>
    </div>


</block>
<block name="body">
    <div class="tabbable-custom nav-justified">
        <table class="table table-striped table-bordered table-hover" id="sample_1" >
            <thead>
            <tr>
                <td colspan="7" align="center" style="font-size: 25px">{pigcms{$year}年{pigcms{$title1}收支预算对比计算表</td>
            </tr>
            <tr>
                <th width="5%">序号</th>
                <th width="10%" colspan="3">预算项目</th>
                <th width="10%">预算金额</th>
                <th width="10%">目前执行金额</th>
                <th width="10%">剩余金额</th>
            </tr>
            </thead>
            <tbody>
            <volist name="money_list" id="vo" key="ke">
                <tr>
                <td rowspan="{pigcms{$vo.count}" style="text-align:center;vertical-align:middle;">{pigcms{$ke}</td>
                <td rowspan="{pigcms{$vo.count}" style="text-align:center;vertical-align:middle;">{pigcms{$vo['type_name']}</td>
                <volist name="vo['children']" id="vo1" key="k">
                        <if condition="$k eq 1">
                            <else/>
                            <tr>
                        </if>
                        <td rowspan="{pigcms{$vo1.count}" style="text-align:center;vertical-align:middle;"><div class="tagDiv">{pigcms{$vo1['type_name']}</div></td>
                        <volist name="vo1['children']" id="vo2" key="k2">
                            <if condition="$k2 eq 1">
                                <else/>
                                <tr>
                            </if>
                            <td style="text-align:center;vertical-align:middle;"><div class="tagDiv">{pigcms{$vo2['type_name']}</div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{:number_format($vo2['data']['money_sum'],2)}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{:number_format($vo2['data']['sum'],2)}</div></div></td>
                    <td><div  style="width: 100%;"><div class="tagDiv">{pigcms{:number_format(($vo2['data']['money_sum']-$vo2['data']['sum']),2)}</div></div></td>
                        </volist>

                    </tr>
                </volist>
            </volist>
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


        new Vue({
            el:"#filter",
            data:{
                list:{pigcms{$project_list},
                    company_id:{pigcms{$company_id},
                        project_id_change:'{pigcms{$project_id_change}',
                        year:'{pigcms{$year}',
                        },
                        computed: {
                            project_list: function () {
                                /*var list_second = {};*/
                                var list = this.list[this.company_id]['list'];
                                /*console.log(this.list_third);*/
                                return list;
                            }
                        },
                        methods: {

                        }

                    });

        function change_url(type,val) {
            console.log(val);
            window.location.href='{pigcms{:U('Budget/check_money_list')}&'+type+'='+val;
        }

    </script>
</block>




