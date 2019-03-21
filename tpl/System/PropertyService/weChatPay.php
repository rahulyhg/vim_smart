<div class="modal-header">
    <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">微信支付</h4>
</div>
<form action="__SELF__" method="post" id="myForm">
<div class="modal-body" style="height: 60rem;overflow-y: scroll">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span style="vertical-align: bottom;line-height: 33px;">请确定支付金额
                （ <small class="text-danger inline">微信支付需全额缴完</small>
                ）
            </span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th colspan="5" style="color: blue">尊敬的客户：{pigcms{$userInfo.name}</th>
                </tr>
                <tr>
                    <th>收费项目</th>
                    <th>应收费用<small class="text-muted">（元）</small></th>
                    <th>已缴费用<small class="text-muted">（元）</small></th>
                    <th>未缴费用<small class="text-muted">（元）</small></th>
                    <th>本次实缴费用<small class="text-muted">（元）</small></th>
                    <!--                    <th>上月上报状态1</th>-->
                </tr>
                <foreach name="userInfo['nowPay']" item="v" key="k">
                    <tr>
                        <td>{pigcms{$k}</td>
                        <td>{pigcms{$v.0}元</td>
                        <td>{pigcms{$v.1}元</td>
                        <td>{pigcms{$v.2}元</td>
                        <td>{pigcms{$v.2}元</td>
                    </tr>
                </foreach>
                <tr>
                    <th colspan="5" style="color: blue">扫以下二维码进行支付</th>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center"><img src="{pigcms{:U('PropertyService/QR',array('url'=>$payUrl))}"/></td>
                </tr>

            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeWid">关闭</button>
</div>
</form>
<script src="./static/js/vue.min.js"></script>
<script src="./static/js/vue-route.js"></script>
<script src="/Car/Admin/Public/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/Car/Admin/Public/js/ui-sweetalert.min.js" type="text/javascript"></script>
<script>
    $(function(){
        var orderNo = "{pigcms{$order_no}";
        var t = setInterval(function () {
            $.ajax({
                url:"{pigcms{:U('check_this_order')}",
                type:'post',
                data:{'order_no':orderNo},
                success:function(res){
                    if(res==1){
                        clearInterval(t);
                        swal({
                                title: "支付成功！",
                                text: "你的本次缴费已经完成，谢谢使用",
                                type: "success",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "好的"

                            },
                            function(){
                                window.location.reload();

                            }
                        );

                    }
                }

            });
        },1000);
    });
    


    
</script>
