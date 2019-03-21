<extend name="./tpl/System/Public_news/base_form.php"/>
<block name="body">
    <div>
        <form action="__SELF__" id="form" method="post" enctype="multipart/form-data" >

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
                        <input type="submit" class="btn green"  value="确认提交"/>
                        <!--<button type="submit" class="btn green" >确认提交</button>-->
                        <!--<button type="button" class="btn default" onclick="app.redirect('ownerlist_uptown_news')">返 回</button>-->
                    </div>
                </div>
            </div>
        </form>
    </div>

</block>
<block name="script">

</block>