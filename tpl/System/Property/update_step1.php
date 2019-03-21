<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="{pigcms{:U('update_step2')}" id="form" method="post" enctype="multipart/form-data" >
            <!--<div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/业主信息导入格式表3.xls" download="业主信息导入格式表.xls">
                        下载
                    </a>
                </div>
            </div>-->

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
            <div class="form-group form-md-line-input">
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
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择类型
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <div class="md-checkbox-list">
                        <foreach name="fee_type" item="row" key="key">
                            <div class="md-radio">
                                <input name="fee_lastyear_id" for="{pigcms{$row['otherfee_type_name']}" type="radio" class="mt-radio" value="{pigcms{$row['otherfee_type_id']}" id="checkbox2_{pigcms{$key}">
                                <label for="checkbox2_{pigcms{$key}" class="text-success">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span> {pigcms{$row['otherfee_type_name']} </label>
                            </div>
                        </foreach>
                    </div>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">年
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                                <input name="year"  type="text"  value="{pigcms{$row['pigcms_id']}">
                </div>
            </div>

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
                        <button type="button" class="btn default" onclick="app.redirect('ownerlist_uptown_news')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            function submit1() {
                var project_id=$("input[name='project_id']:checked").attr('for');

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
                        title: "是否对"+project_id+"进行上传业主/房屋信息操作?",
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
    </div>

</block>
<block name="script">

</block>