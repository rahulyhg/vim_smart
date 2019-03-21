<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="modal_tenant_rooms">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">房间列表</span>
                <a style="float: right" class="btn btn-primary" href="{pigcms{:U('modal_tenant_bind_room',array('tid'=>$tid))}"
                   type="button" data-toggle="modal" data-target="#sub_modal">
                    绑定房间
                </a>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                      <th>单元号</th>
                      <th>房间面积</th>
                      <th>物业单价</th>
                        <th>操作</th>

                    </tr>
                    <template v-for="(item,index) in room_data">
                        <tr>
                            <td>{{item.room_name}}</td>
                            <td>{{item.roomsize}}</td>
                            <td>{{item.property_unit}}</td>
                            <td>
                                <button type="button" @click="unbind_room(item.room_id)" class="btn btn-danger  btn-sm">
                                    解绑
                                </button>
                            </td>
                        </tr>
                    </template>
                </table>
            </div>
        </div>
    </div>
</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#modal_tenant_rooms',
            data:{
                tenantinfo:app_json.tenantinfo,
                room_data:app_json.tenantinfo.property_data
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
                //解绑设备
                unbind_room:function(room_id){
                    if(!window.confirm("确认删除？")) return false;
                    var that = this;
                    var tid = this.tenantinfo.tid;
                    this._get('{pigcms{:U("tenant_unbind_room_act")}',{
                        room_id:room_id,
                        tid:tid
                    },function(res){
                        if(res.err===0){
                            Vue.delete(that.room_data,room_id);
                        }else{
                            alert("发送错误，删除失败");
                        }
                    })
                },
            },
            mounted:function(){

            }
        });
    </script>
</block>