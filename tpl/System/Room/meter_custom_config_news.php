<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="head">
    <style>
        .pointer {
            cursor: pointer;
        }
    </style>
</block>
<block name="body">



    <script type="text/x-template" id="config-template">
        <div v-if="store.state._active_num">
            <h4>必要配置</h4>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                <tr>
                    <th>desc</th>
                    <td><input type="text" class="form-control" v-model="model.desc"></td>
                </tr>
                <tr>
                    <th>sign</th>
                    <td><input type="text" class="form-control" v-model="model.sign"></td>
                </tr>
                <tr>
                    <th>unit_price</th>
                    <td><input type="text" class="form-control" v-model="model.unit_price"></td>
                </tr>
                <tr>
                    <th>unit</th>
                    <td><input type="text" class="form-control" v-model="model.unit"></td>
                </tr>
                <tr>
                    <th>rate</th>
                    <td><input type="text" class="form-control" v-model="model.rate"></td>
                </tr>
                <tr>
                    <th>village_id</th>
                    <td><input type="text" class="form-control" v-model="model.village_id"></td>
                </tr>
                </tbody>
            </table>
        </div>

    </script>


    <script type="text/x-template" id="custom-template">
        <div v-if="store.state._active_num">
            <h4><button class="btn btn-default" @click="addCustom()">添加自定义配置</button></h4>

            <table class="table table-striped table-bordered table-hover">
                <tbody>

                <template v-for="(item,index) in model">
                    <tr><td colspan="2" class="text-right" @click="del(item,index)">X</td></tr>
                    <tr>
                        <th>描述</th>
                        <td><input type="text" class="form-control" v-model="model[index].desc"></td>
                    </tr>
                    <tr>
                        <th>标识符</th>
                        <td><input type="text" class="form-control" v-model="model[index].key"></td>
                    </tr>
                    <tr>
                        <th>默认值</th>
                        <td><input type="text" class="form-control" v-model="model[index].val"></td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>

    </script>

    <script type="text/x-template" id="item-template">
        <li v-if="show">
            <div>
                <span class="pointer" v-bind:class="{'bg-info':isActive}"
                      @click="show_config()"
                >{{model.desc}}</span>
                <span @click="save(model)" v-bind:class="{'glyphicon glyphicon-floppy-disk':isActive}"></span>
                <span @click="del(model.id)"  v-bind:class="{'glyphicon glyphicon-remove-sign':isActive}"></span>
                <span @click="toggle" v-if="isFolder">[{{open ? '-' : '+'}}]</span>
            </div>
            <ul v-show="open" v-if="isFolder">
                <item
                        class="item"
                        v-for="model in model._child"
                        :model="model">
                </item>
                <li class="add" @click="addChild">+</li>
            </ul>
        </li>
    </script>

    <div id="demo" class="row">
        <div class="col-lg-4">
            <ul v-for="(item,index) in treeData">
                <item :model="item"></item>
            </ul>
            <ul class="add" @click="addIndex">+</ul>
        </div>



        <div class="col-lg-4">
            <config></config>
        </div>

        <div class="col-lg-4">
            <custom></custom>
        </div>


    </div>


</block>
<block name="script">
    <script>
        const store = new Vuex.Store({
            state: {
                _active_num: 0,
                edit_panel: {},
                custom_config: [],
                change:[], //发生改变的栏目的数组
            },
            mutations: {
                set_panel: function (state, model) {
                    state.edit_panel = model;
                },
                set_custom: function (state, model) {
                    state.custom_config = model;
                },
                add_custom: function (state) {
                    state.custom_config.push({key: "", val: "",desc:""});
                },
                set_change:function(state){
                    state.change.push(state._active_num);
                },
            }
        })
        /**
         * 左边树形结构
         **/
        Vue.component('item', {
            template: '#item-template',
            props: {
                model: Object
            },
            data: function () {
                return {
                    open: true,
                    editing: false,
                    active_num: Math.floor(Math.random() * 10000000),
                    show:true,
                }
            },
            computed: {
                isFolder: function () {
                    return this.model._child &&
                        this.model._child.length
                },
                isActive: function () {
                    return this.active_num === store.state._active_num;
                },
            },
            mounted: function () {

            },
            methods: {
                toggle: function () {
                    if (this.isFolder) {
                        this.open = !this.open;
                    }
                },
                changeType: function () {
                    if (!this.isFolder) {
                        Vue.set(this.model, '_child', []);
                        this.addChild();
                        this.open = true;
                    }
                },
                addChild: function () {
                    var data = {
                        desc: '新建类型',
                        custom_config: [],
                        pid:this.model.id,
                    }
                    this.model._child.push(data)
                },
                show_config: function () {
                    store.state._active_num = this.active_num;
                    store.commit('set_panel', this.model);
                    store.commit('set_custom', this.model.custom_config);
                },

                /**
                 * 保存配置
                 * @param model
                 */
                save:function(model){
                    var self = this;
                    this._post(app.U('save_config'),model,function(re){
                        if(re.err===0){
                            self.model.id = re.data.id;
                            alert("已保存");
                        }
                    });
                },
                del:function(config_id){
                    if(window.confirm("你确认删除？")){
                        this.show = false;
                        if(config_id){
                            this._get(app.U('del_config'),{config_id:config_id},function(re){
                                console.log(re);
                            });
                        }
                    };
                },

                //post 方法封装
                _post:function(url,params,callback){
                    this.$http.post(url,params).then(function(response){
                        // 响应成功回调
                        if(response.body.err==0){
                            callback(response.body);
                        }else{
                            alert("发生错误:"+response.body.msg);
                        }
                    }, function(response){
                        alert(response.status+" 发生错误");
                    });

                },
                //get 方法封装
                _get:function(url,params,callback){
                    var opt = {
                        'params':params
                    }
                    this.$http.get(url,opt).then(function(response){
                        // 响应成功回调
                        if(response.body.err==0){
                            callback(response.body);
                        }else{
                            console.log(response.body);
                            alert("发生错误");
                        }
                    }, function(response){
                        alert(response.status+" 发生错误");
                    });

                },

            },
        });
        /**
         * 配置面板
         */
        Vue.component('config', {
            template: '#config-template',
            computed: {
                model () {
                    return store.state.edit_panel
                }
            },
            mounted: function () {

            }

        })

        /**
         * 额外配置面板
         */
        Vue.component('custom', {
            template: '#custom-template',
            data: function () {

            },
            computed: {
                model(){
                    return store.state.custom_config
                }
            },
            methods: {
                addCustom: function () {
                    store.commit('add_custom');
                },
                del:function(item,index){
                    this.model.splice(index,1);
                }
            },
            watch:{

            }

        })

        var demo = new Vue({
            el: '#demo',
            data: {
                treeData: app_json.list
            },
            mounted: function () {

            },
            methods: {
                addIndex: function () {
                    this.treeData.push({
                        'desc': "新建设备"
                    });
                }
            }
        })
    </script>

</block>

