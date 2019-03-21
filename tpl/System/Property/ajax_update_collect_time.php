<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
		.modal-footer {display:none;}
    </style>
</block>
<block name="modal_body">
    <div class="row" style="overflow-x:hidden;">
        <form  class="form-horizontal" method="post" id="type_form" enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" id="app">
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-4 control-label">当前所选年份</div>
                        <div class="col-sm-6" style="padding-top: 8px;">
                            <span><span style="font-weight:bold; color:#000000;">{pigcms{$year}</span>年（请注意所有时间都结算至设置日期的24点，比如设置25日，则统计至25日24:00）</span>
                        </div>
                    </div>
                    <for start="1" end="$month_number1">
                        <div class="form-group" >
                            <div class="col-sm-4 control-label" style="line-height:30px;">{pigcms{$i}月</div>
                            <div class="col-sm-6" style="padding-top: 6px;">
                                <input  class="form-group" name="data[{pigcms{$i}]"  value="{pigcms{$collect_time[$i]}" style="height:30px; line-height:30px; width:50%;"/>日 
                            </div>
                        </div>
                    </for>
                    <div class="space"></div>
                    <div class="form-actions"
                    <div class="row">
                        <div class="col-sm-2 control-label"></div>
                        <div class="col-md-offset-4 col-md-9">
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