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
            </form>
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
                <th>设备</th>
                <th colspan="2">绑定业主</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(room,index) in room_list" v-show="search_room(room)" v-bind:class="{ 'bg-info': room.fid==0 }">
<!--                <td>{{ village_list[room.village_id] }}</td>-->
                <td>{{ room.floor_name}}</td>
                <td>{{ room.room_name}}</td>
<!--                <td>{{ room.desc }}</td>-->
                <td>{{ room.tenantname}}</td>
                <td>{{ room.meter_codes}}</td>
<!--                <td></td>-->
                <td>
                    <span>{{room.ownernames}}</span>
                </td>
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
               selected_floor:"", // 选择的楼层
               modal_oid : "{pigcms{$oid}" //当前弹出层归属的业主id
           },
           mounted:function(){
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
                    return village_filter && floor_filter;
               },

               //获取当前业主的绑定状态
               check_bind_status:function(room){
                    var arr = room.oid.split(","),
                        c1 = room.fid==0,//条件1
                        c2 = arr.indexOf(this.modal_oid)>-1;//条件2

                    if(c1)  return -1;//楼层不是房间 不可操作
                    if(c2)  return  1;//已绑定,可解绑
                    if(!c2) return  0; //未绑定，可绑定
               },

               //绑定房间
               bind_room:function(room){
                   this._get('{pigcms{:U("owner_bind_room_act")}',{
                       room_id:room.id,
                       oid:"{pigcms{$oid}"
                   },function(res){
                       room.oid = res.data.oid;
                       room.ownernames = res.data.ownernames
                   })
               },
               //解绑房间
               unbind_room:function(room){
                   this._get('{pigcms{:U("owner_unbind_room_act")}',{
                       room_id:room.id,
                       oid:"{pigcms{$oid}"
                   },function(res){
                       room.oid = res.data.oid;
                       room.ownernames = res.data.ownernames
                   })
               }
           },

           watch:{
               //切换社区时，楼层下拉发生变化
               selected_village:function(){
                   var room_list = this.room_list;
                   var floor_list = [];

                   for(var i in room_list){
                       //选择社区楼层
                       if(room_list[i].fid==0 && room_list[i].village_id==this.selected_village){
                           floor_list.push(room_list[i]);
                       }
                   }

                   this.floor_list = floor_list;
               }
           }

       });

    </script>
</block>