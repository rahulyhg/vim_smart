<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
    <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__">
        <div class="tab-content">
            <div id="basicinfo" class="tab-pane active">
                <div class="form-group">
                    <div class="col-sm-2 control-label">类目名称</div>
                    <div class="col-sm-9">
                        <input class="form-control" size="20" name="type_name" id="type_name" type="text" value="{pigcms{$type_info.type_name}"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">类目级别</div>
                    <div class="col-sm-9">
                        <select name="type_rank" class="form-control" v-model="select_type_rank">
                            <option value="1" >一级分类</option>
                            <option value="2" >二级分类</option>
                            <option value="3" >三级分类</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">父类目</div>
                    <div class="col-sm-9">
                        <select name="type_fid" class="form-control"  v-model="type_id">
                            <option v-bind:value="item.type_id" v-for="(item,index) in list_select">{{item.type_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">所属公司</div>
                    <div class="col-md-9">
                        <select class="form-control  selectpicker" title="全部公司通用（如果为二三级分类，则会继承父类目所选的公司）"  name="type_company_id[]" id="type_company_id" multiple="multiple">
                            <volist name="company_list" id="v">
                                <option value="{pigcms{$v.id}"  >{pigcms{$v.deptname}</option>
                            </volist>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-sm-2 control-label" >是否在执行主表中展示
                    </div>
                    <div class="col-sm-2">
                        <div class="md-checkbox-list">
                            <div class="md-radio">
                                <input name="type_status" type="radio" class="mt-radio" value="1" id="checkbox1_1" v-model="type_status">
                                <label for="checkbox1_1" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 是 </label>
                            </div>
                            <div class="md-radio">
                                <input name="type_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" v-model="type_status">
                                <label for="checkbox1_2" class="text-danger">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 否 </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">排序(同一级别下越大越靠前)</div>
                    <div class="col-sm-9" >
                        <input class="form-control" size="20" name="type_sort" type="text" value="{pigcms{$type_info.type_sort}"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label">备注</div>
                    <div class="col-sm-9" >
                        <textarea name="type_remark" class="form-control" rows="10" >
                            {pigcms{$type_info.type_remark}
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
                    <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=Budget&a=type_list'">返 回</button>
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
        new Vue({
                el:"#type_form",
                data:{
                    list:{pigcms{$type_list},
                    select_type_rank:<if condition="$type_info['type_rank']">{pigcms{$type_info['type_rank']}<else/>1</if>,
                    type_id:<if condition="$type_info['type_fid']">{pigcms{$type_info['type_fid']}<else/>0</if>,
                    type_status:<if condition="$type_info['type_status']">{pigcms{$type_info['type_status']}<else/>1</if>
        },
        computed:{
            list_select:function(){
                var list_select = {};
                if(this.select_type_rank==1){
                    list_select= {
                        "0": [{
                            "type_id": "0",
                            "type_name": "顶级类目无需选择",
                        }]
                    };
                }else{
                    var type_rank=this.select_type_rank-1;
                    for(var i in this.list){
                        if(this.list[i].type_rank == type_rank ){
                            list_select[i] = this.list[i];
                        }
                    }
                }
                return list_select
            },
        },
        methods: {

        }

        });
        $('#type_company_id').selectpicker();
        <if condition="$type_info['type_company_id']">
                var str='{pigcms{$type_info['type_company_id']}';
                $('#type_company_id').selectpicker('val',str.split(','));
                <else/>
                $('#type_company_id').selectpicker('val',0);
        </if>

    </script>

</block>