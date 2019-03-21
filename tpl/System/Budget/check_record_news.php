<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" id="app">
                <div  class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['company_name']}--{pigcms{$record_info['village_name']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属类目</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                                <span>{pigcms{$record_info['type_name']}</span>
                        </div>
                    </div>
                    <if condition="$record_info['record_file_path']">
                        <div class="form-group form-md-line-input">
                            <div class="col-sm-2 control-label">当前已有附件附件凭证</div>
                            <div class="col-md-9" style="padding-top: 7px; font-weight: 600;">
                                <a  href="{pigcms{$record_info['record_file_path']}" download="{pigcms{$record_info['record_file_name']}">点击下载</a>
                            </div>
                        </div>
                    </if>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">条目名称</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_name']}</span>
                        </div>
                        <!--<div class="col-sm-9">
                            <input class="form-control" size="20" name="record_name" id="record_name" type="text" value="{pigcms{$record_info['record_name']}"/>
                        </div>-->
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">金额</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_money']}</span>
                        </div>
                        <!--<div class="col-sm-9">
                            <input  class="form-control number" type="number" size="20" name="record_money" value="{pigcms{$record_info['record_money']}"/>
                        </div>-->
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">日期</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_time']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_remark']}</span>
                        </div>
                    </div>

                    <div id="basicinfo">
                        <div class="form-group">
                            <div class="col-sm-2 control-label">审核状态</div>
                            <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                                <div class="md-radio">
                                    <input name="record_status" type="radio" class="mt-radio" value="1" id="checkbox1_1" v-model="record_status">
                                    <label for="checkbox1_1">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 待审核 </label>
                                </div>
                                <div class="md-radio">
                                    <input name="record_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" v-model="record_status">
                                    <label for="checkbox1_2" class="text-success">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 审核通过 </label>
                                </div>
                                <div class="md-radio">
                                    <input name="record_status" type="radio" class="mt-radio" value="3" id="checkbox1_3" v-model="record_status">
                                    <label for="checkbox1_3" class="text-danger">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 驳回 </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">该类目年度预算金额</div>
                            <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                                <span>{{money_sum}}元</span>
                                <!--<a v-bind:href="url_change" data-toggle="modal" data-target="#common_modal">点击更改预算总额</a>-->
                                <!--                            <input class="form-control" size="20" name="money_sum" id="money_sum" type="text"  v-model="money_sum" />
                                -->                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">已用预算(剩余预算)</div>
                            <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                                <span>{{money_use}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 control-label">审核成功后预计剩余</div>
                            <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                                <span>{{money_cache}}元</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" <if condition="$is_cashier">style="display:none;"</if>>
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
                        <div class="col-sm-2 control-label">归档时间</div>
                        <div class="col-sm-9" >
                            <input placeholder="不填写则默认为审核时间，请注意" class="form-control" size="20" name="record_check_time" id="record_time" type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">支付凭证</div>
                        <div class="col-sm-9" >
                            <input class="form-control" size="20" name="record_number" id="record_number" type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核备注</div>
                        <div class="col-sm-9" >
                        <textarea name="record_check_remark" class="form-control" rows="10" >
                        </textarea>
                        </div>
                    </div>
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
        /*.BMap_cpyCtrl{display:none;}
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
        #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}*/
    </style>
    <!--<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">-->
    <link rel="stylesheet" href="{pigcms{$static_public}css/bootstrap-select.min.css">
</block>
<block name="script">
    <!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
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
        /*Vue.config.devtools = true;*/
        new Vue({
            el:"#basicinfo",
            data:{
                list:{pigcms{$type_list},
                    type_first:{pigcms{$type_first},
                    type_second:{pigcms{$type_second},
                    type_third:{pigcms{$type_third},
                    money_list:{pigcms{$money_list},
                        url:'{pigcms{$url}',
                        record_status:{pigcms{$record_info['record_status']},
                            record_money:{pigcms{$record_info['record_money']}

                            },
                            computed: {
                                list_second: function () {
                                    /*var list_second = {};*/
                                    var list = this.list[this.type_first]['children'];
                                    /*console.log(this.list_third);*/
                                    return list;
                                },
                                list_third:function(){
                                    var cache=this.list[this.type_first]['children'];
                                    var arr = []
                                    for (var i in cache) {
                                        arr[i]=cache[i]; //属性
                                    }
                                    if(arr[this.type_second]){
                                        var list1=this.list[this.type_first]['children'][this.type_second]['children'];
                                    }else{
                                        var list1='';
                                    }
                                    return list1;
                                },
                                money_sum:function () {
                                    if(this.money_list[this.type_third]){
                                        var list1=this.money_list[this.type_third];
                                        var list=list1['money_sum'];
                                        console.log(this.money_list);
                                        return list;
                                    }else{
                                        return '当前项目没有设置预算总额';
                                    }
                                },
                                url_change:function () {
                                    var url=this.url+'&type_id='+this.type_third;
                                    return url;
                                },
                                money_cache:function () {
                                    if(this.money_list[this.type_third]){
                                        var list1=this.money_list[this.type_third];
                                        var list=list1['money_sum']-list1['sum']-this.record_money;
                                        return list;
                                    }else{
                                        return '';
                                    }
                                },
                                money_use:function () {
                                    if(this.money_list[this.type_third]){
                                        var list1=this.money_list[this.type_third];
                                        var cache=list1['money_sum']-list1['sum'];
                                        var list=list1['sum']+'元('+cache+'元)';
                                        return list;
                                    }else{
                                        return '';
                                    }
                                }
                            },
                            methods: {

                            }

                        });
        <if condition="$record_info['cashier_id']">
            $('#cashier_id').selectpicker();
        //初始化多选框
            var cashier_str='{pigcms{$record_info['cashier_id']}';
        $('#cashier_id').selectpicker('val',cashier_str.split(','));
        </if>
    </script>

</block>