<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="__SELF__" method="post" enctype="multipart/form-data" id="form">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/员工花名册.xlsx" download="员工花名册模板(基于原有模板).xlsx">
                        下载
                    </a>
                </div>
            </div>

            <div class="form-group form-md-line-input" id="app">
                <label class="col-md-2 control-label" for="form_control_1">选择公司
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                        <select    class="form-control" name="group_id">
                            <foreach name="group_list" item="vo">
                                <option value="{pigcms{$vo.group_id}">{pigcms{$vo.group_name}</option>
                            </foreach>
                        </select>
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
                        <button type="button" class="btn default" onclick="app.redirect('ownerlist_news')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="script">
    <script>
        /* new Vue({
         el:"#app",
         data:{
         list:{pigcms{$project_list},
         company_id:88,
         project_id_change:'2-1'
         },
         computed: {
         project_list: function () {
         /!*var list_second = {};*!/
         var list = this.list[this.company_id]['list'];
         /!*console.log(this.list_third);*!/
         return list;
         }
         },
         methods: {

         }

         });*/

        function submit1() {
            /*var project_id=$('#project_id  option:selected').text();

             if(!project_id){
             swal({
             title: '请选择小区',
             text: "请选择小区后进行上传",
             type:'warning',
             confirmButtonText: "确定"

             },function(){

             }
             );
             }*/
            swal({
                    title: "是否进行批量导入操作?",
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
    </script>
</block>