<extend name="./tpl/System/Public_news/base_full.php" />
<block name="table-toolbar-left">
    <div class="btn-group">
        <a href="{pigcms{:U('tenantlist_news')}">
            <button id="sample_editable_1_new" class="btn sbold green">返回
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list',array('meter_type_id'=>1))}">
            <button id="sample_editable_1_new" class="btn {pigcms{$_meter_type_id=="1"?"btn-lg active":""} sbold green">水费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list',array('meter_type_id'=>5))}">
            <button id="sample_editable_1_new" class="btn {pigcms{$_meter_type_id=="5"?"btn-lg active":""} sbold green">电费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('property_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">物业费
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('other_account_list')}">
            <button id="sample_editable_1_new"
                    class="btn sbold green">其他费用
            </button>
        </a>
    </div>
    <div class="btn-group">
        <a href="{pigcms{:U('account_list2')}">
            <button id="sample_editable_1_new"
                    class="btn sbold btn-lg green active">分类查看
            </button>
        </a>
    </div>
    <div class="btn-group">
        <form action="" method="post">
            <select name="y" id="y" class="form-control">
                <option value="0">选择年份</option>
                <for start="2017" end="2030">
                    <option value="{pigcms{$i}" {pigcms{$year==$i?"selected='selected'":""}>{pigcms{$i}</option>
                </for>
            </select>


            <select name="m" id="m" class="form-control">
                <option value="0">选择月份</option>
                <for start="1" end="13">
                    <option value="{pigcms{$i}" {pigcms{$month==$i?"selected='selected'":""}>{pigcms{$i}月</option>
                </for>
            </select>
        </form>
    </div>
</block>
<block name="table-toolbar-right">
    <div id="table-toolbar-right">
        <meter_cate_select></meter_cate_select>
    </div>
</block>
<block name="body">
    <div id="list" v-cloak>
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th v-for="f in fields[cate_id]">{{f.fieldname}}</th>
            </tr>
            <tr v-for="(item,index) in filter_list">
                <td v-for="(it,id) in item"
                    v-bind:rowspan="it.rowspan||1"
                >{{it.val}}</td>
            </tr>
        </table>
    </div>

</block>
<block name="script">
    <script type="text/x-template" id="tmplate_meter_cate_select">
        <span>
            <div class="btn-group">
                <select v-model="select_index[0]" @change="reset_cate_id()" class="form-control">
                    <option value="">设备类型</option>
                    <option v-for="(item,index) in meter_type_list" v-bind:value="index">{{item}}</option>
                </select>
            </div>
            <div class="btn-group">
                <select  v-model="select_index[1]" class="form-control">
                    <option value="">用途</option>
                    <option v-for="(item,index) in cate_list" v-bind:value="item.id">{{item.desc}}</option>
                </select>
            </div>
        </span>
    </script>
    <script>
        //状态管理模式，从meter_type_select 组件中获取`用途`
        const store = new Vuex.Store({
            state: {
                filter_meter_type_id:"",
                filter_cate_id:""
            },
            mutations: {
                set_filter_meter_type_id:function(state,meter_type_id){
                    state.filter_meter_type_id = meter_type_id;
                },
                set_filter_cate_id:function(state,cate_id){
                    state.filter_cate_id = cate_id;
                }
            }
        });


        Vue.component("meter_cate_select",{
            template:'#tmplate_meter_cate_select',
            data:function(){
                return {
                    select_index:["",""] //下拉选项卡
                }
            },
            mounted:function(){
                this.select_index = ["5","2"]
            },
            methods:{
                reset_cate_id:function(){
                    this.select_index[1] = "";
                }
            },
            computed:{
                meter_type_list:function(){
                    return app_json.meter_type_list;
                },

                cate_list:function(){
                    var cate_list = [];
                    if(this.select_index[0]){
                        for(var i in app_json.cate_list){
                            var row = app_json.cate_list[i];
                            if(row.meter_type_id==this.select_index[0]){
                                cate_list.push(row);
                            }
                        }
                    }
                    return cate_list;
                },
            },

            watch:{
                select_index:function(val){
                    store.commit('set_filter_meter_type_id',val[0]);
                    store.commit('set_filter_cate_id',val[1]);
                }
            }
        });





        new Vue({
            el:'#table-toolbar-right',
            data:{

            },
            methods:{},
            mounted:function(){
                console.log('start..');
            }
        });


        new Vue({
            el:'#list',
            data:{
                list:app_json.list,
                fields:{},
                group_callback:{
                    2:function(){},
                    3:function(group){
                         let total = 0;
                         for(let i in group){
                             let row = group[i];
                             for(let j in row){
                                 let td = row[j];
                                 if(td.desc == "用量"){
                                     total += parseFloat(td.val);
                                 }
                             }
                         }
                         return total.toFixed(2);
                    },
                    5:function(){},
                    7:function(group){
                        let last_byq_consume = 0,
                            byq_consume = 0;
                        for(let i in group){
                            let row = group[i];
                            for(let j in row){
                                let td = row[j];
                                if(td.desc == "上月止码"){
                                    last_byq_consume+= parseFloat(td.val);
                                }
                                if(td.desc == "本月止码"){
                                    byq_consume += parseFloat(td.val);
                                }
                            }
                        }
                        return last_byq_consume.toFixed(2) + "," +byq_consume.toFixed(2);
                    },
                    8:function(group){
                        let last_byq_consume = 0,
                            byq_consume = 0;
                        for(let i in group){
                            let row = group[i];
                            for(let j in row){
                                let td = row[j];
                                if(td.desc == "上月止码"){
                                    last_byq_consume+= parseFloat(td.val);
                                }
                                if(td.desc == "本月止码"){
                                    byq_consume += parseFloat(td.val);
                                }
                            }
                        }
                        return last_byq_consume.toFixed(2) + "," +byq_consume.toFixed(2);
                    },
                    10:function(){},
                    11:function(){

                    },
                }
            },
            methods:{
                //初始化列名
                init_set_fields:function(){
                    let new_fields = {};
                    for(let i in app_json.fields){
                        let new_cate_fields = {},
                            cate_fields = app_json.fields[i],
                            group_fields = [];
                        for(let j in cate_fields){
                            let field = cate_fields[j],
                                [fieldname = "",sort = 0,groupname=""] = field.split('#');

                            new_cate_fields[fieldname] = {
                                fieldname:fieldname,
                                sort:sort?sort*Math.pow(100,sort-1):0,
                                groupname:groupname
                            }

                            if(groupname){
                                group_fields[groupname] = {
                                    fieldname:groupname,
                                }
                            }
                        }

                        new_cate_fields = Object.assign(new_cate_fields,group_fields);

                        new_fields[i] = new_cate_fields;
                    }
                    this.fields = new_fields;
                },

                //获取排序值
                get_row_sort:function(row) {
                    let sort = 0;
                    let cate_fields = JSON.parse(JSON.stringify(this.fields[this.cate_id]||[]));
                    let arr = [];
                    for (let i in row) {
                        let td = row[i];
                        let field_sort =cate_fields[row[i].desc].sort;

                        if (field_sort<=0){
                            continue;
                        }
                        //计算td中的数字，没有则返回0
                        let std = parseInt(td.val.replace(/[^d]*?(d)[^d]*?/g,"$1"))||0;
                        std = padNumber( std * field_sort, 8 );
                        let ob = {};
                        ob.tdval = td.val;
                        ob.std =  std;
                        arr.push(ob);
                    }


                    arr.sort(function(a,b){return b.std-a.std});
                    for(let i in arr){
                        sort += arr[i].std;
                    }

                    for(let i in arr){
                        sort += arr[i].tdval;
                    }
                    //console.log(sort);
                    return String(sort);
                },


                //排序需要
                compare:function(a,b){
                    let sort_a  = this.get_row_sort(a),
                        sort_b  = this.get_row_sort(b);
                    return sort_a.localeCompare(sort_b, 'zh-Hans-CN', {sensitivity: 'accent'});
                },
                //获取分组字段，TODO::暂时只能进行一个分组
                get_group_desc:function(){
                    let desc = "";
                    for(let i in this.cate_fields){
                        if(this.cate_fields[i].groupname){
                            desc = i;
                        }
                    }
                    return desc;
                },

                //过滤行中的字段
                filter_row:function(row){
                    row = _.filter(row);//删除数组中delete产生的empty
                    //显示自定字段
                    let field = this.fields[this.cate_id],
                        arr = [];
                    if(field){
                        for(let desc in field){

                            for(let i in row){
                                if(row[i].desc == desc ){
                                    arr.push(row[i]);
                                    break;
                                }
                            }
                        }
                    }
                    console.log(arr);
                    return arr;
                },

                //分组
                list_group:function(list,group_desc){
                    let ob = {};
                    for(let i in list){
                        row = list[i];
                        for(let ii in row){
                            td = row[ii];
                            if(td.desc === group_desc){
                                if(!ob[td.val]){
                                    ob[td.val] = [];
                                }
                                ob[td.val].push(row);
                            }
                        }
                    }
                    return ob;
                },

                //添加小计数据
                add_column:function(list){
                    let group_desc = this.get_group_desc(),
                        list_group = this.list_group(list,group_desc),
                        limit = 0,
                        self = this;
                    for(let i in list_group){
                        let group = list_group[i],
                            offset = group.length,
                            info = {val:self.group_callback[self.cate_id](group),rowspan:offset};
                        list[limit].push(info);
                        limit += offset;
                    }
                    return list;

                }

            },
            computed:{
                meter_type_id:  function(){ return store.state.filter_meter_type_id },
                cate_id:        function(){ return store.state.filter_cate_id },
                cate_fields:function(){
                    return this.fields[this.cate_id];
                },
                filter_list:function(){
                    let meter_type_id = this.meter_type_id,
                        cate_id = this.cate_id,
                        original = JSON.parse(JSON.stringify(this.list)),
                        list = [];

                    //过滤行
                    for(let i in original){
                        let row = original[i],//行数据
                            meter_flag = 0,
                            cate_flag = 0;
                        for(let ii in row){
                            let td = row[ii];//单格数据
                            //过滤设备类型
                            if(td.key === "meter_type_id"){
                                meter_flag = !meter_type_id ? 1 : td.val == meter_type_id;
                            }
                            //过滤用途类型
                            if(td.key === "cate_id"){
                                cate_flag = !cate_id ? 1 :td.val.split(',').indexOf(String(cate_id))>-1;
                            }
                            //过滤字段，只对cate_id>0 的字段（自定义字段）进行过滤
                            if(td.cate_id>0){
                                if( cate_id != td.cate_id ){
                                    delete row[ii];
                                }
                            }
                        }

                        //如果符合指定选项 那么添加到list 中
                        if(meter_flag&&cate_flag){
                            row = this.filter_row(row);
                            list.push(row);
                        }
                    }

                    list.sort(this.compare);
                    this.add_column(list);
                    return list;
                }

            },

            mounted:function(){
                this.init_set_fields();
                console.log(app_json.fields);
            },

            watch:{
                cate_id:function () {

                    console.log(this.cate_fields);
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#m').change(function(){
                var y = $('#y').val();
                var m = $(this).val();
                var ym = y+'-'+pad(m,2);
                var meter_type_id = "{pigcms{$_meter_type_id}";
                window.location.href = app.U("",{meter_type_id:meter_type_id,ym:ym});

            });

            //补0函数
            function pad(num, n) {
                if ((num + "").length >= n) return num;
                return pad("0" + num, n);
            }

        });

    </script>

</block>
