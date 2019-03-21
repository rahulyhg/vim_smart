<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="table-toolbar-left">

</block>
<block name="body">
    <div class="btn-group">
        <a href="{pigcms{:U('qrcode_preview',array('type'=>'shuidian'))}">
            <button id="sample_editable_1_new" class="btn sbold green">水电表全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
        <a href="{pigcms{:U('qrcode_preview')}">
            <button id="sample_editable_1_new" class="btn sbold green">巡更码全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
        <a href="{pigcms{:U('qrcode_preview',array('type'=>'zhuanyeshebei'))}">
            <button id="sample_editable_1_new" class="btn sbold green">专业设备全部打印
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div>
        <form action="{pigcms{:U('qrcode_preview_select')}" method="post" enctype="multipart/form-data">
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">文件模板
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <a href="http://www.hdhsmart.com/upload/example/水电表巡更查询格式表.xls" download="水电表巡更查询格式表.xls">
                        下载
                    </a>
                </div>
            </div>

            <!--<div class="form-group form-md-line-input">
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
            </div>-->
            <div class="form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">选择打印标签种类
                    <span class="required"></span>
                </label>

                <div class="col-md-9">
                    <select name="type" class="form-control">
                            <option value="shuidian">水电</option>
                            <option value="">巡更码</option>
                            <option value="zhuanyeshebei">专业设备</option>
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
                        <button type="submit" class="btn green">确认提交</button>
                        <button type="button" class="btn default" onclick="app.redirect('meterlist_news')">返 回</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>