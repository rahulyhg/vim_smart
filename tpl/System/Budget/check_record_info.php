<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <if condition="$is_finance">
            <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__">
                <else/>
                <div class="form-horizontal">
        </if>
            <div class="tab-content" id="app">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['company_name']}--{pigcms{$record_info['village_name']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属类目</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['type_name']}</span>
                        </div>
                    </div>
                    <if condition="$record_info['record_number']">
                        <div class="form-group">
                            <div class="col-sm-2 control-label">支付凭证</div>
                            <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                                <span>{pigcms{$record_info['record_number']}</span>
                            </div>
                        </div>
                    </if>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">条目名称</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_name']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">金额</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_money']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">日期</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_time']}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{$record_info['record_remark']}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核状态</div>
                        <div class="col-sm-9" style="padding-top: 7px; font-weight: 600;">
                            <div class="md-radio">
                                <input name="record_status" type="radio" class="mt-radio" value="1" id="checkbox1_1" >
                                <label for="checkbox1_1">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 待审核 </label>
                            </div>
                            <div class="md-radio">
                                <input name="record_status" type="radio" class="mt-radio" value="2" id="checkbox1_2" >
                                <label for="checkbox1_2" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 审核通过 </label>
                            </div>
                            <div class="md-radio">
                                <input name="record_status" type="radio" class="mt-radio" value="3" id="checkbox1_3" >
                                <label for="checkbox1_3" class="text-danger">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> 驳回 </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核时间</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{:$record_info['record_audit_time']?date('Y年m月d日 H:i:s',$record_info['record_audit_time']):''}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">归档时间</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                            <span>{pigcms{:$record_info['record_record_time']?date('Y年m月d日 H:i:s',$record_info['record_record_time']):''}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">审核备注</div>
                        <div class="col-sm-9 check" style="padding-top: 7px; font-weight: 600;">
                        <span>{pigcms{$record_info['record_check_remark']}</span>
                        </div>
                    </div>
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
        <if condition="$is_finance">
            <div class="form-group">
                <div class="col-sm-2 control-label">支付凭证</div>
                <div class="col-sm-9" >
                    <input class="form-control" size="20" name="record_number" id="record_number" type="text" value="{pigcms{$record_info['record_number']}"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">归档时间设置</div>
                <div class="col-sm-9" >
                    <input class="form-control" name="record_check_time" id="record_check_time" type="text" value="{pigcms{:date('Y-m-d',$record_info['record_check_time'])}" autocomplete="off"/>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="reset" class="btn default" onclick="window.location.history(-1)">返 回</button>
                    </div>
                </div>
            </div>
        </if>
            <div class="space"></div>
    </div>
    <if condition="$is_finance">
        </form>
        <else/>
        </div>
    </if>
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
        .check{
            padding-top: 7px;
        }
    </style>
    <link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
</block>
<block name="script">
    <!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
    <script type="text/javascript">
        $.datetimepicker.setLocale('ch');
        $('#record_check_time').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            startDate:'{pigcms{:$record_info['record_check_time']?date('Y-m-d',$record_info['record_check_time']):date('Y-m-d')}',
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false      //关闭鼠标滚轮事件
         });
        //默认选中
        $("input[name|='record_status'][value|='{pigcms{$record_info['record_status']}']").attr('checked','checked');
    </script>

</block>