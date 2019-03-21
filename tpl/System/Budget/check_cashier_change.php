<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__">
            <div class="tab-content">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">出纳人员</div>
                        <div class="col-sm-9">
                            <input class="form-control" size="20"  readonly="readonly" type="text" value="{pigcms{$cashier_info['admin_info']['account']}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目（影响默认选中）</div>
                        <div class="col-md-9">
                            <select class="form-control  selectpicker" title="不选无影响"  name="cashier_village_id[]" id="cashier_village_id" multiple="multiple" data-live-search="true">
                                <volist name="village_list" id="v">
                                    <option value="{pigcms{$v.village_id}"  >{pigcms{$v.village_name}</option>
                                </volist>
                            </select>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-2 control-label" >是否开启
                        </div>
                        <div class="col-sm-2">
                            <div class="md-checkbox-list">
                                <div class="md-radio">
                                    <input name="type_status" type="radio" class="mt-radio" value="1" id="checkbox1_1" v-model="status">
                                    <label for="checkbox1_1" class="text-success">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 是 </label>
                                </div>
                                <div class="md-radio">
                                    <input name="type_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" v-model="status">
                                    <label for="checkbox1_2" class="text-danger">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> 否 </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9" >
                        <textarea name="remark" class="form-control" rows="10" >
                            {pigcms{$cashier_info.remark}
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
                        <button type="reset" class="btn default" onclick="window.location.href='http://www.hdhsmart.com/admin.php?g=System&c=House&a=village_news'">返 回</button>
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
                status:<if condition="$cashier_info['status']">{pigcms{$cashier_info['status']}<else/>1</if>
            },
        computed:{

        },
        methods: {

        }

        });
        $('#cashier_village_id').selectpicker();
        <if condition="$type_info['type_company_id']">
            var str='{pigcms{$cashier_info['cashier_village_id']}';
        $('#cashier_village_id').selectpicker('val',str.split(','));
        <else/>
        $('#cashier_village_id').selectpicker('val',0);
        </if>

    </script>

</block>