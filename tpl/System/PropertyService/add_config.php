<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div id="add_config">
        <form action="{pigcms{:U(ACTION_NAME . '_act')}" @submit.prevent="submit" class="form-horizontal" method="post">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">所属设备类型
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <select name="meter_type_id" v-model="meter_type_id"  class="form-control" >
                        <option v-for="(item,index) in meter_tpye_list" v-bind:value="index">{{item}}</option>
                    </select>
                </div>
            </div>
            <!--            新建设备-->
            <div v-if="meter_type_id==0">
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">名称
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="config.desc" >
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">标记
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="config.sign" >
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">单位
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="config.unit">
                    </div>
                </div>
            </div>
            <!--            /新建设备-->
            <!--            新建用途类型-->
            <div v-else>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">名称
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="cate.desc" >
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">标记
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="cate.sign" >
                    </div>
                </div>
            </div>
            <!--            /新建用途类型-->
            <!--            自定义设备-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">
                    <button class="btn btn-default" type="button"
                            @click="add_custom()">
                        添加自定义配置
                    </button>
                </label>
                <div class="col-md-9" v-if="custom_config.length>0">
                    <div  class="panel panel-default ">
                        <table class="table table-striped table-bordered table-hover" v-if="custom_config.length>0">
                                <thead>
                                <tr>
                                    <th>描述</th>
                                    <th>标记</th>
                                    <th>默认值</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item,index) in custom_config">
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
            <!--            /自定义设备-->
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default">重 置</button>
                        <button type="button" class="btn default" onclick="app.redirect('PropertyService/device_config_list')">返 回</button>
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
                    pid:0,
                    sign:"",
                    desc:"",
                    unit:"",
                },
                cate:{
                    meter_type_id:0,
                    sign:"",
                    desc:"",
                },
                meter_type_id:0,
                custom_config:[]



            },
            methods:{
                //删除自定义配置
                del_custom:function(index){
                    Vue.delete(this.custom_config,index);
                },
                //添加自定义配置
                add_custom:function(){
                    var arr = {
                        desc:"",
                        key:"",
                        val:"",
                    }
                    this.custom_config.push(arr);
                },
                //提交
                submit: function() {
                    let form_data,url;

                    if(this.meter_type_id === 0){
                       form_data = this.config;
                       url = app.U('save_config');
                    }else{
                        form_data = this.cate;
                        url = app.U('save_cate');
                    }
                    form_data.custom_config = this.custom_config;
                    form_data.meter_type_id = this.meter_type_id;
                    this._post(url,form_data,function(re){
                        app.redirect('add_config_act',{err:re.err})
                    });
                },
            }
        });
    </script>
</block>
