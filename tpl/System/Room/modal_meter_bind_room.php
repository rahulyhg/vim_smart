<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
</block>
<block name="modal_body">
    <div id="owner_bind_room">
        <form class="form-inline">
            <!--    社区-->
            <select class="form-control" v-model="selected_village">
                <option value="">社区</option>
                <option v-for="(village_name,village_id) in village_list" v-bind:value="village_id">{{ village_name }}</option>
            </select>
            <!--    楼层-->
            <select class="form-control" v-model="selected_floor">
                <option value="">楼层</option>
                <option v-for="(floor,index) in floor_list" v-bind:value="floor.id">{{ floor.floor_name }}</option>
            </select>

            <!--    业主-->
            <select class="form-control" v-model="selected_owner">
                <option value="">业主</option>
                <option value="-1">未绑定业主的单元</option>
                <option v-for="(owner_name,owner_id) in owner_list" v-bind:value="owner_id">{{owner_name }}</option>
            </select>

        </form>
        <!--    设备列表-->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <!--                <th>社区</th>-->
                <th>楼层</th>
                <th>房间号</th>
                <!--                <th>描述</th>-->
                <th>租户</th>
                <th>业主</th>
                <th colspan="2">绑定设备</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(room,index) in room_list" v-show="search_room(room)" v-bind:class="{ 'bg-info': room.fid==0 }">
                <!--                <td>{{ village_list[room.village_id] }}</td>-->
                <td>{{ room.floor_name}}</td>
                <td>{{ room.room_name}}</td>
                <!--                <td>{{ room.desc }}</td>-->
                <td>{{ room.tenantname}}</td>
                <td>
                    <span>{{room.ownernames}}</span>
                </td>
                <td>{{ room.meter_codes}}</td>
                <td>
                    <button v-if="check_bind_status(room)===0" class="btn btn-default btn-sm"  @click="bind_room(room)">绑定</button>
                    <button v-if="check_bind_status(room)===1" class="btn btn-danger btn-sm" @click="unbind_room(room)" >解绑</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#owner_bind_room',
            data:{
                village_list:app_json.village_list,//社区下拉
                selected_village:"",//选中的社区
                room_list:app_json.room_list,//房间列表
                floor_list:[], //楼层列表
                owner_list:[],//业主列表
                selected_floor:"", // 选择的楼层
                selected_owner:"", // 选择的楼层
                modal_meter_hash : "{pigcms{$meter_hash}",

            },
            mounted:function(){
                console.log(this.room_list);
                //初始社区默认操作人所在社区，若没有则选择广发银行大厦village_id
                this.selected_village = "{pigcms{:session('system.village_id')}"||"4";
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

                //房间过滤
                search_room:function(room){
                    var village_filter  = this.selected_village == "" ? true : room.village_id == this.selected_village;
                    var floor_filter = this.selected_floor == "" ? true : room.fid == this.selected_floor;
                    var owner_filter;
                    //业主过滤
                    if(this.selected_owner===""){
                        owner_filter = true;
                    }else if(this.selected_owner==="-1"){
                        owner_filter = !room.oid&&room.fid!=0;
                    }else{
                        owner_filter = room.oid.split(',').indexOf(this.selected_owner)>-1;
                    }

                    return village_filter && floor_filter && owner_filter;
                },

                //获取当前设备的绑定状态
                check_bind_status:function(room){
                   //TODO::
                    var
                        arr = room.meter_hash.split(","),
                        c1 = room.fid==0,//条件1 是否是楼层
                        c2 = arr.indexOf(this.modal_meter_hash)>-1;//条件2
                    if(c1)  return -1;//楼层不是房间 不可操作
                    if(c2)  return  1;//已绑定,可解绑
                    if(!c2) return  0; //未绑定，可绑定
                },

                //绑定房间
                bind_room:function(room){
                    this._get('{pigcms{:U("meter_bind_room_act")}',{
                        room_id:room.id,
                        meter_hash:"{pigcms{$meter_hash}"
                    },function(res){
                        //TODO::
                        room.meter_hash = res.data.meter_hash;
                        room.meter_codes = res.data.meter_codes;

                    })
                },
                //解绑房间
                unbind_room:function(room){
                    this._get('{pigcms{:U("meter_unbind_room_act")}',{

                        room_id:room.id,
                        meter_hash:"{pigcms{$meter_hash}"
                    },function(res){
                        //TODO::
                        room.meter_hash = res.data.meter_hash;
                        room.meter_codes = res.data.meter_codes;

                    })
                },

                set_owner_list:function(){
                    var room_list = this.room_list;
                    var owner_list = {},ok=[],ov=[];

                    for(var i in room_list){
                        var karr = room_list[i].oid.split(",");
                        var varr = room_list[i].ownernames.split(",");
                        for(var j in karr){
                            if(karr[j]&&varr[j]){
                                owner_list[karr[j]] = varr[j];
                            }
                        }
                    }
//
//
//
//
//                    for(var i in room_list){
//                        //设置业主列表相关
//                        var karr = room_list[i].oid.split(",");
//                        var varr = room_list[i].ownernames.split(",");
//                        ok = _.union(ok,karr);
//                        ov = _.union(ov,varr);
//                    }
//                    //设置业主列表相关
//                    ok = _.uniq(ok,true); ok=_.compact(ok);
//                    ov = _.uniq(ov,true); ov=_.compact(ov);

                    this.owner_list = owner_list;
                }
                

            },

            watch:{
                //切换社区时
                selected_village:function(){
                    var room_list = this.room_list;
                    //设置楼层
                    var floor_list = [];
//                    var owner_list = {},ok=[],ov=[];

                    for(var i in room_list){
                        //选择社区楼层
                        if(room_list[i].fid==0 && room_list[i].village_id==this.selected_village){
                            floor_list.push(room_list[i]);
                        }

                        //设置业主列表相关
//                        var karr = room_list[i].oid.split(",");
//                        var varr = room_list[i].ownernames.split(",");
//                        ok = _.union(ok,karr);
//                        ov = _.union(ov,varr);
                    }

//                    //设置业主列表相关
//                    ok = _.uniq(ok,true); ok=_.compact(ok);
//                    ov = _.uniq(ov,true); ov=_.compact(ov);

                   // this.owner_list = _.object(ok,ov);
                    this.set_owner_list();
                    this.floor_list = floor_list;

                }
            }

        });

    </script>
</block>