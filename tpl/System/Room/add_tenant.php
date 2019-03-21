<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div id="tenant_bind_room">
        <form action="{pigcms{:U(ACTION_NAME . '_act')}" class="form-horizontal" method="post">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">入住单位名称
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="ownername" value="{pigcms{$info.ownername}">
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">姓名
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="name" value="{pigcms{$info.name}">
                </div>

            </div>

            <!--        联系方式-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">联系方式
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="phone" value="{pigcms{$info.phone}">
                </div>

            </div>
            <!--        address 详细地址-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">详细地址
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="address" value="{pigcms{$info.company}">
                </div>

            </div>
            <!--        单价-->
<!--            <div class="form-group form-md-line-input">-->
<!--                <label class="col-md-2 control-label" for="form_control_1">物业单价-->
<!--                    <span class="required">*</span>-->
<!--                </label>-->
<!---->
<!--                <div class="col-md-9">-->
<!--                    <input type="number" class="form-control" name="property_unit" value="{pigcms{$info.property_unit}">-->
<!--                </div>-->
<!---->
<!--            </div>-->
            <!--       TODO:: uid  绑定用户-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">绑定业主
                    <span class="required">*</span>
                </label>
                <div class="col-md-9">
                    <div id="owner_bind_room" v-cloak>
                        <div  class="form-inline">
                            <!--    社区-->
                            <select class="form-control" v-model="selected_village" name="village_id" id="village_id" >
                                <option value="">社区</option>
                                <option v-for="(village_name,village_id) in village_list" v-bind:value="village_id">{{ village_name }}</option>
                            </select>
                            <input type="text" class="form-control" v-model="keywords" placeholder="业主搜索">
                            <span></span>
                        </div>
                        <!--    设备列表-->
                        <div style="height:250px;overflow-y: scroll">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>业主</th>
                                    <th>房间号</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in owner_list" v-show="filter_owner(item)">
                                        <td>{{item.ownername}}</td>
                                        <td>
                                            <div v-for="(room_name,room_id) in item.room_id_name">
                                                <input
                                                    type="checkbox"
                                                    v-bind:value="room_id" name="room_ids[]"
                                                    :disabled="Boolean(parseInt(item.room_id_tid[room_id]))"
                                                >
                                                <span v-bind:class='{disabled:Boolean(parseInt(item.room_id_tid[room_id]))}'>
                                                    {{room_name}}&nbsp;
                                                    {{item.room_id_tname[room_id]}}
                                                </span>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <input type="hidden" name="oid" value='{pigcms{:I("get.tid")}'>
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default">重 置</button>
                        <button type="button" class="btn default" onclick="app.redirect('tenantlist_news')">返 回</button>
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
        .disabled{
            color:#ccc;
        }
    </style>
</block>
<block name="script">
    <script>
        new Vue({
            el:'#tenant_bind_room',
            data:{
                tid:parseInt('{pigcms{:I("get.oid")}')||0,//是否是编辑操作
                village_list:app_json.village_list,//社区下拉
                selected_village:"",//选中的社区
                owner_list:app_json.owner_list,
                keywords:"",
            },
            mounted:function(){
                if(this.tid){
                    this.edit_init();
                }
                console.log(this.owner_list);
                //初始社区默认操作人所在社区，若没有则选择广发银行大厦village_id
                this.selected_village = "{pigcms{:session('system.village_id')}"||"4";
                //this.is_init = 1;

            },

            computed:{

            },

            methods: {
                //get 方法封装
                _get: function (url, params, callback) {
                    var opt = {
                        'params': params
                    }
                    this.$http.get(url, opt).then(function (response) {
                        // 响应成功回调
                        if (response.body.err == 0) {
                            callback(response.body);
                        } else {
                            alert("发生错误:" + response.body.msg);
                        }
                    }, function (response) {
                        alert(response.status + " 发生错误");
                    });

                },
                //编辑初始化
                edit_init:function(){

                },

                filter_owner:function(item){
                    var keywords = this.keywords,
                        village_id = this.selected_village;
                    var re0 = village_id == "" ? true : item.village_id == village_id;
                    console.log(village_id);
                        //!!item.room_ids;
                    var re1 = keywords==="" ? true : item.ownername.indexOf(keywords)>-1;
                    return re0&&re1;
                }


            },

            watch:{

            }

        });

    </script>
</block>