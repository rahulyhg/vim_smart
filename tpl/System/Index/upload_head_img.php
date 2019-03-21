<link href="/Car/Admin/Public/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="/Car/Admin/Public/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">上传头像图片</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">上传头像图片
                （ <small class="text-danger inline">上传文件需小于3M</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <form action="{pigcms{:U('upload_head_img')}" method="post" enctype="multipart/form-data">
                <input name="upload" type="file"/><br/><br/>
                <input type="submit" value="提交" class="btn green-haze btn-outline sbold uppercase"/>
            </form>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
