<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">条目名称</div>
                        <div class="col-sm-9">
                            <input class="form-control" size="20" name="record_name" id="record_name" type="text" value="{pigcms{$record_info['record_name']}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">金额</div>
                        <div class="col-sm-9">
                            <input  class="form-control number" type="number" size="20" name="record_money" value="{pigcms{$record_info['record_money']}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">日期</div>
                        <div class="col-sm-9">
                            <input  class="form-control" name="record_time" id="record_time" value="{pigcms{$record_info['record_time']}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9" >
                        <textarea name="record_remark" class="form-control" rows="10" >{pigcms{$record_info['record_remark']}</textarea>
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
                            <div class="col-md-9" style="padding-top: 7px">
                                <a href="{pigcms{$record_info['record_file_path']}" download="{pigcms{$record_info['record_file_name']}">点击下载</a>
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
</block>
<block name="script">
    <script type="text/javascript">
        $.datetimepicker.setLocale('ch');
        $('#record_time').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth: false
        });
        function change_text(input,change) {
            $('#'+change).html('已选择：'+$(input).val());
        }
    </script>

</block>