<layout name="layout"/>
<!--头部设置-->
<?php
$title = array(
    'title'=>'包裹入库',
    'describe'=>'',
);
$breadcrumb = array(
    array('包裹入库','#'),
    array('包裹入库','#'),
);

/*$add_action = array(
    'url'=>U('Searchhot/add'),
    'name'=>'快递1公司'
);*/
?>
<!--头部设置结束-->
<include file="Public_news:header"/>
<!--业务区-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light tasks-widget bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-haze bold uppercase">{pigcms{$company_name}</span>
                    <a class="caption-helper" href="{pigcms{:U('choose_express_company_news')}">点击这里换快递公司入库</a>
                </div>
            </div>

            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>包裹入库</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <!--<a href="#portlet-config" data-toggle="modal" class="config"> </a>-->
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="__SELF__" class="form-horizontal" method="post">
                        <input type="hidden" name="cid" value="{pigcms{$Think.get.cid}"/>
                        <div class="form-body">


                            <div class="form-group">
                                <label class="col-md-3 control-label">手机号<span style="color: red">*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                                                    <span class="input-group-addon input-circle-left">
                                                                        <i class="fa fa-phone"></i>
                                                                    </span>
                                        <input type="text" name="phone" class="form-control input-circle-right" placeholder="请输入收件人电话"> </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">姓名</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                                                    <span class="input-group-addon input-circle-left">
                                                                        <i class="fa fa-user"></i>
                                                                    </span>
                                        <input type="text" name="name" class="form-control input-circle-right" placeholder="请输入收件人姓名"> </div>
                                </div>
                            </div>

                            <div class="form-group" id="saoma">
                                <label class="col-md-3 control-label">运单编号<span style="color: red">*</span></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                                                    <span class="input-group-addon input-circle-left">
                                                                        <i class="fa fa-barcode"></i>
                                                                    </span>
                                        <input type="text" name="waybill_number" class="form-control input-circle-right" placeholder="请扫描运单号"> </div>
                                </div>
                            </div>

                            <div class="form-group" style="display: none" id="hand_number">
                                <label class="col-md-3 control-label">运单编号</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                                                    <span class="input-group-addon input-circle-left">
                                                                        <i class="fa fa-barcode"></i>
                                                                    </span>
                                        <input type="text" name="waybill_number1" class="form-control input-circle-right" placeholder="请输入运单号"> </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" id="show_hand"><u>无法扫码？点这里</u></label>
                            </div>



                            <div class="form-actions" style="display: none" id="hand_submit">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn btn-circle green" id="handInput">提交</button>
                                    </div>
                                </div>
                            </div>

                    </form>
                    <!-- END FORM-->
                </div>
            </div>

        </div>
    </div>
</div>
<!--业务区结束-->

<!--引入js-->
<include file="Public_news:script"/>
<!--引入js-->

<!--自定义js代码区开始-->
<script>

    $("input[name='waybill_number']").keydown(function () {
        $("form").submit();

    });

    $("#show_hand").click(function(){
        $("#hand_number").show();
        $("#hand_submit").slideDown();
        $("#saoma").hide();
    });

    $("#handInput").click(function () {
        var number = $("input[name='waybill_number1']").val();
        $("input[name='waybill_number']").val(number);
        $("form").submit();
    });

    $("input[name='phone']").change(function () {
        var phone = $("input[name='phone']").val();
        $.ajax({
            url:"{pigcms{:U('ajax_user_info')}",
            type:'post',
            data:{'phone':phone},
            success:function (res) {
                res && $("input[name='name']").val(res);
            }
        });
    });


</script>


<!--自定义js代码区结束-->
<include file="Public_news:footer"/>