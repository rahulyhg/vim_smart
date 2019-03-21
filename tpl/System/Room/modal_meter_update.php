<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <form action="{pigcms{:U('modal_meter_update')}" class="form-horizontal" method="post" id="formABC">
        <div id="add_meter">
            <!--<village-list
                    :list="village_list"
                    :village_id="meter_info.village_id">
            </village-list>-->
            <meter-type
                :tree="type_tree"
                :meter_type="meter_info.meter_type_id"
                :price_type="meter_info.price_type_id"
                :list="village_list"
                :village_id="meter_info.village_id"
                :room_list_all="room_list"
                :foor="meter_info.floor"
                :rooms="meter_info.rooms">
            </meter-type>
            <!--<room-list
                    :list="room_list"
                    :foor="meter_info.floor"
                    :rooms="meter_info.rooms">
            </room-list>-->
            <custom-config
                :custom_config="meter_info.custom_config"
            >
            </custom-config>
            
            <!-- 修改一 -->
            <div class="form-group form-md-line-input" id="public_check">
                <label class="col-md-2 control-label" for="form_control_1">是否为公区设备
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="is_public" class="form-control">
                        <option value="0" <if condition="$metersArr['is_public'] eq 0">selected</if>>非公区</option>
                        <option value="1" <if condition="$metersArr['is_public'] eq 1">selected</if>>公区</option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>


            <!--        设备码-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">设备码
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="" name="meter_code" value="{pigcms{$metersArr.meter_code}">
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <!-- 修改二 -->
            <div class="form-group form-md-line-input" id="rate_check">
                <label class="col-md-2 control-label" for="form_control_1">默认倍率
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" placeholder="" value="{pigcms{$metersArr.rate}" name="rate"><div class="form-control-focus"></div>
                </div>
            </div>

            <input type="hidden" name="meters_id" id="meters_id" value="{pigcms{$metersArr.id}" >
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="button" class="btn green" onclick="sss()">确认提交</button>
                        <button type="reset" class="btn default">清空重填</button>
                        <php>$list_url = U('meterlist_news')</php>
                        <button type="button" onclick="window.location.href='{pigcms{$list_url}'" class="btn default">返回</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</block>
<block name="script">
    <!--    设备类型模板-->
    <script type="text/x-template" id="meter_type">
        <div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">社区选择
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="village_id"  v-bind:readonly="is_admin" class="form-control" v-bind:style="{ background:backgroundcolor }" v-model="selected_village_id" v-bind:disabled="is_admin">
                        <option value="0">请选择</option>
                        <option v-for="(desc,village_id) in list" v-bind:value="village_id">{{desc}}</option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">设备类型
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="meter_type_id" class="form-control" v-model="selected_meter_type" id="meter_type_id" onchange="check_id(this)">
                        <option value="">请选择</option>
                        <option v-for="(type,index) in tree" v-bind:value="type.id">{{type.desc}}</option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <!-- 修改三 -->
            <div class="form-group form-md-line-input" id="price_type">
                <label class="col-md-2 control-label" for="form_control_1">默认计费类型
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="price_type_id" id="" class="form-control" v-model="selected_price_type">
                        <option value="">请选择</option>
                        <option v-for="(type,index) in price_type_list" v-bind:value="type.id">{{type.desc}}</option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">楼层单元
                    <span class="required">*</span>
                </label>
                <div class="col-md-4">
                    <select class="form-control" v-model="selected_floor_id" name="floor_id">
                        <option value="">请选择</option>
                        <option v-for="(floor,index) in floor_list" v-bind:value="floor.id">{{floor.floor_name}}</option>
                    </select>
                    <div class="form-control-focus"></div>
                </div>
                <div class="col-md-4">
                    <label>请选择单元：</label>
                   <label class="checkbox-inline"  v-for="(room,index) in room_list">-->
                        <input type="checkbox" name="room_id[]" :checked="selected_room_id.indexOf(room.id)!=-1"  class="md-check" v-bind:value="room.id">
                       {{room.room_name}}
                    </label>
                    <div class="form-control-focus"></div>
               </div>
            </div>
            <!-- <div style="border: 1px solid gray; width: 100px; height: 35px; line-height: 35px; color: gray;"><div id="meter_config" style="width: 100%"; onclick="click()">设备基本配置</div></div> -->
            
        </div>
    </script>
    <!--    社区模板-->
    <!--<script type="text/x-template" id="village_list">
        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">社区选择
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <select name="village_id"  readonly="readonly" class="form-control" v-model="selected_village_id">
                    <option value="">请选择</option>
                    <option v-for="(desc,village_id) in list" v-bind:value="village_id">{{desc}}</option>
                </select>
                <div class="form-control-focus"> </div>
            </div>
        </div>
    </script>-->
    <!--    楼层单元模板-->
    <!--<script type="text/x-template" id="room_list">
        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">楼层单元
                <span class="required">*</span>
            </label>
            <div class="col-md-4">
                <select class="form-control" v-model="selected_floor_id" name="floor_id">
                    <option value="">请选择</option>
                    <option v-for="(floor,index) in floor_list" v-bind:value="floor.id">{{floor.floor_name}}</option>
                </select>
                <div class="form-control-focus"></div>
            </div>
            <div class="col-md-4">
                <label>请选择单元：</label>
                <label class="checkbox-inline"  v-for="(room,index) in room_list">
                    <input type="checkbox" name="room_id[]" v-model="selected_room_id"  class="md-check" v-bind:value="room.id">
                    {{room.room_name}}
                </label>
                <div class="form-control-focus"></div>
            </div>
        </div>
 </script>-->
    <!--    自定义设备设置模板-->
    <script type="text/x-template" id="custom_config">
        <div>
            <div class="form-group form-md-line-input" v-for="(item,index) in config_list">
                <label class="col-md-2 control-label" for="form_control_1">{{item.desc}}
                    <span class="required">*</span>
                </label>

                <div class="col-md-9" v-if="item.type=='input_text'">
                    <input type="text" class="form-control" v-bind:name="'custom_id['+item.id+']'"  v-bind:value="item.val" />
                    <div class="form-control-focus"></div>
                </div>
                <div class="col-md-9" v-if="item.type=='input_number'">
                    <input type="text" class="form-control" v-bind:name="'custom_id['+item.id+']'"  v-bind:value="item.val" />
                    <div class="form-control-focus"></div>
                </div>
                <div class="col-md-9" v-if="item.type=='select'">
                    <select class="form-control" v-bind:name="'custom_id['+item.id+']'" >
                        <option v-for="val in item.val.split(',')"  v-bind:value="val">{{val}}</option>
                    </select>
                    <div class="form-control-focus"></div>
                </div>
            </div>
        </div>
    </script>


    <script>
        window.onload = function(){
            // var meter_type = 'selected_meter_type';
            // $('#meter_type_id').attr("v-model",meter_type);
            var config_id = document.getElementById("meter_type_id").value;
            // console.log(meter_type);            
            // var meters_id = document.getElementById("meters_id").value;
            // $.ajax({
            //     url:'{pigcms{:U("get_meter_custom")}',
            //     type:'get',
            //     data:{'config_id':config_id,'meters_id':meters_id},
            //     success:function (res) {}
            // });

            if (config_id == 113) {
                document.getElementById('price_type').style.display="none";
                document.getElementById('public_check').style.display="none";
                document.getElementById('rate_check').style.display="none";
            }
        }

        function check_id(v){
            var id = v.value;
            // console.log(id);
            $.ajax({
                url:'{pigcms{:U("check_id")}',
                type:'post',
                data:{'id':id},
                success:function (res) {
                    // console.log(res);
                     if (res) {
                        // console.log(1);
                        document.getElementById('price_type').style.display="none";
                        document.getElementById('public_check').style.display="none";
                        document.getElementById('rate_check').style.display="none";
                    } else {
                        // console.log(2);
                        document.getElementById('price_type').style.display="block";
                        document.getElementById('public_check').style.display="block";
                        document.getElementById('rate_check').style.display="block";
                    }
                }
            });
        }
    </script>

    <script>
        function click(){
            console.log(1);
            var mButton=document.getElementById("meter_config");
            mButton.onclick = function() {
                console.log(2);
            }
            // console.log(selected_meter_type);
            // $('#meter_type_id').attr("v-model",'');
            // $('#meter_type_id').attr("v-model",selected_meter_type);
        }
    </script>

    <!--   JS代码-->
    <script>
        Vue.use(Vuex);
        const store = new Vuex.Store({
            state: {
                'config_id':-1,
            },
            mutations: {
                set_config_id:function(state,config_id){
                    config_id = config_id||-1;
                    state.config_id = config_id;
                }
            }
        })
        //        设备社区二合一
        Vue.component('meter-type', {
            template: '#meter_type',
            props:{
                tree:Object,
                list:Object,
                room_list_all:Object
            },
            data:function(){
                return {
                    'selected_meter_type':"{pigcms{$metersArr.meter_type_id}",
                    'selected_price_type':"{pigcms{$metersArr.price_type_id}",
                    selected_village_id:app_json.village_id,
                    is_admin:app_json.is_admin,
                    selected_floor_id:"{pigcms{$metersArr.floor_id}",
                     selected_room_id:"{pigcms{$metersArr.room_id}".split(','),
                }
            },
            computed:{
                price_type_list:function(){
                    var price_type_list = {};
                    for(var i in this.tree){
                        if(this.tree[i].id == this.selected_meter_type ){
                            price_type_list = this.tree[i].price_type_list;
                            break;
                        }
                    }
                    return price_type_list;
                },
                backgroundcolor:function () {
                    if(this.is_admin){
                        return '#EEEEEE';
                    }else{
                        return '#FFFFFF';
                    }
                },
                floor_list:function(){
                    var floor_list = [];
                    for(var i in this.room_list_all){
                        if(this.room_list_all[i].fid==0){
                            floor_list.push(this.room_list_all[i]);
                        }
                    }
                    return floor_list;
                },
                 room_list:function(){
                     var floor_id = this.selected_floor_id;
                     var room_list = [];
                     for(var i in this.room_list_all){
                         if(this.room_list_all[i].fid==floor_id){
                             room_list.push(this.room_list_all[i]);
                         }
                     }
                     return room_list;
                 }

            },
            watch:{
                selected_village_id:function(){
                    var village_id = this.selected_village_id;
                    var type_tree='';
                    $.ajax({
                        url:"{pigcms{:U('add_meter_ajax')}",
                        type:'post',
                        data:{'village_id':village_id},
                        dataType:'json',
                        async:false,
                        success:function(res){
                            type_tree=res.data;
                            roomajax_list=res.room_list;
                        }
                    });
                    this.tree=type_tree;
                    this.room_list_all=roomajax_list;
                    // console.log(type_tree);
                },
                selected_price_type:function(){
                    var config_id = this.selected_price_type;
                    store.commit('set_config_id',config_id);
                },
                selected_meter_type:function(){
                    var config_id = this.selected_meter_type;
                    store.commit('set_config_id',config_id);
                }
            },
            mounted:function(){

            }
        });
        //        社区
        /* Vue.component('village-list', {
             template: '#village_list',
             props:{
                 list:Object,
             },
             data:function(){
                 return {
                     selected_village_id:app_json.village_id
                 }
             },
             watch:{
                 selected_village_id:function(){
                     var village_id = this.selected_village_id;
                     console.log(village_id);
                 }
             },
             mounted:function(){
                 console.log(app_json.village_id);
             }
         });*/

        //        楼层
        /*Vue.component('room-list', {
            template: '#room_list',
            props:{
                list:Object,
            },
            data:function(){
                return {
                    selected_floor_id:"",
                    selected_room_id:[],
                }
            },
            computed:{
                 floor_list:function(){
                    var floor_list = [];
                    for(var i in this.list){
                        if(this.list[i].fid==0){
                            floor_list.push(this.list[i]);
                        }
                    }
                    return floor_list;
                 },
                 room_list:function(){
                    var floor_id = this.selected_floor_id;
                    var room_list = [];
                    for(var i in this.list){
                        if(this.list[i].fid==floor_id){
                            room_list.push(this.list[i]);
                        }
                    }
                    return room_list;
                 }
            },
            mounted:function(){

            }
        });*/
        //        自定义配置项
        Vue.component('custom-config', {
            template: '#custom_config',
            data:function(){
                return {
                    config_list:[],
                }
            },
            props:{

            },

            methods:{
                set_custom_config:function (config_id) {
                    var self = this;
                    var meters_id = document.getElementById("meters_id").value;
                    if(config_id === -1) return [];

                    this._get(app.U('get_meter_custom'),{config_id:config_id,meters_id:meters_id},function(re){
                        self.config_list = re.data;
                        console.log(re.data);
                    });
                },
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
            computed:{
                config_id:function(){
                    var config_id = store.state.config_id;
                    return config_id;
                },
            },
            watch:{
                config_id:function(config_id){
                    this.set_custom_config(config_id);
                }
            },
            mounted:function(){
                var meter_hash = "{pigcms{:I('get.meter_hash')}";
                if(meter_hash){
                    this.meter_info = app_json.meter_info;
                }

            }
        });

        //实例
        new Vue({
            el:"#add_meter",
            data:{
                village_list:app_json.village_list,
                type_tree:app_json.type_tree,
                room_list:app_json.room_list,
                meter_info:{}
            },
        });
    </script>
    <script>
        function sss() {
            if(confirm("确定提交吗？请谨慎执行")==false){
                return false;
            } else {
                $("#formABC").submit();
            }
        }
    </script>
</block>