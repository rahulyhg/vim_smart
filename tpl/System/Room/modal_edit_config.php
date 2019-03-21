<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="model_edit_config">
        <form action=""  @submit.prevent="submit" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">必要配置</span>
                    <!-- <input id="change_type" type="checkbox" style="margin-bottom: 9px;" v-model="is_set"/>  -->
                    <div style="clear: both"></div>
                </div><!--<if condition="$is_set == true">checked</if>  v-show="display_cache['2']"-->
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>设备（类型）名称</th>
                                <td><input type="text" class="form-control" v-model="config.desc"></td>
                            </tr>
                            <tr>
                                <th>标记</th>
                                <td><input type="text" class="form-control" v-model="config.sign"></td>
                            </tr>
                            <tr v-if="config.pid!=0">
                                <th>单价</th>
                                <td><input type="text" class="form-control" v-model="config.unit_price"></td>
                            </tr>
                            <tr v-if="config.pid==0">
                                <th>单位</th>
                                <td><input type="text" class="form-control" v-model="config.unit"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="config.pid==0"  class="panel panel-default">
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">自定义配置</span>
                    <button style="float: right" class="btn btn-primary" type="button"
                    @click="add_custom()">
                        添加自定义配置
                    </button>
                    <div style="clear: both"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" v-if="config.custom_config.length>0">
                        <thead>
                        <tr>
                            <th>描述</th>
                            <th>标记</th>
                            <th>类型</th>

                            <th>默认值</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in config.custom_config">
                                <td><input type="text" class="form-control" v-model="item.desc"></td>
                                <td><input type="text" class="form-control" v-model="item.key"></td>
                                <td>
                                    <select class="form-control" v-model="item.type">
                                        <option v-for="type in custom_form_type" v-bind:value="type.sign">
                                            {{type.name}}
                                        </option>
                                    </select>
                                </td>

                                <td>
                                    <input type="text" class="form-control" v-model="item.val" v-if="item.type=='input_text'" >
                                    <input type="number" class="form-control" v-model="item.val" v-if="item.type=='input_number'" >
                                    <textarea class="form-control" v-model="item.val" v-if="item.type=='select'"cols="30" rows="3"
                                              placeholder="设置下拉菜单选项的值，请使用英文逗号分隔。 example:选项1,选项2,选项3"></textarea>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type="button" @click="del_custom(index)">删除</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>
    <div id="model_edit_price_config">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">社区选择</span>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <select name="village_id"  readonly="readonly" class="form-control" v-model="selected_village_id" style="width: 50%;"><!---->
                    <!--去除通用类目-->
                    <!--<option value="0">通用</option>-->
                    <option v-for="(village_name,village_id) in list" v-bind:value="village_id">{{village_name}}</option>
                </select>
            </div>
        </div>

        <if condition="$config_id == 113">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span style="vertical-align: bottom;line-height: 33px;">参数配置</span>
                        
                        <div style="clear: both"></div>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li role="presentation" v-for="(item,index) in config" :class="{active:config_index==index}" @click="config_index=index">
                                <a href="#">
                                    {{item.desc}}
                                    <span
                                            class="glyphicon glyphicon-minus-sign"
                                            aria-hidden="true"
                                            v-if="can_del(index,item.id)"
                                            @click="del_price_config(item,index)"
                                            title="删除该参数类型"
                                    ></span>
                                </a>
                            </li>
                            <li role="presentation" @click="add_price_config()">
                                <a href="#">
                                    <span title="添加参数类型" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                        <price_config2 :price_model="price_config" :list="village_list" :config="config"></price_config2>            
                    </div>
                </div>
            </div>
        <else/>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span style="vertical-align: bottom;line-height: 33px;">计费配置</span>
                        
                        <div style="clear: both"></div>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li role="presentation" v-for="(item,index) in config" :class="{active:config_index==index}" @click="config_index=index">
                                <a href="#">
                                    {{item.desc}}
                                    <span
                                            class="glyphicon glyphicon-minus-sign"
                                            aria-hidden="true"
                                            v-if="can_del(index,item.id)"
                                            @click="del_price_config(item,index)"
                                            title="删除该计费类型"
                                    ></span>
                                </a>
                            </li>
                            <li role="presentation" @click="add_price_config()">
                                <a href="#">
                                    <span title="添加计费类型" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                        <price_config :price_model="price_config" :list="village_list" :config="config"></price_config>            
                    </div>
                </div>
            </div>
        </if>            

    </div>
