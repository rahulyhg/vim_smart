<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="modal_tenant_meters">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">设备列表</span>
                <a style="float: right" class="btn btn-primary" href="{pigcms{:U('modal_tenant_bind_meter',array('tid'=>$tid))}"
                   type="button" data-toggle="modal" data-target="#sub_modal">
                    绑定设备
                </a>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>楼层号</th>
                        <th>设备类型</th>
                        <th>设备编号</th>
                        <th>当月上报状态</th>
                        <th>当前止码</th>
                        <th>计费类型</th>
                        <th>倍率</th>
                        <th>操作</th>
                    </tr>
                    <template v-for="(meter_type_group,meter_type_id) in tenantinfo.room_data" v-if="meter_type_id">
                        <template v-for="(meter_info,meter_hash) in meter_type_group">
                        <tr>
                            <td>{{meter_info.meter_floor}}</td>
                            <td>{{meter_type_list[meter_info.meter_type_id]}}</td>
                            <td>{{meter_info.meter_code}}</td>
                            <td>{{meter_info.record_id?"已抄录":"未抄录"}}</td>
                            <td>{{meter_info.total_consume||meter_info.be_cousume.split(',')[1]}}</td>
                            <td>{{price_type_list[meter_info.price_type_id]}}</td>
                            <td>{{meter_info.rate}}</td>
                            <td>

                                <a type="button"
                                   class="btn btn-default  btn-sm"
                                   data-toggle="modal"
                                   data-target="#sub_modal"
                                   v-bind:href="app.U('modal_tenant_meter_setting',{tid:tenantinfo.tid,meter_hash:meter_info.meter_hash})"
                                >
                                计费配置
                                </a>

                                <a type="button"
                                   class="btn btn-default  btn-sm"
                                   data-toggle="modal"
                                   data-target="#sub_modal"
                                   v-bind:href="app.U('modal_meter_qr',{meter_hash:meter_info.meter_hash})"
                                >
                                    二维码
                                </a>

                                <button type="button"
                                   class="btn btn-default  btn-sm"
                                   @click="unbind_meter(meter_type_id,meter_hash)"
                                >
                                    解绑
                                </button>
                            </td>
                        </tr>
                        </template>
                    </template>

                </table>
            </div>
        </div>
    </div>
</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#modal_tenant_meters',
            data:{
                tenantinfo:app_json.tenantinfo,
                meter_type_list:app_json.meter_type_list,
                price_type_list:app_json.price_type_list,
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
                unbind_meter:function(meter_type_id,meter_hash){
                    if(!window.confirm("确认删除？")) return false;
                    var that = this;
                    var tid = this.tenantinfo.tid;
                    this._get(app.U('tenant_unbind_meter_act'),{
                        meter_hash:meter_hash,
                        tid:tid
                    },function(res){
                        if(res.err===0){
                            Vue.delete(that.tenantinfo.room_data[meter_type_id],meter_hash);
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