<extend name="./tpl/System/Public_news/base_form.php"/>
<link href="/Car/Admin/Public/assets/global/plugins/plugins.min.css" rel="stylesheet" type="text/css" />
<block name="body">
    <div>
        <form action="{pigcms{:U('water_uptown_import_step2')}" id="form" method="post" enctype="multipart/form-data" >
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/业主信息导入格式表5.xls" download="业主信息导入格式表.xls">
                        下载
                    </a>
                </div>
            </div>

            <label class="col-md-2 control-label" for="form_control_1">选择月份
                <span class="required"></span>
            </label>
            <div class="input-group input-large date-picker input-daterange">
                <input type="text" class="form-control" name="start_time" id="time_from">
                <span class="input-group-addon"> to </span>
                <input type="text" class="form-control" name="end_time" id="time_to" onchange="">
            </div>

            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择社区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="village_id" class="form-control">
                        <foreach name="village_list" item="row" key="key">
                            <option value="{pigcms{$key}">{pigcms{$row}</option>
                        </foreach>
                    </select>
                </div>
            </div>-->
            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择园区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <div class="md-checkbox-list">
                        <foreach name="project_list" item="row" key="key">
                                <div class="md-radio">
                                    <input name="project_id" for="{pigcms{$row['desc']}" type="radio" class="mt-radio" value="{pigcms{$row['pigcms_id']}" id="checkbox1_{pigcms{$key}">
                                    <label for="checkbox1_{pigcms{$key}" class="text-success">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {pigcms{$row['desc']} </label>
                                </div>
                        </foreach>
                    </div>
                </div>
            </div>-->

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">导入文件
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <input type="file" class="form-control" name="test">
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <input type="button" class="btn green" onclick="submit1()" value="确认提交"/>
                        <!--<button type="submit" class="btn green" >确认提交</button>-->
                        <button type="button" class="btn default" onclick="app.redirect('PropertyService/room_list_uptown')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--引入js-->
    <include file="Public_news:script"/>
    <!--引入js-->

    <!--自定义js代码区开始-->
    <script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
    <script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
    <!-- <script src="/Car/Admin/Public/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
     -->
    <link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
    <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
        <script>
            function submit1() {
                var project_id='{pigcms{$project_info['desc']}';

                if(!project_id){
                    swal({
                            title: '请选择小区',
                            text: "请选择小区后进行上传",
                            type:'warning',
                            confirmButtonText: "确定"

                        },function(){

                        }
                    );
                }
                swal({
                        title: "是否批量上传水电费信息",
                        text: "请确认",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确认",
                        cancelButtonText: "取消",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $('#form').submit();
                        } else {

                        }
                    });
            }
        </script>
        <!--获取日期时间插件 -->
        <script type="text/javascript">
            $.datetimepicker.setLocale('ch');
            $('#time_from').datetimepicker({
                format: 'Y/m/d',
                lang:"zh",
                timepicker:false
            });
            $('#time_to').datetimepicker({
                format: 'Y/m/d',
                lang:"zh",
                timepicker:false
            });
        </script>

</block>
<block name="script">

</block>