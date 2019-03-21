<layout name="layout"/>
<!--引入日历插件样式 -->

<!-- BEGIN CONTENT -->
<style>
    [v-cloak] {
        display: none;
    }
</style>
<div class="page-content-wrapper">

    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
<!--                <h1>Material Design Form Validation-->
<!--                    <small>material design form validation</small>-->
<!--                </h1>-->
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">设备管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">添加设备</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row" id="app" v-cloak>
            <form action="{pigcms{:U('add_meter_act')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
                <div class="col-md-12" style="float: left">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">添加设备</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->

                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> 您填写的信息可能存在问题，请再检查 </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> 添加成功，请查看记录列表 </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">设备编号
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="meter_code" id="cat_name">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>


                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">社区
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="selected_village_id">
                                            <option  value="" selected="selected">请选择</option>
                                            <option value="1" v-for="(village_name,village_id) in village_list" v-bind:value="village_id">
                                                {{village_name}}
                                            </option>
                                        </select>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">楼层单元
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="selected_floor_id" name="floor_id">
                                            <option value="">请选择</option>
                                            <option v-for="(floor,index) in floor_list" v-bind:value="floor.id">{{floor.room_name}}</option>
                                        </select>
                                        <div class="form-control-focus"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label  v-show="room_list.length>0">请选择单元：</label>
                                        <label class="checkbox-inline"  v-for="(room,index) in room_list">
                                            <input type="checkbox" name="room_id[]" v-model="selected_room_id"  class="md-check" v-bind:value="room.id">
                                            {{room.room_name}}
                                        </label>
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">描述
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" v-bind:value="concat_desc" name="meter_desc" class="form-control" placeholder=""  id="cat_url">
                                        <div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">设备类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="meter_type_id" id="" class="form-control" v-model="selected_meter_type" >
                                            <option value="">请选择</option>
                                            <option v-for="(type,index) in meter_type_list" v-bind:value="type.id">{{type.desc}}</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">默认计费类型
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <select name="price_type_id" id="" class="form-control"  v-model="selected_price_type">
                                            <option value="">请选择</option>
                                            <option v-for="(type,index) in price_type_list" v-bind:value="type.id">{{type.desc}}</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
<!--                                上月止码-->
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">止码
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" placeholder="" name="last_cousume" id="cat_url">
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">默认倍率
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" placeholder="" value="1" name="rate"><div class="form-control-focus"></div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-9">
                                            <input type="hidden" name="meter_floor" v-bind:value="meter_floor">
                                            <button type="submit" class="btn green">确认提交</button>
                                            <button type="reset" class="btn default">清空重填</button>
                                            <php>$list_url = U('device_management_news')</php>
                                            <button type="button" onclick="window.location.href='{pigcms{$list_url}'" class="btn default">返回</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="text-align: center">
    <div class="page-footer-inner" style="width: 100%"> 2017 &copy; 汇得行智慧助手系统
        <a target="_blank" href="http://www.vhi99.com">微嗨科技</a> &nbsp;|&nbsp;
        <a href="http://www.metronic.com" target="_blank">Metronic</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/Car/Admin/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Car/Admin/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Car/Admin/Public/js/jquery.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="/Car/Admin/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Car/Admin/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--表单提交检查js-->
<!--<script src="{$Think.config.ADMIN_ASSETS_URL}pages/scripts/form-validation-md.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!--引入百度文件上传JS开始-->
<script src="/Car/Admin/Public/js/baiduwebuploader/webuploader.js" type="text/javascript"></script>
<!--引入百度文件上传JS结束-->

<!--引入日历jquery插件开始-->
<!--
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.js" type="text/javascript"></script>
<script src="{$Think.config.ADMIN_JS_URL}jquery.datetimepicker.min.js" type="text/javascript"></script>-->

<script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<!--引入日历jquery插件结束-->

<script type='text/javascript'>
    //开启日历插件
    $('#datetimepicker').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });
    $('#datetimepicker2').datetimepicker({
        lang:"ch",           //语言选择中文
        format:"Y-m-d H:i:s",      //格式化日期
        timepicker:false,    //关闭时间选项
        yearStart:2000,     //设置最小年份
        yearEnd:2050,        //设置最大年份
        todayButton:false    //关闭选择今天按钮
    });

    /*页面自定义js代码*/
    $("select[name='is_cost']").change(function(){
        var is_cost =  $("select[name='is_cost']").val();
        if(is_cost == 1){
            $("#cost").slideDown(100);
        }else{
            $("#cost").slideUp(100);
        }
    });
