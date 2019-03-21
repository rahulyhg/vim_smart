<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">选择通知方式</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">请选择何种通知
                （ <small class="text-danger inline">不通知则不勾选</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <h3 style="text-align: center;color: blue">{pigcms{$assignArray.name}的{pigcms{$assignArray.ym}月度账单</h3>
            <if condition="isset($nickData)"><br /><small class="inline" style="font-size: 14px;">将会发送给 :<br /><foreach name="nickData" item="vo"><div style="display: inline-block;margin-bottom: 8px;margin-right:10px;width: 220px;height: 30px; "><img src="{pigcms{$vo['avatar']}" style="width:30px;height: 30px;" />&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$vo.nickname}&nbsp;&nbsp;</div></foreach> </small>
                <else /><small class="inline" style="font-size: 14px;">没有要发送的人员
                </if>

            <hr/>
                <div class="md-checkbox-inline">
                    <div class="md-checkbox">
                        <input type="checkbox" id="checkbox1" class="md-check" name="template[]" checked>
                        <label for="checkbox1">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span> 水电费催费通知 </label>
                    </div>
                    <div class="md-checkbox">
                        <input type="checkbox" id="checkbox2" class="md-check" name="template[]">
                        <label for="checkbox2">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span> 物业费催费通知 </label>
                    </div>
                </div>
                <div style="width: 50%;float: left" id="sd">
                    <span style="width:20%;height:20%">水电费催费通知样本</span>
                        <a data-toggle="modal" data-target="#third_modal" href="{pigcms{:U('show_this_template',array('usernum'=>$assignArray['id'],'ym'=>$assignArray['ym'],'type'=>1))}">
                            <img src="./static/img/images/sdjf.png" title="水电费催费通知样本" width="30%" height="30%"/>
                        </a>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div style="width: 50%;float: left;display: none" id="wy">
                    <span style="width:20%;height:20%">物业费催费通知样本</span>
                        <a data-toggle="modal" data-target="#third_modal" href="{pigcms{:U('show_this_template',array('usernum'=>$assignArray['id'],'ym'=>$assignArray['ym'],'type'=>0))}">
                            <img src="./static/img/images/wyjf.png" title="物业费催费通知样本" width="30%" height="30%"/>
                        </a>
                </div>

        </div>
    </div>
<!--1-->
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" id="confirm_template" data-month="{pigcms{$assignArray.month}" data-pay="{pigcms{$assignArray.pay_id}" data-ym="{pigcms{$assignArray.ym}">确认</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="./static/js/template.js"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>
