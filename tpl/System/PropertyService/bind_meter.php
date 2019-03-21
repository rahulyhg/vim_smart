<div class="modal-header">
    <button type="button" class="close close_sub_modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">新增绑定-{pigcms{$tenant_info['tenantname']}</h4>
</div>
<div class="modal-body" id="app_{pigcms{$tenant_info['pigcms_id']}" style="height: 45rem;overflow-y: scroll">
    <div>
        <form class="form-inline">
            <!--        设备类型-->
            <select class="form-control" v-model="meter_type_id">
                <option value="0">设备类型</option>
                <foreach name="meter_type_list" item="desc" key="meter_type_id">
                    <option value="{pigcms{$meter_type_id}">{pigcms{$desc}</option>
                </foreach>
            </select>
            <!--    楼层-->
            <select class="form-control" v-model="floor">
                <option value="">楼层</option>
                <volist name="floors" id="f">
                    <option value="{pigcms{$f}">{pigcms{$f}</option>
                </volist>
            </select>
            <input type="text" class="form-control" v-model="meter_code" placeholder="设备编号">

            <!--        <span class="text-muted">设备数：</span><span class="text-info">{{meter_count}}</span>-->
        </form>
        <!--    设备列表-->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>设备类型</th>
                <th>楼层</th>
                <th>设备编号</th>
                <th>止码</th>
                <th colspan="2">绑定公司</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in meter_list" v-show="filter_meter(item)">
                <td>{{item.meter_type_desc}}</td>
                <td>{{item.meter_floor}}</td>
                <td>{{item.meter_code}}</td>
                <td>{{item.be_cousume.split(",")[1]}}</td>
                <td>
                    <div v-if="!!item.tenantnames">
                        <div v-for="(tenantname, _tid) in item.tenantnames">
                            {{tenantname}}
                        </div>
                    </div>
                    <span v-else style="color:#bbb">未绑定任何公司</span>
                </td>
                <td>
                    <button class="btn btn-default btn-sm" v-if="item.tids!==null&&item.tids.indexOf(tid)>-1"  @click="unbind_meter(item,$event)">解绑</button>
                    <button v-else class="btn btn-default  btn-sm " @click="bind_meter(item,$event)">绑定</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default close_sub_modal">关闭</button>
<!--    <button type="button" class="btn btn-primary">Save changes</button>-->
</div>


<script>
    var app_{pigcms{$tenant_info['pigcms_id']} = new Vue({
         data:{
             tid:"{pigcms{$tenant_info['pigcms_id']}"||0,//租户（公司）ID
             tenantname:"{pigcms{$tenant_info['tenantname']}",
             usernum:"{pigcms{$tenant_info['usernum']}",
             meter_list:[],
             meter_count : 0,
             meter_code:"",
             meter_type_id : "0",
             floor:"",
         },
         mounted:function(){
            var meter_list = this.get_meter_list()
            this.meter_list = meter_list;
            this.meter_count = meter_list.length;
         },
         methods:{
             //获取数据
             get: function (url, data) {
                 var d;
                 $.ajax({
                     url: url,
                     data: data || {},
                     type: 'get',
                     dataType: 'json',
                     async: false,
                     success: function (re) {
                         d = re;
                     }
                 })
                 return d;
             },

             //获取设备列表
             get_meter_list:function () {
                  var res = this.get('{pigcms{:U("ajax_get_meter_list")}');
                  return res.data;
             },

             //过滤设备列表
             filter_meter:function(node){
                var meter_code = this.meter_code;
                var meter_type_id = this.meter_type_id;
                var floor = this.floor;


                var filter_meter_type_id    = meter_type_id== "0"   ?   true :  node.meter_type_id == meter_type_id;
                var filter_floor            = meter_code==""        ?   true :  node.meter_code.indexOf(meter_code)>-1;
                var filter_meter_code       = floor==""             ?   true :  node.meter_floor == floor;

                var re =  filter_meter_type_id &&filter_floor &&filter_meter_code;

               // re?this.meter_count+=1: this.meter_count-=1;

                return re;

             },

             //公司绑定设备
             bind_meter:function (node,el) {
                 var tid = this.tid;
                 var meter_hash = node.meter_hash;
                 var res = this.get("{pigcms{:U('ajax_bind_meter_act')}",{tid:tid,meter_hash:meter_hash});
                 if(res.err==0){
                     node.tenantnames = res.data.tenantnames;
                     node.tids = res.data.tids;
                     node.tscales = res.data.tscales;
                     //$("#modal_"+this.usernum).css("background-color","red");
                     var bind_model =  bind_meter_list_{pigcms{$tenant_info['pigcms_id']};
                         var bind_list = bind_model.$data.bind_list;
                         console.log(res.data);
                         //同步绑定设备
                         var bind_data = {
                            'be_cousume':res.data.be_cousume,
                            'be_date':res.data.be_date,
                            'meter_code':res.data.meter_code,
                            'meter_hash':res.data.meter_hash,
                            'meter_type_desc':res.data.meter_type_desc,
                            'meter_type_id':res.data.meter_type_id,
                            'price_type_desc':res.data.price_type_desc,
                            'price_type_id':res.data.price_type_id,
                            'tenantname':res.data.tenantnames[tid],
                            'scale':res.data.tsacles[tid],
                            'rate':res.data.rate,
                            'meter_floor':res.data.meter_floor,
                         }
                         bind_list.push(bind_data);

                 }else{
                     alert("发送错误，绑定失败");
                 }
             },
             //解绑
             unbind_meter:function(node){
                 var tid = this.tid;
                 var meter_hash = node.meter_hash;
                 var res = this.get("{pigcms{:U('ajax_unbind_meter_act')}",{tid:tid,meter_hash:meter_hash});
                 if(res.err==0){
                     node.tenantnames = res.data.tenantnames;
                     node.tids = res.data.tids;
                     node.tscales = res.data.tscales;
                     //$("#modal_"+this.usernum).css("background-color","blue");
                     //删除同步
                    var bind_model =  bind_meter_list_{pigcms{$tenant_info['pigcms_id']};
                     var bind_list = bind_model.$data.bind_list;
                     for(var i in bind_list){
                         if(bind_list[i].meter_hash==meter_hash){
                             console.log(bind_list[i]);

                             bind_list.splice(i, 1);
                         }
                     }
                 }else{
                     alert("发送错误，绑定失败");
                 }
             }
         },

    }).$mount('#app_{pigcms{$tenant_info['pigcms_id']}')

</script>