<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" >
                <div id="basicinfo" class="tab-pane active">
                    <div id="filter">
                        <div class="form-group">
                            <div class="col-sm-2 control-label">所属项目</div>
                            <div class="col-sm-9" >

                                <div class="btn-group">
                                    <select  id="company_id"  class="form-control search" v-model="company_id">
                                        <option v-for="(index,key) in list" v-bind:value="key">{{index['deptname']}}</option>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <select name="project_id_change" id="project_id"  class="form-control search" v-model="project_id_change" onchange="change_cashier(this.options[this.options.selectedIndex].value)">
                                        <option v-for="(index1,key1) in project_list" v-bind:value="key1">{{index1}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">类目选择</div>
                            <div class="col-sm-9" >
                                <div class="btn-group" >
                                    <select class="form-control" v-model="type_first">
                                        <option v-for="(item,index) in type_list" v-bind:value="item.type_id" >{{item['type_name']}}</option>
                                    </select>
                                </div>
                                <div class="btn-group" >
                                    <select class="form-control" v-model="type_second">
                                        <option v-for="(item1,index1) in list_second" v-bind:value="item1.type_id" >{{item1['type_name']}}</option>
                                    </select>
                                </div>
                                <div class="btn-group" >
                                    <select class="form-control" name="type_id" v-model="type_third">
                                        <option v-for="(item2,index2) in list_third" v-bind:value="item2.type_id" >{{item2['type_name']}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">年度预算金额</div>
                            <div class="col-sm-9" style="padding-top: 7px">
                                <span style="font-weight:bold; color:#f36a5a">{{money_sum}}</span>
                                <!--<a v-bind:href="url_change" data-toggle="modal" data-target="#common_modal">点击更改预算总额</a>-->
                                <!--                            <input class="form-control" size="20" name="money_sum" id="money_sum" type="text"  v-model="money_sum" />
                                -->                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">可用预算</div>
                            <div class="col-sm-9" style="padding-top: 7px">
                                <span style="font-weight:bold; color:#32c5d2;">{{money_use}}元</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">条目名称</div>
                        <div class="col-sm-9">
                            <input class="form-control" size="20" name="record_name" id="record_name" type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">金额</div>
                        <div class="col-sm-9">
                            <input  class="form-control number" type="text" size="20" name="record_money" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">日期</div>
                        <div class="col-sm-9">
                            <input  class="form-control" name="record_time" id="record_time" value="{pigcms{:date('Y-m-d')}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9" >
                            <textarea name="record_remark" class="form-control" rows="10" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核状态</div>
                        <div class="col-sm-9" style="padding-top: 7px">
                            <div class="md-radio">
                                <input name="record_status" type="radio" class="mt-radio" value="1" id="checkbox1_1"  >
                                <label for="checkbox1_1">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 待审核 </label>
                            </div>
                            <!--<div class="md-radio">
                                <input name="record_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" >
                                <label for="checkbox1_2" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 审核通过 </label>
                            </div>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">选择可见出纳</div>
                        <div class="col-md-9">
                            <select class="form-control  selectpicker" title="不选中则默认仅财务可见"  name="cashier_id[]" id="cashier_id" multiple="multiple">
                                <volist name="cashier_list" id="v">
                                    <option value="{pigcms{$v.cashier_id}"  >{pigcms{$v.account}</option>
                                </volist>
                            </select>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">支付凭证</div>
                        <div class="col-sm-9" >
                            <input class="form-control" size="20" name="record_number" id="record_number" type="text" />
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2 control-label">附件凭证上传</div>
                        <div class="col-md-9">
                            <label for="file" class=" btn btn-default" id="file_button">点击上传文件</label>
                            <input type="file" id="file" name="record_file" style="display:none;"  onchange="change_text(this,'file_button')">
                            <span style="color: red">*多个文件时请先打包成压缩包再上传</span>
                        </div>
                    </div>
                    <if condition="$record_info['record_file_path']">
                        <div class="form-group form-md-line-input">
                            <div class="col-sm-2 control-label">当前已有附件附件凭证</div>
                            <div class="col-md-9">
                                <a style="padding-top: 7px" href="{pigcms{$record_info['record_file_path']}" download="{pigcms{$record_info['record_file_name']}">点击下载</a>
                            </div>
                        </div>
                    </if>
                </div>
            </div>
            <div class="space"></div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default" onclick="window.location.history(-1)">返 回</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</block>
<!--<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>-->
<block name="head">
    <style>
        .BMap_cpyCtrl{display:none;}
        input.ke-input-text {
            background-color: #FFFFFF;
            background-color: #FFFFFF!important;
            font-family: "sans serif",tahoma,verdana,helvetica;
            font-size: 12px;
            line-height: 24px;
            height: 24px;
            padding: 2px 4px;
            border-color: #848484 #E0E0E0 #E0E0E0 #848484;
            border-style: solid;
            border-width: 1px;
            display: -moz-inline-stack;
            display: inline-block;
            vertical-align: middle;
            zoom: 1;
        }
        .col-sm-1{width: 12%}
        .col-sm-2{width: 20%}
        .form-group>label{font-size:12px;line-height:24px;}
        #upload_pic_box{margin-top:20px;height:150px;}
        #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
        #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
    </style>
    <link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
    <link rel="stylesheet" href="{pigcms{$static_public}css/bootstrap-select.min.css">
</block>
<block name="script">
    <script src="{pigcms{$static_public}js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $.datetimepicker.setLocale('ch');
        $('#record_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: false
        });
        $('#checkbox1_1').click();
    </script>
    <script>
        new Vue({
            el:"#filter",
            data:{
                list:{pigcms{$project_list_json},
                    type_list:'',
                    money_list:'',
                    company_id:'2',
                    type_first:1,
                    type_second:5,
                    type_third:8,
                    project_id_change:'',
                    year:'{pigcms{$year}',
                    cashier_list_village:{pigcms{$cashier_list_village}
                },
                computed: {
                    project_list: function () {
                        /*var list_second = {};*/
                        var list = this.list[this.company_id]['list'];
                        /*console.log(this.list_third);*/
                        /*var get=this;*/
                            var get=this;
                            var list_cache=Object.keys(list);
                            var type_list=list_cache[0];
                            get.$set(get.$data,'project_id_change',type_list);
                        /*get.$set(get.$data,'project_id_change','71');*/
                        return list;
                        
                    },
                    /*type_list_all:function () {

                     var project_id_change=this.project_id_change;
                     console.log(project_id_change);
                     var type_list_all='';
                     var get=this;
                     $.ajax({
                     url:'{pigcms{:U("Budget/ajax_get_money_list")}',
                     type:'post',
                     data:'project_id_change='+project_id_change,
                     dataType:'json',
                     success:function (res) {
                     type_list_all=res.type_list;
                     //设定type_list与money_list
                     console.log(type_list_all);
                     get.$set(get.$data,'type_list',res.type_list);
                     get.$set(get.$data,'money_list',res.money_list);
                     }
                     });
                     return Object.values(type_list_all);
                     },*/
                    list_second: function () {
                        /*var list_second = {};*/
                        if(!this.type_list) return '';
                        if(this.type_list[this.type_first]){
                            //var list1=this.list[this.type_first]['children'][this.type_second]['children'];
                            var list=this.type_list[this.type_first]['children'];
                        }else{
                            var list='';
                        }
                        if(list&&!list[this.type_second]){
                            var get=this;
                            var list_cache=Object.values(list);
                            var type_list=list_cache.shift();
                            get.$set(get.$data,'type_second',type_list['type_id']);
                        }
                        return list;
                    },
                    list_third:function(){
                        if(this.list_second[this.type_second]){
                            //var list1=this.list[this.type_first]['children'][this.type_second]['children'];
                            var list1=this.list_second[this.type_second]['children'];
                        }else{
                            var list1='';
                        }
                        if(list1&&!list1[this.type_third]){
                            var get=this;
                            var list_cache=Object.values(list1);
                            var type_list=list_cache.shift();
                            get.$set(get.$data,'type_third',type_list['type_id']);
                        }
                        return list1;
                    },
                    money_sum:function () {
                        if(this.money_list[this.type_third]){
                            var list1=this.money_list[this.type_third];
                            var list=list1['money_sum']+'元    已使用:'+list1['sum']+'元';
                            return list;
                        }else{
                            return '该类目未设置预算总额';
                        }
                    },
                    money_use:function () {
                        if(this.money_list[this.type_third]){
                            var list1=this.money_list[this.type_third];
                           //var cache=list1['money_sum']-list1['sum'];
                            //var list=list1['sum']+'元('+cache+'元)';
                            var list=list1['money_sum']-list1['sum'];
                            return list;
                        }else{
                            return '';
                        }
                    }
                },
                methods: {

                },
                watch: {
                    'project_id_change': function(newVal){
                        var project_id_change=newVal;
                        var type_list_all='';
                        var get=this;
                        $.ajax({
                            url:'{pigcms{:U("Budget/ajax_get_money_list")}',
                            type:'post',
                            data:'project_id_change='+project_id_change,
                            dataType:'json',
                            success:function (res) {
                                type_list_all=res.type_list;
                                //设定type_list与money_list
                                get.$set(get.$data,'type_list',res.type_list);
                                get.$set(get.$data,'money_list',res.money_list);
                            }
                        });
                    }
                }

            });
        function change_text(input,change) {
            $('#'+change).html('已选择：'+$(input).val());
        }
        function change_cashier(project_id_change) {
            cashier_list_village={pigcms{$cashier_list_village};
            var village_id=project_id_change.split('-')['0'];
            console.log(village_id);
            console.log(cashier_list_village[village_id]);
            if(cashier_list_village[village_id]){
                $('#cashier_id').selectpicker('val',cashier_list_village[village_id]);
            }else{
                $('#cashier_id').selectpicker('deselectAll');
            }
        }
        //设置默认选中
        /*$('#project_id').val('71');*/
    </script>
</block>