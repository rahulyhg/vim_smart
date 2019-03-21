<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
    </style>
</block>
<block name="modal_body">
    <div class="row">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" id="app">
                <div id="basicinfo" class="tab-pane active">
            <div class="form-group">
                <div class="col-sm-2 control-label">预算名称</div>
                <div class="col-sm-9" style="padding-top: 7px;">
                    <span>{pigcms{$type_info['type_name']}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">年份</div>
                <div class="col-sm-9" style="padding-top: 7px;">
                    <span>{pigcms{$year}年</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">预算总金额</div>
                <div class="col-sm-9">
                    <input  class="form-control" name="money_sum"  value="{pigcms{$data['money_sum']}"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">当前已使用</div>
                <div class="col-sm-9" style="padding-top: 7px">
                    <span>{pigcms{:number_format($data['sum'],2)}元</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">剩余</div>
                <div class="col-sm-9 " style="padding-top: 7px;">
                    <span>{pigcms{:number_format(($data['money_sum']-$data['sum']),2)}元</span>
                </div>
            </div>
                    <div class="space"></div>
                    <div class="form-actions"
                        <div class="row">
                            <div class="col-sm-2 control-label"></div>
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" class="btn green">确认提交</button>
                                <button type="reset" class="btn default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>
</block>
<block name="modal_script">
    <script>

    </script>
</block>