<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">添加到考试列表</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <form action="{pigcms{:U('Exam/create_text_save_news')}" method="post" class="form-horizontal" id="form_sample_1" enctype="multipart/form-data">
        <input type="datetime-local" name="text_time" /> <br /><br />
        <input type="hidden" name="id" value="{pigcms{$id}" >
        <input type="submit" value="添加" />
    </form>
</div>
<div class="modal-footer">
    <!--<button type="button" class="btn btn-info" style="float: left;" id="update" data-usernum = "{pigcms{$Think.get.usernum}">手动更新此账单</button>-->
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
