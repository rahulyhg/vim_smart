<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/水电表抄表记录初始化表.xls" download="水电表抄表记录初始化表.xls">
                        下载
                    </a>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">导入说明
                </label>

                <div class="col-md-9">
                    <span class="red">
                        1.表中日期项目可以无限往后添加。<br>
                        2.起码如果没有可以不填或者填0
                    </span>
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
                        <button type="button" class="btn green" onclick="submit1()">确认提交</button>
                        <!--<button type="submit" class="btn green">确认提交</button>-->
                        <button type="button" class="btn default" onclick="window.location.history(-1)">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="script">
    <script>

        function submit1() {
            swal({
                    title: "当前操作为初始化操作，将往期抄表记录导入，一块表仅能进行一次，请确认",
                    text: "请确认",
                    type: "warning",
                    html:true,
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
</block>