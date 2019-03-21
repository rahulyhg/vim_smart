<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div id="add_config">
        <form action="{pigcms{:U(ACTION_NAME . '_act')}" @submit.prevent="submit" class="form-horizontal" method="post">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">所属设备类型
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="pid" v-model="config.pid"  class="form-control" >
                        <option v-for="(item,index) in meter_tpye_list" v-bind:value="index">{{item}}</option>
                    </select>
                </div>
            </div>
<!--            设备，计费 父子设备必须-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">{{config.pid==0?"设备类型":"计费类型"}}名称
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="config.desc" value="{pigcms{$info.meter_code}">
                </div>
            </div>
<!--            标记 父子设备必须-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">标记
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control"  v-model="config.sign"  value="{pigcms{$info.meter_code}">
                </div>
            </div>

<!--            单价 子设备必须-->
            <div v-if="config.pid!=0" class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">单价
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control"  v-model="config.unit_price" value="{pigcms{$info.meter_code}">
                </div>
            </div>
<!--            单位 父设备必须-->
            <div v-if="config.pid==0" class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">单位
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="config.unit" value="{pigcms{$info.meter_code}">
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">
                    <button class="btn btn-default" type="button"
                            @click="add_custom()">
                        添加自定义配置
                    </button>
                </label>
                <div class="col-md-9" v-if="config.custom_config.length>0">
                    <div  class="panel panel-default ">
                        <table class="table table-striped table-bordered table-hover" v-if="config.custom_config.length>0">
                                <thead>
                                <tr>
                                    <th>描述</th>
                                    <th>标记</th>
                                    <th>默认值</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item,index) in config.custom_config">
                                    <td><input type="text" class="form-control" v-model="item.desc"></td>
                                    <td><input type="text" class="form-control" v-model="item.key"></td>
                                    <td><input type="text" class="form-control" v-model="item.val"></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" @click="del_custom(index)">删除</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>





            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default">重 置</button>
                        <button type="button" class="btn default" onclick="app.redirect('Room/meter_config_list')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="head">
    <style>
        .is_choosed{
            color: #ffbb53;
        }
    </style>
</block>
<block name="script">
    <script>
        new Vue({
            el:"#add_config",
            data:{
                meter_tpye_list:app_json.meter_type_list,
                config:{
                    "pid":"0",
                    "sign":"",
                    "desc":"",
                    "unit_price":"",
                    "unit":"",
                    "rate":1,
                    "custom_config":[]
                }
            },
            mounted:function(){
                console.log(app_json.meter_type_list)
            },
            methods:{
                //删除自定义配置
                del_custom:function(index){
                    Vue.delete(this.config.custom_config,index);
                },
                //添加自定义配置
                add_custom:function(){
                    var arr = {
                        desc:"",
                        key:"",
                        val:"",
                    }
                    this.config.custom_config.push(arr);
                },
                //提交
                submit: function() {
                    var form_data = this.config; // 这里才是你的表单数据
                    this._post(app.U('save_config'),form_data,function(re){
                        app.redirect('add_config_act',{err:re.err})
                    });
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
            }
        });
    </script>
</block>
