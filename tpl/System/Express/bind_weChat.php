<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">绑定微信</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">{pigcms{$userInfo.name}
                （ <small class="text-danger inline">电话：{pigcms{$userInfo.phone}</small>
                ）
            </span>
        </div>
        <div class="form-horizontal">
            <input type="hidden" class="form-control" name="id" value="{pigcms{$Think.get.id}"/>
            <div class="panel-body">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">微信名称
                            <span class="required">(*)</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nickname"/>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn btn-primary" id="bind">确认</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<if></if>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script src="http://www.hdhsmart.com/Car/Admin/Public/assets/global/scripts/jquery.autocompleter.js" type="text/javascript"></script>

<script type='text/javascript'>
    //开启自动完成
    $(function(){
        //清除缓存的时候打开！（定期清理）
        //$.autocompleter('clearCache');
        $("input[name='nickname']").autocompleter({
            source: "{pigcms{:U('ajax_to_autocomplete')}",
            autoFocus: true
        });

        $("#bind").click(function () {
            var nickname = $("input[name='nickname']").val();
            var id = $("input[name='id']").val();

            $.ajax({
                url:"{pigcms{:U('')}",
                type:'post',
                data:{'nickname':nickname,'id':id},
                success:function (res) {
                    if(res == 1)
                    {
                        swal({
                                title: "绑定成功！",
                                text: "客户已经和微信绑定",
                                type: "success",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "成功"

                            },
                            function(){
                                window.location.reload();
                            }
                        );
                    }
                    else if(res == 2)
                    {
                        swal({
                                title: "绑定失败！",
                                text: "请联系技术员",
                                type: "error",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "好的"

                            },
                            function(){
                                window.location.reload();
                            }
                        );
                    }
                    else if(res == 3)
                    {
                        swal({
                                title: "该用户未认证智慧助手业主",
                                text: "请引导客户认证智慧助手业主",
                                type: "error",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "好的"

                            },
                            function(){
                                window.location.reload();
                            }
                        );
                    }
                }
            });
        });


    });
</script>