</block>
<block name="modal_footer">
    <button type="button" class="btn btn-primary" id="save">保存</button>
</block>
<block name="modal_script">
<!--必要配置与自定义配置-->
<script>
    var model_edit_config =  new Vue({
        el:'#model_edit_config',
        data:{
            config:app_json.config,
            custom_form_type:[
                {name:"纯文本",    sign:'input_text'},
                {name:"数字",      sign:'input_number'},
                {name:"下拉菜单",  sign:'select'},
            ],
            // is_set:{pigcms{$is_set},
        },
        // computed:{
        //     display_cache:function(){
        //         var is_set=this.is_set;
        //         var display_cache=new Array;
        //         display_cache['1']=!is_set;
        //         display_cache['2']=!is_set;
        //         // display_cache['3']=is_set;
        //         // display_cache['4']=!is_set;
        //         return display_cache;
        //     }
        // },
        methods: {
            submit: function() {
                var form_data = this.config; // 这里才是你的表单数据
                this._post(app.U('save_config'),form_data,function(re){
                    if(re.err==0){

                    }else{
                        alert("发生错误");
                    }
                });
            },
            //删除自定义配置
            del_custom:function(index){
                Vue.delete(this.config.custom_config,index);
            },
            //添加自定义配置
            add_custom:function(){
                var arr = {
                    desc:"",
                    key:"",
                    val:"",
                    type:"input_text",
                }
                this.config.custom_config.push(arr);
            }
        },

        mounted:function(){
            console.log(this.config);
        }
    });
</script>
<!--计费类型配置-->
<script type="text/template" id="price_config">
    <table class="table table-striped table-bordered table-hover">
        <tbody>    
            <tr>
                <th colspan="2">计费类型名称<span style="color:red">*</span></th>               
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.desc" required></td>
            </tr>
            <tr style="display: none;" >
                <!--<th>社区选择
                </th>
                <th>
                    <select name="village_id"  readonly="readonly" class="form-control" v-model="price_model.village_id">
                        <option value="0">通用</option>
                        <option v-for="(village_name,village_id) in list" v-bind:value="village_id">{{village_name}}</option>
                    </select>
                </th>-->
                <td>1</td>
                <td><input type="text" class="form-control" v-model="price_model.village_id" ></td>
            </tr>
            <tr>
                <th colspan="2">标记<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.sign" required></td>
            </tr>
            <tr>
                <th colspan="2">单价<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.unit_price" required></td>
            </tr>
        </tbody>      
    </table>  
</script>

<!--参数类型配置-->
<script type="text/template" id="price_config2">
    <table class="table table-striped table-bordered table-hover">
        <tbody>    
            <tr>
                <th colspan="2">参数类型名称<span style="color:red">*</span></th>               
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.desc" required></td>
            </tr>
            <tr style="display: none;" >
                <!--<th>社区选择
                </th>
                <th>
                    <select name="village_id"  readonly="readonly" class="form-control" v-model="price_model.village_id">
                        <option value="0">通用</option>
                        <option v-for="(village_name,village_id) in list" v-bind:value="village_id">{{village_name}}</option>
                    </select>
                </th>-->
                <td>1</td>
                <td><input type="text" class="form-control" v-model="price_model.village_id" ></td>
            </tr>
            <tr>
                <th colspan="2">标记<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.sign" required onchange="check_sign(this)"></td>
            </tr>
            <!-- <tr>
                <th colspan="2">单价<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.unit_price" required></td>
            </tr> -->
        </tbody>      
    </table>  
</script>

