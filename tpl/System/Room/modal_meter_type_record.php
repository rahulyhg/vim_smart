<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div v-cloak  id="modal_meter_type_record_{pigcms{$tid}_{pigcms{$meter_type_id}">
<!--        已录入设备-->
        <div class="panel panel-default"  v-show="record_count>0">
            <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">已录入设备（{{this.record_count}}）
            </span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>楼层单元号</th>
                        <th>设备类型</th>
                        <th>设备编号</th>
                        <th>上月止码</th>
                        <th>当前止码</th>
                        <th>计费类型</th>
                        <th>倍率</th>
                        <th>比例</th>
                        <th>用量</th>
                        <th>参考费用</th>
                        <th>实际费用
                            <small class="text-muted">（点击修改）</small>
                        </th>
                        <th>二维码</th>
                    </tr>
                    <template v-for="(item,type_id) in record_room_data" v-if="item.length>0">
                        <tr>
                            <th colspan="12" class="text-info" style="background-color: #F3F4F6">
                                {{meter_type_list[type_id]}} （{{item.length}}）
                            </th>
                        </tr>
                        <tr v-for="(row,key) in item" class="text-muted">
                            <td>{{row.meter_floor}}</td>
                            <td>{{meter_type_list[row.meter_type_id]}}</td>
                            <td>{{row.meter_code}}</td>
                            <td>
                                <editinput :item="row" :field="'last_total_consume'"></editinput>
                            </td>
                            <td>
                                <editinput :item="row" :field="'total_consume'"></editinput>
                            </td>
                            <td>{{price_type_list[row.price_type_id]}}</td>
                            <td>
                                <editinput :item="row" :field="'rate'"></editinput>
                            </td>
                            <td>
                                <editinput :item="row" :field="'scale'"></editinput>
                            </td>
                            <td>{{(row.total_consume-row.last_total_consume).toFixed(2)}}</td>
                            <td>
                                {{set_cost(row)}}
                            </td>
                            <td>
                            <span @click="editing(row,$event)"
                                  v-if="!is_editing(row)"
                            >
                                {{parseFloat(row.admin_defined_price)||row.cost}}
<!--                                {{parseFloat(row.admin_defined_price)}}-->
                            </span>
                                <input type="number" style="width:100px"
                                       v-model="row.admin_defined_price"
                                       ref='search' v-select
                                       @blur="save(row)"
                                       v-if="is_editing(row)"
                                       ref="input"
                                >
                            </td>
                            <td>
                                <a type="button"
                                   class="btn btn-default  btn-sm"
                                   data-toggle="modal"
                                   data-target="#sub_modal"
                                   v-bind:href="app.U('modal_meter_qr',{meter_hash:row.meter_hash})"
                                >
                                    二维码
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"></td>
                            <th>总计：</th>
                            <th>{{set_total(item).cousume.toFixed(2)}}</th>
                            <th>{{set_total(item).cost.toFixed(2)}}</th>
                            <th>{{set_total(item).admin_defined_price.toFixed(2)}}</th>
                            <td></td>
                        </tr>
                    </template>

                </table>
            </div>
        </div>
<!--        未录入设备-->
        <div class="panel panel-default" v-show="no_record_count>0">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">
                    未录入设备（{{this.no_record_count}}）
                </span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>楼层单元号</th>
                        <th>设备类型</th>
                        <th>设备编号</th>
                        <th>上月止码</th>
                        <th>计费类型</th>
                        <th>倍率</th>
                        <th>比例</th>
                        <th>二维码</th>
                    </tr>

                    <template v-for="(item,type_id) in no_record_room_data" v-if="item.length>0">
                        <tr>
                            <th colspan="12" class="text-info" style="background-color: #F3F4F6">
                                {{meter_type_list[type_id]}} （{{item.length}}）
                            </th>
                        </tr>
                        <tr v-for="(row,key) in item" class="text-muted">
                            <td>{{row.meter_floor}}</td>
                            <td>{{meter_type_list[row.meter_type_id]}}</td>
                            <td>{{row.meter_code}}</td>
                            <td>{{row.be_cousume.split(',')[1]}}</td>
                            <td>{{price_type_list[row.price_type_id]}}</td>
                            <td>{{row.rate}}</td>
                            <td>{{row.scale}}</td>
                            <td>
                                <a type="button"
                                   class="btn btn-default  btn-sm"
                                   data-toggle="modal"
                                   data-target="#sub_modal"
                                   v-bind:href="app.U('modal_meter_qr',{meter_hash:row.meter_hash})"
                                >
                                    二维码
                                </a>
                            </td>
                        </tr>
                    </template>
                </table>
            </div>
        </div>
    </div>



