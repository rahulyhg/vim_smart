<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="model_edit_cate">
        <form action=""  @submit.prevent="submit" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">必要配置</span>
                    <div style="clear: both"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>名称</th>
                            <td><input type="text" class="form-control" v-model="cate.desc"></td>
                        </tr>
                        <tr>
                            <th>标记</th>
                            <td><input type="text" class="form-control" v-model="cate.sign"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default" style="height: 54px;">
                <span style="float: left; line-height: 54px; margin-left: 15px;">自定义模板：</span>
                <div class="radio" style="float: left; margin-top: 10px;">
                    <!-- var_dump(:{pigcms{$meter_type_id}) -->
                    <label>
                      <input type="radio" name="r1" value="1" <if condition="$meter_type_id neq 113">checked=""</if>/>
                      <span class="option"><span class="option-span"></span></span><!--优化后的单选框样式-->
                      <span>模板一</span>
                    </label>
                </div>
                <div class="radio" style="float: left; margin-top: 10px; margin-left: 5px;">
                    <label>
                        <input type="radio" name="r1" value="2" <if condition="$meter_type_id eq 113">checked=""</if>/>
                        <span class="option"><span class="option-span" ></span></span><!--优化后的单选框样式-->
                        <span>模板二</span>
                    </label>
                </div>                  
            </div>
            <div  class="panel panel-default" id="parameters_config" <if condition="$meter_type_id eq 113">style="display: none;"</if>>
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">自定义配置</span>
                    <button style="float: right" class="btn btn-primary" type="button"
                            @click="add_custom()">
                        添加自定义配置
                    </button>
                    <div style="clear: both"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" v-if="cate.custom_config.length>0">
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
                        <tr v-for="(item,index) in cate.custom_config">
                            <td><input type="text" class="form-control" v-model="item.desc"></td>
                            <td><input type="text" class="form-control" v-model="item.key" onchange="check_key(this)"></td>
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
    <div id="model_edit_price_config" <if condition="$meter_type_id neq 113">style="display: none;"</if>>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">参数配置</span>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li role="presentation" v-for="(item,index) in cate.custom_config" :class="{active:config_index==index}" @click="config_index=index">
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
                <price_config1 :price_model_list="cate.custom_config"  :index="config_index" :config="cate.custom_config.parameters"></price_config1>            
            </div>
        </div>
    </div>
</block>

<block name="modal_footer">
    <button type="button" class="btn btn-primary" id="save">保存</button>
</block>

<block name="modal_script">
    <!--必要配置与自定义配置-->
    <script>
        var model_edit_cate =  new Vue({
            el:'#model_edit_cate',
            data:{
                cate:app_json.cate,
                custom_form_type:[
                    {name:"纯文本",    sign:'input_text'},
                    {name:"数字",      sign:'input_number'},
                    {name:"下拉菜单",  sign:'select'},
                ]
            },
            methods: {
                submit: function() {
                    var form_data = this.cate; // 这里才是你的表单数据
                    this._post(app.U('save_cate'),form_data,function(re){
                        if(re.err==0){
                            alert("已保存");
                        }else{
                            alert("发生错误");
                        }
                    });
                },               
                //删除自定义配置
                del_custom:function(index){
                    console.log(1);
                    console.log(index);
                    Vue.delete(this.cate.custom_config,index);
                },
                //添加自定义配置
                add_custom:function(){
                    var arr = {
                        desc:"",
                        key:"",
                        val:"",
                        type:"input_text",
                    }
                    this.cate.custom_config.push(arr);
                }
            },

            // mounted:function(){
            //     console.log(this.cate);
            // }
        });
    </script>

    <!-- <script>
        $('#save').click(function(){
            model_edit_cate.submit();
        });
    </script> -->

<!--参数类型配置-->
<script type="text/template" id="price_config1">
    <table class="table table-striped table-bordered table-hover">
        <tbody >
            <tr >
                <th colspan="2">参数类型名称<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.desc" required></td>
            </tr>
            <tr>
                <th colspan="2">标记<span style="color:red">*</span></th>
                <td colspan="2"><input type="text" class="form-control" v-model="price_model.key" required onchange="check_key(this)"></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="panel-heading">
                        <span style="vertical-align: bottom;line-height: 33px;">自定义参数配置</span>
                        <button style="float: right" class="btn btn-primary" type="button"
                        @click="add_custom1()">
                            添加自定义配置
                        </button>
                        <div style="clear: both"></div>
                    </div>
                </td>            
            </tr>
            <tr style="text-align: center;" v-for="(item,index) in price_model.parameters">
                <th>参数<span style="color:red">*</span></th>
                <td><input type="text" class="form-control" v-model="item.desc" placeholder="请输入参数名称"></td>
                <td><input type="text" class="form-control" v-model="item.key" placeholder="请输入参数标记" v-bind:id="item.id" onchange="check_key(this)"></td>
                <td><button class="btn btn-danger btn-sm" type="button" @click="del_custom1(index)">删除</button></td>
            </tr>                  
        </tbody>      
    </table>  
</script>

<script>
    
    /**
     * 选项卡内容模板
     */
    Vue.component('price_config1',{
        template:'#price_config1',
        props:{
            price_model_list:Object,
             index:Object,
        },
        computed:{
            price_model:function(){
                return this.price_model_list[this.index];
            },
        },
        // cate:app_json.cate,
        methods:{//添加的分类操作属于子类，所以要放在这里
            //删除自定义配置
            del_custom1:function(index){
                console.log(2);
                console.log(index);
                Vue.delete(this.price_model.parameters,index);
            },
            //添加自定义配置
            add_custom1:function(){
                // console.log(this.price_model);
                // console.log(this.price_model['key']);
                var arr = {
                    desc:"",
                    key:"",
                }
                this.price_model.parameters.push(arr);
            }
        }
    });
    var model_edit_price_config = new Vue({
        el:"#model_edit_price_config",
        data:{
            // config_village:app_json.price_configs,
            // selected_village_id:app_json.village_id,
            // config:app_json.price_configs[app_json.village_id], //所有当前设备的计费类型
            // list:app_json.village_list,
            // config_index:0, //选项卡id
            cate:app_json.cate,
            parameter_cate:app_json.cate.custom_config,
            config_index:0, //选项卡id
            
        },
        computed:{
            //当前参数配置
            price_config:function(){
                return this.cate.custom_config[this.config_index];
            },
            // village_list:function(){
            //     return this.list;
            // },
        },
        // watch:{
        //     selected_village_id:function(){
        //         var village_id = this.selected_village_id;
        //         var config=this.config_village[village_id];
        //         this.config=config;
        //     }
        // },
        methods:{
            //保存操作
            submit: function() {
                var form_data = this.cate; // 这里才是你的表单数据
                this._post(app.U('save_cate'),form_data,function(re){
                    if(re.err==0){
                        alert("已保存");
                        window.location.reload();
                    }else{
                        alert("发生错误");
                    }
                });
            },
            //添加计费配置
            add_price_config(){
                //数据格式
                var sub_config = {
                    // parameters: [],
                    // custom_config: [],
                    key: "",
                    val: "",
                    config_id: 0,
                    cate_id: "",
                    pid: 0,
                    sort: 0,
                    create_time: 0,
                    type: "input_text",
                    // desc: "新建参数配置"
                }
                //数据初始化
                sub_config.desc = "新建参数配置";               
                // sub_config.desc = "新建计费配置";
                this.cate.custom_config.push(sub_config);
                //选显卡菜单选择新建计费配置
                this.config_index =  this.cate.length-1;
            },
            //删除计费配置
            del_price_config(item,index){
                if(window.confirm("你确定要删除")){
                    var self = this;
                    this._get(app.U('del_meter_cate'),{cate_id:item.id},function(re){
                        // console.log(re);
                        if(re.err==0){
                            Vue.delete(self.cate.custom_config,index);//删除视图
                            self.config_index =self.cate.custom_config.length-1;//定位到最后一个选项卡
                        }else{
                            alert("发生错误");
                        }
                    });
                }
            },
            //是否可以删除，新建的计费配置，在没有保存的情况下是不能删除的
            can_del:function(index,cate_id){
                return cate_id && this.config_index == index;
            }
        }
    });

</script>

<!--保存操作-->
<script>
    $('#save').click(function(){
        // model_edit_cate.submit();
        model_edit_price_config.submit();
    });
</script>

<script>
    //添加标记时判断是否存在
    function check_key(v){
        var key = v.value;
        console.log(key);
        $.ajax({
             url:'{pigcms{:U("check_key")}',
             type:'post',
             data:{'key':key},
             success:function (res) {
                 if (res) {
                    alert('该标记已存在，请重新输入');
                    $(v).val("");
                 }
             }
         });
    }
</script>

<script>
    $('input[name="r1"]').change(function(){
        if ($('input[name="r1"][value="1"]').prop("checked")) {
            // console.log(1);
            document.getElementById('parameters_config').style.display="";
            document.getElementById('model_edit_price_config').style.display="none";
       } else { 
            // console.log(2);          
            document.getElementById('parameters_config').style.display="none";
            document.getElementById('model_edit_price_config').style.display="";
       }
    });
</script>
</block>
