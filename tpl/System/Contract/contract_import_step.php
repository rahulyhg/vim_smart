<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="{pigcms{:U('contract_import_step1')}" method="post" enctype="multipart/form-data">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/合同数据导入格式表.xls" download="contract_example.xls">
                        下载
                    </a>
                </div>
            </div>

            <!-- <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择社区
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="village_id" class="form-control">
                        <foreach name="village_list" item="row" key="key">
                            <option value="{pigcms{$key}">{pigcms{$row}</option>
                        </foreach>
                    </select>
                </div>
            </div> -->

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
                        <button type="button" class="btn default" onclick="app.redirect('contract_news')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>