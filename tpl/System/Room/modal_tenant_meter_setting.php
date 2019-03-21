<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="modal_tenant_meter_setting">
        <form   @submit.prevent="submit" class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">设备编号</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-bind:value="meter_info.meter_code" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">倍率</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" v-model="meter_info.rate" v-bind:value="meter_info.rate">
                </div>
            </div>
            <div class="form-group">
                <div  class="text-primary col-sm-offset-2 col-sm-10">表比例 1 为独享表 ，若设置小于 1 则为公摊表，如设置为0.5 则公摊50%的费用</div>
                <label for="inputPassword3" class="col-sm-2 control-label">比例</label>
                <div class="col-sm-10">
                    <input type="text" v-model="meter_info.scale" v-bind:value="meter_info.scale" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">设备类型{{meter_info.meter_type_id}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-bind:value="meter_type_list[meter_info.meter_type_id]" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">计费类型(单价)</label>
                <div class="col-sm-10">
                    <div class="checkbox" v-for="(price_type,price_type_id) in price_type_list">
                        &nbsp;
                            <label class="checkbox-inline" style="width:500px">
                                <input type="radio" v-model="meter_info.price_type_id" v-bind:value="price_type_id" name="price_type_id"> {{price_type.desc}}&nbsp;&nbsp;<p class="text-primary" style="display: inline;">(&yen;{{price_type.unit_price}})</p>
                            </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="save" class="btn btn-default">保存</button>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#modal_tenant_meter_setting',
            data:{
                meter_info:app_json.meter_info,
                meter_type_list:app_json.meter_type_list,
                price_type_list:app_json.price_type_list,
            },
            methods: {
                submit: function() {
                    var form_data = this.meter_info; // 这里才是你的表单数据
                    this._post(app.U('save_tenant_meter_setting_act'),form_data,function(re){
                       if(re.err==0){
                           alert("已保存")
                       }
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
            },

            mounted:function(){
                console.log(this.tenantinfo);
            }
        });
    </script>
</block>