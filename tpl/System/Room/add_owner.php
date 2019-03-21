<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <form action="{pigcms{:U(ACTION_NAME . '_act')}" class="form-horizontal" method="post">
        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">业主名称
                <span class="required">*</span>
            </label>

            <div class="col-md-9">
                <input type="text" class="form-control" name="ownername" value="{pigcms{$info.ownername}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">物业费起算时间
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="property_start" id="property_start" value="{pigcms{$info.property_start}">
            </div>
        </div>


        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">合同开始时间
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="contract_start" id="contract_start" value="{pigcms{$info.contract_start}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">合同结束时间
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="contract_end" id="contract_end" value="{pigcms{$info.contract_end}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">联系人
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="name" value="{pigcms{$info.name}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">联系方式
                <span class="required">*</span>
            </label>

            <div class="col-md-9">
                <input type="text" class="form-control" name="phone" value="{pigcms{$info.phone}">
            </div>

        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">绑定房间
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <div id="owner_bind_room" v-cloak>
                    <div  class="form-inline">
                        <!--    社区-->
                        <select class="form-control" v-model="selected_village" name="village_id">
                            <option value="">社区</option>
                            <option v-for="(village_name,village_id) in village_list" v-bind:value="village_id">{{ village_name }}</option>
                        </select>
                        <span>{{show_desc()}}</span>
                    </div>
                    <!--    设备列表-->
                    <div style="height:250px;overflow-y: scroll">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>楼层</th>
                                <th>房间号</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(room,index) in fliter_room_tree" >
                                <td>{{ room.floor_name}}</td>
                                <td>
                                    <input name="floor_ids[]" @click="checked_row(room,$event)" type="checkbox" v-bind:value="room.id" class="mt-checkbox">
                                    <strong>全选</strong>
                                    <span v-for="(r,i) in room._child">
                                    <input name="room_ids[]"  v-model="room_ids" type= "checkbox" v-bind:value="r.id" class="mt-checkbox">
                                    <span v-bind:class="{ is_choosed: r.oid }">{{r.room_name}}&nbsp;</span>
                                </span>
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
                    <input type="hidden" name="oid" value='{pigcms{:I("get.oid")}'>
                    <button type="submit" class="btn green">确认提交</button>
                    <button type="reset" class="btn default">重 置</button>
                    <button type="button" class="btn default" onclick="app.redirect('ownerlist_news')">返 回</button>
                </div>
            </div>
        </div>
    </form>
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
        $.datetimepicker.setLocale('ch');//设置中文

        $('#property_start').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            //timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });

        $('#contract_start').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            //timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });

        $('#contract_end').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            //timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
    </script>
    <script>
        new Vue({
            el:'#owner_bind_room',
            data:{
                oid:parseInt('{pigcms{:I("get.oid")}')||0,//是否是编辑操作
                village_list:app_json.village_list,//社区下拉
                selected_village:"",//选中的社区
                room_list:app_json.room_list,//房间列表
                room_tree:app_json.room_tree, //树形结构
                floor_list:[], //楼层列表
                selected_floor:"", // 选择的楼层
                floor_ids:[],
                room_ids:[],
            },
            mounted:function(){
                if(this.oid){
                    this.edit_init();
                }
                //初始社区默认操作人所在社区，若没有则选择广发银行大厦village_id
                this.selected_village = "{pigcms{:session('system.village_id')}"||"4";
                this.is_init = 1;
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
                edit_init:function(){
                    var checked_rooms = "{pigcms{$info.room_ids}" . split(',');
                    this.room_ids = checked_rooms;
                },
                //全选炒作
                checked_row:function(froom,e){
                   var row_cids = this.get_children_id(froom.id);
                   var checked = e.target.checked;
                   var room_ids = this.room_ids;
                   if(checked){//全部选择
                        room_ids = _.union(room_ids,row_cids);
                   }else{//全部取消
                        room_ids = _.difference(room_ids,row_cids);
                   }
                   this.room_ids = room_ids;
                },

                //获取fid底下的cid
                get_children_id:function(fid){
                    var room_tree = this.room_tree;
                    var children = [];
                    var cids = [];
                    for(var i in room_tree){
                        if(room_tree[i]['id']==fid){
                            children = room_tree[i]['_child'];
                        }
                    }

                    for(var i in children){
                        cids.push(children[i]['id']);
                    }
                    return cids;
                },

                //获取房间id的同层楼的所有id
                get_siblings_id:function(id){

                },
                //显示已经选择的房间号码
                show_desc:function(){
                    var room_ids = this.room_ids;
                    var room_list = this.room_list;
                    var desc = [];
                    for (var i in room_list){
                        var room  = room_list[i];
                        if(room_ids.indexOf(room.id)>-1){
                            desc.push( room.floor_name+"-"+room.room_name)
                        }
                    }
                    return desc.join(',');
                }


            },

            computed:{
                fliter_room_tree:function(){
                    let fliter_list = [];
                    for(let i in this.room_tree){
                        let row = this.room_tree[i];
                        if(row.village_id==this.selected_village){
                            fliter_list.push(row);
                        }
                    }
                    return fliter_list;
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