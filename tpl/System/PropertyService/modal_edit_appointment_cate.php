
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">编辑</h4>
</div>
<div class="modal-body" style="height:300px;overflow: auto">
    <php>
        dump($info);
    </php>

    <div class="col-md-12" style="float: left">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
            </div>
            <div class="portlet-body">
<!--                预约名称-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">预约名称
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.name}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入名称</span>
                        </div>
                    </div>
                </div>
                <!--商品单位-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">单位
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.unit}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入单位</span>
                        </div>
                    </div>
                </div>
                <!--一单位价格-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">价格
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.price}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入名称</span>
                        </div>
                    </div>
                </div>
                <!--商品排序-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">排序
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.sort}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入名称</span>
                        </div>
                    </div>
                </div>
                <!--商品状态-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">状态
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.status}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入名称</span>
                        </div>
                    </div>
                </div>
<!--                商品描述-->
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1" id="cont_name">描述
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="" name="name" value="{pigcms{$info.dec}">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">请输入名称</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">
    <button  type="button" class="btn btn-primary">保存</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>