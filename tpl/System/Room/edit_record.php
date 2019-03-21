<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <form action="{pigcms{:U(ACTION_NAME . '_act')}" class="form-horizontal" method="post">
        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">设备编号
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" disabled="disabled" value="{pigcms{$info.meter_code}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">抄录时间
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control"  disabled="disabled" value="{pigcms{$info.create_time|date='Y-m-d:H:i',###}">
            </div>
        </div>


        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">抄录人
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" disabled="disabled" value="{pigcms{$info.realname}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">起码
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="last_total_consume" id="last_total_consume" value="{pigcms{$info.last_total_consume}">
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-md-2 control-label" for="form_control_1">止码
                <span class="required">*</span>
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="total_consume" value="{pigcms{$info.total_consume}">
            </div>
        </div>

        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <input type="hidden" name="record_id" value='{pigcms{:I("get.record_id")}'>
                    <button type="submit" class="btn green">确认提交</button>
                    <button type="reset" class="btn default">重 置</button>
                    <button type="button" class="btn default" onclick="app.redirect('meter_record_news')">返 回</button>
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
