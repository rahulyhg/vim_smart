<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
</block>
<block name="modal_body">
    <div id="tenant_bind_meter">
        <form class="form-inline">
            <!--        设备类型-->
            <select class="form-control" v-model="meter_type_id">
                <option value="">设备类型</option>
                <option v-for="(desc,meter_type_id) in meter_type_list" v-bind:value="meter_type_id">{{desc}}</option>
            </select>
            <!--    楼层-->
            <select class="form-control" v-model="floor_id">
                <option value="">楼层</option>
                <foreach name="floor_list" item="floor_name" key="key">
                    <option value="{pigcms{$key}">{pigcms{$floor_name}</option>
                </foreach>
            </select>
            <input type="text" class="form-control" v-model="keywords" placeholder="设备编号">
            <!--        <span class="text-muted">设备数：</span><span class="text-info">{{meter_count}}</span>-->
        </form>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>设备类型</th>
                <th>楼层</th>
                <th>设备编号</th>
                <th>止码</th>
                <th colspan="2">入驻单位绑定</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in meter_list" v-show="fliter_meter(item)">
                <td>{{meter_type_list[item.meter_type_id]}}</td>
                <td>{{item.floor_name}}</td>
                <td>{{item.meter_code}}</td>
                <td>{{item.be_cousume.split(",")[1]}}</td>
                <td>
                    <div v-if="!!item.tenantnames">
                        <div v-for="(tenantname, _tid) in item.tenantnames">
                            {{tenantname}}
                        </div>
                    </div>
                    <span v-else style="color:#bbb">未绑定任何入驻单位</span>
                </td>
                <td>
                    <button v-if="check_bind_status(item)===0" class="btn btn-default btn-sm"  @click="bind_meter(item)">绑定</button>
                    <button v-if="check_bind_status(item)===1" class="btn btn-danger btn-sm" @click="unbind_meter(item)" >解绑</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#tenant_bind_meter',
            data:{
                tid:"{pigcms{$tid}",
                meter_list:app_json.meter_list,
                meter_type_list:app_json.meter_type_list,
                floor_list:app_json.floor_list,
                village_list:app_json.village_list,
                floor_id:"",
                meter_type_id:"",
                village_id:"",
                keywords:"",
            },
            mounted:function(){

            },
            methods:{
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
                            alert("发生错误:"+response.body.msg);
                        }
                    }, function(response){
                        alert(response.status+" 发生错误");
                    });

                },
                check_bind_status:function(meter){
                    var arr = meter.tids||[];
                    var c1 = arr.indexOf(this.tid)>-1;
                    return c1?1:0;
                },
                //绑定设备
                bind_meter:function(meter){
                    console.log(meter);
//                    if(!meter.rids){
//                        alert("该入驻单位未绑定任何房间，请先绑定房间号");
//                        return;
//                    }
                    var tid = this.tid;
                    this._get(app.U('tenant_bind_meter_act'),{
                        meter_hash:meter.meter_hash,
                        tid:tid
                    },function(res){
                        meter.tenantnames = res.data.tenantnames;
                        meter.tids = res.data.tids;
                        console.log(meter);
                        console.log(res);
                    })
                },
                //解绑设备
                unbind_meter:function(meter){
                    var tid = this.tid;
                    this._get(app.U('tenant_unbind_meter_act'),{
                        meter_hash:meter.meter_hash,
                        tid:tid
                    },function(res){
                        meter.tenantnames = res.data.tenantnames;
                        meter.tids = res.data.tids;
                    })
                },
                //搜索
                fliter_meter:function(meter){
                    var re1 = !this.floor_id        ||  meter.floor_id       === this.floor_id;
                    var re2 = !this.village_id      ||  meter.village_id     === this.village_id;
                    var re3 = !this.meter_type_id   ||  meter.meter_type_id  === this.meter_type_id;
                    var re4 = !this.keywords        ||  meter.meter_code.indexOf(this.keywords)>-1;

                    return re1&&re2&&re3&&re4;
                }
            },


            watch:{

            }
        });
    </script>
</block>