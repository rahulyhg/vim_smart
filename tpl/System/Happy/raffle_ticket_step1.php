<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="{pigcms{:U('raffle_ticket_step2')}" method="post" enctype="multipart/form-data">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/cjq.xlsx" download="cjq.xlsx">
                        下载
                    </a>
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
                        <button type="submit" class="btn green">确认提交</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</block>