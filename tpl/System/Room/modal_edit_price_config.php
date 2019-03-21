<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <style>
        [v-clock]:{display:none}

    </style>
    <div v-cloak id="model_edit_price_config" >
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
        <price_config :price_model="price_config"></price_config>
    </div>

</block>
<block name="modal_footer">
    <button type="button" class="btn btn-primary" id="save">保存</button>
</block>

<block name="modal_script">
    <script type="text/template" id="price_config">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">{{price_model.desc}}</span>
                    <div style="clear: both"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>计费类型名称</th>
                            <td><input type="text" class="form-control" v-model="price_model.desc"></td>
                        </tr>
                        <tr>
                            <th>标记</th>
                            <td><input type="text" class="form-control" v-model="price_model.sign"></td>
                        </tr>
                        <tr>
                            <th>单价</th>
                            <td><input type="text" class="form-control" v-model="price_model.unit_price"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>
    <script>
        /**
         * 选项卡内容模板
         */
        Vue.component('price_config',{
            template:'#price_config',
            props:{
                price_model:Object,
            }
        });

        var model_edit_price_config = new Vue({
            el:"#model_edit_price_config",
            data:{
                config:app_json.config, //所有当前设备的计费类型
                config_index:0 //选项卡id
            },
            computed:{
                //当前计费配置
                price_config:function(){
                    return this.config[this.config_index];
                }
            },
            methods:{
                //保存操作
                submit: function() {
                    var self = this;
                    var form_data = this.price_config;
                    this._post(app.U('save_config'),form_data,function(re){
                        if(re.err==0){
                            //re.data是返回的数据库最新数据，将最新的数据更新到视图
                            self.$set(self.config,self.config_index,re.data);
                            //提示
                            alert("已保存")
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
                    }
                    //数据初始化
                    sub_config.desc = "新建计费配置";
                    sub_config.pid = this.config[0].pid;
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

        //从外部调用保存操作
        $('#save').click(function(){
            model_edit_price_config.submit();
        });
    </script>
</block>