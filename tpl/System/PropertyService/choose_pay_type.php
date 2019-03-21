<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">选择支付方式</h4>
</div>
<div class="modal-body" style="height: 40rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">请选择支付方式
                （ <small class="text-danger inline">非银联支付请选线下支付</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <foreach name="typeArray" item="v" key="k">
                <if condition="$k eq '银联支付'">
                    <a href="{pigcms{$v}" class="btn green-haze btn-outline sbold uppercase" style="margin: 20px">{pigcms{$k}</a>
                <else/>
                    <a  data-toggle="modal" data-target="#third_modal" href="{pigcms{$v}" class="btn green-haze btn-outline sbold uppercase" style="margin: 20px">{pigcms{$k}</a>
                </if>
            </foreach>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script>
</script>
