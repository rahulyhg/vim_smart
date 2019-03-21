<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <link href="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/fileinput.min.css" rel="stylesheet" type="text/css"/>
    <div>
        <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/考勤导入模板.xls" download="考勤导入模板.xls">
                        下载
                    </a>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">导入员工考勤汇总表
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="file" id="test" class="form-control" name="test" data-show-preview="false">
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">所属部门
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <span>{pigcms{$department_name}</span>
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">考勤员
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="ci_name" value="{pigcms{$ci_name}">
                </div>
            </div>
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">部门/服务中心负责人
                    <span class="required">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="pm_name" value="{pigcms{$pm_name}">
                </div>
            </div>
            <div class="form-group form-md-line-input" >
                <label class="col-md-2 control-label" for="form_control_1">上传附件(如请假单等，文档图片皆可)
                </label>
                <div class="col-md-9">
                    <input id="itemImagers" name="" type="file" data-show-preview="true" data-show-caption="true" multiple>
                    <input id="content" name="content" type="hidden" value="{pigcms{$schArr['content']}">
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="button" class="btn green" onclick="submit1()">确认提交</button>
                        <button type="button" class="btn default" onclick="app.redirect('check_in_list')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="script">
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/fileinput.min.js"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/piexif.js"></script>
    <script src="/Car/Admin/Public/assets/global/plugins/bootstrap-fileinput/zh.min.js"></script>
    <script>
        function submit1() {
            swal({
                    title: "是否进行导入操作?",
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
                        swal({title:"正在上传导入，请耐心等待。",showLoaderOnConfirm:true});
                        $('#form').submit();
                    } else {

                    }
                });
        }

            //指定上传controller访问地址
            var path = "{pigcms{:U('img_upload')}";
            //页面初始化加载initFileInput()方法传入ID名和上传地址
        var control = $('#itemImagers');
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: path,  //上传地址
            showUpload: false, //是否显示上传按钮
            showRemove:true,
            dropZoneEnabled: false,
            showCaption: true,//是否显示标题
            maxFileSize : 2000,
            maxFileCount: 5,
            overwriteInitial: false, //不覆盖已存在的图片
            //下面几个就是初始化预览图片的配置


        }).on("filebatchselected", function(event, files) {
            $(this).fileinput("upload");
        })
            .on("fileuploaded", function(event, data) {
                $('#content').val($('#content').val()+','+data.response.data);
                console.log(data);
            }).on("filesuccessremove", function(event, id) {
                console.log(event);
                console.log(id);
            }).on('filepredelete', function(event, key, jqXHR, data) {
            console.log('Key = ' + key);
            console.log(jqXHR);
            console.log(data);
        });

        $('#test').fileinput({
            language: 'zh', //设置语言
            showUpload: false, //是否显示上传按钮
            showRemove:true,
            dropZoneEnabled: false,
            showCaption: true,//是否显示标题
            maxFileSize : 2000,

        })
    </script>
</block>