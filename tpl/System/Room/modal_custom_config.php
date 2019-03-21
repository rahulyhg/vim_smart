<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal_body">
    <div id="model_custom_config">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span style="vertical-align: bottom;line-height: 33px;">自定义配置</span>
                <div style="clear: both"></div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>描述</th>
                        <th>标记</th>
                        <th>默认值</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,index) in custom_config">
                        <td>{{item.desc}}</td>
                        <td>{{item.key}}</td>
                        <td>{{item.val}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</block>
<block name="modal_script">
    <script>
        new Vue({
            el:'#model_custom_config',
            data:{
               custom_config:app_json.custom_config
            },
            methods: {
                submit: function() {
                    var form_data = this.meter_info; // 这里才是你的表单数据
                    this._post(app.U('save_tenant_meter_setting_act'),form_data,function(re){
                        if(re.err==0){
                            alert("已保存")
                        }
                    });
                }
            },

            mounted:function(){
                console.log(this.custom_config);
            }
        });
    </script>
</block>