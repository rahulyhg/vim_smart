<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        /*.slide-fade-enter-active {*/
            /*transition: all 0.3s ease;*/
        /*}*/
        /*.slide-fade-leave-active {*/
            /*transition: all 0.8s cubic-bezier(1.0, 0.5, 0.8, 1.0);*/
        /*}*/
        /*.slide-fade-enter, .slide-fade-leave-to*/
            /*!* .slide-fade-leave-active for below version 2.1.8 *! {*/
            /*transform: translateX(10px);*/
            /*opacity: 0;*/
        /*}*/
    </style>
</block>
<block name="modal_body">
    <div id="modal_cate_meters">
        <transition name="slide-fade">
            <edit_meter_info :meter_info="meter_info" v-if="editing"></edit_meter_info>
            <div class="panel panel-default" v-else>
            <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;"> 设备列表</span>
            <a style="float: right" class="btn btn-primary"
               href="{pigcms{:U('modal_cate_bind_meter',array('cate_id'=>$cate_id))}"
               type="button" data-toggle="modal" data-target="#sub_modal">
                    绑定设备
                </a>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>设备码</th>
                        <th>楼层描述</th>
                        <th>止码</th>
<!--                        <th>额外属性</th>-->
                        <th colspan="1">操作</th>
                    </tr>
                    <tr v-for="(item,index) in meters">
                        <td>{{item.meter_code}}</td>
                        <td>{{item.meter_floor}}</td>
                        <td>{{item.be_cousume.split(',')[1]}}</td>
<!--                        <td>-->
<!--                            <table class="table table-bordered table-hover">-->
<!--                                <tr v-for="i in item.custom_info">-->
<!--                                    <th>{{i.desc}}</th>-->
<!--                                    <td>{{i.val}}</td>-->
<!--                                </tr>-->
<!--                            </table>-->
<!--                        </td>-->
                        <td>
                            <button type="button" class="btn btn-default btn-sm"
                                    @click="edit(item)"
                            >编辑</button>
                            &nbsp;
                            <button type="button" class="btn btn-danger btn-sm"
                                    @click="unbind_cate(item,index)"
                            >解绑</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <transition>


    </div>


</block>

<block name="modal_script">
<!--    編輯組件-->
    <script type="text/template" id="template_edit_meter_info">
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span style="vertical-align: bottom;line-height: 33px;">附加属性编辑</span>
                    <a style="float: right" class="btn btn-primary" type="button"  @click="stop_editing()">
                        返回
                    </a>
                    <div style="clear: both"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead></thead>
                        <tbody>
                        <tr>
                            <th>设备号</th>
                            <td>{{meter_info.meter_code}}</td>
                        </tr>
                        <tr>
                            <th>楼层</th>
                            <td>{{meter_info.meter_floor}}</td>
                        </tr>
                        <tr>
                            <th>止码</th>
                            <td>{{meter_info.be_cousume.split(",")[1]}}</td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover">
                        <thead></thead>
                        <tbody>
                        <tr v-for="(item,index) in meter_custom">
                            <th>{{item.desc}}</th>
                            <td v-if="item.type=='input_text'">
                                <input type="text" class="form-control" v-model="item.val">
                            </td>
                            <td v-if="item.type=='input_number'">
                                <input type="number" class="form-control" v-model="item.val">
                            </td>
                            <td v-if="item.type=='select'">
                                <select class="form-control" v-model="item.val">
                                    <option v-for="v in item.default_val.split(',')" v-bind:value="v">{{v}}</option>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <button style="float: right"  class="btn btn-default" @click="save()">保存</button>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </script>
    <!--    /編輯組件-->

    <script>
        Vue.use(Vuex);
        const store = new Vuex.Store({
            state: {
                meter_info:{},
                editing:0,
            },
            mutations: {
                set_meter_info:function(state,meter_info){
                    var meter_info = meter_info||{};
                    state.meter_info = meter_info;
                },
                change_edit_status:function (state,status) {
                    state.editing = status;
                }
            }
        });
        console.log(store);
        Vue.component('edit_meter_info',{
            template:"#template_edit_meter_info",
            props:{
                meter_info:Object
            },
            data:function(){
                return {
                    meter_custom:[],
                    meter_type_list:app_json.meter_type_list
                }
            },

            mounted:function(){
                this.set_meter_custom();
            },

            methods:{
                stop_editing:function(){
                    this.$store.commit('change_edit_status',0)
                },
                set_meter_custom:function(){
                    this.meter_custom = JSON.parse(JSON.stringify(this.meter_info.custom_info));
                },
                save:function(){
                    var self = this,
                        meter_custom = this.meter_custom;
                    console.log('save..');
                    this._post(app.U('save_meter_custom'),meter_custom,function(re){

                        if(re.err===0){
                            self.meter_info.custom_info = Object.assign(self.meter_info.custom_info,re.data)
                            alert("已保存")
                        }
                    });
                }
            }
        });








        var cate_meters = new Vue({
            el:'#modal_cate_meters',
            data:{
                meters:app_json.meters,
                cate_id:"{pigcms{$cate_id}"
            },
            store,
            computed:{
                meter_info:function(){
                    return this.$store.state.meter_info;
                },
                editing:function(){
                    return this.$store.state.editing;
                }
            },


            methods:{
                //编辑
                edit:function(item){
                    this.$store.commit('set_meter_info',item);
                    this.$store.commit('change_edit_status',1);
                },
                //解绑
                unbind_cate:function(item,index){
                    let self = this,
                        cate_id = this.cate_id,
                        meter_hash = item.meter_hash;

                    this._get(app.U('cate_unbind_meter_act'),{cate_id:cate_id,meter_hash:meter_hash},function(re){
                        if(re.err===0){
                            Vue.delete(self.meters,index);
                        }
                    });
                },
                //在綁定設備完成后重置設備列表
                reset_meters:function(){
                    let self = this;
                    this._get(app.U('modal_cate_meters'),{cate_id:self.cate_id,reset:1},function(re){
                        if(re.err===0){
                            self.$set(self,'meters',re.data);
                            self.$forceUpdate();
                        }
                    });
                },
            }
        });
    </script>
</block>