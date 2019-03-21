<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <form action="__SELF__" class="form-horizontal" method="post">
        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">业主姓名
                <span class="required">*</span>
            </label>

            <div class="col-md-9">
                <input type="text" class="form-control" name="name" value="{pigcms{$owner_info.name}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">身份证号
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="usernum"  value="{pigcms{$owner_info.usernum}">
            </div>
        </div>


        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">手机号
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="phone"  value="{pigcms{$owner_info.phone}">
            </div>
        </div>


        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <button type="submit" class="btn green">确认提交</button>
                    <a href="{pigcms{:U('ownerlist_updown_news')}"><button type="button" class="btn default">返 回</button></a>
                </div>
            </div>
        </div>
    </form>
</block>
<block name="head">
    <style>
        .is_choosed{
            color: #ffbb53;
        }
    </style>
</block>
<block name="script">

</block>