var add_meter = new Vue({
    el:"#app",
    data:{
        data_list:[], //所有的楼层单元数据
        village_list:[], //社区select
        floor_list:[], //楼层
        room_list:[], //单元号
        type_data:[], //所有的表类型配置
        meter_type_list:[],
        price_type_list:[],
        selected_meter_type:"",
        selected_price_type:"",
        //选择的社区ID
        selected_village_id:"",
        //选择的楼层ID
        selected_floor_id:"",
        //选择的单元ID
        selected_room_id:[],
        meter_floor:"",
        concat_desc:""
    },
    mounted:function(){
        this.data_list = {pigcms{$room_list_json};
        this.village_list ={pigcms{$village_list_json};
        this.type_data = {pigcms{$type_data_json};
        this.meter_type_list = this.get_meter_type_list();
        this.price_type_list = this.get_price_type_list();
    },
    methods:{
         get_floor_list:function(){
             var selected_village_id = this.selected_village_id;
             var data_list = this.data_list;
             var floor_list = [];
             for(var i in data_list){
                if(data_list[i].fid==0 && data_list[i].village_id==selected_village_id ){
                    floor_list.push(data_list[i]);
                }
             }
             this.floor_list = floor_list;
         },
        get_room_list:function(){
            var selected_floor_id = this.selected_floor_id;
            var data_list = this.data_list;
            var room_list = [];
            for(var i in data_list){
                if(data_list[i].fid==selected_floor_id){
                    room_list.push(data_list[i]);
                }

            }
            //排序
            function compact(r1,r2){
                v1 = parseInt(r1.room_name);
                v2 = parseInt(r2.room_name);
                if(v1>v2){
                    return 1;
                }else if(v1<v2){
                    return -1;
                }else{
                    return 0;
                }
            }
            room_list = room_list.sort(compact);
            this.room_list = room_list;
        },
        set_desc:function(){
            var vdesc =this.selected_village_id?this.village_list[this.selected_village_id]:"";
            var fdesc =this.selected_floor_id?this.data_list[this.selected_floor_id].room_name:"";
            var concat_desc = vdesc + fdesc;
            var limit_room = this.get_limit_room();
            var room_names = this.get_room_names();
            var meter_floor = fdesc;

            if(limit_room){
               concat_desc += "("+room_names.join(',')+")";
               meter_floor += limit_room.join('-');
            }

            this.concat_desc = concat_desc;
            this.meter_floor = meter_floor;
        },
        //获取最小 最大房间号码
        get_limit_room:function(){
            var room_index = this.selected_room_id;
            if(room_index.length>0){
                var max_room = -Infinity ; //无限小
                var min_room = Infinity ;//无限大
                for(var i in room_index){
                    var room = this.data_list[room_index[i]].room_name;
                    max_room = max_room>room ? max_room: room;
                    min_room = min_room<room ? min_room: room;
                }
                if(min_room==max_room){
                    return [min_room];
                }
                return [min_room,max_room];

            }
        },

        get_room_names:function(){
            var room_index = this.selected_room_id;
            var room_names = [];
            if(room_index.length>0){
                for(var i in room_index){
                     room_names.push(this.data_list[room_index[i]].room_name);
                }

            }
            function compact(r1,r2){
                v1 = parseInt(r1);
                v2 = parseInt(r2);
                if(v1>v2){
                    return 1;
                }else if(v1<v2){
                    return -1;
                }else{
                    return 0;
                }
            }
            room_names = room_names.sort(compact);
            return room_names;
        },
        get_meter_type_list:function(){
            var type_data = this.type_data;
            var meter_type_list = [];
            for(var i in type_data){
                if(type_data[i].pid==0){
                    meter_type_list.push(type_data[i]);
                }
            }
            return meter_type_list;
        },
        get_price_type_list:function(){
            var selected_meter_type = this.selected_meter_type;
            if(!selected_meter_type) return [];

            var type_data = this.type_data;
            var price_type_list = [];
            for(var i in type_data){
                if(type_data[i].pid==selected_meter_type){
                    price_type_list.push(type_data[i]);
                }
            }
            return price_type_list;
        }

    },
    watch: {
        selected_village_id: function () {
            this.selected_floor_id = "";
            this.selected_room_id = [];
            this.get_floor_list();
            this.set_desc();
        },
        selected_floor_id:function() {
            this.selected_room_id = [];
            this.get_room_list();
            this.set_desc();
        },
        selected_room_id:function(){
            //排序
            this.set_desc();
        },
        selected_meter_type:function(){
            this.price_type_list = this.get_price_type_list();
        }


    },

});
</script>

</body>

</html>