</block>
<block name="modal_footer">

</block>
<block name="modal_script">
<!--    组件  点击span切换成input-->
    <script type="text/x-template" id="editinput">
        <div>
            <span @click="edit()"
                  v-if="!editing"
                  @mouseover="icon_show=true"
                  @mouseout="icon_show=false"
                  style="cursor: pointer">
                {{item[field]}}
                <span v-show="icon_show" style="width:0;padding:0;margin:0" class="glyphicon glyphicon-pencil"></span>
            </span>


            <input type="text" style="width:60px;height:2em" class="form-control"
                   v-model="item[field]"
                   v-select
                   @blur="save()"
                   @keyup.enter="editing=!editing"
                   v-if="editing"
                   ref="input"
            >
        </div>
    </script>
    <script>
      //注册一个全局自定义指令 `v-select`
        Vue.directive('select', {
            // 当被绑定的元素插入到 DOM 中时……
            inserted: function (el) {
                // 全选元素
                el.select()
            }
        })

        //input span 切换组件
        Vue.component('editinput', {
            template: '#editinput',
            data: function () {
                return {
                    editing:false,
                    icon_show:false,
                    tid:app_json.tid,
                }
            },
            props: {
                item:Object,
                field:String
            },
            methods:{
                edit:function(){
                    this.editing = true;
                },
                save:function(){
                    var data = JSON.parse(JSON.stringify(this.item));
                    data.field = this.field;
                    data.tid = this.tid;
                    console.log(data);
                    this._post(app.U('meter_type_record_edit_act'),data,function(re){
                        if(re.err!==0){//如果发生错误则还原数据

                        }
                        console.log(re);
                    });
                    this.editing = false;
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
            },


        });


        //列表
        new Vue({
            el:'#modal_meter_type_record_{pigcms{$tid}_{pigcms{$meter_type_id}',
            data:{
                room_data:app_json.room_data,//所有设备
                meter_type_list:app_json.meter_type_list,
                price_type_list:app_json.price_type_list,
                record_room_data:[],
                record_count:0,
                no_record_room_data:[],
                no_record_count:0,
            },
            mounted:function(){
                //初始化这种总计数据
                this.set_total();
                this.divide_room_data();
            },
            methods:{
                //区分已录入设备与未录入设备
                divide_room_data:function(){
                    var no_record_room_data = {};
                    var record_room_data = {};
                    var record_count = 0;
                    var no_record_count = 0;

                    for(var meter_type_id in this.room_data){
                        var row = this.room_data[meter_type_id];

                        no_record_room_data[meter_type_id] = [];
                        record_room_data[meter_type_id] = [];

                        for(var i in row){
                            if(row[i].record_id){
                                record_room_data[meter_type_id].push(row[i]);
                                record_count += 1;
                            }else{
                                no_record_room_data[meter_type_id].push(row[i]);
                                no_record_count +=1;
                            }
                        }

                    }


                    this.record_count = record_count;
                    this.record_room_data = record_room_data;
                    this.no_record_room_data = no_record_room_data;
                    this.no_record_count = no_record_count;
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
                //编辑状态创建
                editing:function(row,e){
                    if(row.editing===undefined){
                        this.$set(row,'editing',1)
                    }
                    //初始化值
                    if(row.admin_defined_price==0){
                        row.admin_defined_price = row.cost;
                    }


                    row.editing = 1;
                },
                //是否编辑状态
                is_editing:function(row){
                    return row.editing===1||0;
                },
                //保存修改
                save:function(row){
                    row.editing=0;
                    //var tmp =  JSON.parse(JSON.stringify(row));
                    this._get(app.U('admin_defined_price'),row,function(re){
                        if(re.err!==0){//如果发生错误则还原数据
                            alert("发生错误");
                            row.admin_defined_price = re.admin_defined_price;
                        }

                    });
                },
                //设置参考金额
                set_cost:function(row){
                    var cost = row.unit_price
                        *row.rate
                        *row.scale
                        *(row.total_consume-row.last_total_consume);
                    return cost.toFixed(2);
                },

                //设置总计数据
                set_total:function(item){
                    var cousume = 0.00,
                        admin_defined_price = 0.00,
                        cost = 0.00;
                    for(var i in item){
                            cousume += item[i].total_consume-item[i].last_total_consume;
                            cost += item[i].cost;
                            admin_defined_price += parseFloat(item[i].admin_defined_price)||item[i].cost;

                    }
                    return {
                        'cousume':cousume,
                        'cost':cost,
                        'admin_defined_price':admin_defined_price
                    }
                }
            },

        });

    </script>
</block>