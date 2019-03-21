<extend name="./tpl/System/Public_news/modal_base.php" />
<block name="modal-head">
    <style>
        .bg-floor{
            background-color: #00f0ff;
        }
        .xdsoft_datetimepicker{
            z-index: 1000000000;
        }
    </style>
</block>
<block name="modal_body">
    <div class="row">
        <form  class="form-horizontal" method="post"  enctype="multipart/form-data" action="__SELF__" autocomplete="off">
            <div class="tab-content" >
                <div id="basicinfo" class="tab-pane active">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">当前年假剩余</div>
                        <div class="col-sm-9">
                            <span style="padding-top: 7px">{pigcms{$annual_residue_last}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">每年年假刷新时间</div>
                        <div class="col-sm-9" style="padding-top: 7px;">
                            <span style="padding-top: 7px">{pigcms{$day}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">本次年假使用天数</div>
                        <div class="col-sm-9" style="padding-top: 7px;">
                            <input  class="form-control"  name="use_day"  value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">使用时间</div>
                        <div class="col-sm-9" style="padding-top: 7px;">
                            <input  class="form-control datetimepicker"   name="updatetime"  value="" placeholder="不选择则默认为当前时间"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">备注</div>
                        <div class="col-sm-9">
                            <input  class="form-control" name="remark"  value=""/>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="form-actions"></div>
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
    <!--<link rel="stylesheet" href="http://www.hdhsmart.com/Car/Admin/Public/css/jquery.datetimepicker.css">
    <script src="/Car/Admin/Public/js/jquery.datetimepicker.full.js" type="text/javascript"></script>-->
    <script>
        $.datetimepicker.setLocale('ch');
        $('.datetimepicker').datetimepicker({
            lang:"zh",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            startDate:'{pigcms{:date('Y-m-d')}',
            /*datepicker: false,//关闭日期选项*/
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false,    //关闭选择今天按钮
            scrollMonth:false,      //关闭鼠标滚轮事件
            scrollTime:false,
            scrollInput:false
        });
    </script>
</block>