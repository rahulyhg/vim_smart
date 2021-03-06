<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>智慧停车场系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta content="Preview page of Metronic Admin Theme #4 for bootstrap inputs, input groups, custom checkboxes and radio controls and more" name="description" />
    <meta content="" name="author" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/example.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="./Car/Home/Public/statics/plublic/css/weui.min.css" rel="stylesheet" type="text/css" />
    <script src="./Car/Home/Public/statics/plublic/js/zepto.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/router.min.js"></script>
    <script src="./Car/Home/Public/statics/plublic/js/example.js"></script>
    <style type="text/css">
        <!--
        .we {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we:hover {background-color:#389ffe; color:#FFFFFF;}

        .we2 {width:30%; border-radius:8px; border:1px #389ffe solid; float:left; margin-left:2%; margin-bottom:10px; color:#389ffe; text-align:center; padding-top:10px; padding-bottom:10px;}
        .we2:hover {background-color:#389ffe; color:#FFFFFF;}

        .weui_btn_primary {
            background-color: #389ffe;
        }
        .weui_btn_primary:not(.weui_btn_disabled):active {
            color: #ffffff;
            background-color: #2e8ce2;
        }
        -->
    </style></head>
<script>
    document.addEventListener('touchstart',function(){},false);
</script>
<body>
<div id="tenant_bind_room">
    <div class="form-inline">
        <div class="form-inline">
            <!--    社区-->
            <select class="form-control" v-model="selected_village">
                <option value="">社区</option>
                <option v-for="(village_name,village_id) in village_list" v-bind:value="village_id">{{ village_name }}</option>
            </select>
            <!--    楼层-->
            <select class="form-control" v-model="selected_floor">
                <option value="">楼层</option>
                <option v-for="(floor,index) in floor_list" v-bind:value="floor.id">{{ floor.floor_name }}</option>
            </select>
        </div>
    </div>
    <!--    设备列表-->
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>楼层</th>
            <th>房间号</th>
<!--            <th>业主</th>-->
<!--            <th>设备</th>-->
            <th colspan="2">绑定入住单位</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(room,index) in room_list" v-show="search_room(room)" v-bind:class="{ 'bg-info': room.fid==0 }">
            <td>{{ room.floor_name }}</td>
            <td>{{ room.room_name}}</td>
<!--            <td>-->
<!--                <p v-for="(ownername,index) in room.ownernames.split(',')">{{ownername}}</p>-->
<!--            </td>-->
<!--            <td>-->
<!--                <p v-for="(meter_code,index) in room.meter_codes.split(',')">{{meter_code}}</p>-->
<!--            </td>-->
<!--            <td>{{ room.tenantname}}</td>-->
            <td>
                <button v-if="check_bind_status(room)===0" class="btn btn-default btn-sm"  @click="bind_room(room)">绑定</button>
                <button v-if="check_bind_status(room)===1" class="btn btn-danger btn-sm" @click="unbind_room(room)" >解绑</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/vue-resource.min.js"></script>
<script src="./static/js/vuex.js"></script>
<script>
    new Vue({
        el:'#tenant_bind_room',
        data:{
            village_list:app_json.village_list,//社区下拉
            selected_village:"",//选中的社区
            room_list:app_json.room_list,//房间列表
            floor_list:[], //楼层列表
            selected_floor:"", // 选择的楼层
            modal_tid : "{pigcms{$tid}" //当前弹出层归属的业主id
        },
        mounted:function(){
            //初始社区默认操作人所在社区，若没有则选择广发银行大厦village_id
            this.selected_village = "{pigcms{:session('system.village_id')}"||"4";
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

            //房间过滤
            search_room:function(room){
                var village_filter  = this.selected_village == "" ? true : room.village_id == this.selected_village;
                var floor_filter = this.selected_floor == "" ? true : room.fid == this.selected_floor;
                return village_filter && floor_filter;
            },

            //获取当前业主的绑定状态
            check_bind_status:function(room){
                var
                    c1 = room.fid==0,//条件1 是否是楼层
                    c2 = !!parseInt(room.tid), //条件2  是否绑定过
                    c3 = room.tid == this.modal_tid; //条件3 是否是当前入住单位绑定的

                if(c1)  return -1;//楼层不是房间 不可操作
                if(c2&&c3) return 1;//绑定过 并且是自己绑定的 显示解绑按钮
                if(!c2) return  0; //未绑定 显示绑定按钮
            },

            //绑定房间
            bind_room:function(room){
                this._get('{pigcms{:U("pay_bind_room_act")}',{
                    room_id:room.id,
                    tid:"{pigcms{$tid}"
                },function(res){
                    room.tid = res.data.tid;
                    room.tenantname = res.data.tenantname;
                })
            },
            //解绑房间
            unbind_room:function(room){
                this._get('{pigcms{:U("pay_unbind_room_act")}',{
                    room_id:room.id,
                    tid:"{pigcms{$tid}"
                },function(res){
                    room.tid = res.data.tid;
                    room.tenantname = res.data.tenantname;
                })
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
</body>
</html>