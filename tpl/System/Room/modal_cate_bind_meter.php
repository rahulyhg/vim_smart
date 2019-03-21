<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="modal_cate_bind_meter">
        <cate_bind_meter :cate_id="{pigcms{$cate_id}" :meter_type_id="{pigcms{$meter_type_id}"></cate_bind_meter>
    </div>
</block>
<block name="modal_script">
<!--    绑定模板-->
    <script type="text/template" id="template_cate_bind_meter">
        <div>
            <form class="form-inline">
                <!-- 楼层-->
                <select class="form-control" v-model="selected_floor_id">
                    <option value="">楼层</option>
                    <option v-for="(item,index) in floor_list" v-bind:value="index">{{item}}</option>
                </select>
                <!--搜索-->
                <input type="text" v-model="keywords" class="form-control" placeholder="搜索：描述/编号/止码">
            </form>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>设备类型</th>
                    <th>楼层描述</th>
                    <th>设备编号</th>
                    <th>止码</th>
                    <th>用途</th>
                    <th>绑定</th>
<!--                    <th>编辑</th>-->
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in meter_list" v-show="filter(item)">
                    <td>{{meter_type_list[item.meter_type_id]}}</td>
                    <td>{{item.meter_floor||"未知楼层"}}</td>
                    <td>{{item.meter_code}}</td>
                    <td>{{item.be_cousume.split(",")[1]}}</td>
                    <td>
                        <p v-for="desc in str2arr(item.cate_desc)">
                            {{desc}}
                        </p>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default btn-sm"
                        v-if="can_bind(item)"
                        @click="bind_cate(item)"
                        >绑定</button>
                        <button type="button" class="btn btn-danger btn-sm"
                                v-else
                                @click="unbind_cate(item)"
                        >解绑</button>
                    </td>
<!--                    <td>-->
<!--                        <button type="button" class="btn btn-default btn-sm"-->
<!--                                v-if="item.cate_id"-->
<!--                                @click="edit(item)"-->
<!--                        >编辑</button>-->
<!--                    </td>-->
                </tr>
                </tbody>
            </table>
        </div>
    </script>
    <script>
        Vue.component('cate_bind_meter',{
            template:'#template_cate_bind_meter',
            data:function(){
                return {
                    meter_list:[],
                    floor_list:[],
                    village_list:[],
                    meter_type_list:[],
                    keywords:"",
                    selected_floor_id:"",
                }
            },

            props:{
                cate_id:Number,
                meter_type_id:Number,
            },
            mounted:function(){

                this.set_meter_list();
                this.set_meter_type_list();
                this.set_floor_list();
                this.set_village_list();

            },

            methods:{
                //获取设备
                set_meter_list:function(){
                    this.meter_list = app_json.meter_list;
                },
                //获取设备类型
                set_meter_type_list:function(){
                    this.meter_type_list = app_json.meter_type_list;
                },
                //获取楼层
                set_floor_list:function () {
                    this.floor_list = app_json.floor_list;
                },
                //获取社区
                set_village_list:function (){
                    this.village_list = app_json.village_list;
                },

                str2arr:function(str,delimiter){
                    delimiter = delimiter || ',';
                    let arr = [];
                    if(str){
                        arr = str.split(delimiter);
                    }
                    return arr;
                },

                filter:function(item){
                    let re1 = item.meter_type_id == this.meter_type_id,
                        re2_1 = this.keywords==="" ? true : item.meter_code.indexOf(this.keywords)>-1,
                        re2_2 = this.keywords==="" ? true : item.be_cousume.split(",")[1].indexOf(this.keywords)>-1,
                        re2_3 = this.keywords==="" ? true : item.meter_floor.indexOf(this.keywords)>-1,
                        re3 = this.selected_floor_id==="" ? true : item.floor_id === this.selected_floor_id;

                    return re1&&(re2_1||re2_2||re2_3)&&re3;

                },
                /**
                 * 是否能够绑定到该用分类下
                 * @param item
                 * @returns {boolean}
                 */
                can_bind:function(item){
                    let cate_id = String(this.cate_id)
                    //是否绑定过
                    let re = item.cate_id.split(',').indexOf(cate_id)>-1;
                    //没绑定过 可以绑定 so
                    return !re;
                },

                //绑定
                bind_cate:function(item){
                    let cate_id = this.cate_id,
                        meter_hash = item.meter_hash;
                    this._get(app.U('cate_bind_meter_act'),{cate_id:cate_id,meter_hash:meter_hash},function(re){
                        if(re.err===0){
                            item = Object.assign(item,re.data);
                            console.log(item);
                        }

                    });
                },
                //解绑
                unbind_cate:function(item){
                    let cate_id = this.cate_id,
                        meter_hash = item.meter_hash;
                    this._get(app.U('cate_unbind_meter_act'),{cate_id:cate_id,meter_hash:meter_hash},function(re){
                        if(re.err===0){
                            item = Object.assign(item,re.data);
                        }
                    });
                }
            }
        });

        new Vue({
            el:"#modal_cate_bind_meter",
        });
    </script>

    <script>
        $('#sub_modal').on('hidden.bs.modal', function (e) {
            cate_meters.reset_meters();
        })
    </script>
</block>