<script>
    
    /**
     * 选项卡内容模板
     */
    Vue.component('price_config',{
        template:'#price_config',
        props:{
            price_model:Object,
            list:Object,
        },
        methods:{//添加的分类操作属于子类，所以要放在这里
            //删除自定义配置
            del_custom:function(index){
                Vue.delete(this.price_model.parameters,index);
            },
            //添加自定义配置
            add_custom:function(){
                var arr = {
                    desc:"",
                    sign:"",
                }
                this.price_model.parameters.push(arr);
            }
        }
    });

    /**
     * 选项卡内容模板
     */
    Vue.component('price_config2',{
        template:'#price_config2',
        props:{
            price_model:Object,
            list:Object,
        },
        methods:{//添加的分类操作属于子类，所以要放在这里
            //删除自定义配置
            del_custom:function(index){
                Vue.delete(this.price_model.parameters,index);
            },
            //添加自定义配置
            add_custom:function(){
                var arr = {
                    desc:"",
                    sign:"",
                }
                this.price_model.parameters.push(arr);
            }
        }
    });

    var model_edit_price_config = new Vue({
        el:"#model_edit_price_config",
        data:{
            config_village:app_json.price_configs,
            selected_village_id:app_json.village_id,
            config:app_json.price_configs[app_json.village_id], //所有当前设备的计费类型
            list:app_json.village_list,
            config_index:0, //选项卡id
            
        },
        computed:{
            //当前计费配置
            price_config:function(){
                return this.config[this.config_index];
            },
            village_list:function(){
                return this.list;
            },
            // display_cache:function(){
            //     var is_set=this.is_set;
            //     var display_cache=new Array;
            //     display_cache['3']=!is_set;
            //     display_cache['4']=is_set;
            //     // display_cache['5']=is_set;
            //     // display_cache['6']=!is_set;
            //     return display_cache;
            // }
        },
        watch:{
            selected_village_id:function(){
                var village_id = this.selected_village_id;
                var config=this.config_village[village_id];
                this.config=config;
            }
        },
        methods:{
            //保存操作
            submit: function() {
                var self = this;
                var form_data = this.price_config;
                console.log(form_data);
                this._post(app.U('save_config'),form_data,function(re){
                    if(re.err==0){
                        //re.data是返回的数据库最新数据，将最新的数据更新到视图
                        self.$set(self.config,self.config_index,re.data);
                        //提示
                        alert("已保存");
                        window.location.reload();
                        // console.log(re.data);
                    }
                });
            },
            //添加计费配置
            add_price_config(){
                //数据格式
                var sub_config = {
                    cate: [],
                    custom_config: [],
                    desc: "",
                    pid: "",
                    rate: 0,
                    sign: "",
                    unit: "",
                    unit_price: 0.00,
                    village_id: this.selected_village_id
                }
                //数据初始化
                sub_config.pid = this.config[0].pid;               
                sub_config.desc = "新建计费配置";                               
                // sub_config.desc = "新建计费配置";
                this.config.push(sub_config);
                //选显卡菜单选择新建计费配置
                this.config_index =  this.config.length-1;
            },
            //删除计费配置
            del_price_config(item,index){
                if(window.confirm("你确定要删除")){
                    var self = this;
                    this._get(app.U('del_config'),{config_id:item.id},function(re){
                        if(re.err==0){
                            Vue.delete(self.config,index);//删除视图
                            self.config_index =self.config.length-1;//定位到最后一个选项卡
                        }else{
                            alert("发生错误");
                        }
                    });
                }
            },
            //是否可以删除，新建的计费配置，在没有保存的情况下是不能删除的
            can_del:function(index,config_id){
                return config_id && this.config_index == index;
            }
        }
    });

</script>

<!--保存操作-->
<script>
    $('#save').click(function(){
        model_edit_config.submit();
        model_edit_price_config.submit();
    });
</script>

<script>
    //添加标记时判断是否存在
    function check_sign(v){
        var sign = v.value;
        // console.log(sign);
        $.ajax({
             url:'{pigcms{:U("check_sign")}',
             type:'post',
             data:{'sign':sign},
             success:function (res) {
                 if (res) {
                    alert('该标记已存在，请重新输入');
                    $(v).val("");
                 }
             }
         });
    }
</script>

<!-- <script>
$(function(){

});
</script> -->

</block>