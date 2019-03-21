<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">所属项目</div>
                        <div class="col-sm-9" >
                            <select class="form-control" name="project_id_change">
                                <foreach name="project_list" item="vo">
                                    <option value="{pigcms{$key}">{pigcms{$vo['name']}</option>
                                </foreach>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-sm-2 control-label">文件上传</div>
                        <div class="col-md-9">
                            <label for="file" class=" btn btn-default" id="file_button">点击上传文件</label>
                            <input type="file" id="file" name="test" style="display:none;"  onchange="change_text(this,'file_button')">
                            <span style="color: red">*使用以前做账目的表格上传，上传时请删除去年12月份的预算账目</span>
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