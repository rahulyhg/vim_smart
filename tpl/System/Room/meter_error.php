<extend name="./tpl/System/Public_news/base.php" />
<block name="table-toolbar-left">
    <div>
        <div class="btn-group">
            <a href="{pigcms{:U('meterlist_news')}">
                <button id="sample_editable_1_new" class="btn sbold green">返回
                </button>
            </a>
        </div>
        <div class="btn-group">
            <button id="sample_editable_1_new" class="btn sbold green">
                止码检测
            </button>
        </div>
    </div>
</block
<block name="body">
    <table class="table">
        <tr>
            <td>设备码</td>
            <td>设备类型</td>
            <td>计费类型</td>
            <td>起码</td>
            <td>止码</td>
            <td>当月抄录</td>
        </tr>
        <tr v-for="(item,index) in meter_list" :class="classObject(item)">
            <td>{{item.meter_code}}</td>
            <td>{{item.meter_type_name}}</td>
            <td>{{item.price_type_name}}</td>
            <td>{{item.be_cousume.split(',')[0]}}
<!--                ({{item.be_date.split(',')[0]}})-->
            </td>
            <td>{{item.be_cousume.split(',')[1]}}
<!--                ({{item.be_date.split(',')[1]}})-->
            </td>
            <td>
                <span v-if="item.is_record">
                    {{item.total_consume}}
                </span>
                <span v-else>未抄录</span>
            </td>
        </tr>
    </table>
</block>
<block name="head">
    <style>
    </style>
</block>

<block name="script">
    <script>
        new Vue({
            el:'#main',
            data:{
                meter_list:[],
            },
            mounted:function(){
                var that = this;
                this._get(app.U('meterlist_news'),{},function(re){
                    that.meter_list = re.data;
                });
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
                            callback(response.body,this);
                        }else{
                            alert("发生错误:"+response.body.msg);
                        }
                    }, function(response){
                        alert(response.status+" 发生错误");
                    });

                },
                classObject:function(meter_info){
                    var stat = 0;
                    if(meter_info.is_record){//当月未出账的数据
                        if(meter_info.total_consume > meter_info.be_cousume.split(',')[1]){
                            stat = 1;
                        }
                    }
                    var colors = {
                        'text-warning':stat===1,
                        'text-danger':stat===2,
                    };
                    return colors;
                }

            },




        });
    </script>
</block>