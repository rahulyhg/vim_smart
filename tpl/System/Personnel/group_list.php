<extend name="./tpl/System/Public_news/base.php" />
<block name="body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="col-md-12">
            <div class="tab-content">
                <div  class="tab-pane active">
                    <foreach name="group_list" item="vo">
                        <div class="form-group form-md-line-input">
                            <label class="col-sm-2 control-label">{pigcms{$vo['group_name']}</label>
                            <input type="hidden" name="{pigcms{$vo['group_id']}[group_id]" value="{pigcms{$vo['group_id']}"/>
                            <div class="col-sm-9" >
                                <input type="text" id="group_{pigcms{$vo['group_id']}" class="form_control" name="{pigcms{$vo['group_id']}[realname]" value="{pigcms{$vo['realname']}" placeholder="请填写对应真实姓名"/>
                                <span style="color: red">*注意填写全名</span>
                            </div>
                            <div class="form-control-focus"> </div>
                        </div>
                    </foreach>
                        <div class="row">
                            <div class="col-sm-2 control-label"></div>
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                </div>
            </div>
            </div>

        </form>
    </div>
</block>
<block name="script">
    <script src="/static/js/jquery.bigautocomplete.js"></script>
    <link rel="stylesheet" href="/static/css/jquery.bigautocomplete.css">
    <foreach name="group_list" item="vo">
        <script>
            $("#group_{pigcms{$vo['group_id']}").bigAutocomplete({
                url:'{pigcms{:U("Personnel/ajax_admin_list")}',
                callback:function(data){
                    console.log(data);
                }
            });

        </script>
    </foreach>

</block>